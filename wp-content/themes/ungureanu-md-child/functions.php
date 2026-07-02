<?php
/**
 * Ungureanu MD Child — functions.php
 *
 * Responsibilities of this file:
 *   ✓ Enqueue parent (Hello Elementor) + child stylesheets
 *   ✓ Enqueue child theme CSS (assets/css/theme.css)
 *   ✓ Register theme support declarations
 *   ✓ Remove plugin header hook — native header.php takes over
 *   ✓ Fix plugin CTA positioning for native footer
 *
 * NOT here (belongs in gu-design-system plugin):
 *   ✗ CPT registration
 *   ✗ Taxonomy registration
 *   ✗ ACF field group sync
 *   ✗ Shortcodes
 *   ✗ Schema.org output
 *   ✗ Design token CSS (gu-design-system.css)
 *   ✗ Component CSS and utility classes
 *   ✗ Scroll-reveal JS (gu-animations.js)
 *
 * See docs/planning/CHILD_THEME_ARCHITECTURE.md for the full split.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// ─────────────────────────────────────────────────────────────
// 1. REMOVE PLUGIN HEADER — native header.php takes over
// ─────────────────────────────────────────────────────────────

// The plugin registers gu_render_header() on wp_body_open at priority 1.
// With a native header.php, we render the header ourselves — remove the
// plugin's injection to prevent a duplicate header.
add_action( 'after_setup_theme', function () {
	remove_action( 'wp_body_open', 'gu_render_header', 1 );
} );


// ─────────────────────────────────────────────────────────────
// 2. ENQUEUE STYLES
// ─────────────────────────────────────────────────────────────

add_action( 'wp_enqueue_scripts', 'ungureanu_child_enqueue_styles' );

function ungureanu_child_enqueue_styles() {

	$parent_theme = wp_get_theme( 'hello-elementor' );
	$child_theme  = wp_get_theme();

	// Hello Elementor parent stylesheet.
	wp_enqueue_style(
		'hello-elementor-style',
		get_template_directory_uri() . '/style.css',
		[],
		$parent_theme->get( 'Version' )
	);

	// Child theme registration stylesheet (style.css).
	// Contains only the theme header comment — no rules.
	wp_enqueue_style(
		'ungureanu-md-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		[ 'hello-elementor-style' ],
		$child_theme->get( 'Version' )
	);

	// Child theme CSS — footer, hero, front-page sections, 404.
	// Design tokens and component CSS remain in the plugin.
	wp_enqueue_style(
		'ungureanu-md-child-theme',
		get_stylesheet_directory_uri() . '/assets/css/theme.css',
		[ 'ungureanu-md-child-style', 'gu-design-system' ],
		$child_theme->get( 'Version' )
	);
}


// ─────────────────────────────────────────────────────────────
// 3. THEME SUPPORT
// ─────────────────────────────────────────────────────────────

add_action( 'after_setup_theme', 'ungureanu_child_theme_support' );

function ungureanu_child_theme_support() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', [
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		'style',
		'script',
	] );
}


// ─────────────────────────────────────────────────────────────
// 4. FIX PLUGIN CTA POSITIONING FOR NATIVE FOOTER
// ─────────────────────────────────────────────────────────────

// The plugin injects #gu-cta-rebuilt via wp_footer (priority 20) and positions
// it before .elementor-location-footer via inline JS. The native footer uses
// id="gu-site-footer" instead, so the plugin's JS silently fails.
// This hook runs at priority 25 (after plugin's 20) and repositions the CTA
// before the native footer — no plugin changes required.
add_action( 'wp_footer', function () {
	if ( ! is_front_page() ) {
		return;
	}
	?>
	<script>
	(function () {
		var footer = document.getElementById( 'gu-site-footer' );
		var cta    = document.getElementById( 'gu-cta-rebuilt' );
		if ( footer && cta && footer.parentNode ) {
			footer.parentNode.insertBefore( cta, footer );
		}
	}());
	</script>
	<?php
}, 25 );
