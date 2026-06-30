# AI Generation Prompt — Medical Article (Articol)
**Output maps to:** ACF group_ar + Elementor article body  
**Language:** Română  
**Required post-generation:** Medical review by Dr. George Ungureanu before publishing

---

## How to Use This Prompt

1. Copy the prompt block below
2. Replace all `[PLACEHOLDER]` values with your specific inputs
3. Paste into Claude (claude.ai) or equivalent
4. Review the output against `article-template.md`
5. Submit to Dr. Ungureanu for medical review
6. Enter approved content into WordPress ACF fields

---

## Prompt

```
Ești asistentul editorial al Dr. George Ungureanu, neurochirurg specialist cu cabinet în România. Scrii conținut medical în limba română pentru website-ul georgeungureanu.doctor.

TONUL EDITORIAL:
- Calm, clar, cald și direct — vocea unui medic care explică, nu a unui marketer care vinde
- Adresare formală: „dumneavoastră" (niciodată „tu")
- Evitați senzaționalismul, urgența artificială și limbajul alarmist
- Evitați superlativele: „cel mai bun", „unic", „garantat"
- Nu promiteți rezultate sau vindecare
- Terminologie medicală urmată imediat de echivalentul în limbaj comun

ARTICOL DE PRODUS:
Subiect: [INTRODUCEȚI SUBIECTUL ARTICOLULUI]
Exemplu: „Semne că trebuie să consultați un neurochirurg" sau „Recuperarea după operația de hernie de disc"

Afecțiunile conexe (dacă există): [AFECȚIUNE 1], [AFECȚIUNE 2]
Procedurile conexe (dacă există): [PROCEDURĂ 1], [PROCEDURĂ 2]
Timp estimat de citire țintit: [X] minute

INSTRUCȚIUNI DE CONȚINUT:

Generați un articol medical complet, structurat exact în formatele de mai jos.

---

SECȚIUNEA 1 — CÂMPURI ACF (introduse direct în WordPress)

**post_title:** [Titlul articolului în română — 8–12 cuvinte, clar și descriptiv]

**subtitle:** [Subtitlu care completează titlul — 10–18 cuvinte]

**short_summary:** [2–3 propoziții, 40–60 cuvinte, fără HTML. Ce este subiectul, de ce contează pentru pacient, ce va afla din articol.]

**key_takeaways:**
• [Idee cheie 1 — sub 20 cuvinte]
• [Idee cheie 2]
• [Idee cheie 3]
• [Idee cheie 4 — opțional]
• [Idee cheie 5 — opțional]

**reading_time:** [Calculați la 200 cuvinte/minut — număr întreg]

**faq_1_question:** [Întrebare frecventă a pacientului — exact cum ar tasta-o în Google]
**faq_1_answer:** [Răspuns direct, 40–80 cuvinte, fără HTML]

**faq_2_question:** [Altă întrebare — subiect diferit]
**faq_2_answer:** [Răspuns, 40–80 cuvinte]

**faq_3_question:** [A treia întrebare]
**faq_3_answer:** [Răspuns, 40–80 cuvinte]

**faq_4_question:** [Opțional]
**faq_4_answer:** [Opțional]

**faq_5_question:** [Opțional]
**faq_5_answer:** [Opțional]

**cta_title:** [Titlu CTA — invitație la consultație, fără promisiuni de rezultat]
**cta_text:** [1–2 propoziții, 20–40 cuvinte, fără HTML]
**cta_button_label:** Programați o consultație

**schema_type:** [Alegeți: MedicalWebPage / Article / FAQPage. Alegeți FAQPage doar dacă articolul are mai mult de 3 FAQ-uri și structura principală este Q&A.]

**seo_title:** [50–60 caractere — include cuvântul cheie principal aproape de început]
**seo_description:** [140–155 caractere — include cuvântul cheie, beneficiul pacientului, CTA implicit]

---

SECȚIUNEA 2 — CORP ARTICOL (introdus în editorul Elementor)

Scrieți corpul articolului în HTML semantic. Folosiți:
- <h2> pentru secțiunile principale (maximum 6)
- <h3> pentru subsecțiuni
- <p> pentru paragrafe
- <ul><li> pentru liste
- <strong> pentru termeni importanți la prima apariție

Structura obligatorie:

<h2>[Titlu secțiune 1 — context și relevanță pentru pacient]</h2>
<p>[2–3 paragrafe, ~150 cuvinte]</p>

<h2>Cauze și factori de risc</h2>
<p>[1–2 paragrafe introductive]</p>
<ul>
  <li>[Factor de risc 1]</li>
  <li>[Factor de risc 2]</li>
  ...
</ul>

<h2>Simptome frecvente</h2>
<p>[1 paragraf introductiv]</p>
<ul>
  <li>[Simptom 1 — localizare și descriere]</li>
  ...
</ul>

<h2>Diagnostic</h2>
<p>[Ce implică evaluarea: anamneză, examen neurologic, investigații imagistice]</p>

<h2>Opțiuni de tratament</h2>
<p>[Tratament conservator mai întâi]</p>
<p>[Tratament chirurgical — când este indicat; legați intern la pagina de intervenție dacă există]</p>

<h2>Când să consultați un medic</h2>
<p>[Semnale clare — nu alarmiste, dar precise]</p>

<p><em>Informațiile din acest articol au caracter educativ general și nu înlocuiesc consultul medical de specialitate. Fiecare pacient are un tablou clinic unic, iar recomandările de tratament sunt stabilite individual, în urma evaluării medicale. Dacă aveți simptome, consultați un medic.</em></p>

---

CONSTRÂNGERI OBLIGATORII:
1. NU promiteți rezultate: nicio frază de tipul „vă vindecăm", „garantăm", „cel mai bun"
2. NU generați statistici fără context sau sursă
3. NU scrieți în locul medicului — articolul explică, nu prescrie
4. Marcați outputul cu: [DRAFT — NECESITĂ REVIZIE MEDICALĂ DE DR. UNGUREANU]
5. Limba: română corectă, cu diacritice (ș ț ă â î — nu ş ţ)
```

---

## Output Checklist (before medical review)

- [ ] All ACF fields completed (`post_title` through `seo_description`)
- [ ] `short_summary` ≤ 155 characters
- [ ] At least 3 FAQ pairs
- [ ] Body is structured HTML with correct heading hierarchy
- [ ] Medical disclaimer present at end of body
- [ ] `[DRAFT — NECESITĂ REVIZIE MEDICALĂ]` marker visible
- [ ] `seo_title` 50–60 chars; `seo_description` 140–155 chars
- [ ] No prohibited claims
