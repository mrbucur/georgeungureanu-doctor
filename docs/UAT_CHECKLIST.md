# UAT Checklist — Pre-review pentru Dr. George Ungureanu

Acest document servește ca listă de verificare înainte de prima sesiune de review cu clientul. Bifați fiecare punct sau notați observații.

**Browser recomandat pentru review:** Chrome / Safari (desktop), Safari (iPhone)
**URL local:** http://georgeungureanu-doctor-dev.local
**Viewports de verificat:** Desktop 1440px · Tablet 768px · Mobile 390px

---

## 1. Navigație globală

- [ ] Logo vizibil și linkuiește spre homepage
- [ ] Meniu desktop: toate cele 6 linkuri afișate corect (Acasă, Despre, Afecțiuni, Intervenții, Programări, Recomandări)
- [ ] Meniu mobile: hamburger funcțional, meniu se deschide/închide
- [ ] Link „Programări" din header deschide pagina corectă
- [ ] Footer: toate linkurile funcționale, nicio adresă sau telefon placeholder vizibil
- [ ] Nu există linkuri `href="#"` vizibile pentru utilizator

---

## 2. Homepage

- [ ] Hero: fotografie doctor sau imagine profesională (nu placeholder)
- [ ] Hero: titlul H1 „Dr. George Ungureanu" vizibil și lizibil
- [ ] Hero: paragraful de suport (#424245) lizibil pe fond alb
- [ ] Hero: linia de credențiale (#6E6E73) vizibilă
- [ ] Hero: butonul primar „Programează o consultație" duce la /programari/
- [ ] Hero: butonul secundar „Află mai multe" funcțional (nu este ghost alb pe fond deschis)
- [ ] Secțiunea statistici: cifrele sunt corecte și relevante
- [ ] Carduri afecțiuni: minim 3 carduri vizibile, imaginile nu sunt broken
- [ ] Secțiunea CTA finală: gradient alb→gri (#F2F2F7), text negru, buton albastru
- [ ] CTA finală: „Consultații disponibile în Cluj-Napoca, Baia Mare și online." vizibil
- [ ] CTA finală: butonul primar duce la /programari/
- [ ] CTA finală: linkul „Vezi clinicile" duce la /despre/
- [ ] Footer apare după CTA finală, nu se suprapun

---

## 3. Pagina Despre

- [ ] Fotografie doctor prezentă și de calitate (nu placeholder)
- [ ] Heading „Filosofia mea de practică" vizibil pe fond deschis (nu alb pe alb)
- [ ] Bara credențiale: titluri corecte și actuale
- [ ] Secțiunea parcurs profesional: informații reale (nu placeholder)
- [ ] Secțiunea media: linkuri reale (nu #)
- [ ] Membrii asociații: completate sau secțiunea ascunsă
- [ ] Interese: carduri cu text real

---

## 4. Pagina Programări

- [ ] Secțiunea Cluj-Napoca: adresă reală, buton cu link real
- [ ] Secțiunea Baia Mare: adresă reală, buton cu link real
- [ ] Secțiunea Online: buton „Programează o consultație online" cu link Cal.com real
- [ ] Secțiunea Online: mențiunea „Google Meet" prezentă
- [ ] Nu există butoane cu `href="#"` vizibile pentru utilizator
- [ ] Lista „Ce să aduci la consultație" completă și relevantă
- [ ] FAQ: cel puțin 5 întrebări, răspunsuri complete
- [ ] FAQ online: răspunsurile despre consultația online sunt corecte
- [ ] Număr telefon și e-mail reale (nu placeholder)

---

## 5. Hub educațional (Sfatul Dr. George / Articole)

- [ ] Minim 3 articole publicate cu conținut complet
- [ ] Fiecare articol are titlu, imagine și rezumat
- [ ] Filtrele de categorie funcționează (dacă sunt active)
- [ ] Pagina singulară articol: conținut complet, fără text Lorem ipsum
- [ ] Articol singular: secțiunea „Articole similare" afișează carduri reale
- [ ] Video: dacă există linkuri YouTube, acestea funcționează
- [ ] Articole externe recomandate: linkuri funcționale

---

## 6. Arhive Afecțiuni și Intervenții

- [ ] Arhivă afecțiuni: carduri cu imagini reale, titluri corecte
- [ ] Pagină singulară afecțiune: conținut medical complet
- [ ] Pagină singulară afecțiune: secțiunea „La ce să te aștepți" prezentă
- [ ] Pagină singulară afecțiune: linkuri spre intervenții corelate funcționale
- [ ] Arhivă intervenții: carduri complete
- [ ] Pagină singulară intervenție: ghid preoperator și postoperator prezente

---

## 7. Pagina Recomandări

- [ ] Secțiunea Colegi: recomandări reale de la medici (nu placeholder)
- [ ] Secțiunea Colegi: toate câmpurile completate (nume, specialitate, clinică, citat)
- [ ] Secțiunea Pacienți: mărturii reale cu consimțământ semnat
- [ ] Fotografii colegi: prezente sau secțiunea funcționează fără ele

---

## 8. Experiență mobile (390px — iPhone)

- [ ] Meniu hamburger funcțional pe toate paginile
- [ ] Textul hero lizibil (nu overflow sau text tăiat)
- [ ] Butoanele au dimensiune minimă de 44px (ușor de apăsat cu degetul)
- [ ] CTA finală homepage: ambele butoane vizibile și funcționale
- [ ] Pagina Programări: carduri clinică nu se suprapun
- [ ] Formularele (dacă există) funcționează pe mobile
- [ ] Footer: informațiile de contact vizibile și linkabile (tel:, mailto:)
- [ ] Nu există scroll orizontal pe nicio pagină

---

## 9. Conținut lipsă vizibil pentru utilizator

- [ ] Nu există texte „Lorem ipsum" pe nicio pagină
- [ ] Nu există imagini placeholder (imagine generică, imagine ruptă)
- [ ] Nu există linkuri „#" pe care utilizatorul le poate apăsa
- [ ] Nu există secțiuni complet goale vizibile
- [ ] Nu există mesaje de eroare sau notificări WordPress vizibile

---

## 10. Brand și consistență vizuală

- [ ] Toate heading-urile folosesc Inter (nu serif/Lora)
- [ ] Culorile principale: albastru #0E7FC0, text #1D1D1F, secundar #424245
- [ ] Nu există text alb pe fundal deschis (contrast insuficient)
- [ ] Nu există butoane negre — toate butoanele primare sunt albastre
- [ ] Spațierea secțiunilor este consistentă (nu secțiuni lipite sau cu gap uriaș)
- [ ] Border-radius consistent: carduri 20px, butoane 8px

---

## 11. Performanță și funcționalitate de bază

- [ ] Toate paginile se încarcă sub 5 secunde pe conexiune normală
- [ ] Nicio eroare vizibilă în consola browser (F12 → Console)
- [ ] Imaginile nu sunt broken (nu afișează iconița de imagine lipsă)
- [ ] Animațiile de scroll (fade-in) funcționează la prima vizitare
- [ ] Hover pe carduri: efect lift vizibil și plăcut (nu excesiv)

---

## Note review sesiune

**Data review:**
**Participant(i):**

| # | Pagină / Secțiune | Observație | Prioritate | Rezolvat |
|---|-------------------|------------|------------|----------|
| 1 | | | | |
| 2 | | | | |
| 3 | | | | |
| 4 | | | | |
| 5 | | | | |

---

*Generat: Sprint 9.12 — Final Visual Consistency & Content Reality Pass*
