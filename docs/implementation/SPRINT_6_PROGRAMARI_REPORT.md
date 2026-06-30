# Sprint 6 — Programări Page Report

**Date:** 2026-06-30
**Status:** Complete — awaiting commit approval

---

## Overview

Sprint 6 implemented the `/programari/` booking page for Dr. George Ungureanu. The page was previously a blank published placeholder (ID=72) that caused every CTA button on the site to lead to a dead end (P0 blocker from Sprint 5.5).

---

## What Was Built

### 1. Full Programări Page (ID=72)

9 sections built as Elementor containers, inserted via PHP script directly into `wp_postmeta` (`_elementor_data`). Page template set to `elementor_header_footer` (same as homepage) so Theme Builder header/footer are injected correctly.

| # | Section | Background | Key components |
|---|---|---|---|
| 1 | Hero | `#231E1A` | H1, 1-line subheading, CTA button (smooth scroll to form) |
| 2 | Trust Strip | `#F4EFE6` | 3 stat columns (years, procedures, training) with accent-colored numbers |
| 3 | Consultation Types | `#FDFBF7` | 3 cards: Inițială / A doua opinie / Postoperatorie — each with duration, use case, CTA |
| 4 | Process Steps | `#F4EFE6` | 4-step numbered flow (submit → called → consult → plan) |
| 5 | Locations | `#231E1A` | 2 dark clinic cards with address, hours, wait time, click-to-call phone |
| 6 | What to Bring | `#F4EFE6` | Icon list (5 items) + note "Dacă nu ai documentele, vino oricum" |
| 7 | Booking Form | `#FDFBF7` | Elementor Pro form, 8 fields, GDPR checkbox, email submission |
| 8 | FAQ | `#F4EFE6` | 7-item accordion (referral, pricing, duration, companion, cancel, international, surgery pressure) |
| 9 | Final CTA | `#231E1A` | Ghost button (call) + filled button (scroll to form) |

**Total JSON:** 41,277 bytes (compact) / 136,011 bytes (pretty-printed export)

### 2. Booking Form — Self-Contained Component

The Elementor Pro `form` widget (ID `s6pg063`) is isolated within a single inner container (`s6pg061`). To replace with Calendly embed:
1. Remove the `form` widget
2. Insert an HTML widget with the `<script>` and `<div data-url="...">` Calendly embed code
3. No other containers or sections need to change

Form fields:
- Nume și prenume (text, required, 50% width)
- Telefon (tel, required, 50% width)
- Email (email, required, 100%)
- Tipul consultației (select, required, 50%)
- Clinica preferată (select, required, 50%)
- Descriere problemă (textarea, optional, 100%)
- Ora preferată de contact (radio: dimineața / dupăamiaza / orice oră)
- GDPR acceptance (required, links to /politica-de-confidentialitate/)

### 3. Three Reusable Library Templates

| ID | Title | Type | File |
|---|---|---|---|
| 73 | FAQ — Programări | section | `sprint6-faq-programari.json` |
| 74 | Locație — Card | section | `sprint6-locatie-card.json` |
| 75 | CTA Final — Dark Strip | section | `sprint6-cta-final.json` |

Available in Elementor → My Templates → Saved Sections.

---

## CLIENT_DATA_TO_CONFIRM

The following placeholders are used throughout the page. Client must supply these before staging launch.

| Placeholder | Location | Required for |
|---|---|---|
| `[CLIENT: Ani de experiență]` | Trust Strip stat 1 | Trust credibility |
| `[CLIENT: Nr. intervenții]` | Trust Strip stat 2 | Trust credibility |
| `[CLIENT: Loc formare]` | Trust Strip stat 3 | Trust credibility |
| `[CLIENT: Denumire clinică 1]` | Locations section + Form dropdown | Location cards + form |
| `[CLIENT: Stradă, număr]` (×2) | Locations section | Location cards |
| `[CLIENT: Sector/Oraș]` (×2) | Locations section | Location cards |
| `[CLIENT: ex. Luni–Vineri, 09:00–17:00]` (×2) | Locations section | Location cards |
| `[CLIENT: +40 7XX XXX XXX]` (×3) | Locations, Final CTA | Click-to-call links |
| `[CLIENT: ex. ~3–5 zile lucrătoare]` (×2) | Locations section | Wait time info |
| `[CLIENT: Denumire clinică 2]` | Form dropdown + Locations | Second clinic card |
| `[CLIENT: Email destinație formulare]` | Form widget `email_to` | Form submissions |
| `[CLIENT: Email contact]` | FAQ footer + Final CTA | Contact display |
| `[CLIENT: phonenumber]` (tel: link) | Final CTA button | Click-to-call href |
| `[CLIENT: Informații tarif CNAS]` | FAQ item 2 | Pricing/insurance |
| `[CLIENT: Confirmare pacienți internaționali]` | FAQ item 6 | International patients |

**Note on FAQ item 2 (pricing):** This is the highest-stakes client data item. If CNAS decontare is available, stating it is a conversion accelerator. If not, stating it clearly prevents frustrated visitors.

---

## Browser QA Results

Playwright (Chromium headless) — 6 pages × 3 viewports = 18 checks.

| Page | Desktop | Tablet | Mobile |
|---|---|---|---|
| Programări | ✓ H1 ✓ nav ✓ footer ✓ form | ✓ | ✓ H1 at x≥24px |
| Homepage | ✓ | ✓ | ✓ |
| Afecțiuni Archive | ✓ | ✓ | ✓ |
| Afecțiuni Single | ✓ | ✓ | ✓ |
| Intervenții Archive | ✓ | ✓ | ✓ |
| Intervenții Single | ✓ | ✓ | ✓ |

**All 18 checks passed.** Zero PHP warnings. Zero literal `[elementor-tag]` strings. Nav and footer on every page and viewport. Form widget present and rendered on all Programări viewports.

---

## Architecture Notes

### Element ID Naming
- All Sprint 6 elements use prefix `s6pg` (Sprint 6, Programări)
- Library template elements use prefix `lib_faq_`, `lib_loc_`, `lib_cta_`
- Sequential numbering from `001` → `090`

### Anchor Links
- Hero CTA → `#tipuri-consultatie` (consultation types section custom_id)
- Final CTA button → `#formular-programare` (form section custom_id)
- These are same-page smooth scroll links; no routing needed

### Page Template
- `_wp_page_template = elementor_header_footer` — same as homepage
- Header and footer are injected via Theme Builder (All Pages condition)
- No new Theme Builder conditions required

### CSS
- CSS generated on first page load after DB insert (curl warm = 18.5s cold start)
- Stored in `wp-content/uploads/elementor/css/post-72.css`
- All design tokens inherited from `gu-design-system.css` via CSS custom properties

---

## Version Control

| File | Status |
|---|---|
| `elementor-templates/sprint6-programari.json` | ✓ Added |
| `elementor-templates/sprint6-faq-programari.json` | ✓ Added |
| `elementor-templates/sprint6-locatie-card.json` | ✓ Added |
| `elementor-templates/sprint6-cta-final.json` | ✓ Added |
| `docs/implementation/SPRINT_6_PROGRAMARI_REPORT.md` | ✓ This file |

No changes to `gu-design-system.php` (no new CPT, shortcode, or ACF group needed).

---

## Deployment Notes

### For fresh deployment

After the standard Sprint 1–5 deployment steps in `docs/DEPLOYMENT.md`:

1. **Import page**: Create a WordPress page with slug `programari` and status `publish` (same as Step 6 in DEPLOYMENT.md)
2. **Import Sprint 6 templates**: Import `sprint6-programari.json`, `sprint6-faq-programari.json`, `sprint6-locatie-card.json`, `sprint6-cta-final.json` via Elementor → My Templates
3. **Apply page content**: Edit the Programări page in Elementor → Insert template → `Programări`
4. **Configure form email**: In the form widget (Section 7), update `email_to` with the real email address
5. **Replace placeholders**: Search page for `[CLIENT:` strings in Elementor editor and update each one
6. **Flush Elementor CSS**: Elementor → Tools → Regenerate CSS

### GDPR note

The booking form collects: name, phone, email, short symptom description. Under GDPR this is standard personal data (not special-category medical data). The `acceptance` field links to `/politica-de-confidentialitate/` — this page must exist before go-live.

---

## Remaining Risks (Updated from Sprint 5.5)

### P0 — Still unresolved (Sprint 6 scope partially addresses)
1. **Client data placeholders** — The Programări page renders but all stats, clinic info, and contact details are placeholders. Not suitable for public staging until client provides data.
2. **Form email destination unknown** — Form submits to placeholder address `[CLIENT: Email destinație formulare]`. Will silently fail until configured.
3. **`/politica-de-confidentialitate/` missing** — GDPR checkbox links to this URL. The page does not exist. Visitors clicking the link will get a 404.

### P1 — Carry-forward from Sprint 5.5
4. **Homepage not in version control** — See TECH_DEBT.md
5. **Elementor Kit global colors not set** — See TECH_DEBT.md
6. **`sample-page` (ID=2) still published** — See TECH_DEBT.md
7. **No SEO plugin** — ACF `seo_title`/`seo_description` fields not wired to `<head>`

---

## Updated Deployment Readiness Score: 85/100

| Category | Sprint 5.5 | Sprint 6 | Notes |
|---|---|---|---|
| Version control | 18/20 | 18/20 | Homepage still DB-only |
| Architecture | 18/20 | 18/20 | Programări page added; kit colors still missing |
| Browser QA | 20/20 | 20/20 | 18/18 checks pass |
| Documentation | 19/20 | 19/20 | Reports complete; WP-CLI runbook still missing |
| Deployment readiness | 15/20 | **19/20** | `/programari/` fully built (+4); form email still placeholder (-1) |
| **Total** | **72** | **85** | Ready for stakeholder preview once client data provided |

---

## Recommendations Before Public Staging

1. **Provide client data** — fill all `[CLIENT:]` placeholders in the Programări page
2. **Create `/politica-de-confidentialitate/` page** — required for GDPR compliance; link referenced in form
3. **Export homepage** as Elementor template → `elementor-templates/homepage.json`
4. **Confirm Calendly vs. form** — if Calendly embed preferred, replace Section 7 form widget with HTML embed
5. **Test form end-to-end** — send a real test submission and verify email arrives
6. **Configure Elementor Kit global colors** (see TECH_DEBT.md P1)
7. **Delete sample-page (ID=2)** (see TECH_DEBT.md P1)
