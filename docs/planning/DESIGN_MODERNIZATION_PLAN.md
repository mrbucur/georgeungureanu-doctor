# Design Modernization Plan — Sprint 8.2
**Status:** APPROVED FOR PLANNING — awaiting implementation approval  
**Date:** 2026-06-30  
**Input:** `docs/implementation/SPRINT_8_1_VISUAL_DIAGNOSTIC.md`  
**Scope:** Evolutionary refinement — fix implementation gaps, enforce existing design tokens, add missing components  
**Constraint:** No structural changes to content architecture, CPTs, ACF groups, or Elementor page layouts

---

## Foundational Insight

The design system already exists and is correct. The `:root` CSS token block in `gu-design-system.css` defines a complete, coherent system:
- 8px spacing grid (`--space-1` through `--space-32`)
- Full typography scale with correct line-heights (`--leading-h1: 1.15` through `--leading-body: 1.70`)
- Three-tier radius system (`--radius-sm: 4px`, `--radius-md: 6px`, `--radius-lg: 8px`)
- Correct color palette (ink, surface, accent, borders)
- Motion tokens

**The problem is the gap between the token system and actual rendered output.** Elementor button widgets pull from the Elementor Kit (which was never synced to our tokens), heading widgets set their own line-heights, and each sprint added CSS without always referencing the existing variables. This sprint closes those gaps.

---

## 1. Global Design Principles

### Core philosophy

This is the website of a single neurosurgeon practicing precision medicine. The visual language must communicate:

- **Earned authority** — not boastful, not modest. A quiet confidence expressed through generous whitespace and typographic restraint. The copy and credentials carry the authority; the design does not shout.
- **Calm under complexity** — patients arriving on this site are often anxious. The design must be the opposite of anxiety: unhurried, legible, uncluttered. No blinking, no aggressive color contrasts, no overcrowded sections.
- **Premium private practice** — comparable to a high-end private clinic brochure in Zürich or Stockholm. Not a public hospital, not an insurance portal. Every detail signals that this is a curated, personal practice.
- **Warmth without informality** — the warm ivory palette (`#FDFBF7`, `#F4EFE6`) and serif typography (Lora) create approachability. The doctor is human, not a medical robot. But the layout is rigorous and precise.

### Scandinavian influences

The reference aesthetic is contemporary Nordic healthcare and professional services design: Karolinska, Rigshospitalet, high-end Danish clinic websites. Key principles drawn from this direction:

| Principle | Application |
|-----------|------------|
| Negative space as a design element | Section padding: never below 64px vertical. Let content breathe. |
| Monochromatic palette with one accent | Ivory + ink + one teal. No competing accent colors. |
| Typography as the primary visual | When there is no photography, strong typographic hierarchy is the hero. |
| Restraint over decoration | No gradients, no textures, no decorative borders. The warmth comes from color temperature, not ornamentation. |
| Grid discipline | All spacing on the 8px grid. No arbitrary pixel values. |
| Functional minimalism | Every element earns its presence. If removing it doesn't hurt, remove it. |

### What is already working — do not change

The following elements are correct and must not be altered in this sprint or any future sprint without a separate design review:

- Lora / Inter typeface pairing
- `#231E1A` ink color (warm near-black, distinctive)
- `#FDFBF7` / `#F4EFE6` surface palette (warm ivory, not cold white)
- `#4D7A70` accent (muted sage-teal — distinct from generic medical blue)
- Dark "ink" CTA sections with off-white button on ink background
- 12-section about page IA structure
- Schema architecture and `#physician` anchor

---

## 2. Typography System

### Design token baseline (already defined — enforce, do not redefine)

All typographic tokens are defined in `:root` in `gu-design-system.css`. The following table documents them and the implementation status of each:

| Token | Value | Status |
|-------|-------|--------|
| `--font-serif` | Lora, Georgia, serif | ✓ Applied |
| `--font-sans` | Inter, system-ui, sans-serif | ✓ Applied |
| `--size-h1` | 52px | ✓ Homepage hero |
| `--size-h2` | 38px | ✓ Homepage sections |
| `--size-h3` | 28px | Partially applied |
| `--size-h4` | 20px | Partially applied |
| `--size-body` | 17px | ✓ Applied |
| `--leading-h1` | 1.15 | ✗ Not enforced on CPT singles (currently 1.0x) |
| `--leading-h2` | 1.20 | ✗ Not enforced on CPT singles (currently 1.0x) |
| `--leading-h3` | 1.25 | ✗ Not enforced |
| `--leading-body` | 1.70 | ✓ Applied to content areas |

### Heading scale — complete specification

| Level | Font | Size (desktop) | Size (mobile) | Weight | Line-height | Color | Usage |
|-------|------|---------------|--------------|--------|------------|-------|-------|
| H1 | Lora | 52px | 36px | 700 | 1.15 | `--color-surface` (on dark) or `--color-ink` | Page heroes only |
| H2 | Lora | 38px | 28px | 700 | 1.20 | `--color-ink` | Section titles |
| H3 | Lora | 28px | 22px | 700 | 1.25 | `--color-ink` | Sub-section, card titles |
| H4 | Inter | 20px | 18px | 600 | 1.30 | `--color-ink` | Supporting section titles, card labels |
| H5 | Inter | 17px | 16px | 600 | 1.35 | `--color-ink` | Small labels, sidebar headings |
| H6 | Inter | 12px | 12px | 600 | 1.40 | `--color-accent` | Category tags, overlines — ALL CAPS, `letter-spacing: 0.08em` |

### Exceptions — /despre/ page heading sizes

The about page section headings (`.gu-about-section-heading`) were set to 30px in Sprint 8, which is below the H3 token (28px) and well below the H2 token (38px). They should be H2-equivalent headings.

| Element | Current | Target | Token |
|---------|---------|--------|-------|
| `.gu-about-hero__name` (doctor's name) | 40px | **48px** | Between `--size-h1` and `--size-h2` — this is the most prominent personal heading on the site |
| `.gu-about-section-heading` | 30px | **36px** | `--size-h2` - 2px (a deliberate step below homepage H2 to create hierarchy between pages) |

### Body text specification

| Style | Font | Size | Weight | Line-height | Color | Usage |
|-------|------|------|--------|------------|-------|-------|
| Lead paragraph | Inter | 20px | 400 | 1.65 | `--color-ink` | First paragraph of major content sections, standfirsts |
| Body | Inter | 17px | 400 | 1.70 | `--color-ink` | All patient-facing prose content |
| Body secondary | Inter | 15px | 400 | 1.65 | `--color-ink-secondary` | Supporting text, card excerpts |
| Caption | Inter | 13px | 400 | 1.50 | `--color-ink-secondary` | Image captions, footnotes, timestamps |
| Label / overline | Inter | 12px | 600 | 1.40 | `--color-accent` | Category tags, section overlines — uppercase |
| Credentials strip value | Lora | 28px | 700 | 1.0 | `--color-ink` | Statistics, credential numbers |

### Line-height enforcement strategy

The critical gap: Elementor heading widgets set their own line-height at the widget level and override CSS. The correct fix is a CSS rule with sufficient specificity:

```css
/* Applied to all heading levels to enforce the token-defined line-heights.
   Elementor heading widget uses .elementor-heading-title — target that. */
.elementor-heading-title,
.elementor-widget-heading h1,
.elementor-widget-heading h2,
.elementor-widget-heading h3 {
  line-height: 1.2 !important; /* Minimum — widget settings will override upward if needed */
}
h1 { line-height: var(--leading-h1); }
h2 { line-height: var(--leading-h2); }
h3 { line-height: var(--leading-h3); }
```

### Mobile type scale

At ≤768px, the type scale compresses. All reductions are proportional, not arbitrary:

| Level | Desktop | Tablet (768px) | Mobile (390px) |
|-------|---------|---------------|---------------|
| H1 | 52px | 42px | 36px |
| H2 | 38px | 32px | 28px |
| H3 | 28px | 24px | 22px |
| H4 | 20px | 18px | 18px |
| Body | 17px | 17px | 16px |
| `/despre/` hero name | 48px | 38px | 32px |
| `/despre/` section heading | 36px | 30px | 26px |

---

## 3. Spacing System

### 8px grid — already defined, partially enforced

The spacing token system in `:root` is correct. The gap is in Elementor section padding settings, which were entered as arbitrary pixel values in some sprints rather than referencing the grid.

**Canonical section padding values (always use these; never intermediate values):**

| Context | Top padding | Bottom padding | Token reference |
|---------|------------|---------------|----------------|
| Hero sections | 128px | 128px | `--space-32` |
| Major sections (dark CTA, prominent) | 96px | 96px | `--space-24` |
| Standard sections | 80px | 80px | `--space-20` |
| Compact sections | 64px | 64px | `--space-16` |
| Dense sections (credentials strip) | 40px | 40px | `--space-10` |

**Mobile section padding (≤768px):**

| Context | Mobile top | Mobile bottom |
|---------|-----------|--------------|
| Hero sections | 64px | 64px |
| Major sections | 64px | 64px |
| Standard sections | 48px | 48px |
| Compact sections | 32px | 32px |
| Dense sections | 24px | 24px |

**Current violations to fix:**
- `/despre/` Elementor section containing `[gu_about_hero]`: top padding is ~80px on mobile — should be 48px
- The hero section top padding pushes the photo 206px from the top on mobile; reducing to 48px brings the name above the fold

### Card internal spacing

| Context | Padding | Token |
|---------|---------|-------|
| Large card (archive) | 32px | `--space-8` |
| Standard card | 28px | between `--space-8` and `--space-6` |
| Compact card | 24px | `--space-6` |
| Card header to body gap | 16px | `--space-4` |
| Card body to action gap | 20px | `--space-5` |
| Card grid gap | 24px | `--space-6` |
| Section grid gap | 32px | `--space-8` |

### Component internal spacing

| Context | Value | Token |
|---------|-------|-------|
| Icon to label | 8px | `--space-2` |
| Label to heading | 8px | `--space-2` |
| Heading to body | 16px | `--space-4` |
| Paragraph spacing | 20px | `--space-5` |
| Heading to sub-element | 32px | `--space-8` |
| List item gap | 12px | `--space-3` |

---

## 4. Radius System

### Token reference (already defined — enforce, do not create new values)

| Token | Value | Usage |
|-------|-------|-------|
| `--radius-sm` | 4px | Inputs, checkboxes, small badges |
| `--radius-md` | 6px | **Buttons (all types)**, tags, chips |
| `--radius-lg` | 8px | Cards, panels, photo containers, modal overlays |
| `100px` (no token needed) | 100px | Fully round: avatar images, icon circles, radio indicators |

### Application rules

**Buttons:** All buttons across the entire site — Elementor widgets and `.gu-btn` custom components — use `--radius-md` (6px). No exceptions.

Current violation: Some Elementor button widgets are set to 4px (`--radius-sm`) and one ghost button uses 2px. These will be overridden via CSS in Phase A.

**Cards:** All cards — archive cards, specialty cards, feature cards, CTA panels — use `--radius-lg` (8px).

Current status: Archive cards already use 8px. Specialty "Domenii de expertiză" cards also use 8px. Consistent. ✓

**Containers / Panels:** Large content containers (the dark philosophy panel on `/despre/`, the dark CTA strip) use 0px radius — they are full-width and span edge-to-edge. Inner panels within sections use `--radius-lg` (8px).

**Images / Portraits:** Portrait photos (when uploaded) and photo placeholders use `--radius-lg` (8px). Not fully round — this is a professional medical portrait, not a social media avatar.

### Radius compliance summary

| Element | Current | Target | Action |
|---------|---------|--------|--------|
| Header/footer Elementor button | 6px | 6px | ✓ Already correct |
| Hero content Elementor button | 4px | 6px | CSS override |
| `/programari/` buttons | 4px | 6px | CSS override |
| `.gu-btn` (about page) | 6px | 6px | ✓ Already correct |
| Footer ghost button | 2px | 6px | CSS override |
| Archive cards | 8px | 8px | ✓ Already correct |

---

## 5. Button System

### Design decision

The current `.gu-btn` component introduced in Sprint 8 is the correct foundation. It needs to be extended to cover all button contexts site-wide and Elementor button widgets need to be brought into compliance via CSS overrides.

### Button variants — full specification

#### Primary (`.gu-btn`, `.gu-btn--accent`, and Elementor buttons in content areas)

Used for: main CTAs, booking actions, "Programează o consultație"

| Property | Value | Token |
|----------|-------|-------|
| Background | `#4D7A70` | `--color-accent` |
| Text color | `#FDFBF7` | `--color-surface` |
| Border | none | — |
| Radius | 6px | `--radius-md` |
| Padding | 12px 24px | `--space-3` `--space-6` |
| Font | Inter 600, 15px | `--font-sans`, `--weight-semibold` |
| Letter-spacing | 0.01em | — |
| Hover bg | `#3A5F57` | `--color-accent-hover` |
| Hover shadow | `0 4px 12px rgba(77,122,112,0.25)` | — |
| Focus ring | `0 0 0 3px rgba(77,122,112,0.35)` | — |
| Active bg | `#2E4D47` | darker than hover |
| Transition | 200ms ease | `--transition-fast` |

#### Light Primary (`.gu-btn--light`)

Used for: primary CTAs on dark ink backgrounds (bottom CTA sections on all pages)

| Property | Value |
|----------|-------|
| Background | `#FDFBF7` (`--color-surface`) |
| Text color | `#231E1A` (`--color-ink`) |
| Border | none |
| Radius | 6px |
| Hover bg | `#F4EFE6` (`--color-surface-warm`) |
| Hover shadow | `0 4px 12px rgba(253,251,247,0.20)` |

**Consistency fix required:** The CTA button on `/interventii/microdiscectomie-lombara/` uses `#4D7A70` (accent green) instead of `#FDFBF7` (light). This violates the rule that dark sections always use the light button variant.

#### Secondary (`.gu-btn--outline`)

Used for: secondary actions, "Află mai multe", filter controls

| Property | Value |
|----------|-------|
| Background | transparent |
| Text color | `#4D7A70` (`--color-accent`) |
| Border | `1.5px solid #4D7A70` |
| Radius | 6px |
| Hover bg | `rgba(77,122,112,0.08)` |
| Hover border | `#3A5F57` |

Currently this variant is not formally defined in CSS. The "Află mai multe" button on the homepage hero uses transparent background + `#FDFBF7` text (a ghost variant for dark backgrounds). This needs to be separated into two CSS classes: `.gu-btn--outline` (on light bg) and `.gu-btn--ghost-light` (on dark bg).

#### Tertiary / Text link (`.gu-btn--text`)

Used for: "Detalii și program →", "Citește mai mult →", breadcrumb-style inline navigation

| Property | Value |
|----------|-------|
| Background | transparent |
| Text color | `#4D7A70` |
| Border | none |
| Radius | 0 (underline decoration instead) |
| Underline | `1px solid rgba(77,122,112,0.40)` |
| Hover | underline solid opacity 1.0, text color `#3A5F57` |
| Padding | 0 (inline) or 4px 0 |

**Current violation:** "Detalii și program →" in the footer uses `border-radius: 2px` — it looks like a bordered button but has almost no radius. Should become a `.gu-btn--text` style instead.

### Button sizing

| Size class | Font-size | Padding | Use case |
|-----------|-----------|---------|----------|
| `.gu-btn--lg` | 16px | 14px 32px | Hero CTAs |
| `.gu-btn` (default) | 15px | 12px 24px | Standard CTAs |
| `.gu-btn--sm` | 13px | 8px 16px | Card CTAs, inline actions |

**Header/footer fix:** The header Elementor button widget currently uses `elementor-size-xs` which renders at 13px/weight 400. This should effectively be `.gu-btn--sm` style: 13px font-size, weight 600, but with the correct background color. No size change needed — just color and weight correction.

### CSS override strategy

Rather than editing the Elementor Kit (which requires WP admin GUI access), override at the CSS level:

```css
/* Phase A CSS additions to gu-design-system.css */

/* Bring all Elementor button widgets into radius compliance */
.elementor-button {
  border-radius: var(--radius-md) !important;
}

/* Fix header/footer button color — the most visible P0 issue */
.site-header .elementor-button,
.site-footer .elementor-button {
  background-color: var(--color-accent) !important;
  color: var(--color-surface) !important;
  font-weight: var(--weight-semibold) !important;
}
.site-header .elementor-button:hover,
.site-footer .elementor-button:hover {
  background-color: var(--color-accent-hover) !important;
}
```

This approach has zero risk of breaking page layouts and is immediately reversible by removing the CSS rules.

---

## 6. Card System

### Design language for all cards

All cards share a common visual DNA:

- Background: `--color-surface` (`#FDFBF7`)
- Border: `1px solid --color-border` (`#D6CFC4`)
- Radius: `--radius-lg` (8px)
- No hard shadow by default — only on hover
- Hover: `box-shadow: 0 4px 24px rgba(35,30,26,0.08)` + `border-color: --color-border-strong`
- Transition: `--transition-fast` (200ms)
- Cursor: `pointer` on card-level link wrappers

### Specialty cards (`Domenii de expertiză` on homepage)

Current state: plain white box, title + link, no icon, no hover

Target design:

```
┌─────────────────────────────────────┐
│  [ICON 32×32px in #4D7A70]          │
│                                     │
│  Tumori cerebrale              [→]  │
│  ─────────────────────────────────  │
│  Descriere scurtă a domeniului de   │
│  expertiză, 1–2 propoziții.         │
└─────────────────────────────────────┘
```

| Property | Value |
|----------|-------|
| Background | `#FDFBF7` |
| Border | `1px solid #D6CFC4` |
| Border-left on hover | `3px solid #4D7A70` |
| Radius | 8px |
| Padding | 32px |
| Icon | 32×32px SVG, stroke `#4D7A70`, outline style, 2px stroke |
| Title | Lora 700, 20px, `#231E1A` |
| Body | Inter 400, 15px, `#5A4E47` |
| Link arrow | Inter 600, 14px, `#4D7A70` |
| Hover | shadow + left-border accent + slight translateY(-2px) |

**Note:** The current grid uses 6 equal-width cards in a 3×2 arrangement on desktop. Icons are not yet in the template. Phase C adds them. Phase A/B do not change the card structure.

### "O abordare diferită" feature cards (homepage)

Current state: background `#E4EDEB` — wrong palette color (too cold/blue)  
Correct interpretation of `--color-accent-subtle: #E4EDEB`: this token is defined for micro-accents (tag backgrounds, badge fills) — not for large card fills. Using it at card scale looks clinical and cold.

Target:

| Property | Value | Rationale |
|----------|-------|-----------|
| Background | `#FDFBF7` | Warm surface — matches the section container background shift |
| Border | `1px solid #D6CFC4` | Same border as all cards |
| Border-left | `3px solid #4D7A70` | Accent indicator — distinctive, adds color without the cold fill |
| Radius | 8px | Standard card radius |
| Padding | 32px | Standard large card padding |

The left-border accent pattern is a classic Scandinavian editorial device — it adds the accent-color presence without making the entire card feel tinted.

### Archive cards — conditions and procedures

Used on `/afectiuni/`, `/interventii/`

```
┌──────────────────────────────────────┐
│  NEUROCHIRURGIE VERTEBRALĂ  (tag)    │
│                                      │
│  Hernie de disc lombară              │
│                                      │
│  Compresia rădăcinilor nervoase...   │
│                                      │
│  Citește mai mult →                  │
└──────────────────────────────────────┘
```

| Property | Value |
|----------|-------|
| Background | `#FDFBF7` |
| Border | `1px solid #D6CFC4` |
| Radius | 8px |
| Padding | 28px |
| Category tag | Inter 600, 11px, uppercase, `letter-spacing: 0.08em`, `#4D7A70` |
| Title | Lora 700, 20px, `#231E1A` |
| Excerpt | Inter 400, 15px, `#5A4E47`, lh 1.6 |
| CTA link | Inter 600, 14px, `#4D7A70`, "Citește mai mult →" |
| Hover | shadow + translateY(-2px) + border-color `#BDB3A5` |

### Article cards (`/articole/` archive)

Same base as condition/procedure cards with additions:

| Additional element | Value |
|-------------------|-------|
| Author line | Small avatar placeholder (24×24px circle) + "Dr. George Ungureanu" Inter 400, 13px |
| Date | Inter 400, 13px, `#5A4E47` |
| Read-time | "~5 min citire" Inter 400, 13px, `#5A4E47` |

### Interest / specialty cards (on `/despre/` special interests grid)

Current state: `.gu-interest-card` — 3-column grid, cards with icon emoji + title + description

These are functioning correctly. No change needed in Phase A or B. Phase C may add proper SVG icons to replace emoji.

### FAQ accordion cards (not yet on site — Phase C candidate)

Anticipated future use on `/despre/` philosophy section or patient FAQ. Documented here for completeness.

```
┌────────────────────────────────────────────────────┐
│ Ce include o consultație inițială?            [+]  │
├────────────────────────────────────────────────────┤
│  Evaluarea durează 45–60 de minute și include...   │
│  (expanded state)                                  │
└────────────────────────────────────────────────────┘
```

| Property | Value |
|----------|-------|
| Question | Inter 600, 17px, `#231E1A` |
| Answer | Inter 400, 16px, `#231E1A`, lh 1.7 |
| Divider | `1px solid #EDE8DF` |
| Icon | `+` / `−` in `#4D7A70`, rotates 45° on expand |
| Background | transparent (sits on section background) |
| Animation | max-height transition 250ms ease-in-out |

---

## 7. Empty-State System

### Problem

With 1 published entry per CPT, archive pages render 1 card in a 3-column grid with no explanation of the empty space. This looks like a broken page.

### Design specification

Two-tier approach:

**Tier 1 — Grid auto-sizing (Phase B CSS fix)**

Change archive grids from fixed-column (`repeat(3, 1fr)`) to auto-fill:
```css
grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
```

With 1 card: card fills full width. With 2 cards: two equal-width columns. With 3+: three-column layout. This immediately eliminates the "floating card" problem without any content addition.

**Tier 2 — "Coming soon" message (Phase B PHP addition)**

After the grid (regardless of card count), add a conditional empty-state block when `count < 3`:

```
┌ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ┐  (dashed border)
         [clock-like outline icon, 40px]
         
   Conținut în curs de actualizare
   
   Noi resurse pentru pacienți vor fi adăugate
   periodic. Urmăriți această secțiune.
   
   [ Programează o consultație → ]
└ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ┘
```

| Property | Value |
|----------|-------|
| Background | `#F4EFE6` (surface-warm) |
| Border | `1px dashed #BDB3A5` |
| Radius | 8px |
| Padding | 48px 32px |
| Max-width | 560px, centered |
| Icon | 40×40px SVG outline, `#4D7A70` |
| Heading | Lora 700, 22px |
| Body | Inter 400, 16px |
| CTA | `.gu-btn--outline` |
| Margin-top | 48px (below the grid) |

**Visibility rule:** The empty-state block appears only when `count < 3`. When content reaches 3+ items, it is suppressed. Implementation: PHP shortcode checks `$wp_query->found_posts`.

---

## 8. Image Strategy

### Professional portrait — the highest priority client deliverable

The photograph of Dr. George Ungureanu is the most impactful single asset for this website. No design system change compensates for its absence. It affects:
- `/despre/` hero — primary impact
- Homepage "about teaser" section — secondary impact
- All article page author avatars — tertiary impact
- Google Business profile photo (referenced in schema)

**Technical requirements when the photo is provided:**

| Requirement | Specification |
|------------|--------------|
| Format | JPEG or WebP |
| Minimum dimensions | 900 × 1200px (portrait orientation, 3:4 ratio) |
| File size | ≤ 300KB after optimization |
| Subject treatment | Sharp focus on face, natural or off-white background |
| Crop | Head + shoulders + upper torso (not headshot-only) |
| Lighting | Soft, directional (not harsh flash) |
| Expression | Engaged and calm — not smiling for a passport, not stiff |
| ACF field | `about_photo` — already wired in template |

Once uploaded to `about_photo`, the SVG placeholder in `[gu_about_hero]` is automatically replaced. The homepage image widget must be updated separately.

### Portrait placeholder — unified design (Phase B)

Currently two different placeholders exist:
- Homepage: flat grey rectangle (Elementor default placeholder)
- `/despre/`: inline SVG silhouette on `#F4EFE6` background

**Target:** Both locations show the same styled monogram placeholder until the real photo is supplied.

Design:
```
┌──────────────────────┐
│                      │
│                      │
│         G·U          │   ← Lora 700, 48px, #4D7A70
│                      │
│  Portret profesional │   ← Inter 400 italic, 12px, #5A4E47
│  urmează             │
│                      │
└──────────────────────┘
Background: #F4EFE6
Border: 1px solid #D6CFC4
Radius: 8px
```

The "G·U" monogram is more refined than the silhouette and avoids the "broken image" reading of a grey rectangle.

### Medical icons — specialty cards

Required for Phase C (specialty card upgrade). Not blocking Phase A or B.

**Style specification:**

| Property | Value |
|----------|-------|
| Style | Outlined, 2px stroke, rounded line caps |
| Color | `#4D7A70` on transparent |
| Size on cards | 32 × 32px |
| Size on feature sections | 48 × 48px |
| Source | Lucide icons (open source, MIT, consistent 24px grid) or custom SVG |

**Icons needed by specialty:**

| Specialty | Lucide icon candidate |
|-----------|----------------------|
| Tumori cerebrale | `brain` or custom anatomical |
| Hernie de disc / patologie vertebrală | `activity` or `align-center` |
| Neurochirurgie vasculară | `git-branch` or custom vessel |
| Hidrocefalie | `droplets` |
| Patologie de coloană | `layers` |
| Neurochirurgie funcțională | `zap` |

Note: Lucide's anatomy coverage is limited. Custom SVG may be needed for the brain and spine icons.

### Editorial illustrations (Phase C — optional)

Anatomical diagrams for condition pages ("Hernie de disc — ce este") would add significant educational value. Not required for launch. If added:

- Style: simplified line-art, 1–2 colors, no photographic realism
- Colors: `#231E1A` line, `#4D7A70` accent highlights, `#F4EFE6` background
- Format: inline SVG (scalable, no extra HTTP request)
- Size: max 600px wide, responsive

---

## 9. Mobile-First Improvements

### /despre/ hero — bring H1 above the fold

**Current state (measured):**
- Photo top: y = 206px
- Photo height: 245px
- Content (H1) top: y = 483px
- Viewport: 844px
- H1 is 483px below the top — not visible on first load

**Root cause:** Elementor section top padding (~80px) + 126px gap before photo starts + 245px photo = 451px before the name appears.

**Fix specification:**

```css
@media (max-width: 480px) {
  /* Reduce section top padding for the hero Elementor section */
  /* Target: .elementor-element wrapping [gu_about_hero] */
  .page-despre .e-con:first-child {
    padding-top: 40px !important;
    padding-bottom: 40px !important;
  }
  
  /* Constrain photo on mobile */
  .gu-about-hero__photo-wrap {
    width: 160px !important;
    height: 195px !important;
  }
  
  /* Name: slightly larger on mobile than current 28px */
  .gu-about-hero__name {
    font-size: 30px;
  }
  
  /* CTA: full-width on mobile */
  .gu-btn.gu-btn--accent {
    width: 100%;
    text-align: center;
    justify-content: center;
  }
}
```

**After fix (estimated):**
- Section top: 40px
- Photo top: ~120px, height: 195px
- Content top: ~335px (120 + 195 + 20px gap)
- H1 visible at y ≈ 350px on 844px viewport — well above the fold ✓

### Global mobile improvements

| Issue | Fix | Risk |
|-------|-----|------|
| Stats section 3 stacked numbers (homepage mobile) | Add card background + border to each stat item when `flex-direction: column` | Low |
| Section padding too tall on mobile | Add responsive padding rules for all major sections | Low |
| Heading line-height 1.0x (CPT singles mobile) | Global heading line-height CSS rule | Very low |
| Footer "Detalii și program →" button barely visible | Style as `.gu-btn--text` (see Section 5) | Very low |
| Archive grid: single card too narrow on tablet | `auto-fill` grid fix (see Section 7) | Low |

### Responsive breakpoints reference

The current plugin already uses these breakpoints. They are correct and should not change:

| Breakpoint | Width | Name | Context |
|-----------|-------|------|---------|
| ≤ 480px | 480px | Mobile | Single-column, largest text compresses |
| ≤ 768px | 768px | Tablet | 2-column grids, hero stacks |
| ≤ 1024px | 1024px | Large tablet | Inner container constrains at 760px |
| 1440px+ | 1440px | Desktop | Full layout |

---

## 10. Implementation Roadmap

### Phase A — P0 Fixes (Sprint 8.2-A)

**Goal:** Eliminate all trust-breaking and brand-destroying issues. Ship-blockers.  
**Estimated effort:** 2.5–3 hours  
**Risk:** Very Low — all changes are additive CSS or string replacements in PHP

| Task | Method | Files | Time | Risk |
|------|--------|-------|------|------|
| A1. Fix Romanian diacritics in all 16 Section 10 strings | `Edit` tool, direct string replacement | `gu-design-system.php` lines 919–1133 | 30 min | Very Low |
| A2. Fix header/footer button color via CSS override | Add CSS rules targeting `.site-header .elementor-button` | `gu-design-system.css` | 15 min | Very Low |
| A3. Standardize border-radius globally via CSS override | `.elementor-button { border-radius: var(--radius-md) !important; }` | `gu-design-system.css` | 10 min | Very Low |
| A4. Fix header/footer button font-weight (400 → 600) | CSS override on header/footer button selectors | `gu-design-system.css` | 10 min | Very Low |
| A5. Archive grid: `auto-fill` for empty-state fix (Tier 1) | Change `grid-template-columns` in 3 archive shortcode CSS | `gu-design-system.css` | 20 min | Low |
| A6. Archive empty-state block (Tier 2) | Add PHP conditional + new CSS class | `gu-design-system.php`, `gu-design-system.css` | 60 min | Low |
| A7. Sync plugin to live (rsync) | Bash rsync command | — | 5 min | Very Low |

**Phase A QA gates:**
- All header/footer buttons render `#4D7A70` at all 9 pages × 3 viewports
- All button border-radius renders 6px
- `/despre/` all visible text includes correct diacritics (ă â î ș ț)
- Archive pages show no empty grid columns; empty-state block appears

---

### Phase B — Global UI Refresh (Sprint 8.2-B)

**Goal:** Enforce design token consistency across all pages. No page looks "off-brand."  
**Estimated effort:** 3–4 hours  
**Risk:** Low-Medium — includes one DB write for homepage Elementor data

| Task | Method | Files | Time | Risk |
|------|--------|-------|------|------|
| B1. Fix "O abordare diferită" card backgrounds (`#E4EDEB` → `#FDFBF7` + left-border accent) | PHP DB update to homepage `_elementor_data` for 4 card elements | `wp_postmeta` (DB) | 30 min | Medium |
| B2. Add global heading line-height enforcement | CSS rule targeting `.elementor-heading-title` | `gu-design-system.css` | 10 min | Low |
| B3. Add prose content CSS for CPT single pages | Editorial CSS: h2/h3 margins, paragraph spacing, list styling within text-editor widget | `gu-design-system.css` | 45 min | Low |
| B4. Standardize CTA button across pages | Audit `/interventii/` single Elementor data; fix button color mismatch | `wp_postmeta` (DB) | 30 min | Low |
| B5. Unify button CSS into organized Section 24 | CSS cleanup — consolidate all button overrides into single documented block | `gu-design-system.css` | 30 min | Very Low |
| B6. Unified portrait placeholder (monogram) | Update SVG in `[gu_about_hero]` shortcode + add CSS | `gu-design-system.php` | 30 min | Low |
| B7. Fix `/despre/` section heading size (30px → 36px) | CSS override in plugin Section 23 | `gu-design-system.css` | 10 min | Very Low |
| B8. Fix `/despre/` hero H1 size (40px → 48px) | CSS override | `gu-design-system.css` | 5 min | Very Low |
| B9. Sync plugin to live | rsync | — | 5 min | Very Low |

**Risk note on B1:** Editing `_elementor_data` in the database changes the homepage layout. A backup of the homepage row should be taken before the write. If the change breaks the page, restoring the original `meta_value` restores the page exactly. Reversibility: Complete.

**Phase B QA gates:**
- Homepage "O abordare" cards render `#FDFBF7` + 3px left accent border in `#4D7A70`
- All heading levels on CPT singles have `line-height ≥ 1.2`
- Content prose on CPT single pages has visible h2 spacing, paragraph breathing room
- All bottom CTA sections across all pages have identical button appearance
- `/despre/` section headings render at 36px
- `/despre/` hero name renders at 48px

---

### Phase C — Page-Specific Improvements (Sprint 8.2-C)

**Goal:** Elevate individual pages to premium level. Polish and editorial refinement.  
**Estimated effort:** 6–8 hours  
**Risk:** Medium — includes new PHP features and visual design additions

| Task | Method | Files | Time | Risk |
|------|--------|-------|------|------|
| C1. /despre/ mobile hero layout (H1 above fold) | Responsive CSS — reduce padding, constrain photo, widen H1 | `gu-design-system.css` | 60 min | Low |
| C2. Breadcrumb navigation on CPT single pages | New PHP shortcode or `wp_head` hook; CSS | `gu-design-system.php`, `gu-design-system.css` | 90 min | Low |
| C3. Specialty card icon system | SVG icons for 6 specialties; PHP shortcode update for specialty cards | `gu-design-system.php`, new `assets/icons/` directory | 3 hrs | Medium |
| C4. Mobile stats section improvements (homepage) | CSS: add card background + separator to stacked stats on mobile | `gu-design-system.css` | 30 min | Very Low |
| C5. Site header navigation (design decision required) | Elementor header template edit + WP menu registration | Elementor DB template | 60 min | Medium |
| C6. Article card author avatar improvement | CSS: styled placeholder "GU" monogram for author avatar | `gu-design-system.css` | 30 min | Very Low |
| C7. Footer ghost button redesign (`.gu-btn--text`) | CSS refactor of "Detalii și program →" | `gu-design-system.css` | 20 min | Very Low |
| C8. Pull-quote styling for CPT single content | CSS: `.elementor-widget-text-editor blockquote` styled treatment | `gu-design-system.css` | 30 min | Very Low |

**Phase C design decision required before implementation:**

**C5 — Site header navigation:** Should the minimal header (logo + CTA only) be expanded to include navigation links? This is a product decision, not a technical one.
- **Option Keep Minimal:** Maintain current design. Pro: focused CTA, no distraction. Con: no path discovery, friction for multi-page navigation.
- **Option Add Navigation:** Add 4 links: Afecțiuni / Sfaturi / Despre / Programări. Pro: standard web navigation expectation. Con: header becomes taller or more complex.

This decision should be made before Phase C begins. Implementation effort is low either way.

**Phase C QA gates:**
- `/despre/` mobile: H1 visible without scrolling on 390px viewport
- All CPT single pages show breadcrumb path (e.g., "Afecțiuni → Hernie de disc")
- Specialty cards on homepage show SVG icons
- Navigation decision implemented (whichever option is chosen)

---

### Effort and risk summary

| Phase | Effort | Time estimate | Risk | Blocking on |
|-------|--------|---------------|------|-------------|
| **A — P0 Fixes** | Low | 2.5–3 hrs | Very Low | Nothing — start immediately |
| **B — Global UI** | Medium | 3–4 hrs | Low-Medium | Phase A complete |
| **C — Page-Specific** | High | 6–8 hrs | Medium | Phase B complete + C5 decision |
| **Total** | — | **12–15 hrs** | Low-Medium | — |

### Pre-implementation checklist (before any phase begins)

- [ ] Sprint 8 commit reviewed and approved (the /despre/ page from Sprint 8 is not yet committed)
- [ ] Backup of `wp_postmeta` homepage row taken before Phase B DB write
- [ ] Phase C5 navigation decision made (before Phase C)
- [ ] Dr. Ungureanu has reviewed or is aware that diacritics are being corrected (A1)

---

*This document defines what to build. Implementation approval by sprint is required before any code changes begin.*  
*Content constraint: All changes are structural and stylistic only — no medical content is generated or altered.*
