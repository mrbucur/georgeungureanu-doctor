# Sprint 9.9A — Programări Realignment
**Status:** COMPLETE — awaiting browser verification  
**Date:** 2026-07-01  
**QA result:** 75 PASS / 0 FAIL  
**Pages × viewports tested:** /programari/ × 3 + 3 regression pages × 1 = 12 sessions

---

## Context

The Programări page had accumulated credential content (years of experience, intervention counts, training/formation) that belongs on /despre/, not on a booking page. Patients who arrive at /programari/ have already evaluated the doctor — they need to know WHERE and HOW to book, not more credentials.

This sprint implements Phase A of the Strategic Realignment plan (`docs/planning/STRATEGIC_REALIGNMENT_BEFORE_PUSH.md`): simplify the booking page to a calm, location-focused experience.

---

## What Changed

### Architecture change: Elementor → PHP shortcode

The Programári page (WordPress ID=72) was a full Elementor build (41,277 characters of JSON, 9 sections). The entire Elementor structure was replaced with a minimal shortcode container calling `[gu_programari_page]`.

This is the same architecture used successfully for the Recomandări page (Sprint 9.7C). The shortcode approach gives complete PHP control over page structure without Elementor template editing.

**Backup:** The original Elementor JSON was saved to the scratchpad before modification.

### Sections REMOVED (credential content)

| Old section | ID | Content | Reason |
|------------|-----|---------|--------|
| Credentials strip | `s6pg010` | [CLIENT: Ani de experiență], [CLIENT: Nr. intervenții], [CLIENT: Loc formare] | Credential overload on a booking page; belongs on /despre/ |
| Consultation type selector | `s6pg020` | "Alege tipul de consultație potrivit situației tale" — 3 cards | Replaced by clinic cards with direct booking links |
| "How it works" steps | `s6pg030` | 4-step process diagram | Removed per simplification; adds length without value for decided patients |
| Booking form | `s6pg060` | Elementor form widget | Replaced by direct booking links on clinic cards |

### Sections KEPT (content preserved)

| Original section | New shortcode section | Content |
|----------------|---------------------|---------|
| Hero (s6pg001) | Section 1 — Hero | Heading and lead text preserved; updated to "Programați" (formal você); added city badges |
| Clinic boxes (s6pg040/045/046) | Section 2 — Clinic Cards | Completely redesigned with photo placeholder, city badge, name, description, booking link, map link |
| What to bring (s6pg050/053) | Section 4 — Ce să aduceți | All 5 items preserved exactly; note preserved |
| FAQ (s6pg070/073) | Section 5 — Întrebări Frecvente | All 7 questions and answers preserved exactly |
| Final CTA (s6pg080) | Section 6 — CTA | Heading and tone preserved; button updated to link to clinic cards anchor |

### Sections ADDED (new)

**Section 3 — Consultație Online:** New section explaining online consultations — what they include, when appropriate, what they do not replace. Includes a [CLIENT:] placeholder box for Dr. George to confirm platform, pricing, and booking mechanism.

---

## New Page Structure

```
/programari/
  ├── Hero (#FFFFFF)
  │     Overline: "Consultații Neurochirurgicale"
  │     H1: "Programați o consultație"
  │     Lead: "O evaluare corectă este primul pas..."
  │     City badges: [Cluj-Napoca] [Baia Mare]
  │
  ├── Clinic Cards (#F5F5F7) [id="clinici"]
  │     H2: "Unde consultă Dr. George Ungureanu"
  │     2 cards (Cluj-Napoca + Baia Mare):
  │       Photo placeholder (16:9, gradient grey)
  │       City badge (teal pill)
  │       Clinic name [CLIENT:]
  │       Description [CLIENT:]
  │       Map link button (outline style) [CLIENT:]
  │       Booking link button (sage green) [CLIENT:]
  │
  ├── Online Consultation (#FFFFFF)
  │     H2: "Consultație Online"
  │     2 paragraphs explaining scope and limits
  │     [CLIENT:] box: platform, price, booking method, pre-consult materials
  │
  ├── What to Bring (#F5F5F7)
  │     H2: "Ce să aduceți la consultație"
  │     5-item checklist (icon checkmarks)
  │     Note: "Nu aveți toate documentele? Veniți oricum..."
  │
  ├── FAQ (#FFFFFF)
  │     H2: "Întrebări Frecvente"
  │     7 items, native <details>/<summary> accordion
  │     First item open by default
  │     Email note [CLIENT:]
  │
  └── Final CTA (#F5F5F7)
        H2: "Primul pas este cel mai ușor."
        Lead: "Alegeți locația potrivită și contactați direct clinica."
        Primary button: "Alegeți o locație ↑" → #clinici
        Secondary: [CLIENT: phone]
        Email note [CLIENT:]
```

---

## Technical Details

### PHP additions (`gu-design-system.php`)

- Section 13 added (before Section 12/Recomandări, for logical section ordering)
- `body_class` filter: adds `page-programari` to `/programari/` for future CSS targeting
- Shortcode `[gu_programari_page]`: full PHP-rendered page, 6 sections, ~130 lines

### CSS additions (`gu-design-system.css`)

Section 29 added (~135 lines) with new components:

| Component | Classes | Description |
|-----------|---------|-------------|
| Clinic card grid | `.gu-clinic-grid` | 2-col grid at desktop, 1-col at mobile (≤768px) |
| Clinic card | `.gu-clinic-card`, `.gu-clinic-card__photo`, `.gu-clinic-card__body`, `.gu-clinic-card__city`, `.gu-clinic-card__name`, `.gu-clinic-card__desc`, `.gu-clinic-card__actions` | Full card component |
| Checklist | `.gu-checklist`, `.gu-checklist li` | CSS-only circle+checkmark per item |
| FAQ accordion | `.gu-faq`, `.gu-faq__item`, `.gu-faq__question`, `.gu-faq__answer` | `<details>/<summary>` styled as accordion; `+` rotates to `×` on open |
| Mobile padding | `.page-programari section > div` | Reduces horizontal padding to 20px on ≤480px |

### Database changes

| Table | Change |
|-------|--------|
| `wp_postmeta` — `_elementor_data` (post_id=72) | Replaced 41,277-char Elementor JSON with minimal shortcode container (266 chars) |
| `wp_posts` — `post_content` (ID=72) | Set to `[gu_programari_page]` |
| `wp_postmeta` — `_elementor_element_cache` | Deleted (was caching old rendered HTML) |
| `wp_postmeta` — `_elementor_css`, `_elementor_page_assets` | Deleted (stale cache) |
| Elementor CSS file | Deleted `wp-content/uploads/elementor/css/post-72.css` (stale file cache) |

### Diagnosis note: Elementor cache layers

After the initial DB update, QA showed the old content still rendering. Root cause: `_elementor_element_cache` meta key stores Elementor's pre-rendered HTML output. This cache survives `_elementor_data` updates. Fix: delete `_elementor_element_cache` and the file-based `post-72.css`. This is a standard Elementor cache pattern — document it for future reference.

---

## Client Content Required

All [CLIENT:] placeholders must be filled before the page goes live to patients:

### Clinic cards (both cities — required before launch)

For each city (Cluj-Napoca, Baia Mare):
- Clinic / hospital name
- Short description (1–2 sentences)
- Direct booking link (URL, phone, or external booking platform)
- Google Maps link (or coordinates for embed)
- Optional: clinic photo (16:9 ratio, JPEG/WebP, min 800px wide)

### Online consultation (required to enable section)

- Yes/no: does Dr. George offer online consultations?
- Platform: Zoom / Teams / other
- Price
- Booking method
- Pre-consult materials required

### FAQ (2 answers currently [CLIENT:])

- `Cât costă o consultație? Este decontată de CNAS?` — price and CNAS status
- `Consultați și pacienți din alte țări?` — international patient policy

### Contact details

- Phone number (appears in CTA and FAQ note)
- Email address (appears in FAQ note and CTA)

---

## QA Results

**Total: 75 PASS / 0 FAIL**

### /programari/ — 3 viewports × 22 checks = 66 checks

| Check | Description |
|-------|-------------|
| 1 | Header `#gu-header` present |
| 2 | No horizontal overflow |
| 3 | H1 = "Programați o consultație" |
| 4–5 | City badges: Cluj-Napoca, Baia Mare |
| 6–8 | 2 clinic cards, each with city label |
| 9 | 2 photo placeholders |
| 10 | Online Consultation h2 present |
| 11 | What to Bring h2 present |
| 12 | Checklist: ≥5 items |
| 13 | FAQ h2 present |
| 14 | FAQ: 7 `<details>` items |
| 15 | First FAQ open by default |
| 16 | Final CTA h2 present |
| 17 | No credential text: "ani de experiență" |
| 18 | No credential text: "intervenții neurochirurgicale" |
| 19 | No dark brown sections |
| 20 | Body background is light (#F5F5F7) |
| 21 | Nav: 6 links |
| 22 | Nav active state: no item incorrectly active |

### Regression (3 pages × 3 checks = 9 checks)

All passing: homepage, /despre/, /recomandari/ — header present, no overflow, light background.

---

## CSS Notes (for Phase C cleanup)

Section 28j, 28r, 28s in `gu-design-system.css` contain rules targeting `.elementor-element-s6pg001`, `.elementor-element-s6pg040`, and related IDs that no longer exist in the page DOM. These are now dead CSS rules — harmless but should be removed in Phase C (token cleanup sprint).

---

## Browser Review Checklist

Open `http://georgeungureanu-doctor-dev.local/programari/` at 1440px desktop width:

- [ ] Page loads without errors
- [ ] H1 "Programați o consultație" visible above fold
- [ ] City badges "Cluj-Napoca" and "Baia Mare" visible below lead text
- [ ] Two clinic cards visible side-by-side with grey photo placeholder
- [ ] Each clinic card has a city badge (pill), name, description, and two buttons
- [ ] "Consultație Online" section visible
- [ ] "Ce să aduceți la consultație" section with checkmark list
- [ ] FAQ section with 7 questions; first one open; clicking others opens/closes them
- [ ] Final CTA with "Alegeți o locație ↑" button
- [ ] NO years of experience, intervention counts, or training/formation data anywhere
- [ ] At 768px: clinic cards stack to 1-column
- [ ] At 390px: layout remains usable, no overflow

> Do not publish AI-generated medical content without explicit human review.  
> **Do not commit automatically. Stop for browser verification.**
