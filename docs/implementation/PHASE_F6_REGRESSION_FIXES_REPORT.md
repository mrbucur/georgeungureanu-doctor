# Phase F.6 — Regression Fixes Report

**Date:** 2026-06-29  
**Status:** Applied — pending browser verification (CSS regeneration triggered by page load)  
**Reference:** `docs/implementation/REGRESSION_DIAGNOSTIC_001.md`  
**Scope:** Header CSS restore, nav layout, button background — no new features

---

## Fixes Applied

### Fix 1 — Nav Widget `layout: "horizontal"` (issues 1, 2, 3)

**Template:** Header, post_id=9  
**Element:** `[4370cf12]` nav-menu widget

**Root cause:** Phase C set 17 color/typography globals on the nav widget but never set `layout`. The JSON stored `layout: ""` (absent key). With an empty layout value, Elementor's nav-menu widget does not output the `elementor-nav-menu--layout-horizontal` CSS class on the `<nav>` wrapper, causing items to render as a vertical list rather than an inline row.

**Change applied:**
```json
"layout": "horizontal"   ← was absent/empty
```

This ensures the nav widget outputs class `elementor-nav-menu--layout-horizontal` and items display inline.

**Container directions confirmed unchanged:**

| Element | Container | `flex_direction` |
|---------|-----------|-----------------|
| `[8664e2]` | Header Outer | `row` ✓ |
| `[14e2bad8]` | Header Inner | `row` ✓ |
| `[6461e353]` | Nav and CTA | `row` ✓ |

---

### Fix 2 — `_elementor_css` Cache Cleared for post_id=9 (issues 1, 2, 3)

**Root cause:** Phase F.5 deleted `post-9.css` from disk but did not clear the `_elementor_css` DB meta for post_id=9. The stale DB cache had `status: "file"`, which told Elementor the CSS was current and caused it to skip regeneration. On the next browser page load (after the browser visit that Phase F.5 was intended to trigger), Elementor regenerated post-6.css and post-12.css but not post-9.css.

**Change applied:** Deleted the `_elementor_css` postmeta row for post_id=9. On the next browser page load, Elementor will:
1. Check for post-9.css → file absent
2. Generate element-level CSS for all containers and widgets in the header template
3. Write `post-9.css` to `uploads/elementor/css/`

This restores:
- `--flex-direction: row` for containers `[8664e2]`, `[14e2bad8]`, `[6461e353]`
- `--padding-*` for the Header Inner container
- Background color token CSS for the header surface
- All nav widget and button widget color/typography CSS

---

### Fix 3 — Button `button_background_color: "transparent"` (issue 7)

**Template:** Footer, post_id=12  
**Element:** `[5e9f35d1]` — "Detalii și program →" button widget

**Root cause:** Elementor writes a global default into every template's CSS file:
```css
.elementor-widget-button .elementor-button {
    background-color: var(--e-global-color-accent);  /* = #61CE70 bright green */
}
```
The element-specific CSS for `[5e9f35d1]` only set `color` and `fill` to `gu-accent` (#4D7A70 dark teal), never overriding `background-color`. The `button_type: ghost` setting did not generate a `background-color: transparent` override in Elementor 4.1.x's atomic CSS system. The global bright green background won by default.

**Change applied:**
```json
"button_background_color": "transparent"   ← was absent
```

Elementor will now generate into the footer element CSS:
```css
.elementor-12 .elementor-element.elementor-element-5e9f35d1 .elementor-button {
    background-color: transparent;   ← overrides the global #61CE70 rule
    color: var(--e-global-color-gu-accent);   /* #4D7A70 — unchanged */
    fill: var(--e-global-color-gu-accent);
    border-style: none;
    padding: 0px;
}
```

The `button_text_color` global reference (`globals/colors?id=gu-accent`) is unchanged. The "Detalii și program →" link will render as dark teal text (#4D7A70) with no background.

---

## Files and Cache State After Fixes

### DB changes summary

| Post ID | Template | Setting changed | Old value | New value |
|---------|----------|-----------------|-----------|-----------|
| 9 | Header | `[4370cf12].layout` | `""` (absent) | `"horizontal"` |
| 12 | Footer | `[5e9f35d1].button_background_color` | `""` (absent) | `"transparent"` |

### CSS caches cleared

| Scope | Action | Count |
|-------|--------|-------|
| `_elementor_css` post_id=6 (kit) | DB row deleted | 1 |
| `_elementor_css` post_id=9 (header) | DB row deleted | 1 |
| `_elementor_css` post_id=12 (footer) | DB row deleted | 1 |
| `uploads/elementor/css/*.css` | Files deleted | 2 (`post-6.css`, `post-12.css`) |

**Current state:** 0 CSS files on disk, 0 DB cache entries. All three templates will regenerate on next browser load.

### Expected files after browser load

| File | Expected size | Contents |
|------|---------------|----------|
| `post-6.css` | ~5 KB | Kit — global token CSS custom properties |
| `post-9.css` | ~3–6 KB | Header — container layout, widget colors/typography |
| `post-12.css` | ~25 KB | Footer — all column and widget rules |

---

## Manual Verification Steps

### Step 1: Trigger CSS regeneration

Open `http://georgeungureanu-doctor-dev.local/` in the browser. This single page load will:
- Generate `post-6.css` (kit)
- Generate `post-9.css` (header — the key missing file)
- Generate `post-12.css` (footer)

Do a **hard refresh** (Cmd+Shift+R) after the first load to ensure no stale browser cache is served.

### Step 2: Header layout checks

- [ ] Header is visible at the top of the page with a warm white/cream background (`#FDFBF7`)
- [ ] Header renders as a horizontal bar (not collapsed to a thin strip or blank)
- [ ] Logo "Dr. George Ungureanu" and "Neurochirurg" are visible on the left
- [ ] Nav items are horizontal inline: Acasă — Afecțiuni — Sfatul Neurochirurgului — Recomandări — Despre
- [ ] CTA button "Programează o consultație" is on the right, same row as nav
- [ ] At desktop width (≥1280px): no wrapping, no overflow

### Step 3: Nav widget specifics

- [ ] All 5 nav items are visible and inline (not a dropdown or hamburger)
- [ ] Nav items use Inter 15px Medium (gu-nav typography token)
- [ ] Active/current page link shows gu-accent color (#4D7A70)
- [ ] Hover state on nav items shows gu-accent underline or color change
- [ ] No hamburger icon visible at desktop width

### Step 4: Footer color checks

- [ ] Practice description (Col1): "Neurochirurg specializat..." visible in warm gray on dark background
- [ ] Col4 logistics text: "Consultaţii disponibile la clinici partenere." visible above "Detalii și program →"
- [ ] "Detalii și program →": dark teal text (#4D7A70), **no green background**
- [ ] Copyright: "© 2026 Dr. George Ungureanu • Toate drepturile rezervate" visible
- [ ] Privacy link: "Politică de confidențialitate" visible

### Step 5: CSS file verification (optional, after browser load)

```bash
ls -la "/Users/puiucrisanbucur/Local Sites/georgeungureanu-doctor-dev/app/public/wp-content/uploads/elementor/css/"
# Expected: post-6.css, post-9.css, post-12.css all present
```

Confirm `post-9.css` now exists. Check that it contains the header's container rules:

```bash
grep "8664e2\|14e2bad8\|6461e353\|4370cf12" \
  ".../uploads/elementor/css/post-9.css" | head -10
```

---

## Remaining Risks

### Risk 1 — `full_width: yes` on nav widget (medium)

The nav widget `[4370cf12]` has `full_width: "yes"` set (not changed in this phase). In Elementor, full_width makes the nav widget expand to fill its flex parent. In the Nav+CTA container (`flex_dir=row, wrap=nowrap`), the nav should expand to take remaining space after the CTA button's natural width.

**Expected behavior:** Nav takes most of the row width; CTA is right-aligned (since `justify=flex-end` on the container). This is the intended design.

**Risk:** If `full_width: yes` generates `width: 100%` rather than `flex: 1`, the CTA might be pushed to a new line or off-screen. Check in browser; if the CTA disappears or wraps, disable `full_width` by setting `"full_width": ""` in the nav widget settings and clear the CSS cache again.

### Risk 2 — Nav hover underline pointer type `none` (low)

The nav widget has `pointer: "none"` (no underline/highlight pointer effect on hover). This is the Phase C setting. With `layout: "horizontal"` now properly set, the pointer style may need to be reviewed — `pointer: none` is correct per the design spec (hover is handled by `color_menu_item_hover: gu-accent` color change only, no underline decoration). Verify in browser.

### Risk 3 — post-9.css not regenerating (low, known mechanism)

If the user loads the page but `post-9.css` still doesn't appear:
1. The Elementor atomic cache validity might block regeneration. Check `elementor_atomic_cache_validity__global` in `wp_options`.
2. Workaround: Go to Elementor → Tools → Regenerate Files & Data in the WordPress admin.

### Risk 4 — Footer text still invisible after hard refresh (low)

The CSS is correctly generated in post-12.css. If text remains invisible after a hard refresh (Cmd+Shift+R), check DevTools computed styles on `.elementor-element-5a3f904b`:
- If `color` shows `rgb(122, 122, 122)` (#7A7A7A): the global `.elementor-widget-text-editor` rule is winning over the element-specific rule. This would indicate a CSS specificity issue introduced by the `.elementor-12` prefix not being applied to the element. Screenshot the Styles cascade and report.
- If `color` shows `rgb(214, 207, 196)` (#D6CFC4): text is correctly colored but might have an opacity issue — check `opacity` on parent containers.

---

## What Was NOT Changed

- No new Elementor elements created
- No global tokens added or modified
- No homepage content touched
- No CPTs created or modified
- No GU plugin CSS changes (skip-to-content CSS fix from Phase F.5 is intact)
- No Theme Builder conditions modified (already correctly set)
- Footer column structure unchanged
- Col4 container `[16a01497]` and all its children unchanged
