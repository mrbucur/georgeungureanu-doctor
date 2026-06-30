# Content Production Workflow
**georgeungureanu.doctor**  
**Last updated:** 2026-06-30

---

## Overview

This workflow governs how content moves from idea to publication. It is designed to be fast enough to publish consistently, and rigorous enough to protect the practice's medical and legal standing.

**Rule:** No content with medical claims goes live without Dr. Ungureanu's review. No exceptions.

---

## Workflow Diagram

```
1. RESEARCH
   └── Identify topic, patient questions, keyword, existing content gaps
         │
         ▼
2. AI DRAFT
   └── Use prompt from docs/prompts/
   └── Mark output: [DRAFT — NECESITĂ REVIZIE MEDICALĂ]
         │
         ▼
3. STRUCTURAL REVIEW (Content Editor)
   └── Check structure, tone, completeness against template
   └── Fill in any gaps before medical review
   └── Set post_status = draft in WordPress
         │
         ▼
4. MEDICAL REVIEW (Dr. George Ungureanu)
   └── Verify all medical claims (symptoms, causes, treatment, risks, timelines)
   └── Correct inaccuracies; add specific clinical details
   └── Set medical_review_date ACF field
   └── Sign off: Approved / Approved with edits / Requires revision
         │
         ▼
5. SEO REVIEW (Content Editor)
   └── Verify seo_title (50–60 chars) and seo_description (140–155 chars)
   └── Set internal links (ACF cross-link fields + inline body links)
   └── Verify FAQ fields complete
   └── Run pre-publish checklist (docs/content/medical-review-checklist.md)
         │
         ▼
6. PUBLISHING
   └── Change post_status: draft → publish
   └── Confirm permalink, taxonomy, featured image
   └── Warm the page: load it once in browser
   └── Verify schema in Google Rich Results Test (new schema types only)
         │
         ▼
7. PERIODIC UPDATE
   └── Review on schedule (articles: 12 months; conditions/procedures: 18 months)
   └── Check for new evidence or guideline changes
   └── Update medical_review_date when content is re-confirmed
```

---

## Stage 1 — Research

**Who:** Content editor or Dr. Ungureanu  
**Time:** 30–60 minutes per topic

### Input sources
- Patient questions from consultation (most valuable)
- Google "People Also Ask" for the condition/procedure name in Romanian
- Google Search Console — queries driving traffic to related pages
- Neurosurgical society guidelines (Romanian and European)
- Patient forums (identify what patients worry about, not what they're told to worry about)

### Deliverables
- Topic confirmed
- Primary keyword identified (how patients search for it in Romanian)
- 3–5 patient questions identified (become FAQ pairs)
- Content type decided (article / condition / procedure)
- Related existing pages identified (for internal links)

---

## Stage 2 — AI Draft

**Who:** Content editor  
**Time:** 15–30 minutes

### Steps
1. Open the appropriate prompt from `docs/prompts/`
2. Fill in all `[PLACEHOLDER]` values
3. Paste into Claude (claude.ai) or approved AI tool
4. Save the full output as a local file or WordPress draft
5. Confirm `[DRAFT — NECESITĂ REVIZIE MEDICALĂ]` marker is present

### Do not
- Publish AI output without completing stages 3–5
- Edit out the draft marker before medical review
- Generate statistics and include them without verification

---

## Stage 3 — Structural Review

**Who:** Content editor  
**Time:** 20–40 minutes

### Checks
- Content follows the correct template (`docs/content/[type]-template.md`)
- All required sections are present and appropriately filled
- Tone matches `docs/content/CONTENT_TONE.md`
- Word count within target range
- Medical disclaimer present
- No prohibited claims (see `docs/EDITORIAL_POLICY.md`)
- SEO fields drafted (can be refined after medical review)

### Output
- WordPress draft post created with all ACF fields populated
- Internal notes added: AI tool used, date, any structural concerns for Dr. Ungureanu

---

## Stage 4 — Medical Review

**Who:** Dr. George Ungureanu  
**Time:** 15–45 minutes depending on content complexity

### This is the critical gate. Content does not advance without it.

### Review focus
- Clinical accuracy of every medical claim
- Completeness of symptom lists, risk disclosures, recovery timelines
- Whether treatment recommendations reflect current standard of care
- Whether surgical candidacy criteria are correctly described
- Whether any claim could create unrealistic patient expectations

### Dr. Ungureanu's actions
- Edit content directly in WordPress or provide marked-up corrections
- Set the `medical_review_date` ACF field (YYYY-MM-DD format)
- Note in admin notes: "Medical review complete — [date] — approved/approved with changes/needs revision"

### Output
- Medically approved content in WordPress draft
- `medical_review_date` field populated
- Content editor notified for SEO stage

---

## Stage 5 — SEO Review

**Who:** Content editor  
**Time:** 15–20 minutes

### Checks
- `seo_title`: 50–60 characters, keyword near start
- `seo_description`: 140–155 characters, keyword present
- `schema_type` set correctly (see `docs/SCHEMA_GUIDELINES.md`)
- Cross-link ACF fields set (`related_condition_*`, `related_procedure_*`)
- Inline body links to related pages added
- All FAQ pairs complete (minimum 3 for articles)
- `reading_time` calculated and entered
- Complete `docs/content/medical-review-checklist.md` Parts 2 and 3

---

## Stage 6 — Publishing

**Who:** Content editor (with Dr. Ungureanu's approval confirmed from Stage 4)  
**Time:** 5–10 minutes

### Steps
1. Set `post_status` to `publish`
2. Verify the live URL returns 200 and displays correctly
3. Check that the `[gu_article_author]` block shows correct review date (articles only)
4. Verify internal links resolve to published pages
5. For new schema types: test in Google Rich Results Test
6. Add the published URL to the internal content map in `docs/prompts/internal-linking-generation.md`

---

## Stage 7 — Periodic Update

**Who:** Content editor (flags); Dr. Ungureanu (approves updates)

### Review schedule
- Articles: review every 12 months from `medical_review_date`
- Conditions: review every 18 months
- Procedures: review every 18 months

### Triggers for early review
- Dr. Ungureanu adopts a new surgical technique for a covered procedure
- Major clinical guideline update published by relevant medical society
- A claim on the page is challenged or contradicted by new evidence
- Google flags the page in Search Console for health content issues

### Update process
- Follow the same workflow from Stage 3 (structural review) onward
- After Dr. Ungureanu re-approves, update the `medical_review_date` field
- No content change bypasses Stage 4 (medical review), even small edits to clinical claims

---

## Responsibility Matrix (RACI)

| Stage | Dr. Ungureanu | Content Editor |
|-------|--------------|----------------|
| 1. Research | Consulted | Responsible |
| 2. AI Draft | Informed | Responsible |
| 3. Structural Review | Consulted | Responsible |
| 4. Medical Review | Responsible | Supportive |
| 5. SEO Review | Informed | Responsible |
| 6. Publishing | Approves | Responsible |
| 7. Periodic Update | Approves changes | Responsible for scheduling |

---

## Time Budget per Content Piece

| Content type | Research | AI Draft | Structural | Medical | SEO | Publish | Total |
|--------------|----------|----------|------------|---------|-----|---------|-------|
| Article | 45 min | 20 min | 30 min | 30 min | 20 min | 10 min | ~2.5h |
| Condition | 30 min | 20 min | 25 min | 40 min | 15 min | 10 min | ~2.3h |
| Procedure | 45 min | 20 min | 30 min | 45 min | 15 min | 10 min | ~2.8h |

Medical review time varies significantly by topic complexity.

---

## Content Calendar Recommendation

To maintain consistent publishing without overwhelming the review process:

| Frequency | Target |
|-----------|--------|
| Articles | 2–4 per month |
| Conditions | 1–2 per month (until major conditions are covered) |
| Procedures | 1 per month (until main procedures are covered) |

Priority order for initial content build-out:
1. Conditions Dr. Ungureanu sees most frequently in consultation
2. Procedures Dr. Ungureanu performs most often
3. Articles addressing the most common patient questions from consultations
