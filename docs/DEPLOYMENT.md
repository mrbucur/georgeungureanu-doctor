# Deployment Guide — georgeungureanu.doctor

**Environment:** LocalWP → staging → production  
**Last updated:** 2026-07-02 (Sprint 10.0 — updated for Apple Health design system v1.3.0)

---

## Prerequisites

### LocalWP
- LocalWP ≥ 9.x with PHP 8.1+ and MySQL 8.0+ (socket-based connection)
- Node.js ≥ 18 (for Playwright QA scripts)

### Required Plugins (in activation order)
| Plugin | Version tested | Source |
|---|---|---|
| Elementor | 4.1.4 | wordpress.org |
| Elementor Pro | 4.1.2 | elementor.com (license required) |
| Advanced Custom Fields (Free) | 6.8.4 | wordpress.org |
| GU Design System | 1.3.0 | `wp-plugin/gu-design-system/` (this repo) |

**Do not use ACF Pro** — all field groups use ACF Free only.

### Theme
- Hello Elementor (bundled with Elementor)
- No child theme

---

## Import Order

Follow this exact sequence. Skipping steps or reversing order will break template conditions or field group assignments.

### Step 1 — Install WordPress
Fresh WP install. Set site URL to your target domain. Set permalink structure to **Post name** (`/%postname%/`) immediately.

### Step 2 — Install and activate plugins
Activate in this order:
1. Elementor
2. Elementor Pro
3. Advanced Custom Fields (Free)
4. GU Design System v1.3.0 (upload from `wp-plugin/gu-design-system/` or install the zip)

### Step 3 — Activate Hello Elementor theme

### Step 4 — Configure Elementor Site Settings
Open **Elementor → Site Settings → Global Colors** and enter the 8 primary tokens:

| Token name | Hex |
|---|---|
| Color Ink | `#1D1D1F` |
| Color Ink Secondary | `#424245` |
| Color Ink Tertiary | `#6E6E73` |
| Color Surface | `#FFFFFF` |
| Color Surface Warm | `#F5F5F7` |
| Color Surface Gray | `#F2F2F7` |
| Color Accent | `#0E7FC0` |
| Color Accent Hover | `#0B6094` |

Under **Global Typography** configure:
- Primary font: **Inter**, weight 700
- Secondary font: **Inter**, weight 400/500/600
- Text font: **Inter**, weight 400

> The plugin overrides typography via CSS custom properties. Elementor's global font settings are a safety fallback — the rendered site will use Inter regardless. **Do not set Lora** as a font; it is not used in this design system.

### Step 5 — ACF Field Group Sync

The plugin ships with `acf-json/` which ACF uses for auto-sync.

1. Go to **Custom Fields → Tools → Sync**
2. Three field groups should appear:

| File | Title | Fields |
|---|---|---|
| `group_ar.json` | Article (Knowledge Center) | 33 |
| `group_mc.json` | Medical Condition | 12 |
| `group_sp.json` | Surgical Procedure | 13 |

3. Click **Sync All**
4. Verify field counts match the table above

If `acf-json/` is not detected: check that the live plugin directory contains all three `acf-json/*.json` files.

### Step 6 — Create Required Pages

Create these pages (slug must match exactly):

| Title | Slug | Status | Rendered by |
|---|---|---|---|
| Acasă | `acasa` | Publish | Elementor + PHP shortcode |
| Despre | `despre` | Publish | Elementor + PHP shortcode |
| Programări | `programari` | Publish | PHP shortcode (no Elementor editor needed) |
| Recomandări | `recomandari` | Publish | PHP shortcode |
| Articole | `articole` | Publish | PHP shortcode (Sfatul hub) |
| Afecțiuni | `afectiuni` | Publish | Elementor archive template |
| Intervenții | `interventii` | Publish | Elementor archive template |

> Pages marked **PHP shortcode** are fully rendered by the GU Design System plugin. Their Elementor editor content is ignored — the plugin hooks onto the page slug to inject content. The plugin must be active for these pages to render correctly.

After creating pages: go to **Settings → Reading** and set "Your homepage displays" to **A static page**, selecting **Acasă** as Homepage.

### Step 7 — Import Elementor Templates

Templates are in `wp-plugin/gu-design-system/elementor-templates/`. Import via **Elementor → My Templates → Import Template**. Import in this order:

1. `header.json` — Header template
2. `footer.json` — Footer template
3. `404-page.json` — 404 error page
4. `sprint4-single-afectiuni.json` — Afecțiune single page
5. `sprint4-archive-afectiuni.json` — Afecțiuni archive
6. `sprint5-single-interventii.json` — Intervenție single page
7. `sprint5-archive-interventii.json` — Intervenții archive
8. `sprint7a-archive-articole.json` — Articole archive (Sfatul hub listing)
9. `sprint7a-single-articol.json` — Articol single page
10. `sprint8-page-despre.json` — Despre page

> The following templates are reusable sections and optional: `sprint6-cta-final.json`, `sprint6-faq-programari.json`, `sprint6-locatie-card.json`, `sprint6-programari.json`. The homepage CTA and Programări page are now PHP-rendered; these exports are retained for reference only.

### Step 8 — Assign Theme Builder Conditions

After importing templates, go to **Elementor → Theme Builder** and assign conditions:

| Template | Type | Condition |
|---|---|---|
| Header | Header | All Pages |
| Footer | Footer | All Pages |
| 404 | Single | 404 Page |
| Single Afecțiune | Single | `afectiuni` post type |
| Archive Afecțiuni | Archive | `afectiuni` archive |
| Single Intervenție | Single | `interventii` post type |
| Archive Intervenții | Archive | `interventii` archive |
| Single Articol | Single | `articole` post type |
| Archive Articole | Archive | `articole` archive |

> Theme Builder conditions are stored in the WordPress database, not in the exported JSON. They must be assigned manually after every fresh import.

### Step 9 — Set Homepage Content

The homepage is built in Elementor. Either:
- Edit the **Acasă** page directly in Elementor and rebuild the hero/sections, or
- Use **My Templates → Pages → Acasă** if a homepage template export exists

> The final CTA section on the homepage is PHP-injected via `wp_footer` hook (guarded with `is_front_page()`). It does not require Elementor editing.

### Step 10 — Create Demo Content

For each CPT, create at least one demo post to verify templates render:

**Afecțiuni** (post type `afectiuni`):
- Fill all 12 ACF fields: subtitle, short_summary, overview, symptoms, causes, risk_factors, diagnostic, treatment_conservative, treatment_surgical, when_surgery, prognosis, cta_text

**Intervenții** (post type `interventii`):
- Fill all 13 ACF fields: subtitle, short_summary, indications, when_surgery, surgical_technique, benefits, risks, recovery_timeline, faq, cta_title, cta_text, seo_title, seo_description

**Articole** (post type `articole`):
- Fill required ACF fields from `group_ar.json` (Article / Knowledge Center, 33 fields)
- Minimum: title, excerpt, featured image, category

### Step 11 — CSS Regeneration

After all templates are imported and conditions are set:

1. Go to **Elementor → Tools → Regenerate CSS & Data**
2. Click **Regenerate Files**
3. Wait for completion (may take 30–60 seconds)

### Step 12 — Permalink Flush

1. Go to **Settings → Permalinks**
2. Click **Save Changes** (no changes needed — this flushes rewrite rules)
3. Verify `/afectiuni/`, `/interventii/`, `/articole/` return 200

---

## Post-Deployment Verification Checklist

Run in a private/incognito browser after every deployment.

### Pages
- [ ] Homepage loads at `/` — hero, statistics, cards, PHP CTA, footer
- [ ] `/despre/` loads — credentials strip, biography, philosophy section visible
- [ ] `/programari/` loads — 3 clinic cards, online consultation card, checklist, FAQ
- [ ] `/recomandari/` loads — colleague and patient recommendation cards
- [ ] `/articole/` loads — Sfatul hub: featured article, hub nav, guide/recovery sections
- [ ] `/afectiuni/` archive shows card grid
- [ ] `/afectiuni/[slug]/` single renders with all ACF sections
- [ ] `/interventii/` archive shows card grid
- [ ] `/interventii/[slug]/` single renders with all ACF sections
- [ ] `/does-not-exist/` renders custom 404 template (not WP default)

### Design system
- [ ] Inter font loaded (check Network tab → Fonts — no Lora requests)
- [ ] `gu-design-system.css` enqueued (check Network tab)
- [ ] `gu-animations.js` enqueued
- [ ] Primary buttons: background `#0E7FC0` (blue)
- [ ] No white text on light backgrounds (hero, CTA, cards)
- [ ] Footer text: readable (dark text on `#1D1D1F` dark background)
- [ ] Homepage PHP CTA: gradient `#FFFFFF → #F2F2F7`, heading `#1D1D1F`

### Responsive
- [ ] Desktop (1440px): layout and type scale correct
- [ ] Tablet (768px): responsive font sizes active
- [ ] Mobile (390px): 24px horizontal padding, burger menu functional

### Performance
- [ ] No PHP warnings or notices in rendered HTML source
- [ ] No literal `[gu_` shortcode strings visible on any page
- [ ] No `[elementor-tag ...]` strings visible
- [ ] Elementor CSS files present at `wp-content/uploads/elementor/css/`

### ACF
- [ ] **Custom Fields → Tools → Sync** shows 0 pending (all 3 groups synced)
- [ ] All three field groups visible in admin (Article, Medical Condition, Surgical Procedure)
- [ ] ACF fields render on Afecțiuni and Intervenții single pages

---

## Troubleshooting

| Symptom | Cause | Fix |
|---|---|---|
| `[elementor-tag id="" name="post-title" ...]` visible | `__dynamic__` key missing or element cache stale | Delete `_elementor_element_cache` postmeta rows; disable element cache TTL |
| Section backgrounds not visible | `content_width` not set to `'full'` on outer containers, or CSS file deleted | Delete `_elementor_css` postmeta for the template post, then reload the page |
| PHP "Array to string conversion" on frontend | Widget setting with `prefix_class` received an array value | Check `content_width` in template JSON — must be `'full'` or `'boxed'`, not a slider array |
| ACF fields not showing in admin | ACF group key missing in `post_excerpt` (DB bug) | Set `post_excerpt = '{group_key}'` on the `acf-field-group` post |
| `/afectiuni/`, `/interventii/`, or `/articole/` returns 404 | Rewrite rules not flushed after CPT registration | Settings → Permalinks → Save Changes |
| Programări / Recomandări / Articole page is blank | GU Design System plugin not active | Activate the plugin |
| Homepage CTA section missing | `is_front_page()` check failed — page not set as static front page | Settings → Reading → set Acasă as Homepage |
| Inter font not loading | Google Fonts blocked or plugin not active | Check plugin activation; verify no CSP blocking fonts.googleapis.com |
| Old warm/earth-tone colors appearing | Elementor global colors set to old palette | Reset via Elementor → Site Settings → Global Colors using token table in Step 4 |
