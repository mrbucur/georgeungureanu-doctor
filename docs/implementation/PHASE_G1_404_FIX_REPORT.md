# Phase G.1 — 404 Theme Builder Assignment Fix

**Date:** 2026-06-29  
**Status:** Fix applied — pending browser verification  
**Scope:** DB-only — no Elementor data, no CSS, no content changed

---

## Problem Statement

After Phase G created the 404 template (post_id=37), the site continued showing Hello Elementor's default 404 page ("The page can't be found"). Elementor Pro's Theme Builder was not applying the custom template.

---

## Root Cause: Three Bugs

Phase G's creation script used incorrectly assumed values for two meta keys and the global conditions key. All three are wrong; all three must be correct for Elementor Pro to route the 404 template.

### Bug 1 — Wrong `_elementor_template_type`

**Value set:** `'404-page'`  
**Correct value:** `'error-404'`

**Source:** `elementor-pro/modules/theme-builder/documents/error-404.php`:
```php
class Error_404 extends Single_Base {
    public static function get_type() {
        return 'error-404';   // ← the real type string
    }
}
```

Elementor Pro's `get_document($post_id)` reads `_elementor_template_type` and looks up the registered document class. `'404-page'` is not a registered type → `get_document()` returns `null` → the template is silently ignored by the conditions cache regenerator and never applied.

---

### Bug 2 — Wrong location key in global conditions

**Key used:** `'404'`  
**Correct key:** `'single'`

**Source:** `elementor-pro/modules/theme-builder/classes/locations-manager.php`, the `get_current_location()` method:
```php
} elseif ( is_singular() || is_404() ) {
    $location = 'single';
}
```

When WordPress detects a 404, `is_404()` returns true. Elementor Pro maps this to the `'single'` location — not a `'404'` location. `'404'` is not a registered location key. `get_documents_for_location('404')` returns an empty array.

---

### Bug 3 — Wrong condition string

**Value set:** `"include/general"`  
**Correct value:** `"include/singular/not_found404"`

**Why `"include/general"` is wrong:** Placed under the `'single'` location, `"include/general"` would match ALL singular pages (posts, pages, custom post types) — not just 404 pages. The 404 template would appear everywhere.

**The correct condition:** `"include/singular/not_found404"` is parsed as:
```
type=include, name=singular, sub_name=not_found404
```

Evaluation chain:
1. `Singular::check()` → `is_singular() || is_404()` → true on 404 pages
2. `Not_Found404::check()` → `is_404()` → true only on 404 pages

**Source:** `elementor-pro/modules/theme-builder/conditions/not-found404.php`:
```php
class Not_Found404 extends Condition_Base {
    public function get_name() { return 'not_found404'; }
    public function check( $args ) { return is_404(); }
}
```

---

## DB Values Inspected

### Before fix (post_id=37)

| Meta key | Wrong value |
|----------|-------------|
| `_elementor_template_type` | `404-page` |
| `_elementor_conditions` | `a:1:{i:0;s:15:"include/general";}` |

### Global conditions (before)

```
elementor_pro_theme_builder_conditions:
  footer → {12: ["include/general"]}
  header → {9: ["include/general"]}
  404    → {37: ["include/general"]}     ← wrong location key, wrong condition
```

---

## Changes Applied

### `_elementor_template_type` (post_id=37)

| Field | Before | After |
|-------|--------|-------|
| `_elementor_template_type` | `404-page` | `error-404` |
| `_elementor_conditions` | `a:1:{i:0;s:15:"include/general";}` | `a:1:{i:0;s:29:"include/singular/not_found404";}` |

### `elementor_pro_theme_builder_conditions` (wp_options)

| Location | Before | After |
|----------|--------|-------|
| `header` | `{9: ["include/general"]}` | unchanged |
| `footer` | `{12: ["include/general"]}` | unchanged |
| `404` | `{37: ["include/general"]}` | **removed** |
| `single` | *(not present)* | `{37: ["include/singular/not_found404"]}` **added** |

---

## Why the Fix Works

On a 404 page request, Elementor Pro:

1. Calls `get_current_location()` → `is_404()` → returns `'single'`
2. Reads `elementor_pro_theme_builder_conditions['single']` → finds `{37: ["include/singular/not_found404"]}`
3. Calls `get_document(37)` → reads `_elementor_template_type = 'error-404'` → matches registered `Error_404` class → returns a valid document
4. Evaluates condition `"include/singular/not_found404"`:
   - `Singular::check()` → `is_404()` → true
   - `Not_Found404::check()` → `is_404()` → true
5. Template passes → rendered as page body, wrapped with header (post_id=9) and footer (post_id=12)

On a regular page or post request, `is_404()` is false → `Not_Found404::check()` returns false → template is not applied.

---

## Script Output (all pass)

```
✓ _elementor_template_type = 'error-404'
✓ _elementor_conditions = ['include/singular/not_found404']
✓ global conditions 'single'[37] = 'include/singular/not_found404'
✓ wrong '404' location removed
```

---

## Files Changed

| Resource | Change |
|----------|--------|
| `wp_postmeta` (DB) | `_elementor_template_type`: `404-page` → `error-404` |
| `wp_postmeta` (DB) | `_elementor_conditions`: `include/general` → `include/singular/not_found404` |
| `wp_options` (DB) | `elementor_pro_theme_builder_conditions`: removed `'404'` key, added `'single'` key |

No template data changed. No CSS changed. No content changed. Header and footer untouched.

---

## Browser Verification Checklist

**URL:** `http://georgeungureanu-doctor-dev.local/pagina-inexistenta/`  
(Any non-existent URL triggers WordPress's 404 handler.)

### Template routing
- [ ] Custom 404 page renders (NOT Hello Elementor's default "The page can't be found")
- [ ] Site header appears above the content (navigation, logo, CTA)
- [ ] Site footer appears below the content (dark background, columns)

### Content
- [ ] "404" label visible in teal (#4D7A70) above the heading
- [ ] H1 "Pagina nu a fost găsită" visible in Lora typeface
- [ ] Explanatory paragraph visible
- [ ] "Mergi la pagina principală" button visible (teal filled)
- [ ] "Solicită o programare" button visible (outline)

### Navigation
- [ ] "Mergi la pagina principală" → navigates to `/`
- [ ] "Solicită o programare" → navigates to `/programari/`

### No regressions on other pages
- [ ] Homepage (`/`) renders normally — 404 template does NOT appear on it
- [ ] Any existing page renders normally — single location is selective

### If template still does not appear
The conditions cache might need an explicit regeneration. In WordPress admin:
**Elementor → Tools → Regenerate Files & Data**

This triggers `Conditions_Cache::regenerate()` which rebuilds the global conditions from scratch. With `_elementor_template_type = 'error-404'` now correct, it will find the template via `get_document(37)` and place it under `'single'` with condition `'include/singular/not_found404'` — identical to what was written by this fix.
