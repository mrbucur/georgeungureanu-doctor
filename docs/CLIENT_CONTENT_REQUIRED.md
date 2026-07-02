# Conținut necesar de la Dr. George Ungureanu

Acest document listează tot conținutul pe care site-ul îl așteaptă de la client, grupat după prioritate. Elementele marcate **CRITIC** blochează lansarea. Celelalte pot fi adăugate ulterior.

---

## CRITIC — Obligatoriu înainte de lansare

### C1 · Fotografie profesională (portret)
- **Unde apare:** Hero homepage, pagina Despre, bara laterală articole, card autor
- **Format necesar:** JPEG, minim 1200×1600px, fundal neutru (alb, gri deschis sau exterior clinic)
- **Ce lipsește acum:** Placeholder Elementor / imagine lipsă

### C2 · Linkuri de programare pentru fiecare clinică
- **Unde apare:** Pagina Programări — 3 carduri clinică
- **Ce lipsește acum:** `href="#"` pentru toate cele 3 butoane „Programează"
- **Necesar:**
  - Link programare Cluj-Napoca (Clinica Polisano / altă clinică)
  - Link programare Baia Mare (Spitalul Județean)
  - Link programare online (Cal.com — după crearea contului)

### C3 · Număr de telefon și e-mail de contact
- **Unde apare:** Footer, pagina Programări (secțiunea urgențe), potențial header
- **Ce lipsește acum:** Placeholder „+40 XXX XXX XXX" și „contact@example.com"
- **Important:** Un singur număr sau numerele separate pe clinică?

### C4 · Link consultație online (Cal.com)
- **Unde apare:** Pagina Programări — cardul „Consultație Online", butonul „Programează o consultație online"
- **Ce lipsește acum:** `$online_cal_url = '#'` în PHP (marcat cu comentariu `[CLIENT: CAL.COM ONLINE CONSULTATION LINK]`)
- **Pași:** Creare cont Cal.com → configurare tip eveniment 45 min → conectare Google Calendar → copiere link

### C5 · Adrese complete ale clinicilor
- **Unde apare:** Pagina Programări — carduri clinică, potențial Google Maps embed
- **Ce lipsește acum:** Adresele complete sunt placeholder
- **Necesar:** Stradă, număr, cod poștal, oraș pentru fiecare locație

---

## IMPORTANT — Calitate semnificativ îmbunătățită cu aceste elemente

### I1 · Fotografii clinici (interior / exterior)
- **Unde apare:** Carduri clinică pe pagina Programări
- **Format necesar:** JPEG, minim 800×600px per clinică, calitate profesională
- **Ce lipsește acum:** Imagini placeholder (imagini stoc generice)

### I2 · Biografie extinsă (pagina Despre)
- **Unde apare:** Secțiunea „Parcursul meu profesional"
- **Ce lipsește acum:** Text placeholder — traiectorie generică
- **Necesar:**
  - Universitate și an absolvire
  - Specializare / rezidențiat — unde și când
  - Teze / titluri academice (dacă există)
  - Experiență internațională (stagii, burse, conferințe)
  - Motivația alegerii neurochirurgiei

### I3 · Acreditări și titluri oficiale
- **Unde apare:** Bara de credențiale (Despre), cardul autor articole
- **Ce lipsește acum:** „Medic Specialist Neurochirurgie" — confirmare titlu exact
- **Necesar:**
  - Titlu oficial complet (Specialist / Primar)
  - Colectiv / secție actuală
  - Număr Colegiul Medicilor (opțional, dar crește încrederea)

### I4 · Aparițiile media (interviuri, articole de presă)
- **Unde apare:** Pagina Despre — secțiunea „Media"
- **Ce lipsește acum:** 3 carduri placeholder cu titluri și linkuri fictive
- **Necesar per apariție:** Titlu articol/emisiune, publicație/post TV, dată, URL sau screenshot

### I5 · Articole / blog posts (minimum 3)
- **Unde apare:** Hub educațional „Sfatul Dr. George", arhivă Articole, homepage featured
- **Ce lipsește acum:** 2 articole demo cu conținut schelet
- **Necesar:** Minim 3 articole finalizate cu text complet, titlu SEO, meta-descriere

### I6 · Recomandări de la colegi medici
- **Unde apare:** Pagina Recomandări — secțiunea „Colegi"
- **Ce lipsește acum:** 2 carduri placeholder cu nume fictive
- **Necesar per recomandare:** Nume complet medic, specialitate, clinică/spital, text citat (3-5 propoziții), fotografie (opțional)

### I7 · Recomandări de la pacienți
- **Unde apare:** Pagina Recomandări — secțiunea „Pacienți"
- **Ce lipsește acum:** 3 carduri placeholder cu inițiale fictive
- **Necesar per recomandare:** Prenume + inițială (ex: „Maria D."), afecțiune tratată (opțional), text mărturie, an aproximativ
- **Important legal:** Pacienții trebuie să semneze consimțământ pentru publicare

### I8 · Membrii asociații profesionale
- **Unde apare:** Pagina Despre — secțiunea „Afilieri"
- **Ce lipsește acum:** Lipsă completă / doar text generic
- **Necesar:** Societatea Română de Neurochirurgie? EANS? Alte asociații?

---

## OPȚIONAL — Îmbogățesc experiența, pot fi adăugate post-lansare

### O1 · Videoclipuri educaționale
- **Unde apare:** Hub educațional — secțiunea „Video"
- **Ce lipsește acum:** Carduri placeholder cu link YouTube #
- **Dacă există:** ID-uri YouTube sau URL-uri complete

### O2 · Articole externe recomandate
- **Unde apare:** Hub educațional — secțiunea „Articole recomandate"
- **Ce lipsește acum:** 2 carduri placeholder
- **Necesar:** URL, titlu, sursa (ex: NCBI, Medscape), rezumat 1-2 propoziții

### O3 · Programul de consultații (orar)
- **Unde apare:** Pagina Programări — informație suplimentară
- **Ce lipsește acum:** Nicio informație despre zile/ore disponibile
- **Opțional:** Luni-Vineri 09:00-17:00? Sau specific per clinică?

### O4 · Fotografie intraoperatorie sau de echipament (cu consimțământ)
- **Unde apare:** Potențial hero pagina Despre sau secțiune dedicată
- **Notă:** Necesită consimțământ spitalicesc și al pacientului dacă pacientul apare

### O5 · Google Maps embed per clinică
- **Unde apare:** Pagina Programări — lângă cardurile clinică
- **Necesar:** Adresele complete (C5) + aprobare API key Google Maps

### O6 · CV medical complet (PDF descărcabil)
- **Unde apare:** Pagina Despre — link discret în secțiunea credențiale
- **Format:** PDF, actualizat

### O7 · Meta-descrieri și titluri SEO per pagină
- **Unde apare:** `<head>` — invizibil pentru vizitatori, critic pentru Google
- **Ce lipsește acum:** Titluri și descrieri generice/goale pe mai multe pagini
- **Recomandat:** Un rând de titlu + 155 caractere descriere pentru fiecare din cele 9 pagini

---

## Cum trimiți conținutul

**Fotografii:** Google Drive sau WeTransfer → folder `georgeungureanu-doctor/assets/`

**Texte:** Document Word / Google Docs cu secțiunile clar marcate (ex: „BIOGRAFIE", „RECOMANDARE 1 — Dr. Ion Popescu")

**Linkuri:** Listă simplă în e-mail sau document separat

**Contact pentru livrare:** puiu@bucur.info

---

*Generat: Sprint 9.12 — Final Visual Consistency & Content Reality Pass*
