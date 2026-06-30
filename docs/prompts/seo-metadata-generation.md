# AI Generation Prompt — SEO Metadata
**Output maps to:** `seo_title` + `seo_description` ACF fields (all three CPTs)  
**Language:** Română  
**Review required:** Editorial approval (no medical review needed for metadata alone)

---

## How to Use

Use this prompt when:
- Creating metadata for a new piece of content
- Refreshing metadata for existing content
- Generating multiple variants to A/B test

---

## Prompt

```
Ești specialist SEO editorial pentru website-ul medical georgeungureanu.doctor — site-ul dr. George Ungureanu, neurochirurg specialist.

CONTEXT:
Tip pagină: [Articol / Afecțiune / Procedură Chirurgicală]
Titlu pagină (H1): [Titlul complet]
Subiect principal: [Descrieți în 1–2 propoziții]
Cuvântul cheie principal: [Cuvântul sau expresia pe care pacienții o caută]
Cuvinte cheie secundare (opțional): [Lista]

INSTRUCȚIUNI:

Generați 3 variante de seo_title și 3 variante de seo_description.

REGULI seo_title:
- Lungime: 50–60 caractere (inclusiv spații)
- Include cuvântul cheie principal la începutul titlului
- Pattern recomandat: [Cuvânt cheie] — [Beneficiu sau context]
- Specific și descriptiv — nu generic
- Fără clickbait sau senzaționalism
- Nu repetați exact același text ca H1
- Nu includeți „georgeungureanu.doctor" (adăugat automat de WordPress)

Exemple de pattern-uri aprobate:
• „Hernie de disc lombară — Simptome, Cauze și Tratament"
• „Microdiscectomie lombară — Ce este și cum se realizează"
• „Semne că trebuie să consultați un neurochirurg"
• „Stenoză spinală lombară — Ghid complet pentru pacienți"

REGULI seo_description:
- Lungime: 140–155 caractere (inclusiv spații)
- Include cuvântul cheie principal
- Comunică valoarea paginii pentru pacient
- Finalizați cu un call-to-action implicit sau explicit
- Ton: informativ și calm, nu alarmist
- Fără promisiuni de vindecare
- Nu repetați verbatim seo_title

Exemple de pattern-uri aprobate:
• „[Afecțiunea] provoacă [simptomul principal]. Aflați cauzele, simptomele și opțiunile de tratament, inclusiv [procedura]."
• „[Procedura] este o intervenție minim invazivă pentru [indicație]. Dr. Ungureanu explică tehnica, beneficiile și recuperarea."
• „[Subiect articol] — informații medicale corecte pentru a înțelege [problema] și a lua decizii informate."

FORMAT OUTPUT:

VARIANTĂ 1:
seo_title: [max 60 caractere]
seo_description: [140–155 caractere]
Note: [de ce această variantă funcționează]

VARIANTĂ 2:
seo_title: [max 60 caractere]
seo_description: [140–155 caractere]
Note: [...]

VARIANTĂ 3:
seo_title: [max 60 caractere]
seo_description: [140–155 caractere]
Note: [...]

RECOMANDARE FINALĂ: Varianta [X] — [motivul]

CONSTRÂNGERI:
1. Număr exact de caractere după fiecare variantă
2. Nicio promisiune de vindecare sau rezultat garantat
3. Niciun superlativ: „cel mai bun", „unic", „garantat"
4. Diacritice corecte: ș ț ă â î
```

---

## Character Count Verification

After generating, verify character counts before entering into ACF:

```bash
# Quick check — paste into browser console:
"[YOUR SEO TITLE]".length      # must be 50-60
"[YOUR SEO DESCRIPTION]".length  # must be 140-155
```

Or use a character counter tool.

---

## SEO Title Patterns Reference

| Page type | Recommended pattern | Character budget |
|-----------|--------------------|--------------------|
| Condition | `[Condiție] — Simptome, Cauze și Tratament` | ~45 chars + condition name |
| Procedure | `[Procedură] — Ce Este și Cum Se Realizează` | ~46 chars + procedure name |
| Article (how-to) | `[Subiect] — Ghid pentru Pacienți` | ~36 chars + subject |
| Article (symptoms) | `Simptome de [condiție] — Când să Consultați Medicul` | ~52 chars + condition |
| Article (recovery) | `Recuperare după [procedură] — Ce să Vă Așteptați` | ~50 chars + procedure |

---

## Output Checklist

- [ ] Three variants generated
- [ ] Each `seo_title`: 50–60 characters (count verified)
- [ ] Each `seo_description`: 140–155 characters (count verified)
- [ ] Main keyword in both fields
- [ ] No prohibited language
- [ ] Recommendation noted
