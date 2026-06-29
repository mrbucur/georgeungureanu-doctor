# Website Goals

## georgeungureanu.doctor

---

## Primary Goal

Serve patients and their families as a trusted, clear, and calming resource — and create a low-friction pathway from "searching for answers" to "arriving at the right clinic for a consultation."

---

## Goals by Audience

### For Patients

| Goal | How the Website Achieves It |
|------|----------------------------|
| Reduce fear and uncertainty | Plain-language condition descriptions with empathetic framing |
| Understand their condition | Accessible, well-structured condition pages |
| Understand the treatment process | Step-by-step patient journey content |
| Know what to expect | Pre-appointment, procedure, and recovery information |
| Trust the doctor before meeting him | Human biography, values, and patient-first communication |
| Know where they can see the doctor | `/programari` — location directory with all clinics and hospitals |
| Take the next step easily | Primary CTA on every page routes to `/programari`, then to the contact form |

### For Families and Caregivers

| Goal | How the Website Achieves It |
|------|----------------------------|
| Understand what their loved one is facing | Accessible condition summaries |
| Know how to help | Patient journey guidance |
| Feel that the doctor is trustworthy | Approachable, warm doctor biography |
| Know how to arrange an appointment | Clear, simple contact process via `/programari` |
| Know which location is closest to them | Location directory with city and address for each clinic |

### For Referring Physicians

| Goal | How the Website Achieves It |
|------|----------------------------|
| Confirm clinical expertise | Academic credentials, publications, areas of specialization |
| Understand subspecialty focus | Clear listing of conditions and procedures |
| Find referral contact easily | Dedicated professional contact option |

---

## Business Goals

1. **Increase appointment requests** — through improved patient confidence and clear CTAs that route to `/programari`
2. **Reduce geographic uncertainty** — patients in both Cluj-Napoca and Baia Mare should immediately understand that this doctor is accessible to them
3. **Improve patient preparation** — through pre-appointment information resources
4. **Support referral relationships** — through professional credibility content
5. **Establish online presence** — as the authoritative digital presence for the doctor
6. **Reduce administrative friction** — FAQs, location information, and patient content reduce phone inquiries for routine questions

---

## Design Goals

1. Convey **trustworthiness** through visual calm, restraint, and precision
2. Convey **warmth** through human photography, approachable typography, and tone
3. Convey **expertise** through editorial quality and information density (without overwhelming)
4. Convey **accessibility** through plain language, clear navigation, and logical structure
5. Convey **modernity** through contemporary layout, whitespace, and typographic hierarchy

---

## Content Goals

1. All condition descriptions are readable by a non-medical adult
2. Every page includes a clear next action for the patient
3. No page leaves the patient without context or a path forward
4. Medical jargon is always defined or avoided in patient-facing content
5. The doctor's biography communicates humanity alongside expertise

---

## Technical Goals

1. Page load time under 3 seconds on mobile
2. WCAG 2.1 AA accessibility compliance
3. Fully responsive across all device sizes
4. Elementor Pro implementation with zero custom CSS dependencies for standard layouts
5. Global design tokens (colors, typography, spacing) used everywhere — no one-off overrides
6. All templates reusable and extendable

---

## CTA Routing Decision (Confirmed)

All primary CTAs labeled "Programează o consultație" route to `/programari` — not directly to the contact form.

**Rationale:** A patient who clicks "book an appointment" first needs to understand *where* they can see the doctor. The `/programari` page removes geographic uncertainty before the patient reaches the contact form. The contact form at `/contact` remains accessible and is the destination for the secondary CTA ("Contactați-ne").

Patient flow:
```
Any page → "Programează o consultație" → /programari (location overview)
/programari → "Contactați-ne" or phone number → /contact or tel:
```

---

## What Is Out of Scope

- E-commerce or payment processing
- Patient record management
- Telemedicine platform
- Online appointment booking with real-time calendar (Phase 1 uses contact form; `/programari` is an orientation hub, not a booking engine)
- Multi-language support (Phase 1 is Romanian only)
- Forum or community features

---

## Measurement

| Metric | Definition of Success |
|--------|----------------------|
| Patient time on condition pages | Increasing — patients are reading, not bouncing |
| `/programari` page visits | High — patients are reaching the location hub |
| Contact/appointment form completions | Increasing — patients are taking action after visiting `/programari` |
| Bounce rate on condition pages | Low — patients find what they need |
| Bounce rate on `/programari` | Low — patients are finding a location and proceeding to contact |
| Return visits | Patients returning for pre-appointment information |
| Referral doctor feedback | Positive mentions of the website |
