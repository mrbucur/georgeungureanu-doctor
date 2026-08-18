# Client Decisions Required

Decisions that are blocking implementation or content publication.
Updated as decisions are made or new blockers are identified.

**Acesta este registrul canonic pentru toate răspunsurile și deciziile primite
de la Dr. George Ungureanu.** `CLIENT_CONTENT_REQUIRED.md` rămâne doar inventar
istoric și nu trebuie actualizat în paralel.

**Format:** Each item lists what is needed, why it is blocking, and the current status.

## Cum adăugăm răspunsurile lui George

Pentru fiecare răspuns nou păstrăm patru niveluri distincte:

1. **Răspuns brut** — formularea primită, fără reinterpretare.
2. **Variantă normalizată** — informația structurată pentru proiect.
3. **Text public propus** — copy adaptat pentru pacient, dacă este necesar.
4. **Aprobare publicare** — confirmare explicită înainte de publicarea
   informațiilor medicale, tarifelor, titlurilor sau politicilor.

Statusurile folosite sunt: `AȘTEAPTĂ RĂSPUNS`, `PRIMIT`, `DE VERIFICAT`,
`APROBAT`, `IMPLEMENTAT`, `PUBLICAT` și `AMÂNAT`.

### Jurnal de răspunsuri primite

| ID | Data primirii | Răspuns brut | Variantă normalizată | Aprobare | Implementare |
|---|---|---|---|---|---|
| ID-01 | 2026-07-22 | „George Ungureanu” | Nume public: **George Ungureanu** | APROBAT — răspuns explicit la formularea dorită pe site | IMPLEMENTAT în configurația implicită |
| ID-02 | 2026-07-22 | „Medic Primar Neurochirurg, Doctor in Medicina” | Titlu public: **Medic Primar Neurochirurg, Doctor în Medicină** | APROBAT — răspuns explicit pentru titlul profesional complet | IMPLEMENTAT în configurația implicită și Schema.org |
| LOC-01 | 2026-07-22 | „Cluj-Napoca”; „Baia-Mare” | Orașe de consultație: **Cluj-Napoca** și **Baia Mare** | APROBAT; „Baia Mare” normalizat la forma oficială | IMPLEMENTAT în configurația implicită; Q1 rămâne parțial deschisă pentru clinici și adrese |
| ONL-01 | 2026-07-22 | „Evaluarea unui dosar medical complet - este vorba de un caz in care s-a recomandat evaluare neurochirurgicala/ recomandare pentru operatie/ se solicita a doua opinie neurochirurgicala; exista RMN/ CT recent efectuat, pacientul sau apartinatorul este disponibil pentru a raspunde intrebarilor cunoscand foarte bine simptomele si istoricul lor” | Potrivită pentru evaluarea unui dosar medical complet, când există recomandare de evaluare neurochirurgicală, recomandare de operație sau solicitare de a doua opinie; necesită RMN/CT recent și disponibilitatea pacientului ori a unui aparținător bine informat | APROBAT — răspuns medical direct | IMPLEMENTAT în pagina Programări și ghidul consultațiilor online |
| ONL-02 | 2026-07-22 | „nu este potrivita in cazul in care nu a fost recomandata evaluarea neurochirurgicala - daca pacientul doar doreste sa afle anumite lucruri” | Nu este potrivită fără recomandare de evaluare neurochirurgicală sau pentru întrebări generale exclusiv informative | APROBAT — răspuns medical direct | IMPLEMENTAT în pagina Programări și ghidul consultațiilor online |
| ONL-03 | 2026-07-22 | „de la 30 de min pana la 45” | Durata consultației online: **30–45 de minute** | APROBAT — răspuns direct | IMPLEMENTAT în pagina Programări și ghidul consultațiilor online; configurarea exactă Cal.com rămâne de stabilit |
| ONL-04 | 2026-07-22 | „nu e nici una obligatorie; RMN; CT; scrisori medicale; bilet de externare” | Documente recomandate, dar neobligatorii: RMN, CT, scrisori medicale și bilet de externare | APROBAT — răspuns medical direct | IMPLEMENTAT în pagina Programări și ghid; canalul tehnic de trimitere rămâne de stabilit |
| ONL-05 | 2026-07-22 | „Nu poate constitui o recomandare ferma avand in vedere ca anumite lucruri nu pot fi evaluate online- pacientul nu poate fi examinat clinic.” | Consultația online nu poate constitui o recomandare fermă, deoarece pacientul nu poate fi examinat clinic și anumite aspecte nu pot fi evaluate la distanță | APROBAT — formulare medicală directă | IMPLEMENTAT vizibil în pagina Programări și în ghidul consultațiilor online |
| CAR-01 | 2026-07-22 | „medic specialist: 2018; medic primar: 2024; sunt rezident in Neurochirurgie din 2011, specialist din 2018” | Parcurs: neurochirurgie din 2011, medic specialist din 2018, medic primar din 2024 | APROBAT — cronologie profesională directă | IMPLEMENTAT în configurație și pagina Despre; experiența numerică se calculează automat din 2011 |
| PHD-01 | 2026-07-22 | „Modele de interacţiune între meningioamele de bază de craniu şi elementele vasculare şi nervoase cerebrale şi influenţa cisternelor arahnoidiene în dezvoltarea tumorală”; „2025”; „UMF Iuliu Hatieganu Cluj” | Doctorat în 2025 la UMF „Iuliu Hațieganu” Cluj-Napoca; titlul tezei păstrat integral, cu diacritice normalizate | APROBAT — date academice directe | IMPLEMENTAT în configurație și fallback-ul paginii Despre |
| EXP-01 | 2026-07-22 | „peste 1500” pacienți operați | **Peste 1.500 de pacienți operați** | APROBAT — indicator aproximativ solicitat explicit | IMPLEMENTAT în credențialele paginii Despre |
| EXP-02 | 2026-07-22 | „Neurochirurgia tumorala si spinala degenerativa” | Direcții principale: **neurochirurgie tumorală** și **chirurgie spinală degenerativă** | APROBAT — expertiză declarată direct | IMPLEMENTAT în hero și domeniile de expertiză |
| BIO-01 | 2026-07-22 | „Ceea ce mă diferențiază ca neurochirurg este combinația dintre experiența chirurgicală vastă și pregătirea internațională...” | Diferențiator: experiență chirurgicală, formare în centre europene și angajament pentru dezvoltarea chirurgiei tumorilor spinale în România | APROBAT — declarație personală directă | IMPLEMENTAT ca fallback editorial în pagina Despre |
| BIO-02 | 2026-07-22 | „sa simta ca poate avea incredere - nu vreau sa fie despre transmiterea unei senzatii «asta se lauda»” | Obiectiv editorial: încredere prin fapte verificabile, ton reținut și orientare către pacient; fără autoelogiu | APROBAT — regulă de ton | IMPLEMENTAT în copy-ul paginii Despre |
| PERS-01 | 2026-07-22 | „drumetia, meditatia; alergatul; bicicleta” | Interese personale discrete: drumeție, meditație, alergare și ciclism | APROBAT — includere personală solicitată | IMPLEMENTAT discret în pagina Despre |
| MED-01 | 2026-07-22 | „un consult neurochirurgical nu se justifică doar fiindcă ai efectuat o investigație... sau atunci când ai niște dureri și vrei un tratament medicamentos. În general... recomandat de medici din alte specialități” | Consultația neurochirurgicală este, în general, indicată la recomandarea unui alt medic; nu este destinată exclusiv interpretării unui RMN sau prescrierii de tratament medicamentos pentru durere | APROBAT — răspuns medical direct | IMPLEMENTAT în Programări și FAQ educațional |
| MED-02 | 2026-07-22 | „DOAR ATUNCI CÂND ȚI-A FOST RECOMANDATĂ DE CEL PUȚIN DOI MEDICI NEUROCHIRURGI” | Înaintea deciziei de operație la coloană se recomandă confirmarea indicației de către cel puțin doi neurochirurgi | APROBAT — principiu declarat al practicii | IMPLEMENTAT în FAQ; prezentat ca recomandarea lui George, nu regulă universală |
| MED-03 | 2026-07-22 | „Când NU este necesară operația? de cele mai multe ori și vezi ce am spus mai sus”; „Când ar trebui să cer o a doua opinie? tot timpul” | În majoritatea evaluărilor operația nu este necesară; o a doua opinie este recomandată întotdeauna, în special înaintea unei decizii chirurgicale | APROBAT — răspuns medical direct | IMPLEMENTAT în FAQ educațional |
| MED-04 | 2026-07-22 | „investigațiile medicale efectuate pentru afecțiunea de care suferi” | La prima consultație se aduc toate investigațiile relevante deja efectuate | APROBAT — răspuns medical direct | IMPLEMENTAT în Programări și ghidul primei consultații |
| MED-05 | 2026-07-22 | „o investigație imagistică este tot timpul necesară pentru ca neurochirurgul să te poată evalua corect. RMN-ul este cea mai utilizată” | Pentru evaluarea din această practică este necesară o investigație imagistică relevantă; RMN-ul este cel mai frecvent utilizat | APROBAT — cerință a practicii | IMPLEMENTAT în Programări și FAQ; formulat ca cerință a practicii, nu regulă universală |
| GUIDE-01 | 2026-07-22 | PDF „Ghidul pacientului după intervențiile neurochirurgicale”, 27 pagini | Sursă medicală pentru recuperare generală, craniană și spinală | APROBAT — material furnizat de George pentru publicare | IMPLEMENTAT ca PDF optimizat, pagină web și secțiune în hubul educațional |
| CV-01 | 2026-07-22 | CV Europass „Gheorghe Ungureanu”, datat 22.01.2025 | Sursă factuală pentru experiență, formare internațională, afilieri și activitate științifică; datele personale sensibile sunt excluse | PRIMIT — necesită selecție editorială, nu publicare integrală automată | CENTRALIZAT în `docs/content/CV_GEORGE_UNGUREANU_SOURCE.md`; reperele relevante sunt implementate în pagina Despre |
| CV-02 | 2026-07-22 | CV: rezident din 01.01.2012; răspuns direct: „rezident în Neurochirurgie din 2011” | Diferență de cronologie care necesită confirmare | DE CONFIRMAT — răspunsul direct mai nou rămâne temporar sursa site-ului | Anul 2011 nu a fost modificat |

La fiecare răspuns nou, actualizăm atât acest jurnal, cât și statusul întrebării
Q corespunzătoare. Informațiile originale nu se suprascriu; corecțiile se adaugă
ca intrări noi pentru a păstra istoricul deciziilor.

---

## CRITICAL — Blocking publication

### Q0 · Identitate și titulatură publică

**Răspuns primit:**
- Nume afișat: **George Ungureanu**
- Titlu profesional complet: **Medic Primar Neurochirurg, Doctor în Medicină**

**Notă editorială:** A fost adăugată doar diacritica din „în”. Capitalizarea
titlului păstrează preferința transmisă de George.

**Status:** `IMPLEMENTAT` — 2026-07-22.

### Q1 · Clinic names and addresses — **PRIMIT ȘI IMPLEMENTAT (2026-07-23)**

**Răspuns complet primit — 2026-07-23**, **cinci locații confirmate**, toate
publicate pe `/programari/` printr-un Loop Grid Elementor legat de CPT-ul
„Locații" (vezi `docs/PROJECT_STATUS.md` pentru detalii tehnice complete):

1. **Hyperclinica MedLife Cluj** — Cluj-Napoca — Calea Moților 32, 400001
   Cluj-Napoca — Miercuri 15:30–18:00 — 0264 960
2. **Spitalul MedLife Humanitas Cluj** — Cluj-Napoca — Str. Frunzișului 77 —
   program **încă neprimit** — 021 9646
3. **Cardiomed Cluj** — Cluj-Napoca — Str. Republicii nr. 17 — Miercuri
   18:00–19:20 — +40 264 406 600
4. **Spital & Policlinica Sfântul Ioan** — Baia Mare — Str. Republicii nr.
   30 — Sâmbătă 09:00–16:00 — 0262 206 620
5. **Clinica de Neurochirurgie — Spitalul Clinic Județean de Urgență
   Cluj-Napoca** — Cluj-Napoca — Str. Victor Babeș nr. 43, Pavilionul VII
   (distinct de sediul administrativ SCJU, Str. Clinicilor nr. 3–5) —
   „Programări telefonice: Luni–joi, 12:00–14:00" (afișat deliberat în loc
   de intervalul 08:00–11:00, care e programul de lucru al medicului, nu
   un interval confirmat de consultații în ambulatoriu) — 0264 592 771,
   interior 5807 — buton principal „Programare online" — notă discretă pe
   card despre necesitatea RMN/CT — fără fotografie (niciuna oficială,
   suficient de mare și cu drepturi clare disponibilă)

**Rămâne necesar de la George:**
- Programul de consultație la Spitalul MedLife Humanitas Cluj (câmpul e
  lăsat gol intenționat — nu s-a inventat un program)
- O fotografie oficială de rezoluție bună pentru Humanitas — cea furnizată
  inițial (192×144px) era prea mică; am folosit temporar o fotografie
  oficială găsită pe domeniul medlife.ro (recepția clinicii); o fotografie
  mai bună sau confirmarea că aceasta poate rămâne definitivă ar fi utile
- O fotografie oficială pentru Clinica de Neurochirurgie SCJU (momentan:
  fallback vizual unitar, fără fotografie)

**Status:** `IMPLEMENTAT` (tehnic, toate cele 5), `AȘTEAPTĂ RĂSPUNS` pentru
programul Humanitas și fotografiile Humanitas + SCJU.

---

### Q2 · Contact email address

**Needed:** Public-facing contact email (e.g., `contact@georgeungureanu.doctor`).

**Blocking:** Programări page, Recomandări page, footer, FAQ answers, Cal.com confirmation email.

**Status:** Placeholder `[CLIENT: email contact]` in use throughout.

---

### Q3 · Contact phone number

**Needed:** Phone number for patient contact (displayed on Programări page CTA).

**Blocking:** Programări page final CTA.

**Status:** Placeholder `[CLIENT: +40 7XX XXX XXX]` in use.

---

### Q4 · Doctor photography

**Needed:** Professional photo of Dr. George Ungureanu for:
- Homepage hero (right column image placeholder)
- Despre page hero
- Footer logo area (optional)

**Blocking:** Hero section, Despre page — currently shows grey placeholder rectangles.

**Status:** Placeholder `Fotografie Dr. George Ungureanu` displayed.

---

### Q5 · Clinic photography

**Needed:** At least one photo per clinic location for the Programări page clinic cards.

**Blocking:** Programări page visual quality.

**Status:** Placeholder `Fotografie clinică — în curând` displayed.

---

## IMPORTANT — Blocking specific features

### Q6 · Consultation pricing

**Needed:** Price for:
- Initial consultation (clinic, in-person)
- Second opinion / follow-up (clinic)
- Online consultation via Cal.com

**Blocking:** FAQ answer ("Cât costă o consultație?"), Cal.com event setup, Stripe payment (if enabled).

**Status:** Placeholder `[CLIENT: Informații tarif consultație]` in FAQ.

---

### Q7 · CNAS reimbursement

**Needed:** Confirmation of whether consultations are reimbursable via CNAS (national health insurance) at either clinic location.

**Blocking:** FAQ answer, trust signals on Programări page.

**Status:** Left blank pending confirmation.

---

### Q8 · Cal.com account — online consultations

**Eligibilitatea consultației online — răspuns primit 2026-07-22:**

Este potrivită pentru evaluarea unui dosar medical complet atunci când:
- a fost recomandată o evaluare neurochirurgicală;
- a fost recomandată o operație și se dorește evaluarea cazului;
- se solicită o a doua opinie neurochirurgicală;
- există un RMN sau CT recent;
- pacientul ori un aparținător bine informat este disponibil pentru a răspunde
  întrebărilor despre simptome și istoricul medical.

Nu este potrivită atunci când nu a fost recomandată o evaluare
neurochirurgicală sau când persoana dorește doar informații generale.

**Status eligibilitate:** `IMPLEMENTAT`.

**Rezolvat — 2026-08-18:**
- cont: `cal.com/georgeungureanu`;
- email dedicat: `consultatii@georgeungureanu.doctor`;
- eveniment: `cal.com/georgeungureanu/consultatie-online`.

**Blocking rămas:** conectarea Google Calendar și Google Meet împreună cu Dr. George.

**Why Cal.com:** See `docs/ONLINE_CONSULTATIONS_SETUP.md`.

**Status:** Cal.com configurat; Google Calendar și Google Meet urmează.

---

### Q9 · Online consultation duration

**Răspuns primit — 2026-07-22:** Consultația online durează între **30 și
45 de minute**.

**Decizie tehnică — 2026-08-18:** un singur interval de 45 de minute.

**Status:** `CONFIGURAT` în Cal.com și pe site.

---

### Q10 · Online consultation cancellation policy

**Needed:** Cancellation terms to display at booking and in confirmation email:
- How many hours notice required for free cancellation?
- Late cancellation fee or no fee?
- No-show policy?

**Recommendation:** 24-hour free cancellation, no fee.

**Blocking:** Cal.com cancellation policy field, FAQ answer.

**Status:** Pending decision.

---

### Q11 · Online payment — now or later

**Needed:** Should patients pay at the time of booking (via Stripe in Cal.com), or pay after the consultation (invoice / bank transfer)?

**Options:**
- **Pay at booking (Stripe):** Reduces no-shows, requires Stripe setup, patients need card.
- **Pay after:** No Stripe setup needed now. Can add later.

**Recommendation:** Launch without payment, add Stripe in Sprint 9.12 once Cal.com is live.

**Blocking:** Cal.com Stripe configuration.

**Status:** Decision deferred to Sprint 9.12.

---

### Q12 · Documents upload process for online consultations

**Răspuns medical primit — 2026-07-22:** Niciun document nu trebuie încărcat
obligatoriu înainte de consultație. Dacă sunt disponibile, pacientul poate transmite:
- RMN;
- CT;
- scrisori medicale;
- bilet de externare.

**Regulă de comunicare:** Încărcarea în avans nu este o condiție pentru
programare. Pentru eligibilitatea consultației online trebuie însă să existe un
RMN sau CT recent, disponibil pentru evaluare, conform răspunsului ONL-01.

**Needed:** How should patients send RMN/CT images and documents before an online consultation?
- Email attachment to `[CLIENT: email]`?
- Upload link (e.g., WeTransfer, Google Drive)?
- Via Cal.com custom fields (text only, no file upload on free plan)?

**Blocking:** Confirmation email instructions, FAQ answer ("Pot trimite RMN/CT înainte?").

**Status:** `APROBAT` pentru lista documentelor; `AȘTEAPTĂ RĂSPUNS` pentru
canalul tehnic și instrucțiunile de trimitere.

---

### Q13 · GDPR / Privacy note for online consultations

**Needed:** Confirmation that the privacy policy covers:
- Cal.com storing patient booking data (name, email, phone)
- Google Meet processing video/audio
- Any email archiving of clinical documents

**Blocking:** Privacy policy page, Cal.com booking page description.

**Status:** Privacy policy page exists as placeholder. Legal review needed before going live with bookings.

### Q13A · Avertisment medical pentru consultația online

**Răspuns primit — 2026-07-22:** „Nu poate constitui o recomandare fermă având
în vedere că anumite lucruri nu pot fi evaluate online — pacientul nu poate fi
examinat clinic.”

**Text public aprobat:** „Consultația online nu poate constitui o recomandare
medicală fermă, deoarece pacientul nu poate fi examinat clinic, iar anumite
aspecte nu pot fi evaluate la distanță.”

**Status:** `IMPLEMENTAT`.

---

## DEFERRED — Not blocking current sprints

### Q14 · International patients

**Needed:** Confirmation of whether Dr. Ungureanu accepts international patients and what the process is (language, payment, documentation).

**Blocking:** FAQ answer, potential dedicated page.

**Status:** Placeholder `[CLIENT: Confirmare pacienți internaționali]` in FAQ.

---

### Q15 · Colleague recommendations content

**Needed:** Written testimonials from colleague doctors (neurologist, orthopaedic surgeon, GP/internist) with:
- Full name
- Hospital / clinic affiliation
- Written quote (agreed and signed)

**Blocking:** Recomandări page. Section not rendered until content exists (see Status).

**Status (2026-07-23):** No content received. The section is no longer shown to
visitors — it previously displayed three placeholder cards with bracketed
`[CLIENT: ...]` text, which was removed from the frontend. In
`wp-plugin/gu-design-system/gu-design-system.php`, the `gu_recomandari_page`
shortcode now gates this section behind `$has_colleague_recommendations =
false;`. To publish: populate the `$colleague_cards` array with real,
approved role/name/institution/quote entries and flip the flag to `true`.

---

### Q16 · Patient testimonials

**Needed:** Patient experience narratives (no star ratings, no scores — per editorial policy).

**Blocking:** Recomandări page, patient section. Section not rendered until content exists (see Status).

**Status (2026-07-23):** No content received. The internal workflow note
(`[CLIENT: PATIENT TESTIMONIAL WORKFLOW REQUIRED]`) was removed from the
frontend — it was visible to real visitors, which is not acceptable. In
`gu_recomandari_page`, this section is now gated behind
`$has_patient_testimonials = false;`. The separate "Share your experience"
section (real visitors inviting contact) was kept, but its own internal
implementation-options note was replaced with a working link to the existing
consultation/contact page (`$programari_url`) instead of a dead end. To
publish testimonials: populate real, consented patient narratives and flip
the flag to `true`.

---

### Q17 · Bio and personal statement

**Needed:** Dr. Ungureanu's first-person professional bio for the Despre page.

**Blocking:** Despre page bio section.

**Status:** Generic placeholder text in use.

### Q17A · Cronologie profesională și doctorat

**Răspuns primit — 2026-07-22:**
- rezident în neurochirurgie din 2011;
- medic specialist din 2018;
- medic primar din 2024;
- doctorat obținut în 2025 la Universitatea de Medicină și Farmacie
  „Iuliu Hațieganu” Cluj-Napoca;
- teza: „Modele de interacțiune între meningioamele de bază de craniu și
  elementele vasculare și nervoase cerebrale și influența cisternelor
  arahnoidiene în dezvoltarea tumorală”.

**Regulă de afișare a experienței:** Preferăm formularea durabilă „Experiență
în neurochirurgie din 2011”. Dacă este necesar un număr, acesta se calculează
automat din anul 2011.

**Status:** `IMPLEMENTAT` ca date structurate și fallback pentru pagina Despre.

### Q17B · Expertiză, diferențiator și dimensiune personală

**Răspunsuri primite — 2026-07-22:**
- peste 1.500 de pacienți operați;
- direcții principale: neurochirurgie tumorală și chirurgie spinală degenerativă;
- diferențiator: experiență chirurgicală, pregătire internațională în centre
  europene și angajament pentru dezvoltarea chirurgiei tumorilor spinale în România;
- obiectivul paginii: pacientul să simtă că poate avea încredere, fără impresia
  de laudă sau auto-promovare;
- interese personale: drumeție, meditație, alergare și ciclism.

**Regulă editorială:** Indicatorul „peste 1.500” este prezentat factual, o singură
dată. Pregătirea internațională este explicată prin relevanța ei pentru practica
medicală și pacient, nu ca listă de prestigiu. Interesele personale apar într-un
singur paragraf discret.

**Status:** `IMPLEMENTAT` în fallback-urile paginii Despre.

### Q18 · Consultația neurochirurgicală, imagistica și decizia de operație

**Răspunsuri primite — 2026-07-22:**
- consultația neurochirurgicală nu este justificată doar de existența unui RMN
  care trebuie interpretat sau de dureri pentru care se dorește medicație;
- în general, evaluarea neurochirurgicală este recomandată de un medic din altă
  specialitate;
- George recomandă ca indicația unei operații la coloană să fie confirmată de
  cel puțin doi neurochirurgi;
- în majoritatea cazurilor, operația nu este necesară;
- o a doua opinie este recomandată întotdeauna;
- la prima consultație se aduc investigațiile efectuate pentru afecțiunea evaluată;
- în cadrul acestei practici, evaluarea necesită imagistică relevantă, RMN-ul
  fiind investigația cel mai frecvent utilizată.

**Notă de siguranță editorială:** Cerința imagisticii și recomandarea celor două
opinii sunt prezentate ca principii ale practicii lui George. Nu sunt formulate
ca reguli medicale universale și nu substituie triajul urgențelor.

**Status:** `IMPLEMENTAT`.

---

## NOU — Identificate în auditul general local (2026-07-23)

### Q19 · Ghidul de recuperare — pagină lipsă, link public rupt — **REZOLVAT (2026-07-23)**

**Ce s-a găsit:** Butonul „Citește ghidul" din hub-ul „Sfatul Neurochirurgului"
ducea la `/ghid-recuperare/`, care întorcea **404** — nu exista nicio pagină
WordPress publicată cu acest slug.

**Ce s-a făcut:** pagină WordPress reală creată (ID 159, slug
`ghid-recuperare`), Elementor nativ, editabilă vizual, structurată pe cele 5
capitole aprobate din shortcode-ul existent `[gu_recovery_guide]` — nicio
formulare medicală nouă, doar text deja aprobat. Butonul de descărcare
servește fișierul PDF real (27 pagini, ~12MB) printr-un endpoint dedicat cu
`Content-Disposition: attachment`. Detalii tehnice complete în
`PROJECT_STATUS.md` §1C. Șablonul vechi `page-ghid-recuperare.php` și
shortcode-ul `[gu_recovery_guide]` au rămas neșterse, pentru rollback.

**Necesar de la George:** nimic — remediere pur tehnică, local only.
Staging și live nu au fost atinse.

**Status:** `REZOLVAT` — verificat HTTP 200, ancore funcționale, descărcare
PDF confirmată, zero regresii pe restul site-ului.

---

### Q20 · Text intern „[CLIENT: ...]" vizibil public — **remediere de cod aplicată (2026-07-23)**

**Ce s-a găsit:** textul instructiv intern (valori implicite ale câmpurilor
ACF, necompletate încă) apărea direct pe pagina publică, pe Despre
(portret, tagline, afilieri, activitate didactică), Programări (denumiri
clinici, hartă, tarife CNAS, pacienți internaționali, link Cal.com) și pe
articolul demo („add specializations").

**Remediere aplicată:** gating consecvent (`gu_about_content_is_missing()`)
pe toate câmpurile afectate; valorile ACF placeholder au fost golite prin
`update_field()`; secțiunile fără conținut real (carduri clinici, buton
Cal.com, 2 întrebări FAQ) sunt fie ascunse, fie înlocuite cu un mesaj public
discret („va fi publicat în curând"). Detalii complete: `docs/PROJECT_STATUS.md`.

**Rămâne necesar de la George** (neschimbat, doar conținutul lipsește acum,
nu mai există cod de remediat): denumirea și adresa fiecărei clinici (C2),
tariful și decontarea CNAS (Q6/Q7), politica pentru pacienți internaționali
(Q14), contul Cal.com (Q8), portretul profesional (C1), tagline-ul și
afilierile profesionale suplimentare (I3).

**Status:** `AȘTEAPTĂ CONȚINUT + REMEDIERE TEHNICĂ`.

---

### Q21 · Statisticile de pe homepage și Despre — verificare

**Ce s-a găsit:** Homepage-ul afișează „15+ Ani de practică neurochirurgicală",
„2.000 Intervenții neurochirurgicale", „98% Satisfacție declarată de
pacienți". Pagina Despre afișează separat „15+ Ani în neurochirurgie",
„2024 Medic primar din", „1.500+ Pacienți operați", „Româna, Engleza —
Limbi de consultație" — cifre diferite de cele de pe homepage
(2.000 vs. 1.500+ intervenții/pacienți). Toate sunt conținut Elementor
(editabile vizual direct în Elementor) — nu cod. Nu există nicio confirmare
din partea lui George în acest document că aceste cifre sunt exacte sau
consecvente între ele.

**Blocking:** afirmații publice, posibil verificabile/contestabile pentru un
medic — aceeași sensibilitate editorială documentată deja la Q18/MED-01…03.

**Necesar de la George:** confirmarea cifrelor exacte (sau cifre actualizate).

**Status:** `AȘTEAPTĂ CONFIRMARE`.

---

## Decision log

| # | Decision | Date | Decision |
|---|---|---|---|
| — | Numele public este „George Ungureanu” | 2026-07-22 | Confirmed ✓ |
| — | Titlul public este „Medic Primar Neurochirurg, Doctor în Medicină” | 2026-07-22 | Confirmed ✓ |
| — | Orașele de consultație sunt Cluj-Napoca și Baia Mare | 2026-07-22 | Confirmed ✓ |
| — | Use Cal.com + Google Meet for online consultations | 2026-07 | Confirmed ✓ |
| — | Do not add Amelia or booking plugins | 2026-07 | Confirmed ✓ |
| — | Defer Stripe payment to Sprint 9.12 | 2026-07 | Confirmed ✓ |
