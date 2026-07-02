# Sprint 10.0 — Staging Deployment Preparation

**Status:** READY FOR APPROVAL  
**Date:** 2026-07-02  
**Scope:** Audit, risk assessment, and deployment runbook for moving the current codebase to a staging environment. No code changes.

---

## 1. Git State

```
Branch:  main
Commit:  cfc15dd
Message: Sprint 9.12 — Final visual consistency & content reality pass
Status:  clean (nothing to commit, working tree clean)
```

---

## 2. Deployment Assets Checklist

### Plugin

| File | Size | Status |
|------|------|--------|
| `wp-plugin/gu-design-system/gu-design-system.php` | 114 KB | ✅ Present — v1.3.0 |
| `wp-plugin/gu-design-system/assets/css/gu-design-system.css` | 150 KB | ✅ Present |
| `wp-plugin/gu-design-system/assets/js/gu-animations.js` | 5.7 KB | ✅ Present |

### ACF Field Groups

| File | Title | Fields | Status |
|------|-------|--------|--------|
| `acf-json/group_ar.json` | Article (Knowledge Center) | 33 | ✅ Present |
| `acf-json/group_mc.json` | Medical Condition | 12 | ✅ Present |
| `acf-json/group_sp.json` | Surgical Procedure | 13 | ✅ Present |

### Elementor Template Exports (14 files)

| File | Purpose |
|------|---------|
| `header.json` | Site header (Theme Builder) |
| `footer.json` | Site footer (Theme Builder) |
| `404-page.json` | 404 error page |
| `sprint4-single-afectiuni.json` | Afecțiune single |
| `sprint4-archive-afectiuni.json` | Afecțiuni archive |
| `sprint5-single-interventii.json` | Intervenție single |
| `sprint5-archive-interventii.json` | Intervenții archive |
| `sprint6-programari.json` | Programări page content |
| `sprint6-faq-programari.json` | Reusable FAQ section |
| `sprint6-locatie-card.json` | Reusable location card |
| `sprint6-cta-final.json` | Reusable CTA section (now superseded by PHP) |
| `sprint7a-archive-articole.json` | Articole hub archive |
| `sprint7a-single-articol.json` | Articol single |
| `sprint8-page-despre.json` | Despre page |

> **Note:** Homepage, Programări, Sfatul hub, Recomandări, and the final CTA are rendered via PHP shortcodes in the plugin — not from these template exports. The plugin must be installed and activated for those pages to render.

### Documentation

| File | Status |
|------|--------|
| `docs/DEPLOYMENT.md` | ✅ Present — **⚠ outdated** (see Risk R1 below) |
| `docs/UAT_CHECKLIST.md` | ✅ Present (Sprint 9.12) |
| `docs/CLIENT_CONTENT_REQUIRED.md` | ✅ Present (Sprint 9.12) |

---

## 3. Known Staging Risks

### R1 — DEPLOYMENT.md references old design tokens ⚠ HIGH
`docs/DEPLOYMENT.md` Step 4 (Elementor Site Settings → Global Colors) still lists the old "Direction B+ Warm Academic Medicine" palette (Lora font, `#231E1A` ink, `#4D7A70` accent). The site has migrated to Apple Health tokens (`#1D1D1F`, Inter-only, `#0E7FC0` accent) via CSS custom properties in the plugin.

**Impact:** Following the doc step-by-step on a fresh staging install will set wrong global colors and typography in Elementor's database. Our plugin CSS overrides most of these via `!important` and ID selectors, so visual output will be correct — but any new Elementor widgets created on staging will inherit the wrong defaults.

**Mitigation:** Follow the corrected token table in Step 4 below (this document supersedes DEPLOYMENT.md Step 4 for this deployment). Update DEPLOYMENT.md before staging invite is sent to client.

---

### R2 — Online consultation link is placeholder ⚠ HIGH
`$online_cal_url = '#'` in `gu-design-system.php` (line ~1414). The "Programează o consultație online" button on the Programări page goes nowhere.

**Impact:** A core user flow is broken on staging.

**Mitigation:** Either create a Cal.com account before staging deployment and replace `'#'` with the real link, or add a visible banner noting it is a placeholder. See `docs/CLIENT_CONTENT_REQUIRED.md` → C4.

---

### R3 — No staging server defined ⚠ MEDIUM
No staging URL, server credentials, or hosting provider has been specified yet.

**Impact:** This doc cannot be executed until staging infrastructure exists.

**Mitigation:** Before proceeding, define: hosting provider, staging domain (e.g. `staging.georgeungureanu.doctor`), PHP version (must be ≥ 8.1), MySQL version (must be ≥ 8.0), and SSH/SFTP credentials.

---

### R4 — Content is placeholder throughout ⚠ MEDIUM
Doctor portrait, clinic addresses, booking links, phone number, email, biography, media appearances, and patient recommendations are all placeholder. A staging demo will show this to the client.

**Impact:** First impression in review will be weakened by missing real content.

**Mitigation:** Collect CRITIC items (C1–C5 in `CLIENT_CONTENT_REQUIRED.md`) before scheduling the staging review session.

---

### R5 — Elementor Theme Builder conditions not in template JSON ⚠ LOW
Template conditions (which template applies to which page/CPT) are stored in the WordPress database, not in the exported JSON files. After template import, all conditions must be re-assigned manually.

**Impact:** Header and footer will not render, single/archive templates will not fire until conditions are set.

**Mitigation:** Follow Step 8 in DEPLOYMENT.md exactly. Do not skip.

---

### R6 — ACF `group_ar.json` not documented in DEPLOYMENT.md ⚠ LOW
`docs/DEPLOYMENT.md` Step 5 mentions only `group_mc.json` and `group_sp.json`. `group_ar.json` (Article / Knowledge Center, 33 fields) is absent from the doc.

**Impact:** If following the old doc, the Article field group may not be synced, breaking the Sfatul hub single article pages.

**Mitigation:** The ACF sync step in this document (Step 5 below) covers all three groups.

---

## 4. Manual Deployment Steps

These steps supersede `docs/DEPLOYMENT.md` where conflicts exist (noted with ⚠).

### Step 1 — Provision staging environment
- PHP ≥ 8.1
- MySQL ≥ 8.0
- Permalinks capability (mod_rewrite or equivalent)
- Fresh WordPress install at the staging domain
- Set permalink structure to **Post name** (`/%postname%/`) before anything else

### Step 2 — Install and activate plugins (in order)
1. Elementor (4.1.4)
2. Elementor Pro (4.1.2) — license required
3. Advanced Custom Fields Free (6.8.4+)
4. GU Design System v1.3.0 — upload `wp-plugin/gu-design-system/` as a zip or copy directory to `wp-content/plugins/`

### Step 3 — Activate Hello Elementor theme

### Step 4 — Elementor Site Settings ⚠ UPDATED TOKENS
Open **Elementor → Site Settings → Global Colors** and set:

| Token | Hex |
|-------|-----|
| Color Ink | `#1D1D1F` |
| Color Ink Secondary | `#424245` |
| Color Ink Tertiary | `#6E6E73` |
| Color Surface | `#FFFFFF` |
| Color Surface Warm | `#F5F5F7` |
| Color Surface Gray | `#F2F2F7` |
| Color Accent | `#0E7FC0` |
| Color Accent Hover | `#0B6094` |

Under **Global Typography**:
- Primary font: **Inter**, weight 700
- Secondary font: **Inter**, weight 400/500/600
- Text font: **Inter**, weight 400

> ⚠ Do NOT set Lora as a font — the site is Inter-only as of Sprint 9.10.

### Step 5 — ACF Field Group Sync ⚠ THREE GROUPS
1. Go to **Custom Fields → Tools → Sync**
2. Three groups should appear:
   - **Article (Knowledge Center)** — 33 fields
   - **Medical Condition** — 12 fields
   - **Surgical Procedure** — 13 fields
3. Click **Sync All**

### Step 6 — Create required pages

| Title | Slug | Status | Notes |
|-------|------|--------|-------|
| Acasă | `acasa` | Publish | Set as static front page |
| Programări | `programari` | Publish | PHP shortcode — no Elementor needed |
| Despre | `despre` | Publish | Elementor + PHP shortcode |
| Recomandări | `recomandari` | Publish | PHP shortcode |
| Articole | `articole` | Publish | PHP shortcode (hub) |
| Afecțiuni | `afectiuni` | Publish | Elementor archive |
| Intervenții | `interventii` | Publish | Elementor archive |

Set **Settings → Reading → Your homepage displays** to static page → **Acasă**.

### Step 7 — Import Elementor Templates (in order)
**Elementor → My Templates → Import Template**

1. `header.json`
2. `footer.json`
3. `404-page.json`
4. `sprint4-single-afectiuni.json`
5. `sprint4-archive-afectiuni.json`
6. `sprint5-single-interventii.json`
7. `sprint5-archive-interventii.json`
8. `sprint7a-archive-articole.json`
9. `sprint7a-single-articol.json`
10. `sprint8-page-despre.json`
11. `sprint6-programari.json` *(Elementor fallback only — page is PHP-rendered)*

> Templates `sprint6-cta-final.json`, `sprint6-faq-programari.json`, `sprint6-locatie-card.json` are optional reusable sections — import if needed for future editing.

### Step 8 — Assign Theme Builder Conditions
**Elementor → Theme Builder**

| Template | Type | Condition |
|----------|------|-----------|
| Header | Header | All Pages |
| Footer | Footer | All Pages |
| 404 | Single | 404 Page |
| Single Afecțiune | Single | `afectiuni` post type |
| Archive Afecțiuni | Archive | `afectiuni` archive |
| Single Intervenție | Single | `interventii` post type |
| Archive Intervenții | Archive | `interventii` archive |
| Single Articol | Single | `articole` post type |
| Archive Articole | Archive | `articole` archive |

### Step 9 — Create demo content
- 1 × Afecțiune post with all 12 ACF fields filled
- 1 × Intervenție post with all 13 ACF fields filled
- 1 × Articol post with all required ACF fields filled
- Verify each renders correctly on its single and archive template

### Step 10 — Regenerate Elementor CSS
**Elementor → Tools → Regenerate CSS & Data → Regenerate Files**

Wait for completion. This generates per-page CSS files in `wp-content/uploads/elementor/css/`.

### Step 11 — Flush permalinks
**Settings → Permalinks → Save Changes**

Verify `/afectiuni/` and `/interventii/` return 200.

---

## 5. Rollback Plan

This is a fresh staging environment — there is no existing staging data to protect. Rollback means:

1. Deactivate plugin → revert to blank Hello Elementor
2. Or: provision a new staging instance and start over from Step 1

If deploying as an update to an existing staging environment:
1. Note current plugin version before uploading
2. Keep a copy of the old `gu-design-system/` directory
3. On rollback: replace plugin directory with old copy, then **Elementor → Tools → Regenerate CSS**

---

## 6. Post-Deploy Smoke Test Checklist

Run in a private/incognito browser window (no cache).

### Pages load
- [ ] `/` — Homepage: hero, statistics, cards, PHP CTA, footer
- [ ] `/despre/` — About: photo placeholder, credentials strip, biography
- [ ] `/programari/` — Appointments: 3 clinic cards, online card, checklist, FAQ
- [ ] `/recomandari/` — Recommendations: colleague cards, patient cards
- [ ] `/articole/` — Sfatul hub: featured article, hub nav, guide/recovery sections
- [ ] `/afectiuni/` — Archive: card grid renders
- [ ] `/afectiuni/[demo-slug]/` — Single: all ACF sections visible
- [ ] `/interventii/` — Archive: card grid renders
- [ ] `/interventii/[demo-slug]/` — Single: all ACF sections visible
- [ ] `/does-not-exist/` — 404 page renders custom template (not WP default)

### Design system
- [ ] Inter font loaded (check Network tab → Fonts)
- [ ] `gu-design-system.css` enqueued (check Network tab → CSS)
- [ ] `gu-animations.js` enqueued
- [ ] Primary buttons: background `#0E7FC0`
- [ ] No Lora serif font visible on any heading
- [ ] Hero text: `#1D1D1F` on white background (not white on white)
- [ ] Footer text: dark on dark-section background (not white-on-white)
- [ ] Homepage CTA section: gradient `#FFFFFF → #F2F2F7`, heading dark

### Interactions
- [ ] Scroll reveal: page sections fade in on scroll (not instant)
- [ ] Clinic cards: hover lifts 4px
- [ ] FAQ accordion: items open/close, open item heading turns accent blue
- [ ] Mobile hamburger menu opens and closes
- [ ] All in-page anchor links scroll smoothly

### Functional
- [ ] "Programează o consultație" buttons navigate to `/programari/`
- [ ] Footer links all resolve (no 404)
- [ ] No `href="#"` links trigger navigation errors
- [ ] No PHP warnings or notices in page source
- [ ] No `[gu_` shortcode strings visible (all rendered)

### ACF
- [ ] **Custom Fields → Tools → Sync** shows 0 pending (all 3 groups synced)
- [ ] ACF fields visible on Afecțiuni and Intervenții edit screens

---

## 7. Pre-Push Approval Gates

Before any push to staging, the following must be confirmed:

- [ ] **R3 resolved** — Staging server exists and credentials are available
- [ ] **R1 acknowledged** — Deployer is aware DEPLOYMENT.md Step 4 is outdated and will use the token table from this document
- [ ] **R2 decision made** — Either Cal.com link is real, or a placeholder note is acceptable for the staging review session
- [ ] Client content (C1–C5 from `CLIENT_CONTENT_REQUIRED.md`) decision — deploy with placeholders or wait for real content?

---

---

## Deployment docs updated

`docs/DEPLOYMENT.md` updated 2026-07-02 to resolve R1 and R6:

- **Step 4 — Global Colors:** replaced old Direction B+ palette (Lora, `#231E1A`, `#4D7A70`) with current Apple Health tokens (`#1D1D1F`, `#0E7FC0`, Inter-only). Added note that Lora must not be used.
- **Step 5 — ACF Sync:** added `group_ar.json` (Article / Knowledge Center, 33 fields) to the sync table. Was missing from the original doc.
- **Step 6 — Pages:** expanded from 2 pages to all 7 required pages; noted which are PHP-rendered by the plugin vs. Elementor-edited.
- **Step 7 — Templates:** added `sprint7a-archive-articole.json`, `sprint7a-single-articol.json`, `sprint8-page-despre.json`; clarified that `sprint6-*` CTA/programari templates are now legacy (PHP-rendered).
- **Step 8 — Theme Builder:** added Articol single and archive conditions.
- **Troubleshooting:** added rows for blank PHP-rendered pages, missing homepage CTA, Inter font not loading, and stale warm-tone colors.

R1 and R6 from the risk register are now resolved in documentation. R2 (Cal.com link), R3 (staging server), R4 (content placeholders) remain open pending client decisions.

---

*Generated: Sprint 10.0 — Staging Deployment Preparation*
