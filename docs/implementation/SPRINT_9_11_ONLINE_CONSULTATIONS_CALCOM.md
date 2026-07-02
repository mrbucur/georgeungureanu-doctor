# Sprint 9.11 — Online Consultations via Cal.com

**Date:** 2026-07-02
**Status:** IMPLEMENTATION COMPLETE — awaiting browser review and client decisions
**Scope:** Programări page online consultation section, FAQ expansion, planning docs

---

## Context

George confirmed he can provide online consultations. Platform decision: **Cal.com + Google Meet** — chosen over booking plugins (Amelia, Acuity) because:
- Expected volume is low (specialist referrals, single practitioner)
- No WordPress plugin cost or maintenance overhead
- Cal.com's native Google Meet integration generates video links automatically
- Stripe payment can be added later without touching WordPress

Full rationale and setup instructions: `docs/ONLINE_CONSULTATIONS_SETUP.md`

---

## What Changed

### 1. Programări page (`gu-design-system.php` — `gu_programari_page` shortcode)

**Hero section:**
- Added `Online` badge alongside `Cluj-Napoca` and `Baia Mare` location badges
- Updated lead text to mention online option: *"Consultații disponibile în două locații fizice sau online prin video, cu programare directă."*

**Section 2 (clinic cards):**
- Updated section lead to reflect three options (two physical + online)

**Section 3 (Online Consultation) — rebuilt from scratch:**

Before: Generic placeholder client box asking for basic confirmation.

After: Proper consultation card with:
- Video camera icon + "Google Meet" platform label
- Descriptive body copy: video + audio, auto-link, no app required
- 4-item feature list (quality, duration options, screen sharing, location-agnostic)
- CTA button: **"Programează o consultație online"** → `#` placeholder (URL pending)
- Cal.com placeholder note with example URL format
- Note: online does not replace in-person clinical examination
- Section anchored at `#online`

**Section 5 (FAQ) — 4 new items added (7 → 11 total):**

| # | Question |
|---|---|
| 8 | Cum se desfășoară consultația online? |
| 9 | Ce documente trebuie să pregătesc pentru consultația online? |
| 10 | Pot trimite RMN/CT înainte de consultație? |
| 11 | Primesc link video după programare? |

Answers cover: Google Meet flow, document preparation checklist, DICOM/JPG/PDF submission, automatic confirmation email with Meet link.

### 2. Created `docs/ONLINE_CONSULTATIONS_SETUP.md`

Covers:
- Why Cal.com was chosen (comparison table)
- Google Calendar connection steps
- Google Meet auto-generation setup
- Recommended event type settings (title, slug, duration, buffer, minimum notice)
- Duration options: 30 / 45 / 60 min with use-case guidance
- Availability configuration recommendations
- Cancellation policy placeholder + Cal.com field location
- Confirmation email copy template (Romanian)
- Patient preparation checklist
- Stripe payment integration (deferred, instructions included)
- Website integration — how to update the `$online_cal_url` variable

### 3. Created `docs/CLIENT_DECISIONS_REQUIRED.md`

Centralised decision tracker with 17 items across three priority tiers:

**CRITICAL (blocking publication):** Q1 clinic names/addresses, Q2 contact email, Q3 phone, Q4 doctor photography, Q5 clinic photography

**IMPORTANT (blocking specific features):** Q6 consultation pricing, Q7 CNAS reimbursement, Q8 Cal.com account owner, Q9 online consultation duration, Q10 cancellation policy, Q11 payment now or later, Q12 documents upload process, Q13 GDPR/privacy note

**DEFERRED:** Q14 international patients, Q15 colleague recommendation content, Q16 patient testimonials, Q17 bio text

---

## Playwright QA — /programari/ — Desktop + Mobile

**Viewport 1: 1440×900 (desktop)**

| Check | Result |
|---|---|
| "Online" badge in hero | PASS ✓ |
| `#online` section exists | PASS ✓ |
| Google Meet mentioned | PASS ✓ |
| "Programează o consultație online" CTA | PASS ✓ |
| Cal.com placeholder note visible | PASS ✓ |
| Online FAQ items (4 expected) | PASS ✓ |
| Total FAQ count (11) | PASS ✓ |
| White text on light background violations | 0 ✓ |

**Viewport 2: 390×844 (mobile)**

All 8 checks: PASS ✓

---

## What is NOT done (by design)

| Item | Reason |
|---|---|
| Cal.com account creation | Client action — requires George's Google account |
| Cal.com event type setup | Blocked on account creation |
| Stripe payment integration | Explicitly deferred to Sprint 9.12 |
| Amelia / booking plugins | Explicitly excluded |
| Custom video infrastructure | Explicitly excluded |
| Google Meet embed on site | Not requested; external Cal.com link is sufficient |
| Pricing displayed on page | Client decision Q6 pending |
| GDPR notice for bookings | Client decision Q13 / legal review pending |

---

## Pending Client Actions (to go live with online consultations)

1. Create Cal.com account at cal.com (use practice email)
2. Connect Google Calendar + Google Meet in Cal.com settings
3. Create event type "Consultație Neurochirurgicală Online" — 45 min default
4. Set available hours and buffer times
5. Copy Cal.com booking URL (e.g. `https://cal.com/george-ungureanu/consultatie-online`)
6. In `gu-design-system.php` line ~1414: replace `$online_cal_url = '#';` with actual URL
7. Confirm cancellation policy wording
8. Review and personalise the confirmation email template
9. Confirm email address for pre-consultation document submission
10. Legal review of GDPR note for Cal.com data processing

---

## Screenshots

Playwright screenshots at 1440×900 and 390×844:
`/scratchpad/screenshots_sprint911/`

- `programari_full_desktop.png` — full page, desktop
- `programari_fold_desktop.png` — above the fold, desktop
- `programari_full_mobile.png` — full page, mobile
- `programari_fold_mobile.png` — above the fold, mobile
