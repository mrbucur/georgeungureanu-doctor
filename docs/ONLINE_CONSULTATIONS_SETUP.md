# Online Consultations Setup — Cal.com + Google Meet

**Status (2026-08-18):** Contul Cal.com și evenimentul public sunt create.
Google Calendar, Google Meet și Stripe rămân de conectat împreună cu Dr. George.

## Eligibilitate confirmată de Dr. George

Consultația online este destinată evaluării unui dosar medical complet în
situațiile în care a fost recomandată evaluarea neurochirurgicală, a fost
recomandată o operație sau se solicită o a doua opinie neurochirurgicală.

Pentru ca evaluarea să fie utilă, trebuie să existe un RMN sau CT recent, iar
pacientul sau un aparținător care cunoaște foarte bine simptomele și istoricul
medical trebuie să fie disponibil pentru întrebări.

Consultația online nu este potrivită dacă nu a fost recomandată o evaluare
neurochirurgicală sau dacă persoana dorește doar informații generale.

**Durată configurată:** un singur interval de 45 de minute.

### Documente înainte de consultație

Niciun document nu trebuie încărcat obligatoriu înainte de consultație. Dacă
pacientul le are disponibile, sunt recomandate: RMN, CT, scrisori medicale și
biletul de externare. Pentru eligibilitatea consultației trebuie totuși să existe
un RMN sau CT recent, disponibil pentru evaluare. Canalul securizat prin care
documentele vor fi trimise nu este încă stabilit.

### Avertisment medical aprobat

Consultația online nu poate constitui o recomandare medicală fermă, deoarece
pacientul nu poate fi examinat clinic, iar anumite aspecte nu pot fi evaluate la
distanță.

**Platform:** Cal.com (scheduling) + Google Meet (video)
**Payment:** obligatorie la programare; implementarea va folosi integrarea
nativă Stripe din Cal.com după confirmarea prețului și a entității care încasează.

---

## Why Cal.com

| Criterion | Cal.com | Alternative |
|---|---|---|
| Cost at low volume | Free tier sufficient | Amelia: ~$79/yr; Acuity: ~$16/mo |
| WordPress plugin required | No — external link | Amelia requires plugin |
| Google Meet integration | Native, automatic | Varies |
| GDPR / data residency | EU hosting available | Varies |
| Customisable booking page | Yes | Yes |
| Stripe payment (later) | Built-in, optional | Varies |
| Patient-facing branding | Custom URL + logo | Varies |

**Decision rationale:** Volume is expected to be low (single practitioner, specialist referrals). A lightweight external scheduling link avoids plugin maintenance overhead and keeps WordPress lean. If volume grows significantly, revisit Amelia or a dedicated booking system.

---

## Account Setup

1. Cont creat la **cal.com/georgeungureanu** cu adresa dedicată
   `consultatii@georgeungureanu.doctor`.
2. Eveniment public: `https://cal.com/georgeungureanu/consultatie-online`.
3. De realizat împreună cu Dr. George — conectarea Google Calendar:
   - Settings → Calendars → Add Google Calendar
   - Grant access to the calendar used for clinical appointments
   - Set "Check for conflicts" on the clinical calendar to prevent double-booking

---

## Google Meet Auto-Generation

1. In Cal.com: Settings → Video Conferencing → Google Meet
2. Authorize with the Google account linked to the clinical calendar
3. Each confirmed booking will auto-create a Google Meet event and include the link in the confirmation email
4. No separate Zoom or Teams account needed

---

## Recommended Event Type Settings

Eveniment creat: **„Consultație online de neurochirurgie”**

```
Title:        Consultație Neurochirurgicală Online
URL slug:     consultatie-online
Description:  Consultație medicală online pentru evaluarea simptomelor,
              discutarea investigațiilor și stabilirea pașilor următori.
Location:     Cal Video temporar; Google Meet după conectare
Duration:     45 min
Buffer:       10 min după consultație
Minimum notice: 24 ore
```

### Configurarea duratei în Cal.com

Decizia tehnică este închisă: se folosește un singur interval de 45 de minute.

---

## Availability Configuration

- Program provizoriu: marți și joi, 18:00–20:00, Europe/Bucharest
- Block days with in-person clinic obligations
- Add buffer between slots to avoid back-to-back fatigue
- Consider a dedicated "online day" per week (e.g., Thursday afternoon)

---

## Cancellation Policy

**[CLIENT DECISION — see CLIENT_DECISIONS_REQUIRED.md]**

Recomandare de lucru, încă neaprobată:
- reprogramare până la **48 de ore** înainte;
- o singură reprogramare gratuită;
- sub 48 de ore și în caz de neprezentare, plata nu se rambursează;
- dacă medicul anulează, pacientul alege rambursare integrală sau reprogramare.

Cal.com setting: Events → Edit → Cancellation policy (plain text field shown to patient at booking).

---

## Confirmation Email Content

Cal.com sends automatic confirmation emails. Customise the message body at:
Settings → Email → Booking Confirmed.

Suggested structure:
```
Subject: Confirmare consultație online — Dr. George Ungureanu

Stimate(ă) [Prenume],

Consultația dumneavoastră online a fost confirmată.

📅 Data: [DATA]
🕐 Ora: [ORA] (ora României)
🎥 Link Google Meet: [LINK]

Pregătire recomandată:
- Nu trimiteți RMN/CT prin email obișnuit; urmați instrucțiunile canalului securizat
- Pregătiți lista medicamentelor curente
- Verificați că microfonul și camera funcționează înainte de consultație
- Asigurați un spațiu privat și liniștit

Pentru anulare sau reprogramare: [LINK ANULARE CAL.COM]

Cu stimă,
Dr. George Ungureanu
```

---

## Patient Preparation Checklist

To be included in the confirmation email and displayed on the website:

- [ ] Imagini RMN/CT disponibile în format digital; transmiterea se face numai prin canalul securizat comunicat
- [ ] Lista medicamentelor curente (denumire + doze)
- [ ] Scrisori medicale sau rezultate de analize relevante
- [ ] Dispozitiv cu cameră și microfon funcționale (laptop, tabletă sau telefon)
- [ ] Conexiune stabilă la internet
- [ ] Spațiu privat și liniștit
- [ ] Carte de identitate (pentru identificare)

---

## Payment — Stripe (Required Before Public Launch)

Cal.com supports Stripe payment at booking. When ready:

1. Settings → Payment → Connect Stripe
2. Set price per event type (e.g., 45 min = [CLIENT: X RON / EUR])
3. Plata integrală este cerută în fluxul de programare.
4. Test obligatoriu: plată reușită, plată abandonată, rambursare și reprogramare.

---

## Website Integration

The Programări page (`/programari/`) already contains:
- An "Online" card in the clinic grid section
- CTA button: "Programează o consultație online"
- CTA activ către `https://cal.com/georgeungureanu/consultatie-online`
- Email dedicat exclusiv consultațiilor online:
  `consultatii@georgeungureanu.doctor`

---

## Technical Notes

- Cal.com booking page is external (no WordPress plugin required)
- The Cal.com page can be embedded via iframe if desired (add `?embed=1` to URL)
- GDPR: Cal.com stores patient name + email + appointment data — include in privacy policy
- Cal.com is GDPR-compliant; EU data residency available on paid plans
