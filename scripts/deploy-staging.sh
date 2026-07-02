#!/bin/sh
# deploy-staging.sh — Sync plugin and theme to the local WordPress instance.
#
# Usage:
#   sh scripts/deploy-staging.sh
#   sh scripts/deploy-staging.sh --dry-run
#
# What this does:
#   1. Syncs wp-plugin/gu-design-system/ → WP plugins directory
#   2. Syncs wp-content/themes/ungureanu-md-child/ → WP themes directory
#   3. Optionally flushes Elementor CSS cache via WP-CLI (if available)
#
# Staging deployment is handled separately via Git + cPanel Git Version Control.
# See docs/STAGING_DEPLOYMENT_WORKFLOW.md.

set -e

# ─────────────────────────────────────────────────────────────
# CONFIGURATION — adjust WP_PATH for your local environment
# ─────────────────────────────────────────────────────────────

REPO_ROOT="$(cd "$(dirname "$0")/.." && pwd)"

# LocalWP default path. Change this if your site is named differently.
WP_PATH="${WP_PATH:-/Users/puiucrisanbucur/Local Sites/georgeungureanu-doctor-dev/app/public}"

PLUGIN_SRC="$REPO_ROOT/wp-plugin/gu-design-system"
PLUGIN_DST="$WP_PATH/wp-content/plugins/gu-design-system"

THEME_SRC="$REPO_ROOT/wp-content/themes/ungureanu-md-child"
THEME_DST="$WP_PATH/wp-content/themes/ungureanu-md-child"

DRY_RUN=0
if [ "$1" = "--dry-run" ]; then
  DRY_RUN=1
fi

# ─────────────────────────────────────────────────────────────
# HELPERS
# ─────────────────────────────────────────────────────────────

log()  { printf '  %s\n' "$*"; }
ok()   { printf '  ✓ %s\n' "$*"; }
info() { printf '\n── %s ──\n' "$*"; }
warn() { printf '  ⚠ %s\n' "$*"; }

# Detect rsync; fall back to cp -R
if command -v rsync > /dev/null 2>&1; then
  SYNC_CMD="rsync"
else
  SYNC_CMD="cp"
  warn "rsync not found — using cp -R (no deletion of removed files)"
fi

sync_dir() {
  src="$1"
  dst="$2"
  label="$3"

  if [ ! -d "$src" ]; then
    warn "Source not found, skipping: $src"
    return 0
  fi

  if [ "$DRY_RUN" = "1" ]; then
    log "[DRY RUN] would sync $src → $dst"
    return 0
  fi

  mkdir -p "$dst"

  if [ "$SYNC_CMD" = "rsync" ]; then
    rsync -av --delete \
      --exclude=".DS_Store" \
      --exclude="*.map" \
      "$src/" "$dst/" > /dev/null
  else
    cp -R "$src/." "$dst/"
  fi

  ok "$label synced"
}

# ─────────────────────────────────────────────────────────────
# PREFLIGHT
# ─────────────────────────────────────────────────────────────

info "Deploy — local sync"
log "Repo root : $REPO_ROOT"
log "WP path   : $WP_PATH"
log "Sync tool : $SYNC_CMD"
if [ "$DRY_RUN" = "1" ]; then log "Mode      : DRY RUN"; fi

if [ ! -d "$WP_PATH" ]; then
  printf '\nERROR: WordPress path not found: %s\n' "$WP_PATH"
  printf 'Set WP_PATH env var or edit deploy-staging.sh.\n'
  exit 1
fi

# ─────────────────────────────────────────────────────────────
# SYNC
# ─────────────────────────────────────────────────────────────

info "Syncing plugin"
sync_dir "$PLUGIN_SRC" "$PLUGIN_DST" "gu-design-system"

info "Syncing theme"
sync_dir "$THEME_SRC" "$THEME_DST" "ungureanu-md-child"

# ─────────────────────────────────────────────────────────────
# WP-CLI (optional — flush Elementor CSS cache)
# ─────────────────────────────────────────────────────────────

info "WP-CLI"

WPCLI=""
if command -v wp > /dev/null 2>&1; then
  WPCLI="wp"
elif [ -f "$REPO_ROOT/vendor/bin/wp" ]; then
  WPCLI="$REPO_ROOT/vendor/bin/wp"
fi

if [ -n "$WPCLI" ] && [ "$DRY_RUN" = "0" ]; then
  log "WP-CLI found: $WPCLI"
  if $WPCLI --path="$WP_PATH" cli info > /dev/null 2>&1; then
    $WPCLI --path="$WP_PATH" elementor flush-css > /dev/null 2>&1 \
      && ok "Elementor CSS cache flushed" \
      || warn "elementor flush-css failed (plugin may not be active)"
  else
    warn "WP-CLI found but cannot connect to WordPress — skipping cache flush"
  fi
else
  log "WP-CLI not available — skipping cache flush"
  log "Clear cache manually: Elementor → Tools → Regenerate CSS"
fi

# ─────────────────────────────────────────────────────────────
# DONE
# ─────────────────────────────────────────────────────────────

info "Done"
log "Plugin : $PLUGIN_DST"
log "Theme  : $THEME_DST"
log ""
log "Next: open http://georgeungureanu-doctor-dev.local to verify."
