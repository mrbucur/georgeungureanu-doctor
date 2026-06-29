# Implementation Master Plan

## georgeungureanu.doctor

**Purpose of this document:** Transform the approved documentation suite into an executable implementation roadmap. Every decision made in Tasks 00–10 is synthesized here into a sprint-by-sprint plan with clear deliverables, dependencies, definitions of done, and acceptance gates. This is the bridge between planning and development.

**What this document is not:** This is not a technical specification, a plugin configuration guide, or a development brief. It does not contain code, templates, or Elementor configuration. It is a project governance document — it tells the implementation team what to build in what order, under what constraints, and how to know when it is done.

**Governing principle:** The documentation suite (Tasks 00–10) is the source of truth for every implementation decision. If the implementation team encounters a situation not covered by this plan, they consult the relevant task document. If the relevant task document does not cover the situation, they consult Dr. Ungureanu before proceeding — not after.

**Source of truth:**
- `docs/tasks/00_PROJECT_ROADMAP.md` through `docs/tasks/10_MEDIA_HUB_AND_AUTOMATION.md`
- `docs/project/PATIENT_CENTERED_MANIFESTO.md`
- `docs/project/WEBSITE_GOALS.md`
- `docs/project/TARGET_AUDIENCE.md`

---

# 1. Implementation Philosophy

## 1.1 One Sprint at a Time

Each sprint is a self-contained unit of work with a defined scope, a defined set of deliverables, and a defined definition of done. No sprint begins before the previous sprint's acceptance gate is passed. No sprint scope is expanded during execution.

**Why this prevents rework:** The most common source of rework on WordPress projects is building on an unapproved foundation. If Sprint 2 (homepage) is built before Sprint 1 (global design system) is approved, any global color or typography correction required after Sprint 1 approval cascades through every element built during Sprint 2. Sequential sprints with mandatory approval gates ensure that each layer is correct before the next layer is built on it.

## 1.2 One Approval Before the Next Sprint

Dr. Ungureanu reviews and explicitly approves each sprint's deliverables before the next sprint begins. "Approval" means a written confirmation — not a phone call, not a verbal agreement. Approval confirms:
- The deliverables match the task document specification
- The content (if content is part of the sprint) is accurate and approved
- The implementation team has permission to proceed to the next sprint

**What triggers a sprint review:** The implementation team sends Dr. Ungureanu a staging environment URL and a checklist of what was built, referencing the specific task document sections. Dr. Ungureanu reviews against the checklist. Feedback is consolidated, addressed, and the sprint is re-reviewed if changes were required.

## 1.3 No Parallel Implementation Streams

Only one sprint is in active development at any time. This is a single-practice website built for a specific doctor — not a product with multiple feature teams. Parallel development streams create integration risk, communication overhead, and inconsistency in implementation decisions.

**Exception:** Sprint 8 (SEO, Accessibility, Performance, Launch) includes parallel tasks that can be run concurrently — the SEO metadata pass and the accessibility audit can happen simultaneously. This is not a separate stream; it is a sprint where multiple tasks within the same sprint can be parallelized.

## 1.4 No Placeholder Content in Production

No page is published to the production website with placeholder text, sample images, or dummy content. If real content is not available for a section, that section is not built — or is built in staging only and not pushed to production until the content is ready.

**The staging environment exists for this reason:** All in-progress work lives on staging. Production shows only completed, content-populated, approved pages. A patient who discovers the production URL before launch should see either a graceful "coming soon" page or the specific pages that have been fully completed and approved — never a partially-built site with Lorem Ipsum.

**Visibility conditions are not a workaround:** Sections with empty CPTs (SN Articles, testimonials, colleague recommendations) correctly render as absent from the page — this is appropriate and functional. What is not appropriate is a section with a headline and placeholder text explaining that content will appear here later.

## 1.5 The Website Must Remain Functional After Every Sprint

At the end of every sprint, the website (in staging and in production for any published pages) is a coherent, navigable, and patient-appropriate experience. No sprint leaves the site in a broken state.

**What "functional" means in this context:**
- All navigation links route to destinations that exist. If a page has not yet been built, it is not yet in the navigation — not a broken link.
- All CTA buttons route to their correct destinations. If /programari has not yet been built, no CTA button routes to /programari — the button is not built yet.
- The CTA routing chain (any page → /programari → /contact) is tested and confirmed after the sprints where those pages are built.
- No Elementor template renders with missing global styles — global colors and typography are confirmed in Sprint 1 before any page is built.

---

# 2. Technical Constraints

## 2.1 The Allowed Stack

Every implementation decision is made within this stack. No exceptions without explicit written approval from Dr. Ungureanu and a documented rationale.

| Component | Specification | Notes |
|-----------|--------------|-------|
| CMS | WordPress (latest stable version) | Self-hosted; managed hosting recommended |
| Theme | Hello Elementor (parent) + Child Theme | Child theme required for any custom CSS; parent theme is never modified |
| Page Builder | Elementor Pro | Latest stable version; Flexbox Containers enabled; legacy Sections/Columns disabled globally |
| Field Management | Advanced Custom Fields (ACF) Pro | For Custom Post Type field configuration |
| Custom Post Types | Registered in child theme's `functions.php` or a minimal dedicated plugin | NOT via CPT UI or similar GUI plugin — CPT registration code is simple and does not require a plugin dependency |
| Forms | Elementor Forms (built into Elementor Pro) | For contact form and testimonial submission form. No separate form plugin. |
| SEO | Rank Math or Yoast SEO (one, decided at Sprint 8) | Never both simultaneously |
| Performance | WP Rocket or LiteSpeed Cache (depending on hosting) | Sprint 8 only |
| Cookie consent | CookieYes or Complianz (one, decided at Sprint 8) | GDPR compliance |
| Automation | Make.com | Phase 2 only; no WordPress plugin required for Make integration (Make connects via WordPress REST API) |

## 2.2 What Is Forbidden

These are not suggestions — they are absolute constraints that govern every implementation decision.

| Forbidden | Reason |
|-----------|--------|
| Custom React applications or any headless architecture | Unnecessary complexity; no developer on the team should be building this |
| WPGraphQL or REST API first approach | This is a traditional WordPress site; the REST API is used only for Make.com integration (Phase 2) |
| Social widgets with embedded JavaScript from platforms | GDPR violation; performance degradation; editorial control loss — documented in Task 10 |
| Autoplay video (muted or unmuted) | WCAG 1.4.2; documented in Task 09 as a site-wide rule |
| Elementor Local Color overrides | Violates the global token system defined in Task 04; any local color override creates design inconsistency |
| Elementor Local Font overrides | Same reason — all typography comes from Global Typography settings |
| Inter italic | Inter has no true italic variant; faux italic is forbidden; documented in Task 04 |
| Legacy Elementor Sections/Columns | Flexbox Containers only; irreversible architectural decision documented in Task 04 |
| Carousels or sliders anywhere | Site-wide anti-pattern documented in Task 04 |
| Dropdown navigation menus | Navigation is flat; documented in Task 03 |
| Heavy commercial plugins (WooCommerce, bbPress, BuddyPress, etc.) | Not required; adds unnecessary database and performance overhead |
| Multiple instances of the same functionality (two SEO plugins, two caching plugins) | Plugin conflicts; choose one and configure it correctly |
| Auto-publish for any CPT | All content requires human review and explicit publish action |
| Live social feeds or embedded social timelines | No third-party social JavaScript on the site; documented in Task 10 |
| PDF export or downloadable CV | Documented as forbidden in Task 07 |
| Tables for the professional timeline | Documented in Task 07 |
| Nested accordions | FAQ is single-level accordion only; documented in Task 09 |
| Dropdown filters for location or category navigation | Text-based navigation only; documented in Tasks 06 and 09 |

## 2.3 Plugin Philosophy

Each plugin added to the WordPress installation must have a justification. The allowed list in Section 2.1 is the ceiling — not a starting point that gets expanded as the project progresses.

**Before installing any plugin not in the allowed list:**
- Is this functionality available natively in WordPress, Elementor Pro, or ACF?
- What is the maintenance cost of this plugin over time (update frequency, developer reliability, conflict risk)?
- What is the performance cost (additional database queries, JavaScript loaded globally)?
- If this plugin becomes abandoned or breaks, what is the recovery path?

If a requirement genuinely cannot be met by the allowed stack, it is escalated to Dr. Ungureanu with a documented recommendation — not silently solved by plugin installation.

## 2.4 The Staging Environment

A staging environment must exist before Sprint 1 begins. The staging environment:
- Is a separate WordPress installation at a staging URL (not a subdirectory of production)
- Has the same hosting configuration as production (PHP version, database version)
- Is password-protected from public access (HTTP Basic Auth or hosting-level access control)
- Has automatic push/pull capabilities to production when sprints are approved
- Has its own staging URL shared with Dr. Ungureanu for sprint reviews

No sprint work is done directly on the production environment. Production receives only approved, complete sprint deliverables.

---

# 3. Sprint Structure

## Sprint 1 — Foundation and Global Systems

**Goal:** Establish the technical and design foundation that all subsequent sprints build on. Nothing visible to patients is shipped in Sprint 1 — this sprint produces the invisible infrastructure that makes everything else consistent and correct.

**Task documents governing this sprint:** `docs/tasks/03_HEADER_AND_NAVIGATION.md`, `docs/tasks/04_DESIGN_SYSTEM_TOKENS.md`

### Deliverables

**WordPress and Elementor setup:**
- WordPress installed (latest stable), Hello Elementor theme activated
- Child theme created and activated
- Elementor Pro installed, licensed, and activated
- Flexbox Containers enabled; legacy Sections and Columns disabled globally in Elementor settings
- ACF Pro installed and activated

**Custom Post Types registered (6 total):**
- Condition CPT (`condition`) — with all ACF fields from Task 02
- SN Article CPT (`sn-article`) — with all ACF fields from Task 02
- Colleague Recommendation CPT (`colleague-recommendation`) — with all ACF fields from Task 02
- Patient Testimonial CPT (`testimonial`) — with all ACF fields from Task 02 including `gdpr_consent`, `gdpr_version`, `approval_status`
- Timeline Event CPT (`timeline-event`) — with all ACF fields from Task 02
- Media Item CPT (`media-item`) — with all ACF fields from Task 02; registered with `show_in_rest: true`

**Global design system:**
- All 8 color tokens from Task 04 registered as Elementor Global Colors (exact hex values; token names as labels)
- All 5 typography tokens from Task 04 registered as Elementor Global Typography (font, size, weight, line-height; desktop and mobile breakpoints)
- Spacing units mapped to Elementor's custom spacing controls (8px base unit; xs through 3xl)
- Border radius tokens configured
- Transition speed token configured

**Header template:**
- `organism-site-header` built in Elementor Pro header/footer builder
- Logo (left-aligned): text "Dr. George Ungureanu" or logo asset if provided
- Navigation links: Acasă, Afecțiuni, Sfatul Neurochirurgului, Recomandări, Despre Dr. George Ungureanu — exactly as specified in Task 03
- CTA button: "Programează o consultație →" styled as `atom-button-primary`
- Sticky behavior: pinned at top on scroll
- Mobile hamburger menu: all navigation items accessible; CTA button present in mobile menu
- All navigation labels from Task 03 — no abbreviation, no reordering

**Footer template:**
- `organism-site-footer` with all required elements from Task 03
- Navigation links mirrored from header
- Legal links: Politica de Confidențialitate, Politici Cookies
- Disclaimer text (medical advertising disclaimer — Dr. Ungureanu confirms wording)
- Copyright line

**Global accessibility baseline:**
- Skip to content link: first focusable element on every page; routes to `#main-content` anchor
- Focus rings: visible on all interactive elements in all states; `color-accent` outline style
- `<html lang="ro">` set
- `<meta charset="UTF-8">` and viewport meta present

**404 page:**
- Uses the header and footer templates
- Explains the page was not found
- Links back to homepage
- No search form (not in the allowed stack)

### Dependencies Before Sprint 1 Can Begin
- Hosting environment provisioned (production + staging)
- WordPress installed on both environments
- Elementor Pro license purchased
- ACF Pro license purchased
- Domain configured and pointing to production
- Staging URL confirmed and protected

### Definition of Done — Sprint 1

- [ ] All 6 CPTs are visible and accessible in WordPress admin (Posts sidebar)
- [ ] All ACF field groups are attached to the correct CPTs and all fields render in the CPT edit screen
- [ ] All 8 global colors in Elementor match the exact hex values in Task 04 token table
- [ ] All 5 global typography styles in Elementor match Task 04 specifications (font, size, weight, line-height for desktop and mobile)
- [ ] No Elementor "Default" color or "Default" typography remains in any global setting
- [ ] Header renders correctly and is approved by Dr. Ungureanu at 375px, 768px, and 1280px viewport widths
- [ ] Navigation contains exactly the 5 labels from Task 03 in the correct order
- [ ] CTA button in header is present, styled with global accent token, and routes to /programari (404 is acceptable at this stage)
- [ ] Mobile hamburger menu opens and contains all navigation links and CTA button
- [ ] Footer renders correctly and is approved by Dr. Ungureanu at all breakpoints
- [ ] Skip to content link is the first Tab stop on every page; activating it moves focus to `#main-content`
- [ ] Focus rings are visible on header navigation links, CTA button, hamburger toggle, and footer links
- [ ] 404 page renders with header and footer; contains a link to homepage
- [ ] Elementor Flexbox Containers are confirmed as the only container type in use; no legacy Section or Column exists in any template
- [ ] Staging environment is live, password-protected, and accessible to Dr. Ungureanu for review

**Acceptance gate:** Dr. Ungureanu reviews the staging environment and confirms the header, footer, navigation, and design token implementation. No Sprint 2 work begins before written confirmation.

---

## Sprint 2 — Homepage

**Goal:** Build the complete homepage as defined in Task 05. The homepage is the most important first impression of the site — it must be built with approved photography and real copy, not placeholders.

**Task document governing this sprint:** `docs/tasks/05_HOMEPAGE.md`

### Content Required Before Sprint 2 Can Begin
- Q7a — Homepage hero photography (authenticated portrait of Dr. Ungureanu)
- Homepage hero heading and positioning statement (Dr. Ungureanu)
- Personal message section (80–120 words, first person — Dr. Ungureanu)
- Final CTA section heading and supporting text (Dr. Ungureanu)
- All other homepage section headings and lead text (Dr. Ungureanu)

**If photography is not available:** Sprint 2 does not begin. The hero section is the load-bearing visual element of the homepage — it cannot be built with a placeholder. The sprint waits for Q7a.

### Deliverables

**All 9 homepage sections from Task 05:**

| # | Section | Visibility condition |
|---|---------|---------------------|
| 1 | Hero — `organism-hero-homepage` | Always visible; requires Q7a |
| 2 | Personal message — `organism-philosophy-statement` variant | Always visible; requires copy |
| 3 | Afecțiuni frecvente — `organism-conditions-grid` (6 cards) | Always visible; requires ≥6 Condition CPT entries or static content |
| 4 | SN preview — `organism-article-grid` (3 cards) | Hidden until ≥3 SN Articles published |
| 5 | Colleague recommendations — `organism-colleague-recs` | Hidden until ≥1 active Colleague Recommendation entry |
| 6 | Patient testimonials — `organism-patient-testimonials` | Hidden until ≥2 approved Testimoniale entries |
| 7 | Locations — `organism-location-preview` (city-level, no map) | Requires location content from Q13 |
| 8 | About teaser — `organism-doctor-intro` | Requires copy from Dr. Ungureanu |
| 9 | Final CTA — `organism-cta-banner` | Always visible; one button → /programari |

**Visibility condition implementation:**
- Sections 4, 5, 6: Elementor display conditions configured to hide each section when its CPT has fewer than the threshold number of approved entries
- When hidden: no section placeholder, no "coming soon" message, no empty layout — the section is completely absent from the rendered page

**Afecțiuni preview (Section 3) — Sprint 2 special case:**
If the Condition CPT has no entries yet, Section 3 is built with 6 static cards using content provided by Dr. Ungureanu. The cards are later made dynamic (pulling from Condition CPT) in Sprint 6 when the Afecțiuni section is fully built. For Sprint 2, static or dynamic is acceptable as long as the section renders correctly.

### Definition of Done — Sprint 2

- [ ] All 9 section organisms are built and render correctly at 375px, 768px, and 1280px
- [ ] Hero section uses Q7a photography — no placeholder image
- [ ] No placeholder text exists on any section — all copy is real and Dr. Ungureanu-approved
- [ ] Sections 4, 5, 6 are tested with empty CPTs — confirmed hidden
- [ ] Sections 4, 5, 6 are tested with content meeting their thresholds — confirmed visible
- [ ] Final CTA button routes to /programari (404 acceptable if Sprint 3 not yet complete)
- [ ] The homepage 8-second test is conducted: the implementation team, acting as a patient unfamiliar with the site, assesses the page at 375px in 8 seconds — passes the governing test in Task 05
- [ ] No Elementor local color or font overrides anywhere on the homepage
- [ ] All homepage sections use global design tokens exclusively
- [ ] Dr. Ungureanu reviews all copy in its final rendered context (not as raw text) and confirms approval
- [ ] Mobile layout reviewed and approved at 375px and 768px

**Acceptance gate:** Dr. Ungureanu reviews the staging homepage, confirms all copy, approves the visual presentation, and confirms the homepage passes the 8-second test. No Sprint 3 work begins before written confirmation.

---

## Sprint 3 — Programări and Contact

**Goal:** Build the patient appointment journey and contact page. The CTA routing chain (any page → /programari → /contact) must be fully operational by the end of this sprint.

**Task document governing this sprint:** `docs/tasks/06_PROGRAMARI.md`

### Content Required Before Sprint 3 Can Begin
- Q13 — All location data for all active locations:
  - City, institution name, visit type, available days, time intervals, phone number, booking method, street address
  - All 8 required fields per location card — incomplete location cards are not built
- Contact page content (address, phone, email if applicable — Dr. Ungureanu)
- FAQ content for /programari (Q13 sub-items — all 24 Q&A pairs across 6 categories)
- "Ce să aduceți" section content (Dr. Ungureanu)
- "Cum decurge consultația" content (Dr. Ungureanu)
- Q20 — Privacy policy text confirmed (required for contact form GDPR consent)

**If Q13 location data is incomplete:** The location section (Sections 3–4 in the /programari IA) is not built. The rest of the /programari page (hero, introductory explanation, Ce să aduceți, Cum decurge consultația, FAQ, final CTA) can proceed. The location section is added when Q13 is complete.

### Deliverables

**/programari page (8 sections from Task 06):**
- Hero (`organism-hero-interior`)
- Introductory explanation
- Location directory — Cluj-Napoca locations, then Baia Mare locations
- Location cards — one card per active location, all 8 required fields populated
- Ce să aduceți (5 categories)
- Cum decurge consultația (4 steps)
- FAQ (6 categories, single-level accordion, 24 Q&A pairs)
- Final CTA — "Contactați-ne" → /contact (one button, no secondary CTA)

**/contact page:**
- Contact form (Elementor Forms) — name, email, phone, message, GDPR consent checkbox with link to /politica-de-confidentialitate
- Form submission → email to Q16 address
- Thank-you state (inline success message, not a redirect)
- No outbound CTA on /contact (enforced — Task 06 §11)
- Location information if appropriate (or cross-reference to /programari)

**/politica-de-confidentialitate page:**
- Static page with privacy policy text (Dr. Ungureanu confirms text)
- This page must be live before the contact form or testimonial submission form is live

**CTA routing chain verification:**
- Homepage Final CTA → /programari ✓
- /despre Final CTA → /programari ✓
- /recomandari Final CTA → /programari ✓
- /sfatul-neurochirurgului Final CTA → /programari ✓
- /programari Final CTA → /contact ✓
- /contact: no outbound CTA ✓

### Definition of Done — Sprint 3

- [ ] /programari page is built with all sections from Task 06
- [ ] All location cards have all 8 required fields populated — no partial cards
- [ ] Location ordering confirmed: consultation-first within each city group
- [ ] No embedded maps anywhere — all Maps links are plain `<a>` elements opening Google Maps externally in a new tab
- [ ] No dropdown filters for location organization
- [ ] FAQ accordion is single-level (no nested accordions); all 24 Q&A pairs populated
- [ ] "Ce să aduceți" section ends with the reassurance sentence from Task 06
- [ ] /programari Final CTA is "Contactați-ne" → /contact with no secondary CTA
- [ ] /contact page has functional contact form (tested: submission creates email to Q16)
- [ ] /contact page has GDPR consent checkbox linking to /politica-de-confidentialitate
- [ ] /politica-de-confidentialitate page is live and linked from the contact form
- [ ] /contact page has no outbound CTA
- [ ] CTA routing chain tested end-to-end and confirmed
- [ ] All pages pass mobile layout review at 375px and 768px
- [ ] Dr. Ungureanu reviews all location information for accuracy before publication

**Acceptance gate:** Dr. Ungureanu confirms all location data is accurate, all contact information is correct, the CTA routing chain works end-to-end, and the contact form delivers emails correctly to Q16. No Sprint 4 work begins before written confirmation.

---

## Sprint 4 — Despre

**Goal:** Build the About page as defined in Task 07. This is the most content-intensive sprint — it requires complete timeline content, photography, and personal writing from Dr. Ungureanu.

**Task document governing this sprint:** `docs/tasks/07_DESPRE.md`

### Content Required Before Sprint 4 Can Begin
- Q7a — /despre hero photography (may be same as homepage hero or a different photograph)
- Q7 — Timeline photography opportunities (international exchange photos, etc.) if available
- Philosophy statement (80–120 words, first-person — Dr. Ungureanu)
- Biography text (third-person, 3–4 paragraphs — Dr. Ungureanu)
- Complete professional timeline content across all categories:
  - Education (institution, city, years)
  - Residency (specialization, institution, years)
  - Fellowships (institution, program, country, years)
  - International exchanges
  - Courses (selective)
  - Certifications
  - Academic activity
  - SN founding entry (date + origin context)
  - Professional achievements
- International experiences section content
- Academic activity section content
- Publications list (selected, with lay-language summaries)
- Conference list (selected)
- Medical collaborations (hospital affiliations, department descriptions)
- Human dimension content (if Dr. Ungureanu elects to include it)
- Specialty designation (exact wording — e.g., "Medic Primar Neurochirurgie")

**Minimum viable /despre (if full content is not yet available):**
- Hero photography and positioning statement
- Philosophy statement
- Timeline with at minimum: education, residency, and SN founding entry
- At least one section from: International experiences OR Academic activity
- Medical collaborations (hospital affiliations minimum)
- Final CTA

Sprint 4 proceeds with minimum viable content. Additional sections (publications, conferences, human dimension) are added when content arrives — they do not block the sprint from completing if the minimum is met.

### Deliverables

- /despre page with all present sections from Task 07
- Professional timeline built as `molecule-timeline` (vertical connector, no tables, chronological)
- No PDF export link, no downloadable CV, no CV-style tables
- Patient testimonials block built as hidden (will be revealed in Sprint 6+ when ≥2 testimonials are approved)
- Final CTA routes to /programari

### Definition of Done — Sprint 4

- [ ] Hero uses authentic photography (Q7) — no placeholder
- [ ] Philosophy statement is in first person and confirmed by Dr. Ungureanu in its rendered form
- [ ] Professional timeline is rendered as a vertical narrative (not a table) with all provided entries
- [ ] Timeline entries use year marker → event title → institution → optional note format
- [ ] SN founding entry is present, dated, and includes origin context
- [ ] No tables anywhere on the /despre page
- [ ] No "Download CV" link or PDF anywhere on the /despre page
- [ ] Patient testimonials block exists in the DOM but is hidden (confirmed via browser DevTools)
- [ ] Final CTA routes to /programari
- [ ] Mobile layout reviewed and approved at 375px (timeline single-column stack confirmed)
- [ ] The 4-question manifesto compliance test from Task 07 is applied: (1) "I understand this." (2) "This was written for me." (3) "I know what to do next." (4) "I feel more confident, not more confused."
- [ ] Dr. Ungureanu reviews and approves all content in its rendered context

**Acceptance gate:** Dr. Ungureanu reviews /despre at desktop and mobile viewports, confirms all content is accurate and approved, and confirms the page passes the manifesto compliance test. No Sprint 5 work begins before written confirmation.

---

## Sprint 5 — Recomandări

**Goal:** Build the recommendations page and establish the testimonial submission and moderation workflow.

**Task document governing this sprint:** `docs/tasks/08_RECOMANDARI.md`

### Content Required Before Sprint 5 Can Begin
- Q24 — At minimum 1 complete colleague recommendation entry with all 6 required fields:
  - Professional photograph, full name, specialty, institution, professional relationship context, recommendation text
- Q20 — Privacy policy live (required for testimonial submission GDPR consent — /politica-de-confidentialitate is built in Sprint 3)
- Q16 — Admin email address confirmed (required for testimonial submission notification)
- Hero copy (H1, lead text — Dr. Ungureanu)
- Introductory explanation text (80–120 words — Dr. Ungureanu)

**If Q24 is not available:** The page is built with Section 3 (colleague recommendations) hidden. The page launches in State 2 (acceptable partial) from Task 08.

### Deliverables

- /recomandari page with all 6 sections from Task 08
- Section 3: colleague recommendation cards — admin-managed in Elementor; one card per entry; all 6 required fields visible
- Section 4: patient testimonials — `organism-patient-testimonials` built; hidden until ≥2 approved entries
- Section 5: testimonial submission form (Elementor Forms):
  - Fields: prenume (required), oras (optional), afectiune (optional), mesaj (required, min 20 chars), GDPR consent (required), publication consent (required)
  - On submit: creates Testimoniale CPT entry with `status: pending`, `gdpr_consent: true`, `gdpr_version: [current]`
  - Sends email notification to Q16
  - Displays inline success message (does not redirect)
- Moderation workflow tested: admin approves draft → entry appears in Section 4
- Section 6: Final CTA → /programari

**Admin workflow documentation** (handed to Dr. Ungureanu at sprint review):
- How to find pending testimonials in WordPress admin
- How to review and approve
- How to add/edit colleague recommendations in Elementor
- How to change colleague recommendation display order

### Definition of Done — Sprint 5

- [ ] /recomandari page hero has no star ratings, review counts, statistics, or marketing language
- [ ] At least 1 colleague recommendation card is live (if Q24 was available)
- [ ] Colleague recommendation section is hidden if 0 entries exist (confirmed by testing with 0 entries)
- [ ] Patient testimonials section is hidden if fewer than 2 approved entries exist (confirmed by testing)
- [ ] Patient testimonials section becomes visible when ≥2 approved entries exist (confirmed by testing)
- [ ] Testimonial submission form requires both consent checkboxes (GDPR consent + publication consent) before form submits
- [ ] Successful form submission creates a Testimoniale CPT entry with status `pending`
- [ ] Successful form submission sends email notification to Q16 address (tested)
- [ ] Successful form submission shows inline success message — does not redirect
- [ ] Success message accurately describes the pending state ("will be reviewed") — does not claim immediate publication
- [ ] The moderation workflow is tested end-to-end: submission → pending → admin approves → entry appears in Section 4
- [ ] No photographs, star ratings, scores, avatars, or carousels appear in testimonial display
- [ ] Final CTA routes to /programari with the one-button-only rule enforced
- [ ] Mobile layout reviewed and approved at 375px
- [ ] Dr. Ungureanu receives the admin workflow documentation and confirms he understands the moderation process

**Acceptance gate:** Dr. Ungureanu reviews /recomandari, confirms colleague recommendation entries are accurate, tests the submission form, and confirms the moderation workflow documentation is clear. No Sprint 6 work begins before written confirmation.

---

## Sprint 6 — Sfatul Neurochirurgului

**Goal:** Build the complete educational hub and make the homepage SN preview section visible for the first time.

**Task document governing this sprint:** `docs/tasks/09_SFATUL_NEUROCHIRURGULUI.md`

### Content Required Before Sprint 6 Can Begin
- ≥3 SN Articles written and ready to publish (triggers homepage Section 4 visibility)
- SN hub hero copy and overline (Dr. Ungureanu)
- Introductory message (80–120 words, first-person — Dr. Ungureanu)
- FAQ content across ≥4 of the 6 categories (simptome, consultații, investigații, intervenții, recuperare, familie)
- Prima Consultație section content (all 5 topics from Task 09)
- Recuperare și Pregătire section content (all 6 topics from Task 09) — **Semne de alarmă sub-section reviewed and confirmed by Dr. Ungureanu**
- Pentru Familie section content (all 7 topics from Task 09)
- ≥10 glossary entries (for Section 9 to be visible)
- Q25 — Social account URLs confirmed (for Media Hub source URL configuration in Phase 1 curation)

### Deliverables

**SN hub page (/sfatul-neurochirurgului) — all 11 sections:**

| # | Section | Launch visibility |
|---|---------|-----------------|
| 1 | Hero | Always; requires copy |
| 2 | Introductory message | Always; requires copy |
| 3 | Featured content | Visible when ≥3 SN Articles published |
| 4 | Videoclipuri | Visible when ≥1 video Media Item exists |
| 5 | FAQ (6 categories) | Visible when FAQ content provided |
| 6 | Prima consultație | Always; requires content |
| 7 | Recuperare și pregătire | Always; requires content |
| 8 | Pentru familie | Always; requires content |
| 9 | Glosar | Visible when ≥10 entries |
| 10 | Media Hub | Visible when ≥3 Media Items; Phase 1 manual curation |
| 11 | Final CTA | Always |

**SN Article individual page template:**
- `/sfatul-neurochirurgului/[slug]` — built as a reusable Elementor template
- Sections: breadcrumb, article header (H1 + category + optional read time), article content (body text, subheadings, optional video embed), related articles (3 most recent in same category), final CTA → /programari

**Homepage SN preview (Section 4) — now visible:**
- Elementor display condition updated to show Section 4 once ≥3 SN Articles are published
- Confirm the 3 selected articles appear correctly with category labels, titles, excerpts, read time
- No publication date displayed on article cards

**Afecțiuni section — Sprint 6 extension:**
If the Condition CPT is now populated with full entries, the homepage Section 3 (Afecțiuni preview) is upgraded from static cards to dynamic Elementor loop grid pulling from the Condition CPT. This is only done if Condition CPT entries are complete — the static version from Sprint 2 is not broken by this upgrade.

### Definition of Done — Sprint 6

- [ ] All 11 SN hub page sections are built
- [ ] Sections 3, 4, 9, 10 are hidden when below their threshold (tested with 0 entries); visible when at or above threshold
- [ ] ≥3 SN Articles are published; homepage Section 4 is now visible on the homepage
- [ ] FAQ accordion is single-level; no nested accordions; all categories have content
- [ ] The SN Article individual page template is built and renders correctly for all published articles
- [ ] Breadcrumbs on article pages: "Acasă → Sfatul Neurochirurgului → [Article Title]"
- [ ] "Semne de alarmă" content in Recuperare section has Dr. Ungureanu's written confirmation that the content is clinically accurate
- [ ] No video content autoplays anywhere in the SN hub
- [ ] Glossary (if ≥10 entries) renders alphabetically with A-Z navigation
- [ ] Media Hub (Section 10) has ≥3 entries published (Phase 1 manual curation by administrator)
- [ ] Mobile layout reviewed and approved for the full hub page and for SN Article pages
- [ ] No editorial content uses passive voice consistently or contains unexplained medical abbreviations
- [ ] Dr. Ungureanu reviews and approves all educational content, FAQ answers, and glossary entries in their rendered form

**Acceptance gate:** Dr. Ungureanu reviews the full SN hub page and at least 2 individual SN Article pages at desktop and mobile viewports. He confirms all educational content is accurate, the FAQ content is correct, and the clinical content (especially Semne de alarmă) is approved. No Sprint 7 work begins before written confirmation.

---

## Sprint 7 — Media Hub and Automation

**Goal:** Complete the Phase 1 Media Hub and build the Phase 2 Make.com automation infrastructure. This sprint is Phase 2 — it is not required for the website to launch. Sprint 8 (launch) can proceed after Sprint 6 is approved. Sprint 7 may run concurrently with Sprint 8 or after launch.

**Task document governing this sprint:** `docs/tasks/10_MEDIA_HUB_AND_AUTOMATION.md`

### Dependencies Before Sprint 7 Can Begin
- Sprint 6 complete and approved (Media Item CPT is registered; SN hub page Section 10 layout is built)
- Q25 confirmed:
  - Q25a — YouTube channel URL/ID
  - Q25b — Instagram Business Account confirmed
  - Q25c — Facebook Business Page confirmed
- Make.com account active (Core plan or equivalent)
- WordPress Application Password created for Make.com
- API credentials configured for all three platforms (YouTube OAuth2, Instagram Graph API, Facebook Graph API)

### Deliverables

**Phase 1 (already partially complete from Sprint 6):**
- Media Item CPT confirmed functional with `show_in_rest: true`
- ≥3 Media Items manually curated and published (done in Sprint 6)
- Section 10 (Media Hub) visible on SN hub page

**Phase 2 — Make.com automation:**
- Scenario 1: YouTube → WordPress Draft (with admin notification)
- Scenario 2: Instagram → WordPress Draft (with admin notification)
- Scenario 3: Facebook → WordPress Draft (with admin notification)
- Duplicate-check step implemented in all three scenarios
- Error notification emails configured in all three scenarios
- WordPress Application Password stored in Make connection settings
- All three scenarios tested with live social platform content
- Instagram token renewal calendared (7 days before 60-day expiry)

**Admin workflow documentation** (handed to Dr. Ungureanu + administrator at sprint review):
- How to review the Make draft queue in WordPress admin
- How to approve, edit, and publish a Media Item draft
- How to discard a draft
- How to renew the Instagram token when prompted
- What to do when a scenario fails (check Make execution history, manual fallback)
- How to revoke the WordPress Application Password if Make.com is compromised

### Definition of Done — Sprint 7

- [ ] All three Make scenarios are active and have been tested with real content from each platform
- [ ] Each scenario creates a WordPress Draft (not a published post) on successful execution
- [ ] Each scenario sends an email notification to Q16 on successful execution
- [ ] Each scenario sends an error notification email on failure
- [ ] Duplicate-check step is active in all three scenarios
- [ ] Thumbnail download and WordPress media upload works correctly in all three scenarios
- [ ] No API credentials appear in any file in the docs/ directory or WordPress database
- [ ] The WordPress Application Password is stored only in Make.com
- [ ] Make.com account has 2-factor authentication enabled
- [ ] Instagram token renewal is calendared
- [ ] Administrator has confirmed they understand the Make draft review workflow
- [ ] The Phase 1 manual fallback workflow is documented and the administrator can execute it without assistance

**Acceptance gate:** Administrator and Dr. Ungureanu confirm the Make workflow is understood, the draft review process is operational, and the security model is correctly implemented. Sprint 7 may conclude without being a launch blocker if Phase 2 automation is deferred post-launch.

---

## Sprint 8 — SEO, Accessibility, Performance, and Launch

**Goal:** Prepare the complete website for public launch. This sprint is a quality assurance and finalization sprint — no new page content is built. Only metadata, technical compliance, and verification work.

**All previous sprints must be approved before Sprint 8 begins** (or Sprint 7 may be deferred to post-launch — see Sprint 7 note above).

### Deliverables

**SEO:**
- Meta title and meta description for all pages (pattern-based, not one-by-one — the SEO plugin manages these)
- Open Graph tags for all pages (og:title, og:description, og:image)
- Canonical URLs configured
- Hreflang: `<html lang="ro">` confirmed on all pages
- XML sitemap generated and confirmed to include all public pages
- Robots.txt configured (no indexing of admin pages, staging, etc.)
- Google Search Console: site property created, sitemap submitted

**Structured data / Schema.org (added to relevant pages):**
- `Person` schema on /despre — Dr. George Ungureanu, specialty, affiliation
- `MedicalClinic` schema on /programari — per location, with address and phone
- `FAQPage` schema on /programari and /sfatul-neurochirurgului (for the FAQ sections)
- `BreadcrumbList` schema on all non-homepage pages
- Schema validated via Google Rich Results Test before launch

**Accessibility audit:**
- WAVE or axe browser extension audit on all pages — zero errors (not warnings) on WCAG 2.1 AA
- Manual keyboard navigation audit on all pages: Tab order correct, all interactive elements reachable, focus rings visible
- Screen reader test (VoiceOver or NVDA) on homepage, /programari, /sfatul-neurochirurgului, and the testimonial submission form
- Color contrast: all text elements confirmed to pass WCAG 2.1 AA (4.5:1 for body text; 3:1 for large text) — the design tokens in Task 04 were designed to pass these ratios; the audit confirms no overrides have introduced failures

**Performance:**
- Google Lighthouse audit on all pages (mobile): minimum scores — Performance ≥80, Accessibility 100, Best Practices ≥90, SEO 100
- Core Web Vitals: LCP ≤2.5s, CLS ≤0.1, INP ≤200ms (measured on staging, representative of production)
- Image optimization: all uploaded images compressed, WebP format where hosting/WordPress supports it
- No render-blocking resources in critical path
- WP Rocket or equivalent caching plugin configured

**GDPR compliance:**
- Cookie consent banner configured and operational (CookieYes or Complianz)
- Cookie banner appears on first visit, before non-essential cookies are set
- /politici-cookies page created (if required by the cookie consent platform — often auto-generated)
- /politica-de-confidentialitate page confirmed live and linked from footer, contact form, and testimonial form

**Content review pass:**
- Dr. Ungureanu reviews every page in its final rendered form on staging
- All copy confirmed accurate
- All photography confirmed approved
- All contact information confirmed current
- All location information in /programari confirmed accurate
- All SN Article content confirmed clinically accurate
- All FAQ content confirmed accurate
- Glossary reviewed and confirmed

**Launch checklist:**
- DNS propagation confirmed (production domain)
- SSL certificate active and valid
- Staging environment removed from public access or set to no-index
- WordPress admin URL secured (not at default /wp-admin — or protected by 2FA)
- WordPress user accounts: only necessary user accounts exist; any test accounts removed
- Elementor Pro license transferred to production URL
- ACF Pro license confirmed on production
- Backup solution configured (daily automatic backups, 30-day retention minimum)
- All Q-series items reviewed: any unresolved items documented as post-launch tasks

### Definition of Done — Sprint 8

- [ ] All pages have unique meta titles and meta descriptions
- [ ] XML sitemap is generated, validated, and submitted to Google Search Console
- [ ] Structured data validates with zero errors in Google Rich Results Test for all implemented schema types
- [ ] WAVE or axe audit shows zero WCAG 2.1 AA errors on all pages
- [ ] Manual keyboard navigation audit is complete — all interactive elements reachable, focus rings visible
- [ ] Screen reader test conducted on homepage, /programari, /sfatul-neurochirurgului, and testimonial form
- [ ] Lighthouse mobile performance ≥80 on homepage and /sfatul-neurochirurgului hub
- [ ] Lighthouse accessibility score = 100 on all pages
- [ ] Cookie consent banner is operational; non-essential cookies are not set before consent
- [ ] /politica-de-confidentialitate is live and linked from all required locations
- [ ] Dr. Ungureanu has completed a full content review of all pages and confirmed approval in writing
- [ ] All location data in /programari confirmed accurate by Dr. Ungureanu on the day of launch
- [ ] Daily automated backups are confirmed operational
- [ ] SSL certificate is active and not expiring within 30 days
- [ ] No test accounts remain in WordPress
- [ ] Staging environment is no-indexed or removed from public access
- [ ] All Q-series items are either resolved or explicitly documented as post-launch tasks with owners and timelines

**Acceptance gate — Launch readiness (Gate 6):** Dr. Ungureanu confirms all content is reviewed and accurate, all technical compliance checks are passed, and the site is approved for public launch. Production DNS is confirmed pointing to the live server. Launch proceeds.

---

# 4. Content Dependencies Matrix

Every content item below is tracked against three questions: Who is responsible? Does its absence block the site from launching? Can it be added after launch without a rebuild?

| Content Item | Owner | Launch Blocker? | Addable Post-Launch? | Governed by |
|-------------|-------|----------------|---------------------|-------------|
| Homepage hero photography (Q7a) | Dr. Ungureanu | YES — Sprint 2 cannot begin | No — must be present at launch | Task 05 |
| Homepage hero heading + positioning statement | Dr. Ungureanu | YES — Sprint 2 | No | Task 05 |
| Personal message (homepage, 80–120 words) | Dr. Ungureanu | YES — Sprint 2 | No | Task 05 |
| All location data — 8 required fields per location (Q13) | Dr. Ungureanu | YES — location section. Other /programari sections can proceed | Location section only | Task 06 |
| Q20 — Privacy policy text | Dr. Ungureanu / legal | YES — contact form + testimonial form cannot be live | No | Tasks 06, 08 |
| Q16 — Admin notification email | Dr. Ungureanu | YES — forms and moderation workflow | No | Tasks 08, 09, 10 |
| /despre hero photography (Q7a or separate) | Dr. Ungureanu | YES — Sprint 4 cannot begin | No — hero must be present | Task 07 |
| /despre personal philosophy (80–120 words, first-person) | Dr. Ungureanu | YES — cannot be ghostwritten | No | Task 07 |
| Professional timeline content — all categories | Dr. Ungureanu | YES (minimum viable set) | Yes — additional entries can be added | Task 07 |
| SN founding date and origin story | Dr. Ungureanu | YES — timeline entry required | No | Tasks 07, 09 |
| Publications list with lay-language summaries | Dr. Ungureanu | No — /despre can launch with this section absent | Yes | Task 07 |
| Conference list | Dr. Ungureanu | No | Yes | Task 07 |
| Medical collaborations (hospital affiliations) | Dr. Ungureanu | Yes (minimum 1 entry) | Yes | Task 07 |
| Human dimension content (optional) | Dr. Ungureanu | No — section is optional | Yes | Task 07 |
| Specialty designation (exact wording) | Dr. Ungureanu | YES — appears in hero | No | Task 07 |
| Q24 — Colleague recommendation: photographs | Colleague physicians (via Dr. Ungureanu) | No — Section 3 hidden if absent | Yes | Task 08 |
| Q24 — Colleague recommendation: full names + specialties + institutions | Colleague physicians | No — same | Yes | Task 08 |
| Q24 — Colleague recommendation: recommendation texts | Colleague physicians | No — same | Yes | Task 08 |
| SN hub introductory message (80–120 words, first-person) | Dr. Ungureanu | YES — Sprint 6 | No | Task 09 |
| ≥3 SN Articles (triggers homepage Section 4 visibility) | Dr. Ungureanu + admin | YES — homepage Section 4 remains hidden | This is the post-launch addition trigger | Task 09 |
| FAQ content (≥4 categories) | Dr. Ungureanu | Partial — Section 5 hidden if absent | Yes | Task 09 |
| Prima Consultație content (all 5 topics) | Dr. Ungureanu | YES — section 6 must have content | No | Task 09 |
| Recuperare content (all 6 topics) — Semne de alarmă reviewed | Dr. Ungureanu | YES — Semne de alarmă requires clinical review | No | Task 09 |
| Pentru Familie content (all 7 topics) | Dr. Ungureanu | YES — section must have content | No | Task 09 |
| ≥10 glossary entries | Dr. Ungureanu | No — Section 9 hidden until 10 entries | Yes | Task 09 |
| Q25a — YouTube channel ID | Dr. Ungureanu | No — Phase 2 only | Yes | Task 10 |
| Q25b — Instagram Business Account | Dr. Ungureanu | No — Phase 2 only | Yes | Task 10 |
| Q25c — Facebook Business Page | Dr. Ungureanu | No — Phase 2 only | Yes | Task 10 |
| ≥3 Media Items (triggers Section 10 visibility) | Administrator (curation) | No — Section 10 hidden until 3 items | Yes | Task 10 |
| ≥2 approved patient testimonials | Patient submissions + admin | No — Sections 4 on /recomandari and 6 on homepage hidden | Yes — these are post-launch additions | Task 08 |
| ≥1 approved colleague recommendation | Dr. Ungureanu (Q24) | No — Section 3 on /recomandari hidden | Yes | Task 08 |

---

# 5. Implementation Risks

## 5.1 Content Delivery Delays

**Risk:** Dr. Ungureanu is a practicing neurosurgeon. Content delivery — particularly photography, personal writing (philosophy statements, biography), and the professional timeline — may be delayed by professional demands.

**Impact:** High. Photography for the homepage hero (Q7a) blocks Sprint 2. Timeline content blocks Sprint 4. Any delay in content delivery directly extends the project timeline.

**Mitigation strategies:**
- Identify the minimum viable content set for each sprint at the project kickoff; communicate this set clearly and early
- For sprints blocked by a single content item (Q7a blocks Sprint 2), begin building the sprint's non-content-dependent elements in staging while waiting — but do not declare the sprint complete until all content is present
- Schedule a dedicated content session with Dr. Ungureanu (not ongoing requests — a single focused session for each sprint's content requirements)
- Use the Q-series dependency references from Tasks 05–10 as the content collection checklist; do not begin a sprint if its blocking Q-items are unresolved

## 5.2 Photography Delays

**Risk:** Q7 (photography) is the single highest-risk dependency. Professional medical photography requires scheduling a session, a photographer, a location, and Dr. Ungureanu's time — none of which can be rushed without compromising quality.

**Impact:** High. Blocks Sprint 2 (homepage hero). Blocks Sprint 4 (About page hero). The entire patient-facing impression of the website depends on authentic, warm-lit photography as specified in Tasks 05 and 07.

**Mitigation strategies:**
- Schedule the photography session as early as possible — ideally before Sprint 1 begins, so that photographs are available when Sprint 2 starts
- Separate the photography sessions for homepage (Sprint 2) and /despre (Sprint 4) if one session is not possible — Sprint 2 can launch with a hero portrait; Sprint 4 timeline photography can follow
- Do not substitute stock photography under any circumstances — this violates the Brand Guidelines and the Patient-Centered Manifesto
- Document in writing that the project timeline depends on photography availability

## 5.3 Platform API Changes

**Risk:** Facebook and Instagram Graph API have both undergone breaking changes in recent years. The Make.com scenarios built in Sprint 7 may break if Meta changes its API structure, permission model, or token behavior.

**Impact:** Medium (affects Phase 2 automation only; Phase 1 manual workflow is unaffected).

**Mitigation strategies:**
- Phase 1 manual curation is always the fallback — document this explicitly for the administrator
- Subscribe to Facebook for Developers API changelog updates
- Make.com sends execution failure notifications — ensure admin email (Q16) monitors these
- Budget for 1–2 hours of Make scenario adjustment annually to accommodate API changes
- When a scenario fails, diagnose the cause before rebuilding — it may be a token expiry (simple fix) rather than an API structural change (more complex)

## 5.4 Missing Content at Launch

**Risk:** Not all content will be ready at the time the website is ready for launch. Some sections (colleague recommendations, patient testimonials, some SN Articles) may not have their minimum content when everything else is ready.

**Impact:** Medium. The visibility condition system is designed for this — sections hidden until content meets their threshold. However, a homepage with Sections 4, 5, 6 all hidden because content is not yet available makes the homepage feel sparse.

**Mitigation strategies:**
- Treat Section 4 (SN preview) as the most urgent content dependency — 3 SN Articles are a reasonable ask and unlock the homepage's educational signal
- The website launches in its current content state; sections become visible as content is populated — this is the designed behavior
- Communicate to Dr. Ungureanu before launch which sections will be hidden and why; confirm he accepts the launch state

## 5.5 Over-Engineering

**Risk:** A developer unfamiliar with the project constraints introduces unnecessary complexity — a custom React component, a plugin that adds a feature not in scope, a JavaScript library that solves a problem that Elementor Pro already handles.

**Impact:** Medium to High. Over-engineering creates maintenance debt, performance costs, and future rebuild requirements.

**Mitigation strategies:**
- The forbidden list in Section 2.2 is non-negotiable — any deviation requires written approval from Dr. Ungureanu with a documented rationale
- At each sprint review, the implementation team confirms that no new plugins have been added beyond the allowed list
- Code review for any custom functions.php additions before Sprint completion
- The acceptance gate review includes a plugin inventory check

## 5.6 Plugin Bloat and Conflicts

**Risk:** Plugin accumulation over time — each sprint adds a plugin for a specific purpose, and by Sprint 8 the site has 15 active plugins, some of which conflict with each other or with future Elementor Pro updates.

**Impact:** Medium. Plugin conflicts can cause visual regression, form submission failures, or complete site outages.

**Mitigation strategies:**
- Define the final plugin list in the Sprint 8 definition of done; any plugin not on the list is removed
- All plugin updates are tested on staging before applying to production
- Plugin update schedule: monthly; testing protocol documented and followed
- Elementor Pro updates are particularly impactful — test each major version on staging before production deployment

## 5.7 Design Token Drift

**Risk:** During implementation, local color or font overrides are introduced into Elementor elements — a developer uses "custom color" instead of selecting from Global Colors, or sets a font size directly instead of using a Global Typography style.

**Impact:** Medium. Token drift creates visual inconsistency that accumulates quietly and becomes expensive to audit and correct later.

**Mitigation strategies:**
- Sprint 1 Gate requires confirmation that all global tokens are correctly configured before any page is built
- Each sprint's Definition of Done includes the check "No Elementor local color or font overrides"
- Elementor Inspector (built into Elementor Pro) can surface elements with local overrides — run this audit at each sprint review
- If a token drift is discovered at any sprint review, it is corrected before the sprint is approved — not deferred

## 5.8 CTA Routing Chain Failure

**Risk:** The CTA routing chain (any page → /programari → /contact) is broken — a button routes to the wrong page, /contact has an outbound CTA that violates the specification, or the chain is interrupted by a navigation pattern that bypasses /programari.

**Impact:** High. The routing chain is a fundamental UX requirement documented across Tasks 05, 06, 07, 08, and 09. A patient who cannot navigate from any page to an appointment should not encounter this failure.

**Mitigation strategies:**
- Sprint 3 Definition of Done explicitly tests the routing chain end-to-end
- Each subsequent sprint that adds a new page (Sprint 4, 5, 6) includes a test of the new page's final CTA routing
- /contact has a specific check: "no outbound CTA" — confirmed at Sprint 3 and re-confirmed at Sprint 8 launch checklist

## 5.9 Clinical Content Published Without Dr. Ungureanu's Review

**Risk:** Educational content in the SN section — particularly the "Semne de alarmă" warnings in the Recuperare section, and FAQ answers that make clinical claims — is published without Dr. Ungureanu's explicit clinical review.

**Impact:** High. Inaccurate medical content is a patient safety issue and a professional liability risk.

**Mitigation strategies:**
- All clinical content (any content that makes a statement about symptoms, treatments, recovery, or warning signs) requires Dr. Ungureanu's explicit written approval before publication — this is documented specifically for the Semne de alarmă content in Tasks 09 and 11
- The Sprint 6 Definition of Done includes a specific check for this
- The Sprint 8 content review pass is the final clinical accuracy confirmation before launch

---

# 6. Acceptance Gates

No sprint begins before the previous acceptance gate is formally closed. "Formally closed" means a written confirmation from Dr. Ungureanu that the sprint's deliverables are approved.

## Gate 1 — Foundation Approved

**What is confirmed:**
- Global design tokens (colors, typography) are correctly implemented and match Task 04
- Header and footer are approved at all breakpoints
- Navigation order and labels are correct (Task 03)
- All 6 CPTs are registered and accessible in WordPress admin
- Skip to content and focus rings are operational

**Who approves:** Dr. Ungureanu reviews the header, footer, and navigation on staging. The implementation team confirms the CPT and technical setup via a checklist.

**Sprint unlocked:** Sprint 2

---

## Gate 2 — Homepage Approved

**What is confirmed:**
- All 9 homepage sections are present with real content and photography
- The 8-second governing test passes
- Sections 4, 5, 6 correctly hide and reveal based on CPT thresholds
- All copy is reviewed and approved by Dr. Ungureanu in its rendered context

**Who approves:** Dr. Ungureanu reviews the full homepage at desktop and mobile on staging.

**Sprint unlocked:** Sprint 3

---

## Gate 3 — Core Patient Journey Approved

**What is confirmed:**
- /programari is complete with accurate location data
- /contact is complete with functional form
- CTA routing chain works end-to-end
- /politica-de-confidentialitate is live
- /contact has no outbound CTA

**Who approves:** Dr. Ungureanu reviews /programari and /contact on staging; confirms all location data is accurate; confirms the routing chain; tests the contact form.

**Sprint unlocked:** Sprint 4

---

## Gate 4 — Trust Ecosystem Approved

**What is confirmed:**
- /despre is complete with real photography, timeline, and philosophy statement
- /recomandari is complete with at least 1 colleague recommendation
- Testimonial submission and moderation workflow is tested and operational
- The About page manifesto compliance test passes

**Who approves:** Dr. Ungureanu reviews /despre and /recomandari on staging; confirms all content is accurate; tests the testimonial submission workflow.

**Sprint unlocked:** Sprint 5 → Sprint 6 (sequential approval of Sprints 4 and 5 is required before Sprint 6)

---

## Gate 5 — Educational Ecosystem Approved

**What is confirmed:**
- /sfatul-neurochirurgului hub page is complete with all required sections
- ≥3 SN Articles are published; homepage Section 4 is now visible
- All educational content is clinically accurate and reviewed by Dr. Ungureanu
- "Semne de alarmă" content specifically confirmed by Dr. Ungureanu
- SN Article individual page template is functioning

**Who approves:** Dr. Ungureanu reviews the full SN hub page and at least 2 SN Article pages on staging; confirms all content; specifically signs off on clinical content.

**Sprint unlocked:** Sprint 8 (and Sprint 7 if not already complete)

---

## Gate 6 — Launch Readiness Approved

**What is confirmed:**
- All pages have SEO metadata
- Schema validates with no errors
- Lighthouse mobile performance ≥80; accessibility = 100
- Accessibility audit: zero WCAG 2.1 AA errors
- Cookie consent is operational
- Full content review by Dr. Ungureanu is complete
- All Q-series items resolved or documented as post-launch
- Backup solution operational
- Production environment confirmed ready

**Who approves:** Dr. Ungureanu signs off on the full site on staging. The implementation team provides a completed Sprint 8 checklist. Launch proceeds to production.

---

# 7. Phase 2 Opportunities

These opportunities are documented for post-launch planning. None are implemented within the 8-sprint plan above.

## 7.1 Make.com Automation

**What:** Automated creation of WordPress Drafts from YouTube, Instagram, and Facebook publications. Detailed specification in Task 10.

**When:** Sprint 7 (Media Hub and Automation) — may be deferred to post-launch. Not a launch blocker.

**Dependencies:** Q25 (all three social account confirmations), Make.com account, API credentials for all three platforms.

## 7.2 Interactive Professional Timeline

**What:** Click/tap to expand individual timeline entries; filter by category (Education / International / Academic / SN milestones).

**When:** Post-launch, Phase 2. Requires Phase 1 timeline to be built with clean semantic structure.

**Dependencies:** Phase 1 /despre complete and stable; Phase 2 planning for Elementor vs. custom JavaScript approach.

## 7.3 Search Within Educational Content

**What:** Client-side or server-side search across SN Articles, FAQ answers, and glossary entries.

**When:** Post-launch, when SN Article library exceeds ~30 articles.

**Dependencies:** SN Article CPT fully populated; decision between client-side (Fuse.js) and server-side search at that content volume.

## 7.4 Advanced Filtering for SN Articles and Media Hub

**What:** Category-based navigation for SN Articles (text-based, not dropdown); topic tags for Media Items (allowing patients to browse by theme).

**When:** Post-launch, when content volume justifies filtering complexity.

**Dependencies:** SN Article `associated_conditions` field populated; Media Item category field populated consistently.

## 7.5 Multilingual Support

**What:** Hungarian-language versions of the most commonly accessed educational articles; potentially a Hungarian /despre and /programari variant.

**When:** Post-launch, conditional on confirmed patient demand and Dr. Ungureanu's decision to pursue this audience.

**Dependencies:** Qualified medical translator; hreflang implementation; separate content management workflow for the Hungarian content track.

## 7.6 Interactive Anatomy Explainers

**What:** Labeled, interactive anatomical diagrams embedded within SN Articles — allowing patients to explore the spatial context of their diagnosis.

**When:** Post-launch, Phase 3+.

**Dependencies:** Medically accurate diagrams reviewed by Dr. Ungureanu; WCAG-compliant implementation with text equivalents for all interactive content.

## 7.7 Video Transcripts and Audio Versions

**What:** Full text transcripts for educational videos; audio recordings of SN Articles for patients who prefer listening.

**When:** Post-launch, as the video library grows.

**Dependencies:** Transcript production workflow (manual or automated + edited); audio recording setup or text-to-speech implementation.

## 7.8 Publication and Conference Archive with Search

**What:** A dedicated, searchable archive of Dr. Ungureanu's academic publications and conference presentations — separate from the curated /despre section.

**When:** Post-launch, if the publications list exceeds 30–40 entries.

**Dependencies:** Full publications list from Dr. Ungureanu; decision on implementation approach (static JSON filter or WordPress-native search).

---

# 8. Final Validation Checklist

This checklist is the project-wide acceptance standard applied at Gate 6 before launch. It synthesizes the most important requirements from Tasks 00–10.

## 8.1 Patient Trust

- [ ] No star ratings, review counts, or score averages appear anywhere on the site
- [ ] No marketing language ("world-class", "leading", "renowned") appears in any headline or body text
- [ ] No statistics ("20+ years", "500+ surgeries") appear without specific context and Dr. Ungureanu's approval
- [ ] All colleague recommendations are attributed to named, photographed professionals with their specific institutional context
- [ ] Patient testimonials are in the patients' own words — no editorial rewriting of substance
- [ ] The Sfatul Neurochirurgului section is presented as a named brand, not a content blog
- [ ] No content makes promises about medical outcomes, recovery timelines, or treatment results
- [ ] The professional timeline tells a story, not a CV — entries have context, not just data

## 8.2 Accessibility

- [ ] WCAG 2.1 AA: zero errors on every published page (WAVE or axe audit)
- [ ] One H1 per page; heading levels not skipped anywhere
- [ ] All images have descriptive alt text (not empty, not filename)
- [ ] All form fields have visible labels above the field (no placeholder-only labels)
- [ ] All interactive elements are keyboard-accessible and have visible focus rings
- [ ] No content is revealed only on hover — all content accessible without pointer interaction
- [ ] No video autoplays anywhere on the site
- [ ] All external links announce that they open in a new tab (screen-reader-only text)
- [ ] All animations are suppressed under `prefers-reduced-motion: reduce`
- [ ] Body text minimum 17px desktop / 16px mobile — confirmed on all pages
- [ ] Skip to content link is the first focusable element on every page

## 8.3 Performance

- [ ] Google Lighthouse mobile Performance ≥80 on all key pages (homepage, /programari, /sfatul-neurochirurgului)
- [ ] Google Lighthouse Accessibility = 100 on all pages
- [ ] Google Lighthouse SEO = 100 on all pages
- [ ] Core Web Vitals: LCP ≤2.5s, CLS ≤0.1, INP ≤200ms
- [ ] All images served in WebP format where supported
- [ ] Caching configured (WP Rocket or equivalent)
- [ ] No render-blocking resources in the critical rendering path
- [ ] No social platform JavaScript loaded on any page

## 8.4 Maintainability

- [ ] All colors are from Elementor Global Colors — no local overrides exist anywhere
- [ ] All typography is from Elementor Global Typography — no local overrides exist anywhere
- [ ] All 6 CPTs are functional and populated with real content
- [ ] All Elementor templates (header, footer, SN Article page) are named clearly and findable in the Elementor template library
- [ ] The plugin list matches the allowed list in Section 2.1 — no unauthorized plugins remain active
- [ ] Daily automated backups are confirmed operational with 30-day retention
- [ ] The administrator has received and confirmed understanding of all admin workflow documentation (moderation, Media Hub curation, Make draft review)
- [ ] WordPress Application Passwords for Make.com are stored only in Make — not in any document or database

## 8.5 Editorial Quality

- [ ] No page contains Lorem Ipsum, placeholder text, or draft/WIP markers
- [ ] All SN Article content is reviewed and clinically approved by Dr. Ungureanu
- [ ] "Semne de alarmă" content has specific written confirmation from Dr. Ungureanu
- [ ] All FAQ answers are in plain Romanian, without unexplained medical abbreviations
- [ ] All glossary entries include a definition AND a concrete example
- [ ] No editorial content uses passive voice consistently
- [ ] Average sentence length in SN Articles and educational sections does not exceed 15–18 words
- [ ] No SN Article makes a promise about medical outcomes or recovery
- [ ] All publication dates are absent from article cards (educational content does not age like news)

## 8.6 Patient Reassurance

- [ ] The manifesto governing test (Task 05) is applied to the homepage: a frightened patient on a phone at 10pm, 8 seconds, feels slightly less afraid
- [ ] The manifesto compliance test (Task 07) is applied to /despre: (1) "I understand this." (2) "This was written for me." (3) "I know what to do next." (4) "I feel more confident, not more confused."
- [ ] The /recomandari page contains no consumer-review signals
- [ ] Every CTA on every page routes correctly: → /programari → /contact
- [ ] /contact has no outbound CTA
- [ ] All form success messages are honest about pending states
- [ ] The "Recuperare și pregătire" and "Prima Consultație" sections acknowledge patient fears directly — they do not dismiss or minimize them
- [ ] "Pentru familie și aparținători" exists and is substantive — family members can identify content specifically for them

## 8.7 Privacy and GDPR

- [ ] Cookie consent banner appears before non-essential cookies are set
- [ ] /politica-de-confidentialitate is live and linked from: footer, contact form, testimonial form
- [ ] All form GDPR consent checkboxes link to /politica-de-confidentialitate
- [ ] Testimonial submission form has two distinct consent checkboxes (GDPR consent + publication consent)
- [ ] `gdpr_consent` and `gdpr_version` fields are populated on all published Testimoniale CPT entries
- [ ] No third-party social platform JavaScript is loaded on any page
- [ ] All Media Hub thumbnails are stored in WordPress media library (not hot-linked from platform CDN)
- [ ] No patient photographs appear anywhere on the site
- [ ] Patient surnames are never displayed — first names only in testimonials

## 8.8 SEO

- [ ] Unique meta title and meta description on every page
- [ ] Open Graph tags present on all pages
- [ ] XML sitemap generated, validated, submitted to Google Search Console
- [ ] `<html lang="ro">` on all pages
- [ ] Canonical URLs configured
- [ ] Hreflang tags present if multilingual (Phase 2 — not required for launch)
- [ ] Schema.org structured data validates with zero errors in Google Rich Results Test
- [ ] Robots.txt excludes admin pages and staging
- [ ] No duplicate H1 elements on any page

---

*Implementation Master Plan version: 1.0 — 2026-06-28*
*Governs: Sprint 1 through Sprint 8 and the transition to Phase 2 post-launch*
*Source: docs/tasks/00_PROJECT_ROADMAP.md through docs/tasks/10_MEDIA_HUB_AND_AUTOMATION.md*
*Documentation phase: COMPLETE — this document closes the planning suite*
