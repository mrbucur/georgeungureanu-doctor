# Phase F.8 — Footer Invisible Text: Computed CSS Debug Report

**Date:** 2026-06-29  
**Status:** Fix applied — pending browser verification  
**Scope:** Diagnostic + targeted CSS override in `gu-design-system.css` — no Elementor data changes

---

## Problem Statement

Footer paragraph text (Practice Description, Col4 logistics, Copyright) remains invisible even when colors are manually changed in the Elementor editor panel. This proved the issue was not the widget color setting but something overriding it externally.

---

## Investigation

### Step 1 — CSS Files on Disk

```
uploads/elementor/css/post-6.css   ✓ (5,233 bytes — kit CSS variables)
uploads/elementor/css/post-9.css   ✓ (10,539 bytes — header template CSS)
uploads/elementor/css/post-12.css  ✗ MISSING
```

Post-12.css did not regenerate after Phase F.7's cache clear (DB meta was cleared, CSS print method = `external`, post_status = `publish`). Without post-12.css, Elementor falls back to printing the footer template's CSS inline (via `<style>` tags in `<head>`). The footer **dark background** (`#231E1A`) is therefore still applied, just as inline CSS rather than external file.

### Step 2 — DOM Structure and Custom IDs

From `_elementor_data` (post_id=12):

| Element | Custom ID (`_element_id`) | Description |
|---------|--------------------------|-------------|
| `[58c43bf7]` | `organism-site-footer` | Footer outer container |
| `[5925a9fc]` | `organism-site-footer-legal` | Legal strip container |
| `[5a3f904b]` | — | Practice Description (text-editor) |
| `[5d427b5]` | — | Col4 logistics text (text-editor) |
| `[6b2742e8]` | — | Copyright (text-editor) |
| `[78fc5164]` | — | Privacy link (heading) |

No `_css_classes` set on any footer container — the `.section-dark` utility class is **not** applied anywhere in the footer.

### Step 3 — CSS Cascade Analysis for Footer `<p>` Elements

A text-editor widget renders as:
```html
<div class="elementor-widget elementor-widget-text-editor elementor-element-5a3f904b">
  <div class="elementor-widget-container">
    <div class="elementor-text-editor">
      <p>Neurochirurg specializat...</p>  ← the visible content
    </div>
  </div>
</div>
```

**Rules affecting the `<p>` element (ordered by how they apply):**

| Source | Rule | Specificity | Applies to | Effect on `<p>` |
|--------|------|-------------|-----------|-----------------|
| Hello Elementor reset.css | `body { color: #333 }` | 0,0,1 | `<body>` | Inherited by `<p>` |
| `gu-design-system.css §03` | `body { color: var(--color-ink) = #231E1A }` | 0,0,1 | `<body>` | Inherited by `<p>` |
| **`gu-design-system.css §07`** | **`p { color: var(--color-ink) = #231E1A }`** | **0,0,1** | **`<p>` directly** | **WINS — explicit** |
| Elementor global CSS | `.elementor-widget-text-editor { color: var(--e-global-color-text) }` | 0,1,0 | widget container | Inherited by `<p>` |
| Elementor post-12.css / inline | `.elementor-element-5a3f904b { color: #D6CFC4 }` | 0,1,0 | widget container | Inherited by `<p>` |

**Key CSS principle:** An **explicit** rule on an element (even specificity `0,0,1`) always defeats an **inherited** value from a parent (even specificity `0,3,0`). Inheritance is not a cascade win — it is the fallback after all explicit rules are exhausted.

**Result:** `color: #231E1A` (#231E1A = `var(--color-ink)` from `§07`) wins on every `<p>` inside the footer. The footer background is also `#231E1A` (from Elementor inline CSS). Dark on dark = **invisible**.

### Step 4 — Why Manual Elementor Changes Do Not Help

When a color is changed in Elementor's editor panel for a text-editor widget, Elementor updates the widget **container's** `color` property — not `<p>` directly. This changes what `<p>` would inherit, but the `gu-design-system.css §07` rule `p { color: var(--color-ink) }` is explicit and always wins over any inherited value. No amount of container color changes can override an explicit `p {}` rule without targeting `<p>` directly.

### Step 5 — Why Heading Nav Links Are Visible

Elementor heading widgets target `.elementor-heading-title` directly in their generated CSS:
```css
.elementor-12 .elementor-element.elementor-element-27495d8d .elementor-heading-title {
  color: var(--e-global-color-gu-surface);   /* specificity 0,4,0 */
}
```
vs GU plugin:
```css
h1, h2, h3, h4, h5, h6 { color: var(--color-ink); }   /* specificity 0,0,1 */
```
`0,4,0` beats `0,0,1` → Elementor wins for headings. Text-editor widgets don't get this treatment.

---

## Root Cause

**`gu-design-system.css §07` — line 317:**
```css
p {
  color: var(--color-ink);   /* = #231E1A, specificity 0,0,1 — explicit on <p> */
}
```

This rule explicitly overrides the `color` property on every `<p>` element on the site. Elementor's text-editor CSS only affects the widget container (`<div>`). `<p>` inherits from the container but is then explicitly overridden to `#231E1A` by this rule. Since the footer background is also `#231E1A`, the text is invisible.

---

## Fix Applied

Added **§18** to `gu-design-system.css` (before the print section) targeting `<p>` elements directly within the footer's text-editor widgets, scoped to `#organism-site-footer`:

**File:** `wp-content/plugins/gu-design-system/assets/css/gu-design-system.css`  
**Lines inserted:** ~660–685

```css
/* ------------------------------------------------------------
   18. FOOTER DARK AREA — PARAGRAPH TEXT OVERRIDE
   ...
   ------------------------------------------------------------ */

#organism-site-footer .gu-footer-muted,
#organism-site-footer .elementor-widget-text-editor,
#organism-site-footer .elementor-widget-text-editor p {
  color: #D6CFC4 !important;
  opacity: 1 !important;
  visibility: visible !important;
}
```

**Specificity of the new `<p>` rule:** `1,1,1` (1 ID + 1 class + 1 type)  
**vs the GU plugin `p {}` rule:** `0,0,1`  
`1,1,1` beats `0,0,1` even without `!important`. The `!important` is added as a belt-and-suspenders safeguard and matches the pattern already used in `§08` (reduced-motion overrides).

**WCAG AA verification:**

| Foreground | Background | Contrast | WCAG AA |
|-----------|-----------|----------|---------|
| `#D6CFC4` | `#231E1A` | 8.6:1 | Pass ✓ |

**Elements covered by the new rule:**

| Element ID | Label | Inside `#organism-site-footer`? | Covered |
|-----------|-------|--------------------------------|---------|
| `[5a3f904b]` | Practice Description | Yes | ✓ |
| `[5d427b5]` | Col4 Logistics text | Yes | ✓ |
| `[6b2742e8]` | Copyright | Yes (via `#organism-site-footer-legal`) | ✓ |

---

## Elements NOT Covered by This Fix

| Element | Widget | Why not covered | Observed state |
|---------|--------|-----------------|---------------|
| `[78fc5164]` Privacy link | heading | Heading widget — renders as `.elementor-heading-title > <a>`, not `<p>` | Visible as teal (`#4D7A70`) via `a { color: var(--color-accent) }` from §04. Contrast ~3.7:1 — low but visible. |
| Nav links Col2 | heading | Heading + link — teal from `a {}` | Visible |
| Logo name `[511e1807]` | heading | Elementor targets `.elementor-heading-title` directly | Visible via Elementor CSS specificity |

The privacy link's teal-on-dark rendering (3.7:1) is below WCAG AA 4.5:1 for normal text. This is a known gap and can be addressed in a follow-up if needed with a targeted `#organism-site-footer-legal .elementor-heading-title a { color: #D6CFC4 !important }` rule.

---

## Why Post-12.css Is Not Regenerating

- DB cache (`_elementor_css` for post_id=12): cleared — no row
- Post status: `publish`, type `elementor_library`
- CSS print method: `external` (default)
- File permissions: OK (post-6.css and post-9.css both wrote successfully)
- Likely cause: Elementor may be writing the inline CSS fallback first and then short-circuiting the file write, OR the footer template CSS generation is not triggered during the tested page load sequence in LocalWP.

**Impact of missing post-12.css:** The footer still renders correctly because Elementor falls back to inline `<style>` CSS with identical rules. The Phase F.8 fix in `gu-design-system.css` is independent of post-12.css — it applies via the plugin CSS which always loads.

To force post-12.css regeneration: WordPress admin → Elementor → Tools → **Regenerate Files & Data**.

---

## Browser Verification Checklist

Load `http://georgeungureanu-doctor-dev.local/` and hard-refresh (Cmd+Shift+R). No cache clear needed — `gu-design-system.css` is a plugin static file that loads on every page view.

- [ ] Practice Description (Col1): "Neurochirurg specializat în tratamentul afecțiunilor..." visible in warm gray (#D6CFC4) on dark background
- [ ] Col4 Logistics text: "Consultaţii disponibile la clinici partenere." visible
- [ ] Copyright: "© 2026 Dr. George Ungureanu • Toate drepturile rezervate" visible
- [ ] Privacy link: visible (teal or warm gray — see remaining gap above)
- [ ] No white/cream text artifacts on light-background sections of the page
- [ ] Header unchanged (no side effects)
- [ ] Accent links ("Toate articolele →", "Detalii și program →") unchanged

### DevTools confirmation

Open DevTools → Elements → select a `<p>` inside `.elementor-element-5a3f904b`:
- Styles panel should show `#organism-site-footer .elementor-widget-text-editor p` rule from `gu-design-system.css` with `color: #D6CFC4 !important`
- The §07 rule `p { color: var(--color-ink) }` should be visible but struck through (overridden by `!important`)
- Computed `color` should be `rgb(214, 207, 196)` = `#D6CFC4`

---

## What Was NOT Changed

- No Elementor template data modified
- No layout changes
- No content changes
- Header template (post_id=9) not touched
- No new color tokens created
- No existing CSS rules modified — only one new section (§18) added to `gu-design-system.css`
- All Phase F.5, F.6, F.7 changes remain intact
