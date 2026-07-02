# Online Consultations Setup — Cal.com + Google Meet

**Status:** Infrastructure decision confirmed. Cal.com account and event types pending client setup.
**Platform:** Cal.com (scheduling) + Google Meet (video)
**Payment:** Deferred — Stripe integration optional, not in scope for Sprint 9.11.

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

1. Create account at **cal.com** using the practice email.
2. Account owner: **[CLIENT DECISION — see CLIENT_DECISIONS_REQUIRED.md]**
3. Connect Google Calendar:
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

Create one event type: **"Consultație Neurochirurgicală Online"**

```
Title:        Consultație Neurochirurgicală Online
URL slug:     consultatie-online
Description:  Consultație neurochirurgicală prin video cu Dr. George Ungureanu.
              Vă rugăm să trimiteți imagini RMN/CT (dacă există) la [EMAIL] înainte de consultație.
Location:     Google Meet (auto-generated)
Duration:     [CLIENT DECISION — 30 / 45 / 60 min; see below]
Buffer:       10 min after (recommended for note-taking)
Minimum notice: 24 hours (prevents same-day bookings without preparation)
```

### Duration Options

| Duration | Recommended use case |
|---|---|
| 30 min | Follow-up, second opinion on existing imaging |
| 45 min | Standard first consultation |
| 60 min | Complex case, multiple conditions, international patient |

**Recommendation:** Offer 45 min as the default. Add 30 and 60 min as additional event types or as a selectable option within the same event type.

---

## Availability Configuration

- Set available hours to match actual clinical schedule
- Block days with in-person clinic obligations
- Add buffer between slots to avoid back-to-back fatigue
- Consider a dedicated "online day" per week (e.g., Thursday afternoon)

---

## Cancellation Policy

**[CLIENT DECISION — see CLIENT_DECISIONS_REQUIRED.md]**

Suggested default:
- Free cancellation up to **24 hours** before appointment
- Late cancellation or no-show: [CLIENT: fee or no fee]
- Rescheduling: allowed at any time at no cost

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
- Trimiteți imaginile RMN/CT (dacă există) la [EMAIL] cu cel puțin 12 ore înainte
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

- [ ] Imagini RMN/CT în format digital (DICOM, JPG, PDF) — trimise în avans
- [ ] Lista medicamentelor curente (denumire + doze)
- [ ] Scrisori medicale sau rezultate de analize relevante
- [ ] Dispozitiv cu cameră și microfon funcționale (laptop, tabletă sau telefon)
- [ ] Conexiune stabilă la internet
- [ ] Spațiu privat și liniștit
- [ ] Carte de identitate (pentru identificare)

---

## Payment — Later via Stripe (Optional)

Cal.com supports Stripe payment at booking. When ready:

1. Settings → Payment → Connect Stripe
2. Set price per event type (e.g., 45 min = [CLIENT: X RON / EUR])
3. Patient pays at the time of booking — card details held, charged on confirmation
4. Optional: require payment only for new patients, not follow-ups

**Not in scope for Sprint 9.11.** Revisit after Cal.com account is live and pricing is confirmed.

---

## Website Integration

The Programări page (`/programari/`) already contains:
- An "Online" card in the clinic grid section
- CTA button: "Programează o consultație online"
- Button URL placeholder: `#` — replace with actual Cal.com link

To update: in `gu-design-system.php`, find `$online_cal_url = '#';` and replace `'#'` with the Cal.com booking URL.

---

## Technical Notes

- Cal.com booking page is external (no WordPress plugin required)
- The Cal.com page can be embedded via iframe if desired (add `?embed=1` to URL)
- GDPR: Cal.com stores patient name + email + appointment data — include in privacy policy
- Cal.com is GDPR-compliant; EU data residency available on paid plans
