# Sprint 1 — Implementation Status Report

**Date:** 2026-06-28
**Sprint goal:** Foundation and Global Systems
**Governing documents:** `docs/tasks/11_IMPLEMENTATION_MASTER_PLAN.md`, `docs/tasks/03_HEADER_AND_NAVIGATION.md`, `docs/tasks/04_DESIGN_SYSTEM_TOKENS.md`
**Status at inspection:** Environment operational — staging active, Elementor Pro active, v2 templates imported, GU Design System plugin available for activation
**Last updated:** 2026-06-28 (v1.2 — foundation completion audit after SPRINT 1.2)

---

## 1. What Already Exists

### 1.1 CSS / Design Token System — READY

| Asset | Path | Status |
|-------|------|--------|
| Full CSS token file | `elementor/custom.css` | ✅ Complete and correct |
| Plugin CSS (adapted version) | `wp-plugin/gu-design-system/assets/css/gu-design-system.css` | ✅ Complete and correct |
| WordPress plugin (PHP) | `wp-plugin/gu-design-system/gu-design-system.php` | ✅ Ready to install |
| Plugin ZIP | `wp-plugin/gu-design-system.zip` | ✅ Ready to upload |

All color tokens in `custom.css` and `gu-design-system.css` match Task 04 exactly:

| Token | CSS variable | Hex | Task 04 match |
|-------|-------------|-----|--------------|
| color-ink | `--color-ink` | `#231E1A` | ✅ |
| color-surface | `--color-surface` | `#FDFBF7` | ✅ |
| color-surface-warm | `--color-surface-warm` | `#F4EFE6` | ✅ |
| color-surface-muted | `--color-surface-muted` | `#EDE8DF` | ✅ |
| color-accent | `--color-accent` | `#4D7A70` | ✅ |
| color-accent-hover | `--color-accent-hover` | `#3A5F57` | ✅ |
| color-accent-subtle | `--color-accent-subtle` | `#E4EDEB` | ✅ |
| color-border | `--color-border` | `#D6CFC4` | ✅ |

Typography tokens, spacing tokens, layout tokens, and motion tokens are all present and correct in the CSS.

**The plugin is the recommended delivery method.** It uses `wp_enqueue_style` with a proper dependency chain (Google Fonts loads before the design system CSS), adds `<link rel="preconnect">` hints for Google Fonts origins, and fires a one-time admin activation notice pointing to the next configuration step. This is superior to pasting CSS into Elementor's Custom CSS field because it loads in the correct order, is version-stamped, and can be activated/deactivated cleanly.

---

### 1.2 Elementor Template JSON Files — EXIST WITH DISCREPANCIES

| Asset | Path | Status |
|-------|------|--------|
| Header template v1 | `elementor/templates/header-georgeungureanu.json` | ⚠️ Exists — navigation wrong |
| Header template v2 | `elementor/templates/header-georgeungureanu-v2.json` | ⚠️ Exists — navigation wrong |
| Footer template v1 | `elementor/templates/footer-georgeungureanu.json` | ⚠️ Exists — background wrong + navigation wrong |
| Footer template v2 | `elementor/templates/footer-georgeungureanu-v2.json` | ⚠️ Exists — background wrong + navigation wrong |
| Header import instructions | `elementor/templates/README-header-import.md` | ⚠️ References v1; navigation spec is pre-planning-suite |
| Footer import instructions | `elementor/templates/README-footer-import.md` | ⚠️ References v1; background and navigation are pre-planning-suite |

The JSON templates have structural value — container hierarchy, flex properties, widget configuration, sticky behaviour, ARIA attribute placement — but contain content decisions that conflict with the frozen planning suite. See Section 2 for the full discrepancy list.

**Which version to use:** The v2 files (created later; footer v2 is 44KB vs v1's 42KB, suggesting additions) are more likely to address earlier issues. However, the README files reference only v1. Use v2 as the starting point when importing.

---

### 1.3 Implementation Reference Documents — SUPERSEDED BY PLANNING SUITE

| Asset | Path | Status |
|-------|------|--------|
| Design system setup | `docs/implementation/01_DESIGN_SYSTEM_SETUP.md` | ⚠️ Superseded by Task 04 |
| Homepage template guide | `docs/implementation/02_HOMEPAGE_TEMPLATE.md` | ⚠️ Superseded by Task 05 |
| Elementor QA rules | `docs/implementation/03_ELEMENTOR_QA_RULES.md` | ⚠️ Partially superseded by Task 11 |
| Theme Builder globals | `docs/implementation/04_THEME_BUILDER_GLOBALS.md` | ⚠️ Partially current — see note below |
| /programari page guide | `docs/implementation/05_PROGRAMARI_PAGE.md` | ⚠️ Superseded by Task 06 |

**Important note on `04_THEME_BUILDER_GLOBALS.md`:** This document was partially updated to reflect planning-suite decisions. Section §1.1 correctly specifies "6 items" in the nav and the CTA text "Programează o consultație" — which matches the Task 03 freeze. However, it does not specify the exact navigation labels and slugs that Task 03 locks. Use Task 03 as the governing source for the nav, not this document.

**For all implementation decisions:** The `docs/tasks/` suite (Tasks 00–11) is the sole governing source. The `docs/implementation/` documents describe an earlier planning pass and are kept as reference only. When the two conflict, Task documents win.

---

### 1.4 Planning Suite Documents — COMPLETE

All 12 task documents (00–11) exist in `docs/tasks/` and are the source of truth for all Sprint 1 decisions.

| Task | Governs |
|------|---------|
| `03_HEADER_AND_NAVIGATION.md` | Navigation labels, slugs, CTA text, mobile behaviour |
| `04_DESIGN_SYSTEM_TOKENS.md` | All token values, typography scale, spacing, Elementor Global Colors and Global Typography |
| `11_IMPLEMENTATION_MASTER_PLAN.md` | Sprint 1 deliverables, DoD, acceptance gate |

---

## 2. What Is Missing

### 2.1 WordPress Environment — OPERATIONAL (STAGING)

The staging environment is live and the core stack is active.

| Requirement | Status |
|-------------|--------|
| WordPress installed (staging) | ✅ Confirmed operational |
| WordPress installed (production) | ❓ Not confirmed |
| Hello Elementor theme active | ❓ Not confirmed — assumed active (Elementor Pro dependency) |
| Child theme created and active | ❓ Not confirmed |
| Elementor Pro installed and licensed | ✅ Confirmed active |
| ACF Pro installed and licensed | ❓ Not confirmed |
| Staging URL confirmed and password-protected | ✅ Staging accessible |

---

### 2.2 Elementor Global Configuration — PARTIALLY COMPLETE, AUDIT REQUIRED

The GU Design System plugin is active (CSS custom properties are loading). Custom fonts are configured. Initial manual Elementor adjustments have been made. The Global Colors and Global Typography configurations require a spec audit against Task 04 before template correction work can proceed.

| Configuration | Status | Governing source |
|---------------|--------|-----------------|
| GU Design System plugin active | ✅ Confirmed installed and activated | `wp-plugin/gu-design-system.zip` |
| Custom fonts uploaded and configured | ✅ Confirmed | — |
| Initial manual Elementor adjustments | ✅ Made | — |
| 8 Global Colors in Elementor (per spec) | ❓ Must audit against Task 04 §2 token table | Task 04 §2 |
| 5 Global Typography styles in Elementor (per spec) | ❓ Must audit against Task 04 §3 — fonts loaded ≠ styles configured per spec | Task 04 §3 |
| Elementor Flexbox Containers experiment enabled | ❓ Not confirmed | Task 04 §1, Task 11 §2.2 |

---

### 2.3 Header and Footer — V2 TEMPLATES IMPORTED, DISCREPANCIES REMAIN

Header v2 and Footer v2 JSON templates have been imported into the staging WordPress environment. Some manual adjustments have already been made in Elementor. The structural foundation is in place.

However, the discrepancies documented in Section 3 have not been confirmed as resolved. The imported v2 templates were built before the planning suite was frozen, so the navigation labels, slugs, CTA text, footer background colour, and hardcoded hex values must be audited and corrected in Elementor against the Task 03 and Task 04 frozen specs.

---

### 2.4 Custom Post Types — NOT REGISTERED

None of the 6 CPTs exist in any WordPress environment.

| CPT | REST API required | Status |
|-----|------------------|--------|
| Condition | No (Phase 1) | ❌ Not registered |
| SN Article | No (Phase 1) | ❌ Not registered |
| Colleague Recommendation | No | ❌ Not registered |
| Patient Testimonial (Testimoniale) | No | ❌ Not registered |
| Timeline Event | No | ❌ Not registered |
| Media Item | Yes (`show_in_rest: true` — needed for Make.com Phase 2) | ❌ Not registered |

---

### 2.5 ACF Field Groups — NOT CONFIGURED

No ACF field groups exist. The content model definitions in Task 02 define all fields. ACF configuration happens in WordPress admin after ACF Pro is installed.

---

### 2.6 Accessibility Baseline — PARTIALLY IN PLACE

| Requirement | Status |
|-------------|--------|
| Focus rings active | ✅ `gu-design-system.css` is active — focus ring styles are loading |
| Reduced motion respected | ✅ `gu-design-system.css` includes `@media (prefers-reduced-motion)` |
| `<html lang="ro">` on all pages | ❓ Depends on WordPress / Hello Elementor theme settings — must verify |
| Skip-to-content link in every template | ❓ Present in imported header v2 — must verify it is the first DOM element and functional |
| `#main-content` anchor ID on all page templates | ❌ Requires page templates to be built |

---

### 2.7 404 Page — NOT BUILT

No 404 template exists. This is a Sprint 1 deliverable.

---

## 3. Discrepancies Between Existing Assets and Frozen Spec

These must be resolved before the header and footer can go live. They do not block installing the plugin or configuring Elementor global settings — those steps can proceed immediately.

### 3.1 Header Navigation — WRONG LABELS AND SLUGS

| Position | In existing JSON / README | Frozen in Task 03 |
|----------|--------------------------|------------------|
| Item 1 | Acasă → / | Acasă → / ✅ |
| Item 2 | Afecțiuni → /conditii | Afecțiuni → /afectiuni ⚠️ slug differs |
| Item 3 | Despre Dr. Ungureanu → /despre | Sfatul Neurochirurgului → /sfatul-neurochirurgului ❌ wrong item |
| Item 4 | Articole → /resurse | Recomandări → /recomandari ❌ wrong item |
| Item 5 | Contact → /contact | Despre → /despre/ ⚠️ label differs |
| CTA button | "Programări" → /programari | "Programează o consultație" → /programari ⚠️ label differs |
| Total items | 5 nav items | 5 nav items + CTA button ✅ count matches if CTA is counted |

**Impact:** The WordPress navigation menu must be created with the correct 5 labels and slugs from Task 03 before the header template is useful. The nav-menu widget in the imported template will display whatever WordPress menu is assigned to it — the JSON structure is usable, but the menu it references must be rebuilt.

**Slug decision needed:** Task 01 IA uses `/afectiuni/` (without diacritics). The old implementation used `/conditii/`. The Task 03 freeze confirms `/afectiuni/`. This is the correct slug. The footer (and any internal links) must use `/afectiuni/`.

### 3.2 Footer Navigation — WRONG SLUGS AND WRONG STRUCTURE

| Footer Column 2 link | In existing JSON | Frozen Task 03 slug |
|---------------------|-----------------|---------------------|
| Conditions section | /conditii/ | /afectiuni/ ⚠️ |
| Resources/SN | /resurse/ | /sfatul-neurochirurgului/ ❌ |
| About page | /despre/ | /despre/ ✅ |
| Contact | /contact/ | Not in main nav — footer-only link, acceptable |
| Recommendations | Not present | /recomandari/ — should be in footer nav |

**Resolution:** Footer Column 2 links must be updated to use the frozen slugs from Task 03. The footer may include /contact/ as a footer-only link (this is a reasonable navigation convention), but the main nav items must use the correct slugs.

### 3.3 Footer Background Colour — WRONG

| Element | In existing JSON | Frozen in Task 01 IA |
|---------|-----------------|---------------------|
| Footer body (Row 1) | `#EDE8DF` (Surface Muted) | `color-ink` (#231E1A) |
| Footer legal strip (Row 2) | `#F4EFE6` (Surface Warm) | Part of footer — should also be ink-family |

**Impact:** The footer visual treatment is fundamentally wrong. The existing footer presents as a light-coloured information panel. The frozen IA specifies `color-ink` — a dark, warm-near-black background. All text colours, link colours, and border colours within the footer must be adapted for dark-background display (Surface text on Ink background).

**This is not a minor correction.** The footer must be rebuilt for the correct background — the JSON is not a reliable starting point for the visual treatment, only for the structural skeleton (container hierarchy, column count, widget types).

### 3.4 Header and Footer JSON Colors Are Hardcoded — NOT USING GLOBAL TOKENS

All color values in the JSON templates are hardcoded hex strings (e.g., `"color": "#4D7A70"`). The README import guides acknowledge this and provide instructions for replacing each with its Elementor Global Color token after import.

**Sprint 1 requirement:** After importing and correcting the templates in Elementor, all hardcoded hex values must be replaced with their corresponding Global Color token references. This is a Sprint 1 Gate requirement.

---

## 4. Recommended Sprint 1 Implementation Order

Steps marked ✅ are confirmed complete. Steps marked ⚠️ are partially done and require audit or correction before proceeding. Remaining steps are sequential.

```
Step 1 — Set up WordPress environments (production + staging)
         ✅ DONE — Staging operational, Elementor Pro active

Step 2 — Install GU Design System plugin
         ✅ DONE — Plugin installed and activated; gu-design-system.css loading

Step 3 — Configure Elementor Pro experiments
         ⚠️ AUDIT REQUIRED
         Elementor → Settings → Experiments → Flexbox Container → confirm Active
         Confirm no legacy Sections/Columns experiment is active
         (If templates were imported and are rendering correctly, this is likely already set.)

Step 4 — Audit and complete Elementor Global Colors
         ⚠️ AUDIT REQUIRED — some manual adjustments may have been made
         Elementor → Site Settings → Global Colors
         Compare every entry against Task 04 §2 token table — exact hex values, exact label names
         Required tokens (must all exist, no extras):
           Ink (#231E1A), Surface (#FDFBF7), Surface Warm (#F4EFE6),
           Surface Muted (#EDE8DF), Accent (#4D7A70), Accent Hover (#3A5F57),
           Accent Subtle (#E4EDEB), Border (#D6CFC4)
         Remove any color not in this list. Add any that are missing.
         Verify: each token is labelled correctly and returns the correct hex on hover.

Step 5 — Audit and complete Elementor Global Typography
         ⚠️ AUDIT REQUIRED — fonts configured, but style specs may differ from Task 04
         Elementor → Site Settings → Global Typography
         Compare every entry against Task 04 §3:
           type-h1: Lora 700, 52px desktop / 36px mobile, LH 1.15
           type-h2: Lora 700, 38px desktop / 28px mobile, LH 1.20
           type-body: Inter 400, 17px desktop / 16px mobile, LH 1.70
           type-body-lg: Inter 400, 19px desktop / 17px mobile, LH 1.75
           type-quote: Lora 400 italic, 24px, (testimonials only)
         Correct any value that differs. Do not add styles not in this list.

Step 6 — Create (or recreate) WordPress navigation menu
         Appearance → Menus → Create New Menu
         Name: "Navigare principală"
         Items, exact labels, exact slugs — from Task 03:
           Acasă → /
           Afecțiuni → /afectiuni/
           Sfatul Neurochirurgului → /sfatul-neurochirurgului/
           Recomandări → /recomandari/
           Despre → /despre/
         Assign to Primary Navigation location
         Note: CTA button ("Programează o consultație" → /programari) is a separate
         Elementor Button widget — it is NOT a menu item.

Step 7 — Audit and correct the imported header template
         ⚠️ IN PROGRESS — v2 template imported, manual adjustments made
         Open organism-site-header in Elementor Theme Builder
         Verify and correct all items from Section 3.1 and 3.4:
           — Nav menu widget: assign "Navigare principală" (Step 6 menu)
           — CTA button label: must read "Programează o consultație" (not "Programări")
           — CTA button target: /programari ✓
           — All hardcoded hex values → replace with Elementor Global Color tokens
           — Verify: header HTML tag is <header>, role="banner" attribute is set
           — Verify: sticky behaviour is active (Advanced → Motion Effects → Sticky: Top)
           — Verify: skip-to-content link is first DOM element in the header
         Re-publish with display condition: Include → Entire Site

Step 8 — Audit and correct the imported footer template
         ⚠️ IN PROGRESS — v2 template imported, manual adjustments made
         CRITICAL: Footer background must be color-ink (#231E1A), not Surface Muted.
         Open organism-site-footer in Elementor Theme Builder
         Verify and correct all items from Section 3.2, 3.3, and 3.4:
           — Footer body (Row 1) background → color-ink Global Color token (#231E1A)
           — All text and links inside footer → adapt for dark background
             (text: color-surface; links: color-accent or color-surface)
           — Footer legal strip (Row 2) background → consistent with ink-family treatment
           — Footer Column 2 nav slugs:
               /conditii/ → /afectiuni/
               /resurse/ → /sfatul-neurochirurgului/
               Add: /recomandari/
           — All hardcoded hex values → replace with Elementor Global Color tokens
           — Verify: footer HTML tag is <footer>, role="contentinfo" attribute is set
         NOTE: If the background correction requires rebuilding the footer's
         colour treatment substantially, this is expected — the JSON was built
         before the IA specified color-ink for the footer.
         Re-publish with display condition: Include → Entire Site

Step 9 — Register all 6 Custom Post Types
         Method: child theme functions.php or a minimal dedicated plugin
         Do NOT use CPT UI or similar GUI plugins (dependency without benefit)
         CPTs: condition, sn-article, colleague-recommendation,
               testimonial, timeline-event, media-item
         media-item CPT must include: show_in_rest => true
         Verify: all 6 appear in WordPress admin sidebar

Step 10 — Configure ACF Pro field groups
          ACF Pro installed and licensed (confirm first)
          Field groups created per Task 02 content model definitions
          Each group assigned to its corresponding CPT
          Verify: create a test entry in each CPT → all fields render in the edit screen

Step 11 — Create 404 page
          Page with header and footer templates applied
          Content: "Pagina nu a fost găsită" + brief explanation + link to /
          Set as 404 in WordPress → Settings → Reading (or via Elementor Theme Builder → 404)

Step 12 — Sprint 1 Gate review
          Send staging URL and Sprint 1 DoD checklist to Dr. Ungureanu
          No Sprint 2 work begins before written confirmation
```

---

## 5. Sprint 1 Definition of Done — Verification Checklist

Use this checklist at Step 12 (Gate review). Items marked with [TECH] are verified by the implementation team; items marked with [DR] require Dr. Ungureanu's review.

### Design Tokens
- [ ] [TECH] GU Design System plugin is active — confirmed via Plugins page and page source inspection
- [ ] [TECH] All 8 Global Colors in Elementor match Task 04 token table hex values exactly
- [ ] [TECH] All 5 Global Typography styles in Elementor match Task 04 specifications (font, size, weight, line-height)
- [ ] [TECH] No Elementor "Default" color or "Default" typography remains in any global setting
- [ ] [TECH] Elementor Flexbox Containers experiment is Active; legacy Sections/Columns experiment is off

### Header
- [ ] [DR] Header is approved at 1280px, 768px, and 375px viewport widths
- [ ] [TECH] Navigation contains exactly 5 labels in the correct order from Task 03
- [ ] [TECH] Navigation slugs: /afectiuni/, /sfatul-neurochirurgului/, /recomandari/, /despre/ — confirmed correct
- [ ] [DR] CTA button label is "Programează o consultație" — confirmed
- [ ] [TECH] CTA button routes to /programari
- [ ] [TECH] Header background is color-surface (#FDFBF7) at all scroll positions — no transparency
- [ ] [TECH] Header is sticky (sticks to top on scroll)
- [ ] [TECH] Mobile: hamburger visible, logo visible, CTA button hidden on mobile
- [ ] [TECH] Mobile: hamburger opens drawer with all 5 nav items; drawer closes on ×, backdrop tap, and Escape
- [ ] [TECH] No hardcoded hex values remain — all colors are Elementor Global Color tokens
- [ ] [TECH] Skip-to-content link is the first DOM element inside the header; appears on Tab press; moves focus to #main-content on Enter
- [ ] [TECH] header HTML tag: `<header>`; `role="banner"` attribute set
- [ ] [TECH] Display condition: Include → Entire Site — header appears on every page

### Footer
- [ ] [DR] Footer is approved at 1280px, 768px, and 375px viewport widths
- [ ] [TECH] Footer body background is color-ink (#231E1A) — Global Color token, not hardcoded hex
- [ ] [TECH] All footer text, links, and borders use appropriate dark-background colours (Surface on Ink)
- [ ] [TECH] Footer navigation slugs match the frozen spec (/afectiuni/, /sfatul-neurochirurgului/, /recomandari/, /despre/)
- [ ] [TECH] No hardcoded hex values remain — all colors are Elementor Global Color tokens
- [ ] [TECH] footer HTML tag: `<footer>`; `role="contentinfo"` attribute set
- [ ] [TECH] Display condition: Include → Entire Site

### Custom Post Types
- [ ] [TECH] All 6 CPTs appear in WordPress admin sidebar: Condition, SN Article, Colleague Recommendation, Testimonial, Timeline Event, Media Item
- [ ] [TECH] Media Item CPT has `show_in_rest: true` — confirmed via /wp-json/wp/v2/ endpoint
- [ ] [TECH] ACF field groups are attached to each CPT — confirmed by creating a test entry in each CPT and verifying all fields render

### Accessibility Baseline
- [ ] [TECH] `<html lang="ro">` is set on all pages
- [ ] [TECH] Focus rings are visible on all interactive elements in header and footer (Tab through the page and confirm)
- [ ] [TECH] Skip-to-content link confirmed functional on homepage (Tab → Enter → focus moves past header)
- [ ] [TECH] `#main-content` CSS ID is set on the first content section of every built page template

### 404 Page
- [ ] [TECH] 404 page renders with header and footer
- [ ] [TECH] 404 page contains a link back to /

---

## 6. Immediate Next Action

**The environment is operational. The next action is the design token foundation.**

**→ Activate `wp-plugin/gu-design-system.zip` via WordPress admin → Plugins → Add New → Upload Plugin (Step 2)**

This loads the CSS custom properties (`:root` block with all 8 `--color-*` tokens, spacing tokens, typography tokens) onto the frontend via `wp_enqueue_style`. Without this, any Elementor Global Color tokens configured in Site Settings cannot be referenced by CSS variables in widget styles.

Once the plugin is active and verified (check page source for `gu-design-system.css`), proceed immediately to:

**→ Audit Elementor Global Colors against the Task 04 token table (Step 4)**

Open Elementor → Site Settings → Global Colors and compare every entry against the 8-token table in Section 4 Step 4. This audit will reveal what "manual adjustments" have already been made and whether the global colour system is complete, partial, or needs correction. All subsequent template work depends on this being correct — hardcoded hex values in the imported templates can only be properly replaced after the Global Color tokens are confirmed.

---

## 7. Open Questions Blocking Sprint 1

Environmental questions have been resolved. Remaining blockers are content questions that prevent the Sprint 1 Gate from being passed. They do not block Steps 2–6 (plugin, Elementor configuration, navigation menu creation), but they block the footer from going live and the Gate from being passed.

| Question | Blocks | Status |
|----------|--------|--------|
| Confirm child theme is active (functions.php available for CPT registration) | Step 9 | ❓ Not confirmed |
| Confirm ACF Pro license available and installed | Step 10 | ❓ Not confirmed |
| Q15 — Phone number (required for footer Column 1) | Step 8 / Gate | ❓ Not yet resolved |
| Q16 — Admin email (required for footer Column 1 + form notification workflows) | Step 8 / Gate | ❓ Not yet resolved |
| Q20 — Medical disclaimer wording for footer legal strip | Step 8 / Gate | ❓ Not yet resolved |
| Confirm footer schedule content: Option A (fixed hours) or Option B (variable by location) | Step 8 | ❓ Not yet resolved — Option B is the staging default |

Footer content fields (Q15, Q16, Q20) can contain placeholder text in staging during development. They must be resolved and replaced before the Sprint 1 Gate review with Dr. Ungureanu.

---

*Sprint 1 Status version: 1.2 — 2026-06-28 (SPRINT 1.2 foundation completion audit)*
*See `docs/implementation/SPRINT_1_FOUNDATION_CHECKLIST.md` for full remaining task sequence.*
*Next document: docs/implementation/SPRINT_1_HEADER.md (after Gate 1 approval)*
