# Spacing System

## georgeungureanu.doctor

---

## Philosophy

Whitespace is not absence. It is presence. It signals that content is important enough to breathe. It creates the calm, unhurried experience that a patient in distress needs.

The spacing system is built on a base unit of 8px. All spacing values are multiples of 8. This creates mathematical consistency and visual rhythm across every element.

---

## Base Unit

```
Base unit: 8px
```

All spacing values derive from this unit.

---

## Spacing Scale

| Token | Value | Pixels | Usage |
|-------|-------|--------|-------|
| `space-1` | 0.5× | 4px | Micro gaps: icon-to-label, badge padding |
| `space-2` | 1× | 8px | Tight gaps: list item spacing, form field internals |
| `space-3` | 1.5× | 12px | Small gaps: between label and input, between icon and text |
| `space-4` | 2× | 16px | Standard gaps: paragraph spacing, button padding (vertical) |
| `space-5` | 2.5× | 20px | Medium gaps: small section margins, card padding (small) |
| `space-6` | 3× | 24px | Standard component spacing: card padding, navigation gaps |
| `space-8` | 4× | 32px | Section elements: space between heading and body |
| `space-10` | 5× | 40px | Section internals: between subcomponents |
| `space-12` | 6× | 48px | Section padding (small): tight sections on mobile |
| `space-16` | 8× | 64px | Section padding (standard): most section top/bottom padding |
| `space-20` | 10× | 80px | Section padding (large): hero, prominent sections |
| `space-24` | 12× | 96px | Section padding (generous): major editorial sections |
| `space-32` | 16× | 128px | Section padding (maximum): hero on desktop |

---

## Component-Level Spacing

### Buttons

```
Padding (vertical):   space-4  (16px)
Padding (horizontal): space-6  (24px)
Border-radius:        6px
Gap (icon + label):   space-2  (8px)
```

### Cards

```
Padding (all):        space-6  (24px)     — mobile / small card
Padding (all):        space-8  (32px)     — desktop / standard card
Border-radius:        8px
Gap between elements: space-4  (16px)
```

### Form Fields

```
Padding (vertical):   space-4  (16px)
Padding (horizontal): space-5  (20px)
Gap (label to input): space-2  (8px)
Gap between fields:   space-6  (24px)
Border-radius:        6px
Border:               1px solid color-border
```

### Navigation

```
Nav item gap:         space-6  (24px)     — desktop
Nav item padding:     space-4 space-6     — mobile drawer items
Logo to nav gap:      auto                — flex spacing
Nav to CTA gap:       space-8  (32px)
```

### Content Sections

```
Section padding (mobile):     space-12 space-6  (48px top/bottom, 24px sides)
Section padding (desktop):    space-20 space-8  (80px top/bottom, 32px sides)
Section padding (hero):       space-32 space-8  (128px top/bottom — desktop only)
Max content width:            1200px
Content column max width:     760px            — for body text
Wide content max width:       1100px           — for grid layouts
```

---

## Layout Grid

### Container

```
Max width:        1200px
Side padding:     space-6  (24px) on mobile
Side padding:     space-8  (32px) on tablet
Side padding:     space-10 (40px) on desktop
```

### Column Grid

| Breakpoint | Columns | Gutter |
|-----------|---------|--------|
| Mobile (<768px) | 4 | 16px |
| Tablet (768–1024px) | 8 | 24px |
| Desktop (1024–1280px) | 12 | 32px |
| Wide (1280px+) | 12 | 32px |

### Common Column Layouts

```
Full width:          12/12
Content column:      8/12 (centered)       — for long-form reading
Two-column equal:    6/12 + 6/12
Two-column narrow:   4/12 + 8/12           — sidebar or feature + text
Three-column:        4/12 + 4/12 + 4/12
```

---

## Vertical Rhythm

### Heading Spacing

```
Before H2 (after body):    space-16  (64px)
After H2 (before body):    space-6   (24px)
Before H3 (after body):    space-10  (40px)
After H3 (before body):    space-4   (16px)
Before H4 (after body):    space-8   (32px)
After H4 (before body):    space-3   (12px)
```

### Section Spacing

```
Between sections:     Defined by individual section padding (space-16 to space-32)
Background change:    Visual separator — no extra margin needed
Horizontal rule:      1px color-border, margin space-12 (48px) top and bottom
```

---

## Responsive Scaling

Spacing values scale down on mobile using a ratio. As a general rule:

- Section padding at 60–70% of desktop value on mobile
- Component padding at 70–80% of desktop value on mobile
- Text spacing unchanged (body rhythm is already mobile-appropriate)

---

## Rules

### Rule 1: Only System Values

All spacing values in Elementor must come from this system. No arbitrary pixel values (e.g., "23px", "37px", "55px"). If the design requires a value not in the system, use the nearest system value.

### Rule 2: More Space Is Usually Correct

When in doubt between two spacing values, choose the larger one. The content on this website benefits from being given room. Over-compression creates anxiety. Generous spacing creates calm.

### Rule 3: Consistency Within Component Types

All cards use the same internal padding. All sections use the same padding scale. All buttons use the same padding. Inconsistency in spacing signals disorder, which undermines trust.

### Rule 4: Spacing Communicates Relationship

Elements that belong together are spaced close. Elements that are distinct are spaced apart. Section headers belong to the content below them, not the content above — their spacing must reflect this (more space above than below).
