# Information Architecture

## georgeungureanu.doctor

**Source of truth:** `docs/tasks/00_PROJECT_ROADMAP.md`
**Governing philosophy:** `docs/project/PATIENT_CENTERED_MANIFESTO.md`
**Audience reference:** `docs/project/TARGET_AUDIENCE.md`
**Phase:** 1 — Information Architecture

---

## 1. Purpose and Scope

This document defines the complete information architecture of georgeungureanu.doctor: what pages exist, what each page is for, how they are named and connected, how content is structured within each section, and how users move through the site.

This document governs:
- Navigation structure and header composition
- Site map and URL scheme
- Page inventory and purpose
- Content pillar definitions
- CTA routing logic
- User journeys
- Breadcrumb hierarchy

This document does not govern:
- Visual design or layout (see `docs/design-system/`)
- Component composition (see `docs/components/`)
- Elementor build steps (see `docs/implementation/`)
- WordPress configuration steps (see `docs/tasks/00_PROJECT_ROADMAP.md` Phase 1)

---

## 2. Conceptual Site Model

The site has two distinct structural layers:

**Navigational layer** — content destinations a patient chooses to explore:

| Section | Purpose |
|---------|---------|
| Acasă | First impression, orientation, and routing |
| Afecțiuni | Patient education about conditions and treatments |
| Sfatul Neurochirurgului | Educational ecosystem in the doctor's voice |
| Recomandări | Professional endorsements and patient experiences |
| Despre Dr. George Ungureanu | Introduction to the doctor as a person and clinician |

**Transactional layer** — destination pages a patient is routed to, not browsed to:

| Page | Purpose |
|------|---------|
| Programări | Remove geographic uncertainty before contact |
| Contact | Receive and route the appointment request |

The transactional layer is intentionally invisible in the navigation. A patient in a browsing state should not feel pressured into transacting. The transition from browsing to transacting is managed entirely by the primary CTA ("Programează o consultație") that appears on every page.

---

## 3. Navigation Structure

### 3.1 Header Composition

The header contains three zones:

```
[Logo zone]  ·  [Navigation zone]  ·  [CTA zone]
```

**Logo zone**
- Primary text: Dr. George Ungureanu
- Secondary text: Neurochirurg
- Links to: / (homepage)
- No graphic mark in the initial build (conditional on Q19)

**Navigation zone — 5 text links**

| Position | Label | Destination |
|----------|-------|-------------|
| 1 | Acasă | / |
| 2 | Afecțiuni | /afectiuni |
| 3 | Sfatul Neurochirurgului | /sfatul-neurochirurgului |
| 4 | Recomandări | /recomandari |
| 5 | Despre Dr. George Ungureanu | /despre |

**CTA zone — 1 primary button**

| Label | Destination | Type |
|-------|-------------|------|
| Programează o consultație | /programari | atom-button-primary |

The CTA button is visually and structurally distinct from the navigation items. It is not a menu item. It does not appear in the WordPress navigation menu. It is rendered as a separate element in the header's flex layout.

### 3.2 What Is Not in the Navigation

The following pages exist on the site but do not appear as navigation items:

| Page | Why excluded |
|------|-------------|
| /programari | Reached via CTA only — not a browsable section |
| /contact | Reached via /programari only — final step of the transactional flow |
| /pacienti | Linked contextually from relevant content; not a top-level destination |
| /politica-de-confidentialitate | Footer only — legal requirement |
| /cookies | Footer only — conditional on analytics decision (Q12/Q21) |

### 3.3 Mobile Navigation

On mobile, the navigation collapses to a drawer (hamburger trigger):
- Drawer contains all 5 text links in order
- CTA button ("Programează o consultație" → /programari) appears at the bottom of the drawer
- Escape key closes the drawer
- Focus is trapped inside the open drawer for keyboard users

### 3.4 Footer Navigation

The footer is a global element (Theme Builder — all pages). It provides secondary navigation and contact information across four columns:

| Column | Content |
|--------|---------|
| 1 | Doctor name, specialty, phone (Q15), email (Q16), social links (conditional — Q18) |
| 2 | Page links: Acasă, Afecțiuni, Sfatul Neurochirurgului, Recomandări, Despre |
| 3 | Page links: Programări, Informații pentru pacienți, Contact |
| 4 | Consultation schedule or redirect text ("Consultați pagina Programări") — based on Q17 |

Footer legal strip (below the 4 columns):
- Copyright notice
- Link → /politica-de-confidentialitate
- Link → /cookies (conditional — Q12/Q21)
- Medical disclaimer text (Q23)

---

## 4. Site Map

```
georgeungureanu.doctor
│
├── /                                   Acasă (Homepage)
│
├── /afectiuni                          Afecțiuni (Conditions overview)
│   └── /afectiuni/[slug]               Individual condition page
│       (one page per condition — minimum 6 at launch)
│
├── /sfatul-neurochirurgului            Sfatul Neurochirurgului (Hub)
│   └── /sfatul-neurochirurgului/[slug] Individual article or content piece
│       (minimum 3 at launch)
│
├── /recomandari                        Recomandări
│
├── /despre                             Despre Dr. George Ungureanu
│
├── /programari                         Programări (CTA destination — not in nav)
│
├── /contact                            Contact (reached via /programari only)
│
├── /pacienti                           Informații pentru pacienți (linked contextually)
│
├── /politica-de-confidentialitate      Privacy Policy (footer link — GDPR required)
│
└── /cookies                            Cookie Policy (footer link — conditional)
```

**Depth:** No patient-facing content is more than 3 clicks from the homepage.

```
Homepage → Afecțiuni → [Condition] = 2 clicks
Homepage → Sfatul Neurochirurgului → [Article] = 2 clicks
Homepage → [CTA] → Programări = 1 click
Homepage → [CTA] → Programări → Contact = 2 clicks
```

---

## 5. Page Inventory

| Page | Slug | Pillar | Priority | Status |
|------|------|--------|----------|--------|
| Homepage | / | — | Critical | Phase 3 |
| Afecțiuni overview | /afectiuni | Afecțiuni | High | Phase 7 |
| Individual condition (×N) | /afectiuni/[slug] | Afecțiuni | High | Phase 7 |
| Sfatul Neurochirurgului hub | /sfatul-neurochirurgului | Sfatul Neurochirurgului | High | Phase 7 |
| Individual article (×N) | /sfatul-neurochirurgului/[slug] | Sfatul Neurochirurgului | High | Phase 7 |
| Recomandări | /recomandari | Recomandări | High | Phase 6 |
| Despre Dr. George Ungureanu | /despre | Despre | High | Phase 5 |
| Programări | /programari | Transactional | Critical | Phase 4 |
| Contact | /contact | Transactional | Critical | Phase 4 |
| Informații pentru pacienți | /pacienti | Supporting | Medium | Phase 7 |
| Privacy Policy | /politica-de-confidentialitate | Legal | Required | Phase 2 |
| Cookie Policy | /cookies | Legal | Conditional | Phase 8 |

---

## 6. Content Pillars

### 6.1 Afecțiuni

**Navigation position:** 2
**URL root:** /afectiuni
**Purpose:** Patient education — what each condition is, how it is diagnosed, what treatment involves, and what recovery looks like.

**Pillar structure:**

```
/afectiuni                      Overview grid — all conditions
└── /afectiuni/[slug]           Individual condition page
```

**Overview page (/afectiuni):**
Provides the complete grid of all treatable conditions as cards. Each card: condition name, 1-sentence plain-language description, link to individual page. Includes a contact invitation for patients whose condition is not listed.

**Individual condition page (/afectiuni/[slug]):**
Eight fixed sections per condition:

| # | Section | Purpose |
|---|---------|---------|
| 1 | Hero | Condition name as H1; 1-sentence summary |
| 2 | What Is This Condition? | Plain-language explanation; who it affects; causes; symptoms |
| 3 | Diagnosis | Tests and scans; what the patient can expect at diagnosis |
| 4 | Treatment Options | Available options; when surgery is indicated; consequences of no treatment |
| 5 | The Procedure | Duration, anaesthesia, technique (surgical conditions only) |
| 6 | Recovery | Hospital stay; return to activity timeline; follow-up requirements |
| 7 | FAQ | 4–6 most common patient questions answered in plain language |
| 8 | CTA | "Programează o consultație" → /programari |

**Emergency notice rule:** On conditions with acute-presentation symptoms (confirmed list: Q1), `organism-emergency-notice` is placed above Section 1. It is not a section — it is a persistent banner that appears before any other content on that specific page.

**Content rules:**
- Condition name in H1 uses plain Romanian (not the Latin medical term as primary heading)
- All medical terms defined on first use within each page
- No condition page ends without a CTA routing to /programari
- No cross-links between condition pages (patients focus on their own condition)

**Launch minimum:** 6 individual condition pages with complete content.

**Breadcrumb:** Acasă → Afecțiuni → [Condition Name]

---

### 6.2 Sfatul Neurochirurgului

**Navigation position:** 3
**URL root:** /sfatul-neurochirurgului
**Purpose:** An educational ecosystem in Dr. Ungureanu's voice — not a generic blog or resources library. The name "Sfatul Neurochirurgului" (The Neurosurgeon's Counsel) is the section brand. Content is accessible, patient-centered, and always carries Dr. Ungureanu's authority.

**Why this is an ecosystem, not a blog:**
- The name is a brand — it implies a sustained, curated body of counsel from a named expert
- Content enters from multiple sources (original + social platforms) but all passes through manual approval
- Every published piece carries the byline and professional authority of Dr. Ungureanu
- The section builds an ongoing relationship with patients who return before and after consultations

**Pillar structure:**

```
/sfatul-neurochirurgului            Hub — all published content
└── /sfatul-neurochirurgului/[slug] Individual article or content piece
```

**Hub page (/sfatul-neurochirurgului):**
Full grid of all published articles and content pieces, ordered by date (most recent first). Each card: title, excerpt, reading time, publication date.

**Individual content page (/sfatul-neurochirurgului/[slug]):**
Four fixed sections:

| # | Section | Purpose |
|---|---------|---------|
| 1 | Hero | Article title as H1; reading time; publication date |
| 2 | Content | Full article body — structured with H2/H3 headings and body text |
| 3 | FAQ (optional) | Related patient questions, if applicable to the content |
| 4 | CTA | "Programează o consultație" → /programari |

**Content types within Sfatul Neurochirurgului:**

| Type | Source | Format |
|------|--------|--------|
| Original article | Written by or with Dr. Ungureanu, published directly in WordPress | Text + images |
| Repurposed social content | Instagram or Facebook caption → approved WordPress article | Text + image |
| Video content | YouTube video → approved WordPress article with embedded player | Video + description |

**Content entry pipeline — automated channel:**

```
Dr. Ungureanu publishes on Instagram / Facebook / YouTube
            ↓
Make scenario detects new post (one scenario per platform)
            ↓
Make creates WordPress draft
  · Title: auto-generated from caption or video title
  · Body: caption / description → article body
  · Media: image embedded / YouTube player embedded (lazy, no autoplay)
  · Category: Sfatul Neurochirurgului
  · Status: Draft
            ↓
Email notification to admin: "Conținut nou de publicat: [title]"
            ↓
Dr. Ungureanu or admin reviews draft — edits as needed
            ↓
Manual publish → content appears on /sfatul-neurochirurgului
```

**Non-negotiable rule:** No content is published without manual approval. Automated draft creation is the input; human decision is the gate.

**Content rules:**
- Every piece carries the byline: Dr. George Ungureanu
- Title must answer a patient question or directly name a patient benefit
- Reading time estimate present on every piece
- Medical terms defined on first use
- Every piece ends with CTA → /programari

**Launch minimum:** 3 published pieces before the hub page and homepage Section 8 go live.

**Breadcrumb:** Acasă → Sfatul Neurochirurgului → [Article Title]

---

### 6.3 Recomandări

**Navigation position:** 4
**URL root:** /recomandari
**Purpose:** Collect and display trust signals from two distinct sources — professional endorsements from colleague physicians, and experiences shared by patients — and provide a mechanism for patients to contribute their own experience.

**This is a single page with three sections in fixed order:**

```
/recomandari
│
├── Section 1 — Recomandări din partea colegilor medici
├── Section 2 — Experiențele pacienților
└── Section 3 — Trimiteți-vă experiența
```

The order is deliberate and non-negotiable. It creates a trust funnel:
1. Professional credibility establishes that peers trust the doctor
2. Patient experiences show that patients have been cared for well
3. The submission form invites the visitor to contribute their own story

**Section 1 — Recomandări din partea colegilor medici**

Endorsements FROM colleague physicians, ABOUT Dr. George Ungureanu. These are not recommendations the doctor makes to patients — they are recommendations of the doctor, made by his medical peers.

Entry structure (per colleague):
- Doctor photo (professional portrait)
- Full name
- Specialty
- Institution / hospital affiliation
- Professional relationship or context with Dr. Ungureanu (1 sentence — e.g., "Colaborare directă timp de 8 ani în cadrul Spitalului X")
- Recommendation text (2–4 sentences in the colleague's voice)

Management: admin-managed. Entries are added and updated directly in Elementor by a delegated administrator. Colleague doctors do not submit entries through any public form. Content sourced by Dr. Ungureanu from his professional relationships.

No public form. No automation. No CPT. Elementor-only.

**Section 2 — Experiențele pacienților**

Approved patient testimonials, displayed in the order they were approved (most recent first). Each entry shows: prenume, afecțiunea tratată, testimonial text. No star ratings.

These entries come from the approval workflow (Section 3 below). They are stored in the Testimoniale Custom Post Type and queried dynamically. The section remains hidden until at least 2 approved entries exist.

**Section 3 — Trimiteți-vă experiența**

Patient submission form. Four fields:

| Field | Label | Type | Required |
|-------|-------|------|---------|
| 1 | Prenume | Text | Yes |
| 2 | Afecțiunea tratată | Text | Yes |
| 3 | Experiența dvs. | Textarea | Yes |
| 4 | Consimțământ GDPR | Checkbox | Yes |

On submit: WordPress creates a Testimoniale CPT entry with status `pending`. Admin receives email notification. Patient sees a success message (not a redirect): "Vă mulțumim. Mesajul dvs. va fi revizuit și publicat în curând."

**Approval workflow:**

```
Patient submits form on /recomandari
        ↓
WordPress creates Testimoniale CPT entry (status: pending)
        ↓
Admin receives email: "Testimonial nou în așteptare" + review link
        ↓
Admin opens entry in WordPress → Testimoniale panel
        ↓
Approves → status: publish → entry appears in Section 2 of /recomandari
  OR
Rejects → remains pending / deleted — never published
```

**Cross-page presence of approved testimonials:**
- Homepage Section 6 (organism-patient-testimonials): built hidden in Phase 3; unhidden when ≥ 2 approved entries exist
- Despre page: built hidden in Phase 5; unhidden simultaneously with homepage
- /recomandari Section 2: live as soon as ≥ 2 approved entries exist

All three surfaces query the same Testimoniale CPT source. No content duplication.

**Full page section map:**

| # | Section | Content | Background |
|---|---------|---------|-----------|
| 1 | Hero | organism-hero-interior — H1 + breadcrumb + lead | color-surface-warm |
| 2 | Colleague endorsements | Admin-managed Elementor content | color-surface |
| 3 | Patient experiences | organism-patient-testimonials (Testimoniale CPT) | color-surface-warm |
| 4 | Submit experience | Elementor Form widget | color-surface |
| 5 | CTA Banner | organism-cta-banner → /programari | color-ink |

**Breadcrumb:** Acasă → Recomandări

---

### 6.4 Despre Dr. George Ungureanu

**Navigation position:** 5
**URL root:** /despre
**Purpose:** The patient's introduction to Dr. Ungureanu as a human being and clinician. The page must answer the question "Who is this doctor and can I trust him?" — and answer it with warmth, not with a CV.

**Page section map:**

| # | Section | Purpose | Background |
|---|---------|---------|-----------|
| 1 | Hero | organism-hero-interior — page title + specialty | color-surface-warm |
| 2 | Doctor Introduction | organism-doctor-intro — biography + portrait | color-surface |
| 3 | Approach to Care | organism-philosophy-statement — values in doctor's voice | color-surface-warm |
| 4 | Professional Timeline | molecule-timeline (visual) | color-surface |
| 5 | Specializations | organism-credentials-list group 1 | color-surface-warm |
| 6 | Academic Publications | organism-credentials-list group 2 | color-surface |
| 7 | Memberships & Affiliations | organism-credentials-list group 3 | color-surface-warm |
| 8 | CTA Banner | organism-cta-banner → /programari | color-ink |

**The professional timeline (Section 4):**

The timeline is a visual component — not a CV list. It uses `molecule-timeline`, a new component built in Phase 5. The distinction matters: a CV is a document for peers; a timeline is a story for patients.

Timeline architecture:
- Vertical layout with a visual connector between entries (vertical line — atom-divider variant)
- Each entry: year marker (overline style) + event title (H4) + institution (body-sm) + optional note (body-sm)
- Chronological order, earliest to most recent
- Mobile: single-column stack, year above title

Timeline content categories (all required — content provided by Dr. Ungureanu):

| Category | Content examples |
|----------|----------------|
| Medical education | Facultate, licență, masterat — institution, city, years |
| Residency | Rezidențiat — specialization, institution, years |
| International exchanges | Host institution, program, duration, country |
| Continuing education | Relevant courses — institution, year |
| Certifications | Certificări, atestate — issuing body, year |
| Academic positions & work | Hospital affiliations, teaching roles, research activity |
| Founding of Sfatul Neurochirurgului | Date and origin context — the launch of this educational platform |

The founding of Sfatul Neurochirurgului is an explicit timeline entry. It signals to patients that the doctor's commitment to patient education is not incidental — it has a history and an origin.

**Biography requirements (organism-doctor-intro):**
- 3–4 paragraphs, third-person, warm — not a CV recitation
- Must include: why he chose neurosurgery; what drives his approach to patients; what patients can expect from him
- Portrait: warm, approachable photography — not clinical or formal

**Philosophy statement requirements (organism-philosophy-statement):**
- 3–4 values or principles
- Written in first person, in the doctor's own voice
- Example register: "Cred că fiecare pacient merită să înțeleagă exact ce se întâmplă în corpul lui."

**Manifesto compliance test for this page (applied before launch):**
1. "I understand this." — biography is readable by a non-medical adult
2. "This was written for me." — page does not feel like a peer-facing CV
3. "I know what to do next." — CTA banner is present and routes correctly
4. "I feel more confident, not more confused." — credentials section does not overwhelm

**Patient testimonials on this page:**
- organism-patient-testimonials built hidden in Phase 5
- Unhidden simultaneously with homepage Section 6 when ≥ 2 approved Testimoniale CPT entries exist (Phase 6)
- Placement: between Section 7 (Memberships) and Section 8 (CTA Banner)

**Breadcrumb:** Acasă → Despre Dr. George Ungureanu

---

## 7. Transactional Pages

### 7.1 Programări (/programari)

**How reached:** Primary CTA ("Programează o consultație") from every page — not navigable from the menu.
**Purpose:** Remove geographic uncertainty before the patient commits to contact. A patient who does not know whether this doctor is accessible to them will not book an appointment. This page eliminates that barrier.

The page must enable a patient to answer four questions before they take action:
1. **Where?** — Which city, which clinic or hospital
2. **Is it accessible?** — Address, parking, floor, accessibility
3. **When?** — Days and hours at this specific location
4. **How?** — The exact next step to book

**Page section map:**

| # | Section | Purpose | Background |
|---|---------|---------|-----------|
| 1 | Hero | organism-hero-interior — H1, breadcrumb, lead | color-surface-warm |
| 2 | Location directory | organism-location-directory — location cards | color-surface |
| 3 | How it works | organism-how-it-works — contextual /programari variant | color-surface-warm |
| 4 | CTA Banner | organism-cta-banner — single CTA → /contact | color-ink |

**CTA rule — unique to /programari:**
The CTA banner on this page has exactly one button: "Contactați-ne" → /contact. There is no secondary CTA. No button on this page routes back to /programari. This rule is enforced absolutely.

Full routing chain:
```
Any page → "Programează o consultație" → /programari → "Contactați-ne" → /contact
```

**Breadcrumb:** Acasă → Programări

---

### 7.2 Contact (/contact)

**How reached:** "Contactați-ne" button on /programari — and only from /programari.
**Purpose:** Receive the appointment request and route it to Dr. Ungureanu or a delegated administrator.

**Page section map:**

| # | Section | Purpose | Background |
|---|---------|---------|-----------|
| 1 | Hero | organism-hero-contact — H1, phone, email | color-surface-warm |
| 2 | Contact form | organism-contact-form — appointment request | color-surface |
| 3 | What Happens Next | 3-step process (atoms + molecules) | color-surface-warm |

**Form fields:**

| Field | Type | Required |
|-------|------|---------|
| Nume | Text | Yes |
| Email | Email | Yes |
| Telefon | Tel | Yes |
| Motivul contactului | Textarea | No |
| Consimțământ GDPR | Checkbox | Yes |

Success state: inline success message — not a redirect. GDPR checkbox links to /politica-de-confidentialitate.

"What Happens Next" 3 steps: Trimiteți formularul → Vă contactăm în 24 de ore → Stabilim programarea împreună.

**Breadcrumb:** Acasă → Contact

---

## 8. Supporting Pages

### 8.1 Informații pentru pacienți (/pacienti)

**How reached:** Contextual links from condition pages, article pages, and the footer navigation.
**Purpose:** Dedicated patient preparation resource — for patients who have already made an appointment and need practical guidance.

**Page section map:**

| # | Section | Purpose | Background |
|---|---------|---------|-----------|
| 1 | Hero | organism-hero-interior | color-surface-warm |
| 2 | Before Your Appointment | What to bring; how to prepare | color-surface |
| 3 | During Treatment | organism-patient-journey — what to expect | color-surface-warm |
| 4 | Recovery & Follow-up | Timeline; what to expect post-procedure | color-surface |
| 5 | FAQ | organism-faq — general patient questions | color-surface-warm |
| 6 | CTA Banner | organism-cta-banner → /programari | color-ink |

**Breadcrumb:** Acasă → Informații pentru pacienți

---

### 8.2 Legal Pages

**Privacy Policy (/politica-de-confidentialitate)**
- Required under GDPR before the footer, contact form, and testimonial form can go live
- Text provided by Dr. Ungureanu or legal counsel
- No template or design complexity — body text only
- Linked from: footer legal strip, contact form GDPR checkbox, testimonial form GDPR checkbox

**Cookie Policy (/cookies)**
- Conditional: required only if analytics or tracking is used (Q12/Q21)
- If no analytics: page is not created; footer Cookie-uri link is omitted
- Text provided by Dr. Ungureanu or legal counsel

---

## 9. CTA Routing Rules

These rules are absolute. No exception requires a new decision — it requires updating this document first.

### Universal primary CTA

Every page on the site (except /programari and /contact) has at least one primary CTA labeled "Programează o consultație". All instances route to /programari.

```
Any page → "Programează o consultație" → /programari
```

### /programari exception

The CTA banner on /programari has exactly one button labeled "Contactați-ne", routing to /contact. No other destination is permitted from this button.

```
/programari → "Contactați-ne" → /contact
```

### /contact rule

/contact has no outbound CTA button. It is the destination, not a waypoint.

### No direct routing to /contact

No page on the site except /programari routes directly to /contact. The purpose of this rule is to ensure that every patient who intends to make contact passes through /programari first and sees where Dr. Ungureanu can be seen. A patient who contacts without this context is less likely to follow through.

### Afecțiuni condition page routing

Each individual condition page ends with organism-appointment-cta. The primary button routes to /programari (not to /contact directly, and not to a condition-specific contact form).

### Sfatul Neurochirurgului article routing

Each individual article ends with organism-appointment-cta. The primary button routes to /programari.

### /recomandari routing

CTA banner routes to /programari.

### /despre routing

CTA banner routes to /programari.

### Summary routing table

| From | CTA label | Destination |
|------|-----------|-------------|
| Homepage | Programează o consultație | /programari |
| /afectiuni | Programează o consultație | /programari |
| /afectiuni/[slug] | Programează o consultație | /programari |
| /sfatul-neurochirurgului | Programează o consultație | /programari |
| /sfatul-neurochirurgului/[slug] | Programează o consultație | /programari |
| /recomandari | Programează o consultație | /programari |
| /despre | Programează o consultație | /programari |
| /pacienti | Programează o consultație | /programari |
| /programari | Contactați-ne | /contact |
| /contact | — (no outbound CTA) | — |

---

## 10. URL Scheme

### Conventions

- All slugs in Romanian
- Lowercase, hyphenated — no underscores, no diacritics in slugs
- Diacritice (ă, â, î, ș, ț) are omitted from slugs to avoid encoding issues
  - Afecțiuni → /afectiuni
  - Sfatul Neurochirurgului → /sfatul-neurochirurgului
  - Recomandări → /recomandari
  - Programări → /programari
  - Politica de confidențialitate → /politica-de-confidentialitate
- No trailing slashes enforced at application level
- Canonical form: non-www (georgeungureanu.doctor, not www.georgeungureanu.doctor) — unless Q confirms otherwise

### Slug register

| Page | Slug |
|------|------|
| Homepage | / |
| Afecțiuni overview | /afectiuni |
| Individual condition | /afectiuni/[condition-slug] |
| Sfatul Neurochirurgului hub | /sfatul-neurochirurgului |
| Individual article | /sfatul-neurochirurgului/[article-slug] |
| Recomandări | /recomandari |
| Despre Dr. George Ungureanu | /despre |
| Programări | /programari |
| Contact | /contact |
| Informații pentru pacienți | /pacienti |
| Privacy Policy | /politica-de-confidentialitate |
| Cookie Policy | /cookies |

### Child page slug conventions

**Condition pages** — readable patient-facing slug, not Latin term:
- Hernii de disc → /afectiuni/hernie-de-disc
- Tumori cerebrale → /afectiuni/tumori-cerebrale
- Stenoza de canal → /afectiuni/stenoza-de-canal

**Article pages** — derived from article title, truncated to ~60 characters:
- "Ce trebuie să știi înainte de o operație pe coloană" → /sfatul-neurochirurgului/ce-trebuie-sa-stii-inainte-de-operatie-pe-coloana

---

## 11. Content Types

### Static pages (Elementor)

Pages built and maintained entirely in the Elementor editor. Updated manually by admin.

| Page | Type |
|------|------|
| Homepage | Static |
| /afectiuni | Static |
| /recomandari (colleague recommendations section) | Static |
| /despre | Static |
| /programari | Static |
| /contact | Static |
| /pacienti | Static |
| /politica-de-confidentialitate | Static |
| /cookies | Static |

### Templated content (repeatable structure)

Pages that share a fixed section structure and are created using the same template. Each instance has unique content.

| Type | Parent | Template |
|------|--------|---------|
| Individual condition page | /afectiuni | Condition page template (8 sections) |
| Individual article page | /sfatul-neurochirurgului | Article page template (4 sections) |

### Dynamic content (Custom Post Type)

Content that enters via a submission form or automation pipeline and is managed through WordPress's post management interface.

| CPT | Name | Status flow | Display |
|-----|------|-------------|---------|
| Testimoniale | Patient testimonials | pending → publish | /recomandari Section 2, Homepage Section 6, /despre |

### Automated draft content (Make pipeline)

WordPress Posts created by Make from social media source content. These use the standard WordPress Posts post type with the category `sfatul-neurochirurgului`. They enter as drafts and are published manually.

| Source | Content type | Category | Status on creation |
|--------|-------------|----------|--------------------|
| Instagram | Image post + caption | Sfatul Neurochirurgului | Draft |
| Facebook | Text/image post | Sfatul Neurochirurgului | Draft |
| YouTube | Video + description | Sfatul Neurochirurgului | Draft |

---

## 12. Breadcrumb Hierarchy

Breadcrumbs appear on all interior pages via molecule-breadcrumb. They are not shown on the homepage.

```
/afectiuni                 Acasă → Afecțiuni
/afectiuni/[slug]          Acasă → Afecțiuni → [Condition Name]
/sfatul-neurochirurgului   Acasă → Sfatul Neurochirurgului
/sfatul-neurochirurgului/[slug]  Acasă → Sfatul Neurochirurgului → [Article Title]
/recomandari               Acasă → Recomandări
/despre                    Acasă → Despre Dr. George Ungureanu
/programari                Acasă → Programări
/contact                   Acasă → Contact
/pacienti                  Acasă → Informații pentru pacienți
```

Each breadcrumb uses `aria-current="page"` on the final (current) item. The breadcrumb `<nav>` element uses `aria-label="Breadcrumb"`.

---

## 13. Primary User Journeys

These are the five paths that the IA is designed to support. All paths end at /contact.

### Journey 1 — The patient researching a condition

```
/ (Homepage)
  → Section 3: Afecțiuni grid → /afectiuni
  → /afectiuni/[condition]
  → "Programează o consultație" → /programari
  → "Contactați-ne" → /contact
```

Entry point: a patient searching for information about a specific condition. They find the condition on the homepage or in /afectiuni, read the condition page, and convert.

### Journey 2 — The patient evaluating the doctor

```
/ (Homepage)
  → Section 4: Doctor teaser → /despre
  → Timeline, biography, philosophy
  → "Programează o consultație" → /programari
  → "Contactați-ne" → /contact
```

Entry point: a patient who has heard of the doctor and wants to know who he is before committing to contact.

### Journey 3 — The patient looking for social proof

```
/ (Homepage)
  → Navigation: Recomandări → /recomandari
  → Section 1: Colleague endorsements
  → Section 2: Patient experiences
  → "Programează o consultație" → /programari
  → "Contactați-ne" → /contact
```

Entry point: a patient who wants to know whether this doctor is trusted by both peers and other patients before taking action.

### Journey 4 — The patient consuming educational content

```
/ (Homepage)
  → Section 8: Sfatul Neurochirurgului → /sfatul-neurochirurgului
  → /sfatul-neurochirurgului/[article]
  → "Programează o consultație" → /programari
  → "Contactați-ne" → /contact
```

Entry point: a patient browsing for advice or educational content who reads an article and is then moved to take action.

### Journey 5 — The pre-appointment patient (returning user)

```
/ (Homepage)
  → Navigation: Sfatul Neurochirurgului → /sfatul-neurochirurgului
     or
  → Footer: Informații pentru pacienți → /pacienti
  → Pre-appointment FAQ, recovery guidance
  → (No CTA conversion needed — patient already has appointment)
```

Entry point: a patient who has already booked and is returning to prepare. This journey does not end at /contact — it ends when the patient has the information they need.

---

## 14. Blocking Dependencies

The following questions must be answered by Dr. Ungureanu before the information architecture can be fully implemented. These are architectural blockers — they affect page creation, navigation, and routing, not just content.

| Q# | Question | Blocks |
|----|----------|--------|
| Q13 | Location data (clinic names, addresses, visit types, schedules, Maps URLs per location) | /programari cannot be built; molecule-location-card cannot be created |
| Q15 | Patient-facing phone number | Footer Column 1, organism-hero-contact on /contact |
| Q16 | Email address | Footer Column 1, /contact form routing, Make notifications |
| Q20 | Privacy policy text and legal review | /politica-de-confidentialitate; footer and forms cannot go live without it |
| Q24 | Colleague doctor recommendation entries (names, specialties, institutions, photos, texts) | /recomandari Section 1 cannot be populated |
| Q4 | Full condition list with patient-readable names | /afectiuni grid and individual pages cannot be created |
| Q9 | Minimum 3 articles for Sfatul Neurochirurgului | /sfatul-neurochirurgului hub and homepage Section 8 cannot go live |
| Q18 | Social media account confirmation and API access | Make automation pipeline cannot be configured; footer social links cannot be set |
| Q25 | Make account registered; API quotas confirmed per platform | Phase 8 automation pipeline cannot begin |
| Q7 | Doctor photography (hero image + approachable portrait) | Homepage hero, /despre biography section cannot go live |
| Q1 | List of acute-presentation conditions requiring emergency notice | organism-emergency-notice cannot be deployed on the correct pages |
| Q2 | Patient testimonial availability | Superseded by Phase 6 submission form workflow — no longer a manual collection question |

---

*IA version: 1.0 — 2026-06-28*
*Source: docs/tasks/00_PROJECT_ROADMAP.md v1.1*
*Next: docs/tasks/02_CONTENT_MODELS.md*
