# Homepage

## georgeungureanu.doctor

**Purpose of this document:** Freeze the complete Homepage experience before implementation. Every section, its order, its purpose, and its content requirements are locked here. Implementation follows this specification. Changes after build begins require a documented revision with stated rationale.

**This document supersedes** the homepage section in `docs/tasks/02_CONTENT_MODELS.md` (§1.1) for all implementation purposes. The content models document defined a skeleton; this document defines the full, final homepage.

**Source of truth:**
- `docs/tasks/00_PROJECT_ROADMAP.md` v1.1
- `docs/tasks/01_INFORMATION_ARCHITECTURE.md` v1.0
- `docs/tasks/02_CONTENT_MODELS.md` v1.0
- `docs/tasks/03_HEADER_AND_NAVIGATION.md` v1.0
- `docs/tasks/04_DESIGN_SYSTEM_TOKENS.md` v1.0
- `docs/project/PATIENT_CENTERED_MANIFESTO.md`
- `docs/project/WEBSITE_GOALS.md`
- `docs/project/TARGET_AUDIENCE.md`
- `docs/design-system/APPROVED_VISUAL_DIRECTION.md`

**Governing principle:** Every section of the homepage is evaluated against one question first — *Does this help a patient feel informed, reassured, understood, and guided?* If the answer is no, the section content is wrong, not the question.

---

# 1. Homepage Purpose

## 1.1 The Patient Who Arrives Here

The homepage is not visited equally by all personas. It is the primary landing surface for the most vulnerable visitor: the Night-Search Patient — a person who has recently received a concerning diagnosis or referral, is researching after hours, is in an elevated state of anxiety, and is trying to determine whether this doctor and this practice is the right answer to their specific situation.

Everything on this page — every section, every label, every image, every amount of whitespace — is evaluated through this patient's emotional state, not through a content checklist.

## 1.2 Emotional Goals

**Primary emotional goal:** A frightened patient arrives and, within 8 seconds, before reading a word of body text, feels — *not thinks* — that this is a calm, considered, and human place where they will be understood.

**Secondary emotional goals:**
- Relief from the specific fear of not knowing what to do next — the homepage provides a clear path
- Reduced anxiety about geographic access — the page signals that this doctor may be reachable
- The beginning of trust — not full trust (that builds over multiple pages and sections), but the beginning of willingness to continue reading
- A sense of being seen — not as a condition or a case, but as a person

**The page fails emotionally if** a patient feels impressed but confused — or if they feel the page was built to display the doctor's credentials rather than to serve the patient's needs.

## 1.3 Business Goals

**Appointment pathway initiation:** The homepage must create at least one compelling reason for a patient to move deeper into the site — toward /afectiuni, /sfatul-neurochirurgului, /recomandari, or /programari. A visitor who leaves the homepage without clicking anywhere has not been served.

**Geographic barrier removal:** Romanian medical websites routinely fail because patients in Baia Mare assume a Cluj-based doctor is inaccessible to them, and vice versa. The homepage must signal both cities clearly enough that a patient from either location feels included before navigating anywhere.

**Appointment conversion foundation:** The homepage does not close appointments — /programari does. The homepage's business job is to create the trust and direction needed for a patient to voluntarily navigate to /programari. The CTA is present and persistent; it is never the primary emotional message.

## 1.4 Educational Goals

**Position Sfatul Neurochirurgului as a brand from the first visit:** A patient who learns on the homepage that Dr. Ungureanu has built an educational platform for patients comes to the site with a different expectation than a patient who only sees "a neurosurgeon's website." The educational commitment is introduced here, at the top level, not buried in a navigation item.

**Surface conditions without overwhelming:** Six condition cards give the patient a sense of scope without requiring them to read an index. If their condition appears, they feel seen. If it does not appear, the "Toate afecțiunile" link invites them to continue looking.

## 1.5 Trust-Building Goals

**Layer trust progressively across the page:** Trust is not established by a credentials section. It is established by the cumulative experience of a page that makes sense, treats the patient as intelligent, provides social proof from different types of people (professional colleagues, other patients), and ends with a clear invitation rather than a demand.

**The trust sequence on this page:**
1. Doctor is visually present and calm (Hero)
2. Doctor speaks in his own voice about his commitment to patients (Personal Message)
3. Doctor has deep knowledge of the relevant conditions (Afecțiuni preview)
4. Doctor has built a sustained educational platform (SN preview)
5. Medical peers endorse Dr. Ungureanu specifically (Colleague recommendations)
6. Real patients describe their experience in their own words (Patient testimonials)
7. Doctor is geographically accessible (Unde mă găsiți)
8. Doctor is a person with a story, not just a title (About preview)
9. The action is clear, calm, and available (Final CTA)

## 1.6 The 8-Second Experience

Within 8 seconds of arriving on the homepage — before reading any body text — a patient should be able to:

1. Identify that this is a neurosurgeon's personal practice website (not a clinic directory, not an aggregator)
2. See the doctor as a person (genuine photography, not a title and a logo)
3. Understand that appointments can be made (CTA visible in the header, at minimum)
4. Feel that this environment is calm and considered — not clinical and corporate

**What creates this within 8 seconds:**
- The warm cream surface (`color-surface`, `#FDFBF7`) visible before any content loads
- Genuine photography of Dr. Ungureanu — present, not posed
- A headline that speaks to the patient's situation (not the doctor's credentials)
- The absence of visual noise (no banners, no popups, no moving elements, no competing CTAs)

**What would destroy it:**
- A modal appearing immediately
- A cookie banner blocking the hero content before the patient has had 8 seconds
- A headline that leads with the doctor's titles rather than the patient's situation
- A hero background image that reads as a stock photograph

---

# 2. Homepage Information Hierarchy

## 2.1 The Final Section Order

This order is frozen. It does not change in Phase 1. Phase 2 additions may extend the page but do not rearrange what is here.

| Position | Section | Organism | Background |
|----------|---------|----------|-----------|
| — | Header + navigation | `organism-site-header` | `color-surface` |
| 1 | Hero | `organism-hero-homepage` | `color-ink` (dark, photography) |
| 2 | Personal message | `organism-philosophy-statement` (variant) | `color-surface` |
| 3 | Afecțiuni frecvente | `organism-conditions-grid` | `color-surface-warm` |
| 4 | Sfatul Neurochirurgului | `organism-article-grid` (SN variant) | `color-surface` |
| 5 | Recomandări din partea colegilor medici | `organism-colleague-recs` | `color-surface-warm` |
| 6 | Experiențele pacienților | `organism-patient-testimonials` | `color-surface` |
| 7 | Unde mă găsiți | `organism-location-preview` | `color-accent-subtle` |
| 8 | Despre Dr. George Ungureanu | `organism-doctor-intro` | `color-surface-warm` |
| 9 | CTA final | `organism-cta-banner` | `color-ink` (dark) |
| — | Footer | `organism-site-footer` | `color-ink` |

Section 4 (SN preview), Section 5 (Colleague recommendations), and Section 6 (Patient testimonials) are built during Phase 7 / Phase 6 respectively but may be hidden at launch based on content availability. See individual section specifications for visibility conditions.

## 2.2 Why This Order Exists

**Hero first:** The patient arrives afraid. The first thing they see must ground them emotionally — a calm, authoritative space with a real person. Nothing else earns the right to precede this.

**Personal message second:** After visual grounding comes the doctor's voice. This is the first moment the patient hears Dr. Ungureanu speak — about why he created Sfatul Neurochirurgului, what it means for patients to have access to educational content from their own neurosurgeon. Placed second, it follows the visual establishment of trust with a human statement of commitment. It also immediately frames the educational ecosystem that the rest of the page will demonstrate.

**Afecțiuni third:** The patient arrived because they have a condition or a diagnosis. The third section speaks directly to that need — "do you treat what I have?" Placed early, before any social proof or biography, it honors the patient's most immediate question.

**Sfatul Neurochirurgului fourth:** For the patient who did not find their exact condition, or who wants to understand more before deciding, the educational content preview signals: "there is more here for you." It also demonstrates Dr. Ungureanu's commitment to patient education in action — not just stated, but visible.

**Colleague recommendations fifth:** Social proof from professional peers. Placed after education (the doctor has demonstrated knowledge) but before patient testimonials (professional credibility precedes peer-patient experience). A patient who has seen the doctor's educational commitment and professional endorsements reads the patient testimonials from a position of growing trust.

**Patient testimonials sixth:** Real patients, in their own words. Placed after professional endorsements, not before — the professional trust creates the context within which patient experiences land more powerfully. Placed here rather than at the top, where they would lead with social pressure before the patient has context.

**Unde mă găsiți seventh:** Geographic accessibility. This critical practical question is answered after the patient has engaged emotionally and begun to trust. A patient who asks "but can I actually see this doctor?" needs this answer before they are asked to act. Placed seventh, it resolves the practical concern immediately before the about section and the final CTA.

**About preview eighth:** Who is this person? By the time a patient reaches Section 8, they have seen the doctor's face, heard his voice, encountered his knowledge, read what colleagues and other patients say, and confirmed geographic access. The About preview is no longer a stranger's CV — it is the humanizing detail that completes a picture the patient is already forming.

**Final CTA ninth:** The invitation to act comes after the complete journey. A patient who has been through all eight sections has either decided to act or has not. The CTA section does not persuade — it provides the clear, calm next step for those who are ready.

---

# 3. Hero Section

**Organism:** `organism-hero-homepage`
**Background:** `color-ink` (`#231E1A`) with warm photography overlay (`color-overlay`)
**Position:** Section 1 — always visible, no conditions

## 3.1 Purpose

The hero section has three simultaneous jobs, delivered in order of patient experience:

1. **Reassurance** — The environment (warm, calm, considered) lowers anxiety before content is read
2. **Authority** — The presence of the doctor as a genuine person, in a genuine environment, establishes that this is a real practice
3. **Direction** — A clear, visible CTA tells the patient exactly what to do when they are ready

## 3.2 Emotional Intent

The hero must not try to impress. It must try to calm.

A patient scrolling to this page has already spent hours on other websites — medical directories with cold blue palettes, hospital pages with stock photography of handshakes, clinical white pages that feel like a waiting room. The hero's emotional job is to feel different at a visceral level — before a word is read.

Warmth comes first. Then authority. Then direction. In that order. Never reversed.

## 3.3 Required Elements

| Element | Specification | Content Rule |
|---------|--------------|-------------|
| Background photography | Full-bleed, doctor photographed in genuine consultation or work environment | Original photography only (Q7 blocking). Warm light. Doctor is the primary subject. No white-coat-as-subject. |
| Dark warm overlay | `color-overlay` (`#231E1ACC`) over photography | Maintains readability while allowing photography warmth to register |
| Headline | `type-h1` (Lora 52px / 700 / `color-surface`) | One sentence. Speaks to the patient's situation or need — not the doctor's title. Does not open with "Dr." or credentials. Maximum 8–10 words. (Final copy from Dr. Ungureanu.) |
| Supporting text | `type-body-lg` (Inter 19px / `color-surface` at 85% opacity) | 1–2 sentences. Extends the headline. Warm, direct. Does not list specializations or credentials. Maximum 25 words. (Final copy from Dr. Ungureanu.) |
| Primary CTA | `atom-button-primary` → /programari | Label: "Programează o consultație" — exact, always |
| Secondary CTA | `atom-button-secondary` → /afectiuni | Label: "Aflați despre afecțiunile tratate" or equivalent. Lower commitment path for patients not yet ready to book. |
| Doctor name attribution | `type-body-sm` (`color-surface` at 70% opacity) | "Dr. George Ungureanu — Medic Primar Neurochirurgie" — sets the specialty context without leading with credentials |

## 3.4 What the Hero Does Not Contain

| Forbidden Element | Reason |
|------------------|--------|
| Statistics or numeric claims | Cannot be verified at build time; erodes trust if inaccurate; conflicts with emotional register |
| Animated counters | Anti-pattern (COMPONENT_INVENTORY.md); startup-prestige signal; incompatible with calm register |
| Marketing language | "World-class," "leading," "best" — undermines the authenticity that is the entire foundation of this direction |
| Stock photography | A stock photograph of "a doctor" is felt before it is articulated. The entire trust architecture collapses if the hero is inauthenticity personified. |
| Multiple competing CTAs | One primary, one secondary. Not three buttons. The patient should not have to choose. |
| Logo or practice tagline | The doctor's name in the attribution line suffices. No taglines. |
| Rotating text or slide animations | Motion competes with the emotional first impression |
| Breadcrumbs | The homepage has no parent — no breadcrumb |

## 3.5 Photography Direction for Hero

The ideal hero photograph shows Dr. Ungureanu in genuine engagement — not posed for a camera, but observed. A photograph of the doctor listening intently, or mid-explanation to a patient (partially visible), or reviewing a scan in genuine concentration — these are all preferable to a direct-to-camera professional portrait.

The direct-to-camera portrait has a role (homepage About section, /despre) but the hero photograph should feel caught, not constructed.

Warm light. Real environment. Doctor as the clear visual primary. Everything else recedes.

## 3.6 Blocking Dependencies

| Dependency | Source | Status |
|-----------|--------|--------|
| Hero photography (full-bleed) | Q7 — Dr. Ungureanu | BLOCKING |
| Headline copy | Dr. Ungureanu | BLOCKING |
| Supporting text copy | Dr. Ungureanu | BLOCKING |
| /programari live | Phase 4 | BLOCKING (primary CTA destination must exist) |

---

# 4. Personal Message Section

**Organism:** `organism-philosophy-statement` (homepage variant)
**Background:** `color-surface` (`#FDFBF7`)
**Position:** Section 2 — always visible once content is provided
**Visibility condition:** Built with placeholder content; published once Dr. Ungureanu provides the text

## 4.1 Purpose

This section answers a question the patient will form implicitly after the hero: *"But why should I trust that this doctor cares about me specifically?"*

The hero establishes presence. The personal message establishes voice. Before the patient has seen the doctor's conditions, his educational content, or his endorsements, they hear him speak — not about himself, but about his commitment to patients.

Specifically, this section explains why Sfatul Neurochirurgului exists: a neurosurgeon who chose to build an educational platform for patients, at scale, through social media and written content, because he believes patients deserve to understand their conditions before walking into a consultation. This is not a tagline. It is a statement of professional identity that distinguishes this practice from the category.

## 4.2 Emotional Role

A patient reading this section should feel: *"This doctor thought about me before I even arrived."*

The personal message is not an about-me statement. It is not a biography teaser. It is the doctor stating, in his own words, his answer to the question "Why does this educational platform exist?" — and the answer is: for you, the patient, so that you come to your first consultation already informed, already understanding the vocabulary, already less afraid.

This reframes the entire site: the patient has not found a doctor's website. They have found a resource that a doctor built for them.

## 4.3 Layout

| Element | Token | Notes |
|---------|-------|-------|
| Section label | `atom-overline` (`color-accent`) | Short identifier — "Sfatul Neurochirurgului" or "Despre această platformă" |
| Heading | `type-h2` (Lora 38px / 700 / `color-ink`) | A patient-facing framing of why this platform exists. Not "Welcome to my website." One sentence, calm and direct. (Final copy from Dr. Ungureanu.) |
| Body text | `type-body-lg` then `type-body` | 2–3 paragraphs in Dr. Ungureanu's first-person voice. Explains why he created Sfatul Neurochirurgului. What he observed that motivated him. What he hopes patients receive from it. Maximum 150 words. Plain Romanian. |
| Doctor portrait | `atom-avatar` or `atom-image` | Approachable portrait (not the hero photograph). Warm, smaller than the hero. Places a face alongside the personal voice. |
| Link | `atom-button-ghost` → /sfatul-neurochirurgului | "Explorați Sfatul Neurochirurgului →" — tertiary action, not a CTA |

Layout: two-column on desktop (portrait left, text right, or centered text with portrait above), single column on mobile.

## 4.4 Relationship to Social Media Channels

Sfatul Neurochirurgului exists across multiple surfaces — this website, Instagram, Facebook, and YouTube. The personal message implicitly acknowledges this: the doctor's commitment to patient education is a channel-agnostic commitment. Patients who have found Dr. Ungureanu through social media recognize the same voice and the same educational philosophy here. Patients who have not previously encountered the social channels learn that there is more available to them.

The personal message section does not embed social media feeds, does not display follower counts, and does not contain social media icons. It speaks about the commitment; the social links in the footer allow patients to explore further if they choose.

## 4.5 Phase 2: Video Possibility

In Phase 2, this section may incorporate a YouTube video — Dr. Ungureanu introducing himself and explaining Sfatul Neurochirurgului in his own voice, directly to the camera. This video would be embedded as a lazy-loaded YouTube oEmbed (no autoplay, no live social widget) and would replace or accompany the portrait.

**Phase 2 video conditions:**
- A suitable video must exist on the YouTube channel (confirmed Q18)
- The video must be produced specifically for this context — a patient introduction, not a repurposed clinical lecture
- The lazy-loaded embed must not affect Core Web Vitals (LCP, CLS)

In Phase 1: no video. Portrait + text only.

## 4.6 Required Content from Dr. Ungureanu

| Content | Format | Notes |
|---------|--------|-------|
| Personal statement about why SN was created | 2–3 paragraphs, first person | Not a press-release tone. Conversational, warm, honest. |
| Approachable portrait photograph | Square or near-square, minimum 600×600px | Different from the hero photograph — this one is warmer, more direct |

---

# 5. Afecțiuni Frecvente

**Organism:** `organism-conditions-grid`
**Background:** `color-surface-warm` (`#F4EFE6`)
**Position:** Section 3 — always visible once ≥6 Condition CPT entries are active

## 5.1 Purpose

This section addresses the most immediate clinical question a patient has: *"Does this doctor treat my condition?"*

It does not need to answer this question for every possible condition — it needs to answer it for the most commonly encountered conditions or the conditions most likely to be represented in the incoming patient population. The six cards are a representative sample, not an index.

A patient who sees their condition named here feels immediately: "I am in the right place." A patient who does not see their condition has the "Vedeți toate afecțiunile" link as the immediate next step.

## 5.2 Card Count and Selection

**Exactly 6 condition cards.** Not 4. Not 8. Not "as many as exist." Six cards at this stage:
- Create a visual grid (3×2 on desktop, 2×3 on tablet, 1×6 on mobile) that reads as comprehensive without being overwhelming
- Represent the breadth of the practice without requiring every condition to be listed
- Load in a predictable, non-scrolling layout on all viewports above 768px

**Selection criteria for the 6 cards** (determined by Dr. Ungureanu):
- The conditions most frequently presenting in the patient population
- The conditions for which patients are most likely to be searching online at the time of concern
- A representation of both spinal and cranial subspecialties if applicable
- Conditions for which clear, patient-accessible content can be written

The 6 selected conditions are set by Dr. Ungureanu and stored in the `display_order` field of the Condition CPT (lower numbers = appear in the grid). The selection is not algorithmic — it is a clinical and patient-experience editorial decision.

## 5.3 Card Content and Structure

Each card uses `molecule-card-condition`:

| Element | Token | Source |
|---------|-------|--------|
| Icon | `atom-icon-box`, 48×48px, `color-accent-subtle` background + `color-accent` icon | One relevant, clear icon per condition. Not a medical symbol. An anatomically evocative but non-clinical icon. |
| Condition name | `type-h4` (Inter 20px / 600) | `patient_title` field — plain Romanian (e.g., "Hernie de disc", not "Hernia nuclei pulposi") |
| Short description | `type-body-sm` (Inter 15px / 400) | `card_description` — 1 sentence, maximum 120 characters, written from the patient's perspective |
| Link | `atom-button-ghost` → /afectiuni/[slug] | "Aflați mai multe" — always the same label for all 6 cards |

No symptoms, no treatment information, no medical detail on the card. The card's job is to confirm: "this condition is here." The condition page's job is to explain it.

## 5.4 Grid Behavior

| Viewport | Layout | Notes |
|----------|--------|-------|
| Desktop (≥1025px) | 3 columns × 2 rows | All 6 cards visible without scroll |
| Tablet (768–1024px) | 2 columns × 3 rows | All 6 cards visible |
| Mobile (<768px) | 1 column × 6 rows | Cards stack vertically; full-width; each card is easily tappable |

**No carousels.** All 6 cards are rendered in the DOM and visible on the page — not hidden behind a navigation mechanism. A patient on mobile scrolls through all 6 cards in a single, uninterrupted scroll motion.

## 5.5 Section Footer

Below the 6-card grid, the section ends with:
- A text invitation: "Nu vedeți afecțiunea dvs.? Consultați lista completă." — the second sentence is a link → /afectiuni
- This line is always present. It acknowledges that the 6 cards are a selection, not the complete picture.

## 5.6 Blocking Dependencies

| Dependency | Source | Status |
|-----------|--------|--------|
| ≥6 active Condition CPT entries with patient_title, card_description, slug, icon | Q4 — Dr. Ungureanu | BLOCKING |
| Dr. Ungureanu confirms the 6 selected conditions and display_order | Dr. Ungureanu | BLOCKING |

---

# 6. Sfatul Neurochirurgului Preview

**Organism:** `organism-article-grid` (SN homepage variant)
**Background:** `color-surface` (`#FDFBF7`)
**Position:** Section 4
**Visibility condition:** Hidden until ≥3 published SN Article entries exist. Built during Phase 7. Hidden at launch if content count is insufficient; section becomes visible once the threshold is met without requiring a new deployment.

## 6.1 This Is Not a Blog Preview

This section introduces an educational ecosystem, not a content stream. The distinction matters for how the section is framed and what it selects to display.

**A blog preview says:** "Here are my latest posts." It is a chronological stream of self-expression.

**An SN preview says:** "Here is a selection from the educational platform Dr. Ungureanu has built for patients like you." It is a curated introduction to a sustained commitment.

The section header establishes this distinction explicitly — through the section label ("Sfatul Neurochirurgului"), the heading (which names a patient benefit, not a content category), and the introductory text (which frames the platform in patient terms).

## 6.2 Content Selection

**3 entries displayed on the homepage** — not more, not fewer:
- 3 entries fit the visual grid on desktop without compression
- 3 entries represent enough variety to signal the breadth of the platform
- 3 entries do not overwhelm — they invite

**Selection logic (not algorithmic — editorial):**
- The 3 entries are selected by Dr. Ungureanu or the administrator as the most relevant to the arriving patient population
- They do not have to be the 3 most recent entries (though they may be)
- Recommended variety: at least one article-type entry, and — when video content exists — at least one video-type entry
- All 3 must be published SN Articles (approval_status = Published)

## 6.3 Card Content and Structure

Each card uses `molecule-card-article`:

| Element | Token | Source |
|---------|-------|--------|
| Featured image | 3:2 or 16:9 ratio, WebP | `featured_image` field — warm, non-clinical imagery; if absent, section uses a `color-surface-muted` background block |
| Content-type tag | `type-label` in pill, `color-surface-muted` | `content_type` field: Article / Video / Repurposed social |
| Article title | `type-h4` (Inter 20px / 600) | `title` — must be a patient question or patient benefit statement |
| Excerpt | `type-body-sm` (Inter 15px) | `excerpt` — max 200 chars, written for a patient, not a professional |
| Metadata | `type-caption` (`color-ink-secondary`) | Reading time + publish date |

## 6.4 Video Cards

If one of the 3 entries has `content_type = Video`, the card displays:
- A YouTube thumbnail image (static image, not a live embed or autoplay preview)
- A play icon overlay in `color-accent` — signals video content
- The same title, excerpt, and metadata as an article card

Clicking a video card routes to the SN Article page (`/sfatul-neurochirurgului/[slug]`) where the YouTube oEmbed loads on demand. **The video does not play on the homepage.** No autoplay. No embedded player in the homepage card.

## 6.5 Section Footer

- "Vedeți toate articolele" → /sfatul-neurochirurgului (styled as `atom-button-secondary` or `atom-button-ghost`)
- This link is always present when the section is visible — whether there are 3 or 30 published articles behind it

## 6.6 Relationship to Media Hub (Phase 2)

In Phase 2, the Make automation pipeline feeds social media content into the SN Article library after admin review. As the article count grows, the 3 homepage entries may be revisited by the administrator to ensure the homepage shows the most relevant content for incoming patients, not just the most recent.

The homepage SN preview does not auto-select based on traffic or algorithm. It is an editorial selection — consistent with the SN brand's commitment to curation over quantity.

## 6.7 Blocking Dependencies

| Dependency | Source | Status |
|-----------|--------|--------|
| ≥3 published SN Article entries | Q9 — Dr. Ungureanu | BLOCKING (section hidden until met) |
| Dr. Ungureanu selects the 3 homepage-featured entries | Dr. Ungureanu | BLOCKING |

---

# 7. Recomandări din Partea Colegilor Medici

**Organism:** `organism-colleague-recs` (homepage variant)
**Background:** `color-surface-warm` (`#F4EFE6`)
**Position:** Section 5
**Visibility condition:** Hidden until ≥1 active Colleague Recommendation CPT entry exists (Q24). When hidden, the section is absent from the page — no placeholder, no "coming soon" message.

## 7.1 Why This Comes Before Patient Testimonials

Professional peer endorsement is the most credible form of trust signal for a patient who does not yet know the doctor. When a colleague surgeon or specialist vouches for Dr. Ungureanu by name, with specific context about their professional relationship, that signal carries the weight of a professional community's trust.

Patient testimonials are powerful and personal. But a patient reading them without prior professional context reads them as: "other patients liked this doctor." A patient who has first read that peers of the doctor explicitly endorse him reads patient testimonials as: "even the people who would know a problem if there was one trust him, and so do other patients like me."

Professional credibility first. Patient social proof second. This order is preserved on the homepage — identical to the /recomandari page order.

## 7.2 Visible Entries

**2–3 entries on the homepage.** Not all active entries (that is the /recomandari page's role).

2 entries: standard homepage preview; sufficient to establish the social proof signal without requiring more space.
3 entries: if a third entry meaningfully adds variety (different specialty, different institution, different relationship context), the administrator may choose to display 3.

The administrator selects which entries appear on the homepage using `display_order` in the Colleague Recommendation CPT. Lower display_order values appear first on the homepage.

## 7.3 Entry Layout

Each recommendation entry renders in a horizontal card layout:

| Element | Token | Source field |
|---------|-------|-------------|
| Doctor portrait | `atom-avatar` 80×80px, `radius-avatar` (50%) | `photo` — professional portrait only |
| Name | `type-h4` (Inter 20px / 600) | `display_name` — "Dr. [Prenume] [Nume]" |
| Specialty | `type-body-sm` (Inter 15px) | `specialty` |
| Institution | `type-body-sm`, `color-ink-secondary` | `institution` |
| Professional context | `type-body-sm`, `color-ink-secondary`, possibly italic | `professional_context` — 1 sentence |
| Recommendation text | `type-body` (Inter 17px / 400) | `recommendation_text` — 60–150 words |

Desktop: portrait left, all text content right (flex row). Mobile: portrait above (centered or left-aligned), text below.

**No sliders.** Both/all entries are simultaneously visible on the page. They are rendered as a vertical stack on mobile, or a 2-column grid on desktop when 2 entries are displayed.

## 7.4 Trust Mechanisms

**What makes these entries trustworthy:**
- Real photographs of identified professionals (not stock avatars or initials)
- Full name and title — not anonymized
- Specific professional institution — verifiable
- Professional context that names the actual relationship — not a generic description of Dr. Ungureanu's virtues
- Recommendation text that is specific — references an approach, an outcome, or a quality that only someone with direct knowledge would name

**What makes these entries untrustworthy (and therefore forbidden):**
- Anonymous entries
- Generic praise ("one of the best") without specific context
- Entries without a professional photograph
- Entries without institutional affiliation
- Entries where the relationship between the recommending doctor and Dr. Ungureanu is unclear

## 7.5 Section Footer

- Link: "Vedeți toate recomandările" → /recomandari (`atom-button-ghost`)
- Phrasing: neutral, not promotional. "See all recommendations" — not "Read what others say about us"

## 7.6 Blocking Dependencies

| Dependency | Source | Status |
|-----------|--------|--------|
| ≥1 active Colleague Recommendation CPT entry (photo, name, specialty, institution, context, text) | Q24 — Dr. Ungureanu | BLOCKING (section hidden until met) |

---

# 8. Experiențele Pacienților

**Organism:** `organism-patient-testimonials`
**Background:** `color-surface` (`#FDFBF7`)
**Position:** Section 6
**Visibility condition:** Hidden until ≥2 approved Testimoniale CPT entries exist. When hidden, the section is absent — no placeholder. Unhidden simultaneously with /despre Section 7 (same content, same trigger point — Phase 6 workflow).

## 8.1 Visible Entries

**3 approved entries displayed on the homepage.** These are the 3 most recently approved entries from the Testimoniale CPT. No editorial selection required — the most recent 3 approved entries appear automatically.

Why 3: enough to signal that multiple patients have contributed; few enough to not overwhelm. The full testimonials list lives on /recomandari where all approved entries appear.

## 8.2 Display Structure

Each testimonial renders as:

| Element | Token | Source |
|---------|-------|--------|
| Testimonial text | `type-quote` (Lora italic 24px) for featured / `type-body` for standard | `experience_text` — in the patient's own words |
| Attribution | `type-caption` (Inter 13px), `color-ink-secondary` | "[Prenume][, Oraș]" — city only if provided and consented |
| Condition tag | `molecule-condition-tag` pill, `color-surface-muted` | `condition` field if provided |

**No carousels.** All 3 entries are simultaneously visible — rendered as a vertical stack (mobile) or a 3-column grid with consistent height (desktop). A patient does not need to interact to see all entries.

**No star ratings.** A patient's experience with their health is not rated 1–5. Star ratings reduce a human experience to a consumer metric.

**No photographs.** Patient privacy is the constraint. A testimonial without a face is not less trustworthy — it is more respectful. The name and city are identification enough.

**No surnames.** First name and city only.

## 8.3 Privacy Principles

Every displayed testimonial requires:
- `consent_given = true` (confirmed at time of form submission)
- `approval_status = Published` (admin-reviewed and approved)
- `gdpr_version` recorded (audit trail for compliance)

Content that was not explicitly consented to, was not reviewed by an administrator, or was submitted in error is never displayed. The system enforces this through the approval workflow — it is not a manual check during display.

No batch import of testimonials from external sources (Google reviews, social media comments) is permitted. All testimonials in this system were submitted through the /recomandari form with informed consent.

## 8.4 Relationship to Full Recommendations Page

The 3 homepage entries are a preview. The full experience lives on /recomandari.

- Homepage: 3 most recent approved entries + link to /recomandari
- /recomandari Section 2: all approved entries, ordered most-recent first, with Phase 2 load-more

**Section footer:**
- "Citiți experiențele pacienților" → /recomandari (`atom-button-ghost`)

---

# 9. Unde Mă Găsiți

**Organism:** `organism-location-preview`
**Background:** `color-accent-subtle` (`#E4EDEB`)
**Position:** Section 7 — always visible once location data is provided (Q13)
**Visibility condition:** Hidden until minimum location data for at least one city is confirmed. When location data is available, this section is always visible regardless of other content conditions.

## 9.1 Purpose

This section answers the most practically decisive question a patient has: *"Can I actually get to this doctor?"*

Geographic inaccessibility — or the perception of it — is the most common reason a Romanian patient does not pursue a consultation with a qualified specialist. A patient in Baia Mare who assumes a Cluj-based doctor is unreachable will not call. A patient who sees "Dr. Ungureanu also consults in Baia Mare" before reaching /programari has that barrier removed.

The homepage location section exists to signal: "This doctor may be accessible to you." The full details (address, schedule, booking method) live on /programari. This section creates the awareness and routes to the detail.

## 9.2 Content — City Level Only

The homepage location section is informational and city-level only. It does not contain:
- Full addresses (those are on /programari)
- Operating hours (those are on /programari per location card)
- Phone numbers (that is on /contact and footer)
- Maps or map embeds

**What it does contain:**

For each city:
- City name (Lora, `type-h3` weight)
- Visit type indicator: Consultații / Intervenții chirurgicale / Ambele — using the same vocabulary as the `molecule-location-card`
- Brief orientation line: name of the clinic or hospital, without full address (e.g., "Spitalul Clinic Județean Cluj-Napoca" — the institution, not the street)
- CTA → /programari: "Detalii și program" — routes to the full location directory

**No live map embed on the homepage.** Maps require JavaScript loading, external API calls, and are a privacy consideration (Google Maps tracking on initial page load). The homepage is not the appropriate surface for a map — /programari is. The homepage shows city names only.

## 9.3 Layout — Two Cities

Two cities are documented in this specification: Cluj and Baia Mare. If additional locations exist or are confirmed by Q13, this section's layout adapts:

| Configuration | Layout |
|--------------|--------|
| 1 location | Full-width, centered, single location block |
| 2 locations | Two-column on desktop, stacked on mobile |
| 3 locations | Three-column on desktop, stacked on mobile |

Each location block contains the elements described in Section 9.2.

The section has a single primary CTA at the bottom, below all location blocks: "Programează o consultație" → /programari. This is the action the section exists to enable.

## 9.4 Map Behavior (Phase 1 — None)

No map embed in Phase 1. The /programari page contains map links (Google Maps URL per location) that open in the patient's native maps application. The homepage does not need a map — it needs city names and the path to more detail.

## 9.5 Connection to /programari

This section is explicitly not a replacement for /programari. Its section-level CTA routes to /programari for all details. The patient who needs:
- A specific address → goes to /programari
- The schedule for a specific location → goes to /programari
- The booking method → goes to /programari
- The phone number → goes to /programari or /contact

The homepage section removes the geographic barrier. /programari resolves the logistical detail.

## 9.6 Blocking Dependencies

| Dependency | Source | Status |
|-----------|--------|--------|
| City names and visit types for all active locations | Q13 — Dr. Ungureanu | BLOCKING |
| Institution/clinic names (not full address) | Q13 | BLOCKING |
| /programari live | Phase 4 | BLOCKING (section CTA must route somewhere) |

---

# 10. Despre Dr. George Ungureanu (About Preview)

**Organism:** `organism-doctor-intro`
**Background:** `color-surface-warm` (`#F4EFE6`)
**Position:** Section 8 — always visible once photography and text are provided (Q7)

## 10.1 Purpose

By Section 8, a patient has been on the page for a significant amount of time. They have seen the hero, read the doctor's personal message, scanned condition cards, seen educational content, read peer endorsements and patient testimonials, and confirmed geographic access. They have not yet committed to an appointment.

This section answers the question that emerges after trust is partially established: *"Who is this person, specifically?"*

This is not a summary of /despre. It is a human moment — a portrait of Dr. Ungureanu as a person and a clinician, offering enough to feel known and enough to invite the patient to continue to /despre for the full story.

## 10.2 What This Section Is Not

It is not a CV. It is not a credentials list. It is not a list of institutions, conferences, and publications. It does not replicate the professional timeline. It does not replace /despre.

A patient who reads this section should come away with: a sense of who Dr. Ungureanu is as a person and why he became what he is — not a record of everything he has accomplished.

## 10.3 Required Elements

| Element | Token | Notes |
|---------|-------|-------|
| Approachable portrait | `atom-avatar` or constrained `atom-image` | The portrait distinct from the hero photograph — more direct, warm, calm eye contact or engaged expression. (Q7 blocking.) |
| Specialty and title | `atom-overline` or `type-label` | "Medic Primar Neurochirurgie" — one line, precise |
| Philosophy statement | `type-h3` (Lora 28px / 400) + `type-body` | 2–3 sentences in Dr. Ungureanu's voice about his approach to patient care. First person. Not marketing language. The statement that explains how he thinks about the doctor-patient relationship. |
| Academic credibility anchor | `type-body-sm`, `color-ink-secondary` | One or two specific credentials that a patient would find reassuring — not a list. The one most relevant to this patient population. Examples: subspecialty certification, affiliated institution, years of practice in neurochirurgie. Not a wall of text. |
| Timeline hint | Brief visual element | A single line or small visual cue indicating the professional journey — "Pregătire medicală la [institution]" or similar. Not the full timeline — one anchor that invites the patient to /despre for more. |
| Link | `atom-button-secondary` → /despre | "Aflați mai multe despre Dr. George Ungureanu" — not "About me" |

Desktop layout: two-column (portrait left, all text right) or asymmetric (portrait 40%, text 60%). Mobile: portrait above, text below.

## 10.4 The Human Dimension

The philosophy statement is the most important element in this section. It is the moment on the homepage where the doctor speaks about what he believes — about patients, about care, about the relationship between understanding and healing.

The statement must be written by Dr. Ungureanu. It must not be drafted by an administrator, a copywriter, or derived from existing marketing language. It must read as a person who has thought carefully about why they chose their vocation.

Length: 2–3 sentences. Warm, precise, unhurried.

**What makes it fail:**
- Third person ("Dr. Ungureanu believes...")
- Marketing register ("is committed to providing world-class care")
- Generic medical values ("patient-centered care is at the heart of...")
- Credential-anchored ("With 20 years of experience...")

**What makes it succeed:**
- First person, specific, genuine
- Names something the patient will recognize as true from their own experience of illness
- Does not self-congratulate — it acknowledges the patient's situation

## 10.5 Blocking Dependencies

| Dependency | Source | Status |
|-----------|--------|--------|
| Approachable portrait photograph | Q7 — Dr. Ungureanu | BLOCKING |
| Philosophy statement (2–3 sentences, first person) | Dr. Ungureanu | BLOCKING |
| Specialty and title for credentials line | Dr. Ungureanu | BLOCKING |
| Academic credibility anchor (one specific credential) | Dr. Ungureanu | BLOCKING |
| /despre live | Phase 5 | BLOCKING (section CTA must route somewhere) |

---

# 11. Final CTA Section

**Organism:** `organism-cta-banner`
**Background:** `color-ink` (`#231E1A`) — warm near-black
**Position:** Section 9 — always visible

## 11.1 Purpose

A patient who has reached Section 9 has traveled through the full homepage experience. They have been given everything the homepage offers: visual calm, the doctor's personal voice, clinical breadth, educational depth, professional social proof, patient social proof, geographic clarity, and a human portrait.

The final CTA section has one job: provide a clear, calm next step for the patient who is ready to act.

This section does not persuade. It does not remind. It does not summarize the page. It does not list the reasons to book an appointment. A patient who has arrived at this section has their reasons. The section's job is simply to make the next action frictionless.

## 11.2 Emotional Tone

**Not urgent.** "Programează o consultație" — not "Book now," not "Don't wait," not "Limited appointments available."

**Not pressuring.** No countdown. No scarcity signal. No social proof used as pressure ("Join 500+ patients who...").

**Calm and clear.** The section's darkness (`color-ink`) creates a visual anchor at the bottom of the page — a moment of presence and gravity that is different from the cream sections above it. It signals arrival, not urgency.

**An invitation, not a demand.** The copy acknowledges that the patient may not be ready to book an appointment today — and that is acceptable. The CTA is present for when they are.

## 11.3 Required Elements

| Element | Token | Notes |
|---------|-------|-------|
| Heading | `type-h2` (Lora 38px / 700 / `color-surface`) | A single sentence that acknowledges the patient's journey and invites action. Not a marketing headline. (Final copy from Dr. Ungureanu.) |
| Supporting text | `type-body` (Inter 17px / `color-surface` at 85%) | 1–2 sentences. Explains what happens next: "Programați o consultație și stabilim împreună pașii următori" or equivalent. Specific, calm, reassuring. |
| Primary CTA | `atom-button-primary` (adapted for dark background) → /programari | "Programează o consultație" — exact label, always |
| No secondary CTA | — | The final CTA section has one button. One clear next step. Not two competing paths. |

## 11.4 What This Section Does Not Contain

| Forbidden | Reason |
|-----------|--------|
| Urgency language | Incompatible with this emotional register and the Manifesto |
| Scarcity ("Limited availability") | Manipulative; creates anxiety rather than confidence |
| Statistics or counters | Not established at build time; would require ongoing maintenance |
| Testimonial preview | The testimonials section was Section 6; repeating social proof here turns the CTA into a sales tactic |
| Multiple CTAs | One button, one destination, one clear instruction |
| Contact information | Contact is on /contact, reached via /programari |

## 11.5 Relationship to /programari

The final CTA routes to /programari. Always. Every time. No exceptions.

A patient who clicks the final CTA button is not yet contacting Dr. Ungureanu. They are navigating to /programari, where they will see location information, confirm geographic accessibility, and then (if they choose) proceed to /contact.

This two-step process is intentional and documented throughout this project. The final CTA is the beginning of the appointment journey — not the end of it.

---

# 12. Mobile Homepage

## 12.1 Section Order on Mobile

The section order is identical to desktop. No sections are reordered on mobile. No sections are hidden on mobile that are visible on desktop (or vice versa, beyond the existing visibility conditions).

## 12.2 Mobile Spacing

| Context | Desktop | Mobile |
|---------|---------|--------|
| Section padding top/bottom | `spacing-2xl` (80px) | `spacing-xl` (64px) |
| Hero section padding | `spacing-3xl` (128px) | `spacing-2xl` (80px) |
| Card internal padding | `space-8` (32px) | `space-6` (24px) |
| Grid gap between cards | `space-6` (24px) | `space-4` (16px) |
| Between testimonial entries | `space-8` (32px) | `space-6` (24px) |

## 12.3 Typography on Mobile

| Element | Desktop | Mobile | Notes |
|---------|---------|--------|-------|
| H1 (hero headline) | 52px | 36px | Lora retains character at 36px; do not go below 32px |
| H2 (section headings) | 38px | 28px | All section headings scale down |
| H3 (subsection) | 28px | 22px | |
| Body text | 17px | 16px | Never smaller on mobile |
| Body-lg (lead) | 19px | 17px | |
| Navigation | 15px | 15px | Does not change — UI text consistent |
| CTA button | 16px | 15px | Slightly reduced; never below 15px |

## 12.4 CTA Visibility on Mobile

The primary CTA ("Programează o consultație") must be visible without scrolling on the hero section. On a 375px×667px viewport (iPhone SE), the hero CTA button must appear in the initial viewport.

In the sticky mobile header: the CTA button is retained at all scroll positions. See `docs/tasks/03_HEADER_AND_NAVIGATION.md` Section 2.5 for sticky mobile header specification.

In the final CTA section: the button is full-width on mobile. Padding: `space-4` vertical (16px), full-width horizontal.

## 12.5 Touch Targets for Older Patients

Patients 50+ are a primary consideration on mobile. All interactive elements meet or exceed 44×44px tap targets:

| Element | Mobile tap target |
|---------|-----------------|
| Nav items in mobile drawer | 48px height × full drawer width |
| Hamburger button | 44×44px |
| Condition card (entire card) | Full card surface, minimum 80px height |
| CTA button (hero) | 52px height minimum, full width on small screens |
| CTA button (final) | 52px height minimum, full width |
| Testimonial "Read more" link (if present) | 44×44px |
| Location section CTA | 52px height minimum |
| Accordion triggers (FAQ — if used) | 48px height |

## 12.6 Condition Card Grid on Mobile

6 condition cards stack vertically as a single column on mobile (<768px). Each card is full-width with `space-6` (24px) internal padding. Cards do not scroll horizontally. A patient scrolls vertically through all 6 cards in a natural reading motion.

## 12.7 Colleague Recommendations on Mobile

2–3 recommendation entries stack vertically on mobile. Portrait moves above the text content (from horizontal layout to vertical stack). Portrait centered or left-aligned. Text left-aligned below.

## 12.8 Patient Testimonials on Mobile

3 testimonial entries stack vertically. Each testimonial is a full-width card. No horizontal scrolling. No interaction required to see all entries.

---

# 13. Accessibility

## 13.1 Reading Flow and Document Outline

The homepage produces a single, logical heading outline for screen readers:

```
H1: [Hero headline — page title]
  H2: [Personal message section heading]
  H2: Afecțiuni frecvente
    H3: [Each condition card title is NOT an H3 — it uses type-h4 styling, presented as a card heading, not a section heading]
  H2: Sfatul Neurochirurgului
    H3: [Each article title is a heading within its card context]
  H2: Recomandări din partea colegilor medici
    H3: [Each recommendation entry has a heading for the recommending doctor's name]
  H2: Experiențele pacienților
  H2: Unde mă găsiți
    H3: Cluj-Napoca
    H3: Baia Mare
  H2: Despre Dr. George Ungureanu
  H2: [Final CTA heading]
```

One H1 per page. All section headings are H2. Sub-elements within sections use H3 or styled non-heading elements. No heading levels are skipped.

## 13.2 Screen Reader Logic

| Section | Screen Reader Consideration |
|---------|---------------------------|
| Hero photography | `alt=""` if decorative overlay; if the photograph carries meaning, describe the content (not "image of doctor") |
| Condition cards | Each card's link must have a meaningful label: "Citiți despre [condition name]" not just "Aflați mai multe" (ambiguous when multiple identical links exist) |
| Article cards | Link text must include the article title (visible text is sufficient if the link wraps the entire card) |
| Colleague recommendation entries | Each entry should be wrapped in an `<article>` element or equivalent landmark for screen reader navigation |
| Testimonials | Each testimonial is an `<article>` or `<blockquote>` with attribution — the attribution must follow the testimonial text, not precede it |
| Location section | Location blocks should use `<address>` element or equivalent ARIA landmark |
| CTA sections | Button text is explicit: "Programează o consultație" — not "Click here" |

## 13.3 Reduced Motion

All homepage animations are suppressed or simplified under `prefers-reduced-motion: reduce`. This applies to:
- Hero: no entrance animation — content appears immediately at full opacity
- Section scroll reveals: disabled — sections appear at their final state without transition
- Condition card hover: no translateY movement — box-shadow still appears (color change is acceptable)
- Any parallax treatment on the hero photography: disabled

The `prefers-reduced-motion` query is applied globally and is not opt-in per component. A user who has requested reduced motion receives a reduced-motion experience across the entire homepage without exception.

## 13.4 Keyboard Navigation

| Flow | Keyboard Path |
|------|--------------|
| Skip to main content | Tab (first action) → Enter → arrives at `#main-content` (beginning of hero) |
| Navigate through sections | Tab moves through all interactive elements in document order |
| Condition card grid | Tab enters each card; Enter activates the link; all 6 cards reachable |
| Colleague recommendation entries | Tab moves through each entry; if entries have links, Tab navigates to them |
| Hero CTAs | Primary CTA → secondary CTA → (Tab continues to next section) |
| Location section CTAs | Tab reaches each location's CTA; Enter activates |
| Final CTA | Tab reaches the button; Enter activates |

No element on the homepage requires hover to reveal content. All content is visible without mouse interaction.

## 13.5 Cognitive Accessibility

For patients with reduced cognitive capacity (anxiety, distress, unfamiliar with digital interfaces):
- Every section has a single, clear primary purpose — no section tries to do multiple things simultaneously
- CTAs use identical labels across the page ("Programează o consultație" is the same label every time it appears)
- The section order is intuitive — it follows a narrative, not an organizational hierarchy
- No time-limited elements (no auto-hiding messages, no countdown banners, no content that disappears)
- Errors (if any form interaction exists) use plain Romanian, appear next to the relevant element, and do not disappear automatically

---

# 14. Phase 2 Opportunities

These are documented for planning purposes. **None are implemented in Phase 1.** They are not placeholders or empty containers in the Phase 1 build.

## 14.1 Introductory Video

A YouTube video of Dr. Ungureanu introducing himself and Sfatul Neurochirurgului — placed in the Personal Message section (Section 2) as a lazy-loaded oEmbed alongside or replacing the portrait.

**Condition:** Suitable video produced specifically for this context (not a repurposed lecture); YouTube channel confirmed (Q18); video tested for Core Web Vitals impact.

**Implementation constraint:** Lazy-loaded, no autoplay, `prefers-reduced-motion` does not suppress a video that requires user interaction to play — only decorative motion is suppressed.

## 14.2 Richer Educational Previews

As the SN Article library grows, the Section 4 preview may be enhanced with:
- Category-based selection (e.g., "for patients before surgery" vs. "recovery information")
- A mix of article, video, and FAQ-style entries in a more varied grid layout
- Reading time and difficulty indicator

**Condition:** ≥12 published SN Article entries across at least 3 content types.

## 14.3 Media Integrations

If the Make automation pipeline (Phase 8) produces a steady volume of social media content converted to SN Articles, a small Instagram or YouTube "recent content" indicator — not an embedded feed, but a static "recently added to Sfatul Neurochirurgului" panel — may be added to Section 4.

**Implementation constraint:** No live social feed embeds. No third-party JavaScript from social platforms loaded on initial page load.

## 14.4 Advanced Testimonial Display

If the volume of approved patient testimonials grows significantly (≥30 entries), the homepage testimonial section may display a randomized selection of 3 from the approved pool, rather than always the 3 most recent.

**Condition:** ≥30 approved Testimoniale CPT entries; Dr. Ungureanu confirms randomization is acceptable.

## 14.5 Multilingual Support

If a significant non-Romanian-speaking patient population is identified, a multilingual version of the homepage would require:
- Complete architecture review (hreflang, URL structure)
- Full content translation for all 9 sections
- Typography review (Lora + Inter render well in Hungarian/English — but typographic scale may need adjustment for other scripts)

**Not a toggle.** Multilingual is an architectural decision. It begins here only after a comprehensive multilingual strategy is approved.

---

# 15. Validation Checklist

## 15.1 Emotional Clarity

- [ ] A patient can understand the purpose of this page within 8 seconds without reading body text
- [ ] The hero headline addresses the patient's situation — not the doctor's credentials
- [ ] No section creates urgency, scarcity, or pressure
- [ ] Every section has a single clear purpose — no section is trying to accomplish multiple emotional jobs simultaneously
- [ ] The page feels calmer to read than a standard medical website
- [ ] The manifesto test passes: a patient who received a difficult diagnosis last week would feel slightly less afraid after landing here

## 15.2 Trust

- [ ] All photography of Dr. Ungureanu is original (not stock) and warm-lit
- [ ] The hero photograph reads as observed, not posed for a website
- [ ] Colleague recommendation entries are specific and professionally attributed — not generic praise
- [ ] Patient testimonials contain no fabricated, imported, or anonymized content
- [ ] No marketing language ("world-class," "leading," "best") appears on the page
- [ ] The professional message (Section 2) is in Dr. Ungureanu's voice — first person, specific, genuine
- [ ] The About preview (Section 8) leads with philosophy before credentials
- [ ] Social proof sections (Sections 5 and 6) are present only when real content exists — no placeholder testimonials

## 15.3 Education

- [ ] The Section 4 heading frames Sfatul Neurochirurgului as an educational platform, not a blog
- [ ] Article card titles are patient questions or patient benefit statements — not topic labels
- [ ] The 6 condition cards represent a meaningful, patient-relevant selection — confirmed by Dr. Ungureanu
- [ ] Condition card descriptions are written for a non-medical patient — plain Romanian, no Latin terminology
- [ ] The link to /sfatul-neurochirurgului is present and leads to the full hub

## 15.4 Accessibility

- [ ] Page heading outline is logical: one H1, multiple H2s, H3s only within sections
- [ ] All interactive elements have visible focus rings (2px `color-accent`)
- [ ] Skip to content link is the first focusable element
- [ ] All images have appropriate alt text (descriptive for meaningful, empty for decorative)
- [ ] All condition card links have unique, descriptive text (not 6 identical "Aflați mai multe" links)
- [ ] All touch targets are minimum 44×44px
- [ ] All animations are suppressed under `prefers-reduced-motion`
- [ ] Contrast verified: all text/background combinations pass WCAG 2.1 AA (primary text: 14.5:1)
- [ ] Keyboard navigation traverses all interactive elements in logical document order

## 15.5 Mobile Experience

- [ ] Hero CTA is visible on a 375×667px viewport without scrolling
- [ ] All 6 condition cards are reachable without horizontal scrolling
- [ ] Colleague recommendation entries stack vertically and are readable without zooming
- [ ] Patient testimonials stack vertically and are readable without zooming
- [ ] Location section is legible with city names clearly visible
- [ ] All tap targets are minimum 44×44px — verified at 375px viewport
- [ ] Body text is minimum 16px at all mobile breakpoints
- [ ] CTA button is full-width on mobile and minimum 52px height

## 15.6 Patient Reassurance

- [ ] The homepage answers the question "can I trust this doctor?" through multiple forms of evidence — not through credentials alone
- [ ] The homepage answers the question "can I access this doctor geographically?" before the patient must navigate to /programari
- [ ] The homepage does not end abruptly — the final CTA is a clear, calm invitation, not a forgotten afterthought
- [ ] The CTA button label is "Programează o consultație" — exact, always, without variation
- [ ] The primary CTA always routes to /programari — never to /contact, a tel: link, or a modal
- [ ] A patient who is not ready to book an appointment has multiple lower-commitment paths (reading about a condition, reading an SN article, reading about the doctor) available before being asked to act
- [ ] The page does not leave a patient without a next step at any section

---

# 16. Blocking Dependencies Summary

| Section | Dependency | Source | Status |
|---------|-----------|--------|--------|
| 1 — Hero | Doctor photography (full-bleed hero image) | Q7 | BLOCKING |
| 1 — Hero | Headline copy | Dr. Ungureanu | BLOCKING |
| 1 — Hero | Supporting text copy | Dr. Ungureanu | BLOCKING |
| 1 — Hero | /programari live | Phase 4 | BLOCKING |
| 2 — Personal Message | Approachable portrait | Q7 | BLOCKING |
| 2 — Personal Message | Personal statement about SN (150 words, first person) | Dr. Ungureanu | BLOCKING |
| 3 — Afecțiuni | ≥6 active Condition CPT entries | Q4 | BLOCKING |
| 3 — Afecțiuni | Selection of 6 conditions + display_order | Dr. Ungureanu | BLOCKING |
| 4 — SN Preview | ≥3 published SN Article entries | Q9 | BLOCKING (section hidden until met) |
| 4 — SN Preview | Selection of 3 featured articles | Dr. Ungureanu | BLOCKING |
| 5 — Colleague Recs | ≥1 active Colleague Recommendation entry | Q24 | BLOCKING (section hidden until met) |
| 6 — Testimonials | ≥2 approved Testimoniale CPT entries | Phase 6 workflow | BLOCKING (section hidden until met) |
| 7 — Unde mă găsiți | City names + visit types + institution names | Q13 | BLOCKING |
| 7 — Unde mă găsiți | /programari live | Phase 4 | BLOCKING |
| 8 — About Preview | Approachable portrait | Q7 | BLOCKING |
| 8 — About Preview | Philosophy statement (2–3 sentences, first person) | Dr. Ungureanu | BLOCKING |
| 8 — About Preview | Academic credibility anchor (1 specific credential) | Dr. Ungureanu | BLOCKING |
| 8 — About Preview | /despre live | Phase 5 | BLOCKING |
| 9 — Final CTA | Final CTA heading copy | Dr. Ungureanu | BLOCKING |
| 9 — Final CTA | /programari live | Phase 4 | BLOCKING |

**Minimum viable homepage at launch (if not all content is ready):**
Sections 1, 2, 3, 7, and 9 are always visible (after their content conditions are met). Sections 4, 5, and 6 are conditionally hidden and activate as content is published. Sections 8 requires photography and philosophy text. A launch is technically feasible with Sections 1, 3, 7, and 9 — though Sections 2 and 8 are important enough that launch should not proceed without them.

---

*Homepage version: 1.0 — 2026-06-28*
*Supersedes: docs/tasks/02_CONTENT_MODELS.md §1.1 (Homepage) for all implementation purposes*
*Source: docs/tasks/00_PROJECT_ROADMAP.md v1.1, docs/tasks/01_INFORMATION_ARCHITECTURE.md v1.0, docs/tasks/02_CONTENT_MODELS.md v1.0, docs/tasks/03_HEADER_AND_NAVIGATION.md v1.0, docs/tasks/04_DESIGN_SYSTEM_TOKENS.md v1.0*
*Next: docs/tasks/06_AFECTIUNI.md*
