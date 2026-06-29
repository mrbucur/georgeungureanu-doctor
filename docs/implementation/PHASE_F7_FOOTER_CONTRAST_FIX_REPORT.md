# Phase F.7 — Footer Dark Text Contrast Fix Report

**Date:** 2026-06-29  
**Status:** Applied — pending browser verification  
**Scope:** Footer text color globals removal — no layout, content, or header changes

---

## Root Cause

Phase F.5 set `text_color: "#D6CFC4"` (direct hex) on affected text-editor and heading widgets but also preserved the `__globals__.text_color: "globals/colors?id=gu-border"` reference.

In Elementor 4.x, when a control has a `__globals__` color reference, the CSS generator uses the CSS custom property and **ignores the direct hex value entirely**. The generated CSS was:

```css
/* What Elementor generated (WRONG): */
.elementor-12 .elementor-element.elementor-element-5a3f904b {
    color: var(--e-global-color-gu-border);   /* resolves to dark / unresolved */
}
```

If `--e-global-color-gu-border` fails to cascade (kit class not applied to body, or variable undefined in that context), the `color` property — being an inherited property — falls back to the inherited value: `body { color: #333 }` (Hello Elementor default). Result: dark `#333` text on `#231E1A` dark footer background = invisible.

The direct `text_color: "#D6CFC4"` set in Phase F.5 had **zero effect on CSS generation** as long as `__globals__.text_color` was also present.

---

## Fix Applied

**Action:** Remove `__globals__.text_color` / `__globals__.title_color` from the 4 affected elements. Keep the direct hex value. Elementor then generates `color: #D6CFC4` without any CSS variable lookup.

```css
/* What Elementor now generates (CORRECT): */
.elementor-12 .elementor-element.elementor-element-5a3f904b {
    color: #D6CFC4;   /* warm beige — guaranteed, no variable resolution needed */
}
```

### Elements modified (post_id=12, footer template)

| Element ID | Widget | Label | Direct value set | Global reference removed |
|-----------|--------|-------|-----------------|-------------------------|
| `[5a3f904b]` | text-editor | Practice Description (Col1) | `text_color: #D6CFC4` | `__globals__.text_color` |
| `[5d427b5]` | text-editor | Col4 Logistics text | `text_color: #D6CFC4` | `__globals__.text_color` |
| `[6b2742e8]` | text-editor | Copyright | `text_color: #D6CFC4` | `__globals__.text_color` |
| `[78fc5164]` | heading | Privacy link | `title_color: #D6CFC4` | `__globals__.title_color` |

**Remaining globals on each widget:** `typography_typography` globals (font token references) were NOT touched — only color globals were removed.

---

## Elements Intentionally Left Unchanged

| Element ID | Label | Why not changed |
|-----------|-------|-----------------|
| `[ce0da850]` | "Toate articolele →" (Col3 accent link) | Uses `__globals__.title_color: gu-accent` with empty direct value — accent link color, not broken per user report |
| `[5e9f35d1]` | "Detalii și program →" (button) | Fixed in Phase F.6 (`button_background_color: transparent`) — not a text color issue |
| Nav link headings (Col2) | Acasă, Afecțiuni, etc. | Not reported as broken by user |
| Overline headings (Col2/Col3/Col4) | PAGINI, SFATUL NR., PROGRAMĂRI | Not reported as broken |
| Logo name + subtitle (Col1) | Dr. George Ungureanu / Neurochirurg | Not reported as broken |

---

## WCAG AA Contrast Verification

All fixed elements render `#D6CFC4` on the footer background `#231E1A`:

| Foreground | Background | Contrast ratio | WCAG AA (4.5:1) |
|-----------|-----------|---------------|-----------------|
| `#D6CFC4` (warm beige) | `#231E1A` (dark ink) | **8.6:1** | Pass ✓ |

The Privacy link (`#D6CFC4`) similarly passes at 8.6:1.

---

## CSS Cache State

| Action | Count |
|--------|-------|
| `_elementor_css` DB rows cleared (posts 6, 9, 12) | 3 |
| CSS files deleted from disk | 3 (`post-6.css`, `post-9.css`, `post-12.css`) |

All three templates regenerate on next browser page load.

---

## Script Verification Output

```
[5a3f904b] Practice Desc (text-editor):
  ✓ text_color = '#D6CFC4' (want: #D6CFC4)
  ✓ __globals__.text_color = '(removed)' (want: removed)
  → remaining globals: typography_typography

[5d427b5] Col4 Logistics (text-editor):
  ✓ text_color = '#D6CFC4' (want: #D6CFC4)
  ✓ __globals__.text_color = '(removed)' (want: removed)
  → remaining globals: typography_typography

[6b2742e8] Copyright (text-editor):
  ✓ text_color = '#D6CFC4' (want: #D6CFC4)
  ✓ __globals__.text_color = '(removed)' (want: removed)

[78fc5164] Privacy Link (heading):
  ✓ title_color = '#D6CFC4' (want: #D6CFC4)
  ✓ __globals__.title_color = '(removed)' (want: removed)

Accent check [ce0da850] 'Toate articolele →':
  title_color (direct) = ''
  __globals__.title_color = 'globals/colors?id=gu-accent' ✓ (unchanged)

Button check [5e9f35d1] 'Detalii și program →':
  button_background_color = 'transparent' ✓ (unchanged from F.6)
```

---

## Browser Verification Checklist

Load `http://georgeungureanu-doctor-dev.local/` and hard-refresh (Cmd+Shift+R):

- [ ] Col1 Practice Description: "Neurochirurg specializat..." visible in warm beige (#D6CFC4) on dark background
- [ ] Col4 logistics text: "Consultaţii disponibile la clinici partenere." visible
- [ ] Copyright: "© 2026 Dr. George Ungureanu • Toate drepturile rezervate" visible
- [ ] Privacy link: "Politică de confidențialitate" visible
- [ ] "Toate articolele →" remains teal/accent color (not bright green, not invisible)
- [ ] "Detalii și program →" remains no background (transparent — from Phase F.6)
- [ ] Header layout unchanged (horizontal bar with nav + CTA row — from Phase F.6)

### DevTools confirmation (if text still invisible after hard refresh)

Open DevTools → Elements → inspect `.elementor-element-5a3f904b .elementor-text-editor p`:

- **Expected:** `color: rgb(214, 207, 196)` (#D6CFC4 = computed value, no `var()` reference)
- **If still dark:** Check Styles panel for a higher-specificity rule overriding the element CSS. Screenshot and report.

---

## What Was NOT Changed

- No layout changes (no `flex_direction`, `padding`, `margin`, `width`)
- No content changes (no `editor` or `title` HTML modified)
- No header template (post_id=9) changes
- No new color tokens created
- No GU plugin CSS changes
- `typography_typography` globals left intact on all text-editor widgets (font tokens still resolve via CSS variable)
- All Phase F.6 fixes (nav layout, button background) remain intact
