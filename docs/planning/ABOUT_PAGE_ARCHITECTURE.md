# About Page Architecture — /despre/
**Sprint:** 8 — Phase 1 (Planning only)  
**Date:** 2026-06-30  
**Status:** Awaiting approval — DO NOT IMPLEMENT  
**Roles:** Healthcare UX Designer · Medical Branding Specialist · Patient Trust Strategist · Lead Content Architect

---

## Context

The `/despre/` page does not yet exist as a WordPress page. It is, however, already referenced in two live places:

1. **Physician schema node:** `"@id": "https://georgeungureanu.doctor/despre/#physician"` — emitted on every `articole` single page via the plugin's Section 9 schema hook. Until the page exists, this anchor resolves to a 404.
2. **Author block shortcode:** `[gu_article_author]` renders a "Despre Dr. George Ungureanu →" link pointing to `/despre/`. Every published article carries this broken link.

**Priority:** High. This page should be built before the site moves to staging.

---

## 1. User Goals

### Who arrives at this page and why

| Visitor type | Emotional state | Primary question |
|-------------|----------------|-----------------|
| Referred patient | Cautiously hopeful | "Can I trust this specific doctor with my situation?" |
| Self-referred patient (found via search) | Anxious, researching | "Is this doctor genuinely qualified, or just a website?" |
| Patient's family member | Protective, skeptical | "Who is making decisions about my family member?" |
| GP / referring physician | Professional, efficient | "What does this specialist actually specialize in?" |
| Journalist / media | Neutral | "What are this doctor's credentials and areas of expertise?" |
| Second-opinion seeker | Comparing options | "What makes this doctor different from the one I already saw?" |

### What success looks like for each visitor

- **Referred patient:** Leaves feeling their referral was a good choice. Ready to book.
- **Self-referred:** Convinced this is not just a marketing website. Reads the philosophy section. Books.
- **Family member:** Understands who is operating and why this person is trustworthy.
- **Referring GP:** Quickly finds specialty focus and contact details. Bookmarks for future referrals.
- **Media:** Finds quotable credentials and a contact point.
- **Second-opinion seeker:** Sees enough differentiation to book a second-opinion consultation.

### The single most important thing the page must do

**Answer "Am I in good hands?" within the first viewport — through a face, a name, a specific title, and a human sentence.**

Credentials alone do not answer this question. A photo answers it faster than a CV.

---

## 2. Trust Signals

Ranked by impact on patient trust decision (UX research synthesis for healthcare):

### Tier 1 — Immediate (above-the-fold)

| Signal | Why it works | Implementation |
|--------|-------------|---------------|
| Professional photograph | A face creates accountability. Patients trust a person, not an institution. | Hero section; requires resolution of Q7a photography blocker |
| Full name + specific title | "Neurochirurg" is more trustworthy than "Doctor" or "Specialist" | H1 + subtitle |
| Specific positioning statement | One sentence that tells a patient what kind of doctor to expect | Subtitle / tagline below name |

### Tier 2 — Scanning (first scroll)

| Signal | Why it works | Implementation |
|--------|-------------|---------------|
| Years of experience | Patients use this as a proxy for volume and competence | Quick facts strip |
| Specific training institutions | Named institutions (even unfamiliar ones) signal rigor | Education section headline |
| Current hospital affiliation | Patients know and trust hospitals more than individual practices | Quick facts strip |
| Languages spoken | Reduces a specific barrier; signals patient-centered thinking | Quick facts strip |

### Tier 3 — Reading (engaged visitor)

| Signal | Why it works | Implementation |
|--------|-------------|---------------|
| Philosophy of care | Most differentiating signal; tells the patient what the experience will feel like | Dedicated section, pull-quote treatment |
| Personal origin story | Why this doctor chose neurosurgery; humanizes credentials | Biography section |
| Patient communication approach | Explicitly states how the doctor talks to patients (plain language, etc.) | Philosophy / patient approach section |

### Tier 4 — Validation (researcher)

| Signal | Why it works | Implementation |
|--------|-------------|---------------|
| Academic affiliations | University appointments imply peer review and external accountability | Teaching section |
| Published research | Signals that the doctor's knowledge is externally validated | Research section |
| Professional memberships | Third-party organizations that have standards for membership | Memberships section |
| Media appearances | Signals that peers and journalists consider this doctor an authoritative voice | Media section |

### Tier 5 — Schema (invisible to patient, visible to search engines)

The enriched Physician schema node (see Section 7) signals to Google that this is a verified, credentialed physician — which affects how the site appears in health-related searches.

---

## 3. Information Architecture

### Section order — Inverted Pyramid

```
TRUST FIRST → CREDENTIALS SECOND → DEPTH THIRD → CONVERSION LAST
```

| # | Section | Content type | Patient question answered |
|---|---------|-------------|--------------------------|
| 1 | Hero | Photo + Name + Title + Positioning + CTA | "Who is this?" |
| 2 | Quick Facts Strip | Years exp · Specialty · Affiliation · Languages | "Is this person qualified at a glance?" |
| 3 | Biography | Personal story, origin, motivation | "Why did they choose this field?" |
| 4 | Philosophy of Care | Core belief statement + patient approach | "What will it be like to be their patient?" |
| 5 | Education & Training | Medical school → Residency → Fellowship(s) | "Where did they train?" |
| 6 | Clinical Experience | Current practice, scope, surgical volume context | "How experienced are they?" |
| 7 | Special Interests | Subspecialty focus areas, link to conditions/procedures | "Do they treat my specific condition?" |
| 8 | Research & Publications | Key publications, contributions *(omit if thin)* | "Is their knowledge peer-reviewed?" |
| 9 | Teaching & Academic | University roles, resident training | "Are they accountable to a peer community?" |
| 10 | Professional Memberships | National + international societies | "Are they recognized by their professional community?" |
| 11 | Media Appearances | Press, TV, online *(omit if thin)* | "Do others consider them an authority?" |
| 12 | CTA | Book a consultation | "How do I take the next step?" |

### Content dependency map

Sections 1–4 can be designed and built without content from Dr. Ungureanu (using placeholder structure).  
Sections 5–11 require specific content input from Dr. Ungureanu before they can be written.  
See **Section 9 — Content Requirements** for the full input list.

---

## 4. Wireframe

```
╔══════════════════════════════════════════════════════════════╗
║  SECTION 1: HERO                          bg: surface-warm   ║
║  ┌─────────────────┐  ┌───────────────────────────────────┐  ║
║  │                 │  │  Dr. George Ungureanu             │  ║
║  │   PHOTOGRAPH    │  │  ─────────────────────────────    │  ║
║  │   560 × 680px   │  │  Neurochirurg specialist          │  ║
║  │   (placeholder  │  │                                   │  ║
║  │   avatar until  │  │  [Tagline — 1 sentence describing │  ║
║  │   Q7a resolved) │  │  philosophy in patient language]  │  ║
║  │                 │  │                                   │  ║
║  │                 │  │  ● 15+ ani experiență             │  ║
║  │                 │  │  ● Coloana vertebrală & creier    │  ║
║  │                 │  │  ● [Spital / cabinet]             │  ║
║  │                 │  │                                   │  ║
║  │                 │  │  [ Programați o consultație  →  ] │  ║
║  └─────────────────┘  └───────────────────────────────────┘  ║
╚══════════════════════════════════════════════════════════════╝

╔══════════════════════════════════════════════════════════════╗
║  SECTION 2: QUICK FACTS STRIP             bg: surface        ║
║                                                              ║
║   ┌──────────────┐ ┌──────────────┐ ┌──────────────┐        ║
║   │  [X]+ ani    │ │  Coloana     │ │  [Spital /   │        ║
║   │  experiență  │ │  vertebrală  │ │  Cabinet]    │        ║
║   │  clinică     │ │  & creier    │ │              │        ║
║   └──────────────┘ └──────────────┘ └──────────────┘        ║
║                     (3 or 4 items depending on data)         ║
╚══════════════════════════════════════════════════════════════╝

╔══════════════════════════════════════════════════════════════╗
║  SECTION 3: BIOGRAPHY                     bg: surface-warm   ║
║                                                              ║
║   H2: Cine este Dr. George Ungureanu                         ║
║                                                              ║
║   [Paragraph 1: Origin story — why neurosurgery.            ║
║    Human, specific, not self-promotional. What drew          ║
║    this doctor to this specialty.]                           ║
║                                                              ║
║   [Paragraph 2: Training journey and what it shaped.         ║
║    Key formative experiences in plain language.]             ║
║                                                              ║
║   [Paragraph 3: Current practice and what it represents.     ║
║    What he does today and for whom.]                         ║
║                                                              ║
║   ┌─────────────────────────────────────────────────────┐   ║
║   │  " [Pull-quote — most memorable line from bio] "    │   ║
║   └─────────────────────────────────────────────────────┘   ║
╚══════════════════════════════════════════════════════════════╝

╔══════════════════════════════════════════════════════════════╗
║  SECTION 4: PHILOSOPHY OF CARE            bg: ink (dark)     ║
║                                           text: surface       ║
║                                                              ║
║   H2: Filosofia mea de practică                              ║
║                                                              ║
║   " [Core belief statement in first person —                 ║
║     how Dr. Ungureanu thinks about patient care.             ║
║     2–3 sentences. The emotional heart of the page.] "       ║
║                                                              ║
║   ───────────────────────────────────────────────────────   ║
║                                                              ║
║   H3: Abordarea pacientului                                  ║
║   [2 paragraphs: how the consultation works; how he          ║
║    communicates; how patients can expect to be treated.      ║
║    References plain language, unhurried explanations.]       ║
╚══════════════════════════════════════════════════════════════╝

╔══════════════════════════════════════════════════════════════╗
║  SECTION 5: EDUCATION & TRAINING          bg: surface        ║
║                                                              ║
║   H2: Educație și Formare                                    ║
║                                                              ║
║   TIMELINE FORMAT:                                           ║
║                                                              ║
║   [YEAR]  ──  Facultatea de Medicină [Instituție]            ║
║               Specializare / Titlu obținut                   ║
║                                                              ║
║   [YEAR]  ──  Rezidențiat Neurochirurgie                     ║
║               [Spital / Instituție], [Oraș]                  ║
║                                                              ║
║   [YEAR]  ──  Fellowship / Formare avansată *(if any)*       ║
║               [Instituție], [Țară]                           ║
║                                                              ║
║   [YEAR]  ──  Atestat / Titlu specialist / Certificare       ║
╚══════════════════════════════════════════════════════════════╝

╔══════════════════════════════════════════════════════════════╗
║  SECTION 6: CLINICAL EXPERIENCE           bg: surface-warm   ║
║                                                              ║
║   H2: Experiență Clinică                                     ║
║                                                              ║
║   [1–2 paragraphs: current practice context,                 ║
║    scope of surgical activity, types of cases.]              ║
║                                                              ║
║   ┌──────────────────────┐ ┌──────────────────────┐         ║
║   │ Neurochirurgie       │ │ Neurochirurgie        │         ║
║   │ spinală              │ │ craniană              │         ║
║   │ [brief descriptor]   │ │ [brief descriptor]    │         ║
║   └──────────────────────┘ └──────────────────────┘         ║
║   + additional subspecialty cards as relevant                ║
╚══════════════════════════════════════════════════════════════╝

╔══════════════════════════════════════════════════════════════╗
║  SECTION 7: SPECIAL INTERESTS             bg: surface        ║
║                                                              ║
║   H2: Domenii de interes special                             ║
║                                                              ║
║   [3–5 focus areas; each links to relevant                   ║
║    /afectiuni/ or /interventii/ page]                        ║
║                                                              ║
║   ┌────────────┐ ┌────────────┐ ┌────────────┐              ║
║   │ Chirurgia  │ │ Tumori     │ │ [Focus 3]  │              ║
║   │ minim inv. │ │ cerebrale  │ │            │              ║
║   │ a coloanei │ │            │ │            │              ║
║   │ vertebrale │ │            │ │            │              ║
║   └────────────┘ └────────────┘ └────────────┘              ║
╚══════════════════════════════════════════════════════════════╝

╔══════════════════════════════════════════════════════════════╗
║  SECTION 8: RESEARCH *(include only if substantive)*  surface-warm ║
║                                                              ║
║   H2: Cercetare și Publicații                                ║
║                                                              ║
║   • [Publication / contribution 1 — title, journal, year]   ║
║   • [Publication / contribution 2]                           ║
║   • [Conference presentation / keynote]                      ║
║                                                              ║
║   [If thin: merge with Section 9 under H2: Activitate       ║
║    academică — Cercetare & Didactică]                        ║
╚══════════════════════════════════════════════════════════════╝

╔══════════════════════════════════════════════════════════════╗
║  SECTION 9: TEACHING & ACADEMIC           bg: surface        ║
║                                                              ║
║   H2: Activitate Didactică                                   ║
║                                                              ║
║   [University affiliation(s)]                                ║
║   [Resident teaching roles]                                  ║
║   [Continuing medical education activities]                  ║
╚══════════════════════════════════════════════════════════════╝

╔══════════════════════════════════════════════════════════════╗
║  SECTION 10: MEMBERSHIPS                  bg: surface-warm   ║
║                                                              ║
║   H2: Afilieri Profesionale                                  ║
║                                                              ║
║   [Logo grid or styled list of professional societies]       ║
║                                                              ║
║   • Societatea Română de Neurochirurgie                      ║
║   • [European neurosurgical society if member]               ║
║   • [WFNS or other international body if member]             ║
║   • [Other relevant memberships]                             ║
╚══════════════════════════════════════════════════════════════╝

╔══════════════════════════════════════════════════════════════╗
║  SECTION 11: MEDIA *(include only if substantive)*  surface  ║
║                                                              ║
║   H2: Apariții în Media                                      ║
║                                                              ║
║   [Publication logo + article title + date]                  ║
║   [TV/Radio appearance + topic + date]                       ║
╚══════════════════════════════════════════════════════════════╝

╔══════════════════════════════════════════════════════════════╗
║  SECTION 12: CTA                          bg: ink (dark)     ║
║                                                              ║
║   Vorbiți cu Dr. George Ungureanu                            ║
║                                                              ║
║   [1–2 sentences — consultation invitation;                  ║
║    no outcome promises]                                      ║
║                                                              ║
║   [ Programați o consultație → ]                             ║
╚══════════════════════════════════════════════════════════════╝
```

---

## 5. Emotional Journey

The patient's emotional state at each section, and what design/content must do:

```
ARRIVAL
"Who is this doctor?"
State: Anxious, evaluating, time-limited. Will bounce in < 8 seconds if not engaged.
Design response: Photo + name + specific title fills the first viewport.
──────────────────────────────────────────────────────────────────────
SECTION 1 — HERO
"This person has a face and a specific title. They look like a doctor."
State: Mildly reassured. Scanning for next signal.
Design response: The positioning tagline creates curiosity ("I want to read that").
──────────────────────────────────────────────────────────────────────
SECTION 2 — FACTS STRIP
"OK, X years of experience. That's meaningful."
State: First rational validation. Not yet convinced but willing to keep reading.
Design response: Numbers must be real, not inflated. Patients sense vague claims.
──────────────────────────────────────────────────────────────────────
SECTION 3 — BIOGRAPHY
"This is a person, not a profile. They chose this specialty for a reason."
State: Emotional engagement begins. The patient is reading, not scanning.
Design response: First-person or close third-person voice. Specific memory or moment, not generic "passion for medicine."
──────────────────────────────────────────────────────────────────────
SECTION 4 — PHILOSOPHY OF CARE  ← Peak emotional moment
"This is exactly how I want my doctor to think."
State: Trust established at the emotional level. This section is the conversion engine.
Design response: Dark background, large type, pull-quote treatment. Unhurried. The most carefully written text on the site.
──────────────────────────────────────────────────────────────────────
SECTION 5–6 — EDUCATION & EXPERIENCE
"Good schools. Real experience. I can verify this."
State: Rational validation of the emotional trust built above. Relief, not excitement.
Design response: Timeline format. Specificity. Named institutions. No vague claims.
──────────────────────────────────────────────────────────────────────
SECTION 7 — SPECIAL INTERESTS
"They treat exactly what I have."
State: Personal relevance clicks. Internal links deepen engagement.
Design response: Cards link to /afectiuni/ and /interventii/ pages — keep the patient on the site.
──────────────────────────────────────────────────────────────────────
SECTIONS 8–11 — RESEARCH, TEACHING, MEMBERSHIPS, MEDIA
"This doctor is accountable to a professional community beyond their own website."
State: Final validation for the thorough researcher. Comfort, not excitement.
Design response: Clean, credible, not promotional. These sections confirm; they don't persuade.
──────────────────────────────────────────────────────────────────────
SECTION 12 — CTA
"I know enough. I'm ready."
State: Decision made. The CTA is the release valve, not the persuasion.
Design response: Warm, direct invitation. Not urgent. Not discounted. Just a clear next step.
```

---

## 6. SEO Strategy

### Target queries

| Query type | Example | Priority |
|------------|---------|---------|
| Branded — exact name | "Dr. George Ungureanu" | Primary |
| Branded — name + specialty | "Dr. George Ungureanu neurochirurg" | Primary |
| Branded — name + location | "Dr. George Ungureanu [city]" *(Q13 blocker)* | Primary (blocked) |
| Local specialty | "neurochirurg [city]" *(Q13 blocker)* | Secondary (blocked) |
| Specialty + condition | "neurochirurg hernie disc [city]" | Tertiary |
| Trust-evaluation | "opinii Dr. George Ungureanu" | Informational |

### On-page SEO

**`<title>`:** `Dr. George Ungureanu — Neurochirurg specialist | georgeungureanu.doctor`  
**Meta description (155 chars):** `Dr. George Ungureanu este neurochirurg specialist cu experiență în chirurgia minim invazivă a coloanei vertebrale și neurochirurgia craniană. Consultații în [CITY].`

**H1:** `Dr. George Ungureanu` (name is the primary keyword)  
**H2s:** Section headings optimized for secondary queries where natural  
**Internal links from this page:** Link to `/afectiuni/`, `/interventii/`, `/programari/`, individual condition and procedure pages from Special Interests section

### The schema anchor requirement

The `#physician` anchor in the URL (`/despre/#physician`) is referenced by the schema in every article. This anchor must resolve to a real element — the `id="physician"` attribute must be set on the hero section's container div in Elementor (via Advanced → CSS ID field). This is a technical implementation requirement, not just design.

---

## 7. Physician Schema Opportunities

Current implementation (Sprint 7B) emits this node from every `articole` single page:

```json
{
  "@type": "Physician",
  "@id": "https://georgeungureanu.doctor/despre/#physician",
  "name": "Dr. George Ungureanu",
  "jobTitle": "Neurochirurg",
  "url": "https://georgeungureanu.doctor/despre/",
  "worksFor": {
    "@type": "MedicalOrganization",
    "name": "Cabinet Neurochirurgie Dr. George Ungureanu",
    "url": "https://georgeungureanu.doctor/"
  }
}
```

### Fields to add in Phase 2

| Schema field | Content needed | Blocker |
|-------------|---------------|---------|
| `alumniOf` | Medical school name + university | Q — needs from Dr. Ungureanu |
| `hasCredential` | Medical license, specialist title | Q — needs from Dr. Ungureanu |
| `memberOf` | Professional society names | Q — needs from Dr. Ungureanu |
| `knowsAbout` | Array of specialties ("Neurosurgery", "Spine Surgery", etc.) | Derive from Special Interests |
| `knowsLanguage` | Languages spoken | Needs confirmation |
| `image` | Doctor photo URL | Q7a blocker |
| `address` | Practice address | Q13 blocker |
| `telephone` | Practice phone | Q13 blocker |
| `sameAs` | Links to LinkedIn, Google Business, medical society profile | Q — needs from Dr. Ungureanu |

### Implementation approach

The enriched Physician node should be emitted from the `/despre/` page itself (not only from article pages). The plugin should be extended (Section 10 or updated Section 9) to:
1. Emit the full Physician node when `is_page('despre')` returns true
2. Update the article pages to reference the same `@id` (already done) without re-emitting the full Physician node (to avoid redundancy)

### New schema types for /despre/

Consider adding a `MedicalOrganization` node for the practice itself, referenced from the Physician's `worksFor` field:

```json
{
  "@type": "MedicalOrganization",
  "@id": "https://georgeungureanu.doctor/#practice",
  "name": "Cabinet Neurochirurgie Dr. George Ungureanu",
  "url": "https://georgeungureanu.doctor/",
  "medicalSpecialty": "Neurological Surgery",
  "address": { ... }  // Q13 blocker
}
```

---

## 8. Reusable Components

### New components this page would introduce

| Component | CSS class | Reusable where |
|-----------|-----------|----------------|
| Quick facts strip | `.gu-credentials-strip` | Homepage (Sprint 9+), /despre/ |
| Timeline entry | `.gu-timeline-entry` | Education, experience — potentially future milestones pages |
| Pull-quote (dark bg) | `.gu-philosophy-quote` | Homepage patient promise section |
| Special interest card | `.gu-interest-card` | Crosslinks to /afectiuni/ and /interventii/ — similar to existing `.gu-related-card` |
| Membership item | `.gu-membership-item` | Standalone section or footer upgrade |
| Media mention item | `.gu-media-mention` | Standalone section |

### Existing components this page can reuse

| Component | Template / class | Notes |
|-----------|-----------------|-------|
| CTA Final strip | Elementor template ID=75 | Already built; use as Section 12 |
| `.gu-related-card` | Sprint 7B | Special interest cards could extend this |
| Author block layout | `.gu-author-block` | Hero photo + credentials layout is conceptually similar |

### ACF field group for /despre/ (proposed: `group_about`)

Rather than hardcoding biography and credentials in Elementor widgets, a dedicated ACF group would allow Dr. Ungureanu to update content without touching Elementor:

| Field key | Label | Type |
|-----------|-------|------|
| `about_photo` | Fotografie profesională | image |
| `about_tagline` | Tagline / Motto | text |
| `about_bio` | Biografie | wysiwyg |
| `about_philosophy` | Filosofia de practică | wysiwyg |
| `about_years_experience` | Ani de experiență | number |
| `about_hospital` | Afiliere spital / cabinet | text |
| `about_languages` | Limbi vorbite | text |
| `about_education` | Educație (repeater) | repeater *(ACF Pro)* or 5× text pairs |
| `about_memberships` | Afilieri profesionale | textarea |
| `about_media` | Apariții media | wysiwyg |
| `about_seo_title` | SEO Title | text |
| `about_seo_description` | SEO Description | textarea |

**Note:** Repeater field for education requires ACF Pro. Without Pro, use 4× fixed text pairs (institution, year, degree) — sufficient for most physicians.

---

## 9. Risks

### Critical risks (blocks launch)

| Risk | Impact | Mitigation |
|------|--------|-----------|
| **Q7a — No professional photography** | The page cannot launch effectively without a photo. A placeholder avatar in the hero is functional but significantly reduces trust conversion. The photo is the #1 trust signal on a physician about page. | Design a graceful placeholder (SVG avatar, neutral tone) that allows the page to be built and published; swap for real photo when available. Prioritize photography before staging. |
| **`#physician` anchor not set** | The Physician schema node on 100+ future article pages would reference a broken anchor, which Google may penalize or ignore. | Set `id="physician"` as a CSS ID on the hero section container in Elementor Advanced settings during implementation. Verify with `curl [url] | grep 'id="physician"'`. |

### Significant risks

| Risk | Impact | Mitigation |
|------|--------|-----------|
| **Q13 — No location data** | Local SEO potential is unrealized; `address` in schema cannot be populated; location-based patient queries won't match. | Build the schema with a `TODO: address` placeholder in plugin; populate when Q13 is resolved. |
| **Content completeness** | Sections 5–11 require specific, accurate input from Dr. Ungureanu. Without this, the page risks being launched with vague or placeholder content that erodes rather than builds trust. | Create a Content Input Form (see Section 9) before implementation begins. Do not build the Elementor template until this input is received. |
| **Promotional tone drift** | About pages are high-risk for accidentally slipping into marketing language ("world-class," "best," "dedicated to excellence"). The tone guide must be applied rigorously here, where the subject is the doctor himself. | Apply the same prohibited-claims rules from EDITORIAL_POLICY.md §4. Dr. Ungureanu should review the biography and philosophy sections for unintended promotional tone. |
| **Thin sections undermining credibility** | If the research or media sections are sparse, they create an "empty shelf" effect — worse than no section at all. | Make Sections 8 and 11 conditional: include only if there is substantive content. Default to omitting them and adding later. |

### Low risks

| Risk | Impact | Mitigation |
|------|--------|-----------|
| CV vs. human balance | The page could read as a LinkedIn profile dump: a list of accomplishments with no human texture. | The biography and philosophy sections must come before credentials. Structure enforces this. |
| Q24 — colleague recommendations | Peer quotes could add a powerful trust layer but are listed as a blocker. | Design a space for this (testimonial/quote section) but make it optional. Launch without it. |
| Schema duplication | The Physician node is currently emitted on article pages. Adding a second emission from /despre/ could cause duplicate schema. | Modify plugin logic: emit full Physician node ONLY from /despre/; emit `@id` reference only from article pages. |

---

## 10. Implementation Estimate

### Phase 2 prerequisites (before any code is written)

| Item | Owner | Estimated time |
|------|-------|---------------|
| Professional photography session | Dr. Ungureanu / photographer | External — schedule ASAP |
| Content Input Form completed by Dr. Ungureanu | Dr. Ungureanu | 2–3 hours of focused time |
| Location data confirmed (Q13) | Dr. Ungureanu | 15 minutes |
| Philosophy of care text drafted and approved | Dr. Ungureanu + content editor | 1–2 hours |

### Phase 2 implementation tasks

| Task | Estimate | Dependencies |
|------|----------|-------------|
| WordPress page created at `/despre/` | 15 min | None |
| ACF field group `group_about` + fields | 1 hr | None |
| Elementor page build (12 sections) | 4–5 hr | Content Input Form |
| CSS new components (6 classes) | 2 hr | Design tokens (already defined) |
| Hero section: set `id="physician"` anchor | 5 min | Elementor template built |
| Plugin: enrich Physician schema on /despre/ | 1.5 hr | None |
| Plugin: refactor to emit full node only from /despre/ | 1 hr | Above |
| Playwright QA (Desktop/Tablet/Mobile) | 1 hr | All above |
| ACF JSON export + sprint report | 30 min | All above |
| **Total Phase 2** | **~12 hrs** | Photography + Content Input Form |

### Sprint classification

Sprint 8 is approximately **1.5× the complexity of Sprint 6** (Programări) due to the richer content architecture, schema refactoring, and the number of new CSS components. It is simpler than Sprint 7A (which required CPT infrastructure).

**Recommended: Split into two sessions if content input is incomplete at implementation start.** Build the template skeleton and schema in Session 1; populate content in Session 2 once Dr. Ungureanu's input is received.

---

## Appendix A — Content Input Form

*To be completed by Dr. George Ungureanu before Phase 2 begins.*

```
BIOGRAFIE SCURTĂ
Q1. De ce ați ales neurochirurgia? (2–5 propoziții, în propriile cuvinte)

Q2. Care a fost cel mai formativ moment din formarea dumneavoastră chirurgicală?
    (Opțional — poate fi anonim sau generic dacă este prea personal)

Q3. Cum ați descrie abordarea dumneavoastră față de pacient într-o propoziție?

FILOSOFIA DE PRACTICĂ
Q4. Ce credeți că diferențiază o relație bună medic–pacient?

Q5. Cum explicați un diagnostic dificil unui pacient?

EDUCAȚIE & FORMARE
Q6. Facultatea de Medicină: instituție, orașului, ani (ex: 2000–2006)
Q7. Rezidențiat: instituție, specializare, ani
Q8. Fellowship / formare avansată în altă țară? (dacă da: instituție, țară, ani)
Q9. Titlul de specialist obținut: data, instituția emitentă

EXPERIENȚĂ CLINICĂ
Q10. Ani de experiență neurochirurgicală:
Q11. Afilierea actuală (spital / cabinet): numele instituției
Q12. Tipuri de cazuri operate frecvent: (ex: hernii disc, tumori cerebrale, ...)

DOMENII DE INTERES SPECIAL
Q13. 3–5 arii de focus în cadrul neurochirurgiei:

CERCETARE & PUBLICAȚII
Q14. Publicații relevante (titlu, revistă, an) — dacă există:
Q15. Prezentări la conferințe semnificative:

ACTIVITATE DIDACTICĂ
Q16. Funcție didactică universitară (dacă există): titlu, universitate
Q17. Implicare în formarea rezidenților:

AFILIERI PROFESIONALE
Q18. Societăți profesionale din care faceți parte:

APARIȚII MEDIA
Q19. Aparații TV, radio, presă scrisă sau online (publicație, subiect, an):

DATE PRACTICE
Q20. Limbile în care consultați:
Q21. Adresa cabinetului / spitalului (Q13 blocker):
Q22. Număr de telefon contact:
Q23. Link profil LinkedIn sau alt profil profesional public (pentru schema sameAs):
```

---

## Appendix B — Decisions Requiring Approval

Before implementation begins, the following decisions should be confirmed:

| Decision | Options | Recommendation |
|----------|---------|---------------|
| D1: ACF group for /despre/ | (a) New `group_about` ACF group — content editable without Elementor; (b) Hardcode in Elementor widgets — simpler to build | **Recommend (a)** — Dr. Ungureanu should be able to update his bio without developer access |
| D2: Photo placeholder | (a) SVG avatar (current author-block style); (b) Warm abstract/pattern placeholder; (c) Launch after photography is ready | **Recommend (a)** — allows the page to go live and fixes the broken schema anchor; swap when photo is ready |
| D3: Research/Media sections | (a) Include if content provided; (b) Omit entirely; (c) Build with placeholder "arriving soon" treatment | **Recommend (a)** — conditional on Dr. Ungureanu completing Q14–Q19 in Content Input Form |
| D4: Education format | (a) Visual timeline (more visual weight, harder to maintain); (b) Styled list (simpler, equally readable); (c) ACF repeater (Pro only) | **Recommend (b)** until ACF Pro is available, then migrate to (c) |
| D5: Physician schema location | (a) Emit from /despre/ only — article pages reference `@id` only; (b) Keep emitting from article pages + add /despre/ | **Recommend (a)** — cleaner, one authoritative source |
