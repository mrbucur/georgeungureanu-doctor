# Article Template (Articole CPT)
**ACF Group:** `group_ar` (ID=78)  
**URL pattern:** `/articole/{slug}/`  
**Schema default:** `MedicalWebPage`

---

## 1. WordPress Post Fields

| WP Field | Value | Notes |
|----------|-------|-------|
| `post_title` | Romanian article title | Shown as H1 on page |
| `post_name` | auto-slugified | Edit if auto-slug is awkward |
| `post_status` | `draft` until medical review complete | Never publish AI draft directly |
| `post_type` | `articole` | |

---

## 2. ACF Fields — group_ar

### Identity

| Field key | Label | Type | Required | Guidelines |
|-----------|-------|------|----------|------------|
| `subtitle` | Subtitlu | text | Yes | 10–18 words; completes the H1 without repeating it |
| `short_summary` | Sumar scurt | textarea | Yes | 2–3 sentences, 40–60 words; used as meta fallback and in cards |
| `reading_time` | Timp citire (minute) | number | Yes | Count 200 words/min; round to nearest whole minute |

### Author & Medical Review

| Field key | Label | Default value | Notes |
|-----------|-------|---------------|-------|
| `author_display_name` | Autor — Nume afișat | Dr. George Ungureanu | Change only if co-authored |
| `author_credentials` | Autor — Titlu / Specializare | MD, Neurochirurg | |
| `author_bio_short` | Autor — Biografie scurtă | (optional) | 1–2 sentences, omit if redundant with /despre/ |
| `medical_review_date` | Data revizuirii medicale | YYYY-MM-DD | Set when Dr. Ungureanu approves; required before publish |

### Cross-linking

| Field key | Label | Post type | Max |
|-----------|-------|-----------|-----|
| `related_condition_1/2/3` | Afecțiune conexă 1–3 | `afectiuni` | 3 |
| `related_procedure_1/2/3` | Intervenție conexă 1–3 | `interventii` | 3 |
| `related_article_1/2/3` | Articol conex 1–3 | `articole` | 3 |

Link to at least 1 condition OR 1 procedure per article. Leave extras blank.

### FAQ (for `[gu_article_faq]` shortcode + FAQPage schema)

| Field key | Content |
|-----------|---------|
| `faq_1_question` … `faq_5_question` | Questions a patient would actually ask |
| `faq_1_answer` … `faq_5_answer` | 2–4 sentences each; direct, no hedging |

Minimum 3 FAQ pairs per article. Maximum 5. Use 3–5 most searched patient questions.

### CTA

| Field key | Guidelines |
|-----------|------------|
| `cta_title` | Default: "Aveți întrebări despre această afecțiune?" |
| `cta_text` | 1–2 sentences; invite consultation, never promise outcomes |
| `cta_button_label` | Default: "Programați o consultație" |

### SEO

| Field key | Guideline |
|-----------|-----------|
| `schema_type` | `MedicalWebPage` (default), `Article` (general health), `FAQPage` (FAQ-heavy) |
| `seo_title` | 50–60 characters; include main keyword near start |
| `seo_description` | 140–155 characters; includes keyword, signals value to patient |

---

## 3. Article Body Content (Elementor Sections)

The article body goes in the Elementor text widget inside section `s7sg030` (Article body section). Write in flowing HTML or via the Elementor rich-text editor.

### Mandatory body sections (in order)

```
H2: [Context — what is this and why does it matter to the patient]
[2–3 paragraphs, ~150 words]

H2: Cauze și factori de risc
[2–3 paragraphs; list format acceptable]

H2: Simptome frecvente
[bulleted list + 1 introductory paragraph]

H2: Diagnostic
[2 paragraphs; what tests, what the doctor looks for]

H2: Opțiuni de tratament
[2–4 paragraphs; conservative first, surgical if relevant]
→ Link internally to relevant procedure page(s)

H2: Când să consultați un medic / neurochirurg
[1–2 paragraphs; clear red-flag signals]

[Medical disclaimer — see editorial-guidelines.md]
```

### Optional body sections

```
H2: Recuperare și prognostic
H2: Întrebări frecvente de la pacienți
H2: Studii și referințe
```

---

## 4. Word Count Targets

| Section | Min | Max |
|---------|-----|-----|
| short_summary | 40 words | 60 words |
| Article body | 900 words | 1,800 words |
| Each FAQ answer | 50 words | 120 words |
| CTA text | 20 words | 40 words |

---

## 5. Key Takeaways (for `[gu_key_takeaways]` shortcode)

Field key: `key_takeaways`  
3–5 bullet points, each under 20 words.  
Summarize the single most important point from each major section.  
Write for a patient who will only read the summary box.

---

## 6. Pre-publish Checklist

- [ ] `medical_review_date` set (Dr. Ungureanu has reviewed and approved)
- [ ] `short_summary` ≤ 155 characters (for meta description fallback)
- [ ] `reading_time` calculated and entered
- [ ] At least 1 cross-link to condition or procedure
- [ ] 3–5 FAQ pairs completed
- [ ] `seo_title` 50–60 chars; `seo_description` 140–155 chars
- [ ] No guaranteed outcomes, no superlatives, no prohibited claims
- [ ] Medical disclaimer present in body
- [ ] `post_status` set to `publish` only after all above pass
