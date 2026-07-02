# Sprint 10.4B — Staging Elementor Default Kit Repair

**Date:** 2026-07-02
**Status:** Complete — pending commit

---

## Problem

On a clean WordPress install + Git deployment, opening Elementor editor shows:

> "Your site doesn't have a default kit. Seems like your kit was deleted, please create new one or try restore it from trash."

This blocks all Elementor editing until the Default Kit is repaired.

---

## Root cause

The Elementor Default Kit is a post of type `elementor_library` with `_elementor_template_type = kit`. Elementor stores its ID in the `elementor_active_kit` WordPress option. On a fresh database (clean install, import without kit data, or accidental trash), this post is absent or trashed, and the option is stale.

---

## What was built

### `gu_elementor_kit_status()` — status helper

Returns one of six states:

| `kit_status` | Meaning |
|---|---|
| `not_elementor` | Elementor plugin is not loaded |
| `ok` | Active kit exists and is published — no action needed |
| `trashed` | Option points to a trashed post — restorable |
| `broken` | Post exists but is not `publish` (draft, etc.) — fixable |
| `restorable` | Option invalid/missing, but another kit was found in DB |
| `missing` | No kit anywhere — must create new |

### `admin_post_gu_repair_kit` — POST handler

Repair logic per state:

| State | Action |
|---|---|
| `ok` | No-op, redirect with `kit_action=already_ok` |
| `trashed` | `wp_untrash_post()` + `wp_publish_post()` |
| `broken` | `wp_publish_post()` |
| `restorable` | Restore/publish orphaned kit + `update_option('elementor_active_kit', $id)` |
| `missing` | `wp_insert_post()` with `elementor_library` + required meta + set option |

**No destructive actions.** No existing kit content is modified. If a kit already exists, it is never duplicated.

### Setup page — Elementor Default Kit panel

Added between "CPT Archives" and "Flush Permalinks" cards:
- Green badge when kit is `ok`
- Red badge + explanation when kit is broken, with contextual description per state
- "Repair Elementor Default Kit" button (only shown when action is needed)
- Explanatory note describing what the action will do before the button is pressed
- Footer row showing the raw `elementor_active_kit` option value for debugging

Success/error notices shown after form submission.

### Quick Reference table updated

Added rows:
- WordPress nou instalat: includes kit repair step
- "Elementor arată 'doesn't have a default kit'" → Repair Elementor Default Kit

---

## Technical details

Elementor source reference: `elementor/core/kits/manager.php`

- Option: `elementor_active_kit` → post ID
- Post type: `elementor_library`
- Required meta:
  - `_elementor_template_type = kit`
  - `_elementor_edit_mode = builder`
- Kit validity check (from Elementor source): post must be `elementor_library`, `_elementor_template_type = kit`, and status must not be `trash`

The repair handler does NOT call `Elementor\Plugin::$instance->kits_manager` or any Elementor class methods — it uses only WordPress core functions (`wp_insert_post`, `wp_untrash_post`, `wp_publish_post`, `update_option`). This avoids Pro API dependencies and works even when Elementor is partially initialised.

---

## Files changed

| File | Change |
|---|---|
| `wp-plugin/gu-design-system/gu-design-system.php` | Added `gu_elementor_kit_status()`, `admin_post_gu_repair_kit` handler, kit panel in setup page; bumped to v1.3.3 |
| `dist/gu-design-system.zip` | Rebuilt from v1.3.3 source |

---

## Security

- Handler gated on `current_user_can('manage_options')`
- `check_admin_referer('gu_repair_kit')` nonce verification
- All output: `esc_html()`, `wp_kses()`, `esc_url()`
- POST handler uses `wp_safe_redirect()` + `exit`
- No user input is written to the database

---

## Usage

1. WP Admin → **GU Design System → Setup**
2. "Elementor Default Kit" card shows current status
3. If status shows ✗: click **Repair Elementor Default Kit**
4. Verify: open any page with Elementor — editor should load without the kit error
