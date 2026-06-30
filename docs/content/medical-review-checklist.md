# Medical Review Checklist
**Purpose:** Gate content from AI draft → published status  
**Who completes this:** Dr. George Ungureanu (medical review) + content editor (technical/SEO review)  
**When:** Before changing `post_status` from `draft` to `publish`

---

## Part 1 — Medical Accuracy Review (Dr. Ungureanu)

Complete this section for every piece of content before it is published.

### 1.1 Clinical Accuracy

- [ ] All symptoms listed are accurate for this condition or procedure
- [ ] All causes and risk factors are clinically correct
- [ ] Diagnostic methods described are currently used in clinical practice
- [ ] Treatment descriptions reflect current standard of care
- [ ] Recovery timelines are realistic and consistent with this practice's protocols
- [ ] No outdated procedures, superseded terminology, or retired treatment options included

### 1.2 Risk Completeness

- [ ] All material risks of the procedure are included (not minimized)
- [ ] Risks are accurately described — not exaggerated, not understated
- [ ] The language makes clear these risks are discussed at the pre-op consultation

### 1.3 Prohibited Claims Verification

- [ ] No guaranteed outcomes ("vă va scăpa de durere," "vă vindecăm")
- [ ] No comparison claims ("cel mai bun," "unic în România")
- [ ] No statistics that cannot be substantiated or sourced
- [ ] No advice that could substitute for individual medical consultation
- [ ] Emergency warning language is used only where clinically appropriate

### 1.4 Romanian Medical Terminology

- [ ] Medical terms are correctly used in Romanian
- [ ] Plain-language equivalents are provided where appropriate
- [ ] Diacritics correct throughout (ș ț ă â î — not ş ţ)

### 1.5 Medical Disclaimer

- [ ] Standard medical disclaimer is present at end of body content
- [ ] Disclaimer text has not been modified without approval

### Medical Review Sign-off

> Reviewed by: Dr. George Ungureanu  
> Date: ____________ (set this as `medical_review_date` ACF field)  
> Status: ☐ Approved ☐ Approved with edits ☐ Requires revision

---

## Part 2 — Content & Editorial Review

Complete this section before publishing (content editor or Dr. Ungureanu).

### 2.1 Content Completeness (Articles)

- [ ] All required body sections present (see `article-template.md`)
- [ ] `short_summary` written (40–60 words)
- [ ] `key_takeaways` written (3–5 bullets, each < 20 words)
- [ ] `reading_time` calculated and entered
- [ ] All 5 FAQ fields (minimum 3 pairs) completed

### 2.1 Content Completeness (Conditions)

- [ ] `subtitle`, `short_summary`, `symptoms`, `causes`, `diagnosis`, `treatment` all populated
- [ ] `faq` minimum 3 Q&A pairs
- [ ] CTA fields populated

### 2.1 Content Completeness (Procedures)

- [ ] All 8 content fields populated (through `faq`)
- [ ] `risks` section — not omitted or shortened
- [ ] `recovery_timeline` uses concrete time ranges
- [ ] CTA fields populated

### 2.2 Tone & Style

- [ ] Formal address throughout ("dumneavoastră")
- [ ] No marketing language or superlatives
- [ ] Sentences average < 20 words in body content
- [ ] Paragraphs ≤ 5 lines on desktop
- [ ] Active voice dominant

### 2.3 Internal Linking

- [ ] Minimum internal link quotas met (see `editorial-guidelines.md`)
- [ ] Anchor text is descriptive, not generic ("click here")
- [ ] No broken or draft-status internal links

---

## Part 3 — SEO & Technical Review

### 3.1 SEO Fields

- [ ] `seo_title`: 50–60 characters
- [ ] `seo_description`: 140–155 characters
- [ ] Main keyword appears in `seo_title` and `seo_description`
- [ ] `short_summary` usable as meta fallback (≤ 155 chars)

### 3.2 Schema

- [ ] `schema_type` field set appropriately (see `SCHEMA_GUIDELINES.md`)
- [ ] For articles: `schema_type` is one of: `MedicalWebPage`, `Article`, `FAQPage`
- [ ] For FAQPage: minimum 3 FAQ pairs populated

### 3.3 Cross-linking ACF Fields (Articles only)

- [ ] At least 1 `related_condition_*` field populated
- [ ] At least 1 `related_procedure_*` field populated
- [ ] IDs verified — linked posts exist and are published

### 3.4 WordPress Technical

- [ ] Post slug is clean, hyphenated, Romanian (no special characters except hyphens)
- [ ] Post is assigned correct taxonomy term
- [ ] Featured image set if applicable
- [ ] `post_status` is `publish` only after all above are checked

---

## Part 4 — AI Content Audit (if AI-drafted)

If this content was generated using a prompt from `docs/prompts/`, confirm:

- [ ] Content was not published directly from AI output
- [ ] Medical review (Part 1) was completed after AI drafting
- [ ] AI-generated statistics have been verified against clinical sources
- [ ] Content does not claim to represent Dr. Ungureanu's personal clinical experience unless confirmed
- [ ] `[DRAFT — NECESITĂ REVIZIE MEDICALĂ]` marker removed before publish
- [ ] AI tool and date of generation noted in WordPress admin notes (for audit trail)

---

## Audit Trail

Record completed reviews here or in the WordPress post admin notes field:

```
Drafted by: [Name / AI tool]
Draft date: YYYY-MM-DD
Medical review by: Dr. George Ungureanu
Medical review date: YYYY-MM-DD
Editorial review by: [Name]
Editorial review date: YYYY-MM-DD
Published: YYYY-MM-DD
Next scheduled review: YYYY-MM-DD
```
