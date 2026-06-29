# Prompt 04: Elementor Template Rules

## georgeungureanu.doctor — Template Export, Structure, and Maintenance

---

## Context for Claude Code

This is Prompt 04 in the implementation sequence for georgeungureanu.doctor.

This prompt does not produce new UI templates. It produces:
1. Rules and validation checklists for all Elementor work
2. A template export and versioning protocol
3. A QA checklist for each completed template
4. Rules for future template additions

Use this prompt when:
- Auditing existing Elementor templates for compliance
- Setting up the template versioning workflow
- Onboarding any contributor to the Elementor implementation
- Adding new page types beyond those specified in earlier prompts

---

## Objective

Establish a rigorous, repeatable quality standard for all Elementor work on this project so that every template, now and in the future, is consistent, maintainable, and patient-centered.

---

## Template Validation Checklist

Apply this checklist to every template before considering it complete.

### Design System Compliance

```
[ ] All colors reference Global Colors — no hex values entered locally
[ ] All typography references Global Typography — no local font overrides
[ ] All spacing values match the spacing system (multiples of 8px)
[ ] No custom CSS in individual widget fields
[ ] No CSS !important in any widget-level styles
[ ] All containers are Flexbox Containers (no legacy Sections)
[ ] No legacy Columns structure anywhere in the template
```

### Atomic Design Compliance

```
[ ] Every visible UI element corresponds to an atom, molecule, or organism in the library
[ ] No one-off visual elements built for this template only
[ ] All new components have been added to ATOMIC_DESIGN_RULES.md before building
[ ] Organisms are saved as Global Sections where they appear on multiple pages
[ ] Atoms used as Global Widgets are not duplicated locally
```

### Naming Compliance

```
[ ] All containers have a Custom ID following naming convention
[ ] Template is named following the naming convention in Elementor library
[ ] JSON file is named following the naming convention in the repository
```

### Content and Accessibility

```
[ ] Page has exactly one H1 element
[ ] Heading hierarchy is logical (H1 → H2 → H3, no skips)
[ ] All images have descriptive alt text (or alt="" for decorative images)
[ ] All CTA buttons have descriptive text (not "Click here" or "Read more")
[ ] All links have descriptive text
[ ] Interactive elements are keyboard-accessible
[ ] Focus ring is visible on all interactive elements (from global CSS)
[ ] Color is not the only means of conveying information
[ ] Minimum text contrast passes WCAG 2.1 AA (4.5:1 body, 3:1 large)
```

### Responsive Compliance

```
[ ] Template is fully functional at 375px (mobile portrait)
[ ] Template is fully functional at 768px (tablet)
[ ] Template is fully functional at 1280px (desktop)
[ ] Touch targets are minimum 44×44px on mobile
[ ] No horizontal scroll at any breakpoint
[ ] Text does not overflow its containers at any breakpoint
[ ] Images scale correctly and do not distort at any breakpoint
```

### Patient-Centered Content Check

```
[ ] Every section has a clear purpose (why is this here for the patient?)
[ ] Every page has a clear primary action for the patient
[ ] Medical terms are accompanied by plain-language explanations
[ ] Content tone is calm, clear, and empathetic (see CONTENT_TONE.md)
[ ] No self-promotional language ("world-class", "exceptional", "best")
[ ] No unexplained abbreviations
[ ] Appointment CTA is reachable in one click from this page
```

---

## Template Export Protocol

### When to Export

Export templates as JSON at these points:
- After completing initial template build
- After any significant structural change
- Before any major site update or WordPress/Elementor upgrade
- Monthly as a baseline backup

### How to Export

In Elementor:
1. Navigate to the template you want to export
2. **Elementor → Templates → My Templates**
3. Hover over the template → click **Export**
4. Save the `.json` file to the correct directory in the repository

### File Naming Convention

```
elementor-templates/
├── atoms/
│   └── atom-[name].json
├── molecules/
│   └── molecule-[name].json
├── organisms/
│   └── organism-[name].json
└── pages/
    └── template-[page-type].json
```

### Version Notes

Each exported file is committed to the repository with a git commit message that includes:
- What changed
- Why it changed
- Date of export

Example: `feat: update organism-hero-homepage to add mobile portrait slot`

---

## Adding New Page Types

When a new page type is needed (e.g., a new condition page, a team member page, a publications page):

### Step 1: Define in Documentation

Before opening Elementor:
1. Add the page type to `CONTENT_STRUCTURE.md` with its full section structure
2. Identify which existing organisms it uses
3. Identify any new organisms needed
4. If new organisms are needed, add them to `ATOMIC_DESIGN_RULES.md`

### Step 2: Build Missing Organisms

If the new page requires organisms not in the library:
1. Build new organisms from existing molecules and atoms
2. Save as Global Sections
3. Apply the full validation checklist to each new organism
4. Export to `elementor-templates/organisms/`

### Step 3: Build the Page Template

1. Assemble organisms in the correct sequence
2. Configure all placeholder content slots
3. Apply the full validation checklist
4. Export to `elementor-templates/pages/`

### Step 4: Update Documentation

1. Update `ATOMIC_DESIGN_RULES.md` with any new components
2. Update `CONTENT_STRUCTURE.md` with the new page structure
3. Commit all changes together

---

## Elementor Settings Audit

Run this audit any time Elementor or WordPress is updated, or quarterly.

### Global Colors Audit

1. Go to **Elementor → Site Settings → Global Colors**
2. Verify all 14 colors from `COLOR_SYSTEM.md` are present with correct names and hex values
3. Verify no additional colors have been added without documentation

### Global Typography Audit

1. Go to **Elementor → Site Settings → Global Fonts**
2. Verify all typography tokens from `TYPOGRAPHY_SYSTEM.md` are present with correct settings
3. Verify no local overrides have been introduced in templates

### Template Library Audit

1. Go to **Elementor → Templates → My Templates**
2. Verify all templates are present and named correctly
3. Export any templates that have been modified since the last export

---

## Common Implementation Errors to Avoid

| Error | Detection | Fix |
|-------|-----------|-----|
| Local hex color entered | Widget color picker shows hex, not global name | Replace with Global Color selection |
| Local font settings | Widget typography shows font family name, not "Default" | Replace with Global Typography selection |
| Legacy Section in template | Navigator shows "Section" instead of "Container" | Rebuild in Flexbox Container |
| Multiple H1 elements | Browser DevTools → heading outline | Remove duplicate H1, use H2 for section headings |
| Missing alt text | Browser accessibility inspector | Add descriptive alt text or `alt=""` for decorative |
| One-off spacing value | Widget padding/margin shows non-8px-multiple | Round to nearest spacing token |
| CTA not reachable | Click-count test from any page | Add appointment CTA to section or ensure header CTA is visible |

---

## Performance Monitoring

After each major template addition, check:

```
[ ] Google PageSpeed Insights mobile score: 85+
[ ] Google PageSpeed Insights desktop score: 90+
[ ] Largest Contentful Paint (LCP): under 2.5s
[ ] Cumulative Layout Shift (CLS): under 0.1
[ ] Total page weight: under 2MB
[ ] Images in WebP format
[ ] Elementor lazy loading enabled
```

---

## The Rule That Supersedes All Others

Every template decision — structure, styling, content slots, naming — must be evaluable by someone who did not build it.

If a future contributor would need to ask "why is this here?" or "what does this do?", the answer must be in the documentation, the naming convention, or the code comments.

Build for the future maintainer. Build for the patient. Build for both.
