# Editorial Policy
**georgeungureanu.doctor**  
**Effective:** 2026-06-30  
**Owner:** Dr. George Ungureanu  
**Review cycle:** Annual

---

## 1. Purpose

This policy governs all content published on georgeungureanu.doctor. It applies to content created by Dr. Ungureanu, by human collaborators, and by AI tools operating under his direction. All content must reflect the medical standards, ethical principles, and communication values of a specialist medical practice.

---

## 2. Tone of Voice

The voice of this website is the doctor speaking directly to the patient.

**Core attributes:** Calm · Clear · Warm · Direct · Precise  
**What the voice is not:** Promotional · Intimidating · Paternalistic · Falsely cheerful · Passive

The full tone guide is in `docs/content/CONTENT_TONE.md`. This policy assumes familiarity with that document.

**Language:** Romanian, formal register. Address the reader as "dumneavoastră" throughout. Diacritics required: ș ț ă â î (comma-below forms, not cedilla).

---

## 3. Medical Disclaimer Requirements

### 3.1 Mandatory disclaimer

Every article and condition page must contain this disclaimer (or an approved equivalent) at the end of the body content:

> *Informațiile din acest articol au caracter educativ general și nu înlocuiesc consultul medical de specialitate. Fiecare pacient are un tablou clinic unic, iar recomandările de tratament sunt stabilite individual, în urma evaluării medicale. Dacă aveți simptome, consultați un medic.*

### 3.2 Procedure page disclaimer

> *Informațiile de pe această pagină sunt orientative. Indicarea și efectuarea oricărei intervenții chirurgicale se stabilesc individual, în urma consultației preoperatorii cu Dr. Ungureanu și pe baza investigațiilor imagistice complete.*

### 3.3 Disclaimer integrity

The wording of the approved disclaimers must not be modified without Dr. Ungureanu's explicit approval. No disclaimer may be removed to save space or improve flow.

---

## 4. Prohibited Claims

The following content is prohibited on this website regardless of context:

### 4.1 Outcome guarantees
- "Vă vindecăm"
- "Garantăm ameliorarea durerii"
- "100% succes"
- "Fără riscuri"
- "Procedura nu are complicații"
- Any framing that implies a guaranteed or universal outcome

### 4.2 Comparative superlatives
- "Cel mai bun neurochirurg din România"
- "Cea mai avansată clinică"
- "Singurul specialist care..."
- "Unic în țară"

### 4.3 Fabricated evidence
- Statistics without a credible source or clinical context
- Patient testimonials that promise outcomes ("M-a vindecat complet")
- Before/after claims without documented evidence

### 4.4 Alarmist language
- Language designed to create fear or urgency without clinical basis
- "Dacă nu operați imediat, riscați paralizia" (unless this is the specific, documented medical risk)
- Countdown urgency ("Acționați acum înainte să fie prea târziu")

### 4.5 Unsupported medical claims
- Claims that contradict current medical consensus
- Endorsement of unproven treatments or supplements
- Advice that could substitute for individual medical assessment

---

## 5. Fact-Check Workflow

All medical claims in published content must be verifiable. The following workflow applies:

### 5.1 Sources of truth
1. Dr. Ungureanu's direct clinical knowledge and protocols (primary)
2. Current Romanian medical standards and clinical guidelines
3. Peer-reviewed literature (PubMed, Cochrane, major neurosurgical society guidelines)

### 5.2 Fact-check steps
1. **AI draft:** AI tools may draft content structure and non-clinical sections
2. **Clinical accuracy pass:** Dr. Ungureanu reviews all medical claims against steps 1–3 above
3. **Statistics:** Any numerical claim must be traceable to a specific source; if untraceable, remove or rephrase ("majority of patients" instead of "87%")
4. **Documentation:** The medical review date is recorded in the `medical_review_date` ACF field

---

## 6. Review Responsibilities

| Content element | Responsibility |
|-----------------|---------------|
| Medical accuracy of all clinical content | Dr. George Ungureanu |
| Tone compliance | Content editor / Dr. Ungureanu |
| SEO fields (seo_title, seo_description) | Content editor |
| Disclaimer presence | Content editor (verified) |
| Internal linking | Content editor |
| Technical WordPress fields | Content editor |
| Publication decision | Dr. George Ungureanu (final authority) |

No content moves from `draft` to `publish` without Dr. Ungureanu's explicit approval.

---

## 7. Update Frequency

| Content type | Scheduled review | Triggers immediate update |
|--------------|-----------------|--------------------------|
| Articles | Every 12 months | New evidence changes recommendations; practice protocols updated |
| Conditions | Every 18 months | New diagnostic criteria; treatment guidelines revised |
| Procedures | Every 18 months | New technique adopted; equipment change; complication rate update |
| Disclaimers | Annually | Regulatory changes; legal advice |
| This policy | Annually | Significant practice change or legal requirement |

Outdated content that cannot be immediately updated must display a visible "last reviewed" date so patients can assess its currency.

---

## 8. Citation Recommendations

### 8.1 When to cite
- Specific statistics or outcomes claimed in the text
- Medical protocols or guidelines referenced
- Comparative data between treatment options

### 8.2 How to cite (patient-facing)
Do not use academic citation format in patient-facing content. Instead:
- "Conform ghidurilor Societății Europene de Neurochirurgie..."
- "Studii publicate în reviste de specialitate arată că..."
- "Datele clinice recente sugerează că..."

### 8.3 Internal citation log
Maintain a citation log in WordPress admin notes for content that references specific statistics. The patient does not see this log, but it supports the medical review process.

---

## 9. AI Usage Policy

### 9.1 Permitted uses of AI
- Drafting content structure and section outlines
- Generating first-draft text for medical review
- Generating SEO metadata variants
- Generating FAQ sets for human review
- Suggesting internal linking opportunities

### 9.2 Prohibited uses of AI
- Publishing AI-generated medical content without human medical review
- Using AI to generate statistics that cannot be independently verified
- Allowing AI output to replace Dr. Ungureanu's clinical judgment in any content

### 9.3 AI disclosure in workflow
- All AI-drafted content must be marked `[DRAFT — NECESITĂ REVIZIE MEDICALĂ]` until approved
- The AI tool used and the date of generation should be recorded in admin notes for audit trail
- Published content does not require a public AI-use disclosure, but the internal workflow record is maintained

### 9.4 Responsibility
AI tools are instruments of the editorial workflow. Dr. Ungureanu is the responsible author of all published content, regardless of the drafting method. AI-generated content reviewed and approved by Dr. Ungureanu is his content.

---

## 10. Patient Privacy

- No patient names, case details, or identifiable information published without explicit written consent
- Anonymized case descriptions ("un pacient de 45 de ani...") require Dr. Ungureanu's approval
- No clinical photography published without patient consent and compliance with GDPR

---

## 11. Policy Amendments

Amendments to this policy require Dr. Ungureanu's written approval. Minor editorial clarifications may be made by the content editor and noted in the document changelog. Substantive changes to prohibited claims, disclaimer text, or AI policy require formal approval.
