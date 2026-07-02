# Client Decisions Required

Decisions that are blocking implementation or content publication.
Updated as decisions are made or new blockers are identified.

**Format:** Each item lists what is needed, why it is blocking, and the current status.

---

## CRITICAL — Blocking publication

### Q1 · Clinic names and addresses

**Needed:** Full legal name of each clinic/hospital, address, phone number, and booking contact for:
- Cluj-Napoca location
- Baia Mare location

**Blocking:** Programări page clinic cards, footer address, Schema.org LocalBusiness markup, Google Maps links.

**Status:** Placeholder `[CLIENT: Denumire clinică / spital]` in use.

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

**Needed:**
- Who creates and owns the Cal.com account (doctor directly, or practice admin)?
- Preferred account email
- Preferred Cal.com URL slug (e.g., `cal.com/george-ungureanu`)

**Blocking:** Online consultation booking link. Currently `#` placeholder on Programări page.

**Why Cal.com:** See `docs/ONLINE_CONSULTATIONS_SETUP.md`.

**Status:** Decision confirmed to use Cal.com + Google Meet. Account not yet created.

---

### Q9 · Online consultation duration

**Needed:** Which durations to offer for online consultations:
- 30 minutes (follow-up / second opinion)
- 45 minutes (standard first consultation)
- 60 minutes (complex case / international patient)

**Recommendation:** Default to 45 min; offer 30 and 60 as additional options.

**Blocking:** Cal.com event type setup.

**Status:** Pending decision.

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

**Needed:** How should patients send RMN/CT images and documents before an online consultation?
- Email attachment to `[CLIENT: email]`?
- Upload link (e.g., WeTransfer, Google Drive)?
- Via Cal.com custom fields (text only, no file upload on free plan)?

**Blocking:** Confirmation email instructions, FAQ answer ("Pot trimite RMN/CT înainte?").

**Status:** Email currently referenced as placeholder. Awaiting confirmed process.

---

### Q13 · GDPR / Privacy note for online consultations

**Needed:** Confirmation that the privacy policy covers:
- Cal.com storing patient booking data (name, email, phone)
- Google Meet processing video/audio
- Any email archiving of clinical documents

**Blocking:** Privacy policy page, Cal.com booking page description.

**Status:** Privacy policy page exists as placeholder. Legal review needed before going live with bookings.

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

**Blocking:** Recomandări page. Currently shows three placeholder cards.

**Status:** Placeholder cards displayed. No content received.

---

### Q16 · Patient testimonials

**Needed:** Patient experience narratives (no star ratings, no scores — per editorial policy).

**Blocking:** Recomandări page, patient section.

**Status:** Workflow placeholder displayed. No content received.

---

### Q17 · Bio and personal statement

**Needed:** Dr. Ungureanu's first-person professional bio for the Despre page.

**Blocking:** Despre page bio section.

**Status:** Generic placeholder text in use.

---

## Decision log

| # | Decision | Date | Decision |
|---|---|---|---|
| — | Use Cal.com + Google Meet for online consultations | 2026-07 | Confirmed ✓ |
| — | Do not add Amelia or booking plugins | 2026-07 | Confirmed ✓ |
| — | Defer Stripe payment to Sprint 9.12 | 2026-07 | Confirmed ✓ |
