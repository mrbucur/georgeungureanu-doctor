# Local release readiness — 18 august 2026

## Verificat local

- Pagini: `/`, `/despre/`, `/programari/`, `/articole/`, `/recomandari/`,
  `/ghid-recuperare/`, `/politica-de-confidentialitate/`.
- Desktop și mobil 390 px: fără overflow orizontal și fără imagini rupte.
- Un singur H1 pe fiecare pagină verificată.
- Niciun text public `[DEMO]`, `[CLIENT]`, `coming soon` sau formularea veche
  „specialist în neurochirurgie”.
- Linkul consultației online este
  `https://cal.com/georgeungureanu/consultatie-online`.
- Adresa `consultatii@georgeungureanu.doctor` este folosită exclusiv în
  secțiunea consultațiilor online.
- Durata publicată pentru consultația online este 45 de minute.
- Formularul Cal.com solicită nume, email, telefon și motivul consultației.
- Cal.com este configurat marți și joi, 18:00–20:00, minimum 24 h înainte și
  buffer de 10 minute după consultație.
- Rezervările sunt limitate la maximum 60 de zile în avans și maximum o
  rezervare activă per pacient.
- Verificarea emailului pacientului este obligatorie.
- Notele și detaliile programării sunt ascunse în calendarele partajate, iar
  emailul organizatorului este ascuns în notificările standard Cal.com.
- Fotografia existentă este folosită și pe pagina `/despre/`; placeholderul
  portretului a fost eliminat local.
- Faviconul fallback „GU” este activ.

## Obligatoriu înainte de staging/publicare

1. Conectarea Google Calendar al lui George în Cal.com și verificarea
   prevenirii suprapunerilor.
2. Conectarea Google Meet și înlocuirea locației temporare Cal Video.
3. Stabilirea prețului, monedei și entității care încasează; apoi conectarea
   Stripe și testarea unei plăți complete, abandonate și rambursate.
4. Aprobarea politicii de anulare/reprogramare/rambursare. Recomandare de
   lucru: reprogramare până la 48 h, o singură reprogramare gratuită.
5. Stabilirea unui canal securizat pentru RMN/CT. Site-ul spune acum explicit
   să nu fie trimise documente medicale prin email obișnuit.
6. Revizuirea juridică/GDPR a politicii de confidențialitate pentru Cal.com,
   Google și Stripe.
7. Rezervare end-to-end de test cu George: emailuri, calendar, Meet, plată,
   reprogramare și anulare.

## Necesită conținut sau decizie de la George

- Prețul consultației și politica financiară.
- Contul Google/Calendar care va fi conectat.
- Fotografie pentru pagina `/despre/` (acolo există încă un placeholder
  vizual intenționat).
- Fotografia locației SCJU Cluj, dacă dorește eliminarea ultimului placeholder
  de clinică.
- Confirmarea textului final al instrucțiunilor pacientului și a modului de
  transmitere a investigațiilor.

## Poate aștepta după release candidate

- Automatizări avansate prin webhooks.
- Integrarea Revolut Pay, dacă nu este expusă direct prin Stripe/Cal.com.
- Analytics avansat pentru rezervări și plăți.
- Conținut suplimentar, testimoniale și recomandări noi.

## Remedieri aplicate în această rundă

- Link și email dedicate consultațiilor online, configurabile separat de
  contactul general.
- Copy video neutru în card, compatibil cu tranziția la Google Meet.
- Eliminată promisiunea neaprobată de reprogramare gratuită.
- Eliminată recomandarea de trimitere a RMN/CT prin email obișnuit.
- Eliminată afirmația incorectă că linkul video este valabil o singură dată.
