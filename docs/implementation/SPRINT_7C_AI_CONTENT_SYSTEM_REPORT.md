# Sprint 7C — AI Content Production System
**Status:** COMPLETE — awaiting human review before commit  
**Date:** 2026-06-30  
**Type:** Documentation sprint — no plugin code changes, no DB changes

---

## Files Created

### docs/content/ — Templates & Operational Guides

| File | Purpose |
|------|---------|
| `article-template.md` | Complete field-by-field guide for `articole` CPT; maps all 33 group_ar ACF fields |
| `condition-template.md` | Field guide for `afectiuni` CPT; maps all 12 `medical-condition` ACF fields |
| `procedure-template.md` | Field guide for `interventii` CPT; maps group_sp fields + content section guidelines |
| `faq-template.md` | FAQ format spec; covers both plain-text (article ACF) and wysiwyg (condition/procedure) formats |
| `editorial-guidelines.md` | Operational rules: word counts, heading hierarchy, internal linking quotas, CTA standards, medical disclaimer, AI division of responsibility |
| `medical-review-checklist.md` | 4-part pre-publish gate: medical accuracy (Dr. Ungureanu), content completeness, SEO/technical, AI content audit |

### docs/content/examples/ — Production-Ready Examples

All three examples are in Romanian, fully mapped to ACF fields, and marked `[EXEMPLU — NECESITĂ REVIZIE MEDICALĂ]`.

| File | Content |
|------|---------|
| `example-article.md` | "Semne că ar trebui să consultați un neurochirurg" — 5 FAQ pairs, full body HTML, all ACF fields populated |
| `example-condition.md` | "Stenoză de canal spinal" — all 10 condition ACF fields in Romanian |
| `example-procedure.md` | "Laminectomie lombară" — all procedure fields including complete risks section |

### docs/prompts/ — AI Generation Prompts

Copy-paste prompts for Claude or equivalent. Each prompt produces output structured to the exact ACF field names.

| File | Generates |
|------|-----------|
| `article-generation.md` | Full article: post_title through seo_description + HTML body |
| `condition-generation.md` | Full condition: all 10 ACF wysiwyg + metadata fields |
| `procedure-generation.md` | Full procedure: all fields including risks, technique, recovery |
| `faq-generation.md` | FAQ sets for any content type; two output formats (plain text / wysiwyg) |
| `seo-metadata-generation.md` | 3 variants of seo_title + seo_description per page |
| `internal-linking-generation.md` | Link recommendations: ACF cross-link fields, inline links, reverse links |

### docs/ — Policy Documents

| File | Purpose |
|------|---------|
| `EDITORIAL_POLICY.md` | Formal policy: tone of voice, prohibited claims, fact-check workflow, review responsibilities, update frequency, citation standards, AI usage policy |
| `SCHEMA_GUIDELINES.md` | Decision tree for schema types; when to use MedicalWebPage / Article / FAQPage; why MedicalCondition and MedicalProcedure are deferred |
| `CONTENT_WORKFLOW.md` | 7-stage workflow diagram; RACI matrix; time budgets per content type; content calendar recommendation |

---

## Editorial Standards

### Voice
- Calm, clear, warm, direct, precise — the doctor speaking to the patient, not an institution's press office
- Formal Romanian throughout ("dumneavoastră")
- Medical terms immediately followed by plain-language equivalents
- Sentences average ≤ 18 words; paragraphs ≤ 5 lines

### Prohibited Categories
1. Outcome guarantees ("garantăm", "vă vindecăm", "100% succes")
2. Comparative superlatives ("cel mai bun", "unic în România")
3. Fabricated statistics
4. Alarmist urgency language
5. Advice substituting for individual medical assessment

### Content Lengths
| Type | Body | Summary | FAQ answers |
|------|------|---------|-------------|
| Article | 900–1,800 words | 40–60 words | 40–100 each |
| Condition | 600–1,200 words | 40–60 words | 30–80 each |
| Procedure | 700–1,400 words | 40–60 words | 40–100 each |

---

## AI Safeguards

### Non-negotiable rules embedded in every prompt:
1. Every prompt ends with: `Marcați: [DRAFT — NECESITĂ REVIZIE MEDICALĂ DE DR. UNGUREANU]`
2. Every prompt explicitly prohibits: outcome guarantees, invented statistics, advice replacing individual medical assessment
3. Every prompt requires the medical disclaimer text in the body

### Workflow gate:
The 4-part `medical-review-checklist.md` creates a formal gate between AI draft and publication:
- Part 1 (medical accuracy) is the responsibility of Dr. Ungureanu exclusively
- No content moves from `draft` to `publish` without Part 1 completed

### AI responsibility principle (from EDITORIAL_POLICY.md §9.4):
> "AI tools are instruments of the editorial workflow. Dr. Ungureanu is the responsible author of all published content, regardless of the drafting method."

---

## ACF Field Coverage

| CPT | Group | Fields documented |
|-----|-------|------------------|
| articole | group_ar (ID=78) | All 33 fields |
| afectiuni | medical-condition (ID=39) | All 12 fields |
| interventii | group_sp (ID=55) | All 12 fields (note: field keys empty in DB — see below) |

**group_sp field key issue:** The `group_sp` fields have empty `post_excerpt` in the DB (no explicit ACF field keys registered). Templates reference these by label-slug. Before using ACF `get_field()` programmatically for procedures, verify the actual keys in `/wp-admin/edit.php?post_type=acf-field-group` and update procedure-template.md accordingly.

---

## Future Opportunities

### Content volume targets
Based on a typical neurosurgical practice scope, the estimated content build-out:

| Content type | Priority items | Estimated total |
|--------------|---------------|-----------------|
| Conditions (afecțiuni) | Hernie disc, stenoză spinală, tumori cerebrale, hidrocefalie, nevralgie trigeminală | 15–25 |
| Procedures (intervenții) | Microdiscectomie, laminectomie, craniotomie, biopsie cerebrală, decompresie | 10–20 |
| Articles (articole) | Symptom guides, recovery guides, "when to see a neurosurgeon" type content | 20–40 |

At 2 conditions/month, 1 procedure/month, and 3 articles/month, a full content library would take 12–18 months to build.

### Schema enhancements
- `MedicalCondition` schema: requires restructuring `medical-condition` ACF group to use repeater fields for symptoms and treatments + ICD-10 coding per condition
- `MedicalProcedure` schema: same — requires repeater fields for `bodyLocation`, `preparation`, `followup`
- `LocalBusiness` / `Physician` enhancement: add `address`, `telephone`, `hasCredential` once location data confirmed (Q13 blocker in TECH_DEBT.md)

### Content freshness automation
- WordPress cron job to flag content where `medical_review_date` is older than 12 months (articles) or 18 months (conditions/procedures)
- Dashboard widget showing overdue reviews
- Requires: WP plugin addition or custom code in `gu-design-system.php`

### Multilingual expansion
- If the practice begins serving international patients, an English content layer could be added via WPML or Polylang
- Prompts would need English variants with equivalent safeguards

---

## Migration Path to ACF Pro

The current system uses ACF Free. The following ACF Pro features would significantly improve the content system:

| Feature | Benefit |
|---------|---------|
| Relationship field (true bidirectional) | Replace current `post_object` cross-links with proper bidirectional relationships; auto-populate `[gu_articles_for_post]` without meta_query hack |
| Repeater field | Structure symptoms/causes/risks as individual items rather than wysiwyg blobs; enables `MedicalCondition` / `MedicalProcedure` schema generation |
| Options page | Store practice-wide data (address, phone, Dr. Ungureanu credentials) as ACF fields; use in schema and footer |
| Flexible content field | Allow variable article body sections (text block, callout, Q&A, image+caption) instead of a single Elementor widget |
| Clone field | Share the SEO field set (seo_title, seo_description, schema_type) across all three CPT field groups via a single group definition |

**Estimated Pro upgrade impact:** Medium complexity, 1 sprint to migrate field groups + update plugin code + re-export templates.

---

## Constraints Honoured

- All AI prompts include explicit prohibition on publishing without medical review
- No medical content generated in this sprint (examples are drafts, clearly marked)
- Three examples cover all three CPTs and demonstrate the workflow end-to-end
- Schema guidelines defer `MedicalCondition` and `MedicalProcedure` until structured data is available
- EDITORIAL_POLICY.md §9.4 makes Dr. Ungureanu the responsible author of all published content
