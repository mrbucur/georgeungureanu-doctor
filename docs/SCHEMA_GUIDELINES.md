# Schema.org Structured Data Guidelines
**georgeungureanu.doctor**  
**Last updated:** 2026-06-30

---

## Overview

Structured data helps search engines understand what a page is about and can improve how the site appears in search results (rich snippets, knowledge panels, breadcrumbs). This document defines which schema types to use for each content type, and which ones to avoid.

The site currently uses an `@graph` approach: all schema nodes for a page are bundled in a single `<script type="application/ld+json">` block emitted by the `gu-design-system` plugin (Section 9, Sprint 7B).

---

## Schema Decision Tree

```
Is the page a single articole post?
│
├── YES → Does it have 3+ FAQ pairs?
│         ├── YES and FAQ is the PRIMARY content → schema_type = FAQPage
│         └── NO / FAQ is supplementary → schema_type = MedicalWebPage (default)
│
├── Is it a news-style or lifestyle health piece (not condition/procedure-specific)?
│         └── YES → schema_type = Article
│
└── Is it an afectiune or interventie page?
          └── → No schema_type ACF field on these CPTs → MedicalWebPage used by default
                (MedicalCondition and MedicalProcedure deferred — see Section 3)
```

---

## 1. When to Use `MedicalWebPage`

**Use for:** Most articles and all condition/procedure pages.

`MedicalWebPage` is the safe default for medical content. It signals medical intent without making specific claims about the nature of the content (condition vs. procedure vs. article).

**Required when:**
- The page explains a medical condition, treatment, or health topic
- The content is reviewed by a qualified medical professional
- The page is not primarily a Q&A structure

**Current implementation:**
The plugin (Section 9b) emits `MedicalWebPage` when `schema_type` is `MedicalWebPage` or unset.

```json
{
  "@type": "MedicalWebPage",
  "@id": "https://georgeungureanu.doctor/articole/[slug]/#webpage",
  "name": "...",
  "description": "...",
  "inLanguage": "ro-RO",
  "datePublished": "YYYY-MM-DD",
  "dateModified": "YYYY-MM-DD",
  "author": { "@id": "https://georgeungureanu.doctor/despre/#physician" }
}
```

---

## 2. When to Use `Article`

**Use for:** General health lifestyle articles that are not specifically about a condition or procedure.

Examples:
- "10 sfaturi pentru sănătatea coloanei vertebrale"
- "Cum să alegeți un neurochirurg"
- "Ce să vă așteptați la o consultație neurochirurgicală"

`Article` is appropriate when the content is educational/informational rather than a clinical reference for a specific condition.

**Set in ACF:** `schema_type = Article`

---

## 3. When to Use `FAQPage`

**Use for:** Articles where the primary structure is Q&A, or where FAQs are so central that they justify a different schema signal.

**Criteria for FAQPage:**
- Article has 4–5 FAQ pairs (not just 3)
- The FAQ section is the dominant content on the page
- The article title or subtitle signals Q&A nature ("Întrebări frecvente despre...")

**When NOT to use FAQPage:**
- The FAQ is supplementary to a long article body — use `MedicalWebPage` instead
- You have fewer than 3 FAQ pairs

**Current implementation:**
When `schema_type = FAQPage`, the plugin emits `FAQPage` as the main node type.  
Note: FAQPage schema is also emitted inline by `[gu_article_faq]` shortcode when FAQ fields are populated — this creates a separate but complementary FAQPage block. If `schema_type = FAQPage`, both blocks will be present; this is acceptable (one from `wp_head`, one inline).

---

## 4. `MedicalCondition` Schema — Deferred

**Do not use yet.** `MedicalCondition` is a richer schema type that includes:
- `signOrSymptom` → array of `MedicalSign` / `MedicalSymptom` nodes
- `possibleTreatment` → array of treatment nodes
- `associatedAnatomy`
- `code` (ICD-10)

**Why deferred:**
1. Requires structured ACF data that doesn't currently exist in the condition field group (symptoms, causes, etc. are stored as unstructured wysiwyg, not individual fields)
2. Requires ICD-10 coding for each condition — needs Dr. Ungureanu input
3. Misimplemented `MedicalCondition` schema can trigger Google penalties for health content

**Migration path:**
When upgrading to ACF Pro, restructure the `medical-condition` group to use repeater fields for symptoms and treatments. Then `MedicalCondition` schema can be generated from structured data.

---

## 5. `MedicalProcedure` Schema — Deferred

**Do not use yet.** Similar reasoning to `MedicalCondition`:
- `howPerformed`, `preparation`, `followup` fields require structured data
- `bodyLocation` field requires anatomical data not currently in `group_sp`
- Risk of incorrect implementation given unstructured wysiwyg fields

**Migration path:** Same as MedicalCondition — requires ACF Pro repeater fields to populate correctly.

---

## 6. When to Avoid Structured Data

Do not add schema markup in these situations:

| Situation | Reason |
|-----------|--------|
| Content not reviewed by Dr. Ungureanu | Schema signals authority; unreviewed content should not be signaled as authoritative medical content |
| `MedicalCondition` or `MedicalProcedure` without complete structured data | Incomplete implementation is worse than no implementation for health content |
| Duplicate schema on the same page | The plugin emits `@graph`; do not add additional `ld+json` blocks via Elementor or other plugins |
| Pages under `draft` status | Schema bots only process published pages anyway, but avoid schema in drafts to prevent leaks |

---

## 7. Breadcrumb List

`BreadcrumbList` is emitted automatically by the plugin for every `articole` single post:
- Position 1: Acasă → `/`
- Position 2: Articole → `/articole/`
- Position 3: Article title → current URL

For conditions and procedures, breadcrumbs are managed by Elementor's breadcrumb widget (if implemented) or the theme. If Elementor is rendering breadcrumbs visually, do not add a separate `BreadcrumbList` JSON-LD block to avoid duplication.

---

## 8. Physician Node

The `Physician` node is emitted once per article page and references Dr. Ungureanu's `/despre/` page:

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

This node is stable across all articles and should not be modified per-article. Location data (`address`) and credentials (`hasCredential`) will be added when that data is confirmed (see TECH_DEBT.md Q13 blocker).

---

## 9. Schema Validation

Before publishing any page with new schema types, validate at:
- Google Rich Results Test: `search.google.com/test/rich-results`
- Schema.org validator: `validator.schema.org`

Common errors to check:
- `datePublished` and `dateModified` in ISO 8601 format (YYYY-MM-DD)
- `@id` values are unique across the `@graph`
- No required fields missing for the chosen `@type`
