# Footer v3 — Implementation Plan

**Date:** 2026-06-28
**Sprint:** Sprint 1 — Foundation and Global Systems
**Component:** `organism-site-footer` (Footer v3)
**Status:** Planning complete — ready for Elementor implementation
**Governing documents:**
- `docs/tasks/03_HEADER_AND_NAVIGATION.md` §3 (primary source — footer architecture freeze)
- `docs/tasks/01_INFORMATION_ARCHITECTURE.md` §3.4, §9, §14 (site model, CTA rules, blocking deps)
- `docs/tasks/04_DESIGN_SYSTEM_TOKENS.md` (token values, color, typography, spacing)
- `docs/tasks/11_IMPLEMENTATION_MASTER_PLAN.md` (sprint requirements)

**Prerequisites required before footer build:**
- Phase A complete — Elementor Global Colors confirmed (all 8 required tokens present)
- Phase A complete — Elementor Global Typography confirmed
- GU Design System plugin active (`gu-design-system.css` loading)

**Relationship to header build:**
Footer build can begin in parallel with Phase C (Header). It depends only on Phase A (tokens). It does not depend on the navigation menu or the header template.

---

## 1. Final Footer Information Architecture

### 1.1 Governing Role

The footer is a global element applied to every page via Elementor Theme Builder → Display Conditions → Entire Site. It serves four distinct patient needs:

1. **Doctor identity reinforcement** — patients who have scrolled to the bottom of a page need a reminder of who this practice belongs to
2. **Secondary navigation** — entry points into condition content and educational content without requiring a scroll back to the top
3. **Appointment action** — the full CTA button at the bottom of every page ensures a patient who has finished reading can act immediately
4. **Legal compliance** — copyright, privacy policy link, cookie policy (conditional), and medical disclaimer are required before launch

### 1.2 Footer Structure

The footer consists of two rows:

```
Row 1 — Footer body (dark)
  ├── Column 1: Doctor Identity
  ├── Column 2: Afecțiuni
  ├── Column 3: Sfatul Neurochirurgului
  └── Column 4: Programări

Row 2 — Legal strip (slightly lighter dark, or same Ink with a top border)
  Copyright · Privacy Policy · Cookie Policy (conditional) · Medical disclaimer
```

**Background:** Row 1 and Row 2 both use `color-ink` (`#231E1A`) as the primary background. The legal strip is distinguished by a 1px `color-border` horizontal rule at its top edge, not by a different background color.

### 1.3 What Is Not in the Footer

From Task 03 §3.7 — the following are explicitly excluded:

| Element | Reason |
|---------|--------|
| Newsletter subscription form | Out of scope; creates data handling obligations beyond current GDPR setup |
| Social media feed embeds (live widgets) | Anti-pattern; GDPR tracking risk; API instability; editorial control loss |
| Live chat widget | Creates patient expectation of real-time medical response the practice cannot fulfil |
| Back-to-top button | Page-level affordance, not a footer content element |
| Award badges or accreditation seals | Out of scope for this iteration |
| Photography | Dark footer background makes photography impractical without full art direction |
| Testimonial preview | Belongs on /recomandari and homepage sections, not the footer |
| Analytics scripts or tracking pixels | Implementation concern, not a content element |
| Star ratings, review counts, or averages | This is not a review platform |

### 1.4 Document Conflict Note — Task 01 vs Task 03

Task 01 IA §3.4 describes a simplified footer with a pages-navigation column (Columns 2 and 3 as page links). Task 03 §3 provides a more detailed and later-written freeze of the footer architecture with condition links (Column 2) and SN article links (Column 3). **Task 03 governs.** The footer v3 follows the Task 03 specification. The v2 template was built closer to the Task 01 simplified model — this is a primary source of discrepancy that drives the v3 migration work.

---

## 2. Column Structure

### 2.1 Column 1 — Doctor Identity

**Purpose:** Remind the patient who this practice belongs to. Provide a grounding statement that reinforces trust before the patient leaves the page.

**Required content (in order):**

| Element | Content | Status |
|---------|---------|--------|
| Logo name | "Dr. George Ungureanu" — Inter 600 18px, `color-surface`, links to / | Ready to build |
| Logo subtitle | "Neurochirurg" — Inter 400 14px, `color-ink-secondary` adapted for dark bg | Ready to build |
| Title / credential | "Medic Primar Neurochirurgie" — confirm exact approved credential wording | ❓ Confirm with Dr. Ungureanu |
| Philosophy statement | 1–2 sentences in Dr. Ungureanu's voice — "Cred că fiecare pacient..." | ⛔ BLOCKED — Q from Dr. Ungureanu |
| Professional credibility | One line maximum — e.g., "Membru al Societății Române de Neurochirurgie" | ⛔ BLOCKED — Q from Dr. Ungureanu |
| Social icons | Small icon links to confirmed profiles (Instagram, Facebook, YouTube) | ⛔ BLOCKED — Q18 not resolved |

**Social icons rule (from Task 03 §3.2):** If Q18 is not resolved (social accounts not confirmed), the entire social icons row is absent. No placeholder icons. No broken links. The row either contains confirmed, working links or it does not exist.

**What Column 1 does NOT contain:**
- Phone number (moved to Column 4)
- Email address (moved to Column 4)
- Any navigation links to other pages
- Full biography excerpt (that belongs on /despre)
- Trust indicator numbers

**Token treatment on dark background:**

| Element | Color token | Note |
|---------|------------|------|
| Logo name text | Surface (#FDFBF7) | Primary readable on Ink |
| Logo subtitle text | Ink Secondary (#5A4E47) is too dark on Ink — use Surface at 70% opacity or Border token | Requires manual testing for WCAG AA |
| Title / credential text | Surface (#FDFBF7) or Border (#D6CFC4) | Both pass WCAG AA on Ink |
| Philosophy statement text | Surface (#FDFBF7) | Standard body text on dark bg |
| Professional credibility text | Border (#D6CFC4) | Secondary text, slightly receded |
| Social icons | Accent (#4D7A70) or Surface (#FDFBF7) | Both pass WCAG AA on Ink |

**Staging behavior:** During Sprint 1, Column 1 is built with logo, title/credential placeholder, and two clearly-marked placeholder paragraphs for the philosophy statement and credibility line. Social icons row is absent until Q18 is resolved. This is acceptable for the Sprint 1 Gate review — Dr. Ungureanu will provide the actual text before the Sprint 1 Gate passes.

---

### 2.2 Column 2 — Afecțiuni

**Purpose:** Give patients who are browsing the footer a second entry point into condition content. Footer condition links are a common path for patients who have landed on the site through search and are scanning for their specific condition.

**Required content (in order):**

| Element | Content | Status |
|---------|---------|--------|
| Section label | "AFECȚIUNI" — `type-overline`, `color-border` or Surface at reduced opacity | Ready to build |
| Archive link | "Toate afecțiunile →" → `/afectiuni` — `color-accent` treatment | Ready to build |
| 6–8 condition links | Individual condition links → /afectiuni/[slug] | ⛔ BLOCKED — Q4 (condition list) not resolved |

**Condition links rule:** Only conditions confirmed by Dr. Ungureanu (Q4) and with active individual pages appear as footer links. No placeholder condition links. No broken links. If conditions are not yet confirmed, only "Toate afecțiunile →" appears.

**What Column 2 does NOT contain:**
- Condition descriptions or summaries (footer is not a content surface)
- Images or icons per condition
- More than 8 conditions
- Any inactive conditions

**Staging behavior:** During Sprint 1, Column 2 contains only: the overline label and the "Toate afecțiunile" archive link. Individual condition links are added when Q4 is resolved and condition pages are built (Sprint 7 per the master plan).

**This is not a structural omission — it is the correct staging state.** The footer is built correctly at this stage. Content is absent because it does not yet exist in WordPress.

---

### 2.3 Column 3 — Sfatul Neurochirurgului

**Purpose:** Surface the educational brand and give patients a direct path to content without navigating through the hub first.

**Required content (in order):**

| Element | Content | Status |
|---------|---------|--------|
| Section label | "SFATUL NEUROCHIRURGULUI" — `type-overline` | Ready to build |
| Brand descriptor | One short line — e.g., "Resurse educaționale pentru pacienți și aparținători" | ⛔ BLOCKED — exact text from Dr. Ungureanu |
| Hub link | "Toate articolele →" → `/sfatul-neurochirurgului` — `color-accent` treatment | Ready to build |
| 4–6 featured article links | Individual SN Article links → /sfatul-neurochirurgului/[slug] | ⛔ BLOCKED — Q9 (min 3 articles) not resolved |
| YouTube channel link | "Urmăriți pe YouTube →" → YouTube channel URL | ⛔ BLOCKED — Q18 (YouTube confirmed) not resolved |

**Article links rule (from Task 03 §3.4):** Link text uses article `title` values. Selected by Dr. Ungureanu or the administrator from published SN Article CPT entries. 4 links minimum, 6 maximum. If fewer than 4 SN Articles are published, only "Toate articolele →" appears (no partial list of 1 or 2 links).

**YouTube link rule:** If the YouTube channel (Q18) is not confirmed, this row is absent. Not a placeholder link. Not a disabled icon. Absent.

**What Column 3 does NOT contain:**
- Embedded video players
- Social media feed widgets
- Article preview images
- Category filter links
- More than 6 article links

**Staging behavior:** During Sprint 1, Column 3 contains: overline label, brand descriptor placeholder (clearly marked), and "Toate articolele →" link. Article links and YouTube link are absent until their respective dependencies are resolved.

---

### 2.4 Column 4 — Programări

**Purpose:** The most actionable column. A patient who has been reading and is ready to take action scans the footer and finds everything they need to initiate contact — in this column.

**Required content (in order):**

| Element | Content | Status |
|---------|---------|--------|
| Section label | "PROGRAMĂRI" — `type-overline` | Ready to build |
| Primary CTA button | "Programează o consultație" → `/programari` — full column width, `color-accent` bg | Ready to build |
| Location city summary | City names only → each links to /programari | ⛔ BLOCKED — Q13 (location data) not resolved |
| Phone number | [Q15] → `tel:+40XXXXXXXXX` link | ⛔ BLOCKED — Q15 not resolved |
| Email address | [Q16] → `mailto:` link | ⛔ BLOCKED — Q16 not resolved |
| Secondary link | "Detalii și program →" → `/programari` — text link | Ready to build |

**Location city summary rule (from Task 03 §3.5):** City names only — not full addresses. If Q13 is not resolved, this row is absent entirely. No placeholder text, no "Locație de confirmat" text.

**Phone and email rules:** These fields contain real placeholder text in staging (clearly marked as `[TELEFON — Q15 BLOCANT]` etc.). They are replaced when Q15 and Q16 are resolved. They must be confirmed before the Sprint 1 Gate passes.

**CTA button in footer:** This is a standard `color-accent` primary CTA button — identical visual treatment to the header CTA and every other page-level CTA. It routes to `/programari`, consistent with the universal CTA routing rule.

**Column 4 HTML tag:** Column 4 is a `<div>` — NOT a `<nav>` element. Schedule and contact information is not site navigation; it is informational content. Only Columns 2 and 3 (which contain navigation links) receive `<nav>` landmark tags.

---

### 2.5 Legal Strip — Row 2

**Purpose:** Legal compliance and trust signaling. Required before any form on the site can go live (forms reference the privacy policy).

**Left side:**

| Element | Content | Status |
|---------|---------|--------|
| Copyright | "© 2026 Dr. George Ungureanu. Toate drepturile rezervate." | Ready to build |

**Right side (links separated by · ):**

| Element | Content | Status |
|---------|---------|--------|
| Privacy policy | "Politică de confidențialitate" → `/politica-de-confidentialitate` | Ready to build (page can be stub in staging) |
| Cookie policy | "Cookie-uri" → `/cookies` | ⛔ CONDITIONAL — Q21 (analytics decision) not resolved; omit entirely if not confirmed |

**Below or centered:**

| Element | Content | Status |
|---------|---------|--------|
| Medical disclaimer | One sentence — exact wording from Dr. Ungureanu | ⛔ BLOCKED — Q20 not resolved |

**Legal strip background:** Same `color-ink` as Row 1. A 1px `color-border` horizontal rule at the top of the legal strip creates visual separation without requiring a second background color. Text uses `type-caption` (Inter 13px / 400), `color-border` token for slightly receded appearance.

**Copyright year:** Static `2026`. Update each January or replace with a WordPress shortcode for dynamic year if available.

---

## 3. Responsive Behavior

### 3.1 Desktop (≥1024px)

- 4-column layout
- Column 1 approximately 28% width; Columns 2, 3, 4 share remaining width equally
- All columns align top (flex-start)
- Row 1 inner padding: 64px top/bottom (`spacing-xl`), 32px left/right (`space-8`)
- Inter-column gap: 32px (`space-8`) or defined with Elementor column gap control

### 3.2 Tablet (768–1023px)

- 2×2 grid: Columns 1+2 on top row; Columns 3+4 on bottom row
- Each column: 46–48% width, with auto margin or flex gap handling the remaining space
- Column order: 1 (top-left) · 2 (top-right) · 3 (bottom-left) · 4 (bottom-right)
- Row 1 inner padding: 40px top/bottom, 24px left/right

In Elementor: set the inner container `flex_wrap: wrap` at the tablet breakpoint, and set each column width to 46% at tablet.

### 3.3 Mobile (≤767px)

- **Column order on mobile reverses to prioritize the most actionable content first:**
  - Column 4 (Programări — CTA and contact) appears first
  - Column 1 (Doctor Identity) appears second
  - Columns 2 and 3 (Afecțiuni and SN links) appear third and fourth

This reordering ensures that a patient who has scrolled to the footer on mobile sees the appointment action before the navigation links. Desktop order (1, 2, 3, 4) is correct for left-to-right scanning; mobile order (4, 1, 2, 3) is correct for top-to-bottom scanning.

- Each column: full width (100%)
- Row 1 inner padding: 48px top/bottom, 24px left/right
- Inter-column spacing: 40px (`spacing-lg`) between stacked columns
- CTA button in Column 4: full width on mobile (inherits from column width)

**Implementing column reorder in Elementor:**
Use Elementor's column order controls at the mobile breakpoint. Set Column 4 order to `1`, Column 1 order to `2`, Column 2 order to `3`, Column 3 order to `4`. This reorders visually without changing DOM order — the DOM order can remain 1, 2, 3, 4 for accessibility consistency. (Verify with keyboard and screen reader that the visual reorder does not create navigation confusion.)

### 3.4 Legal Strip Responsive

| Breakpoint | Layout |
|------------|--------|
| Desktop | Row: copyright left · privacy/cookies right · disclaimer below |
| Tablet | Two rows: copyright + links on row 1; disclaimer on row 2 |
| Mobile | Three stacked elements: copyright → privacy/cookies → disclaimer |

Legal strip padding: 20px all breakpoints.

---

## 4. Placeholder Content — Blocked Pending Dr. Ungureanu

The following footer content cannot be built until specific questions are answered by Dr. Ungureanu. These are documented here with their staging treatment so the footer can be built now and completed later without structural rework.

| # | Content | Column | Blocking question | Staging treatment |
|---|---------|--------|-------------------|-------------------|
| 1 | Doctor credential/title | 1 | Confirm exact approved credential line | Placeholder text clearly marked `[TITLU — de confirmat cu Dr. Ungureanu]` |
| 2 | Philosophy statement | 1 | Content must come from Dr. Ungureanu | Placeholder text clearly marked `[DECLARAȚIE FILOSOFIE — de scris de Dr. Ungureanu]` — two sentences in size |
| 3 | Professional credibility line | 1 | Content must come from Dr. Ungureanu | Placeholder text `[AFILIERE PROFESIONALĂ — de confirmat cu Dr. Ungureanu]` |
| 4 | Social media icons | 1 | Q18 — social accounts confirmed | Entire social icons row is ABSENT; not a placeholder — the row does not exist until Q18 resolved |
| 5 | Individual condition links | 2 | Q4 — condition list and slugs confirmed | Row absent; only "Toate afecțiunile →" shown |
| 6 | SN brand descriptor | 3 | Content must come from Dr. Ungureanu | Placeholder text `[DESCRIPTOR BRAND SN — de scris de Dr. Ungureanu]` — one line |
| 7 | Individual SN article links | 3 | Q9 — min. 3 SN articles published | Row absent; only "Toate articolele →" shown |
| 8 | YouTube link | 3 | Q18 — YouTube channel confirmed | Entire row is ABSENT until Q18 resolved |
| 9 | Location city summary | 4 | Q13 — location data confirmed | Entire row is ABSENT until Q13 resolved (no placeholder) |
| 10 | Phone number | 4 | Q15 — confirmed phone number | Placeholder `[TELEFON — Q15 BLOCANT]` in staging; must be resolved before Gate |
| 11 | Email address | 4 | Q16 — confirmed email address | Placeholder `[EMAIL — Q16 BLOCANT]` in staging; must be resolved before Gate |
| 12 | Cookie policy link | Legal strip | Q21 — analytics/cookie decision | Entire link is ABSENT until Q21 resolved |
| 13 | Medical disclaimer | Legal strip | Q20 — approved disclaimer wording | Placeholder `[DISCLAIMER MEDICAL — aprobare Dr. Ungureanu / consilier juridic]` — Gate-blocking |

### 4.1 Gate-Blocking Content vs. Sprint-Blocking Content

**Must be resolved before the Sprint 1 Gate review (Dr. Ungureanu cannot approve the footer without these):**
- Q15 — Phone number (Column 4)
- Q16 — Email address (Column 4)
- Q20 — Medical disclaimer (Legal strip)

**Can remain as placeholder in staging and resolved in later sprints:**
- Philosophy statement, credibility line, brand descriptor (Column 1, 3) — placeholder acceptable through Sprint 1 Gate
- Condition links (Column 2) — absent is correct until Sprint 7
- SN article links (Column 3) — absent is correct until Sprint 6
- Social icons, YouTube link (Column 1, 3) — absent until Q18 resolved (can be after Gate)
- Location city summary (Column 4) — absent until Q13 resolved (Sprint 3 content)
- Cookie policy link (Legal strip) — conditional on Q21 (can remain absent)

---

## 5. Accessibility Requirements

### 5.1 Landmark and Semantic Structure

| Element | HTML tag | ARIA attribute |
|---------|----------|---------------|
| Outer footer container | `<footer>` | `role="contentinfo"` |
| Column 2 (Afecțiuni nav) | `<nav>` | `aria-label="Footer — afecțiuni"` |
| Column 3 (SN nav) | `<nav>` | `aria-label="Footer — Sfatul Neurochirurgului"` |
| Column 4 | `<div>` | (NOT nav — informational content, not navigation) |
| Legal strip nav area | `<div>` | No landmark — legal text and links are not navigation |

**Elementor implementation:** Set HTML tags via Advanced → HTML Tag and custom attributes via Advanced → Custom Attributes on the relevant container widgets.

### 5.2 Color Contrast on Dark Background

All text in the footer must pass WCAG 2.1 AA on the `color-ink` (#231E1A) background.

| Text element | Intended token | Hex | Ratio on Ink | WCAG AA |
|-------------|---------------|-----|-------------|---------|
| Primary text (logo, column content) | Surface | #FDFBF7 | 14.5:1 | Pass |
| Secondary text (credibility line, captions) | Border | #D6CFC4 | 7.5:1 | Pass |
| Overline labels | Border or Surface | #D6CFC4 or #FDFBF7 | 7.5:1 or 14.5:1 | Pass |
| Navigation links | Surface | #FDFBF7 | 14.5:1 | Pass |
| Navigation link hover | Accent | #4D7A70 | 4.6:1 | Pass |
| Navigation archive links | Accent | #4D7A70 | 4.6:1 | Pass |
| CTA button text | Surface on Accent | #FDFBF7 on #4D7A70 | 4.6:1 | Pass |
| Legal strip text | Border | #D6CFC4 | 7.5:1 | Pass |

**Note on `color-ink-secondary` (#5A4E47):** This token has a contrast ratio of approximately 1.6:1 against `color-ink` (#231E1A) — it fails WCAG AA by a wide margin. Do not use `color-ink-secondary` for any text in the footer. Use `color-border` (#D6CFC4) as the secondary text color on dark backgrounds.

### 5.3 Focus States

All interactive elements in the footer (navigation links, CTA button, legal strip links) receive the same visible focus ring as all other site elements:
- 2px solid `color-accent` (#4D7A70)
- 3px offset

Focus rings on a dark background are naturally more visible than on a light background. No additional styling needed — the global focus rule from `gu-design-system.css` applies.

### 5.4 Link Underlines and Hover States

Footer navigation links (Columns 2 and 3) use no underline by default and a hover underline to signal interactivity. This is achieved via CSS in Elementor → Site Settings → Custom CSS:

```
/* Column 2 and 3 nav link hover */
#organism-site-footer .elementor-widget-heading a {
  text-decoration: none;
}
#organism-site-footer .elementor-widget-heading a:hover {
  color: var(--color-accent);
  text-decoration: underline;
  text-underline-offset: 3px;
}

/* Footer logo — no underline */
#molecule-logo-footer a { text-decoration: none; }
#molecule-logo-footer a:hover { text-decoration: none; opacity: 0.85; }
```

### 5.5 Keyboard Navigation

All footer navigation links and the CTA button must be reachable by keyboard. Tab order within the footer follows the visual reading order at the current viewport:

- Desktop: Column 1 links → Column 2 links → Column 3 links → Column 4 CTA → Column 4 secondary links → Legal strip links
- Mobile: Column 4 links → Column 1 links → Column 2 links → Column 3 links → Legal strip links (note: DOM order determines Tab order; if the mobile visual reorder is achieved through Elementor `order` CSS, the Tab order follows the DOM, not the visual order — verify that mobile column reorder does not create confusing keyboard navigation)

### 5.6 Reduced Motion

The footer has minimal animation (hover color transition on links). Under `prefers-reduced-motion: reduce`, all transitions become instant. The global rule in `gu-design-system.css` handles this.

---

## 6. Footer CTA Behavior

### 6.1 CTA Button in Column 4

The Column 4 CTA button is the footer's primary action element.

| Property | Value |
|----------|-------|
| Label | "Programează o consultație" — exact text, always |
| Destination | `/programari/` |
| Background | `color-accent` (#4D7A70) — Global Color token |
| Hover background | `color-accent-hover` (#3A5F57) — Global Color token |
| Text color | `color-surface` (#FDFBF7) — Global Color token |
| Width | Full width of Column 4 |
| Border-radius | 6px (`radius-button`) |
| Padding | `space-4` vertical (16px) × `space-6` horizontal (24px) |
| Font | `type-cta` (Inter 600 / 16px) |

### 6.2 CTA Routing Rule in the Footer

The footer CTA routes to `/programari/` — not to `/contact/` directly. This is the universal CTA routing rule:

```
Any page → "Programează o consultație" → /programari → "Contactați-ne" → /contact
```

The footer CTA is part of "any page." Even though a patient at the footer has scrolled to the bottom and may feel ready to contact, the route through /programari is preserved. This ensures the patient sees location information before committing to contact.

**The footer is NOT an exception to the CTA routing chain.**

### 6.3 What the Footer CTA Is Not

- It is not a ghost button or secondary button — it is the primary action element in Column 4, identical in treatment to the header CTA
- It is not optional — it must be present in every Sprint 1 footer build
- It does not route to a modal, a phone number, or a form — always to `/programari/`
- On mobile, the CTA appears first in the column stack (Column 4 is first on mobile), making it the first visible action element on the footer

### 6.4 The "Detalii și program" Secondary Link

Below the CTA button, a secondary text link "Detalii și program →" also routes to `/programari/`. This link provides an alternative path for patients who want to understand what they'll find before clicking the button. Both the button and the link route to the same destination — the button is primary (visual prominence), the text link is secondary (lower visual weight).

---

## 7. Migration Plan: Footer v2 → Footer v3

### 7.1 Overview

Footer v2 was built before the planning suite was frozen. The migration requires both structural corrections (columns 2, 3, and 4 have different content from the frozen spec) and a fundamental visual treatment change (background color). This is a heavier migration than the header — the footer's column content structure diverges significantly from v2.

```
Footer v2 (imported)
      │
      ▼
Open in Elementor Theme Builder → organism-site-footer
      │
      ├── REUSE: outer container two-row structure (Row 1 + Row 2)
      ├── REUSE: inner container max-width 1200px, centered
      ├── REUSE: Column 1 logo widget structure (logo name + subtitle, links to /)
      ├── REUSE: four-column flex layout skeleton
      ├── REUSE: legal strip row structure
      │
      ├── CORRECT (visual): Row 1 background → color-ink (#231E1A)
      ├── CORRECT (cascading): all text and link colors → dark background treatment
      ├── CORRECT (cascading): all hex values → Global Color tokens
      ├── CORRECT (structural): Column 1 — remove phone/email; add philosophy and credibility placeholders
      ├── REBUILD: Column 2 — from "PAGINI" page nav → "AFECȚIUNI" condition links
      ├── REBUILD: Column 3 — from "CONDIȚII TRATATE" (old slugs) → "SFATUL NEUROCHIRURGULUI" hub links
      ├── CORRECT (structural): Column 4 — add primary CTA button; confirm placeholders; add secondary link
      ├── CORRECT (HTML): outer container → <footer>, role="contentinfo"
      ├── CORRECT (HTML): Column 2 container → <nav aria-label="Footer — afecțiuni">
      ├── CORRECT (HTML): Column 3 container → <nav aria-label="Footer — Sfatul Neurochirurgului">
      ├── CORRECT (HTML): Column 4 container → <div> (NOT nav)
      ├── CORRECT (mobile): set column order 4→1→2→3 at mobile breakpoint
      │
      └── Result: Footer v3 — compliant with Task 03 §3 frozen spec
```

### 7.2 What Can Be Reused from v2

| Element | v2 status | v3 action |
|---------|-----------|-----------|
| Outer two-row structure (Row 1 + Row 2) | Present | Verify CSS IDs are correct |
| Inner container (max-width 1200px, centered) | Present | Verify padding values |
| Four-column flex layout | Present | Rebuild column 2 and 3 content; keep flex structure |
| Column 1 logo zone (name + subtitle + link to /) | Present | Correct colors; remove phone/email; add placeholders |
| Legal strip row structure | Present | Correct background/border treatment; update links |
| Footer CSS ID (`organism-site-footer`) | Present | Verify on outer container |

### 7.3 What Must Be Corrected

| Issue | v2 state | v3 requirement | Priority |
|-------|----------|----------------|----------|
| Row 1 background | #EDE8DF (Surface Muted) | color-ink (#231E1A) via Global Color token | **Critical — cascades to everything** |
| All text colors | Light-on-light (surface on surface-muted) | Light-on-dark (surface/border on ink) | **Critical** |
| All hardcoded hex values | Present throughout | Elementor Global Color tokens | **High** |
| Column 1 phone/email | Present | Moved to Column 4 — remove from Column 1 | High |
| Column 1 philosophy content | Absent | Add placeholder text (clearly marked) | High |
| Column 2 content | "PAGINI" page nav (wrong) | "AFECȚIUNI" condition links — full rebuild | High |
| Column 3 content | "CONDIȚII TRATATE" (old slugs /conditii/) | "SFATUL NEUROCHIRURGULUI" hub links — full rebuild | High |
| Column 4 CTA button | Absent (only a ghost link) | Add primary CTA button → /programari | High |
| Column 4 phone/email | Absent | Add Q15 and Q16 placeholder text (Gate-blocking) | High |
| Column 4 overline label | "PROGRAM CONSULTAȚII" | "PROGRAMĂRI" | Medium |
| Outer container HTML tag | May not have transferred on import | Set to `<footer>` via Advanced → HTML Tag | High |
| `role="contentinfo"` | May not have transferred | Advanced → Custom Attributes | High |
| Column 2 HTML tag | Likely `<div>` | Change to `<nav>` | High |
| Column 2 `aria-label` | Absent | `aria-label="Footer — afecțiuni"` | High |
| Column 3 HTML tag | Likely `<div>` | Change to `<nav>` | High |
| Column 3 `aria-label` | Absent | `aria-label="Footer — Sfatul Neurochirurgului"` | High |
| Column 4 HTML tag | Likely `<div>` | Confirm is `<div>` — NOT nav | Medium |
| Mobile column order | Desktop order (1,2,3,4) | Mobile order: Column 4 first, then 1, 2, 3 | Medium |
| Legal strip background | #F4EFE6 (Surface Warm) | color-ink with top border rule | Medium |
| Legal strip text colors | Dark on light | Light on dark — Border token | Medium |
| Copyright text | "© 2026" | Confirm year; verify full text | Low |

### 7.4 What Should Be Deleted

| Item | Action |
|------|--------|
| v2 "Clinici și locații →" link in Column 1 | Remove — this link now lives in Column 4 as "Detalii și program →" |
| v2 "CONDIȚII TRATATE" links with `/conditii/[slug]` slugs | Replace entirely with Column 3 SN content (v3 Column 3 is a full rebuild) |
| Any page links that reference `/resurse/` | Remove — the section is now /sfatul-neurochirurgului/ |
| Any link that references `/conditii/` | Remove — the section is now /afectiuni/ |
| "Programări" link in v2 Column 2 nav | Remove — /programari is not in the footer navigation; it is the CTA destination |

### 7.5 Column 2 and 3 Rebuild Strategy

Columns 2 and 3 require a structural rebuild, not a correction. The v2 content (page navigation links) does not correspond to the v3 content (condition links and SN article links).

**Recommended approach:**
1. Delete all widget content inside Column 2 and Column 3 (keep the column containers)
2. Change Column 2 container HTML tag to `<nav>` and add `aria-label`
3. Change Column 3 container HTML tag to `<nav>` and add `aria-label`
4. Build Column 2 content fresh: overline → "Toate afecțiunile →" link (condition links absent at Sprint 1)
5. Build Column 3 content fresh: overline → brand descriptor placeholder → "Toate articolele →" link (article links absent at Sprint 1)

This is faster than trying to repurpose the v2 link structure and avoids carrying over incorrect slug patterns.

---

## 8. Acceptance Criteria

Footer v3 is approved only if all of the following pass. Items marked [DR] require Dr. Ungureanu's review.

### Visual Treatment
- [ ] Row 1 background is `color-ink` (#231E1A) — verified via browser DevTools element inspector (**blocking**)
- [ ] All text in Row 1 is readable on dark background — no light-on-light combinations remain (**blocking**)
- [ ] Legal strip (Row 2) background is `color-ink` with a 1px `color-border` top rule
- [ ] No hardcoded hex values remain — all colors are Elementor Global Color tokens (**blocking**)
- [ ] No one-off local color overrides

### Column 1 — Doctor Identity
- [ ] Logo "Dr. George Ungureanu" present, Inter 600 18px, Surface color, links to /
- [ ] Logo subtitle "Neurochirurg" present, Inter 400 14px, readable on dark background, links to /
- [ ] No underline on logo links
- [ ] Philosophy statement placeholder is clearly marked (not published as real content)
- [ ] Professional credibility placeholder is clearly marked
- [ ] Social icons row is ABSENT (Q18 not yet resolved — row must not exist, not be hidden)
- [ ] Phone and email are NOT in Column 1 (moved to Column 4)

### Column 2 — Afecțiuni
- [ ] Overline label: "AFECȚIUNI" — `type-overline`, readable on dark background
- [ ] Archive link: "Toate afecțiunile →" → `/afectiuni/` — Accent color, hover underline
- [ ] Individual condition links: ABSENT (correct staging state — not a missing element)
- [ ] Column 2 container: HTML tag is `<nav>`, `aria-label="Footer — afecțiuni"`

### Column 3 — Sfatul Neurochirurgului
- [ ] Overline label: "SFATUL NEUROCHIRURGULUI" — `type-overline`, readable on dark background
- [ ] Brand descriptor placeholder is clearly marked
- [ ] Hub link: "Toate articolele →" → `/sfatul-neurochirurgului/` — Accent color, hover underline
- [ ] Individual article links: ABSENT (correct staging state)
- [ ] YouTube link: ABSENT (Q18 not resolved — must not exist, not be hidden)
- [ ] Column 3 container: HTML tag is `<nav>`, `aria-label="Footer — Sfatul Neurochirurgului"`

### Column 4 — Programări
- [ ] Overline label: "PROGRAMĂRI" — `type-overline`, readable on dark background
- [ ] Primary CTA button present: "Programează o consultație" → `/programari/` (**blocking**)
- [ ] CTA button: full column width, `color-accent` background, `color-surface` text
- [ ] CTA button: routes to `/programari/` — not to `/contact/` (**blocking**)
- [ ] Location city summary: ABSENT (correct staging state — Q13 not resolved)
- [ ] Phone placeholder: present and clearly marked as placeholder — Gate-blocking to resolve
- [ ] Email placeholder: present and clearly marked as placeholder — Gate-blocking to resolve
- [ ] Secondary link: "Detalii și program →" → `/programari/` present
- [ ] Column 4 container: HTML tag is `<div>` (NOT nav)

### Legal Strip
- [ ] Copyright text: "© 2026 Dr. George Ungureanu. Toate drepturile rezervate."
- [ ] Privacy policy link: "Politică de confidențialitate" → `/politica-de-confidentialitate/` (page can be stub in staging)
- [ ] Cookie policy link: ABSENT until Q21 resolved (correct staging state)
- [ ] Medical disclaimer: placeholder clearly marked — Gate-blocking to resolve (Q20)
- [ ] All legal strip text uses `type-caption` (Inter 13px / 400)
- [ ] Legal strip text color: `color-border` (#D6CFC4) or `color-surface` at reduced opacity — passes WCAG AA on Ink

### Semantic and Accessibility
- [ ] Outer footer container: HTML tag `<footer>`, `role="contentinfo"` attribute (**blocking**)
- [ ] Column 2 container: `<nav>`, `aria-label="Footer — afecțiuni"`
- [ ] Column 3 container: `<nav>`, `aria-label="Footer — Sfatul Neurochirurgului"`
- [ ] Column 4 container: `<div>` (not nav)
- [ ] All links reachable by keyboard (Tab through footer from start to legal strip)
- [ ] All focused elements have visible 2px `color-accent` focus ring
- [ ] No information communicated by color alone

### Responsive Layout
- [ ] Desktop (1280px): 4-column layout — all columns visible side by side
- [ ] Tablet (768–1023px): 2×2 grid — Columns 1+2 top row; Columns 3+4 bottom row
- [ ] Mobile (≤767px): 1-column stack — Column 4 first, Column 1 second, Columns 2+3 below
- [ ] No horizontal scroll at 375px
- [ ] CTA button is full-width of its column at all breakpoints

### Display Condition
- [ ] Display condition: Include → Entire Site
- [ ] Footer appears on the WordPress homepage
- [ ] Footer appears on any test interior page (or stub page)
- [ ] No page renders without the footer

### Gate-Blocking Content
- [ ] Q15 (phone) is resolved: confirmed number replaces placeholder in Column 4 (**Sprint 1 Gate requires this**)
- [ ] Q16 (email) is resolved: confirmed address replaces placeholder in Column 4 (**Sprint 1 Gate requires this**)
- [ ] Q20 (medical disclaimer) is resolved: approved text replaces placeholder in legal strip (**Sprint 1 Gate requires this**)
- [ ] [DR] Dr. Ungureanu has approved footer at 1280px, 768px, and 375px

---

*Sprint 1 Footer v3 Plan — version 1.0 — 2026-06-28*
*Next step after approval: implement in Elementor following the migration plan in Section 7*
*After footer v3 is complete: proceed to Phase G (404 page) per Sprint 1 Foundation Checklist*
