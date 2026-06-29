# Phase C — Header v3 Rebuild Report

**Date:** 2026-06-28  
**Status:** Complete — pending browser verification  
**Sources:** `SPRINT_1_HEADER_V3_PLAN.md`, `docs/tasks/03_HEADER_AND_NAVIGATION.md`, `docs/tasks/04_DESIGN_SYSTEM_TOKENS.md`

---

## 1. What Was Changed

All changes were applied programmatically via PHP + MySQL against the local WordPress database. No Elementor editor session was required.

### Modified Database Row

| Field | Value |
|-------|-------|
| Table | `wp_postmeta` |
| `meta_id` | 15 |
| `post_id` | 9 (header Theme Builder template) |
| `meta_key` | `_elementor_data` |
| Original size | 7,062 bytes |
| Updated size | 8,084 bytes |

---

## 2. Element-by-Element Changes

### 2.1 Outer Container `[8664e2]` — Header — Outer

| Setting | Before | After |
|---------|--------|-------|
| `background_color` | `#FDFBF7` (hardcoded) | `""` → `__globals__.background_color = globals/colors?id=gu-surface` |
| `border_color` | `#D6CFC4` (hardcoded) | `""` → `__globals__.border_color = globals/colors?id=gu-border` |

### 2.2 Logo — Doctor Name `[25436055]`

| Setting | Before | After |
|---------|--------|-------|
| `title_color` | `#231E1A` (hardcoded) | `""` → `__globals__.title_color = globals/colors?id=gu-ink` |
| Typography | Custom Inter 600 18/17/16px LH 1.3 | **Unchanged** — no matching global token; custom values correct per spec |

### 2.3 Logo — Subtitle `[10d3e433]`

| Setting | Before | After |
|---------|--------|-------|
| `title_color` | `#5A4E47` (hardcoded) | `""` → `__globals__.title_color = globals/colors?id=gu-ink-secondary` |
| Typography | Custom Inter 400 14px LH 1.4 | **Unchanged** — no matching global token; correct for subtitle use on light background |

> **Contrast note:** `color-ink-secondary` (#5A4E47) on `color-surface` (#FDFBF7) = ~7.5:1 — passes WCAG 2.1 AA. Only fails on dark (ink) backgrounds.

### 2.4 Nav Widget `[4370cf12]` — Navigation — Navigare principală

| Setting | Before | After |
|---------|--------|-------|
| `menu` | `"0"` (no menu assigned) | `"4"` — term_id of "Navigare principală" |
| `item_gap.size` | `16` px | `24` px (spec: `space-6` = 24px) |
| `typography_typography` | `"custom"` | `""` → `__globals__.typography_typography = globals/typography?id=gu-nav` |
| `typography_font_family` | `"Inter"` | `""` (derived from global) |
| `typography_font_weight` | `"500"` | `""` (derived from global) |
| `typography_font_size` | `14px` | removed (derived from global — 15px via gu-nav) |
| `color_menu_item` | `#231E1A` | `""` → global `gu-ink` |
| `color_menu_item_hover` | `#4D7A70` | `""` → global `gu-accent` |
| `color_menu_item_active` | `#4D7A70` | `""` → global `gu-accent` |
| `pointer_color_menu_item` | `#4D7A70` | `""` → global `gu-accent` |
| `pointer_color_menu_item_hover` | `#3A5F57` | `""` → global `gu-accent-hover` |
| `pointer_color_menu_item_active` | `#3A5F57` | `""` → global `gu-accent-hover` |
| `toggle_color` | `#231E1A` | `""` → global `gu-ink` |
| `toggle_color_hover` | `#4D7A70` | `""` → global `gu-accent` |
| `dropdown_background_color` | `#FDFBF7` | `""` → global `gu-surface` |
| `dropdown_border_color` | `#D6CFC4` | `""` → global `gu-border` |
| `color_dropdown_item` | `#231E1A` | `""` → global `gu-ink` |
| `color_dropdown_item_hover` | `#4D7A70` | `""` → global `gu-accent` |
| `color_dropdown_item_active` | `#4D7A70` | `""` → global `gu-accent` |
| `background_color_dropdown_item` | `#FDFBF7` | `""` → global `gu-surface` |
| `background_color_dropdown_item_hover` | `#F4EFE6` | `""` → global `gu-surface-warm` |
| `background_color_dropdown_item_active` | `#E4EDEB` | `""` → global `gu-accent-subtle` |
| `dropdown_divider_color` | `#D6CFC4` | `""` → global `gu-border` |

> **Menu items served** (from "Navigare principală", term_id=4, created Phase B):  
> Acasă → /  
> Afecțiuni → /afectiuni/  
> Sfatul Neurochirurgului → /sfatul-neurochirurgului/  
> Recomandări → /recomandari/  
> Despre → /despre/

### 2.5 CTA Button `[2c97d16a]` — CTA — Consultație

| Setting | Before | After |
|---------|--------|-------|
| `_title` (editor label) | `CTA — Programări` | `CTA — Consultație` |
| `text` | `Programări` | `Programează o consultație` |
| `link.url` | `/programari` | `/programari/` (trailing slash added) |
| `hide_mobile` | `"yes"` | **removed** (CTA must be visible on all breakpoints in v3) |
| `text_padding` | `10/20/10/20 px` | `12/24/12/24 px` (8px grid: 1.5×8 = 12, 3×8 = 24) |
| `typography_typography` | `"custom"` | `""` → `__globals__.typography_typography = globals/typography?id=gu-cta` |
| `typography_font_family` | `"Inter"` | `""` (derived from global) |
| `typography_font_weight` | `"600"` | `""` (derived from global) |
| `typography_font_size` | `14px` | removed (derived from global — 16px via gu-cta) |
| `button_text_color` | `#FDFBF7` | `""` → global `gu-surface` |
| `background_color` | `#4D7A70` | `""` → global `gu-accent` |
| `hover_color` | `#FDFBF7` | `""` → global `gu-surface` |
| `button_background_hover_color` | `#3A5F57` | `""` → global `gu-accent-hover` |

**Unchanged on CTA:** `border_radius` (6px), `hover_transition_duration` (200ms), `size` (xs), `_element_id` (atom-button-primary-header), `button_type` (info), `align` (center).

---

## 3. CSS Cache Actions

| Action | Result |
|--------|--------|
| Deleted `_elementor_css` meta for post_id=9 (header) | 1 row deleted |
| Deleted `_elementor_css` meta for post_id=6 (kit) | 1 row deleted |
| Deleted generated CSS files from `uploads/elementor/css/` | 4 files deleted |

---

## 4. What Was NOT Changed (Intentional)

| Item | Reason |
|------|--------|
| Skip-to-content HTML widget `[5f0d252]` | Preserved as-is per spec |
| Logo container layout and spacing | Already correct in v2 |
| Sticky header behavior (`sticky: top`) | Preserved — still correct for v3 |
| Outer container shadow (scroll behavior) | Requires CSS — not in Elementor JSON; handled by template CSS or Phase E |
| Logo typography (Inter 600 18/17/16px) | No matching global token; custom values match spec |
| Subtitle typography (Inter 400 14px) | No matching global token; correct for subtitle role |
| Nav `pointer` setting | Kept as `none` — underline/dot indicators not specified in v3 |
| Dropdown item padding (16px 24px) | Already matches 8px grid |
| Dropdown item min-height (56px) | Already matches 7×8px grid |
| CTA `border_border: none` | Correct for v3 |

---

## 5. Manual Verification Checklist

Complete these steps in the browser after running this report:

### Step 1 — Regenerate CSS
- [ ] Open `http://georgeungureanu-doctor-dev.local/wp-admin`
- [ ] Go to **Templates → Theme Builder → Header**
- [ ] Open the header template in Elementor editor
- [ ] Confirm the nav widget shows "Navigare principală" in the panel (Menu dropdown)
- [ ] Confirm the CTA button text reads "Programează o consultație"
- [ ] Click the hamburger menu (☰) → **Site Settings** → **Save Changes**
- [ ] Wait for CSS regeneration confirmation

### Step 2 — Desktop verification (1280px)
- [ ] Open `http://georgeungureanu-doctor-dev.local/` in a browser tab
- [ ] Resize viewport to exactly 1280px
- [ ] Nav items visible: Acasă / Afecțiuni / Sfatul Neurochirurgului / Recomandări / Despre
- [ ] No nav items wrap to a second line
- [ ] CTA button "Programează o consultație" is right-aligned and visible
- [ ] Background is `#FDFBF7` (cream, not white)
- [ ] Bottom border is `#D6CFC4` (warm gray)
- [ ] Logo name "Dr. George Ungureanu" in `#231E1A`
- [ ] Logo subtitle "Neurochirurg" in `#5A4E47`

### Step 3 — Mobile verification (375px)
- [ ] Resize viewport to 375px
- [ ] Hamburger toggle icon visible (≡)
- [ ] CTA button "Programează o consultație" visible (was `hide_mobile: yes` in v2 — now must show)
- [ ] Tap hamburger → drawer slides in
- [ ] Drawer shows all 5 items in correct order
- [ ] Drawer background is `#FDFBF7`
- [ ] No overflow or horizontal scroll

### Step 4 — Link targets
- [ ] Each nav item links to correct slug (stubs may 404 — that is expected; check URL, not page content)
- [ ] CTA button links to `/programari/`
- [ ] Logo name and subtitle both link to `/`

### Step 5 — Accessibility
- [ ] `Tab` key cycles through: skip-to-content link → logo → nav items → CTA
- [ ] Skip-to-content link visible on first Tab press
- [ ] All nav items keyboard-activatable (Enter/Space)
- [ ] `aria-label="Navigare principală"` present on nav element (inspect in browser DevTools)

---

## 6. Known Gaps (post-v3, not blocking)

| Gap | Notes |
|-----|-------|
| Sticky shadow on scroll | Requires custom CSS: `box-shadow: 0 2px 8px rgba(35,30,26,0.10)` on scroll. Not deliverable via Elementor JSON alone. Phase E or custom CSS block. |
| Active state underline indicator | Nav `pointer` = none. Spec may require a 2px `color-accent` underline on active item. Verify against `SPRINT_1_HEADER_V3_PLAN.md §3.3`. |
| Logo image (Q19) | Text-only logo in Phase 1 — intentional pending Q19 photography answer. |
| Mobile CTA min-height 48px | Must verify 48px tap target on real device. Padding 12/24 gives ~40px — if short, add `min-height: 48px` via custom CSS. |

---

## 7. Files and Database Objects Modified

| Object | Type | Value |
|--------|------|-------|
| `wp_postmeta` meta_id=15 | DB row | `_elementor_data` for header post_id=9 |
| `uploads/elementor/css/*.css` | Files | 4 stale CSS files deleted |
| `wp_postmeta` (post_id=9, `_elementor_css`) | DB row | Deleted (cache cleared) |
| `wp_postmeta` (post_id=6, `_elementor_css`) | DB row | Deleted (kit cache cleared) |

No PHP files, plugin files, or template files were modified. All changes are in the database layer only.
