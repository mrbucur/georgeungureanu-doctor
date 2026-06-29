# Prompt 05: Theme Builder Globals

## georgeungureanu.doctor — Header and Footer Implementation Guide

**Visual direction:** B+ — Warm Academic Medicine
**Type:** Elementor Theme Builder (global templates, applied to all pages)
**Output:** Two templates — `organism-site-header` and `organism-site-footer`

**Prerequisites (must be complete before beginning):**
- Prompts 01–04 complete: global CSS active, global colors configured, global typography configured, component library documented
- WordPress site live at domain
- Elementor Pro licensed and active
- Hello Elementor theme active
- WordPress menus configured (see §Navigation menu setup below)

**What this document is:** A complete, section-by-section implementation guide for the two global templates. Build the header first, then the footer. Apply the QA checklist from `docs/implementation/03_ELEMENTOR_QA_RULES.md` to both before marking either complete.

**What this document does not do:** Generate Elementor JSON. Generate code. Both templates are built by hand in Elementor following the instructions in this document.

---

## Patient-Centered Foundation

The header and footer are the only elements that appear on every single page the patient visits. They do more than organize — they calibrate every patient's emotional experience on the site.

**What the header must communicate in under 3 seconds:**
1. "I am in the right place" — the doctor's name and specialty are immediately visible
2. "I know what to do next" — the primary CTA is always visible

**What the footer must communicate:**
1. "I can reach someone if I need to" — contact information is findable without scrolling back up
2. "There is more here if I want it" — navigation and conditions links for deeper exploration
3. "This site is trustworthy and professional" — legal information, medical disclaimer, copyright present

Neither the header nor the footer should surprise, confuse, or require effort from a patient. They are infrastructure — invisible when well-done, frustrating when not.

---

## Part 1 — `organism-site-header`

---

### 1.1 — Structure and Dimensions

```
Full-width outer Flexbox Container
├── Inner Flexbox Container (max-width: 1200px, centered)
│   ├── Logo zone (flex-start)
│   │   └── molecule-logo: doctor name + specialty
│   ├── Navigation zone (flex: 1, center)
│   │   └── 6 × molecule-nav-item
│   └── CTA zone (flex-end, flex-shrink: 0)
│       └── atom-button-primary (small variant)
```

**Outer container:**
- Width: 100% (full viewport)
- Background: Global Color "Surface" (#FDFBF7) — always, at all scroll positions
- Border-bottom: 1px solid Global Color "Border" (#D6CFC4)
- Position: sticky, top: 0, z-index: 100

**Inner container:**
- Max-width: 1200px
- Margin: 0 auto
- Direction: Row (Flexbox)
- Align items: center
- Justify content: space-between
- Padding: 20px top/bottom (space-5), 32px left/right (space-8) — desktop
- Padding mobile: 16px top/bottom (space-4), 20px left/right (space-5)
- Gap between zones: none — handled by justify-content: space-between

**Desktop header height:** 72px (20px padding top + ~32px logo + 20px padding bottom)
**Mobile header height:** 64px

> **Transparent header is explicitly not allowed.** The header background is always `color-surface` (#FDFBF7). No transparency, no opacity fade-in on scroll, no color-shift based on page section. The header is always readable against its own background.

---

### 1.2 — Logo (`molecule-logo`)

The logo is text-only — no image file, no SVG graphic mark. If a graphic mark is commissioned in the future, this section must be revisited before implementation.

**Content:**
- Line 1: "Dr. George Ungureanu"
- Line 2: "Neurochirurg"

**Specifications:**

| Element | Typography | Color | Notes |
|---|---|---|---|
| Line 1 — name | Global "H4 — Card Headline" (Inter 600, 18px) | Global "Ink" | Slightly reduced from H4 if 18px feels large in context |
| Line 2 — specialty | Global "Body Small" (Inter 400, 14px) | Global "Ink Secondary" | Below name, no margin |

**Behavior:**
- The entire logo is a link to `/` (homepage)
- Link wraps both text elements inside a single Flexbox Column container
- No underline on the logo link (CSS class `no-underline` or Elementor link style: none)
- Logo is never an `<img>` element
- On mobile: logo is always visible, never hidden

**Elementor implementation:**
1. Add a Flexbox Container inside the logo zone — Direction: Column, Gap: 4px, Width: auto
2. Add a Text widget → content: "Dr. George Ungureanu" → Typography: Global "H4 — Card Headline" → Color: Global "Ink" → Link: / (add via Elementor link field on the Text widget)
3. Add a second Text widget → content: "Neurochirurg" → Typography: Global "Body Small" → Color: Global "Ink Secondary" → Link: / (same link)
4. Alternatively: use a single Heading widget (H2 tag, styled as H4) for the name and a separate Text widget for the specialty, both inside the logo container. The logo container itself carries the link.
5. Custom ID on logo container: `molecule-logo`

**Accessibility note:** The logo link does not need additional `aria-label` if the visible text is descriptive. Screen readers will announce "Dr. George Ungureanu Neurochirurg" as the link text, which is accurate.

---

### 1.3 — Navigation (`molecule-nav-item` × 6)

**Items (confirmed):**
1. "Acasă" → /
2. "Condiții tratate" → /conditii/
3. "Programări" → /programari/
4. "Resurse" → /resurse/
5. "Despre Dr. Ungureanu" → /despre/
6. "Contact" → /contact/

**Typography:** Global "Navigation" (Inter 500, 15px)
**Color (default):** Global "Ink" (#231E1A)
**Color (hover):** Global "Accent" (#4D7A70), transition 200ms ease
**Color (active/current page):** Global "Accent" (#4D7A70)

**Active state indicator:** A 2px bottom border in Global "Accent" on the active nav item. Implementation: CSS class `nav-item-active` with `border-bottom: 2px solid var(--color-accent)` added to the current-page menu item automatically by WordPress's `current-menu-item` class.

In `custom.css`, add:
```
.organism-site-header .current-menu-item > a {
  color: var(--color-accent);
  border-bottom: 2px solid var(--color-accent);
  padding-bottom: 2px;
}
```

**Spacing between items:** 24px (space-6) gap in the Nav Menu widget settings.
**No dropdown menus.** The navigation is flat — all 6 items are top-level. No sub-menus, no mega-menus, no hover-reveal panels.
**No icons** in the navigation links.

**WordPress menu setup (do this before building the Elementor template):**
1. WordPress admin → Appearance → Menus → Create New Menu → name: "Navegare principală"
2. Add pages in this order: Acasă, Condiții tratate, Programări, Resurse, Despre Dr. Ungureanu, Contact
3. Menu Location: Primary Navigation (if Hello Elementor uses this location)
4. Save menu

**Elementor implementation:**
1. Add Elementor Pro's Nav Menu widget inside the navigation zone
2. Menu: Select "Navigare principală" (the WordPress menu created above)
3. Layout: Horizontal
4. Typography: Global "Navigation"
5. Text color: Global "Ink" (default state)
6. Pointer: Underline → choose "Bottom Border" for the hover/active indicator
7. Pointer color: Global "Accent"
8. Animation: None (no slide, no fade)
9. Align: Center (within the flex zone)
10. Breakpoint for mobile toggle: 768px (or the project's configured tablet breakpoint)
11. Mobile layout: Full-Width (each nav item spans the full drawer width)
12. Mobile toggle button (hamburger): configured in §1.6

---

### 1.4 — Primary CTA Button (small variant)

**Content:** "Programează o consultație"
**Destination:** /programari

This button uses a small variant of `atom-button-primary`. The full-size button (15px/32px padding) is too large for the header. The header uses a compact version.

**Specifications:**
| Property | Value |
|---|---|
| Background | Global "Accent" (#4D7A70) |
| Background (hover) | Global "Accent Hover" (#3A5F57) |
| Text color | Global "Surface" (#FDFBF7) |
| Font | Global "CTA Button" (Inter 600), size reduced to 14px for header context |
| Padding | 10px top/bottom, 20px left/right |
| Border-radius | 6px |
| Hover transition | background 200ms ease |
| Focus ring | `:focus-visible` — `outline: 3px solid var(--color-accent); outline-offset: 3px` (from custom.css) |

**On desktop:** Always visible. Never hidden. This is the primary patient action from any page.

**On mobile (below 768px):** The CTA button text is hidden. The button is re-introduced at full width inside the mobile drawer (see §1.6). At the mobile breakpoint, set the CTA button widget to Hidden via Elementor's responsive display settings.

**Elementor implementation:**
1. Add a Button widget in the CTA zone
2. Text: "Programează o consultație"
3. Link: /programari
4. Set padding, background, text color, border-radius via the Button widget's Style tab
5. Note: Inter 600 at 14px is the standard CTA button style from Global Typography — you can use the Global "CTA Button" style and then reduce the size locally to 14px for the header context only. This is the one permitted local size override in the header.
6. Custom ID: `atom-button-primary-header`
7. Hide at mobile: Advanced → Responsive → Hide on mobile

---

### 1.5 — Sticky Behavior

**Default state (top of page):**
- Background: color-surface
- Border-bottom: 1px solid color-border
- No box-shadow

**Scrolled state (when sticky kicks in):**
- Background: color-surface (unchanged)
- Border-bottom: 1px solid color-border (unchanged)
- Box-shadow added: `0 2px 12px rgba(35, 30, 26, 0.08)`

Elementor adds the class `.elementor-sticky--active` to the sticky container when it becomes stuck. Add to `elementor/custom.css`:

```css
#organism-site-header.elementor-sticky--active {
  box-shadow: 0 2px 12px rgba(35, 30, 26, 0.08);
}
```

**Elementor sticky setup:**
1. Select the outer Flexbox Container
2. Advanced → Motion Effects → Sticky → Top
3. Sticky offset: 0 (sticks to the very top of the viewport)
4. No additional effects — no opacity, no size change, no color change on scroll

**What the sticky header must not do:**
- Change opacity at any point
- Become transparent as the page loads
- Shrink or grow based on scroll position
- Hide and re-appear based on scroll direction (no "smart" hide/show behavior)
- Shift page layout when it sticks (ensure the outer container has a fixed height so content beneath it doesn't jump)

---

### 1.6 — Skip-to-Content Link

This is the first focusable element on every page — it exists for keyboard and screen reader users who want to bypass the navigation and reach the main content directly.

**Implementation:**
The `.skip-to-content` class is already defined in `elementor/custom.css`. It positions the link off-screen by default and reveals it on `:focus`.

```css
/* Already in custom.css — do not duplicate */
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

**In Elementor:**
1. Add a Text Editor widget as the FIRST widget inside the header's inner container (before the logo zone)
2. Content: `<a href="#main-content" class="skip-to-content">Mergi la conținut</a>` (must be entered in HTML view — Elementor Text Editor → switch to HTML mode)
3. The widget renders the link inline; the CSS handles its positioning and visibility
4. Set this widget's container to have z-index: 200 so the revealed link appears above all other header content

**On every page template (homepage and interior):**
Add `id="main-content"` to the first content container below the header. This is the landmark that the skip link targets. In Elementor, this is done via: select the first content section → Advanced → CSS ID → `main-content`.

**Testing the skip-to-content link:**
1. Load any page
2. Press Tab once — the skip link appears in the top-left corner
3. Press Enter — focus jumps to `#main-content`, bypassing all header navigation
4. The header navigation is completely bypassed for keyboard users who want it to be

---

### 1.7 — Mobile Implementation

**Trigger breakpoint:** 768px (Elementor's tablet/mobile breakpoint)

**Mobile header layout:**
```
Full-width container (64px height)
├── Logo (left — always visible)
└── Hamburger icon (right — 44×44px touch target)
    [Navigation and CTA button hidden]
```

**Mobile drawer:**
```
Full-height panel, slides in from the right edge
Width: 100% (full viewport width at mobile — simplest, most accessible)
Background: color-surface (#FDFBF7)
z-index: 200 (above the sticky header at z-index 100)
├── Drawer header (64px, matches main header height)
│   ├── Logo (left — echoes main header)
│   └── Close button "×" (right — 44×44px touch target)
├── Navigation list (stacked vertically, full-width)
│   ├── "Acasă" — full-width, 56px height
│   ├── "Condiții tratate" — full-width, 56px height
│   ├── "Programări" — full-width, 56px height
│   ├── "Resurse" — full-width, 56px height
│   ├── "Despre Dr. Ungureanu" — full-width, 56px height
│   └── "Contact" — full-width, 56px height
├── Divider (color-border)
└── CTA button — "Programează o consultație" — full-width, primary style
```

**Drawer behavior:**
- Opens on hamburger tap
- Closes on close button tap, on backdrop tap, or on Escape key
- When open: focus moves to the first nav item inside the drawer (not the close button)
- Escape key: closes drawer, focus returns to hamburger button
- Backdrop: semi-transparent overlay (`color-overlay`: rgba(35, 30, 26, 0.80)) appears behind the drawer when open

**Typography in mobile drawer:**
- Nav items: Global "Body Large" (Inter 400, 20px) — larger than desktop nav for touch readability
- CTA button: Global "CTA Button" (Inter 600, 15px), full-width

**Elementor Nav Menu widget handles the mobile drawer natively.** Configure in the Nav Menu widget settings:
- Toggle button type: Hamburger (or custom icon via atom-icon SVG)
- Toggle button size: 24px icon, 44px clickable area
- Full-screen / Dropdown mode: choose Dropdown (slide from right)
- Overlay: enable, color: Global "Overlay" at 80% opacity
- Close button: enabled
- Breakpoint: Tablet (768px)

**Additional mobile adjustments:**
1. Hide the standalone CTA button widget at mobile (Advanced → Responsive → Hide on mobile)
2. The Nav Menu widget's mobile CTA appears inside the drawer (configure in Nav Menu widget → Mobile settings → CTA button)
3. Verify the logo is visible and properly sized at 375px

---

### 1.8 — Accessibility Checklist — Header

Complete this checklist before the header is applied to any page.

**Semantic structure:**
```
[ ] The outer header container uses the <header> HTML element — set in Elementor: Advanced → HTML Tag → header
[ ] role="banner" is present on the <header> element (Elementor → Advanced → Custom Attributes → role: banner)
[ ] The Nav Menu widget is wrapped in a <nav> element (default Elementor behavior)
[ ] The <nav> has aria-label="Navigare principală" (set in Nav Menu widget → Accessibility settings or Custom Attributes)
```

**Skip-to-content:**
```
[ ] Skip link is the first focusable element on every page
[ ] Skip link appears on first Tab keypress (visually revealed via :focus)
[ ] Pressing Enter on skip link moves focus to #main-content
[ ] Every page template has id="main-content" on the first content section
```

**Navigation:**
```
[ ] All 6 nav items are keyboard-accessible (Tab → each item in order)
[ ] Active page has aria-current="page" on the current menu item (WordPress automatically adds .current-menu-item; add aria-current via custom CSS or JS if Elementor does not handle it)
[ ] Hover state is visible (color change at 200ms is sufficient)
[ ] Focus ring is visible on all nav items (from custom.css :focus-visible rule)
```

**CTA button:**
```
[ ] Button has descriptive text: "Programează o consultație" (not "Programează", not "Click here")
[ ] Button link destination is confirmed: /programari
[ ] Button focus ring is visible
[ ] Button is keyboard-accessible (Tab to button → Enter or Space activates)
```

**Mobile drawer:**
```
[ ] Hamburger button has aria-label="Deschide meniu" when closed, aria-label="Închide meniu" when open
[ ] Hamburger button has aria-expanded="false" when closed, aria-expanded="true" when open
[ ] When drawer opens, focus moves to the first navigation item inside the drawer
[ ] Escape key closes the drawer and returns focus to the hamburger button
[ ] Focus does not escape the drawer while it is open (focus trap)
[ ] Backdrop close (tap outside drawer) works on touch devices
[ ] Close button (×) inside the drawer has aria-label="Închide meniu"
[ ] All drawer navigation items are keyboard-accessible while the drawer is open
```

**Motion:**
```
[ ] No animations on the header itself
[ ] Drawer open/close may use a brief 200ms ease transition (not suppressed by prefers-reduced-motion since it is user-triggered)
[ ] Scroll shadow on sticky header uses CSS, not JavaScript animation
```

---

### 1.9 — Header Anti-Patterns

| Pattern | Why it fails here | Compliant alternative |
|---|---|---|
| Transparent header that becomes opaque on scroll | Requires contrast verification at every section background — unpredictable and failure-prone | Always `color-surface` — zero maintenance |
| Scroll-hide behavior (header hides when scrolling down, reappears when scrolling up) | Patients navigating a medical site may need to reach the CTA at any moment; hiding the header creates a barrier | Header always visible — sticky |
| Dropdown navigation menus | Adds cognitive load; unreliable on touch devices; obscures the flat site structure | Flat navigation — all 6 items always visible |
| Logo as an image file | Renders poorly at small sizes; requires retina/WebP variants; slower | Text-only logo via molecule-logo |
| "Book now" or "Schedule now" CTA text | Implies commitment before the patient understands their options | "Programează o consultație" — open, not pressuring |
| More than one primary action in the header | Splits patient attention | One primary button only — "Programează o consultație" |
| Mega menus or navigation panels | Overwhelming for a 6-page site; creates accessibility complexity | Flat nav — no sub-menus |
| Animate navigation items | Distracts; fails prefers-reduced-motion | No animations anywhere in the header |
| Hide the header CTA on small desktop or tablet | Patients using 768px–1024px viewports lose access to the primary action | CTA visible at all non-mobile viewport widths |

---

### 1.10 — Elementor Implementation Steps — Header (Complete Sequence)

**Before starting:** Confirm the WordPress navigation menu "Navigare principală" is created with all 6 items in the correct order.

1. Navigate to: Elementor → Templates → Theme Builder → Add New Template → Type: Header → Name: `organism-site-header`
2. Click "Edit in Elementor"

**Building the outer container:**

3. The canvas starts empty. Add a Flexbox Container → set to Full Width
4. Advanced → HTML Tag: `header`
5. Advanced → Custom Attributes: `role` = `banner`
6. Style → Background: Global Color "Surface"
7. Style → Border: Bottom only, 1px, Global Color "Border"
8. Advanced → Motion Effects → Sticky: Top
9. Advanced → CSS ID: `organism-site-header`
10. Advanced → z-index: 100

**Building the inner container:**

11. Inside the outer container, add another Flexbox Container
12. Direction: Row; Align Items: Center; Justify Content: Space Between
13. Style → Width: 1200px; Margin: 0 auto
14. Style → Padding: 20px top, 20px bottom, 32px left, 32px right (desktop)
15. Mobile padding (set at Tablet/Mobile breakpoint): 16px top, 16px bottom, 20px left, 20px right

**Building the skip-to-content link:**

16. Inside the inner container (as the first child), add a Text Editor widget
17. Switch to HTML mode
18. Paste: `<a href="#main-content" class="skip-to-content">Mergi la conținut</a>`
19. Save. In preview mode: Tab once to verify the link appears at the top of the page.
20. Advanced → z-index: 200 on this widget's container

**Building the logo zone:**

21. Add a Flexbox Container inside the inner container (after the skip link widget)
22. Direction: Column; Gap: 4px; Width: auto; flex-shrink: 0
23. Advanced → CSS ID: `molecule-logo`
24. Add Text widget → content: "Dr. George Ungureanu" → Typography: Global "H4 — Card Headline" → Color: Global "Ink"
25. Add Link: / on the Text widget (Elementor → Content → Link field)
26. Add second Text widget → content: "Neurochirurg" → Typography: Global "Body Small" → Color: Global "Ink Secondary"
27. Add Link: / on this widget too
28. Add Custom CSS to the logo container to remove link underlines:
    In `elementor/custom.css` (not per-widget): `#molecule-logo a { text-decoration: none; }`

**Building the navigation zone:**

29. Add the Nav Menu Pro widget (Elementor Pro) after the logo zone
30. Menu: Select "Navigare principală"
31. Layout: Horizontal
32. Align: Center
33. Typography: Global "Navigation" (Inter 500, 15px)
34. Text Color: Global "Ink"
35. Text Color (Hover): Global "Accent"
36. Pointer: Underline → select Bottom Border, 2px, Global "Accent"
37. Pointer animation: None
38. Gap between items: 24px (space-6)
39. Breakpoint: Tablet (768px) — below this, mobile drawer activates
40. Mobile toggle: Hamburger icon → size 24px → touch area 44px
41. Full-screen overlay: enable, color: Global "Overlay" (rgba 35,30,26, 0.80)
42. Dropdown direction: Left (drawer slides from the right edge — set as "Right" origin)
43. Mobile nav item height: 56px
44. Mobile nav typography: Global "Body Large"
45. Mobile CTA: enable → text "Programează o consultație" → link /programari → style: Primary (full-width)

**Building the CTA zone:**

46. Add a Flexbox Container after the Nav Menu widget → Width: auto; flex-shrink: 0
47. Add a Button widget → text: "Programează o consultație" → link: /programari
48. Button style: Background: Global "Accent"; Text: Global "Surface"; Border-radius: 6px
49. Padding: 10px top/bottom, 20px left/right
50. Typography: Global "CTA Button" → size override to 14px (local size only — font family remains Inter via the global style)
51. Hover: Background: Global "Accent Hover"
52. Advanced → Responsive → Hide on Mobile
53. Advanced → CSS ID: `atom-button-primary-header`

**Setting display conditions:**

54. Click the Display Conditions button (top left of Theme Builder)
55. Add condition: Include → Entire Site
56. Publish

**Post-build:**

57. Verify the sticky CSS is in `elementor/custom.css`:
    ```css
    #organism-site-header.elementor-sticky--active {
      box-shadow: 0 2px 12px rgba(35, 30, 26, 0.08);
    }
    .organism-site-header .current-menu-item > a {
      color: var(--color-accent);
      border-bottom: 2px solid var(--color-accent);
      padding-bottom: 2px;
    }
    ```
58. Load any page. Scroll down. Verify shadow appears when the header sticks.
59. Tab once on a fresh page load. Verify skip-to-content link appears.
60. Press Enter on skip-to-content. Verify focus moves to the first section below the header.
61. Resize to 375px. Verify mobile drawer works end-to-end.
62. Apply the accessibility checklist in §1.8 before publishing.

---

## Part 2 — `organism-site-footer`

---

### 2.1 — Structure

The footer has two visual rows:

**Row 1 — Main footer body**
```
Full-width container (background: color-surface-muted)
├── Inner container (max-width: 1200px)
│   ├── Column 1 — Doctor info and contact (30% desktop, 100% mobile)
│   ├── Column 2 — Quick navigation (flex: 1, 100% mobile)
│   ├── Column 3 — Conditions navigation (flex: 1, 100% mobile)
│   └── Column 4 — Schedule and locations (flex: 1, 100% mobile)
```

**Row 2 — Legal strip**
```
Full-width container (background: color-surface-warm)
└── Inner container (max-width: 1200px, centered)
    └── Copyright · Privacy · Cookie policy · Medical disclaimer
```

**Semantics:**
- The entire footer is a `<footer>` HTML element with `role="contentinfo"`
- Navigation columns (2 and 3) are each wrapped in a `<nav>` element with distinct `aria-label`
- Column 4 (schedule) is not a navigation — it uses plain text, not a nav element

---

### 2.2 — Column 1 — Doctor Info and Contact

This is the patient's most direct path to the doctor. It answers: "Who is this? How do I reach them? Where are they?"

**Content:**
```
molecule-logo (text-only — same as header logo)
  "Dr. George Ungureanu"
  "Neurochirurg"

atom-body-sm (practice description — 1 sentence):
  "Neurochirurg specializat în afecțiuni ale creierului, coloanei vertebrale
   și sistemului nervos. Consultații și intervenții în Cluj-Napoca și Baia Mare."
  Color: Global "Ink Secondary"
  [CONFIRM FINAL TEXT WITH DR. UNGUREANU]

molecule-meta (phone):
  Icon: phone (Heroicons outline, 16px, color-accent)
  Text: [PHONE NUMBER — REQUIRED, BLOCKING]
  Link: tel:+40[number]
  Typography: Global "Body Small"
  Color: Global "Ink"

molecule-meta (email):
  Icon: envelope (Heroicons outline, 16px, color-accent)
  Text: [EMAIL ADDRESS — REQUIRED, BLOCKING]
  Link: mailto:[email]
  Typography: Global "Body Small"
  Color: Global "Ink"

molecule-meta (locations link):
  Icon: map-pin (Heroicons outline, 16px, color-accent)
  Text: "Clinici și locații →"
  Link: /programari/
  Typography: Global "Body Small"
  Color: Global "Accent"
  Note: Links to /programari — NOT to a single clinic address. Multiple locations exist.
```

**Social media (conditional):**
Add only if Dr. Ungureanu confirms accounts are officially maintained and actively monitored. Unmonitored accounts listed on a medical website create patient safety risk — patients may send medical questions expecting a response.

If social accounts are confirmed maintained:
- Position: below the locations link, after a 16px gap
- Icons: SVG only (no image files), 20px, color-ink-secondary on default, color-ink on hover
- `aria-label="[Platform name] Dr. George Ungureanu"` on each link
- SVG: `aria-hidden="true"`
- Max 3 platforms (Facebook, LinkedIn, YouTube are the most likely for a Romanian neurosurgeon)
- Open in new tab: `target="_blank" rel="noopener"`

If social accounts are NOT confirmed:
- Omit entirely — do not add social icon placeholders

**Elementor implementation:**
1. Add a Flexbox Container → Direction: Column, Gap: space-5 (20px), Width: 30% desktop / 100% mobile
2. Logo sub-container: Flexbox Column, Gap: 4px, link the text widgets to / as in the header
3. Description: Text widget → Body Small → Ink Secondary
4. Phone: Icon Box widget → phone SVG icon → link tel: → Body Small typography
5. Email: Icon Box widget → email SVG icon → link mailto: → Body Small typography
6. Locations: Icon Box widget → map-pin SVG → link /programari/ → Body Small → Accent color
7. (If social confirmed): add Icon widgets for each platform with correct aria-labels

---

### 2.3 — Column 2 — Quick Navigation

```
atom-label: "PAGINI"
  Style: Global "Overline" (Inter 500, 12px, 2px letter-spacing, uppercase)
  Color: Global "Ink Secondary"
  CSS class: text-overline

Navigation links (6 items — matches confirmed navigation structure):
  "Acasă" → /
  "Condiții tratate" → /conditii/
  "Programări" → /programari/
  "Resurse" → /resurse/
  "Despre Dr. Ungureanu" → /despre/
  "Contact" → /contact/
  Style: Global "Body Small", Global "Ink", no underline by default
  Hover: Global "Accent", underline
  Transition: 200ms ease
```

**Semantic structure:** These links are navigation — wrap them in `<nav aria-label="Footer — pagini principale">`.

**Elementor implementation:**
1. Add a Flexbox Container → Direction: Column, Gap: space-4 (16px), Flex: 1
2. Add Text widget → content: "PAGINI" → CSS class: `text-overline` → Ink Secondary
3. For each link: Text widget with the page name → link to the corresponding URL → Body Small → Ink → hover Accent
4. Wrap the column container: Advanced → HTML Tag: `nav`; Custom Attributes: `aria-label` = "Footer — pagini principale"

**Note on number of links:** All 6 confirmed navigation items appear here. This exceeds the previous "max 4 links per column" rule, which has been superseded by the confirmed 6-item navigation structure.

---

### 2.4 — Column 3 — Conditions Navigation

```
atom-label: "CONDIȚII TRATATE"
  Style: Global "Overline"
  Color: Global "Ink Secondary"

Condition links (top 5 — confirm list with Dr. Ungureanu):
  "Tumori cerebrale" → /conditii/tumori-cerebrale/
  "Hernie de disc" → /conditii/hernie-de-disc/
  "Anevrism cerebral" → /conditii/anevrism-cerebral/
  "Hidrocefalie" → /conditii/hidrocefalie/
  "Nevralgie de trigemen" → /conditii/nevralgie-de-trigemen/

  Style: Global "Body Small", Global "Ink", hover: Global "Accent"

atom-button-ghost:
  "Toate condițiile →"
  Link: /conditii/
  Typography: Global "Body Small", Global "Accent"
  Margin-top: space-3 (12px) — slightly more space above the "all" link
```

**Semantic structure:** Wrap in `<nav aria-label="Footer — condiții tratate">`.

**Elementor implementation:**
1. Add a Flexbox Container → Direction: Column, Gap: space-4 (16px), Flex: 1
2. Text widget → "CONDIȚII TRATATE" → CSS class: `text-overline` → Ink Secondary
3. For each condition: Text widget with condition name → link to condition URL → Body Small → Ink
4. Button widget (ghost style) → "Toate condițiile →" → /conditii/ → Accent color → no background, no border
5. Wrap: Advanced → HTML Tag: `nav`; Custom Attributes: `aria-label` = "Footer — condiții tratate"

**Condition URLs:** These must be published pages before the footer can go live. If any condition page does not yet exist, remove that link from the footer until the page is published. Never link to unpublished pages.

---

### 2.5 — Column 4 — Schedule and Locations

Because Dr. Ungureanu consults at multiple locations with different schedules, the footer cannot show a single authoritative schedule. Column 4 gives the patient a brief orientation and directs them to `/programari/` for the full picture.

```
atom-label: "PROGRAM CONSULTAȚII"
  Style: Global "Overline"
  Color: Global "Ink Secondary"

Schedule summary (atom-body-sm):
  [CONFIRM EXACT CONTENT WITH DR. UNGUREANU]
  Option A (if schedule is consistent across locations):
    "Luni – Vineri, [hours]
     Sâmbătă: [hours or 'Închis']"

  Option B (if schedule varies by location):
    "Programul variază în funcție de locație.
     Consultați pagina Programări pentru detalii."

  Color: Global "Ink"
  Typography: Global "Body Small"
  Line-height: 1.6

atom-button-ghost:
  "Toate locațiile și programul →"
  Link: /programari/
  Typography: Global "Body Small", Global "Accent"
  Margin-top: space-3 (12px)
```

**Recommendation:** Use Option B until exact schedules per location are confirmed with Dr. Ungureanu. A vague correct statement is better than a specific wrong one. The `/programari` page is the single source of truth for schedule information.

**Elementor implementation:**
1. Flexbox Container → Direction: Column, Gap: space-4 (16px), Flex: 1
2. Text widget → "PROGRAM CONSULTAȚII" → text-overline class → Ink Secondary
3. Text widget → schedule content (or Option B text) → Body Small → Ink
4. Button widget (ghost) → "Toate locațiile și programul →" → /programari/ → Accent

---

### 2.6 — Row 2 — Legal Strip

**Purpose:** Legal requirements, medical disclaimer, copyright. Calm and minimal — not a design focal point.

**Background:** Global Color "Surface Warm" (#F4EFE6)
**Border-top:** 1px solid Global Color "Border"
**Padding:** 20px top/bottom (space-5)
**Text color:** Global "Ink Secondary"
**Typography:** Global "Caption" (Inter 400, 13px)

**Content (left to right on desktop, stacked on mobile):**

```
"© [YEAR] Dr. George Ungureanu. Toate drepturile rezervate."
  separator: " · "
"Politică de confidențialitate" → /politica-de-confidentialitate/
  separator: " · "
"Cookie-uri" → /cookies/
  separator: " · "
Medical disclaimer:
"Informațiile de pe acest site au caracter exclusiv informativ și nu constituie
 sfat medical sau recomandare terapeutică. Consultați medicul specialist."
```

**Copyright year:** Should be dynamic (current year). In Elementor, use the Copyright widget if available, or a Text widget with the year manually updated annually. Alternatively, use a shortcode that returns the current year.

**Privacy policy and cookie pages:**
- These pages must exist before the footer goes live
- Their content is legally required under GDPR for a site that collects personal data via the contact form
- `/politica-de-confidentialitate/` and `/cookies/` must be created as WordPress pages
- Content is the responsibility of the practice (not within this implementation scope)
- If these pages do not exist at launch, add placeholder pages with "În curs de redactare" rather than linking to 404s

**Medical disclaimer:**
This is a legal requirement for all medical websites in Romania. The disclaimer must be visible without scrolling in the legal strip. The exact wording should be confirmed by a legal advisor or the practice's own requirements. The placeholder text provided above follows the standard Romanian medical website disclaimer format.

**Elementor implementation:**
1. Add a new full-width Flexbox Container below the main footer body
2. Background: Global Color "Surface Warm"
3. Border-top: 1px, Global Color "Border"
4. Padding: 20px top/bottom
5. Inner container: max-width 1200px, Flexbox Row (desktop) / Column (mobile), gap 24px
6. Text widget → copyright string → Caption typography → Ink Secondary
7. Text widget → "Politică de confidențialitate" → link /politica-de-confidentialitate/ → Caption → Ink Secondary
8. Text widget → "Cookie-uri" → link /cookies/ → Caption → Ink Secondary
9. Text widget → medical disclaimer text → Caption → Ink Secondary
10. On mobile (responsive): stack to column, each item on its own line, centered

---

### 2.7 — Responsive Behavior — Footer

**Desktop (≥ 1024px):** 4-column Row layout with defined widths. Gap: 48px (space-12).

**Tablet (768px–1023px):** 2-column layout — Column 1 + Column 2 in the first row, Column 3 + Column 4 in the second row. Gap: 32px (space-8).

**Mobile (< 768px):** 1-column layout — all 4 columns stacked vertically. Column order:
1. Doctor info and contact (top — most important for a patient who has reached the footer)
2. Quick navigation
3. Conditions navigation
4. Schedule

Padding per column (mobile): 40px top/bottom for the first column, 24px between subsequent columns.

**Legal strip mobile:**
- Stack copyright on one line
- Privacy and cookie links on a second line (separated by " · ")
- Medical disclaimer on its own line
- All centered

---

### 2.8 — Accessibility Checklist — Footer

```
[ ] The outer footer container uses the <footer> HTML element: Advanced → HTML Tag → footer
[ ] role="contentinfo" is present: Custom Attributes → role: contentinfo
[ ] Column 2 nav: <nav aria-label="Footer — pagini principale"> (HTML Tag → nav + Custom Attribute)
[ ] Column 3 nav: <nav aria-label="Footer — condiții tratate"> (HTML Tag → nav + Custom Attribute)
[ ] Column 4 (schedule) is NOT a nav element — plain div/article, not <nav>
[ ] Phone number: tel: link with readable text ("0721 000 000", not "+40721000000")
[ ] Email address: mailto: link with readable text
[ ] Locations link: descriptive text ("Clinici și locații →", not "Click here")
[ ] All condition links: descriptive text (condition name, not "Read more")
[ ] "Toate condițiile →" link: descriptive text
[ ] "Toate locațiile și programul →" link: descriptive text
[ ] Social icon links (if present): aria-label="[Platform] Dr. George Ungureanu"
[ ] Social SVG icons: aria-hidden="true"
[ ] External links (social, Maps): target="_blank" rel="noopener" and visible external indicator
[ ] Privacy policy link: points to a real, published page
[ ] Cookie policy link: points to a real, published page
[ ] Medical disclaimer: visible text (not in a CSS-hidden element)
[ ] Copyright year: correct year
[ ] Column 2 and 3 links: keyboard-accessible (Tab through all links in order)
[ ] Focus rings visible on all links and buttons in the footer
```

---

### 2.9 — Footer Anti-Patterns

| Pattern | Why it fails here | Compliant alternative |
|---|---|---|
| Single clinic address in Column 1 | Multiple locations exist — a single address misleads patients from Baia Mare or other locations | Link to /programari/ — the definitive location hub |
| Newsletter signup form | Medically inappropriate; creates data collection complexity; no clear patient benefit | Omit entirely |
| Social links to inactive accounts | Patients may send medical questions expecting a response; unanswered messages create safety risk | Only add if accounts are confirmed actively monitored |
| "Contact us" as a generic footer CTA | Too vague — patients do not know what happens next | Direct contact: phone number (tel: link) + email (mailto: link) + link to /programari |
| Cookie banner inside the footer | Creates confusion with the system-level cookie consent | Use a dedicated cookie consent plugin (e.g., Complianz, Borlabs) |
| More than 6 links per navigation column | Creates scanning difficulty; patients already have the full nav in the header | Max 6 links per column |
| Promotional content in the footer | Undermines the editorial, calm character of the footer | Footer is information only — no "Book now!" or "Limited appointments" language |
| Testimonials in the footer | Out of context; no space for proper attribution and consent handling | Testimonials live only in organism-patient-testimonials |
| Medical schedule claimed with certainty if it varies | Patients may arrive expecting a doctor who is not there | Use Option B text and redirect to /programari for location-specific schedules |

---

### 2.10 — Elementor Implementation Steps — Footer (Complete Sequence)

**Before starting:** Confirm that the privacy policy page, cookie policy page, and /programari page are all created in WordPress (even as drafts). Confirm the phone number and email address.

1. Navigate to: Elementor → Templates → Theme Builder → Add New Template → Type: Footer → Name: `organism-site-footer`

**Row 1 — Main footer body:**

2. Add a Flexbox Container (full-width) → Advanced → HTML Tag: `footer` → Custom Attributes: `role` = `contentinfo`
3. Style → Background: Global Color "Surface Muted"
4. Style → Border: Top only, 1px, Global Color "Border"
5. Advanced → CSS ID: `organism-site-footer`
6. Inside, add inner container: max-width 1200px, Flexbox Row, Align Items: Flex-Start, Gap: 48px
7. Padding: 64px top/bottom (desktop), 40px (tablet), 40px (mobile)

**Column 1:**

8. Add Flexbox Container → Width: 30%, Direction: Column, Gap: 20px
9. Logo container: Flexbox Column, gap 4px, contains name + specialty text widgets (same as header, both linked to /)
10. Description text widget → Body Small → Ink Secondary
11. Phone Icon Box widget → tel: link → Body Small
12. Email Icon Box widget → mailto: link → Body Small
13. Locations link: Icon Box → "Clinici și locații →" → /programari/ → Body Small → Accent color
14. (Social if confirmed): icon links below locations, aria-labels set

**Column 2:**

15. Add Flexbox Container → Flex: 1, Direction: Column, Gap: 16px
16. Advanced → HTML Tag: `nav`; Custom Attributes: `aria-label` = `Footer — pagini principale`
17. Label text widget → "PAGINI" → text-overline class → Ink Secondary
18. 6 Text widgets → one per nav item → Body Small → Ink → hover Accent → link to correct URL

**Column 3:**

19. Add Flexbox Container → Flex: 1, Direction: Column, Gap: 16px
20. Advanced → HTML Tag: `nav`; Custom Attributes: `aria-label` = `Footer — condiții tratate`
21. Label text widget → "CONDIȚII TRATATE" → text-overline class → Ink Secondary
22. 5 Text widgets → one per condition → Body Small → Ink → link to condition URL
23. Button widget (ghost) → "Toate condițiile →" → /conditii/ → Accent → no background

**Column 4:**

24. Add Flexbox Container → Flex: 1, Direction: Column, Gap: 16px
25. Label text widget → "PROGRAM CONSULTAȚII" → text-overline class → Ink Secondary
26. Schedule text widget → Body Small → Ink (use Option B if schedule unconfirmed)
27. Button widget (ghost) → "Toate locațiile și programul →" → /programari/ → Accent

**Row 2 — Legal strip:**

28. Add a new Flexbox Container (full-width, outside and below Row 1's container)
29. Style → Background: Global Color "Surface Warm"
30. Style → Border: Top only, 1px, Global Color "Border"
31. Padding: 20px top/bottom
32. Inner container: max-width 1200px, Flexbox Row (desktop) / Column (mobile), centered, gap 24px
33. Copyright text widget → "© [YEAR] Dr. George Ungureanu. Toate drepturile rezervate." → Caption → Ink Secondary
34. Privacy link text widget → "Politică de confidențialitate" → link /politica-de-confidentialitate/ → Caption → Ink Secondary
35. Cookie link text widget → "Cookie-uri" → link /cookies/ → Caption → Ink Secondary
36. Disclaimer text widget → full medical disclaimer text → Caption → Ink Secondary
37. Mobile responsive: set inner container to Direction Column at mobile breakpoint

**Display conditions:**

38. Click Display Conditions → Add: Include → Entire Site
39. Publish

---

## Part 3 — Performance Considerations

**Header:**
- The header loads on every page — its weight directly impacts every page's time-to-interactive
- The Nav Menu Pro widget loads Elementor's navigation JS — this is unavoidable but minimal
- No images in the header (text-only logo avoids an image request)
- The sticky CSS uses CSS `position: sticky` — no JavaScript required for sticking behavior
- The mobile drawer: Elementor Nav Menu Pro uses minimal inline JS for the hamburger toggle
- Expected header contribution to page weight: < 20KB (template CSS + minimal JS)

**Footer:**
- The footer is below the fold — defer loading is acceptable for non-critical resources
- No images in the footer (text links and SVG icons only)
- Social SVG icons (if added): inline SVG preferred over `<img>` or background-image for performance + accessibility
- The 4-column layout uses pure Flexbox — no JavaScript required
- Condition links: only link to pages that are published; remove any link if the destination 404s

**Google Fonts:**
- Lora and Inter are loaded once globally (via custom.css @import or Elementor's Google Fonts integration)
- The header and footer do not trigger additional font requests — they use the same fonts already loaded
- Verify in Chrome DevTools → Network → Fonts: only 2 font families should appear

**Shared resources with page templates:**
- Global Colors and Global Typography: loaded once, shared across all templates
- The custom.css file: loaded once, shared across all templates
- No per-template CSS duplication

---

## Part 4 — Launch Checklist

Complete this checklist before the header and footer go live on the site.

### Header Launch Checklist

```
[ ] WordPress navigation menu "Navigare principală" created with 6 items in correct order
[ ] All 6 nav item destinations are published pages (no links to 404 URLs)
[ ] CTA button links to /programari/ — verified by clicking
[ ] Sticky shadow visible when scrolling down any page
[ ] Skip-to-content link appears on first Tab press
[ ] Skip-to-content Enter key moves focus to #main-content on all page templates
[ ] #main-content ID is set on the first content section in all page templates (homepage, interior, contact, /programari)
[ ] Active page indicator: the current page's nav item shows color-accent + 2px bottom border
[ ] Mobile: hamburger visible at 375px
[ ] Mobile: drawer opens and displays all 6 nav items
[ ] Mobile: drawer closes on ×, on backdrop, and on Escape key
[ ] Mobile: CTA button present at the bottom of the mobile drawer
[ ] Mobile: focus trapped in drawer while open
[ ] Display condition: Entire Site (verify on at least 3 different pages)
[ ] Lighthouse accessibility score ≥ 90 on any page with the header
[ ] No horizontal scroll at 375px with the header rendered
```

### Footer Launch Checklist

```
[ ] Phone number confirmed and displays as tel: link (test on mobile — tapping should offer to call)
[ ] Email confirmed and displays as mailto: link (test on desktop — clicking should open email client)
[ ] /programari/ page is live (locations link in Column 1 must not 404)
[ ] /conditii/ page is live (conditions navigation must not 404)
[ ] All 5 condition links in Column 3 point to published condition pages
[ ] "Toate condițiile →" links to /conditii/ — verified
[ ] "Toate locațiile și programul →" links to /programari/ — verified
[ ] All 6 quick navigation links in Column 2 point to published pages
[ ] Privacy policy page is live at /politica-de-confidentialitate/
[ ] Cookie policy page is live at /cookies/ (if tracking is used)
[ ] Copyright year is correct
[ ] Medical disclaimer text is present and visible
[ ] Social links (if added): icons visible, links open correct profiles in new tab, aria-labels set
[ ] Mobile: 4 columns collapse to 1 column in the correct stacking order
[ ] Mobile: legal strip wraps correctly, no content clipped
[ ] Display condition: Entire Site
[ ] Lighthouse accessibility score ≥ 90 on any page with the footer
[ ] Footer does not add more than 50KB to the page weight (excluding fonts already loaded)
```

---

## Part 5 — Open Questions Requiring Dr. Ungureanu's Input

The following questions are blocking or conditional for the header and footer. Items marked **BLOCKING** prevent the footer from going live. Items marked **CONDITIONAL** affect specific footer elements but do not block the overall launch.

| # | Question | Blocks | Where used |
|---|---|---|---|
| Q6a | **BLOCKING — Phone number.** What phone number should appear in the footer and be used for patient contact? | Footer Column 1 (molecule-meta phone) | Footer, /contact page, organism-hero-contact |
| Q6b | **BLOCKING — Email address.** What email address should appear in the footer and be used for patient enquiries? | Footer Column 1 (molecule-meta email) | Footer, /contact page, organism-contact-form |
| Q15 | **BLOCKING — Schedule.** What are the consultation hours? Is the schedule consistent across all locations, or does it vary? If it varies by location, Column 4 uses Option B text (redirect to /programari) — confirm this is acceptable. | Footer Column 4 | Footer |
| Q16 | **CONDITIONAL — Social media.** Does Dr. Ungureanu have social media accounts (Facebook, LinkedIn, YouTube, or other) that are officially maintained and actively monitored for patient messages? If yes: provide the profile URLs. If no: social links are omitted from the footer. | Footer Column 1 (social links) | Footer only |
| Q17 | **BLOCKING (legal) — Privacy policy.** A privacy policy page is legally required under GDPR since the contact form collects personal data. Does a privacy policy document exist, or does one need to be drafted? The implementation links to `/politica-de-confidentialitate/` — this page must be created. | Footer Row 2 (legal strip) | Footer, /contact page |
| Q18 | **CONDITIONAL — Cookie policy and analytics.** Is Google Analytics, Hotjar, or any similar tracking/analytics tool planned for this website? If yes, a cookie consent mechanism and a cookie policy page are legally required. If no, the Cookie-uri link in the legal strip can be omitted. | Footer Row 2 | Footer |
| Q19 | **CONDITIONAL — Logo mark.** Is the logo purely typographic (current spec: "Dr. George Ungureanu" + "Neurochirurg" in Inter) or is a graphic mark/symbol planned? If a graphic mark is designed or commissioned, the logo implementation changes — a graphic mark requires a separate SVG file and different sizing rules. | Header logo, Footer logo | Header, Footer |
| Q20 | **CONDITIONAL — Footer description text.** Confirm or modify the one-sentence practice description for Footer Column 1: "Neurochirurg specializat în afecțiuni ale creierului, coloanei vertebrale și sistemului nervos. Consultații și intervenții în Cluj-Napoca și Baia Mare." | Footer Column 1 | Footer |
| Q21 | **CONDITIONAL — Medical disclaimer wording.** Confirm or modify the medical disclaimer text: "Informațiile de pe acest site au caracter exclusiv informativ și nu constituie sfat medical sau recomandare terapeutică. Consultați medicul specialist." The practice may have a specific legal formulation required by their insurer or professional body. | Footer Row 2 | Footer |
| Q22 | **CONDITIONAL — Conditions for footer Column 3.** Confirm the top 5 conditions to link from the footer navigation. Current placeholder: Tumori cerebrale, Hernie de disc, Anevrism cerebral, Hidrocefalie, Nevralgie de trigemen. The final list should be the 5 most common presenting conditions. | Footer Column 3 | Footer |
