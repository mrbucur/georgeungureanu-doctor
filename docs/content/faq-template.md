# FAQ Template
**Used in:** All three content types (articole, afectiuni, interventii)  
**Shortcode:** `[gu_article_faq]` (for articole — renders FAQPage JSON-LD schema)  
**In conditions/procedures:** FAQ content goes in the `faq` wysiwyg ACF field

---

## Structure

Each FAQ consists of a question and an answer. The question should be exactly what a patient would type into Google.

### Format for wysiwyg fields (conditions, procedures)

```html
<h3>Cât durează recuperarea după [procedură]?</h3>
<p>Recuperarea completă durează de obicei [X–Y săptămâni]. În primele [X] zile veți fi spitalizat. Majoritatea pacienților revin la activitățile ușoare după [X] săptămâni și la activitatea profesională după [X–Y] săptămâni, în funcție de natura muncii.</p>

<h3>Este intervenția dureroasă?</h3>
<p>Intervenția se efectuează sub anestezie generală, deci nu veți simți nimic în timpul operației. Durerea postoperatorie este gestionată cu medicație analgezică și este, de regulă, mai mică decât durerea preoperatorie cauzată de afecțiune.</p>
```

### Format for articole ACF fields (faq_1_question / faq_1_answer)

These are plain-text fields — no HTML tags.

```
faq_1_question: La cât timp după operație mă pot întoarce la muncă?
faq_1_answer: Depinde de tipul de muncă. Pentru activități de birou, majoritatea pacienților revin la 2–4 săptămâni. Pentru muncă fizică, poate fi nevoie de 8–12 săptămâni. Dr. Ungureanu vă va oferi o recomandare personalizată la consultația postoperatorie.
```

---

## Question Types

### Patient Journey Questions (use always)
These address the patient at different stages of their decision process.

**Before diagnosis:**
- Ce simptome ar trebui să mă îngrijoreze?
- Când trebuie să merg la neurochirurg?
- Cât de urgent este să fac investigații?

**Understanding the diagnosis:**
- Ce înseamnă exact [diagnostic]?
- Este [afecțiunea] periculoasă?
- Poate [afecțiunea] să se agraveze fără tratament?

**Before surgery:**
- Există alternative la operație?
- Ce se întâmplă dacă amân intervenția?
- Cum mă pregătesc pentru operație?

**After surgery:**
- Cât durează recuperarea?
- Când pot conduce/lucra/face sport?
- Care sunt semnele că ceva nu este în regulă după operație?

**General:**
- Câte astfel de intervenții a efectuat Dr. Ungureanu?
- Unde se realizează intervenția?
- Cum programez o consultație?

---

## Answer Guidelines

### Length
- Minimum: 2 complete sentences (≈ 30 words)
- Maximum: 4–5 sentences (≈ 100 words)
- Optimal: 40–70 words

### Tone
- Direct and specific, not hedged to the point of meaninglessness
- Acknowledges variation without refusing to give information
- Never dismissive ("It depends" alone is not an answer)

### Prohibited in FAQ answers
- "Results may vary" without any concrete context
- "Ask your doctor" as the only content (the patient IS reading the doctor's content)
- Medical guarantees or cure claims
- Statistics without a source if they are contested
- Language that creates fear ("dangerous," "emergency," "life-threatening") unless clinically accurate and appropriate

### Required in FAQ answers (where applicable)
- Concrete time ranges (not "some time" or "a while")
- A clear recommendation embedded in the answer
- An invitation to discuss individual circumstances at consultation

---

## Article FAQ Fields (group_ar)

| Field key | Requirement |
|-----------|-------------|
| `faq_1_question` | Must be answerable in the article context |
| `faq_1_answer` | Plain text, no HTML, 40–100 words |
| `faq_2_question` | Different topic from faq_1 |
| `faq_2_answer` | |
| `faq_3_question` | **Minimum — must have at least 3 pairs** |
| `faq_3_answer` | |
| `faq_4_question` | Optional |
| `faq_4_answer` | |
| `faq_5_question` | Optional |
| `faq_5_answer` | |

The `[gu_article_faq]` shortcode generates FAQPage JSON-LD from these fields automatically. Do not add separate schema markup for the same questions.

---

## FAQPage Schema Trigger

FAQPage JSON-LD is emitted when:
1. The article's `schema_type` ACF field = `FAQPage`, OR
2. The `[gu_article_faq]` shortcode is present on the page and returns at least 1 pair

See `SCHEMA_GUIDELINES.md` for when to use `FAQPage` vs `MedicalWebPage`.

---

## Example FAQ Block (production-ready)

```
Q: Hernia de disc lombară se poate vindeca fără operație?
A: Da, în majoritatea cazurilor. Aproximativ 80–90% dintre pacienții cu hernie de disc lombar obțin ameliorarea simptomelor prin tratament conservator — repaus relativ, kinetoterapie și medicație antiinflamatoare — în 6–12 săptămâni. Intervenția chirurgicală este recomandată atunci când durerea este severă, persistentă sau când apare deficit motor ori afectare sfincteliană.

Q: Cât durează recuperarea după microdiscectomie lombară?
A: Spitalizarea durează de obicei 1–2 zile. Pacienții revin la activitățile ușoare după 2–4 săptămâni. Revenirea la munca de birou este posibilă în 3–4 săptămâni, iar la munca fizică după 8–12 săptămâni. Dr. Ungureanu va stabili un program de recuperare individualizat în funcție de evoluție.

Q: Există riscul ca hernia să reapară după operație?
A: Rata de recurență după microdiscectomie este de aproximativ 5–10%. Riscul poate fi redus prin menținerea unei greutăți corporale normale, evitarea ridicării greutăților în primele luni postoperator și efectuarea exercițiilor de kinetoterapie recomandate.
```
