# AI Generation Prompt — Internal Linking Strategy
**Purpose:** Identify internal linking opportunities across existing content  
**Output:** Recommended links to add to a specific piece of content  
**Language:** Română (for anchor text); English acceptable for strategy output  
**Review required:** Editorial (no medical review needed for link placement)

---

## How to Use

Use this prompt when:
- Publishing a new article/condition/procedure and deciding which existing content to link to
- Auditing an existing page for missing internal links
- Building a linking map for a content cluster

---

## Prompt

```
Ești specialist în arhitectura de conținut și SEO pentru website-ul medical georgeungureanu.doctor.

CONTEXT WEBSITE:
Structura URL:
- /articole/{slug}/ — articole medicale pentru pacienți
- /afectiuni/{slug}/ — fișe de afecțiuni neurologice/neurochirurgicale
- /interventii/{slug}/ — proceduri chirurgicale
- /programari/ — pagina de programare consultație
- /despre/ — pagina Dr. George Ungureanu

PAGINA ANALIZATĂ:
Titlu: [Titlul paginii]
URL: [URL-ul paginii]
Tip: [Articol / Afecțiune / Intervenție]
Rezumat scurt: [2–3 propoziții despre subiect]

CONȚINUT EXISTENT PE SITE (listați paginile publicate):
Afecțiuni:
- /afectiuni/hernie-de-disc-lombara/ — Hernie de disc lombară
- [adăugați celelalte afecțiuni publicate]

Intervenții:
- /interventii/microdiscectomie-lombara/ — Microdiscectomie lombară
- [adăugați celelalte proceduri publicate]

Articole:
- /articole/hernia-de-disc-lombara/ — [DEMO] Hernia de disc lombară
- [adăugați celelalte articole publicate]

INSTRUCȚIUNI:

1. CROSS-LINKS RECOMANDATE (ACF fields)
Identificați care pagini existente ar trebui setate în câmpurile ACF de cross-linking:
- related_condition_1/2/3 (pentru articole)
- related_procedure_1/2/3 (pentru articole)
- related_article_1/2/3 (pentru articole)

Format output:
related_condition_1: /afectiuni/[slug]/ — [Justificare în 1 propoziție]
related_procedure_1: /interventii/[slug]/ — [Justificare]

2. INLINE LINK OPPORTUNITIES
Identificați fraze din conținutul paginii analizate unde ar trebui adăugate link-uri interne.

Format:
„[fraza exactă din text]" → [URL target] → [Justificare]

Exemplu:
„hernia de disc lombară" → /afectiuni/hernie-de-disc-lombara/ → pagina dedicată afecțiunii tratate în context

3. PAGINI CARE AR TREBUI SĂ LEGE ÎNAPOI
Identificați ce pagini existente ar trebui să adauge un link spre pagina analizată.

Format:
Pagina sursă: [URL] — fraza recomandată pentru link: „[anchor text]"

4. OPORTUNITĂȚI DE CONȚINUT (goluri de linking)
Dacă există referințe la afecțiuni/proceduri care nu au încă pagini pe site, listați-le ca oportunități de conținut viitor.

CONSTRÂNGERI:
- Anchor text: descriptiv, în română, nu generic („click aici")
- Maximum 2 link-uri spre același URL din același articol
- Nu sugerați link-uri spre pagini care nu există încă (în afara secțiunii 4)
- Volumul de link-uri: 3–6 inline links per pagină (nu supraîncărcați)
```

---

## Manual Linking Checklist

After receiving AI recommendations, verify before implementation:

- [ ] Each suggested target URL exists and returns 200
- [ ] Target page is published (not draft)
- [ ] Anchor text is natural in context (not keyword-stuffed)
- [ ] No more than 2 links to the same target from the same page
- [ ] `/programari/` linked at least once per page (in CTA — handled by shortcode)
- [ ] ACF cross-link fields updated in WordPress admin

---

## Content Cluster Map (Current)

```
[COLOANA VERTEBRALĂ CLUSTER]
├── Afecțiuni
│   └── /afectiuni/hernie-de-disc-lombara/
├── Intervenții
│   └── /interventii/microdiscectomie-lombara/
└── Articole
    └── /articole/hernia-de-disc-lombara/ [DEMO]

[CLUSTERS NEDEZVOLTATE — oportunități de conținut]
├── Stenoza spinală (afecțiune → laminectomie → articole)
├── Tumori cerebrale (afecțiune → craniotomie → articole)
├── Nevralgie trigeminală (afecțiune → procedură → articole)
└── Hidrocefalie (afecțiune → proceduri → articole)
```

Update this map as new content is published.

---

## ACF Cross-Link Priority Rules

When choosing which posts to set in ACF cross-link fields:

1. **Strongest signal:** The article directly discusses the condition/procedure as its main topic
2. **Second:** The article mentions the condition/procedure in a key section (causes, treatment)
3. **Avoid:** Tenuous connections just to fill the 3 available slots — leave blank rather than force irrelevant links
