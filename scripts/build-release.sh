#!/bin/sh
# build-release.sh — Build installable ZIPs into dist/.
#
# Usage:
#   sh scripts/build-release.sh
#
# Output:
#   dist/gu-design-system.zip
#   dist/ungureanu-md-child.zip
#
# This is an EMERGENCY FALLBACK only.
# Normal deployment uses Git + cPanel Git Version Control.
# See docs/STAGING_DEPLOYMENT_WORKFLOW.md.

set -e

REPO_ROOT="$(cd "$(dirname "$0")/.." && pwd)"
DIST="$REPO_ROOT/dist"

log()  { printf '  %s\n' "$*"; }
ok()   { printf '  ✓ %s\n' "$*"; }
info() { printf '\n── %s ──\n' "$*"; }

# ─────────────────────────────────────────────────────────────
# PREFLIGHT
# ─────────────────────────────────────────────────────────────

if ! command -v zip > /dev/null 2>&1; then
  printf 'ERROR: zip not found. Install zip and retry.\n'
  exit 1
fi

mkdir -p "$DIST"

info "Building release ZIPs → dist/"
log "Repo root : $REPO_ROOT"
log "Output    : $DIST"

# ─────────────────────────────────────────────────────────────
# gu-design-system.zip
# ─────────────────────────────────────────────────────────────

info "Plugin — gu-design-system"

PLUGIN_SRC="$REPO_ROOT/wp-plugin/gu-design-system"
PLUGIN_ZIP="$DIST/gu-design-system.zip"

if [ ! -d "$PLUGIN_SRC" ]; then
  printf 'ERROR: plugin source not found: %s\n' "$PLUGIN_SRC"
  exit 1
fi

rm -f "$PLUGIN_ZIP"

(
  cd "$REPO_ROOT/wp-plugin"
  zip -r "$PLUGIN_ZIP" gu-design-system/ \
    --exclude "*.DS_Store" \
    --exclude "*/.git/*" \
    --exclude "*.map" \
    > /dev/null
)

SIZE=$(du -sh "$PLUGIN_ZIP" | cut -f1)
ok "gu-design-system.zip — $SIZE"

# ─────────────────────────────────────────────────────────────
# ungureanu-md-child.zip
# ─────────────────────────────────────────────────────────────

info "Theme — ungureanu-md-child"

THEME_SRC="$REPO_ROOT/wp-content/themes/ungureanu-md-child"
THEME_ZIP="$DIST/ungureanu-md-child.zip"

if [ ! -d "$THEME_SRC" ]; then
  printf 'ERROR: theme source not found: %s\n' "$THEME_SRC"
  exit 1
fi

rm -f "$THEME_ZIP"

(
  cd "$REPO_ROOT/wp-content/themes"
  zip -r "$THEME_ZIP" ungureanu-md-child/ \
    --exclude "*.DS_Store" \
    --exclude "*/.git/*" \
    --exclude "*.map" \
    > /dev/null
)

SIZE=$(du -sh "$THEME_ZIP" | cut -f1)
ok "ungureanu-md-child.zip — $SIZE"

# ─────────────────────────────────────────────────────────────
# DONE
# ─────────────────────────────────────────────────────────────

info "Done"
log "dist/gu-design-system.zip"
log "dist/ungureanu-md-child.zip"
log ""
log "Upload via WordPress Admin → Plugins/Themes → Add New → Upload"
log "REMINDER: This is the emergency fallback. Use Git deployment normally."
