# AI Generation Prompt — Surgical Procedure (Intervenție)
**Output maps to:** ACF group_sp (ID=55)  
**Language:** Română  
**Required post-generation:** Medical review by Dr. George Ungureanu before publishing

> **Critical:** Procedure content carries higher medical-legal risk than articles or conditions. The `risks` section must be complete. The `benefits` section must never promise outcomes. Dr. Ungureanu's review is non-negotiable before publish.

---

## How to Use This Prompt

1. Copy the prompt block below
2. Replace all `[PLACEHOLDER]` values
3. Paste into Claude or equivalent
4. Review output against `procedure-template.md`
5. Submit to Dr. Ungureanu for medical review — pay special attention to risks and technique sections
6. Enter approved content into WordPress ACF fields

---

## Prompt

```
Ești asistentul editorial al Dr. George Ungureanu, neurochirurg specialist. Scrii conținut medical în limba română pentru website-ul georgeungureanu.doctor.

INTERVENȚIA DE DOCUMENTAT:
Denumire: [NUMELE INTERVENȚIEI — ex: Laminectomie lombară]
Indicație principală: [afecțiunea pe care o tratează]
Abord chirurgical: [minim invaziv / deschis / endoscopic — dacă se știe]
Afecțiunile conexe (pentru linking intern): [afecțiune 1], [afecțiune 2]

TONUL EDITORIAL:
- Calm și precis — tonul unui chirurg care explică unui pacient
- Adresare formală: „dumneavoastră"
- Fără senzaționalism sau dramatism
- Nicio promisiune de vindecare; beneficiile se prezintă cu „în majoritatea cazurilor", „de regulă", „frecvent"
- Riscurile se prezintă complet, onest, fără minimizare
- Termeni medicali + echivalent în limbaj clar

INSTRUCȚIUNI:

Generați conținut structurat după câmpurile ACF de mai jos.

---

**post_title:** [Denumirea intervenției în română]

**subtitle:** [8–16 cuvinte — tipul de intervenție și ce tratează]

**short_summary:** 
[2–3 propoziții, 40–60 cuvinte, fără HTML.
Ce face procedura, cum se realizează (abord), ce obiectiv terapeutic are.
Fără promisiuni de rezultat.]

---

**indications:** (wysiwyg)
<p>[Ce afecțiuni sau condiții tratează această intervenție]</p>

<p><strong>Această intervenție este indicată în cazul:</strong></p>
<ul>
  <li>[Indicație 1]</li>
  <li>[Indicație 2]</li>
  [3–6 indicații]
</ul>

<p>Eligibilitatea pentru această procedură este stabilită în urma consultației și a investigațiilor imagistice complete.</p>

---

**when_surgery_is_recommended:** (wysiwyg)
<p>[Tratamentul conservator este prezentat primul]</p>

<p>Interventia chirurgicală este luată în considerare când:</p>
<ul>
  <li>[Criteriu 1 — de ex: simptomele persistă > 6 săptămâni de tratament conservator]</li>
  <li>[Criteriu 2 — de ex: deficit motor progresiv]</li>
  <li>[Criteriu 3]</li>
</ul>

<p>[Precizare că decizia este individualizată — nu o regulă aplicabilă tuturor]</p>

---

**surgical_technique:** (wysiwyg)
<p>Intervenția se realizează sub <strong>anestezie generală</strong> [sau locală/spinală — dacă se aplică], cu pacientul [poziționare].</p>

<p>[Descriere pas cu pas accesibilă pacientului — nu tehnicilor chirurgicale avansate]</p>

<ul>
  <li>[Pas 1 — incizie, acces, dimensiuni]</li>
  <li>[Pas 2 — ce se realizează]</li>
  <li>[Pas 3 — ce se îndepărtează / repară / decomprimă]</li>
  <li>[Pas 4 — închidere]</li>
</ul>

<p><strong>Durata intervenției:</strong> aproximativ [X–Y] ore.</p>

---

**benefits:** (wysiwyg)
<p>[Obiectivul terapeutic principal — ameliorarea simptomului specific]</p>

<p><strong>Beneficii frecvent raportate:</strong></p>
<ul>
  <li>[Beneficiu 1 — cu hedging: „în majoritatea cazurilor", „de regulă"]</li>
  <li>[Beneficiu 2]</li>
  <li>[Beneficiu 3]</li>
</ul>

<p>Rezultatele individuale variază în funcție de vârstă, starea generală de sănătate și severitatea afecțiunii. Dr. Ungureanu va discuta cu dumneavoastră așteptările realiste la consultația preoperatorie.</p>

IMPORTANT: Nu scrieți nicio variantă a: „garantăm ameliorarea", „veți scăpa de durere", „100% succes", „cea mai bună intervenție".

---

**risks:** (wysiwyg)
<p>Ca orice intervenție chirurgicală, [denumirea intervenției] comportă riscuri care vor fi discutate în detaliu cu Dr. Ungureanu la consultația preoperatorie.</p>

<p><strong>Riscuri generale ale anesteziei:</strong></p>
<ul>
  <li>Reacții alergice la medicamentele anestezice</li>
  <li>Variații ale tensiunii arteriale sau ritmului cardiac</li>
  <li>Greață postoperatorie</li>
</ul>

<p><strong>Riscuri specifice procedurii:</strong></p>
<ul>
  <li>[Risc specific 1]</li>
  <li>[Risc specific 2]</li>
  <li>[Risc specific 3]</li>
  [Listați toate riscurile materiale; nu omiteți riscuri cunoscute pentru această procedură]
</ul>

<p>[1 paragraf despre cum experiența chirurgicală și tehnica utilizată reduc riscurile — fără a le elimina]</p>

IMPORTANT: Secțiunea de riscuri nu poate fi scurtată, minimizată sau omisă. Aceasta este cerința legală și etică fundamentală.

---

**recovery_timeline:** (wysiwyg)
<p><strong>Primele 24–48 ore:</strong> [spitalizare, control durere, mobilizare precoce]</p>

<p><strong>Prima săptămână:</strong> [externare, restricții, îngrijire plagă]</p>

<p><strong>Săptămânile 2–4:</strong> [activitate ușoară, control postoperator, fizioterapie]</p>

<p><strong>Lunile 1–3:</strong> [revenire la activitate normală; diferențiat birou vs. muncă fizică]</p>

<p>Ritmul recuperării variază în funcție de vârstă, condiție fizică și complexitatea intervenției. Dr. Ungureanu va elabora un plan de recuperare individualizat.</p>

---

**faq:** (wysiwyg — minimum 3 Q&A)
<h3>[Întrebare frecventă pre-operatorie]</h3>
<p>[Răspuns clar, 40–80 cuvinte]</p>

<h3>[Întrebare despre recuperare]</h3>
<p>[Răspuns cu termene concrete]</p>

<h3>[Întrebare despre riscuri sau despre ce se întâmplă dacă nu operează]</h3>
<p>[Răspuns honest, fără alarmism]</p>

<h3>[Întrebare opțională]</h3>
<p>[Răspuns]</p>

---

**cta_title:** Aflați dacă această intervenție este potrivită pentru dumneavoastră
**cta_text:** [1–2 propoziții — invitație la consultație; eligibilitatea se stabilește individual]

**seo_title:** [50–60 caractere]
Pattern: „[Intervenție] — Ce Este și Cum Se Realizează"

**seo_description:** [140–155 caractere — include intervenția, indicația principală, invitație]

---

CONSTRÂNGERI OBLIGATORII:
1. Secțiunea de RISCURI: completă, onestă, neminimizată
2. Secțiunea de BENEFICII: fără promisiuni, cu hedging consecvent
3. CÂND ESTE INDICAT: tratamentul conservator prezentat primul
4. Nicio statistică de succes fără sursă credibilă
5. Finalizați fiecare secțiune care menționează chirurgia cu trimitere la consultația individuală
6. Marcați: [DRAFT — NECESITĂ REVIZIE MEDICALĂ DE DR. UNGUREANU]
7. Diacritice: ș ț ă â î
```

---

## Output Checklist

- [ ] All content fields completed
- [ ] `risks` section lists all material risks (not shortened)
- [ ] `benefits` section uses hedging language throughout
- [ ] `when_surgery_is_recommended` presents conservative treatment first
- [ ] `recovery_timeline` uses concrete time ranges
- [ ] Minimum 3 FAQ pairs
- [ ] `seo_title` 50–60 chars; `seo_description` 140–155 chars
- [ ] `[DRAFT]` marker present
