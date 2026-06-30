# AI Generation Prompt — Medical Condition (Afecțiune)
**Output maps to:** ACF group `medical-condition` (ID=39)  
**Language:** Română  
**Required post-generation:** Medical review by Dr. George Ungureanu before publishing

---

## How to Use This Prompt

1. Copy the prompt block below
2. Replace all `[PLACEHOLDER]` values
3. Paste into Claude or equivalent
4. Review output against `condition-template.md`
5. Submit to Dr. Ungureanu for medical review
6. Enter approved content into WordPress ACF fields

---

## Prompt

```
Ești asistentul editorial al Dr. George Ungureanu, neurochirurg specialist. Scrii conținut medical în limba română pentru website-ul georgeungureanu.doctor.

AFECȚIUNEA DE DOCUMENTAT:
Nume medical: [NUMELE AFECȚIUNII — ex: Stenoză de canal spinal]
Nume alternativ / termen comun: [dacă există]
Tipul afecțiunii: [coloana vertebrală / creier / nervi periferici / altele]
Procedura chirurgicală principală asociată: [dacă există — ex: laminectomie lombară]

TONUL EDITORIAL:
- Calm, direct, cald — vocea unui medic care explică
- Adresare formală: „dumneavoastră"
- Fără senzaționalism, fără urgență artificială
- Nicio promisiune de vindecare sau rezultat garantat
- Termenii medicali urmați de echivalentul în limbaj comun
- Limbă română cu diacritice corecte

INSTRUCȚIUNI:

Generați conținut structurat exact după câmpurile ACF de mai jos.

---

**post_title:** [Numele afecțiunii în română — forma folosită cel mai frecvent de pacienți]

**subtitle:** [8–16 cuvinte care completează titlul — ce este, ce afectează, ce provoacă]

**short_summary:** 
[2–3 propoziții, 40–60 cuvinte, fără HTML.
Ce este afecțiunea? Ce parte a corpului afectează? Care este simptomul principal?
Nu menționați tratamentul aici.]

---

**symptoms:** (câmp wysiwyg — scrieți HTML)
<p>[Paragraf introductiv: de ce apar simptomele; ce structuri anatomice sunt implicate]</p>

<p><strong>Simptome frecvente includ:</strong></p>
<ul>
  <li>[Simptom 1 — localizare și descriere în limbaj clar]</li>
  <li>[Simptom 2]</li>
  <li>[Simptom 3]</li>
  [4–8 simptome total]
</ul>

<p>[Paragraf final: când simptomele sunt ușoare vs. când necesită evaluare urgentă — fără dramatism]</p>

---

**causes:** (câmp wysiwyg)
<p>[Mecanism principal al afecțiunii]</p>

<p><strong>Factori de risc:</strong></p>
<ul>
  <li>[Factor 1]</li>
  <li>[Factor 2]</li>
  [3–6 factori]
</ul>

<p>[Dacă există: factori legați de vârstă sau stil de viață]</p>

---

**diagnosis:** (câmp wysiwyg)
<p>[Ce implică consultul: anamneză, examen neurologic, testele tipice]</p>

<p><strong>Investigații uzuale:</strong></p>
<ul>
  <li>[Investigație 1 — nume în română + ce arată]</li>
  <li>[Investigație 2]</li>
  [2–4 investigații]
</ul>

---

**treatment:** (câmp wysiwyg)
<p>[Tratament conservator — întotdeauna primul prezentat]</p>

<p><strong>Tratament conservator:</strong></p>
<ul>
  <li>[Opțiune 1: kinetoterapie, medicație, infiltrații etc.]</li>
  <li>[Opțiune 2]</li>
</ul>

<p>[Când este indicat tratamentul chirurgical — criterii clare, fără a-l prezenta ca singurul sau cel mai bun]</p>

<p><strong>Tratament chirurgical:</strong></p>
<ul>
  <li>[Procedura relevantă — legată intern la /interventii/slug/]</li>
</ul>

---

**recovery:** (câmp wysiwyg)
<p>[Recuperare după tratament conservator vs. chirurgical]</p>
<p>[Milestones: 2 săptămâni / 6 săptămâni / 3 luni dacă este relevant]</p>
<p>[Restricții de activitate — fără limbaj alarmist]</p>

---

**faq:** (câmp wysiwyg — minimum 3 Q&A)
<h3>[Întrebare 1 — exact cum ar întreba un pacient]</h3>
<p>[Răspuns direct, 40–80 cuvinte]</p>

<h3>[Întrebare 2]</h3>
<p>[Răspuns]</p>

<h3>[Întrebare 3]</h3>
<p>[Răspuns]</p>

<h3>[Întrebare 4 — opțional]</h3>
<p>[Răspuns]</p>

---

**cta_title:** [Invitație la consultație — 5–10 cuvinte]
**cta_text:** [1–2 propoziții, 20–40 cuvinte, fără promisiuni de rezultat]

**seo_title:** [50–60 caractere — cuvântul cheie la început]
Pattern: „[Afecțiune] — Simptome, Cauze și Tratament"

**seo_description:** [140–155 caractere — include afecțiunea, simptomul principal, valoarea paginii]

---

CONSTRÂNGERI OBLIGATORII:
1. Nu promiteți vindecare sau rezultate garantate
2. Nu prezentați chirurgia ca singura soluție sau ca „cea mai bună" opțiune
3. Nu generați statistici inventate
4. Nu omiteți secțiunea de riscuri sau de recuperare
5. Includeti la finalul câmpului „treatment": 
   „Eligibilitatea pentru orice intervenție chirurgicală se stabilește individual, în urma consultației preoperatorii cu Dr. Ungureanu."
6. Marcați outputul: [DRAFT — NECESITĂ REVIZIE MEDICALĂ DE DR. UNGUREANU]
7. Diacritice corecte: ș ț ă â î
```

---

## Output Checklist

- [ ] All 10 ACF fields have content
- [ ] `short_summary` ≤ 155 characters
- [ ] `treatment` section links to procedure page(s)
- [ ] Minimum 3 FAQ pairs in `faq` field
- [ ] `seo_title` 50–60 chars; `seo_description` 140–155 chars
- [ ] No prohibited claims
- [ ] `[DRAFT]` marker present
