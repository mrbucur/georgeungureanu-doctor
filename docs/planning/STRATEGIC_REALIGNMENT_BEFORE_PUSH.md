# Strategic Realignment Before Remote Push
**Sprint:** 9.8 — Phase 1: Diagnostic & Plan Only  
**Date:** 2026-07-01  
**Git state:** Clean — commit `d4a31f9` (Sprint 9.7C, 16 files, 8541 insertions)  
**Status:** AWAITING APPROVAL — do not implement anything from this document without explicit sign-off  
**Roles synthesized:** Senior Product Strategist · Healthcare UX Designer · Brand Architect · Patient Journey Specialist · WordPress/Elementor Technical Lead

---

## Purpose

Before the first push to a remote repository, this document answers three questions:

1. **Where have we drifted** from the original strategic vision — and why?
2. **What is the correct state** the site should be in before staging goes live?
3. **How do we close the gap** — in what order, at what risk?

This is a plan. Nothing in this document should be built until each section is approved.

---

## 1. Drift Analysis — How We Got Here and What Went Wrong

### 1.1 The original vision (Sprints 1–7)

The planning suite established a clear product strategy:

- **A single neurosurgeon's digital presence** — not a clinic portal, not a content farm. One physician, one voice, earned authority.
- **Three-stage patient journey:** Learn (Sfatul Neurochirurgului articles) → Understand (Afecțiuni / Intervenții pages) → Book (/programari/)
- **Trust architecture:** Recomandări as a trust pillar (colleague-first), Despre for deep biography, Sfatul for patient education
- **Editorial philosophy:** Patient-centered, honest about uncertainty, no outcome promises, no fake metrics
- **Visual direction:** Restraint. Negative space. Precision typography. Warm but not clinical; confident but not boastful.

### 1.2 Where and how drift occurred

**Drift 1 — Visual: from restraint to heavy and warm**

Sprints 8–9.6 progressively darkened and warmed the site. Dark brown hero sections (`rgb(35,30,26)`) were introduced for "impact," warm beige surfaces (`#F4EFE6`) dominated, and sections that were meant to breathe became dense and heavy. The cumulative effect was a site that felt warmer than modern private healthcare and darker than the restrained confidence the brand required.

Sprint 9.7 corrected this via the Apple Health pivot. The correction is correct and should be locked as the design direction.

**Drift 2 — Brand: "Articole" displaced "Sfatul Neurochirurgului"**

At some point the public label for the educational hub reverted from the brand-correct "Sfatul Neurochirurgului" to the technical label "Articole" — the internal CPT name leaking into the UI. Sprint 9.7B restored the brand label throughout nav, archive hero, breadcrumbs, and footer.

**Drift 3 — Structure: Programări became a credentials page**

The booking page accumulated content that belongs on /despre/: years of experience, intervention counts, training summaries, biography excerpts. This creates two problems:
- Credential overload on the booking page confuses the patient's intent (they are there to book, not to evaluate)
- It duplicates content from /despre/, diluting both pages

**Drift 4 — Missing pages: Recomandări was absent**

The nav architecture always included Recomandări as a fifth pillar. The page did not exist. Sprint 9.7C restored it. The page now exists with correct placeholder structure.

**Drift 5 — Sfatul hub: remained an article list, never became a hub**

The original vision for Sfatul Neurochirurgului (KNOWLEDGE_CENTER_ARCHITECTURE.md) was a full educational hub: articles, video, curated social content, FAQ, patient guides (Prima consultație, Recuperare, Familie/aparținători), glossary, myth-busting, and a media section. What was built is a functional article archive — correct infrastructure, but not yet the hub.

**Drift 6 — Design token inconsistency: two systems in conflict**

The DESIGN_MODERNIZATION_PLAN (Sprint 8.2) documented the warm Scandinavian palette as the "do not change" baseline: `#FDFBF7`, `#231E1A` warm ink, `#4D7A70` sage. Sprint 9.7 superseded this with the Apple Health system. The two systems now coexist in the CSS, with Section 28 overriding earlier sections. The override approach is correct for the transition, but the CSS needs a consolidation pass before public launch.

### 1.3 What is working and must not be touched

| Element | Status | Notes |
|---------|--------|-------|
| Lora + Inter typeface pairing | ✓ Keep | Correct — warm serif for headings, precise sans for body |
| CPT architecture (afectiuni, interventii, articole) | ✓ Keep | Correct — no structural changes |
| ACF field groups (group_mc, group_sp, group_ar) | ✓ Keep | Correct — no changes |
| Nav structure: 6 items + CTA | ✓ Keep | Implemented in Sprint 9.7C — final form |
| Apple Health token set (Section 28a) | ✓ Keep | Direction is correct — codify as canonical |
| Recomandări page structure and philosophy | ✓ Keep | Sprint 9.7C — trust pillar correctly built |
| Schema architecture (Physician, MedicalCondition, etc.) | ✓ Keep | Sprint 7B — no changes |
| Shortcode-based content system | ✓ Keep | PHP shortcodes over Elementor widgets — maintainable, correct |
| Patient journey: Article → Condition → Procedure → Booking | ✓ Keep | Core architecture — do not change |

---

## 2. Apple Health Visual Direction — Codified and Locked

### 2.1 Why the Apple Health direction is correct for this practice

Dr. George's practice is premium, private, and precise. Patients arrive anxious; they need calm, not warm. The Apple Health/Fitness reference — clean white surfaces, graphite text, restrained blue-green accents, iOS Health-style floating cards — communicates:

- Clinical competence without intimidation
- Premium without ostentation
- Calm without coldness

The warm Scandinavian palette (beige, ivory, dark warm ink) reads as "traditional private practice." The Apple Health palette reads as "modern precision medicine." The latter is the correct brand position for a neurosurgeon who is younger than the median specialist, practices minimal-invasion techniques, and wants to attract educated, researching patients.

### 2.2 Canonical Apple Health token set (from Section 28a — now the master reference)

```css
:root {
  /* Canvas */
  --color-canvas:        #F5F5F7;   /* Apple cool grey — page background */
  --color-surface:       #FFFFFF;   /* Pure white — card surfaces, hero sections */
  --color-surface-alt:   #FBFBFD;   /* Barely-there blue-white — alternating sections */

  /* Ink */
  --color-ink:           #1D1D1F;   /* Apple graphite — all primary text */
  --color-ink-secondary: #6E6E73;   /* Apple secondary grey — descriptions, captions */
  --color-ink-tertiary:  #86868B;   /* Apple tertiary grey — timestamps, metadata */

  /* Accent */
  --color-accent:        #3D6B5E;   /* Muted sage-green — restrained, supporting role */
  --color-accent-hover:  #2D5048;   /* Darkened on hover */
  --color-accent-subtle: rgba(61,107,94,0.08); /* Background tint for tags/badges */

  /* Borders */
  --color-border:        rgba(0, 0, 0, 0.06);  /* Standard dividers */
  --color-border-strong: rgba(0, 0, 0, 0.12);  /* On-hover, separators */

  /* Shadows — neutral, never warm-tinted */
  --shadow-sm: 0 1px 4px rgba(0, 0, 0, 0.06), 0 0 0 1px rgba(0, 0, 0, 0.04);
  --shadow-md: 0 4px 16px rgba(0, 0, 0, 0.08), 0 1px 3px rgba(0, 0, 0, 0.04);
  --shadow-lg: 0 8px 32px rgba(0, 0, 0, 0.10), 0 2px 8px rgba(0, 0, 0, 0.06);
}
```

**DEPRECATED (must not appear in new CSS):**

| Old token / value | Reason | Replacement |
|-------------------|--------|-------------|
| `#F4F2EF` warm off-white canvas | Too warm, beige | `#F5F5F7` |
| `#FDFBF7` warm ivory surface | Too warm | `#FFFFFF` |
| `#F4EFE6` warm surface alt | Too warm, beige | `#FBFBFD` or `#F5F5F7` |
| `#1C1814` / `#231E1A` warm near-black | Too warm, not Apple | `#1D1D1F` |
| `#68615C` warm secondary grey | Too warm | `#6E6E73` |
| `rgba(28,24,20,...)` warm shadow tint | Too warm | `rgba(0,0,0,...)` |
| `rgb(35,30,26)` dark brown | Sprint 9.7 removed — never use again | `#FFFFFF` or `#F5F5F7` |
| `#4D7A70` warm sage | Slightly too warm / blue-heavy | `#3D6B5E` |

### 2.3 What the Apple Health direction means in practice

**Page backgrounds:** Body always `#F5F5F7`. Content sections alternate between `#FFFFFF` and `#F5F5F7`. Never dark, never warm beige.

**Cards:** White (`#FFFFFF`) floating surfaces on grey canvas (`#F5F5F7`). `border-radius: 12px`. Shadow: `var(--shadow-sm)`. No card borders on light surface — shadow provides containment. On hover: `var(--shadow-md)` + subtle lift (`translateY(-2px)`).

**Typography:** `#1D1D1F` for all headings and body. `#6E6E73` for secondary text. The graphite-on-white contrast is clean and precise — not harsh like pure black, not warm like the old ink.

**Accent color:** `#3D6B5E` sage green is the one accent color. It appears on: CTA buttons, active nav states, category tags, icon strokes. It should be restrained — a supporting voice, not a dominant presence. Do not introduce additional accent colors.

**Buttons on light backgrounds:** Background `#3D6B5E`, text `#FFFFFF`. Hover: `#2D5048`. Radius: 12px (matching card radius — the update from 6px to 12px happened with the Apple Health pivot).

**Buttons on dark backgrounds:** If any dark section reappears (none currently), use white button. Currently N/A.

### 2.4 What the Apple Health direction does NOT mean

- It does not mean cold or clinical. `#1D1D1F` on `#FFFFFF` is warm compared to `#000000` on `#FFFFFF`.
- It does not mean no photography. When Dr. George's photo is available, it will warm the site significantly. The current clean-white palette is optimized for the photography-absent state.
- It does not mean no Lora serif. The Lora headings remain — they are the warmth in the system when photography is absent.
- It does not mean the site should look like Apple.com. It means: adopt the whitespace discipline, the typographic restraint, and the neutral shadow system. The content and typography remain distinctly medical and Romanian.

---

## 3. Sfatul Neurochirurgului Hub Restoration

### 3.1 Current state

The `/articole/` CPT and archive are functional. The nav label "Sfatul Neurochirurgului" correctly points to `/articole/`. One published article exists (`hernia-de-disc-lombara`). The archive page renders the article grid via `[gu_articole_archive]`.

What exists is the infrastructure for written content — not the hub.

### 3.2 The hub vision (from KNOWLEDGE_CENTER_ARCHITECTURE.md + Sprint 9.8 brief)

The Sfatul Neurochirurgului section should be Dr. George's authoritative educational voice across all formats, not just written articles. The hub organizes all patient-facing educational content by type and audience.

**Proposed hub architecture:**

```
/articole/                              ← Archive = Hub Home
  ├── Written Articles                  ← CPT articole (existing)
  ├── Video (Dr. George explains)       ← Curated, manually approved
  ├── YouTube (curated playlist)        ← Embedded, manually selected
  ├── IG / FB Educational Posts         ← Curated excerpts, manual approval
  ├── Prima Consultație               ← Static guide (patient prep)
  ├── Recuperare                        ← Static guide (post-op recovery)
  ├── Familie și Aparținători           ← Static guide (for family members)
  ├── Glosar Medical                    ← Glossary (expandable)
  ├── Mituri și Adevăruri              ← Myth-busting series
  └── Media Hub                         ← Press, TV, interviews
```

### 3.3 Content curation philosophy — critical constraint

**All social and video content must be manually curated by Dr. George or a designated editor. No raw live social feeds. No API auto-sync. No third-party widgets that pull content automatically.**

Rationale:
- A raw Instagram feed will pull every post, including casual/personal content that does not belong on a medical website
- Medical authority is undermined by unreviewed content appearing next to clinical information
- GDPR: patients appearing in unmoderated social content creates liability

The approved curation workflow:
1. Dr. George (or designated editor) selects a post/video for the hub
2. The item is embedded or linked manually, with an approved caption
3. The item is reviewed for clinical accuracy before it goes live
4. Seasonal or time-sensitive content is reviewed and updated periodically

### 3.4 Hub sections — implementation approach

All hub sections are implemented as PHP shortcodes within the existing archive page template. No new CPTs, no ACF changes, no Elementor template rebuilds.

**Section: Video (Dr. George Explains)**

A curated grid of embedded video cards. Each card: thumbnail (screenshot), title, duration, short description. Clicking opens the video in a lightbox or navigates to a video page.

- Implementation: `[gu_hub_video]` shortcode, content stored as PHP array in plugin (editable via plugin update)
- Content needed: [CLIENT: Dr. George to provide video list with titles, YouTube IDs, descriptions]
- Design: White card grid on `#F5F5F7` canvas, 2-column at desktop, 1-column at mobile

**Section: YouTube Curated**

Not an embedded YouTube channel widget — a manually curated set of recommended videos (Dr. George's own, or referenced expert talks he endorses). Displayed as styled link cards, not iframes (avoids GDPR cookie consent complexity for auto-loading embeds).

- Implementation: `[gu_hub_youtube]` shortcode, PHP array
- Content needed: [CLIENT: Dr. George to select and approve video list]

**Section: IG / FB Educational Posts**

Selected educational posts from Instagram or Facebook. Displayed as text-and-image excerpts — not live social embeds. Each entry: post date, post text (manually copied), link to original post. Optional: screenshot image.

- Implementation: `[gu_hub_social]` shortcode, PHP array
- Content needed: [CLIENT: Dr. George to select posts for curation]
- Note: Do NOT use Meta embed widgets — they load tracking scripts and require user consent per GDPR

**Section: Prima Consultație (First Consultation Guide)**

A structured patient guide answering: What to bring. What to expect. How long does it take. What happens next. This content is static editorial copy — written once, reviewed by Dr. George, published.

- Implementation: `[gu_hub_prima_consultatie]` shortcode
- Design: Full-width editorial section with numbered steps, checkboxes for "bring list"
- Content needed: [CLIENT: Dr. George to write or approve this content]

**Section: Recuperare (Recovery)**

Patient guides for the post-operative period. General guidance first, then links to specific /interventii/ pages for procedure-specific recovery. Honest about timelines, does not over-promise.

- Implementation: `[gu_hub_recuperare]` shortcode
- Design: Editorial section with accordion for different procedure types
- Content needed: [CLIENT: Dr. George to write or approve recovery guidance]

**Section: Familie și Aparținători (Family and Caregivers)**

Educational content for the patient's support network. Answers: How can I help. What should I know. How to ask the right questions. What to expect in the waiting room.

- Implementation: `[gu_hub_familie]` shortcode
- Content needed: [CLIENT: Dr. George to write or approve this section]

**Section: Glosar Medical (Medical Glossary)**

Definitions of medical terms used throughout the site. Alphabetical, expandable (accordion). Each term links to relevant /afectiuni/ or /interventii/ pages where appropriate.

- Implementation: `[gu_hub_glosar]` shortcode
- Content needed: [CLIENT: Dr. George or editor to compile term list; can start with 20–30 terms]
- Design: Alphabetical accordion, clean, no decoration

**Section: Mituri și Adevăruri (Myths and Truths)**

Short myth-busting entries on common neurosurgical misconceptions. Format: Myth (in patient language) → Truth (clinical correction in plain language). Each entry reviewed by Dr. George.

- Implementation: `[gu_hub_mituri]` shortcode
- Content needed: [CLIENT: Dr. George to contribute 6–10 myth/truth pairs]
- Design: Two-column card pair at desktop, stacked at mobile

**Section: Media Hub**

Press mentions, TV appearances, online interviews. Link cards with: publication logo, article title, date, short description. Opens in new tab.

- Implementation: `[gu_hub_media]` shortcode
- Content needed: [CLIENT: Dr. George to compile media list]

### 3.5 Hub page structure (proposed section order)

The archive at `/articole/` becomes a structured hub page, not a flat article list. Proposed flow:

```
1. Hero — "Sfatul Neurochirurgului" — existing, already styled
2. Hub navigation strip — tabs or jump links to hub sections (articles, video, guide, etc.)
3. Featured Article — most recent or pinned article, full-width
4. Article Grid — [gu_articole_archive] — existing shortcode
5. Video Section — [gu_hub_video] — new
6. Patient Guides — 3 cards: Prima consultație, Recuperare, Familie — [gu_hub_guides_nav]
7. Mituri și Adevăruri — [gu_hub_mituri] — new
8. Glosar Medical — [gu_hub_glosar] — new
9. Media Hub — [gu_hub_media] — new
10. CTA — "Programează o consultație" — existing pattern
```

### 3.6 Phased approach

The hub rebuild does not need to be completed before push. The minimum viable hub:
- Phase B.1: Article grid (already done)
- Phase B.2: Hub navigation strip + Prima Consultație guide
- Phase B.3: Remaining sections (video, social, glossary, etc.) — after George's content

---

## 4. Programări Simplification

### 4.1 Current problem

The Programări page has accumulated credential content that belongs on /despre/. Patients arriving at `/programari/` have already done their evaluation — they know who Dr. George is. They need to know **where to go** and **how to book**. Loading them with credentials at this stage creates friction.

Content that must be removed from this page:
- Years of experience / career statistics
- Intervention counts / surgical volume
- Training history / education summary
- Biography excerpt / personal story
- Philosophy of care (belongs on /despre/)

### 4.2 Target page structure

**Section 1 — Hero: Reassurance**

Calm, reassuring. Not promotional. The tone is: "You've made a good decision. Here's how we get started."

- H1: "Programați o consultație" (or "Vă așteptăm" — client decides)
- Subheading: 1–2 sentence reassurance ("Prima consultație durează 45–60 de minute...")
- Cities prominently visible: **Cluj-Napoca · Baia Mare** (or whatever the confirmed cities are — awaiting Q13)
- No credentials, no statistics

**Section 2 — Unde consulț Dr. George (Clinic Cards)**

One card per location. Each card:

```
┌────────────────────────────────────────────────┐
│  [Clinic / hospital photo — 16:9]              │
│                                                │
│  [CLINIC NAME]                    Cluj-Napoca  │
│  ─────────────────────────────────────────────│
│  [1–2 sentence description of the clinic       │
│   and what type of consultations happen here]  │
│                                                │
│  [ Programează la această locație  → ]         │
│                                                │
│  [Embedded map — static Google Maps image,     │
│   with link to full directions]                │
└────────────────────────────────────────────────┘
```

Content needed (Q13 blockers):
- [CLIENT: clinic/hospital name, address, city for each location]
- [CLIENT: clinic photo for each location — or placeholder]
- [CLIENT: booking link or phone number per location]
- [CLIENT: brief description of each location]

Design: White cards on `#F5F5F7` canvas. `border-radius: 16px`. `box-shadow: var(--shadow-md)`. 2-column grid at desktop, 1-column at mobile.

**Section 3 — Ce să aduci (What to Bring)**

Practical checklist. Reduces patient anxiety. Short, scannable.

```
Înainte de consultație, aduceți cu dumneavoastră:
☐ Rezultatele investigațiilor recente (RMN, CT, radiografii)
☐ Scrisori medicale de la medicul de familie sau alt specialist
☐ Lista medicamentelor pe care le luați în prezent
☐ Întrebările dumneavoastră — nu există întrebări greșite
```

Design: `#F5F5F7` section with clean icon-list layout. No cards needed — editorial list works.

Content: Can be written now — this is generic enough for any neurosurgical consultation. Pending Dr. George's review.

**Section 4 — Consultație Online** *(conditional — only if Dr. George offers online consultations)*

If yes: Brief explanation of how it works, what is included, what is not. Link to online booking.
If no: Section omitted entirely.

[CLIENT: Does Dr. George offer online/teleconsultations? If yes, please describe the format.]

**Section 5 — Întrebări Frecvente (FAQ)**

5–7 patient booking questions. Reduces pre-appointment anxiety. Suggested questions:

1. Cât durează o consultație inițială?
2. Ce se întâmplă dacă am nevoie de investigații suplimentare?
3. Pot veni cu un aparținător?
4. Cum pot reprograma sau anula?
5. Acceptați trimitere de la medicul de familie?
6. Prețul consultației și metode de plată

Design: Clean accordion. No schema needed here (FAQ schema is higher-value on article pages).

Content: [CLIENT: Dr. George to review and approve answers]

**Section 6 — CTA (Final)**

"Pregătiți să faceți primul pas?" + booking button. Simple, calm.

### 4.3 What the new structure removes from its current state

The current Programări page was built with Elementor and contains credential and biography content. The removal and restructuring requires:
- PHP: rewrite the `[gu_programari_page]` shortcode (or equivalent) to output the new structure
- CSS: clinic card component (new), booking checklist list style (new), FAQ accordion (existing pattern)
- No Elementor template edits needed if content is fully shortcode-based

### 4.4 Why this makes the page convert better

When a patient arrives at `/programari/`:
- They already trust Dr. George (they visited /articole/, /afectiuni/, /despre/, or /recomandari/)
- They need practical information: WHERE, WHEN, HOW MUCH, WHAT TO BRING
- Every credential section at this stage is friction — it delays the booking action
- The clinic card + map model answers all spatial questions at a glance
- The "What to bring" checklist reduces pre-appointment anxiety, which increases follow-through

---

## 5. Navigation — Final Proposal

The navigation is already correct as of commit `d4a31f9`. No structural changes needed.

```
┌─────────────────────────────────────────────────────────────────────┐
│  [GU logo]   Acasă  Afecțiuni  Intervenții  Sfatul Neurochirurgului │
│                                      Recomandări  Despre            │
│                               [ Programează o consultație → ]       │
└─────────────────────────────────────────────────────────────────────┘
```

**Rationale for each item:**

| Nav item | Destination | Patient intent served |
|----------|-------------|----------------------|
| Acasă | `/` | Orientation, first impression |
| Afecțiuni | `/afectiuni/` | "What condition do I have?" |
| Intervenții | `/interventii/` | "What procedure might I need?" |
| Sfatul Neurochirurgului | `/articole/` | "I want to learn / read educational content" |
| Recomandări | `/recomandari/` | "What do other doctors and patients say?" |
| Despre | `/despre/` | "Who is this doctor?" |
| [CTA button] | `/programari/` | "I'm ready to book" |

**Pending polish (not structural changes):**

- Header button font-weight: currently Elementor's `elementor-size-xs` renders at weight 400. Should be 600 (semibold) to read as a proper CTA.
- Header button border-radius: verify it matches the Apple Health 12px radius system
- Mobile drawer active state: verify the currently-active page is highlighted in the drawer

---

## 6. Page-by-Page Correction Audit

### 6.1 `/` — Homepage

| Issue | Priority | Source | Action |
|-------|----------|--------|--------|
| Hero stat strip: years/interventions — placeholder values | P1 before push | Q13 blocker | [CLIENT: provide real numbers] |
| Hero photo: placeholder still showing | P1 before push | Q7a blocker | [CLIENT: provide photo] |
| Specialty cards: no SVG icons | P2 — post-launch | DESIGN_MODERNIZATION_PLAN §8 | Phase B.3 or post-launch |
| "O abordare diferită" cards: left-border accent pattern | P2 | DESIGN_MODERNIZATION_PLAN §6 | Phase A or B |
| Bio teaser section: photo placeholder matches /despre/ | P2 | Unified placeholder design | Phase B |
| Archive grid: auto-fill for single card | P1 before push | DESIGN_MODERNIZATION_PLAN §7 | Phase A CSS fix |

### 6.2 `/afectiuni/` — Conditions Archive

| Issue | Priority | Action |
|-------|----------|--------|
| 1 card in 3-column grid (empty shelf effect) | P1 before push | `auto-fill` CSS fix — 10 minutes |
| Hero: Apple Health styled ✓ | — | No action |
| Content: only 1 condition published | Post-launch | Add more conditions after push |

### 6.3 `/afectiuni/hernie-de-disc-lombara/` — Single Condition

| Issue | Priority | Action |
|-------|----------|--------|
| Related articles section: links to /articole/ items | P2 | Depends on more articles being published |
| CTA: Apple Health styled ✓ | — | No action |
| Hero: Apple Health styled ✓ | — | No action |
| Tablet overflow (934px): Elementor container | Pre-existing | DB edit required — Phase A or deferred |

### 6.4 `/interventii/` — Procedures Archive

Same as `/afectiuni/` — same auto-fill fix needed, same single-card problem.

### 6.5 `/interventii/microdiscectomie-lombara/` — Single Procedure

| Issue | Priority | Action |
|-------|----------|--------|
| CTA button: audit for color compliance (Sprint 9.7 / DESIGN_MODERNIZATION_PLAN B4) | P1 | Playwright check → CSS fix if needed |
| Hero: Apple Health styled ✓ | — | No action |

### 6.6 `/articole/` — Sfatul Hub Archive

| Issue | Priority | Action |
|-------|----------|--------|
| Currently a plain article list, not a hub | P1 | Phase B hub rebuild |
| Archive h1 renamed "Sfatul Neurochirurgului" via JS ✓ | — | Working |
| 1 card in grid → auto-fill fix | P1 before push | Phase A CSS fix |

### 6.7 `/articole/hernia-de-disc-lombara/` — Single Article

| Issue | Priority | Action |
|-------|----------|--------|
| Related conditions/procedures: needs more published content | Post-launch | Add content after push |
| Mobile overflow (471px): pre-existing | Pre-existing | DB edit required — deferred |
| Author block: photo placeholder | P2 | Monogram placeholder already in place |

### 6.8 `/programari/` — Booking

| Issue | Priority | Action |
|-------|----------|--------|
| Credential overload on booking page | P1 before push | Phase A: shortcode rewrite |
| Clinic cards: needs Q13 location data | P1 blocker | [CLIENT: provide location data] |
| FAQ content: needs George review | P1 | [CLIENT: review and approve] |
| Tablet overflow (774px): Elementor form | Pre-existing | DB edit required — can fix in Phase A or defer |

### 6.9 `/recomandari/` — Recommendations

| Issue | Priority | Action |
|-------|----------|--------|
| All content [CLIENT:] — colleague cards, patient section | P1 before push | [CLIENT: see Sprint 9.7C content requirements] |
| Page structure and philosophy: correct ✓ | — | No action |
| Mobile minor overflow (395px): design choice | Note | Acceptable — not a structural error |

### 6.10 `/despre/` — About

| Issue | Priority | Action |
|-------|----------|--------|
| Hero photo: placeholder | P1 before push | Q7a blocker |
| Philosophy section: needs George's own words | P1 before push | [CLIENT: write or dictate] |
| Education / training timeline: empty | P1 before push | [CLIENT: complete Content Input Form Appendix A] |
| Research / memberships: conditional on content | P2 | Include only if Dr. George provides |
| `#physician` anchor (`id="physician"` on hero element) | P1 before push | Verify and set if missing |
| Apple Health light backgrounds ✓ | — | Sprint 9.7 applied |

---

## 7. Implementation Plan

### Phase order rationale

Phase A must come first because Programări is a live blocker — it currently has the wrong content structure. Phase B (hub) can run in parallel but is content-blocked. Phase C (CSS cleanup) can run any time. Phase D (header polish) is fast and can close Phase C. Phase E is the final gate before push.

---

### Phase A — Programări Simplification

**Goal:** Remove credential overload, install location-focused booking experience  
**Estimated effort:** 3–4 hours  
**Blockers:** Q13 location data (can build structure with placeholders, fill content when data arrives)  
**Risk:** Low — shortcode-based, no Elementor template edits

| Task | Method | File | Time |
|------|--------|------|------|
| A1. Rewrite `[gu_programari_page]` shortcode | PHP: remove credential sections, add clinic cards, checklist, FAQ, online consult | `gu-design-system.php` | 90 min |
| A2. CSS: clinic card component | New `.gu-clinic-card` class, 2-column grid, photo, map placeholder | `gu-design-system.css` | 30 min |
| A3. CSS: booking checklist style | `.gu-booking-checklist` with checkbox icons | `gu-design-system.css` | 15 min |
| A4. Fix Elementor form tablet overflow | DB: update container width in wp_postmeta for programari page | MySQL | 30 min |
| A5. Archive grid auto-fill: afectiuni, interventii, articole | CSS: `grid-template-columns: repeat(auto-fill, minmax(300px, 1fr))` | `gu-design-system.css` | 15 min |
| A6. Sync + Playwright QA | rsync then QA script | — | 45 min |

**Phase A QA gates:**
- `/programari/` shows no credentials, no years, no intervention counts
- Clinic cards render (with placeholder content if Q13 not yet resolved)
- Archive grids render single card at full width (not in empty 3-column grid)
- Tablet overflow at `/programari/` resolved

---

### Phase B — Sfatul Neurochirurgului Hub Rebuild

**Goal:** Transform article archive into a full educational hub  
**Estimated effort:** Phase B.1: 2 hours; B.2–B.3: 4–6 hours (after content from George)  
**Blockers:** All hub section content is [CLIENT:] — Dr. George must provide or approve  
**Risk:** Low — additive shortcodes, no existing functionality touched

**Phase B.1 — Minimum hub (can implement now):**

| Task | Method | File | Time |
|------|--------|------|------|
| B1.1. Hub navigation strip (jump links to sections) | PHP: `[gu_hub_nav]` shortcode — horizontal pill nav | `gu-design-system.php` | 30 min |
| B1.2. Prima Consultație guide | PHP: `[gu_hub_prima_consultatie]` shortcode with [CLIENT:] content placeholder | `gu-design-system.php` | 45 min |
| B1.3. Recuperare guide | PHP: `[gu_hub_recuperare]` shortcode with [CLIENT:] placeholder | `gu-design-system.php` | 30 min |
| B1.4. Familie/Aparținători guide | PHP: `[gu_hub_familie]` shortcode with [CLIENT:] placeholder | `gu-design-system.php` | 30 min |
| B1.5. CSS: hub section styles | Section headers, guide cards, editorial layout | `gu-design-system.css` | 45 min |

**Phase B.2 — Content sections (implement when George provides content):**

| Task | Blocker |
|------|---------|
| `[gu_hub_video]` — video card grid | [CLIENT: video list with YouTube IDs] |
| `[gu_hub_youtube]` — curated playlist links | [CLIENT: selected YouTube videos] |
| `[gu_hub_social]` — curated IG/FB posts | [CLIENT: selected social posts] |
| `[gu_hub_mituri]` — myth-busting entries | [CLIENT: 6–10 myth/truth pairs] |
| `[gu_hub_glosar]` — medical glossary | [CLIENT: 20–30 glossary terms] |
| `[gu_hub_media]` — press mentions | [CLIENT: media appearances list] |

**Phase B.3 — Homepage specialty card icons (lower priority):**
SVG icon system for the 6 specialty cards on the homepage. Deferred — does not block push.

---

### Phase C — Apple Health Token Cleanup

**Goal:** Remove all stale warm-palette references from CSS; document the Apple Health system as canonical in-file  
**Estimated effort:** 1.5 hours  
**Risk:** Very Low — CSS only, no visual changes expected (Section 28 already overrides everything)

| Task | Method | File | Time |
|------|--------|------|------|
| C1. CSS audit: find remaining warm-palette values | Search for `#F4F2EF`, `#FDFBF7`, `#1C1814`, `#231E1A`, `rgba(28,24,20`, warm shadow tints | `gu-design-system.css` | 30 min |
| C2. Document Section 28 as the canonical token block | Add clear comment header explaining the Apple Health system | `gu-design-system.css` | 10 min |
| C3. Update DESIGN_MODERNIZATION_PLAN note | Add deprecation notice: warm Scandinavian palette superseded by Apple Health direction | `DESIGN_MODERNIZATION_PLAN.md` | 5 min |
| C4. Update `:root` token block to remove deprecated warm tokens | Remove or comment out stale warm tokens from the base `:root` declaration | `gu-design-system.css` | 30 min |
| C5. QA: visual regression check | Playwright spot-check all 9 pages after cleanup | — | 30 min |

**Risk note on C4:** Removing tokens from `:root` that are still referenced by earlier CSS sections will break those sections. The correct approach: update the references first (replace `#FDFBF7` with `var(--color-surface)`, etc.), then remove the old token names. Do C4 carefully, one token at a time, with QA between each.

---

### Phase D — Nav and Header Polish

**Goal:** Final polish on the header experience  
**Estimated effort:** 1 hour  
**Risk:** Very Low

| Task | Method | File | Time |
|------|--------|------|------|
| D1. Header CTA button: font-weight 400 → 600 | CSS override: `.gu-header .elementor-button { font-weight: 600 !important; }` | `gu-design-system.css` | 10 min |
| D2. Header CTA button: verify border-radius = 12px | CSS audit + override if needed | `gu-design-system.css` | 10 min |
| D3. Mobile drawer: verify active state styling | Playwright check at 390px | — | 15 min |
| D4. Header compact scroll: verify shadow on scroll | Visual check | — | 10 min |
| D5. Verify all 6 nav active states fire correctly | Playwright check — each page at 1440px | — | 15 min |

---

### Phase E — Final Browser QA + Push

**Goal:** Complete browser verification at all viewports, then push to remote  
**Estimated effort:** 2–3 hours  
**Risk:** Low — QA only, no code changes

| Task | Method |
|------|--------|
| E1. Browser verification — Dr. George reviews all 9 pages + /recomandari/ at 1440px | Manual browser review using Sprint checklists |
| E2. Mobile spot-check — key pages at 390px | Manual or Playwright |
| E3. Playwright full QA suite — 10 pages × 3 viewports | Automated — extend existing suite |
| E4. Fix any regressions found in E1–E3 | Code changes if needed |
| E5. Git commit — final state | All files |
| E6. Remote push | `git push origin main` |

**Push checklist (all must be ✓ before git push):**
- [ ] Dr. George has reviewed all pages in browser and approved
- [ ] No dark brown sections remaining anywhere
- [ ] No credential content on /programari/
- [ ] Nav shows 6 items + CTA on all pages
- [ ] /recomandari/ renders correctly
- [ ] All [CLIENT:] placeholders are documented in a client handoff brief
- [ ] No horizontal overflow on any page (except documented pre-existing Elementor tablet issues)
- [ ] `#physician` anchor verified on /despre/

---

## 8. Risk Assessment

### 8.1 Safe to implement before push — no George review needed

These are structural or stylistic changes with no medical content involvement. Low risk. Can proceed after plan approval.

| Change | Phase | Risk |
|--------|-------|------|
| Archive grid auto-fill (CSS) | A | Very Low — fixes broken empty state |
| Header button font-weight/radius | D | Very Low — visual polish only |
| CSS token cleanup (removing stale warm palette) | C | Low — QA required after each token removal |
| Programări structural rewrite (removing credential sections) | A | Low — content is removed, not changed |
| Hub navigation strip (jump links) | B.1 | Very Low — additive shortcode |
| Clinic card component structure (placeholder content) | A | Low — [CLIENT:] until Q13 resolved |

### 8.2 Requires George's browser review before finalizing

These are changes to patient-facing content direction that George should review:

| Item | Why George's review is needed |
|------|-------------------------------|
| Programări FAQ content | Medical-adjacent — tone and accuracy must be approved |
| Prima Consultație guide content | Patient-facing instructions — George's authority is on the line |
| Recuperare content | Post-op guidance — clinical accuracy required |
| Family/caregiver content | Patient-adjacent communication — needs physician approval |
| Hub section order and emphasis | Brand/editorial decision — George's voice |

### 8.3 Blocked on George providing content — cannot build final state without

These sections are fully blocked until specific content input is received. They can be scaffolded with [CLIENT:] placeholders and launched in placeholder state:

| Blocker | Impact | Placeholder state |
|---------|--------|------------------|
| **Q7a — Professional photography** | /despre/ hero, homepage bio, article author avatar — the most impactful missing asset | SVG monogram placeholder |
| **Q13 — Location data** (clinics, addresses) | /programari/ clinic cards cannot show real data; Physician schema address missing | Text: "[Locație — în curs de confirmare]" |
| **Q24 — Colleague recommendations** | /recomandari/ Section 1 cannot be finalized | [CLIENT:] placeholder cards |
| **Philosophy of care text** | /despre/ Section 4 — the emotional heart of the page | [CLIENT:] placeholder |
| **Education / training timeline** | /despre/ Sections 5–6 — required for credibility | [CLIENT:] placeholder with form |
| **Video / social content for hub** | Sfatul hub sections B.2 — cannot build without content decisions | Sections omitted until content provided |
| **Myth/truth pairs** | `[gu_hub_mituri]` section — 6–10 pairs minimum | Section omitted until provided |
| **Media appearances list** | `[gu_hub_media]` section | Section omitted until provided |

### 8.4 Pre-existing technical issues — not caused by this project, deferred

| Issue | Pages affected | Viewport | Root cause | Fix approach |
|-------|---------------|----------|------------|-------------|
| Elementor form container overflow | /programari/ | 768px | Elementor form widget container exceeds viewport | DB edit (Phase A or deferred) |
| Elementor archive container overflow | /afectiuni/, /interventii/ | 768px | Fixed 1100px inner container | DB edit (deferred — post-launch) |
| Article single overflow | /articole/ single | 390px | Wide content element | DB edit (deferred) |

These are all Elementor database edits — not CSS-fixable. They require careful DB updates to `wp_postmeta` `_elementor_data` entries. They do not affect desktop experience. They can be fixed post-launch without affecting push timing.

### 8.5 One-way vs. reversible changes

All proposed changes in Phases A–D are reversible:

| Change type | Reversibility |
|-------------|--------------|
| PHP shortcode rewrite | Reversible — revert PHP file |
| CSS additions | Reversible — remove CSS rules |
| DB `_elementor_data` edits (overflow fixes) | Reversible — restore `meta_value` from backup |
| MySQL pages created (like /recomandari/) | Reversible — delete page row |
| Git push to remote | NOT reversible without force-push (hence Phase E is the last gate) |

---

## 9. Content Handoff Brief (for client — Dr. George Ungureanu)

Before the site can be finalized, the following input is needed. This section is written to be shared directly with the client.

**Priority 1 — Blocks the site going live:**

| # | What we need | Where it appears | Format |
|---|-------------|-----------------|--------|
| Q7a | Professional photograph of Dr. George | /despre/ hero, homepage, article author | JPEG, min 900×1200px, max 300KB |
| Q13a | Name and address of each clinic/hospital where consultations happen | /programari/ clinic cards, Physician schema | Text: "Clinica X, Str. Y, Nr. Z, Cluj-Napoca" |
| Q13b | Booking link or phone number for each location | /programari/ clinic cards | URL and/or phone |
| Q20 | Languages of consultation (Romanian + which others?) | /despre/ Quick Facts strip | Text |

**Priority 2 — Improves the site significantly, should be resolved before push:**

| # | What we need | Where | Format |
|---|-------------|-------|--------|
| Q1 | Why did you choose neurosurgery? (2–5 sentences, your own words) | /despre/ biography | Text, Romanian |
| Q3 | How would you describe your approach to patients in one sentence? | /despre/ hero tagline | 1 sentence |
| Q4 | What do you believe makes a good doctor-patient relationship? | /despre/ philosophy | Text, Romanian |
| Q6–9 | Education timeline: medical school, residency, fellowships, specialty title | /despre/ education section | See Content Input Form (ABOUT_PAGE_ARCHITECTURE.md Appendix A) |
| Q10 | Years of neurosurgical experience | /despre/ Quick Facts, homepage stats | Number |
| Q11 | Current hospital/clinic name (primary affiliation) | /despre/ Quick Facts | Text |
| Q18 | Professional society memberships | /despre/ memberships | List |

**Priority 3 — Will be added post-launch:**

| # | What we need | Where |
|---|-------------|-------|
| Q24 | Written recommendations from colleague physicians (with consent) | /recomandari/ Section 1 |
| Q14–15 | Publications, conference presentations | /despre/ research section |
| Q19 | Press/media appearances | /despre/ media section, hub media section |
| Hub video list | YouTube videos to feature in hub | /articole/ video section |
| Hub myths | 6–10 myth/truth pairs | /articole/ myths section |
| Hub social | IG/FB posts to curate | /articole/ social section |

---

## Summary — What Needs to Happen Before Remote Push

| # | Item | Status | Owner |
|---|------|--------|-------|
| 1 | Phase A: Programări simplification | Not started | Engineering |
| 2 | Phase B.1: Hub minimum viable structure | Not started | Engineering |
| 3 | Phase C: CSS token cleanup | Not started | Engineering |
| 4 | Phase D: Nav/header polish | Not started | Engineering |
| 5 | Q7a Photography | Blocked | Dr. George |
| 6 | Q13 Location data | Blocked | Dr. George |
| 7 | /despre/ Content Input Form | Blocked | Dr. George |
| 8 | /programari/ FAQ content review | Blocked | Dr. George |
| 9 | /recomandari/ colleague cards | Blocked | Dr. George |
| 10 | Phase E: Browser QA + George approval | Not started | Engineering + Dr. George |
| 11 | Remote push | Blocked on Phase E | Engineering |

The engineering work (Phases A–D) can proceed in parallel with content gathering (items 5–9). The site can be pushed with [CLIENT:] placeholders where content is not yet available — with the understanding that those sections will be populated before the site is promoted to patients.

---

> **Do not publish AI-generated medical content without explicit human review.**  
> **Do not commit automatically. Stop for browser verification.**  
> **Do not push to remote without Phase E approval.**

*This document is a diagnostic and plan only. No implementation has occurred as part of its creation.*  
*Ready for approval before any Phase A–E work begins.*
