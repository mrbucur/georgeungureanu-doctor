# georgeungureanu.doctor

**Website for Dr. George Ungureanu — Neurosurgeon**

> Current source of truth: native WordPress child theme + GU Design System
> plugin. The older Elementor-first notes below describe the project's origin,
> not its current frontend architecture.

A WordPress + Hello Elementor + Elementor Pro website designed to serve patients and their families navigating neurosurgical conditions.

---

## Core Philosophy

This website exists primarily for **patients and their families** — not for professional prestige.

Every decision — design, content, navigation, UX — is evaluated against a single question:

> "Does this help a patient feel informed, reassured, understood, and guided?"

**The project succeeds** if a patient says: *"I felt calmer and more informed after visiting this website."*

**The project fails** if a visitor says: *"This looks impressive, but I don't know what to do next."*

---

## Project Structure

```
georgeungureanu.doctor/
│
├── README.md                          ← This file
│
└── docs/
    ├── project/
    │   ├── PROJECT_BRIEF.md           ← Full project scope and context
    │   ├── PATIENT_CENTERED_MANIFESTO.md ← Non-negotiable design philosophy
    │   ├── WEBSITE_GOALS.md           ← Success metrics and goals
    │   └── TARGET_AUDIENCE.md         ← Audience personas and needs
    │
    ├── design-system/
    │   ├── BRAND_GUIDELINES.md        ← Identity, tone, visual language
    │   ├── DESIGN_PRINCIPLES.md       ← Core design decision framework
    │   ├── COLOR_SYSTEM.md            ← Global color palette + usage rules
    │   ├── TYPOGRAPHY_SYSTEM.md       ← Global fonts + type scale
    │   ├── SPACING_SYSTEM.md          ← Spacing tokens + rhythm rules
    │   ├── ATOMIC_DESIGN_RULES.md     ← Component hierarchy and composition
    │   └── ELEMENTOR_IMPLEMENTATION_RULES.md ← WordPress/Elementor constraints
    │
    ├── content/
    │   ├── CONTENT_TONE.md            ← Voice, language, and tone rules
    │   ├── CONTENT_STRUCTURE.md       ← Page and section content framework
    │   └── HOMEPAGE_CONTENT_STRATEGY.md ← Homepage narrative strategy
    │
    └── prompts/
        ├── 01_DESIGN_SYSTEM_FOUNDATION.md   ← Prompt: build the global design system
        ├── 02_ATOMIC_COMPONENT_LIBRARY.md   ← Prompt: build reusable components
        ├── 03_HOMEPAGE_TEMPLATE.md          ← Prompt: build the homepage
        └── 04_ELEMENTOR_TEMPLATE_RULES.md   ← Prompt: Elementor export/structure rules
```

---

## Technology Stack

| Layer | Technology |
|-------|-----------|
| CMS | WordPress |
| Theme | Ungureanu MD Child (Hello Elementor parent) |
| Page layouts | Native PHP templates; Elementor is transitional/legacy |
| Functionality/content model | GU Design System plugin + CPT + ACF |
| Configuration | Theme settings + WordPress menus (migration in progress) |
| Typography | Global Fonts only |
| Design Pattern | Atomic Design |
| Mobile | Mobile-first |
| Accessibility | WCAG 2.1 AA minimum |

---

## Quick Navigation

**Start here for strategy:** [`docs/project/PATIENT_CENTERED_MANIFESTO.md`](docs/project/PATIENT_CENTERED_MANIFESTO.md)

**Start here for design:** [`docs/design-system/DESIGN_PRINCIPLES.md`](docs/design-system/DESIGN_PRINCIPLES.md)

**Start here for content:** [`docs/content/CONTENT_TONE.md`](docs/content/CONTENT_TONE.md)

**Start here for implementation:** [`docs/prompts/01_DESIGN_SYSTEM_FOUNDATION.md`](docs/prompts/01_DESIGN_SYSTEM_FOUNDATION.md)

---

## Design References

- Mayo Clinic
- Johns Hopkins Medicine
- Cleveland Clinic
- Stanford Medicine
- Harvard Medical School
- The New England Journal of Medicine

---

## Status

| Phase | Status |
|-------|--------|
| Documentation | Extensive; consolidation needed |
| Design System | Implemented; token/CSS consolidation needed |
| Component Library | Implemented in plugin; inline-style cleanup needed |
| Page Templates | Native child-theme templates implemented |
| Theme configuration | Foundation implemented; migration in progress |
| Content Entry | In progress; some client placeholders remain |
| Launch | Staging workflow prepared; final QA pending |

See [`docs/planning/THEME_FIRST_PARADIGM.md`](docs/planning/THEME_FIRST_PARADIGM.md)
for the active architecture and migration rules.
