# Footer Template — Import Instructions

**File:** `footer-georgeungureanu.json`
**Template type:** Elementor Theme Builder Footer
**Design system:** Direction B+ — Warm Academic Medicine
**Governing spec:** `docs/implementation/04_THEME_BUILDER_GLOBALS.md` §2

---

## Before You Import

Complete these prerequisites or the import will produce an incomplete footer.

```
[ ] Stage 1 complete — GU Design System plugin active, custom.css loaded
[ ] Header template imported and published (Stage 2 prerequisite)
[ ] Elementor Pro active and licensed
[ ] Container (Flexbox) experiment: Active (Elementor → Settings → Experiments)
[ ] Privacy policy page created at /politica-de-confidentialitate/ (or the link will 404)
[ ] Q15 resolved — phone number confirmed with Dr. Ungureanu (BLOCKING)
[ ] Q16 resolved — email address confirmed with Dr. Ungureanu (BLOCKING)
```

---

## Step 1 — Create the Theme Builder Footer Template

1. **Elementor → Templates → Theme Builder**
2. Click **Add New Template** → choose **Footer**
3. Name it: `organism-site-footer`
4. Click **Edit in Elementor**
5. In the Elementor editor, click the **folder icon** (Templates) in the left panel
6. Go to **My Templates** tab → click **Import Templates**
7. Upload `footer-georgeungureanu.json`
8. The imported template appears in your My Templates list — click **Insert**
9. The footer structure loads into the canvas

---

## Step 2 — Set Display Conditions

The footer must appear on every page.

1. Click **Publish** (top right of Theme Builder editor)
2. In the Display Conditions dialog: **+ Add Condition** → **Include** → **Entire Site**
3. **Save & Close**

---

## Step 3 — Fill in Blocking Placeholder Content

After import, two widgets contain placeholder text that cannot be published live:

### Phone (Column 1, Q15 — BLOCKING)

1. Click the phone HTML widget in Column 1
2. Replace `[TELEFON — confirmat cu Dr. Ungureanu · Q15 BLOCANT]` with the confirmed phone number
3. Update `href="tel:+40000000000"` with the correct international format (e.g., `tel:+40264123456`)

### Email (Column 1, Q16 — BLOCKING)

1. Click the email HTML widget in Column 1
2. Replace `[EMAIL — confirmat cu Dr. Ungureanu · Q16 BLOCANT]` with the confirmed email address
3. Update `href="mailto:contact@georgeungureanu.doctor"` with the confirmed address

---

## Step 4 — Handle the Cookie Policy Link (Conditional, Q21)

The legal strip includes a **Cookie-uri** link to `/cookies/`. This link should only appear if the site uses a separate cookie policy page.

**If a cookie policy page exists at /cookies/:** Leave the widget as-is.

**If cookie consent is handled by plugin (e.g., Complianz, CookieYes):** The plugin typically inserts its own footer link. In this case, delete the Cookie Policy heading widget from the legal strip inner container to avoid duplication.

**If no cookie policy is needed:** Delete the Cookie Policy heading widget.

---

## Step 5 — Add Footer Link Hover CSS

Nav links in Column 2 and Column 3 default to Ink color (`#231E1A`). Hover states require CSS.

Add to **Elementor → Site Settings → Custom CSS**:

```css
/* Footer nav link hover */
#organism-site-footer .elementor-widget-heading a {
  color: var(--color-ink);
  text-decoration: none;
}

#organism-site-footer .elementor-widget-heading a:hover {
  color: var(--color-accent);
  text-decoration: underline;
  text-underline-offset: 3px;
}

/* Footer logo links — no underline */
#molecule-logo-footer a {
  text-decoration: none;
}

#molecule-logo-footer a:hover {
  text-decoration: none;
  opacity: 0.85;
}
```

---

## Step 6 — Add Phone and Email Icon Classes (Optional)

The phone and email widgets are implemented as plain HTML widgets. If you want to add SVG icons (16px, accent color) before each link:

1. Click the phone HTML widget → switch to **HTML** source mode
2. Wrap the content in your preferred icon structure, e.g.:

```html
<p
  style="font-family: Inter, sans-serif; font-size: 15px; line-height: 1.65; color: #231E1A; margin: 0; display: flex; align-items: center; gap: 8px;"
>
  <svg
    width="16"
    height="16"
    viewBox="0 0 24 24"
    fill="none"
    stroke="#4D7A70"
    stroke-width="2"
    stroke-linecap="round"
    stroke-linejoin="round"
    aria-hidden="true"
  >
    <path
      d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.8a19.79 19.79 0 01-3.07-8.64A2 2 0 012 .82h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.91 8.2a16 16 0 006.29 6.29l1.75-1.75a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7a2 2 0 011.72 2.03z"
    />
  </svg>
  <a href="tel:+40264000000" style="color: #4D7A70; text-decoration: none;"
    >+40 264 000 000</a
  >
</p>
```

3. Repeat for the email widget with an envelope SVG icon.

---

## Step 7 — Update Copyright Year

The template uses `© 2026`. Update annually or replace with dynamic text via a shortcode:

```
© [year] Dr. George Ungureanu. Toate drepturile rezervate.
```

If using a year shortcode plugin, replace the static `2026` in the copyright text-editor widget.

---

## Step 8 — Verify Responsive Behavior

### Desktop (≥ 1024px)

1. Confirm 4-column layout: Doctor info · Pages · Conditions · Schedule
2. Column 1 approximately 28% width, others distributing equally
3. All nav links visible with 14px gap between items

### Tablet (768–1023px)

The JSON sets `flex_wrap: "wrap"` on tablet breakpoint with column widths at 46%. Verify:

- 2×2 grid: Columns 1+2 on row 1, Columns 3+4 on row 2
- If the layout is not 2×2, select the Row 1 inner container → **Responsive → Tablet** → adjust Wrap to Wrap, and set each column width to 46%

### Mobile (< 768px)

1. Confirm 1-column stack: Col 1 → Col 2 → Col 3 → Col 4
2. Legal strip wraps to multiple lines if needed
3. No horizontal scroll at 375px

---

## Post-Import Checklist

```
[ ] Theme Builder → Footer → organism-site-footer is published
[ ] Display condition: Entire Site (verified on homepage, /programari, /contact)
[ ] Phone placeholder replaced with confirmed number (Q15)
[ ] Email placeholder replaced with confirmed address (Q16)
[ ] Cookie policy link: present / removed (Q21 decision made)
[ ] Medical disclaimer wording confirmed with Dr. Ungureanu (Q23)
[ ] Privacy policy page exists at /politica-de-confidentialitate/
[ ] Logo "Dr. George Ungureanu" links to /
[ ] Logo "Neurochirurg" links to /
[ ] All Column 2 nav links resolve (no 404)
[ ] All Column 3 condition links resolve (no 404) — pages may be stubs at launch
[ ] "Toate condițiile →" → /conditii/ resolves
[ ] "Toate locațiile și programul →" → /programari/ resolves
[ ] "Clinici și locații →" → /programari/ resolves
[ ] Footer link hover CSS added to Elementor Site Settings
[ ] Footer logo CSS added (no underline)
[ ] Desktop: 4-column layout ✓
[ ] Tablet: 2×2 grid layout ✓
[ ] Mobile: 1-column stack ✓
[ ] Legal strip: copyright · privacy · (cookie) · disclaimer visible ✓
[ ] No horizontal scroll at 375px
```

---

## What the JSON Contains

### Container structure

```
Container: Row 1 — Footer body (a0000001)
  HTML tag: <footer>
  Attribute: role="contentinfo"
  CSS ID: organism-site-footer
  Background: #EDE8DF (Surface Muted)
  Border-top: 1px #D6CFC4 (Border)

  └── Container: Row 1 inner (a0000002)
        Width: 1200px, centered
        Flex: row → column (mobile), gap 48px/32px/24px
        Padding: 64px desktop · 40px tablet/mobile

        ├── Container: Column 1 — Doctor Info (a0000003)
        │   Width: ~28%, Column, gap 20px
        │   ├── Container: Logo (a0000004, #molecule-logo-footer)
        │   │   ├── Heading: "Dr. George Ungureanu" — Inter 600, 18px, #231E1A, link /
        │   │   └── Heading: "Neurochirurg" — Inter 400, 14px, #5A4E47, link /
        │   ├── Text-editor: Practice description — Inter 400, 15px, #5A4E47
        │   ├── HTML widget: Phone link (tel:) — PLACEHOLDER Q15
        │   ├── HTML widget: Email link (mailto:) — PLACEHOLDER Q16
        │   └── Heading: "Clinici și locații →" — Inter 500, 15px, #4D7A70, link /programari/

        ├── Container: Column 2 — Pages Nav (a000000b)
        │   HTML tag: <nav aria-label="Footer — pagini principale">
        │   Flex: column, gap 14px
        │   ├── Heading: "PAGINI" — overline style, #5A4E47
        │   ├── Heading: "Acasă" — Inter 400, 15px, #231E1A, link /
        │   ├── Heading: "Condiții tratate" — link /conditii/
        │   ├── Heading: "Programări" — link /programari/
        │   ├── Heading: "Resurse" — link /resurse/
        │   ├── Heading: "Despre Dr. Ungureanu" — link /despre/
        │   └── Heading: "Contact" — link /contact/

        ├── Container: Column 3 — Conditions Nav (a0000013)
        │   HTML tag: <nav aria-label="Footer — condiții tratate">
        │   Flex: column, gap 14px
        │   ├── Heading: "CONDIȚII TRATATE" — overline style, #5A4E47
        │   ├── Heading: "Tumori cerebrale" — link /conditii/tumori-cerebrale/
        │   ├── Heading: "Hernie de disc" — link /conditii/hernie-de-disc/
        │   ├── Heading: "Anevrism cerebral" — link /conditii/anevrism-cerebral/
        │   ├── Heading: "Hidrocefalie" — link /conditii/hidrocefalie/
        │   ├── Heading: "Nevralgie de trigemen" — link /conditii/nevralgie-de-trigemen/
        │   └── Button (ghost): "Toate condițiile →" — #4D7A70, link /conditii/

        └── Container: Column 4 — Schedule (a000001b)
            HTML tag: <div> (NOT nav — no landmark semantics)
            Flex: column, gap 14px
            ├── Heading: "PROGRAM CONSULTAȚII" — overline style, #5A4E47
            ├── Text-editor: Schedule Option B — Inter 400, 15px, #231E1A
            └── Button (ghost): "Toate locațiile și programul →" — #4D7A70, link /programari/

Container: Row 2 — Legal strip (a000001f)
  CSS ID: organism-site-footer-legal
  Background: #F4EFE6 (Surface Warm)
  Border-top: 1px #D6CFC4 (Border)

  └── Container: Legal strip inner (a0000020)
        Width: 1200px, centered
        Flex: row → column (mobile), wrap, gap 24px/8px
        Padding: 20px all breakpoints

        ├── Text-editor: "© 2026 Dr. George Ungureanu..." — Inter 400, 13px, #5A4E47
        ├── Heading: "Politică de confidențialitate" — Inter 400, 13px, link /politica-de-confidentialitate/
        ├── Heading: "Cookie-uri" — Inter 400, 13px, link /cookies/ [CONDITIONAL Q21]
        └── Text-editor: Medical disclaimer — Inter 400, 13px, #5A4E47
```

---

## Color Map — JSON Hex → Global Color Token

All colors in the JSON are hardcoded hex values. After import, optionally replace each with its Global Color token.

| Hex in JSON | Global Color token      | Elementor label |
| ----------- | ----------------------- | --------------- |
| `#EDE8DF`   | `--color-surface-muted` | Surface Muted   |
| `#F4EFE6`   | `--color-surface-warm`  | Surface Warm    |
| `#FDFBF7`   | `--color-surface`       | Surface         |
| `#231E1A`   | `--color-ink`           | Ink             |
| `#5A4E47`   | `--color-ink-secondary` | Ink Secondary   |
| `#4D7A70`   | `--color-accent`        | Accent          |
| `#D6CFC4`   | `--color-border`        | Border          |

---

## Known Limitations of the JSON Import

These settings may not transfer via JSON import and will need to be set manually in the Elementor editor:

| Setting                   | Location in editor           | Value to set                                |
| ------------------------- | ---------------------------- | ------------------------------------------- |
| Row 1 HTML tag            | Advanced → HTML Tag          | `footer`                                    |
| `role="contentinfo"` attr | Advanced → Custom Attributes | `role` / `contentinfo`                      |
| Column 2 HTML tag         | Advanced → HTML Tag          | `nav`                                       |
| Column 2`aria-label` attr | Advanced → Custom Attributes | `aria-label` / `Footer — pagini principale` |
| Column 3 HTML tag         | Advanced → HTML Tag          | `nav`                                       |
| Column 3`aria-label` attr | Advanced → Custom Attributes | `aria-label` / `Footer — condiții tratate`  |
| Column 4 HTML tag         | Advanced → HTML Tag          | `div` (explicitly — do not set nav)         |
| Display conditions        | Theme Builder publish dialog | Include → Entire Site                       |

---

## Schedule Content — Options

Column 4 is set to **Option B** (generic, recommended for launch). If Dr. Ungureanu confirms consistent hours across all locations, replace the text-editor content with Option A:

**Option A (consistent schedule — requires Q17 answer):**

```
Luni – Vineri: 09:00 – 17:00
Sâmbătă: 09:00 – 13:00
```

**Option B (variable by location — default in template):**

```
Programul variază în funcție de locație. Consultați pagina Programări pentru detalii.
```

To update: click the Schedule text-editor widget in Column 4 → replace the paragraph content.
