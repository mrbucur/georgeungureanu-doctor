# Content Models

## georgeungureanu.doctor

**Source of truth:** `docs/tasks/00_PROJECT_ROADMAP.md`, `docs/tasks/01_INFORMATION_ARCHITECTURE.md`
**Governing philosophy:** `docs/project/PATIENT_CENTERED_MANIFESTO.md`
**Tone reference:** `docs/content/CONTENT_TONE.md`
**Phase:** 1 — Information Architecture → feeds Phase 2 (Content Models build)

---

## Purpose and Scope

This document defines the complete content model for georgeungureanu.doctor: what data each page requires, what structured content types exist, how content enters the system, and how it flows from creation to publication.

This document governs:
- Page-level content requirements (sections, data dependencies, audience)
- Custom Post Type field specifications and business logic
- Editorial workflows for all content types
- Phase 1 (manual) vs. Phase 2 (automated) content operations

This document does not govern:
- Elementor template layouts or section compositions (see `docs/implementation/`)
- WordPress configuration or plugin code
- Design system tokens or component definitions (see `docs/components/`)

---

## Tone Constraints (applied to all content)

All content entered into this system must pass the following tests before publication, derived from `docs/content/CONTENT_TONE.md` and `docs/project/PATIENT_CENTERED_MANIFESTO.md`:

1. **Readability:** Grade 8–10 reading level. Paragraphs maximum 4–5 lines on desktop.
2. **Medical language:** Every medical term defined on first use within that page. No unexplained abbreviations.
3. **Voice:** Calm, warm, direct, precise. Never promotional. Never hedging.
4. **Patient orientation:** Every section tells the patient what this means for them. Not what it means to a clinician.
5. **Manifesto test:** Read as a patient who received a difficult diagnosis last week. Does the content make them feel more informed? More confident? Calmer?

---

# 1. Standard Pages

---

## 1.1 Homepage (/)

**Purpose:** First impression for new patients arriving from search, referral, or social media. Establishes trust, introduces the doctor and the site's key pillars, and routes each patient toward their relevant content destination or toward /programari.

**Primary audience:** The Night-Search Patient — anxious, recently diagnosed, searching for answers and for a doctor they can trust before committing to an appointment.
**Secondary audience:** The Concerned Family Member — researching on behalf of a loved one.

### Required Sections

| # | Section | Content source | Notes |
|---|---------|---------------|-------|
| 1 | Hero | Manual — static Elementor content | Full-bleed doctor photography (Q7); headline speaks to patient concern, not doctor achievement |
| 2 | Patient Promise | Manual — static Elementor content | 2–3 sentences only; no credentials; what the practice offers the patient |
| 3 | Afecțiuni preview | Condition CPT — 6 selected entries | Cards display: patient_title, card_description; link to /afectiuni/[slug] |
| 4 | Doctor introduction | Manual — static Elementor content | Short biography excerpt; approachable portrait (Q7); link to /despre |
| 5 | Trust indicators | Manual — static Elementor content | 3 confirmed, verifiable figures (Q3); patient-readable framing |
| 6 | How It Works | Manual — static Elementor content | 4 fixed steps: Alegeți locația → Solicitați programarea → Prima consultație → Stabilim împreună planul terapeutic |
| 7 | CTA Banner | Manual — static Elementor content | Primary button: "Programează o consultație" → /programari |

### Optional Sections (built hidden — do not delete)

| Section | Visibility condition | Content source |
|---------|---------------------|---------------|
| Patient testimonials | ≥ 2 approved Testimoniale CPT entries | Testimoniale CPT — most recent approved entries |
| Sfatul Neurochirurgului preview | ≥ 3 published SN Article entries | SN Article CPT — 3 most recent published |

Both optional sections are built during Phase 3 (Homepage) but remain hidden until their conditions are met by Phase 6 and Phase 7 respectively.

### Required Data Dependencies

| Dependency | Source | Blocking? |
|-----------|--------|----------|
| Doctor photography — hero image | Q7 | BLOCKING |
| Doctor photography — approachable portrait | Q7 | BLOCKING |
| Trust indicator figures | Q3 | BLOCKING |
| Patient Promise text | Dr. Ungureanu | BLOCKING |
| Biography excerpt for doctor intro section | Dr. Ungureanu | BLOCKING |
| 6 Condition CPT entries with card_description | Q4 | BLOCKING |
| /programari live | Phase 4 | BLOCKING |
| /afectiuni live | Phase 7 | BLOCKING |
| /despre live | Phase 5 | BLOCKING |

---

## 1.2 Programări (/programari)

**Purpose:** Remove geographic uncertainty before the patient contacts. Answers four patient questions: Where? Is it accessible? When? How? Routes to /contact — and only to /contact.

**Primary audience:** All patients following a primary CTA from any page. This is the first stop in the transactional flow.

### Required Sections

| # | Section | Content source | Notes |
|---|---------|---------------|-------|
| 1 | Hero | Manual — static Elementor content | H1 + breadcrumb + lead paragraph framing the location directory |
| 2 | Location directory | Manual — molecule-location-card per location | One card per active location; requires Q13 data |
| 3 | How It Works | Manual — static Elementor content | /programari-specific variant; 4 steps focused on appointment logistics, not general patient journey |
| 4 | CTA Banner | Manual — static Elementor content | Single button only: "Contactați-ne" → /contact. No secondary CTA. No exceptions. |

### Required Per-Location Data (per molecule-location-card)

| Field | Required? |
|-------|----------|
| Clinic or hospital patient-facing name | Required |
| Visit type badge: Consultații / Intervenții chirurgicale / Ambele | Required |
| Full street address | Required |
| Schedule: days and hours at this specific location | Required |
| Phone number | Required |
| Booking method note | Required |
| Google Maps URL | Required |
| Email (location-specific) | Optional |
| Patient notes (parking, floor, accessibility, entrance) | Optional |

### Launch State Rules

- State 1 (preferred): All active locations with all required fields — launch normally
- State 2 (acceptable): At least one card per city with all required fields; incomplete locations omitted
- State 3 (not acceptable): Empty or placeholder cards — do not launch

### Required Data Dependencies

| Dependency | Source | Blocking? |
|-----------|--------|----------|
| Location data per location (name, address, visit type, schedule, phone, booking method, Maps URL) | Q13 | BLOCKING |
| Patient-facing phone number | Q15 | BLOCKING |
| /contact live | Phase 4 co-deliverable | BLOCKING |

---

## 1.3 Contact (/contact)

**Purpose:** Receive the appointment request. Final step of the transactional flow. Reached only from /programari.

**Primary audience:** All patients who have passed through /programari and chosen to contact.

### Required Sections

| # | Section | Content source | Notes |
|---|---------|---------------|-------|
| 1 | Hero | Manual — static Elementor content | H1 + phone number + email address visible above fold without scrolling |
| 2 | Contact form | Form widget | 4 data fields + GDPR consent; routes to confirmed admin email (Q11) |
| 3 | What Happens Next | Manual — static Elementor content | 3-step process: Trimiteți formularul → Vă contactăm în 24 de ore → Stabilim programarea împreună |

### Contact Form Fields

| Field | Label | Type | Required |
|-------|-------|------|---------|
| name | Nume și prenume | Text | Yes |
| email | Adresă de email | Email | Yes |
| phone | Număr de telefon | Tel | Yes |
| reason | Motivul contactului | Textarea | No |
| gdpr_consent | Confirm că am citit politica de confidențialitate | Checkbox | Yes |

On successful submission: inline success message — not a redirect. Form does not clear on refresh (to prevent accidental resubmission).

### Required Data Dependencies

| Dependency | Source | Blocking? |
|-----------|--------|----------|
| Phone number | Q15 | BLOCKING |
| Email address | Q16 | BLOCKING |
| Form routing destination (admin notification email) | Q11 | BLOCKING |
| /politica-de-confidentialitate live | Q20 | BLOCKING (GDPR checkbox must link to it) |

---

## 1.4 Despre Dr. George Ungureanu (/despre)

**Purpose:** Introduce the doctor as a human being and clinician. The patient leaves feeling they know and trust Dr. Ungureanu before they have met him. This page must pass the manifesto test as a patient in distress, not as a peer reviewing a colleague.

**Primary audience:** The Night-Search Patient evaluating whether to trust this doctor.
**Secondary audience:** The Referring Physician confirming credentials and subspecialty scope.

### Required Sections

| # | Section | Content source | Notes |
|---|---------|---------------|-------|
| 1 | Hero | Manual — static Elementor content | Page title + specialty descriptor |
| 2 | Doctor introduction | organism-doctor-intro; biography from Dr. Ungureanu | 3–4 paragraphs, third person, warm; approachable portrait (Q7) |
| 3 | Approach to care | organism-philosophy-statement; text from Dr. Ungureanu | 3–4 values, first person, doctor's voice |
| 4 | Professional timeline | Timeline Event CPT — all active entries | Visual molecule-timeline; chronological; all 7 content categories required |
| 5 | Specializations | Manual — static Elementor content | List of subspecialty areas with 1-sentence descriptions |
| 6 | Academic publications | Manual — static Elementor content | Selected publications; standard citation format; lay-language summary per entry |
| 7 | Memberships & affiliations | Manual — static Elementor content | Professional societies, hospital affiliations, academic appointments |
| 8 | CTA Banner | Manual — static Elementor content | "Programează o consultație" → /programari |

### Optional Section (built hidden)

| Section | Visibility condition | Placement |
|---------|---------------------|----------|
| Patient testimonials | ≥ 2 approved Testimoniale CPT entries | Between Section 7 and Section 8 |

Unhidden simultaneously with Homepage Section 6 (same condition, same trigger point — Phase 6 workflow).

### Required Data Dependencies

| Dependency | Source | Blocking? |
|-----------|--------|----------|
| Doctor photography — full portrait | Q7 | BLOCKING |
| Biography text (3–4 paragraphs) | Dr. Ungureanu | BLOCKING |
| Philosophy/values text (3–4 principles) | Dr. Ungureanu | BLOCKING |
| Timeline Event CPT populated (all 7 categories) | Dr. Ungureanu | BLOCKING |
| Specializations list with 1-sentence descriptions | Dr. Ungureanu | BLOCKING |
| Academic publications list with lay-language summaries | Dr. Ungureanu | BLOCKING |
| Memberships and affiliations list | Dr. Ungureanu | BLOCKING |

---

## 1.5 Recomandări (/recomandari)

**Purpose:** Build trust through two distinct voices — professional peers who endorse Dr. Ungureanu, and patients who have experienced his care — and invite visitors to contribute their own experience. The three-section order is fixed and non-negotiable; it creates a deliberate trust funnel.

**Primary audience:** The Night-Search Patient seeking social proof before committing to contact.
**Secondary audience:** The Concerned Family Member needing professional reassurance.

### Required Sections (in this order — non-negotiable)

| # | Section | Content source | Visibility condition |
|---|---------|---------------|---------------------|
| — | Hero | Manual — static Elementor content | Always visible |
| 1 | Recomandări din partea colegilor medici | Colleague Recommendation CPT | Visible when ≥ 1 active entry; hidden with placeholder text if no entries exist |
| 2 | Experiențele pacienților | Testimoniale CPT (published entries only) | Visible when ≥ 2 approved entries; section hidden until then |
| 3 | Trimiteți-vă experiența | Testimonial submission form | Always visible — patients can submit before any testimonials are displayed |
| 4 | CTA Banner | Manual — static Elementor content | Always visible; "Programează o consultație" → /programari |

### Why This Order

1. **Colleague endorsements first** — professional-to-professional credibility establishes that medical peers trust Dr. Ungureanu. This is the strongest trust signal for a patient who does not know the doctor.
2. **Patient experiences second** — peer-patient social proof shows that real patients have been through this and came out well. This speaks to the emotional experience, not the clinical one.
3. **Submission form third** — after reading both forms of validation, the patient is invited to contribute their own experience. The form comes last because it is an action, not information.

### Required Data Dependencies

| Dependency | Source | Blocking? |
|-----------|--------|----------|
| Colleague Recommendation CPT — at least 1 active entry | Q24 | BLOCKING (Section 1) |
| /politica-de-confidentialitate live | Q20 | BLOCKING (form GDPR checkbox) |
| Admin email (Q16) configured for form notifications | Q16 | BLOCKING (form submissions) |
| Testimoniale CPT registered and form routing active | Phase 6 | BLOCKING (submission form) |

---

## 1.6 Afecțiuni index (/afectiuni)

**Purpose:** Allow patients to find and navigate to their specific condition. The overview grid must feel like a calm, organized resource — not a medical directory.

**Primary audience:** The Night-Search Patient who has a diagnosis or symptom and is looking for information specific to their condition.

### Required Sections

| # | Section | Content source | Notes |
|---|---------|---------------|-------|
| 1 | Hero | Manual — static Elementor content | Empathetic framing: the section exists for patients who have questions, not as a clinical catalogue |
| 2 | Conditions grid | Condition CPT — all active entries | Ordered by display_order field; card shows: patient_title, card_description, link to /afectiuni/[slug] |
| 3 | CTA Banner | Manual — static Elementor content | "Programează o consultație" → /programari |

A contact invitation is placed at the base of the conditions grid: "Nu vedeți afecțiunea dvs.? Contactați-ne." The link routes to /programari (not /contact directly).

### Required Data Dependencies

| Dependency | Source | Blocking? |
|-----------|--------|----------|
| Minimum 6 active Condition CPT entries with complete content | Q4 | BLOCKING |
| Each entry: patient_title, card_description, slug | Dr. Ungureanu | BLOCKING |

---

## 1.7 Sfatul Neurochirurgului hub (/sfatul-neurochirurgului)

**Purpose:** Entry point to the Sfatul Neurochirurgului educational ecosystem. Displays all published content pieces in reverse chronological order. This is a named, curated educational platform — not a generic blog or resources library.

**The distinction:** A blog is a personal publication space. Sfatul Neurochirurgului is a named educational brand: Dr. Ungureanu's sustained commitment to patient-accessible medical knowledge. Every piece published here carries his authority and has passed his review.

**Primary audience:** All personas — patients seeking educational content; returning patients staying informed between appointments.

### Required Sections

| # | Section | Content source | Notes |
|---|---------|---------------|-------|
| 1 | Hero | Manual — static Elementor content | Lead text establishes this as Dr. Ungureanu's educational platform, not a generic "latest articles" section |
| 2 | Content grid | SN Article CPT — all published entries | Ordered by publish_date descending; card shows: title, excerpt, reading_time, content_type, publish_date |
| 3 | CTA Banner | Manual — static Elementor content | "Programează o consultație" → /programari |

### Launch Condition

The hub page and homepage Section 8 (article preview) do not go live until minimum 3 published SN Article entries exist.

### Required Data Dependencies

| Dependency | Source | Blocking? |
|-----------|--------|----------|
| Minimum 3 published SN Article CPT entries | Q9 | BLOCKING |

---

## 1.8 Patient Guidance Articles (under /sfatul-neurochirurgului/)

**Classification:** Sfatul Neurochirurgului Article CPT entries — not a standalone page.

There is no /pacienti page. Patient preparation and guidance content is published as four dedicated SN Articles within the Sfatul Neurochirurgului ecosystem. This approach keeps all educational content under a single named brand and avoids creating a navigational orphan for content that is not part of the diagnostic journey.

| Slug | Topic | Primary audience |
|------|-------|-----------------|
| `/sfatul-neurochirurgului/prima-consultatie` | What happens at the first consultation | Night-Search Patient preparing for a first appointment |
| `/sfatul-neurochirurgului/pentru-apartinatori` | Guide for family members and caregivers | The Concerned Family Member |
| `/sfatul-neurochirurgului/intrebari-frecvente` | Frequently asked questions before surgery | The Referred Patient preparing for a procedure |
| `/sfatul-neurochirurgului/recuperare` | What to expect after surgery | The Referred Patient in or entering the recovery phase |

These four articles are created manually by the administrator from content provided by Dr. Ungureanu during Phase 7 (Sfatul Neurochirurgului content build). They follow the SN Article content model (Section 2.2) in full — including all field requirements, tone constraints, and mandatory Dr. Ungureanu review before publication.

Patients reach these articles via the Sfatul Neurochirurgului hub grid, direct search, or internal links from relevant Condition CPT pages.

---

# 2. Custom Post Types

---

## 2.1 Condition

**Admin label:** Afecțiuni
**URL pattern:** /afectiuni/[slug]
**Visibility:** Public — each entry has a frontend page
**Who creates entries:** Administrator, from content provided by Dr. Ungureanu
**Who can edit entries after creation:** Administrator or delegated editor with clinical review by Dr. Ungureanu

### Field Specification

| Field | Type | Required | Constraints |
|-------|------|---------|------------|
| `patient_title` | Short text | Required | Plain Romanian — the name a patient would use, not a Latin medical term. Used as H1 and in the conditions grid card. Example: "Hernie de disc" not "Hernia nuclei pulposi" |
| `medical_title` | Short text | Optional | Latin or technical term shown below H1 in smaller type for referring physicians |
| `slug` | Text (auto from patient_title) | Required | Romanian, no diacritics in slug |
| `card_description` | Short text (max 120 chars) | Required | One sentence in plain Romanian describing the condition from the patient's perspective. Used on the conditions grid card. |
| `hero_image` | Image | Optional | Used as visual element in condition page hero; must not be a medical illustration — abstract or nature-reference imagery preferred |
| `is_emergency` | Boolean | Required | Default: false. If true, triggers the emergency notice banner above all page content. |
| `emergency_warning_text` | Rich text | Conditional | Required if is_emergency = true. Text for the emergency notice banner. Must include what the acute symptom is, and what the patient should do immediately (call 112, go to emergency, etc.) |
| `symptoms` | Rich text | Required | Plain-language description: what the condition feels like; who it affects; what causes it. Patient-facing. Starts from the patient's experience, not the clinical definition. |
| `diagnosis` | Rich text | Required | How it is diagnosed; what tests or scans are involved; what the patient can expect at diagnosis. |
| `treatment_options` | Rich text | Required | Available treatment options; when surgery is recommended; what happens if untreated. |
| `procedure_details` | Rich text | Optional | The surgical procedure in detail: what it involves, duration, anaesthesia, technique. Shown only for surgical conditions. Hidden if empty — this section does not render a blank heading. |
| `recovery_expectations` | Rich text | Required | Hospital stay duration; return to daily activities timeline; follow-up schedule. Specific timeframes where available ("Most patients go home within 2–4 days"). |
| `faq` | Repeater (question + answer) | Required | Minimum 4 entries, maximum 8. Questions must be phrased exactly as a patient would ask them. Answers must be in plain Romanian. |
| `related_conditions` | Relationship (to Condition CPT) | Optional | Maximum 3 related conditions. Displayed as "Vedeți și" links below the FAQ. No cross-links within body content. |
| `display_order` | Number | Optional | Controls position on /afectiuni index grid. Lower numbers appear first. |
| `is_active` | Boolean | Required | Default: true. If false, condition is excluded from the index grid and its page returns 404. Used to temporarily hide a condition without deleting it. |
| `seo_title` | Short text | Optional | Custom SEO title; defaults to "{patient_title} — Dr. George Ungureanu, Neurochirurg" |
| `seo_description` | Text (max 160 chars) | Optional | Custom meta description; defaults to card_description |

### Page Template Triggered by This CPT

Eight sections, always in this order:

| # | Section | Populated from |
|---|---------|---------------|
| 1 | Hero | patient_title (H1), card_description (lead), hero_image (background if set) |
| 2 | What Is This Condition? | symptoms field |
| 3 | Diagnosis | diagnosis field |
| 4 | Treatment Options | treatment_options field |
| 5 | The Procedure | procedure_details field (section hidden if field empty) |
| 6 | Recovery | recovery_expectations field |
| 7 | FAQ | faq repeater |
| 8 | CTA | organism-appointment-cta → /programari |

Emergency banner: If is_emergency = true, organism-emergency-notice is rendered above Section 1, containing emergency_warning_text. It is not a section — it is a persistent banner.

### Content Rules

- patient_title must always be the primary identifier. Medical titles are secondary.
- All medical terms in any field must be defined on first use within that condition page.
- No abbreviations without expansion (MRI → "imagistică prin rezonanță magnetică (IRM)").
- recovery_expectations must include specific timeframes wherever clinically accurate — not "recovery varies."
- faq questions must be written as a patient would ask them: "Cât timp voi fi în spital?" not "Duration of hospitalization."

---

## 2.2 Sfatul Neurochirurgului Article

**Admin label:** Sfatul Neurochirurgului
**URL pattern:** /sfatul-neurochirurgului/[slug]
**Visibility:** Public — each entry has a frontend page
**Implementation note:** These are registered as WordPress Posts (standard post type) with a dedicated category, rather than a separate CPT. This is because the Make automation pipeline creates content via the WordPress Posts REST API. A separate CPT would require additional API endpoint configuration. The content model is defined here; the registration method is a Phase 2 implementation decision.
**Who creates entries:** Administrator (from original content) or Make automation (draft from social source), followed by mandatory admin review.

### What This Is — And What It Is Not

**Sfatul Neurochirurgului is an educational ecosystem, not a blog.**

| Blog | Sfatul Neurochirurgului |
|------|------------------------|
| Personal publication space | Named educational platform with a defined brand |
| Author publishes freely | All content requires Dr. Ungureanu's review and approval |
| Generic taxonomy (categories, tags) | Content type is educational, patient-centered by definition |
| Auto-publish is standard | No auto-publish under any condition |
| Title reflects topic | Title must answer a patient question or name a direct patient benefit |
| Source is always the author | Content enters from multiple channels (original, social platforms via Make) |

Every piece published here carries Dr. Ungureanu's name and authority. The section brand — "Sfatul Neurochirurgului" — carries the implication that this is the doctor's curated counsel, not incidental content.

### Field Specification

| Field | Type | Required | Constraints |
|-------|------|---------|------------|
| `title` | Short text | Required | Must answer a patient question or name a patient benefit. Example: "Ce trebuie să știi înainte de o operație pe coloană" not "Spinal Surgery Overview" |
| `slug` | Text (auto from title) | Required | Romanian, no diacritics |
| `excerpt` | Text (max 200 chars) | Required | Used in content grid card. Plain Romanian. Written for a patient, not a professional. |
| `body_content` | Rich text | Required | Full article body. All medical terms defined on first use. Active voice. Paragraphs max 4–5 lines. |
| `featured_image` | Image | Optional | Used in grid card and article page header. Clinical photos of procedures are not used — warm, calm imagery only. |
| `content_type` | Select | Required | Values: Article / Video / Repurposed social. Displayed as a tag on the grid card. |
| `video_url` | URL | Conditional | Required if content_type = Video. YouTube URL only. Rendered as lazy oEmbed embed; no autoplay; no live social widget. |
| `source_platform` | Select | Optional | Values: Original / Instagram / Facebook / YouTube. Set by Make for automated content; set manually for original articles. |
| `original_social_url` | URL | Optional | Original post URL if content entered via Make. Stored for audit trail; not displayed to patients. |
| `reading_time` | Number (minutes) | Optional | Estimated reading time. Displayed in article hero and grid card. |
| `author_byline` | Text | Required | Always: "Dr. George Ungureanu". No exceptions. |
| `related_articles` | Relationship (to SN Article) | Optional | Maximum 3. Displayed as "Articole asemănătoare" at the bottom of the article page. |
| `cta_variant` | Select | Required | Values: Standard ("Programează o consultație" → /programari) / Contact ("Contactați-ne" → /programari). Defaults to Standard. |
| `approval_status` | Select | Required | Values: Draft / Pending Review / Published. Make sets to Draft. Admin changes to Published. No auto-publish. |
| `publish_date` | Datetime | Required | Set by admin at publish time. For Make-created content, defaults to import date; admin may adjust. |
| `seo_title` | Short text | Optional | Defaults to "{title} — Sfatul Neurochirurgului" |
| `seo_description` | Text (max 160 chars) | Optional | Defaults to excerpt |

### Page Template Triggered by This CPT

| # | Section | Populated from |
|---|---------|---------------|
| 1 | Hero | title (H1), reading_time, publish_date, author_byline |
| 2 | Article content | body_content, video_url (if content_type = Video) |
| 3 | Related articles | related_articles (section hidden if field empty) |
| 4 | CTA | organism-appointment-cta; variant determined by cta_variant field |

### Content Rules

- title must be a patient question or a direct patient benefit statement — never a topic label
- body_content must pass the full tone checklist from `docs/content/CONTENT_TONE.md`
- No article is published without Dr. Ungureanu's explicit review
- Video embeds: YouTube oEmbed only; lazy-loaded; no autoplay; no social feed widgets of any kind
- Articles repurposed from social media must be edited for tone and reading level before publication — captions are not articles

---

## 2.3 Colleague Recommendation

**Admin label:** Recomandări colegi
**URL pattern:** None — no public URL. Entries render only within /recomandari Section 1.
**Visibility:** Not public (no post type archive, no single entry page)
**Who creates entries:** Delegated administrator, on Dr. Ungureanu's instruction
**Who submits these:** Nobody via a public form. Colleague doctors do not submit their own entries. The administrator creates every entry based on content provided to Dr. Ungureanu through his professional relationships.

### Field Specification

| Field | Type | Required | Constraints |
|-------|------|---------|------------|
| `display_name` | Short text | Required | Full name including title. Format: "Dr. [Prenume] [Nume]". |
| `photo` | Image | Required | Professional portrait; minimum 400×400px; square or near-square crop; no stock imagery; no clinical imagery |
| `specialty` | Short text | Required | Medical specialty in plain Romanian. Example: "Medic de familie", "Neurolog", "Ortoped" |
| `institution` | Short text | Required | Name of hospital or clinic and city. Example: "Spitalul Clinic Județean Cluj-Napoca" |
| `professional_context` | Short text (max 200 chars) | Required | One sentence describing the professional relationship with Dr. Ungureanu. Example: "Colaborare directă timp de 8 ani în cadrul Spitalului Județean Cluj". Must be factually accurate. |
| `recommendation_text` | Rich text (60–150 words) | Required | The endorsement in the colleague's own voice. Warm but professional. Specific — references Dr. Ungureanu by approach or outcome, not generically ("best doctor" is not a recommendation). |
| `display_order` | Number | Required | Manual sort order. Lower numbers appear higher in the section. |
| `is_active` | Boolean | Required | Default: true. If false, entry is hidden from /recomandari without deletion. Used when a colleague changes institution, retires, or requests removal. |

### Content Rules

- recommendation_text must be in the colleague's voice — it is not written by the administrator
- professional_context must be factually accurate and verified by Dr. Ungureanu before entry is created
- display_order is managed manually — there is no algorithmic sort
- Inactive entries are never shown to site visitors and cannot be submitted publicly

---

## 2.4 Patient Testimonial

**Admin label:** Testimoniale
**URL pattern:** None — no public URL. Entries render within /recomandari Section 3, Homepage Section 6, and /despre (testimonials section).
**Visibility:** Not public (no post type archive, no single entry page)
**Who creates entries:** Patients, via the submission form on /recomandari Section 4. No administrator bulk import.

### Scaling Context

This CPT is designed for hundreds of entries, not dozens. The approval queue, filtering, and display mechanism must function efficiently at high volume. Display on the frontend uses no carousels, no sliders, and no timed transitions — ever. A patient in distress cannot control a carousel and may miss the testimonial most relevant to them.

### Field Specification

| Field | Type | Required | Constraints |
|-------|------|---------|------------|
| `prenume` | Short text | Required | First name only. No family name collected. |
| `city` | Short text | Optional | City of residence. Displayed only if provided and patient consented. |
| `condition` | Short text | Optional | Afecțiunea tratată — free text entry by patient. Not a relationship to the Condition CPT. This is what the patient calls their condition, which may differ from the clinical term. |
| `experience_text` | Long text | Required | Minimum 30 words. The testimonial in the patient's own words. |
| `consent_given` | Boolean | Required | Must be true for form submission to complete. Populated from GDPR checkbox on submission form. |
| `gdpr_version` | Short text | Auto | Version identifier of the privacy policy in effect at time of submission. Set automatically. |
| `submission_date` | Datetime | Auto | Set at form submission. |
| `approval_status` | Select | Required | Values: Pending / Published / Rejected. Default on submission: Pending. |
| `approval_date` | Datetime | Auto | Set when approval_status changes to Published. |
| `reviewed_by` | Short text | Auto | WordPress username of the administrator who approved or rejected. |
| `rejection_reason` | Short text | Optional | Internal note only; never shown to patients; helps admin track patterns (spam, inappropriate content, etc.) |

### Submission Form Fields (on /recomandari Section 4)

| Field | Label shown to patient | Maps to CPT field |
|-------|----------------------|------------------|
| Text input | Prenume | prenume |
| Text input | Orașul dvs. (opțional) | city |
| Text input | Afecțiunea tratată (opțional) | condition |
| Textarea | Experiența dvs. | experience_text |
| Checkbox | Am citit și accept politica de confidențialitate | consent_given |

### Display Rules at Volume

**Phase 1 (at launch):**
- All approved entries displayed in a vertical stack, ordered by approval_date descending
- No load-more button; no filter; full list visible
- Expected volume: 0–30 approved entries at launch

**Phase 2 (when volume grows):**
- Load-more button when approved count exceeds 12 visible entries (not infinite scroll)
- Optional condition filter: text links above the testimonial stack (e.g., "Toate / Hernie de disc / Tumori cerebrale"). Condition values drawn from the condition field of published entries.
- No carousel. No slider. No timed rotation. Ever.

### Cross-Page Visibility

Approved (Published) entries appear on three surfaces simultaneously:

| Surface | Condition | Maximum shown |
|---------|-----------|--------------|
| /recomandari Section 3 | ≥ 2 approved | All approved, most recent first |
| Homepage Section 6 | ≥ 2 approved + section unhidden | 3 most recent approved |
| /despre (between Sections 7 and 8) | ≥ 2 approved + section unhidden | 2 most recent approved |

All three surfaces query the same CPT. No content duplication in the database.

---

## 2.5 Timeline Event

**Admin label:** Timeline — Parcurs profesional
**URL pattern:** None — no public URL. Entries render only within /despre Section 4 (molecule-timeline).
**Visibility:** Not public
**Who creates entries:** Administrator, from content provided by Dr. Ungureanu
**Purpose:** Tell the story of Dr. Ungureanu's professional journey. Not a CV. A narrative in time.

### The CV vs. Timeline Distinction

A CV lists everything that happened, because completeness is its value. A timeline selects the moments that made the doctor who he is, because story is its value. A patient reading the timeline should understand the doctor's trajectory — not be overwhelmed by a list.

The category field enables this: administrators select entries that tell a story and assign appropriate categories, rather than importing every course attended or every paper published.

### Field Specification

| Field | Type | Required | Constraints |
|-------|------|---------|------------|
| `year` | Number | Required | 4-digit year of the event. |
| `title` | Short text | Required | The name of the milestone. Written as a patient could read it — not an abbreviation or institutional code. Example: "Rezidențiat în Neurochirurgie, Institutul Clinic Fundeni, București" |
| `category` | Select | Required | One of the 9 categories below. Controls visual grouping and filtering in Phase 2. |
| `description` | Short text (max 200 chars) | Optional | Brief contextual note. What this milestone meant. Not required for every entry — used when the title alone does not convey significance. |
| `institution` | Short text | Optional | Formal name of the institution. |
| `location` | Short text | Optional | City and country. Country is required for any entry outside Romania. |
| `photo` | Image | Optional | Used only for milestone-category entries (e.g., a photograph from a landmark event). Not used for routine education or course entries. |
| `display_order` | Number | Required | Controls chronological display order. Entries within the same year are sorted by display_order. |
| `is_active` | Boolean | Required | Default: true. Inactive entries are hidden from the timeline without deletion. |

### Category Values

| Category | Examples |
|----------|---------|
| `education` | Medical school, undergraduate degrees, academic training |
| `residency` | Formal specialization period (rezidențiat) |
| `fellowship` | Post-residency specialized training at a distinct institution |
| `exchange` | International academic or clinical exchange; visiting scholar programs |
| `course` | Continuing education course relevant to current practice |
| `certification` | Formal certification or attestation (document issued by recognized body) |
| `academic` | Academic position, research role, publication milestone, teaching appointment |
| `media` | Notable media appearance or public educational event |
| `milestone` | Founding of Sfatul Neurochirurgului; any landmark professional moment that shaped the doctor's direction |

### The Sfatul Neurochirurgului Founding Entry

One entry with category = milestone must document the founding of Sfatul Neurochirurgului. This entry is not optional. It signals to patients that the doctor's commitment to patient education is intentional, sustained, and has a history. The title field should name the event; the description field should state why it was created.

### Display Logic

- Entries are displayed by display_order ascending (low numbers = early career = top of timeline)
- Within the same year, display_order determines sequence
- Inactive entries are not rendered
- The timeline is not filterable in Phase 1; category-based filtering may be introduced in Phase 2

---

## 2.6 Media Item

**Admin label:** Media — Import social
**URL pattern:** None — no public URL. This CPT is a staging area, not a content destination.
**Visibility:** Not public
**Phase availability:** Phase 1 — CPT registered but not populated. Phase 2 — active; populated by Make automation pipeline.
**Purpose:** Receive and stage social media content created by the Make automation pipeline, pending admin review and conversion to a published Sfatul Neurochirurgului Article.

### What This CPT Is Not

Media Item entries are never displayed to site visitors. They are not articles. They are not embeds of live social content. They are intermediate staging objects that exist only inside the WordPress admin until an administrator converts them to a published SN Article — or rejects them.

### Field Specification

| Field | Type | Required | Constraints |
|-------|------|---------|------------|
| `source_platform` | Select | Required | Values: Instagram / Facebook / YouTube. Set by Make. |
| `original_url` | URL | Required | The URL of the original post or video on the source platform. Never displayed to patients. |
| `media_type` | Select | Required | Values: Image / Video / Text only. Set by Make based on post content. |
| `auto_title` | Short text | Required | Auto-generated by Make from the first sentence of the caption or the YouTube video title. Max 100 chars. Admin edits this before publishing as an article. |
| `auto_description` | Rich text | Required | Auto-generated by Make from the full post caption or YouTube video description. Admin edits for tone, reading level, and medical term definitions before publishing. |
| `thumbnail_url` | URL | Optional | Image URL from the social post. Make downloads the image and uploads it to the WordPress Media Library; this field stores the resulting WordPress attachment URL. |
| `related_article` | Relationship (to SN Article) | Optional | Admin may link to an existing SN Article if this media item extends or illustrates existing content. |
| `approval_status` | Select | Required | Values: Draft / Approved / Rejected. Default: Draft (set by Make). Changed to Approved when admin converts to SN Article; Rejected if not suitable. |
| `make_scenario_id` | Short text | Auto | Identifier of the Make execution that created this entry. Stored for pipeline audit trail. |
| `import_date` | Datetime | Auto | Set when Make creates the entry. |

### Relationship to Sfatul Neurochirurgului Article

Media Items are not articles. They are raw material. The workflow from Media Item to published article requires human editorial action — there is no automated conversion.

When an administrator approves a Media Item, they:
1. Edit auto_title to form a patient-question title
2. Edit auto_description to meet tone requirements, add medical term definitions, and structure for reading
3. Create a new SN Article entry with the edited content
4. Set SN Article approval_status to Published
5. Set Media Item approval_status to Approved (closing the loop for audit purposes)

---

# 3. Editorial Workflows

---

## 3.1 Colleague Recommendations Workflow

Content type: Colleague Recommendation CPT
Entry method: Administrator only — no public form

```
Dr. Ungureanu identifies a colleague to feature
        │
        ▼
Dr. Ungureanu collects and provides:
  · Full name and title
  · Specialty and institution
  · Professional context (1 sentence)
  · Recommendation text (in colleague's voice)
  · Professional portrait (photo file or approved source)
        │
        ▼
Administrator creates entry in WordPress → Recomandări colegi
  · Fills all required fields
  · Uploads photo
  · Sets display_order
  · is_active = true
        │
        ▼
Entry appears in /recomandari Section 1
```

**Update workflow (institution change, removal request):**
```
Dr. Ungureanu requests update or removal
        │
        ▼
Administrator edits relevant fields
  OR
Administrator sets is_active = false
        │
        ▼
Entry updated or hidden immediately — no re-approval queue
```

No email notifications. No pending states. No public-facing actions.

---

## 3.2 Patient Testimonial Workflow

Content type: Testimoniale CPT
Entry method: Patient submission form on /recomandari

```
Patient reads Section 2 (colleague recommendations)
  and Section 3 (existing patient experiences)
        │
        ▼
Patient fills submission form (Section 4):
  · Prenume (required)
  · Oraș (optional)
  · Afecțiunea tratată (optional)
  · Experiența dvs. (required, min 30 words)
  · GDPR consent checkbox (required)
        │
        ▼
Form validates — all required fields present, consent = true
        │
        ▼
WordPress creates Testimoniale entry
  · approval_status: Pending
  · submission_date: now
  · gdpr_version: current policy version
        │
        ▼
Patient sees success message:
  "Vă mulțumim. Mesajul dvs. va fi revizuit și publicat în curând."
        │
        ▼
Admin receives notification email (destination: Q16)
  Subject: "Testimonial nou în așteptare — [prenume]"
  Body: full experience_text + submission_date + direct link to admin review
        │
        ▼
Admin opens entry in WordPress → Testimoniale → Pending
        │
        ├── Approve:
        │     approval_status → Published
        │     approval_date → now
        │     reviewed_by → admin username
        │     Entry appears on /recomandari + homepage + /despre (if ≥ 2 approved)
        │
        └── Reject:
              approval_status → Rejected
              rejection_reason → internal note (optional)
              reviewed_by → admin username
              Entry never displayed
              No notification sent to patient
```

**Admin panel requirements for volume handling:**
- Filter by approval_status (Pending / Published / Rejected)
- Sort by submission_date (newest first)
- Bulk action: Approve selected / Reject selected
- Search by prenume, condition (free text)

---

## 3.3 Media Automation Workflow (Phase 2 only)

Content type: Media Item CPT → Sfatul Neurochirurgului Article CPT
Entry method: Make automation pipeline

**Phase 1 note:** This workflow does not exist in Phase 1. The Make integration is configured and activated in Phase 8. In Phase 1, social media content that the administrator wants to adapt as an article is handled manually (Workflow 3.4).

```
Dr. Ungureanu publishes content on Instagram, Facebook, or YouTube
        │
        ▼
Make scenario triggers (one per platform):
  · Platform API detects new post
  · Make parses content:
      source_platform, original_url, media_type,
      auto_title (first sentence / video title),
      auto_description (full caption / description),
      thumbnail (downloaded → uploaded to WP Media Library)
        │
        ▼
Make creates Media Item entry via WordPress REST API
  · approval_status: Draft
  · make_scenario_id: current Make execution ID
  · import_date: now
        │
        ▼
Make sends notification email to admin (Q16)
  Subject: "Conținut nou de publicat: [auto_title]"
  Body: source_platform, auto_title, first 200 chars of auto_description,
        link to Media Item in WP admin
        │
        ▼
Admin opens Media Item in WordPress
        │
        ▼
Admin reviews auto_title and auto_description:
  · Rewrites auto_title as a patient question
  · Edits auto_description: tone, paragraph structure,
    medical term definitions, reading level check
  · Confirms or adjusts media_type
        │
        ├── Suitable for publication:
        │     Admin creates new SN Article entry with edited content
        │     Sets approval_status: Published → article goes live
        │     Sets Media Item approval_status: Approved
        │     Article appears on /sfatul-neurochirurgului + homepage Section 8
        │
        └── Not suitable for publication:
              Admin sets Media Item approval_status: Rejected
              No content reaches the frontend
```

**Non-negotiable:** No content from this pipeline is published without an explicit human publishing action. Draft creation is automated; publication is always manual.

---

## 3.4 Article Publication Workflow

Content type: Sfatul Neurochirurgului Article CPT
Entry method: Administrator (from original content by Dr. Ungureanu)

```
Dr. Ungureanu has content for a new article
  (written, dictated, or sketched in notes form)
        │
        ▼
Administrator creates SN Article entry in WordPress:
  · source_platform: Original
  · approval_status: Draft
  · Formats body_content: heading structure,
    paragraph breaks, medical term definitions
        │
        ▼
Dr. Ungureanu reviews draft:
  · Directly in WordPress (if admin access granted)
    OR
  · Via shared preview link
        │
        ├── Approved:
        │     Admin sets approval_status: Published
        │     Sets publish_date, reading_time, featured_image
        │     Article goes live on /sfatul-neurochirurgului
        │     Homepage Section 8 unhides if ≥ 3 published articles
        │
        └── Changes requested:
              Admin edits draft per feedback
              Returns to Dr. Ungureanu review step
```

---

## 3.5 Timeline Maintenance Workflow

Content type: Timeline Event CPT
Entry method: Administrator, on Dr. Ungureanu's instruction

**Initial population (one-time at Phase 5):**
```
Dr. Ungureanu provides complete career milestone list
  (all 7 content categories: education, residency, exchange,
   course, certification, academic, milestone)
        │
        ▼
Administrator creates one Timeline Event entry per milestone:
  · Assigns category, year, title, institution, location
  · Sets display_order (chronological)
  · Uploads photo for milestone-category entries only
        │
        ▼
Timeline renders on /despre Section 4
```

**Ongoing maintenance (new milestones):**
```
Dr. Ungureanu acquires new certification / completes course /
launches new initiative
        │
        ▼
Dr. Ungureanu notifies administrator with milestone details
        │
        ▼
Administrator creates new Timeline Event entry:
  · Appropriate category and year
  · display_order set to place it chronologically
        │
        ▼
Entry appears on timeline immediately
```

No approval queue. No email notifications. No public submission. Administrator acts on Dr. Ungureanu's direct instruction only.

---

# 4. Phase 1 vs. Phase 2

---

## Phase 1 — Manual Content Entry and Approvals

Phase 1 is the complete, shippable MVP at launch. Every content operation is manual. No external automations are active. All editorial quality is maintained through admin discipline and Dr. Ungureanu's review.

### Phase 1 Content Operations

| Content type | Entry method | Approval method |
|-------------|-------------|----------------|
| Condition pages | Admin creates CPT entry from Dr. Ungureanu's content | Dr. Ungureanu reviews draft before admin publishes |
| SN Articles | Admin creates entry from Dr. Ungureanu's original content | Dr. Ungureanu reviews draft; admin publishes |
| Colleague recommendations | Admin creates entry from content provided by Dr. Ungureanu | No approval queue — admin creates on instruction |
| Patient testimonials | Patient submits via /recomandari form | Admin reviews and approves in WordPress |
| Timeline events | Admin creates entries from Dr. Ungureanu's milestone list | No approval queue — admin creates on instruction |
| Media items | CPT registered but not used | — |
| Social media content | Admin manually adapts social post captions as SN Articles when relevant | Same as SN Article workflow above |

### Phase 1 Frontend Display

| Area | Phase 1 behavior |
|------|-----------------|
| Sfatul Neurochirurgului hub | All published articles, reverse chronological, no filter |
| Testimonials on /recomandari | Vertical stack, all approved, most recent first, no filter, no load-more |
| Conditions on /afectiuni | Full grid, ordered by display_order, no filter |
| Homepage SN preview (Section 8) | 3 most recent published articles; hidden until ≥ 3 exist |
| Homepage testimonials (Section 6) | Hidden until ≥ 2 approved entries from Phase 6 workflow |

---

## Phase 2 — Automation and Enhanced Experience

Phase 2 extends Phase 1 without replacing it. All manual workflows continue alongside new automated operations. Phase 2 begins in Phase 8 of the project roadmap.

### Phase 2 New Capabilities

| Area | Phase 2 behavior |
|------|-----------------|
| Social content import | Make pipeline active for Instagram, Facebook, YouTube → Media Item CPT → admin review → SN Article |
| Admin notifications | Automated email on every new Make-created draft |
| SN Article display | Category or content-type filter on hub page when article count exceeds ~12. Text-based navigation links only — no dropdown menus, no select elements, no JavaScript-controlled filter widgets. |
| Testimonial display | Load-more button when approved count exceeds 12; optional condition filter (text links from published condition values) |
| Condition display | Optional grouping by condition category on /afectiuni index if count exceeds ~12 |
| Timeline display | Optional category filter on the timeline in Phase 2 |
| Video content | YouTube videos rendered as lazy oEmbed in SN Article pages (no autoplay, no live social widget) |

### Phase 2 Does Not Introduce

| Capability | Reason excluded |
|-----------|----------------|
| Auto-publish of any content | Manual approval is non-negotiable regardless of source |
| AI-generated content | Every published word carries Dr. Ungureanu's name and authority |
| Live social media feed embeds | Anti-pattern per COMPONENT_INVENTORY.md; unpredictable third-party content; privacy risk |
| Carousels or sliders | Anti-pattern per COMPONENT_INVENTORY.md; patients in distress cannot control timed content |
| Comment sections | No patient forum; no unmoderated public content |
| Patient portals or user accounts | Out of scope (PROJECT_BRIEF.md §What Is Out of Scope) |
| E-commerce or payment processing | Out of scope |

---

# 5. Open Questions and Blocking Dependencies

The following questions must be resolved before the corresponding content model areas can be populated or launched.

| Q# | Question | Blocks |
|----|----------|--------|
| Q1 | List of acute-presentation conditions requiring organism-emergency-notice | is_emergency field on Condition CPT; emergency notice cannot be deployed without confirmed list |
| Q3 | Trust indicator figures (years of experience, specialization context, institutional context) | Homepage Section 5; molecule-card-trust cannot show unconfirmed numbers |
| Q4 | Full condition list with patient-readable titles and card descriptions | Condition CPT cannot be populated; /afectiuni index cannot go live |
| Q7 | Doctor photography (hero image + approachable portrait) | Homepage hero; /despre biography section; neither can launch without real photography |
| Q9 | Minimum 3 articles for Sfatul Neurochirurgului | SN hub page and homepage Section 8 cannot go live |
| Q11 | Contact form routing destination (admin notification email) | /contact form cannot route submissions |
| Q13 | Location data per location | molecule-location-card cannot be built; /programari cannot launch |
| Q15 | Patient-facing phone number | Footer, /contact hero, location cards |
| Q16 | Admin email address | Contact form routing, testimonial notifications, Make draft notifications |
| Q20 | Privacy policy text and legal review | /politica-de-confidentialitate; contact form and testimonial form GDPR checkboxes |
| Q24 | Colleague recommendation entries (photo, name, specialty, institution, context, text) | /recomandari Section 1 cannot be populated |
| Q25 | Make account registration; API quotas per platform | Phase 2 automation pipeline cannot be configured |
| Q18 | Social media account confirmation and API access | Make scenarios for Instagram, Facebook, YouTube cannot be configured |
| — | Biography text (3–4 paragraphs) | /despre cannot launch |
| — | Philosophy/values text (3–4 principles in doctor's voice) | /despre Section 3 cannot be populated |
| — | Timeline milestone list (all 7 categories) | /despre Section 4 cannot be built |
| — | Academic publications list with lay-language summaries | /despre Section 6 cannot be populated |
| — | Patient guidance article content (prima-consultatie, pentru-apartinatori, intrebari-frecvente, recuperare) | The 4 SN patient guidance articles cannot be published without source content from Dr. Ungureanu |

---

*Content Models version: 1.0 — 2026-06-28*
*Source: docs/tasks/00_PROJECT_ROADMAP.md v1.1, docs/tasks/01_INFORMATION_ARCHITECTURE.md v1.0*
*Next: docs/tasks/03_HOMEPAGE.md*
