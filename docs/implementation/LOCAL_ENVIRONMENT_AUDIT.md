# Local Environment Audit

**Date:** 2026-06-28
**Environment:** LocalWP — `georgeungureanu-doctor-dev.local`
**Site path:** `~/Local Sites/georgeungureanu-doctor-dev/app/public`
**Status:** Audit complete — not yet implementation-ready
**Governing documents:** `docs/tasks/03_HEADER_AND_NAVIGATION.md`, `docs/tasks/04_DESIGN_SYSTEM_TOKENS.md`, `docs/implementation/SPRINT_1_FOUNDATION_CHECKLIST.md`

---

## 1. Current State

### 1.1 WordPress Core

| Property | Value |
|----------|-------|
| WordPress version | 7.0 |
| Site URL | `http://georgeungureanu-doctor-dev.local` |
| Site name | `georgeungureanu-doctor-dev` |
| Blog description | (empty) |
| Language | Not confirmed — `lang=ro` not verified |

### 1.2 Active Theme

| Property | Value | Status |
|----------|-------|--------|
| Active theme | Hello Elementor | ✅ Correct |
| Child theme | None | ⚠️ Not present |
| Theme stylesheet | `hello-elementor` (= template) | No child |

**Note on child theme:** For Sprint 1 scope, the absence of a child theme is not a hard blocker. The GU Design System plugin handles CSS injection without modifying the theme. If custom PHP hooks are ever needed (action/filter customization), a child theme would be the appropriate vehicle. Flag for Sprint 8 review.

### 1.3 Active Plugins

| Plugin | Version | Status | Notes |
|--------|---------|--------|-------|
| Elementor | 4.1.4 | ✅ Active | |
| Elementor Pro | 4.1.2 | ✅ Active | License key present |
| Advanced Custom Fields | **6.8.4 Free** | ⚠️ Active | **NOT Pro — critical gap** |
| GU Design System | 1.0.0 | ✅ Active | Custom plugin, correct |

**Critical finding — ACF Free vs ACF Pro:**
All 6 Custom Post Types defined in Task 02 require ACF Pro field types: Repeater, Flexible Content, Image, and Relationship fields. ACF Free 6.8.4 does not include Repeater or Flexible Content field types. ACF Pro must be installed before Sprint 2 (CPT and field group work) can begin.

Sprint 1 is not blocked by the ACF version — CPTs and field groups are Sprint 2 prerequisites per `SPRINT_1_FOUNDATION_CHECKLIST.md`. However, ACF Pro must be sourced and ready before the Sprint 1 Gate review passes.

### 1.4 Elementor Templates

| ID | Title | Type | Status | Display Condition |
|----|-------|------|--------|------------------|
| 6 | Default Kit | kit | ✅ Publish | — (active kit) |
| 9 | organism-site-header | header | ✅ Publish | include/general (entire site) ✅ |
| 12 | organism-site-footer | footer | ✅ Publish | include/general (entire site) ✅ |

Both templates are correctly set to display on the entire site. No additional templates (pages, 404) exist.

### 1.5 Elementor Kit — Global Design System

**This is the most important Sprint 1 finding.**

| Property | Value | Status |
|----------|-------|--------|
| Active kit | Default Kit (ID 6) | — |
| `_elementor_data` | Empty | ❌ No kit content |
| `_elementor_page_settings` | Empty | ❌ No global settings |
| Global Colors configured | **Zero** | ❌ None set |
| Global Typography configured | **Zero** | ❌ None set |
| Kit CSS fonts (actual) | Roboto, Roboto Slab | ❌ Wrong — spec requires Inter + Lora |

**Interpretation:** The Elementor Site Settings have never been configured. No Global Colors exist. No Global Typography styles exist. The kit is the factory default. Elementor widgets throughout the header and footer templates cannot reference global tokens because none have been created yet.

This is the primary Phase A work item and must be completed before any template editing begins.

### 1.6 Header v2 — Current State

Template: `organism-site-header` (ID 9)

**Structure (confirmed from template data):**

| Element | Value | vs. Spec |
|---------|-------|----------|
| Outer container ID | `organism-site-header` | ✅ Correct |
| HTML tag | `<header>` | ✅ Correct |
| ARIA role | `role="banner"` | ✅ Correct |
| Sticky position | top | ✅ Correct |
| Inner container width | 1200px | ✅ Correct |
| Skip-to-content link | Present, `href="#main-content"` | ✅ Present |
| Background color | `#FDFBF7` **hardcoded hex** | ❌ Must be Global Color token |
| Border color | `#D6CFC4` **hardcoded hex** | ❌ Must be Global Color token |
| Logo font family | Inter **hardcoded in widget** | ❌ Must be Global Typography token |
| Logo name color | `#231E1A` **hardcoded hex** | ❌ Must be Global Color token |

**Nav labels and CTA (from prior session analysis of the same template data source):**
The v2 template was built against the superseded navigation structure. Nav labels and slugs do not match the Task 03 frozen specification. Full correction required as part of the v3 rebuild.

**Summary:** The header's structural skeleton is correct (container IDs, HTML tags, ARIA, sticky, skip-to-content). The color and typography treatment is entirely hardcoded hex — no connection to the Global Design System. The navigation content is wrong. The CTA is hidden on mobile (must show in v3).

### 1.7 Footer v2 — Current State

Template: `organism-site-footer` (ID 12)

From prior session analysis of the same template file source (confirmed in `SPRINT_1_FOOTER_V3_PLAN.md`):

| Element | v2 State | vs. Spec |
|---------|----------|----------|
| HTML tag | `<footer>` | ✅ Correct |
| ARIA role | `role="contentinfo"` | ✅ Correct |
| Display condition | include/general | ✅ Correct |
| Row 1 background | `#EDE8DF` (Surface Muted) **hardcoded** | ❌ Must be `color-ink` (#231E1A) |
| All other colors | Hardcoded hex throughout | ❌ Must be Global Color tokens |
| Column 2 content | "PAGINI" page nav links | ❌ Wrong — must be "AFECȚIUNI" condition links |
| Column 3 content | "CONDIȚII TRATATE" (old `/conditii/` slugs) | ❌ Wrong — must be "SFATUL NEUROCHIRURGULUI" content |
| Column 4 | Schedule text + ghost link | ❌ Missing primary CTA button |
| Column 2 HTML tag | `<div>` | ❌ Must be `<nav>` |
| Column 3 HTML tag | `<div>` | ❌ Must be `<nav>` |
| Mobile column order | Desktop order (1,2,3,4) | ❌ Must be (4,1,2,3) on mobile |

**Summary:** Footer background color is wrong (Light → Dark) — this cascades to every text and border color inside it. Columns 2 and 3 require full content rebuilds. Column 4 requires a primary CTA button addition. HTML semantics for nav columns need correction.

### 1.8 Navigation Menus

| Type | Count | Detail |
|------|-------|--------|
| Classic nav menus (nav_menu taxonomy) | **0** | None created |
| Menu location assignments | **0** | theme_mods `nav_menu_locations: {}` |
| Block editor navigation (wp_navigation) | 1 | Default `<!-- wp:page-list /-->` — not usable |

**Zero classic WordPress nav menus exist.** The Elementor nav widget requires a classic menu (registered via `register_nav_menus` / `wp_nav_menu`) — it does not read block editor navigation. The one existing `wp_navigation` block is the WordPress default (auto-lists all pages) and is not relevant to Elementor.

Creating the correct navigation menu is Phase B of Sprint 1 and must happen before the header v3 template can be completed.

### 1.9 Pages

| ID | Title | Status | Slug |
|----|-------|--------|------|
| 2 | Sample Page | published | sample-page |
| 3 | Privacy Policy | draft | privacy-policy |

**None of the required site pages exist.** No homepage (or front page set), no /afectiuni/, no /sfatul-neurochirurgului/, no /recomandari/, no /despre/, no /programari/, no /contact/. The "Sample Page" is the WordPress installation default.

### 1.10 Custom Post Types

| CPT | Registered | Status |
|-----|-----------|--------|
| Condition | No | Sprint 2 |
| SN Article | No | Sprint 2 |
| Colleague Recommendation | No | Sprint 2 |
| Patient Testimonial (Testimoniale) | No | Sprint 2 |
| Timeline Event | No | Sprint 2 |
| Media Item | No | Sprint 2 |

No CPTs are registered. This is the expected state for Sprint 1 — CPTs are explicitly Phase E (Sprint 2 prerequisite) per `SPRINT_1_FOUNDATION_CHECKLIST.md`. Not a Sprint 1 blocker.

### 1.11 ACF Field Groups

Zero field groups exist. Expected for Sprint 1. Cannot be built until ACF Pro is installed and CPTs are registered (Sprint 2).

### 1.12 GU Design System Plugin

| Property | Value | Status |
|----------|-------|--------|
| Version | 1.0.0 | — |
| Plugin active | Yes | ✅ |
| Enqueues Google Fonts | Yes (Lora + Inter, via `wp_enqueue_style`) | ✅ |
| CSS asset present | `assets/css/gu-design-system.css` | ✅ |
| CSS custom properties | Loaded via the CSS file | ✅ |

**The GU Design System plugin is working.** CSS custom properties (color tokens, spacing, typography) are being injected via the plugin's stylesheet. Google Fonts (Lora and Inter) are being enqueued from the CDN.

**Important distinction:** The plugin loads CSS custom properties (`var(--color-accent)` etc.) that the browser can use. These are separate from Elementor's Global Color system. Elementor widgets reference Global Colors (stored in the kit's database settings) — not CSS custom properties directly. Both systems must be configured:
- Plugin: loads the CSS tokens for the browser (✅ already working)
- Elementor Kit: must be configured to register the same tokens as Global Colors so they appear in the Elementor widget color picker (❌ not yet done)

---

## 2. Missing Pieces

### 2.1 Critical — Blocks Sprint 1 Work

| # | Missing item | Impact |
|---|-------------|--------|
| 1 | **Elementor Global Colors** — zero tokens configured in Site Settings | No template work can use design system colors via token reference. All current colors are hardcoded. Phase A is blocked until this is done. |
| 2 | **Elementor Global Typography** — zero styles configured in Site Settings | No template work can use approved typefaces via token reference. Fonts are hardcoded in widget settings. Phase A is blocked. |
| 3 | **WordPress classic nav menu** — zero menus created | Header v3 nav widget has nothing to reference. Phase B and Phase C are blocked until a menu exists. |

### 2.2 Important — Blocks Sprint 2 Work

| # | Missing item | Impact |
|---|-------------|--------|
| 4 | **ACF Pro** (ACF Free 6.8.4 installed) | All 6 CPTs require Repeater and Flexible Content fields. Sprint 2 is fully blocked without ACF Pro. Must be acquired before the Sprint 1 Gate review. |
| 5 | **Custom Post Types** (none registered) | Expected — Sprint 2 task. Not a Sprint 1 blocker. |
| 6 | **ACF Field Groups** (none) | Depends on CPTs and ACF Pro. Sprint 2. |

### 2.3 Expected Absences — Not Blockers

| # | Missing item | Notes |
|---|-------------|-------|
| 7 | Site pages (Acasă, Afecțiuni, etc.) | Should be created as stubs during or after Phase B, before the Sprint 1 Gate review |
| 8 | 404 custom template | Phase G — Sprint 1 Gate task |
| 9 | Child theme | Not required for current scope |
| 10 | Testimonials, SN Articles, Condition entries | Content sprint work (Sprints 6–7) |
| 11 | Make.com automation | Sprint 7 |
| 12 | Social media links (Q18) | Conditional on Q18 answer |

---

## 3. Immediate Blockers

Listed in dependency order. Each item blocks the one below it.

### Blocker 1 — Elementor Global Colors not configured (Phase A)

**Blocks:** Every subsequent template task (Phase C Header, Phase D Footer).

**Required action:** In Elementor → Site Settings → Global Colors, add the following 9 tokens exactly:

| Token name | Hex |
|-----------|-----|
| color-ink | #231E1A |
| color-surface | #FDFBF7 |
| color-surface-warm | #F4EFE6 |
| color-surface-muted | #EDE8DF |
| color-accent | #4D7A70 |
| color-accent-hover | #3A5F57 |
| color-accent-subtle | #E4EDEB |
| color-border | #D6CFC4 |
| color-ink-secondary | #5A4E47 |

(9th token `color-ink-secondary` is required for logo subtitle and footer secondary text — not in the original 8 but needed before template work begins. See `SPRINT_1_HEADER_V3_PLAN.md` §2.)

### Blocker 2 — Elementor Global Typography not configured (Phase A)

**Blocks:** Every subsequent template task.

**Required action:** In Elementor → Site Settings → Global Typography, add the following 5 styles:

| Style name | Font | Weight | Size (desktop) |
|-----------|------|--------|----------------|
| type-h1 | Lora | 700 | 52px |
| type-h2 | Lora | 700 | 38px |
| type-body | Inter | 400 | 17px |
| type-body-lg | Inter | 400 | 19px |
| type-quote | Lora | 400 italic | 24px |

(type-nav and type-cta are applied via local widget overrides in the header — not required as Global Typography styles.)

### Blocker 3 — No WordPress nav menu (Phase B)

**Blocks:** Header v3 template (Phase C). The nav widget inside the header requires a classic WordPress menu to be assigned.

**Required action:** In WordPress Admin → Appearance → Menus:
1. Create a new menu named "Navigare principală"
2. Add 5 custom link items in this exact order:

| Label | URL |
|-------|-----|
| Acasă | / |
| Afecțiuni | /afectiuni/ |
| Sfatul Neurochirurgului | /sfatul-neurochirurgului/ |
| Recomandări | /recomandari/ |
| Despre | /despre/ |

3. Assign to the primary menu location (or leave unassigned — Elementor nav widget will reference by menu name, not by location slot)

**Note:** The destination pages don't exist yet. The menu items will be broken links locally until stub pages are created. This is acceptable — the nav structure is what matters for the header template build.

### Blocker 4 — ACF Pro not installed (Sprint 2 prerequisite)

**Blocks:** Sprint 2 (all CPT and field group work).

**Required action before Sprint 1 Gate:** Source the ACF Pro license. No immediate action needed for Sprint 1 template work, but it must be confirmed and ready before the Sprint 1 Gate review concludes.

---

## 4. Recommended Next Implementation Order

### Phase A — Elementor Global Tokens (do first, unblocks everything)

1. Open Elementor → Site Settings (hamburger menu → Site Settings)
2. Navigate to "Global Colors" — add all 9 tokens from Blocker 1 above
3. Navigate to "Global Typography" — add all 5 styles from Blocker 2 above
4. Save and verify each token appears in widget dropdowns (open any widget, click a color field, confirm tokens appear in the "Global" section)
5. Verify GU Design System CSS is loading: browser DevTools → Elements → `<head>` should show `gu-google-fonts` and `gu-design-system` stylesheet tags

**Acceptance check for Phase A:** Open Elementor editor, add a Heading widget, click color — the 9 tokens appear in the Global Colors section. Click typography — the 5 styles appear in the Global Typography section.

---

### Phase B — WordPress Navigation Menu (do second, unblocks header build)

6. Create the "Navigare principală" menu with 5 items per the table in Blocker 3
7. Confirm menu saves without error
8. (Optional but recommended) Create stub WordPress pages for the 5 destinations so that nav links aren't broken during testing

**Acceptance check for Phase B:** In Elementor editor, click the Nav Menu widget → menu selector → "Navigare principală" appears as a selectable menu.

---

### Phase C — Header v3 Build (do third, depends on A and B)

Per `docs/implementation/SPRINT_1_HEADER_V3_PLAN.md`:

9. Open `organism-site-header` in Elementor Theme Builder
10. Replace all hardcoded hex color values with the corresponding Global Color tokens (Blocker 1 must be done first)
11. Assign "Navigare principală" menu to the nav widget
12. Correct CTA label to "Programează o consultație →"
13. Correct CTA destination to `/programari/`
14. Change CTA visibility on mobile from hidden to **visible** (this is the most critical behavioral change — v2 hides the CTA on mobile, v3 must show it)
15. Verify ARIA attributes on nav container: `aria-label="Navigare principală"`
16. Verify hamburger button ARIA: `aria-expanded`, `aria-controls`, `aria-label="Deschide meniul"`
17. Test at 1280px, 768px, and 375px

---

### Phase D — Footer v3 Build (can run in parallel with Phase C after Phase A)

Per `docs/implementation/SPRINT_1_FOOTER_V3_PLAN.md`:

18. Open `organism-site-footer` in Elementor Theme Builder
19. Change Row 1 background to `color-ink` Global Color token (most critical change — cascades to all text)
20. Replace all hardcoded hex values with Global Color tokens
21. Rebuild Column 2: delete "PAGINI" nav content; change container to `<nav>`; add `aria-label`; add overline + "Toate afecțiunile →" link
22. Rebuild Column 3: delete "CONDIȚII TRATATE" content; change container to `<nav>`; add `aria-label`; add overline + brand descriptor placeholder + "Toate articolele →" link
23. Restructure Column 4: add primary CTA button ("Programează o consultație" → /programari/); add phone and email placeholders; update overline to "PROGRAMĂRI"
24. Set mobile column order: Column 4 first, then 1, 2, 3
25. Correct Column 2 HTML tag → `<nav>`; Column 3 HTML tag → `<nav>`; confirm Column 4 is `<div>`
26. Update legal strip: adjust to `color-ink` background with 1px `color-border` top separator
27. Test at 1280px, 768px, and 375px

---

### Phase G — 404 Page (do last, unblocks Sprint 1 Gate)

28. In Elementor Theme Builder, create a new template of type "Single" or "404 Page"
29. Minimal Sprint 1 content: header (inherits), message "Pagina nu a fost găsită", link back to homepage, footer (inherits)
30. Set display condition: 404 page

---

### Sprint 1 Gate Checklist (before declaring Sprint 1 complete)

- [ ] All 9 Global Color tokens confirmed in Elementor Site Settings with correct hex values
- [ ] All 5 Global Typography styles confirmed in Elementor Site Settings
- [ ] "Navigare principală" menu exists with correct labels and order
- [ ] Header v3: nav shows correct labels; CTA shows on mobile; no hardcoded hex values
- [ ] Footer v3: dark background (`color-ink`); Column 4 has CTA button; no hardcoded hex values
- [ ] 404 template exists and displays on non-existent URLs
- [ ] Q15 (phone) resolved — placeholder replaced in Footer Column 4
- [ ] Q16 (email) resolved — placeholder replaced in Footer Column 4
- [ ] Q20 (medical disclaimer) resolved — placeholder replaced in Footer legal strip
- [ ] ACF Pro license confirmed and ready to install

---

## 5. Environment vs. Prior Staging Report

`SPRINT_1_STATUS.md` (v1.2) was based on staging environment facts provided by the user. This audit is based on the actual LocalWP database and file system. Comparing:

| Item | SPRINT_1_STATUS.md claim | Local audit finding |
|------|--------------------------|---------------------|
| Elementor Pro active | ✅ | ✅ Confirmed (4.1.2) |
| Custom fonts configured | ✅ | ⚠️ Partially — GU plugin enqueues fonts correctly, but Elementor Global Typography is empty |
| Global Colors configured | ❓ (unconfirmed) | ❌ Confirmed: zero tokens |
| Global Typography configured | ❓ (unconfirmed) | ❌ Confirmed: zero styles |
| ACF Pro | ❓ (unconfirmed) | ❌ ACF Free 6.8.4 installed |
| Header v2 imported | ✅ | ✅ Confirmed (ID 9, active, entire site) |
| Footer v2 imported | ✅ | ✅ Confirmed (ID 12, active, entire site) |
| Nav menus | Not mentioned | ❌ Zero menus exist |
| Site pages | Not mentioned | ❌ Zero site pages — only defaults |

The most significant new finding is that Global Colors, Global Typography, and navigation menus are all completely absent — these were flagged as ❓ in the staging report but are now confirmed ❌.

---

*LOCAL_ENVIRONMENT_AUDIT.md — version 1.0 — 2026-06-28*
*Audit method: LocalWP filesystem inspection + direct MySQL query via LocalWP bundled MySQL binary*
*No WordPress files were modified. No database writes were performed.*
