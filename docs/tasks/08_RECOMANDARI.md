# Recomandări

## georgeungureanu.doctor

**Purpose of this document:** Freeze the complete /recomandari page before implementation. Every section, its order, its content model, its moderation workflow, and the principles governing how trust is built and protected are locked here.

**Governing constraint:** This page is not a review platform. It does not aggregate scores, rank the doctor against peers, or function as a consumer ratings mechanism. It exists to make one thing possible: a patient who does not know Dr. Ungureanu can encounter, in a structured and authentic form, the professional trust of medical colleagues and the genuine experiences of other patients who have already been in that position.

**Source of truth:**
- `docs/tasks/00_PROJECT_ROADMAP.md` v1.1
- `docs/tasks/01_INFORMATION_ARCHITECTURE.md` v1.0
- `docs/tasks/02_CONTENT_MODELS.md` v1.0
- `docs/tasks/03_HEADER_AND_NAVIGATION.md` v1.0
- `docs/tasks/04_DESIGN_SYSTEM_TOKENS.md` v1.0
- `docs/tasks/05_HOMEPAGE.md` v1.0
- `docs/tasks/06_PROGRAMARI.md` v1.0
- `docs/tasks/07_DESPRE.md` v1.0
- `docs/project/PATIENT_CENTERED_MANIFESTO.md`
- `docs/project/WEBSITE_GOALS.md`
- `docs/project/TARGET_AUDIENCE.md`
- `docs/content/CONTENT_TONE.md`
- `docs/design-system/BRAND_GUIDELINES.md`

---

# 1. Purpose of the Recommendations Page

## 1.1 Why This Page Appears Before /despre in the Navigation

The navigation order is: Acasă → Afecțiuni → Sfatul Neurochirurgului → **Recomandări** → Despre Dr. George Ungureanu → [Programează o consultație].

/recomandari precedes /despre. This is not alphabetical order, not implementation order, and not an accident. It is a deliberate decision about how trust is built in the mind of a patient evaluating a doctor they have never met.

A patient who visits /recomandari before /despre encounters trust signals from people other than the doctor himself — professional peers who have worked alongside him and patients who have been in the patient's own position. These signals arrive before the doctor's self-presentation. By the time the patient reaches /despre, professional and social trust has already begun to form. The doctor's own biography and credentials are read through that existing trust — which makes them land with considerably more weight.

The reverse ordering would be: doctor presents himself → then others confirm what he said. That is the structure of a reference section appended to a CV. The current ordering is: others speak first → then the doctor's own voice. That is the structure of a trusted introduction.

## 1.2 Why Trust from Other Physicians Matters

A patient evaluating a neurosurgeon cannot directly assess clinical competence. They do not have the training to evaluate surgical technique, diagnostic judgment, or procedural outcomes. What they can evaluate — and what they implicitly look for — is whether the doctor is trusted by people who can assess those things.

When a neurologist, a GP, or a colleague neurosurgeon says — by name, with professional attribution, in specific language — "I refer my patients to Dr. Ungureanu because of his approach to spinal cases and his willingness to explain options before proceeding," that is a form of quality signal that a credential list cannot produce.

The colleague recommendation is not a testimonial — it is a professional vouching. The person providing it has clinical knowledge, has a professional reputation of their own at stake, and is making a specific statement about a specific professional relationship. That specificity is what gives it weight.

## 1.3 Why Patient Experiences Matter

A patient evaluating a doctor needs to know two things that no credential demonstrates: *what is it like to be his patient?* and *do other patients like me feel they were cared for?*

Patient experiences answer these questions in a form that a frightened patient can receive: first-person, plain language, human, specific. Not "excellent outcomes" — but "he took time to explain the diagnosis three times, in three different ways, until I understood what was going to happen."

These experiences are distinct from reviews precisely because they are not ratings — they are accounts. They do not produce a score. They do not position the doctor in a competitive ranking. They place the patient's experience in words and make it available to other patients who are in that same moment of uncertainty.

## 1.4 Why Recommendations Are Different from Commercial Reviews

Commercial reviews — Google reviews, Trustpilot, star ratings — are built for a commercial evaluation context. The patient is the consumer. The doctor is the product. A 4.7-star rating means: in aggregate, this product is preferred by 94% of buyers who rated it.

This framing is wrong for a neurosurgical consultation in every way that matters to a patient:
- Conditions that require neurosurgery are not products to be purchased
- Patients are not consumers making a reversible buying decision
- Star aggregation erases context — a patient who gave 3 stars because they waited 40 minutes and a patient who gave 3 stars because their condition was not treated as intended are not the same signal
- The act of rating a medical consultation on a 1–5 scale implies that outcomes can be judged by the same mechanism used to rate a hotel room

The /recomandari page refuses this framing. It presents specific, contextualized, attributed human experiences — from physicians and from patients — without reduction to a number. A patient reading this page encounters other people; they do not encounter a consumer aggregate.

## 1.5 Emotional Goals

**Primary:** A patient who reads this page should feel: *I am not the first person to be in this position. Others came before me, encountered this doctor, and speak well of the experience. I am not alone in choosing to trust him.*

**Secondary emotional goals:**
- Reduction of the "What if I chose wrong?" anxiety — peer and patient validation reduces the fear of making a bad decision
- Recognition of their own situation in the patient experiences — seeing specific conditions mentioned, seeing authentic emotional language, recognizing the fear they feel in someone else's account of having felt it and come through
- Confidence that the doctor is trusted by the medical community — professional peer endorsements are especially reassuring for patients who arrived through a referral and want to confirm that the referring doctor's judgment is sound

## 1.6 Educational Goals

The /recomandari page indirectly educates:
- Through the colleague recommendations: what conditions and situations prompt specialist referrals from GPs and neurologists; what subspecialty differentiation within neurosurgery means to a referring physician
- Through patient experiences: what the consultation and care experience actually involves, from the patient's perspective; what aspects of the experience other patients found most meaningful
- Through the submission form: that this is a practice that values patient feedback, that the submission process is transparent, and that patient voices are reviewed by a human before publication

## 1.7 Credibility Goals

- Professional credibility: The colleague recommendations establish that this doctor is trusted by identifiable professionals with named specialties and institutional affiliations
- Experiential credibility: The patient experiences establish that the doctor's patient-centered approach is not merely stated in his biography — it is experienced by the people who have sat across from him
- Transparency credibility: The visible moderation process (explicit on the submission form) establishes that the page is curated, not automatic — which makes the content that appears here more trustworthy, not less

---

# 2. Information Architecture

## 2.1 Page Section Map

| # | Section | Component | Background | Visibility |
|---|---------|-----------|-----------|-----------|
| — | Header | `organism-site-header` | `color-surface` | Always |
| 1 | Hero | `organism-hero-interior` | `color-surface-warm` | Always |
| 2 | Introductory explanation | Inline atoms | `color-surface` | Always |
| 3 | Recomandări din partea colegilor medici | Admin-managed Elementor content | `color-surface-warm` | Hidden until ≥1 active entry (Q24) |
| 4 | Experiențele pacienților | `organism-patient-testimonials` (full) | `color-surface` | Hidden until ≥2 approved Testimoniale CPT entries |
| 5 | Împărtășește experiența ta | Elementor Form widget (testimonial) | `color-surface-warm` | Always — form is always present |
| 6 | Final CTA | `organism-cta-banner` | `color-ink` | Always |
| — | Footer | `organism-site-footer` | `color-ink` | Always |

**Background alternation:** warm → surface → warm → surface → warm → ink. No two adjacent sections share a background.

**Breadcrumb:** "Acasă → Recomandări" — molecule-breadcrumb on hero section, with `aria-current="page"` on "Recomandări".

## 2.2 Purpose of Each Section

**Section 1 — Hero:** Establishes what this page is and who it is for. The H1 names the page for patients, not for search engines. A brief lead confirms: this page contains professional recommendations from colleagues and experiences from patients — not a rating system.

**Section 2 — Introductory explanation:** 80–120 words. Explains the two types of content on this page, why they are presented in this order, and why they are curated rather than aggregated. Sets the expectation that what follows is specific and human, not statistical.

**Section 3 — Recomandări din partea colegilor medici:** Professional endorsements from identified physicians who have worked with, referred to, or collaborated with Dr. Ungureanu. Admin-managed only. No public submission path. The first and most credibility-establishing section.

**Section 4 — Experiențele pacienților:** Approved patient testimonials, in the patients' own words. Dynamic content from the Testimoniale CPT. Built hidden at launch; revealed when ≥2 approved entries exist. All entries reviewed and approved by an administrator before publication.

**Section 5 — Împărtășește experiența ta:** The patient submission form. Always present — the mechanism for growing Section 4 over time. Separate from the contact form (`organism-contact-form`). Creates a Testimoniale CPT entry with status `pending` on submission. The patient sees a success message, not a redirect.

**Section 6 — Final CTA:** "Programează o consultație" → /programari. Standard CTA banner. The patient who has read through the recommendations and experiences has been through the full trust-building journey — the CTA is the natural next step.

---

# 3. Hero Section

**Organism:** `organism-hero-interior`
**Background:** `color-surface-warm` (`#F4EFE6`)
**Position:** Section 1 — always visible

## 3.1 Required Elements

| Element | Specification |
|---------|--------------|
| Breadcrumb | "Acasă → Recomandări" with `aria-current="page"` on current label |
| Overline | Short category identifier — "RECOMANDĂRI" in `atom-overline` style |
| H1 | Page title. Names the page for patients clearly. Example register: "Ce spun colegii și pacienții." Final copy from Dr. Ungureanu. |
| Lead text | 1–2 sentences. Explains that this page contains professional colleague recommendations and authentic patient experiences. Warm, direct. |
| CTA | `atom-button-primary` → /programari, "Programează o consultație" |

The hero of /recomandari does not use photography — unlike the homepage hero or the /despre hero, this page is not about the doctor's presence. It is about others' voices. The hero is text-focused: clean, editorial, and clear about what the patient is about to encounter.

## 3.2 What the Hero Does Not Contain

| Forbidden | Reason |
|-----------|--------|
| Star ratings | This is the exact commercial review framing this page refuses |
| Review counts ("250+ reviews") | Reduces human experiences to a volume metric |
| Average scores | Creates a consumer-rating context incompatible with this page's purpose |
| Statistics ("98% satisfaction") | Unverifiable, manipulable, and incompatible with the page's trust model |
| Marketing language ("Trusted by hundreds") | Generic; this page's strength is specificity, not volume |
| Photography of patients | Privacy; patient photographs are not used on this site |
| Doctor photography | This page is for other voices, not the doctor's visual presence |

---

# 4. Introductory Section

**Background:** `color-surface` (`#FDFBF7`)
**Position:** Section 2 — always visible
**Length:** 80–120 words

## 4.1 Purpose

Before the patient encounters the first colleague recommendation or patient experience, they benefit from a brief orientation: what they are about to read, why it is organized this way, and why the content is curated rather than automatically published.

This orientation matters because:
- A patient who does not understand why colleague recommendations precede patient experiences may assume the ordering is arbitrary
- A patient who does not know that patient experiences are reviewed before publication may be uncertain whether the content is authentic or selected to create a favorable impression — a brief statement of the moderation process resolves this uncertainty and increases trust
- A patient who understands that colleague recommendations come from identified professionals, not anonymous reviewers, is prepared to read them with the appropriate weight

## 4.2 Content Themes

The introductory text addresses three points, briefly:

1. **Why professional colleague recommendations appear first:** Professionals with medical training, who have professional relationships with Dr. Ungureanu, speak from a perspective of clinical knowledge. Their endorsements are addressed to patients — but grounded in professional observation.

2. **Why patient experiences are curated:** Every patient experience on this page was submitted through the form on this page, reviewed by the practice team, and published after review. This is not a process designed to hide negative experiences — it is a process designed to ensure that what appears here is genuine, respectful, and appropriate for other patients to read.

3. **That patients can contribute:** The section ends with a brief forward reference to the submission form below — inviting the reader to share their own experience if they have one.

**Draft register (not final copy):** "Această pagină reunește două tipuri de mărturii: recomandările colegilor medici care lucrează alături de sau îndrumă pacienți către Dr. Ungureanu, și experiențele pacienților care au ales să le împărtășească. Fiecare mesaj al pacienților este revizuit înainte de publicare. Nu calculăm medii, nu acordăm stele — lăsăm oamenii să vorbească."

---

# 5. Colleague Recommendations

**Position:** Section 3
**Background:** `color-surface-warm` (`#F4EFE6`)
**Management:** Admin-managed only — entries are added and updated directly in Elementor by a delegated administrator
**Visibility:** Hidden until ≥1 active entry exists. When hidden, no placeholder is shown — the section is absent from the page.

## 5.1 What These Are

Colleague recommendations are endorsements FROM identified medical professionals, ABOUT Dr. George Ungureanu, for the benefit of patients evaluating him.

They are not:
- Reviews submitted by anonymous physicians
- Generic testimonials about working in medicine
- Marketing quotes extracted from emails without context

They are:
- Named, photographed professionals who have professional relationships with Dr. Ungureanu
- Specific statements about why they refer patients to him, work alongside him, or collaborate with him professionally
- Grounded in a named professional relationship — "I refer spinal patients from my neurology practice" — not floating praise

## 5.2 Administration

**Doctors do not submit content through the website.** There is no public form, no registration, no automated workflow for colleague recommendations.

The process is entirely offline:
1. Dr. Ungureanu identifies colleagues who are willing to provide a recommendation
2. The colleague's content (photograph, statement, professional details) is collected through direct communication
3. An administrator enters the content directly into Elementor on the /recomandari page
4. Dr. Ungureanu reviews the published entry before the page is made public

This offline management is intentional:
- It prevents gaming — no physician can submit an unsolicited recommendation
- It ensures quality — every entry meets the required fields and tone standards before publishing
- It protects professional relationships — the colleague has explicitly consented to being named and attributed

## 5.3 Required Fields (per entry — entry cannot be published without all)

| Field | Content | Notes |
|-------|---------|-------|
| Professional photograph | Portrait-quality photograph of the colleague physician | Must be provided by the colleague, not sourced from social media or institutional websites without permission |
| Full name | "Dr. [Prenume] [Nume]" | Exactly as the colleague wishes to be identified professionally |
| Specialty | Professional specialty designation | "Medic Neurolog", "Medic de Familie", etc. — in the colleague's own professional designation |
| Institution | Current primary institutional affiliation | Hospital or clinic name, city — the institution where this physician primarily practices |
| Professional relationship / context | 1 sentence describing the professional relationship with Dr. Ungureanu | Examples: "Colaborare directă în cadrul [Institution], timp de [X] ani" / "Medic de familie cu pacienți îndrumați periodic către Dr. Ungureanu" / "Colegi în cadrul rezidențiatului la [Institution]" |
| Recommendation text | 60–200 words in the colleague's voice | Specific, personal, professional. Names what they observe, what they rely on, why they refer |

## 5.4 What Makes an Entry Trustworthy

The specificity of each entry is what creates trust. The following contrasts illustrate the standard:

**Generic (insufficient):**
*"Dr. Ungureanu este un neurochirurg excellent, cu o abordare profesionistă față de pacienți. Îl recomand cu toată încrederea."*

This says nothing specific. It could describe any doctor. It provides no evidence of a genuine professional relationship.

**Specific (required standard):**
*"Colaborez cu Dr. Ungureanu de peste șase ani, îndrumând cazuri de disc herniat cervical și tumori vertebrale din practica mea de neurologie. Ceea ce apreciez în mod special este că primesc întotdeauna o scrisoare de consult detaliată după fiecare consultație — pacienții se întorc informați și cu un plan clar. Acesta este tipul de comunicare interspecialitate care face diferența pentru pacient."*

This entry names the specialty relationship, the years of collaboration, the types of cases referred, and a specific observation about professional behavior. It is evidence of a real professional relationship.

## 5.5 Desktop Layout

**Layout:** Vertical stack of full-width entries on desktop for 1–4 entries. For 5+ entries, 2-column grid on desktop (1280px+), 1-column on narrower viewports.

**Design consideration for 10–30 entries:** At 30 colleague recommendation entries, a single-column vertical stack becomes a very long page section. A 2-column grid (entries side by side) is appropriate at desktop viewport widths above 1025px. The grid maintains the full content of each entry — no content is truncated or hidden behind an expand interaction in Phase 1.

**Entry card structure (desktop):**
```
[Portrait — 80×80px, radius-avatar (50%)] [Name — type-h4]
                                           [Specialty — type-body-sm]
                                           [Institution — type-body-sm, color-ink-secondary]
                                           [Professional context — type-body-sm, italic]
[Recommendation text — type-body, left-aligned, full width below portrait row]
```

The portrait is positioned left; name, specialty, institution, and context appear to the right of the portrait in a flex row. The recommendation text appears below the attribution row, spanning the full card width. This layout gives the recommendation text maximum reading space — it is the most important content in the entry.

**Card background:** `color-surface` — slightly elevated from the `color-surface-warm` section background. Border: 1px `color-border`. Radius: `radius-card` (8px). Padding: `space-8` (32px) desktop.

**Section header above entries:**
- Overline: "RECOMANDĂRI PROFESIONALE"
- H2: "Recomandări din partea colegilor medici"
- Brief descriptor (1 sentence): What these are and why they are listed

## 5.6 Mobile Layout

On mobile (<768px):
- Single column, full-width cards
- Portrait: 64×64px, left-aligned
- Attribution (name, specialty, institution) to the right of portrait
- Professional context: below the attribution row
- Recommendation text: below professional context, full width
- Card padding: `space-6` (24px)
- Card gap between entries: `space-4` (16px)

## 5.7 Ordering Principles

Entries are ordered by `display_order` — a field set by the administrator. Lower display_order values appear first.

**Default ordering guidance for Dr. Ungureanu:**
1. Entries representing the most common referral relationships (GP and neurologist referrals first — these are closest to the patient's experience of being referred)
2. Entries from colleagues at primary affiliated institutions
3. Entries from colleagues in complementary specialties
4. Entries representing longer professional relationships before shorter ones

No alphabetical ordering. No ordering by specialty. The ordering is editorial — it reflects which perspectives are most useful to the patient arriving at this page.

## 5.8 Trust Mechanisms

What makes this section build genuine trust (rather than the appearance of trust):

- **Named and photographed:** Anonymous endorsements prove nothing. A named physician with a photograph and an institutional affiliation has put their professional reputation behind the statement.
- **Professional relationship stated:** The context field ("Colaborare directă timp de 8 ani") grounds the recommendation in something verifiable. A patient who knows their GP refers to Dr. Ungureanu can recognize the type of relationship described.
- **Specific observation:** Recommendations that name specific behaviors, outcomes, or approaches ("întotdeauna primesc o scrisoare de consult detaliată") are more credible than recommendations that describe general virtues.
- **Absence of superlatives:** Entries that avoid "cel mai bun" or "excepțional" in favor of specific professional observations read as more credible. Superlatives are marketing language; specific observations are evidence.

## 5.9 Accessibility Considerations

- Each colleague recommendation entry is wrapped in an `<article>` element or a `role="article"` container
- The colleague's name is the primary label for each article — the portrait photograph has `alt="Fotografia Dr. [Prenume] [Nume]"`
- The portrait is decorative in the sense that it repeats information in the name field — but it is not `alt=""` because it is a real person's photograph and a meaningful trust signal
- The professional relationship context is in the DOM, not CSS-only — screen readers read it
- No content is hidden behind a "read more" expansion in Phase 1 — all recommendation text is visible

## 5.10 No Sliders, No Auto-Rotation, No Hidden Content

All colleague recommendation entries are rendered simultaneously in the DOM. There are no carousels, no sliders, no auto-advancing presentations, no "previous/next" navigation between entries.

At 10–30 entries, a 2-column grid on desktop and a single column on mobile renders all entries in a single, scrollable section. This is:
- Accessible: all content is available without interaction
- Respectful of the patient: all professional endorsements are equally visible — none is more "seen" than others through carousel positioning
- Technically simpler: no JavaScript required for the colleague recommendation section in Phase 1
- Consistent with the site's anti-carousel principle (documented in `docs/tasks/04_DESIGN_SYSTEM_TOKENS.md` §9)

---

# 6. Patient Experiences

**Component:** `organism-patient-testimonials` (full /recomandari variant)
**Background:** `color-surface` (`#FDFBF7`)
**Position:** Section 4
**Visibility:** Hidden until ≥2 approved Testimoniale CPT entries exist. When hidden, this section is absent from the page — no placeholder, no "coming soon" message.

## 6.1 What These Are

Patient experiences are first-person accounts submitted by patients who have chosen to share their experience of consulting with or receiving care from Dr. Ungureanu. They appear in the patient's own words, under their first name and optional city and condition, after administrator review and approval.

They are not:
- Solicited marketing testimonials written by the practice
- Reviews imported from external platforms (Google, Doctoranytime, etc.)
- Testimonials extracted from emails or messages without explicit publication consent
- Anonymous accounts that cannot be traced to a real submission

They are:
- Voluntarily submitted through the form on this page
- Reviewed by an administrator before publication
- Published with the patient's explicit, recorded consent
- Attributed only as the patient has permitted (first name + optional city + optional condition)

## 6.2 Required Fields (what is displayed per entry)

| Field | Display | Source |
|-------|---------|--------|
| First name | "Mihai" — first name only, never surname | `prenume` field from submission form |
| City (optional) | "Cluj-Napoca" — displayed only if patient provided it | `oras` field — optional |
| Condition (optional) | "Hernie de disc" — plain language, displayed only if patient provided it | `afectiune` field — optional |
| Experience text | Patient's own words | `mesaj` field |

**No photographs.** Patients are not asked to provide photographs, and no photographs accompany testimonials. Patient privacy is the primary constraint — a photograph identifies a medical patient publicly, which this page avoids.

**No star ratings.** Patients are not asked to rate their experience on any numerical scale. No stars, no scores, no rankings.

**No avatars or initials placeholders.** Entries appear as text blocks only — no icon, no avatar, no decorative element that simulates a photograph. Text only.

**No carousels.** All approved entries are rendered in the DOM simultaneously. The patient scrolls through them — they do not advance automatically or through user navigation.

## 6.3 Entry Display Format

Each testimonial entry renders as a full-width text block:

```
[Quote mark or pull-quote styling — decorative]
[Experience text — type-body (Inter 17px / 1.70 line-height)]
[Attribution line — type-caption (Inter 13px), color-ink-secondary]
  Format: "[Prenume][, Oraș][ — Afecțiune]"
  Example: "Mihai, Cluj-Napoca — Hernie de disc"
  Or: "Elena" (if only first name provided)
```

Experience text: no maximum length for display (the submitted text appears in full). In practice, most testimonials will be 50–300 words. Very long submissions (500+ words) may be editorially reduced by the administrator during the moderation review — with the principle that meaning and voice are preserved, not polished. Any editorial reduction is noted internally in the WordPress admin panel.

**No "read more" truncation** in Phase 1. All text is visible without interaction. This serves accessibility (no hidden content) and respects the patient's voice (the full account is readable).

## 6.4 Thinking at Scale: 100–500 Testimonials

The page must function at 100–500 testimonials without requiring a rebuild. This informs the display strategy from Phase 1:

**Phase 1 — Load More:**
- Display the 12 most recently approved entries on initial page load
- Below the initial entries: `atom-button-secondary` → "Încarcă mai multe experiențe" (or equivalent)
- Each click loads the next 12 approved entries, appending them below the existing ones
- The button disappears when all entries have been loaded
- Implementation: WordPress REST API query with `per_page=12` and `offset` incrementing per click, or a server-rendered pagination approach

The Load More pattern is chosen over pagination because:
- Pagination creates navigational friction (page 1, page 2...) that interrupts the reading flow
- A patient reading testimonials is in a sustained reading state — interrupting with a page reload breaks that state
- Appending entries allows the patient to read continuously without losing their place

**Phase 1 order:** Most recently approved first. This ensures new entries are visible without requiring existing patients to scroll past hundreds of older ones.

**Phase 2:** See Section 11 (Phase 2 Opportunities) for advanced filtering.

## 6.5 Filtering Philosophy

**Phase 1: No filters.**

No filter by condition. No filter by city. No sort control. No search within testimonials.

**Why no condition filter:**
Filtering testimonials by condition creates an unintended privacy dimension. If a patient can filter for "Hernie de disc" testimonials, the resulting list represents a set of people whose spinal condition is publicly associated with their first name and city. Even though the patient submitted this voluntarily, presenting it as a filterable dataset changes the nature of the exposure — from "I chose to mention my condition in my own account" to "my condition is one data point in a filterable medical database."

The testimonials section is human and narrative. It is not a database. Filtering would change its nature.

**Why no sort control:**
Allowing patients to sort by date, condition, or city introduces a UX interface that signals "review platform" — exactly the framing this page refuses. The absence of sorting controls is consistent with the page's identity as a curated human collection, not an algorithm-served consumer resource.

## 6.6 Privacy Principles

**Consent is the gate.** No testimonial is published without confirmed GDPR consent recorded at submission time. The consent checkbox on the form is required — the form does not submit without it. The `gdpr_consent` field in the Testimoniale CPT records `true` on all published entries, with the `gdpr_version` field recording which version of the privacy policy was in effect at submission time.

**Minimal attribution.** A patient who provides only their first name is attributed only by their first name. No inference is made about city, condition, or any other detail not explicitly provided. The optional city and condition fields are optional in the clearest sense — they change nothing about the submission's eligibility for publication.

**No reverse identification.** The combination of first name + city + condition on a published testimonial is the minimum that would appear if all optional fields are completed. This combination is, in most cases, insufficient to identify a specific individual without significant additional effort. The administrator should consider whether any combination of data points in a specific entry makes a patient identifiable in a way they may not have anticipated — if so, discuss with Dr. Ungureanu before publishing.

**Right to withdrawal.** A patient who has had a testimonial published and later requests its removal contacts the practice through standard communication channels. The administrator unpublishes the entry (status → `draft` or delete). There is no automated self-service removal mechanism.

**No minor testimonials.** The submission form should not be used by or for patients under 18. The form does not have an age gate in Phase 1 (this would add friction), but the moderation review includes an assessment of whether the submission appears to come from an adult patient.

---

# 7. Share Your Experience

**Component:** Elementor Form widget (testimonial submission — distinct from `organism-contact-form`)
**Background:** `color-surface-warm` (`#F4EFE6`)
**Position:** Section 5 — always visible

## 7.1 Purpose

The submission form is the mechanism through which the patient experiences section grows over time. It is always present — even when Section 4 is hidden (before ≥2 approved entries exist). Its presence signals: this is an ongoing conversation; your voice is welcome here.

The form is positioned after the existing testimonials rather than before them. A patient who has read what others wrote is more likely to be moved to contribute than a patient who encounters the form first.

## 7.2 Form Fields

| Field | Label | Type | Required | Notes |
|-------|-------|------|---------|-------|
| First name | "Prenume" | Text | Yes | First name only — never surname |
| City | "Orașul dvs. (opțional)" | Text | No | Optional — clearly labeled as such |
| Condition | "Afecțiunea tratată (opțional)" | Text | No | Open text — not a dropdown of conditions |
| Experience | "Experiența dvs." | Textarea | Yes | No character limit imposed; minimum 20 characters to prevent empty submissions |
| GDPR consent | "Am citit și sunt de acord cu Politica de Confidențialitate" | Checkbox | Yes | Links to /politica-de-confidentialitate in a new tab |
| Publication agreement | "Sunt de acord ca experiența mea să fie publicată pe acest site" | Checkbox | Yes | Distinct from GDPR consent — specifically covers publication |

**Why condition is an open text field, not a dropdown:** A dropdown of conditions is medically problematic. It presents a list of diagnoses in a public-facing form that may cause distress (a patient who does not see their condition may feel unserved), may be medically inaccurate (patient may not know the exact diagnosis name), and gives the appearance of a diagnostic sorting system. An open text field lets patients describe their condition in their own terms, which is more accurate, more human, and less clinical.

**Why two consent checkboxes:** GDPR consent (required for data processing) and publication consent (required for making the submission public) are legally and ethically distinct. A patient may consent to their data being stored without consenting to publication. Separate checkboxes make these distinct choices explicit.

## 7.3 Workflow

```
Patient completes form on /recomandari Section 5
          ↓
Form submits (requires: prenume + experiența + both checkboxes checked)
          ↓
WordPress creates Testimoniale CPT entry
  · prenume: [submitted value]
  · oras: [submitted value or empty]
  · afectiune: [submitted value or empty]
  · mesaj: [submitted value]
  · data_trimiterii: [timestamp]
  · gdpr_consent: true
  · gdpr_version: [current privacy policy version]
  · approval_status: pending
          ↓
Admin email notification (Q16 destination):
  Subject: "Testimonial nou în așteptare — georgeungureanu.doctor"
  Body: prenume + afectiune (if provided) + first 200 characters of mesaj + direct link to WordPress admin → Testimoniale → [this entry]
          ↓
Patient sees success message (inline, not a redirect — see §7.4)
          ↓
Admin opens entry in WordPress → Testimoniale panel
          ↓
                 Approve                    |                  Reject
  status → publish                         |    status remains pending / entry deleted
  entry appears in Section 4               |    no notification to patient
  of /recomandari                          |    entry never appears publicly
```

## 7.4 Success Message

The success message appears inline, below the form, after submission. The form is not cleared — the patient's text remains visible so they can confirm what was submitted.

**Success message content (example register — not final copy):**
"Vă mulțumim. Mesajul dvs. a fost primit și va fi revizuit în curând. Apreciem că ați ales să vă împărtășiți experiența."

**What the success message does not say:**
- "Your review has been published" — it has not been published; it is pending
- "We will contact you" — no contact is made during moderation
- "Your submission was approved" — it is not yet approved

The success message is honest about the pending state without creating anxiety: the patient knows their submission arrived, and knows it will be reviewed.

## 7.5 Moderation Principles

Every submission is reviewed before publication. The review is a human decision made by the administrator (and/or Dr. Ungureanu if the administrator has questions).

**Approve if:**
- The submission is authentic — reads as a genuine patient experience, not a generic or fabricated account
- The content is respectful — even critical accounts can be published if they are expressed respectfully
- The content is not defamatory — does not make false factual claims
- The content is appropriate for other patients to read — does not contain explicit content, personal information about third parties, or medical advice
- Both consent checkboxes were checked (recorded in the CPT)
- The entry appears to come from an adult patient

**Reject (do not publish) if:**
- The submission appears fabricated or written by someone other than a patient
- The submission is defamatory — contains false factual claims about the doctor
- The submission is inappropriate for the audience — abusive, offensive, or harmful
- The submission contains identifying information about other patients or medical staff (mentioned by name)
- The submission appears to come from a minor
- The submission is clearly not from a patient (spam, solicitation, test submissions)

**Do not edit and publish without patient agreement:**
Minor formatting may be applied (paragraph breaks for readability). Content edits require either Dr. Ungureanu's decision to reject the entry or, in exceptional cases, explicit re-consent from the patient. The administrator does not silently rewrite submissions before publishing.

## 7.6 Rejection Principles

When an entry is rejected, no email is sent to the patient. The entry remains in pending state or is deleted. The patient does not receive a notification explaining why their submission was not published.

This is intentional:
- Explaining rejection reasons opens a dialogue the practice is not resourced to maintain
- A rejection notification may cause distress — the patient does not need to know that their specific account was declined
- The submission form's language sets the expectation ("will be reviewed") without promising publication

Entries that are clearly spam or test submissions are deleted. Entries that contain genuine patient content but do not meet the publication standard are left in pending state (preserved in case context or circumstances change) or deleted per the administrator's judgment.

## 7.7 No User Accounts, No Comments, No Edits

**No user accounts:** The submission process requires no registration, no login, no account creation. The patient fills in the form, agrees to both consent checkboxes, and submits. No profile is created. No login is ever required.

**No comments:** There is no comment system on this page. The patient submits a testimonial; the doctor does not respond publicly to individual testimonials; other patients do not comment on other patients' experiences. The experiences section is not a forum.

**No edits after submission:** Once a patient submits, the submission is final. There is no "edit my submission" functionality. If a patient wants to update their submission, they submit a new one — the previous submission remains in pending state and the administrator determines which version, if any, to publish.

## 7.8 Accessibility Requirements for the Form

- All form labels are visible above their fields — no placeholder-only labels that disappear on focus
- The GDPR consent checkbox has a visible label that includes a link to /politica-de-confidentialitate
- The publication agreement checkbox has a visible label distinct from the GDPR label
- Form validation errors appear adjacent to the relevant field, in `color-error` (#B83030), with a specific explanation
- Form error messages do not disappear automatically — they persist until the field is corrected
- Success message appears in the DOM after submission — not in a `role="alert"` that overrides current focus, but in a visually prominent position below the form that keyboard users can reach
- The form is fully navigable by keyboard: Tab to each field, Space to check checkboxes, Tab to submit, Enter to activate
- Submit button label: "Trimiteți experiența" — specific, not generic

---

# 8. Trust Principles

## 8.1 Why This Page Avoids Stars, Ratings, Counts, and Rankings

The decision not to use star ratings, review counts, score averages, or rankings on /recomandari is architectural — it shapes everything about the page's content model, display, and moderation.

**Stars:** A 5-star rating system implies that a medical consultation can be evaluated on the same scale as a restaurant or a hotel stay. It reduces the entire complexity of a neurosurgical encounter — the quality of diagnosis, the communication of options, the feeling of being understood — to a single integer from 1 to 5. The aggregation of those integers produces an average that removes all context. The star rating is the least informative thing a patient could express about a medical encounter; displaying it as the primary signal reverses the information hierarchy entirely.

**Review counts:** "312 reviews" is a volume metric. It signals popularity, not quality. A practice with 312 reviews may have 312 patients who found the form and filled it in, or 312 patients who were specifically encouraged to do so, or 312 genuine experiences. The count does not distinguish between these. More critically, it invites comparison — a practice with 400 reviews outranks one with 200 in the consumer-review framing, regardless of what the reviews actually say. This is the wrong competition for this practice to participate in.

**Rankings:** "Top Neurochirurg, 2024" — ranked by what metric, assessed by whom, on what basis? Rankings are marketing assets produced by organizations with their own methodologies and often their own commercial interests. They communicate "someone said this doctor is good," which is a weaker signal than "these specific people said this about their specific experiences."

**Score averages:** An average requires that the underlying data is commensurable — that a 5 given because the doctor explained a procedure well and a 5 given because the waiting room was comfortable can be meaningfully combined. They cannot be. Medical consultation quality is not commensurable across the dimensions patients evaluate it on.

## 8.2 The Difference Between Trust and Social Proof Marketing

Social proof marketing uses aggregated signals (ratings, counts, rankings) to create the impression of consensus. It says: "Many people have chosen this, therefore you should too." It is primarily a persuasion technique, borrowed from consumer behavior research and applied to medical contexts where it does not belong.

Trust is built differently. It is built through specificity, attribution, and time. When a named physician describes a specific professional observation about a specific clinical behavior over a specific period of years, that is trust-building content. When a patient describes, in their own words, a specific moment in a specific consultation that left them feeling understood, that is trust-building content.

Social proof marketing needs volume to work — the more reviews, the stronger the signal. Trust needs quality — one highly specific, attributed, honest account does more trust-building work than one hundred generic 5-star ratings.

This page operates on trust logic, not social proof marketing logic. The consequence of this choice:
- The page may appear to have "less" content than a practice with 500 Google reviews
- The content it does have is more credible to a patient who takes the time to read it
- The patient who reads the page is making a more informed decision than the patient who sees a 4.9-star average

## 8.3 Why Authenticity Is Non-Negotiable

A patient considering a neurosurgical consultation is making one of the most significant decisions of their medical life. The doctor they choose may operate on their brain or spine. In this context, a testimonial that was suggested, edited, or incentivized is a form of deception — not in a legal sense, but in the most important sense: it puts false evidence in front of a person making a decision with real consequences.

The moderation workflow on this page is not designed to select favorable content. It is designed to exclude inappropriate content — fabrications, defamation, spam, and material that would harm rather than inform other patients. Within those constraints, the principle is: publish what patients actually said, in their own words, including experiences that acknowledge difficulty.

A testimonial that reads: "The consultation was difficult — I received news I wasn't ready for. But Dr. Ungureanu stayed with me through the explanation, repeated it three times, and made sure I left knowing what my options were" is more trustworthy than ten accounts of "perfect experience, 5 stars." It is also more useful to another patient who is frightened about what they might hear.

---

# 9. Mobile Experience

## 9.1 Section Order on Mobile

Identical to desktop. The page is long on mobile — colleague recommendations followed by patient testimonials is a significant scroll. This is appropriate: a patient willing to read through this page on mobile is engaged and in a reading state.

## 9.2 Recommendation Cards on Mobile

At 10–30 colleague recommendations, mobile behavior is critical to usability:

- Single column on all mobile viewports (<768px)
- Full-width cards, `space-6` (24px) internal padding
- Portrait photograph: 64×64px, left-aligned, radius-avatar (50%)
- Attribution (name, specialty, institution) to the right of portrait — fits without wrapping at 375px if type-h4 is 18px and the portrait is 64px
- Professional context: below the portrait + attribution row, full-width
- Recommendation text: below context, full-width, `type-body` (16px), line-height 1.70
- Card gap: `space-4` (16px) between cards
- No truncation of recommendation text — all text visible without interaction

At 30 cards in a single column, the colleague recommendations section is approximately 30 × (card height + gap). This is a significant scroll. Phase 1 does not paginate colleague recommendations. Phase 2 may introduce a "Load More" for this section if growth warrants it.

## 9.3 Testimonial Readability on Mobile

- Testimonial text: `type-body` minimum 16px — never smaller
- Line height: 1.70 — sufficient for comfortable reading of longer passages
- Maximum testimonial width: full container width on mobile (no side margins that reduce reading width below ~320px on a 375px screen)
- Attribution line: `type-caption` 13px, `color-ink-secondary` — acceptable at this size for a brief label
- Quote mark or pull-quote styling: reduced or simplified on mobile — the styling is decorative, not structural

## 9.4 Touch Targets

| Element | Mobile target |
|---------|--------------|
| "Încarcă mai multe" button | Full-width, 52px height |
| CTA button (Section 6) | Full-width, 52px height |
| Form submit button | Full-width, 52px height |
| GDPR link within checkbox label | 44×44px touchable area around the link text |
| Form fields | Minimum 48px height — prevents accidental taps on adjacent elements |
| Checkboxes | 44×44px touch target including label |

## 9.5 Spacing on Mobile

| Section | Desktop (top/bottom) | Mobile (top/bottom) |
|---------|---------------------|---------------------|
| Hero | 80px | 40px |
| Introductory explanation | 80px | 40px |
| Colleague recommendations | 80px | 48px |
| Patient experiences | 80px | 40px |
| Submission form | 80px | 40px |
| Final CTA | 96px | 48px |

## 9.6 Pagination Behavior on Mobile

The Load More button for Section 4 (patient testimonials) is full-width on mobile. After tapping, the next 12 entries are appended below the existing entries. The button remains at the bottom of the current list — the patient does not need to scroll to the original button position.

The Load More action must not cause a full page reload. It must not scroll the page to the top. After appending new entries, the page position remains at approximately the last visible testimonial, allowing continuous reading.

## 9.7 50+ Patient Considerations

- Testimonial text at 16px minimum with 1.70 line height is readable without zooming for most patients aged 50+
- Form fields at 48px height are tappable without requiring precise targeting
- All checkboxes have large touch targets — the checkbox label is fully tappable (not only the checkbox element itself)
- No time-limited interactions — the form does not auto-submit, no success message disappears automatically, no session timeout
- The submission form's success message is visible without scrolling after submission — the patient does not need to search for confirmation that their submission was received

---

# 10. Accessibility

## 10.1 Heading Structure

```
H1: [Hero headline — page title]
  H2: [Introductory explanation heading]
  H2: Recomandări din partea colegilor medici
    H3: [Colleague name — only if entries are wrapped with H3; implementation decision in Phase 6]
  H2: Experiențele pacienților
  H2: Împărtășește experiența ta (Submission form section heading)
  H2: [Final CTA heading]
```

One H1. All section headings are H2. If colleague recommendation entries use heading elements for the colleague's name, they are H3 — subordinate to the section H2. This is an implementation decision for Phase 6 — entries may alternatively use `role="article"` with the name as strong text rather than H3, to avoid a heading outline with 10–30 individual H3 entries.

## 10.2 Screen Reader Support

| Element | Screen reader treatment |
|---------|------------------------|
| Hero — no photography | Standard text; reads naturally |
| Colleague recommendation entries | Each wrapped in `<article>` or `role="article"`. Portrait: `alt="Fotografia [Dr. Name], [Specialty], [Institution]"` |
| Patient testimonials | Each wrapped in `<blockquote>` with attribution in `<footer>` or `<cite>` element. Screen readers read blockquote + citation correctly. |
| Load More button | "Încarcă mai multe experiențe" — explicit label. After activation: new entries appended to DOM; focus does not move (patient continues reading); no announcement unless implemented as a live region |
| Submission form | All fields have explicit `<label>` elements. Error messages are associated with fields via `aria-describedby`. Success message uses `role="status"` to announce to screen reader users without interrupting. |
| GDPR checkbox | Label wraps checkbox and full label text including link. Link text: "Politica de Confidențialitate" — not "click here" |
| Publication consent checkbox | Label wraps checkbox and full label text |
| Form submit button | "Trimiteți experiența" — not "Submit" or "Send" |

## 10.3 Keyboard Navigation

| Flow | Keyboard path |
|------|--------------|
| Skip to content | Tab → Enter → `#main-content` (hero) |
| Breadcrumb | Tab to "Acasă" link → (separator is aria-hidden) → "Recomandări" (current, not a link) |
| Colleague entries | Tab moves through any interactive elements within entries (none in Phase 1 — entries are read-only) |
| Patient experiences | Tab moves through the Load More button; no interactive elements within testimonials |
| Load More button | Tab → Enter loads next 12 entries |
| Submission form | Tab → each field in order → GDPR checkbox → publication checkbox → submit button |
| GDPR link | Tab while in GDPR label → Enter opens /politica-de-confidentialitate in new tab |
| Final CTA | Tab → "Programează o consultație" → Enter navigates to /programari |

## 10.4 Long-Text Readability

Patient testimonials may be 50–300 words or more. For screen reader users navigating a page with potentially hundreds of testimonials:
- Each testimonial is a distinct `<blockquote>` element — screen reader users can navigate by blockquote element type
- The Load More pattern appends elements to the DOM — screen readers announce newly added content if the container has `aria-live="polite"`
- No truncation with hidden text in Phase 1 — what is visible is what is read

## 10.5 Cognitive Accessibility

- **Clear section labels:** "Recomandări din partea colegilor medici" and "Experiențele pacienților" are explicit H2 labels — a patient navigating the page by heading knows exactly what each section contains
- **No hidden interactions:** All content is visible without hover, without interaction, without account
- **Form confirmation:** The success message persists until the patient navigates away — it does not auto-dismiss
- **Error messages:** Form errors appear adjacent to the relevant field with a specific explanation — "Acest câmp este obligatoriu" is not sufficient; "Vă rugăm să completați prenumele dvs." is specific
- **Two consent checkboxes:** Clearly labeled, clearly distinct. A patient with cognitive difficulty can understand "I agree to privacy policy" and "I agree that this can be published" as two separate decisions

---

# 11. Phase 2 Opportunities

These are documented for planning purposes. None are implemented in Phase 1.

## 11.1 Advanced Filtering for Patient Testimonials

Phase 2 may introduce category-based navigation within the patient experiences section — allowing patients to read experiences related to a particular type of condition or care context.

**Implementation consideration:** This must not become a condition-based filter (the privacy argument against this is documented in §6.5). It may be implemented as a tag-based navigation where the administrator assigns a broad category tag to each testimonial (e.g., "Consultație" / "Intervenție chirurgicală" / "Urmărire postoperatorie") rather than a specific medical condition.

**Condition:** Volume of approved testimonials must justify the complexity. Appropriate when ≥50 approved entries exist.

## 11.2 Search Within Testimonials

A text search within the patient experiences section — allowing patients to search for specific words within testimonials.

**Condition:** Client-side search (JavaScript, no server query) is viable at ≤200 entries with a static JSON export of all approved testimonials. Server-side search is needed at larger volumes. Phase 2 planning determines the appropriate approach.

## 11.3 Video Recommendations

Phase 2 may add video testimonials from colleague physicians — a brief video recording (30–90 seconds) where a colleague speaks about their professional relationship with Dr. Ungureanu.

**Conditions:**
- Video must be recorded specifically for this purpose — not a repurposed interview
- Colleague must explicitly consent to video publication
- Hosted on YouTube (lazy-loaded, no autoplay) or self-hosted
- Closed captions required (accessibility — WCAG 1.2.2 for pre-recorded video)
- Mobile-friendly: the video embed must not cause layout shift (CLS)

## 11.4 Multilingual Testimonials

If a significant portion of the patient population submits in Hungarian (Baia Mare region) or other languages, Phase 2 may add:
- A language indicator on each testimonial entry
- Optional: a Romanian translation below the original text (translation by the practice, not automatic)

**Condition:** Authentic multilingual submissions in sufficient volume, confirmed demand from Dr. Ungureanu.

## 11.5 Richer Colleague Profiles

Phase 2 may expand colleague recommendation entries with:
- A link to the colleague's institutional profile (with their consent)
- A brief specialty description oriented toward patients ("Medic neurolog specializat în afecțiuni degenerative — explică ce afecțiuni tratează și de ce ar îndruma un pacient spre neurochirurgie")
- A brief second page or modal with the full professional biography of the recommending colleague (for patients who want to assess the recommender's credibility more deeply)

**Condition:** Phase 1 colleague entry format must be built cleanly enough to extend without rebuilding.

---

# 12. Blocking Dependencies

## 12.1 Full Dependency Table

| Dependency | Source | Impact if Missing | Blocks Launch? |
|-----------|--------|------------------|---------------|
| **Q24 — All colleague recommendation content** | Dr. Ungureanu | Section 3 is hidden; page launches without colleague recommendations | YES — Section 3 hidden at launch if no content |
| Q24a — Professional photographs (per colleague) | Colleague physicians (provided to Dr. Ungureanu) | Card cannot be published without photograph | YES per card |
| Q24b — Full names (per colleague) | Colleagues | Card cannot be published without name | YES per card |
| Q24c — Specialty designations (per colleague) | Colleagues | Card cannot be published without specialty | YES per card |
| Q24d — Institutional affiliations (per colleague) | Colleagues | Card cannot be published without institution | YES per card |
| Q24e — Professional relationship context (per colleague) | Colleagues (via Dr. Ungureanu) | Card cannot be published without context | YES per card |
| Q24f — Recommendation texts (per colleague) | Colleagues (written by the colleague) | Card cannot be published without text | YES per card |
| Q24g — Display order (which colleagues appear first) | Dr. Ungureanu | All entries appear in arbitrary order without guidance | No — but editorial quality is reduced |
| **Q20 — Privacy policy live** | Dr. Ungureanu / legal | GDPR consent checkbox cannot link to /politica-de-confidentialitate; form cannot be made live | YES — submission form blocked |
| **Q16 — Admin email** | Dr. Ungureanu | Admin notification emails for new testimonial submissions cannot be sent | YES — workflow broken without notification |
| **Q11 — Contact form routing confirmation** | Dr. Ungureanu | Elementor Forms action "Create Post" for Testimoniale CPT must be confirmed compatible | YES — CPT creation may not work |
| **Testimoniale CPT registered** | Phase 6 implementation | Submission form cannot create pending entries | YES — form submission has no destination |
| **≥2 approved Testimoniale CPT entries** | Patient submissions + admin approval | Section 4 (Patient experiences) remains hidden | No — page launches with Section 4 hidden |
| **/politica-de-confidentialitate live** | Phase 2 (carried forward) | Form GDPR link broken | YES |
| **/programari live** | Phase 4 | Final CTA has no destination | YES |
| **Hero copy (H1 + lead text)** | Dr. Ungureanu | Hero has placeholder text — cannot launch | YES |
| **Introductory section text (80–120 words)** | Dr. Ungureanu | Section 2 is placeholder — cannot launch | YES |

## 12.2 What Can Be Built Before Content Is Provided

| Component | Status without content |
|-----------|----------------------|
| Hero structure (layout, breadcrumb, overline, CTA) | Buildable; H1 and lead are placeholder |
| Section 2 layout | Buildable; text is placeholder |
| Section 3 layout (grid structure, city divider) | Buildable; no colleague entries until Q24 resolved |
| Section 4 layout (testimonial block structure) | Buildable; hidden pending ≥2 approved entries |
| Section 5 form structure | Buildable; requires Q20 (privacy policy) and Q16 (email) for form to function |
| Section 6 CTA banner | Buildable; /programari must be live |
| Testimoniale CPT registration | Requires Phase 6 implementation; independent of Dr. Ungureanu content |

## 12.3 Launch States

**State 1 — Full launch (ideal):**
- ≥1 colleague recommendation entry (Section 3 visible)
- ≥2 approved patient testimonials (Section 4 visible)
- Submission form functional (Q20, Q16, Q11, CPT confirmed)
- Privacy policy live
- All CTAs routing correctly

**State 2 — Partial launch (acceptable):**
- Section 3 hidden (no colleague recommendations yet — Q24 unresolved)
- Section 4 hidden (no patient testimonials yet)
- Submission form functional — begins collecting submissions for future moderation
- All other sections present
- Page is live and usable; trust sections will appear as content becomes available

**State 3 — Minimum (acceptable with note):**
- Both Section 3 and Section 4 hidden
- Submission form may or may not be functional
- Hero, intro, and final CTA present
- Page exists at the URL, is in the navigation, and has the correct breadcrumb
- **Risk:** A patient who navigates to /recomandari and finds no recommendations may draw a negative inference. This state should be temporary (days, not weeks) and should be resolved by securing at least one colleague recommendation before significant patient traffic arrives.

**State 4 — Not acceptable:**
- Page published with placeholder text visible ("Adaugați conținut aici", "Titlu", etc.)
- Page published with "coming soon" or "under construction" messaging
- Page published with non-genuine content (invented testimonials, drafted colleague recommendations not provided by real colleagues)

## 12.4 Post-Launch Enhancements (not launch blockers)

| Enhancement | When to add |
|-------------|------------|
| Additional colleague recommendations (Q24) | As Dr. Ungureanu collects content from more colleagues; no rebuild required — admin adds in Elementor |
| Patient testimonials (Section 4 visible) | As soon as ≥2 approved entries exist; admin changes Elementor visibility from hidden to visible |
| Phase 2 Load More implementation | If/when approved testimonial count exceeds 12 |
| Display order refinement | After initial entries are live and Dr. Ungureanu reviews ordering |

---

# 13. Validation Checklist

## 13.1 Trust

- [ ] The hero contains no star ratings, review counts, score averages, or rankings
- [ ] The introductory explanation (Section 2) explains in patient-accessible language why professional recommendations precede patient experiences
- [ ] Every published colleague recommendation entry has all 6 required fields: photograph, name, specialty, institution, professional context, recommendation text
- [ ] No colleague recommendation entry uses generic praise without specific professional observation
- [ ] All colleague photographs are professional portraits provided with the colleague's consent — not sourced from social media
- [ ] The page does not describe itself as a "review" platform anywhere in copy or UI labels
- [ ] Patient experiences appear in the patients' own words — not polished or rewritten beyond minor formatting
- [ ] The admin does not publish content that reads as suggested or drafted by the practice

## 13.2 Authenticity

- [ ] All published colleague recommendations were provided by named professionals through direct communication with Dr. Ungureanu — none were solicited through a public form
- [ ] All published patient testimonials were submitted through the /recomandari form with both consent checkboxes recorded as checked
- [ ] No published testimonial contains content that appears fabricated or written by someone other than the submitting patient
- [ ] The `gdpr_consent` and `gdpr_version` fields are populated on all published Testimoniale CPT entries
- [ ] The moderation principle "publish what patients actually said" is applied — content that is authentic but not entirely positive is not systematically rejected
- [ ] No testimonial from a minor appears on the page

## 13.3 Privacy

- [ ] Patient surnames are never displayed — first names only
- [ ] City is displayed only if the patient provided it in the optional field
- [ ] Condition is displayed only if the patient provided it in the optional field
- [ ] No patient photographs appear on the page
- [ ] The GDPR consent checkbox links to the live /politica-de-confidentialitate page
- [ ] The publication agreement checkbox is distinct from the GDPR checkbox — both are required before submission succeeds
- [ ] The `gdpr_version` field records the privacy policy version at time of submission for all entries
- [ ] No entry has been batch-imported from external sources (Google reviews, social media comments, email messages) without explicit re-consent through the form

## 13.4 Accessibility

- [ ] One H1 on the page; all section headings are H2; no heading levels skipped
- [ ] Breadcrumb `<nav>` has `aria-label="Breadcrumb"` and `aria-current="page"` on the current label
- [ ] All colleague portrait photographs have descriptive alt text naming the colleague
- [ ] Patient testimonials are wrapped in `<blockquote>` elements with attribution in `<cite>` or `<footer>`
- [ ] The submission form has visible labels above all fields (no placeholder-only labels)
- [ ] Form errors appear adjacent to relevant fields with specific error messages
- [ ] Form success message uses `role="status"` — announced to screen reader users without interrupting focus
- [ ] Both consent checkboxes have full label text with a tappable target of ≥44×44px
- [ ] The Load More button (when present) has an explicit label ("Încarcă mai multe experiențe")
- [ ] All animations are suppressed under `prefers-reduced-motion`

## 13.5 Emotional Comfort

- [ ] The manifesto test passes: a patient who received a difficult diagnosis last week reads this page and feels that others have been in their situation and have been cared for — not that they are reading marketing material
- [ ] No section on this page creates urgency, pressure, or scarcity
- [ ] The submission form feels like an invitation — not a required action, not a feedback mechanism for operational purposes
- [ ] Patient experiences that acknowledge difficulty (fear before consultation, uncertainty about diagnosis) are present and are not systematically excluded in favor of only positive experiences
- [ ] The page's tone matches the rest of the site — warm, specific, unhurried
- [ ] The final CTA is a calm invitation: "Programează o consultație" → /programari with no urgency language

## 13.6 Patient Reassurance

- [ ] A patient who reads Section 3 can identify the professional credentials of the recommending physicians (specialty + institution) without needing to do additional research
- [ ] A patient who reads Section 4 can recognize emotional language similar to their own experience of illness — the testimonials are specific enough to be relatable
- [ ] A patient who submits through Section 5 knows that their submission arrived (success message) and knows it will be reviewed (no false promise of immediate publication)
- [ ] A patient who is not yet ready to contact can read the full page without pressure — the CTA is at the end, not repeated aggressively throughout
- [ ] The page does not end without a clear next step: the final CTA provides it calmly

---

*Recomandări version: 1.0 — 2026-06-28*
*Source: docs/tasks/00_PROJECT_ROADMAP.md v1.1, docs/tasks/01_INFORMATION_ARCHITECTURE.md v1.0, docs/tasks/02_CONTENT_MODELS.md v1.0, docs/project/PATIENT_CENTERED_MANIFESTO.md*
*Next: docs/tasks/09_AFECTIUNI.md*
