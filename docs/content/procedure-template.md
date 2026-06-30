# Procedure Template (Intervenții CPT)
**ACF Group:** `group_sp` (ID=55)  
**URL pattern:** `/interventii/{slug}/`  
**Schema:** `MedicalWebPage` (MedicalProcedure schema deferred — see SCHEMA_GUIDELINES.md)

> **Note on field keys:** ACF group_sp was imported without explicit field keys (`post_excerpt` empty). Until field keys are confirmed in ACF admin, reference these fields by their label slugs or verify via `/wp-admin/post.php?post=55&action=edit`.

---

## 1. WordPress Post Fields

| WP Field | Value | Notes |
|----------|-------|-------|
| `post_title` | Procedure name in Romanian | Medical terminology acceptable; plain Romanian preferred where equivalent exists |
| `post_name` | slugified | `/interventii/microdiscectomie-lombara/` |
| `post_status` | `draft` until medical review | |
| `post_type` | `interventii` | |

**Taxonomy:** `tip-interventie` — tag with relevant type (e.g., Coloana Vertebrală, Neurochirurgie Oncologică, Nervi Periferici)

---

## 2. ACF Fields — group_sp (ID=55)

| Label (as registered) | Slug reference | Required | Guideline |
|-----------------------|----------------|----------|-----------|
| Subtitle | `subtitle` | Yes | 8–16 words; what type of surgery, what it treats |
| Short Summary | `short_summary` | Yes | 2–3 sentences; what the procedure is and what it achieves |
| Indications | `indications` | Yes | Who this procedure is for; conditions it addresses |
| When Surgery Is Recommended | `when_surgery_is_recommended` | Yes | Criteria for surgical candidacy; conservative alternatives |
| Surgical Technique | `surgical_technique` | Yes | Step-level description appropriate for a patient audience |
| Benefits | `benefits` | Yes | Expected outcomes; phrased with appropriate uncertainty |
| Risks | `risks` | Yes | All material risks; honest, not minimized, not sensationalized |
| Recovery Timeline | `recovery_timeline` | Yes | Time-based recovery milestones |
| FAQ | `faq` | Yes | Min 3, max 6 Q&A pairs |
| CTA Title | `cta_title` | Yes | |
| CTA Text | `cta_text` | Yes | |
| SEO Title | `seo_title` | Yes | 50–60 chars |
| SEO Description | `seo_description` | Yes | 140–155 chars |

---

## 3. Content Section Guidelines

### subtitle (8–16 words)
Name what the procedure treats and the approach used.
> Exemplu: "Intervenție minim invazivă pentru rezolvarea herniei de disc lombare"

### short_summary (40–60 words)
What, why, and general approach. No outcomes promised.
> Exemplu: "Microdiscectomia lombară este o procedură chirurgicală minim invazivă care îndepărtează fragmentul de disc herniat ce apasă pe nervul rahidian. Dr. Ungureanu utilizează tehnici moderne pentru a minimiza traumatismul tisular, reducând durata spitalizării și accelerând revenirea la activitățile normale."

### indications (100–200 words)
```
[1 paragraph — the conditions this procedure addresses]

Această intervenție este indicată în cazul:
• [Indication 1]
• [Indication 2]
• ...

[1 paragraph — patient profile; NOT a guarantee of suitability]
```
Close with: "Eligibilitatea pentru această procedură este stabilită în urma consultației și a investigațiilor imagistice."

### when_surgery_is_recommended (100–200 words)
Conservative measures must be presented first. Surgery is framed as a step taken when conservative treatment has not provided adequate relief, or when there are specific urgent criteria (motor deficit, bladder/bowel dysfunction, etc.).

Never frame surgery as "the best option" — frame it as the appropriate option for specific clinical criteria.

### surgical_technique (200–350 words)
Write for a patient who wants to understand what will happen, not a surgeon learning the technique.

Structure:
```
[Pre-operative preparation — anesthesia type, positioning, prep]

[Step-level description — use plain language verbs]
• Incizie de [X] cm / abord minim invaziv
• [What the surgeon accesses]
• [What is removed or repaired]
• [How the wound is closed]

Durata intervenției: aproximativ [X–Y] ore.
```
Do not describe every anatomical layer. Focus on what the patient will experience and what the surgeon achieves.

### benefits (150–250 words)
```
[1 paragraph — primary therapeutic goal: relief of the specific symptom]

Beneficii frecvent raportate:
• [Benefit 1 — symptom relief; phrased with appropriate hedging: "în majoritatea cazurilor"]
• [Benefit 2]
• ...

[1 paragraph — comparative benefits vs. open surgery if minimally invasive applies]
```
**Prohibited:** "Guaranteed relief," "100% success rate," "eliminates pain completely."  
**Required:** Acknowledge that individual results vary.

### risks (150–250 words)
Risks must be complete and honest. Do not bury risks in qualifications or minimize them.

```
Ca orice intervenție chirurgicală, [procedure name] comportă riscuri care vor fi discutate individual cu Dr. Ungureanu în cadrul consultației preoperatorii.

Riscuri generale ale anesteziei generale:
• ...

Riscuri specifice procedurii:
• [Risk 1]
• [Risk 2]
• ...

[1 paragraph — how risks are mitigated by surgical experience and technique]
```

### recovery_timeline (150–250 words)
Use concrete time milestones. Avoid vague language ("soon," "relatively quickly").

```
Primele 24–48 ore: [What the patient experiences; pain management; mobilization]

Prima săptămână: [Discharge criteria; restrictions; wound care]

Săptămânile 2–4: [Activity return; follow-up visit]

Lunile 1–3: [Full return to normal activities; return to work by occupation type]

[1 paragraph — variation by patient age, fitness, extent of procedure]
```

### faq
See `faq-template.md`. Focus on pre-op and post-op patient questions.

---

## 4. SEO Fields

### seo_title (50–60 characters)
Pattern: `[Procedure Name] — Ce Este și Cum Se Realizează`  
Or: `[Procedure Name] la Dr. George Ungureanu — Neurochirurg`

### seo_description (140–155 characters)
Include: procedure name, primary benefit, call to discovery.

---

## 5. Internal Linking Requirements

- Link from `indications` to the relevant `/afectiuni/` condition pages
- The `[gu_articles_for_post]` shortcode auto-generates article cross-links
- Link from `when_surgery_is_recommended` to related conditions if helpful

---

## 6. Pre-publish Checklist

- [ ] Medical review by Dr. Ungureanu (date documented)
- [ ] All ACF fields populated
- [ ] `short_summary` ≤ 155 characters
- [ ] `indications` links to corresponding `/afectiuni/` page(s)
- [ ] `risks` section complete — no material risks omitted
- [ ] `recovery_timeline` uses concrete time ranges, not vague language
- [ ] No prohibited claims in `benefits`
- [ ] Minimum 3 FAQ Q&A pairs
- [ ] `seo_title` 50–60 chars; `seo_description` 140–155 chars
- [ ] Taxonomy tag applied
- [ ] Medical disclaimer present
