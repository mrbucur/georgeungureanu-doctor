# Local Development Guide

This guide explains how to set up the local development environment, make changes, and deploy to staging.

---

## Prerequisites

| Tool | Version | Purpose |
|---|---|---|
| [LocalWP](https://localwp.com) | 9.x+ | Local WordPress environment |
| Git | any | Version control |
| Node.js | 18+ | Playwright QA scripts |
| zip | any | Building release ZIPs (emergency fallback) |

Optional:
- WP-CLI — `deploy-staging.sh` uses it if available to flush Elementor cache after sync

---

## Repository structure

```
georgeungureanu-doctor/
│
├── wp-plugin/
│   └── gu-design-system/          ← PLUGIN SOURCE (edit here)
│       ├── gu-design-system.php   ← main plugin file
│       ├── assets/
│       │   ├── css/gu-design-system.css
│       │   └── js/
│       │       ├── gu-animations.js
│       │       └── gu-header.js
│       ├── acf-json/              ← ACF field group definitions
│       │   ├── group_ar.json      ← Article (33 fields)
│       │   ├── group_mc.json      ← Medical Condition (12 fields)
│       │   └── group_sp.json      ← Surgical Procedure (13 fields)
│       └── elementor-templates/   ← Elementor JSON exports (legacy)
│
├── wp-content/
│   └── themes/
│       └── ungureanu-md-child/    ← THEME SOURCE (edit here)
│           ├── style.css
│           ├── functions.php
│           ├── header.php
│           ├── footer.php
│           ├── front-page.php
│           ├── 404.php
│           └── assets/
│               └── css/theme.css
│
├── docs/                          ← All documentation
│   ├── DEPLOYMENT.md              ← WordPress install steps
│   ├── STAGING_DEPLOYMENT_WORKFLOW.md ← Git deployment guide
│   ├── UAT_CHECKLIST.md
│   ├── CLIENT_CONTENT_REQUIRED.md
│   └── implementation/            ← Per-sprint records
│
├── scripts/
│   ├── deploy-staging.sh          ← Local → LocalWP sync
│   └── build-release.sh           ← Build dist/ ZIPs (fallback)
│
├── dist/                          ← Generated ZIPs (gitignored)
├── elementor/                     ← Additional Elementor exports
├── .cpanel.yml                    ← cPanel Git deployment config
└── .gitignore
```

---

## Local WordPress setup (first time)

1. Open **LocalWP** → your site should be `georgeungureanu-doctor-dev`
2. Site URL: `http://georgeungureanu-doctor-dev.local`
3. PHP: 8.1+ · MySQL: 8.0+
4. Required plugins active: Elementor, Elementor Pro, ACF Free, GU Design System
5. Active theme: **Ungureanu MD Child**

The plugin and theme on LocalWP are synced from the repo, not edited directly in the LocalWP directory. See **Editing code** below.

---

## Editing code

### Plugin changes

1. Edit files in `wp-plugin/gu-design-system/`
2. Sync to LocalWP:
   ```sh
   sh scripts/deploy-staging.sh
   ```
3. Refresh `http://georgeungureanu-doctor-dev.local` to verify
4. If CSS changed: LocalWP site → WP Admin → **Elementor → Tools → Regenerate CSS**

### Theme changes

1. Edit files in `wp-content/themes/ungureanu-md-child/`
2. Sync to LocalWP:
   ```sh
   sh scripts/deploy-staging.sh
   ```
3. Refresh to verify

### Do NOT edit files directly in LocalWP

The LocalWP plugin/theme directories are deployment targets, not sources. Changes made there will be overwritten by the next `deploy-staging.sh` run.

---

## Pushing to GitHub

```sh
git add .
git commit -m "type: short description"
git push origin main
```

Commit message types: `feat`, `fix`, `docs`, `style`, `refactor`

---

## Deploying to staging

After pushing to GitHub:

1. cPanel → **Git™ Version Control** → `georgeungureanu-doctor` → **Manage**
2. Click **Update from Remote**
3. Run post-deploy smoke tests (see `docs/STAGING_DEPLOYMENT_WORKFLOW.md`)

---

## Running QA scripts

Playwright tests live in the session scratchpad and are not committed. To run a visual audit:

```sh
cd /path/to/scratchpad
node qa_sprint912_audit.cjs
```

Screenshots are saved to `scratchpad/screenshots_912/`.

---

## Design system reference

All design tokens are defined in `wp-plugin/gu-design-system/assets/css/gu-design-system.css` (`:root` block, lines ~60–150).

| Token | Value | Use |
|---|---|---|
| `--color-ink` | `#1D1D1F` | Primary text |
| `--color-ink-secondary` | `#424245` | Body text |
| `--color-ink-tertiary` | `#6E6E73` | Captions, meta |
| `--color-surface` | `#FFFFFF` | Default background |
| `--color-surface-warm` | `#F5F5F7` | Card backgrounds |
| `--color-surface-gray` | `#F2F2F7` | Alternate sections |
| `--color-accent` | `#0E7FC0` | Buttons, links |
| `--color-accent-hover` | `#0B6094` | Button hover |
| `--font-sans` | `'Inter', system-ui, …` | All text |
| `--ease-spring` | `cubic-bezier(0.34, 1.4, 0.64, 1)` | Card hover |

---

## What belongs where

| Concern | Location |
|---|---|
| Design tokens (CSS variables) | Plugin — `gu-design-system.css` |
| Component CSS (cards, buttons, FAQ) | Plugin — `gu-design-system.css` |
| Page layout HTML | Theme — `*.php` templates |
| Theme-level CSS (footer, hero, 404) | Theme — `assets/css/theme.css` |
| CPT registration | Plugin — `gu-design-system.php` |
| ACF field groups | Plugin — `acf-json/*.json` |
| Shortcodes | Plugin — `gu-design-system.php` |
| Scroll-reveal JS | Plugin — `assets/js/gu-animations.js` |
| Mobile header JS | Plugin — `assets/js/gu-header.js` |

See `docs/planning/CHILD_THEME_ARCHITECTURE.md` for the full rationale.
