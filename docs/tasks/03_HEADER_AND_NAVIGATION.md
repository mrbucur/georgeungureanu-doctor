# Header and Navigation

## georgeungureanu.doctor

**Purpose of this document:** Freeze the final navigation system before implementation. Every decision recorded here is locked. Changes after implementation begins require a documented revision with a stated rationale.

**Source of truth:**
- `docs/tasks/00_PROJECT_ROADMAP.md` v1.1
- `docs/tasks/01_INFORMATION_ARCHITECTURE.md` v1.0
- `docs/tasks/02_CONTENT_MODELS.md` v1.0
- `docs/design-system/COLOR_SYSTEM.md`
- `docs/design-system/TYPOGRAPHY_SYSTEM.md`
- `docs/design-system/SPACING_SYSTEM.md`
- `docs/project/PATIENT_CENTERED_MANIFESTO.md`
- `docs/project/TARGET_AUDIENCE.md`

**Governing philosophy:** Every navigation decision is evaluated through one question: *Does this help an anxious patient find what they need without hesitation?* Navigation that is clever, compact, or efficient at the expense of patient clarity is wrong navigation.

---

# 1. Final Primary Navigation

## 1.1 The Approved Navigation Structure

This is the final, approved navigation for the entire project. It does not change. It is not revised for Phase 2 additions. Future content lives within this structure.

### Desktop Navigation (single row)

```
[Logo / Dr. George Ungureanu]    Acasă    Afecțiuni    Sfatul Neurochirurgului    Recomandări    Despre    [Programează o consultație →]
```

| Position | Item | Type | Destination | Notes |
|----------|------|------|------------|-------|
| Left | Logo / practice name | Identity element | / (homepage) | Text-only in Phase 1; image logo conditional on Q19 |
| 1 | Acasă | Text nav item | / | |
| 2 | Afecțiuni | Text nav item | /afectiuni | |
| 3 | Sfatul Neurochirurgului | Text nav item | /sfatul-neurochirurgului | |
| 4 | Recomandări | Text nav item | /recomandari | |
| 5 | Despre | Text nav item | /despre | Approved short label — confirmed 2026-06-28 |
| Right | Programează o consultație | CTA button | /programari | Not a nav item — visually distinct button |

**Total text nav items: 5.** The CTA is the 6th element visually, but it is not a menu item — it is a persistent action button.

## 1.2 What Is Not in the Navigation

| Item | Where it lives | Why it is absent from nav |
|------|---------------|--------------------------|
| Programări | CTA button (right side of header) | It is an action, not a destination patients browse to. It is always visible without occupying a nav slot. |
| Contact | Reached via /programari → /contact only | Contact belongs to the appointment journey, not to the discovery journey. Placing it in the nav implies it is a starting point; it is not. |
| Informații pentru pacienți | Part of Sfatul Neurochirurgului | Patient guidance content (prima-consultatie, pentru-apartinatori, etc.) lives as SN Articles — the hub nav item surfaces them. |
| Politică de Confidențialitate | Footer legal strip only | Legal/compliance page; not a destination patients navigate to during their journey. |
| Cookies | Footer legal strip only | Conditional on analytics implementation. |

## 1.3 Programează o consultație — CTA Button Rules

This button is the most important interactive element on every page. Its behavior is non-negotiable.

**Destination:** Always `/programari`. Never `/contact` directly. Never a phone number tel: link. Never a modal.

**Visibility:** Present in the header on every page of the site, at every scroll position. It does not disappear when the header is in scroll-reduced mode.

**Label:** "Programează o consultație" — exact text, always. No abbreviation, no variation, no translation. This label is repeated on every primary CTA across the entire site. Consistency is the mechanism by which the patient learns that this button always answers the question "how do I book an appointment?"

**Visual treatment:** `color-accent` (`#4D7A70`) background, `color-surface` (`#FDFBF7`) text, `type-cta` typography (Inter 16px / 600 weight), standard button padding (`space-4` vertical × `space-6` horizontal). It is distinct from the nav items by background color, padding, and border-radius. It should never visually merge with the text nav items.

**Active state:** The CTA button does not receive an "active" nav state when the user is on /programari. The active-page indicator system applies only to text nav items.

## 1.4 Active Page Indicator

The current-page nav item is visually distinguished from inactive items. The indicator uses `color-accent` (`#4D7A70`) — same token as the CTA, which reinforces the system logic (accent = action/current position).

| State | Treatment |
|-------|----------|
| Default | `color-ink` (`#231E1A`) text, no underline |
| Hover | `color-accent` text; transitions smoothly (150–200ms) |
| Active (current page) | `color-accent` text + bottom border in `color-accent`, 2px — or `color-accent` text at slightly heavier weight |
| Focus (keyboard) | Visible focus ring using `color-accent`, 2px offset — WCAG 2.4.7 compliant |

Implementation note: The active state is applied by WordPress/Elementor's menu system using the `.current-menu-item` class. This is automatic — no manual handling required.

**Sfatul Neurochirurgului active state:** When the patient is on any `/sfatul-neurochirurgului/[slug]` article page, the "Sfatul Neurochirurgului" nav item should receive the active state. This requires WordPress menu item to be configured as a parent of the post type archive. Verify during implementation.

**Afecțiuni active state:** When the patient is on any `/afectiuni/[slug]` condition page, the "Afecțiuni" nav item should receive the active state. Same parent-child configuration required.

## 1.5 The Logo

**Phase 1 (blocking on Q19):** Text-only mark. "Dr. George Ungureanu" in `type-h5` or equivalent. Warm, readable, professional. Clicking the logo routes to `/` (homepage).

**Phase 2 / conditional:** If a logomark is provided (Q19), replace text-only logo with image mark. The image logo must not exceed 40px height in the header. The logo must remain legible at the reduced header height on scroll.

**The logo is never displayed as plain body text.** It has a dedicated treatment in the nav component that clearly distinguishes it from the nav items to its right.

---

# 2. Mobile Navigation

## 2.1 Core Principle

The mobile navigation must be comprehensible to a 65-year-old patient using a mid-range Android smartphone with slightly enlarged system text, looking for an appointment booking option at 11pm after receiving a concerning diagnosis that day.

This is the correct design constraint. It is not a hypothetical — it describes a large fraction of the actual user population.

## 2.2 Hamburger Menu

**Trigger:** Standard three-line (≡) hamburger icon, top-right of header. Icon size minimum 44×44px tap target (WCAG 2.5.5). The icon has a visible label "Meniu" beneath or beside it — never icon-only.

**Opening behavior:** Tapping the hamburger opens a slide-in drawer from the right, or a full-width overlay from the top. No animated logo rearrangement. No complex transition sequences. The drawer is visible immediately on tap — animation duration maximum 200ms. Easing: ease-out.

**Closing behavior:** The drawer closes when: (a) the user taps the × close button, (b) the user taps outside the drawer on the page content, or (c) the user taps a menu link. Close button minimum 44×44px tap target, positioned at top-right of the drawer.

**Overlay:** The page behind the drawer receives a dark overlay (`color-overlay` at reduced opacity, ~50%) to signal that the drawer is modal-like. Tapping the overlay closes the drawer.

**No complex animations.** No flip-out transitions, no stagger-in effects, no parallax interactions. Open/close is the only state change.

## 2.3 Mobile Drawer Contents

The mobile drawer contains all five navigation items and the CTA button. Everything in the drawer is immediately visible — no nested menus, no expandable sub-sections.

```
[× Close]

Acasă
Afecțiuni
Sfatul Neurochirurgului
Recomandări
Despre

[Programează o consultație]     ← Full-width CTA button at drawer bottom
```

**Item order:** Identical to desktop nav order. The CTA appears last, visually separated from the text nav items by extra vertical space (`space-8`, 32px).

**Item size:** Each nav item tap target minimum 48px height. `type-nav` typography (Inter 15px / 500). `color-ink` text. Generous `space-6` (24px) top and bottom padding per item. A 1px `color-border` separator between items improves scannability for older patients.

**CTA button:** Full width of the drawer. `color-accent` background. "Programează o consultație" label. Same styling as desktop CTA but full width.

## 2.4 Maximum Menu Depth

**Phase 1: one level. No exceptions.**

Every destination in the primary navigation is reached in two taps maximum:
- Tap 1: Open the hamburger drawer
- Tap 2: Tap the destination

There are no sub-menus. There are no expandable accordion items within the drawer. "Sfatul Neurochirurgului" taps directly to `/sfatul-neurochirurgului`. "Afecțiuni" taps directly to `/afectiuni`. Patients navigate within those sections using the hub pages, not sub-menus in the global nav.

**Why this matters for anxious patients:** Sub-menus require the patient to understand a nested information structure while already cognitively loaded. A two-tap maximum is a strict constraint that protects the primary audience. Phase 2 additions (see Section 6) do not break this rule.

## 2.5 Sticky Header Rules

**Desktop:** The header is sticky — it remains fixed at the top of the viewport on scroll. On scroll down (past 80px), the header reduces height slightly and gains a subtle bottom shadow (`0 2px 8px rgba(35,30,26,0.12)` or equivalent using warm near-black). This scroll-shadow signals that the header is elevated above the page content.

**Mobile:** The header is sticky. The sticky header on mobile shows: logo + hamburger icon + CTA button. The CTA button is visible in the sticky mobile header — it is not hidden to save space. Removing the CTA from mobile sticky navigation defeats the purpose of persistent CTA availability.

**Reduced height on scroll (desktop):**
- Default header height: ~72–80px
- Scroll-reduced header height: ~56–64px
- Transition: smooth, ~200ms ease-out
- The CTA button remains fully visible at reduced height
- The logo remains legible at reduced height
- The nav items do not truncate or wrap

**Scroll-reduced behavior does not apply to:** /programari, /contact (transactional pages where the header stays consistent to reduce cognitive load during the appointment flow).

## 2.6 Accessibility Requirements

The following are non-negotiable accessibility rules for the navigation. They are required for WCAG 2.1 AA compliance and for the patient population this site serves.

| Requirement | Standard | Implementation note |
|------------|---------|-------------------|
| Skip to content link | WCAG 2.4.1 | Visually hidden by default; visible on keyboard focus; first interactive element on every page; routes to `#main-content` |
| Keyboard navigation | WCAG 2.1.1 | Full keyboard nav: Tab through items, Enter to activate, Escape to close hamburger drawer |
| Focus visibility | WCAG 2.4.7 | All focused elements have visible 2px `color-accent` outline; never suppress outline with `outline: none` without replacement |
| Touch target size | WCAG 2.5.5 | All interactive nav elements minimum 44×44px tap area |
| Nav landmark | WCAG 1.3.1 | Primary nav wrapped in `<nav aria-label="Navigare principală">` |
| Hamburger ARIA | WCAG 4.1.2 | Button element with `aria-expanded="false/true"` and `aria-controls="[drawer-id]"` |
| Logo alt text | WCAG 1.1.1 | If logo is an image: `alt="Dr. George Ungureanu — Neurochirurg"`. Text logo: no alt attribute needed. |
| Color alone never conveys state | WCAG 1.4.1 | Active nav state uses color + typographic indicator (border or weight) — not color alone |
| Contrast — nav text | WCAG 1.4.3 | `color-ink` (#231E1A) on `color-surface` (#FDFBF7) = 14.5:1 — passes AA |
| Contrast — CTA button | WCAG 1.4.3 | `color-surface` (#FDFBF7) on `color-accent` (#4D7A70) = 4.6:1 — passes AA |

**No hidden interactions.** Every nav element that has a state (hover, focus, active, open/closed) communicates that state visually and programmatically (ARIA attributes). No interaction is discoverable only by accident.

---

# 3. Footer Architecture

## 3.1 Footer Structure

The footer is a dark-background section (`color-ink`, `#231E1A`) with warm cream text (`color-surface`, `#FDFBF7`). It renders at the bottom of every page, after all page content and before the legal strip.

```
[Column 1 — Doctor Identity]  [Column 2 — Afecțiuni]  [Column 3 — Sfatul Neurochirurgului]  [Column 4 — Programări]

─────────────────────────────────────────────────────────────────────
[Legal strip — © Copyright • Politică de Confidențialitate • Cookies • Medical disclaimer]
```

Desktop layout: 4 equal columns. Tablet: 2×2. Mobile: 4 stacked full-width columns, Column 4 first (most actionable) then Column 1, then 2 and 3.

## 3.2 Column 1 — Doctor Identity

**Purpose:** Remind the patient who this practice belongs to. Provide a grounding statement that reinforces trust before the patient leaves the page.

**Contents:**

- **Name:** Dr. George Ungureanu (rendered as the site logo/text mark — same treatment as header logo)
- **Title:** Medic Primar Neurochirurgie (or approved equivalent — confirm exact credential title)
- **Short philosophy statement:** 1–2 sentences maximum. In Dr. Ungureanu's voice. States the core patient commitment. This is not a tagline — it is a brief, sincere statement of approach. Example register: "Fiecare pacient merită să înțeleagă pe deplin starea sa de sănătate și opțiunile disponibile." Exact text from Dr. Ungureanu.
- **Professional credibility indicators:** One line only. Example: "Membru al Societății Române de Neurochirurgie." Exact text from Dr. Ungureanu.
- **Social media icons** (conditional on Q18 — social accounts confirmed): Small icon links to confirmed profiles (Instagram, Facebook, YouTube). If accounts are not confirmed, this row is omitted. No placeholder icons. No broken links.

**What Column 1 does NOT contain:**
- Full biography excerpt (that belongs on /despre)
- Photography (dark footer background makes photography impractical)
- Trust indicator numbers (that belongs on the homepage)
- Awards, accolades, or certifications (not in scope for this iteration)

## 3.3 Column 2 — Afecțiuni

**Purpose:** Give patients who are browsing the footer a second entry point into condition content. The footer is often where patients land after reading one condition page and wondering "what else?"

**Contents:**

- **Section label:** "Afecțiuni" (`type-overline` — uppercase label)
- **Link to archive:** "Toate afecțiunile" → /afectiuni (styled as a text link with `color-accent` treatment)
- **6–8 individual condition links:** The most frequently sought conditions. Selected by Dr. Ungureanu from the active Condition CPT entries. Rendered as simple text links. Each links to `/afectiuni/[slug]`. Use `patient_title` values.
- **No descriptions.** Names and links only. The footer is not a content surface.

**What Column 2 does NOT contain:**
- Condition card descriptions or summaries
- Images or icons per condition
- Conditions that are inactive (is_active = false)
- More than 8 conditions (footer link lists at this length create cognitive overload)

## 3.4 Column 3 — Sfatul Neurochirurgului

**Purpose:** Surface the educational brand and give patients a direct path to content without navigating through the hub first.

**Contents:**

- **Section label:** "Sfatul Neurochirurgului" (`type-overline`)
- **Brand descriptor:** One short line naming what this is — not a blog description, but a brand positioning line. Example register: "Resurse educaționale pentru pacienți și aparținători." Exact text from Dr. Ungureanu.
- **Link to hub:** "Toate articolele" → /sfatul-neurochirurgului (styled as text link)
- **4–6 featured article links:** The most relevant or recently published SN Articles. Selected by Dr. Ungureanu or the administrator. Use `title` values from the SN Article CPT. Each links to `/sfatul-neurochirurgului/[slug]`.
- **YouTube channel link** (conditional on Q18 — YouTube confirmed): One text link "Urmăriți pe YouTube" → YouTube channel URL. Only if channel is confirmed and active. Not an embedded player. Not a video preview thumbnail. A simple text link.

**What Column 3 does NOT contain:**
- Embedded video players
- Social media feed widgets
- Article preview images
- Category filter links (footer is not a filtering interface)
- More than 6 article links

## 3.5 Column 4 — Programări

**Purpose:** The most actionable column. A patient who has been reading and is ready to take action scans the footer and finds everything they need to initiate contact.

**Contents:**

- **Section label:** "Programări" (`type-overline`)
- **Primary CTA button:** "Programează o consultație" → /programari. Full width of the column. This is the only button in the footer. `color-accent` background, `color-surface` text — same token treatment as header CTA.
- **Location summary** (conditional on Q13): List of cities where Dr. Ungureanu consults. City names only — not full addresses. Each city name links to /programari (the location directory resolves the detail). If location data is unavailable, this row is omitted entirely — no placeholder text.
- **Contact reference:** After the CTA button, one or two lines of contact information for patients who prefer direct reference:
  - Phone: [Q15] → displayed as a tel: link
  - Email: [Q16] → displayed as a mailto: link
- **/programari link:** "Detalii și program" → /programari (text link, secondary to the CTA button above)

**What Column 4 does NOT contain:**
- A contact form (that belongs on /contact, reached through /programari)
- A map embed
- Full clinic addresses (that belongs on /programari)
- Operating hours in the footer (that belongs on /programari per-location cards)
- A second CTA destination (one destination: /programari)

## 3.6 Legal Strip

The legal strip is a full-width bar below the four-column footer. Thinner than the footer proper, separated by a 1px `color-border-strong` horizontal rule. Text in `type-caption` (Inter 13px / 400).

**Left side:**
- © [year] Dr. George Ungureanu. Toate drepturile rezervate.

**Right side (links, separated by · ):**
- Politică de Confidențialitate → /politica-de-confidentialitate
- Cookies → /cookies (conditional on Q21 — analytics/cookie implementation confirmed; omit if not)

**Center or below (if space requires):**
- Medical disclaimer: One sentence. Exact wording from Dr. Ungureanu (required — Q20 equivalent for disclaimer). Example register: "Conținutul acestui site are scop informativ și nu înlocuiește consultul medical de specialitate." Exact wording must be reviewed by Dr. Ungureanu or a legal advisor before launch.

## 3.7 What Does Not Belong in the Footer

| Element | Reason for exclusion |
|---------|---------------------|
| Newsletter subscription form | Out of scope (PROJECT_BRIEF.md); creates data handling obligations beyond current GDPR setup |
| Social media feed embeds | Anti-pattern (COMPONENT_INVENTORY.md); live third-party content; privacy risk; unpredictable display |
| Live chat widget | Out of scope; creates patient expectation of real-time medical response the practice cannot fulfil |
| Back-to-top button | UI affordance handled at page level, not a footer content element |
| Award badges or accreditation seals | Not in scope for this iteration; visual clutter without verified context |
| Photography | Dark footer background makes photography impractical without full art direction |
| Testimonial preview | Content of this nature belongs on /recomandari and homepage sections, not the footer |
| Analytics scripts or tracking pixels | Implementation concern, not a content element |

---

# 4. Navigation Philosophy

These are the reasoning records for every significant navigation decision. They exist so that future reviewers — including Dr. Ungureanu, future developers, or agency partners — understand why the navigation is structured as it is and do not reverse decisions without understanding what they are reversing.

## 4.1 Why Contact Is Not in the Primary Navigation

Contact is not a destination a patient navigates to unprompted. It is the endpoint of a defined journey:

```
Any page → [Programează o consultație] → /programari → [Contactați-ne] → /contact
```

A patient who sees "Contact" in the main navigation may click it first, before understanding where Dr. Ungureanu practices. They would then face a contact form without knowing which location to reference or whether the doctor consults in their city. This is a worse outcome than routing them through /programari first.

Removing Contact from the nav does not hide it — it places it after /programari in a sequenced flow that answers the patient's critical question (geographic accessibility) before asking them to commit to initiating contact.

**The test:** A patient in Baia Mare should not find themselves on /contact without first having seen that Dr. Ungureanu also consults in Baia Mare. The /programari → /contact sequence guarantees this. A direct nav link to /contact bypasses this guarantee.

## 4.2 Why Programări Is a CTA Button, Not a Nav Item

Programări is not a content destination — it is an action. A patient does not browse Programări the way they browse Afecțiuni or Sfatul Neurochirurgului. They are sent there by a CTA when they are ready to act.

Displaying it as a text nav item would:
- Suggest it has informational content comparable to other nav items
- Compete with the CTA button's visual distinctiveness
- Dilute the CTA's effectiveness (the button's contrast draws the eye precisely because it is alone)

The CTA button serves as a persistent action affordance visible on every page at every scroll position. Its visual distinctiveness — the only colored, padded element in the header — is the mechanism by which the patient knows "this is where I act."

**The five text nav items serve the patient who is exploring.** The CTA button serves the patient who is ready to commit. These are different emotional states, and they deserve different visual language.

## 4.3 Why Sfatul Neurochirurgului Is a Brand Pillar, Not a Blog

A "Blog" or "Resurse" label implies personal, occasionally-updated commentary. It suggests content that might or might not be relevant, might or might not be recent, and does not carry particular editorial authority.

"Sfatul Neurochirurgului" (The Neurosurgeon's Counsel) is a named brand that carries specific implications:
- This content is curated by a named specialist
- Every piece published here has been reviewed by Dr. Ungureanu
- This is not incidental writing — it is a sustained commitment to patient education

Naming this pillar in the navigation establishes it as an equal first-class destination alongside clinical content (Afecțiuni) and the doctor himself (Despre). The name signals that Dr. Ungureanu considers patient education a primary professional responsibility, not a secondary marketing activity.

A blog would be demoted to a sub-section. A brand appears in the primary navigation.

## 4.4 Why Recomandări Appears Before Despre

The navigation order reflects the patient's trust-building journey, not an organizational hierarchy:

1. **Acasă** — arrival and orientation
2. **Afecțiuni** — the patient's clinical question (what is my condition?)
3. **Sfatul Neurochirurgului** — the patient's educational question (what should I know?)
4. **Recomandări** — the patient's social proof question (do others trust this doctor?)
5. **Despre** — the patient's final trust question (who is this person?)

A patient who has already read about their condition and found educational content that answered their questions arrives at Recomandări in a warmer state than a patient who went straight to Despre. They are more likely to read testimonials and colleague endorsements as confirmation rather than discovery.

Placing Recomandări before Despre also serves the patient who does not need the biographical context — they may feel satisfied with social proof alone and proceed directly to the CTA.

The order is not alphabetical, not hierarchical by importance, and not conventional. It is a sequence designed to move a patient progressively closer to a booking decision.

## 4.5 Why Simplicity Is Non-Negotiable

The target audience (Section 1.3 of `docs/project/TARGET_AUDIENCE.md`) includes:
- Patients reading under emotional distress
- Patients on mobile devices at night
- Patients who are not digital-native users
- Older patients with reduced fine motor precision and potentially reduced vision
- Family members managing high cognitive load

For this audience, every additional nav item is friction. Every sub-menu is a barrier. Every unexpected interaction is a failure.

Five text items and one CTA button is not a compromise — it is the correct answer for this user population. The navigation does not need to surface all content. It surfaces the five conceptual destinations the patient might want to explore. Within those destinations, the page architecture handles discovery.

**The manifesto test applied to navigation:** Does this navigation system help a patient in distress find what they need without hesitation? If adding an item creates any hesitation, remove it.

---

# 5. Header Behavior Rules

## 5.1 Desktop Rules

| Rule | Specification |
|------|--------------|
| Minimum breakpoint for single-row layout | 1280px — all five nav items + CTA button in one row, no wrapping |
| Maximum breakpoint for mobile nav | 1024px — hamburger menu, no visible text nav items |
| Transition breakpoint (1024–1280px) | Uses desktop layout with compressed spacing; this range must be tested explicitly |
| Header height (default) | 72–80px — sufficient to contain logo, nav, and CTA button without crowding |
| Header height (scroll-reduced) | 56–64px — triggered after 80px of scroll; nav items and CTA remain fully visible |
| Header background | `color-surface` (`#FDFBF7`) — warm cream, not white |
| Header bottom shadow (on scroll) | Subtle box-shadow using warm near-black overlay; signals elevation above page content |
| Mega menus | Not permitted in Phase 1 or Phase 2. The flat structure of this site does not justify mega menus. |
| Dropdown menus | Not permitted in Phase 1. Phase 2 consideration for Sfatul Neurochirurgului only — see Section 6. |
| Logo position | Left-aligned |
| Nav position | Center or right of logo — implemented as a flex container with auto margins |
| CTA position | Right-aligned, separated from last nav item by `space-8` (32px) |
| Font | `type-nav`: Inter 15px / 500 weight — from Global Typography |
| Nav item gap | `space-6` (24px) between text nav items |

**Width note — "Sfatul Neurochirurgului" is now the sole long item.**

With the approved nav label "Despre" (~55px) replacing the previous "Despre Dr. George Ungureanu" (~245px), the header fits comfortably at 1280px. Total nav text is approximately 475px against a 1200px inner container. "Sfatul Neurochirurgului" at ~195px is the longest single item and remains the primary watch point.

- "Sfatul Neurochirurgului": approximately 195px at `type-nav`
- "Despre": approximately 55px at `type-nav`
- "Programează o consultație" button: approximately 230px + 48px padding = ~278px

**Implementation must verify at exactly 1280px.** Wrapping is not expected. If it occurs, reduce `type-nav` to 14px at the 1025–1279px range only. Do not abbreviate any label.

**No wrapping rule is absolute:** If the header wraps to two rows at any supported viewport width, the implementation is incorrect. Resolve by adjusting logo width, spacing, or nav font-size — not by shortening navigation labels.

## 5.2 Mobile Rules

| Rule | Specification |
|------|--------------|
| Breakpoint trigger | ≤1024px — hamburger replaces text nav |
| Sticky mobile header height | 56px minimum |
| Elements in sticky mobile header | Logo (left) + CTA button (center or right) + hamburger icon (far right) |
| CTA in sticky mobile header | Required — never hidden on mobile to save space |
| Hamburger icon size | 24×24px icon, 44×44px minimum tap target |
| Close button size | 44×44px tap target in drawer |
| Drawer nav item height | Minimum 48px tap target height |
| Drawer width | Full-width (preferred on mobile portrait) or 85% from right side |
| Drawer background | `color-surface` (`#FDFBF7`) — distinct from the dark page overlay |
| Overlay behind drawer | `color-overlay` at ~50% opacity, tappable to close |
| Maximum menu depth | One level — all items are direct links, no sub-menus |
| Font size in drawer | `type-nav` (Inter 15px) — not smaller |
| CTA in drawer | Full-width button, `color-accent`, at drawer bottom |
| Two-tap maximum | Every page destination reachable in: tap 1 (open drawer) + tap 2 (tap item) |
| Animation | Slide-in from right or fade-in overlay; maximum 200ms; ease-out; no complex sequences |
| Scroll lock | Body scroll is locked while drawer is open; drawer content is independently scrollable if content exceeds viewport height |

---

# 6. Future Phase 2 Possibilities

The following are documented for awareness only. **None of these are implemented in Phase 1.** They are not placeholders, they are not in the code, and they are not referenced in Phase 1 templates. They are recorded here so that when Phase 2 planning begins, the navigation architecture is not re-invented without awareness of prior thinking.

## 6.1 Sfatul Neurochirurgului Secondary Navigation

When the volume of published SN Articles grows sufficiently, a secondary navigation within the `/sfatul-neurochirurgului` hub may help patients filter by content type (Article / Video / Repurposed social).

**Phase 2 form:** Text-based navigation links immediately below the hub page hero — not a dropdown, not a sidebar, not a tab system. Five or fewer links maximum. The primary navigation does not change.

**Condition for implementation:** More than 12 published SN Article entries AND at least two distinct content types present with three or more entries each.

## 6.2 Timeline Quick Links

The professional timeline on `/despre` may benefit from a within-page navigation when the number of Timeline Event entries exceeds a threshold where the timeline becomes difficult to scan.

**Phase 2 form:** Anchor links to timeline category groupings, rendered as text links above the timeline. Not a sticky sub-nav. Not a sidebar index. Not a filter that hides content.

**Condition for implementation:** More than 12 active Timeline Event entries across at least 4 categories.

## 6.3 Media Hub Shortcuts

If the Make automation pipeline (Phase 8) generates a high volume of video content, a dedicated path to video content within Sfatul Neurochirurgului may improve discovery.

**Phase 2 form:** A text link in the footer Column 3 ("Vizionați pe YouTube" or equivalent) pointing to a filtered view of SN Articles where `content_type = Video`, OR directly to the YouTube channel. This is already conditionally defined in the footer (Section 3.4) — it becomes unconditional when Phase 2 video volume justifies it.

**Condition for implementation:** More than 8 published SN Article entries with `content_type = Video`.

## 6.4 Language Selector

If a significant proportion of Dr. Ungureanu's patient population includes non-Romanian speakers (international patients, Hungarian-speaking patients from Transylvania), a language selector may become relevant.

**Phase 2 form:** A small language toggle (e.g., "RO / HU") at the far right of the desktop nav or in the hamburger drawer footer. The implementation is deferred to a full multilingual content and URL strategy review — this is not a navigation toggle added to the existing site.

**Condition for implementation:** Dr. Ungureanu confirms a material portion of his patient base communicates primarily in a language other than Romanian, AND translated content for all pages is prepared and reviewed.

**This decision cannot be made by adding a toggle.** It requires a complete multilingual architecture, URL structure (hreflang), and translation workflow. It is recorded here to prevent the toggle from being added informally in Phase 2 without that architecture in place.

---

# 7. Validation Checklist

Before the navigation system goes live, every item in this checklist must pass. This checklist is used at the end of Phase 2 (Foundation build — header and footer implementation) and again at Phase 9 (SEO, Accessibility & Launch).

## 7.1 Patient Usability

- [ ] A person unfamiliar with the site can identify within 5 seconds where to go to book an appointment
- [ ] A patient who has arrived on any page can locate the CTA button without scrolling
- [ ] A patient who wants to find information about a specific condition can reach Afecțiuni in one action from any page
- [ ] A patient who wants to read educational content can reach Sfatul Neurochirurgului in one action from any page
- [ ] A patient who wants to know who the doctor is can reach Despre in one action from any page
- [ ] A patient who follows the CTA from /programari is routed to /contact — not to a third destination
- [ ] No nav item leads to a page that requires another nav action to reach actionable content (no dead-end pages)
- [ ] The navigation communicates the site's purpose without requiring the patient to read content first

## 7.2 Accessibility

- [ ] Skip to content link is present as the first keyboard-focusable element on every page
- [ ] All nav items and the CTA button are reachable and activatable by keyboard alone (Tab + Enter)
- [ ] Hamburger button has correct ARIA attributes (`aria-expanded`, `aria-controls`, `aria-label`)
- [ ] Primary nav is wrapped in `<nav aria-label="Navigare principală">`
- [ ] Active page state is communicated both visually and programmatically (not color alone)
- [ ] All interactive elements have visible focus rings (minimum 2px `color-accent` outline)
- [ ] All tap targets are minimum 44×44px (WCAG 2.5.5)
- [ ] Logo image (if used) has descriptive alt text; text logo requires none
- [ ] `color-ink` on `color-surface` contrast verified: ≥ 4.5:1 (actual: 14.5:1 — pass)
- [ ] `color-surface` on `color-accent` (CTA) contrast verified: ≥ 4.5:1 (actual: 4.6:1 — pass)
- [ ] Body scroll locks while mobile drawer is open; drawer is independently scrollable

## 7.3 Mobile Experience

- [ ] Single-tap on hamburger opens the drawer (no double-tap required)
- [ ] All five nav items and CTA button are visible in the drawer without scrolling (verify on 375px viewport)
- [ ] CTA button is visible in the sticky mobile header without opening the drawer
- [ ] Every destination reachable in maximum two taps from any page
- [ ] Drawer closes on: × button tap, overlay tap, and nav item tap
- [ ] Scroll-lock engages correctly when drawer is open (page behind does not scroll)
- [ ] Tested on: iOS Safari (iPhone SE, iPhone 14), Android Chrome (mid-range device, 360px viewport)
- [ ] Header height does not obscure page content on any mobile viewport (verify 667px height viewport)
- [ ] Text remains legible without zoom on the minimum supported viewport (375px width)

## 7.4 Information Architecture Consistency

- [ ] Navigation labels exactly match approved labels: Acasă / Afecțiuni / Sfatul Neurochirurgului / Recomandări / Despre
- [ ] CTA button label is exactly: "Programează o consultație"
- [ ] All nav item destinations match approved URL scheme from `docs/tasks/01_INFORMATION_ARCHITECTURE.md`
- [ ] No nav item routes to /contact directly
- [ ] /programari CTA always routes to /programari (not /contact, not a modal, not a tel: link)
- [ ] Active page state is set correctly on nested URLs (/afectiuni/[slug] activates Afecțiuni; /sfatul-neurochirurgului/[slug] activates Sfatul Neurochirurgului)
- [ ] Footer column 4 CTA routes to /programari (not /contact)
- [ ] Footer social links (if present) are conditional on Q18 resolution — not placeholder links

## 7.5 Emotional Clarity

- [ ] A person in emotional distress (anxious, stressed) can use the navigation without instruction
- [ ] The navigation does not feel overwhelming — five items is the correct maximum
- [ ] The CTA button communicates "this is where I act" visually distinct from informational nav items
- [ ] The footer does not create additional decisions or distractions for a patient ready to leave the page
- [ ] No animation in the navigation creates discomfort or motion sensitivity concerns (test with prefers-reduced-motion CSS media query respected)
- [ ] The navigation does not demand interaction before surfacing information (no required hover states, no required scroll to see all items)

---

# 8. Blocking Dependencies

| Dependency | Source | Blocks |
|-----------|--------|--------|
| Patient-facing phone number | Q15 | Footer Column 4 (tel: link) |
| Admin / public email address | Q16 | Footer Column 4 (mailto: link) |
| Location city names | Q13 | Footer Column 4 location summary |
| Social media accounts confirmed | Q18 | Footer Column 1 social icons; Footer Column 3 YouTube link |
| Doctor logo or wordmark | Q19 | Header logo (text-only fallback available — not a hard block) |
| Privacy policy page live | Q20 | Footer legal strip link; /politica-de-confidentialitate must exist before legal strip can render |
| Cookie/analytics implementation decision | Q21 | Cookies link in footer legal strip (conditional — omit if not confirmed) |
| Medical disclaimer wording approved | Dr. Ungureanu | Footer legal strip disclaimer line |
| Short philosophy statement for footer | Dr. Ungureanu | Footer Column 1 |
| Footer brand descriptor for SN column | Dr. Ungureanu | Footer Column 3 |
| Featured condition links (6–8) | Q4 (Condition CPT entries) | Footer Column 2 |
| Featured SN Article links (4–6) | Q9 (SN Article entries) | Footer Column 3 |

**Note:** The header (navigation structure and CTA button) has no blocking dependencies — it can be built and fully tested with placeholder page links before content is live.

---

*Header and Navigation version: 1.0 — 2026-06-28*
*Source: docs/tasks/00_PROJECT_ROADMAP.md v1.1, docs/tasks/01_INFORMATION_ARCHITECTURE.md v1.0, docs/tasks/02_CONTENT_MODELS.md v1.0*
*Next: docs/tasks/04_DESIGN_SYSTEM_TOKENS.md or docs/tasks/04_HOMEPAGE.md — pending direction from Dr. Ungureanu*
