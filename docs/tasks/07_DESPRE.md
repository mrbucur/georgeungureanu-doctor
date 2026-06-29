# Despre Dr. George Ungureanu

## georgeungureanu.doctor

**Purpose of this document:** Freeze the complete About page before implementation. Every section, its order, its purpose, its content requirements, and the principles governing how the doctor's story is told are locked here.

**Governing constraint:** This page is not a CV. It does not reproduce an academic portfolio. It tells the story of a neurosurgeon's professional journey and philosophy in a way that builds genuine trust with patients — trust that comes from understanding a person, not from being impressed by a credential list.

**This document expands** the section map defined in `docs/tasks/01_INFORMATION_ARCHITECTURE.md` §6.4. The IA document defined 8 sections; this document defines 9 sections with richer content specifications. This document governs Phase 5 implementation.

**Source of truth:**
- `docs/tasks/00_PROJECT_ROADMAP.md` v1.1
- `docs/tasks/01_INFORMATION_ARCHITECTURE.md` v1.0
- `docs/tasks/02_CONTENT_MODELS.md` v1.0
- `docs/tasks/03_HEADER_AND_NAVIGATION.md` v1.0
- `docs/tasks/04_DESIGN_SYSTEM_TOKENS.md` v1.0
- `docs/tasks/05_HOMEPAGE.md` v1.0
- `docs/tasks/06_PROGRAMARI.md` v1.0
- `docs/project/PATIENT_CENTERED_MANIFESTO.md`
- `docs/project/WEBSITE_GOALS.md`
- `docs/project/TARGET_AUDIENCE.md`
- `docs/project/PROJECT_BRIEF.md`
- `docs/content/CONTENT_TONE.md`
- `docs/design-system/BRAND_GUIDELINES.md`

---

# 1. Purpose of the About Page

## 1.1 Why Patients Visit This Page

A patient who navigates to /despre has already encountered this doctor somewhere — through a search, a referral, a colleague's recommendation, or by browsing the site. They are not arriving at /despre to confirm that this doctor exists. They are arriving to answer a deeper question: *Who is this person, and can I trust them with something this important?*

The About page is the only place on the site where the patient can understand the doctor as a human being — not just as a specialist who treats a specific condition. It is the page where clinical authority meets personal humanity. Both must be present. Neither can dominate.

A patient who leaves /despre with a clear sense of who Dr. Ungureanu is — where he studied, what he has dedicated his professional life to, what he believes about medicine and patients, what has shaped his thinking — has something more than a list of credentials. They have the beginning of a relationship with a person they have not yet met.

This matters because a patient who feels they know the doctor — who has a sense of his values, his intellectual commitments, his humanity — is a patient who arrives at the first consultation less afraid. And a patient who arrives less afraid is more able to participate in their own care.

## 1.2 Why Trust Matters More Than Prestige

Prestige impresses. Trust reassures. A frightened patient does not need to be impressed — they need to be reassured.

A wall of academic credentials, conference appearances, and publication titles communicates: "I have accomplished a great deal." It does not communicate: "I will listen to you and explain your situation until you understand it."

The /despre page is built around the latter signal. Academic credentials and achievements are present because they contribute to trust — they confirm that this is a serious, rigorous clinician. But they are never the lead. They support the narrative; they do not replace it.

The governing principle from `docs/project/PATIENT_CENTERED_MANIFESTO.md` applies directly here: academic authority must *inspire confidence, never create intimidation*. A patient who feels intimidated by a doctor's biography does not book an appointment. They leave.

## 1.3 Why This Page Comes After Recomandări in the Navigation

The navigation order is: Acasă → Afecțiuni → Sfatul Neurochirurgului → **Recomandări** → **Despre Dr. George Ungureanu** → [Programează o consultație].

/recomandari comes before /despre. This is deliberate.

A patient who is evaluating a doctor follows a trust-building sequence:
1. "Do I understand what I have?" — addressed by Afecțiuni
2. "Does this doctor create educational resources that serve patients like me?" — addressed by Sfatul Neurochirurgului
3. "Do others — medical peers and patients — trust this doctor?" — addressed by Recomandări
4. "Who is this doctor, specifically, as a person and a clinician?" — addressed by Despre

By the time a patient reaches /despre through the navigation, they have had three prior encounters with the doctor's work and reputation. They arrive at /despre with a partial picture already formed. The About page completes and deepens that picture — it does not need to introduce the doctor from scratch.

This sequencing also means that the most personal and humanizing content (the biography, the philosophy, the story) arrives after professional and social trust has already begun to form — which makes the humanizing content land with greater weight.

## 1.4 Emotional Goals

**Primary emotional goal:** A patient who reads this page should feel they know Dr. Ungureanu as a person — not completely, not intimately, but enough to feel that this is a real human being with genuine commitments and a real professional story.

**Secondary emotional goals:**
- Reduction of the "choosing a stranger" anxiety — the About page transforms "a doctor whose credentials I evaluated" into "a person whose journey I understand"
- Confidence that the educational commitment (Sfatul Neurochirurgului) is genuine and sustained — the About page reveals the origin and continuity of that commitment
- Reassurance that the doctor's training and international exposure match the complexity of the conditions he treats
- A sense that the doctor is both capable and approachable — capable enough to inspire confidence, approachable enough to not create distance

## 1.5 Educational Goals

The About page educates the patient about:
- What subspecializations within neurosurgery exist and which Dr. Ungureanu has pursued
- What the path to becoming a specialist in this field involves (indirectly, through the timeline)
- What international medical education and exchange means for a practicing clinician's skill set
- What academic work within medicine looks like and why it matters for clinical practice

None of these educational goals is pursued through lecture. They are pursued through story — through a timeline that shows a professional trajectory, through an international experience section that explains what exposure to global medical standards means for a Romanian patient, through a publications section that demonstrates intellectual seriousness without demanding that the patient read academic papers.

## 1.6 Credibility Goals

Credibility is established through accumulated evidence, not through assertion. The doctor who writes "I am highly experienced" is less credible than the doctor whose timeline shows a thirty-year progression from medical school through residency through fellowship through international exchange through hospital affiliation through academic teaching.

The /despre page provides that accumulated evidence — but in a form that a patient can read, not in a form designed for peer review.

Credibility goals:
- Demonstrate depth and specificity of training — not just "neurosurgery" but the specific subspecialties and the specific programs that shaped this clinician
- Demonstrate intellectual engagement — publications, conferences, and academic roles signal that this is a doctor who thinks rigorously about their field
- Demonstrate integration into the medical community — collaborations, hospital affiliations, and professional memberships show that this doctor works within and contributes to a professional network
- Demonstrate sustained commitment to patient education — the Sfatul Neurochirurgului milestone in the timeline is a credibility signal specifically for the patient who is reading the site as evidence of that commitment

---

# 2. Information Architecture

## 2.1 Page Section Map

| # | Section | Organism | Background | Visibility |
|---|---------|----------|-----------|-----------|
| — | Header | `organism-site-header` | `color-surface` | Always |
| 1 | Hero | `organism-hero-interior` | `color-surface-warm` | Always — requires Q7 photography |
| 2 | Personal philosophy | `organism-philosophy-statement` | `color-surface` | Always — requires Dr. Ungureanu text |
| 3 | Professional timeline | `molecule-timeline` (full) | `color-surface-warm` | Always — requires complete timeline content |
| 4 | International experiences | `organism-credentials-list` (international variant) | `color-surface` | Always — requires content |
| 5 | Academic activity | `organism-credentials-list` (academic variant) | `color-surface-warm` | Always — requires content |
| 6 | Publications and conferences | `organism-credentials-list` (publications variant) | `color-surface` | Always — requires content |
| 7 | Medical collaborations | `organism-credentials-list` (collaborations variant) | `color-surface-warm` | Always — requires content |
| 8 | Human dimension | Inline atoms + molecules | `color-surface` | Optional — requires Dr. Ungureanu decision |
| 9 | Final CTA | `organism-cta-banner` | `color-ink` | Always |
| — | Patient testimonials | `organism-patient-testimonials` | Inserted between 7 and 8 | Hidden until ≥2 approved — Phase 6 |
| — | Footer | `organism-site-footer` | `color-ink` | Always |

**Background alternation:** warm → surface → warm → surface → warm → surface → warm → surface → ink. No two adjacent sections share the same background.

**Patient testimonials note:** The patient testimonials block, built hidden in Phase 5, is inserted between Section 7 (Medical collaborations) and Section 8 (Human dimension). It becomes visible simultaneously with the homepage Section 6 (patient testimonials) when ≥2 approved Testimoniale CPT entries exist (Phase 6 workflow). It does not disrupt the section numbering above — it occupies a conditional position in the page flow.

## 2.2 Purpose of Each Section

**Section 1 — Hero:** Establishes presence. Authentic photography of Dr. Ungureanu, his title and specialty, a brief positioning statement. The visual anchor of the page — the patient arrives and sees a real person, not a title card.

**Section 2 — Personal philosophy:** The doctor's voice, in first person. His relationship with patients, with education, with the Sfatul Neurochirurgului mission. 80–120 words. The earliest opportunity on this page for the patient to hear the doctor speak.

**Section 3 — Professional timeline:** The spine of the page. A chronological journey — not a CV extraction, but a story with a beginning, a progression, and a present moment. The patient reads through this section and understands how the doctor became who he is.

**Section 4 — International experiences:** A focused section on the exchanges, visiting programs, international collaborations, and conferences abroad that shaped the doctor's clinical and intellectual development. Explains why international exposure matters to a patient receiving care in Romania.

**Section 5 — Academic activity:** Teaching, mentoring, research, and institutional academic roles. Demonstrates that this clinician thinks rigorously about medicine, not only practices it. Positioned after the story (timeline) and the international context, so it reads as a dimension of the person already encountered, not as a credential wall encountered cold.

**Section 6 — Publications and conferences:** Selected academic output. Citations with lay-language summaries. Phase 1: simple list. Phase 2: searchable. The patient who wants to verify academic seriousness finds it here; the patient who does not need this level of proof skips past it easily.

**Section 7 — Medical collaborations:** The doctor's institutional relationships — hospitals, clinics, departments, multidisciplinary teams. Reassures patients that this doctor works within a network of professional relationships, not in isolation.

**Section 8 — Human dimension (optional):** The most personal section. Personal motivations, the origin of the choice to pursue neurosurgery, what sustains the commitment to patient education. Not lifestyle content. Not influencer aesthetics. A brief, dignified glimpse of the person behind the profession — only if Dr. Ungureanu is willing to provide this.

**Section 9 — Final CTA:** "Programează o consultație" → /programari. Calm invitation. After a patient who has traveled through the full About page, the CTA is the natural next step — not a demand, not a pressure point.

---

# 3. Hero Section

**Organism:** `organism-hero-interior`
**Background:** `color-surface-warm` (`#F4EFE6`)
**Position:** Section 1 — always visible, requires Q7 photography
**Blocking:** Cannot be launched without authentic photography and positioning statement text

## 3.1 Purpose

The hero of /despre establishes one thing before any content is read: there is a real person here. A genuine photograph, a name, a specialty designation, and a brief statement that places this doctor in relation to the patient — not in relation to his achievements.

## 3.2 Required Elements

| Element | Specification | Source |
|---------|--------------|--------|
| Portrait photograph | Authentic, warm-lit, genuine — not posed for marketing. Dr. Ungureanu in his professional environment: listening, reviewing, or in direct eye contact with the camera in a warm setting. Not a clinical headshot. | Q7 — Dr. Ungureanu |
| Name | "Dr. George Ungureanu" | Confirmed |
| Specialty designation | "Medic Primar Neurochirurgie" — one line, precise | Dr. Ungureanu confirms exact designation |
| Positioning statement | 1–2 sentences. Frames the doctor's relationship to patients, not his accomplishments. Example register (not final copy): "Neurochirurg dedicat înțelegerii pacientului înainte de orice decizie terapeutică." Must be written by or with Dr. Ungureanu. | Dr. Ungureanu |
| Breadcrumb | "Acasă → Despre Dr. George Ungureanu" | Implemented — no blocking |
| CTA | `atom-button-primary` → /programari, "Programează o consultație" | Implemented once /programari is live |

## 3.3 What the Hero Does Not Contain

| Forbidden Element | Reason |
|------------------|--------|
| Awards or award badges | Awards signal prestige to peers; they create distance with patients |
| Statistics ("20+ years", "500+ surgeries") | Unverifiable at build time; reduces a human career to a metric |
| Marketing language | "World-class", "leading", "renowned" — undermines authenticity |
| List of hospital affiliations | That belongs in Section 7; not in the hero |
| Credentials string ("MD, PhD, FRNCS...") | Abbreviation soup that no patient can interpret; creates intimidation |
| Social media follower count | Social proof in the wrong register for this page |
| Patient testimonial | Testimonials are in Section 7 (after Medical Collaborations); not in the hero |

## 3.4 Photography Principles for the Hero

The hero photograph is not the same as the homepage hero photograph. The homepage hero is full-bleed with a dark overlay — visual authority at scale. The /despre hero is intimate — the patient is arriving to meet this person.

**Preferred:** Dr. Ungureanu in genuine, warm-lit engagement — either with the camera (direct eye contact, calm) or in his working environment (reviewing, explaining, in thought). The photograph should feel like a moment captured, not a moment performed.

**The distinction that matters:** A patient looking at the hero photograph of /despre should feel: *this is a real person I could sit across from.* If the photograph makes them feel like they are looking at a professional brand asset, it has failed.

---

# 4. Personal Philosophy

**Organism:** `organism-philosophy-statement`
**Background:** `color-surface` (`#FDFBF7`)
**Position:** Section 2 — immediately after the hero

## 4.1 Purpose

This section is the first time the patient hears the doctor speak in his own voice on this page. It bridges the visual establishment of the hero (here is a person) with the intellectual and professional narrative that follows (here is that person's journey and thinking).

The philosophy statement answers: *What does this doctor believe about medicine, about patients, about the relationship between a clinician and the person in front of them?*

This is not an abstract statement of values. It is a personal statement of how Dr. Ungureanu approaches his work — specific enough to feel real, broad enough to speak to any patient who reads it.

## 4.2 Voice and Tone

**First person.** Dr. Ungureanu speaks directly to the reader. Not "Dr. Ungureanu believes..." — that is the biography's register. This section uses "Cred că...", "Încerc întotdeauna...", "Ceea ce m-a convins..."

**Authentic.** The statement must come from Dr. Ungureanu. It cannot be drafted from generic medical values language and attributed to him. A patient who reads a philosophy statement that uses the same phrases as every other medical website's "our values" page will sense the inauthenticity immediately.

**Warm but not sentimental.** The statement acknowledges the emotional reality of a neurosurgical consultation without becoming overwrought. Plain directness is warmer than performed emotion.

**Under 120 words.** Long philosophy statements become self-congratulatory. The discipline of 80–120 words forces the statement to say something specific rather than everything that could be said.

## 4.3 Content Themes to Discuss with Dr. Ungureanu

These are themes for the content conversation — not a template to fill in. Dr. Ungureanu's responses to these questions, in his own words, are the raw material for the philosophy statement:

**Relationship with patients:**
- What is the most important thing that happens in the first consultation?
- What does "patient-centered care" mean to you in practice, not in principle?
- What do you want a patient to feel when they leave a consultation — regardless of the diagnosis?
- How do you think about the gap between what you know medically and what the patient understands?

**Relationship with education:**
- Why did you create Sfatul Neurochirurgului?
- What was the moment or observation that made you realize patients needed a different kind of access to neurosurgical information?
- What do you want a patient to understand before they sit across from you for the first time?

**Relationship with medicine as a practice:**
- What aspect of neurosurgery do you find most demanding — and most meaningful?
- What has changed in your approach to patients over the years?
- What do you find yourself saying to patients before procedures that you learned to say from experience?

## 4.4 Target Length and Structure

**80–120 words.** This is a firm target, not a guideline. Shorter loses specificity. Longer loses focus.

**1–3 paragraphs** of 2–4 sentences each. No bullet points. No sub-headings within this section. The philosophy statement is a continuous piece of personal writing.

**Typography:** `type-quote` (Lora italic, 24px) for a featured pull-line, followed by `type-body` (Inter, 17px) for the remainder. Alternatively, all in `type-body-lg` (Inter, 19px) if the statement is presented as a unified block rather than a pull-line plus extension.

## 4.5 Blocking Dependency

The philosophy statement cannot be drafted by anyone other than Dr. Ungureanu or with his direct, substantive input. A ghostwritten philosophy statement is detectable and undermines the authenticity that is the entire foundation of this page.

**Q — Philosophy statement:** Dr. Ungureanu provides the text or a substantive first-person draft in his own words (Romanian), which may be refined for clarity and length but not rewritten in a different voice.

---

# 5. Professional Timeline

**Organism:** `molecule-timeline` (full version)
**Background:** `color-surface-warm` (`#F4EFE6`)
**Position:** Section 3 — the primary content section of the page

## 5.1 This Section Tells a Story

The timeline is the most important section on /despre. It is also the most commonly misunderstood — the natural instinct is to reproduce a CV in a visual format. That instinct must be resisted.

**A CV is a document for selection.** It is addressed to a committee that needs to confirm qualifications. It is organized for scanning, not reading. It uses abbreviations, codes, and formats that hiring committees recognize and patients do not.

**A timeline is a story for patients.** It is addressed to a person who wants to understand who they are meeting. It is organized for reading — a progression that reveals a journey. It uses language that a patient can follow without a medical degree.

The test for every entry in the timeline: *Does this entry help a patient understand who this doctor is and how he became that person?* If the answer is no, the entry is for a CV — and belongs in a downloaded document that does not exist on this site.

**No tables.** The timeline is a visual-narrative component, not a data table. Tables present parallel information for comparison. A timeline presents sequential information for understanding.

**No PDF export.** There is no "Download CV" link on this page. There is no printer-friendly version. The timeline is not a document — it is a page experience. A patient who has read the timeline does not need a document version of it.

**No downloadable CV.** Not hidden behind a button, not linked from the footer, not available in any format on this site. If a referring physician or academic peer requires a formal CV, they request it through professional channels — not through a patient-facing website.

## 5.2 Timeline Content Categories

These categories, provided by Dr. Ungureanu, are the building blocks of the timeline. They appear in chronological order within the timeline — not organized by category separately.

| Category | Description | Entry format |
|----------|-------------|-------------|
| Educație medicală | Faculty of Medicine, degree program, institution, city, years | Year range + "Facultatea de Medicină, [Institution]" + brief note if relevant |
| Rezidențiat | Neurosurgery residency — specialization, institution, years | Year range + "Rezidențiat Neurochirurgie, [Institution]" + note on focus if any |
| Fellowships | Subspecialty training programs after residency | Year + "Fellowship [Program], [Institution], [Country]" |
| Schimburi internaționale | Visiting programs, observerships, international training exchanges | Year + "Stagiu de pregătire, [Institution], [City], [Country]" + brief context |
| Cursuri de perfecționare | Continuing education courses relevant to clinical practice | Year + "[Course name], [Organizer]" — selective, not exhaustive |
| Certificări și atestate | Board certifications, specialty attestations | Year + "[Certification name], [Issuing body]" |
| Activitate academică | University teaching positions, research roles, hospital academic affiliations | Year or period + "[Role], [Institution]" |
| Repere media | Key media appearances, published interviews, television or radio participation related to patient education | Year + "[Publication or channel], [brief context]" |
| Repere Sfatul Neurochirurgului | Founding date, launch milestones, platform growth milestones | Year + "Fondarea Sfatul Neurochirurgului" + brief origin context |
| Realizări profesionale | Significant professional achievements, awards from recognized medical bodies, leadership roles in professional societies | Year + "[Achievement or role], [Organization]" |

## 5.3 The Sfatul Neurochirurgului Entry

The founding of Sfatul Neurochirurgului appears as an explicit, named timeline entry. It is not a footnote, not a parenthetical, not a small card at the end of the timeline. It is a milestone in the same visual format as the residency or the fellowship.

This entry matters to patients specifically because it demonstrates that the educational mission is not incidental — it has a date, an origin, a reason it was created. A patient who reads this entry understands that the website they are visiting is part of a sustained professional commitment that predates their visit.

The entry includes:
- Year of founding (confirmed by Dr. Ungureanu)
- Brief origin context (2–3 sentences in the doctor's voice: what he observed, what he decided to do about it)

## 5.4 Entry Format

Each timeline entry contains:

```
[Year or year range] — presented as atom-overline or atom-label, color-accent
[Event title] — type-h4 (Inter 20px / 600)
[Institution or organization] — type-body-sm (Inter 15px), color-ink-secondary
[Optional note] — type-body-sm (Inter 15px), color-ink, 1–2 sentences maximum
```

**What makes an entry a story element vs. a CV line:**
- CV line: "2008 — Fellowship, Microsurgery" (what happened)
- Story element: "2008 — Fellowship în Microchirurgie, [Institution], [Country]. Prima experiență cu protocoale chirurgicale diferite de cele din România — o perspectivă care a schimbat modul în care abordez planificarea preoperatorie." (what happened and what it meant)

The optional note is where the story lives. It is brief — 1–2 sentences — but it is the difference between a list of facts and a narrative that a patient can follow.

Not every entry requires a note. Major milestones (residency, fellowships, founding of SN) earn notes. Routine courses may not.

## 5.5 Desktop Behavior

The timeline is a vertical layout with a continuous visual connector — a 2px line in `color-border` running vertically from the first entry to the last. Each entry is anchored to this line.

Visual connector position: left-aligned. Entries appear to the right of the connector. A small marker (circle or square in `color-accent`) at each entry's anchor point signals position on the timeline.

Reading direction: top (earliest) → bottom (most recent). The patient reads the story of a professional life from its beginning to its present.

Maximum reading column width: 720px. The timeline content must not span full page width — it is a reading document, not a layout exercise.

Section background: `color-surface-warm`. The entries themselves use `color-surface` cards or inline blocks — slightly elevated from the section background.

## 5.6 Mobile Behavior

On mobile (<768px):
- The vertical connector line is hidden or reduced to a minimal left-border treatment per entry
- Each entry stacks vertically in a single column
- Year marker appears above the event title (not to the left, where it would require horizontal space)
- The narrative note (optional text) wraps naturally below the institution line
- Entries are separated by `space-6` (24px) vertical gap
- All entry text meets minimum sizes: year label 12px, event title 18px, institution 15px, note 15px

## 5.7 Photography Opportunities Within the Timeline

Selected timeline entries may be accompanied by a photograph — a photograph that illustrates that moment in the doctor's journey.

**Photography opportunities to discuss with Dr. Ungureanu:**
- A photograph from an international exchange or fellowship (the institution, the city, a clinical environment abroad)
- A photograph from an early career period if available (medical school, residency — archival)
- A photograph from the launch or early period of Sfatul Neurochirurgului (if a meaningful image exists)
- A photograph from a significant professional achievement if one was commemorated photographically

**Photography rules for timeline use:**
- Photographs must be authentic — no stock imagery
- They appear as inline images within specific entries, not as a separate gallery
- Maximum one photograph per three timeline entries — not every entry has a photograph
- Warm-lit or warm-toned. If archival photographs have a cool tone, they may be presented as warm-converted black and white
- Mobile: photographs collapse to a smaller width or are hidden if they do not contribute meaningfully at small sizes

## 5.8 Accessibility for the Timeline

- The timeline is a reading document, not an interactive component. No keyboard interaction is required beyond reading.
- Each entry heading (`type-h4`) is an accessible heading within the section's H2 context — but given the number of entries, H4 may be too many headings for screen reader navigation. Implementation may use `role="listitem"` with the event title as strong text rather than a heading. This decision is resolved during Phase 5 build.
- The visual connector line is `aria-hidden="true"` — it is decorative.
- Entry year markers (circles/dots) are `aria-hidden="true"` — the year is present in the text content.
- All photographs within the timeline have descriptive `alt` text naming the subject, location, and approximate period.
- The `prefers-reduced-motion` query suppresses any entrance animations on individual entries.

---

# 6. International Experiences and Exchanges

**Organism:** `organism-credentials-list` (international variant)
**Background:** `color-surface` (`#FDFBF7`)
**Position:** Section 4

## 6.1 Purpose

International experiences — fellowships abroad, visiting programs, international collaborations, conferences where the doctor has presented or participated — communicate something that no domestic credential can: that this clinician's thinking has been shaped by exposure to different medical cultures, different protocols, and different approaches to the same clinical problems.

For a patient in Romania receiving care for a complex neurological condition, this matters in a specific way. It says: this doctor has seen how this condition is treated elsewhere. He has chosen his approach with comparative knowledge — not only because it is what he learned during residency, but because he has seen alternatives and formed a considered clinical position.

This is credibility that speaks to patients in a language more accessible than peer-reviewed citations: *this doctor has been out in the world and brought something back for you.*

## 6.2 Content Definition

Experiences to document in this section:

| Type | Content | Notes |
|------|---------|-------|
| Fellowships abroad | Institution, city, country, year, subspecialty focus | Major training experiences. Include a brief (1-sentence) patient-facing description of what this fellowship developed |
| Observerships and visiting programs | Institution, country, year, brief context | Shorter stays. Include only if clinically meaningful |
| International collaborations | With which institutions or departments abroad; nature of collaboration | Only if ongoing or with significant professional impact |
| Invited presentations abroad | Conference name, city, country, year, brief topic | Signals that this doctor's work is recognized beyond Romanian medical circles |
| International conference participation | Major international conferences attended. Selective — not exhaustive | Establishes participation in global professional discourse |

## 6.3 Why This Section Is Separate from the Timeline

The professional timeline tells the full chronological story, which includes international experiences woven into the narrative. This section zooms in on the international dimension specifically, for two reasons:

1. **Narrative emphasis.** International exposure is a trust signal that deserves dedicated attention — not burial within a list of Romanian institutional affiliations and course titles.
2. **Patient-facing explanation.** The timeline format (entry + institution + optional note) is efficient for timeline reading but does not accommodate a more substantive patient-facing explanation of why these experiences matter. This section can provide that explanation.

## 6.4 Patient-Facing Framing

The section does not simply list institutions and years. It opens with 1–2 sentences explaining why international medical training matters for patient care. Not marketing language — honest explanation:

"O parte semnificativă a formării Dr. Ungureanu a inclus programe de pregătire și colaborări în afara României — expunere la standarde chirurgicale internaționale, protocoale diferite și perspective clinice diverse. Această experiență contribuie direct la calitatea evaluărilor și a deciziilor terapeutice pe care le oferim pacienților noștri."

(Final copy from Dr. Ungureanu — not the above verbatim, but this register.)

---

# 7. Academic Activity

**Organism:** `organism-credentials-list` (academic variant)
**Background:** `color-surface-warm` (`#F4EFE6`)
**Position:** Section 5

## 7.1 Purpose

Academic activity signals that this clinician does not only practice medicine — he thinks rigorously about it. Teaching, mentoring, research, and institutional academic roles are evidence of intellectual engagement with the field that benefits patients indirectly: a doctor who teaches must articulate knowledge clearly; a doctor who researches must question assumptions; a doctor who mentors must communicate principles precisely.

Academic authority supports trust. It is not the lead — the story (timeline) and the philosophy (personal statement) precede it. Academic activity appears after the patient has already encountered the person; now they encounter the intellectual rigors.

## 7.2 Content Definition

| Activity type | Content | Notes |
|---------------|---------|-------|
| University teaching | Position title, university, department, years | Confirm whether this is a current or past role |
| Mentoring | Nature of mentoring activity (residents, students) — without naming individuals unless permitted | 1–2 sentences describing the mentoring commitment, not a list of mentees |
| Research | Active or completed research programs — topics, institutional affiliation, years | Patient-accessible description of what the research addressed |
| Clinical research | Studies, trials, or outcome research in which Dr. Ungureanu has participated | Selective — those with patient relevance |
| Professional society memberships | Society name, membership level if relevant | Demonstrates participation in the professional community |
| Hospital board or committee roles | Committee name, institution, years | Only significant roles — not routine committee memberships |

## 7.3 Academic Authority Does Not Dominate

The section is a concise inventory — not an exhaustive demonstration of every academic role held. A patient reading this section should come away thinking: *this is a serious academic clinician* — not: *I cannot read this list without a medical dictionary.*

Length guidance: 200–400 words total in this section, including list entries. If more content exists, it is condensed or moved to Phase 2 (academic archive, searchable).

---

# 8. Publications and Conferences

**Organism:** `organism-credentials-list` (publications variant)
**Background:** `color-surface` (`#FDFBF7`)
**Position:** Section 6

## 8.1 Purpose

Academic publications and conference presentations are evidence of intellectual contribution to the field. They confirm that this doctor's knowledge is not only applied — it is produced. A clinician who publishes contributes to the body of knowledge that all clinicians draw from.

For patients, the publications section performs a specific role: it confirms that this doctor is considered by medical peers to have something worth reading. It requires no patient to actually read the papers — the evidence is in the existence and context of the publications, not in their content.

## 8.2 Presentation Principles

**Selected, not exhaustive.** A complete publication list belongs in an academic CV — not on a patient website. The publications section presents selected works: those that are most relevant to the conditions this doctor treats, most representative of his research focus, or most recent.

**Lay-language summary per entry.** Every publication entry includes, in addition to the formal citation, one sentence that explains what the paper was about in plain Romanian. This sentence is not a translation of the abstract — it is a patient-accessible explanation of what the research addressed and why it matters.

Example:
*"Ungureanu G. et al., «Title», Journal Name, Vol. X, No. Y, 2019.*
*Această lucrare a analizat rezultatele pe termen lung ale intervenției [X] la pacienții cu [condition] — cu implicații practice pentru selecția candidaților chirurgicali."*

**No abbreviations without expansion.** Journal names may be abbreviated in standard academic citation format, but all other content is fully written out.

**Chronological order within selected list:** Most recent first. This is the inverse of the timeline (earliest first) — publications are selected and presented most-recent-first to show currency.

## 8.3 Conference Presentations

| Conference content | Presentation |
|-------------------|-------------|
| Conferences where Dr. Ungureanu has presented | Name + year + presentation title or topic + location |
| Major international conferences attended | Name + year — selected, not exhaustive |
| Keynote or invited lecture appearances | Specifically marked — these carry more weight than contributed presentations |

Conference lists follow the same principles as publications: selected, not exhaustive; patient-accessible context where possible; most recent first.

## 8.4 Phase 1 vs. Phase 2

**Phase 1 — Simple lists:**
- Selected publications: formatted citation + 1-sentence lay summary
- Selected conferences: name + year + topic
- Both presented as readable lists within the `organism-credentials-list` component
- No interaction required to access the content — no accordion, no pagination, no search

**Phase 2 — Search and filtering:**
- All publications (not selected — complete list)
- Filterable by year, topic, or type (original research / review / case report / conference)
- Search by keyword within the publication list
- Requires Phase 2 planning to determine implementation approach (custom search, static JSON with filter, or a simple category-based accordion)

Phase 2 publication search is documented here for planning purposes. It is not built in Phase 1.

---

# 9. Medical Collaborations

**Organism:** `organism-credentials-list` (collaborations variant)
**Background:** `color-surface-warm` (`#F4EFE6`)
**Position:** Section 7

## 9.1 Purpose

A neurosurgeon does not operate alone. Neurosurgical care is inherently multidisciplinary — it requires collaboration with neurologists, oncologists, radiologists, anesthesiologists, intensivists, rehabilitation specialists, and general practitioners who refer patients.

This section communicates that Dr. Ungureanu is embedded in a network of professional relationships. A patient reading this section understands: *my care will not depend on one person's judgment in isolation. This doctor works within, and with, a community of medical professionals.*

This is a specific and important form of reassurance for patients facing complex conditions where multiple specialist opinions and treatments are involved.

## 9.2 Content Definition

| Collaboration type | Content | Notes |
|-------------------|---------|-------|
| Hospital affiliations | Hospital name, city, nature of affiliation (staff / visiting / operating privileges) | Patient-facing names, not legal entity names |
| Clinic partnerships | Clinic name, city — locations where consultations occur | Partially covered by /programari location cards; About page provides the institutional context |
| Multidisciplinary teams | Specialty departments or tumor boards this doctor participates in — without naming individual colleagues unless specifically permitted | Describe the collaboration, not the individuals |
| Referral relationships | Types of specialists who refer to Dr. Ungureanu, and to whom he refers — a sense of the referral ecosystem | General description, not a list of specific names |
| National professional society roles | Active roles in Romanian neurochirurgie or medical societies | Confirms participation in the national professional community |

## 9.3 How This Reassures Patients

**For patients with complex diagnoses:** Knowing that this neurosurgeon works within tumor boards, multidisciplinary teams, and collaborative networks with oncologists and neurologists means that the patient's care will benefit from multiple expert perspectives — not only the neurosurgeon's view.

**For patients considering second opinions:** The collaborations section implicitly communicates that second opinions are normal in this professional context — this doctor refers and receives referrals. The patient who wants a second opinion does not feel they are challenging the doctor by seeking one.

**For referring physicians:** A doctor who refers a patient wants to know that the specialist they are sending that patient to works collegially — returns patients to their GP, communicates with other specialists, participates in the professional community. The collaborations section addresses this audience implicitly while remaining patient-facing in tone.

## 9.4 Privacy Considerations

Naming individual colleagues requires those colleagues' explicit consent. The collaborations section should describe the nature of professional relationships rather than listing specific names where consent has not been obtained. "Colaborare cu departamentele de Neurologie și Oncologie din [Institution]" is preferable to naming specific physicians without their confirmed consent.

If colleague physicians have provided explicit endorsements for the /recomandari page, their names may appear there — not duplicated here without specific purpose.

---

# 10. Human Dimension

**Position:** Section 8 — optional
**Organism:** Inline atoms + molecules
**Background:** `color-surface` (`#FDFBF7`)
**Visibility:** Present only if Dr. Ungureanu decides to include this content and provides it

## 10.1 What This Section Is

This section is an optional, brief glimpse of the person behind the profession. It is the most personal content on the page — and therefore the most valuable to patients who have read this far, and the most sensitive to get wrong.

It is not lifestyle content. It is not a social media aesthetic. It does not feature the doctor's hobbies, travel, pets, or family photographs. It is a brief, dignified statement of the human motivations that underlie the professional choices visible everywhere else on the page.

This section exists because a patient who has read through the timeline, the international experiences, the publications, and the collaborations has encountered an impressive professional — but still wants to know: *why? Why neurosurgery? Why this commitment to patient education? What drives a person to dedicate their professional life to this?*

If Dr. Ungureanu is willing and able to answer that question honestly and briefly, this section provides the answer. If not, the section is absent — not replaced with anything, not filled with generic values language.

## 10.2 Possible Content Directions

These are possibilities to discuss with Dr. Ungureanu. He selects from them — or provides something different. No combination is required. One honest direction is more valuable than all of them combined in generic form.

**Why neurosurgery:**
What specific moment, encounter, or realization led to this choice of specialty? Not: "I was always passionate about the brain." Something specific — a clinical encounter during medical school, a mentor, a patient case, a book, an observation about where surgery and precision meet human consequence.

**The educational mission:**
Why Sfatul Neurochirurgului specifically? What gap in patient knowledge made creating an educational platform feel necessary — not merely desirable? What does the doctor observe in first consultations that makes him wish patients had arrived with different preparation?

**What sustains the commitment:**
After years of practice, what continues to make this work meaningful? Not generic: not "helping patients." Something specific — a particular type of conversation, a specific aspect of neurosurgical work, an observation about patients that keeps the work from becoming routine.

**A professional regret or challenge:**
This is the most courageous option — and the most trust-building. A doctor who is willing to acknowledge that medicine involves difficulty, uncertainty, and cases that do not go as hoped is a doctor who treats the patient as an adult. This content direction requires the most care and the most deliberate writing.

## 10.3 What This Section Is Not

| Forbidden | Reason |
|-----------|--------|
| Family photographs | The family has not consented to be part of this website's content |
| Hobbies and lifestyle | Not relevant to the patient's medical context; the doctor's brand is not a lifestyle brand |
| Inspirational quotes | Generic; undermines the authentic register of everything around it |
| "I believe in making a difference" | Every doctor says this; it says nothing specific |
| Personal tragedies as motivation | Medical tragedy-as-origin-story is a narrative cliché that requires exceptional handling |
| Anything that sounds drafted by a copywriter | This section must read as Dr. Ungureanu speaking, or it must not exist |

## 10.4 Length

80–150 words. Two to four short paragraphs. No longer. The human dimension section is a glimpse, not a confession.

---

# 11. Final CTA

**Organism:** `organism-cta-banner`
**Background:** `color-ink` (`#231E1A`)
**Position:** Section 9 — always visible

## 11.1 Purpose

The /despre page is the longest, most content-rich page on the site. A patient who has read it in full has invested significant time and attention. They have encountered the doctor's philosophy, traced his professional journey, understood his academic and clinical commitments, and potentially encountered his most personal motivations.

The final CTA exists for one reason: to provide the patient who is ready to act with a clear, calm next step.

It does not persuade. It does not congratulate the patient for reading. It does not add new information. It simply makes the next action available.

## 11.2 Emotional Tone

**Not urgent.** A patient who has read the entire About page and has decided to contact the practice will click a button regardless of urgency language. A patient who has read the page and decided not to contact yet will not be pushed into contact by urgency language — they will feel pressured and the trust built by the entire page will be damaged.

**Not pressuring.** No scarcity, no "limited appointments," no countdown.

**Transitional.** The tone acknowledges that the patient has been on a journey through this page and that the next step — whenever they are ready — is clear and available.

## 11.3 Required Elements

| Element | Specification |
|---------|--------------|
| Heading | `type-h2` (Lora 38px / 700 / `color-surface`) — calm, transitional. Not "Book Now." Not "Don't Wait." A sentence that acknowledges the journey and invites the next step. (Final copy from Dr. Ungureanu.) |
| Supporting text | `type-body` (Inter 17px / `color-surface` at 85% opacity) — 1–2 sentences. What happens next when the patient contacts the practice. |
| Primary CTA | `atom-button-primary` (inverted — `color-surface` background, `color-ink` text) → /programari — "Programează o consultație" |
| No secondary CTA | One button, one destination. The /despre CTA banner is identical in structure to the homepage final CTA: one action, no options. |

## 11.4 Routing

The /despre CTA banner routes to /programari. Always. Not to /contact directly. The routing chain is maintained: any page → "Programează o consultație" → /programari → "Contactați-ne" → /contact.

---

# 12. Mobile Experience

## 12.1 Section Order on Mobile

Identical to desktop. No sections are reordered, hidden, or collapsed for mobile (beyond the existing optional visibility of Section 8). The page is long on mobile — that is appropriate. A patient reading the About page is engaged and willing to scroll.

## 12.2 Timeline on Mobile

The timeline is the component with the most significant mobile behavior changes:

| Element | Desktop | Mobile |
|---------|---------|--------|
| Visual connector line | Vertical, left-aligned, full height | Reduced to a left-border treatment per card, or omitted |
| Year marker | Inline with connector, left of entry | Above the event title |
| Entry layout | Connector left, content right (flex row) | Full-width stacked (flex column) |
| Entry gap | `space-8` (32px) | `space-6` (24px) |
| Column width | 720px max | 100% container width |
| Photography | Inline with entries (right-aligned thumbnail) | Full-width or hidden depending on image significance |

On mobile, a patient scrolls through the timeline entries in a natural vertical reading motion. Each entry is self-contained — year, title, institution, optional note — without requiring horizontal reading.

## 12.3 Spacing

| Section | Desktop (top/bottom) | Mobile (top/bottom) |
|---------|---------------------|---------------------|
| Hero | 80px | 40px |
| Personal philosophy | 80px | 40px |
| Professional timeline | 96px | 48px |
| International experiences | 80px | 40px |
| Academic activity | 80px | 40px |
| Publications and conferences | 80px | 40px |
| Medical collaborations | 80px | 40px |
| Human dimension (if present) | 64px | 32px |
| Final CTA | 96px | 48px |

The professional timeline receives extra padding because it is the longest and densest section — additional breathing room aids reading.

## 12.4 Typography on Mobile

| Element | Desktop | Mobile |
|---------|---------|--------|
| H1 (hero heading) | 52px | 36px |
| H2 (section headings) | 38px | 28px |
| Timeline event title (H4 or strong) | 20px | 18px |
| Body text | 17px | 16px |
| Body-lg (philosophy) | 19px | 17px |
| Caption / overline | 12px | 12px |
| Timeline year marker | 12px | 12px |

Body text minimum 16px on all mobile breakpoints without exception.

## 12.5 Reading Flow

The About page is a long-form reading experience. On mobile, reading flow must be continuous — no section should require horizontal scrolling, no content should be clipped, and no interactive element should interrupt reading before the patient chooses to interact.

The patient testimonials block (when visible) appears between Sections 7 and 8 — a moment of pause and social proof within the longer reading journey.

## 12.6 Touch Targets

All interactive elements:

| Element | Mobile target |
|---------|--------------|
| CTA button (hero) | 52px height, minimum full container width or 220px |
| CTA button (final) | Full-width, 52px height |
| Any inline links | 44×44px touch area around the link text |
| Social links (if present) | 44×44px per icon |

No interactive elements within the timeline (entries are not expandable in Phase 1). No accordion within the timeline.

## 12.7 50+ Patient Consideration

The About page is longer and more content-dense than any other page on the site. For patients aged 50+, the mobile reading experience depends on:
- Text size that does not require zooming (met by 16px minimum)
- Sufficient spacing between elements that targets are not accidentally tapped
- A section structure that signals progress — section headings every 3–6 scrolls provide orientation landmarks
- No interaction required to access any content — the page is read, not operated

---

# 13. Accessibility

## 13.1 Heading Outline

The page must produce a single, logical heading outline:

```
H1: [Hero headline — Doctor's name or positioning statement]
  H2: [Personal philosophy section heading]
  H2: Parcursul profesional (or equivalent — Professional timeline)
    [Timeline entries — H4 or strong element, depending on Phase 5 implementation decision]
  H2: Experiențe internaționale
  H2: Activitate academică
  H2: Publicații și conferințe
  H2: Colaborări medicale
  H2: [Human dimension heading — if section is present]
  H2: [Final CTA heading]
```

One H1 per page. All section headings are H2. Timeline entry titles: if the count of entries would create an overwhelming screen-reader navigation menu of H4 elements, implementation may use `role="list"` + `role="listitem"` with strong text for event titles. This is a Phase 5 implementation decision — document it in the build notes.

## 13.2 Timeline Accessibility

The timeline is a reading component, not an interactive component. Accessibility priorities:

- The visual connector line is `aria-hidden="true"` — decorative, carries no semantic meaning
- Year markers / dot indicators are `aria-hidden="true"` — year information is present in the entry text
- All timeline photographs have descriptive `alt` text: "[Doctor name] at [Institution], [City], [Year]" — specific, not generic
- If entries are wrapped in a list structure (`<ol>` or `<ul>`), each entry is a `<li>` — the structure communicates chronological sequence
- Screen reader users can navigate section-by-section (H2 headings) or scroll through the full timeline

## 13.3 Screen Reader Support

| Element | Screen reader treatment |
|---------|------------------------|
| Hero portrait | `alt="Dr. George Ungureanu, neurochirurg, [brief description of setting]"` — specific |
| Philosophy statement | Plain text — reads naturally |
| Timeline entry structure | Year + title + institution + note — all visible text, no hidden content |
| Publication citations | Read as text — no special treatment needed |
| External links (conference websites, institution links if any) | Open in new tab with `aria-label` noting the destination and external opening |
| Patient testimonials block (when visible) | Each testimonial is a `<blockquote>` with attribution; reads naturally |
| CTA buttons | "Programează o consultație" — specific label, not "click here" |

## 13.4 Keyboard Navigation

All content on /despre is accessible without a mouse:
- Tab moves through all interactive elements (links, CTA buttons) in document order
- The hero CTA and final CTA are the primary interactive elements
- Any inline links within body text (institution names, if linked) are Tab-reachable
- No element requires hover to reveal content

The page does not use accordions in Phase 1 (publications and conferences appear as lists, not expandable items). This simplifies keyboard navigation — no accordion trigger/expand interaction is required.

## 13.5 Cognitive Accessibility

The About page is dense by necessity — it documents a full professional life. Cognitive accessibility requires:

- **Clear section landmarks:** Every major section has a visible H2 heading that tells the patient what they are about to read before they read it
- **Progressive depth:** Each section can be read at a high level (title + lead) or at full depth (all entries, notes, lay summaries). A patient who skims gets orientation; a patient who reads gets full context.
- **No required sequence:** A patient who navigates directly to the publications section (via anchor or by scrolling) does not miss anything required for understanding — each section is self-contained
- **Consistent formatting:** Timeline entries follow the same format throughout — year, title, institution, optional note. The patient learns the pattern once and reads all entries using it.
- **No time-limited elements:** No auto-advancing content, no disappearing sections, no session timeouts

---

# 14. Phase 2 Opportunities

These are documented for planning purposes. None are implemented in Phase 1.

## 14.1 Interactive Timeline

Phase 2 may introduce timeline interactivity:
- Click/tap on a timeline entry to expand additional context (longer notes, photographs, links to publications related to that period)
- Filter the timeline by category (Education / International / Academic / SN milestones)
- Scroll-anchored section highlighting — the active timeline period is highlighted as the patient scrolls

**Condition:** Phase 1 timeline must be built with clean, maintainable structure that can be enhanced without rebuilding from scratch.

## 14.2 Media Milestones

Phase 2 may add a dedicated media section or media gallery within the timeline — video clips, podcast appearances, television segments, or print articles where Dr. Ungureanu has been interviewed or featured.

**Condition:** Requires confirmed media archive from Dr. Ungureanu; legal clearance for embedding or reproducing media content; GDPR-compliant hosting for any video content not hosted on YouTube.

## 14.3 Conference Filtering

If the full conference and publication list grows significantly, Phase 2 introduces:
- A filter by year within the publications/conferences section
- A filter by topic or subspecialty
- A simple search within the list

**Condition:** Phase 1 list must be structured in a way that is filterable (consistent data format per entry). A JSON-backed static filter or a custom post type approach are both candidates — Phase 2 planning determines the approach.

## 14.4 Academic Archive

A dedicated searchable academic archive — distinct from the publications section on /despre — could consolidate all publications, conference presentations, research abstracts, and lecture materials in a searchable database.

**Condition:** Volume of academic output must justify the complexity of a separate archive. Appropriate for Phase 2 if the publications list exceeds 30–40 entries.

## 14.5 Multilingual Biographies

A Hungarian-language version of the biography (not the entire site — only the About page) could serve the Hungarian-speaking patient population in Cluj-Napoca and Transylvania.

**Condition:** Requires multilingual strategy decision; hreflang configuration; separate content management; confirmed Hungarian-speaking patient population as a meaningful segment.

---

# 15. Blocking Dependencies

## 15.1 Full Dependency Table

| Dependency | Source | Impact if Missing | Status |
|-----------|--------|------------------|--------|
| **Q7 — All photography** | Dr. Ungureanu | Hero cannot be launched; page lacks authentic visual anchor | BLOCKING |
| Q7a — Hero portrait | Dr. Ungureanu | Hero section placeholder only — page cannot launch | BLOCKING |
| Q7b — Secondary portrait (warmer, casual) | Dr. Ungureanu | Can use Q7a in two contexts; not strictly blocking | Post-launch |
| Q7c — Timeline photography (international periods, SN launch) | Dr. Ungureanu | Timeline entries have no accompanying images — acceptable for launch | Optional post-launch |
| **Philosophy statement** | Dr. Ungureanu | Section 2 empty; page must not launch with placeholder | BLOCKING |
| **Biography text (third person, 3–4 paragraphs)** | Dr. Ungureanu | Doctor Introduction organism cannot be populated | BLOCKING — or remove intro and lead with philosophy + timeline |
| **Education history** | Dr. Ungureanu | Timeline incomplete — cannot launch | BLOCKING |
| Q_edu_a — Degree program, institution, city, years | Dr. Ungureanu | Timeline Category 1 empty | BLOCKING |
| **Residency details** | Dr. Ungureanu | Timeline incomplete | BLOCKING |
| Q_res_a — Specialization, institution, years | Dr. Ungureanu | Timeline Category 2 empty | BLOCKING |
| **Fellowship details** | Dr. Ungureanu | Timeline incomplete; Section 4 incomplete | BLOCKING if fellowships exist |
| Q_fel_a — Institution, program, country, years | Dr. Ungureanu | Timeline Category 3 + Section 4 empty | BLOCKING |
| **International exchanges and observerships** | Dr. Ungureanu | Section 4 sparse; Timeline Category 4 incomplete | BLOCKING if exchanges exist |
| **Continuing education courses (selective)** | Dr. Ungureanu | Timeline Category 5 may be omitted if not significant; judgment with Dr. Ungureanu | Conditional |
| **Certifications and atestate** | Dr. Ungureanu | Timeline Category 6 incomplete | BLOCKING if certifications exist |
| **Academic positions** | Dr. Ungureanu | Section 5 incomplete; Timeline Category 7 incomplete | BLOCKING if positions exist |
| **Sfatul Neurochirurgului founding date and origin context** | Dr. Ungureanu | SN timeline entry incomplete; personal philosophy missing its educational origin | BLOCKING |
| **Publications list (selected, with lay summaries)** | Dr. Ungureanu | Section 6 empty | BLOCKING — page launches without publications if none provided |
| **Conference list (selected)** | Dr. Ungureanu | Section 6 incomplete | Post-launch if none provided at launch |
| **Hospital and clinic affiliations** | Dr. Ungureanu | Section 7 incomplete | BLOCKING — must have at least /programari location cross-reference |
| **Collaborations (department-level descriptions)** | Dr. Ungureanu | Section 7 sparse | Conditional — description without naming individuals is possible |
| **Human dimension content** | Dr. Ungureanu | Section 8 absent — acceptable; page functions without it | Optional |
| **Specialty designation (exact wording)** | Dr. Ungureanu | Hero and positioning statement cannot be confirmed | BLOCKING |
| **/programari live** | Phase 4 | Hero CTA and final CTA have no destination | BLOCKING |
| **Testimoniale CPT — ≥2 approved entries** | Phase 6 workflow | Testimonials block remains hidden — acceptable; page launches without it | Hidden at launch |

## 15.2 What Can Be Built Before Content Is Provided

| Component | Status without Dr. Ungureanu content |
|-----------|--------------------------------------|
| Hero structure (layout, breadcrumb, CTA positioning) | Buildable; photography and text are placeholder |
| Philosophy statement layout | Buildable; text is placeholder |
| Timeline visual structure (connector, entry format, year markers) | Buildable; no entries |
| International experiences section layout | Buildable; no content |
| Academic activity section layout | Buildable; no content |
| Publications section layout | Buildable; no content |
| Collaborations section layout | Buildable; no content |
| Human dimension section layout | Buildable conditionally |
| Final CTA banner | Buildable; /programari must be live for the CTA to route |
| Patient testimonials block (hidden) | Buildable in Phase 5; hidden pending Phase 6 |

## 15.3 Minimum Viable /despre at Launch

The page can launch with a reduced content set if the following minimum is met:
- Hero portrait (Q7a) confirmed
- Positioning statement confirmed
- Philosophy statement confirmed (80–120 words, first person)
- Professional timeline with at minimum: education, residency, and SN founding entry
- At least one section from: International experiences OR Academic activity
- Hospital affiliations (even if partial — the /programari cards provide location context)
- Final CTA routing to /programari

The page must not launch with:
- Empty sections with placeholder text
- A hero photograph that is stock or unrelated to the doctor
- A philosophy statement drafted by anyone other than Dr. Ungureanu
- A timeline with fewer than 5 real entries

---

# 16. Validation Checklist

## 16.1 Trust

- [ ] The hero photograph is authentic and warm — not posed for marketing, not clinical
- [ ] No awards, statistics, or marketing language appear in the hero
- [ ] The philosophy statement is in first person and reads as Dr. Ungureanu's voice, not a copywriter's
- [ ] The timeline entries have optional notes that give context, not just data
- [ ] The Sfatul Neurochirurgului founding entry is present, dated, and contextualized
- [ ] Publications include lay-language summaries — a non-medical adult understands each one
- [ ] The collaborations section describes professional relationships, not just institutions
- [ ] No section leads with credentials — story and philosophy precede evidence

## 16.2 Humanity

- [ ] A patient who reads this page comes away with a sense of who Dr. Ungureanu is as a person, not just as a clinician
- [ ] The philosophy statement says something specific — it does not use phrases common to every medical website's "values" section
- [ ] If Section 8 (Human dimension) is present, it reads as genuine — specific, human, and clearly from the doctor's own perspective
- [ ] The biography (if present) includes why he chose neurosurgery — not only what he has accomplished
- [ ] No section is so dense with credentials that a patient feels they have been handed a CV
- [ ] The page's tone is consistent from hero to CTA — warm, calm, direct throughout

## 16.3 Credibility

- [ ] The timeline covers all required categories: education, residency, any fellowships, international exchanges, certifications, academic activity, SN milestones
- [ ] No timeline entry uses unexplained abbreviations or acronyms
- [ ] International experiences section explains — briefly — why international exposure matters for the patient
- [ ] Publications include proper citations and lay summaries
- [ ] Academic roles are described accurately — not inflated, not undersold
- [ ] Hospital and clinic affiliations in the collaborations section are accurate and confirmed

## 16.4 Accessibility

- [ ] One H1 on the page; H2 for all section headings; no skipped heading levels
- [ ] Timeline visual connector is `aria-hidden="true"`
- [ ] All portrait and timeline photographs have specific, descriptive alt text
- [ ] All interactive elements have visible focus rings
- [ ] CTA buttons have explicit labels: "Programează o consultație" — not "Click here" or "Learn more"
- [ ] No content is revealed only on hover
- [ ] All text passes WCAG 2.1 AA contrast (primary: 14.5:1)
- [ ] Skip to content link is the first focusable element; `#main-content` on the hero section
- [ ] prefers-reduced-motion suppresses all entrance animations

## 16.5 Emotional Comfort

- [ ] The manifesto test passes: a patient who received a difficult diagnosis last week reads this page and feels they understand who this doctor is — and feels slightly more confident about the decision to contact
- [ ] The page does not leave the patient with the feeling: "This is impressive, but I don't know what to do next"
- [ ] The final CTA is a calm invitation — not a demand, not a reward for reading, not an urgency-based prompt
- [ ] The page's emotional register is consistent with the homepage — warm, unhurried, human
- [ ] No section creates anxiety — not through complexity, not through intimidating credentials, not through clinical detachment

## 16.6 Patient Understanding

- [ ] A patient without a medical background can read the philosophy statement and understand what the doctor believes about his work
- [ ] A patient can trace the doctor's professional journey from the timeline without a medical vocabulary
- [ ] The lay-language summaries in the publications section are readable by a Grade 8–10 reader
- [ ] The international experiences section explains why those experiences matter for patient care — not just that they occurred
- [ ] The collaborations section helps a patient understand that their care will involve a professional network, not one person in isolation
- [ ] The patient who reads the full page knows what to do next: there is one clear CTA, one destination, and no ambiguity about the next step

---

*Despre version: 1.0 — 2026-06-28*
*Expands: docs/tasks/01_INFORMATION_ARCHITECTURE.md §6.4 (Despre Dr. George Ungureanu)*
*Source: docs/tasks/00_PROJECT_ROADMAP.md v1.1, docs/project/PATIENT_CENTERED_MANIFESTO.md, docs/content/CONTENT_TONE.md, docs/design-system/BRAND_GUIDELINES.md*
*Next: docs/tasks/08_RECOMANDARI.md*
