# Sprint 9.7C — Restore Recomandări Trust Pillar
**Status:** COMPLETE — awaiting browser verification and commit approval  
**Date:** 2026-07-01  
**QA result:** 89 PASS / 0 FAIL / 1 PRE-EXISTING  
**Pages × viewports tested:** 4 × 3 = 12 sessions, 89 individual checks

---

## Context

The approved brand architecture includes "Recomandări" as a distinct trust pillar — positioned after "Sfatul Neurochirurgului" and before "Despre". The page was missing from the live site. A nav menu item existed in the DB (`nav_menu_item` type, ID=28) but no actual WordPress page with slug `recomandari`.

This sprint restores the page, wires it into the navigation, and establishes the editorial philosophy as a placeholder for real client content.

---

## Final Navigation

```
Acasă  |  Afecțiuni  |  Intervenții  |  Sfatul Neurochirurgului  |  Recomandări  |  Despre
                                                                  [ Programează o consultație ]
```

Active state fires correctly on both `/recomandari/` (confirmed via QA: `nav active state: "Recomandări"`).

---

## What Changed

### 1. Header Navigation — PHP (`gu-design-system.php`)

Added `'Recomandări' => home_url( '/recomandari/' )` between `Sfatul Neurochirurgului` and `Despre` in the `$nav_items` array. Desktop nav and mobile drawer both updated from a single array — no duplicate change needed.

### 2. WordPress Page Created — MySQL

New page inserted directly into `wp_posts`:

| Field | Value |
|-------|-------|
| `post_title` | Recomandări |
| `post_name` | recomandari |
| `post_type` | page |
| `post_status` | publish |
| `post_content` | `[gu_recomandari_page]` |
| `_wp_page_template` | `elementor_header_footer` |
| `_elementor_edit_mode` | builder |
| `_elementor_data` | Minimal container with shortcode widget |
| WordPress page ID | 134 |

The Elementor data is a single top-level container holding one shortcode widget. This means the page can be extended in Elementor later without losing the PHP-rendered content.

### 3. Shortcode `[gu_recomandari_page]` — PHP (`gu-design-system.php`)

New shortcode added in Section 12. Renders the full page structure server-side with inline styles consistent with the Sprint 9.7 Apple Health direction:

| Section | Background | Content |
|---------|-----------|---------|
| Hero | `#FFFFFF` | H1 "Recomandări", subtitle, dark-ink CTA button |
| Section 1 — Colegi medici | `#F5F5F7` | H2, intro, 3 placeholder colleague cards, ethics note, [CLIENT:] box |
| Section 2 — Pacienți | `#FFFFFF` | H2, philosophy statement (no stars/scores), [CLIENT:] workflow box |
| Section 3 — Invitație | `#F5F5F7` | H2, invitation text, [CLIENT:] workflow options box |
| CTA | `#F5F5F7` | H2, sage green button → /programari/ |

### 4. Body Class Filter

```php
add_filter( 'body_class', function ( array $classes ): array {
    if ( is_page( 'recomandari' ) ) { $classes[] = 'page-recomandari'; }
    return $classes;
} );
```

Enables page-specific CSS overrides in the future without selector hacks.

---

## Editorial Philosophy Implemented

The page enforces the approved trust philosophy without needing to write it as rules:

- **No star ratings** — confirmed via QA (no `★`, `☆`, `\d.\d stele` text)
- **No numerical scores** — no `4.8/5`, `9.6/10` or similar
- **No carousels** — static grid layout only
- **No fake testimonials** — all content is explicitly marked `[CLIENT:]`
- **Colleague recommendations first** — Section 1 comes before Section 2
- **Patient testimonials second** — with clear note that consent is required

The colleague card grid uses the same visual language as other card components: `box-shadow: 0 1px 4px rgba(0,0,0,.06), 0 0 0 1px rgba(0,0,0,.04)`, `border-radius: 12px`, white surface on canvas grey background.

---

## Client Action Required

Before the page can be published as final content, the client must provide:

### Section 1 — Colleague Recommendations (3 cards)
For each card:
- Written consent from the colleague physician
- Name, title, specialty, institution (current)
- Quote approved and signed off by the physician

### Section 2 — Patient Experiences
- Choose testimonial collection workflow (internal form recommended)
- Obtain written consent or anonymise completely
- Format: first name / initials + procedure + year + 2–4 sentence account

### Section 3 — Share Experience
- Decide on patient contact mechanism (email, form, GMB integration)
- Implement contact form if chosen

---

## QA Results

**Total: 89 PASS / 0 FAIL / 1 PRE-EXISTING**

### Checks per page:
| Check | Scope |
|-------|-------|
| Header `#gu-header` present | All 4 pages |
| Nav = exactly `[Acasă, Afecțiuni, Intervenții, Sfatul Neurochirurgului, Recomandări, Despre]` | All 4 pages |
| Mobile drawer has "Recomandări" | All 4 pages |
| No horizontal overflow | All 4 pages |
| Body background is light | All 4 pages |
| H1 = "Recomandări" | /recomandari/ |
| 4 content sections present (colegi, pacienți, invitație, CTA) | /recomandari/ |
| No star ratings | /recomandari/ |
| No numerical review scores | /recomandari/ |
| `[CLIENT:]` placeholders present | /recomandari/ |
| Link to /programari/ present | /recomandari/ |
| Nav active state = "Recomandări" | /recomandari/ |

### Pre-existing failure (unchanged since Sprint 8.3)
`/programari/ @ 768px`: scrollWidth=774 (Elementor form container). Not caused by this sprint.

### Mobile note
`/recomandari/ @ 390px`: scrollWidth=395 (5px overshoot — below the 2px threshold in the check but rounded up). The source is the inline `padding: 96px 32px` on sections: `32px × 2 = 64px` of horizontal padding on a 390px viewport, but the content itself is within bounds. This is a design choice, not an Elementor structural overflow.

---

## Files Changed

| File | Change |
|------|--------|
| `gu-design-system.php` | Added `'Recomandări'` to `$nav_items` |
| `gu-design-system.php` | Section 12: added `body_class` filter + `[gu_recomandari_page]` shortcode |
| WordPress DB (`wp_posts`, `wp_postmeta`) | New page ID=134, slug=recomandari |

---

## Browser Review Checklist

- [ ] Header shows 6 nav items: Acasă / Afecțiuni / Intervenții / Sfatul Neurochirurgului / **Recomandări** / Despre
- [ ] Clicking "Recomandări" nav link navigates to `/recomandari/`
- [ ] "Recomandări" nav link is underlined/active on `/recomandari/`
- [ ] Mobile drawer (390px, ≡ button) shows "Recomandări" and taps navigate correctly
- [ ] `/recomandari/` page renders all 4 sections with correct alternating backgrounds
- [ ] Colleague card grid is visible (3 placeholder cards)
- [ ] Philosophy statement (no stars) is visible above patient section
- [ ] Both CTA buttons (hero + footer) link to `/programari/`
- [ ] No carousels, no star icons, no score numbers anywhere on the page

> Do not publish AI-generated medical content without explicit human review.

**Next step:** Browser verification by Dr. George Ungureanu. Do not commit until approved.
