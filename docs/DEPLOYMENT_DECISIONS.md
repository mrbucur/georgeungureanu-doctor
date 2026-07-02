# Deployment Decisions

Architecture decisions that are stable and should not be revisited without a documented reason.

---

## DD-01 — Git + cPanel Git Version Control is the official deployment mechanism

**Date:** 2026-07-02  
**Status:** Adopted (Sprint 10.2.5)

### Decision

All deployments to staging and production are performed via:

1. `git push origin main`
2. cPanel → Git™ Version Control → Update from Remote

The `.cpanel.yml` file at the repo root defines the deployment tasks that cPanel runs automatically after each pull.

### Rationale

- **Single source of truth:** Every deployed file is in Git history. The state of staging is always `git log` + `.cpanel.yml`.
- **No manual file management:** ZIP uploads, FTP transfers, and manual file copies are error-prone and leave no audit trail.
- **Rollback by commit hash:** Roll back to any prior state with `git push --force-with-lease origin SHA:main` + Update from Remote. No backup ZIPs to manage.
- **Reviewed before deploy:** Code on staging has always passed a local test (LocalWP) and a code review (pull request or self-review) before reaching GitHub.

### What this replaces

| Old practice | Status |
|---|---|
| ZIP upload via WordPress Admin | Emergency fallback only (see DD-02) |
| Rsync from dev machine to server | Not used for staging |
| FTP | Never used — not documented |
| Manual file edits on server | Prohibited |

### Scope

Applies to:
- `wp-plugin/gu-design-system/` → staging `wp-content/plugins/gu-design-system/`
- `wp-content/themes/ungureanu-md-child/` → staging `wp-content/themes/ungureanu-md-child/`

Does NOT apply to:
- WordPress core files (managed by hosting)
- WordPress database content (managed via WP Admin or WP-CLI)
- Elementor template imports (one-time setup, then superseded by native PHP templates)

---

## DD-02 — ZIP upload is emergency fallback only

**Date:** 2026-07-02  
**Status:** Adopted (Sprint 10.2.5)

### Decision

`scripts/build-release.sh` generates installable ZIPs in `dist/`. This mechanism is retained solely as a fallback for:
- Hosting environments without cPanel Git Version Control
- Recovery scenarios where Git deployment is broken
- First-time WordPress installs where cPanel access is not yet configured

### What "emergency" means

ZIP upload is emergency fallback when:
- cPanel Git Version Control is unavailable or misconfigured
- The deploy key needs regeneration and there is no time to fix it
- A hotfix must reach staging immediately without waiting for Git pipeline

ZIP upload is NOT appropriate for:
- Routine feature deployments
- Any deployment that should appear in the audit trail

### Constraint

`dist/` is gitignored. ZIPs are generated fresh each time from the current working tree. They are never committed to the repository.

---

## DD-03 — Plugin is source of truth for design tokens and functionality

**Date:** 2026-07-02  
**Status:** Adopted (Sprint 10.1)

### Decision

The `gu-design-system` plugin is the canonical source for:
- All CSS custom properties (design tokens)
- CPT and taxonomy registration
- ACF field group JSON
- Shortcode rendering
- Scroll-reveal and header JS

The child theme (`ungureanu-md-child`) contains only:
- Page layout templates (PHP)
- Theme-level structural CSS (footer, hero, page-specific layouts)

The plugin is activated regardless of which theme is active. Deactivating the plugin breaks shortcodes and CPTs. Deactivating the theme breaks page layout (falls back to Hello Elementor).

### Rationale

Design tokens in the plugin are available to any future theme without migration. CPTs registered in the plugin survive theme switches. Keeping functionality in the plugin and layout in the theme enables independent versioning of each.

---

## DD-04 — Elementor Pro is retained for client content editing

**Date:** 2026-07-02  
**Status:** Adopted (Sprint 10.1)

### Decision

Elementor Pro remains installed and active on staging and production. It is not the layout authority (that role moves to PHP templates as Stage 1–4 migration progresses), but it is retained for:
- Client use of the Elementor visual editor within template regions
- Future content blocks that benefit from drag-and-drop editing
- Archive page post loops (while Stage 3 templates are pending)

Elementor template exports in `wp-plugin/gu-design-system/elementor-templates/` are archived reference material. They are not imported on new deployments once Stage 4 migration is complete.
