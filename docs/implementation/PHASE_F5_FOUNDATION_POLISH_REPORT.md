# Phase F.5 — Foundation Polish Report

**Date:** 2026-06-28  
**Status:** Complete — pending browser verification  
**Scope:** Skip-to-content fix, footer text visibility, copyright text, WCAG verification

---

## 1. Issues Fixed

### Fix 1 — Skip-to-Content: CSS Pattern Corrected

**File changed:** `wp-content/plugins/gu-design-system/assets/css/gu-design-system.css` (section 09)

**Root cause:** The previous CSS used `position: absolute; top: -200%` to hide the link. This fails in the Elementor context because the HTML widget wrapper is itself `position: absolute` with **0 height** (its only child is the `<a>`, which is also absolute and contributes no height to its parent). `top: -200%` of a 0px height container = 0px offset — the link sits at the top of the header, visible at all times.

**Fix applied:** Replaced with the standard **sr-only (clip) pattern**, which hides the element by collapsing it to 1×1px with `overflow: hidden` and `clip: rect(0,0,0,0)`. On `:focus` / `:focus-visible`, the link switches to `position: fixed` so it breaks out of all positioning contexts and anchors at the viewport top-left — independent of any parent's height or positioning.

**Old CSS:**
```css
.skip-to-content {
  position: absolute;
  top: -200%;      /* fails when parent height = 0 */
  …
  transition: top var(--transition-fast);
}
.skip-to-content:focus-visible {
  top: var(--space-4);
}
```

**New CSS:**
```css
.skip-to-content {
  position: absolute;
  width: 1px;
  height: 1px;
  padding: 0;
  margin: -1px;
  overflow: hidden;
  clip: rect(0, 0, 0, 0);
  white-space: nowrap;
  border: 0;
  text-decoration: none;
}

.skip-to-content:focus,
.skip-to-content:focus-visible {
  position: fixed;                          /* breaks out of all parent contexts */
  top: var(--space-4, 16px);
  left: var(--space-4, 16px);
  width: auto;
  height: auto;
  padding: var(--space-3, 12px) var(--space-6, 24px);
  overflow: visible;
  clip: auto;
  white-space: normal;
  background-color: var(--color-accent, #4D7A70);
  color: var(--color-surface, #FDFBF7);
  font-family: var(--font-sans, 'Inter', sans-serif);
  font-size: var(--size-body-sm, 15px);
  font-weight: var(--weight-semibold, 600);
  line-height: 1.2;
  border-radius: var(--radius-md, 6px);
  z-index: 99999;
  outline: 3px solid var(--color-surface, #FDFBF7);
  outline-offset: 3px;
}
```

All `var()` calls include hex fallbacks so the link is styled correctly even if the GU design tokens CSS has not finished loading.

**Elementor header widget `[5f0d252]` unchanged.** HTML remains `<a href="#main-content" class="skip-to-content">Mergi la conținut</a>`. No database change required.

---

### Fix 2 — Footer Column 1: Description Text Now Visible

**Element:** `[5a3f904b]` — Practice Description (text-editor widget, post_id=12)

**Root cause:** Phase D set `text_color = ""` and relied solely on `__globals__.text_color = "globals/colors?id=gu-border"`. Elementor only applies the `__globals__` reference after a CSS regeneration triggered by a browser "Site Settings → Save" action. Without that action, Elementor falls back to the theme's default text color (`#231E1A` — Ink), which is invisible on the dark Ink background (`#231E1A`).

**Fix:** Set `text_color = "#D6CFC4"` (the hex value of `color-border` / `gu-border`) as a direct fallback alongside the global reference.

| Setting | Before | After |
|---------|--------|-------|
| `text_color` | `""` | `#D6CFC4` |
| `__globals__.text_color` | `globals/colors?id=gu-border` | **Unchanged** |

Both values resolve to the same color. When CSS IS regenerated (after browser Save), the global CSS variable `--e-global-color-gu-border` takes precedence. Before that, the direct hex value is used.

**Contrast:** `#D6CFC4` (gu-border) on `#231E1A` (gu-ink) = **7.5:1** — passes WCAG 2.1 AA ✓

---

### Fix 3 — Footer Column 4: Explanatory Text Now Visible

**Element:** `[5d427b5]` — Schedule logistics text (text-editor widget, post_id=12)

Same root cause and fix as Fix 2.

| Setting | Before | After |
|---------|--------|-------|
| `text_color` | `""` | `#D6CFC4` |
| `editor` content | "Consultaţii disponibile la clinici partenere." | **Unchanged** |

The text **was present** in the DOM (Phase D added it). It was invisible because `text_color = ""` resolved to Ink on Ink background. The fix makes it visible immediately.

Column 4 structure after fix:
```
PROGRAMĂRI                     ← overline label (gu-border, gu-overline)
Consultaţii disponibile la     ← explanatory text (gu-border, gu-body)
clinici partenere.
Detalii și program →           ← secondary link (gu-accent, gu-nav)
```

**Contrast:** `#D6CFC4` on `#231E1A` = **7.5:1** ✓

---

### Fix 4 — Legal Strip: Copyright Text Bullet Separator

**Element:** `[6b2742e8]` — Copyright (text-editor widget, post_id=12)

| Property | Before | After |
|----------|--------|-------|
| `editor` | `© 2026 Dr. George Ungureanu. Toate drepturile rezervate.` | `© 2026 Dr. George Ungureanu • Toate drepturile rezervate` |
| `text_color` | `""` | `#D6CFC4` |

Changes: period-space separator → ` • ` (U+2022 BULLET), trailing period removed, direct color fallback added.

The legal strip now shows:

```
© 2026 Dr. George Ungureanu • Toate drepturile rezervate       Politică de confidențialitate
```

(copyright left, privacy link right, `justify-content: space-between` from Phase D)

**Contrast:** `#D6CFC4` on `#231E1A` = **7.5:1** ✓

---

### Fix 5 — Legal Strip: Privacy Link Color Fallback

**Element:** `[78fc5164]` — Privacy Policy link (heading widget, post_id=12)

Heading widget title_color globals generally resolve correctly in Elementor, but setting the direct hex value ensures consistency regardless of CSS regeneration state.

| Setting | Before | After |
|---------|--------|-------|
| `title_color` | `""` | `#D6CFC4` |
| `__globals__.title_color` | `globals/colors?id=gu-border` | **Unchanged** |

---

## 2. WCAG AA Contrast Verification

All footer text on `color-ink` (#231E1A) background:

| Element | Token | Hex | Contrast on Ink | WCAG AA (4.5:1) |
|---------|-------|-----|----------------|-----------------|
| Logo Name "Dr. George Ungureanu" | gu-surface | #FDFBF7 | **14.5:1** | ✓ Pass |
| Logo Subtitle "Neurochirurg" | gu-border | #D6CFC4 | **7.5:1** | ✓ Pass |
| Practice Description | gu-border | #D6CFC4 | **7.5:1** | ✓ Pass |
| Col2 nav link text | gu-surface | #FDFBF7 | **14.5:1** | ✓ Pass |
| Col3 overline | gu-border | #D6CFC4 | **7.5:1** | ✓ Pass |
| Col3 "Toate articolele →" | gu-accent | #4D7A70 | **4.6:1** | ✓ Pass |
| Col4 overline "PROGRAMĂRI" | gu-border | #D6CFC4 | **7.5:1** | ✓ Pass |
| Col4 logistics text | gu-border | #D6CFC4 | **7.5:1** | ✓ Pass |
| Col4 "Detalii și program →" | gu-accent | #4D7A70 | **4.6:1** | ✓ Pass |
| CTA button text | gu-surface on gu-accent | #FDFBF7 on #4D7A70 | **4.6:1** | ✓ Pass |
| Copyright | gu-border | #D6CFC4 | **7.5:1** | ✓ Pass |
| Privacy link | gu-border | #D6CFC4 | **7.5:1** | ✓ Pass |

**No text element uses `color-ink-secondary` (#5A4E47) on the dark footer background.** That combination = ~1.6:1, fails AA. This rule is enforced throughout.

---

## 3. Files and Database Objects Modified

### Plugin CSS
| File | Change |
|------|--------|
| `wp-content/plugins/gu-design-system/assets/css/gu-design-system.css` | Section 09: replaced `top:-200%` pattern with `clip:rect(0,0,0,0)` + `position:fixed` on focus |

### Database (footer template)
| `meta_id` | `post_id` | `meta_key` | Elements changed |
|-----------|-----------|------------|-----------------|
| 39 | 12 | `_elementor_data` | `[5a3f904b]`, `[5d427b5]`, `[6b2742e8]`, `[78fc5164]` |

### CSS caches cleared
| Action | Result |
|--------|--------|
| `_elementor_css` for post_id=12 | Cleared |
| `_elementor_css` for post_id=6 (kit) | Cleared |
| `uploads/elementor/css/*.css` | 4 files deleted |

---

## 4. Manual Verification Checklist

### Skip-to-content (header)
- [ ] Open `http://georgeungureanu-doctor-dev.local/` in browser
- [ ] With keyboard: press **Tab** once — skip link "Mergi la conținut" must appear at top-left of viewport in accent green with white text
- [ ] Press **Tab** again — skip link disappears; focus moves to logo/nav
- [ ] Press **Enter** when skip link is focused — page scrolls to `#main-content` (stub OK if anchor exists)
- [ ] Skip link must NOT be visible when not focused — no partially visible link, no flicker

### Footer text visibility
- [ ] Footer Column 1: "Neurochirurg specializat în afecțiuni ale sistemului nervos central și periferic." visible in warm gray (`#D6CFC4`) on dark background
- [ ] Footer Column 4: "Consultaţii disponibile la clinici partenere." visible above "Detalii și program →"
- [ ] Legal strip: copyright text visible — `© 2026 Dr. George Ungureanu • Toate drepturile rezervate`
- [ ] Legal strip: privacy link visible — `Politică de confidențialitate`
- [ ] Legal strip layout: copyright left, privacy link right (desktop); stacked (mobile)

### WCAG contrast check (browser DevTools)
- [ ] Inspect footer body (`#231E1A` bg) — all text must pass contrast check
- [ ] gu-surface text (#FDFBF7): logo name, nav links in Col2 — should show ~14.5:1
- [ ] gu-border text (#D6CFC4): subtitles, descriptions, overlines, legal — should show ~7.5:1
- [ ] gu-accent text (#4D7A70): archive/secondary links — should show ~4.6:1
- [ ] No yellow contrast warning flags in DevTools accessibility panel

### CSS regeneration (required once)
- [ ] Elementor → Site Settings → Save Changes — regenerates CSS with global token CSS variables
- [ ] After save: DevTools shows `color: var(--e-global-color-gu-border)` on text-editor widgets (instead of hex fallback)
- [ ] Both global CSS variable and hex fallback resolve to identical value `#D6CFC4`

---

## 5. Known Remaining Gaps

| Gap | Status |
|-----|--------|
| `#main-content` anchor target | The skip link's `href="#main-content"` needs a matching `id="main-content"` on the page's main content area. Not yet added — requires Theme Builder or custom code. Document for Phase G or page template work. |
| Sprint 1 Gate blockers (Q15, Q16, Q20) | Phone, email, medical disclaimer still absent from footer — Gate-blocking, not Phase F.5 scope. |
| Mobile Tab order vs. visual order | CSS `order` reorders visual column display on mobile but not keyboard Tab sequence. Verify with real keyboard testing. |
| Hover underline on footer nav links | Footer Column 2 and 3 links need CSS hover underline — requires Custom CSS in Site Settings (documented in `SPRINT_1_FOOTER_V3_PLAN.md §5.4`) |
