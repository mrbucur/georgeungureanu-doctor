# Staging Deployment Workflow

**Official method:** Git push → cPanel Git Version Control → Update from Remote  
**Emergency fallback:** ZIP upload via WordPress Admin (see `scripts/build-release.sh`)  
**Decision record:** `docs/DEPLOYMENT_DECISIONS.md`

---

## Architecture

```
Developer machine
  └── georgeungureanu-doctor/ (Git repo)
        ├── wp-plugin/gu-design-system/        ← plugin source
        ├── wp-content/themes/ungureanu-md-child/ ← theme source
        └── .cpanel.yml                        ← deploy tasks

GitHub
  └── puiucrisanbucur/georgeungureanu-doctor   ← origin/main

Staging server (cPanel)
  └── cPanel Git Version Control
        → pulls from GitHub
        → runs .cpanel.yml tasks
        → copies plugin → wp-content/plugins/gu-design-system/
        → copies theme  → wp-content/themes/ungureanu-md-child/
```

---

## One-time setup (do once per hosting account)

### 1. Edit `.cpanel.yml`

Open `.cpanel.yml` in the repo root. Replace `[WP_ROOT]` with the absolute path to the WordPress installation on the staging server.

```
[WP_ROOT] → /home/yourusername/public_html
```

To find the correct path: cPanel → File Manager → navigate to `public_html` → note the full path shown in the address bar.

Commit and push this change before wiring up cPanel.

### 2. Connect cPanel to GitHub

1. cPanel → **Git™ Version Control** → **Create**
2. Toggle **Clone a Repository**
3. **Clone URL:** `git@github.com:puiucrisanbucur/georgeungureanu-doctor.git`
4. **Repository Path:** e.g. `/home/yourusername/repos/georgeungureanu-doctor`
5. **Repository Name:** `georgeungureanu-doctor`
6. Click **Create** — cPanel clones the repo and runs `.cpanel.yml` immediately

### 3. Add cPanel's deploy key to GitHub

If the clone fails with a permissions error:

1. cPanel → Git Version Control → the repo → **Manage** → copy the **Public Key**
2. GitHub → repository → **Settings → Deploy Keys → Add deploy key**
3. Paste the public key, name it `cPanel staging`, check **Allow write access** = OFF
4. Click **Add key**
5. Back in cPanel → retry **Update from Remote**

### 4. Verify WordPress sees the new plugin/theme

- cPanel → File Manager → confirm `public_html/wp-content/plugins/gu-design-system/` exists
- WordPress Admin → Plugins → confirm **GU Design System** is listed
- WordPress Admin → Appearance → Themes → confirm **Ungureanu MD Child** is listed
- Activate both if not already active

---

## Normal deployment flow (every time)

### Step 1 — Edit locally

Make changes to plugin or theme source files.

### Step 2 — Test on LocalWP

```sh
sh scripts/deploy-staging.sh
```

Opens `http://georgeungureanu-doctor-dev.local` and verify the change works.

### Step 3 — Commit and push

```sh
git add .
git commit -m "feat: description of change"
git push origin main
```

### Step 4 — Deploy to staging

1. cPanel → **Git™ Version Control**
2. Find `georgeungureanu-doctor` → click **Manage**
3. Click **Update from Remote**
4. Wait for the green checkmark — cPanel runs `.cpanel.yml` tasks automatically

### Step 5 — Post-deploy checks

After every deployment:

**Always:**
- [ ] Visit the staging URL — confirm the site loads
- [ ] Check homepage, one content page, one 404

**If plugin files changed:**
- [ ] WordPress Admin → **Elementor → Tools → Regenerate CSS & Data → Regenerate Files**
- [ ] Wait for completion (~30 seconds)

**If new page templates were added:**
- [ ] WordPress Admin → **Settings → Permalinks → Save Changes** (flushes rewrite rules)

**If ACF fields changed:**
- [ ] WordPress Admin → **Custom Fields → Tools → Sync** — confirm 0 pending

**If anything looks wrong:**
- [ ] Check staging PHP error log: cPanel → **Error Log**
- [ ] Check browser console for 404 assets

---

## Emergency fallback — ZIP upload

Only use this if Git deployment is broken or the server does not support cPanel Git Version Control.

```sh
sh scripts/build-release.sh
```

This creates:
```
dist/
  gu-design-system.zip
  ungureanu-md-child.zip
```

Upload via:
- WordPress Admin → **Plugins → Add New → Upload Plugin** → `gu-design-system.zip`
- WordPress Admin → **Appearance → Themes → Add New → Upload Theme** → `ungureanu-md-child.zip`

After ZIP upload, still run the post-deploy checks above.

---

## What `.cpanel.yml` does

cPanel runs these tasks in a shell after pulling the latest commit:

```yaml
- mkdir -p [WP_ROOT]/wp-content/plugins/gu-design-system
- cp -R wp-plugin/gu-design-system/. [WP_ROOT]/wp-content/plugins/gu-design-system/
- mkdir -p [WP_ROOT]/wp-content/themes/ungureanu-md-child
- cp -R wp-content/themes/ungureanu-md-child/. [WP_ROOT]/wp-content/themes/ungureanu-md-child/
```

The repo is checked out to a non-web-accessible path (e.g. `/home/username/repos/`). The `.cpanel.yml` tasks copy only the plugin and theme into the WordPress directory. No other repo files (docs, scripts, elementor exports) are copied to the web root.

---

## Troubleshooting

| Symptom | Cause | Fix |
|---|---|---|
| "Update from Remote" shows no changes | Nothing new on `origin/main` | Push a new commit first |
| `.cpanel.yml` tasks fail | `[WP_ROOT]` not replaced | Edit `.cpanel.yml`, replace placeholder, commit, push, re-deploy |
| Plugin not updated after deploy | cPanel deploy key has no read access to GitHub | Verify deploy key in GitHub → Settings → Deploy Keys |
| Site shows old styles after deploy | Elementor CSS cache stale | Admin → Elementor → Tools → Regenerate CSS |
| `wp-content/plugins/gu-design-system/` directory missing | First deploy — tasks ran before `mkdir -p` | Re-run Update from Remote |
| Elementor says templates are missing | Fresh WordPress install — templates not imported | Follow `docs/DEPLOYMENT.md` template import steps |
