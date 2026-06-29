# Prompt 01: Design System Foundation

## georgeungureanu.doctor — Elementor Pro Global Design System

---

## Context for Claude Code

This is Prompt 01 in the implementation sequence for georgeungureanu.doctor.

Before using this prompt, ensure you have read and understood:
- `docs/design-system/COLOR_SYSTEM.md`
- `docs/design-system/TYPOGRAPHY_SYSTEM.md`
- `docs/design-system/SPACING_SYSTEM.md`
- `docs/design-system/ELEMENTOR_IMPLEMENTATION_RULES.md`

This prompt produces Elementor-compatible configuration artifacts only. It does not produce WordPress theme files or PHP.

---

## Objective

Generate the complete Elementor Pro global design system configuration for georgeungureanu.doctor, including:

1. Global Colors (Elementor Site Settings format)
2. Global Typography (Elementor Site Settings format)
3. Spacing reference table for Elementor use
4. Global Stylesheet additions (custom.css)

---

## Deliverables

### 1. Global Colors Configuration

Produce a structured reference document that specifies every Global Color to be entered in **Elementor → Site Settings → Global Colors**, in this format:

```
Color Name (Token):    [token name as it appears in docs]
Display Label:         [human-readable name for Elementor UI]
Hex Value:             [hex code]
Usage Rule:            [one sentence on when this color is used]
```

Include all 14 colors from `COLOR_SYSTEM.md`.

### 2. Global Typography Configuration

Produce a structured reference document for every Global Typography style to be entered in **Elementor → Site Settings → Global Fonts**, in this format:

```
Style Name (Token):    [token name]
Display Label:         [human-readable name for Elementor UI]
Font Family:           [Playfair Display / Inter]
Font Weight:           [numeric weight]
Font Size (Desktop):   [px value]
Font Size (Mobile):    [px value]
Line Height:           [ratio]
Letter Spacing:        [em value or "default"]
Text Transform:        [none / uppercase]
Usage Rule:            [one sentence]
```

Include all typography tokens from `TYPOGRAPHY_SYSTEM.md`.

### 3. Spacing Reference

Produce a quick-reference card mapping every spacing token to its pixel value, formatted for use alongside Elementor's spacing inputs.

### 4. Global Custom CSS

Produce a `custom.css` file to be pasted in **Elementor → Custom CSS** (Site Settings level), containing:

- CSS custom properties (variables) for all design tokens
- Font import declarations for Playfair Display and Inter from Google Fonts
- Base body styles (font smoothing, box-sizing)
- Global link styles
- Global focus ring styles (accessibility)
- Global selection color

CSS must:
- Use the color tokens as CSS variables
- Not override any Elementor-managed styles — only extend and fill gaps
- Include accessibility-critical styles (focus-visible ring)
- Be clearly commented by section

---

## Constraints

- No WordPress PHP
- No Elementor JSON templates (those come in Prompt 02)
- No page-level styles
- No component-level styles (those come in Prompt 02)
- Output must be directly implementable — no placeholder values

---

## Implementation Notes for Claude Code

When generating the custom.css:
- CSS variable names must exactly match the token names from `COLOR_SYSTEM.md` with `--` prefix (e.g., `--color-ink`)
- Font smoothing: `-webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale;`
- Focus ring: `outline: 3px solid var(--color-accent); outline-offset: 3px;` — applied to `:focus-visible` not `:focus`
- Google Fonts import: use the `@import` method with `display=swap`
- Do not use `!important` unless documenting exactly why it is necessary

---

## Success Criteria

After implementing this prompt's output:
- All 14 Global Colors are configured in Elementor with the correct names and hex values
- All typography styles are configured in Elementor with the correct font, size, weight, and line-height settings
- The custom.css is in place with all CSS variables, font imports, and base styles
- Any Elementor widget using "Global Color" or "Global Typography" will pull from this system
- The design system is fully configured before any templates are built
