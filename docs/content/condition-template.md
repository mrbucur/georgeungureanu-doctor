# Condition Template (Afecțiuni CPT)
**ACF Group:** `medical-condition` (ID=39)  
**URL pattern:** `/afectiuni/{slug}/`  
**Schema:** `MedicalWebPage` (condition-specific; MedicalCondition schema deferred — see SCHEMA_GUIDELINES.md)

---

## 1. WordPress Post Fields

| WP Field | Value | Notes |
|----------|-------|-------|
| `post_title` | Condition name in Romanian | Romanian medical terminology; plain Romanian in slug |
| `post_name` | slugified condition name | `/afectiuni/hernie-de-disc-lombara/` |
| `post_status` | `draft` until medical review | |
| `post_type` | `afectiuni` | |

**Taxonomy:** `specializare` — tag with relevant specialty (e.g., Coloana Vertebrală, Neurochirurgie Oncologică)

---

## 2. ACF Fields — medical-condition (key=medical-condition)

| Field key | Label | Type | Required | Guideline |
|-----------|-------|------|----------|-----------|
| `subtitle` | Subtitlu | text | Yes | Descriptive subtitle completing the condition name; 8–16 words |
| `short_summary` | Short Summary | textarea | Yes | 2–3 sentences; what the condition is and who it affects; 40–60 words |
| `symptoms` | Simptome | wysiwyg | Yes | See Section 3 below |
| `causes` | Cauze | wysiwyg | Yes | See Section 3 below |
| `diagnosis` | Diagnostic | wysiwyg | Yes | See Section 3 below |
| `treatment` | Tratament | wysiwyg | Yes | See Section 3 below |
| `recovery` | Recuperare | wysiwyg | Recommended | See Section 3 below |
| `faq` | FAQ | wysiwyg | Yes | Minimum 3 Q&A pairs; see faq-template.md |
| `cta_title` | CTA Title | text | Yes | Patient-first invitation |
| `cta_text` | CTA Text | textarea | Yes | 20–40 words; no outcome promises |
| `seo_title` | SEO Title | text | Yes | 50–60 chars |
| `seo_description` | SEO Description | textarea | Yes | 140–155 chars |

---

## 3. Content Section Guidelines

### short_summary (40–60 words)
State what the condition is, which part of the body it affects, and the main symptom. Do not mention treatment here.

> Exemplu: "Hernia de disc lombară apare atunci când materialul gelatinos din interiorul unui disc intervertebral iese în afara învelișului său și apasă pe nervii din apropierea coloanei lombare. Poate provoca dureri de spate, dureri iradiante în picior și amorțeală sau slăbiciune musculară."

### symptoms (wysiwyg, 150–300 words)
Structure:
```
[1 intro paragraph — what causes the symptoms and which nerve paths are involved]

Simptome frecvente:
• [Symptom 1 — plain description, where it's felt]
• [Symptom 2]
• [Symptom 3]
• ... (list 4–8 symptoms)

[1 closing paragraph — when symptoms are mild vs. when they require urgent attention]
```

### causes (wysiwyg, 150–250 words)
Structure:
```
[1 intro paragraph — primary mechanism]

Factori de risc:
• [Risk factor 1]
• [Risk factor 2]
• ...

[1 paragraph on age/lifestyle factors if relevant]
```

### diagnosis (wysiwyg, 100–200 words)
Structure:
```
[1 paragraph — what the consultation includes (history, physical exam)]

Investigații uzuale:
• [Investigation 1 — plain name + what it shows]
• [Investigation 2]
• ...
```

### treatment (wysiwyg, 200–350 words)
Structure:
```
[1 paragraph — conservative treatment options first]

Tratament conservator:
• [Option 1]
• ...

[1 paragraph — when surgery is considered; link to relevant /interventii/ page(s)]

Tratament chirurgical:
• [Procedure name — link to procedure page]
```
Do not state that surgery is "the best" or "the only" option. Present it as one pathway when conservative measures have not resolved symptoms.

### recovery (wysiwyg, 100–200 words)
```
[1–2 paragraphs; typical recovery timeline after conservative or surgical treatment]
[What to expect at 2 weeks / 6 weeks / 3 months]
[Activity restrictions without scare language]
```

### faq (wysiwyg)
Use structured Q&A format. See `faq-template.md` for full format.  
Minimum 3, maximum 6 pairs.

### CTA fields
`cta_title`: "Aveți simptome care vă îngrijorează?"  
`cta_text`: Invite the patient to schedule a consultation; emphasize that early evaluation leads to more options. Never promise outcomes.  
`cta_button_label` (if available): "Programați o consultație"

---

## 4. SEO Fields

### seo_title (50–60 characters)
Pattern: `[Condition Name] — Simptome, Cauze și Tratament`  
Or: `[Condition Name] — Ce Trebuie să Știți`

### seo_description (140–155 characters)
Should include: condition name, primary symptom, implicit value of reading the page.

> Exemplu: "Hernia de disc lombară provoacă dureri de spate și iradiație în picior. Aflați care sunt cauzele, simptomele și opțiunile de tratament, inclusiv chirurgical."

---

## 5. Internal Linking Requirements

- Link to at least 1 surgical procedure page from the `treatment` section
- The `[gu_articles_for_post]` shortcode on this template auto-generates article cross-links
- Do not manually add duplicate links if the shortcode covers them

---

## 6. Pre-publish Checklist

- [ ] Medical review completed by Dr. Ungureanu (date documented in admin note)
- [ ] All required ACF fields populated
- [ ] `short_summary` ≤ 155 characters
- [ ] `treatment` section links to relevant `/interventii/` page
- [ ] Minimum 3 FAQ Q&A pairs
- [ ] `seo_title` 50–60 chars; `seo_description` 140–155 chars
- [ ] Taxonomy tag applied
- [ ] No prohibited claims (no cure guarantees, no "best" superlatives)
- [ ] Medical disclaimer present
