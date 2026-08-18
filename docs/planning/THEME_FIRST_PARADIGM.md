# Theme-first paradigm

**Adopted:** 2026-07-22
**Product direction:** Apple Health-inspired, mobile-first, fast and easy to edit.

## The rule

Every decision has one owner:

| Concern | Source of truth |
|---|---|
| Page structure and presentation | `ungureanu-md-child` theme |
| Brand, contact and repeated CTA copy | Theme settings in WordPress |
| Navigation | WordPress Menus |
| Medical content and structured data | `gu-design-system` plugin / CPTs / ACF |
| Visual language | One canonical token layer; components consume tokens |

Templates must not introduce new contact details, brand strings, CTA labels or
navigation arrays. They read them through the theme helpers in
`inc/theme-settings.php`.

## Product principles

1. Start at 320px and enhance for larger screens.
2. One clear action per viewport; content before decoration.
3. White cards, cool neutral canvas, graphite text and one restrained accent.
4. Native HTML first; JavaScript only when interaction genuinely requires it.
5. Repeated content is configurable. Page-specific medical copy remains content.
6. No inline visual styles in PHP. Components use semantic classes and tokens.
7. Load assets only where needed and keep the critical path small.

## Migration sequence

1. Centralize theme settings and WordPress navigation. **Started.**
2. Move repeated CTA/brand/contact reads in plugin output to shared helpers.
3. Replace inline styles in shortcode HTML with component classes.
4. Split the plugin monolith by responsibility without changing public output.
5. Consolidate competing CSS tokens and remove obsolete override sections.
6. Self-host/subset fonts and conditionally load animation/page assets.
7. Validate at 320, 375, 768 and 1280px, then measure mobile Core Web Vitals.

## Definition of done

- A non-developer can change brand/contact/CTA/navigation without editing code.
- A visual token changes the whole site from one location.
- No template duplicates shared site copy.
- The primary journey works without JavaScript.
- Mobile performance is measured on staging, not inferred from desktop styling.
