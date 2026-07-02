# Sprint 10.5 — Native Child Theme Core Templates

**Date:** 2026-07-02
**Status:** Complete — pending commit

---

## Files created / updated

### Theme templates (new)

| File | URL | Notes |
|---|---|---|
| `archive-afectiuni.php` | `/afectiuni/` | CPT archive, grid + empty state |
| `archive-interventii.php` | `/interventii/` | CPT archive, grid + empty state |
| `archive-articole.php` | `/articole/` | CPT archive, reading time badge, empty state |
| `single-afectiuni.php` | `/afectiuni/{slug}/` | ACF sections by name |
| `single-interventii.php` | `/interventii/{slug}/` | ACF sections by field key (names empty in JSON) |
| `single-articole.php` | `/articole/{slug}/` | Author, reading time, takeaways, FAQ pairs, related posts |
| `page-despre.php` | `/despre/` | Profile, portrait placeholder, credentials, philosophy, timeline |
| `page-programari.php` | `/programari/` | 2 clinics, Cal.com placeholder, FAQ, CTA |
| `page-recomandari.php` | `/recomandari/` | Doctor reco grid, patient experience grid, CTA |

### Theme files updated

| File | Change |
|---|---|
| `assets/css/theme.css` | Rebuilt — light footer, + archive/single/page template CSS |

### Footer

Footer HTML unchanged (same `footer.php`). CSS rebuilt from dark to light:
- Background: `#F2F2F7` (was `#1D1D1F`)
- Text: `#424245` (was `#A1A1A6`)
- Links hover: `var(--color-accent)` (was `#FFFFFF`)
- Bottom bar: `#FFFFFF` with `rgba(0,0,0,0.08)` top border

---

## Design tokens used

All values are from the plugin's `--color-*` variables:
- Ink: `#1D1D1F` / secondary `#424245` / tertiary `#6E6E73`
- Surfaces: `#FFFFFF` / warm `#F5F5F7` / gray `#F2F2F7`
- Accent: `#0E7FC0` / hover `#0B6094`
- Font: `var(--font-sans)` (Inter)

---

## ACF field access

| CPT | Field access method | Reason |
|---|---|---|
| `afectiuni` | `get_field('name')` — by name | `group_mc.json` has populated `name` fields |
| `interventii` | `get_field('field_sp_*')` — by key | `group_sp.json` `name` fields are empty; keys are `field_sp_subtitle` etc. |
| `articole` | `get_field('name')` — by name | `group_ar.json` has populated `name` fields |

All ACF calls wrapped in `function_exists('get_field')` guard.  
All templates fall back gracefully to `get_the_excerpt()` if ACF is unavailable.

---

## Known placeholders (CLIENT_CONTENT)

All marked with `[CLIENT_CONTENT]` inline in templates.

### page-programari.php
- Clinic names (Cluj-Napoca, Baia Mare)
- Street addresses
- Phone numbers  
- Office hours
- Cal.com username → replace `[CALCOM_USERNAME]` with actual value
- FAQ answer for decontare CNAS — confirm with clinic

### page-despre.php
- Portrait photograph
- Biography text
- University / year of graduation
- Hospital / department affiliation
- Years of experience
- Professional society memberships
- Timeline items (year, institution, role) — 3 placeholder slots

### page-recomandari.php
- 4 doctor recommendation cards (quote, name, specialty, institution)
- 4 patient experience cards (quote, initials, condition type)

---

## Staging test checklist

After `git push` + cPanel Update from Remote + Flush Permalinks:

- [ ] `/afectiuni/` — renders "Afecțiuni neurochirurgicale" (not "Archives: Afecțiuni")
- [ ] `/afectiuni/` — empty state shown if no CPT posts exist
- [ ] `/afectiuni/{slug}/` — single renders title + ACF sections (or content)
- [ ] `/interventii/` — renders "Intervenții neurochirurgicale"
- [ ] `/interventii/{slug}/` — single renders; ACF accessed by field_sp_* keys
- [ ] `/articole/` — renders "Sfatul Neurochirurgului" (not "Archives:")
- [ ] `/articole/{slug}/` — reading time, takeaways, FAQ, CTA visible
- [ ] `/despre/` — profile, credentials, timeline sections visible; placeholders shown
- [ ] `/programari/` — two clinic blocks, online section placeholder, FAQ, CTA
- [ ] `/recomandari/` — two grids (doctors, patients), placeholders shown
- [ ] Footer — light background (`#F2F2F7`), readable text, no dark styling
- [ ] All pages — 72px top offset respected (from plugin body padding)
- [ ] All pages — mobile layout correct at 375px and 768px
- [ ] No "Archives:" prefix on any archive page title
- [ ] No default WordPress fallback styling on any page

---

## What was NOT changed

- `front-page.php` — homepage template unchanged
- `functions.php` — no changes needed; theme.css is already enqueued
- Plugin (`gu-design-system.php`) — no changes
- CPT registrations — no changes
- ACF field groups — no changes
