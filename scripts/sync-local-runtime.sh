#!/bin/sh
# sync-local-runtime.sh — Sync the child theme + plugin from this repo into
# the LOCAL WordPress runtime ONLY.
#
# This script is deliberately separate from deploy-staging.sh. It exists to
# guarantee one thing deploy-staging.sh never guaranteed: it refuses to run
# unless the destination is exactly the approved local install, it always
# backs up first (database + existing plugin/theme), and it verifies the
# copy afterward instead of assuming it worked.
#
# It never touches staging or live. There is no SSH, no remote host, no
# rsync-over-network anywhere in this file — the only destination this
# script can ever write to is a single hardcoded local filesystem path.
#
# Usage:
#   sh scripts/sync-local-runtime.sh              # backup + sync + verify
#   sh scripts/sync-local-runtime.sh --dry-run     # show what would happen, change nothing
#
# What this does NOT do:
#   - does not activate the child theme
#   - does not change any Elementor condition, template, or Theme Builder location
#   - does not touch wp-content/uploads
#   - does not touch wp-content/plugins/elementor or elementor-pro
#   - does not touch any other plugin or theme
#   - does not connect to staging or live in any way

set -e

# ─────────────────────────────────────────────────────────────
# HARD-CODED DESTINATION — no environment override, on purpose.
# The one property this script exists to guarantee is that it can only ever
# write to this exact local path. If this path is ever wrong, fix it here,
# deliberately, in a reviewed commit — never via an env var at call time.
# ─────────────────────────────────────────────────────────────

APPROVED_WP_PATH="/Users/puiucrisanbucur/Local Sites/georgeungureanu-doctor-dev/app/public"

REPO_ROOT="$(cd "$(dirname "$0")/.." && pwd)"

PLUGIN_SRC="$REPO_ROOT/wp-plugin/gu-design-system"
PLUGIN_DST="$APPROVED_WP_PATH/wp-content/plugins/gu-design-system"

THEME_SRC="$REPO_ROOT/wp-content/themes/ungureanu-md-child"
THEME_DST="$APPROVED_WP_PATH/wp-content/themes/ungureanu-md-child"

BACKUP_ROOT="$HOME/Desktop/gu-sync-backup-$(date +%Y%m%d-%H%M%S)"

# Local (LocalWP) mysql/php binaries + socket used elsewhere in this project
# for read-only DB access. Same paths used throughout docs/audit/.
MYSQL_BIN_DIR="/Users/puiucrisanbucur/Library/Application Support/Local/lightning-services/mysql-8.4.0/bin/darwin-arm64/bin"
MYSQL_SOCK="/Users/puiucrisanbucur/Library/Application Support/Local/run/aIKA0gWRn/mysql/mysqld.sock"
PHP_BIN="/Users/puiucrisanbucur/Library/Application Support/Local/lightning-services/php-8.2.29+0/bin/darwin-arm64/bin/php"

DRY_RUN=0
if [ "$1" = "--dry-run" ]; then
  DRY_RUN=1
fi

# ─────────────────────────────────────────────────────────────
# HELPERS
# ─────────────────────────────────────────────────────────────

log()  { printf '  %s\n' "$*"; }
ok()   { printf '  \342\234\223 %s\n' "$*"; }
info() { printf '\n\342\224\200\342\224\200 %s \342\224\200\342\224\200\n' "$*"; }
warn() { printf '  \342\232\240 %s\n' "$*"; }
fail() { printf '\n\342\234\227 %s\n' "$*"; exit 1; }

# ─────────────────────────────────────────────────────────────
# GUARD 1 — destination must resolve, by realpath, to the approved local
# path. This is a string-vs-resolved-path check, not just an existence
# check, so a symlink pointing elsewhere would still be caught.
# ─────────────────────────────────────────────────────────────

info "Destination guard"

case "$APPROVED_WP_PATH" in
  *"Local Sites"*) ;;
  *) fail "APPROVED_WP_PATH does not look like a LocalWP path — refusing to run." ;;
esac

if [ ! -d "$APPROVED_WP_PATH" ]; then
  fail "Approved local path does not exist: $APPROVED_WP_PATH — refusing to run."
fi

RESOLVED_DEST="$(cd "$APPROVED_WP_PATH" && pwd -P)"

case "$RESOLVED_DEST" in
  *"/Local Sites/georgeungureanu-doctor-dev/app/public") ;;
  *) fail "Resolved realpath ($RESOLVED_DEST) does not match the approved local install — a symlink or unexpected mount may be involved. Refusing to run." ;;
esac

if [ ! -f "$APPROVED_WP_PATH/wp-load.php" ]; then
  fail "No wp-load.php found at $APPROVED_WP_PATH — this is not a WordPress install. Refusing to run."
fi

ok "Destination confirmed: $RESOLVED_DEST"
log "Repo root : $REPO_ROOT"
log "Plugin    : $PLUGIN_SRC -> $PLUGIN_DST"
log "Theme     : $THEME_SRC -> $THEME_DST"
if [ "$DRY_RUN" = "1" ]; then log "Mode      : DRY RUN (no backup, no copy, no verification writes)"; fi

if [ "$DRY_RUN" = "1" ]; then
  info "DRY RUN — nothing will be backed up or copied"
  log "[DRY RUN] backup target would be: $BACKUP_ROOT"
  log "[DRY RUN] would back up: local DB, existing plugin dir (if any), existing theme dir (if any)"
  log "[DRY RUN] would sync    : $PLUGIN_SRC -> $PLUGIN_DST"
  log "[DRY RUN] would sync    : $THEME_SRC  -> $THEME_DST"
  log "[DRY RUN] would verify  : realpath, checksum+size for every file both ways (fails on any mismatch/extra file), wp_get_theme() + plugin version (mandatory, fails the script if either check does not pass)"
  exit 0
fi

# ─────────────────────────────────────────────────────────────
# BACKUP — database + existing plugin/theme directories, outside the repo.
# Refuses to proceed if the DB backup cannot be made.
# ─────────────────────────────────────────────────────────────

info "Backup (outside repo, before any copy)"

mkdir -p "$BACKUP_ROOT"

if [ -x "$MYSQL_BIN_DIR/mysqldump" ] && [ -S "$MYSQL_SOCK" ]; then
  "$MYSQL_BIN_DIR/mysqldump" --socket="$MYSQL_SOCK" -uroot -proot local \
    > "$BACKUP_ROOT/db-pre-sync.sql" 2>/dev/null
  ok "Database backed up -> $BACKUP_ROOT/db-pre-sync.sql"
else
  fail "Local mysqldump binary or socket not found at the expected path — refusing to sync without a DB backup."
fi

if [ -d "$PLUGIN_DST" ]; then
  cp -R "$PLUGIN_DST" "$BACKUP_ROOT/gu-design-system.before-sync"
  ok "Existing plugin backed up -> $BACKUP_ROOT/gu-design-system.before-sync"
else
  log "No existing plugin at destination — nothing to back up."
fi

if [ -d "$THEME_DST" ]; then
  cp -R "$THEME_DST" "$BACKUP_ROOT/ungureanu-md-child.before-sync"
  ok "Existing theme backed up -> $BACKUP_ROOT/ungureanu-md-child.before-sync"
else
  log "No existing theme at destination — nothing to back up (expected on first sync)."
fi

# ─────────────────────────────────────────────────────────────
# SYNC — only the two named directories. Never uploads, never other
# plugins/themes, never Elementor/Elementor Pro — those simply are not
# among the source/destination pairs this script knows about.
# ─────────────────────────────────────────────────────────────

if command -v rsync > /dev/null 2>&1; then
  SYNC_CMD="rsync"
else
  SYNC_CMD="cp"
  warn "rsync not found — using cp -R (no deletion of removed files)"
fi

sync_dir() {
  src="$1"; dst="$2"; label="$3"
  if [ ! -d "$src" ]; then
    fail "Source not found: $src — refusing to sync $label from a missing source."
  fi
  mkdir -p "$dst"
  if [ "$SYNC_CMD" = "rsync" ]; then
    rsync -av --delete \
      --exclude=".DS_Store" \
      "$src/" "$dst/" > /dev/null
  else
    cp -R "$src/." "$dst/"
    find "$dst" -name ".DS_Store" -exec rm -f {} +
  fi
  ok "$label synced (byte-for-byte, excluding only .DS_Store)"
}

info "Syncing plugin"
sync_dir "$PLUGIN_SRC" "$PLUGIN_DST" "gu-design-system"

info "Syncing theme"
sync_dir "$THEME_SRC" "$THEME_DST" "ungureanu-md-child"

# ─────────────────────────────────────────────────────────────
# VERIFY — realpath, checksum + size for every synced file, wp_get_theme(),
# plugin version. This is what deploy-staging.sh never did: confirm the
# copy actually landed, byte-for-byte, instead of assuming rsync succeeded.
# ─────────────────────────────────────────────────────────────

info "Verification"

log "Plugin dest realpath: $(cd "$PLUGIN_DST" && pwd -P)"
log "Theme dest realpath : $(cd "$THEME_DST" && pwd -P)"

MISMATCH=0
OLD_IFS="$IFS"

# List files relative to a root, one per line, safe for names containing
# spaces (splits on newline only — filenames containing literal newlines
# are not a case this repo produces). Excludes .DS_Store, since that is the
# one thing sync_dir() is allowed to skip.
list_files() {
  root="$1"
  ( cd "$root" && find . -type f ! -name ".DS_Store" | sed 's|^\./||' )
}

check_tree() {
  src_root="$1"; dst_root="$2"; label="$3"

  IFS='
'
  for f in $(list_files "$src_root"); do
    IFS="$OLD_IFS"
    if [ ! -f "$dst_root/$f" ]; then
      warn "$label: missing at destination: $f"
      MISMATCH=1
      IFS='
'
      continue
    fi
    s1=$(shasum -a 256 "$src_root/$f" | awk '{print $1}')
    z1=$(stat -f "%z" "$src_root/$f")
    s2=$(shasum -a 256 "$dst_root/$f" | awk '{print $1}')
    z2=$(stat -f "%z" "$dst_root/$f")
    if [ "$s1" != "$s2" ] || [ "$z1" != "$z2" ]; then
      warn "$label: checksum/size mismatch: $f (size $z1 vs $z2, sha256 $s1 vs $s2)"
      MISMATCH=1
    fi
    IFS='
'
  done
  IFS="$OLD_IFS"

  # Reverse direction: any file present at destination but absent from the
  # repo source is unexpected — byte-for-byte means nothing extra either.
  IFS='
'
  for f in $(list_files "$dst_root"); do
    IFS="$OLD_IFS"
    if [ ! -f "$src_root/$f" ]; then
      warn "$label: unexpected extra file at destination (not in repo source): $f"
      MISMATCH=1
    fi
    IFS='
'
  done
  IFS="$OLD_IFS"
}

check_tree "$PLUGIN_SRC" "$PLUGIN_DST" "plugin"
check_tree "$THEME_SRC" "$THEME_DST" "theme"

if [ "$MISMATCH" = "0" ]; then
  ok "Every file matches the repo source exactly (checksum + size), no extra files"
else
  fail "Plugin/theme sync verification failed — destination is not byte-for-byte identical to repo source. See warnings above."
fi

info "PHP / WordPress verification (mandatory — failure stops this script)"

if [ ! -x "$PHP_BIN" ]; then
  fail "Local PHP binary not found at expected path: $PHP_BIN — refusing to finish without wp_get_theme()/plugin verification."
fi

PHP_VERIFY_OUTPUT=$("$PHP_BIN" -d mysqli.default_socket="$MYSQL_SOCK" -d pdo_mysql.default_socket="$MYSQL_SOCK" -r '
define("WP_USE_THEMES", false);
require "'"$APPROVED_WP_PATH"'/wp-load.php";

$t = wp_get_theme("ungureanu-md-child");
if ( ! $t->exists() ) {
	$errors = $t->errors();
	echo "FAIL: wp_get_theme(ungureanu-md-child)->exists() is false: " . ( $errors ? implode( "; ", $errors->get_error_messages() ) : "unknown error" ) . "\n";
	exit(1);
}
echo "OK: wp_get_theme(ungureanu-md-child)->exists() is true, version " . $t->get( "Version" ) . "\n";

$plugin_file = "'"$PLUGIN_DST"'/gu-design-system.php";
if ( ! file_exists( $plugin_file ) ) {
	echo "FAIL: plugin main file not found at $plugin_file\n";
	exit(1);
}
$data = get_file_data( $plugin_file, [ "Version" => "Version", "Name" => "Plugin Name" ] );
if ( empty( $data["Version"] ) ) {
	echo "FAIL: plugin metadata unreadable or missing Version header at $plugin_file\n";
	exit(1);
}
echo "OK: plugin on disk: " . $data["Name"] . " v" . $data["Version"] . "\n";
echo "OK: active theme (unchanged by this script): " . get_option( "stylesheet" ) . "\n";
exit(0);
' 2>&1) || {
  printf '%s\n' "$PHP_VERIFY_OUTPUT" | sed 's/^/  /'
  fail "PHP/WordPress verification failed (wp_get_theme or plugin metadata check did not pass)."
}

printf '%s\n' "$PHP_VERIFY_OUTPUT" | sed 's/^/  /'
ok "PHP/WordPress verification passed"

info "Done — nothing activated, no Elementor condition touched"
log "Plugin : $PLUGIN_DST"
log "Theme  : $THEME_DST"
log "Backup : $BACKUP_ROOT"
log ""
log "This script never activates the theme and never touches Elementor"
log "conditions. Activating the theme, if desired, remains a separate,"
log "deliberate step — same as before."
