# Project Roadmap

## georgeungureanu.doctor

**Governing philosophy:** `docs/project/PATIENT_CENTERED_MANIFESTO.md`
**Stack:** WordPress + Hello Elementor + Elementor Pro · Flexbox Containers · Global Tokens · Atomic Design
**Visual direction:** B+ — Warm Academic Medicine (approved)
**Language:** Romanian (primary)

---

## Phase Index

| Phase | Name | Status |
|-------|------|--------|
| 0 | Foundation | ✅ Complete |
| 1 | Information Architecture | — |
| 2 | Content Models | — |
| 3 | Homepage | — |
| 4 | Programări | — |
| 5 | Despre (Timeline) | — |
| 6 | Recomandări | — |
| 7 | Sfatul Neurochirurgului | — |
| 8 | Media Hub & Automation | — |
| 9 | SEO, Accessibility & Launch | — |

---

## Phase 0 — Foundation

**Status:** ✅ Complete

### Goal

Produce the complete documentation base that drives every subsequent Elementor build decision without improvisation, ambiguity, or on-the-fly design choices.

### Deliverables

**Project documentation**
- `docs/project/PROJECT_BRIEF.md` — scope, stack, constraints, success criteria
- `docs/project/PATIENT_CENTERED_MANIFESTO.md` — non-negotiable governing philosophy
- `docs/project/WEBSITE_GOALS.md` — goals by audience, CTA routing decision, business goals
- `docs/project/TARGET_AUDIENCE.md` — primary, secondary, and tertiary audience profiles

**Design system**
- `docs/design-system/VISUAL_DIRECTIONS.md` — three candidate directions
- `docs/design-system/APPROVED_VISUAL_DIRECTION.md` — B+ approved (Warm Academic Medicine)
- `docs/design-system/COLOR_SYSTEM.md` — 14 global color tokens with hex values and roles
- `docs/design-system/TYPOGRAPHY_SYSTEM.md` — 15 global typography styles; Lora + Inter
- `docs/design-system/SPACING_SYSTEM.md` — 8px base unit, all multiples of 8
- `docs/design-system/BRAND_GUIDELINES.md` — tone, imagery rules, anti-patterns
- `docs/design-system/ATOMIC_DESIGN_RULES.md` — atom → molecule → organism composition rules
- `docs/design-system/ELEMENTOR_IMPLEMENTATION_RULES.md` — Elementor-specific constraints
- `docs/design-system/DESIGN_PRINCIPLES.md` — design rationale and constraints

**Content**
- `docs/content/CONTENT_STRUCTURE.md` — section-by-section structure for all page types
- `docs/content/CONTENT_TONE.md` — voice, tone, prohibited language patterns
- `docs/content/HOMEPAGE_CONTENT_STRATEGY.md` — homepage section-by-section content strategy

**Component library**
- `docs/components/01_ATOMS.md` — 28 atoms (26 MVP + 2 deferred)
- `docs/components/02_MOLECULES.md` — 17 molecules
- `docs/components/03_ORGANISMS.md` — 21 organisms (20 MVP + 1 deferred)
- `docs/components/COMPONENT_INVENTORY.md` — master cross-reference, page-to-organism matrix, build sequence, open questions

**Implementation guides**
- `docs/implementation/01_DESIGN_SYSTEM_SETUP.md` — global CSS, global colors, global typography, layout settings
- `docs/implementation/02_HOMEPAGE_TEMPLATE.md` — 9-section homepage build guide
- `docs/implementation/03_ELEMENTOR_QA_RULES.md` — master QA checklist, anti-pattern registry, export protocol, per-launch gate
- `docs/implementation/04_THEME_BUILDER_GLOBALS.md` — header + footer step-by-step build guide
- `docs/implementation/05_PROGRAMARI_PAGE.md` — /programari appointment hub build guide (769 lines)

**Confirmed decisions**
- Navigation: Acasă / Afecțiuni / Sfatul Neurochirurgului / Recomandări / Despre Dr. George Ungureanu / [Programări CTA] (5 nav items + CTA button)
- Header CTA: "Programează o consultație" → /programari (universal routing rule)
- How-It-Works steps: Alegeți locația → Solicitați programarea → Prima consultație → Stabilim împreună planul terapeutic
- /programari CTA exception: banner routes to /contact only (no loop)

### Dependencies

None. Phase 0 is the starting point.

### Validation Checklist

- [x] All 6 implementation guides written
- [x] Visual direction approved (B+)
- [x] Navigation structure confirmed (5 items + Programări CTA button)
- [x] CTA routing confirmed (/programari as universal primary destination)
- [x] Component inventory complete (63 active MVP components)
- [x] Open questions documented (Q1–Q23)
- [x] Build sequence defined (Stages 1–7 in COMPONENT_INVENTORY.md)
- [x] Anti-pattern registry written
- [x] Per-launch QA gate written

### Definition of Done

All documentation written and reviewed. No Elementor build work required or performed in this phase. ✅

---

## Phase 1 — Information Architecture

### Goal

Stand up the WordPress environment with a working global design system — colors, typography, spacing, and navigation configured in Elementor before any page template is built.

### Deliverables

**WordPress environment**
- WordPress installed and configured at georgeungureanu.doctor
- Hello Elementor theme activated
- Elementor Pro installed and licensed
- SSL active; site accessible over HTTPS

**Global CSS**
- Custom CSS (`elementor/custom.css`) pasted into Elementor → Site Settings → Custom CSS
- All CSS custom properties active and verified in browser console
- `prefers-reduced-motion` suppression verified

**Elementor global tokens**
- 14 Global Colors configured in Elementor → Site Settings → Global Colors
  (color-ink, color-ink-secondary, color-surface, color-surface-warm, color-surface-muted, color-accent, color-accent-hover, color-accent-subtle, color-border, color-border-strong, color-overlay, color-success, color-warning, color-error)
- 15 Global Typography styles configured in Elementor → Site Settings → Global Fonts
  (H1–H4, Body Large, Body, Body Small, Pull Quote, Overline, Label, Caption, CTA Button, Navigation)
- Elementor → Site Settings → Layout: content width 1200px

**WordPress navigation**
- Menu "Navigare principală" created with 5 items in correct order:
  Acasă / Afecțiuni / Sfatul Neurochirurgului / Recomandări / Despre Dr. George Ungureanu
- "Programează o consultație" CTA button rendered separately from nav items (not a menu item) → /programari
- Menu assigned to the Primary Navigation location

**WordPress pages**
All pages created with the correct slugs (may be empty at this stage):
- / (homepage)
- /programari
- /contact
- /despre (or /despre-dr-george-ungureanu)
- /afectiuni
- /sfatul-neurochirurgului
- /recomandari
- /politica-de-confidentialitate
- /pacienti (patient information hub)

**Basic site settings**
- Site title, tagline, and favicon configured
- WordPress → Settings → Reading: homepage set to the static page "Acasă"

### Dependencies

- Hosting environment provisioned and accessible
- Domain georgeungureanu.doctor pointing to server
- Elementor Pro license available
- `docs/implementation/01_DESIGN_SYSTEM_SETUP.md` complete ✅

### Validation Checklist

- [ ] CSS custom property verified: `getComputedStyle(document.documentElement).getPropertyValue('--color-accent').trim()` → `#4D7A70`
- [ ] All 14 Global Colors appear in Elementor color picker
- [ ] All 15 Global Typography styles appear in Elementor typography picker
- [ ] Lora and Inter fonts loading: DevTools → Network → Fonts
- [ ] `prefers-reduced-motion` suppression confirmed via DevTools → Rendering → Emulate CSS media
- [ ] Navigation menu visible in the WordPress menu editor: 5 items (Acasă / Afecțiuni / Sfatul Neurochirurgului / Recomandări / Despre Dr. George Ungureanu)
- [ ] All page slugs reachable (even if empty or showing WordPress default)
- [ ] Site accessible at georgeungureanu.doctor over HTTPS
- [ ] No mixed content warnings in browser console

### Definition of Done

Global CSS active. All 14 color and 15 typography tokens configured in Elementor. Navigation menu created. All required page slugs exist. Elementor editor opens on any page with correct global tokens available in all pickers.

---

## Phase 2 — Content Models

### Goal

Build the complete atomic design system in Elementor — atoms, molecules, and global organisms — so that every page template in Phases 3–8 can be assembled from pre-built, tested components without inventing new design patterns.

### Deliverables

**Stage 4 — Atoms (Global Widgets)**

Build and save as Global Widgets in this order:
1. Typography atoms: A-01 (atom-overline), A-02 (atom-h1), A-03 (atom-h2), A-04 (atom-h3), A-05 (atom-h4), A-08 (atom-body-lg), A-09 (atom-body), A-10 (atom-body-sm), A-11 (atom-pull-quote), A-12 (atom-caption), A-13 (atom-label)
   — Note: A-06 (atom-h5) and A-07 (atom-h6) are **deferred** — do not configure
2. Interactive atoms: A-14 (atom-button-primary), A-15 (atom-button-secondary), A-16 (atom-button-ghost), A-17 (atom-link-inline)
3. Structural atoms: A-18 (atom-divider), A-19 (atom-divider-strong), A-20 (atom-icon), A-21 (atom-icon-box)
4. Form atoms: A-22 (atom-input), A-23 (atom-textarea), A-24 (atom-select), A-25 (atom-checkbox), A-26 (atom-form-error)
5. Media atoms: A-27 (atom-image), A-28 (atom-avatar)

**Stage 5 — Molecules (Template Library)**

Build in priority order:
1. molecule-logo — needed for header and footer
2. molecule-nav-item — needed for header
3. molecule-breadcrumb — needed for all interior page heroes
4. molecule-section-header — used by nearly every organism
5. molecule-meta — used by footer and contact
6. molecule-form-field + molecule-form-submit — form components
7. molecule-cta-button-group — used by heroes and CTA banners
8. molecule-card-condition, molecule-card-article, molecule-card-trust, molecule-card-doctor-teaser
9. molecule-pull-quote, molecule-condition-tag, molecule-process-step, molecule-cta-inline
10. **molecule-location-card** — **BLOCKED** on Q13 (location data from Dr. Ungureanu); build last, after location data confirmed

**Stage 6 — Global Organisms (Theme Builder)**

1. organism-site-header — Theme Builder → Header → Display Conditions: Entire Site
2. organism-site-footer — Theme Builder → Footer → Display Conditions: Entire Site
3. organism-page-not-found — **DEFERRED** — WordPress default 404 is acceptable at launch; do not build in MVP

Blocked content for header/footer (must be resolved before Stage 6 can complete):
- Q15 **BLOCKING**: Patient-facing phone number for footer Column 1 and organism-hero-contact
- Q16 **BLOCKING**: Email address for footer Column 1 and contact page
- Q20 **BLOCKING**: Privacy policy page at /politica-de-confidentialitate (legally required under GDPR before footer goes live)
- Q17: Consultation schedule — if consistent across locations: display hours; if variable: use redirect text ("Consultați pagina Programări")
- Q18 Conditional: Social media accounts — if confirmed: add profile links; if not confirmed: omit social links from footer
- Q22 Conditional: Footer description text — approve or amend default: "Neurochirurg specializat în afecțiuni ale creierului, coloanei vertebrale și sistemului nervos. Consultații și intervenții în Cluj-Napoca și Baia Mare."
- Q23 Conditional: Medical disclaimer — approve or amend default: "Informațiile de pe acest site au caracter exclusiv informativ și nu constituie sfat medical sau recomandare terapeutică. Consultați medicul specialist."

### Dependencies

- Phase 1 complete (global design system active in Elementor)
- `docs/components/01_ATOMS.md`, `02_MOLECULES.md`, `03_ORGANISMS.md` complete ✅
- `docs/implementation/04_THEME_BUILDER_GLOBALS.md` complete ✅
- Q15 (phone), Q16 (email), Q20 (privacy policy page) resolved — required before organism-site-footer can go live
- Q13 (location data) resolved — required before molecule-location-card can be built

### Validation Checklist

**Atoms**
- [ ] All 26 MVP atoms accessible as Global Widgets in Elementor
- [ ] atom-button-primary background: color-accent (#4D7A70); text: color-surface (#FDFBF7)
- [ ] atom-button-primary hover: color-accent-hover (#3A5F57)
- [ ] atom-overline: Inter 600, uppercase, color-accent, 12px
- [ ] All interactive atoms have 44px minimum touch target on mobile
- [ ] Focus ring visible on all interactive atoms (:focus-visible)

**Molecules**
- [ ] All 17 molecules saved in Elementor Template Library
- [ ] molecule-section-header composed of: overline + H2 + body-lg
- [ ] molecule-location-card has all 8 required fields (once Q13 resolved)

**Header (organism-site-header)**
- [ ] Logo: "Dr. George Ungureanu" + "Neurochirurg" — no graphic mark unless Q19 resolved
- [ ] 5-item nav in correct order: Acasă / Afecțiuni / Sfatul Neurochirurgului / Recomandări / Despre Dr. George Ungureanu
- [ ] Header CTA button "Programează o consultație" → /programari (visually distinct from nav items; not a menu link)
- [ ] Skip-to-content link: appears on :focus, off-screen at rest
- [ ] Sticky on scroll with box-shadow transition
- [ ] Mobile drawer opens/closes on tap and keyboard (Escape closes)
- [ ] `<header role="banner">` landmark present
- [ ] `<nav aria-label="Navigare principală">` present

**Footer (organism-site-footer)**
- [ ] Column 1: phone (Q15) and email (Q16) present
- [ ] Column 4: schedule or redirect text based on Q17
- [ ] Privacy policy link in legal strip → /politica-de-confidentialitate
- [ ] Medical disclaimer present (Q23 confirmed)
- [ ] Social links present only if Q18 confirmed
- [ ] No placeholder "[phone]" or "[email]" text visible to visitors
- [ ] `<footer role="contentinfo">` landmark present

**Both global organisms**
- [ ] QA checklist from `docs/implementation/03_ELEMENTOR_QA_RULES.md` passed for header
- [ ] QA checklist from `docs/implementation/03_ELEMENTOR_QA_RULES.md` passed for footer
- [ ] Color contrast ≥ 4.5:1 on all text in both organisms
- [ ] Flexbox Containers only — no legacy Sections/Columns
- [ ] Global tokens only — no local color or font overrides

### Definition of Done

All 26 MVP atoms and 17 molecules built and saved. Header and footer live on all pages via Theme Builder, with real contact data (Q15, Q16), resolved schedule content (Q17), and privacy policy page live (Q20). Both organisms pass the full QA checklist. No placeholder text visible to site visitors.

---

## Phase 3 — Homepage

### Goal

Build and publish the homepage — the site's primary trust-building surface and the first page most patients will see.

### Deliverables

9 sections built by hand in Elementor per `docs/implementation/02_HOMEPAGE_TEMPLATE.md`:

| # | Section | Organism | Background |
|---|---------|----------|-----------|
| 1 | Hero | organism-hero-homepage | color-surface (or full-bleed photo with overlay) |
| 2 | Patient Promise | Centered editorial statement (atoms + molecules) | color-surface |
| 3 | Afecțiuni Overview | organism-conditions-grid | color-surface-muted |
| 4 | Doctor Introduction | molecule-card-doctor-teaser (full-width container) | color-surface-warm |
| 5 | Credentials | organism-doctor-credentials (compact — 3 molecule-card-trust) | color-surface |
| 6 | Patient Testimonials | organism-patient-testimonials | color-surface-warm |
| 7 | How It Works | organism-how-it-works (4 steps) | color-surface |
| 8 | Sfatul Neurochirurgului | organism-article-grid (3 cards) | color-surface-warm |
| 9 | CTA Banner | organism-cta-banner | color-ink |

**Conditional visibility rules (set correctly on first build; do not launch with placeholders):**
- Section 6 (organism-patient-testimonials): built and hidden; unhide only when first approved testimonials are available via the Recomandări workflow (Phase 6)
- Section 8 (organism-article-grid): built and hidden; unhide only when 3+ articles published on /sfatul-neurochirurgului (Phase 7)

**CTA routing on this page:**
- All primary CTAs ("Programează o consultație") → /programari
- Secondary CTAs ("Afecțiuni") → /afectiuni
- Doctor teaser "Află mai multe" → /despre
- CTA banner primary button → /programari

### Dependencies

- Phase 2 complete (atoms, molecules, header/footer live via Theme Builder)
- Q7 **BLOCKING**: Doctor photography delivered — full-bleed hero photo + approachable portrait; real photography only, no stock or placeholder images
- Q3 **BLOCKING**: Trust indicator figures confirmed by Dr. Ungureanu — molecule-card-trust requires honest, verifiable figures (years of experience, specialization context, institutional context); volume metrics such as "500+ surgeries" must not be used without explicit confirmation
- Minimum 6 condition entries defined and titled (Q4)
- /programari slug live (primary CTA destination from hero)
- /afectiuni slug live (conditions grid links to it)
- /despre slug live (doctor intro section links to it)

**Blocked until content resolved:**
- Section 1 Hero: requires doctor photography (Q7)
- Section 5 Credentials: requires confirmed trust figures (Q3)
- Section 6 Testimonials: unhide only after Phase 6 approval workflow produces at least 2 approved entries (Q2)
- Section 8 Articles: unhide only after 3+ articles published on /sfatul-neurochirurgului (Q9)

### Validation Checklist

**Content**
- [ ] Hero headline speaks to patient's concern, not doctor's achievement (manifesto tone test)
- [ ] Patient Promise section: 2–3 sentences maximum, no credentials
- [ ] Afecțiuni grid shows minimum 6 cards with 1-sentence plain-language descriptions
- [ ] Doctor photo is warm and approachable — not clinical or formal (manifesto compliance)
- [ ] Trust figures are accurate, patient-readable, and confirmed by Dr. Ungureanu
- [ ] Section 6 is in hidden state (Elementor visibility: hidden) — not deleted
- [ ] Section 8 is in hidden state — not deleted

**CTA routing**
- [ ] Every "Programează o consultație" button → /programari (no exceptions)
- [ ] No CTA routes to /contact directly
- [ ] CTA banner: /programari destination confirmed

**Technical**
- [ ] One H1 on page; heading hierarchy H1 → H2 → H3 (no skipped levels)
- [ ] Background alternation correct: no two adjacent sections share same background
- [ ] Page passes QA checklist (`docs/implementation/03_ELEMENTOR_QA_RULES.md`)
- [ ] Flexbox Containers only — no legacy Sections/Columns
- [ ] Global tokens only — no local overrides
- [ ] WCAG 2.1 AA color contrast on all text
- [ ] Mobile layout tested at 375px, 414px, 768px
- [ ] Page load under 3 seconds on mobile (measured in DevTools Lighthouse)
- [ ] CSS ID `main-content` present on Section 1 (skip-to-content target from header)

### Definition of Done

Homepage live with real doctor photography, confirmed trust figures, real condition entries, and real condition page slugs linked. Testimonials and article sections correctly hidden pending Phase 6 and Phase 7 content. All 9 sections present. QA checklist passed. Page load under 3 seconds on mobile.

---

## Phase 4 — Programări

### Goal

Launch /programari and /contact as a unified pair — /programari removes geographic uncertainty, /contact closes the appointment request. Neither page can go live without the other.

### Deliverables

**A. /programari — appointment hub**

4 sections built by hand in Elementor per `docs/implementation/05_PROGRAMARI_PAGE.md`:

| # | Section | Organism | Background |
|---|---------|----------|-----------|
| 1 | Hero | organism-hero-interior | color-surface-warm |
| 2 | Location directory | organism-location-directory | color-surface |
| 3 | How it works | organism-how-it-works (contextual /programari variant) | color-surface-warm |
| 4 | CTA banner | organism-cta-banner (/programari variant) | color-ink |

**molecule-location-card — required fields (per location instance):**
- Visit type badge: Consultații / Intervenții chirurgicale / Ambele
- Clinic or hospital patient-facing name
- Full street address
- Schedule: days and hours at this specific location
- Phone number (location-specific or general)
- Booking method note (e.g., "Programare prin formularul de contact")
- Google Maps button (atom-button-ghost → Maps URL for this address)

**Optional fields per card (include if available):**
- Email (location-specific)
- Patient notes (parking, accessibility, floor, entrance)

**Launch state rules:**
- State 1 (preferred): all active locations with all required fields
- State 2 (minimum acceptable): at least one card per city group with all required fields; omit incomplete cards
- State 3 (unacceptable): empty or placeholder cards — **do not launch in this state**

**CTA routing rule — /programari only:**
- CTA banner Section 4: single button "Contactați-ne" → /contact
- No secondary CTA on /programari
- No button on this page routes back to /programari
- Routing chain enforced: any page → "Programează o consultație" → /programari → "Contactați-ne" → /contact

**B. /contact — contact page**

/programari's CTA banner routes exclusively to /contact. This page must be live before /programari can launch. Built in the same phase.

| # | Section | Organism | Background |
|---|---------|----------|-----------|
| 1 | Hero | organism-hero-contact | color-surface-warm |
| 2 | Contact form | organism-contact-form | color-surface |
| 3 | What Happens Next | molecule/atom blocks (3-step process) | color-surface-warm |

organism-hero-contact content:
- H1: "Contactați-ne"
- Two molecule-meta items: phone number + email address
- Brief reassuring intro (1–2 sentences)

Contact form fields:
- Name, email, phone (required)
- Reason for contact (optional, open text field)
- GDPR consent checkbox (required; links to /politica-de-confidentialitate)
- Success message on submission (not a redirect)

"What Happens Next" 3-step process:
Trimiteți formularul → Vă contactăm în 24 de ore → Stabilim programarea împreună

Q11 must be resolved before /contact goes live: Elementor form email routing destination confirmed; email notification template configured; CRM integration decided.

### Dependencies

- Phase 2 complete (header/footer live via Theme Builder)
- Q13 **BLOCKING**: Location data from Dr. Ungureanu — all of the following before molecule-location-card can be built: clinic/hospital patient-facing names, full street addresses per location, visit types per location (consultations / surgeries / both), Dr. Ungureanu's schedule at each location, Google Maps URL per address
- Q15 (phone number) resolved — for location card phone fields and organism-hero-contact
- Q11 **BLOCKING** (for /contact): Contact form email routing destination confirmed; email notification template ready
- /politica-de-confidentialitate live (Q20 — carried from Phase 2; required for GDPR checkbox on contact form)

### Validation Checklist

**Content — /programari**
- [ ] Breadcrumb: "Acasă → Programări" with aria-current="page" on current label
- [ ] At least one complete location card per city group
- [ ] No placeholder text visible on any card (e.g., "[Adresă]", "[Program]")
- [ ] Every location card has all 8 required fields populated
- [ ] Every Maps button opens the correct address in Google Maps (tested on mobile)
- [ ] How-it-works wording uses /programari-adapted steps, not homepage wording

**CTA routing — /programari**
- [ ] CTA banner: single button "Contactați-ne" → /contact only
- [ ] No second button in CTA banner
- [ ] No CTA on this page routes to /programari (loop check)
- [ ] /contact page is live before /programari goes live

**Content — /contact**
- [ ] Contact form submits and sends email to confirmed destination (Q11)
- [ ] Form: name, email, phone required; reason optional
- [ ] GDPR consent checkbox present, required, and links to /politica-de-confidentialitate
- [ ] Success message appears on submit (no redirect)
- [ ] "What Happens Next" 3-step process present
- [ ] Phone and email visible in organism-hero-contact without scrolling

**Technical — both pages**
- [ ] CSS ID `main-content` on Section 1 of each page (skip-to-content target)
- [ ] Breadcrumb `<nav aria-label="Breadcrumb">` landmark present on /programari
- [ ] Background alternation: color-surface-warm → color-surface → color-surface-warm → color-ink (/programari)
- [ ] Location cards stack to single column on mobile (375px)
- [ ] Both pages pass QA checklist (`docs/implementation/03_ELEMENTOR_QA_RULES.md`)
- [ ] WCAG 2.1 AA color contrast throughout

### Definition of Done

/programari and /contact both live. Patient can answer all four pre-appointment questions (Where? Is it accessible? When? How?) from /programari alone. Contact form routes to confirmed email destination. Full routing chain functional: any page → /programari → /contact → form submission → email notification.

---

## Phase 5 — Despre (Timeline)

### Goal

Build the About page — the patient's introduction to Dr. Ungureanu as a human being and clinician, anchored by a comprehensive career timeline that communicates depth without intimidating.

### Deliverables

Page sections per `docs/content/CONTENT_STRUCTURE.md` §About Dr. Ungureanu:

| # | Section | Organism/Component | Background |
|---|---------|-------------------|-----------|
| 1 | Hero | organism-hero-interior | color-surface-warm |
| 2 | Doctor Introduction | organism-doctor-intro | color-surface |
| 3 | Approach to Care | organism-philosophy-statement | color-surface-warm |
| 4 | Career & Education Timeline | molecule-timeline (new — see below) | color-surface |
| 5 | Specializations | organism-credentials-list (group 1) | color-surface-warm |
| 6 | Academic Publications | organism-credentials-list (group 2) | color-surface |
| 7 | Memberships & Affiliations | organism-credentials-list (group 3) | color-surface-warm |
| 8 | CTA Banner | organism-cta-banner | color-ink |

**molecule-timeline (new component — built in this phase):**
- Vertical timeline of career milestones in chronological order
- Each entry: year (atom-overline styled), event title (atom-h4), institution (atom-body-sm), optional note (atom-body-sm)
- Visual connector: atom-divider variant (vertical line between entries)
- Mobile: single-column stack with year above title
- Content categories provided by Dr. Ungureanu:
  - Medical education (facultate, licență, masterat — institution, city, years)
  - Residency (rezidențiat — specialization, institution, years)
  - International exchanges (instituție gazdă, program, durată, țară)
  - Continuing education courses (cursuri relevante, instituție organizatoare, an)
  - Certifications (certificări și atestate, organism emitent, an)
  - Academic positions and work (posturi universitare, activitate de cercetare, spitale de afiliere)
  - Selected publications and academic milestones (not exhaustive — landmark achievements only)
  - Founding of Sfatul Neurochirurgului (data lansării și contextul — the origin story of the patient education platform built into this site)
- Uses existing global tokens only — no new colors or fonts

**organism-doctor-intro content requirements:**
- Biography: 3–4 paragraphs, third-person, warm — not a CV recitation
- Must include: why he chose neurosurgery; what drives his approach to patients; what patients can expect from him
- Portrait: warm, approachable photography — not a formal clinical photo

**organism-philosophy-statement content requirements:**
- 3–4 values or principles
- Written in doctor's voice — personal, direct, not institutional
- Example register: "Cred că fiecare pacient merită să înțeleagă exact ce se întâmplă în corpul lui."

**organism-credentials-list — Academic Publications:**
- Selected publications only (not exhaustive)
- Standard academic citation format
- Each publication includes a 1-sentence lay-language summary (patient-readable)

### Dependencies

- Phase 2 complete (header/footer live)
- Q7 **BLOCKING**: Doctor photography delivered — full portrait for organism-doctor-intro; must be warm and approachable (see manifesto §Authority Principle)
- Doctor biography text provided and approved by Dr. Ungureanu (must pass manifesto tone test §The Success Test)
- Philosophy/values text provided and approved by Dr. Ungureanu
- Academic publications list provided by Dr. Ungureanu (with lay-language summaries)
- Career timeline content confirmed with Dr. Ungureanu across all categories: education, residency, international exchanges, courses, certifications, academic positions and publications, and the founding of Sfatul Neurochirurgului

### Validation Checklist

**Content — manifesto compliance**
- [ ] Biography does not read as a CV recitation
- [ ] Biography includes why the doctor chose neurosurgery (humanizing)
- [ ] Philosophy section is in doctor's voice — not institutional or formal language
- [ ] Academic credentials are present but do not dominate the page
- [ ] Publications have lay-language summaries — a non-medical adult can understand each one
- [ ] Doctor portrait is warm and approachable — confirmed against manifesto §Authority Principle

**Timeline**
- [ ] All content categories represented: education, residency, international exchanges, courses, certifications, academic work, and founding of Sfatul Neurochirurgului
- [ ] Each entry has at minimum: year, title, institution
- [ ] Founding of Sfatul Neurochirurgului entry is present with date and brief context
- [ ] Chronological order correct (earliest → most recent)
- [ ] No Latin abbreviations or unexplained acronyms in timeline entries

**Manifesto tone test (read as a patient)**
- [ ] "I understand this." — biography is readable by a non-medical adult
- [ ] "This was written for me." — page does not feel like a peer-facing CV
- [ ] "I know what to do next." — CTA banner is present and routes to /programari
- [ ] "I feel more confident, not more confused." — credentials section does not overwhelm

**Technical**
- [ ] CTA banner routes to /programari
- [ ] One H1 on page; heading hierarchy H1 → H2 → H3 (no skipped levels)
- [ ] Breadcrumb: "Acasă → Despre Dr. George Ungureanu"
- [ ] Timeline is keyboard-navigable and readable by screen readers
- [ ] Mobile layout tested (timeline collapses to single column)
- [ ] Page passes QA checklist (`docs/implementation/03_ELEMENTOR_QA_RULES.md`)
- [ ] WCAG 2.1 AA color contrast throughout

### Definition of Done

/despre live with real biography, real photography, approved philosophy text, real credentials and publications, and a working career timeline covering all required content categories including the founding of Sfatul Neurochirurgului. Manifesto tone test passed by a non-clinician reader. QA checklist passed. CTA banner routes correctly to /programari.

---

## Phase 6 — Recomandări

### Goal

Build the recommendations system — Dr. Ungureanu's curated recommendations for patients, and a patient testimonials workflow with a submission form, moderation queue, and approval pipeline.

### Deliverables

**A. /recomandari page**

| # | Section | Organism/Component | Background |
|---|---------|-------------------|-----------|
| 1 | Hero | organism-hero-interior | color-surface-warm |
| 2 | Recomandări din partea colegilor medici | Admin-managed Elementor content (see B) | color-surface |
| 3 | Patient Testimonials | organism-patient-testimonials (approved entries) | color-surface-warm |
| 4 | Submit a Testimonial | Elementor Form widget (testimonial submission) | color-surface |
| 5 | CTA Banner | organism-cta-banner | color-ink |

**B. Recomandări din partea colegilor medici (admin-managed)**

Endorsements from colleague physicians who refer patients to or collaborate with Dr. Ungureanu. Each entry represents a named medical professional recommending Dr. Ungureanu by name. Managed directly in the Elementor editor by a delegated administrator — colleague doctors do not submit entries through any public form.

Content structure per entry:
- Doctor photo (atom-avatar)
- Full name (atom-h4)
- Specialty (atom-body-sm)
- Institution / hospital affiliation (atom-body-sm)
- Professional relationship or context (atom-body-sm — e.g., "Medic de familie, colaborare directă timp de 8 ani")
- Recommendation text (atom-body or atom-pull-quote)

No automated sync. No CPT. Administrator adds and updates entries directly in Elementor when new colleague recommendations are received. Content provided by Dr. Ungureanu, sourced from his professional relationships (Q24 — see Open Questions).

**C. Patient testimonial submission form**

New Elementor Form widget placed in Section 4 of /recomandari (distinct from organism-contact-form):

| Field | Type | Required |
|-------|------|---------|
| Prenume | Text | Yes |
| Afecțiunea tratată | Text | Yes |
| Mesajul dvs. | Textarea | Yes |
| Consimțământ GDPR | Checkbox | Yes |

On submit:
- WordPress creates a new post in the Testimoniale Custom Post Type with status "Pending Review"
- Automated email sent to admin (Q16): subject "Testimonial nou în așteptare", body includes patient name, condition, full text, and a direct link to the WordPress draft
- No auto-publish under any circumstances
- Patient sees a success message (not a redirect): "Vă mulțumim. Mesajul dvs. va fi revizuit și publicat în curând."

**D. Testimoniale Custom Post Type**

Lightweight CPT registered in WordPress (via plugin or theme functions) to hold submitted testimonials in a structured moderation queue:

- CPT name: `testimoniale`
- Fields: prenume, afectiune, mesaj, data_trimiterii
- Default status on form submission: `pending` (not `draft`, not `publish`)
- Visible in WordPress admin → Testimoniale panel to Dr. Ungureanu and editors

**E. Approval workflow**

1. Patient submits the form on /recomandari
2. WordPress creates a Testimoniale CPT entry with status `pending`
3. Admin receives email notification with review link
4. Admin opens the entry in WordPress → Testimoniale → reviews content
5. **Approve:** changes status to `publish` → testimonial immediately appears in organism-patient-testimonials on /recomandari
6. **Reject:** leaves in `pending` or deletes — never published, no email to patient
7. organism-patient-testimonials on /recomandari queries the Testimoniale CPT for `status = publish`, ordered by date descending

**F. organism-patient-testimonials — go live on homepage and About page**

This organism was built hidden in Phase 3 (homepage Section 6) and Phase 5 (About page). Unhide on both pages simultaneously when:
- Minimum 2 approved testimonials exist in the Testimoniale CPT
- Each entry has: prenume + afectiune + mesaj
- Dr. Ungureanu has reviewed and approved each entry
- No star ratings, no marketing language in any testimonial

Unhide by changing Elementor visibility from "hidden" to "visible" on both pages. No content duplication — both pages query the same CPT source.

### Dependencies

- Phase 2 complete (header/footer live)
- Phase 3 complete (homepage Section 6 built hidden — activated in this phase)
- Phase 5 complete (About page testimonials section built hidden — activated in this phase)
- Q24 **BLOCKING**: Doctor recommendations content provided by Dr. Ungureanu — what he recommends, to whom, and with what links (if any)
- Testimoniale CPT registered in WordPress before form can be configured
- Q16 (email) resolved — admin notification email destination for testimonial submissions
- Q11 resolved — Elementor Forms must be able to create CPT posts (confirm via Elementor Forms → Actions After Submit → "Create Post" action or equivalent)

### Validation Checklist

**Colleague doctor recommendations**
- [ ] Content sourced from real colleague physicians — no placeholder entries
- [ ] Each entry has all 6 required fields: photo, full name, specialty, institution, professional relationship/context, recommendation text
- [ ] Doctor photos are professional portraits — no stock imagery
- [ ] Section is editable by admin without developer involvement (Elementor only)

**Submission form**
- [ ] All 4 fields present (prenume, afectiune, mesaj, GDPR checkbox)
- [ ] GDPR checkbox links to /politica-de-confidentialitate
- [ ] Form submission creates a Testimoniale CPT entry with status `pending`
- [ ] Admin receives email notification on each submission (Q16)
- [ ] Success message shown to patient after submit (not a redirect)
- [ ] Form does not auto-publish under any condition

**Approval workflow**
- [ ] WordPress admin → Testimoniale panel lists all pending entries
- [ ] Approving an entry (status → `publish`) makes it immediately visible on /recomandari
- [ ] Approved entries appear in organism-patient-testimonials on /recomandari
- [ ] organism-patient-testimonials on homepage and About page unhidden with ≥ 2 approved entries
- [ ] Both homepage Section 6 and About page testimonials visible simultaneously (not staggered)

**All pages**
- [ ] Breadcrumb: "Acasă → Recomandări"
- [ ] CTA banner → /programari
- [ ] Page passes QA checklist (`docs/implementation/03_ELEMENTOR_QA_RULES.md`)
- [ ] WCAG 2.1 AA color contrast throughout
- [ ] Mobile layout tested

### Definition of Done

/recomandari live with Dr. Ungureanu's curated recommendations and a working testimonial submission form. Testimoniale CPT active and receiving submissions. Approval workflow confirmed end-to-end: form submit → pending entry → admin notification → admin approves → testimonial appears on /recomandari. Homepage Section 6 and About page testimonials section unhidden with minimum 2 approved entries.

---

## Phase 7 — Sfatul Neurochirurgului

### Goal

Build two content pillars — Sfatul Neurochirurgului (the medical education blog) and Afecțiuni (the conditions library) — and the patient information hub. These three deliverables complete the site's educational depth and give patients the information they need before, during, and after a consultation.

### Deliverables

**A. /sfatul-neurochirurgului hub page**

| # | Section | Organism | Background |
|---|---------|----------|-----------|
| 1 | Hero | organism-hero-interior | color-surface-warm |
| 2 | Article grid | organism-article-grid (full — all published articles) | color-surface |
| 3 | CTA Banner | organism-cta-banner | color-ink |

**B. Individual article page template**

| # | Section | Component | Notes |
|---|---------|-----------|-------|
| 1 | Hero | organism-hero-interior | Article title as H1; reading time; date |
| 2 | Article content | atom-body + atom-h2/h3 + atom-image blocks | Full article body |
| 3 | Article FAQ (if applicable) | organism-faq | Related patient questions |
| 4 | CTA | organism-appointment-cta | "Programează o consultație" → /programari |

**C. Initial articles**

Minimum 3 articles published before:
- organism-article-grid on homepage (Section 8) is unhidden
- /sfatul-neurochirurgului page goes live

Article requirements:
- Written in plain Romanian, readable by a non-medical adult
- Title answers a patient question (e.g., "Ce trebuie să știi înainte de o operație pe coloană?")
- Reading time estimate present
- Author: Dr. George Ungureanu (byline confirmed)

**D. Navigation update**
- "Sfatul Neurochirurgului" nav item (position 3 in the 5-item navigation) linked to /sfatul-neurochirurgului once page is live

**E. /afectiuni overview page**

| # | Section | Organism | Background |
|---|---------|----------|-----------|
| 1 | Hero | organism-hero-interior | color-surface-warm |
| 2 | Full conditions grid | organism-conditions-grid (full — all conditions) | color-surface |
| 3 | CTA | organism-cta-banner | color-ink |

**F. Individual condition page template**

Per condition, 8 sections per `docs/content/CONTENT_STRUCTURE.md` §Individual Condition:

| # | Section | Component | Notes |
|---|---------|-----------|-------|
| 1 | Hero | organism-hero-interior | Condition name as H1; 1-sentence summary |
| 2 | What Is This Condition? | atom-h2 + atom-body blocks | Plain language, patient-readable |
| 3 | Diagnosis | atom-h2 + atom-body blocks | What tests, what to expect |
| 4 | Treatment Options | atom-h2 + atom-body blocks | Options, when surgery, if untreated |
| 5 | The Procedure (surgical) | atom-h2 + atom-body blocks | Duration, anaesthesia, technique |
| 6 | Recovery | atom-h2 + atom-body blocks | Hospital stay, timeline, follow-up |
| 7 | FAQ | organism-faq | 4–6 questions per condition in plain language |
| 8 | CTA | organism-appointment-cta | "Programează o consultație" → /programari |

Emergency notice rule: organism-emergency-notice placed above Section 1 on any acute-presentation condition (confirmed list: Q1 — to be resolved with Dr. Ungureanu).

**G. Initial condition pages**

Minimum 6 condition pages published with complete content before the conditions grid on the homepage or /afectiuni can go live. Content written in plain Romanian, readable by a non-medical adult.

**H. /pacienti patient information page**

| # | Section | Organism | Background |
|---|---------|----------|-----------|
| 1 | Hero | organism-hero-interior | color-surface-warm |
| 2 | Before Your Appointment | atom/molecule blocks | color-surface |
| 3 | During Treatment | organism-patient-journey (primary use) | color-surface-warm |
| 4 | Recovery & Follow-up | atom/molecule blocks | color-surface |
| 5 | FAQ | organism-faq | color-surface-warm |
| 6 | CTA Banner | organism-cta-banner | color-ink |

### Dependencies

- Phase 2 complete (header/footer live)
- Phase 3 complete (homepage article grid and conditions grid are built hidden — both unhidden in this phase)
- Q9 **BLOCKING**: Article content available — minimum 3 articles written or provided by Dr. Ungureanu
- Q4 **BLOCKING**: Full condition list confirmed with Dr. Ungureanu — minimum 6 conditions with content for initial launch
- Q1: Emergency notice scope — confirmed list of acute-presentation conditions requiring organism-emergency-notice
- Condition content written in patient-accessible Romanian (provided by Dr. Ungureanu or by a medical writer with clinical review)
- Q10: SEO plugin confirmed (Yoast SEO or RankMath) — for FAQ Schema on condition and article pages with FAQ sections

### Validation Checklist

**Sfatul Neurochirurgului hub (/sfatul-neurochirurgului)**
- [ ] Minimum 3 article cards visible
- [ ] Each card: title, excerpt, reading time, date
- [ ] Cards link to individual article pages
- [ ] CTA banner → /programari
- [ ] Homepage Section 8 (organism-article-grid) is now unhidden and showing live articles

**Individual article pages**
- [ ] H1 is a patient question or direct patient-benefit statement
- [ ] Medical terms defined on first use
- [ ] Reading time estimate shown
- [ ] Author byline: Dr. George Ungureanu
- [ ] organism-appointment-cta CTA → /programari
- [ ] FAQ Schema markup present if Q10 resolved

**Navigation**
- [ ] "Sfatul Neurochirurgului" nav item in header links to /sfatul-neurochirurgului
- [ ] Breadcrumb on /sfatul-neurochirurgului: "Acasă → Sfatul Neurochirurgului"
- [ ] Breadcrumb on individual article: "Acasă → Sfatul Neurochirurgului → [Article Title]"

**Afecțiuni overview page (/afectiuni)**
- [ ] All confirmed conditions appear as cards in the grid
- [ ] Each card: condition name + 1-sentence plain-language description + link to individual page
- [ ] "Nu vedeți afecțiunea dvs.?" or equivalent contact invitation present
- [ ] CTA banner → /programari
- [ ] Homepage Section 3 (conditions grid) links to /afectiuni

**Individual condition pages (checked per page)**
- [ ] Condition name in H1 uses plain Romanian (not Latin medical term as primary heading)
- [ ] Medical terms defined on first use
- [ ] FAQ answers are in plain language — a non-medical adult can read them
- [ ] organism-emergency-notice present on confirmed acute conditions (Q1)
- [ ] organism-appointment-cta CTA → /programari
- [ ] No heading hierarchy gaps (H1 → H2 → H3)
- [ ] FAQ Schema markup present if Q10 resolved and Yoast/RankMath confirmed

**Patient page (/pacienti)**
- [ ] Breadcrumb: "Acasă → Informații pentru pacienți"
- [ ] organism-patient-journey used (not organism-how-it-works — different purpose)
- [ ] FAQ answers in plain Romanian
- [ ] CTA banner → /programari
- [ ] Manifesto tone test passed

**All pages**
- [ ] Every page passes manifesto tone test
- [ ] Every page passes QA checklist (`docs/implementation/03_ELEMENTOR_QA_RULES.md`)
- [ ] WCAG 2.1 AA color contrast throughout
- [ ] Mobile layout tested on all new pages

### Definition of Done

/sfatul-neurochirurgului live with minimum 3 articles. /afectiuni live with full conditions grid and minimum 6 individual condition pages with patient-readable content. /pacienti live. Homepage Section 8 (article grid) and Section 3 (conditions grid) both unhidden and showing live content. "Sfatul Neurochirurgului" navigation item links correctly. organism-emergency-notice deployed on confirmed acute condition pages. All pages pass QA and manifesto tone test.

---

## Phase 8 — Media Hub & Automation

### Goal

Build the automated content pipeline that converts Dr. Ungureanu's social media posts (Instagram, Facebook, YouTube) into WordPress draft posts on the Sfatul Neurochirurgului section, requiring manual approval before publication. No content is published automatically under any condition.

### Pipeline Architecture

```
Dr. Ungureanu posts on Instagram / Facebook / YouTube
          ↓
Make scenario detects new post (trigger per platform)
          ↓
Make creates WordPress draft via REST API
  · Title: auto-generated from caption / video title
  · Body: caption or description → post body
  · Media: image or video embedded
  · Category: Sfatul Neurochirurgului
  · Status: Draft (never auto-published)
          ↓
Make sends email to admin: "Conținut nou de publicat: [title]"
  · Direct link to WordPress draft for review
          ↓
Dr. Ungureanu / admin opens draft in WordPress editor
  · Reviews content; edits formatting, language, medical accuracy
  · Sets excerpt, tags, featured image (if not auto-imported)
  · Publishes manually
          ↓
Post appears on /sfatul-neurochirurgului + homepage Section 8
```

### Deliverables

**A. Make account and scenario configuration**

- Make account active with the project's credentials
- Three scenarios configured (one per source platform):
  1. Instagram Business/Creator → WordPress
  2. Facebook Page → WordPress
  3. YouTube Channel → WordPress
- Each scenario: platform trigger → content parser → WordPress REST API call → email notification

**B. Instagram → WordPress scenario**

- Trigger: new post published on Dr. Ungureanu's Instagram account (Instagram Basic Display API or Instagram Graph API via Make)
- Field mapping:
  - Caption → post body (atom-body format)
  - First image → featured image (uploaded to WordPress Media Library via Make)
  - Post date → WordPress post date
  - Instagram permalink → custom field "Sursa originală" (displayed as atom-button-ghost below content)
- Draft title: first sentence of caption (truncated to 80 characters); admin edits before publishing
- WordPress category: Sfatul Neurochirurgului
- WordPress status: `draft`

**C. Facebook → WordPress scenario**

- Trigger: new post published on Dr. Ungureanu's Facebook Page (Facebook Graph API via Make)
- Same field mapping as Instagram scenario
- WordPress category: Sfatul Neurochirurgului
- WordPress status: `draft`

**D. YouTube → WordPress scenario**

- Trigger: new video published on Dr. Ungureanu's YouTube channel (YouTube Data API v3 via Make)
- Field mapping:
  - Video title → post title
  - Video description → post body (atom-body format)
  - YouTube video ID → embedded YouTube player (oEmbed, lazy-loaded, no autoplay)
  - Published date → WordPress post date
  - YouTube URL → custom field "Sursa originală"
- WordPress category: Sfatul Neurochirurgului
- WordPress status: `draft`

**E. WordPress REST API configuration**

- WordPress application password generated for Make (scoped to: create post, upload media only)
- REST API endpoint: `/wp-json/wp/v2/posts` (POST method — create draft)
- Media upload endpoint: `/wp-json/wp/v2/media` (POST method — for image import)
- Make connection authenticated and tested per scenario
- Polling interval or webhook configured per platform's API capabilities

**F. Admin email notification**

- Make → Email module (or Gmail integration) sends notification on each new draft
- Subject: "Conținut nou de publicat: [post title]"
- Body: post title, source platform, first 200 characters of content, direct link to WordPress draft
- Recipient: admin email (Q16)
- Notification sent regardless of content length or media presence

**G. Admin approval workflow (manual — no exceptions)**

1. Admin receives email notification
2. Opens WordPress → Posts → Drafts → [new draft]
3. Reviews: reads content, checks medical accuracy, adjusts language to site tone
4. Edits title, body, excerpt, tags, featured image as needed
5. Confirms category: Sfatul Neurochirurgului
6. Clicks "Publish" → post appears on /sfatul-neurochirurgului and homepage Section 8
7. If not suitable for publication: moves to Trash or leaves as draft indefinitely

**H. End-to-end pipeline test**

Before declaring this phase complete, run a full test for each platform:
- Post test content on Instagram, Facebook, and YouTube (use test accounts or unpublished posts if available)
- Confirm Make scenario triggers within expected time
- Confirm WordPress draft is created with correctly mapped fields
- Confirm admin email notification arrives with correct subject and draft link
- Confirm manual publish makes post appear on /sfatul-neurochirurgului
- Confirm homepage Section 8 reflects the new post
- Confirm no content is published without manual approval step

### Dependencies

- Phase 7 complete (/sfatul-neurochirurgului page live; article page template built and tested)
- Q18 **BLOCKING** (updated): Dr. Ungureanu's official social media accounts confirmed with admin API access — Instagram Business or Creator account, Facebook Page with admin access, YouTube channel with channel owner access. API credentials provisioned for Make.
- Q25 **BLOCKING**: Make account registered and subscription active (make.com); API quota confirmed for each platform
- Q16 (admin email) resolved — notification destination for new drafts
- WordPress application password generated (WordPress admin → Users → Application Passwords)

### Validation Checklist

**Pipeline — per platform**
- [ ] Instagram scenario: triggers on new post within 15 minutes; creates draft with correct caption and image
- [ ] Facebook scenario: triggers on new page post; creates draft with correct content
- [ ] YouTube scenario: triggers on new video; creates draft with title, description, and embedded player
- [ ] All three scenarios: admin email notification received with direct draft link

**WordPress integration**
- [ ] WordPress application password used by Make — not admin username/password
- [ ] Drafts appear in WordPress → Posts → Drafts with correct category (Sfatul Neurochirurgului)
- [ ] No drafts auto-publish at any point in the pipeline
- [ ] Featured images (when imported) appear in WordPress Media Library

**Approval workflow**
- [ ] Admin can edit draft content before publishing
- [ ] Manual publish makes post appear on /sfatul-neurochirurgului immediately
- [ ] Homepage Section 8 (organism-article-grid) reflects newly published post
- [ ] Rejected drafts remain in draft/trash and never appear on frontend

**GDPR and cookie compliance**
- [ ] Q12/Q21 resolved: analytics tracking decision made
- [ ] If analytics in use: cookie consent mechanism installed; /cookies page live; footer Cookie-uri link active
- [ ] If no analytics: Cookie-uri link omitted from footer legal strip
- [ ] /politica-de-confidentialitate live and confirmed (Q20 — carried from Phase 2)

### Definition of Done

All three social platform scenarios active in Make and tested end-to-end. At least one real post per platform has been converted to a WordPress draft and manually published. Admin email notifications confirmed working. No auto-publish has occurred at any point in any test. GDPR compliance decision resolved.

---

## Phase 9 — SEO, Accessibility & Launch

### Goal

Verify that the complete site meets its technical, accessibility, and SEO requirements before going live to patients.

### Deliverables

**A. Full QA pass — all pages**
Apply `docs/implementation/03_ELEMENTOR_QA_RULES.md` master checklist and per-launch gate to every page:
- Homepage
- /programari
- /contact
- /afectiuni + all condition pages
- /sfatul-neurochirurgului + all article pages
- /recomandari
- /despre
- /pacienti
- /politica-de-confidentialitate
- /cookies (if applicable)

**B. Accessibility audit (WCAG 2.1 AA)**
- Run axe DevTools or equivalent on all pages
- Verify: heading hierarchy, landmark regions, aria-labels, form labels, image alt text, color contrast
- Verify: keyboard-only navigation works across entire site (Tab, Shift+Tab, Enter, Escape, arrow keys in nav)
- Verify: screen reader test on header, footer, forms, and condition pages

**C. SEO configuration**
- SEO plugin installed and configured (Q10 — Yoast SEO or RankMath)
- Meta title and description set on every page (using confirmed SEO copy)
- Open Graph tags configured (title, description, image per page)
- FAQ Schema markup on organism-faq instances (if Q10 resolved)
- MedicalBusiness / Physician schema on homepage or /contact (structured data for medical practice)
- Breadcrumb schema on all interior pages
- Canonical URLs configured (no duplicate content)
- XML sitemap generated and submitted to Google Search Console
- robots.txt configured (no sensitive directories indexed)
- hreflang not required (Romanian-only in Phase 1)

**D. Performance**
- Google Lighthouse audit on homepage and /programari on mobile (target: Lighthouse score 90+ Performance, 100 Accessibility)
- Images: all hero and card images compressed (WebP format preferred)
- Images: lazy loading enabled on all below-the-fold images
- Font loading: Lora and Inter preloaded with `<link rel="preload">`
- Core Web Vitals: LCP, CLS, FID/INP within acceptable range
- Elementor page cache configured (if caching plugin installed)

**E. Pre-launch gate (from `docs/implementation/03_ELEMENTOR_QA_RULES.md`)**
The QA rules document defines a per-launch gate checklist. All items must be checked before site goes live.

**F. DNS and hosting verification**
- georgeungureanu.doctor resolves correctly from external networks
- SSL certificate valid; auto-renewal configured
- www → georgeungureanu.doctor redirect configured (or vice versa — pick one canonical form)
- HTTP → HTTPS redirect active
- WordPress address and site address match the canonical domain

**G. Go-live**
- Site set to "Public" in WordPress → Settings → Reading
- Google Search Console verified and sitemap submitted
- WordPress admin and Elementor editor credentials secured
- Backup configured (automated, offsite)

### Dependencies

- All phases 1–8 complete
- All open questions (Q1–Q25) resolved (any remaining conditional questions decided)
- Dr. Ungureanu has reviewed and approved all live content
- Legal review of privacy policy and medical disclaimer text (Q20, Q23)
- Google Search Console access available

### Validation Checklist

**QA**
- [ ] Per-launch gate from `docs/implementation/03_ELEMENTOR_QA_RULES.md` fully checked — all items pass
- [ ] No Elementor "Edit" bars or admin bars visible when logged out
- [ ] No placeholder text on any page ([brackets], lorem ipsum, or TBD labels)
- [ ] No broken internal links (check all CTAs, nav items, footer links, breadcrumbs)
- [ ] No 404 pages except the intentional 404 page (WordPress default — deferred per Phase 2)

**Accessibility**
- [ ] axe DevTools: zero critical or serious violations on all pages
- [ ] Keyboard navigation: complete end-to-end journey (homepage → /programari → /contact → form submit) achievable by keyboard alone
- [ ] Screen reader: header nav, contact form, condition page FAQ all announce correctly
- [ ] Color contrast: all text passes WCAG 2.1 AA (4.5:1 normal, 3:1 large)
- [ ] All images have meaningful alt text (or `alt=""` for decorative images)
- [ ] Focus indicators visible on all interactive elements

**SEO**
- [ ] Every page has a unique meta title and meta description
- [ ] Open Graph image set on homepage and key pages
- [ ] XML sitemap submitted to Google Search Console
- [ ] robots.txt does not block any patient-facing pages
- [ ] No indexing of /wp-admin or /elementor
- [ ] Breadcrumb schema present on interior pages

**Performance**
- [ ] Lighthouse Performance ≥ 90 on mobile (homepage)
- [ ] Lighthouse Accessibility = 100 (homepage)
- [ ] LCP < 2.5 seconds on homepage (mobile)
- [ ] CLS < 0.1 on all pages
- [ ] All hero images compressed and served in WebP
- [ ] Page load under 3 seconds on 4G mobile connection

**Go-live**
- [ ] Site publicly visible at georgeungureanu.doctor (not password-protected or "Coming Soon")
- [ ] SSL valid and auto-renewal confirmed
- [ ] Canonical URL confirmed (www or non-www — consistent)
- [ ] Automated backup running
- [ ] Dr. Ungureanu has final sign-off on all live content

### Definition of Done

All QA checks pass. Lighthouse Accessibility = 100 on homepage. All pages have meta titles and descriptions. Sitemap submitted. SSL confirmed. Site publicly accessible. Dr. Ungureanu has signed off on all content. The patient who arrives at the site at midnight, afraid and searching for answers, finds clarity, warmth, and a clear next step.

---

## Open Questions Summary

The following questions must be resolved before the corresponding phases can complete. Questions are grouped by blocking phase.

| Q# | Question | Blocks | Type |
|----|----------|--------|------|
| Q13 | Location data (clinic names, addresses, visit types, schedules, Maps URLs) | Phase 4 | BLOCKING |
| Q7 | Doctor photography (hero + portrait) | Phases 3, 5 | BLOCKING |
| Q3 | Trust indicator figures (honest, verifiable) | Phase 3 | BLOCKING |
| Q15 | Patient-facing phone number | Phases 2, 4 | BLOCKING |
| Q16 | Email address | Phases 2, 4, 6, 8 | BLOCKING |
| Q20 | Privacy policy page (GDPR required) | Phase 2 | BLOCKING |
| Q11 | Contact form email routing destination | Phase 4 | BLOCKING |
| Q9 | Article content (minimum 3) | Phase 7 | BLOCKING |
| Q4 | Full condition list (minimum 6 with content) | Phase 7 | BLOCKING |
| Q24 | Colleague doctor recommendations content (names, specialties, institutions, photos, and recommendation texts from physicians who refer to or collaborate with Dr. Ungureanu) | Phase 6 | BLOCKING |
| Q25 | Make account registered and active; API quota confirmed per platform | Phase 8 | BLOCKING |
| Q1 | Emergency notice scope (acute conditions list) | Phase 7 | Must resolve with Dr. Ungureanu |
| Q2 | Patient testimonials — Phase 6 workflow replaces manual collection; Q2 is now resolved by the submission form | Phase 6 | Superseded by workflow |
| Q10 | SEO plugin choice (Yoast or RankMath) | Phases 7, 9 | Technical decision |
| Q12/Q21 | Analytics and cookie consent | Phase 8, Launch | Legal/technical decision |
| Q17 | Consultation schedule (consistent or variable) | Phase 2 footer | Conditional |
| Q18 | Social media accounts and API access (Instagram, Facebook, YouTube) | Phase 2 footer (conditional); Phase 8 (BLOCKING) | Conditional → BLOCKING in Phase 8 |
| Q19 | Logo mark (typographic or graphic) | Phase 2 header | Conditional |
| Q22 | Footer description text | Phase 2 footer | Confirm or amend default |
| Q23 | Medical disclaimer wording | Phase 2 footer | Legal — confirm or amend |

---

*Roadmap version: 1.1 — 2026-06-28*
*Navigation updated to approved IA: Acasă / Afecțiuni / Sfatul Neurochirurgului / Recomandări / Despre Dr. George Ungureanu / [Programări CTA]*
*Source documents: docs/project/*, docs/design-system/*, docs/content/*, docs/components/COMPONENT_INVENTORY.md, docs/implementation/01–05*
*Next task: see docs/tasks/ for individual phase task files*
