# Sprint 9.7B — Restore Sfatul Neurochirurgului Brand Pillar
**Status:** COMPLETE — awaiting browser verification and commit approval  
**Date:** 2026-07-01  
**QA result:** 78 PASS / 0 FAIL — zero failures across 5 pages × 3 viewports  
**Files changed:** `gu-design-system.php` (2 surgical edits), `assets/js/gu-header.js` (+28 lines)

---

## Context

The educational hub CPT (`articole`) was being presented publicly as "Articole" — a generic, technical label. The brand pillar for this section is **Sfatul Neurochirurgului** (The Neurosurgeon's Advice), which positions it as authoritative patient education rather than a generic article list.

This sprint was CSS/JS/PHP only. CPT slug (`articole`), permalinks, and Elementor templates were not touched.

---

## What Changed

### 1. Header Navigation — PHP (`gu-design-system.php`)

```php
// Before
'Articole' => home_url( '/articole/' ),

// After
'Sfatul Neurochirurgului' => home_url( '/articole/' ),
```

URL unchanged: `/articole/`. Label updated in both desktop nav and mobile drawer (both iterate the same `$nav_items` array — one change covers both).

### 2. Schema.org Breadcrumb — PHP (`gu-design-system.php`)

The JSON-LD `BreadcrumbList` on article single pages had position 2 as `"Articole"`. Updated to match the public brand name:

```php
// Before
[ '@type' => 'ListItem', 'position' => 2, 'name' => 'Articole', 'item' => $archive_url ],

// After
[ '@type' => 'ListItem', 'position' => 2, 'name' => 'Sfatul Neurochirurgului', 'item' => $archive_url ],
```

Structural data now consistent with the visible UI brand.

### 3. Elementor Archive Hero H1 — JS (`gu-header.js`)

The archive template heading widget (`s7ar003`) had hardcoded text: `"Articole pentru Pacienți"`. Without rebuilding the Elementor template, replaced via targeted DOM mutation on `DOMContentLoaded`:

```js
var archiveH1 = document.querySelector(
  '.elementor-element-s7ar003 h1.elementor-heading-title'
);
if (archiveH1 && /articole/i.test(archiveH1.textContent)) {
  archiveH1.textContent = 'Sfatul Neurochirurgului';
}
```

The guard (`/articole/i.test(...)`) ensures the replacement is idempotent and safe if the Elementor template is later updated by hand.

### 4. Footer CTA Link — JS (`gu-header.js`)

The footer "SFATUL NEUROCHIRURGULUI" column already had the correct column heading (confirmed via DOM audit). The CTA link within it (`ce0da850`) still read `"Toate articolele →"`. Updated via JS to the editorial label:

```js
var footerCta = document.querySelector('.elementor-element-ce0da850 a');
if (footerCta && /articole/i.test(footerCta.textContent)) {
  footerCta.textContent = 'Explorează Sfatul Neurochirurgului';
}
```

---

## What Was NOT Changed

| Item | Reason |
|------|--------|
| CPT slug `articole` | Not in scope — permalinks preserved |
| `/articole/{slug}/` URLs | Not in scope |
| Elementor templates | No rebuilds — JS replacement only |
| Article card "Citește articolul →" links | Contextually correct — refers to a specific article |
| Footer column heading "SFATUL NEUROCHIRURGULUI" | Already correct before this sprint |
| Admin labels in WP dashboard | No need — CPT internal labels not patient-facing |

---

## Pre-Sprint DOM Audit Findings

Before writing any code, Playwright confirmed:

| Location | Text found | Source | Action |
|----------|-----------|--------|--------|
| Header nav | `"Articole"` | PHP `$nav_items` | Updated PHP |
| Mobile drawer | `"Articole"` | Same PHP array | Updated automatically |
| Archive h1 | `"Articole pentru Pacienți"` | Elementor widget `s7ar003` | JS replacement |
| Footer CTA link | `"Toate articolele →"` | Elementor widget `ce0da850` | JS replacement |
| Footer column heading | `"SFATUL NEUROCHIRURGULUI"` | Elementor widget `086316b5` | Already correct — no change |
| Schema JSON-LD | `"Articole"` (BreadcrumbList position 2) | PHP `wp_head` action | Updated PHP |

---

## QA Results

**Total: 78 PASS / 0 FAIL**  
**Pages:** `/`, `/articole/`, `/articole/hernia-de-disc-lombara/`, `/programari/`, `/despre/`  
**Viewports:** 1440px · 768px · 390px

### Checks per page (5–6 checks per page):

| Check | Description |
|-------|-------------|
| 1 | Desktop nav contains "Sfatul Neurochirurgului" |
| 2 | Mobile drawer contains "Sfatul Neurochirurgului" |
| 3 | No bare "Articole" label in nav or footer |
| 4 | Footer CTA link text = "Explorează Sfatul Neurochirurgului" |
| 5 | Archive h1 = "Sfatul Neurochirurgului" (archive page only) |
| 6 | No new horizontal overflow introduced |

Pre-existing overflows (programari@768 scrollWidth=774, articole-single@390 scrollWidth=471) unchanged — not caused by this sprint.

---

## Files Changed

| File | Change |
|------|--------|
| `gu-design-system.php` | Line 1212: nav key `'Articole'` → `'Sfatul Neurochirurgului'` |
| `gu-design-system.php` | Line 779: breadcrumb item name `'Articole'` → `'Sfatul Neurochirurgului'` |
| `assets/js/gu-header.js` | Added `normaliseBrandLabels()` function (28 lines) |

---

## Browser Review Checklist

- [ ] Header shows "Sfatul Neurochirurgului" as the 4th nav link (not "Articole")
- [ ] Mobile drawer (tap ≡ on 390px) shows "Sfatul Neurochirurgului"
- [ ] `/articole/` hero h1 reads "Sfatul Neurochirurgului" (not "Articole pentru Pacienți")
- [ ] Footer "SFATUL NEUROCHIRURGULUI" column has "Explorează Sfatul Neurochirurgului" as the link
- [ ] Clicking the nav link navigates correctly to `/articole/`
- [ ] Active nav state lights up when on `/articole/` and `/articole/hernia-de-disc-lombara/`

> Do not publish AI-generated medical content without explicit human review.

**Next step:** Browser verification by Dr. George Ungureanu. Do not commit until approved.
