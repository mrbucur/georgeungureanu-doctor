# Sprint 9.10 — Apple Health Design System Migration
**Status:** COMPLETE (9.10 + 9.10B) — awaiting browser review  
**Date:** 2026-07-01  
**QA result:** 9.10 — 45 PASS / 0 FAIL | 9.10B — 50 PASS / 0 FAIL  
**Pages tested:** All 10 pages × computed bg/text audit + screenshots

---

## Design Direction

**Deprecated aesthetic:** Warm luxury — beige palette, brown tones, dark hero backgrounds, sage-green accents.  
**New direction:** Apple Health / Apple.com — light-first, white space, precision, quiet confidence.

Design principles applied:
- White surfaces everywhere. No warm cream, no beige.
- One accent color (blue-teal), used sparingly for interactive elements only.
- Soft depth via subtle shadows and borders, never color fills.
- Editorial typography with large Lora headings on white.
- Translucent white header blur — no solid color backgrounds.

---

## Color Token Changes

### Deprecated tokens (removed)

| Old value | Role | Replacement |
|-----------|------|-------------|
| `#3D6B5E` | Sage green primary accent | `#0E7FC0` |
| `#4D7A70` | Sage green secondary | `#0E7FC0` |
| `#2D5048` | Sage green dark | `#0B6094` |
| `#3A5F57` | Sage green hover | `#0B6094` |
| `rgba(61,107,94,...)` | Sage green rgba variants | `rgba(14,127,192,...)` |
| `rgba(77,122,112,...)` | Sage green rgba variants | `rgba(14,127,192,...)` |
| `#231E1A` | Dark espresso bg | `#1D1D1F` |
| `#FDFBF7` | Warm cream bg | `#FFFFFF` |
| `#F4EFE6` | Warm parchment bg | `#F5F5F7` |
| `#EDE8DF` | Warm beige bg | `#F5F5F7` |
| `#D6CFC4` | Warm taupe border | `rgba(0,0,0,0.06)` |
| `#5A4E47` | Warm brown text | `#6E6E73` |
| `rgba(35,30,26,...)` | Dark espresso rgba | `rgba(0,0,0,...)` |
| `rgba(253,251,247,...)` | Warm cream rgba | `rgba(255,255,255,...)` |

### New `:root` token system

```css
/* COLORS — Apple Health palette */
--color-ink:           #1D1D1F;   /* sf-black — primary text */
--color-ink-secondary: #424245;   /* medium grey — secondary text */
--color-ink-tertiary:  #6E6E73;   /* light grey — captions, meta */
--color-surface:       #FFFFFF;   /* pure white */
--color-surface-warm:  #F5F5F7;   /* off-white — alternate sections */
--color-surface-muted: #FBFBFD;   /* near-white — input backgrounds */
--color-accent:        #0E7FC0;   /* blue-teal — buttons, links, highlights */
--color-accent-hover:  #0B6094;   /* darker blue-teal on hover */
--color-accent-subtle: #E3F2FA;   /* very light blue tint — truth cards */
--color-border:        #D2D2D7;   /* system grey border */
--color-border-strong: #C7C7CC;   /* stronger border */
--color-overlay:       rgba(0, 0, 0, 0.50);

/* RADIUS TOKENS — Apple scale */
--radius-sm: 6px;    /* tags, chips */
--radius-md: 10px;   /* buttons, inputs */
--radius-lg: 16px;   /* cards, panels */
```

---

## Component Changes

### Header
- Background: `rgba(255,255,255,0.90)` (was warm cream `rgba(253,251,247,0.96)`)
- Compact state: `rgba(255,255,255,0.95)` with border `rgba(0,0,0,0.08)`
- Nav link hover: `rgba(14,127,192,0.07)` (was sage rgba)
- CTA button: `#0E7FC0` (was `#3D6B5E`)

### Buttons (`.gu-btn`)
- Border-radius: `var(--radius-md)` = 10px (was 8px with deprecated green)
- Accent color: `#0E7FC0` throughout
- Hover: `#0B6094`

### Cards
- `.gu-afectiuni-card` — added class to `<article>` elements (was unstyled)
- `.gu-interventii-card` — added class to `<article>` elements (was unstyled)
- Both: inline `border-radius:16px; background:#FFFFFF; border:1px solid rgba(0,0,0,.06)`
- Text color corrected: `#6E6E73` (was `#5A5550` — deprecated warm tone)

### Sfatul Hub — Section 30 CSS
- Truth card background: `#EEF6FC` (blue tint, was `#F0F6F4` green tint)
- Hub nav pill accent: `#0E7FC0`
- All guide block and recovery card colors migrated to Apple Health palette

### Radius tokens
- Section 32 Elementor override: `--radius-lg: 12px` in `.page-sfatul-hub` context — retained (12px is still Apple-scale for compact hub elements)

---

## Files Changed

| File | Changes |
|------|---------|
| `gu-design-system.css` | `:root` block rewritten; all deprecated color values replaced; Section 30 hub colors migrated; stale dark-hero comment cleaned |
| `gu-design-system.php` | `<article>` tags in afecțiuni/intervenții archives: added class names, fixed text color `#5A5550`→`#6E6E73` |

---

## Pages Affected

All pages that load `gu-design-system.css`:
- `/` Homepage
- `/afectiuni/` and all afecțiuni CPT pages
- `/interventii/` and all intervenții CPT pages
- `/programari/`
- `/articole/` (Sfatul Neurochirurgului hub)
- `/recomandari/`
- `/despre/`
- 404 page

---

## QA Results — 45 PASS / 0 FAIL

### [Homepage] /
- ✓ No dark hero bg
- ✓ No warm cream bg
- ✓ No sage green
- ✓ No horizontal overflow
- ✓ Body not warm cream
- ✓ Hero button radius ≥ 8px

### [Afecțiuni] /afectiuni/
- ✓ No sage green
- ✓ No overflow
- ✓ Header present
- ✓ Card border-radius ≥ 12px (12px — inline style)
- ✓ Card white background

### [Intervenții] /interventii/
- ✓ No sage green, no overflow, header present
- ✓ Card border-radius ≥ 12px

### [Programări] /programari/
- ✓ No sage green, no overflow
- ✓ Header CTA blue-teal #0E7FC0
- ✓ Header not warm cream

### [Sfatul Hub] /articole/
- ✓ No sage green, no overflow
- ✓ Hub nav pills ≥ 2 present
- ✓ H1 "Sfatul Neurochirurgului"

### [Recomandări] /recomandari/
- ✓ No sage green, no warm cream bg, no overflow, header present

### [Despre] /despre/
- ✓ No sage green, no warm cream bg, no overflow, header present

### [Mobile 390px] Homepage + Sfatul
- ✓ No overflow at mobile viewport

### [CSS Token Audit]
- ✓ No deprecated hex values (#3D6B5E, #4D7A70, #2D5048, #231E1A, #FDFBF7)
- ✓ No sage rgba variants in CSS
- ✓ `#0E7FC0` accent present
- ✓ `--color-accent` token defined
- ✓ `--radius-lg: 16px` defined

---

## Browser Review Checklist

Open `http://georgeungureanu-doctor-dev.local/` at 1440px desktop:

- [ ] Hero: white/light background, no dark overlay
- [ ] Hero headline: Lora serif, large editorial style
- [ ] Hero CTA button: blue-teal (#0E7FC0), 10px radius
- [ ] Header: translucent white blur (not cream)
- [ ] Nav links: dark grey text (#1D1D1F), blue hover
- [ ] Header CTA: blue-teal background
- [ ] Page sections alternate white ↔ off-white (#F5F5F7)
- [ ] No warm beige, brown, or sage green anywhere

Open `/programari/`, `/recomandari/`, `/despre/`:
- [ ] Consistent light palette, no warm tones
- [ ] Header identical across all pages

Open `/afectiuni/` or `/interventii/` with demo content:
- [ ] Cards: white bg, 16px radius, subtle border
- [ ] Card excerpt text: `#6E6E73` (not warm brown)

Open `/articole/` (Sfatul Hub):
- [ ] Hub nav pills: blue-teal accent
- [ ] Truth cards: light blue tint (#EEF6FC)
- [ ] No green anywhere in the hub

> **Do not commit automatically. Stop for browser review.**

---

## 9.10B — Legacy Beige Cleanup

**Date:** 2026-07-01  
**Trigger:** Browser review after 9.10 revealed beige/warm surfaces still present on Elementor-rendered pages, despite CSS token migration. Root cause: legacy hex values embedded in Elementor `_elementor_data` JSON in the WordPress database — these override CSS variables via Elementor's inline style output.

### Pages checked (visual + computed style audit)

| Page | Legacy colors found | Status |
|------|---------------------|--------|
| `/` Homepage (post 38) | `#FDFBF7` bg ×9, `#231E1A` ×16, `#D6CFC4` ×7, `#4D7A70` ×4 | Fixed |
| `/afectiuni/` archive (post 53) | `#FDFBF7` ×1, `#231E1A` ×1, `#F4EFE6` ×1 | Fixed |
| `/afectiuni/hernie-de-disc-lombara/` (post 52) | `#FDFBF7` bg ×4, text ×2, `#231E1A` ×11, `#5A5550` ×6, `#F4EFE6` ×1 | Fixed |
| `/interventii/` archive (post 70) | `#FDFBF7` ×1, `#231E1A` ×1, `#F4EFE6` ×1 | Fixed |
| `/interventii/microdiscectomie-lombara/` (post 69) | `#FDFBF7` bg ×1, text ×3, `#231E1A` ×10, `#4D7A70` ×1, `#F4EFE6` ×2 | Fixed |
| `/articole/hernia-de-disc-lombara/` (post 112) | `#FDFBF7` bg ×2, text ×5, `#231E1A` ×4, `#4D7A70` ×1, `#3A5F57` ×1, `#F4EFE6` ×4 | Fixed |
| `/despre/` (post 116) | `#FDFBF7` bg ×4, `#231E1A` ×2, `#F4EFE6` ×4 | Fixed |
| Footer (post 12) | `#D6CFC4` ×3 | Fixed |
| 404 (post 37) | `#FDFBF7` ×1, `#231E1A` ×1, `#4D7A70` ×3 | Fixed |
| `/articole/`, `/programari/`, `/recomandari/` | Already clean (shortcode-rendered) | N/A |

### Legacy colors found and replaced

All colors replaced in `_elementor_data` for 9 posts (DB hex-literal write — no escaping issues):

| Old value | Context | New value |
|-----------|---------|-----------|
| `#FDFBF7` | `background_color` | `#F5F5F7` |
| `#FDFBF7` | `title_color`, `text_color`, `button_text_color`, `hover_color` | `#FFFFFF` |
| `#231E1A` | All contexts | `#1D1D1F` |
| `#5A5550` | Text colors | `#6E6E73` |
| `#D6CFC4` | Text colors (footer) | `#D2D2D7` |
| `#4D7A70`, `#3A5F57` | Accent colors | `#0E7FC0` |
| `#F4EFE6`, `#EDE8DF` | Background colors | `#F5F5F7` |

### Files / systems changed

| Layer | What changed |
|-------|-------------|
| WordPress DB `wp_postmeta._elementor_data` | 9 posts patched via Python hex-literal MySQL writes |
| Elementor CSS cache | All `post-*.css` files deleted after each patch; auto-regenerated on first page load |
| `gu-design-system.php` | `<article>` elements in afectiuni/interventii archives: added `class="gu-afectiuni-card"` / `class="gu-interventii-card"`, corrected text color `#5A5550`→`#6E6E73` |

### Technical note — MySQL write safety

**Bug discovered and fixed in this sprint:** MySQL batch output (`--batch --skip-column-names`) doubles backslashes on output (e.g., stored `\"` → output `\\"` as 3 chars). Writing this back with an additional `replace('\\', '\\\\')` resulted in 4× backslash multiplication, breaking Elementor's JSON.

**Fix:** All DB writes in this sprint use `0x{hex_literal}` syntax, which transfers exact bytes with zero SQL string escaping. All reads use `SELECT HEX(meta_value)` and `bytes.fromhex()` for exact byte retrieval.

**Template restoration:** Posts 37, 52, 53, 69, 70, 112, 116, 12 were restored from source JSON template files (`.content` key extracted). Post 38 (homepage, no template file) was repaired in-place with `re.sub(r'\\\\', r'\\', data)` to undo one level of backslash doubling, validated with `json.loads()` before writing.

### QA — 9.10B Final

**50 PASS / 0 FAIL** across 10 pages.

Checks per page: overflow, header present, computed background colors (no legacy warm values), computed text colors (no sage green / warm brown), page source (no legacy hex in inline styles).

CSS token audit (from 9.10): 10/10 PASS — all deprecated hex values absent from `gu-design-system.css`.

Screenshots taken: all 10 pages at 1440px, full-page.
