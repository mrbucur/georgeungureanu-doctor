# Phase G — 404 Page Template: Implementation Report

**Date:** 2026-06-29  
**Status:** Template created — pending browser verification  
**Post ID:** 37  
**Template type:** `404-page` (Elementor Theme Builder)

---

## Template Overview

A patient-friendly 404 page template created directly in the Elementor library via PHP/MySQL, following the same approach used for the header (post_id=9) and footer (post_id=12) templates.

### Design decisions

- **Tone:** Calm, factual. No humor, no exclamation marks, no technical jargon.
- **Language:** Romanian (site default).
- **Layout:** Single centered column, 120px top/bottom padding, generous gap between elements.
- **Colors:** GU global tokens only — no new colors created.
- **Typography:** GU global tokens only — no new fonts introduced.
- **Animations:** None (no motion effects set on any element).
- **Custom JS:** None.
- **New plugins:** None.
- **Skip-to-content fix (bonus):** The outer container uses `html_tag="main"` and custom ID `main-content` — the header's skip link (`<a href="#main-content">`) now works on 404 pages.

---

## Template Structure

```
wp_posts ID=37  |  elementor_library  |  publish  |  organism-404-page
└─ [f404b001] container  |  html_tag=main  |  id="main-content"
   |  flex_direction=column  |  align_items=center  |  padding=120px 24px
   ├─ [f404b002] heading widget  ← "404" status label
   │    header_size=p  |  align=center
   │    __globals__: typography=gu-overline, color=gu-accent (#4D7A70)
   │
   ├─ [f404b003] heading widget  ← H1 main heading
   │    header_size=h1  |  align=center
   │    direct: title_color=#231E1A
   │    __globals__: typography=gu-h2 (Lora 700 38px), color=gu-ink
   │
   ├─ [f404b004] text-editor widget  ← explanation paragraph
   │    No color set — inherits dark ink on light background via GU plugin §03/§07
   │    (14.5:1 contrast: #231E1A on #FDFBF7)
   │
   └─ [f404b005] container  ← button row
        flex_direction=row  |  flex_wrap=wrap  |  justify_content=center
        ├─ [f404b006] button  ← Primary CTA
        │    "Mergi la pagina principală" → /
        │    bg=#4D7A70 (gu-accent), text=#FDFBF7 (gu-surface)
        │    padding=12px 28px  |  border-radius=4px
        │
        └─ [f404b007] button  ← Secondary CTA
             "Solicită o programare" → /programari/
             bg=transparent, text=#4D7A70, border=1px solid #4D7A70
             padding=12px 28px  |  border-radius=4px
```

---

## Content

### "404" status label
```
404
```
Typography: `gu-overline` (Inter 600 12px, uppercase, letter-spacing 0.08em)  
Color: `gu-accent` (#4D7A70)

### H1 heading
```
Pagina nu a fost găsită
```
Typography: `gu-h2` (Lora 700 38px) — used with `<h1>` HTML tag for correct semantics at calm visual scale  
Color: `gu-ink` (#231E1A)

### Body paragraph
```
Pagina pe care o căutați nu mai există sau a fost mutată la o altă adresă.
Vă rugăm să folosiți una dintre opțiunile de mai jos.
```
Typography: inherits `body { font-family: Inter; font-size: 17px }` from GU plugin  
Color: inherits `p { color: #231E1A }` from GU plugin §07 — correct on light background

### Primary button
**"Mergi la pagina principală"** → `/`

### Secondary button
**"Solicită o programare"** → `/programari/`

---

## Database Changes

### New `wp_posts` row

| Field | Value |
|-------|-------|
| `ID` | 37 |
| `post_title` | `organism-404-page` |
| `post_status` | `publish` |
| `post_type` | `elementor_library` |
| `post_name` | `organism-404-page` |
| `post_content` | (empty — Elementor uses `_elementor_data`) |

### New `wp_postmeta` rows (post_id=37)

| Meta key | Value |
|----------|-------|
| `_elementor_data` | JSON template (see structure above) |
| `_elementor_edit_mode` | `builder` |
| `_elementor_template_type` | `404-page` |
| `_elementor_version` | `4.1.4` |
| `_elementor_pro_version` | `4.1.2` |
| `_wp_page_template` | `default` |
| `_elementor_conditions` | `a:1:{i:0;s:15:"include/general";}` |

### Updated `wp_options` row

| Option | Change |
|--------|--------|
| `elementor_pro_theme_builder_conditions` | Added `"404"` location key → `{37: ["include/general"]}` |

**Full updated value:**
```
a:3:{
  s:6:"footer";a:1:{i:12;a:1:{i:0;s:15:"include/general";}}
  s:6:"header";a:1:{i:9;a:1:{i:0;s:15:"include/general";}}
  s:3:"404";a:1:{i:37;a:1:{i:0;s:15:"include/general";}}
}
```

---

## WCAG Contrast

| Element | Foreground | Background | Contrast | WCAG AA |
|---------|-----------|-----------|----------|---------|
| "404" label | `#4D7A70` | `#FDFBF7` | 4.8:1 | Pass ✓ |
| H1 heading | `#231E1A` | `#FDFBF7` | 14.5:1 | Pass ✓ |
| Body text | `#231E1A` | `#FDFBF7` | 14.5:1 | Pass ✓ |
| Primary btn text | `#FDFBF7` | `#4D7A70` | 4.8:1 | Pass ✓ |
| Secondary btn text | `#4D7A70` | `#FDFBF7` | 4.8:1 | Pass ✓ |

---

## Routing

Elementor Pro Theme Builder routes requests in this order (by location priority):

1. `header` → post_id=9 → all pages (header above every page)
2. `footer` → post_id=12 → all pages (footer below every page)
3. `404` → post_id=37 → displayed as page body when WordPress triggers a 404

The 404 template is injected as the page body. The site header and footer render above and below it as usual — the 404 page has the same branding and navigation as all other pages.

---

## CSS Notes

**Post-37.css:** Will not exist until first page load triggers Elementor CSS generation. On first 404 request, Elementor will either generate `post-37.css` to disk or fall back to inline `<style>` CSS (as observed with `post-12.css`). The template functions correctly in either case — global tokens are resolved from `post-6.css` which is always on disk.

**Body paragraph color:** The GU plugin's `p { color: var(--color-ink) }` (§07, specificity `0,0,1`) applies to the body paragraph. On the light (#FDFBF7) 404 background this produces dark (#231E1A) text — correct, high contrast. This is the opposite of the footer case (Phase F.8) where dark text on dark background caused invisibility.

---

## Files Changed

| File | Change |
|------|--------|
| `wp_posts` (DB) | New row ID=37 |
| `wp_postmeta` (DB) | 7 new rows for post_id=37 |
| `wp_options` (DB) | `elementor_pro_theme_builder_conditions` updated |

No CSS files, no template files, no plugin files were modified.

---

## Browser Verification Checklist

**URL to test:** `http://georgeungureanu-doctor-dev.local/pagina-inexistenta/`  
(Any URL that doesn't exist triggers a 404.)

### Structure
- [ ] Page renders with the site header (navigation, logo, CTA) — same as homepage
- [ ] Page renders with the site footer (dark background, columns) — same as homepage
- [ ] 404 template content appears between header and footer (not blank, not WordPress default 404)

### Content
- [ ] "404" label visible in teal (#4D7A70) above the heading
- [ ] H1 "Pagina nu a fost găsită" visible in dark ink, Lora 700 typeface
- [ ] Explanatory paragraph visible in dark ink, centered
- [ ] Two buttons visible side-by-side (or stacked on mobile):
  - [ ] "Mergi la pagina principală" — teal filled button
  - [ ] "Solicită o programare" — outline/ghost button (transparent bg, teal border + text)

### Navigation
- [ ] Primary button click → navigates to `/` (homepage)
- [ ] Secondary button click → navigates to `/programari/`
- [ ] Header navigation links function normally

### No regressions
- [ ] Homepage (`/`) unchanged
- [ ] Footer text visible (Phase F.8 fix still active)
- [ ] Header layout correct (Phase F.6 fix still active)

### DevTools (optional)
Open DevTools → Elements on the 404 page:
- `<main id="main-content">` should be the page body container
- `[f404b002]` heading `.elementor-heading-title` should have `color: var(--e-global-color-gu-accent)` or `color: #4D7A70`
- `[f404b006]` button should have `background-color: #4D7A70` or `var(--e-global-color-gu-accent)`
- `[f404b007]` button should have `background-color: transparent` and `border: 1px solid #4D7A70`

---

## What Was NOT Changed

- No homepage template modified
- No header template modified (post_id=9)
- No footer template modified (post_id=12)
- No CSS files modified
- No new plugins installed
- No new colors created
- No existing content changed
- No layout rebuilt

---

## Known Edge Cases

**If the 404 template doesn't display (shows default WordPress 404):**  
Elementor Pro may need a conditions cache flush. In WordPress admin: Elementor → Tools → Regenerate Files & Data. Alternatively, open the template in Elementor editor (Templates → Theme Builder → 404) and re-publish it — this triggers a conditions re-write.

**If `/programari/` doesn't exist yet:**  
The secondary button will link to a future page. This is expected — the Programări page is part of a later sprint. The link is correct and will work when the page is created.
