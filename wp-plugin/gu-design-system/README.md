# GU Design System

WordPress plugin for `georgeungureanu.doctor`.

Loads the approved **Direction B+ — Warm Academic Medicine** design system automatically on every frontend page. Covers the CSS foundation only — Global Colors and Global Typography must still be configured manually in Elementor Site Settings.

---

## What This Plugin Does

- Enqueues **Google Fonts** (Lora + Inter) via `wp_enqueue_style` with `display=swap`
- Adds `<link rel="preconnect">` hints for `fonts.googleapis.com` and `fonts.gstatic.com`
- Enqueues `assets/css/gu-design-system.css`, which provides:
  - All **CSS custom properties** (`--color-*`, `--size-*`, `--leading-*`, `--space-*`, `--font-*`, `--radius-*`, `--transition-*`)
  - Box-sizing reset
  - Base body, link, and typographic element styles
  - **Focus ring** (`:focus-visible` — accessibility critical)
  - **Text selection** tint (warm accent)
  - **`prefers-reduced-motion`** suppression (accessibility critical)
  - Skip-to-content link style (`.skip-to-content`)
  - Elementor container width constraints (`.e-con-inner`)
  - Utility classes: `.reading-column`, `.section-dark`, `.text-overline`, `.callout-box`, `.callout-box-muted`, `.lead-paragraph`
  - Form base styles
  - Print styles

## What This Plugin Does NOT Do

- Does **not** modify any Elementor database settings
- Does **not** create pages, posts, or templates
- Does **not** depend on Elementor Pro APIs — works with Elementor Free
- Does **not** run any code on deactivation other than clearing a transient
- Does **not** require a child theme or theme modification

---

## Installation

1. Upload the `gu-design-system` folder to `/wp-content/plugins/`  
   — OR — upload `gu-design-system.zip` via WordPress admin → Plugins → Add New → Upload Plugin
2. Activate the plugin via WordPress admin → Plugins → Installed Plugins
3. An admin notice will confirm activation and link to Elementor Site Settings

---

## After Activation

This plugin loads the CSS foundation. Complete the design system by configuring Elementor:

**Global Colors** (14 tokens) — `Elementor → Site Settings → Global Colors`  
**Global Typography** (15 styles) — `Elementor → Site Settings → Typography`  

Full step-by-step instructions: `docs/implementation/01_DESIGN_SYSTEM_SETUP.md`

---

## Verification

After activating, open the site frontend and run these checks in browser DevTools console:

```js
// Color tokens
getComputedStyle(document.documentElement).getPropertyValue('--color-accent').trim()
// Expected: "#4D7A70"

getComputedStyle(document.documentElement).getPropertyValue('--color-surface').trim()
// Expected: "#FDFBF7"

getComputedStyle(document.documentElement).getPropertyValue('--color-ink').trim()
// Expected: "#231E1A"

// Spacing token
getComputedStyle(document.documentElement).getPropertyValue('--space-20').trim()
// Expected: "80px"

// Font family
getComputedStyle(document.documentElement).getPropertyValue('--font-serif').trim()
// Expected: starts with "'Lora'"
```

Check DevTools → Network tab → filter `lora` → a `.woff2` request should appear (status 200).  
Check DevTools → Network tab → filter `inter` → a `.woff2` request should appear (status 200).

---

## Utility Classes — Quick Reference

| Class | Apply to | Effect |
|-------|----------|--------|
| `.reading-column` | Inner text container | `max-width: 700px`, auto margins — 68-char column limit |
| `.section-dark` | Section container | Dark background (`#231E1A`), inverted text colors |
| `.text-overline` | Text widget (overline label) | Inter 600, 12px, uppercase, 0.08em letter-spacing, accent color |
| `.callout-box` | Container | Accent-subtle background, accent left border — for critical patient info |
| `.callout-box-muted` | Container | Muted background variant — for secondary notices |
| `.lead-paragraph` | First text widget in a section | 19px, 1.75 line-height — "start here" signal |
| `.skip-to-content` | `<a>` in `<head>` or theme header | Screen-reader skip link, visible on focus |

In Elementor: `Advanced → CSS Classes → [class-name]`

---

## File Structure

```
gu-design-system/
├── gu-design-system.php       — Plugin bootstrap, enqueue hooks, activation notice
├── assets/
│   └── css/
│       └── gu-design-system.css  — Design tokens + utility classes
└── README.md                  — This file
```

---

## Governing Sources

- `docs/design-system/APPROVED_VISUAL_DIRECTION.md` — Direction B+: Warm Academic Medicine
- `elementor/custom.css` — Source CSS (adapted: `@import` removed, fonts via `wp_enqueue_style`)
- `docs/implementation/01_DESIGN_SYSTEM_SETUP.md` — Elementor manual configuration reference

---

## Version

`1.0.0` — Initial release. All 14 color tokens and 15 typography tokens from Direction B+.
