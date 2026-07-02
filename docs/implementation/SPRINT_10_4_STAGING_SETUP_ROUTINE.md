# Sprint 10.4 — Staging Setup Routine: Create Core Pages

**Date:** 2026-07-02
**Status:** Complete — pending commit

---

## Objective

Add a "GU Design System → Setup" admin page to the plugin. Provides two one-click tools for initialising a fresh WordPress install (staging or production) without WP-CLI or manual SQL.

---

## What was built

### Admin menu

- Top-level menu: **GU Design System** (dashicons-layout, position 80)
- Submenu page: **Setup** (same callback, removes auto-duplicate)

### `gu_core_pages_config()` — 5 required pages

| Title | Slug | Homepage |
|---|---|---|
| Acasă | `/acasa/` | yes |
| Despre | `/despre/` | |
| Recomandări | `/recomandari/` | |
| Programări | `/programari/` | |
| Sfatul Neurochirurgului | `/articole/` | |

### Button 1 — Create / Repair Core Pages

- Handler: `admin_post_gu_create_pages`
- Logic: `get_page_by_path()` → skip if exists, `wp_insert_post()` if missing
- No content overwrite on existing pages
- Sets `show_on_front = page` and `page_on_front = <acasa-id>` after run
- POST → PRG redirect with `created` + `skipped` counts in query string

### Button 2 — Flush Permalinks

- Handler: `admin_post_gu_flush_permalinks`
- Calls `flush_rewrite_rules(true)` (hard flush)
- POST → PRG redirect with `action=flushed`

### Setup page UI

- Status table: each page shows title, slug, URL, and ✓ Există / ✗ Lipsă badge
- Homepage panel: shows if `show_on_front=page` and `page_on_front` points to Acasă
- CPT archives panel: quick links to `/afectiuni/` and `/interventii/`
- Quick reference table: when to use each button

---

## Files changed

| File | Change |
|---|---|
| `wp-plugin/gu-design-system/gu-design-system.php` | Added admin setup section (~200 lines); bumped to v1.3.2 |
| `dist/gu-design-system.zip` | Rebuilt from v1.3.2 source |

---

## Usage (first deploy to new environment)

1. Activate plugin + activate child theme
2. WP Admin → **GU Design System → Setup**
3. Click **Create / Repair Core Pages** — creates 5 pages, sets Acasă as static front page
4. Click **Flush Permalinks** — activates CPT archive URLs
5. Assign Elementor templates to each page as needed
6. Verify: `/acasa/`, `/despre/`, `/recomandari/`, `/programari/`, `/articole/`

---

## Security

- All POST handlers check `current_user_can('manage_options')`
- Both forms use `wp_nonce_field()` + `check_admin_referer()`
- All output uses `esc_html()`, `esc_url()` — no raw user input echoed
- POST handlers use `wp_safe_redirect()` + `exit`

---

## Next sprint

Sprint 10.5 — single-page templates (Despre, Recomandări, Programări, etc.) or staging smoke-test pass.
