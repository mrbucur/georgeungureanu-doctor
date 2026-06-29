# Header v3 — Implementation Plan

**Date:** 2026-06-28
**Sprint:** Sprint 1 — Foundation and Global Systems
**Component:** `organism-site-header` (Header v3)
**Status:** Planning complete — ready for Elementor implementation
**Governing documents:**
- `docs/tasks/03_HEADER_AND_NAVIGATION.md` (primary source)
- `docs/tasks/04_DESIGN_SYSTEM_TOKENS.md` (token values)
- `docs/tasks/11_IMPLEMENTATION_MASTER_PLAN.md` (sprint requirements)
- `docs/implementation/SPRINT_1_FOUNDATION_CHECKLIST.md` (Phase C implementation steps)

**Prerequisites confirmed:**
- WordPress staging operational
- Elementor Pro active
- Global Colors and Typography configured
- Custom fonts configured
- GU Design System plugin active

---

## 1. Final Navigation

### 1.1 Frozen Navigation Structure

The navigation is frozen. Labels, order, and URLs are not subject to revision without a documented decision logged in `docs/tasks/03_HEADER_AND_NAVIGATION.md`. The following table is the implementation specification.

| Position | Type | Label | URL | Notes |
|----------|------|-------|-----|-------|
| Left | Identity element | Dr. George Ungureanu / Neurochirurg | `/` | Text-only in Phase 1; logo image pending Q19 |
| Nav 1 | Text nav item | Acasă | `/` | |
| Nav 2 | Text nav item | Afecțiuni | `/afectiuni` | No diacritics in slug |
| Nav 3 | Text nav item | Sfatul Neurochirurgului | `/sfatul-neurochirurgului` | Full label — never abbreviated |
| Nav 4 | Text nav item | Recomandări | `/recomandari` | No diacritics in slug |
| Nav 5 | Text nav item | Despre | `/despre/` | Approved short label — confirmed 2026-06-28 |
| Right | CTA button | Programează o consultație | `/programari` | Not a nav item — visually distinct button |

**Total text nav items: 5.** The CTA button is the 6th element visually but is not a WordPress menu item. It is a persistent Elementor Button widget.

### 1.2 WordPress Menu Configuration

Create (or recreate) the WordPress menu:

```
Menu name: Navigare principală
Menu location: Primary Navigation

Items (in order):
  1. Acasă           → /
  2. Afecțiuni       → /afectiuni/
  3. Sfatul Neurochirurgului → /sfatul-neurochirurgului/
  4. Recomandări     → /recomandari/
  5. Despre → /despre/
```

The CTA ("Programează o consultație" → `/programari/`) is NOT added to this menu. It is a separate Elementor Button widget inside the header container.

### 1.3 Menu Hierarchy — Phase 1

**Single-level only. No sub-menus. No dropdowns.**

Every item in the menu is a direct link. "Afecțiuni" links to `/afectiuni` (the conditions archive). It does not open a dropdown listing individual conditions. "Sfatul Neurochirurgului" links to `/sfatul-neurochirurgului` (the hub). It does not expand to reveal article categories.

Patients navigate within those sections using the hub pages, not sub-menus in the global nav. The two-tap maximum — open hamburger, tap destination — is a non-negotiable constraint for the target audience.

### 1.4 Why No Dropdowns in Phase 1

The governing reason is patient clarity under cognitive load.

A patient arriving with a recent neurological diagnosis has reduced working memory available for navigation. A dropdown sub-menu requires the patient to:
1. Hover or tap the top-level item
2. Hold the dropdown open while scanning
3. Select a sub-item without accidentally dismissing the dropdown
4. Understand the relationship between the top-level item and the sub-items

This is three failure points that did not exist before the dropdown appeared.

The flat navigation structure answers the patient's actual need: a short list of clearly-named destinations, reachable in one action. Within each destination, the hub page architecture handles further discovery without requiring sub-menus.

**Phase 2 consideration (not implemented in Phase 1):** A secondary text-based navigation within the `/sfatul-neurochirurgului` hub page becomes relevant only when more than 12 SN Articles exist across at least two distinct content types. This secondary navigation lives on the hub page, not in the global header. The primary navigation does not change.

### 1.5 Future Extensibility

The five-item navigation does not grow. Phase 2 content additions — additional SN Articles, more condition pages, timeline events, media items — live within existing sections. No new top-level nav items are added without a documented architecture review. This constraint is protective: the five items exist because five is the correct number for this audience, not because there is no more content.

Conditional Phase 2 considerations (documented in Task 03 §6, not implemented):
- Sfatul Neurochirurgului secondary text navigation (within the hub page, not the global header)
- YouTube channel link in Footer Column 3 (footer only)
- Language selector (requires full multilingual architecture — not a toggle added to the header)

### 1.6 Navigation Order Rationale

The order is a deliberate trust-building sequence, not an arbitrary or alphabetical arrangement:

1. **Acasă** — orientation
2. **Afecțiuni** — the patient's clinical question (what is my condition?)
3. **Sfatul Neurochirurgului** — the patient's educational question (what should I know?)
4. **Recomandări** — social proof (do others trust this doctor?)
5. **Despre** — identity confirmation (who is this person?)

A patient who reaches Recomandări after engaging with Afecțiuni and Sfatul Neurochirurgului reads testimonials as confirmation. A patient who goes to Recomandări before reading anything reads them as marketing claims. The order is the persuasion strategy.

---

## 2. Desktop Layout (1280px)

### 2.1 Container Structure

```
Outer container: full-width sticky strip
  └── Inner container: max-width 1200px, centered, flex row, space-between
        ├── Logo zone (flex-start, flex-shrink: 0)
        │     "Dr. George Ungureanu" (Inter 600 18px)
        │     "Neurochirurg" (Inter 400 14px, color-ink-secondary)
        │     Both lines link to /
        ├── Nav + CTA zone (flex-end, flex row, align-center)
        │     ├── Nav Menu widget (Navigare principală)
        │     └── Button widget (Programează o consultație → /programari)
        └── (Skip-to-content link — first DOM element, visually off-screen)
```

### 2.2 Dimension and Spacing Rules

All values are from the Task 04 spacing system (8px base unit).

| Property | Value | Token |
|----------|-------|-------|
| Inner container max-width | 1200px | — |
| Inner padding top/bottom (default) | 20px | `space-5` |
| Inner padding left/right | 32px | `space-8` |
| Header height (default) | 72–80px | — |
| Header height (scroll-reduced) | 56–64px | — |
| Gap between nav items | 24px | `space-6` |
| Gap between last nav item and CTA button | 32px | `space-8` |
| CTA button padding vertical | 12px | `space-3` (adjusted for header height) |
| CTA button padding horizontal | 24px | `space-6` |
| CTA button border-radius | 6px | `radius-button` |

### 2.3 Alignment Rules

- **Logo:** `flex-start`, `flex-shrink: 0`, left-aligned within inner container
- **Nav + CTA zone:** `flex-end` within inner container; nav items and CTA button are `align-items: center` within their flex row
- **Nav items:** horizontal, `gap: 24px`, no wrapping
- **CTA button:** rightmost element, `margin-left: 32px` (or `gap: 32px` from last nav item via flex)

### 2.4 Typography

| Element | Token | Exact value |
|---------|-------|------------|
| Logo name | Inter 600 18px | From Global Typography or local — Inter, 600, 18px |
| Logo subtitle | Inter 400 14px | `color-ink-secondary` (#5A4E47) |
| Nav items | `type-nav` | Inter 15px / 500 weight / LH 1.0 |
| CTA button | `type-cta` | Inter 16px / 600 weight / LH 1.0 |

**Range 1025–1279px:** If wrapping occurs at this range, `type-nav` may reduce to 14px for this range only, returning to 15px at 1280px+. Do not abbreviate nav labels.

### 2.5 Maximum Label Lengths

The two longest items require careful width management. From Task 03 §5.1:

| Nav item | Approximate width at type-nav (15px) |
|----------|--------------------------------------|
| Acasă | ~45px |
| Afecțiuni | ~80px |
| Sfatul Neurochirurgului | ~195px |
| Recomandări | ~100px |
| Despre | ~55px |
| **Total nav text** | **~475px** |
| 4 × 24px inter-item gaps | 96px |
| CTA "Programează o consultație" + padding | ~278px |
| Nav-to-CTA gap | 32px |
| Logo zone | ~180px |
| Container padding L+R | 64px |

**Total at 1280px: ~1125px of content in a 1200px inner container.**

With the approved short label "Despre" (~55px) replacing the previous "Despre Dr. George Ungureanu" (~245px), the nav fits comfortably within the 1200px container. The remaining watch item is "Sfatul Neurochirurgului" at ~195px — still the longest single item. Implementation should verify at exactly 1280px; wrapping is not expected but must be confirmed. If wrapping occurs (unlikely), reduce nav font-size to 14px at 1025–1279px before any other change.

### 2.6 No-Wrapping Policy

Header wrapping to two rows at any supported viewport width is a failed implementation, not a design variation. Resolution steps in order:

1. First: Reduce nav font-size to 14px at 1025–1279px (not below 1280px)
2. If still wrapping: Reduce logo zone width slightly
3. If still wrapping: Reduce nav-item gap from 24px to 20px
4. Never: abbreviate nav labels, hide any nav item, or reduce the CTA label

The no-wrapping rule is absolute. A two-row header fails the patient experience: the sticky header occupies more screen real estate, pushing content down and creating visual instability on scroll.

### 2.7 Color Tokens — Header Elements

All colors must be Elementor Global Color tokens. No hardcoded hex values.

| Element | State | Global Color token | Hex |
|---------|-------|--------------------|-----|
| Header background | All states | Surface | `#FDFBF7` |
| Header bottom border | — | Border | `#D6CFC4` |
| Nav item text | Default | Ink | `#231E1A` |
| Nav item text | Hover | Accent | `#4D7A70` |
| Nav item text | Active (current page) | Accent | `#4D7A70` |
| Active nav indicator | Active | Accent | `#4D7A70` (2px bottom border) |
| Logo name | — | Ink | `#231E1A` |
| Logo subtitle | — | *(no token — Ink Secondary is not in the 8-token set; see §2.8)* | `#5A4E47` |
| CTA background | Default | Accent | `#4D7A70` |
| CTA background | Hover | Accent Hover | `#3A5F57` |
| CTA text | — | Surface | `#FDFBF7` |
| Sticky shadow | On scroll | — | `rgba(35,30,26,0.10)` |

### 2.8 Logo Subtitle Color (Ink Secondary)

`color-ink-secondary` (`#5A4E47`) is defined in Task 04 §2 (Primary Colors table) but is NOT one of the 8 Elementor Global Color tokens confirmed in the Foundation phase. Three options:

1. **Add Ink Secondary as a 9th Global Color token** (recommended) — this is a legitimate token, not a one-off color. Adding it preserves the token-only rule and makes future reuse straightforward.
2. **Use the Ink token** — #231E1A is slightly darker but passes all contrast requirements. Acceptable if adding a token is not desired.
3. **Local color override** — explicitly not permitted by the design system. Do not use.

**Recommended:** Add `color-ink-secondary` (`#5A4E47`) to Elementor Global Colors as part of the header build. Document the addition in the sprint notes.

### 2.9 Active State and Hover Transitions

| State | Treatment |
|-------|-----------|
| Default | `color-ink` text, no underline |
| Hover | `color-accent` text; 150–200ms ease transition |
| Active (current page) | `color-accent` text + 2px solid `color-accent` bottom border |
| Focus (keyboard) | 2px `color-accent` outline, 3px offset — WCAG 2.4.7 |

Active state is applied automatically by WordPress/Elementor's `.current-menu-item` class. Additional CSS is required for the bottom border active indicator (added via Site Settings → Custom CSS):

```
#organism-site-header .current-menu-item > a,
#organism-site-header .current-page-ancestor > a {
  color: var(--color-accent);
  border-bottom: 2px solid var(--color-accent);
  padding-bottom: 2px;
}
```

### 2.10 Scroll Behavior (Desktop)

- **Default:** Header height 72–80px, border-bottom 1px Border, no shadow
- **After 80px scroll:** Header compresses to 56–64px, shadow appears: `0 2px 8px rgba(35,30,26,0.10)`
- **Transition:** 200ms ease-out on height and shadow appearance
- **Exceptions:** /programari and /contact pages maintain a constant header height — no scroll-reduce behavior on transactional pages

Shadow CSS (add to Site Settings → Custom CSS):
```
#organism-site-header.elementor-sticky--active {
  box-shadow: 0 2px 8px rgba(35, 30, 26, 0.10);
}
```

---

## 3. Tablet Behavior (768–1279px)

### 3.1 Breakpoint Behavior

| Viewport range | Behavior |
|----------------|----------|
| 1280px+ | Full desktop layout — 5 text nav items visible |
| 1025–1279px | Desktop layout, compressed spacing; nav font-size may reduce to 14px; must be tested explicitly |
| ≤1024px | Hamburger menu — all text nav items hidden, logo + CTA + hamburger visible |

**The transition zone (1025–1279px) requires explicit testing.** Elementor's default tablet breakpoint is 1024px, which aligns with the hamburger trigger. The 1025–1279px range uses the desktop layout with no structural changes — only spacing may compress. This is the range most likely to produce wrapping and must be checked at 1025px, 1100px, 1200px, and 1279px.

### 3.2 CTA Visibility on Tablet

The CTA button is visible at all viewport widths — including all tablet widths. At 1025–1279px it remains in the header nav zone. At ≤1024px it appears in the sticky mobile header (see Section 4).

**The CTA is never hidden at any viewport width.**

### 3.3 Touch Targets at Tablet

At ≤1024px, the hamburger menu is active. All touch targets apply:
- Hamburger icon tap target: minimum 44×44px
- CTA button height: minimum 44px

At 1025–1279px, the desktop layout is in use. Nav items are text links — hover states apply, not tap target rules. However, if a touchscreen device is used at this viewport width, nav items should be vertically padded enough to tap reliably.

### 3.4 Spacing Adjustments at Tablet (1025–1279px)

If spacing must compress to prevent wrapping:
1. Reduce nav-item gap from `space-6` (24px) to `space-5` (20px)
2. Reduce nav-to-CTA gap from `space-8` (32px) to `space-6` (24px)
3. Reduce inner container padding from `space-8` (32px) to `space-6` (24px)
4. Reduce nav font-size from 15px to 14px

Apply these adjustments in Elementor's tablet responsive settings, not by changing the desktop settings.

---

## 4. Mobile Header (≤767px)

### 4.1 Mobile Breakpoint

Hamburger menu activates at ≤1024px (Elementor's tablet breakpoint). The mobile layout described here applies at all viewports ≤1024px, with the 375–767px range being the primary mobile target.

### 4.2 Sticky Mobile Header Elements

The mobile sticky header contains three elements in this order (left to right):

```
[Logo zone]    [CTA button]    [Hamburger icon]
(flex-start)   (flex-center    (flex-end,
                or flex-end)    far right)
```

**The CTA button is visible in the sticky mobile header.** This is a non-negotiable requirement from Task 03 §2.5 and §5.2. The v2 template hid the CTA on mobile (`hide_mobile: yes`) — this decision is reversed in v3. The CTA must be present and tappable in the mobile header.

**Rationale:** A patient browsing on a mobile device at 11pm after receiving a diagnosis should not need to open the hamburger drawer to find the appointment booking button. The CTA must be visible at all times on all devices. Removing it to save space defeats the purpose of persistent CTA availability.

### 4.3 Mobile Header CTA Button Dimensions

The full CTA label ("Programează o consultație") must be retained — no abbreviation. At 375px, the three-element header (logo + CTA + hamburger) will be tight. Handle through:

- CTA font-size: `type-cta` (Inter 15px mobile per token) or constrained to 14px within the mobile header
- CTA padding: reduce to `space-2` (8px) vertical / `space-4` (16px) horizontal within the header — sufficient for the tap target
- CTA height minimum: 36px within the header (full 44px in the drawer)
- Logo: may compress to single line ("Dr. George Ungureanu") — subtitle ("Neurochirurg") can be hidden at mobile if needed

Verify the three elements fit without overflow at 375px. If the CTA label breaks to two lines within the header, reduce the CTA font-size to 13px for the header variant only.

### 4.4 Hamburger Icon

| Property | Value |
|----------|-------|
| Icon | Three horizontal lines (≡) |
| Icon visible size | 24×24px |
| Tap target | 44×44px minimum (use padding to achieve this) |
| Label | "Meniu" — text label visible beneath or beside the icon (never icon-only) |
| Position | Far right of mobile header |

### 4.5 Mobile Drawer

The hamburger opens a slide-in drawer. All five nav items and the CTA button are immediately visible inside — no scrolling within the drawer, no nested menus.

```
┌─────────────────────────────────┐
│                            [×] │  ← 44×44px tap target
│                                │
│  Acasă                         │  ← 48px min height
│  ─────────────────────────── │
│  Afecțiuni                     │  ← 48px min height
│  ─────────────────────────── │
│  Sfatul Neurochirurgului        │  ← 48px min height
│  ─────────────────────────── │
│  Recomandări                   │  ← 48px min height
│  ─────────────────────────── │
│  Despre                        │  ← 48px min height
│                                │
│  (32px vertical space)         │
│                                │
│  [Programează o consultație]   │  ← Full-width CTA button
└─────────────────────────────────┘
```

**Drawer properties:**

| Property | Value |
|----------|-------|
| Width | Full-width (preferred) or 85% from right side |
| Background | `color-surface` (#FDFBF7) — warm cream, distinct from the overlay |
| Shadow | `-4px 0 24px rgba(35,30,26,0.15)` — warm shadow on left edge |
| Open animation | Slide in from right — 250ms ease-out |
| Close animation | Slide out right — 200ms ease-in |
| Overlay behind drawer | `color-overlay` (~50% opacity) — tapping overlay closes drawer |
| Nav item font | `type-nav` (Inter 15px / 500) — not smaller than desktop |
| Nav item height | 48px minimum tap target (use vertical padding) |
| Nav item separator | 1px `color-border` between items — aids scannability for older users |
| Nav item text color | `color-ink` (default), `color-accent` (active/current page) |
| CTA button | Full-width, `color-accent` background, `color-surface` text |
| CTA vertical separation | `space-8` (32px) above the CTA from the last nav item |
| Body scroll | Locked while drawer is open (CSS `overflow: hidden` on body) |
| Drawer scroll | Independent — drawer content is scrollable if it exceeds viewport height |

**Drawer triggers:**
- Opens: tap hamburger icon
- Closes: tap × close button, tap any nav item, tap the page overlay, press Escape key

### 4.6 Primary Patient Population Note

The mobile design constraint from Task 03 §2.1:

> The mobile navigation must be comprehensible to a 65-year-old patient using a mid-range Android smartphone with slightly enlarged system text, looking for an appointment booking option at 11pm after receiving a concerning diagnosis that day.

Every mobile decision is evaluated through this constraint. Items of note:
- The 48px nav item height (not 44px) provides extra margin for reduced motor precision
- 1px separators between nav items prevent adjacent items from appearing to be a single block
- The CTA in the mobile header (not only in the drawer) reduces the required taps to reach the booking page
- "Meniu" text label on the hamburger removes ambiguity for users who may not recognise the three-line icon

---

## 5. Accessibility Requirements

### 5.1 Skip-to-Content Link

| Property | Value |
|----------|-------|
| Position in DOM | First interactive element — before the logo, before anything |
| Default visibility | Visually off-screen (`position: absolute; left: -9999px`) |
| Visible state | Appears at top-left on keyboard focus (`position: static; clip: auto`) |
| Label text | "Mergi la conținut" |
| Target | `href="#main-content"` — the CSS ID set on the first content section of each page template |
| Styling | Styled by `.skip-to-content` class in `gu-design-system.css` (already loaded) |

The skip link is not a visual design element — it exists for keyboard and screen reader users and must be the first focusable element in the DOM order, regardless of its visual position.

### 5.2 Keyboard Navigation

Every nav element is fully operable by keyboard alone.

| Action | Keyboard input |
|--------|---------------|
| Move between nav items | Tab / Shift+Tab |
| Activate nav item or CTA | Enter |
| Open hamburger drawer (mobile) | Enter or Space on the hamburger button |
| Close hamburger drawer | Escape — focus returns to hamburger button |
| Navigate drawer items | Tab / Shift+Tab |
| Activate drawer item | Enter |
| Trap focus in drawer | Tab cycles within drawer while it is open |

Tab order must follow visual reading order: skip link → logo → nav items (left to right) → CTA button.

### 5.3 Focus States

All focused elements receive a visible focus ring. **Never suppress `outline: none` without a replacement.**

| Property | Value |
|----------|-------|
| Focus ring style | 2px solid `color-accent` (#4D7A70) |
| Focus ring offset | 3px |
| Applied to | All nav items, CTA button, hamburger button, close button, drawer nav items, logo links |
| Implementation | Provided by `gu-design-system.css` global focus rule (`:focus-visible`) |

### 5.4 ARIA Labels and Attributes

| Element | ARIA requirement |
|---------|----------------|
| Primary nav container | `<nav aria-label="Navigare principală">` |
| Hamburger button | `aria-expanded="false"` (updated to `"true"` when drawer opens) |
| Hamburger button | `aria-controls="[drawer-id]"` where `[drawer-id]` is the drawer container's ID |
| Hamburger button | `aria-label="Deschide meniul"` |
| Close button | `aria-label="Închide meniul"` |
| Drawer container | `id="[drawer-id]"` matching hamburger's `aria-controls` |
| Outer header container | HTML tag: `<header>`, custom attribute: `role="banner"` |
| Logo link | No alt text needed (text logo) |
| Active page indicator | Active state is communicated by `.current-menu-item` class + visual color + border (not color alone) |

**Elementor implementation note:** Elementor's Nav Menu Pro widget handles `aria-expanded` and `aria-controls` on the hamburger automatically when the mobile drawer is configured. Verify these attributes are present in browser DevTools after the mobile drawer is built. If they are absent, add them via Elementor's Custom Attributes on the hamburger widget.

### 5.5 Color and Contrast

| Combination | Actual ratio | WCAG AA (4.5:1) | Used in header |
|-------------|-------------|-----------------|---------------|
| `color-ink` on `color-surface` | 14.5:1 | Pass (exceeds AAA) | Nav items, logo name |
| `color-surface` on `color-accent` | 4.6:1 | Pass | CTA button text |
| `color-accent` on `color-surface` | 4.6:1 | Pass | Hover/active nav states |
| `color-ink-secondary` on `color-surface` | 7.2:1 | Pass (exceeds AAA) | Logo subtitle |

Active state uses color + bottom border — not color alone. This satisfies WCAG 1.4.1 (Use of Color).

### 5.6 Reduced Motion

All header animations must be suppressed or simplified under `prefers-reduced-motion: reduce`. The GU Design System CSS already includes the global reduced-motion rule. Verify:

| Animation | Default | Under prefers-reduced-motion |
|-----------|---------|------------------------------|
| Nav hover color transition | 150–200ms ease | Instant color change |
| Scroll-reduce header compression | 200ms ease-out | Instant |
| Sticky shadow appearance | 200ms ease-out | Instant |
| Mobile drawer slide-in | 250ms ease-out | Instant appear (no slide) |
| Mobile drawer slide-out | 200ms ease-in | Instant disappear |

---

## 6. Migration Plan: Header v2 → Header v3

### 6.1 Migration Decision

The Header v2 template was built before the planning suite was frozen. It contains structural work that is partially salvageable, but it has navigation, color, and behavior decisions that conflict with the frozen spec. The migration is a correction pass on the imported v2 template — not a full rebuild from scratch.

```
Header v2 (imported)
      │
      ▼
Open in Elementor Theme Builder → organism-site-header
      │
      ├── Reuse: container hierarchy and flex configuration
      ├── Reuse: skip-to-content HTML widget structure
      ├── Reuse: sticky position and z-index settings
      ├── Reuse: mobile drawer mechanism (Elementor Nav Menu widget)
      │
      ├── Correct: nav menu assignment (assign "Navigare principală")
      ├── Correct: CTA label ("Programări" → "Programează o consultație")
      ├── Correct: CTA mobile visibility (HIDDEN in v2 → VISIBLE in v3)
      ├── Correct: all hardcoded hex values → Global Color tokens
      ├── Correct: ARIA attributes (verify they transferred on import)
      ├── Correct: HTML tag on outer container (must be <header>)
      │
      └── Result: Header v3 — compliant with Task 03 frozen spec
```

### 6.2 What Can Be Reused from v2

| Element | v2 status | v3 action |
|---------|-----------|-----------|
| Outer container (flex row, sticky, z-index 100) | Likely correct | Verify sticky settings; verify CSS ID is `organism-site-header` |
| Inner container (max-width 1200px, centered) | Likely correct | Verify padding values match spec |
| Skip-to-content HTML widget | Present in v2 | Verify it is the FIRST element in the inner container DOM order |
| Logo zone (two-line text mark, links to /) | Present | Verify font, color, link target |
| Nav menu widget (Elementor Nav Menu Pro) | Present | Assign "Navigare principală"; verify mobile drawer settings |
| CTA button widget (rightmost element) | Present | Change label; change mobile visibility; change Global Color tokens |
| Flex alignment (space-between, align-center) | Likely correct | Verify at 1280px |
| Mobile hamburger mechanism | Handled by Nav Menu widget | Verify ARIA attributes after menu assignment |

### 6.3 What Must Be Corrected in v2

| Issue | v2 state | v3 requirement | Priority |
|-------|----------|----------------|----------|
| Navigation menu | Old labels and slugs | "Navigare principală" with Task 03 slugs | Critical |
| CTA label | "Programări" | "Programează o consultație" | Critical |
| CTA mobile visibility | Hidden (`hide_mobile: yes`) | **Visible** — shown in sticky mobile header | Critical |
| All hex color values | Hardcoded (e.g. `#4D7A70`) | Elementor Global Color tokens | High |
| `color-ink-secondary` (#5A4E47) | Hardcoded | Add to Global Colors or substitute Ink token | High |
| Outer container HTML tag | May not have transferred on import | Set to `<header>` in Advanced → HTML Tag | High |
| `role="banner"` attribute | May not have transferred on import | Advanced → Custom Attributes → `role` / `banner` | High |
| Nav ARIA: `aria-label` | May not have transferred | Advanced → Custom Attributes on nav widget | Medium |
| Active nav CSS | May need updating | Verify `.current-menu-item` CSS uses token variable | Medium |
| Sticky shadow CSS | Stored in Site Settings → Custom CSS | Confirm correct shadow value from Task 04 §6.2 | Medium |

### 6.4 What Should Be Deleted

| Item | Action |
|------|--------|
| Header v1 JSON file | Retain for archive — do not re-import |
| Footer v1 JSON file | Retain for archive — do not re-import |
| Any CSS rules that reference old navigation slugs (`/conditii/`, `/resurse/`) | Remove from Site Settings → Custom CSS |
| Any CSS that hides the CTA on mobile in the header | Remove — CTA must be visible on mobile |

---

## 7. Implementation Checklist

Complete these steps in order. Each step depends on the previous.

### Step 1 — Update WordPress Navigation Menu

```
[ ] Go to: WordPress admin → Appearance → Menus
[ ] If "Navigare principală" exists: edit it
    If it does not exist: Create New Menu → name "Navigare principală"
[ ] Delete all existing items
[ ] Add items in this exact order:
      Acasă          → custom URL: /
      Afecțiuni      → custom URL: /afectiuni/
      Sfatul Neurochirurgului → custom URL: /sfatul-neurochirurgului/
      Recomandări    → custom URL: /recomandari/
      Despre → custom URL: /despre/
[ ] Confirm: no sub-items, no hierarchy, flat single-level list
[ ] Assign menu location: Primary Navigation
[ ] Save Menu
[ ] Verify: menu appears in Appearance → Menus with 5 items only
```

### Step 2 — Rebuild Elementor Header Template

```
[ ] Go to: Elementor → Templates → Theme Builder
[ ] Open "organism-site-header" (the imported v2 template) → Edit with Elementor

    Outer container:
    [ ] CSS ID is: organism-site-header
    [ ] Advanced → HTML Tag: header
    [ ] Advanced → Custom Attributes: role / banner
    [ ] Advanced → Motion Effects → Sticky: Top / Offset: 0 / Z-index: 100
    [ ] Style → Background: Global Color → Surface (#FDFBF7)
    [ ] Style → Border → Bottom: 1px solid → Global Color → Border (#D6CFC4)

    Inner container:
    [ ] Max-width: 1200px (custom width or use Elementor width control)
    [ ] Flexbox: row, space-between, align-center
    [ ] Padding top/bottom: 20px / Padding left/right: 32px

    Skip-to-content HTML widget:
    [ ] Present and is the FIRST widget in the inner container (before logo)
    [ ] Contains: <a href="#main-content" class="skip-to-content">Mergi la conținut</a>
    [ ] Verify in browser DevTools: this is the first child of the inner container in DOM

    Logo zone:
    [ ] "Dr. George Ungureanu" widget: Inter 600 18px; Global Color → Ink; links to /
    [ ] "Neurochirurg" widget: Inter 400 14px; Global Color → Ink Secondary (or Ink); links to /
    [ ] No underline on logo links (CSS: #molecule-logo a { text-decoration: none; })

    Nav menu widget:
    [ ] Content → Menu: select "Navigare principală"
    [ ] Verify all 5 items appear in canvas
    [ ] Layout: Horizontal
    [ ] Pointer: None (hover/active states handled by CSS)
    [ ] Typography: Inter 15px / 500 weight / LH 1.0
    [ ] Color → Text: Global Color → Ink
    [ ] Color → Hover: Global Color → Accent
    [ ] Hamburger (mobile): verify icon is three lines (≡)
    [ ] Mobile breakpoint: ≤1024px
    [ ] Drawer background: Global Color → Surface
    [ ] Drawer items font: Inter 15px / 500
    [ ] Drawer items height: 48px minimum
    [ ] Drawer items separator: 1px Border color between items

    CTA button widget:
    [ ] Content → Text: Programează o consultație
    [ ] Content → Link: /programari/
    [ ] Style → Background: Global Color → Accent (default)
    [ ] Style → Background: Global Color → Accent Hover (hover state)
    [ ] Style → Text Color: Global Color → Surface
    [ ] Style → Typography: Inter 600 16px
    [ ] Style → Border Radius: 6px
    [ ] Style → Padding: 12px top/bottom / 24px left/right
    [ ] Advanced → Responsive → Hide on Mobile: NO (remove any hide-on-mobile setting)
    [ ] Verify: button is visible in desktop preview AND mobile preview

    Color sweep (all hardcoded hex values):
    [ ] Open every widget → check every color control
    [ ] Switch from hex entry to Global Color token (click the globe icon)
    [ ] No hex values remain except in Custom CSS fields using var() references
```

### Step 3 — Configure Responsive Behavior

```
    Desktop (1280px+):
    [ ] Full header visible: logo · 5 nav items · CTA button in one row
    [ ] No wrapping
    [ ] Test at exactly 1280px viewport width

    Tablet transition range (1025–1279px):
    [ ] Open Elementor tablet responsive controls
    [ ] If wrapping occurs: reduce nav item gap from 24px to 20px at tablet breakpoint
    [ ] If still wrapping: reduce nav font-size to 14px at tablet breakpoint
    [ ] Test at 1025px, 1100px, 1200px, 1279px

    Mobile (≤1024px):
    [ ] Nav menu widget switches to hamburger at ≤1024px
    [ ] Text nav items are hidden
    [ ] CTA button remains VISIBLE (not hidden) — verify
    [ ] Hamburger is visible at far right
    [ ] Logo visible at far left

    Mobile sticky header (375px):
    [ ] Logo + CTA button + hamburger fit in one row without overflow
    [ ] CTA button is tappable (minimum height 36px within header)
    [ ] Hamburger tap target is 44×44px (verify with browser DevTools)
    [ ] No horizontal scroll at 375px
```

### Step 4 — Accessibility Checks

```
[ ] Browser DevTools: Outer container HTML tag is <header> in DOM
[ ] Browser DevTools: role="banner" is present on the outer container
[ ] Browser DevTools: <nav aria-label="Navigare principală"> wraps the nav menu
[ ] Browser DevTools: hamburger button has aria-expanded and aria-controls
[ ] Keyboard test: Tab once → skip-to-content link appears top-left
[ ] Keyboard test: Enter on skip link → focus jumps to #main-content (set this ID on any test page)
[ ] Keyboard test: Tab through all nav items → each receives visible focus ring
[ ] Keyboard test: Tab to CTA → visible focus ring; Enter → navigates to /programari
[ ] Keyboard test (mobile at 1024px): Tab to hamburger → Enter → drawer opens
[ ] Keyboard test: Escape key → drawer closes, focus returns to hamburger
[ ] Keyboard test: Tab within open drawer → focus cycles through drawer items only
[ ] Visual test: hover each nav item → color transitions smoothly to Accent
[ ] Visual test: visit / → Acasă is active (color-accent text + bottom border)
[ ] Visual test: CTA button hover → background transitions to Accent Hover
[ ] Reduced motion: enable prefers-reduced-motion in OS → verify all animations are instant
```

### Step 5 — Cross-Device Validation

```
    At each viewport, verify: one-row header, correct colors, no wrapping

    Desktop:
    [ ] 1280px — full header, no wrapping (critical test)
    [ ] 1440px — full header
    [ ] 1920px — full header (confirm max-width 1200px centers correctly)
    [ ] 1025px — full header with any compressed settings applied

    Mobile (hamburger active):
    [ ] 1024px — hamburger layout; CTA visible; logo visible
    [ ] 768px  — hamburger layout; CTA visible; logo visible
    [ ] 375px  — minimum mobile viewport; all elements fit; no overflow

    Drawer (all mobile viewports):
    [ ] 5 nav items visible without drawer scroll
    [ ] CTA button visible at drawer bottom
    [ ] Separator lines visible between items
    [ ] × close button at minimum 44×44px
    [ ] Overlay behind drawer is visible and tappable

    Active state:
    [ ] Visit each page in the nav → correct nav item shows active state
    [ ] Visit /sfatul-neurochirurgului/[any-article-slug] → "Sfatul Neurochirurgului" is active
    [ ] Visit /afectiuni/[any-condition-slug] → "Afecțiuni" is active

    Publish:
    [ ] Elementor → Publish → Display Conditions: Include → Entire Site
    [ ] Verify header appears on the WordPress homepage
    [ ] Verify header appears on a test interior page (or stub page)
    [ ] No header-less pages exist
```

---

## 8. Acceptance Criteria

Header v3 is approved only if all of the following pass. Items marked [DR] require Dr. Ungureanu's review.

### Layout
- [ ] No wrapping at 1280px — full header in one row (**blocking**)
- [ ] No horizontal scroll at 375px mobile (**blocking**)
- [ ] Full header visible at 1920px, 1280px, 1440px
- [ ] Hamburger layout correct at 1024px, 768px, 375px
- [ ] [DR] Desktop header approved at 1280px
- [ ] [DR] Mobile header approved at 375px

### Navigation
- [ ] Exactly 5 nav items in the correct order: Acasă / Afecțiuni / Sfatul Neurochirurgului / Recomandări / Despre
- [ ] Nav slugs: / · /afectiuni/ · /sfatul-neurochirurgului/ · /recomandari/ · /despre/
- [ ] No dropdown menus; no sub-menus; no hover-revealed content
- [ ] CTA label is exactly: "Programează o consultație" (no abbreviation, no variation)
- [ ] CTA routes to: /programari/

### CTA Visibility
- [ ] CTA button visible in desktop header (**blocking**)
- [ ] CTA button visible in mobile sticky header — NOT hidden on mobile (**blocking**)
- [ ] CTA button visible in mobile drawer (full-width)
- [ ] CTA button visible at every scroll position on every page

### Colors and Tokens
- [ ] No hardcoded hex values remain in any header widget — all colors are Elementor Global Color tokens (**blocking**)
- [ ] No one-off local color overrides in any widget
- [ ] Header background: Surface token (#FDFBF7)
- [ ] CTA background: Accent token (#4D7A70)
- [ ] CTA hover background: Accent Hover token (#3A5F57)
- [ ] Nav items default: Ink token (#231E1A)
- [ ] Nav items hover/active: Accent token (#4D7A70)

### No Local Styling
- [ ] No local font size overrides — all typography uses Global Typography tokens or documented exceptions
- [ ] No local color overrides — all colors use Global Color tokens
- [ ] No one-off spacing values — all spacing uses multiples of 8px

### Accessibility
- [ ] Skip-to-content link is the first DOM element; appears on Tab; routes to #main-content (**blocking**)
- [ ] All nav items and CTA reachable and activatable by keyboard alone
- [ ] Hamburger has `aria-expanded` and `aria-controls` attributes
- [ ] Primary nav has `aria-label="Navigare principală"`
- [ ] Outer container: `<header>` HTML tag, `role="banner"`
- [ ] All focus rings visible (2px color-accent outline)
- [ ] Escape key closes mobile drawer; focus returns to hamburger button
- [ ] All animations suppressed under `prefers-reduced-motion`
- [ ] No information communicated by color alone (active state uses color + border)

### No Hidden Interactions
- [ ] Every interactive state (hover, active, focus, open, closed) is visible and/or programmatic
- [ ] No interaction discovered only by accident or by knowing to hover
- [ ] Active page state is communicated visually and via `.current-menu-item` class

### Display Condition
- [ ] Display condition: Include → Entire Site
- [ ] Header appears on homepage, on any test interior page, and on the 404 page
- [ ] No page renders without the header

---

*Sprint 1 Header v3 Plan — version 1.0 — 2026-06-28*
*Next step after approval: implement in Elementor following Section 7 checklist*
*After header v3 is complete: proceed to Footer v3 (Phase D of Sprint 1 Foundation Checklist)*
