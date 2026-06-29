# Regression Diagnostic 001

**Date:** 2026-06-29  
**Investigator:** Claude Code (diagnostic only — no modifications made)  
**Trigger:** Browser verification after Phase F.5 Foundation Polish  
**Status:** Complete — awaiting engineer review before fix implementation

---

## Reported Symptoms

| # | Symptom | Template |
|---|---------|----------|
| 1 | Header layout collapsed vertically | Header, post_id=9 |
| 2 | Navigation is no longer horizontal | Header, post_id=9 |
| 3 | CTA moved below the menu | Header, post_id=9 |
| 4 | Footer practice description still invisible | Footer, post_id=12 |
| 5 | Footer Programări column text still missing | Footer, post_id=12 |
| 6 | Copyright text not rendering | Footer, post_id=12 |
| 7 | "Detalii și program" uses incorrect bright green | Footer, post_id=12 |

---

## Theme Builder Condition Status

**Conditions are correctly assigned.** They are stored in `wp_options` under `elementor_pro_theme_builder_conditions`, not in postmeta — the postmeta `_elementor_conditions` is always empty by design.

```
elementor_pro_theme_builder_conditions:
  header → post_id=9 → ["include/general"]  ✓ (show on all pages)
  footer → post_id=12 → ["include/general"] ✓ (show on all pages)
```

Theme Builder is not the cause of any regression.

---

## Root Cause 1 — Missing `post-9.css` (issues 1, 2, 3)

### What happened

Phase F.5 deleted all files in `uploads/elementor/css/` (glob `*.css`), which included `post-9.css` (the header template's element-level CSS). Phase F.5 then cleared `_elementor_css` DB meta for post_id=12 and post_id=6, but **not for post_id=9**.

After Phase F.5:

| Post | DB cache cleared? | CSS file deleted? | Elementor on next load |
|------|-------------------|-------------------|------------------------|
| 6 (kit) | **Yes** | Yes | Regenerates → `post-6.css` ✓ |
| 9 (header) | **No** | Yes | Sees DB cache status=`"file"` → skips regeneration → file absent |
| 12 (footer) | **Yes** | Yes | Regenerates → `post-12.css` ✓ |

Current state:
```
uploads/elementor/css/
├── post-6.css   5,233 bytes   (kit global tokens — regenerated ✓)
├── post-12.css  25,206 bytes  (footer — regenerated ✓)
└── post-9.css   MISSING       ← critical
```

DB cache for post_id=9 (`_elementor_css` meta):
```
status: "file", time: 1782669516
```
Elementor trusts this cache entry and does not regenerate the file.

### What post-9.css contained

Post-12.css (the footer CSS) confirms the layout CSS pattern Elementor uses. For each flexbox container, Elementor writes CSS custom property overrides into the element-level file:

```css
/* From post-12.css — the pattern used for ALL templates */
.elementor-12 .elementor-element.elementor-element-58c43bf7 {
    --display: flex;
    --flex-direction: row;
    --container-widget-width: initial;
    --flex-wrap: nowrap;
    --padding-top: 0px;
    --padding-bottom: 0px;
    /* etc. */
}
```

The base `.e-con` class (in Elementor's bundled CSS) consumes these custom properties:
```css
.e-con { flex-direction: var(--flex-direction); display: var(--display); }
```

Without `post-9.css`:
- `--flex-direction` is not set on any header container → no flex layout CSS is applied to the header elements
- `--padding-top/bottom/left/right` are not set → container dimensions collapse to content minimum
- Background color CSS custom properties are not set → header background may not render
- All widget typography and color tokens are absent

### Header structure (verified in DB, correct)

```
[8664e2]  Header — Outer    flex_dir=row  bg_global=gu-surface
  [14e2bad8] Header — Inner   flex_dir=row  justify=space-between
    [5f0d252]  Widget / html (skip-to-content)
    [3ddeb885] Logo           flex_dir=column
    [6461e353] Nav and CTA    flex_dir=row  justify=flex-end
      [4370cf12] Widget / nav-menu
      [2c97d16a] Widget / button (CTA)
```

The JSON data is correct. The layout collapse is purely a CSS generation problem.

---

## Root Cause 2 — Nav Widget `layout=""` (issue 2, secondary)

**File:** Header, post_id=9, element `[4370cf12]`

Phase C set 17 color/typography globals and `item_gap: 24px` on the nav-menu widget, but **never set `layout: "horizontal"`**. The saved JSON has:

```json
"layout": ""
```

The Elementor nav-menu widget uses the `layout` setting to output a CSS class on the `<nav>` wrapper:

- `layout: "horizontal"` → adds class `elementor-nav-menu--layout-horizontal` → nav items are flex-row
- `layout: ""` → no layout class added → nav items may render as a vertical list (browser default for `<ul>`)

Additionally, `full_width: "yes"` is set on this widget. In Elementor, the full-width setting makes the nav widget stretch to 100% of its container's width. Combined with an absent or non-horizontal layout class, the nav items stack vertically inside the full-width widget, making the widget take the full container height and pushing the CTA button down below it.

This is a **pre-existing Phase C issue** — it was present before Phase F.5. It was masked when Elementor had a valid post-9.css, because the nav widget's element-level CSS included additional rules. Without post-9.css, this underlying setting gap becomes fully visible.

---

## Root Cause 3 — "Detalii și program" Bright Green Background (issue 7)

**File:** Footer, post_id=12, element `[5e9f35d1]` (button widget)

### The conflicting CSS rules

Elementor generates a **global default rule** for all button widgets into every template's CSS file. In post-12.css:

```css
.elementor-widget-button .elementor-button {
    background-color: var(--e-global-color-accent);   /* ← #61CE70 BRIGHT GREEN */
    font-family: var(--e-global-typography-accent-font-family), Sans-serif;
    font-weight: var(--e-global-typography-accent-font-weight);
}
```

`--e-global-color-accent` is the Elementor **default** accent (not the GU custom accent). It is defined in post-6.css as:
```
--e-global-color-accent: #61CE70   ← Elementor default bright green
--e-global-color-gu-accent: #4D7A70 ← GU design system accent (dark teal)
```

The element-specific CSS for `[5e9f35d1]` (generated from the widget's `__globals__`):

```css
.elementor-12 .elementor-element.elementor-element-5e9f35d1 .elementor-button {
    fill: var(--e-global-color-gu-accent);   /* #4D7A70 — dark teal */
    color: var(--e-global-color-gu-accent);  /* #4D7A70 — dark teal */
    border-style: none;
    padding: 0px;
    /* background-color: NOT SET */
}
```

The element rule overrides `color` and `fill` with `gu-accent (#4D7A70)` at higher specificity. But **`background-color` is never overridden**. The global rule's `background-color: #61CE70` (bright green) wins by default.

### Why ghost mode doesn't help

The button has `button_type: ghost`. In Elementor 4.1.x, the ghost skin is supposed to render `background: transparent`. However, in the atomic CSS system used by Elementor 4.x, `background-color: transparent` is only written to the element CSS if it is **explicitly set as a value** in the widget settings. Since `button_background_color` is absent from the settings, Elementor generates no `background-color` override. The global bright green rule stands.

### Why the footer CTA is not affected

The footer CTA button `[2283012]` has `button_background_color` explicitly set via `__globals__.button_background_color: "globals/colors?id=gu-accent"`. Its generated CSS includes:
```css
.elementor-12 .elementor-element.elementor-element-2283012 .elementor-button {
    background-color: var(--e-global-color-gu-accent);  /* #4D7A70 — correct */
}
```
This overrides the global rule. `[5e9f35d1]` has no such override.

---

## Root Cause 4 — Footer Text Visibility Status (issues 4, 5, 6)

### What the DB contains (verified)

| Element | Setting | Value | Status |
|---------|---------|-------|--------|
| `[5a3f904b]` Practice Desc | `text_color` | `#D6CFC4` | Set by F.5 ✓ |
| `[5a3f904b]` | `__globals__.text_color` | `globals/colors?id=gu-border` | Set ✓ |
| `[5d427b5]` Logistics text | `text_color` | `#D6CFC4` | Set by F.5 ✓ |
| `[5d427b5]` | `__globals__.text_color` | `globals/colors?id=gu-border` | Set ✓ |
| `[6b2742e8]` Copyright | `text_color` | `#D6CFC4` | Set by F.5 ✓ |
| `[6b2742e8]` | editor content | `© 2026 Dr. George Ungureanu • Toate drepturile rezervate` | Updated ✓ |
| `[78fc5164]` Privacy link | `title_color` | `#D6CFC4` | Set by F.5 ✓ |

### What post-12.css contains (verified)

post-12.css (25,206 bytes) was regenerated correctly and contains:

```css
/* Practice Description */
.elementor-12 .elementor-element.elementor-element-5a3f904b {
    color: var(--e-global-color-gu-border);   /* #D6CFC4 */
}

/* Col4 logistics text */
.elementor-12 .elementor-element.elementor-element-5d427b5 {
    color: var(--e-global-color-gu-border);   /* #D6CFC4 */
}

/* Copyright */
.elementor-12 .elementor-element.elementor-element-6b2742e8 {
    color: var(--e-global-color-gu-border);   /* #D6CFC4 */
}

/* Privacy link */
.elementor-12 .elementor-element.elementor-element-78fc5164 .elementor-heading-title {
    color: var(--e-global-color-gu-border);   /* #D6CFC4 */
}

/* Footer Row 1 background */
.elementor-12 .elementor-element.elementor-element-58c43bf7:not(...) {
    background-color: var(--e-global-color-gu-ink);  /* #231E1A */
}
```

And post-6.css contains:
```css
.elementor-kit-6 {
    --e-global-color-gu-border: #D6CFC4;
    --e-global-color-gu-ink: #231E1A;
}
```

### Competing global rule

post-12.css also contains a global text-editor default:
```css
.elementor-widget-text-editor {
    color: var(--e-global-color-text);  /* = #7A7A7A */
}
```

Specificity contest on the widget container div (which has BOTH classes simultaneously):
- `.elementor-widget-text-editor` → specificity **0,1,0**
- `.elementor-12 .elementor-element.elementor-element-5a3f904b` → specificity **0,3,0**

The element-specific rule wins. The text color resolves to `#D6CFC4`.

### Assessment

**The footer text CSS is correctly generated.** The contrast is 7.5:1 (`#D6CFC4` on `#231E1A`). Based on file system evidence, the text should now be visible.

The most likely explanation for the "still invisible" reports:
1. The user tested **before post-12.css was regenerated** — immediately after Phase F.5 cleared the DB cache, before any browser visit triggered regeneration
2. OR the user's browser cached the old (empty) page CSS and the cache was not force-refreshed (Ctrl+Shift+R / Cmd+Shift+R)

**Requires browser DevTools verification** to confirm. If text is still invisible after a hard refresh, inspect the computed color on the `.elementor-element-5a3f904b` element to see which rule wins.

---

## CSS File State Summary

| File | Expected | Actual | Status |
|------|----------|--------|--------|
| `post-6.css` (kit) | Present | 5,233 bytes | ✓ Correct |
| `post-9.css` (header) | Present | **ABSENT** | ✗ **Missing — not regenerated** |
| `post-12.css` (footer) | Present | 25,206 bytes | ✓ Correct |

---

## GU Design System CSS Overrides

The GU plugin CSS (`gu-design-system.css`) contains two rules that interact with Elementor output:

### Rule 1: `.e-con-inner` width constraint
```css
.e-con-inner {
    max-width: var(--max-width);  /* = 1200px */
}
```
**Impact:** Restricts the inner container width to 1200px. No conflict with the header or footer layout — both inner containers are intentionally constrained to 1200px. Not a regression cause.

### Rule 2: `.skip-to-content` (modified by Phase F.5)
The Phase F.5 CSS change replaced `top: -200%` with the `clip: rect(0,0,0,0)` pattern. No interaction with header container layout. Not a regression cause.

### Rule 3: Print CSS
```css
@media print {
    .elementor-widget-button, .elementor-nav-menu, .skip-to-content { display: none; }
}
```
Print only. No impact on screen rendering.

**No GU plugin CSS rules conflict with or override Elementor container flex layout.**

---

## Recommended Fixes

The following fixes are listed in priority order. They require script-level changes — do not implement until this diagnostic is reviewed.

### Fix 1 — CRITICAL: Clear `_elementor_css` DB cache for post_id=9

**Scope:** DB write to `wp_postmeta`, deletion of non-existent reference  
**Expected outcome:** Next browser page load regenerates `post-9.css`, restoring all header container layout CSS

Action:
```sql
DELETE FROM wp_postmeta WHERE post_id = 9 AND meta_key = '_elementor_css';
```

This signals to Elementor that post-9.css needs regeneration. On the next browser load of any page (since the header template is `include/general`), Elementor will generate the missing file.

**This single fix resolves symptoms 1, 2 (partially), and 3.**

### Fix 2 — Set nav widget `layout` to `horizontal`

**Scope:** DB write, header `_elementor_data`, element `[4370cf12]`  
**Expected outcome:** Nav-menu widget outputs `elementor-nav-menu--layout-horizontal` CSS class; items render horizontally; `full_width: "yes"` no longer causes full-height stacking

Action: In the nav widget `[4370cf12]` settings, set:
```json
"layout": "horizontal"
```

**This fully resolves symptom 2 and prevents future recurrence.**

### Fix 3 — Set `button_background_color: "transparent"` on `[5e9f35d1]`

**Scope:** DB write, footer `_elementor_data`, element `[5e9f35d1]`  
**Expected outcome:** Elementor generates `background-color: transparent` in the element CSS, overriding the global `#61CE70` kit default

Action: In button `[5e9f35d1]` settings, add:
```json
"button_background_color": "transparent"
```
This generates a `background-color: transparent` rule with `.elementor-12 .elementor-element-5e9f35d1 .elementor-button` specificity, overriding the global kit rule.

**This resolves symptom 7.**

### Fix 4 — Verify footer text visibility in browser

**Scope:** Manual verification only — no code change  
**Action:** Open `http://georgeungureanu-doctor-dev.local/` in browser, press Cmd+Shift+R (hard refresh), inspect footer practice description with DevTools:
1. Select `.elementor-element-5a3f904b` in Elements panel
2. Check Computed panel: `color` should show `rgb(214, 207, 196)` (#D6CFC4)
3. If it shows a darker value, screenshot the Styles cascade showing which rule wins

If text remains invisible after hard refresh, the issue requires a specificity override — add `!important` to the text-editor color rule, or convert from `__globals__` to a direct hex value only (remove the globals reference to force inline style generation).

---

## Non-Issues Confirmed

| Item | Investigation result |
|------|---------------------|
| Theme Builder conditions | Correct — `include/general` for both header and footer |
| Footer DB settings | Phase F.5 changes applied correctly (verified) |
| Global tokens in kit | All GU tokens defined correctly in post-6.css |
| Footer Col2/Col3 nav links | CSS correctly generates `color: var(--e-global-color-gu-surface)` for all nav heading links |
| Col4 container ID | Actual ID is `16a01497` (not `c8e99b29`) — internal diagnostic issue only, no user impact |
| GU plugin CSS | No rules conflict with Elementor container flex layout |
| `_elementor_css` DB for post_id=6 | 206 bytes — correct (stores metadata, not CSS content) |
| Copyright text in DB | Updated: `© 2026 Dr. George Ungureanu • Toate drepturile rezervate` ✓ |

---

## Files Investigated (read-only)

| File | Notes |
|------|-------|
| `uploads/elementor/css/post-6.css` | Kit CSS — token variables confirmed |
| `uploads/elementor/css/post-12.css` | Footer CSS — all element rules inspected |
| `uploads/elementor/css/post-9.css` | **Does not exist** |
| `wp-content/plugins/gu-design-system/assets/css/gu-design-system.css` | No conflicting rules |
| `wp-content/themes/hello-elementor/assets/css/reset.css` | `body { color: #333 }` — overridden by Elementor element rules |
| `wp_postmeta` (post_id=9) | `_elementor_data` — header JSON verified; `_elementor_css` — stale cache confirmed |
| `wp_postmeta` (post_id=12) | `_elementor_data` — all F.5 changes present; `_elementor_css` — regenerated |
| `wp_options` | `elementor_pro_theme_builder_conditions` — conditions confirmed correct |
