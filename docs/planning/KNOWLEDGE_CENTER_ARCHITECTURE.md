# Knowledge Center & Content Engine — Architecture

**Sprint:** 7 (Phase 1 — Planning)
**Date:** 2026-06-30
**Status:** Awaiting approval — DO NOT IMPLEMENT

**Roles synthesized:**
Medical Content Strategist · SEO Architect · Information Architect · Lead WordPress Engineer

---

## Executive Summary

The site currently has two content silos: Afecțiuni (conditions) and Intervenții (procedures). Both are deep, specialist content that converts well — but they are invisible at the top of the funnel. A patient searching "de ce mă doare spatele" or "hernie de disc simptome" does not land on these pages; they land on generic health portals.

The Knowledge Center adds a third layer — `articole` — that captures informational search intent and feeds patients into the existing Afecțiuni → Intervenții → Programări conversion path. It turns the site from a medical brochure into a medical authority.

**Goal:** Build a content engine that compounds over time. Every article published increases organic surface area, links back to specialist content, and routes patients toward consultation.

---

## 1. CPT Architecture

### Existing CPTs (unchanged)

| CPT | Slug | Archive | Purpose |
|---|---|---|---|
| Afecțiuni | `afectiuni` | `/afectiuni/` | Condition reference pages (Sprints 4) |
| Intervenții | `interventii` | `/interventii/` | Procedure reference pages (Sprint 5) |

### New CPT: Articole

**Slug:** `articole`
**Archive:** `/articole/`
**REST API:** enabled (future headless or search integration)
**Features:** `title`, `editor`, `thumbnail`, `excerpt`, `custom-fields`, `revisions`
**Rewrite:** `{slug}` → `/articole/{post-slug}/`

**Purpose:** Capture informational + educational search intent. Articles are written for patients, not physicians. They explain conditions in plain language, reference Dr. George's clinical perspective, and link to the specialist Afecțiuni and Intervenții pages.

#### Taxonomy 1: Categorie Articole

**Slug:** `categorie-articole`
**Type:** Hierarchical (tree structure, like WordPress categories)
**Archive URL:** `/articole/categorie/{slug}/`
**REST:** enabled

Proposed category tree:
```
Coloana Vertebrală
├── Hernie de Disc
├── Stenoză Spinală
├── Scolioză
└── Durere Lombară

Creier și Craniu
├── Tumori Cerebrale
├── Hidrocefalie
└── Nevralgii

Nervi Periferici
├── Sindrom de Tunel Carpian
└── Neuropatii

Ghiduri pentru Pacienți
├── Înainte de Operație
├── Recuperare Postoperatorie
└── Când să Consulți un Neurochirurg
```

The "Ghiduri pentru Pacienți" category is strategically important: it captures patients in the pre-decision phase ("should I see a neurosurgeon?") and is the top-of-funnel entry point.

#### Taxonomy 2: Etichete Articole

**Slug:** `eticheta-articole`
**Type:** Non-hierarchical (flat, like WordPress tags)
**Archive URL:** `/articole/eticheta/{slug}/`
**REST:** enabled

Tags are not displayed prominently but power internal "related articles" queries. They should be normalized terms: `durere-lombara`, `hernie-disc`, `rmn`, `recuperare`, `operatie`, etc.

**Cross-CPT tagging strategy:** Use the same tag slugs across `articole`, `afectiuni`, and `interventii` if taxonomies allow shared terms — or duplicate with consistent naming. This enables a future "All content on this topic" aggregation page.

#### Relationships Between CPTs

This is the most important architectural decision of Sprint 7.

**Option A — ACF Free (custom field with stored IDs)**

Store post IDs as a comma-separated text field. A custom shortcode resolves the IDs and renders cards. No UI affordance in the WP admin for selecting posts by name.

- Pros: No new plugins, consistent with current ACF Free constraint
- Cons: Poor editorial UX (admin must know post IDs), no referential integrity (broken links if post deleted)

**Option B — ACF Pro Relationship Fields**

Full many-to-many relationship UI: admins search by title, select posts, relationships persist in `wp_postmeta`. The reverse relationship can be displayed via `acf_get_field()` API.

- Pros: First-class editorial experience, referential integrity, reverse relationships possible
- Cons: Requires ACF Pro license (~$149/yr)

**Recommendation: ACF Pro for Sprint 7.**

The Relationship field is the single most impactful ACF Pro feature for this architecture. Without it, the internal linking system is entirely manual (hardcoded IDs or hand-written links). With it, Dr. George or an editor can maintain cross-CPT connections through a clean admin UI. The investment pays for itself in editorial time within the first 10 articles.

If ACF Pro is not approved: implement Option A with a custom WP admin meta box (a post-selection UI built in PHP) to avoid the raw-ID problem. This is Sprint 7B scope.

---

## 2. ACF Field Group: `group_ar` — Article

Applied to: `articole` CPT

### Core Content Fields

| # | Field name | ACF type | Notes |
|---|---|---|---|
| 1 | `subtitle` | text | Article subtitle / display under H1 |
| 2 | `short_summary` | textarea | 2–3 sentences for archive cards and meta description fallback |
| 3 | `key_takeaways` | wysiwyg | Bulleted clinical insights box — rendered in an accent-colored callout |
| 4 | `reading_time` | number | Minutes to read — editorial input or auto-calculated via shortcode |

### Medical Authority Fields

| # | Field name | ACF type | Notes |
|---|---|---|---|
| 5 | `medical_review_date` | date (YYYYMMDD) | Last reviewed by Dr. George — displayed as "Revizuit la [date]" |
| 6 | `author_display_name` | text | Defaults to "Dr. George Ungureanu" — allows guest/co-author override |
| 7 | `author_credentials` | text | "MD, Neurochirurg" — displayed under author name |
| 8 | `author_bio_short` | textarea | 1–2 sentence bio (for schema and byline) |

### Relationship Fields (requires ACF Pro — see Section 1)

| # | Field name | ACF type | Notes |
|---|---|---|---|
| 9 | `related_conditions` | relationship | post_type: `afectiuni`, max: 3, rendered as linked cards |
| 10 | `related_procedures` | relationship | post_type: `interventii`, max: 3, rendered as linked cards |
| 11 | `related_articles` | relationship | post_type: `articole`, max: 4, rendered as "Citește și" row |

*ACF Free fallback: fields 9–11 become `text` fields storing comma-separated post IDs. A `[gu_related_posts ids="..." type="afectiuni"]` shortcode renders them.*

### FAQ Block (without ACF Pro Repeater)

The Repeater field requires ACF Pro. For ACF Free, implement as 5 fixed question/answer pairs. If more than 5 FAQs are needed, use the `content` wysiwyg as overflow.

| # | Field name | ACF type | Notes |
|---|---|---|---|
| 12 | `faq_1_question` | text | First FAQ question |
| 13 | `faq_1_answer` | textarea | First FAQ answer |
| 14 | `faq_2_question` | text | |
| 15 | `faq_2_answer` | textarea | |
| 16 | `faq_3_question` | text | |
| 17 | `faq_3_answer` | textarea | |
| 18 | `faq_4_question` | text | |
| 19 | `faq_4_answer` | textarea | |
| 20 | `faq_5_question` | text | |
| 21 | `faq_5_answer` | textarea | |

**With ACF Pro Repeater** (recommended): replace fields 12–21 with a single `faq_items` Repeater with sub-fields `question` (text) and `answer` (textarea). No cap of 5. Renders via a shortcode that iterates `have_rows('faq_items')`.

### CTA Configuration

| # | Field name | ACF type | Notes |
|---|---|---|---|
| 22 | `cta_title` | text | Custom CTA heading (default: "Programează o consultație") |
| 23 | `cta_text` | textarea | 1–2 sentence CTA body (default: global copy from plugin option) |
| 24 | `cta_button_label` | text | Button text (default: "Programează acum") |

### Schema & SEO

| # | Field name | ACF type | Notes |
|---|---|---|---|
| 25 | `schema_type` | select | Options: `Article`, `MedicalWebPage`, `FAQPage` |
| 26 | `seo_title` | text | Override meta `<title>` |
| 27 | `seo_description` | textarea | Override meta description |

**Total fields: 27** (ACF Free version: 27 fields, no repeaters)
**Total fields: 19** (ACF Pro version: relationship + repeater consolidation reduces count)

**ACF group key:** `group_ar`
**Local JSON export:** `acf-json/group_ar.json`

---

## 3. Patient Content Journey

### The Core Journey

```
[AWARENESS — Google Search]
   "hernie de disc lombară simptome"
   "de ce mă doare spatele noaptea"
   "când trebuie să merg la neurochirurg"
        ↓
[ARTICLE — /articole/{slug}/]
   Informational, accessible, evidence-based
   Answers the patient's immediate question
   Establishes Dr. George as a trusted voice
   Shows: key takeaways, FAQ, Author badge (medical review date)
        ↓ (Related Conditions section, in-text links)
[CONDITION — /afectiuni/{slug}/]
   Diagnostic depth: symptoms, causes, risk factors
   Treatment overview: conservative vs. surgical
   Patient understands their specific condition
        ↓ (Related Procedures section)
[PROCEDURE — /interventii/{slug}/]
   Surgical pathway: indications, technique, recovery
   Risks and benefits explained honestly
   Patient understands what treatment looks like
        ↓ (CTA section on every page)
[PROGRAMĂRI — /programari/]
   Trust built across 3–4 pages
   Patient arrives informed, anxiety reduced
   Booking form pre-selects "Consultație inițială"
```

### Why This Journey Is Optimal

**1. Funnel alignment with search intent**

Search intent has three stages: informational ("ce este hernia de disc"), navigational ("Dr. George Ungureanu"), transactional ("programare neurochirurg București"). The current site only serves navigational and partial transactional. Articles serve informational — the stage where 80% of medical searches begin and where authority is first established.

**2. Trust compounding across touchpoints**

A patient who reads an article by Dr. George before seeing his Afecțiuni page has already encountered his clinical voice. Each page they navigate reinforces trust. By the time they reach Programări, they have read 3–4 pieces of content authored by the same physician they are about to book.

**3. SEO + conversion are not in conflict**

Medical SEO often traps practices into choosing between ranking content (long, keyword-rich, generic) and converting content (direct, CTA-heavy, specialist). The funnel resolves this: articles rank and educate, conditions and procedures convert, Programări closes. Each page optimizes for its stage without compromising the other stages.

**4. Reverse journeys exist and should be accommodated**

Not every patient starts at Google. Some arrive directly at `/afectiuni/` from a referral. The content architecture must support:
- Condition → related articles (deepen understanding before deciding)
- Procedure → related articles (patient wants to read more before agreeing)
- Article → Programări direct (for patients who are already decided)

All three reverse paths are served by the bidirectional linking strategy in Section 4.

**5. Content compounding over time**

Each new article creates new entry points into the funnel. 20 articles = 20 potential Google ranking positions, each funneling into the same Afecțiuni → Intervenții → Programări path. The conversion infrastructure (Sprints 4–6) is already built; articles multiply its reach without rebuilding it.

---

## 4. Internal Linking Strategy

### Article → Outbound Links

| Link type | Placement | Behavior |
|---|---|---|
| Related Conditions | Dedicated section, below article body | Renders 1–3 `afectiuni` cards using ACF relationship data |
| Related Procedures | Dedicated section, below conditions | Renders 1–3 `interventii` cards |
| Related Articles | "Citește și" row, bottom of page | Renders 2–4 article cards (horizontal scroll on mobile) |
| In-text links | Within the article body (wysiwyg) | Manual links to `/afectiuni/slug/` and `/interventii/slug/` |
| FAQ anchor | Jump link from article intro | `#intrebari-frecvente` smooth scroll |
| Final CTA | Last section of every article | → `/programari/` |

### Condition → Inbound/Outbound Links

Existing conditions (`/afectiuni/`) must be updated in Sprint 7B to show:

| Link type | New section | Source |
|---|---|---|
| Related Articles | "Citește despre această afecțiune" | ACF relationship (reverse: articles that list this condition) |
| Related Procedures | Already exists in template | No change needed |

### Procedure → Inbound/Outbound Links

Existing procedures (`/interventii/`) must be updated in Sprint 7B to show:

| Link type | New section | Source |
|---|---|---|
| Related Articles | "Citește mai mult" | ACF relationship (reverse) |
| Related Conditions | "Afecțiuni tratate" | Already exists |

### FAQ Cross-References

If a FAQ answer references a specific condition or procedure, the answer text should contain an inline link. The FAQ accordion on Programări should link to relevant articles for deeper reading.

### Editorial Linking Rules

1. Every article must link to at least one `afectiuni` page
2. Every article must link to at least one `interventii` page
3. Every article must have a CTA section linking to `/programari/`
4. No orphan articles — every article must be in at least one category
5. No broken internal links — when a condition/procedure slug changes, update relationships via ACF admin (not by searching HTML)
6. Maximum 3 outbound relationship links per type (conditions, procedures, articles) to avoid diluting page equity

---

## 5. SEO Architecture

### URL Structure

```
/                                   Homepage
/afectiuni/                         Conditions archive
/afectiuni/{slug}/                  Single condition
/interventii/                       Procedures archive
/interventii/{slug}/                Single procedure
/articole/                          Articles archive (NEW)
/articole/{slug}/                   Single article (NEW)
/articole/categorie/{slug}/         Category archive (NEW)
/articole/eticheta/{slug}/          Tag archive (NEW — optional)
/programari/                        Booking page
```

### Breadcrumbs (BreadcrumbList Schema)

```
Acasă › Articole › Coloana Vertebrală › Durerea Lombară: Cauze și Tratament
Acasă › Afecțiuni › Hernie de Disc Lombară
Acasă › Intervenții › Microdiscectomie Lombară
```

Breadcrumbs must be rendered as visible HTML (not just schema) for both UX and SEO. Implementation: a custom `[gu_breadcrumb]` shortcode that reads the current post's taxonomies and outputs `<nav aria-label="Breadcrumb"><ol>...</ol></nav>`.

### Meta Strategy

| Page type | `<title>` pattern | `<meta description>` source |
|---|---|---|
| Single article | `{seo_title or post_title} \| Dr. George Ungureanu` | `seo_description` field or `short_summary` field |
| Category archive | `{Category Name} — Articole \| Dr. George Ungureanu` | Static description per category (ACF Options Page in Pro, or hardcoded in `wp_head` hook) |
| Articles archive | `Articole pentru Pacienți \| Dr. George Ungureanu` | Hardcoded |
| Single condition | Already defined in group_mc (`seo_title`, `seo_description`) | — |
| Single procedure | Already defined in group_sp (`seo_title`, `seo_description`) | — |

**Current blocker:** Meta fields exist in ACF but are not wired to `<head>`. This is TECH_DEBT.md P1 item. Sprint 7 must resolve this — a `wp_head` hook in `gu-design-system.php` that reads `seo_title` and `seo_description` from the current post's ACF fields and outputs them as `<title>` and `<meta name="description">`.

### Taxonomy SEO Rules

1. `categorie-articole` archives should be indexable (public: true)
2. `eticheta-articole` archives should be `noindex` unless they have ≥5 posts (thin content risk)
3. No duplicate taxonomy archives for the same term across CPTs
4. Permalink structure: `/%category%/%postname%/` for articles (nests posts under category in URL)
   - **Alternative:** flat `/articole/{slug}/` — recommended for flexibility (category can change without breaking URL)
   - **Decision:** Use flat URL. Category in URL creates URL dependency on taxonomy which complicates content restructuring.

### Schema.org Opportunities

#### Per-Article Schema: `MedicalWebPage` (or `Article`)

```json
{
  "@context": "https://schema.org",
  "@type": "MedicalWebPage",
  "name": "{post title}",
  "description": "{short_summary}",
  "url": "{canonical URL}",
  "datePublished": "{post_date}",
  "dateModified": "{medical_review_date}",
  "author": {
    "@type": "Physician",
    "name": "Dr. George Ungureanu",
    "medicalSpecialty": "Neurochirurgie"
  },
  "reviewedBy": {
    "@type": "Physician",
    "name": "Dr. George Ungureanu"
  },
  "about": {
    "@type": "MedicalCondition",
    "name": "{related condition name}"
  }
}
```

Use `MedicalWebPage` when the article is a clinical explainer. Use `Article` when it's a patient narrative or general educational piece. The `schema_type` ACF field controls which is output.

#### Per-Article Schema: `FAQPage` (when FAQs are populated)

```json
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "{faq_1_question}",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "{faq_1_answer}"
      }
    }
  ]
}
```

This enables FAQ rich snippets in Google Search — one of the highest-value schema types for medical content. A patient searching "hernie de disc operație sau tratament conservator" may see Dr. George's FAQ answer directly in search results.

#### Per-Condition Schema: `MedicalCondition`

```json
{
  "@context": "https://schema.org",
  "@type": "MedicalCondition",
  "name": "{post title}",
  "alternateName": "{subtitle}",
  "description": "{short_summary}",
  "possibleTreatment": {
    "@type": "MedicalTherapy",
    "name": "{related procedure name}"
  }
}
```

#### Per-Procedure Schema: `MedicalProcedure`

```json
{
  "@context": "https://schema.org",
  "@type": "MedicalProcedure",
  "name": "{post title}",
  "description": "{short_summary}",
  "procedureType": "SurgicalProcedure",
  "bodyLocation": "Coloana vertebrală / Creier"
}
```

#### Global Schema: `Physician` (in `<head>` on every page)

```json
{
  "@context": "https://schema.org",
  "@type": "Physician",
  "name": "Dr. George Ungureanu",
  "medicalSpecialty": "Neurologie chirurgicală",
  "url": "https://georgeungureanu.doctor",
  "telephone": "[CLIENT: phone]",
  "address": {
    "@type": "PostalAddress",
    "addressCountry": "RO",
    "addressLocality": "[CLIENT: city]"
  }
}
```

#### Global Schema: `BreadcrumbList` (per-page, generated from taxonomy path)

Output on every non-homepage page via `gu_breadcrumb` shortcode injecting JSON-LD into `wp_head`.

### Schema Implementation Approach

All schema output via a `gu_output_schema()` function called from `wp_head` in `gu-design-system.php`. The function:
1. Detects post type
2. Reads relevant ACF fields for the current post
3. Builds the appropriate schema array
4. Outputs as `<script type="application/ld+json">`

No schema plugin needed. Avoids dependency on Yoast/Rank Math (though one of these should be installed for the meta description output — or the custom `wp_head` hook described above handles both).

---

## 6. AI Content Pipeline

### Problem

Dr. George has clinical expertise and unique perspectives but limited time for content production. AI can accelerate drafting while his review preserves accuracy and voice.

### Pipeline Design

```
[TRIGGER: Content brief created]
       ↓
[Step 1: Topic + keyword research]
   Input: topic, target keywords, target CPT/taxonomy
   Tool: manual research or SEMrush/Ahrefs (external)
   Output: a brief document with target H1, keywords, outline
       ↓
[Step 2: AI Article Draft]
   Input: brief + approved article samples for voice calibration
   Tool: Claude API (or Claude.ai)
   Output: full article draft in markdown with:
     - H1 (matches seo_title candidate)
     - Short summary (2–3 sentences for `short_summary` field)
     - Key takeaways (bullet list for `key_takeaways` field)
     - Body (wysiwyg content)
     - FAQ block (5 Q&A pairs for `faq_*` fields)
     - CTA title + text suggestions
     - Reading time estimate
       ↓
[Step 3: AI Meta Generation]
   Input: draft title + short_summary
   Tool: Claude
   Output: `seo_title` candidate (≤60 chars) + `seo_description` (≤155 chars)
       ↓
[Step 4: AI Relationship Suggestions]
   Input: article topic + list of existing afectiuni/interventii slugs + titles
   Tool: Claude
   Output: recommended related_conditions (up to 3) + related_procedures (up to 3) + related_articles (up to 4) with justification
       ↓
[Step 5: Medical Review — Dr. George]
   Input: full draft with all field values pre-filled
   Action: review clinical accuracy, adjust voice, approve or edit
   Gate: NOTHING publishes without this step
       ↓
[Step 6: WP Import]
   Input: approved markdown + field values
   Action: paste into WP editor, populate ACF fields, set taxonomy, publish
   Tool: manual or WP-CLI import script
       ↓
[Step 7: Post-publish QA]
   Action: verify page loads, check H1, check schema, verify internal links
   Tool: Playwright (extend sprint QA script to include /articole/ URLs)
```

### Prompt Engineering: Voice Calibration

A "system prompt" for article generation must encode Dr. George's voice. Based on content written across Sprints 4–6:

```
You are writing a medical article for Dr. George Ungureanu's neurosurgery website.
Dr. George's voice is:
- Calm and authoritative, never alarmist
- Evidence-based: references clinical consensus, not personal opinion alone
- Patient-centered: explains the "why" before the "what"
- Honest about risk and uncertainty: does not oversell surgical outcomes
- In Romanian (medical Romanian, not colloquial)
- Accessible: no unexplained medical jargon (define terms on first use)
- Respectful of patient autonomy: never pressures toward surgery

Approved content examples for tone calibration:
[paste 2–3 existing approved afectiuni/interventii summaries]
```

### AI Limitations and Gates

| Risk | Mitigation |
|---|---|
| Medical hallucinations (wrong statistics, wrong anatomy) | Dr. George reviews every claim — AI draft is a starting point, not final copy |
| Outdated clinical information | `medical_review_date` field tracks when content was last reviewed; set annual review reminders |
| Generic voice (sounds like every other health portal) | Voice calibration prompt + Dr. George actively edits, not just approves |
| GDPR: patient case descriptions | AI must not generate identifiable patient content; all case examples must be anonymized or fabricated composites |
| Over-reliance on AI | Editorial calendar should include articles Dr. George contributes from original clinical observations, not AI-drafted |

### AI Pipeline Output Format

Each AI pipeline run produces a structured Markdown file:

```markdown
---
title: "..."
seo_title: "..."
seo_description: "..."
short_summary: "..."
reading_time: 6
schema_type: MedicalWebPage
category: coloana-vertebrala/hernie-de-disc
tags: hernie-disc, durere-lombara, rmn
related_conditions: hernie-de-disc-lombara
related_procedures: microdiscectomie-lombara
medical_review_date: 2026-06-30
author_display_name: Dr. George Ungureanu
author_credentials: MD, Neurochirurg
---

# H1: ...

## Key Takeaways
- ...

## Body
...

## FAQs
**Q1:** ...
**A1:** ...

## CTA
Title: ...
Text: ...
```

This format maps directly to ACF fields, making WP import a structured copy-paste exercise (or automatable via WP-CLI + custom import script).

---

## 7. Reusable Elementor Components

### New components required for Sprint 7

| Component name | Description | Reuse potential |
|---|---|---|
| **Article Card** | Card with thumbnail, category tag, title, summary, reading time, "Citește →". Used in archive and "Related Articles" sections | Archive, Related Articles rows, Homepage |
| **Key Takeaways Box** | Accent (`#E4EDEB`) callout box with bullet list. Placed near article top | All articles |
| **Medical Review Badge** | "Revizuit medical la [date] de [author]" — small bar below H1 | All articles |
| **Related Conditions Row** | 1–3 condition cards rendered from ACF relationship — titled "Afecțiuni conexe" | Article single, Procedure single |
| **Related Procedures Row** | 1–3 procedure cards rendered from ACF relationship — titled "Intervenții conexe" | Article single, Condition single |
| **Related Articles Row** | 2–4 article cards, horizontal, titled "Citește și" | Article single, Condition single, Procedure single |
| **Author Byline** | Author name, credentials, brief bio, avatar placeholder | All articles |
| **Breadcrumb Bar** | Visible breadcrumb trail below header — renders shortcode `[gu_breadcrumb]` | All non-homepage pages |
| **FAQ Accordion (Schema-Enabled)** | Accordion widget + `<script type="application/ld+json">` with FAQPage schema injected server-side | Articles, Programări (already exists) |

### Components that already exist (extend, don't rebuild)

| Existing component | Sprint 7 extension |
|---|---|
| Archive card grid (`[gu_articole_archive]`) | New shortcode; same pattern as `[gu_afectiuni_archive]` and `[gu_interventii_archive]` |
| CTA dark section (`s6pg080` pattern) | Reuse with custom `cta_title`/`cta_text` from ACF fields |
| FAQ accordion | Already in Programări (ID=73 library template). Articles use a variant with schema output |

---

## 8. Risks

### SEO Risks

| Risk | Probability | Severity | Mitigation |
|---|---|---|---|
| **Keyword cannibalization** between article and condition pages targeting the same query | Medium | High | Differentiate intent: articles answer "what is X / should I be worried"; conditions answer "how is X diagnosed and treated". Use different title patterns. |
| **Thin content** on short articles or stub categories | High | High | Minimum 800 words per article editorial policy. Category archives must have ≥5 posts before being publicly indexed. |
| **Duplicate meta** if `seo_title` not filled and default fallbacks collide | Medium | Medium | Implement fallback chain: `seo_title` → `post_title + site_name`. Never two identical titles. |
| **Tag archive proliferation** with thin pages | High | Medium | Set tag archives to `noindex` by default. Only index tags with ≥5 published articles. |
| **404s from slug changes** if post slugs change after publish | Medium | High | Implement 301 redirects via Redirection plugin or Nginx config. Never change a published slug without setting a redirect. |
| **Missing `canonical` tag** on paginated category archives | Low | Medium | Ensure `rel=canonical` points to page 1 from all archive pagination pages. |

### Medical Content Risks

| Risk | Probability | Severity | Mitigation |
|---|---|---|---|
| **Clinical inaccuracy in AI draft** published without sufficient review | Medium | Very High | Hard gate: Dr. George must review every article. No "auto-publish" from AI pipeline. |
| **Outdated content** (clinical guidelines change) | High over time | High | `medical_review_date` field + calendar reminder for annual content audit. |
| **GDPR violations** in patient case descriptions | Low | Very High | No identifiable patient content anywhere. Case examples are composites or hypothetical. |
| **E-E-A-T failures** (Google's Expertise-Experience-Authoritativeness-Trustworthiness) | Medium | High | Every article must display author credentials, medical review date, and `Physician` schema. |
| **Medical advice liability** (content interpreted as diagnosis) | Medium | High | Each article must include a disclaimer: "Acest articol are scop informativ și nu înlocuiește consultația medicală." |

### Technical Risks

| Risk | Probability | Severity | Mitigation |
|---|---|---|---|
| **ACF Pro dependency** if relationships are core to the architecture | High (if ACF Free forced) | High | Decide on ACF Pro before Sprint 7A begins. Half the linking strategy degrades without it. |
| **Performance** with many articles and complex relationship queries | Low (current traffic) | Medium | Enable full-page caching (LiteSpeed Cache or WP Rocket) before public launch. Add `LIMIT` clauses to relationship queries. |
| **Elementor article template conflicts** with global CSS | Low | Low | Use `s7` element ID prefix. Test all new components against existing global CSS. |
| **Schema validation errors** in Google Search Console | Medium | Medium | Validate every new schema type with schema.org validator and Google Rich Results Test before shipping. |
| **WP-CLI import errors** on large content batches | Low | Low | Test import script on staging with ≥5 articles before production. |

### Maintenance Risks

| Risk | Probability | Severity | Mitigation |
|---|---|---|---|
| **Content rot** — no process for reviewing/updating published articles | Very High | High | Editorial calendar with quarterly review triggers. `medical_review_date` field creates audit trail. |
| **Tag sprawl** — proliferating tags created without governance | High | Medium | Define a tag taxonomy governance doc. All new tags must match an approved list. |
| **Broken relationships** when conditions/procedures are deleted | Medium | Medium | ACF Pro relationship fields degrade gracefully (empty, not 404). ACF Free text fields do not — implement a pre-delete hook. |
| **Elementor version drift** — new Elementor versions may alter article template JSON | Low | Medium | Run Playwright QA after every Elementor update. Export templates immediately after any manual changes. |
| **AI voice drift** — if different people generate content with different prompts | Medium | High | Store the voice calibration prompt in `docs/prompts/` and enforce its use. |

---

## 9. Sprint Roadmap

### Sprint 7A — Foundation (Complexity: Medium)

**Goal:** Publish one complete article end-to-end. All infrastructure in place.

| Task | Complexity | Notes |
|---|---|---|
| Register `articole` CPT in `gu-design-system.php` | Low | Same pattern as `afectiuni` / `interventii` |
| Register `categorie-articole` + `eticheta-articole` taxonomies | Low | |
| Create ACF field group `group_ar` (27 fields) | Medium | Via PHP script, same pattern as group_mc/group_sp |
| Build Elementor Single Article template | High | New components: Key Takeaways, Author Byline, Medical Review Badge, Related sections, FAQ |
| Build Elementor Archive template | Medium | Reuses Article Card component |
| Create demo article with all ACF fields populated | Medium | Content: "Hernie de disc lombară: ce trebuie să știi" |
| Register `[gu_articole_archive]` shortcode | Low | Same pattern as existing archive shortcodes |
| Playwright QA at 3 viewports | Low | Extend existing QA script |
| Export ACF JSON + Elementor templates | Low | |
| Sprint report | Low | |

**Estimated time:** 6–8h engineering + 2–3h content (demo article)

**Blockers:**
- ACF Pro vs. ACF Free decision (relationship fields)
- 1 demo article written and approved by Dr. George (or placeholder content accepted for QA)

---

### Sprint 7B — Relationships & Internal Linking (Complexity: Medium-High)

**Goal:** All three CPTs are interconnected. Patients can navigate between conditions, procedures, and articles.

| Task | Complexity | Notes |
|---|---|---|
| Implement `related_conditions` rendering on article single | Medium | ACF relationship → card grid |
| Implement `related_procedures` rendering on article single | Medium | Same pattern |
| Implement `related_articles` rendering on article single | Medium | Horizontal row |
| Update `afectiuni` single template: add "Citește despre această afecțiune" section | Medium | Reverse relationship: articles that link to this condition |
| Update `interventii` single template: add related articles section | Medium | Same pattern |
| Build `[gu_related_posts]` shortcode (renders by post ID list for ACF Free) | Medium | If ACF Pro not approved |
| Implement breadcrumb shortcode `[gu_breadcrumb]` | Medium | Output HTML + JSON-LD BreadcrumbList |
| Wire `seo_title` + `seo_description` ACF fields to `wp_head` for all CPTs | Low | Single function in `gu-design-system.php` — resolves TECH_DEBT.md P1 item |
| Populate 2–3 additional demo articles with real cross-links | Medium | Demonstrates the full journey in QA |
| Playwright QA — verify journey from article → condition → procedure → programari | Medium | |
| Export all templates | Low | |

**Estimated time:** 8–10h engineering + 3–4h content (demo articles)

**Blockers:**
- Sprint 7A complete
- At least 2 additional demo articles (or approved placeholders)
- Decision on reverse relationship approach (ACF Pro OR custom WP query)

---

### Sprint 7C — Schema, SEO & AI Pipeline (Complexity: Medium)

**Goal:** Site is technically SEO-ready. AI content pipeline is documented and usable.

| Task | Complexity | Notes |
|---|---|---|
| Implement `gu_output_schema()` function in plugin | High | Detects CPT, reads ACF fields, outputs correct JSON-LD for Article/MedicalCondition/MedicalProcedure/FAQPage/Physician |
| Validate all schema types with schema.org validator | Low | |
| Configure `noindex` for thin tag archives (< 5 posts) | Low | `wp_head` hook checking `get_queried_object()` |
| Write AI content pipeline prompt template | Medium | Voice-calibrated Claude prompt, stored in `docs/prompts/ARTICLE_GENERATION_PROMPT.md` |
| Write AI output → WP import mapping doc | Low | Field-by-field guide for editorial team |
| Editorial governance document (tag taxonomy, slug rules, update policy) | Medium | `docs/content/EDITORIAL_POLICY.md` |
| Google Search Console verification + sitemap submission | Low | Requires production domain — staging only for now |
| Final Playwright QA across all content types + schema validation | Medium | |
| Sprint report | Low | |

**Estimated time:** 6–8h engineering + 3–4h documentation

**Blockers:**
- Sprint 7B complete
- Production domain / staging environment for Google Search Console
- Dr. George approval on Physician schema data (name, specialty, address)

---

## Summary Decision Points Before Implementation

These must be resolved before any code is written:

| # | Decision | Options | Recommendation | Owner |
|---|---|---|---|---|
| D1 | ACF Free vs. ACF Pro | Free (text ID fields + custom shortcode) vs. Pro (Relationship + Repeater) | **ACF Pro** — the relationship fields are core to the content engine | Client budget decision |
| D2 | Article URL structure | Flat `/articole/{slug}/` vs. nested `/articole/{category}/{slug}/` | **Flat** — avoids URL dependency on taxonomy | Architecture decision |
| D3 | Schema implementation | Custom wp_head hook vs. Yoast SEO plugin | **Custom hook** for CPT schema + Yoast for sitemap/general meta | Engineering decision |
| D4 | Tag archives | Index all vs. noindex thin | **noindex < 5 posts** | SEO decision |
| D5 | AI pipeline tool | Claude.ai (manual) vs. Claude API (automated) | **Claude.ai for Sprint 7** — API integration is Sprint 8+ | Ops decision |

---

*Awaiting approval before any implementation begins. Once approved, implementation starts with Sprint 7A.*
