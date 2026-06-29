# Sprint 1 — Foundation Checklist

**Date:** 2026-06-28
**Sprint goal:** Foundation and Global Systems fully operational
**Governing documents:** `docs/tasks/03_HEADER_AND_NAVIGATION.md`, `docs/tasks/04_DESIGN_SYSTEM_TOKENS.md`, `docs/tasks/11_IMPLEMENTATION_MASTER_PLAN.md`
**Status:** Foundation partially complete — audit and corrections required before Sprint 2 can begin

---

## Section 1 — Completed Foundation Work

The following have been confirmed complete on the staging environment.

| # | Task | Verified by |
|---|------|------------|
| F1 | WordPress staging site operational | SPRINT 1.2 context |
| F2 | Elementor Pro installed and active | SPRINT 1.2 context |
| F3 | Custom fonts uploaded and configured | SPRINT 1.2 context |
| F4 | GU Design System plugin installed and activated | SPRINT 1.2 context |
| F5 | Header v2 JSON template imported into Theme Builder | SPRINT 1.2 context |
| F6 | Footer v2 JSON template imported into Theme Builder | SPRINT 1.2 context |
| F7 | Initial manual Elementor adjustments performed | SPRINT 1.2 context |

**What F4 delivers:** All CSS custom properties (`--color-ink`, `--color-surface`, etc.) are loading on the frontend via `gu-design-system.css`. Focus rings and reduced-motion handling are active. Google Fonts dependency is managed by the plugin.

---

## Section 2 — Remaining Sprint 1 Tasks

### 2.1 Overview

Seven task groups remain before Sprint 1 Gate can be passed. They are listed in dependency order — each group must be complete before the next begins, except where marked as independent.

| Group | Task | Depends on | Gate-blocking | Estimated scope |
|-------|------|------------|--------------|-----------------|
| A | Elementor Global token audit | F4 (done) | Yes | Config audit — 1 session |
| B | WordPress navigation menu | A (Global Colors confirmed) | Yes | Menu creation — 30 min |
| C | Header correction in Elementor | A + B | Yes | Template editing — 1–2 hours |
| D | Footer reconstruction in Elementor | A | Yes | Template editing — 2–3 hours |
| E | Custom Post Types registration | F1 (done), child theme | **No — Sprint 2 prerequisite** | Code registration — 1 session |
| F | ACF Pro field groups | E (CPTs exist) | **No — Sprint 2 prerequisite** | Config — 1 session per CPT |
| G | 404 page | C + D (header/footer correct) | Yes | Page build — 30 min |

Sprint 1 Gate review requires Groups A, B, C, D, and G to be complete, and Q15, Q16, Q20 to be resolved. Groups E (CPTs) and F (ACF) are Sprint 2 prerequisites — they do not block the Sprint 1 Gate and can be completed in parallel with A–G or deferred to the start of Sprint 2.

---

## Section 3 — Exact Implementation Order

### Phase A — Design Token Audit (IMMEDIATE NEXT)

**Purpose:** Confirm the Elementor Global Colors and Global Typography match the Task 04 frozen spec exactly. All subsequent template work depends on this being correct — hardcoded hex values in the imported templates will be replaced with these tokens.

**Does not depend on:** any other remaining task
**Blocks:** all template editing (Groups B, C, D)

#### A1 — Confirm Elementor Flexbox Containers experiment is active

```
Elementor → Settings → Experiments
→ Flexbox Container → Active
→ Confirm: no legacy Sections/Columns experiment is active
```

If Flexbox Containers is not active, none of the imported container-based templates will render correctly. Confirm this before touching any template.

#### A2 — Audit Elementor Global Colors

```
Elementor → Site Settings → Global Colors
```

Confirm that all approved global colors exist and all required tokens from Task 04 are present. Additional colors already configured in staging are permitted — the check is for presence and correctness, not exclusivity.

Required tokens — these must exist with the correct hex value:

| Required label | Required hex | CSS variable |
|---------------|-------------|-------------|
| Ink | `#231E1A` | `--color-ink` |
| Surface | `#FDFBF7` | `--color-surface` |
| Surface Warm | `#F4EFE6` | `--color-surface-warm` |
| Surface Muted | `#EDE8DF` | `--color-surface-muted` |
| Accent | `#4D7A70` | `--color-accent` |
| Accent Hover | `#3A5F57` | `--color-accent-hover` |
| Accent Subtle | `#E4EDEB` | `--color-accent-subtle` |
| Border | `#D6CFC4` | `--color-border` |

Actions:
- Add any token from the table above that is missing
- Correct any token whose hex value differs from the table
- Do not rename labels — other templates may reference them
- Additional approved global colors already in staging may remain

#### A3 — Audit Elementor Global Typography

```
Elementor → Site Settings → Global Typography
```

Compare every existing entry against this table.

| Required label | Font | Weight | Size (desktop) | Size (mobile) | Line height |
|---------------|------|--------|----------------|---------------|-------------|
| type-h1 | Lora | 700 | 52px | 36px | 1.15 |
| type-h2 | Lora | 700 | 38px | 28px | 1.20 |
| type-body | Inter | 400 | 17px | 16px | 1.70 |
| type-body-lg | Inter | 400 | 19px | 17px | 1.75 |
| type-quote | Lora | 400 italic | 24px | 24px | — |

Actions:
- Correct any value that differs from the table
- Add any style that is missing
- Remove any style not in this list
- Note: fonts being loaded (F3) does not confirm these style definitions exist

**A completes when:** all required Task 04 Global Color tokens exist with correct hex values, all 5 Global Typography styles match the table above, and Flexbox Containers experiment is active.

---

### Phase B — Navigation Menu

**Purpose:** Create the WordPress primary menu with the correct Task 03 labels and slugs. The header template's nav-menu widget will be assigned this menu.

**Depends on:** Phase A complete (so the menu is created with correct labels before the header is touched)
**Blocks:** Phase C (header correction)

```
WordPress admin → Appearance → Menus → Create New Menu
```

Menu name: `Navigare principală`

| Order | Label | URL slug |
|-------|-------|----------|
| 1 | Acasă | `/` |
| 2 | Afecțiuni | `/afectiuni/` |
| 3 | Sfatul Neurochirurgului | `/sfatul-neurochirurgului/` |
| 4 | Recomandări | `/recomandari/` |
| 5 | Despre | `/despre/` |

After saving: assign this menu to the **Primary Navigation** location.

**Important:** The CTA button ("Programează o consultație" → `/programari/`) is a separate Elementor Button widget inside the header template. It is not a menu item and must not be added here.

**B completes when:** "Navigare principală" menu exists with exactly 5 items in the correct order, assigned to Primary Navigation.

---

### Phase C — Header Correction

**Purpose:** Bring the imported header v2 template into compliance with the Task 03 frozen spec and Task 04 token requirements.

**Depends on:** Phase A (Global Colors must exist to replace hardcoded hex), Phase B (navigation menu must exist to assign)
**Blocks:** Phase G (404 page)

```
Elementor → Templates → Theme Builder → organism-site-header → Edit
```

#### C1 — Assign the navigation menu

- Click the Nav Menu widget
- Content tab → Menu → select "Navigare principală"
- Verify all 5 nav items appear in the canvas

#### C2 — Correct the CTA button

- Click the Button widget (rightmost element in the header inner container)
- Content tab → Text: change to `Programează o consultație`
- Content tab → Link: confirm `/programari/`
- Responsive tab → confirm button is hidden on mobile (Hide on: Mobile)

#### C3 — Replace all hardcoded hex values with Global Color tokens

For each widget in the header, open its style/color controls and switch from hex to the matching Global Color token. Priority order:

| Widget | Property | Hardcoded hex | Replace with token |
|--------|----------|--------------|-------------------|
| Outer container | Background | `#FDFBF7` | Surface |
| Outer container | Border-bottom color | `#D6CFC4` | Border |
| Logo "Dr. George Ungureanu" | Text color | `#231E1A` | Ink |
| Logo "Neurochirurg" | Text color | `#5A4E47` | Ink (nearest available) |
| Nav menu | Item color | `#231E1A` | Ink |
| Nav menu | Hover color | `#4D7A70` | Accent |
| CTA button | Background | `#4D7A70` | Accent |
| CTA button | Hover background | `#3A5F57` | Accent Hover |
| CTA button | Text color | `#FDFBF7` | Surface |

Note: `#5A4E47` (Ink Secondary) is not in the 8-token set. If this sub-label text has a local color set, either apply the Ink token (close enough) or leave as a local override and document it.

#### C4 — Verify structural and accessibility requirements

Run through these in the Elementor editor and the live staging preview:

```
[ ] Outer container CSS ID is: organism-site-header
[ ] Outer container HTML tag is: header (Advanced → HTML Tag)
[ ] Outer container has custom attribute: role / banner (Advanced → Custom Attributes)
[ ] Outer container position is: Sticky, Top, Z-index 100 (Advanced → Motion Effects)
[ ] Skip-to-content HTML widget is the first element inside the inner container
    (in DOM order — check with browser inspector if unsure)
[ ] Skip-to-content link href is: #main-content
[ ] Skip-to-content link class is: skip-to-content (styled by gu-design-system.css)
[ ] Logo "Dr. George Ungureanu" links to /
[ ] Logo "Neurochirurg" links to /
[ ] CTA button links to /programari/
[ ] CTA button is hidden on mobile
```

#### C5 — Add CSS for sticky shadow, logo, and active nav item

The following CSS was specified in `elementor/templates/README-header-import.md`. Add to **Elementor → Site Settings → Custom CSS** (not the plugin CSS — these are instance-level styles):

```
/* Sticky shadow */
#organism-site-header.elementor-sticky--active {
  box-shadow: 0 2px 12px rgba(35, 30, 26, 0.08);
}

/* Logo — no underline */
#molecule-logo a { text-decoration: none; }
#molecule-logo a:hover { text-decoration: none; opacity: 0.85; }

/* Active nav item */
#organism-site-header .current-menu-item > a,
#organism-site-header .current-page-ancestor > a {
  color: #4d7a70 !important;
  border-bottom: 2px solid #4d7a70;
  padding-bottom: 2px;
}
```

#### C6 — Publish with correct display condition

- Click Publish in the Theme Builder editor
- Display Conditions: Include → Entire Site
- Verify header appears on the WordPress homepage

**C completes when:** All C1–C6 checklist items pass, and the header renders correctly at 1280px, 768px, and 375px.

---

### Phase D — Footer Reconstruction

**Purpose:** Bring the imported footer v2 template into compliance with the Task 01 IA and Task 03 frozen spec. The background colour correction is the critical change and affects every widget inside the footer.

**Depends on:** Phase A (Global Colors must exist to replace hardcoded hex)
**Independent of:** Phase B and Phase C — can run in parallel with or after the header

```
Elementor → Templates → Theme Builder → organism-site-footer → Edit
```

#### D1 — Correct the footer body background (CRITICAL)

The imported footer uses `#EDE8DF` (Surface Muted) as the body background. The Task 01 IA specifies `color-ink` for the footer background.

- Click the outer footer container (Row 1 — organism-site-footer)
- Style tab → Background → switch from hex `#EDE8DF` to Global Color token: **Ink** (`#231E1A`)

This one change cascades: all text, links, borders, and dividers inside the footer now need dark-background treatment. Work through D2 immediately after.

#### D2 — Adapt all footer content for dark background

After the background changes to Ink (#231E1A), all child widgets need their text and link colours updated:

| Element | Property | Replace with |
|---------|----------|-------------|
| All body text (logo, nav labels, descriptions) | Text color | Surface token (#FDFBF7) |
| All navigation links | Text color | Surface token (default) |
| All navigation links | Hover color | Accent token (#4D7A70) |
| All overline headings ("PAGINI", "CONDIȚII TRATATE", etc.) | Text color | Surface or Border token — your choice, must be readable on Ink |
| All borders and dividers | Border color | Border token (#D6CFC4) at reduced opacity, or Surface Muted |
| "Clinici și locații →" and ghost buttons | Text color | Accent Subtle or Accent |
| Legal strip (Row 2) background | Background | Surface Warm token or Ink — must be consistent with footer treatment |
| Legal strip text | Text color | Surface Muted or Border token |

There is no hardcoded rule for each widget — the governing principle is: all text must meet WCAG 2.1 AA contrast against the Ink background (#231E1A). The minimum passing combinations:
- Surface (#FDFBF7) on Ink (#231E1A): contrast ratio ~16:1 ✅
- Accent (#4D7A70) on Ink (#231E1A): contrast ratio ~4.6:1 ✅ (passes AA for normal text)
- Border (#D6CFC4) on Ink (#231E1A): contrast ratio ~7.5:1 ✅

#### D3 — Correct footer navigation slugs

In the footer Column 2 nav container, update the link targets:

| Current link | Correct link |
|-------------|-------------|
| `/conditii/` | `/afectiuni/` |
| `/resurse/` | `/sfatul-neurochirurgului/` |
| `/recomandari/` | Already correct if present — confirm |
| `/contact/` | Keep — footer-only link is acceptable |

In footer Column 3 (Condiții tratate links), the condition slugs are listed as sub-pages under `/conditii/`. Update the parent slug:

| Current | Correct |
|---------|---------|
| `/conditii/tumori-cerebrale/` | `/afectiuni/tumori-cerebrale/` |
| `/conditii/hernie-de-disc/` | `/afectiuni/hernie-de-disc/` |
| `/conditii/anevrism-cerebral/` | `/afectiuni/anevrism-cerebral/` |
| `/conditii/hidrocefalie/` | `/afectiuni/hidrocefalie/` |
| `/conditii/nevralgie-de-trigemen/` | `/afectiuni/nevralgie-de-trigemen/` |
| "Toate condițiile →" → `/conditii/` | → `/afectiuni/` |

#### D4 — Replace all hardcoded hex values with Global Color tokens

After correcting the background and adapting text colours, replace remaining hardcoded hex values with their Global Color token equivalents using the same process as Phase C Step C3.

#### D5 — Verify structural and accessibility requirements

```
[ ] Outer footer container CSS ID is: organism-site-footer
[ ] Outer footer container HTML tag is: footer (Advanced → HTML Tag)
[ ] Outer footer container has custom attribute: role / contentinfo
[ ] Column 2 (Pages nav) HTML tag is: nav
[ ] Column 2 has custom attribute: aria-label / Footer — pagini principale
[ ] Column 3 (Conditions nav) HTML tag is: nav
[ ] Column 3 has custom attribute: aria-label / Footer — condiții tratate
[ ] Column 4 (Schedule) HTML tag is: div (NOT nav — it is not navigation)
[ ] Phone placeholder (Q15) is present and clearly marked as placeholder in staging
[ ] Email placeholder (Q16) is present and clearly marked as placeholder in staging
[ ] Medical disclaimer placeholder (Q20) is present and clearly marked
[ ] Privacy policy link → /politica-de-confidentialitate/ (can 404 in staging — that is acceptable)
[ ] "Toate condițiile →" → /afectiuni/ (corrected in D3)
[ ] "Toate locațiile și programul →" → /programari/ ✓
[ ] Copyright: © 2026 Dr. George Ungureanu. Toate drepturile rezervate.
```

#### D6 — Add footer CSS

Add to **Elementor → Site Settings → Custom CSS**:

```
/* Footer nav link hover */
#organism-site-footer .elementor-widget-heading a {
  text-decoration: none;
}
#organism-site-footer .elementor-widget-heading a:hover {
  color: var(--color-accent);
  text-decoration: underline;
  text-underline-offset: 3px;
}

/* Footer logo links — no underline */
#molecule-logo-footer a { text-decoration: none; }
#molecule-logo-footer a:hover { text-decoration: none; opacity: 0.85; }
```

#### D7 — Publish with correct display condition

- Click Publish in the Theme Builder editor
- Display Conditions: Include → Entire Site
- Verify footer appears on the WordPress homepage

**D completes when:** All D1–D7 checklist items pass, footer background is Ink (#231E1A), all text is readable, all links use correct slugs, and the footer renders correctly at 1280px, 768px, and 375px.

---

### Phase E — Custom Post Types (Sprint 2 Prerequisite — Does Not Block Sprint 1 Gate)

**Purpose:** Register all 6 CPTs in WordPress so they appear in the admin sidebar and content can be created during subsequent sprints.

**Depends on:** Child theme active (or a dedicated plugin file)
**Independent of:** Phases A–D — can be done in parallel with header/footer work or deferred to Sprint 2
**Does not block:** Sprint 1 Gate
**Blocks:** Phase F (ACF field groups require CPTs to exist) and Sprint 2 content entry

First confirm whether a child theme is active (Appearance → Themes — child theme should show "Child Theme" badge). If not, child theme creation is the prerequisite.

CPTs to register (per Task 02 content model):

| CPT slug | Admin label (singular) | Admin label (plural) | REST API |
|----------|----------------------|---------------------|---------|
| `condition` | Condiție | Condiții tratate | No |
| `sn-article` | Articol SN | Articole SN | No |
| `colleague-recommendation` | Recomandare colegă | Recomandări colegiale | No |
| `testimonial` | Testimonial | Testimoniale | No |
| `timeline-event` | Eveniment cronologie | Cronologie | No |
| `media-item` | Element media | Media Hub | Yes (`show_in_rest: true`) |

Registration method: `register_post_type()` calls in the child theme's `functions.php`, hooked to `init`. See Task 02 for the full field definitions governing each CPT.

**E completes when:** All 6 CPTs appear in the WordPress admin sidebar, and `/wp-json/wp/v2/` lists `media-item` in the REST API namespace.

---

### Phase F — ACF Pro Field Groups (Sprint 2 Prerequisite — Does Not Block Sprint 1 Gate)

**Purpose:** Attach all content model fields to each CPT so editors can create structured content entries.

**Depends on:** Phase E (CPTs must exist before field groups can be assigned)
**Does not block:** Sprint 1 Gate
**Blocks:** Sprint 2 content entry (homepage requires content from CPTs)

Confirm ACF Pro is installed and licensed before beginning (Plugins page should show ACF Pro, not free ACF).

Create one field group per CPT, assigned using the "Post Type is equal to [CPT slug]" location rule. Governing source for all field definitions: `docs/tasks/02_CONTENT_MODELS.md`.

| CPT | Key fields to configure (abbreviated — see Task 02 for full list) |
|-----|------------------------------------------------------------------|
| Condition | condition_name, icd_code, description, symptoms, treatments, hero_image |
| SN Article | title, category, body (WYSIWYG), featured_image, video_url, faq_items (repeater) |
| Colleague Recommendation | colleague_name, specialty, institution, relationship_context, recommendation_text, photo |
| Testimonial | patient_initials, condition_treated, testimonial_text, gdpr_consent, publication_consent |
| Timeline Event | year, title, description, location, event_type |
| Media Item | source_platform, original_url, thumbnail (WP media), caption, media_type |

**F completes when:** All 6 field groups are active, and creating a test entry in each CPT renders all required fields in the edit screen.

---

### Phase G — 404 Page (Depends on C + D)

**Purpose:** Provide a functional 404 page before the site can be considered complete for Sprint 1 Gate.

**Depends on:** Phase C (header must be correct) and Phase D (footer must be correct) — the 404 page inherits both
**Blocks:** Sprint 1 Gate

```
Elementor → Templates → Theme Builder → Add New → Single → 404 Page
```

Required content (in Romanian):
- Heading: "Pagina nu a fost găsită" (type-h1, Lora)
- Body: one or two sentences explaining the page may have moved
- Link: "Mergi la pagina principală" → `/`
- No CTA routing chain on the 404 page — the link to `/` is sufficient

Set as 404 template: Theme Builder publish dialog → Display Conditions → 404 Page.

**G completes when:** Navigating to a nonexistent URL on staging renders the 404 page with the correct header and footer.

---

## Section 4 — Task Dependency Map

```
F4 (plugin active)
        │
        ▼
  Phase A (token audit)
        │
        ├──────────────────┐
        ▼                  ▼
  Phase B              Phase D
 (nav menu)            (footer)
        │                  │
        ▼                  │
  Phase C (header) ────────┘
        │
        ▼
  Phase G (404)
        │
        ▼
 Sprint 1 Gate

─ ─ ─ Sprint 2 prerequisites (parallel, not Gate-blocking) ─ ─ ─
F1 (WP staging) ──▶ Phase E (CPTs) ──▶ Phase F (ACF) ──▶ Sprint 2
```

**The critical path is:** Phase A → Phase B → Phase C → Phase D → Phase G → Gate.

Phase D (footer) depends only on Phase A and runs in parallel with Phase B and C, but must complete before Phase G.
Phase E (CPTs) and Phase F (ACF) do not block the Sprint 1 Gate and should be treated as Sprint 2 prerequisites.

---

## Section 5 — Content Dependencies (Blocking the Gate)

Before the Sprint 1 Gate review with Dr. Ungureanu, the following open questions must be resolved. The staging footer can carry placeholder text during development, but these must be replaced with real content before the Gate.

| Question | Blocks | Content needed |
|----------|--------|---------------|
| Q15 — Phone number | Footer Column 1 / Gate | Confirmed phone in international format (tel:+40XXXXXXXXX) |
| Q16 — Admin notification email | Footer Column 1 / Gate | Confirmed email address |
| Q20 — Medical disclaimer wording | Footer legal strip / Gate | Approved text (Dr. Ungureanu must approve wording) |

---

## Section 6 — Sprint 1 Acceptance Criteria

All items must pass before Sprint 1 Gate review is requested.

### Design Token Foundation
- [ ] GU Design System plugin active — `gu-design-system.css` in page source
- [ ] All approved global colors exist in Elementor Site Settings → Global Colors
- [ ] All 8 required Task 04 tokens exist with correct hex values: Ink, Surface, Surface Warm, Surface Muted, Accent, Accent Hover, Accent Subtle, Border
- [ ] No one-off local colors are used in any header or footer widget (all color values reference a Global Color token)
- [ ] All 5 Elementor Global Typography styles match Task 04 spec — correct font, size, weight, line-height
- [ ] Elementor Flexbox Containers experiment is Active

### Header
- [ ] Navigation contains exactly 5 items in the correct order: Acasă / Afecțiuni / Sfatul Neurochirurgului / Recomandări / Despre
- [ ] Navigation slugs correct: / · /afectiuni/ · /sfatul-neurochirurgului/ · /recomandari/ · /despre/
- [ ] CTA button label: "Programează o consultație"
- [ ] CTA button target: /programari/
- [ ] CTA button hidden on mobile
- [ ] Header background: Surface (#FDFBF7) — visible at all scroll positions, no transparency
- [ ] Header is sticky (confirm by scrolling past one viewport height)
- [ ] Sticky shadow appears on scroll
- [ ] No hardcoded hex values remain — all colors are Elementor Global Color tokens
- [ ] HTML tag: `<header>` · Custom attribute: `role="banner"`
- [ ] Skip-to-content link is first in DOM, appears on Tab, moves focus on Enter
- [ ] Mobile: hamburger visible, logo visible, CTA hidden
- [ ] Mobile drawer: opens, all 5 items visible, closes on × / backdrop / Escape
- [ ] Display condition: Entire Site — header present on homepage and a test interior page
- [ ] [DR] Dr. Ungureanu has approved header at 1280px, 768px, 375px

### Footer
- [ ] Footer body background: Ink (#231E1A) — Global Color token, not hardcoded hex
- [ ] All footer text readable on Ink background (minimum WCAG AA contrast)
- [ ] Navigation slugs correct: /afectiuni/ · /sfatul-neurochirurgului/ · /recomandari/ · /despre/
- [ ] Condition slugs updated from /conditii/[slug]/ to /afectiuni/[slug]/
- [ ] No hardcoded hex values remain — all colors are Elementor Global Color tokens
- [ ] HTML tag: `<footer>` · Custom attribute: `role="contentinfo"`
- [ ] Column 2 `aria-label`: "Footer — pagini principale"
- [ ] Column 3 `aria-label`: "Footer — condiții tratate"
- [ ] Column 4 HTML tag: `<div>` (not nav)
- [ ] Q15 phone number: confirmed value, correctly linked tel:
- [ ] Q16 email address: confirmed value, correctly linked mailto:
- [ ] Q20 medical disclaimer: approved text in legal strip
- [ ] Privacy policy link: /politica-de-confidentialitate/ (page can be stub)
- [ ] Desktop: 4-column layout · Tablet: 2×2 grid · Mobile: 1-column stack
- [ ] Display condition: Entire Site
- [ ] [DR] Dr. Ungureanu has approved footer at 1280px, 768px, 375px

### Custom Post Types and ACF (Sprint 2 Prerequisites — Not Required for Sprint 1 Gate)
- [ ] *(Sprint 2)* All 6 CPTs appear in WordPress admin sidebar
- [ ] *(Sprint 2)* media-item CPT listed at /wp-json/wp/v2/ endpoint
- [ ] *(Sprint 2)* All 6 ACF field groups active — test entry creation works in each CPT

### Accessibility Baseline
- [ ] `<html lang="ro">` confirmed on page source
- [ ] Focus rings visible on Tab through header and footer
- [ ] Skip-to-content functional: Tab → visible · Enter → focus moves past header

### 404 Page
- [ ] Nonexistent URL renders the 404 template with header and footer
- [ ] 404 page contains a link back to /

### Sprint 1 Gate Review
- [ ] Dr. Ungureanu has reviewed staging and given written approval
- [ ] No unresolved content placeholders remain in header or footer
- [ ] Sprint 2 start confirmed in writing

---

*Sprint 1 Foundation Checklist version: 1.1 — 2026-06-28 (revised per SPRINT 1.2 corrections)*
*Next document after Gate: `docs/implementation/SPRINT_2_HOMEPAGE.md`*
