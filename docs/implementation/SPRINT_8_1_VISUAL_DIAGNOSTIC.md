# Sprint 8.1 — Visual Diagnostic Report
**Date:** 2026-06-28  
**Author:** Senior UI/UX + Design System audit  
**Scope:** 9 pages × 3 viewports (Desktop 1440px, Tablet 768px, Mobile 390px) = 27 screenshots + CSS/DOM measurement audit  
**Status:** DIAGNOSIS COMPLETE — awaiting approval before implementation

---

## Methodology

Three data sources were combined for this diagnosis:

1. **27 full-page screenshots** — visual review at Desktop (1440px), Tablet (768px), Mobile (390px) for all 9 pages: `/`, `/despre/`, `/programari/`, `/afectiuni/`, `/afectiuni/hernie-de-disc-lombara/`, `/interventii/`, `/interventii/microdiscectomie-lombara/`, `/articole/`, `/articole/hernia-de-disc-lombara/`
2. **CSS/DOM audit script** — Playwright measurement of computed styles, layout dimensions, button colors, typography, and grid geometry across all pages
3. **Elementor database audit** — raw background color values from `wp_postmeta` `_elementor_data` for homepage sections

All findings below include exact measured values. Nothing is subjective opinion.

---

## Severity Legend

| Level | Meaning |
|-------|---------|
| **P0 — Critical** | Visible on every page load; brand-damaging or trust-destroying |
| **P1 — High** | Significantly degrades the premium medical feel; UX impairment |
| **P2 — Polish** | Noticeable detail gap; does not block launch but lowers quality bar |

---

## P0 — Critical Issues (Fix Before Any QA)

### P0-1 · Header and footer buttons use wrong brand color

**Pages affected:** All 9 pages (header + footer present on every page)  
**Measured value:** `rgb(91, 192, 222)` — Bootstrap 3 "info" cyan (#5BC0DE)  
**Expected value:** `rgb(77, 122, 112)` — design system `--color-accent` (#4D7A70)

Every header "Programează o consultație" button and the footer "Programează o consultație" button render in bright cyan — a color that does not appear anywhere in the design token palette (`--color-ink: #231E1A`, `--color-surface: #FDFBF7`, `--color-surface-warm: #F4EFE6`, `--color-accent: #4D7A70`).

Content-area buttons added in Sprints 1–8 correctly use `#4D7A70`. The mismatch is jarring: the most prominent button on the page (the primary CTA in the header) looks like it belongs to a completely different website.

**Root cause:** The Elementor Kit `Global Colors` configuration still has the default Elementor primary accent set to the cyan value. The design system CSS defines CSS custom properties but does not override the Kit's hardcoded button widget color. The header/footer templates were built using Elementor's button widget, which pulls from the Kit color — not from our CSS variables.

**Fix approach:** Update the Elementor Kit Global Colors via WP Admin → Elementor → Site Settings → Global Colors: set "Accent" to `#4D7A70`. Alternatively, add a CSS override in the plugin targeting `.site-header .elementor-button, .site-footer .elementor-button`.

---

### P0-2 · Four different button border-radius values site-wide

**Pages affected:** All pages  
**Measured values:**

| Location | Color | Border-radius | Font-size | Font-weight |
|----------|-------|--------------|-----------|-------------|
| Header/footer (Elementor widget) | `#5BC0DE` | **6px** | 13–15px | 400 |
| Homepage hero CTA + content | `#4D7A70` | **4px** | 16–17px | 600 |
| `/programari/` booking buttons | `#4D7A70` | **4px** | 14–17px | 600 |
| `/despre/` `.gu-btn--accent` | `#4D7A70` | **6px** | 15px | 600 |
| Footer ghost "Detalii și program" | transparent | **2px** | 13px | 400 |

Result: five different button contexts, three different radius values (2px / 4px / 6px), two different weight values (400 / 600), and four different font-sizes (13px / 14px / 15px / 16–17px). A user scrolling between sections sees buttons that look like they come from different UI libraries.

**Root cause:** Buttons were added sprint-by-sprint without a unified specification. The `.gu-btn` component introduced in Sprint 8 uses 6px, which is not retroactively applied to Elementor button widgets on earlier pages.

---

### P0-3 · Romanian diacritics missing throughout /despre/ page

**Pages affected:** `/despre/` — all 12 sections  
**Evidence:** Plugin `gu-design-system.php` Section 10 (lines 919–1133)

Every user-visible text string in the about page shortcodes uses ASCII approximations instead of correct Romanian:

| Current (incorrect) | Correct Romanian |
|--------------------|-----------------|
| Programati o consultatie | Programați o consultație |
| Vorbiti cu Dr. George Ungureanu | Vorbiți cu Dr. George Ungureanu |
| consultatie va ofera o evaluare | consultație vă oferă o evaluare |
| simptomelor dumneavoastra | simptomelor dumneavoastră |
| Filosofia mea de practica | Filosofia mea de practică |
| Educatie & Formare | Educație & Formare |
| Experienta Clinica | Experiență Clinică |
| Cercetare & Publicatii | Cercetare & Publicații |
| Activitate Didactica | Activitate Didactică |
| Aparitii in Media | Apariții în Media |
| ani de experienta clinica | ani de experiență clinică |
| afiliere clinica | afiliere clinică |
| limbi de consultatie | limbi de consultație |
| Informatii cheie | Informații cheie |
| Romana | Română |

For a medical professional's website targeting Romanian-speaking patients, incorrect diacritics look like a machine translation error. This is a P0 trust issue: it signals the site was not written by a native speaker or was auto-generated without review.

**Root cause:** The `cat >>` bash heredoc method used to append Section 10 to the plugin file cannot reliably encode multi-byte UTF-8 characters (ă â î ș ț) in some terminal environments. ASCII fallbacks were used to avoid encoding failures.

**Fix approach:** Direct `Edit` tool replacement of each incorrect string in the plugin PHP file, using the correct Romanian diacritics.

---

### P0-4 · Archive pages show 1 card in a 3-column grid — looks broken

**Pages affected:** `/afectiuni/`, `/interventii/`, `/articole/`  
**Measured values:**

| Archive | Grid layout | Card count | Container width | Visual result |
|---------|------------|------------|-----------------|---------------|
| /afectiuni/ | 3 columns × 344px, 24px gap | 1 card | 1080px | One 344px card, 712px blank space |
| /interventii/ | 3 columns × 344px, 24px gap | 1 card | 1080px | Same |
| /articole/ | 2 columns × 358px, 24px gap | 1 card | 740px | One 358px card, 358px blank space |

The grid uses fixed `grid-template-columns` regardless of item count. With only 1 published entry per CPT, each archive page looks unfinished — a single card floating in the upper-left of a wide container. There is no empty-state message, no placeholder, and no visual indication of whether more content is coming.

For a first-time visitor (or Dr. Ungureanu reviewing the site), this reads as: "something went wrong." The archive pages are a primary entry point from the homepage's "Domenii de expertiză" cards.

**Root cause:** Low content volume during development. The grid CSS uses `repeat(3, 1fr)` / fixed column definitions without a minimum-item fallback. Not a code bug — a design gap.

**Fix approach:** Two options:
- **Option A (Recommended):** Add an empty-state block below the grid when `count < 3`: a styled notice "Conținut în curs de actualizare — urmărește noi articole" with a /programari/ CTA.
- **Option B:** Change `grid-template-columns` to `repeat(auto-fill, minmax(320px, 1fr))` so that 1 card fills the full width and 3 cards appear as expected. This changes the visual design but eliminates the broken appearance.

---

## P1 — High Priority Issues

### P1-1 · "O abordare diferită" section uses off-palette background color

**Pages affected:** `/` (homepage), Section 4 of the Elementor layout  
**Measured value:** `rgb(228, 237, 235)` = `#E4EDEB` — 4 feature cards (elements a4wr1–a4wr4)  
**Design token palette:** `#FDFBF7` (surface), `#F4EFE6` (surface-warm), `#4D7A70` (accent), `#231E1A` (ink)

The `#E4EDEB` color is a washed-out blue-grey that does not appear in the design token palette. It is close to the accent color (#4D7A70) but desaturated and lightened — creating a "clinical" feel that clashes with the warm ivory palette used everywhere else on the site. The cards for "Tehnici minim-invazive", "Evaluare personalizată", "Continuitate terapeutică", and "Formare internațională" all share this off-palette background.

**Root cause:** This section was built in Elementor with a manually-chosen background color that was not taken from the design system tokens.

**Fix approach:** Change all 4 card element background colors from `#E4EDEB` to `#F4EFE6` (surface-warm) via Elementor editor. Alternatively, change to `#FDFBF7` if the containing section background is already `#F4EFE6`.

---

### P1-2 · Heading line-height = 1.0x on CPT single pages

**Pages affected:** `/afectiuni/hernie-de-disc-lombara/`, `/interventii/microdiscectomie-lombara/`, `/articole/hernia-de-disc-lombara/`  
**Measured values:**

| Heading | Font-size | Line-height | Ratio |
|---------|-----------|------------|-------|
| h1 (CPT single dark hero) | 48px | 48px | **1.0x** |
| h2 (CPT single content) | 32px | 32px | **1.0x** |
| h3 (CPT single content) | 26px | 26px | **1.0x** |
| h4 | 24px | 28.8px | 1.2x |

Line-height = font-size means zero leading. On a long title like "[DEMO] Hernia de disc lombară — Cauze, Simptome și Tratament" that wraps to 2 lines on mobile, consecutive text lines touch each other. This creates unreadable, cramped headings — particularly on mobile viewports where wrapping is frequent.

**Comparison:** Homepage H1 uses `lh: 59.8px` at `52px` = 1.15x. About page H1 uses `lh: 44px` at `40px` = 1.1x. CPT singles are the outlier.

**Root cause:** The Elementor heading widget in the CPT single templates has line-height set to its pixel value (matching font-size). No CSS override exists in the plugin stylesheet.

**Fix approach:** Add CSS to the plugin: `.elementor-widget-heading .elementor-heading-title { line-height: 1.2; }` as a global minimum, overriding widget-level settings.

---

### P1-3 · No visible navigation in site header

**Pages affected:** All 9 pages  
**Measured:** `Nav links present: false` (selector: `.site-header nav a, .elementor-nav-menu a`)

The header shows the logo ("Dr. George Ungureanu / Neurochirurg") on the left and one CTA button on the right. There are no navigation links visible at any viewport (desktop, tablet, mobile). Users cannot navigate between pages from the header — all navigation relies on footer links or knowing URLs directly.

Navigation is present in the footer (columns PAGINI, SFATUL NEUROCHIRURGULUI, PROGRAMĂRI) but users typically expect header navigation on a multi-page site.

**Note:** This may be an intentional design choice (minimal header for a solo practitioner). However, for a 6+ page site with multiple content types, the absence of any navigation link in the header will increase bounce rate and reduce time-on-site, particularly from mobile users who may not scroll to the footer.

**Fix approach (if change is approved):** Add an Elementor Nav Menu widget to the header template between the logo and the CTA button. Minimum items: Acasă / Afecțiuni / Despre / Programări.

---

### P1-4 · CTA section button is inconsistent across pages

**Pages affected:** `/`, `/despre/`, `/afectiuni/hernie-de-disc-lombara/`, `/interventii/microdiscectomie-lombara/`  
**Measured:**

| Page | CTA heading | Button color | Button text |
|------|------------|-------------|------------|
| / | "Programați o consultație astăzi" | `rgb(253, 251, 247)` off-white | "Programează acum" |
| /despre/ | "Vorbiti cu Dr. George Ungureanu" | `rgb(255, 255, 255)` pure white | "Programati o consultatie" |
| /afectiuni/ single | (no heading visible) | `rgb(253, 251, 247)` off-white | "Programează o consultație" |
| /interventii/ single | (no heading visible) | `rgb(77, 122, 112)` accent teal | "Programează o consultație" |

The intervention single page CTA button uses the accent green (#4D7A70) rather than the off-white surface color used on other pages. The button text also differs ("acum" vs "o consultație"). The CTA section is the highest-conversion element on a medical site — its inconsistency is distracting and undermines the sense of a unified brand.

**Root cause:** CPT single templates were built in separate sprints without a locked CTA specification. The /interventii/ single was built with a different button style.

---

### P1-5 · /despre/ hero H1 (40px) is smaller than CPT single H1 (48px)

**Measured:**
- `/despre/` hero name heading (`.gu-about-hero__name`): **40px** Lora 700
- CPT single dark hero heading (`h1`): **48px** Lora 700
- Homepage hero heading: **52px** Lora 700

The about page — which is the most personal and central page of the site, featuring the doctor's name and portrait — has the smallest primary heading of all major pages. The doctor's name should be the largest, most impactful heading on the entire site.

**Root cause:** The Sprint 8 CSS defined `.gu-about-hero__name { font-size: 2.5rem; }` = 40px. CPT singles use Elementor's heading widget at 48px. These were set independently.

**Fix approach:** Increase `.gu-about-hero__name` to `font-size: 3rem` (48px) or `font-size: clamp(36px, 4vw, 56px)` for fluid scaling.

---

### P1-6 · /despre/ mobile: name and CTA are below the fold

**Pages affected:** `/despre/` at 390px (Mobile)  
**Measured values:**

| Element | Top position | Height |
|---------|-------------|--------|
| Photo wrap | y: 206px | 245px |
| Content (name, title, CTA) | y: 483px | 369px |
| Viewport height | — | 844px |

On a standard iPhone viewport (390×844px), the header occupies ~80px, leaving 764px of visible area. The photo starts at y:206 and ends at y:451. The H1 "Dr. George Ungureanu" starts at y:483 — completely below what a user sees without scrolling.

A visitor arriving on `/despre/` on mobile sees: header, empty space (126px), then a 200×245px portrait photo. They must scroll before they see who they're reading about. The name and CTA are invisible on first load.

**Root cause:** The `.gu-about-hero` mobile layout stacks photo above content (`flex-direction: column`). The Elementor section has 80px top padding, pushing the photo down. The photo is 200px wide (centered on 390px = 95px margin each side) and 245px tall. Total height before the name: 80 + 206 + 245 + 32 = 563px on a 844px viewport.

H1 font-size on mobile: **28px** (compared to 40px desktop).

**Fix approach:**
1. Reduce the Elementor section top padding from ~80px to 40px on mobile via responsive padding settings
2. Reduce the mobile photo height from 245px to 180px (or use `max-height: 180px` on `.gu-about-hero__photo-wrap img` at ≤480px)
3. Consider showing the name before the photo on mobile (reorder `flex` items with `order` property at breakpoint)

---

### P1-7 · /despre/ section headings are 30px vs homepage 38px H2s

**Measured:**
- Homepage H2 sections: **38px** Lora 700
- /despre/ section headings (`.gu-about-section-heading`): **30px** Lora 700

Every section heading on the about page (Educație & Formare, Experiență Clinică, Domenii de Interes Special, etc.) is 30px. The homepage section headings ("Domenii de expertiză", "O abordare diferită") are 38px. A visitor who navigates from the homepage to /despre/ experiences a significant visual "shrink" in heading scale — the about page looks secondary or less important.

**Fix approach:** Change `.gu-about-section-heading { font-size: 2rem; }` to `font-size: 2.25rem` (36px) or `2.375rem` (38px).

---

### P1-8 · CPT single pages are unstyled text documents

**Pages affected:** `/afectiuni/hernie-de-disc-lombara/`, `/interventii/microdiscectomie-lombara/`, `/articole/hernia-de-disc-lombara/`  
**Measured:** `Content H2s: []` (empty — no content H2 was found inside `.page-content h2` or `.elementor-widget-text-editor h2`)

The single page content area (the ACF wysiwyg field rendered as a text block) has no editorial design applied to it. The content is a wall of prose text with:
- No visual break between H2 sections (line-height 1.0x, no top margin)
- No decorative element before H2 headings (no rule, no colored accent)
- No pull-quote styling for important callouts
- No key-takeaway box (`.gu-key-takeaways` selector: not found)
- No in-content illustrations or diagram placeholders

This is the most content-heavy part of the site and it receives the least design attention. For a neurosurgeon treating patients with complex conditions, editorial clarity in the patient-facing content is a trust signal.

**Root cause:** The CPT single shortcodes render ACF wysiwyg HTML without wrapper classes or editorial CSS applied. The plugin CSS does not have prose content styling rules.

---

### P1-9 · Mobile stats section: three numbers stack as enormous unstyled blocks

**Pages affected:** `/` at 390px (Mobile)  
**Measured:** Three separate e-con containers at 215px each (elements [16], [17], [18]) with no applied background, no separator treatment.

On desktop, "15+ / 2.000+ / 98%" appear as a horizontal stat strip with green accent color. On mobile, they stack vertically as three large numbers with their labels. Without visible separators between them, the three numbers look like one long block of text. The counter styling is not confirmed to include the green color on mobile — the screenshot shows green numbers, but the container measurement shows transparent backgrounds.

---

## P2 — Polish Issues

### P2-1 · "Domenii de expertiză" cards have no icon or visual anchor

The 6 specialty cards ("Tumori cerebrale", "Hernie de disc", etc.) are plain white boxes with a title and link. No icon, no hover animation, no left-accent border. Compared to premium healthcare websites, icon-less specialty cards feel generic and mid-tier.

### P2-2 · No breadcrumb navigation on any single page

Users landing on a CPT single from Google Search have no visible way to navigate back to the archive or understand the site structure. The hero section shows the title but no path context (e.g., "Afecțiuni → Hernie de disc lombară").

### P2-3 · Credential strip placeholder text overflows

The placeholder "[CLIENT: Denumire spital / cabinet de completat]" is longer than a typical hospital name and causes the strip item to wrap to 2 lines, making the credentials strip layout uneven. This is visible on desktop.

### P2-4 · Articole archive grid width differs from afectiuni/interventii

- /afectiuni/ and /interventii/: 3-column grid, 1080px total width  
- /articole/: 2-column grid, 740px total width

These are intentionally different (articles are wider cards), but the inconsistency is noticeable when comparing the archive pages side by side.

### P2-5 · Ghost button "Detalii și program" uses 2px radius and weight 400

In the footer, the ghost button "Detalii și program →" has `border-radius: 2px` and `font-weight: 400` — the most visually different button style on the site. It looks like a plain text link with a thin border.

### P2-6 · /despre/ CTA section text loses diacritics (overlaps P0-3)

The CTA section heading "Vorbiti cu Dr. George Ungureanu" and button "Programati o consultatie" are the most visible user-facing outputs of the Section 10 shortcodes. These are mentioned here separately because they appear prominently at the bottom of the most important page.

### P2-7 · Elementor "knowledge language" field outputs "Romana" in schema

The Physician JSON-LD schema on `/despre/` emits `"knowsLanguage": ["Romana", "Engleza"]`. The ISO 639-1 value should be `"ro"` and `"en"`, or the human-readable Romanian strings should use diacritics: `"Română"` / `"Engleză"`. Schema validators will not flag this as an error but it is inconsistent with standard Physician schema practice.

### P2-8 · Article card author avatar is a grey silhouette placeholder

On `/articole/hernia-de-disc-lombara/` and the articles archive, the author photo renders as the WordPress default grey user silhouette — the same placeholder used for any WordPress user without a photo. It is visually identical to any generic blog and undermines the personal brand.

### P2-9 · Homepage "about" teaser section shows grey box as photo placeholder

The homepage teaser section for Dr. Ungureanu uses a plain grey rectangle as the photo placeholder. On the about page, the placeholder is a styled SVG silhouette with "PORTRET PROFESIONAL NECESAR" text. These two placeholders are visually different from each other, which is inconsistent. Both will be replaced when the real photo arrives, but the homepage grey box looks more broken in the interim.

---

## Root Cause Analysis

### Root cause group A: Elementor Kit not synchronized with design system

The Elementor Kit (Site Settings → Global Colors / Global Fonts) was not updated to reflect the design tokens defined in `gu-design-system.css`. When Elementor widgets pull colors from the Kit, they get the defaults — hence the cyan button color. The CSS variables defined in the plugin are only applied to shortcode-rendered HTML, not to Elementor widget HTML.

**Cascading impact:** P0-1 (button color), P0-2 (radius inconsistency), P1-4 (CTA inconsistency)

### Root cause group B: Sprint-by-sprint build without design review checkpoints

Each sprint added components independently. Typography scales, button sizes, section paddings, and color choices were made separately without a cross-page visual audit until now. Decisions that looked fine in isolation (30px section headings, 4px radius buttons) create inconsistency at the site level.

**Cascading impact:** P0-2, P1-1, P1-5, P1-7, P2-5

### Root cause group C: Bash heredoc encoding limitation

Section 10 of the plugin (~215 lines of PHP) was appended using `cat >>` in a bash heredoc, which cannot reliably transmit multi-byte UTF-8 characters. All Romanian-language text strings were therefore written with ASCII approximations.

**Cascading impact:** P0-3 (all /despre/ sections missing diacritics)

### Root cause group D: No empty-state design for low-content archives

Archive templates were designed for multiple cards. No empty-state or sparse-content fallback was designed. With 1 published item per CPT, every archive page looks broken.

**Cascading impact:** P0-4

### Root cause group E: Mobile-first design not applied to /despre/ hero

The Sprint 8 hero CSS was designed desktop-first. The mobile stacking behavior was added via `@media (max-width: 768px)` but the photo dimensions and section padding were not tuned for the content shift.

**Cascading impact:** P1-6

---

## What Should Be Redesigned Globally vs Fixed Page-by-Page

### Global changes (all pages affected)

| # | Change | Scope | Priority |
|---|--------|-------|----------|
| G1 | Fix button color: set Elementor Kit accent → #4D7A70 | All pages, header/footer | P0 |
| G2 | Standardize button border-radius to 6px site-wide | All pages | P0 |
| G3 | Standardize button font-weight to 600 in header/footer | All pages | P1 |
| G4 | Add CSS minimum line-height for all heading levels: `h1,h2,h3 { line-height: 1.2; }` | All CPT singles | P1 |
| G5 | Redesign archive pages with empty-state blocks | /afectiuni/, /interventii/, /articole/ | P0 |
| G6 | Add header navigation links (if approved — design decision) | All pages | P1 |

### Page-specific changes

| Page | Change | Priority |
|------|--------|----------|
| `/despre/` | Fix all 16 Romanian diacritics in plugin PHP shortcodes | P0 |
| `/despre/` | Increase hero H1 to 48px (match CPT singles) | P1 |
| `/despre/` | Increase section headings to 36px (close gap with homepage 38px) | P1 |
| `/despre/` | Fix mobile hero: reduce photo height, reduce section top padding, bring H1 above fold | P1 |
| `/` (homepage) | Fix "O abordare diferită" card background: `#E4EDEB` → `#F4EFE6` | P1 |
| `/` (homepage) | Improve mobile stats section: add separators or card background | P2 |
| CPT singles | Add prose content CSS (h2 margin-top, h3 spacing, body line-height) | P1 |
| CPT singles | Add breadcrumb navigation element | P2 |
| CTA sections | Standardize CTA button to off-white `#FDFBF7` across all pages | P1 |

---

## Design Modernization Principles

For a premium solo-practitioner neurosurgeon website in 2025–2026, targeting educated Romanian patients making high-stakes medical decisions, the site must communicate:

1. **Precision** — every element is intentional. No inconsistencies, no misaligned sizes, no off-palette colors.
2. **Authority without intimidation** — the doctor is supremely competent but approachable. Warm ivory palette is correct; the cold #E4EDEB cards undermine this.
3. **Readability as trust** — patients reading about their brain tumor or spinal herniation need the clearest possible prose experience. Tight line-heights (1.0x) and absent editorial styling communicate carelessness.
4. **Brand coherence across every touchpoint** — the brand color (#4D7A70) must appear in the same shade on every button, every accent, every hover state. One cyan CTA button destroys this coherence.
5. **Completeness signal** — empty-looking archive pages with 1 card suggest the site is unfinished or abandoned. Empty-state blocks communicate "this is growing" rather than "this is broken."

**What is working well (do not change):**
- Lora serif / Inter sans-serif pairing — excellent typography foundation
- `#231E1A` ink color — warm, premium, distinctive
- `#FDFBF7` / `#F4EFE6` surface colors — sophisticated ivory palette
- `#4D7A70` accent green — authoritative, medical, distinct from commodity healthcare blue
- Dark "ink" CTA sections — strong conversion anchor on each page
- 12-section about page structure — correct inverted-pyramid IA
- Mobile-responsive grid on /despre/ interests section — works well

---

## Prioritized Fix Order (if approved)

Recommended sprint 8.2 sequence, fastest impact first:

1. **P0-3** — Fix diacritics in plugin PHP (Edit tool, no Elementor access needed, ~5 minutes)
2. **P0-1** — Fix header/footer button color (Elementor Kit update or CSS override)
3. **P0-2** — Standardize border-radius globally (CSS override in plugin)
4. **P1-1** — Fix "O abordare diferită" card background (Elementor editor)
5. **P1-2** — Add heading line-height minimum (1 CSS rule in plugin)
6. **P0-4** — Archive empty-state blocks (PHP shortcode update + CSS)
7. **P1-5 + P1-7** — /despre/ heading sizes (CSS in plugin)
8. **P1-6** — /despre/ mobile hero padding (CSS in plugin + responsive rules)
9. **P1-4** — CTA button color standardization (check CPT single templates)
10. **P1-8** — Prose content CSS for CPT singles (CSS in plugin)
11. **P2-x** — Polish items after visual review of items 1–10

---

*Stop — this document is the diagnosis only. No implementation changes have been made. Awaiting approval before proceeding with Sprint 8.2 fixes.*
