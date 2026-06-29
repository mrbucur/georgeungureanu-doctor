# Implementation Guide 04: Theme Builder Globals

## georgeungureanu.doctor — Header and Footer Build Reference

**Visual direction:** B+ — Warm Academic Medicine
**Sequence position:** Prompt 04 of the implementation sequence (after design system, component library, homepage, QA rules)
**Scope:** Two Elementor Theme Builder templates — `organism-site-header` and `organism-site-footer`
**Applied to:** Every page via Theme Builder → Display Conditions → Entire Site

**Required before starting:**
- `docs/implementation/01_DESIGN_SYSTEM_SETUP.md` complete — Global CSS active, Global Colors and Typography configured
- Component library built in Elementor Template Library (Prompts 01–02)
- WordPress navigation menu "Navigare principală" created (see §1.3)
- WordPress site accessible at the target domain
- Elementor Pro active and licensed

**QA reference:** Apply `docs/implementation/03_ELEMENTOR_QA_RULES.md` to both templates before marking either complete.

**Related page guides:**
- Homepage template: `docs/implementation/02_HOMEPAGE_TEMPLATE.md`
- /programari page: `docs/prompts/06_PROGRAMARI_PAGE_TEMPLATE.md`

**What this guide does not do:** Generate Elementor JSON. Generate WordPress theme files. All templates are built by hand in Elementor following the instructions below.

---

## Why the Header and Footer Are Built Before Page Templates

The header and footer are the only components that appear on every page. If they have errors — wrong links, missing ARIA roles, broken mobile drawer — those errors multiply across the entire site. Build and validate both before touching any page template.

**What the header must communicate in 3 seconds:**
1. "I am in the right place" — doctor name and specialty immediately visible
2. "I know what to do next" — primary CTA always visible

**What the footer must communicate:**
1. "I can reach someone" — contact details findable without scrolling back up
2. "There is more if I want it" — navigation links for deeper exploration
3. "This site is trustworthy" — legal information, disclaimer, and copyright present

**Build order:** Header first, footer second. Apply the QA checklist after each.

---

## Template 1 — `organism-site-header`

---

### §1.1 — Structure and Dimensions

```
Full-width outer Flexbox Container  [<header> element, role="banner"]
└── Inner Flexbox Container (max-width 1200px, centered)
    ├── Skip-to-content link (first child — off-screen by default, appears on :focus)
    ├── Logo zone (flex-start, flex-shrink: 0)
    │   └── molecule-logo
    │       "Dr. George Ungureanu" (Inter 600, 18px, Global Ink)
    │       "Neurochirurg" (Inter 400, 14px, Global Ink Secondary)
    ├── Navigation zone (flex: 1, centered)
    │   └── Elementor Pro Nav Menu — 6 items
    └── CTA zone (flex-end, flex-shrink: 0)
        └── atom-button-primary (small variant) — "Programează o consultație" → /programari
```

| Property | Desktop | Mobile |
|---|---|---|
| Background | Global Color "Surface" (#FDFBF7) — always | Same |
| Border-bottom | 1px solid Global "Border" (#D6CFC4) | Same |
| Outer container position | sticky, top: 0, z-index: 100 | sticky |
| Inner max-width | 1200px | N/A (full width) |
| Inner padding top/bottom | 20px (space-5) | 16px (space-4) |
| Inner padding left/right | 32px (space-8) | 20px (space-5) |
| Header height | 72px | 64px |

> **Transparent header is forbidden.** The background is always `color-surface` at all scroll positions. No transparency, no color shift, no opacity fade. Zero exceptions.

---

### §1.2 — Logo (`molecule-logo`)

Text-only. No image file. No SVG graphic mark.

| Element | Widget | Typography | Color | Link |
|---|---|---|---|---|
| "Dr. George Ungureanu" | Text widget | Global "H4 — Card Headline" (Inter 600, 18px) | Global "Ink" | / |
| "Neurochirurg" | Text widget | Global "Body Small" (Inter 400, 14px) | Global "Ink Secondary" | / |

**Container:** Flexbox Column, Direction: Column, Gap: 4px, Width: auto, flex-shrink: 0
**Custom ID:** `molecule-logo`
**No link underline:** Add to `elementor/custom.css`:
```css
#molecule-logo a { text-decoration: none; }
```

**Accessibility:** The link text "Dr. George Ungureanu Neurochirurg" is descriptive. No additional `aria-label` needed.

**On mobile:** Always visible. Never hidden.

**If a graphic mark is commissioned in the future:** This section must be revisited. A graphic mark requires a separate SVG file, different sizing rules, and a decision on text/mark composition in both header and footer.

---

### §1.3 — Navigation (`molecule-nav-item` × 6)

**WordPress menu setup — do this before building the Elementor template:**
1. WordPress admin → Appearance → Menus → Create New Menu → Name: "Navigare principală"
2. Add pages in this exact order:
   - Acasă → /
   - Condiții tratate → /conditii/
   - Programări → /programari/
   - Resurse → /resurse/
   - Despre Dr. Ungureanu → /despre/
   - Contact → /contact/
3. Set Menu Location: Primary Navigation
4. Save menu

**Nav item specifications:**

| State | Color | Additional styling |
|---|---|---|
| Default | Global "Ink" (#231E1A) | No underline |
| Hover | Global "Accent" (#4D7A70) | 2px bottom border, 200ms ease transition |
| Active (current page) | Global "Accent" (#4D7A70) | 2px bottom border (permanent, not just hover) |
| Focus | Global "Ink" | `:focus-visible` ring from custom.css |

**Active state CSS** — add to `elementor/custom.css`:
```css
.organism-site-header .current-menu-item > a {
  color: var(--color-accent);
  border-bottom: 2px solid var(--color-accent);
  padding-bottom: 2px;
}
```

**Spacing between items:** 24px (space-6) gap in the Nav Menu widget settings
**Typography:** Global "Navigation" (Inter 500, 15px)
**No dropdown menus.** Navigation is flat — all 6 items are top-level. No sub-menus, no mega-menus, no hover panels.
**No icons** in desktop navigation links.

---

### §1.4 — Primary CTA Button (small variant)

**Label:** "Programează o consultație"
**Destination:** /programari
**Custom ID:** `atom-button-primary-header`

| Property | Value |
|---|---|
| Background | Global "Accent" (#4D7A70) |
| Background hover | Global "Accent Hover" (#3A5F57) |
| Text color | Global "Surface" (#FDFBF7) |
| Typography | Global "CTA Button" (Inter 600) — size 14px locally for header context |
| Padding | 10px top/bottom, 20px left/right |
| Border-radius | 6px |
| Hover transition | background 200ms ease |
| Focus ring | From custom.css `:focus-visible` rule |

**On desktop:** Always visible. Never hidden at any viewport ≥ 768px.
**On mobile (< 768px):** Hidden via Elementor Responsive → Hide on Mobile. The CTA re-appears inside the mobile drawer (see §1.6).

**Note on size override:** The 14px is a permitted local size override in the header context only. The font family (Inter 600) comes from the Global "CTA Button" style — the size adjustment is the only local property.

---

### §1.5 — Sticky Behavior

**Default state (top of page):**
- Background: color-surface
- Border-bottom: 1px solid color-border
- No box-shadow

**Scrolled state (when `.elementor-sticky--active` is applied by Elementor):**
- Background: color-surface (unchanged)
- Border-bottom: 1px solid color-border (unchanged)
- Box-shadow: `0 2px 12px rgba(35, 30, 26, 0.08)` (added by CSS)

**Add to `elementor/custom.css`:**
```css
#organism-site-header.elementor-sticky--active {
  box-shadow: 0 2px 12px rgba(35, 30, 26, 0.08);
}
```

**Elementor sticky setup:**
- Select the outer Flexbox Container → Advanced → Motion Effects → Sticky: Top
- Sticky offset: 0
- No additional effects — no opacity change, no size change, no color change on scroll

**The sticky header must not:**
- Change opacity at any point
- Shrink or grow based on scroll position
- Hide and reappear based on scroll direction ("smart" hide/show)
- Shift page layout when it sticks (fixed height prevents layout jump)

---

### §1.6 — Skip-to-Content Link

This is the first focusable element on every page. It exists for keyboard and screen reader users who want to bypass navigation and reach content directly.

**The CSS is already defined in `elementor/custom.css`:**
```css
/* Already in custom.css — do NOT add again */
.skip-to-content {
  position: absolute;
  top: -100%;
  left: 16px;
  z-index: 1000;
  background: var(--color-accent);
  color: var(--color-surface);
  padding: 8px 16px;
  border-radius: 0 0 6px 6px;
  font-family: var(--font-sans);
  font-weight: 600;
  font-size: 14px;
  text-decoration: none;
  transition: top 200ms ease;
}
.skip-to-content:focus {
  top: 0;
}
```

**In Elementor (header template):**
1. Add a Text Editor widget as the FIRST widget inside the inner container (before the logo zone)
2. Switch the widget to HTML mode
3. Paste: `<a href="#main-content" class="skip-to-content">Mergi la conținut</a>`
4. Set z-index: 200 on this widget's wrapper container

**On every page template:**
Set `id="main-content"` on the first content section below the header — via Elementor: select the section → Advanced → CSS ID → `main-content`. This is the skip link's target.

Page templates where `#main-content` must be set:
- Homepage: first content section (organism-hero-homepage)
- All interior page templates: the hero section (organism-hero-interior)
- /contact: the hero section (organism-hero-contact)
- /programari: the hero section (organism-hero-interior) — confirmed in Prompt 06

**Testing the skip-to-content:**
1. Load any page → Tab once → link appears top-left
2. Press Enter → focus jumps to `#main-content` (the content section, bypassing all nav)
3. Test on every distinct page template (homepage, interior, contact, /programari)

---

### §1.7 — Mobile Implementation

**Trigger breakpoint:** 768px

**Mobile header:**
```
Full-width container (64px height)
├── Logo (left — always visible, same spec as desktop)
└── Hamburger button (right — 44×44px touch target, aria-label="Deschide meniu")
```

**Mobile drawer (slides from right):**
```
Full-viewport-width panel
Background: color-surface (#FDFBF7)
z-index: 200
├── Drawer header (64px, matches main header)
│   ├── Logo (echoes main header)
│   └── Close button "×" (44×44px, aria-label="Închide meniu")
├── Navigation list (vertical stack)
│   ├── "Acasă"                   56px height, full width
│   ├── "Condiții tratate"        56px height, full width
│   ├── "Programări"              56px height, full width
│   ├── "Resurse"                 56px height, full width
│   ├── "Despre Dr. Ungureanu"    56px height, full width
│   └── "Contact"                 56px height, full width
│   [Typography: Global "Body Large" — 20px for touch readability]
├── atom-divider (color-border)
└── CTA button — "Programează o consultație" → /programari
    Style: Primary, full-width, Global "CTA Button"
```

**Backdrop:** Semi-transparent overlay behind the drawer (Global "Overlay": rgba(35,30,26,0.80))

**Drawer behavior:**
- Opens: hamburger tap → `aria-expanded="false"` → `aria-expanded="true"`, focus moves to first nav item
- Closes: close button tap, backdrop tap, or Escape key
- Escape key: closes drawer, focus returns to hamburger button
- Focus trap: while drawer is open, Tab/Shift+Tab must not leave the drawer

**Elementor Nav Menu widget handles the mobile drawer natively.** Configure:
- Toggle button: Hamburger
- Toggle button size: 24px icon, 44px clickable area
- Dropdown mode: slide from right
- Overlay: enable, color: Global "Overlay" 80%
- Close button: enabled
- Breakpoint: Tablet (768px)
- Mobile nav item height: 56px
- Mobile nav typography: Global "Body Large"
- Mobile CTA: enable → text "Programează o consultație" → link /programari → style: Primary (full-width)

---

### §1.8 — Accessibility Checklist — Header

Complete before applying the header to any page. Reference: WCAG 2.1 AA.

**Semantic structure:**
```
[ ] Outer container HTML tag: <header> (Advanced → HTML Tag → header)
[ ] role="banner" on the <header> element (Custom Attributes → role: banner)
[ ] Nav Menu widget wraps in <nav> (Elementor default behavior — verify in DOM)
[ ] <nav> has aria-label="Navigare principală"
```

**Skip-to-content:**
```
[ ] Skip link is the FIRST focusable element on every page (Tab once — it appears)
[ ] Skip link appears on first Tab keypress (CSS :focus handler works)
[ ] Enter on skip link → focus moves to #main-content
[ ] Every page template has id="main-content" on the first content section
```

**Navigation:**
```
[ ] All 6 nav items keyboard-accessible (Tab through each item in order)
[ ] Active page item: aria-current="page" (WordPress .current-menu-item + CSS)
[ ] Hover state visible (color change 200ms — sufficient)
[ ] Focus ring visible on all nav items (from custom.css :focus-visible rule)
```

**CTA button:**
```
[ ] Text: "Programează o consultație" — descriptive, not "Click here" or "Book"
[ ] Link: /programari — confirmed
[ ] Focus ring visible on the button
[ ] Keyboard-accessible (Tab → button → Enter or Space activates)
```

**Mobile drawer:**
```
[ ] Hamburger: aria-label="Deschide meniu" when closed, aria-label="Închide meniu" when open
[ ] Hamburger: aria-expanded="false" when closed, aria-expanded="true" when open
[ ] When drawer opens: focus moves to the first navigation item inside the drawer
[ ] Escape key: closes drawer, focus returns to hamburger button
[ ] Focus trap: Tab/Shift+Tab does not escape the drawer while open
[ ] Backdrop close (tap outside drawer) functions on touch devices
[ ] Close button (×): aria-label="Închide meniu"
[ ] All 6 drawer navigation items keyboard-accessible while drawer is open
```

**Motion:**
```
[ ] No animations on the header itself
[ ] Drawer transition (200ms ease) — user-triggered, not suppressed by prefers-reduced-motion
[ ] Scroll shadow (CSS only — no JS animation)
```

---

### §1.9 — Header Anti-Patterns

| Pattern | Why it fails | Correct approach |
|---|---|---|
| Transparent header that becomes opaque on scroll | Contrast unverifiable at every section background | Always `color-surface` — zero maintenance, always readable |
| Scroll-hide header (hides scrolling down, shows scrolling up) | Patients may need the CTA at any moment | Header always visible via sticky |
| Dropdown navigation menus | Cognitive load; unreliable on touch | Flat navigation — all 6 items always visible |
| Logo as an image file | Renders poorly small; requires retina/WebP variants | Text-only `molecule-logo` |
| "Book now" or "Schedule now" CTA text | Implies commitment before the patient is ready | "Programează o consultație" — open invitation |
| More than one primary action in the header | Splits patient attention | One button only |
| Mega menus or navigation panels | Overwhelming for a 6-page site | Flat nav, no sub-menus |
| Animated navigation items | Distracts; fails `prefers-reduced-motion` | No animations in the header |
| Hidden CTA on small desktop (768px–1024px) | Patients at these sizes lose the primary action | CTA visible at all viewports ≥ 768px |

---

### §1.10 — Elementor Build Steps — Header (Full Sequence)

**Before starting:** Confirm "Navigare principală" menu is created in WordPress with all 6 items in correct order.

1. Elementor → Templates → Theme Builder → Add New Template → Type: Header → Name: `organism-site-header`
2. Click "Edit in Elementor"

**Outer container:**
3. Add a Flexbox Container → set to Full Width
4. Advanced → HTML Tag: `header`
5. Advanced → Custom Attributes: `role` = `banner`
6. Style → Background: Global Color "Surface"
7. Style → Border: Bottom only, 1px, Global Color "Border"
8. Advanced → Motion Effects → Sticky: Top; offset: 0
9. Advanced → CSS ID: `organism-site-header`
10. Advanced → z-index: 100

**Inner container:**
11. Inside the outer container, add a Flexbox Container
12. Direction: Row; Align Items: Center; Justify Content: Space Between
13. Style → Width: 1200px; Margin: 0 auto
14. Style → Padding: 20px top, 20px bottom, 32px left, 32px right (desktop)
15. Responsive padding (tablet/mobile breakpoint): 16px top, 16px bottom, 20px left, 20px right

**Skip-to-content link (first child of inner container):**
16. Add a Text Editor widget as the first widget inside the inner container
17. Switch to HTML mode
18. Paste: `<a href="#main-content" class="skip-to-content">Mergi la conținut</a>`
19. Set z-index: 200 on this widget's container
20. Preview: Tab once on any page → verify the link appears at top-left

**Logo zone:**
21. Add a Flexbox Container → Direction: Column, Gap: 4px, Width: auto, flex-shrink: 0
22. Advanced → CSS ID: `molecule-logo`
23. Add Text widget → "Dr. George Ungureanu" → Typography: Global "H4 — Card Headline" → Color: Global "Ink" → Link: /
24. Add second Text widget → "Neurochirurg" → Typography: Global "Body Small" → Color: Global "Ink Secondary" → Link: /
25. Custom CSS in `elementor/custom.css`: `#molecule-logo a { text-decoration: none; }`

**Navigation zone:**
26. Add the Elementor Pro Nav Menu widget
27. Menu: Select "Navigare principală"
28. Layout: Horizontal; Align: Center
29. Typography: Global "Navigation" (Inter 500, 15px)
30. Text Color (default): Global "Ink"
31. Text Color (hover): Global "Accent"
32. Pointer: Underline → Bottom Border, 2px, Global "Accent"
33. Pointer animation: None
34. Gap between items: 24px (space-6)
35. Breakpoint: Tablet (768px)
36. Mobile toggle: Hamburger icon, 24px, 44px touch area
37. Full-screen overlay: enable, color: Global "Overlay" 80%
38. Dropdown direction: right (drawer from right edge)
39. Mobile nav item height: 56px
40. Mobile nav typography: Global "Body Large"
41. Mobile CTA: enable → text "Programează o consultație" → link /programari → style Primary, full-width

**CTA zone:**
42. Add a Flexbox Container → Width: auto, flex-shrink: 0
43. Add Button widget → Text: "Programează o consultație" → Link: /programari
44. Background: Global "Accent"; Text: Global "Surface"; Border-radius: 6px
45. Padding: 10px top/bottom, 20px left/right
46. Typography: Global "CTA Button" → size: 14px (local size override for header context)
47. Hover → Background: Global "Accent Hover"
48. Advanced → Responsive → Hide on Mobile
49. Advanced → CSS ID: `atom-button-primary-header`

**Display conditions:**
50. Click Display Conditions → Add condition: Include → Entire Site
51. Publish

**Post-build verification:**
52. Verify sticky shadow CSS in `elementor/custom.css`:
    ```css
    #organism-site-header.elementor-sticky--active {
      box-shadow: 0 2px 12px rgba(35, 30, 26, 0.08);
    }
    ```
53. Load any page → scroll down → verify shadow appears when header sticks
54. Tab once → verify skip-to-content link appears
55. Press Enter on skip link → verify focus moves to the first content section
56. Resize to 375px → verify mobile drawer works end-to-end
57. Apply the full Accessibility Checklist (§1.8) before publishing

---

## Template 2 — `organism-site-footer`

---

### §2.1 — Structure

The footer has two visual rows, each a separate full-width Flexbox Container.

**Row 1 — Main body (background: color-surface-muted):**
```
<footer> element, role="contentinfo"
└── Inner container (max-width 1200px, Flexbox Row, gap 48px)
    ├── Column 1 — Doctor info and contact (width: 30%)
    ├── Column 2 — Quick navigation (flex: 1)  [<nav> element]
    ├── Column 3 — Conditions navigation (flex: 1)  [<nav> element]
    └── Column 4 — Schedule and locations (flex: 1)  [plain div — NOT <nav>]
```

**Row 2 — Legal strip (background: color-surface-warm):**
```
Full-width container (border-top: 1px color-border)
└── Inner container (max-width 1200px, Flexbox Row, gap 24px)
    └── Copyright · Privacy policy · Cookie policy · Medical disclaimer
```

**Semantic note:** Columns 2 and 3 are navigation regions — they use `<nav>` HTML tags with distinct `aria-label` values. Column 4 is not navigation — it uses a plain `<div>`.

---

### §2.2 — Column 1 — Doctor Info and Contact

This column answers the patient's most urgent footer questions: who is this and how do I reach them?

```
molecule-logo (same spec as header)
  "Dr. George Ungureanu" — Global H4, Global Ink, link: /
  "Neurochirurg" — Global Body Small, Global Ink Secondary, link: /

atom-body-sm (practice description):
  "Neurochirurg specializat în afecțiuni ale creierului, coloanei vertebrale
   și sistemului nervos. Consultații și intervenții în Cluj-Napoca și Baia Mare."
  Color: Global "Ink Secondary"
  [CONFIRM FINAL TEXT — Q20]

molecule-meta (phone):
  Icon: phone SVG, 16px, color-accent
  Text: [PHONE NUMBER — Q15, BLOCKING]
  Link: tel:+40[number]
  Typography: Global "Body Small", Global "Ink"

molecule-meta (email):
  Icon: envelope SVG, 16px, color-accent
  Text: [EMAIL ADDRESS — Q16, BLOCKING]
  Link: mailto:[email]
  Typography: Global "Body Small", Global "Ink"

molecule-meta (locations):
  Icon: map-pin SVG, 16px, color-accent
  Text: "Clinici și locații →"
  Link: /programari/ (NOT a single address — multiple locations exist)
  Typography: Global "Body Small", Global "Accent"

[Social links — CONDITIONAL on Q18 — omit entirely if not confirmed]
  Position: below locations link, 16px margin-top
  Icons: SVG, 20px, color-ink-secondary default, color-ink hover
  aria-label="[Platform] Dr. George Ungureanu" per link
  SVG: aria-hidden="true"
  Max 3 platforms
  target="_blank" rel="noopener"
```

**Elementor implementation:**
1. Flexbox Container → Direction: Column, Gap: 20px (space-5), Width: 30% desktop / 100% mobile
2. Logo sub-container → Flexbox Column, Gap: 4px, both text widgets linked to /
3. Description: Text widget → Body Small → Ink Secondary
4. Phone: Icon Box widget → phone SVG → tel: link → Body Small
5. Email: Icon Box widget → envelope SVG → mailto: link → Body Small
6. Locations: Icon Box widget → map-pin SVG → /programari/ → Body Small → Accent color
7. (Social if Q18 confirmed): icon links with correct aria-labels

---

### §2.3 — Column 2 — Quick Navigation

```
atom-label: "PAGINI"
  CSS class: text-overline
  Color: Global "Ink Secondary"

Links (6 items — matches confirmed navigation):
  "Acasă" → /
  "Condiții tratate" → /conditii/
  "Programări" → /programari/
  "Resurse" → /resurse/
  "Despre Dr. Ungureanu" → /despre/
  "Contact" → /contact/
  Typography: Global "Body Small", Global "Ink"
  Hover: Global "Accent", underline, 200ms ease
```

**Semantic structure:** Wrap the column container in `<nav aria-label="Footer — pagini principale">`.

**Elementor implementation:**
1. Flexbox Container → Direction: Column, Gap: 16px (space-4), Flex: 1
2. Advanced → HTML Tag: `nav`; Custom Attributes: `aria-label` = `Footer — pagini principale`
3. Text widget → "PAGINI" → CSS class `text-overline` → Ink Secondary
4. 6 × Text widget → one per nav item → Body Small → Ink → hover Accent → correct URL per item

---

### §2.4 — Column 3 — Conditions Navigation

```
atom-label: "CONDIȚII TRATATE"
  CSS class: text-overline
  Color: Global "Ink Secondary"

Links (top 5 — confirm list with Dr. Ungureanu, Q22):
  "Tumori cerebrale" → /conditii/tumori-cerebrale/
  "Hernie de disc" → /conditii/hernie-de-disc/
  "Anevrism cerebral" → /conditii/anevrism-cerebral/
  "Hidrocefalie" → /conditii/hidrocefalie/
  "Nevralgie de trigemen" → /conditii/nevralgie-de-trigemen/
  Typography: Global "Body Small", Global "Ink", hover: Global "Accent"

atom-button-ghost:
  "Toate condițiile →" → /conditii/
  Typography: Global "Body Small", Global "Accent"
  Margin-top: 12px (space-3)
```

**Semantic structure:** Wrap in `<nav aria-label="Footer — condiții tratate">`.

**Elementor implementation:**
1. Flexbox Container → Direction: Column, Gap: 16px (space-4), Flex: 1
2. Advanced → HTML Tag: `nav`; Custom Attributes: `aria-label` = `Footer — condiții tratate`
3. Text widget → "CONDIȚII TRATATE" → CSS class `text-overline` → Ink Secondary
4. 5 × Text widget → one per condition → Body Small → Ink → link to condition URL
5. Button widget (ghost style) → "Toate condițiile →" → /conditii/ → Accent → no background

**Important:** Only link to published condition pages. If a condition page does not yet exist, remove its link from the footer until the page is published. Never link to a 404.

---

### §2.5 — Column 4 — Schedule and Locations

Dr. Ungureanu is present at multiple locations with different schedules. The footer cannot show a single authoritative schedule — that would mislead patients. Column 4 orients the patient and routes them to `/programari/` for specifics.

```
atom-label: "PROGRAM CONSULTAȚII"
  CSS class: text-overline
  Color: Global "Ink Secondary"

Schedule block — two options depending on Q17:

  Option A (use ONLY if schedule is consistent across all locations):
    "Luni – Vineri, [HOURS — CONFIRM Q17]
     Sâmbătă: [CLOSED or HOURS — CONFIRM Q17]"
    Typography: Global "Body Small", Global "Ink"

  Option B (use if schedule varies by location, or if Q17 not yet confirmed):
    "Programul variază în funcție de locație.
     Consultați pagina Programări pentru detalii."
    Typography: Global "Body Small", Global "Ink"

atom-button-ghost:
  "Toate locațiile și programul →" → /programari/
  Typography: Global "Body Small", Global "Accent"
  Margin-top: 12px (space-3)
```

**Default: use Option B** until Dr. Ungureanu confirms consistent hours across all locations. A vague correct statement is preferable to a specific incorrect one. `/programari/` is the single source of truth for schedule information.

**Elementor implementation:**
1. Flexbox Container → Direction: Column, Gap: 16px (space-4), Flex: 1
2. This container does NOT use `<nav>` — it is informational, not navigation
3. Text widget → "PROGRAM CONSULTAȚII" → text-overline class → Ink Secondary
4. Text widget → Option B text → Body Small → Ink (replace with Option A when Q17 confirmed)
5. Button widget (ghost) → "Toate locațiile și programul →" → /programari/ → Accent

---

### §2.6 — Row 2 — Legal Strip

**Purpose:** Legal requirements, medical disclaimer, copyright. Minimal visual weight. Not a design focal point.

| Property | Value |
|---|---|
| Background | Global Color "Surface Warm" (#F4EFE6) |
| Border-top | 1px solid Global "Border" |
| Padding | 20px top/bottom (space-5) |
| Typography | Global "Caption" (Inter 400, 13px) |
| Color | Global "Ink Secondary" |

**Content (left → right on desktop, stacked on mobile):**
```
"© [YEAR] Dr. George Ungureanu. Toate drepturile rezervate."
  · separator ·
"Politică de confidențialitate" → /politica-de-confidentialitate/
  · separator ·
"Cookie-uri" → /cookies/  [CONDITIONAL — only if tracking confirmed, Q21]
  · separator ·
"Informațiile de pe acest site au caracter exclusiv informativ și nu constituie
 sfat medical sau recomandare terapeutică. Consultați medicul specialist."
 [CONFIRM FINAL WORDING — Q23]
```

**Copyright year:** Use Elementor's Copyright widget if available. Otherwise, update the year manually each January. A shortcode returning the current year is also acceptable.

**Legal pages must exist before the footer goes live:**
- `/politica-de-confidentialitate/` — GDPR privacy policy (Q20 — BLOCKING)
- `/cookies/` — cookie policy (CONDITIONAL on Q21 — only required if analytics is in use)

If these pages do not exist at launch, create placeholder pages with "Politică în curs de redactare" rather than linking to 404s.

**Elementor implementation:**
1. Add a new full-width Flexbox Container (outside and below the Row 1 footer container)
2. Background: Global Color "Surface Warm"
3. Border: Top only, 1px, Global Color "Border"
4. Padding: 20px top/bottom
5. Inner container: max-width 1200px, centered, Flexbox Row (desktop) / Column (mobile), gap: 24px
6. Text widget → copyright string → Caption → Ink Secondary
7. Text widget → "Politică de confidențialitate" → link /politica-de-confidentialitate/ → Caption → Ink Secondary
8. Text widget → "Cookie-uri" → link /cookies/ → Caption → Ink Secondary [add only if Q21 confirmed]
9. Text widget → medical disclaimer text → Caption → Ink Secondary
10. Mobile: set inner container Direction to Column at mobile breakpoint; center-align all items

---

### §2.7 — Responsive Behavior — Footer

| Breakpoint | Layout | Gap |
|---|---|---|
| Desktop ≥ 1024px | 4-column Row | 48px (space-12) |
| Tablet 768–1023px | 2×2 grid: Col1+Col2 top row, Col3+Col4 bottom row | 32px (space-8) |
| Mobile < 768px | 1-column stack (all 4 columns vertical) | 24px (space-6) |

**Mobile column order:**
1. Doctor info and contact (top — patient's most urgent footer need)
2. Quick navigation
3. Conditions navigation
4. Schedule

**Legal strip mobile:**
- Copyright on one line
- Privacy and cookie links on one line (separated by " · ")
- Medical disclaimer on its own line
- All centered

**Row 1 footer padding:** 64px top/bottom desktop → 40px tablet/mobile
**Row 2 legal strip padding:** 20px top/bottom at all breakpoints

---

### §2.8 — Accessibility Checklist — Footer

```
[ ] Outer container HTML tag: <footer> (Advanced → HTML Tag → footer)
[ ] role="contentinfo" present (Custom Attributes → role: contentinfo)
[ ] Column 2: HTML Tag → nav; Custom Attributes → aria-label: "Footer — pagini principale"
[ ] Column 3: HTML Tag → nav; Custom Attributes → aria-label: "Footer — condiții tratate"
[ ] Column 4: HTML tag is NOT nav — plain div (schedule/locations, not navigation)
[ ] Phone: tel: link with readable display text (e.g., "0721 000 000", not "+40721000000")
[ ] Email: mailto: link with readable display text
[ ] Locations link "Clinici și locații →": descriptive text (not "Click here")
[ ] All 5 condition links: descriptive condition names (not "Read more")
[ ] "Toate condițiile →": descriptive, not "More"
[ ] "Toate locațiile și programul →": descriptive
[ ] Social icon links (if present): aria-label="[Platform] Dr. George Ungureanu"
[ ] Social SVG icons: aria-hidden="true"
[ ] External links (social, if any): target="_blank" rel="noopener" + visible external indicator
[ ] Privacy policy link: points to a real, published page
[ ] Cookie policy link: points to a real, published page (if in use)
[ ] Medical disclaimer: visible text (not in a CSS-hidden element)
[ ] Copyright year: correct year
[ ] All Column 2 and 3 links: keyboard-accessible
[ ] Focus rings visible on all links and buttons
```

---

### §2.9 — Footer Anti-Patterns

| Pattern | Why it fails | Correct approach |
|---|---|---|
| Single clinic address in Column 1 | Misleads patients from other locations | Link to /programari/ — the definitive location hub |
| Newsletter signup form | Medically inappropriate; data collection complexity; no clear patient benefit | Omit entirely |
| Social links to inactive/unmonitored accounts | Patients send medical questions; unanswered messages create safety risk | Only add if accounts are confirmed actively monitored (Q18) |
| Claiming a specific schedule if it varies | Patients may arrive expecting a doctor who isn't there | Use Option B text → redirect to /programari/ |
| "Contact us" generic footer CTA | Too vague — patients don't know what happens | Direct phone tel: link + email mailto: link + /programari/ |
| Promotional language in the footer | Undermines the calm, editorial character | Footer is information only — no "Book now!" or "Limited appointments" |
| Testimonials in the footer | No space for proper attribution; out of context | Testimonials only in organism-patient-testimonials |
| Cookie banner inside the footer | Confusing; system-level consent belongs in a dedicated plugin | Use Complianz, Borlabs, or similar cookie consent plugin |
| Links to unpublished condition pages | Creates 404s | Remove any link where the destination page does not exist |
| More than 6 links per nav column | Scanning difficulty | Maximum 6 links per navigation column |

---

### §2.10 — Elementor Build Steps — Footer (Full Sequence)

**Before starting:** Confirm phone number, email address, and that privacy policy and /programari pages are at minimum created as drafts.

1. Elementor → Templates → Theme Builder → Add New Template → Type: Footer → Name: `organism-site-footer`

**Row 1 outer container:**
2. Add Flexbox Container (full-width)
3. Advanced → HTML Tag: `footer`
4. Advanced → Custom Attributes: `role` = `contentinfo`
5. Style → Background: Global Color "Surface Muted"
6. Style → Border: Top only, 1px, Global Color "Border"
7. Advanced → CSS ID: `organism-site-footer`

**Row 1 inner container:**
8. Inside the outer container, add a Flexbox Container
9. Direction: Row; Align Items: Flex-Start; Gap: 48px
10. Max-width: 1200px; Margin: 0 auto
11. Padding: 64px top/bottom (desktop), 40px (tablet and mobile)

**Column 1:**
12. Add Flexbox Container → Width: 30%, Direction: Column, Gap: 20px
13. Logo sub-container: Flexbox Column, gap 4px, both text widgets linked to /
14. Description text widget → Body Small → Ink Secondary
15. Phone Icon Box widget → tel: link → Body Small → Ink
16. Email Icon Box widget → mailto: link → Body Small → Ink
17. Locations Icon Box → "Clinici și locații →" → /programari/ → Body Small → Accent
18. (Social if Q18 confirmed): icon links below, with aria-labels

**Column 2:**
19. Add Flexbox Container → Flex: 1, Direction: Column, Gap: 16px
20. Advanced → HTML Tag: `nav`; Custom Attributes: `aria-label` = `Footer — pagini principale`
21. Label widget → "PAGINI" → CSS class `text-overline` → Ink Secondary
22. 6 × Text widget → one per nav item → Body Small → Ink → link to correct URL

**Column 3:**
23. Add Flexbox Container → Flex: 1, Direction: Column, Gap: 16px
24. Advanced → HTML Tag: `nav`; Custom Attributes: `aria-label` = `Footer — condiții tratate`
25. Label widget → "CONDIȚII TRATATE" → CSS class `text-overline` → Ink Secondary
26. 5 × Text widget → one per condition → Body Small → Ink → link to condition URL
27. Button widget (ghost) → "Toate condițiile →" → /conditii/ → Accent → no background

**Column 4:**
28. Add Flexbox Container → Flex: 1, Direction: Column, Gap: 16px
29. [No nav HTML tag on this container]
30. Label widget → "PROGRAM CONSULTAȚII" → CSS class `text-overline` → Ink Secondary
31. Schedule widget → Option B text (or Option A when Q17 confirmed) → Body Small → Ink
32. Button widget (ghost) → "Toate locațiile și programul →" → /programari/ → Accent

**Row 2 — Legal strip:**
33. Add a new Flexbox Container (full-width, outside Row 1)
34. Background: Global Color "Surface Warm"
35. Border: Top only, 1px, Global Color "Border"
36. Padding: 20px top/bottom
37. Inner container: max-width 1200px, centered, Flexbox Row, Gap: 24px
38. Mobile: Direction Column at mobile breakpoint, centered
39. Copyright widget (or Text widget) → copyright string → Caption → Ink Secondary
40. Text widget → "Politică de confidențialitate" → link /politica-de-confidentialitate/ → Caption → Ink Secondary
41. Text widget → "Cookie-uri" → link /cookies/ → Caption → Ink Secondary [only if Q21 confirmed]
42. Text widget → medical disclaimer → Caption → Ink Secondary

**Display conditions:**
43. Click Display Conditions → Add: Include → Entire Site
44. Publish

---

## Part 3 — Performance Specifications

### Header
- Expected contribution to page weight: < 20KB (template CSS + Elementor Nav JS)
- No images (text-only logo avoids image requests)
- Sticky behavior: CSS `position: sticky` — no JavaScript required
- Mobile drawer: Elementor Nav Menu Pro minimal inline JS for hamburger toggle

### Footer
- No images (text links + inline SVG icons only)
- Social SVG icons (if added): prefer inline SVG over `<img>` or background-image
- 4-column layout: pure Flexbox — no JavaScript required
- Condition links: verify all 5 destination pages exist before launch

### Shared resource behavior
- Lora and Inter loaded once globally — header and footer do not trigger additional font requests
- Global Colors and Global Typography: loaded once, shared across all templates
- custom.css: loaded once — no per-template CSS duplication
- Verify in Chrome DevTools → Network → Fonts: only 2 font families should appear

---

## Part 4 — Launch Checklists

### Header Launch Checklist

```
[ ] "Navigare principală" WordPress menu: 6 items in correct order
[ ] All 6 nav destinations are published pages (no 404 links)
[ ] CTA "Programează o consultație" links to /programari/ — verified by clicking
[ ] Sticky shadow appears when scrolling down any page
[ ] Skip-to-content link appears on first Tab press
[ ] Skip-to-content Enter → focus moves to #main-content on all page templates
[ ] #main-content ID set on the first content section in: homepage, all interior templates, /contact, /programari
[ ] Active page indicator: current page's nav item shows color-accent + 2px bottom border
[ ] Mobile (375px): hamburger visible
[ ] Mobile: drawer opens, shows all 6 nav items
[ ] Mobile: drawer closes on ×, on backdrop tap, and on Escape key
[ ] Mobile: CTA button present at the bottom of the mobile drawer
[ ] Mobile: focus trapped inside drawer while open
[ ] Display condition: Entire Site (verify on 3+ different page types)
[ ] Lighthouse accessibility score ≥ 90 on any page with the header
[ ] No horizontal scroll at 375px
```

### Footer Launch Checklist

```
[ ] Phone number confirmed — displays as tel: link — test on mobile (tap should offer to call)
[ ] Email confirmed — displays as mailto: link — test on desktop (click should open email client)
[ ] /programari/ page is live (Column 1 locations link must not 404)
[ ] /conditii/ page is live (conditions nav must not 404)
[ ] All 5 condition links in Column 3 → published condition pages (verified)
[ ] "Toate condițiile →" → /conditii/ — verified
[ ] "Toate locațiile și programul →" → /programari/ — verified
[ ] All 6 quick navigation links in Column 2 → published pages
[ ] Privacy policy page live at /politica-de-confidentialitate/
[ ] Cookie policy page live at /cookies/ (only if Q21 confirmed — tracking in use)
[ ] Copyright year is correct
[ ] Medical disclaimer text visible in the legal strip
[ ] Social links (if added): icons visible, correct profiles, open in new tab, aria-labels set
[ ] Mobile: 4 columns collapse to 1 column in correct stacking order
[ ] Mobile: legal strip wraps correctly, no content clipped
[ ] Display condition: Entire Site
[ ] Lighthouse accessibility score ≥ 90 on any page with the footer
[ ] Footer page-weight contribution ≤ 50KB (excluding fonts already loaded)
```

---

## Part 5 — Open Questions

Questions blocking or gating header/footer implementation. Items confirmed at time of writing are marked. Items still open are grouped by priority.

### Blocking — Footer cannot go live without these

| ID | Question | Where used |
|---|---|---|
| Q15 | **Phone number.** What patient-facing phone number appears in the footer Column 1 and /contact page? | Footer Col 1, organism-hero-contact |
| Q16 | **Email address.** What email address appears in the footer Column 1 and is used for patient enquiries? | Footer Col 1, organism-contact-form |
| Q17 | **Schedule consistency.** Is Dr. Ungureanu's consultation schedule consistent across all locations (enabling Option A in Column 4), or does it vary by location (requiring Option B — redirect to /programari)? | Footer Col 4 |
| Q20 | **Privacy policy page.** A GDPR-required privacy policy must exist at `/politica-de-confidentialitate/`. Does this document exist, or does it need drafting? | Footer legal strip |

### Conditional — Specific footer elements depend on these

| ID | Question | Where used |
|---|---|---|
| Q18 | **Social media.** Does Dr. Ungureanu maintain official social media accounts (Facebook, LinkedIn, YouTube, or other) that are actively monitored for patient messages? If yes: provide profile URLs. If no: social links are omitted entirely from the footer. | Footer Col 1 (social block) |
| Q19 | **Logo mark.** Is the logo purely typographic (current spec), or is a graphic mark commissioned or planned? A graphic mark changes the logo implementation in both header and footer. | Header logo, Footer logo |
| Q21 | **Cookie policy and analytics.** Is Google Analytics, Hotjar, or similar tracking planned? If yes: cookie consent mechanism and `/cookies/` page required. If no: Cookie-uri link in the legal strip is omitted. | Footer legal strip |
| Q22 | **Conditions for footer Column 3.** Confirm the top 5 conditions to link from the footer. Current placeholder: Tumori cerebrale, Hernie de disc, Anevrism cerebral, Hidrocefalie, Nevralgie de trigemen. | Footer Col 3 |
| Q23 | **Medical disclaimer wording.** Confirm or amend: "Informațiile de pe acest site au caracter exclusiv informativ și nu constituie sfat medical sau recomandare terapeutică. Consultați medicul specialist." The practice may have a specific legally required formulation. | Footer legal strip |
| Q24 | **Footer description text.** Confirm or amend: "Neurochirurg specializat în afecțiuni ale creierului, coloanei vertebrale și sistemului nervos. Consultații și intervenții în Cluj-Napoca și Baia Mare." | Footer Col 1 |

### Confirmed — No further input needed

| ID | Decision | Confirmed |
|---|---|---|
| Nav structure | 6 items: Acasă / Condiții tratate / Programări / Resurse / Despre Dr. Ungureanu / Contact | ✅ |
| Header CTA | "Programează o consultație" → /programari | ✅ |
| Header transparency | Forbidden — always `color-surface` | ✅ |
| Footer Column 1 location | Links to /programari/ (not a single clinic address) | ✅ |
| /programari CTA routing | → /contact only (no /programari loop) | ✅ |
