# Sfatul Neurochirurgului — Hub Realignment Plan
**Sprint:** 9.9B — Phase 1: Planning & Information Architecture Only  
**Date:** 2026-07-01  
**Status:** AWAITING APPROVAL — do not implement anything from this document  
**Roles:** Healthcare Content Strategist · Patient Education Specialist · Medical UX Designer · Editorial Director · Information Architect

---

## 1. Executive Summary

Sfatul Neurochirurgului is not a blog. It is not a renamed article list. It is not a content marketing channel.

**It is a companion.** A space where a patient who just received a difficult diagnosis — or whose family member did — can find clarity, prepare, and feel less alone.

The current `/articole/` is a renamed archive with one demo article. The H1 says "Sfatul Neurochirurgului." The page is a flat list. A patient arriving from search finds one article and an empty-state block. There is no guidance, no organization, no sense that someone designed this for *them*.

The original vision (KNOWLEDGE_CENTER_ARCHITECTURE.md) described a content engine that compounds over time and feeds patients through a trust-building journey. That vision has not been abandoned — it was never built.

This document is the build plan.

---

**What Sfatul Neurochirurgului should feel like:**

> *Like opening a carefully curated booklet that a thoughtful neurosurgeon prepared specifically for the day before your appointment — and the day after surgery — and the night when you can't sleep and need to understand what's happening to your body.*

**What it should NOT feel like:**
- A traditional blog (chronological, author-centric, no structure)
- A news section (timely, trending, ephemeral)
- A content farm (volume over quality, keyword-stuffed)
- A CPT archive rendered with default Elementor widgets

---

## 2. Current State Audit

### What exists

| Element | Status | Source |
|---------|--------|--------|
| CPT `articole` | Working | Sprint 7A |
| Archive URL `/articole/` | Working | Sprint 7A |
| Single article template | Working | Sprint 7A |
| Archive label "Sfatul Neurochirurgului" | Working (via JS) | Sprint 9.7B |
| 1 published article (demo) | Exists | Sprint 7A |
| Archive hero | Working, Apple Health styled | Sprint 9.7 |
| Empty-state block | Working | Sprint 8.2 |

### What does NOT exist

| Element | Status |
|---------|--------|
| Hub navigation (between sections) | Missing |
| Featured article treatment | Missing |
| Educational guides (Prima consultație, Recuperare, Familie) | Missing |
| Myth-busting section | Missing |
| Medical glossary | Missing |
| General FAQ | Missing |
| Video section | Missing |
| Media / press section | Missing |
| Curated social content | Missing |
| Recomandări de lectură | Missing |
| Any cross-linking from /afectiuni/, /interventii/ to hub guides | Missing |

### The core problem

The current page is a renamed article list. The H1 says "Sfatul Neurochirurgului" but nothing on the page delivers on that promise. The word "Sfat" means advice, counsel, guidance. A list of one article with an empty-state block below it is not guidance.

When a patient arrives and sees only one article, they conclude: *this doctor doesn't maintain his website*. That conclusion is false, but the page creates it.

---

## 3. The Hub Vision

### What Sfatul Neurochirurgului should be

A structured educational ecosystem organized around patient need, not content format or publication date.

**Three patient moments it must serve:**

| Moment | Patient state | Hub response |
|--------|--------------|--------------|
| **Before consultation** | Anxious, researching, not sure what to expect | Prima Consultație guide, FAQ, Mituri |
| **Between consultation and surgery** | Processing a diagnosis, needs clarity | Articles, Glosar, Recuperare preview |
| **After surgery / recovery** | Following instructions, worried about normalcy | Recuperare guides, FAQ, Familie |

**And one family moment:**

| Moment | State | Hub response |
|--------|-------|--------------|
| **Family member supporting patient** | Protective, overwhelmed, unsure how to help | Familie și aparținători section |

### The editorial philosophy

1. **Patient first, always.** Every piece of content answers a real question a real patient asks. Not questions a neurologist would find interesting.

2. **Honest about uncertainty.** "We don't always know" is more trustworthy than "studies show 95% success." Patients can sense overconfidence.

3. **Plain language, clinical accuracy.** The two are not in conflict. A neurosurgeon who can explain a herniated disc in two sentences a grandmother understands is more impressive than one who uses Latin nomenclature.

4. **No content without review.** Every piece — article, guide, FAQ answer, myth card, glossary term — must be reviewed by Dr. George before publication. AI drafts are starting points, not final copy.

5. **Depth over volume.** One excellent guide to recovery after microdiscectomy is worth more than ten thin articles. The hub should grow slowly and be consistently excellent.

6. **The hub is a living resource.** Content is dated and reviewed periodically. A guide written in 2026 should have a visible "Last reviewed: [date]" so patients know it is current.

---

## 4. Hub Section Architecture — All 10 Sections

### Section 1 — Prima Consultație *(Immediate priority — buildable now)*

**Patient need:** I've never seen a neurosurgeon. I don't know what to bring, what will happen, or what to ask.

**Content structure:**

```
Prima Consultație
├── Ce să aduci
│     Checklist: RMN/CT, trimitere, lista medicamente, buletin
│     Note: "Nu aveți toate documentele? Veniți oricum."
│
├── Cum să vă pregătiți
│     Mental preparation: write down symptoms, timeline, questions
│     Physical: no special preparation needed unless specified
│     Practical: arrive 10-15 min early, bring someone if possible
│
└── Ce întrebări să puneți
      Question guide: 8-10 suggested questions
      Examples: "Ce opțiuni de tratament am?", "Cât de urgent este?"
      Format: printable checklist style
```

**Implementation:** PHP shortcode or dedicated page  
**Content readiness:** ~70% buildable from existing /programari/ content + generic medical knowledge  
**Blocker:** Dr. George review of preparation advice  
**Format:** Step-by-step guide with numbered stages and a printable checklist

---

### Section 2 — Recuperare și îngrijire *(High priority — needs George's content)*

**Patient need:** I had or am about to have surgery. What does recovery actually look like? What can I do, what can't I do?

**Content structure:**

```
Recuperare și îngrijire
├── Recuperare post-operatorie (general)
│     Timeline: Day 1 / Week 1 / Month 1 / 3 months
│     Pain management: what to expect, when to be concerned
│     When to call the doctor: warning signs
│
├── Proceduri specifice (linked to /interventii/ pages)
│     [For each published interventii page: a recovery guide]
│     e.g., "Recuperare după microdiscectomie lombară"
│
├── Exerciții și recomandări
│     What you CAN do at each stage
│     What to AVOID and for how long
│     Physiotherapy: when and why
│
└── Revenirea la activitățile zilnice
      Work: when, what type
      Driving: when it is safe
      Exercise: gradual reintroduction
      Travel: considerations
```

**Implementation:** Separate page (richest section, needs own URL)  
**Content readiness:** ~0% — requires Dr. George's clinical content  
**Blocker:** All content from Dr. George, procedure-specific  
**Format:** Timeline-based guides with procedure-specific variants  
**Note:** Procedure-specific recovery guides should link bidirectionally to /interventii/ single pages

---

### Section 3 — Pentru familie și aparținători *(High priority — partially buildable)*

**Patient need (family member):** My family member is about to have surgery. How can I actually help? What should I know?

**Why this section is strategically important:** In neurosurgical contexts, the family member is often the primary online researcher. They are the ones searching at 2am. They are the ones who will ultimately influence the patient's decision to book or not. A section written directly for them — acknowledging their role, their fear, their specific questions — is rare and differentiating.

**Content structure:**

```
Pentru familie și aparținători
├── Cum vă puteți susține persoana dragă
│     Practical: what to do on surgery day
│     Emotional: how to talk about fear without amplifying it
│     Practical at home: what to prepare in the house before discharge
│     Longer-term: how to support recovery without fostering dependence
│
├── Ce să așteptați de la intervenție și spitalizare
│     What happens in the OR (demystified)
│     What to expect in the recovery room
│     How long until you can see the patient
│     What the patient will look/feel like post-op
│
└── Întrebări frecvente pentru familie
      "Pot veni la consultație cu persoana mea?"
      "Cum îi explic copilului că tatăl său are nevoie de operație?"
      "Ce înseamnă că operația a 'decurs bine'?"
      "Când ar trebui să mă îngrijorez în recuperare?"
```

**Implementation:** PHP shortcode or dedicated page  
**Content readiness:** ~40% — general framework buildable; specifics need George's input  
**Blocker:** Emotional guidance text must be reviewed by Dr. George  
**Format:** Warm, conversational tone — less clinical than other sections  
**Note:** This is the section most likely to be shared on social media. Patients forward it to family members.

---

### Section 4 — Mituri și adevăruri *(Medium priority — needs George's content)*

**Patient need:** I've heard that neurochirurgie is very dangerous / the recovery takes years / you're never the same after brain surgery. Are these true?

**Why this section is strategically important:** Medical myths are the primary driver of delayed consultation. A patient who believes "orice operație pe coloană te lasă paralizat" will avoid seeking help even when surgery is indicated. Myth-busting by a named, credentialed neurosurgeon is uniquely powerful.

**Content structure:**

```
Mituri și adevăruri
[6-10 myth/truth pairs]

Myth: "Neurochirurgia este întotdeauna extrem de riscantă"
Truth: "Riscul depinde de tipul intervenției, localizare și starea pacientului..."

Myth: "Dacă operezi coloana, nu mai poți face sport niciodată"
Truth: "Marea majoritate a pacienților revin la activitate sportivă..."

Myth: "Hernia de disc se vindecă numai prin operație"
Truth: "În 85% din cazuri, tratamentul conservativ este suficient..."

Myth: "Recuperarea după operație pe creier durează ani"
Truth: "Durata recuperării depinde dramatic de tipul intervenției..."
```

**Implementation:** Myth card components (pair: warning card + truth card)  
**Content readiness:** 0% — all myth/truth pairs must come from Dr. George  
**Blocker:** Dr. George must provide 6-10 pairs with clinical grounding  
**Format:** Two-card pair: myth card (amber/warning visual treatment) + truth card (sage/calm visual)  
**Note:** This section has the highest social media sharing potential of any hub content

---

### Section 5 — Glosar medical *(Medium priority — seeded quickly)*

**Patient need:** I keep reading about "stenoză spinală", "radiculopatie", "laminectomie" and I don't understand what these words mean.

**Content structure:**

```
Glosar medical
[Alphabetical or categorized, 20-30 terms initially]

Each entry:
  Term: [Medical term]
  Definition: [Plain-language explanation, 2-4 sentences]
  Related: [Link to /afectiuni/ or /interventii/ page if applicable]

Categories:
  Anatomie (vertebre, disc, nerv, măduva spinării...)
  Diagnosticare (RMN, CT, electromiografie...)
  Proceduri (microdiscectomie, laminectomie, fuziune...)
  Simptome (radiculopatie, claudicatie, parestezii...)
```

**Implementation:** PHP shortcode, alphabetical expandable list, or accordion  
**Content readiness:** ~20% — structure buildable; terms need Dr. George  
**Blocker:** Term list and definitions must be reviewed by Dr. George  
**Format:** Expandable definitions (click to expand) or alphabetical list  
**Schema opportunity:** `DefinedTerm` schema for each glossary entry — significant SEO value  
**Target count:** 30 terms at launch, expanding with each article published

---

### Section 6 — Întrebări Frecvente *(High priority — mostly buildable now)*

**Patient need:** Quick answers to common questions — broader than the booking FAQ on /programari/.

**Scope distinction:** The FAQ on /programari/ is booking-focused ("how do I book", "what does it cost"). This hub FAQ is education-focused ("what is neurochirurgie", "when should I see a neurosurgeon", "what happens at first consultation").

**Content structure:**

```
Întrebări Frecvente

Category A: Despre neurochirurgie
  - Ce este neurochirurgia?
  - Neurochirurgul vs. neurologul — care este diferența?
  - Când ar trebui să consult un neurochirurg?
  - Trebuie să am simptome grave ca să vin?

Category B: Înainte de consultație
  - Pot veni fără trimitere?
  - Ce se întâmplă la prima consultație?
  - Cât durează o consultație?
  - Cât costă? (→ /programari/ for specifics)

Category C: Despre operație
  - Înseamnă o consultație că voi fi operat?
  - Cine decide dacă am nevoie de operație?
  - Cum mă pregătesc pentru operație?
  - Ce se întâmplă dacă refuz operația?

Category D: Recuperare
  - Cât durează recuperarea?
  - Cum îmi dau seama că recuperarea decurge bine?
  - Ce simptome ar trebui să mă îngrijoreze post-op?
```

**Implementation:** PHP shortcode using `<details>/<summary>` (same pattern as /programari/ FAQ)  
**Content readiness:** ~60% — most questions are generic enough to draft  
**Blocker:** Dr. George review of all answers  
**Format:** Categorized accordion — distinct from /programari/ FAQ in scope

---

### Section 7 — Video *(Medium priority — needs Dr. George's content list)*

**Patient need:** I learn better from watching than reading. I want to see Dr. George explain things directly.

**Content structure:**

```
Video — Dr. George Explică
[Curated grid of video cards]

Each card:
  Thumbnail image (YouTube thumbnail, manually saved)
  Category tag (e.g., "Hernie de disc")
  Title
  Duration
  Brief description (1-2 sentences)
  Link → YouTube (opens in new tab)
```

**Implementation:** PHP shortcode, video card CSS component (`.gu-video-card`)  
**Content readiness:** 0% — Dr. George must provide YouTube video list  
**Blocker:** Dr. George to select which videos to feature  
**Format:** 2-3 column card grid at desktop; 1 column at mobile  
**Critical constraint:** NO YouTube embed widget. NO auto-playing embeds. GDPR-compliant linked cards only — the video link opens YouTube in a new tab. Embeds require consent management that is disproportionate for a medical site.

---

### Section 8 — Media și apariții publice *(Lower priority — needs list from George)*

**Patient need (researcher/validator):** I want to see that this doctor is recognized as an authority beyond his own website.

**Why this section matters for E-E-A-T:** Google evaluates medical content providers on Experience, Expertise, Authoritativeness, Trustworthiness. External media mentions are one of the strongest off-page authority signals. Making them visible on the site brings that signal onto the domain.

**Content structure:**

```
Media și apariții publice

Sub-types:
  Presa scrisă (print/online articles)
  Televiziune / radio
  Podcasturi
  Conferințe și prezentări
  Publicații medicale

Each item:
  Publication/show name or logo
  Type indicator (press / TV / podcast / conferință)
  Title or topic
  Date
  Link (external, opens in new tab) or note if archived
```

**Implementation:** PHP shortcode, media item card  
**Content readiness:** 0% — Dr. George must compile list  
**Format:** Chronological list, most recent first; grouped by type

---

### Section 9 — Instagram Highlights *(Lower priority — needs editorial process)*

**Patient need (social proof):** I want to see that this doctor has an active, educational presence — not just a static website.

**Content structure:**

```
Instagram Highlights — Conținut educațional selectat

[6-9 curated posts]

Each item:
  Saved image or screenshot (locally hosted — NOT Instagram embed)
  Caption: manually written editorial context
  Date of original post
  Link to original post (optional)
  No: like counts, comment counts, follower counts
```

**Implementation:** PHP shortcode, photo grid component  
**Content readiness:** 0% — Dr. George must select posts and approve captions  
**Format:** 3-column photo grid at desktop; 2-column at mobile  
**Critical constraint:** See Section 5 (Social Content Policy) — no live Instagram embeds under any circumstances.

---

### Section 10 — Recomandări de lectură *(Lower priority — differentiating)*

**Patient need (engaged researcher):** Beyond this website, what else should I read? Are there books or resources my doctor would recommend?

**Why this section is differentiating:** Almost no neurosurgeon's website offers a curated patient reading list. It signals: *this doctor thinks about his patients' education beyond the 60-minute consultation*. It is a small but powerful trust signal for the engaged, researching patient.

**Content structure:**

```
Recomandări de lectură

Categories:
  Cărți pentru pacienți
    Books about the spine, brain, or neurosurgery written for non-specialists
    Examples: patient memoirs, condition guides, recovery narratives

  Ghiduri și broșuri
    Romanian Health Ministry guides
    Patient society booklets
    Trusted clinic patient guides

  Resurse online de încredere
    Romanian-language medical sources (not Wikipedia)
    Professional society patient sections
    Trusted international sources (Mayo Clinic, etc.) with note on language

Each item:
  Title
  Author or publisher
  Year
  Brief description: why Dr. George recommends it, 2 sentences
  Link (if available)
```

**Implementation:** PHP shortcode, resource card component  
**Content readiness:** 0% — Dr. George must compile and annotate list  
**Format:** Simple card list, not grid — title + author + description + link  
**Target at launch:** 5-8 recommendations minimum

---

## 5. Social Content Policy

### The Rule

**All content from external platforms (YouTube, Instagram, Facebook, LinkedIn) must be manually selected, editorially approved, and published as static curated content. No live feeds. No API auto-sync. No third-party embed widgets.**

### Why — Four Dimensions

**1. GDPR and digital rights**

Live social embeds (Instagram, YouTube, Facebook) load third-party JavaScript from Meta and Google's servers. This JavaScript sets persistent tracking cookies on the user's browser. Under GDPR (EU regulation, applicable to Romanian .ro sites), this requires explicit informed consent before the script loads.

A medical site implementing a consent banner is manageable. A medical site that loads tracking scripts without consent is a legal liability. The manual curation approach is 100% GDPR-compliant by design: the content is static, locally hosted, no third-party scripts. There is nothing to consent to.

**2. Quality and clinical safety**

A raw Instagram feed will pull every post — including casual content, personal moments, events, and posts that were appropriate for a social context but not for a patient preparing for surgery. Clinical credibility requires curation.

Consider: a patient reading the Prima Consultație guide scrolls down and sees an Instagram post from Dr. George at a social event. The cognitive dissonance is real. Curation prevents it.

**3. Reputational control**

Social platforms change. Posts can be misread out of context. Comments below a post can be negative or misleading. Embedding a live post embeds the comments section. The manual curation approach means Dr. George controls exactly what appears on his medical site — not the algorithm.

**4. Medical authority positioning**

Instagram is designed to feel casual. The Sfatul hub is designed to feel authoritative. Live social embeds import the aesthetic of social media — engagement metrics, time-relative posting, algorithmic randomness — into a space that should feel like a considered editorial publication. They are structurally incompatible.

### The Curation Workflow

```
External platform (Instagram, YouTube, etc.)
      ↓
Dr. George (or designated editor) identifies a post/video
      ↓
Manual selection: Is this educational? Is it appropriate for patients?
      ↓
Editorial approval: Does the caption/description on the hub add context?
      ↓
Content created: Screenshot or thumbnail saved locally. Caption written.
      ↓
Published in hub shortcode (static PHP array, easily updated)
      ↓
Periodic review: Is this content still accurate? (At least annually)
```

This workflow takes approximately 5-10 minutes per item. A hub with 6-9 Instagram highlights requires 45-90 minutes to curate. It does not require a developer — it requires updating a PHP array with new entries.

**Implementation note:** Each social content section (Video, Instagram, Media) is implemented as a PHP array in the shortcode. Adding new items is a one-line addition to the array. Removing items is a one-line deletion. The editor does not need Elementor, WP admin, or CPT access — just a developer to update the PHP file, or Dr. George could email the list and a developer updates it in 10 minutes.

---

## 6. Navigation Model — Analysis and Recommendation

### Option A — Landing Page + Long-Scroll Sections

**Structure:** Single `/articole/` page with all 10 sections in sequence. Jump navigation bar below hero (sticky on scroll) with anchor links to each section.

**Pros:**
- Simplest to implement — one page, all content
- Excellent SEO — high content density on a single URL
- No navigation friction — the user scrolls, not clicks
- Each section benefits from the domain authority of the main URL
- Easy to build incrementally (add sections to the page as content develops)

**Cons:**
- Long pages can feel overwhelming at first impression
- Sections of unequal depth create visual imbalance (Video might be 2 cards; Recuperare might be 4,000 words)
- All sections live and die together — a thin section weakens the whole page
- Cannot give a specific guide its own shareable URL (for email/WhatsApp sharing)
- Scroll fatigue on mobile for the deepest content

---

### Option B — Landing Page + Sub-pages

**Structure:** Hub landing at `/articole/` with section tiles (no content). Each section is a separate WordPress page: `/articole/prima-consultatie/`, `/articole/recuperare/`, etc.

**Pros:**
- Clean, focused landing page (just a directory)
- Each section has its own URL — shareable, linkable, SEO-indexable independently
- Section pages can grow to any depth without affecting the hub
- Users arrive at the specific content they need

**Cons:**
- Requires creating 8-10 WordPress pages (more maintenance surface)
- The landing page is thin — a directory without content is less engaging
- Risk of empty or near-empty sub-pages in the launch phase (worse than no page)
- Changes the URL structure from the current `/articole/` hub model
- More complex navigation to implement (breadcrumbs, back links, etc.)

---

### Option C — Hybrid (Recommended)

**Structure:** Hub landing at `/articole/` with:
- Featured content area (editorial front page)
- Section preview cards (2-3 items per section, "Toate →" link)
- Short sections fully embedded (Mituri, Glosar preview, FAQ)
- Rich sections linked to their own pages as content develops

**Pros:**
- Landing page has content and direction (editorial front door)
- MVP can launch with only the landing page (all sections in preview/placeholder state)
- Rich sections grow to separate pages without breaking the hub
- Patients who want a quick overview see the hub; those who go deep get dedicated pages
- Balances SEO (dense hub page) with shareability (individual section pages)
- Natural growth path: start as Option A (everything on hub), graduate rich sections to Option B as content matures

**Cons:**
- More architectural decisions upfront (which sections stay on hub, which get pages)
- Requires deciding the section-to-page graduation threshold
- Slightly more complex to implement than pure Option A

---

### Recommendation: **Option C — Hybrid**

The hybrid is the only model that can:
1. Launch before all content is ready (sections in preview/placeholder state)
2. Scale without a rebuild as content grows
3. Serve both the time-limited scanner (hub landing) and the engaged reader (section pages)

**Section graduation criteria:** A section gets its own page when its content exceeds what can be shown in a 3-item preview on the hub page. Currently, only Recuperare and Familia are likely to reach this threshold at launch. All others stay on the hub landing page.

**URL model:**

| Section | At launch | When graduated |
|---------|-----------|---------------|
| Prima Consultație | Hub section (full) | `/articole/prima-consultatie/` |
| Recuperare | Hub preview + page | `/articole/recuperare/` |
| Familie | Hub section (full) | `/articole/familie-apartinatori/` |
| Mituri | Hub section (full) | Stays on hub |
| Glosar | Hub section (preview) | `/articole/glosar/` |
| FAQ | Hub section (full) | Stays on hub |
| Video | Hub section | Stays on hub |
| Media | Hub section | Stays on hub |
| Instagram | Hub section | Stays on hub |
| Lectură | Hub section | Stays on hub |
| Articles grid | Hub section | Stays on hub |

---

## 7. Visual Direction

### Reference aesthetic

The hub must feel like the intersection of three reference points:

**Apple Health (iOS):** Information organized by category, not chronologically. Card-based. Each section is a distinct, navigable chapter. Metrics and content presented at the same quality level. No visual hierarchy accident — everything is intentional.

**Apple News editorial:** A front page curated by a human editor, not an algorithm. Featured story gets visual prominence. Category sections have strong headers. Content feels selected, not assembled.

**Notion documentation:** Clear visual hierarchy. Icons as section anchors. Callout blocks for critical information. Expandable sections for reference content. The reader can skim or go deep — the structure accommodates both.

### Visual language applied to Sfatul

**Hub landing page hierarchy:**

```
╔══════════════════════════════════════════════════════════════╗
║  HERO                              bg: #FFFFFF               ║
║  Overline: "Sfatul Neurochirurgului"  (sage, 11px uppercase) ║
║  H1: Sfatul Neurochirurgului           (Lora 700, 52px+)     ║
║  Lead: What this space is.             (Inter 400, 20px)     ║
╚══════════════════════════════════════════════════════════════╝

╔══════════════════════════════════════════════════════════════╗
║  HUB NAVIGATION STRIP              bg: #FFFFFF sticky        ║
║  [⬜ Prima consultație] [⬜ Recuperare] [⬜ Familie]           ║
║  [⬜ Mituri] [⬜ Glosar] [⬜ FAQ] [⬜ Video] [⬜ Media]       ║
╚══════════════════════════════════════════════════════════════╝

╔══════════════════════════════════════════════════════════════╗
║  FEATURED ARTICLE                  bg: #F5F5F7               ║
║  ┌──────────────────────────────────────────────────────┐   ║
║  │  COLOANA VERTEBRALĂ  · 7 min citire                  │   ║
║  │  [Article title in H2/Lora, large]                   │   ║
║  │  [Excerpt, 2 sentences]          [Citește articolul]  │   ║
║  └──────────────────────────────────────────────────────┘   ║
╚══════════════════════════════════════════════════════════════╝

╔══════════════════════════════════════════════════════════════╗
║  GHIDURI PENTRU PACIENȚI           bg: #FFFFFF               ║
║                                                              ║
║  [📋] Prima consultație    [🔄] Recuperare  [👨‍👩‍👧] Familie    ║
║  Guide cards with icon, title, brief description             ║
╚══════════════════════════════════════════════════════════════╝

[... sections continue alternating #FFFFFF / #F5F5F7 ...]
```

### Card types — specification

**1. Article card** (existing — `.gu-article-card`)
- Category tag (overline style, sage)
- H3 title (Lora 700, 18-20px)
- 2-line excerpt (Inter 400, 15px)
- Read time + "Citește articolul →"

**2. Guide card** (new — `.gu-guide-card`)
- Large icon (40px, sage stroke)
- H3 title (Lora 700, 18px)
- Description (Inter 400, 14px, 2 lines)
- Estimated time ("~10 min lectură" or "3 pași")
- Arrow link "Deschide ghidul →"

**3. Video card** (new — `.gu-video-card`)
- Thumbnail image (16:9, locally saved screenshot)
- Duration badge (top-right of thumbnail)
- Category tag
- H3 title
- "Vizionează pe YouTube →" (opens new tab)

**4. Myth card pair** (new — `.gu-myth-pair`)
- Left: myth card (amber left-border, warning tone)
  - "DEMONTĂM MITUL" overline
  - Myth statement in quotes
- Right: truth card (sage left-border, calm tone)
  - "ADEVĂRUL" overline
  - Truth statement
- Side-by-side at desktop, stacked at mobile

**5. Glossary term** (new — `.gu-glossary-term`)
- `<details>/<summary>` pattern (same as FAQ)
- Term: Inter 600, 16px
- Definition: Inter 400, 15px, lh 1.7
- Related link (if applicable)

**6. Media item** (new — `.gu-media-item`)
- Type badge (Presă / TV / Podcast / Conferință)
- Title / topic
- Publication or show name
- Date
- External link

**7. Resource/book card** (new — `.gu-resource-card`)
- Cover image or category icon
- Title (Inter 600, 16px)
- Author/Publisher (Inter 400, 14px, sage)
- 2-sentence description
- Link →

### Hub navigation strip

A horizontal pill navigation that sticks below the header when the user scrolls past the hero. Each pill: icon (20px) + label. Active state: sage background, white text. Inactive: transparent, graphite text.

```css
/* Concept — not for implementation yet */
.gu-hub-nav {
  position: sticky;
  top: 72px;       /* below fixed header */
  background: rgba(255,255,255,0.96);
  backdrop-filter: blur(8px);
  border-bottom: 1px solid rgba(0,0,0,.06);
  z-index: 100;
}
```

On mobile (≤768px): horizontally scrollable pill strip. No wrapping.

---

## 8. Content Journeys

### Journey 1 — The Anxious Patient (Google → Article → Hub)

```
ENTRY POINT: Google search
"hernie de disc lombară simptome" / "durere de spate care iradiaza in picior"
          ↓
ARTICLE PAGE: /articole/hernia-de-disc-lombara/
Informational, educational, plain language.
Patient reads, understands their possible condition.
At the bottom: Related Conditions card → /afectiuni/
At the bottom: "Pregătiți-vă pentru consultație" → Prima Consultație guide
          ↓
HUB GUIDE: Prima Consultație
Patient learns what to bring, what to expect, what to ask.
Anxiety reduced. Patient feels prepared.
At the end: "Programați o consultație" →
          ↓
/programari/
Patient arrives informed. Less repetition needed during consultation.
Conversion rate higher than cold arrival.
```

**Duration of journey:** 15-25 minutes across 3-4 pages  
**Trust built:** High — patient has read Dr. George's educational voice 3 times before booking

---

### Journey 2 — The Family Member (Direct → Hub → Guide → Booking)

```
ENTRY POINT: Direct navigation or referral from patient
"/articole/" or from Google: "cum să ajut pe cineva care se operează pe coloana"
          ↓
HUB LANDING: Sfatul Neurochirurgului
Family member scans hub. Sees "Pentru familie și aparținători."
This is exactly what they were looking for.
          ↓
FAMILY GUIDE: Familie și aparținători
Reads practical support guide. Reads FAQ for families.
Reads myth section: dispels fear about "operația pe coloana = invaliditate."
Shares myth article with patient.
          ↓
Patient + family member now aligned.
Family member convinces patient to book.
          ↓
/programari/
Two people now invested in the booking. Follow-through rate higher.
```

**Duration of journey:** 20-35 minutes  
**Trust built:** Very high — the site addressed their specific role and fear directly

---

### Journey 3 — The Post-Op Patient (Recovery Support)

```
ENTRY POINT: Internal — linked from discharge documentation or follow-up email
"Pentru recuperare, vă recomandăm: georgeungureanu.doctor/articole/recuperare/"
          ↓
RECOVERY GUIDE: Recuperare și îngrijire
Patient finds their procedure in the list.
Reads day-by-day timeline.
Checks warning signs list.
Bookmarks the page.
          ↓
Returns 3 times in recovery period.
FAQ section answers questions that would otherwise require a phone call.
Patient feels supported. Anxiety managed.
          ↓
Post-op control appointment kept.
Word of mouth: "His website has a great recovery guide."
→ New patient referrals
```

**Strategic value:** This journey reduces support burden on the clinic (fewer "normal?" calls), improves recovery outcomes (compliance with instructions), and generates word-of-mouth referrals.

---

### Journey 4 — The Informed Researcher (Validation Seeking)

```
ENTRY POINT: Branded search — "Dr. George Ungureanu"
          ↓
/despre/ — biography, credentials, philosophy
(Hub linked from about page: "Citiți sfaturile Dr. George Ungureanu")
          ↓
HUB LANDING: Sfatul Neurochirurgului
Researcher sees: well-organized educational hub. Not a blog.
Sees video section: watches Dr. George explain a condition.
Sees media section: press mentions and conference appearances.
          ↓
Researcher concludes: "This doctor maintains an active, authoritative presence."
E-E-A-T signal satisfied. Trust established.
          ↓
/programari/ or shares the site with their GP for referral
```

---

## 9. Section Priority and MVP Definition

### Launch-critical (must be present before push)

| Section | Why critical | Build status |
|---------|-------------|-------------|
| Hub landing page (redesigned) | The current flat list is not a hub | Not started |
| Prima Consultație | Immediate patient value; partially buildable from /programari/ content | Not started |
| FAQ (educational) | High-demand; distinct from booking FAQ | Not started |
| Article grid | Already functional; must be preserved in new layout | Functional |

### Important (build in Phase B/C; can be [CLIENT:] placeholder at launch)

| Section | Why important | Blocker |
|---------|--------------|---------|
| Mituri și adevăruri | High engagement potential; differentiating | 6-10 pairs from Dr. George |
| Glosar medical | Useful reference; SEO value | Term list from Dr. George |
| Familie și aparținători | Addresses underserved audience | Content review from Dr. George |

### Post-launch (requires content from Dr. George; launch as empty sections with clear coming-soon state)

| Section | Status |
|---------|--------|
| Video | Requires Dr. George's YouTube list |
| Media și apariții | Requires Dr. George's press list |
| Recuperare (procedure-specific) | Requires clinical content from Dr. George |
| Instagram Highlights | Requires Dr. George's post selection |
| Recomandări de lectură | Requires Dr. George's reading list |

### What NOT to ship at launch

A section with zero content and a "Coming soon" badge is **worse** than no section. It creates the same trust deficit as the empty credentials strip we removed from /programari/. A missing section harms nothing. An empty section signals abandonment.

**Rule:** Each section that appears on the hub page must have at least 2-3 real content items. If not, the section is omitted from the hub landing until content is ready.

---

## 10. Content Requirements from Dr. George

This section is written to be shared directly with the client.

### Priority 1 — Required to build any hub content

| # | Request | Format | Estimated time |
|---|---------|--------|---------------|
| H1 | Please confirm: is Prima Consultație content (what to bring, how to prepare, what to ask) approved as written in the current /programari/ page? Or should it be modified? | Review + approve/edit | 15-20 min |
| H2 | Please confirm: should the hub FAQ be separate from the /programari/ FAQ? If yes, what additional questions should be covered? | List of questions | 20-30 min |
| H3 | Review and approve the general hub structure (10 sections) and their order. Are any sections missing? Any should be removed? | Review | 20 min |

### Priority 2 — Required to build educational sections

| # | Section | What we need | Format |
|---|---------|-------------|--------|
| E1 | Mituri și adevăruri | 6-10 myth/truth pairs. Each: the myth as patients say it + the clinical truth in plain language | Numbered list: "Mitul: [...] / Adevărul: [...]" |
| E2 | Glosar medical | 20-30 terms with plain-language definitions. Starting terms: disc intervertebral, hernie de disc, stenoză spinală, laminectomie, microdiscectomie, radiculopatie, sciatalgie, RMN, CT, EMG | Word document or email, one term per paragraph |
| E3 | Familie și aparținători | What practical advice do you give families? What are the most common family questions you hear? | Free-text, any length — we will format it |
| E4 | Recuperare | For each published procedure (/interventii/): general recovery timeline, what patients can/cannot do at each stage, warning signs to watch for | One section per procedure; can be drafted by us and reviewed by you |

### Priority 3 — Required for media and social sections

| # | Section | What we need |
|---|---------|-------------|
| M1 | Video | List of YouTube video URLs you'd like featured, with a brief description of each |
| M2 | Media | List of press, podcast, and conference appearances — title, publication/show, date, link if available |
| M3 | Instagram | 6-9 Instagram posts you'd like to curate for the hub — we'll save screenshots and write captions |
| M4 | Recomandări de lectură | 5-8 books or resources you would recommend to patients — title, author, why you recommend it in 1-2 sentences |

---

## 11. Implementation Roadmap

### Phase A — Information Architecture (this document)

**Goal:** Finalize the hub structure, section priority, and MVP definition.  
**Deliverable:** This document.  
**Effort:** 2 hours (completed)  
**Blocker:** Approval from Dr. George on hub section list and priority

---

### Phase B — Hub Landing Page Rebuild

**Goal:** Replace the current flat article archive with a structured editorial hub page.  
**Effort:** 4-6 hours  
**Risk:** Low — additive; article CPT and existing archive shortcode preserved

**Tasks:**

| Task | Method | Estimate |
|------|--------|----------|
| B1. Hub hero section | PHP shortcode: updated overline, H1, lead paragraph | 20 min |
| B2. Hub navigation strip | PHP shortcode: `[gu_hub_nav]` — horizontal pill nav, sticky, anchor links | 45 min |
| B3. Featured article treatment | PHP: pull most recent `articole` post, render as large hero card | 45 min |
| B4. Guide cards section (patient guides) | PHP: 3 guide cards (Prima Consultație, Recuperare, Familie) with [CLIENT:] state for unfilled sections | 45 min |
| B5. Section preview framework | PHP: reusable section-preview wrapper with icon, H2, lead, content grid, "see all" link | 30 min |
| B6. Prima Consultație section (full, on hub) | PHP: steps-based guide using existing content from /programari/ as foundation | 60 min |
| B7. Educational FAQ section | PHP: broader FAQ using `<details>/<summary>`, categorized | 45 min |
| B8. Myth card component (placeholder) | PHP + CSS: myth/truth pair cards with [CLIENT:] placeholders | 45 min |
| B9. Glosar preview (placeholder) | PHP: glossary term accordion, 2-3 sample entries + [CLIENT:] box | 30 min |
| B10. Video section (coming soon) | PHP: section header + placeholder state | 20 min |
| B11. Media section (coming soon) | PHP: section header + placeholder state | 20 min |
| B12. CSS: guide card, myth card, video card, media item | All new components in new CSS section | 60 min |
| B13. Article grid preserved | Existing `[gu_articole_archive]` shortcode, repositioned in hub | 10 min |
| B14. Sync + Playwright QA | rsync + extended QA script | 45 min |

**Total Phase B:** 4.5–6 hours

**Phase B QA gates:**
- Hub page loads with all sections (including placeholder state for empty sections)
- Hub navigation strip is visible and all anchor links work
- Featured article card renders correctly
- Prima Consultație section renders fully
- No horizontal overflow at any viewport
- Article grid continues to work correctly
- All other pages unaffected (regression check)

---

### Phase C — Educational Section Content Population

**Goal:** Replace [CLIENT:] placeholders with real content as Dr. George provides it.  
**Effort:** 1-2 hours per section (after content received)  
**Risk:** Very low — PHP array updates; no structural changes

| Phase | Section | When | Trigger |
|-------|---------|------|---------|
| C1 | Mituri și adevăruri | After E1 from Dr. George | Add myth/truth pairs to PHP array |
| C2 | Glosar medical | After E2 from Dr. George | Add terms to PHP array |
| C3 | Familie și aparținători | After E3 from Dr. George | Update section content |
| C4 | Recuperare | After E4 from Dr. George | Build recovery guide per procedure |

---

### Phase D — Video, Media and Social Modules

**Goal:** Add curated external content to the hub.  
**Effort:** 2-3 hours  
**Risk:** Low — new shortcode sections, no existing functionality changed

| Task | Trigger |
|------|---------|
| Video section | After M1 (Dr. George's YouTube list) |
| Media section | After M2 (press/podcast list) |
| Instagram highlights | After M3 (post selection) |
| Recomandări de lectură | After M4 (reading list) |

---

### Phase E — Cross-linking and SEO

**Goal:** Connect the hub to the rest of the site. Make the educational content findable and link-worthy.  
**Effort:** 2-3 hours  
**Risk:** Low

| Task | What it does |
|------|-------------|
| E1. Article → Prima Consultație link | Add "Pregătiți-vă pentru consultație →" callout at the bottom of all article singles |
| E2. /afectiuni/ singles → hub | Add "Citiți ghidul de recuperare →" link on condition singles that have a related procedure |
| E3. /interventii/ singles → Recuperare | Add "Recuperare după [procedură] →" link on procedure singles |
| E4. /despre/ → hub | Add "Citiți sfaturile Dr. George Ungureanu →" link from biography section |
| E5. Schema for guides | Add `HowTo` schema to Prima Consultație, `FAQPage` to FAQ sections, `DefinedTerm` to Glosar |
| E6. Breadcrumbs for sub-pages | Add breadcrumb nav for `/articole/recuperare/` etc. |

---

## 12. Risk Assessment

### Risk 1 — Content dependency (HIGH probability, HIGH impact)

Most hub sections cannot reach final state without specific content from Dr. George. Building the architecture before content exists is the right call (structure enables content), but each section must have a clear, honest placeholder state that does not look broken.

**Mitigation:** Every section has two states — "content ready" and "content pending." The pending state is designed to look intentional (e.g., "Ghid de recuperare — în pregătire. Contactați clinica pentru informații.") — not empty.

### Risk 2 — Scope creep (MEDIUM probability, MEDIUM impact)

10 sections is ambitious. Without discipline, Phase B becomes Phase B + Phase C + Phase D, all at once. This creates an unreviewable sprint.

**Mitigation:** Strict phase boundaries. Phase B delivers the hub shell with placeholder states. Content population happens in Phase C only after Dr. George's input arrives.

### Risk 3 — Elementor cache (LOW probability, HIGH impact — documented)

Sprint 9.9A identified three Elementor cache layers that survive `_elementor_data` DB changes. The hub rebuild uses the same shortcode approach (no Elementor data involved), so this risk is reduced. However, if any Elementor-rendered elements are modified, all three caches must be cleared.

**Mitigation:** Document the cache-clearing procedure. Run Playwright QA after every sync to catch cache staleness.

### Risk 4 — URL changes (LOW probability, HIGH impact)

The current `/articole/` URL must not change. Any sub-pages created for graduated sections must use `/articole/{slug}/` prefixes to avoid confusion with the CPT archive (`/articole/hernia-de-disc-lombara/`).

**Mitigation:** Use WordPress page slugs that are clearly non-article (e.g., `/articole/prima-consultatie/`, `/articole/recuperare/`). These will not conflict with the CPT's flat URL structure.

### Risk 5 — Photography absence (LOW probability, MEDIUM impact)

The hub will be significantly more compelling when it includes Dr. George's photo (in the author byline, in the hub hero area, in the guide cards). The current state without photography can still launch — but photography remains the single highest-ROI asset change possible.

---

## 13. Decisions Required Before Phase B Implementation

| # | Decision | Options | Recommendation |
|---|----------|---------|---------------|
| D1 | Hub structure approved? | (a) As proposed in this document (b) Modified | Awaiting Dr. George |
| D2 | Navigation model confirmed? | Option A / B / **C (Hybrid)** | Option C — see Section 6 |
| D3 | Which sections appear on hub at launch vs. separate pages? | See Section 9 priority table | Prima Consultație + FAQ on hub; Recuperare gets a page |
| D4 | [CLIENT:] sections: show placeholder or omit? | (a) Show "in preparation" placeholder (b) Omit section entirely | Show placeholder — absence implies nothing; placeholder implies coming |
| D5 | Featured article: most recent post or manually pinned? | (a) Most recent (automatic) (b) Manual pin via ACF field | Manual pin preferred (requires `pin_to_hub` boolean ACF field) |
| D6 | Hub navigation strip: icons or text only? | (a) Text pills only (b) Icon + text | Icon + text — 20px icons add visual anchors without cost |

---

## Summary

| Element | Status |
|---------|--------|
| Planning document | Complete — this document |
| Phase B (hub rebuild) | Ready to implement after approval |
| Phase C (content population) | Blocked on Dr. George's content |
| Phase D (media/social modules) | Blocked on Dr. George's content |
| Phase E (cross-linking) | Blocked on Phase B |
| Decisions D1-D6 | Awaiting approval |

The hub can be built to MVP state with Phase B alone — a structured, navigable educational hub with genuine content in the core sections (Prima Consultație, FAQ) and clear placeholder states for content-dependent sections. This is a meaningful upgrade from the current state (renamed flat archive + 1 article).

---

> **Do not publish AI-generated medical content without explicit human review.**  
> **Do not implement anything from this document without explicit approval.**

*This document is a planning and information architecture exercise only. No code has been written or modified as part of its creation.*
