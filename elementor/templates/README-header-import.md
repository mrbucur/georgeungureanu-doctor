# Header Template — Import Instructions

**File:** `header-georgeungureanu.json`
**Template type:** Elementor Theme Builder Header
**Design system:** Direction B+ — Warm Academic Medicine
**Governing spec:** `docs/implementation/04_THEME_BUILDER_GLOBALS.md` §1

---

## Before You Import

Complete these prerequisites or the import will produce an incomplete header.

```
[ ] Stage 1 complete — GU Design System plugin active, custom.css loaded
[ ] Elementor Pro active and licensed (nav-menu widget requires Pro)
[ ] Container (Flexbox) experiment: Active (Elementor → Settings → Experiments)
[ ] WordPress nav menu created (Step 1 below)
```

---

## Step 1 — Create the WordPress Navigation Menu

The nav-menu widget references a WordPress menu by ID. The menu must exist before you assign it to the widget.

**WordPress admin → Appearance → Menus → Create New Menu**

```
Menu name:  Navigare principală
```

Add items in this exact order:

| Label                | URL       |
| -------------------- | --------- |
| Acasă                | /         |
| Afecțiuni            | /conditii |
| Despre Dr. Ungureanu | /despre   |
| Articole             | /resurse  |
| Contact              | /contact  |

```
[ ] Set Menu Location: Primary Navigation (if the Hello Elementor theme supports it)
[ ] Save Menu
[ ] Note the menu ID from the URL bar: ?menu=N — you will need this in Step 4
```

> **Navigation spec discrepancy — read before building:**
> The confirmed navigation spec in `docs/implementation/04_THEME_BUILDER_GLOBALS.md` §1.3 lists **6 items** in a different order:
> Acasă / Condiții tratate / **Programări** / Resurse / Despre Dr. Ungureanu / Contact
> The template JSON was built per the explicit request above (5 items, different labels).
> If the confirmed spec is used instead, add "Programări → /programari" as item 3 in the menu and rebuild accordingly. The nav-menu widget in this template will display whichever menu is assigned to it.

---

## Step 2 — Create the Theme Builder Header Template

The JSON file imports as a page template. It must be placed inside a Theme Builder Header template to appear on every page.

1. **Elementor → Templates → Theme Builder**
2. Click **Add New Template** → choose **Header**
3. Name it: `organism-site-header`
4. Click **Edit in Elementor**
5. In the Elementor editor, click the **folder icon** (Templates) in the left panel
6. Go to **My Templates** tab → click **Import Templates**
7. Upload `header-georgeungureanu.json`
8. The imported template appears in your My Templates list — click **Insert**
9. The header structure loads into the canvas

---

## Step 3 — Assign the Navigation Menu

After import, the nav-menu widget has no menu assigned (it shows "no menu selected" or empty).

1. Click the **Navigation** nav-menu widget in the canvas
2. In the Content tab → **Menu** dropdown → select **Navigare principală**
3. Verify all nav items appear in the canvas preview

---

## Step 4 — Set Display Conditions

The header must appear on every page.

1. Click **Publish** (top right of Theme Builder editor)
2. In the Display Conditions dialog: **+ Add Condition** → **Include** → **Entire Site**
3. **Save & Close**

---

## Step 5 — Add the Sticky Shadow CSS

The sticky shadow appears when the header sticks to the top of the viewport. It is not set in the JSON — it requires one CSS rule.

Add to **Elementor → Site Settings → Custom CSS** (or to `elementor/custom.css` if already loaded via the plugin):

```css
#organism-site-header.elementor-sticky--active {
  box-shadow: 0 2px 12px rgba(35, 30, 26, 0.08);
}
```

Verify: scroll down any page → header sticks → a subtle warm shadow appears under the header.

---

## Step 6 — Add the Logo Link Style

The logo text links to `/`. By default, Elementor heading links show an underline. Remove it:

Add to **Elementor → Site Settings → Custom CSS**:

```css
#molecule-logo a {
  text-decoration: none;
}

#molecule-logo a:hover {
  text-decoration: none;
  opacity: 0.85;
}
```

---

## Step 7 — Add the Active Nav Item Style

The current page's nav item should be highlighted with the accent color.

Add to **Elementor → Site Settings → Custom CSS**:

```css
#organism-site-header .current-menu-item > a,
#organism-site-header .current-page-ancestor > a {
  color: #4d7a70 !important;
  border-bottom: 2px solid #4d7a70;
  padding-bottom: 2px;
}
```

---

## Step 8 — Set #main-content on Every Page Template

The skip-to-content link (`<a href="#main-content">`) targets the first content section on every page. This target must exist.

For each page template, select the **first content section below the header** and set:

- **Advanced → CSS ID:** `main-content`

Pages that require this:

- Homepage (organism-hero-homepage)
- /programari (organism-hero-interior)
- /contact (hero section)
- All other interior page templates

**Test:** Tab once on any page → skip link appears top-left → press Enter → focus jumps past the header to the first content section.

---

## Step 9 — Verify Mobile Behavior

1. Resize browser to 375px (or use Chrome DevTools mobile emulation)
2. Confirm: logo visible left, hamburger icon visible right, CTA button hidden
3. Tap the hamburger → mobile drawer opens with all nav items
4. Nav items are large enough to tap (minimum 56px height)
5. Close button (×) visible → tap closes drawer
6. Tap outside drawer → drawer closes
7. Press Escape → drawer closes

> The mobile CTA ("Programări") is hidden on mobile via the button widget's `hide_mobile: "yes"` setting in the JSON. If this setting does not apply after import, set it manually:
> Select the "Programări" button widget → **Advanced → Responsive → Hide on: Mobile**

---

## Post-Import Checklist

```
[ ] Theme Builder → Header → organism-site-header is published
[ ] Display condition: Entire Site (verified on homepage, /programari, /contact)
[ ] Navigation menu: "Navigare principală" assigned in the nav-menu widget
[ ] All nav links resolve to existing pages (no 404)
[ ] Logo "Dr. George Ungureanu" links to /
[ ] Logo "Neurochirurg" links to /
[ ] CTA "Programări" links to /programari
[ ] Sticky: header sticks to top on scroll
[ ] Sticky shadow CSS added and working
[ ] Logo link CSS added (no underline)
[ ] Active nav item CSS added
[ ] #main-content ID set on all page templates
[ ] Skip-to-content: Tab once → link appears top-left
[ ] Skip-to-content: Enter → focus moves to #main-content
[ ] Desktop: logo left · nav center-right · CTA right ✓
[ ] Mobile (375px): logo left · hamburger right · CTA hidden ✓
[ ] Mobile drawer: all nav items accessible · closes on ×/backdrop/Escape ✓
[ ] No horizontal scroll at 375px
[ ] Lighthouse accessibility ≥ 90 on any page with the header
```

---

## What the JSON Contains

### Container structure

```
Container: outer (#organism-site-header)
  HTML tag: <header>
  Attribute: role="banner"
  Background: #FDFBF7 (Surface)
  Border-bottom: 1px #D6CFC4 (Border)
  Position: sticky top, z-index 100
  CSS class: gu-header-outer

  └── Container: inner
        Width: 1200px, centered in outer
        Flex: row, space-between, align-center
        Padding: 20/32px desktop · 16/24px tablet · 12/16px mobile

        ├── Widget: HTML (skip-to-content link)
        │     <a href="#main-content" class="skip-to-content">Mergi la conținut</a>
        │     Styled by .skip-to-content in gu-design-system.css
        │     First focusable element in DOM

        ├── Container: logo (#molecule-logo)
        │     Flex: column, gap 4px, width auto
        │     ├── Widget: Heading ("Dr. George Ungureanu")
        │     │     Inter 600, 18px, #231E1A (Ink), link: /
        │     └── Widget: Heading ("Neurochirurg")
        │           Inter 400, 14px, #5A4E47 (Ink Secondary), link: /

        └── Container: nav and CTA
              Flex: row, align-center, gap 32px
              ├── Widget: Nav Menu (Navigare principală)
              │     Horizontal layout, 24px item gap
              │     Inter 500, 15px, #231E1A default, #4D7A70 hover/active
              │     Hamburger on mobile, full-width dropdown
              │     Dropdown: #FDFBF7 background, #D6CFC4 border
              │     Mobile item height: 56px, Inter 400 17px
              └── Widget: Button (#atom-button-primary-header)
                    "Programări" → /programari
                    Background: #4D7A70 (Accent), hover: #3A5F57
                    Text: #FDFBF7 (Surface)
                    Inter 600, 14px, padding 10/20px, radius 6px
                    Hidden on mobile (hide_mobile: yes)
```

### Color map — JSON hex → Global Color token

All colors in the JSON are hardcoded hex values. After import, you can optionally replace each with its Elementor Global Color token for automatic updates when the palette changes.

| Hex in JSON | Global Color token      | Elementor label |
| ----------- | ----------------------- | --------------- |
| `#FDFBF7`   | `--color-surface`       | Surface         |
| `#F4EFE6`   | `--color-surface-warm`  | Surface Warm    |
| `#E4EDEB`   | `--color-accent-subtle` | Accent Subtle   |
| `#231E1A`   | `--color-ink`           | Ink             |
| `#5A4E47`   | `--color-ink-secondary` | Ink Secondary   |
| `#4D7A70`   | `--color-accent`        | Accent          |
| `#3A5F57`   | `--color-accent-hover`  | Accent Hover    |
| `#D6CFC4`   | `--color-border`        | Border          |

To replace: click the color swatch in each widget → switch to the **Global** tab → select the matching token. Priority order: outer container background, nav-menu colors, CTA button colors, border colors.

### Typography map — JSON values → Global Typography token

| Widget                | Values in JSON  | Global Typography token          |
| --------------------- | --------------- | -------------------------------- |
| Logo name             | Inter 600, 18px | H4 — Card Headline               |
| Logo subtitle         | Inter 400, 14px | Body Small                       |
| Nav items             | Inter 500, 15px | Navigation                       |
| Mobile dropdown items | Inter 400, 17px | Body                             |
| CTA button            | Inter 600, 14px | CTA Button (14px local override) |

To replace: click the typography control in each widget → select **Global Typography** → choose the matching token. Note: the CTA button uses the Global "CTA Button" token but overrides the size to 14px locally.

---

## Known Limitations of the JSON Import

These settings may not transfer via JSON import and will need to be set manually in the Elementor editor:

| Setting                   | Location in editor                              | Value to set                         |
| ------------------------- | ----------------------------------------------- | ------------------------------------ |
| Outer container HTML tag  | Advanced → HTML Tag                             | `header`                             |
| `role="banner"` attribute | Advanced → Custom Attributes                    | `role` / `banner`                    |
| Nav menu`aria-label`      | Advanced → Custom Attributes on nav-menu widget | `aria-label` / `Navigare principală` |
| Sticky behavior           | Advanced → Motion Effects → Sticky              | Top, offset 0                        |
| CTA button hide on mobile | Advanced → Responsive → Hide on                 | Mobile                               |
| Display conditions        | Theme Builder publish dialog                    | Include → Entire Site                |

If any of these do not apply on import, set them manually before applying display conditions.
