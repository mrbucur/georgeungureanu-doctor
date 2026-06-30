# Project Structure — georgeungureanu.doctor

**Stack:** WordPress 6.x · Hello Elementor theme · Elementor Pro 4.1.x · ACF Free 6.x  
**Last updated:** 2026-06-30

---

## Repository Layout

```
georgeungureanu-doctor/
│
├── docs/                           # All project documentation
│   ├── DEPLOYMENT.md               # Step-by-step deployment guide
│   ├── PROJECT_STRUCTURE.md        # This file
│   ├── TECH_DEBT.md                # Known limitations and future work
│   ├── components/                 # Atomic design component specs
│   │   ├── 01_ATOMS.md
│   │   ├── 02_MOLECULES.md
│   │   ├── 03_ORGANISMS.md
│   │   └── COMPONENT_INVENTORY.md
│   ├── content/                    # Content strategy and tone
│   ├── design-system/              # Visual direction, tokens, typography
│   ├── implementation/             # Sprint reports and audit logs
│   ├── project/                    # Brief, goals, audience
│   ├── prompts/                    # Prompt engineering reference
│   └── tasks/                      # Roadmap and sprint task definitions
│
├── elementor/                      # Legacy template exports (Sprint 1)
│   ├── custom.css                  # Source CSS (adapted into plugin)
│   └── templates/
│       ├── header-georgeungureanu-v2.json
│       ├── footer-georgeungureanu-v2.json
│       └── README-*.md
│
└── wp-plugin/
    ├── gu-design-system.zip        # Stale build artifact (do not use)
    └── gu-design-system/           # ← PRIMARY SOURCE OF TRUTH
        ├── gu-design-system.php    # Plugin entry point
        ├── README.md
        ├── assets/
        │   └── css/
        │       └── gu-design-system.css   # Design system stylesheet
        ├── acf-json/               # ACF Local JSON (auto-sync)
        │   ├── group_mc.json       # Medical Condition (12 fields, Sprint 4)
        │   └── group_sp.json       # Surgical Procedure (13 fields, Sprint 5)
        └── elementor-templates/    # All Elementor template exports
            ├── header.json
            ├── footer.json
            ├── 404-page.json
            ├── sprint4-single-afectiuni.json
            ├── sprint4-archive-afectiuni.json
            ├── sprint5-single-interventii.json
            └── sprint5-archive-interventii.json
```

---

## Plugin Architecture

`gu-design-system.php` is structured in 6 numbered sections:

| Section | Purpose |
|---|---|
| 1. Frontend Styles | Enqueues Google Fonts (Lora + Inter) + design system CSS |
| 2. Performance | `<link rel="preconnect">` hints for fonts.googleapis.com |
| 3. Admin Notice | One-time activation reminder for Elementor Site Settings |
| 4. CPT: Afecțiuni | Registers `afectiuni` CPT + `categorie-afectiuni` taxonomy |
| 5. CPT: Intervenții | Registers `interventii` CPT + `categorie-interventii` taxonomy |
| 6. Shortcodes | `[gu_field]`, `[gu_afectiuni_archive]`, `[gu_interventii_archive]` |

The plugin is entirely self-contained. It does not depend on Elementor APIs at load time (safe to activate before Elementor). It stores nothing in the database and can be deactivated cleanly.

---

## Elementor Database Objects

All Elementor content lives in the WordPress database. The exported JSONs in `elementor-templates/` are the git-versioned source of truth.

| ID | Type | Post title | Template type | Condition |
|---|---|---|---|---|
| 6 | Kit | Default Kit | kit | — |
| 9 | Library | organism-site-header | header | All pages |
| 12 | Library | organism-site-footer | footer | All pages |
| 37 | Library | organism-404-page | error-404 | 404 |
| 52 | Library | Afecțiune — Single | single | `afectiuni` singular |
| 53 | Library | Afecțiuni — Archive | archive | `afectiuni` archive |
| 69 | Library | Intervenție — Single | single | `interventii` singular |
| 70 | Library | Intervenții — Archive | archive | `interventii` archive |

---

## ACF Field Groups

Both groups use ACF Free only (no Pro features).

### Medical Condition (`group_mc`) — Sprint 4
Applied to: `afectiuni` CPT

| Field | Type | Slug |
|---|---|---|
| Subtitle | text | subtitle |
| Short Summary | textarea | short_summary |
| Overview | wysiwyg | overview |
| Symptoms | wysiwyg | symptoms |
| Causes | wysiwyg | causes |
| Risk Factors | wysiwyg | risk_factors |
| Diagnostic | wysiwyg | diagnostic |
| Conservative Treatment | wysiwyg | treatment_conservative |
| Surgical Treatment | wysiwyg | treatment_surgical |
| When Surgery | wysiwyg | when_surgery |
| Prognosis | wysiwyg | prognosis |
| CTA Text | textarea | cta_text |

### Surgical Procedure (`group_sp`) — Sprint 5
Applied to: `interventii` CPT

| Field | Type | Slug |
|---|---|---|
| Subtitle | text | subtitle |
| Short Summary | textarea | short_summary |
| Indications | wysiwyg | indications |
| When Surgery | wysiwyg | when_surgery |
| Surgical Technique | wysiwyg | surgical_technique |
| Benefits | wysiwyg | benefits |
| Risks | wysiwyg | risks |
| Recovery Timeline | wysiwyg | recovery_timeline |
| FAQ | wysiwyg | faq |
| CTA Title | text | cta_title |
| CTA Text | textarea | cta_text |
| SEO Title | text | seo_title |
| SEO Description | textarea | seo_description |

---

## Shortcodes

| Shortcode | Registered in | Purpose |
|---|---|---|
| `[gu_field name="field_name"]` | Section 6 | Render any ACF field on the current post. Bypasses ACF's `enable_shortcode` setting. |
| `[gu_afectiuni_archive]` | Section 6 | Card grid of all published `afectiuni` posts (auto-fill, minmax 280px) |
| `[gu_interventii_archive]` | Section 6 | Card grid of all published `interventii` posts (auto-fill, minmax 280px) |

`[gu_field]` output is passed through `wp_kses_post()` — safe for wysiwyg fields.

---

## Naming Conventions

### CPTs and Taxonomies
- Romanian slugs matching site language: `afectiuni`, `interventii`, `categorie-afectiuni`, `categorie-interventii`
- All registered with `show_in_rest: true` for Gutenberg/REST compatibility

### Elementor Element IDs
- Prefix `s4` = Sprint 4 (Afecțiuni), `s5` = Sprint 5 (Intervenții)
- Suffix `sg` = single, `ar` = archive
- Pattern: `s{sprint}{template}{section}{sub}` e.g. `s5sg001` = Sprint 5 Single section 001

### ACF Group Keys
- `group_mc` — Medical Condition
- `group_sp` — Surgical Procedure

### CSS Custom Properties
All defined in `:root` in `gu-design-system.css`:
- `--color-*` — color tokens
- `--font-*` — font family tokens
- `--text-*` — type scale tokens
- `--space-*` — spacing tokens
- `--radius-*` — border radius tokens
- `--transition-*` — motion tokens

---

## Git Workflow

### Branch strategy
Single branch (`main`). Feature work is committed per sprint.

### Commit naming
```
Sprint N: {short description} — {key components}
```
Examples:
- `Sprint 4: Medical content architecture — CPT, taxonomy, ACF fields, Elementor templates`
- `Sprint 5: Surgical procedures architecture — CPT, taxonomy, ACF fields, Elementor templates`

### What is versioned
- `wp-plugin/gu-design-system/` — full plugin source
- `wp-plugin/gu-design-system/acf-json/` — ACF local JSON
- `wp-plugin/gu-design-system/elementor-templates/` — all template exports
- `docs/` — all documentation

### What is NOT versioned
- WordPress core files
- Elementor Pro plugin files
- `wp-content/uploads/`
- Database (recreation handled by `docs/DEPLOYMENT.md`)
- `.claude/` directory (ignored in `.gitignore`)

---

## Sprint Workflow

Each sprint follows this sequence:

1. **Register** — CPT, taxonomy, shortcodes in `gu-design-system.php`
2. **ACF** — Create field group + fields in DB via PHP/WP bootstrap script
3. **Templates** — Build Elementor single + archive templates in DB via JSON
4. **Content** — Create demo post(s) with realistic content
5. **QA** — Playwright verification at Desktop/Tablet/Mobile (3 viewports)
6. **Fix** — Address all visual issues before proceeding
7. **Export** — ACF Local JSON + Elementor template JSONs to repo
8. **Report** — `docs/implementation/SPRINT_N_*.md`
9. **Commit** — Awaiting explicit user approval

---

## Design System Tokens (Quick Reference)

| Token | Value | Usage |
|---|---|---|
| `--color-ink` | `#231E1A` | Primary text, dark section backgrounds |
| `--color-ink-secondary` | `#5A4E47` | Secondary text |
| `--color-surface` | `#FDFBF7` | Page background, card backgrounds |
| `--color-surface-warm` | `#F4EFE6` | Alternating sections |
| `--color-surface-muted` | `#EDE8DF` | Card borders |
| `--color-accent` | `#4D7A70` | CTAs, links, active states |
| `--font-sans` | Inter | Body, UI |
| `--font-serif` | Lora | Headings (H1–H3) |
