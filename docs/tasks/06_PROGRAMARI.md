# Programări

## georgeungureanu.doctor

**Purpose of this document:** Freeze the complete /programari page and the appointment journey it anchors before implementation. Every section, its purpose, its content requirements, and the logic of its relationship to other pages are locked here.

**This document defines:**
- Why /programari is the universal CTA destination and what that means
- The complete patient journey from homepage to appointment request
- The page information architecture (8 sections)
- Location card content model and field requirements
- Cluj-Napoca and Baia Mare location documentation principles
- What to bring — content model
- How the consultation works — process documentation
- FAQ — categories and question inventory
- The /programari → /contact relationship and why it exists
- Mobile experience, accessibility, Phase 2, blocking dependencies, and validation

**Source of truth:**
- `docs/tasks/00_PROJECT_ROADMAP.md` v1.1
- `docs/tasks/01_INFORMATION_ARCHITECTURE.md` v1.0
- `docs/tasks/02_CONTENT_MODELS.md` v1.0
- `docs/tasks/03_HEADER_AND_NAVIGATION.md` v1.0
- `docs/tasks/04_DESIGN_SYSTEM_TOKENS.md` v1.0
- `docs/tasks/05_HOMEPAGE.md` v1.0
- `docs/project/PATIENT_CENTERED_MANIFESTO.md`
- `docs/project/WEBSITE_GOALS.md`
- `docs/project/TARGET_AUDIENCE.md`
- `docs/implementation/05_PROGRAMARI_PAGE.md`

**Not superseded by this document:** `docs/implementation/05_PROGRAMARI_PAGE.md` remains the step-by-step build reference for Elementor implementation. This document expands the content scope (adding Sections 5–7: What to Bring, How the Consultation Works, FAQ) which are not specified in that implementation guide.

---

# 1. Purpose of /programari

## 1.1 Why Every CTA on the Site Routes Here

Every page on this site except /programari and /contact carries a primary CTA labeled "Programează o consultație." Every one of those buttons routes to /programari. Not to /contact. Not to a modal. Not to a phone number. To /programari.

This is not a UX convention. It is an answer to a specific problem that the patient has.

**The problem:** A patient who is frightened, newly diagnosed, and searching for a neurosurgeon is not yet ready to make contact. They do not know whether this doctor is accessible to them. They do not know if there is a clinic in their city. They do not know if the schedule is compatible with their situation. They do not know how appointment booking works.

A patient who is sent directly to a contact form before these questions are answered will typically abandon the process. They feel uncertain. They do not know if they are in the right place. They do not know what happens after they fill in the form. The uncertainty is the barrier.

**The solution /programari provides:** Before asking a patient to make contact, the site removes every practical obstacle to that decision. /programari answers four questions:
1. **Where?** — Which city, which clinic, which hospital
2. **Is it accessible?** — Address, how to get there, practical notes
3. **When?** — Days and hours at the specific location that serves this patient
4. **How?** — The exact next step to book an appointment

A patient who can answer all four questions is ready to contact. A patient who cannot has not been given enough to proceed.

/programari is not a booking engine. It is an uncertainty-removal page. It does its job, then routes the patient to /contact to complete the appointment request.

## 1.2 Why Contact Is Intentionally Separated

/contact does not appear in the navigation. It is not reachable by clicking any navigation item. It is not reachable from the header CTA. It is reachable from exactly one place: the CTA banner on /programari.

This is a deliberate decision, documented in `docs/tasks/01_INFORMATION_ARCHITECTURE.md` §9.

The routing chain is:
```
Any page → "Programează o consultație" → /programari → "Contactați-ne" → /contact
```

**Why this sequence is enforced:**

A patient who contacts the practice without knowing where Dr. Ungureanu consults, without knowing if their city has a location, and without knowing what to bring — is a patient who may not follow through. They may cancel because they assumed the location would work and later discovered it would not. They may show up unprepared. They may feel the practice did not take care of them before they even arrived.

By placing /programari between every CTA and /contact, the site ensures that every patient who reaches the contact form has already confirmed geographic access and understood the logistics. They contact with commitment, not with uncertainty.

**This also protects /contact from premature queries.** If every CTA routed directly to the contact form, the form would receive inquiries from patients who do not yet know if this doctor is accessible to them — requiring staff to answer geographic questions that the website should have answered first.

## 1.3 How This Reduces Patient Anxiety

A patient with a neurological diagnosis is already managing a significant level of fear. Adding logistical uncertainty on top of that fear — "But is there a clinic near me? What do I need to bring? What will happen at the consultation? How long will I wait?" — compounds the anxiety.

/programari addresses logistical anxiety specifically and directly:
- Location cards answer geographic anxiety before any commitment is required
- "What to Bring" (Section 5) addresses the fear of arriving unprepared
- "How the Consultation Works" (Section 6) addresses the fear of the unknown — patients who do not know what to expect from the first consultation often delay making contact because the consultation itself feels threatening
- FAQ (Section 7) addresses the long tail of specific worries — insurance, whether a family member can come, what happens if the tests are old

The page's emotional contract is: *you will leave this page with no unanswered logistical question standing between you and contact.*

## 1.4 Why Location Information Comes Before Communication

If a patient does not know whether this doctor is accessible to them, they will not fill in a contact form. This is not a reluctance to act — it is rational behavior. No person fills in a form to request an appointment at a location they do not yet know is accessible.

The geographic question is therefore the first practical question /programari answers — before process, before FAQ, before anything else. Location cards are Section 3 of the page (immediately after the hero and brief introduction). The patient sees clinic and city information before they encounter any CTA asking them to act.

This sequencing is non-negotiable. Location cards first. Process second. FAQ third. Contact invitation last.

The /programari page exists specifically because `docs/project/TARGET_AUDIENCE.md` identifies geographic orientation as "the most underappreciated barrier in Romanian medical websites" — a patient in Baia Mare who cannot immediately see that this doctor also consults there will assume the doctor is only accessible from Cluj-Napoca and may not pursue an appointment.

---

# 2. Patient Journey

## 2.1 The Full Appointment Journey

```
Homepage (/)
  ↓
  Patient clicks "Programează o consultație" (from hero, CTA section, or any page)
  ↓
/programari
  ↓
  Section 1 — Hero: patient understands what this page does
  ↓
  Section 2 — Introductory explanation: patient understands geography, scope, and next step
  ↓
  Sections 3–4 — Location cards (Cluj-Napoca + Baia Mare): patient identifies accessible location
  ↓
  Section 5 — What to bring: patient prepares mentally for the visit
  ↓
  Section 6 — How the consultation works: patient understands the process; fear of unknown is reduced
  ↓
  Section 7 — FAQ: patient resolves remaining specific questions
  ↓
  Section 8 — CTA banner: patient clicks "Contactați-ne" → /contact
  ↓
/contact
  ↓
  Patient completes contact form (name, email, phone, reason)
  ↓
  Appointment request received
  ↓
  24-hour response → appointment confirmed
```

## 2.2 Why the Sequence Exists

**Hero first:** The patient arrives from a CTA that promised "scheduling a consultation." The hero confirms they are in the right place, states what this page does, and sets the expectation: this is where you find locations and understand how to book.

**Introductory explanation second:** Before the location cards, a brief orientation paragraph tells the patient what they are looking at. Dr. Ungureanu consults and operates at multiple locations in Cluj-Napoca and at a location in Baia Mare. The patient should choose the location most convenient for them and then contact the practice. This removes any confusion about why there are multiple cards and what to do with them.

**Location cards third and fourth (first, most critical):** The first question a patient asks is "Can I even get there?" This must be answered before anything else. The location cards are the primary content of the page. Everything else supports their existence and completes the patient's preparation.

**What to bring fifth:** A patient who has found their accessible location immediately wants to know what they need to prepare. "What to Bring" is in natural reading sequence after the location decision — the patient has committed to attending and is now preparing.

**How the consultation works sixth:** After deciding they are going, and after knowing what to bring, the patient wants to understand what will happen. "How the Consultation Works" demystifies the experience and reduces the anxiety of the unknown. This is especially important for patients who have never seen a neurochirurg before and have no reference point for what a neurosurgical consultation involves.

**FAQ seventh:** The patient has now read through the practical preparation content. Specific questions remain — about insurance, about family members, about old imaging studies. The FAQ is the appropriate place for these — accessible to patients with specific concerns without cluttering the main content.

**CTA banner eighth:** The patient who has traveled through the full page is prepared, oriented, and ready. The CTA is the last element on the page — not the first, not the most prominent. It appears after the patient has been given everything they need to make a confident decision.

## 2.3 Alternative Entry Points

Not every patient arrives at /programari from the homepage. Some entry points:
- Header CTA from any page — same journey
- Footer "Programări" link — same journey
- /contact page (referenced within /programari CTA — patients do not navigate backwards)
- Direct URL (bookmark, search result for "Dr. Ungureanu programare") — same journey; the page works standalone

All of these deliver the same experience. The page is self-contained and assumes the patient may have no prior context from other pages.

---

# 3. Information Architecture

## 3.1 Page Section Map

| # | Section | Organism | Background | Visibility |
|---|---------|----------|-----------|-----------|
| — | Header | `organism-site-header` | `color-surface` | Always |
| 1 | Hero | `organism-hero-interior` | `color-surface-warm` | Always |
| 2 | Introductory explanation | Inline atoms + molecules | `color-surface` | Always |
| 3 | Cluj-Napoca locations | Part of `organism-location-directory` | `color-surface-warm` | When ≥1 Cluj card has confirmed data |
| 4 | Baia Mare location | Part of `organism-location-directory` | `color-surface-warm` | When ≥1 Baia Mare card has confirmed data |
| 5 | What to bring | `molecule-process-list` or structured atom blocks | `color-surface` | Always |
| 6 | How the consultation works | `organism-how-it-works` (consultation variant) | `color-surface-warm` | Always |
| 7 | FAQ | `organism-faq` | `color-surface` | Always |
| 8 | Final CTA to Contact | `organism-cta-banner` (/programari variant) | `color-ink` | Always |
| — | Footer | `organism-site-footer` | `color-ink` | Always |

**Background alternation:** warm → surface → warm → surface → warm → surface → ink. No two adjacent sections share a background.

Note: Sections 3 and 4 are both within `organism-location-directory` — they share the same background (`color-surface-warm`) as one organism with two city sub-groups. The background reads as a single warm section containing both city groups.

Sections 5, 6, and 7 are new content sections not present in `docs/implementation/05_PROGRAMARI_PAGE.md`. They extend the page with patient preparation content and distinguish this document from the earlier implementation guide.

## 3.2 Purpose of Each Section

**Section 1 — Hero**
Orients the patient. Confirms they are in the right place. H1 names the page's function — not the doctor's titles. Breadcrumb: Acasă → Programări. The hero is text-only (no photography); the LCP element is the H1.

**Section 2 — Introductory explanation**
2–3 sentences. States that Dr. Ungureanu consults and operates at multiple locations in Cluj-Napoca and at a location in Baia Mare. Invites the patient to find the most convenient location below. Does not enumerate locations here — that is Section 3/4's job.

**Section 3 — Cluj-Napoca locations**
One or more location cards for Cluj-Napoca. Each card contains all required fields. If multiple locations exist, they appear in defined order (consultation-first ordering). This is the patient's primary geographic question answered.

**Section 4 — Baia Mare location**
One or more location cards for Baia Mare. Presented with the same care as Cluj-Napoca locations — not subordinated or minimized. A patient from Baia Mare reads this section with the same trust and completeness as a Cluj patient reads Section 3.

**Section 5 — What to bring**
A structured list of documents, imaging, and preparation items the patient should bring to their first consultation. Reduces anxiety about arriving unprepared. Written in plain Romanian; no clinical jargon. Non-judgmental about what the patient may or may not have — all scenarios addressed.

**Section 6 — How the consultation works**
Four-step description of the consultation process (Arrival → Discussion → Review of investigations → Next steps). No medical promises. No guarantees. Only process clarity. The patient who reads this knows exactly what will happen during the 45–60 minutes of the first consultation.

**Section 7 — FAQ**
Six categories of patient questions. Accordion component. No nested accordions. Covers appointments, documents, imaging, family members, payment and administrative matters, and follow-up. Answers written in plain Romanian. Tone is warm and direct — the same voice as the rest of the site.

**Section 8 — Final CTA to Contact**
One button. One destination: /contact. Label: "Contactați-ne." No secondary CTA. No options. This is the end of the /programari journey — the patient who clicks this button is ready.

---

# 4. Location Cards

## 4.1 Purpose

Each location card is a self-contained answer to the four questions a patient needs answered:
1. Where is it? (city, institution name, address)
2. Is it accessible? (practical notes, parking if known)
3. When is Dr. Ungureanu there? (days, hours)
4. How do I book? (booking method, phone number)

No card is published until all required fields are populated with confirmed data. A card with placeholder or missing fields is hidden, not published.

## 4.2 Required Fields (per card — card cannot be published without all of these)

| Field | Content | Notes |
|-------|---------|-------|
| City | "Cluj-Napoca" or "Baia Mare" | Always known from the city group |
| Institution name | Patient-facing name — the name patients recognize | Not the legal entity name. Example: "Clinica [Name]" or "Spitalul Clinic Județean Cluj-Napoca" |
| Visit type | One of: Consultații / Intervenții chirurgicale / Consultații și intervenții | Displayed as a badge. Determines card ordering within the city group. |
| Available days | Days of the week Dr. Ungureanu is present at this location | Not the institution's general schedule — specifically Dr. Ungureanu's days |
| Time intervals | Dr. Ungureanu's hours at this location | Format: "10:00 – 18:00" per day or a range |
| Phone number | The number a patient should call to book or inquire | May be a direct line, a clinic reception, or a location-specific number. All instances published as `tel:` links |
| Booking method | The exact process for booking an appointment at this location | Plain Romanian statement of the method. Examples: "Programare prin formularul de contact de pe site" / "Programare telefonic la numărul de mai sus" / "Programare prin recepția clinicii" |

## 4.3 Optional Fields (included only when confirmed — never guessed or estimated)

| Field | Notes |
|-------|-------|
| Short description | 1–2 sentences about this location from the patient's perspective (what kind of activity happens here, any distinguishing feature). Not marketing language. |
| Google Maps link | Strong recommendation — opens the correct address in the patient's native maps application. The button is omitted entirely if the URL is not confirmed. |
| Email (location-specific) | Only if a per-location email exists and is patient-facing. If all contact goes through one address, this field is omitted. |
| Patient notes | Practical patient information: what entrance to use, what floor, any requirements specific to this location (e.g., "Adresați-vă recepției la intrarea principală, etajul 2") |
| Parking | Available? Free or paid? Street or private lot? Only stated when confirmed. |
| Accessibility | Wheelchair access? Lift? Ground floor? Only stated when confirmed. |

## 4.4 No Embedded Maps

No map is embedded on this page. No Google Maps iframe. No map widget. No interactive map of any kind.

Maps require JavaScript from Google's infrastructure, add significant page weight, create privacy implications (tracking on initial page load), and introduce layout shift risk (CLS). On mobile — which is where most patients will be — an embedded map that cannot be scrolled past without triggering zoom is a usability anti-pattern.

**Every Maps button is a plain `<a>` link** → a Google Maps URL that opens the correct address in the patient's native maps application. On iOS this opens Apple Maps or Google Maps. On Android this opens Google Maps. On desktop it opens the Google Maps website in a new tab.

The button is labeled "Cum ajungeți →" with an `aria-label` that names the specific location: "Direcții pentru [Institution Name] în Google Maps". It opens in a new tab (`target="_blank" rel="noopener"`).

## 4.5 CTA Label

The button that opens Google Maps uses the label "Cum ajungeți →" — patient-facing, action-oriented, plain Romanian. Not "Google Maps" (brand name, not an action). Not "Hartă" (too abstract). Not "Direcții" (correct but less warm than "Cum ajungeți").

## 4.6 Card Visual Structure

```
[Visit type badge] — "Consultații" / "Intervenții chirurgicale" / "Consultații și intervenții"
[Institution name — H4]
[Address — body-sm]
[Divider — 1px, color-border]
[Days — molecule-meta: calendar icon + days]
[Hours — molecule-meta: clock icon + hours]
[Divider — 1px, color-border]
[Phone — molecule-meta: phone icon + tel: link]
[Email — molecule-meta: email icon + mailto: link] (optional)
[Booking method — body-sm, color-ink-secondary]
[Patient notes — molecule-meta: info icon + text] (optional)
[Parking — molecule-meta: car icon + text] (optional)
[Accessibility — molecule-meta: accessibility icon + text] (optional)
[Divider — card footer]
[Maps button — atom-button-ghost → Google Maps URL] (strongly recommended)
```

Card background: `color-surface` — cards are visually distinct from the `color-surface-warm` section background that contains them. Border: 1px `color-border`. Radius: `radius-card` (8px). Padding: `space-8` (32px) desktop, `space-6` (24px) mobile.

## 4.7 Launch States

**State 1 — Full launch (required):** All active locations with all required fields confirmed and published. No hidden cards.

**State 2 — Partial launch (acceptable with conditions):** At minimum one complete card per city group. Remaining cards hidden (not deleted). The closing note at the bottom of Section 4 — "Nu ați găsit o locație convenabilă? Contactați-ne." — covers the gap.

Constraint on State 2: the one published card per city must serve consultation visits. A patient seeking a first consultation cannot be given only a surgery-only card with no path to a first appointment.

**State 3 — Not acceptable:** No location data confirmed. Page must not be published in this state. If State 3 is unavoidable, the homepage primary CTA routes temporarily to /contact directly, and /programari is not published until State 1 or State 2 is achievable.

---

# 5. Cluj-Napoca Locations

## 5.1 Multiple Locations

Dr. Ungureanu may consult and operate at multiple locations in Cluj-Napoca — multiple clinics, hospitals, or medical centers. The exact count and nature of these locations is confirmed by Dr. Ungureanu (Q13 — BLOCKING).

The implementation guide (`docs/implementation/05_PROGRAMARI_PAGE.md`) anticipates 2–3 Cluj-Napoca locations. This document does not fix a maximum — it fixes the principles for how multiple locations are documented and presented, regardless of count.

## 5.2 Ordering Principles

Within the Cluj-Napoca city group, location cards are ordered by visit type:

| Order | Visit type | Rationale |
|-------|-----------|-----------|
| First | Consultation only | A patient seeking a first appointment is most likely seeking a consultation. The most relevant card leads. |
| Second | Consultation + surgery (both) | Cards offering both types follow — they serve the wider range of patient needs. |
| Third | Surgery only | Surgery-only locations are relevant to patients already in the treatment process. They appear last for first-time visitors. |

Within the same visit-type tier, if multiple locations exist at the same tier, ordering follows Dr. Ungureanu's guidance (e.g., primary hospital first, private clinic second).

## 5.3 Primary vs. Secondary Locations

The documentation distinguishes between:

**Primary consultation location:** The location where Dr. Ungureanu most regularly sees new patients. This card appears first. The location data for this card is the highest priority for Q13 resolution.

**Secondary locations:** Additional Cluj-Napoca sites — surgical, or additional consultation clinics. These cards appear after the primary card and serve patients who need a different type of visit or a different schedule.

No card is labeled "primary" or "secondary" visibly to the patient — the ordering conveys the hierarchy without explicit labeling. A patient sees location cards in logical order; they do not see a hierarchy designation.

## 5.4 Mobile Behavior

On mobile (<768px), all cards within the Cluj-Napoca city group stack to a single column. The ordering principle is maintained — the consultation-first card is still the first card a mobile patient scrolls past.

No horizontal scrolling. No card carousel. No "see more" within the city group that hides cards below a fold. All Cluj-Napoca cards are visible in a single vertical scroll.

The city header ("CLUJ-NAPOCA" overline + "Locații în Cluj-Napoca" H3) appears above the first card and remains visible. On mobile this ensures the patient knows which city they are reading.

## 5.5 No Dropdown Filters

There are no dropdown menus, no tabbed selectors, no JavaScript-controlled filter widgets on this page.

A patient who wants to see only consultation locations cannot filter for them. They see all cards in order and identify the relevant one by reading the visit type badge on each card.

This is the correct decision for this patient population:
- Older patients are less comfortable with interactive filter UI
- Anxious patients do not want to feel they might be missing information hidden behind a filter
- 2–3 Cluj-Napoca cards can be scanned in seconds without a filter — the complexity of a filter interface is not justified by the card count

If the number of locations grows dramatically in later phases, revisit this decision with a documented rationale. Do not add a filter UI to Phase 1 based on hypothetical future growth.

## 5.6 City Group Structure

The Cluj-Napoca group is visually contained:

```
[city overline — "CLUJ-NAPOCA" — color-ink-secondary]
[city H3 — "Locații în Cluj-Napoca"]
[card grid — 2 columns desktop, 1 column mobile]
  [card 1 — consultation-first or primary]
  [card 2 — if exists]
  [card 3 — if exists]
```

A visual divider (atom-divider) separates the Cluj-Napoca group from the Baia Mare group below.

---

# 6. Baia Mare

## 6.1 Presentation Principles

The Baia Mare location is presented with the same visual and content quality as the Cluj-Napoca locations. No visual hierarchy makes Baia Mare appear secondary, distant, or less important.

**The visual presentation must not suggest:**
- That Baia Mare is an afterthought
- That the Baia Mare location is somehow less serious than Cluj-Napoca
- That a patient from Baia Mare is a less typical or less expected visitor

**The visual presentation must convey:**
- That Dr. Ungureanu has a genuine, regular presence in Baia Mare
- That a patient from Baia Mare is fully served by this practice, not accommodated reluctantly
- That the Baia Mare location is an active, staffed, real medical setting

The Baia Mare card uses the same molecule-location-card template as Cluj cards. It receives the same required fields (institution name, days, hours, phone, booking method) and the same optional fields when available. No difference in design or information density.

## 6.2 Relationship with Cluj Locations

The two city groups appear on the same page, separated by a clear visual divider. They are not competing — they serve different patient populations geographically.

The page's introductory explanation (Section 2) names both cities explicitly from the first paragraph. A patient from Baia Mare who arrives at /programari reads about both cities immediately, before scrolling to any location card. They know before they see the cards that there is a Baia Mare location.

The Baia Mare group is visually positioned after the Cluj-Napoca group — Cluj-Napoca has more locations and is typically the larger pool of patients. This ordering does not imply importance. A patient from Baia Mare who scrolls past the Cluj cards to reach the Baia Mare group is scrolling through information that is not relevant to them — but the scroll is short (one or two Cluj cards) and the Baia Mare group header ("BAIA MARE") is clear enough that they can visually skip past.

If future analysis shows a significant portion of visitors are Baia Mare patients who are confused or frustrated by the Cluj-first ordering, the section ordering can be revisited with data. This decision is based on logical organization, not on the assumption that Cluj patients are more important.

## 6.3 Trust-Building Considerations for Baia Mare Patients

A patient from Baia Mare has a specific trust question that a Cluj patient does not: "Does this doctor actually come here regularly, or is this an occasional visit that might not be available when I need it?"

The location card must address this implicitly through:
- Clear statement of days — not "periodic" or "occasional" but specific days of the week or a stated frequency
- Clear statement of hours — the same precision expected of Cluj cards
- A booking method that is specific to this location — if the Baia Mare booking uses a different phone number or a different process than Cluj, the card reflects this accurately
- A short description (optional field) that, if provided by Dr. Ungureanu, can acknowledge the regularity or nature of his presence in Baia Mare

If the Baia Mare schedule is irregular (monthly, bimonthly, or by arrangement), the card must state this honestly: "Dr. Ungureanu este prezent în Baia Mare [frequency]. Contactați-ne pentru a confirma data disponibilă." This is more trustworthy than a card that implies a regular weekly presence when the actual schedule is less frequent.

Honesty about schedule variability builds more trust than a misleadingly precise presentation that the patient will discover is inaccurate after contacting the practice.

## 6.4 Homepage Relationship

The homepage (Section 7 — Unde mă găsiți) establishes that both Cluj and Baia Mare are available, at the city level. The /programari page provides the full detail — institution name, address, schedule, phone.

A patient who arrives at /programari from the homepage already knows there are two cities. This page confirms and details what the homepage promised.

If a patient arrives at /programari directly (without visiting the homepage), the introductory text (Section 2) still names both cities. The page works as a standalone — it does not assume the patient has already seen the homepage location preview.

---

# 7. What to Bring

## 7.1 Purpose

This section addresses a specific patient anxiety: "What if I arrive without something I need?"

A patient who does not know what to bring to a neurosurgical consultation may delay making an appointment because they feel they are not ready. They may be waiting until they have "the right documents" — documents they do not know how to identify, or documents they assume are required that may not be.

The "What to Bring" section does two things:
1. It tells the patient exactly what is useful to bring
2. It reassures the patient that they can come with what they have — the doctor will advise on what additional investigations may be needed during the consultation itself

The tone is inviting and non-intimidating. "You don't need to have everything — come with what you have and we will guide you from there" is as important as the list of what to bring.

## 7.2 Content Model

### Category 1 — Trimitere și documente medicale anterioare (Referral and Previous Medical Documents)

| Item | Notes |
|------|-------|
| Trimitere medicală | From a GP or specialist who referred the patient. Not always required but useful. If the patient does not have one, they can still attend. |
| Scrisori medicale sau fișe de consultație anterioară | Previous specialist consultation notes — neurologist, orthopedist, cardiologist if relevant |
| Bilete de externare | Discharge summaries from previous hospitalizations relevant to the current condition |
| Scrisori de trimitere anterioare | Previous referrals related to the same condition |
| Note de boală sau diagnostic medical | Any written diagnosis received previously |

**Patient-facing principle:** Bring what you have. If you have no referral and no previous documents, you can still attend the consultation — the doctor will start from your current situation.

### Category 2 — Investigații imagistice (Imaging Studies)

| Item | Notes |
|------|-------|
| RMN (Imagistică prin rezonanță magnetică) | Preferred format: CD with DICOM files. Films are also acceptable. If both exist, bring both. |
| CT (Tomografie computerizată) | Same format preference as RMN. |
| Radiografii | Plain X-rays of the relevant anatomical area, if applicable. |
| Alte investigații imagistice | Echografie, scintigrafie — any imaging relevant to the current condition. |

**On imaging format:** DICOM files on CD allow the doctor to zoom, measure, and review in full detail. Printed films are a secondary option. Smartphone photographs of printed films are not useful. If only a smartphone photograph exists, the patient should be advised to obtain the original CD from the imaging center.

**On imaging age:** Imaging older than 6–12 months may need to be repeated, depending on the condition and what has changed. Bring existing imaging regardless of age — the doctor will determine during the consultation whether new imaging is required. Do not delay the consultation to obtain new imaging unless specifically advised to do so.

**On not having imaging:** If the patient has no imaging, they can still attend the consultation. The doctor will advise which investigations to pursue.

### Category 3 — Fișe și analize (Medical Records and Test Results)

| Item | Notes |
|------|-------|
| Rezultatele analizelor de sânge recente | Relevant blood work from the past 6 months if available |
| EEG (Electroencefalogramă) | If conducted for the current condition |
| EMG (Electromiografie) | If conducted for the current condition |
| Alte investigații funcționale | Any other specialist investigations related to the current condition |
| Protocoale chirurgicale anterioare | Previous surgical protocol documents if the patient has had prior neurosurgical or relevant procedures |

### Category 4 — Lista de medicamente (Medication List)

| Item | Notes |
|------|-------|
| Toate medicamentele curente | All current medications, with name, dosage, and frequency |
| Suplimentele alimentare | Vitamins, supplements, and any non-prescription products taken regularly |
| Alergii medicamentoase cunoscute | Any known drug allergies or adverse reactions |
| Anticoagulante sau antiagregante | Specifically flagged — blood thinners require specific consideration and must be disclosed |

**Patient-facing principle:** Bring the actual packaging or blister packs if a written list is not practical. A clear photograph of the packaging labels is also acceptable.

### Category 5 — Întrebările pacientului (Patient-Prepared Questions)

This is not a document — it is encouragement for the patient to prepare:

| Guidance | Notes |
|---------|-------|
| Scrieți întrebările dvs. în avans | The consultation lasts 45–60 minutes. Dr. Ungureanu answers all questions. Writing them down prevents forgetting them during the consultation. |
| Nu există întrebări nepotrivite | Questions about daily life, sports, driving, recovery duration — all are appropriate. |
| Includeți preocupările familiei | If a family member will not be present, their specific questions can be written and brought |

**Recommended question categories for patients to consider:**
- What does my diagnosis mean for my daily life?
- What are the consequences of not treating this condition?
- What treatment options exist, and what are the differences between them?
- What does recovery look like if surgery is recommended?
- What should I do or avoid between now and the consultation?
- What should I do or avoid while waiting for surgery if surgery is planned?

## 7.3 Tone and Presentation

The "What to Bring" section is presented as a structured list, not a checklist with checkboxes. Checkboxes imply pass/fail — if the patient cannot check all boxes, they feel they are failing a test. A structured list implies "here is useful guidance."

The section ends with a reassurance line: "Dacă nu aveți toate documentele de mai sus, veniți oricum. Dr. Ungureanu vă va ghida din punctul în care vă aflați." This must appear at the end of the section, not as a footnote. It is as important as any item on the list.

---

# 8. How the Consultation Works

## 8.1 Purpose

A patient who does not know what will happen during the consultation feels the consultation itself as a source of anxiety — separate from the medical situation. The consultation is an unknown procedure in an unknown environment with an unknown outcome.

This section removes the unknown from the process. A patient who reads it knows:
- That 45–60 minutes have been set aside — there is no rush
- That the consultation begins with listening — the patient is not processed
- That imaging and documents will be reviewed during the appointment, not separately
- That the consultation ends with a clear explanation of options — nothing is decided for the patient without their understanding

This section makes no medical promises. It does not promise a diagnosis, a treatment plan, or a specific outcome. It only describes the process — what happens, in what order.

## 8.2 The Four-Step Process

### Step 1 — Sosire (Arrival)

The patient arrives and is received. The environment and the process of arrival are what they are — the card describes what to do upon arrival.

**What this step communicates:**
- The patient is expected and welcome
- The reception process is straightforward
- If a family member has accompanied the patient, they are welcome

**No medical content.** No promises about waiting times. No commitments about what will happen before the patient is seen. Only: you will be received, and here is how.

### Step 2 — Discuție (Discussion)

Dr. Ungureanu listens to the patient's account of their situation — their symptoms, their history, their concerns, and their questions. This step establishes the patient's context before any examination or document review.

**What this step communicates:**
- The consultation begins with listening, not with paperwork
- The patient's account of their own experience is the starting point
- Questions prepared in advance are addressed during this time
- The family member present may contribute

**No medical promises.** The step does not promise a diagnosis. It describes what the doctor does: he listens, he asks clarifying questions, he creates the full picture of the patient's situation.

### Step 3 — Analiza investigațiilor (Review of investigations)

Dr. Ungureanu reviews all imaging, test results, and previous medical documents the patient has brought. This review happens during the consultation — not separately, not in another appointment.

**What this step communicates:**
- The documents the patient brings are reviewed in their presence
- The patient can ask questions about what the doctor is seeing
- If new investigations are needed, the doctor will explain why during this step
- If the existing imaging is sufficient, the patient knows during the same appointment

**No medical promises.** The step does not promise that the existing imaging will be sufficient. It describes what happens: the documents are reviewed, and the patient receives an explanation of what the doctor observes.

### Step 4 — Pașii următori (Next steps)

Dr. Ungureanu explains all available options — conservative treatment, interventional treatment, further investigation, or monitoring — and discusses the implications of each. The patient receives a clear explanation before any decision is made.

**What this step communicates:**
- The patient will leave the consultation with a clear understanding of their options
- No decision is made without the patient's understanding and participation
- If surgery is one of the options, the patient will understand what it involves, what recovery looks like, and what the alternatives are
- The "next steps" are proposed by the doctor, decided jointly — not imposed

**No medical promises.** This step does not promise that surgery will be recommended, that a diagnosis will be certain, or that all questions will be definitively resolved. It promises only that the patient will understand what their options are at the end of the consultation.

## 8.3 Language Principles for This Section

**No medical promises.** No statement implies a guaranteed outcome, a guaranteed diagnosis, or a guaranteed treatment path.

**No guarantees.** Nothing in this section commits Dr. Ungureanu to a specific clinical outcome.

**Process clarity only.** Each step describes what happens, not what the result will be.

**Active, warm language.** "Dr. Ungureanu ascultă" — not "The doctor will conduct a medical history interview." Patient-facing, not clinical.

**Honest about uncertainty where relevant.** If the consultation sometimes requires a follow-up appointment or additional investigations, this is not a failure of the process — it is appropriate. The section can acknowledge this without making it the lead: "Uneori, sunt necesare investigații suplimentare. Dr. Ungureanu vă va explica ce este nevoie și de ce."

---

# 9. Frequently Asked Questions

## 9.1 Structure

The FAQ section uses `organism-faq` — accordion component. Each question is a clickable trigger; the answer expands below. One question is open at a time by default (or all closed). No nested accordions.

Questions are organized into six categories. Each category appears as a group with a visible category label (H3) followed by the accordion items for that category.

No JavaScript-controlled filtering of questions by category. No tabs. No dropdown to select a category. All categories are visible in sequential scroll order.

## 9.2 Category 1 — Programări (Appointments)

**Q: Cum fac o programare?**
A: Utilizați formularul de contact de pe pagina Contact sau sunați direct la locația aleasă folosind numărul de telefon de pe cardul de mai sus. Vă confirmăm programarea în maximum 24 de ore.

**Q: Cât de mult trebuie să aștept pentru o consultație?**
A: Nu putem garanta un timp de așteptare specific — depinde de disponibilitate la momentul contactului. Vă recomandăm să contactați cât mai devreme posibil. La confirmare, vă comunicăm data disponibilă.

**Q: Cât durează consultația inițială?**
A: Consultația inițială durează în medie 45–60 de minute. Dr. Ungureanu rezervă timp suficient pentru a asculta, a analiza investigațiile și a răspunde tuturor întrebărilor dvs.

**Q: Pot reprograma sau anula consultația?**
A: Da. Contactați-ne prin același canal folosit la programare — telefonic sau prin formularul de contact. Vă rugăm să ne anunțați cu cât mai mult timp posibil pentru a putea oferi locul altui pacient.

**Q: Am nevoie de o trimitere de la medicul de familie?**
A: O trimitere medicală facilitează accesul la decontare prin CNAS la anumite locații. Dacă nu aveți trimitere, puteți veni în continuare — vă rugăm să verificați la confirmare dacă locația aleasă impune condiții specifice.

## 9.3 Category 2 — Documente (Documents)

**Q: Ce documente trebuie să aduc?**
A: Aduceți toate documentele medicale pe care le aveți: trimiterile, scrisorile medicale anterioare, biletele de externare, investigațiile imagistice (RMN, CT pe CD), analizele relevante și lista medicamentelor curente. Nu amânați consultația dacă nu aveți toate documentele — veniți cu ce aveți.

**Q: Ce fac dacă nu am nicio documentație medicală?**
A: Puteți veni fără documente. Dr. Ungureanu va începe de la situația dvs. actuală și va recomanda investigațiile necesare în funcție de ce observă în cadrul consultației.

**Q: Documentele trebuie să fie în original?**
A: Ideal, da — în special pentru investigații imagistice. Dacă aveți copii, aduceți-le oricum. Originalele nu se lasă la cabinet — le primiți înapoi la finalul consultației.

**Q: Pot trimite documentele în avans?**
A: Contactați-ne înainte de programare pentru a discuta această posibilitate. În funcție de locație și context, se poate organiza un schimb de documente în avans.

## 9.4 Category 3 — Investigații imagistice (Imaging)

**Q: Ce format de RMN sau CT trebuie să aduc?**
A: Preferabil CD cu fișiere DICOM — permit vizualizarea completă și măsurătorile necesare. Filmele imprimate sunt acceptabile ca alternativă. Fotografii ale filmelor (cu telefonul) nu sunt utile.

**Q: Investigațiile mele sunt mai vechi de un an — mai sunt utile?**
A: Da — aduceți orice investigație aveți, indiferent de dată. Dr. Ungureanu va evalua dacă sunt actuale sau dacă sunt necesare investigații noi. Nu amânați consultația pentru a obține investigații noi fără o recomandare medicală în acest sens.

**Q: Am efectuat RMN-ul în alt oraș. Îl poate analiza Dr. Ungureanu?**
A: Da. Aduceți CD-ul — formatul DICOM este standard și poate fi citit indiferent de centrul unde a fost efectuat.

**Q: Nu am investigații imagistice deloc. Pot veni la consultație?**
A: Da. Dr. Ungureanu evaluează situația în cadrul consultației și recomandă investigațiile necesare. Uneori o consultație clinică inițială precede investigațiile imagistice.

## 9.5 Category 4 — Membrii familiei (Family members)

**Q: Poate veni un membru al familiei cu mine?**
A: Da. Este încurajat — mai ales în cazul pacienților care se simt anxioși sau dacă urmează să fie discutate decizii complexe. Prezența unui aparținător ajută și la urmărirea recomandărilor primite.

**Q: Câți aparținători pot veni?**
A: De regulă, un aparținător. Dacă există circumstanțe speciale (pacient în vârstă, mobilitate redusă), contactați-ne în prealabil pentru a clarifica.

**Q: Aparținătorul poate fi prezent pe toată durata consultației?**
A: În general da, cu acordul pacientului. Unele momente ale examinării clinice pot necesita intimitate — Dr. Ungureanu va indica.

**Q: Există o sală de așteptare pentru aparținători?**
A: Depinde de locație. Informații specifice despre sala de așteptare sunt incluse în notele de pacient ale cardului de locație, acolo unde sunt disponibile.

## 9.6 Category 5 — Plăți și aspecte administrative (Payment and administrative)

**Q: Consultația este decontată prin CNAS?**
A: Depinde de locație. Unele locații oferă decontare prin asigurarea națională de sănătate cu trimitere medicală; altele funcționează exclusiv în regim privat. Verificați cardul locației alese sau contactați-ne pentru clarificări.

**Q: Care este costul consultației?**
A: Tarifele variază în funcție de locație și de tipul consultației. Nu publicăm tarife pe site — vă rugăm să confirmați la momentul programării.

**Q: Se eliberează chitanță sau factură?**
A: Da, la cerere. Confirmați la momentul programării dacă aveți nevoie de un document fiscal specific.

**Q: Pot fi asigurat prin asigurare privată?**
A: Unele locații acceptă asigurări private. Verificați cu asigurătorul dvs. și confirmați cu recepția locației la momentul programării.

## 9.7 Category 6 — Controale și urmărire (Follow-up visits)

**Q: Când trebuie să revin după operație?**
A: Dr. Ungureanu vă va indica data și condițiile controlului postoperator la finalul internării sau al consultației. Data specifică depinde de tipul intervenției și de evoluția dvs.

**Q: Cum pot contacta cabinetul între programări?**
A: Prin același canal de contact folosit pentru programare — formularul de pe site sau telefonul locației. Urgențele medicale se adresează serviciului de urgențe (112).

**Q: Pot solicita o a doua opinie de la Dr. Ungureanu?**
A: Da. Sunteți binevenit(ă) indiferent de ce alte opinii medicale ați primit. Aduceți toate documentele relevante.

**Q: Am deja o programare la altă clinică. Pot schimba locația?**
A: Contactați-ne și vom clarifica posibilitățile disponibile în funcție de calendarul și locațiile active.

---

# 10. Contact Relationship

## 10.1 /programari → /contact: Why They Are Separate

/programari and /contact are distinct pages serving distinct purposes. Their separation is intentional and architectural. It is not simplifiable to "one contact page" without losing the function that /programari performs.

**The problem with a single contact page:** If the primary CTA sent patients directly to a contact form, patients would arrive at the form without knowing:
- Whether Dr. Ungureanu consults in their city
- Which clinic or hospital to reference in their inquiry
- What schedule to consider when choosing a date
- What to bring to their appointment
- What the appointment process involves

A patient who fills in a contact form without any of this information produces an incomplete inquiry. The staff must then answer basic logistical questions before the appointment can even be discussed. Every question that /programari answers is a question that does not need to be answered by phone or email after contact.

**The function of the separation:**
- /programari reduces logistical uncertainty before contact
- /contact receives qualified, oriented inquiries from patients who are ready
- The practice receives better, more actionable appointment requests
- The patient has a better experience — they arrive at the form already knowing the answer to "can I get there?"

## 10.2 Why Contact Is Not in the Primary Navigation

/contact does not appear in the header navigation. It is not accessible from the navigation menu. It is not accessible from the footer as a navigation-level destination.

A patient who sees "Contact" in the navigation of a medical website will often click it directly, bypassing the appointment journey entirely. They arrive at a form before they understand whether this doctor is the right one, whether the location works, or whether the schedule aligns.

The navigation is for browsing. /contact is for acting. Patients who are acting have been through /programari. The navigation does not serve the /contact page because the navigation serves browsers, not actors.

**The footer does list /contact** — in the tertiary navigation column alongside /programari and /pacienti. This is appropriate: the footer is where patients who have explored the site look for a path they have not yet found. It is not the same as placing Contact in primary navigation.

## 10.3 The Routing Chain Is One-Way

```
Any page → /programari → /contact
```

No page on the site routes to /contact except /programari. No navigation item, no footer link at the primary level, no body text link routes a patient directly to /contact as a shortcut.

The chain has no loop. No page on /programari routes back to /programari. No page on /contact routes to /programari. Once a patient reaches /contact, they are there to submit a form — not to reconsider their location choice.

This is documented in `docs/tasks/01_INFORMATION_ARCHITECTURE.md` §9 and enforced in every page specification and QA checklist.

## 10.4 The Patient Should Understand Logistics Before Initiating Communication

A patient who understands:
- That Dr. Ungureanu is physically accessible to them
- Which clinic is most convenient
- What to bring
- How the consultation process works

...is a patient who contacts with confidence. They know what they are requesting, where they want the appointment, and what will happen when they arrive.

This preparation-before-contact model respects the patient's time and the practice's time. It is the model /programari is built to enforce.

---

# 11. Mobile Experience

## 11.1 Section Order on Mobile

Identical to desktop. No section is hidden on mobile that is visible on desktop. No section is reordered for mobile. The rationale for the section order applies equally to mobile users.

## 11.2 Location Cards on Mobile

Desktop: 2-column grid per city group. Mobile: 1-column, full-width stack.

| Property | Desktop | Mobile |
|----------|---------|--------|
| Card width | ~50% of grid | 100% of container |
| Card padding | `space-8` (32px) | `space-6` (24px) |
| Grid gap | `space-6` (24px) | `space-4` (16px) |
| City header above cards | Visible | Visible |
| Optional fields | Stack below required | Stack below required |
| Maps button | ~50% width or ghost button | Full-width |

All location cards within a city group are visible in a single vertical scroll on mobile. No cards are hidden behind a "show more" interaction within the city group.

## 11.3 Spacing

| Section | Desktop padding (top/bottom) | Mobile padding (top/bottom) |
|---------|-------|--------|
| Hero | 80px | 40px |
| Introductory explanation | 80px | 40px |
| Location directory | 80px | 40px |
| What to bring | 80px | 40px |
| How consultation works | 64px | 32px |
| FAQ | 80px | 40px |
| CTA banner | 96px | 48px |

## 11.4 Touch Targets

All interactive elements meet minimum 44×44px touch targets.

| Element | Mobile target |
|---------|--------------|
| Maps button (per location card) | Full-width, 48px height minimum |
| Phone number link (`tel:`) | Full-width touchable area, 44px height |
| FAQ accordion triggers | Full-width, 52px height minimum |
| CTA button ("Contactați-ne") | Full-width, 52px height minimum |
| Email link (`mailto:`) | Full-width touchable area, 44px height |

## 11.5 CTA Visibility on Mobile

The final CTA button ("Contactați-ne" → /contact) is full-width on mobile. Padding: 16px vertical, full-width horizontal. Height: minimum 52px.

The sticky mobile header retains the primary CTA button ("Programează o consultație") visible at all scroll positions — even while the patient is reading the location directory, the What to Bring section, or the FAQ. See `docs/tasks/03_HEADER_AND_NAVIGATION.md` for sticky header specification.

## 11.6 Phone Number Interactions on Mobile

Every phone number on this page is a `tel:` link. On mobile, tapping a `tel:` link triggers the native phone dialer. This is the expected behavior for a patient who wants to call directly from their phone.

The `tel:` link is formatted with the international prefix: `tel:+40...`. This ensures the call works from both domestic and international mobile networks.

Phone numbers are displayed as the full human-readable string below the `tel:` link — the patient can read the number, then decide to tap to call or to dial manually.

## 11.7 External Map Behavior on Mobile

The Maps button ("Cum ajungeți →") opens a Google Maps URL in a new browser tab. On mobile, the browser may offer to open the native Maps application (Apple Maps on iOS, Google Maps on Android).

No Google Maps embed is present. The button is a standard `<a>` link. No JavaScript is required. The behavior is predictable: tap → browser prompts to open in Maps app or opens in browser tab.

## 11.8 50+ Patient Consideration

Patients aged 50 and above are a primary audience. Mobile behaviors must be evaluated through this lens:

- **Text size:** Body text minimum 16px on mobile. Location card H4 labels minimum 18px. Never reduce below these thresholds to fit more content per screen.
- **Tap target size:** 44px minimum, 52px for primary CTA. No small-text phone links where the tap area is only the underlined text — the tap area should be the full row or card area.
- **Accordion behavior:** FAQ accordions open on first tap, close on second tap. No double-tap required. No hover required to see that they are interactive. Arrow icon or plus/minus indicator signals interactability visually without hover.
- **No hidden interactions:** No content is revealed only on hover. All content is accessible by tap or by scrolling. A patient who does not hover will not miss content.
- **Sufficient contrast for outdoor conditions:** The 14.5:1 primary text contrast ratio (color-ink on color-surface) is adequate for outdoor reading in varying lighting conditions.

---

# 12. Accessibility

## 12.1 Reading Order and Document Outline

The page produces a single, logical heading outline for screen readers:

```
H1: [Hero headline — page title]
  H2: [Introductory explanation heading — if present]
  H2: Unde ne găsiți (Location directory)
    H3: Locații în Cluj-Napoca
      H4: [Institution name — per card]
    H3: Locație în Baia Mare
      H4: [Institution name — per card]
  H2: Ce să aduceți la consultație (What to bring)
    H3: [Each category name within What to Bring — if structured as subsections]
  H2: Cum decurge consultația (How the consultation works)
    [Steps are not headings — they are numbered list items with H4 step titles]
  H2: Întrebări frecvente (FAQ)
    H3: [Each FAQ category name]
  H2: [CTA banner heading]
```

One H1 per page. All major section headings are H2. Sub-headings within sections use H3. Location card names are H4 (within an H3 city group context). No heading levels are skipped.

## 12.2 Screen Reader Support

| Element | Accessibility treatment |
|---------|------------------------|
| Location card grid | Container: `role="list"`. Each card wrapper: `role="listitem"`. |
| Maps button | `aria-label="Direcții pentru [Institution Name] în Google Maps"`. External icon: `aria-hidden="true"`. `target="_blank"`, `rel="noopener"`. |
| Phone links | `<a href="tel:+40...">` — screen reader announces "link, phone number". |
| Email links | `<a href="mailto:...">` — screen reader announces "link, email address". |
| Molecule-meta icons | `aria-hidden="true"` — decorative only; text carries meaning. |
| Visit type badge | Text content, not icon-only. Screen reader reads "Consultații" or "Intervenții chirurgicale". |
| FAQ accordion triggers | `aria-expanded="true/false"`. `aria-controls` pointing to the answer panel ID. |
| FAQ answer panels | `role="region"`. `aria-labelledby` pointing to the trigger ID. |
| Breadcrumb | `<nav aria-label="Breadcrumb">`. Current page item has `aria-current="page"`. |
| Step numbers in "How consultation works" | `aria-hidden="true"` — decorative. H4 step title carries the label. |

## 12.3 Keyboard Navigation

| Sequence | Keyboard path |
|----------|--------------|
| Skip to main content | Tab → Enter → arrives at `#main-content` (hero) |
| Breadcrumb | Tab into "Acasă" link → Tab to breadcrumb separator (skip) → "Programări" (current, not a link) |
| Hero section | Tab past heading (not interactive) |
| Location cards | Tab enters the grid; each card's interactive elements (phone, email, Maps button) are focusable in order |
| Between city groups | Tab continues sequentially past divider |
| What to bring | No interactive elements — content only; Tab moves to next section |
| How consultation works | No interactive elements — step content; Tab moves to next section |
| FAQ accordion | Tab to each accordion trigger → Enter opens/closes → Tab into the answer text (if needed) → Tab to next trigger |
| CTA banner | Tab reaches "Contactați-ne" button → Enter activates → navigates to /contact |

No element on this page requires hover to reveal content. All interactive elements are reachable by keyboard. No content is hidden from keyboard users that is visible to mouse users.

## 12.4 Cognitive Accessibility

- **One action per section.** No section on /programari asks the patient to make multiple competing decisions simultaneously.
- **Progressive disclosure.** The patient reads location cards → then preparation content → then FAQ → then acts. Each section gives more information only as needed. A patient who only needed geographic information can stop after Sections 3–4.
- **Consistent CTA labeling.** "Contactați-ne" appears exactly once on this page — in the CTA banner. It is not repeated as an inline text link within the FAQ or the What to Bring section. One label, one location, one action.
- **No time-limited elements.** No auto-hiding messages. No session timeouts. No countdown banners.
- **No ambiguous interactions.** Every interactive element on the page communicates its purpose through its label: phone numbers communicate that they dial on tap, email addresses communicate that they open email, the Maps button communicates that it shows directions, FAQ triggers communicate that they expand.

---

# 13. Phase 2 Opportunities

These are documented for planning purposes. None are implemented in Phase 1.

## 13.1 Online Booking Integration

A future booking widget embedded within individual location cards could allow patients to request or select appointment slots directly from the location card — without navigating to /contact.

**Conditions:** Requires a booking system compatible with the practice's workflow (a calendar system Dr. Ungureanu can manage, or a clinic-provided booking API). Must maintain the human confirmation step — no auto-confirmed appointments. System must be GDPR-compliant.

**Phase 2 constraint:** The booking experience must not bypass the location orientation content on /programari. If a booking widget is added to location cards, it is embedded within the card — below all required information — not as a shortcut that replaces the page.

## 13.2 Google Calendar Synchronization

Each location card could link to a "Add to Google Calendar" button that creates a calendar entry for the confirmed appointment date and time.

**Conditions:** Appointment date must be confirmed (Phase 1 confirmation comes via email after contact). The calendar link would be sent in the confirmation email (outside the website's scope) rather than embedded in the page.

## 13.3 Appointment Reminders

Automated email or SMS reminders sent 24–48 hours before a confirmed appointment. Requires:
- A confirmed appointment date in a system
- Patient contact information collected at booking
- GDPR-compliant opt-in for reminders
- An email/SMS sending service (Make integration candidate)

## 13.4 Multilingual Schedules

If the patient population includes non-Romanian-speaking patients (Hungarian-speaking patients in Baia Mare, for example), the /programari page may benefit from a Hungarian-language version.

**Condition:** Multilingual is an architectural decision requiring hreflang, URL strategy, and full content translation. It begins only after a comprehensive multilingual strategy is approved.

## 13.5 Interactive Maps

An embedded map showing all active locations simultaneously — with markers per city — could provide geographic orientation at a glance.

**Conditions:**
- Acceptable performance impact on mobile (the current no-embed approach is a deliberate performance decision)
- No tracking concern resolution required (Google Maps Analytics in iframes has privacy implications)
- A map library that renders without external JavaScript (e.g., a static map image with coordinate pins) may be more appropriate than a full iframe embed

---

# 14. Blocking Dependencies

## 14.1 Full Dependency Table

| Dependency | Source | Impact if Missing | Status |
|-----------|--------|------------------|--------|
| **Q13 — ALL LOCATION DATA** | Dr. Ungureanu | /programari cannot be built; no location cards published | BLOCKING |
| Q13a — Clinic/hospital patient-facing names (per location) | Dr. Ungureanu | Location cards hidden; State 3 launch risk | BLOCKING |
| Q13b — Cities per location | Dr. Ungureanu | City group structure cannot be defined | BLOCKING |
| Q13c — Visit types per location (consultation / surgery / both) | Dr. Ungureanu | Card ordering, badge content, patient routing all undefined | BLOCKING |
| Q13d — Schedule per location (days of week) | Dr. Ungureanu | Schedule block empty; card must be hidden | BLOCKING |
| Q13e — Hours per location | Dr. Ungureanu | Schedule block empty; card must be hidden | BLOCKING |
| Q13f — Phone number per location | Dr. Ungureanu | Contact block empty; card must be hidden; `tel:` links unavailable | BLOCKING |
| Q13g — Booking method per location | Dr. Ungureanu | Patient does not know how to book; card must be hidden | BLOCKING |
| Q13h — Google Maps URLs per address | Dr. Ungureanu | Maps button omitted; patients must search manually | Strongly recommended |
| Q13i — Full street addresses | Dr. Ungureanu | Address field empty; card must be hidden | BLOCKING |
| Q13j — Patient notes (entrance, floor, requirements) per location | Dr. Ungureanu | Optional field omitted; card still publishable without it | Optional post-launch |
| Q13k — Parking availability per location | Dr. Ungureanu | Optional field omitted | Optional post-launch |
| Q13l — Accessibility per location | Dr. Ungureanu | Optional field omitted | Optional post-launch |
| Q13m — Location-specific email per location | Dr. Ungureanu | Email optional field omitted; all contact via form or phone | Optional post-launch |
| Q13n — Number of Baia Mare locations | Dr. Ungureanu | Baia Mare group structure uncertain (1-column or 2-column grid) | BLOCKING |
| Q13o — Baia Mare schedule frequency (weekly / monthly / by arrangement) | Dr. Ungureanu | Affects how schedule is described on Baia Mare card | BLOCKING |
| Q15 — Patient-facing phone number (if used as general contact) | Dr. Ungureanu | Phone number in footer and organism-hero-contact unavailable | BLOCKING (Phase 2 footer) |
| Q11 — Contact form email routing destination | Dr. Ungureanu | /contact form cannot route submissions anywhere | BLOCKING (/contact) |
| /contact page live | Phase 4 | CTA banner on /programari routes to non-existent page | BLOCKING |
| /politica-de-confidentialitate live | Phase 2 | GDPR checkbox on /contact form cannot link | BLOCKING (/contact) |

## 14.2 What Can Be Built Before Q13 Is Resolved

| Component | Status without Q13 |
|-----------|-------------------|
| Hero section (Section 1) | Fully buildable — no location data required |
| Introductory explanation (Section 2) | Buildable — city names (Cluj-Napoca, Baia Mare) are assumed; verify with Dr. Ungureanu |
| Location directory structure (grid, city headers, divider) | Buildable — template structure only, no cards |
| Location cards | BLOCKED — all required fields from Q13 |
| What to Bring (Section 5) | Fully buildable — no location data required |
| How the Consultation Works (Section 6) | Fully buildable — no location data required |
| FAQ (Section 7) | Mostly buildable — FAQ answers that reference specific booking process may need Q13 for accuracy |
| CTA banner (Section 8) | Fully buildable — routes to /contact |

## 14.3 Minimum Viable Launch Criteria

The page is not publishable in any state that includes placeholder text visible to patients. The following conditions must all be met before /programari is published:

- [ ] At least one location card per city (Cluj-Napoca AND Baia Mare) with all required fields populated
- [ ] At least one consultation-type location card in the Cluj-Napoca group (surgery-only is insufficient for new patients seeking a first appointment)
- [ ] /contact is live and the contact form routes to a confirmed email destination
- [ ] /politica-de-confidentialitate is live
- [ ] All published phone numbers are confirmed working tel: links
- [ ] All published Maps buttons open the correct address
- [ ] Dr. Ungureanu has reviewed all published location data

---

# 15. Validation Checklist

## 15.1 Clarity

- [ ] The H1 names the page's function — not the doctor's credentials or the practice's name
- [ ] The introductory explanation (Section 2) names both Cluj-Napoca and Baia Mare before the patient scrolls to any card
- [ ] Each location card answers all four patient questions: Where? Is it accessible? When? How?
- [ ] No card contains placeholder text, empty fields, or "[CONFIRM CU DR. UNGUREANU]" strings
- [ ] The "What to Bring" section ends with the reassurance that patients can come with what they have
- [ ] The "How the Consultation Works" section makes no medical promises or guarantees
- [ ] The FAQ answers are in plain Romanian — readable by a non-medical adult
- [ ] The CTA banner has one button with one label: "Contactați-ne"

## 15.2 Patient Reassurance

- [ ] A patient from Baia Mare can confirm that this doctor consults in Baia Mare before reaching any CTA
- [ ] A patient who has no medical documents reads that they can still attend
- [ ] A patient who does not know what to expect from a neurosurgical consultation reads the four-step process and understands the structure
- [ ] No section on the page creates urgency, scarcity, or pressure
- [ ] The page tone matches the rest of the site — calm, warm, direct
- [ ] A patient who reads the page but decides not to contact today has not been pressured — they have been served

## 15.3 Logistics Understanding

- [ ] Each city group has a clear H3 heading that names the city
- [ ] Location cards within the Cluj-Napoca group follow consultation-first ordering
- [ ] The Baia Mare location card is presented with the same visual quality as Cluj-Napoca cards
- [ ] The Maps button on each card opens the correct address (verified)
- [ ] Each phone number is a working tel: link (tested on mobile)
- [ ] The booking method statement on each card is specific — not generic ("Programare prin formularul de contact de pe site" — not "contact us to book")
- [ ] The closing note at the bottom of the location section ("Nu ați găsit o locație convenabilă? Contactați-ne.") is present and routes to /contact
- [ ] The CTA banner routes to /contact — not back to /programari

## 15.4 Accessibility

- [ ] One H1 on the page; heading hierarchy H1 → H2 → H3 → H4 — no skipped levels
- [ ] Breadcrumb: "Acasă → Programări" with `aria-current="page"` on "Programări"
- [ ] Breadcrumb `<nav>` has `aria-label="Breadcrumb"`
- [ ] Location card grid has `role="list"`; each card wrapper has `role="listitem"`
- [ ] Each Maps button has specific `aria-label` naming the institution and destination
- [ ] All phone and email links use correct href protocols (`tel:`, `mailto:`)
- [ ] FAQ accordion triggers have `aria-expanded` state; answer panels have `aria-labelledby`
- [ ] All molecule-meta icons are `aria-hidden="true"`
- [ ] Skip to content link is the first focusable element; `#main-content` is on the hero section
- [ ] All animations suppressed under `prefers-reduced-motion`
- [ ] Color contrast: all text passes WCAG 2.1 AA (primary: 14.5:1)

## 15.5 Mobile Experience

- [ ] Location cards stack to single column at <768px with no horizontal scroll
- [ ] All touch targets are minimum 44×44px — verified at 375px
- [ ] Phone numbers are tappable as tel: links — tested on a real mobile device
- [ ] Maps buttons are full-width on mobile — tested to open correct address
- [ ] FAQ accordion triggers are minimum 52px height on mobile — tappable without precision
- [ ] CTA button ("Contactați-ne") is full-width, minimum 52px height
- [ ] Body text is minimum 16px on all mobile breakpoints
- [ ] City group headers (H3) remain visible above card stacks on mobile
- [ ] No content requires horizontal scroll at 375px

## 15.6 Emotional Comfort

- [ ] The page manifesto test passes: a patient who received a difficult diagnosis last week reads this page and feels less uncertain about the appointment process, not more
- [ ] The Baia Mare location is presented without any visual or tonal signal that it is less important or less reliable than Cluj-Napoca locations
- [ ] "How the Consultation Works" is written from the patient's perspective — what they experience, not what the doctor does in clinical terms
- [ ] "What to Bring" does not read as a checklist that creates anxiety — it reads as preparation guidance that reduces anxiety
- [ ] The FAQ covers the questions a patient actually has, not the questions that are convenient to answer
- [ ] The CTA banner is a calm invitation — not a final high-pressure push before the patient can leave the page

---

*Programări version: 1.0 — 2026-06-28*
*Extends: docs/implementation/05_PROGRAMARI_PAGE.md (adds Sections 5–7: What to Bring, How the Consultation Works, FAQ)*
*Source: docs/tasks/00_PROJECT_ROADMAP.md v1.1, docs/tasks/01_INFORMATION_ARCHITECTURE.md v1.0, docs/project/PATIENT_CENTERED_MANIFESTO.md, docs/project/WEBSITE_GOALS.md, docs/project/TARGET_AUDIENCE.md*
*Next: docs/tasks/07_DESPRE.md*
