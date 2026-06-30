# Deployment Guide — georgeungureanu.doctor

**Environment:** LocalWP → staging → production  
**Last updated:** 2026-06-30

---

## Prerequisites

### LocalWP
- LocalWP ≥ 9.x with PHP 8.2 and MySQL 8.x (socket-based connection)
- Node.js ≥ 18 (for Playwright QA scripts)

### Required Plugins (in activation order)
| Plugin | Version tested | Source |
|---|---|---|
| Elementor | 4.1.4 | wordpress.org |
| Elementor Pro | 4.1.2 | elementor.com (license required) |
| Advanced Custom Fields (Free) | 6.8.4 | wordpress.org |
| GU Design System | 1.0.0 | `wp-plugin/gu-design-system/` (this repo) |

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
4. GU Design System (upload from `wp-plugin/gu-design-system/` or install the zip)

### Step 3 — Activate Hello Elementor theme

### Step 4 — Configure Elementor Site Settings
Open **Elementor → Site Settings → Global Colors** and enter the 8 primary tokens:

| Token name | Hex |
|---|---|
| Color Ink | `#231E1A` |
| Color Ink Secondary | `#5A4E47` |
| Color Surface | `#FDFBF7` |
| Color Surface Warm | `#F4EFE6` |
| Color Surface Muted | `#EDE8DF` |
| Color Accent | `#4D7A70` |
| Color Accent Hover | `#3A5F57` |
| Color Accent Subtle | `#E4EDEB` |

Under **Global Typography** configure:
- Primary font: Lora, weight 700
- Secondary font: Inter, weight 400/500/600
- Text font: Inter, weight 400

### Step 5 — ACF Field Group Sync

The plugin ships with `acf-json/` which ACF uses for auto-sync.

1. Go to **Custom Fields → Tools → Sync**
2. Both field groups should appear: **Medical Condition** and **Surgical Procedure**
3. Click **Sync All**
4. Verify field counts: Medical Condition = 12 fields, Surgical Procedure = 13 fields

If `acf-json/` is not detected: check that the live plugin directory contains `acf-json/group_mc.json` and `acf-json/group_sp.json`.

### Step 6 — Create Required Pages

Create these pages (slug must match exactly):

| Title | Slug | Status |
|---|---|---|
| Acasă | `acasa` | Publish |
| Programări | `programari` | Publish |

**Acasă** will be used as the static front page (set in Settings → Reading).

After importing Sprint 6 templates, apply the Programări page content:
1. Open the **Programări** page in Elementor editor
2. Click **+** → **My Templates** → **Pages** → **Programări**
3. Insert — the full 9-section page replaces the blank content
4. Update all `[CLIENT:]` placeholders (see SPRINT_6_PROGRAMARI_REPORT.md)
5. Update the form widget `email_to` field with the real email address

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
8. `sprint6-programari.json` — Programări page content
9. `sprint6-faq-programari.json` — Reusable FAQ section
10. `sprint6-locatie-card.json` — Reusable Location card section
11. `sprint6-cta-final.json` — Reusable Final CTA section

### Step 8 — Assign Theme Builder Conditions

After importing templates, go to **Elementor → Theme Builder** and assign conditions:

| Template | Type | Condition |
|---|---|---|
| organism-site-header | Header | All Pages |
| organism-site-footer | Footer | All Pages |
| organism-404-page | Single | 404 Page |
| Afecțiune — Single | Single | `afectiuni` post type |
| Afecțiuni — Archive | Archive | `afectiuni` archive |
| Intervenție — Single | Single | `interventii` post type |
| Intervenții — Archive | Archive | `interventii` archive |

### Step 9 — Set Homepage Template

1. Open **Elementor → Theme Builder → Pages**
2. Assign the homepage template to the **Acasă** page
3. Or edit the **Acasă** page directly in Elementor and paste the homepage template content

### Step 10 — Create Demo Content

For each CPT, create at least one demo post to verify templates render:

**Afecțiuni** (post type `afectiuni`):
- Fill all 12 ACF fields: subtitle, short_summary, overview, symptoms, causes, risk_factors, diagnostic, treatment_conservative, treatment_surgical, when_surgery, prognosis, cta_text

**Intervenții** (post type `interventii`):
- Fill all 13 ACF fields: subtitle, short_summary, indications, when_surgery, surgical_technique, benefits, risks, recovery_timeline, faq, cta_title, cta_text, seo_title, seo_description

### Step 11 — CSS Regeneration

After all templates are imported and conditions are set:

1. Go to **Elementor → Tools → Regenerate CSS & Data**
2. Click **Regenerate Files**
3. Wait for completion (may take 30–60 seconds)

### Step 12 — Permalink Flush

1. Go to **Settings → Permalinks**
2. Click **Save Changes** (no changes needed — this flushes rewrite rules)
3. Verify `/afectiuni/`, `/interventii/` return 200

---

## Post-Deployment Verification Checklist

Run through each item after every deployment.

### Functional
- [ ] Homepage loads at `/` with hero, sections, footer
- [ ] `/afectiuni/` archive shows card grid
- [ ] `/afectiuni/[slug]/` single renders with all ACF sections
- [ ] `/interventii/` archive shows card grid
- [ ] `/interventii/[slug]/` single renders with all ACF sections
- [ ] `/programari/` returns 200 (not 404)
- [ ] `/this-page-does-not-exist/` renders the 404 template (not WP default)
- [ ] All "Programează o consultație" buttons link to `/programari/`

### Design System
- [ ] Google Fonts (Lora + Inter) load from fonts.googleapis.com
- [ ] `gu-design-system.css` enqueued (check Network tab)
- [ ] Hero backgrounds show `#231E1A` (dark warm-black)
- [ ] Section backgrounds alternate warm (`#F4EFE6`) and white (`#FDFBF7`)
- [ ] Accent color `#4D7A70` on CTA buttons and links

### Responsive
- [ ] Desktop (1440px): inner containers constrained to 720–760px
- [ ] Tablet (768px): responsive font sizes active
- [ ] Mobile (390px): 24px horizontal padding on outer sections, burger menu active

### Performance
- [ ] No PHP warnings or notices in rendered HTML
- [ ] No literal `[elementor-tag ...]` strings visible on any page
- [ ] Elementor CSS files generated at `wp-content/uploads/elementor/css/`

### ACF
- [ ] `acf-json/` directory present in live plugin folder
- [ ] Both field groups sync-able from **Custom Fields → Tools → Sync**
- [ ] ACF field values render via `[gu_field name="..."]` shortcode

---

## Troubleshooting

| Symptom | Cause | Fix |
|---|---|---|
| `[elementor-tag id="" name="post-title" ...]` visible | `__dynamic__` key missing in widget settings, or element cache stale | Delete `_elementor_element_cache` postmeta rows; disable element cache TTL |
| Section backgrounds not visible | `content_width` not set to `'full'` on outer containers, or CSS file deleted without forcing regen | Delete `_elementor_css` postmeta for the template post, then reload the page |
| PHP "Array to string conversion" on frontend | Widget setting with `prefix_class` received an array value instead of string | Check `content_width` setting in template JSON — must be `'full'` or `'boxed'`, not a slider array |
| ACF fields not showing in admin | ACF group key missing in `post_excerpt` (DB bug) | Set `post_excerpt = '{group_key}'` on the `acf-field-group` post |
| `/afectiuni/` or `/interventii/` returns 404 | Rewrite rules not flushed after CPT registration | Settings → Permalinks → Save Changes |
| CTA buttons return 404 | `/programari/` page not created | Create a page with slug `programari` and status `publish` |
