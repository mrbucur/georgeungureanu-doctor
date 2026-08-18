<?php
/**
 * Plugin Name:  GU Design System
 * Plugin URI:   https://georgeungureanu.doctor
 * Description:  Apple Health-inspired design system for georgeungureanu.doctor. Enqueues Inter via Google Fonts, CSS custom properties (color, typography, spacing, layout, motion tokens), scroll-reveal animations, and PHP-rendered page sections. Safe to activate/deactivate — removes everything on deactivation. Does not modify Elementor database settings and does not depend on Elementor Pro APIs.
 * Version:      1.5.4
 * Author:       Mr. Bucur
 * Author URI:   https://puiu.bucur.info
 * License:      Private — All rights reserved
 * Text Domain:  gu-design-system
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Prevent direct file access.
}

define( 'GU_DESIGN_SYSTEM_VERSION', '1.5.4' );
define( 'GU_DESIGN_SYSTEM_URL', plugin_dir_url( __FILE__ ) );
define( 'GU_ACF_JSON_DIR', plugin_dir_path( __FILE__ ) . 'acf-json' );

/**
 * Read shared site configuration without coupling the plugin to one theme.
 * The child theme owns the UI for these values; the fallback keeps the plugin
 * portable and prevents public output from becoming empty on a theme switch.
 */
function gu_shared_site_setting( string $key, string $default = '' ): string {
	if ( function_exists( 'gu_get_theme_setting' ) ) {
		return gu_get_theme_setting( $key );
	}

	$value = get_theme_mod( 'gu_' . $key, $default );
	return is_string( $value ) ? trim( $value ) : $default;
}

function gu_shared_primary_cta(): array {
	if ( function_exists( 'gu_get_primary_cta' ) ) {
		return gu_get_primary_cta();
	}

	return [
		'label' => gu_shared_site_setting( 'cta_label', 'Programează o consultație' ),
		'url'   => gu_shared_site_setting( 'cta_url', home_url( '/programari/' ) ),
	];
}

function gu_shared_navigation_items(): array {
	if ( function_exists( 'gu_get_navigation_items' ) ) {
		return gu_get_navigation_items();
	}

	return [
		[ 'title' => 'Acasă', 'url' => home_url( '/' ) ],
		[ 'title' => 'Afecțiuni', 'url' => home_url( '/afectiuni/' ) ],
		[ 'title' => 'Intervenții', 'url' => home_url( '/interventii/' ) ],
		[ 'title' => 'Sfatul Neurochirurgului', 'url' => home_url( '/articole/' ) ],
		[ 'title' => 'Recomandări', 'url' => home_url( '/recomandari/' ) ],
		[ 'title' => 'Despre', 'url' => home_url( '/despre/' ) ],
	];
}


// ─────────────────────────────────────────────────────────────
// 0. ACF JSON LOAD / SAVE
// ─────────────────────────────────────────────────────────────

// Append plugin acf-json to ACF's load paths (preserves default theme path).
add_filter( 'acf/settings/load_json', function ( $paths ) {
	$paths[] = GU_ACF_JSON_DIR;
	return $paths;
} );

// Direct all ACF saves to the plugin acf-json directory; create it if absent.
add_filter( 'acf/settings/save_json', function ( $path ) {
	if ( ! is_dir( GU_ACF_JSON_DIR ) ) {
		wp_mkdir_p( GU_ACF_JSON_DIR );
	}
	return GU_ACF_JSON_DIR;
} );


// ─────────────────────────────────────────────────────────────
// 1. FRONTEND STYLES
// ─────────────────────────────────────────────────────────────

/**
 * Enqueue Google Fonts and the design system stylesheet on every frontend page.
 *
 * Load order:
 *   1. gu-google-fonts  — Google Fonts CDN (Lora + Inter), no version string
 *   2. gu-design-system — CSS custom properties + utility classes, depends on fonts
 */
function gu_design_system_enqueue_styles() {

	/*
	 * Google Fonts
	 *
	 * Lora:  ital,wght@0,400 (body) | 0,700 (bold headings) | 1,400 (pull-quote italic)
	 * Inter: variable optical-size axis, weights 400 / 500 / 600
	 * display=swap: text renders immediately in system fallback, swaps when fonts arrive.
	 *
	 * Version is null — Google manages CDN versioning. Passing null prevents WordPress
	 * from appending ?ver= which breaks the Google Fonts URL.
	 */
	wp_enqueue_style(
		'gu-google-fonts',
		'https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,700;1,400&family=Inter:ital,opsz,wght@0,14..32,400;0,14..32,500;0,14..32,600&display=swap',
		[],
		null
	);

	/*
	 * Design system stylesheet
	 *
	 * Contains:
	 *  — CSS custom properties (:root) for all color, typography, spacing, layout, motion tokens
	 *  — Box-sizing reset
	 *  — Base body styles
	 *  — Global link styles
	 *  — Focus ring (accessibility)
	 *  — Text selection
	 *  — Typographic element defaults
	 *  — prefers-reduced-motion suppression
	 *  — Skip-to-content link
	 *  — Elementor container width constraints
	 *  — Utility classes: .reading-column, .section-dark, .text-overline,
	 *                     .callout-box, .callout-box-muted, .lead-paragraph
	 *  — Form base styles
	 *  — Print styles
	 */
	wp_enqueue_style(
		'gu-design-system',
		GU_DESIGN_SYSTEM_URL . 'assets/css/gu-design-system.css',
		[ 'gu-google-fonts' ],
		GU_DESIGN_SYSTEM_VERSION
	);
}
add_action( 'wp_enqueue_scripts', 'gu_design_system_enqueue_styles' );

function gu_design_system_enqueue_scripts() {
	wp_enqueue_script(
		'gu-header',
		GU_DESIGN_SYSTEM_URL . 'assets/js/gu-header.js',
		[],
		GU_DESIGN_SYSTEM_VERSION,
		true
	);
	wp_enqueue_script(
		'gu-animations',
		GU_DESIGN_SYSTEM_URL . 'assets/js/gu-animations.js',
		[],
		GU_DESIGN_SYSTEM_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'gu_design_system_enqueue_scripts' );


// ─────────────────────────────────────────────────────────────
// 2. PERFORMANCE — RESOURCE HINTS
// ─────────────────────────────────────────────────────────────

/**
 * Add <link rel="preconnect"> hints for Google Fonts origins.
 *
 * Establishes TCP/TLS connections to both Google Fonts hosts before the
 * stylesheet is parsed, reducing latency on the first font request.
 * fonts.gstatic.com requires crossorigin because it serves font files
 * from a different origin (CORS-required resource).
 *
 * @param  array  $urls          Existing resource hint URLs.
 * @param  string $relation_type The relation type being filtered.
 * @return array
 */
function gu_design_system_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' === $relation_type ) {
		$urls[] = [
			'href'        => 'https://fonts.googleapis.com',
			'crossorigin' => false,
		];
		$urls[] = [
			'href'        => 'https://fonts.gstatic.com',
			'crossorigin' => true, // Required: font files are cross-origin resources.
		];
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'gu_design_system_resource_hints', 10, 2 );


// ─────────────────────────────────────────────────────────────
// 3. ADMIN NOTICE — CONFIGURATION REMINDER
// ─────────────────────────────────────────────────────────────

/**
 * Show a one-time admin notice after activation reminding the implementer
 * to complete the Elementor Site Settings configuration.
 *
 * This plugin loads the CSS foundation only. Global Colors and Global Typography
 * must still be configured manually in Elementor → Site Settings.
 * Reference: docs/implementation/01_DESIGN_SYSTEM_SETUP.md
 */
function gu_design_system_activation_notice() {
	if ( ! get_transient( 'gu_design_system_activated' ) ) {
		return;
	}
	?>
	<div class="notice notice-info is-dismissible">
		<p>
			<strong>GU Design System active.</strong>
			Google Fonts and CSS custom properties are now loading on the frontend.
			Complete the design system setup by configuring
			<strong>Global Colors</strong> (14 colors) and
			<strong>Global Typography</strong> (15 styles) in
			<a href="<?php echo esc_url( admin_url( 'admin.php?page=elementor' ) ); ?>">Elementor → Site Settings</a>.
			Reference: <code>docs/implementation/01_DESIGN_SYSTEM_SETUP.md</code>
		</p>
	</div>
	<?php
	delete_transient( 'gu_design_system_activated' );
}
add_action( 'admin_notices', 'gu_design_system_activation_notice' );

/**
 * Set activation transient so the admin notice displays once.
 */
function gu_design_system_on_activate() {
	set_transient( 'gu_design_system_activated', true, 30 );
}
register_activation_hook( __FILE__, 'gu_design_system_on_activate' );

/**
 * Clean up on deactivation. Nothing is stored in the database, so this
 * is a no-op beyond clearing any residual transient.
 */
function gu_design_system_on_deactivate() {
	delete_transient( 'gu_design_system_activated' );
}
register_deactivation_hook( __FILE__, 'gu_design_system_on_deactivate' );


// ─────────────────────────────────────────────────────────────
// 4. CUSTOM POST TYPES AND TAXONOMIES
// ─────────────────────────────────────────────────────────────

function gu_register_cpt_afectiuni() {
	register_post_type( 'afectiuni', [
		'labels' => [
			'name'          => __( 'Afecțiuni', 'gu-design-system' ),
			'singular_name' => __( 'Afecțiune', 'gu-design-system' ),
			'add_new'       => __( 'Adaugă afecțiune', 'gu-design-system' ),
			'add_new_item'  => __( 'Adaugă afecțiune nouă', 'gu-design-system' ),
			'edit_item'     => __( 'Editează afecțiune', 'gu-design-system' ),
			'view_item'     => __( 'Vezi afecțiune', 'gu-design-system' ),
			'all_items'     => __( 'Toate afecțiunile', 'gu-design-system' ),
			'search_items'  => __( 'Caută afecțiuni', 'gu-design-system' ),
		],
		'public'            => true,
		'has_archive'       => true,
		'show_in_rest'      => true,
		'menu_icon'         => 'dashicons-heart',
		'supports'          => [ 'title', 'thumbnail', 'excerpt' ],
		'rewrite'           => [ 'slug' => 'afectiuni' ],
		'show_in_nav_menus' => true,
	] );
}
add_action( 'init', 'gu_register_cpt_afectiuni' );

function gu_register_taxonomy_categorie_afectiuni() {
	register_taxonomy( 'categorie-afectiuni', [ 'afectiuni' ], [
		'labels' => [
			'name'          => __( 'Categorii afecțiuni', 'gu-design-system' ),
			'singular_name' => __( 'Categorie afecțiuni', 'gu-design-system' ),
			'all_items'     => __( 'Toate categoriile', 'gu-design-system' ),
			'edit_item'     => __( 'Editează categoria', 'gu-design-system' ),
			'add_new_item'  => __( 'Adaugă categorie nouă', 'gu-design-system' ),
			'menu_name'     => __( 'Categorii', 'gu-design-system' ),
		],
		'hierarchical'  => true,
		'public'        => true,
		'show_in_rest'  => true,
		'rewrite'       => [ 'slug' => 'categorie-afectiuni' ],
	] );
}
add_action( 'init', 'gu_register_taxonomy_categorie_afectiuni' );


// ─────────────────────────────────────────────────────────────
// 5. CPT: INTERVENȚII CHIRURGICALE
// ─────────────────────────────────────────────────────────────

function gu_register_cpt_interventii() {
	register_post_type( 'interventii', [
		'labels' => [
			'name'          => __( 'Intervenții', 'gu-design-system' ),
			'singular_name' => __( 'Intervenție', 'gu-design-system' ),
			'add_new'       => __( 'Adaugă intervenție', 'gu-design-system' ),
			'add_new_item'  => __( 'Adaugă intervenție nouă', 'gu-design-system' ),
			'edit_item'     => __( 'Editează intervenție', 'gu-design-system' ),
			'view_item'     => __( 'Vezi intervenție', 'gu-design-system' ),
			'all_items'     => __( 'Toate intervențiile', 'gu-design-system' ),
			'search_items'  => __( 'Caută intervenții', 'gu-design-system' ),
		],
		'public'            => true,
		'has_archive'       => true,
		'show_in_rest'      => true,
		'menu_icon'         => 'dashicons-clipboard',
		'supports'          => [ 'title', 'thumbnail', 'excerpt' ],
		'rewrite'           => [ 'slug' => 'interventii' ],
		'show_in_nav_menus' => true,
	] );
}
add_action( 'init', 'gu_register_cpt_interventii' );

function gu_register_taxonomy_categorie_interventii() {
	register_taxonomy( 'categorie-interventii', [ 'interventii' ], [
		'labels' => [
			'name'          => __( 'Categorii intervenții', 'gu-design-system' ),
			'singular_name' => __( 'Categorie intervenție', 'gu-design-system' ),
			'all_items'     => __( 'Toate categoriile', 'gu-design-system' ),
			'edit_item'     => __( 'Editează categoria', 'gu-design-system' ),
			'add_new_item'  => __( 'Adaugă categorie nouă', 'gu-design-system' ),
			'menu_name'     => __( 'Categorii', 'gu-design-system' ),
		],
		'hierarchical'  => true,
		'public'        => true,
		'show_in_rest'  => true,
		'rewrite'       => [ 'slug' => 'categorie-interventii' ],
	] );
}
add_action( 'init', 'gu_register_taxonomy_categorie_interventii' );


// ─────────────────────────────────────────────────────────────
// 6. SHORTCODES FOR ELEMENTOR TEMPLATES
// ─────────────────────────────────────────────────────────────

// [gu_field name="field_name"] — ACF field value for the current post.
// Bypasses ACF's enable_shortcode setting (disabled by default in ACF >= 6.3).
add_shortcode( 'gu_field', function ( $atts ) {
	if ( ! function_exists( 'get_field' ) ) {
		return '';
	}
	$atts = shortcode_atts( [ 'name' => '' ], $atts );
	if ( empty( $atts['name'] ) ) {
		return '';
	}
	$value = get_field( $atts['name'] );
	if ( is_array( $value ) || false === $value ) {
		return '';
	}
	return wp_kses_post( (string) $value );
} );

// Shared helper: empty-state block shown on archive pages with < 3 items.
function gu_archive_empty_state(): string {
	$cta = gu_shared_primary_cta();
	$icon = '<svg width="40" height="40" viewBox="0 0 24 24" fill="none"'
		. ' stroke="#0E7FC0" stroke-width="1.5" stroke-linecap="round"'
		. ' stroke-linejoin="round" aria-hidden="true">'
		. '<circle cx="12" cy="12" r="10"/>'
		. '<polyline points="12 6 12 12 16 14"/>'
		. '</svg>';
	return '<div class="gu-archive-empty-state">'
		. $icon
		. '<h3 class="gu-archive-empty-state__heading">Conținut în curs de actualizare</h3>'
		. '<p class="gu-archive-empty-state__text">Noi resurse pentru pacienți vor fi adăugate periodic. Urmăriți această secțiune.</p>'
		. '<a class="gu-btn gu-btn--accent gu-btn--sm"'
		. ' href="' . esc_url( $cta['url'] ) . '">' . esc_html( $cta['label'] ) . '</a>'
		. '</div>';
}

// [gu_afectiuni_archive] — card grid of all published afectiuni.
// Used in the Elementor archive template.
add_shortcode( 'gu_afectiuni_archive', function () {
	if ( ! post_type_exists( 'afectiuni' ) ) {
		return '';
	}
	$query = new WP_Query( [
		'post_type'      => 'afectiuni',
		'posts_per_page' => -1,
		'post_status'    => 'publish',
		'orderby'        => 'title',
		'order'          => 'ASC',
	] );
	if ( ! $query->have_posts() ) {
		return '<p>Nu există afecțiuni publicate.</p>';
	}
	$out = '<div class="gu-afectiuni-grid" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:24px;">';
	while ( $query->have_posts() ) {
		$query->the_post();
		$summary = function_exists( 'get_field' ) ? wp_strip_all_tags( (string) get_field( 'short_summary' ) ) : get_the_excerpt();
		$out    .= '<article class="gu-afectiuni-card" style="background:#FFFFFF;border:1px solid rgba(0,0,0,.06);border-radius:16px;padding:28px;">';
		$out    .= '<h3 style="font-family:Inter,system-ui,sans-serif;font-size:20px;font-weight:700;margin:0 0 10px;letter-spacing:-0.01em;"><a href="' . esc_url( get_permalink() ) . '" style="color:#1D1D1F;text-decoration:none;">' . esc_html( get_the_title() ) . '</a></h3>';
		$out    .= '<p style="font-family:Inter,system-ui,sans-serif;font-size:15px;color:#6E6E73;margin:0 0 14px;">' . esc_html( wp_trim_words( $summary, 20 ) ) . '</p>';
		$out    .= '<a href="' . esc_url( get_permalink() ) . '" style="font-size:14px;font-weight:600;color:#0E7FC0;text-decoration:none;">Citește mai mult →</a>';
		$out    .= '</article>';
	}
	wp_reset_postdata();
	$out .= '</div>';
	if ( $query->found_posts < 3 ) {
		$out .= gu_archive_empty_state();
	}
	return $out;
} );

// [gu_interventii_archive] — card grid of all published interventii.
// Used in the Elementor archive template.
add_shortcode( 'gu_interventii_archive', function () {
	if ( ! post_type_exists( 'interventii' ) ) {
		return '';
	}
	$query = new WP_Query( [
		'post_type'      => 'interventii',
		'posts_per_page' => -1,
		'post_status'    => 'publish',
		'orderby'        => 'title',
		'order'          => 'ASC',
	] );
	if ( ! $query->have_posts() ) {
		return '<p>Nu există intervenții publicate.</p>';
	}
	$out = '<div class="gu-interventii-grid" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:24px;">';
	while ( $query->have_posts() ) {
		$query->the_post();
		$summary = function_exists( 'get_field' ) ? wp_strip_all_tags( (string) get_field( 'short_summary' ) ) : get_the_excerpt();
		$out    .= '<article class="gu-interventii-card" style="background:#FFFFFF;border:1px solid rgba(0,0,0,.06);border-radius:16px;padding:28px;">';
		$out    .= '<h3 style="font-family:Inter,system-ui,sans-serif;font-size:20px;font-weight:700;margin:0 0 10px;letter-spacing:-0.01em;"><a href="' . esc_url( get_permalink() ) . '" style="color:#1D1D1F;text-decoration:none;">' . esc_html( get_the_title() ) . '</a></h3>';
		$out    .= '<p style="font-family:Inter,system-ui,sans-serif;font-size:15px;color:#6E6E73;margin:0 0 14px;">' . esc_html( wp_trim_words( $summary, 20 ) ) . '</p>';
		$out    .= '<a href="' . esc_url( get_permalink() ) . '" style="font-size:14px;font-weight:600;color:#0E7FC0;text-decoration:none;">Detalii intervenție →</a>';
		$out    .= '</article>';
	}
	wp_reset_postdata();
	$out .= '</div>';
	if ( $query->found_posts < 3 ) {
		$out .= gu_archive_empty_state();
	}
	return $out;
} );


// ─────────────────────────────────────────────────────────────
// 7. CPT: ARTICOLE (KNOWLEDGE CENTER)
// ─────────────────────────────────────────────────────────────

function gu_register_cpt_articole() {
	register_post_type( 'articole', [
		'labels' => [
			'name'          => __( 'Articole', 'gu-design-system' ),
			'singular_name' => __( 'Articol', 'gu-design-system' ),
			'add_new'       => __( 'Adaugă articol', 'gu-design-system' ),
			'add_new_item'  => __( 'Adaugă articol nou', 'gu-design-system' ),
			'edit_item'     => __( 'Editează articolul', 'gu-design-system' ),
			'view_item'     => __( 'Vezi articolul', 'gu-design-system' ),
			'all_items'     => __( 'Toate articolele', 'gu-design-system' ),
			'search_items'  => __( 'Caută articole', 'gu-design-system' ),
		],
		'public'            => true,
		'has_archive'       => true,
		'show_in_rest'      => true,
		'menu_icon'         => 'dashicons-welcome-write-blog',
		'supports'          => [ 'title', 'editor', 'thumbnail', 'excerpt', 'revisions' ],
		'rewrite'           => [ 'slug' => 'articole', 'with_front' => false ],
		'show_in_nav_menus' => true,
	] );
}
add_action( 'init', 'gu_register_cpt_articole' );

function gu_register_taxonomy_categorie_articole() {
	register_taxonomy( 'categorie-articole', [ 'articole' ], [
		'labels' => [
			'name'          => __( 'Categorii articole', 'gu-design-system' ),
			'singular_name' => __( 'Categorie articol', 'gu-design-system' ),
			'all_items'     => __( 'Toate categoriile', 'gu-design-system' ),
			'edit_item'     => __( 'Editează categoria', 'gu-design-system' ),
			'add_new_item'  => __( 'Adaugă categorie nouă', 'gu-design-system' ),
			'menu_name'     => __( 'Categorii', 'gu-design-system' ),
		],
		'hierarchical'  => true,
		'public'        => true,
		'show_in_rest'  => true,
		'rewrite'       => [ 'slug' => 'articole/categorie' ],
	] );
}
add_action( 'init', 'gu_register_taxonomy_categorie_articole' );

function gu_register_taxonomy_eticheta_articole() {
	register_taxonomy( 'eticheta-articole', [ 'articole' ], [
		'labels' => [
			'name'          => __( 'Etichete articole', 'gu-design-system' ),
			'singular_name' => __( 'Etichetă articol', 'gu-design-system' ),
			'all_items'     => __( 'Toate etichetele', 'gu-design-system' ),
			'edit_item'     => __( 'Editează eticheta', 'gu-design-system' ),
			'add_new_item'  => __( 'Adaugă etichetă nouă', 'gu-design-system' ),
			'menu_name'     => __( 'Etichete', 'gu-design-system' ),
		],
		'hierarchical'  => false,
		'public'        => true,
		'show_in_rest'  => true,
		'rewrite'       => [ 'slug' => 'articole/eticheta' ],
	] );
}
add_action( 'init', 'gu_register_taxonomy_eticheta_articole' );


// ─────────────────────────────────────────────────────────────
// 7B. CPT: LOCAȚII (unde consultă Dr. George Ungureanu)
//
// Fields (see acf-json/group_loc.json): city, address, schedule (optional),
// phone, booking_url, map_url. Photo = native featured image. Display
// order = native WP "page-attributes" Order field (menu_order) — no
// separate custom field needed, and it is what Elementor's Loop Grid query
// control sorts by natively ("Menu Order").
// ─────────────────────────────────────────────────────────────

function gu_register_cpt_locatii() {
	register_post_type( 'locatii', [
		'labels' => [
			'name'          => __( 'Locații', 'gu-design-system' ),
			'singular_name' => __( 'Locație', 'gu-design-system' ),
			'add_new'       => __( 'Adaugă locație', 'gu-design-system' ),
			'add_new_item'  => __( 'Adaugă locație nouă', 'gu-design-system' ),
			'edit_item'     => __( 'Editează locația', 'gu-design-system' ),
			'view_item'     => __( 'Vezi locația', 'gu-design-system' ),
			'all_items'     => __( 'Toate locațiile', 'gu-design-system' ),
			'search_items'  => __( 'Caută locații', 'gu-design-system' ),
		],
		'public'            => true,
		'has_archive'       => false,
		'show_in_rest'      => true,
		'menu_icon'         => 'dashicons-location-alt',
		'supports'          => [ 'title', 'thumbnail', 'page-attributes' ],
		'rewrite'           => [ 'slug' => 'locatii' ],
		'show_in_nav_menus' => false,
	] );
}
add_action( 'init', 'gu_register_cpt_locatii' );


// ─────────────────────────────────────────────────────────────
// 8. SHORTCODES — ARTICOLE (KNOWLEDGE CENTER)
// ─────────────────────────────────────────────────────────────

// Internal helper: resolve related post_object fields (ACF Free) or
// relationship fields (ACF Pro). Returns array of WP_Post objects.
// Free field names:  related_{type}_1 / _2 / _3
// Pro field name:    related_{type}s   (relationship, returns array)
function gu_get_related_posts( string $type ): array {
	if ( ! function_exists( 'get_field' ) ) {
		return [];
	}
	$pro_value = get_field( "related_{$type}s" );
	if ( is_array( $pro_value ) && ! empty( $pro_value ) ) {
		return array_values( array_filter( $pro_value, fn( $p ) => $p instanceof WP_Post ) );
	}
	$posts = [];
	foreach ( [ 1, 2, 3 ] as $n ) {
		$post = get_field( "related_{$type}_{$n}" );
		if ( $post instanceof WP_Post ) {
			$posts[] = $post;
		}
	}
	return $posts;
}

// [gu_articole_archive] — card grid of published articole.
add_shortcode( 'gu_articole_archive', function ( $atts ) {
	if ( ! post_type_exists( 'articole' ) ) {
		return '';
	}
	$atts = shortcode_atts( [ 'limit' => -1, 'category' => '' ], $atts );

	$args = [
		'post_type'      => 'articole',
		'posts_per_page' => (int) $atts['limit'],
		'post_status'    => 'publish',
		'orderby'        => 'date',
		'order'          => 'DESC',
	];
	if ( ! empty( $atts['category'] ) ) {
		$args['tax_query'] = [ [ 'taxonomy' => 'categorie-articole', 'field' => 'slug', 'terms' => sanitize_text_field( $atts['category'] ) ] ];
	}
	$query = new WP_Query( $args );
	if ( ! $query->have_posts() ) {
		return '<p style="font-family:Inter,sans-serif;color:#6E6E73;">Nu există articole publicate.</p>';
	}
	$out = '<div class="gu-articole-grid">';
	while ( $query->have_posts() ) {
		$query->the_post();
		$summary  = function_exists( 'get_field' ) ? wp_strip_all_tags( (string) get_field( 'short_summary' ) ) : get_the_excerpt();
		$time     = function_exists( 'get_field' ) ? (int) get_field( 'reading_time' ) : 0;
		$cats     = get_the_terms( get_the_ID(), 'categorie-articole' );
		$cat_name = ( is_array( $cats ) && ! empty( $cats ) ) ? esc_html( $cats[0]->name ) : '';
		$out .= '<article class="gu-article-card">';
		if ( $cat_name ) {
			$out .= '<span class="gu-article-card__cat">' . $cat_name . '</span>';
		}
		$out .= '<h3 class="gu-article-card__title"><a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a></h3>';
		if ( $summary ) {
			$out .= '<p class="gu-article-card__summary">' . esc_html( wp_trim_words( $summary, 22 ) ) . '</p>';
		}
		$out .= '<div class="gu-article-card__footer">';
		if ( $time ) {
			$out .= '<span class="gu-article-card__time">' . $time . ' min citire</span>';
		}
		$out .= '<a class="gu-article-card__link" href="' . esc_url( get_permalink() ) . '">Citește articolul →</a>';
		$out .= '</div></article>';
	}
	wp_reset_postdata();
	$out .= '</div>';
	if ( $query->found_posts < 3 ) {
		$out .= gu_archive_empty_state();
	}
	return $out;
} );

// [gu_article_meta] — author byline + medical review date strip.
add_shortcode( 'gu_article_meta', function () {
	if ( ! function_exists( 'get_field' ) ) {
		return '';
	}
	$author   = get_field( 'author_display_name' ) ?: 'Dr. George Ungureanu';
	$cred     = gu_strip_client_note( (string) get_field( 'author_credentials' ) ) ?: 'Medic Primar Neurochirurg, Doctor în Medicină';
	$raw_date = get_field( 'medical_review_date' );
	$date_str = $raw_date ? date_i18n( 'd F Y', strtotime( $raw_date ) ) : '';
	$time     = (int) get_field( 'reading_time' );

	$out  = '<div class="gu-article-meta">';
	$out .= '<div class="gu-article-meta__author"><span class="gu-article-meta__name">' . esc_html( $author ) . '</span><span class="gu-article-meta__cred">' . esc_html( $cred ) . '</span></div>';
	$out .= '<div class="gu-article-meta__right">';
	if ( $date_str ) {
		$out .= '<span class="gu-article-meta__review">Revizuit la ' . esc_html( $date_str ) . '</span>';
	}
	if ( $time ) {
		$out .= '<span class="gu-article-meta__time">' . $time . ' min citire</span>';
	}
	$out .= '</div></div>';
	return $out;
} );

// [gu_key_takeaways] — key_takeaways ACF field in a styled callout.
add_shortcode( 'gu_key_takeaways', function () {
	if ( ! function_exists( 'get_field' ) ) {
		return '';
	}
	$content = get_field( 'key_takeaways' );
	if ( empty( $content ) ) {
		return '';
	}
	return '<div class="gu-key-takeaways"><p class="gu-key-takeaways__label">Idei cheie</p>' . wp_kses_post( $content ) . '</div>';
} );

// [gu_article_faq] — FAQ accordion + FAQPage JSON-LD schema.
add_shortcode( 'gu_article_faq', function () {
	if ( ! function_exists( 'get_field' ) ) {
		return '';
	}
	$pairs = [];
	// ACF Pro Repeater
	if ( function_exists( 'have_rows' ) && have_rows( 'faq_items' ) ) {
		while ( have_rows( 'faq_items' ) ) {
			the_row();
			$q = get_sub_field( 'question' );
			$a = get_sub_field( 'answer' );
			if ( $q && $a ) {
				$pairs[] = [ 'q' => $q, 'a' => $a ];
			}
		}
	}
	// ACF Free fallback
	if ( empty( $pairs ) ) {
		for ( $i = 1; $i <= 5; $i++ ) {
			$q = get_field( "faq_{$i}_question" );
			$a = get_field( "faq_{$i}_answer" );
			if ( $q && $a ) {
				$pairs[] = [ 'q' => $q, 'a' => $a ];
			}
		}
	}
	if ( empty( $pairs ) ) {
		return '';
	}
	$out = '<div class="gu-faq">';
	foreach ( $pairs as $idx => $pair ) {
		$id       = 'faq-' . get_the_ID() . '-' . ( $idx + 1 );
		$expanded = $idx === 0 ? 'true' : 'false';
		$out .= '<div class="gu-faq__item">';
		$out .= '<button class="gu-faq__question" aria-expanded="' . $expanded . '" aria-controls="' . esc_attr( $id ) . '">';
		$out .= '<span>' . esc_html( $pair['q'] ) . '</span>';
		$out .= '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/></svg>';
		$out .= '</button>';
		$out .= '<div class="gu-faq__answer" id="' . esc_attr( $id ) . '"' . ( $idx !== 0 ? ' hidden' : '' ) . '><p>' . wp_kses_post( $pair['a'] ) . '</p></div>';
		$out .= '</div>';
	}
	$out .= '</div>';
	// FAQPage schema
	$schema = [ '@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => array_map( fn( $p ) => [
		'@type' => 'Question',
		'name'  => $p['q'],
		'acceptedAnswer' => [ '@type' => 'Answer', 'text' => wp_strip_all_tags( $p['a'] ) ],
	], $pairs ) ];
	$out .= '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>';
	// Lightweight accordion JS (no jQuery dependency)
	$out .= '<script>(function(){document.querySelectorAll(".gu-faq__question").forEach(function(b){b.addEventListener("click",function(){var e=b.getAttribute("aria-expanded")==="true",p=document.getElementById(b.getAttribute("aria-controls"));b.setAttribute("aria-expanded",e?"false":"true");e?p.setAttribute("hidden",""):p.removeAttribute("hidden");});});})();</script>';
	return $out;
} );

// [gu_related_conditions] — related afectiuni cards.
add_shortcode( 'gu_related_conditions', function () {
	$posts = gu_get_related_posts( 'condition' );
	if ( empty( $posts ) ) {
		return '';
	}
	$out = '<div class="gu-related-grid">';
	foreach ( $posts as $p ) {
		$summary = function_exists( 'get_field' ) ? wp_strip_all_tags( (string) get_field( 'short_summary', $p->ID ) ) : '';
		$out .= '<article class="gu-related-card"><h3 class="gu-related-card__title"><a href="' . esc_url( get_permalink( $p->ID ) ) . '">' . esc_html( $p->post_title ) . '</a></h3>';
		if ( $summary ) {
			$out .= '<p class="gu-related-card__summary">' . esc_html( wp_trim_words( $summary, 18 ) ) . '</p>';
		}
		$out .= '<a class="gu-related-card__link" href="' . esc_url( get_permalink( $p->ID ) ) . '">Citește despre această afecțiune →</a></article>';
	}
	$out .= '</div>';
	return $out;
} );

// [gu_related_procedures] — related interventii cards.
add_shortcode( 'gu_related_procedures', function () {
	$posts = gu_get_related_posts( 'procedure' );
	if ( empty( $posts ) ) {
		return '';
	}
	$out = '<div class="gu-related-grid">';
	foreach ( $posts as $p ) {
		$summary = function_exists( 'get_field' ) ? wp_strip_all_tags( (string) get_field( 'short_summary', $p->ID ) ) : '';
		$out .= '<article class="gu-related-card"><h3 class="gu-related-card__title"><a href="' . esc_url( get_permalink( $p->ID ) ) . '">' . esc_html( $p->post_title ) . '</a></h3>';
		if ( $summary ) {
			$out .= '<p class="gu-related-card__summary">' . esc_html( wp_trim_words( $summary, 18 ) ) . '</p>';
		}
		$out .= '<a class="gu-related-card__link" href="' . esc_url( get_permalink( $p->ID ) ) . '">Detalii intervenție →</a></article>';
	}
	$out .= '</div>';
	return $out;
} );

// [gu_related_articles] — related articole cards.
add_shortcode( 'gu_related_articles', function () {
	$posts = gu_get_related_posts( 'article' );
	if ( empty( $posts ) ) {
		return '';
	}
	$out = '<div class="gu-related-grid">';
	foreach ( $posts as $p ) {
		$summary = function_exists( 'get_field' ) ? wp_strip_all_tags( (string) get_field( 'short_summary', $p->ID ) ) : '';
		$time    = function_exists( 'get_field' ) ? (int) get_field( 'reading_time', $p->ID ) : 0;
		$out .= '<article class="gu-related-card"><h3 class="gu-related-card__title"><a href="' . esc_url( get_permalink( $p->ID ) ) . '">' . esc_html( $p->post_title ) . '</a></h3>';
		if ( $summary ) {
			$out .= '<p class="gu-related-card__summary">' . esc_html( wp_trim_words( $summary, 18 ) ) . '</p>';
		}
		$out .= '<div class="gu-related-card__footer">';
		if ( $time ) {
			$out .= '<span class="gu-article-card__time">' . $time . ' min</span>';
		}
		$out .= '<a class="gu-related-card__link" href="' . esc_url( get_permalink( $p->ID ) ) . '">Citește →</a>';
		$out .= '</div></article>';
	}
	$out .= '</div>';
	return $out;
} );


// ─────────────────────────────────────────────────────────────
// 9. SPRINT 7B — SEO, SCHEMA & CROSS-LINKING
// ─────────────────────────────────────────────────────────────

// ── 9a. SEO: title override + meta description ───────────────
// Injects custom <title> and <meta name="description"> for articole
// single posts. Skips automatically when Yoast SEO or Rank Math
// is active (those plugins own <head> SEO). Safe to leave active
// even after installing an SEO plugin — the check prevents conflicts.
//
// Limitation: does NOT write to Yoast/Rank Math databases.
// If the site later uses Yoast, populate Yoast _yoast_wpseo_title
// and _yoast_wpseo_metadesc from the ACF fields via a one-time migration.

function gu_seo_plugin_active(): bool {
	return class_exists( 'WPSEO_Frontend' )  // Yoast SEO
		|| class_exists( 'RankMath' )          // Rank Math
		|| class_exists( 'SEOPRESS_SETTINGS' ) // SEOPress
		|| defined( 'THE_SEO_FRAMEWORK_VERSION' ); // The SEO Framework
}

// Title override via pre_get_document_title filter (safe — no duplicate <title>).
add_filter( 'pre_get_document_title', function ( string $title ): string {
	if ( gu_seo_plugin_active() || ! is_singular( 'articole' ) ) {
		return $title;
	}
	$seo_title = function_exists( 'get_field' ) ? (string) get_field( 'seo_title' ) : '';
	if ( empty( $seo_title ) ) {
		return $title; // keep default WP title
	}
	return wp_strip_all_tags( $seo_title );
}, 20 );

// Meta description injection.
add_action( 'wp_head', function () {
	if ( gu_seo_plugin_active() || ! is_singular( 'articole' ) || ! function_exists( 'get_field' ) ) {
		return;
	}
	$description = (string) get_field( 'seo_description' );
	if ( empty( $description ) ) {
		// Fallback to short_summary (strips HTML, trims to 155 chars).
		$description = wp_strip_all_tags( (string) get_field( 'short_summary' ) );
	}
	if ( empty( $description ) ) {
		return;
	}
	$description = mb_substr( wp_strip_all_tags( $description ), 0, 155 );
	echo '<meta name="description" content="' . esc_attr( $description ) . '">' . "\n";
}, 1 );

// ── 9b. Schema.org JSON-LD ────────────────────────────────────
// Outputs a @graph containing:
//   – MedicalWebPage (or Article) for the article
//   – BreadcrumbList (Home → Articole → Article title)
//   – Physician node for Dr. George Ungureanu
// FAQPage schema is already output inline by [gu_article_faq] shortcode.
// Conservative schema: no ratings, no reviews, no medical claims.

add_action( 'wp_head', function () {
	if ( ! is_singular( 'articole' ) || ! function_exists( 'get_field' ) ) {
		return;
	}

	$post        = get_queried_object();
	$post_url    = get_permalink( $post );
	$home_url    = trailingslashit( home_url() );
	$archive_url = get_post_type_archive_link( 'articole' );

	$schema_type  = (string) get_field( 'seo_schema_type' ) ?: (string) get_field( 'schema_type' ) ?: 'MedicalWebPage';
	$allowed_types = [ 'Article', 'MedicalWebPage', 'FAQPage' ];
	if ( ! in_array( $schema_type, $allowed_types, true ) ) {
		$schema_type = 'MedicalWebPage';
	}

	$title       = wp_strip_all_tags( get_the_title( $post ) );
	$description = wp_strip_all_tags( (string) get_field( 'seo_description' ) ?: (string) get_field( 'short_summary' ) );
	$review_date = (string) get_field( 'medical_review_date' ); // Y-m-d
	$modified    = $review_date ?: get_post_modified_time( 'Y-m-d', true, $post );
	$published   = get_post_time( 'Y-m-d', true, $post );

	$physician_id = $home_url . 'despre/#physician';
	$brand_name   = gu_shared_site_setting( 'brand_name', 'George Ungureanu' );
	$brand_role   = gu_shared_site_setting( 'brand_short_role', 'Medic Primar Neurochirurg' );

	$graph = [
		[
			'@type'         => $schema_type,
			'@id'           => $post_url . '#webpage',
			'name'          => $title,
			'description'   => mb_substr( $description, 0, 300 ),
			'url'           => $post_url,
			'inLanguage'    => 'ro-RO',
			'datePublished' => $published,
			'dateModified'  => $modified,
			'author'        => [ '@id' => $physician_id ],
			'breadcrumb'    => [ '@id' => $post_url . '#breadcrumb' ],
		],
		[
			'@type'       => 'BreadcrumbList',
			'@id'         => $post_url . '#breadcrumb',
			'itemListElement' => [
				[ '@type' => 'ListItem', 'position' => 1, 'name' => 'Acasă',   'item' => $home_url ],
				[ '@type' => 'ListItem', 'position' => 2, 'name' => 'Sfatul Neurochirurgului', 'item' => $archive_url ],
				[ '@type' => 'ListItem', 'position' => 3, 'name' => $title ],
			],
		],
		[
			'@type'    => 'Physician',
			'@id'      => $physician_id,
			'name'     => $brand_name,
			'jobTitle' => $brand_role,
			'url'      => $home_url . 'despre/',
			'worksFor' => [
				'@type' => 'MedicalOrganization',
				'name'  => 'Cabinet Neurochirurgie ' . $brand_name,
				'url'   => $home_url,
			],
		],
	];

	$json = wp_json_encode(
		[ '@context' => 'https://schema.org', '@graph' => $graph ],
		JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT
	);
	echo '<script type="application/ld+json">' . $json . '</script>' . "\n";
}, 10 );

// ── 9c. Author / Medical Review block ────────────────────────
// [gu_article_author] — Renders a credibility block with Dr. George's
// photo placeholder, credentials, review date, bio and /despre/ link.
// Section background: warm (#F4EFE6). Placed after article body.
add_shortcode( 'gu_article_author', function () {
	if ( ! function_exists( 'get_field' ) ) {
		return '';
	}
	$name        = (string) get_field( 'author_display_name' ) ?: 'Dr. George Ungureanu';
	$title       = gu_strip_client_note( (string) get_field( 'author_credentials' ) ) ?: 'Medic Primar Neurochirurg, Doctor în Medicină';
	$bio         = (string) get_field( 'author_bio_short' );
	$review_raw  = (string) get_field( 'medical_review_date' );
	$review_str  = $review_raw ? date_i18n( 'd F Y', strtotime( $review_raw ) ) : '';
	$about_url   = home_url( '/despre/' );

	$out  = '<div class="gu-author-block">';
	$out .= '<div class="gu-author-block__avatar" aria-hidden="true">';
	// SVG silhouette placeholder — replaced when photography is available
	$out .= '<svg viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg" width="80" height="80"><circle cx="40" cy="40" r="40" fill="#C8C0B8"/><circle cx="40" cy="30" r="14" fill="#FFFFFF"/><ellipse cx="40" cy="72" rx="24" ry="18" fill="#FFFFFF"/></svg>';
	$out .= '</div>';
	$out .= '<div class="gu-author-block__content">';
	$out .= '<span class="gu-author-block__label">Autor &amp; Revizie medicală</span>';
	$out .= '<h3 class="gu-author-block__name">' . esc_html( $name ) . '</h3>';
	$out .= '<p class="gu-author-block__title">' . esc_html( $title ) . '</p>';
	if ( $bio ) {
		$out .= '<p class="gu-author-block__bio">' . esc_html( $bio ) . '</p>';
	}
	if ( $review_str ) {
		$out .= '<p class="gu-author-block__review">Conținut revizuit la <strong>' . esc_html( $review_str ) . '</strong></p>';
	}
	$out .= '<a class="gu-author-block__link" href="' . esc_url( $about_url ) . '">Despre Dr. George Ungureanu →</a>';
	$out .= '</div>';
	$out .= '</div>';
	return $out;
} );

// ── 9d. Reverse-lookup: articles referencing the current post ─
// [gu_articles_for_post] — Used on afectiuni/interventii single pages.
// Finds published articole where related_condition_1/2/3 or
// related_procedure_1/2/3 contain the current post's ID.
// No new ACF fields required on the condition/procedure groups.
add_shortcode( 'gu_articles_for_post', function () {
	$post_id = get_the_ID();
	if ( ! $post_id ) {
		return '';
	}

	// Build meta_query across all six possible relation fields.
	$meta_relations = [
		'related_condition_1', 'related_condition_2', 'related_condition_3',
		'related_procedure_1', 'related_procedure_2', 'related_procedure_3',
	];
	$meta_query = [ 'relation' => 'OR' ];
	foreach ( $meta_relations as $key ) {
		$meta_query[] = [ 'key' => $key, 'value' => (string) $post_id, 'compare' => '=' ];
	}

	$query = new WP_Query( [
		'post_type'      => 'articole',
		'post_status'    => 'publish',
		'posts_per_page' => 6,
		'meta_query'     => $meta_query,
	] );

	if ( ! $query->have_posts() ) {
		return '';
	}

	$out = '<div class="gu-related-grid">';
	while ( $query->have_posts() ) {
		$query->the_post();
		$summary = function_exists( 'get_field' ) ? wp_strip_all_tags( (string) get_field( 'short_summary' ) ) : get_the_excerpt();
		$time    = function_exists( 'get_field' ) ? (int) get_field( 'reading_time' ) : 0;
		$cats    = get_the_terms( get_the_ID(), 'categorie-articole' );
		$cat     = ( is_array( $cats ) && ! empty( $cats ) ) ? esc_html( $cats[0]->name ) : '';
		$out .= '<article class="gu-related-card">';
		if ( $cat ) {
			$out .= '<span class="gu-article-card__cat">' . $cat . '</span>';
		}
		$out .= '<h3 class="gu-related-card__title"><a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a></h3>';
		if ( $summary ) {
			$out .= '<p class="gu-related-card__summary">' . esc_html( wp_trim_words( $summary, 20 ) ) . '</p>';
		}
		$out .= '<div class="gu-related-card__footer">';
		if ( $time ) {
			$out .= '<span class="gu-article-card__time">' . $time . ' min</span>';
		}
		$out .= '<a class="gu-related-card__link" href="' . esc_url( get_permalink() ) . '">Citește articolul →</a>';
		$out .= '</div></article>';
	}
	wp_reset_postdata();
	$out .= '</div>';
	return $out;
} );


// ─────────────────────────────────────────────────────────────
// 10. SPRINT 8 — ABOUT PAGE (/despre/)
// ─────────────────────────────────────────────────────────────

// ── 10a. Utilities ────────────────────────────────────────────

// Add body class so CSS can target the page without hardcoding the ID.
add_filter( 'body_class', function ( array $classes ): array {
	if ( is_page( 'despre' ) ) { $classes[] = 'page-despre'; }
	return $classes;
} );

// Hide the Hello Elementor theme's .page-header H1 above the Elementor content.
// This is the page title rendered by content-page.php; our own H1 lives in [gu_about_hero].
add_action( 'wp_head', function () {
	if ( ! is_page( 'despre' ) ) { return; }
	echo '<style>.page-despre .page-header { display: none !important; }</style>' . "\n";
}, 0 );

function gu_get_about_page_id(): int {
	static $pid = null;
	if ( null === $pid ) {
		$page = get_page_by_path( 'despre' );
		$pid  = $page ? (int) $page->ID : 0;
	}
	return $pid;
}

function gu_get_about_field( string $key ): string {
	$pid = gu_get_about_page_id();
	if ( ! $pid || ! function_exists( 'get_field' ) ) { return ''; }
	$val = get_field( $key, $pid );
	if ( is_array( $val ) ) { return ''; }
	return (string) $val;
}

function gu_about_content_is_missing( string $content ): bool {
	$plain = trim( wp_strip_all_tags( $content ) );
	return '' === $plain || false !== stripos( $plain, '[CLIENT' );
}

// Some ACF values mix real content with a trailing internal note, e.g.
// "MD, Neurochirurg — [CLIENT: add specializations]". Strips only the
// bracketed note (and its leading separator, if any), keeping the real part.
function gu_strip_client_note( string $value ): string {
	$stripped = preg_replace( '/\s*[—-]?\s*\[CLIENT:[^\]]*\]/iu', '', $value );
	return trim( $stripped ?? $value );
}

// ── 10b. SEO head for /despre/ ────────────────────────────────

add_filter( 'pre_get_document_title', function ( string $title ): string {
	if ( gu_seo_plugin_active() || ! is_page( 'despre' ) ) { return $title; }
	$seo = gu_get_about_field( 'about_seo_title' );
	return $seo ? wp_strip_all_tags( $seo ) : $title;
}, 21 );

add_action( 'wp_head', function () {
	if ( gu_seo_plugin_active() || ! is_page( 'despre' ) ) { return; }
	$desc = gu_get_about_field( 'about_seo_description' );
	if ( empty( trim( $desc ) ) ) { return; }
	echo '<meta name="description" content="' . esc_attr( mb_substr( wp_strip_all_tags( $desc ), 0, 155 ) ) . '">' . "\n";
}, 2 );

// ── 10b-2. SEO head for /ghid-recuperare/ ─────────────────────

add_filter( 'pre_get_document_title', function ( string $title ): string {
	if ( gu_seo_plugin_active() || ! is_page( 'ghid-recuperare' ) ) { return $title; }
	return 'Ghidul pacientului după intervențiile neurochirurgicale | Recuperare';
}, 21 );

add_action( 'wp_head', function () {
	if ( gu_seo_plugin_active() || ! is_page( 'ghid-recuperare' ) ) { return; }
	$desc = 'Ghid medical pentru pacienți: recuperarea după intervențiile neurochirurgicale craniene și spinale, semne de alarmă și recomandări pentru viața de zi cu zi.';
	echo '<meta name="description" content="' . esc_attr( $desc ) . '">' . "\n";
}, 2 );

// ── 10c. Physician schema — full enriched node on /despre/ ────

add_action( 'wp_head', function () {
	if ( ! is_page( 'despre' ) ) { return; }
	$home_url  = trailingslashit( home_url() );
	$about_url = $home_url . 'despre/';
	$phys_id   = $about_url . '#physician';
	$years     = (int) gu_get_about_field( 'about_years_experience' );
	$career_start = (int) gu_shared_site_setting( 'career_start_year', '2011' );
	if ( $years <= 0 && $career_start > 0 ) {
		$years = max( 0, (int) wp_date( 'Y' ) - $career_start );
	}
	$hospital  = gu_get_about_field( 'about_hospital' );
	$lang_raw  = gu_get_about_field( 'about_languages' ) ?: 'Română';
	$languages = array_values( array_filter( array_map( 'trim', explode( ',', $lang_raw ) ) ) );
	$brand_name = gu_shared_site_setting( 'brand_name', 'George Ungureanu' );
	$brand_role = gu_shared_site_setting( 'brand_specialty', 'Medic Primar Neurochirurg, Doctor în Medicină' );

	$desc_parts = [ $brand_name . ' este ' . mb_strtolower( $brand_role ) ];
	if ( $years > 0 ) { $desc_parts[] = "cu {$years}+ ani de experiență clinică"; }
	$desc_parts[] = 'în neurochirurgie spinală și craniană.';

	$physician = [
		'@type'         => 'Physician',
		'@id'           => $phys_id,
		'name'          => $brand_name,
		'jobTitle'      => $brand_role,
		'url'           => $about_url,
		'description'   => implode( ' ', $desc_parts ),
		'knowsAbout'    => [ 'Neurosurgery', 'Spine Surgery', 'Brain Surgery', 'Minimally Invasive Neurosurgery' ],
		'knowsLanguage' => $languages,
		'worksFor'      => [
			'@type' => 'MedicalOrganization',
			'@id'   => $home_url . '#practice',
			'name'  => $hospital ?: 'Cabinet Neurochirurgie ' . $brand_name,
			'url'   => $home_url,
		],
	];

	$graph = [
		$physician,
		[
			'@type'           => 'BreadcrumbList',
			'@id'             => $about_url . '#breadcrumb',
			'itemListElement' => [
				[ '@type' => 'ListItem', 'position' => 1, 'name' => 'Acasă', 'item' => $home_url ],
				[ '@type' => 'ListItem', 'position' => 2, 'name' => 'Despre ' . $brand_name ],
			],
		],
	];

	echo '<script type="application/ld+json">'
		. wp_json_encode(
			[ '@context' => 'https://schema.org', '@graph' => $graph ],
			JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT
		)
		. '</script>' . "\n";
}, 11 );

// ── 10d. Shortcodes ───────────────────────────────────────────

// Hero — photo placeholder + name + badges + CTA.
// id="physician" on root div resolves schema anchor /despre/#physician.
add_shortcode( 'gu_about_hero', function () {
	$cta      = gu_shared_primary_cta();
	$brand    = gu_shared_site_setting( 'brand_name', 'George Ungureanu' );
	$tagline  = gu_get_about_field( 'about_tagline' );
	$has_tagline = ! gu_about_content_is_missing( $tagline );
	$years    = (int) gu_get_about_field( 'about_years_experience' );
	$career_start = (int) gu_shared_site_setting( 'career_start_year', '2011' );
	if ( $years <= 0 && $career_start > 0 ) {
		$years = max( 0, (int) wp_date( 'Y' ) - $career_start );
	}
	$hospital = gu_get_about_field( 'about_hospital' );
	$has_hospital = ! gu_about_content_is_missing( $hospital );

	$pid       = gu_get_about_page_id();
	$photo_arr = ( $pid && function_exists( 'get_field' ) ) ? get_field( 'about_photo', $pid ) : null;
	if ( is_array( $photo_arr ) && ! empty( $photo_arr['url'] ) ) {
		$photo_html = '<img src="' . esc_url( $photo_arr['url'] ) . '"'
			. ' alt="Dr. George Ungureanu - Medic primar neurochirurg"'
			. ' class="gu-about-hero__photo" width="440" height="540" loading="eager">';
	} elseif ( $fallback_photo_id = (int) gu_shared_site_setting( 'about_photo_id', '0' ) ) {
		$photo_html = wp_get_attachment_image(
			$fallback_photo_id,
			'large',
			false,
			[
				'alt'      => 'Dr. George Ungureanu - Medic primar neurochirurg',
				'class'    => 'gu-about-hero__photo',
				'loading'  => 'eager',
				'fetchpriority' => 'high',
			]
		);
	} else {
		// Public-safe "photo coming soon" placeholder — no internal note text.
		$photo_html  = '<div class="gu-about-hero__photo-placeholder" role="img"'
			. ' aria-label="Fotografie profesională — în curând">';
		$photo_html .= '<svg viewBox="0 0 440 540" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">'
			. '<rect width="440" height="540" fill="#C8C0B8"/>'
			. '<circle cx="220" cy="185" r="82" fill="#FFFFFF"/>'
			. '<ellipse cx="220" cy="490" rx="148" ry="120" fill="#FFFFFF"/>'
			. '<text x="220" y="345" font-family="Georgia,serif" font-size="11" fill="#6B5E57"'
			. ' text-anchor="middle">Fotografie</text>'
			. '<text x="220" y="362" font-family="Georgia,serif" font-size="11" fill="#6B5E57"'
			. ' text-anchor="middle">profesională — în curând</text>'
			. '</svg>'
			. '</div>';
	}

	$out  = '<div id="physician" class="gu-about-hero">';
	$out .= '<div class="gu-about-hero__photo-wrap">' . $photo_html . '</div>';
	$out .= '<div class="gu-about-hero__content">';
	$out .= '<h1 class="gu-about-hero__name">' . esc_html( $brand ) . '</h1>';
	$out .= '<p class="gu-about-hero__title">Medic primar neurochirurg</p>';
	if ( $has_tagline ) {
		$out .= '<p class="gu-about-hero__tagline">' . esc_html( $tagline ) . '</p>';
	}
	$out .= '<ul class="gu-about-hero__badges" aria-label="Informații cheie">';
	if ( $years > 0 ) {
		$out .= '<li class="gu-about-hero__badge">' . esc_html( $years . '+ ani experiență' ) . '</li>';
	}
	$out .= '<li class="gu-about-hero__badge">' . esc_html( gu_shared_site_setting( 'expertise', 'Neurochirurgie tumorală și chirurgie spinală degenerativă' ) ) . '</li>';
	if ( $has_hospital ) {
		$out .= '<li class="gu-about-hero__badge">' . esc_html( $hospital ) . '</li>';
	}
	$out .= '</ul>';
	$out .= '<a class="gu-btn gu-btn--accent" href="' . esc_url( $cta['url'] ) . '">' . esc_html( $cta['label'] ) . '</a>';
	$out .= '</div></div>';
	return $out;
} );

// Credentials strip — 3-4 scannable facts.
add_shortcode( 'gu_about_credentials_strip', function () {
	$years    = (int) gu_get_about_field( 'about_years_experience' );
	$career_start = (int) gu_shared_site_setting( 'career_start_year', '2011' );
	if ( $years <= 0 && $career_start > 0 ) {
		$years = max( 0, (int) wp_date( 'Y' ) - $career_start );
	}
	$langs    = gu_get_about_field( 'about_languages' ) ?: 'Română';
	$patients = (int) gu_shared_site_setting( 'operated_patients_min', '1500' );
	$out  = '<div class="gu-credentials-strip" role="list">';
	if ( $years > 0 ) {
		$out .= '<div class="gu-credentials-strip__item" role="listitem">'
			. '<span class="gu-credentials-strip__value">' . esc_html( $years . '+' ) . '</span>'
			. '<span class="gu-credentials-strip__label">ani în neurochirurgie</span></div>';
	}
	$out .= '<div class="gu-credentials-strip__item" role="listitem">'
		. '<span class="gu-credentials-strip__value">' . esc_html( gu_shared_site_setting( 'primary_year', '2024' ) ) . '</span>'
		. '<span class="gu-credentials-strip__label">medic primar din</span></div>';
	if ( $patients > 0 ) {
		$out .= '<div class="gu-credentials-strip__item" role="listitem">'
			. '<span class="gu-credentials-strip__value">' . esc_html( number_format( $patients, 0, ',', '.' ) ) . '+</span>'
			. '<span class="gu-credentials-strip__label">pacienți operați</span></div>';
	}
	if ( mb_strtolower( trim( $langs ), 'UTF-8' ) !== 'română' ) {
		$out .= '<div class="gu-credentials-strip__item" role="listitem">'
			. '<span class="gu-credentials-strip__value">' . esc_html( $langs ) . '</span>'
			. '<span class="gu-credentials-strip__label">limbi de consultație</span></div>';
	}
	$out .= '</div>';
	return $out;
} );

// Biography.
add_shortcode( 'gu_about_bio', function () {
	$bio = gu_get_about_field( 'about_bio' );
	if ( gu_about_content_is_missing( $bio ) ) {
		$bio = '<p>' . esc_html( gu_shared_site_setting( 'professional_difference', 'Experiența chirurgicală și pregătirea internațională dobândită în centre de neurochirurgie din Europa susțin o practică riguroasă, orientată către dezvoltarea chirurgiei tumorilor spinale în România și către binele pacientului.' ) ) . '</p>';
	}
	$personal = gu_shared_site_setting( 'personal_interests', 'Drumeție, meditație, alergare și ciclism' );
	return '<h2 class="gu-about-section-heading">Despre George Ungureanu</h2>'
		. '<div class="gu-about-bio">' . wp_kses_post( $bio )
		. ( $personal ? '<p class="gu-about-personal"><strong>Dincolo de profesie:</strong> ' . esc_html( $personal ) . '.</p>' : '' )
		. '</div>';
} );

// Philosophy of care — rendered inside dark section.
add_shortcode( 'gu_about_philosophy', function () {
	$phil = gu_get_about_field( 'about_philosophy' );
	if ( gu_about_content_is_missing( $phil ) ) {
		$phil = '<p>Încrederea se construiește prin explicații clare, o evaluare atentă și recomandări oneste. Experiența și pregătirea profesională au valoare atunci când ajută pacientul să înțeleagă ce opțiuni are și să ia o decizie informată, fără presiune.</p>';
	}
	return '<div class="gu-about-philosophy">'
		. '<h2 class="gu-about-section-heading">Filosofia mea de practică</h2>'
		. '<div class="gu-about-philosophy__content">' . wp_kses_post( $phil ) . '</div>'
		. '</div>';
} );

// Education & Training.
add_shortcode( 'gu_about_education', function () {
	$edu = gu_get_about_field( 'about_education' );
	if ( gu_about_content_is_missing( $edu ) ) {
		$edu = '<ul>'
			. '<li>Absolvent al Universității de Medicină și Farmacie „Iuliu Hațieganu” Cluj-Napoca</li>'
			. '<li>Medic specialist neurochirurg din ' . esc_html( gu_shared_site_setting( 'specialist_year', '2018' ) ) . '</li>'
			. '<li>Medic primar neurochirurg din ' . esc_html( gu_shared_site_setting( 'primary_year', '2024' ) ) . '</li>'
			. '<li>Formare internațională în centre de neurochirurgie din Milano, Atena, Barcelona, Budapesta și Beijing</li>'
			. '<li>Pregătire avansată în chirurgie spinală și tehnici endoscopice prin programe EANS/Eurospine și centre europene specializate</li>'
			. '</ul>';
	}
	return '<h2 class="gu-about-section-heading">Educație &amp; Formare</h2>'
		. '<div class="gu-about-education">' . wp_kses_post( $edu ) . '</div>';
} );

// Clinical Experience.
add_shortcode( 'gu_about_experience', function () {
	$exp = gu_get_about_field( 'about_experience' );
	if ( gu_about_content_is_missing( $exp ) ) {
		$exp = '<p>Activitate în neurochirurgie din ' . esc_html( gu_shared_site_setting( 'career_start_year', '2011' ) )
			. ', cu peste ' . esc_html( number_format_i18n( (int) gu_shared_site_setting( 'operated_patients_min', '1500' ) ) )
			. ' de pacienți operați.</p>';
	}
	return '<h2 class="gu-about-section-heading">Experiență Clinică</h2>'
		. '<div class="gu-about-experience">' . wp_kses_post( $exp ) . '</div>';
} );

// Special Interests — links to conditions/procedures.
add_shortcode( 'gu_about_interests', function () {
	$content = gu_get_about_field( 'about_interests' );
	$out     = '<h2 class="gu-about-section-heading">Domenii de Interes Special</h2>';
	if ( ! gu_about_content_is_missing( $content ) ) {
		return $out . '<div class="gu-about-interests">' . wp_kses_post( $content ) . '</div>';
	}
	$items = [
		[ 'Neurochirurgie tumorală', 'Evaluarea și tratamentul chirurgical al patologiei tumorale neurochirurgicale.', '/afectiuni/' ],
		[ 'Chirurgie spinală degenerativă', 'Evaluarea și tratamentul afecțiunilor degenerative ale coloanei vertebrale.', '/afectiuni/hernie-de-disc-lombara/' ],
		[ 'Tumori spinale', 'Domeniu de interes pentru dezvoltarea unei expertize chirurgicale specializate în România.', '/afectiuni/' ],
	];
	$out .= '<div class="gu-interests-grid">';
	foreach ( $items as [ $title, $desc, $url ] ) {
		$out .= '<div class="gu-interest-card">'
			. '<h3 class="gu-interest-card__title">' . esc_html( $title ) . '</h3>'
			. '<p class="gu-interest-card__desc">' . esc_html( $desc ) . '</p>'
			. '<a class="gu-interest-card__link" href="' . esc_url( home_url( $url ) ) . '">Aflați mai multe</a>'
			. '</div>';
	}
	$out .= '</div>';
	return $out;
} );

// Research & Publications — CONDITIONAL: self-contained block or empty string.
add_shortcode( 'gu_about_research', function () {
	$content = gu_get_about_field( 'about_research' );
	if ( gu_about_content_is_missing( $content ) ) {
		$content = '<p><strong>Doctor în Medicină, ' . esc_html( gu_shared_site_setting( 'phd_year', '2025' ) ) . '</strong><br>'
			. esc_html( gu_shared_site_setting( 'phd_institution', 'Universitatea de Medicină și Farmacie „Iuliu Hațieganu” Cluj-Napoca' ) ) . '</p>'
			. '<p>Teza de doctorat: <em>„' . esc_html( gu_shared_site_setting( 'phd_thesis', 'Modele de interacțiune între meningioamele de bază de craniu și elementele vasculare și nervoase cerebrale și influența cisternelor arahnoidiene în dezvoltarea tumorală' ) ) . '”</em></p>'
			. '<p>Autor și coautor de articole științifice și capitole de carte în neurochirurgie tumorală, craniană și spinală.</p>';
	}
	return '<div class="gu-about-conditional gu-about-conditional--warm">'
		. '<div class="gu-about-conditional__inner">'
		. '<h2 class="gu-about-section-heading">Cercetare &amp; Publicații</h2>'
		. '<div class="gu-about-research">' . wp_kses_post( $content ) . '</div>'
		. '</div></div>';
} );

// Teaching & Academic.
add_shortcode( 'gu_about_teaching', function () {
	$content = gu_get_about_field( 'about_teaching' );
	if ( gu_about_content_is_missing( $content ) ) { return ''; }
	return '<h2 class="gu-about-section-heading">Activitate Didactică</h2>'
		. '<div class="gu-about-teaching">' . wp_kses_post( $content ) . '</div>';
} );

// Professional Memberships.
add_shortcode( 'gu_about_memberships', function () {
	$content = gu_get_about_field( 'about_memberships' );
	if ( gu_about_content_is_missing( $content ) ) {
		$content = '<ul>'
			. '<li>European Association of Neurosurgical Societies (EANS)</li>'
			. '<li>Southeast Europe Neurosurgical Society (SeENS)</li>'
			. '<li>Societatea Română de Neurochirurgie (SRN)</li>'
			. '</ul>';
	}
	return '<h2 class="gu-about-section-heading">Afilieri Profesionale</h2>'
		. '<div class="gu-about-memberships">' . wp_kses_post( $content ) . '</div>';
} );

// Media Appearances — CONDITIONAL: self-contained block or empty string.
add_shortcode( 'gu_about_media', function () {
	$content = gu_get_about_field( 'about_media' );
	if ( empty( trim( strip_tags( $content ) ) ) ) { return ''; }
	return '<div class="gu-about-conditional gu-about-conditional--light">'
		. '<div class="gu-about-conditional__inner">'
		. '<h2 class="gu-about-section-heading">Apariții în Media</h2>'
		. '<div class="gu-about-media">' . wp_kses_post( $content ) . '</div>'
		. '</div></div>';
} );

// CTA at bottom of /despre/ page.
add_shortcode( 'gu_about_cta', function () {
	$cta   = gu_shared_primary_cta();
	$brand = gu_shared_site_setting( 'brand_name', 'George Ungureanu' );
	return '<div class="gu-about-cta">'
		. '<h2 class="gu-about-cta__heading">Vorbiți cu ' . esc_html( $brand ) . '</h2>'
		. '<p class="gu-about-cta__text">O consultație vă oferă o evaluare individualizată a simptomelor dumneavoastră și o discuție deschisă despre toate opțiunile de tratament disponibile.</p>'
		. '<a class="gu-btn gu-btn--accent" href="' . esc_url( $cta['url'] ) . '">' . esc_html( $cta['label'] ) . '</a>'
		. '</div>';
} );


// ─────────────────────────────────────────────────────────────
// 11. CUSTOM HEADER + NAVIGATION
// ─────────────────────────────────────────────────────────────

/**
 * Determine whether a nav URL matches the current request.
 *
 * Matches front page exactly; matches all other URLs as a path prefix so that
 * e.g. /afectiuni/ stays active on /afectiuni/hernie-de-disc-lombara/.
 */
function gu_nav_is_active( string $url ): bool {
	if ( trailingslashit( $url ) === trailingslashit( home_url( '/' ) ) ) {
		return is_front_page();
	}
	$nav_path  = rtrim( (string) parse_url( $url, PHP_URL_PATH ), '/' );
	$curr_path = rtrim( (string) parse_url( $_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH ), '/' );
	return 0 === strpos( $curr_path . '/', $nav_path . '/' );
}

/**
 * Render the custom site header and mobile drawer into the page.
 *
 * Hooked to wp_body_open (priority 1) so it appears before Elementor renders
 * its header location. The Elementor header is hidden via CSS.
 */
function gu_render_header(): void {
	$nav_items = gu_shared_navigation_items();
	$cta       = gu_shared_primary_cta();
	$brand     = gu_shared_site_setting( 'brand_name', 'George Ungureanu' );
	$role      = gu_shared_site_setting( 'brand_short_role', 'Medic Primar Neurochirurg' );
	?>
	<header class="gu-header" id="gu-header" role="banner">
		<div class="gu-header__inner">

			<a class="gu-header__logo"
			   href="<?php echo esc_url( home_url( '/' ) ); ?>"
			   aria-label="<?php echo esc_attr( $brand . ' — Pagina principală' ); ?>">
				<span class="gu-header__logo-name"><?php echo esc_html( $brand ); ?></span>
				<span class="gu-header__logo-title"><?php echo esc_html( $role ); ?></span>
			</a>

			<nav class="gu-header__nav" aria-label="Navigare principală">
				<ul class="gu-header__nav-list" role="list">
					<?php foreach ( $nav_items as $item ) : ?>
					<li class="gu-header__nav-item">
						<a class="gu-header__nav-link<?php echo gu_nav_is_active( $item['url'] ) ? ' is-active' : ''; ?>"
						   href="<?php echo esc_url( $item['url'] ); ?>">
							<?php echo esc_html( $item['title'] ); ?>
						</a>
					</li>
					<?php endforeach; ?>
				</ul>
			</nav>

			<div class="gu-header__actions">
				<a class="gu-btn gu-btn--accent gu-header__cta"
				   href="<?php echo esc_url( $cta['url'] ); ?>">
					<?php echo esc_html( $cta['label'] ); ?>
				</a>
				<button class="gu-header__hamburger"
				        type="button"
				        aria-expanded="false"
				        aria-controls="gu-mobile-drawer"
				        aria-label="Deschide meniul de navigare">
					<span class="gu-header__bar" aria-hidden="true"></span>
					<span class="gu-header__bar" aria-hidden="true"></span>
					<span class="gu-header__bar" aria-hidden="true"></span>
				</button>
			</div>

		</div>
	</header>

	<div class="gu-mobile-drawer"
	     id="gu-mobile-drawer"
	     aria-hidden="true"
	     role="dialog"
	     aria-modal="true"
	     aria-label="Meniu de navigare">

		<div class="gu-mobile-drawer__backdrop" id="gu-drawer-backdrop"></div>

		<div class="gu-mobile-drawer__panel">
			<button class="gu-mobile-drawer__close"
			        type="button"
			        id="gu-drawer-close"
			        aria-label="Închide meniul">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none"
				     stroke="currentColor" stroke-width="1.5"
				     stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
					<line x1="18" y1="6" x2="6" y2="18"/>
					<line x1="6" y1="6" x2="18" y2="18"/>
				</svg>
			</button>

			<nav aria-label="Navigare mobilă">
				<ul class="gu-mobile-drawer__nav" role="list">
					<?php foreach ( $nav_items as $item ) : ?>
					<li>
						<a class="gu-mobile-drawer__link"
						   href="<?php echo esc_url( $item['url'] ); ?>">
							<?php echo esc_html( $item['title'] ); ?>
						</a>
					</li>
					<?php endforeach; ?>
				</ul>
			</nav>

			<a class="gu-btn gu-btn--accent gu-mobile-drawer__cta"
			   href="<?php echo esc_url( $cta['url'] ); ?>">
				<?php echo esc_html( $cta['label'] ); ?>
			</a>
		</div>

	</div>
	<?php
}
add_action( 'wp_body_open', 'gu_render_header', 1 );


// ─────────────────────────────────────────────────────────────
// 13. PROGRAMĂRI PAGE (/programari/) — Sprint 9.9A
// Simplified booking experience. Removes credential metrics
// (years/interventions/training) that belong on /despre/.
// Adds city-grouped clinic cards, online consultation section.
// Preserves: what to bring, FAQ, final CTA.
// ─────────────────────────────────────────────────────────────

add_filter( 'body_class', function ( array $classes ): array {
	if ( is_page( 'programari' ) ) {
		$classes[] = 'page-programari';
	}
	return $classes;
} );

add_shortcode( 'gu_programari_page', function (): string {
	$contact_email = gu_shared_site_setting( 'contact_email' );
	$contact_phone = gu_shared_site_setting( 'contact_phone' );

	// ── Shared inline style strings ──────────────────────────
	$s_section_white  = 'background:#FFFFFF;border-bottom:1px solid rgba(0,0,0,.06);';
	$s_section_canvas = 'background:#F5F5F7;border-bottom:1px solid rgba(0,0,0,.06);';
	$s_inner_wide     = 'max-width:900px;margin:0 auto;padding:96px 32px;';
	$s_inner_narrow   = 'max-width:720px;margin:0 auto;padding:96px 32px;';
	$s_inner_narrow_c = 'max-width:720px;margin:0 auto;padding:96px 32px;text-align:center;';
	$s_overline       = 'font:600 11px/1 Inter,system-ui,sans-serif;letter-spacing:.1em;text-transform:uppercase;color:#0E7FC0;margin:0 0 14px;';
	$s_h1             = 'font:700 clamp(42px,4.8vw,64px)/1.1 Inter,system-ui,sans-serif;color:#1D1D1F;letter-spacing:-.03em;margin:0 0 20px;';
	$s_h2             = 'font:700 clamp(28px,3vw,42px)/1.15 Inter,system-ui,sans-serif;color:#1D1D1F;letter-spacing:-.025em;margin:0 0 16px;';
	$s_lead           = 'font:400 20px/1.7 Inter,system-ui,sans-serif;color:#6E6E73;max-width:600px;margin:0 0 32px;';
	$s_body           = 'font:400 17px/1.75 Inter,system-ui,sans-serif;color:#424245;margin:0 0 20px;';
	$s_note           = 'font:400 14px/1.6 Inter,system-ui,sans-serif;color:#6E6E73;border-left:3px solid #0E7FC0;padding-left:14px;margin:32px 0 0;';
	$s_client_box     = 'background:#FBFBFD;border:1px dashed rgba(14,127,192,.35);border-radius:10px;padding:28px 32px;margin:32px 0 0;font:400 15px/1.65 Inter,system-ui,sans-serif;color:#6E6E73;';
	$s_city_badge     = 'display:inline-block;background:rgba(14,127,192,.1);color:#0E7FC0;font:600 12px/1 Inter,system-ui,sans-serif;padding:6px 14px;border-radius:100px;letter-spacing:.04em;';
	$s_btn_sage       = 'display:inline-block;background:#0E7FC0;color:#FFFFFF;font:600 16px/1 Inter,system-ui,sans-serif;padding:16px 36px;border-radius:8px;text-decoration:none;';
	$s_btn_sage_sm    = 'display:inline-block;background:#0E7FC0;color:#FFFFFF;font:600 14px/1 Inter,system-ui,sans-serif;padding:12px 22px;border-radius:8px;text-decoration:none;';
	$s_btn_outline_sm = 'display:inline-block;background:transparent;color:#0E7FC0;border:1.5px solid #0E7FC0;font:600 14px/1 Inter,system-ui,sans-serif;padding:11px 22px;border-radius:8px;text-decoration:none;';

	$out = '';

	// ──────────────────────────────────────────────────────
	// SECTION 1 — HERO
	// ──────────────────────────────────────────────────────
	$out .= '<section style="' . $s_section_white . '">';
	$out .= '<div style="' . $s_inner_narrow . 'padding-top:80px;padding-bottom:80px;">';
	$out .= '<p style="' . $s_overline . '">Consultații Neurochirurgicale</p>';
	$out .= '<h1 style="' . $s_h1 . '">Programați o consultație</h1>';
	$out .= '<p style="' . $s_lead . '">O evaluare corectă este primul pas. Nu trebuie să aveți un diagnostic — doar să vă descrieți problema. Prima consultație durează 45–60 de minute.</p>';
	$out .= '<div style="display:flex;gap:10px;flex-wrap:wrap;">';
	$out .= '<span style="' . $s_city_badge . '">Cluj-Napoca</span>';
	$out .= '<span style="' . $s_city_badge . '">Baia Mare</span>';
	$out .= '<span style="' . $s_city_badge . '">Online</span>';
	$out .= '</div>';
	$out .= '</div>';
	$out .= '</section>';

	// ──────────────────────────────────────────────────────
	// SECTION 2 — LOCAȚII ȘI PROGRAM
	// Data-driven from the "locatii" CPT (editable in wp-admin, no code) —
	// displayed via a real Elementor Loop Grid (template 156) rendering a
	// Loop Item card template (155), one native "gu_location_card" shortcode
	// call per location. Order = each post's native "Order" field.
	// ──────────────────────────────────────────────────────
	$locations_count = count( get_posts( [
		'post_type'      => 'locatii',
		'posts_per_page' => -1,
		'fields'         => 'ids',
	] ) );
	$has_locations = $locations_count > 0;

	$out .= '<section id="clinici" style="' . $s_section_canvas . '">';
	$out .= '<div style="' . $s_inner_wide . '">';
	$out .= '<p style="' . $s_overline . '">Locații</p>';
	$out .= '<h2 style="' . $s_h2 . '">Unde consultă Dr. George Ungureanu</h2>';
	if ( $has_locations ) {
		$out .= '<p style="' . $s_lead . '">Consultații disponibile la ' . esc_html( $locations_count ) . ' locații, cu programare directă.</p>';
	} else {
		$out .= '<p style="' . $s_lead . '">Consultații disponibile în mai multe locații, cu programare directă.</p>';
	}

	if ( $has_locations ) {
		$out .= do_shortcode( '[elementor-template id="156"]' );
		$out .= '<p class="gu-locations-note">Programul poate suferi modificări. Pentru confirmarea disponibilității, vă rugăm să contactați direct clinica.</p>';
	} elseif ( $contact_email || $contact_phone ) {
		$out .= '<p style="' . $s_lead . 'margin-top:20px;">';
		if ( $contact_phone ) {
			$phone_href = preg_replace( '/[^0-9+]/', '', $contact_phone );
			$out .= '<a href="tel:' . esc_attr( $phone_href ) . '" style="' . $s_btn_sage_sm . '">' . esc_html( $contact_phone ) . '</a> ';
		}
		if ( $contact_email ) {
			$out .= '<a href="mailto:' . esc_attr( $contact_email ) . '" style="' . $s_btn_outline_sm . '">' . esc_html( $contact_email ) . '</a>';
		}
		$out .= '</p>';
	}

	$out .= '</div>';
	$out .= '</section>';

	// ──────────────────────────────────────────────────────
	// SECTION 3 — ONLINE CONSULTATION
	// ──────────────────────────────────────────────────────
	$online_cal_url = gu_shared_site_setting(
		'online_consultation_url',
		'https://cal.com/georgeungureanu/consultatie-online'
	);
	$online_email = gu_shared_site_setting(
		'online_consultation_email',
		'consultatii@georgeungureanu.doctor'
	);
	$online_price = gu_shared_site_setting( 'online_consultation_price' );
	$online_currency = gu_shared_site_setting( 'online_consultation_currency', 'RON' );
	$online_policy = gu_shared_site_setting( 'online_booking_policy' );

	$out .= '<section id="online" style="' . $s_section_white . '">';
	$out .= '<div style="' . $s_inner_wide . '">';
	$out .= '<p style="' . $s_overline . '">La Distanță</p>';
	$out .= '<h2 style="' . $s_h2 . '">Consultație Online</h2>';
	$out .= '<p style="' . $s_lead . '">Evaluarea prin video a unui dosar medical complet, atunci când a fost recomandată o evaluare neurochirurgicală, o operație sau se dorește o a doua opinie.</p>';
	$out .= '<div class="gu-online-eligibility">';
	$out .= '<div class="gu-online-eligibility__group gu-online-eligibility__group--yes">';
	$out .= '<h3 class="gu-online-eligibility__title">Când este potrivită</h3>';
	$out .= '<ul class="gu-online-eligibility__list">';
	$out .= '<li>A fost recomandată o evaluare neurochirurgicală.</li>';
	$out .= '<li>A fost recomandată o operație și doriți evaluarea cazului.</li>';
	$out .= '<li>Solicitați o a doua opinie neurochirurgicală.</li>';
	$out .= '<li>Aveți un RMN sau CT recent.</li>';
	$out .= '<li>Pacientul sau un aparținător bine informat poate răspunde întrebărilor despre simptome și istoricul medical.</li>';
	$out .= '</ul></div>';
	$out .= '<div class="gu-online-eligibility__group gu-online-eligibility__group--no">';
	$out .= '<h3 class="gu-online-eligibility__title">Când nu este potrivită</h3>';
	$out .= '<p class="gu-online-eligibility__text">Dacă nu a fost recomandată o evaluare neurochirurgicală sau dacă doriți doar informații generale.</p>';
	$out .= '</div></div>';

	// Online consultation card
	$out .= '<div style="background:#FFFFFF;border:1px solid rgba(0,0,0,.08);border-radius:16px;padding:36px 36px 32px;max-width:560px;box-shadow:0 2px 12px rgba(0,0,0,.06);margin-bottom:32px;">';

	// Icon + platform header
	$out .= '<div style="display:flex;align-items:center;gap:14px;margin-bottom:22px;">';
	$out .= '<div style="width:48px;height:48px;background:#E8F4FB;border-radius:12px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">';
	$out .= '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><rect x="2" y="6" width="14" height="12" rx="2" stroke="#0E7FC0" stroke-width="1.5"/><path d="M16 10l6-4v12l-6-4v-4z" stroke="#0E7FC0" stroke-width="1.5" stroke-linejoin="round"/></svg>';
	$out .= '</div>';
	$out .= '<div>';
	$out .= '<p style="font:600 11px/1 Inter,system-ui,sans-serif;letter-spacing:.06em;text-transform:uppercase;color:#0E7FC0;margin:0 0 5px;">Consultație video</p>';
	$out .= '<p style="font:700 18px/1.2 Inter,system-ui,sans-serif;color:#1D1D1F;margin:0;letter-spacing:-.01em;">Platformă video securizată</p>';
	$out .= '</div>';
	$out .= '</div>'; // icon row

	$out .= '<p style="font:400 15px/1.75 Inter,system-ui,sans-serif;color:#424245;margin:0 0 22px;">Consultația se desfășoară video și audio în timp real. Linkul de acces este trimis automat prin email după confirmare și poate fi deschis direct în browser.</p>';

	$online_features = [
		'Video + audio de înaltă calitate, direct în browser',
		'Durată: 45 de minute',
		'Puteți partaja imagini RMN/CT pe ecran în timp real',
		'Niciun document nu trebuie încărcat obligatoriu înainte de programare',
		'Consultație disponibilă din orice locație cu acces internet',
	];
	$out .= '<ul style="margin:0 0 28px 0;padding:0;list-style:none;">';
	foreach ( $online_features as $f ) {
		$out .= '<li style="font:400 14px/1.6 Inter,system-ui,sans-serif;color:#424245;padding:8px 0;border-bottom:1px solid rgba(0,0,0,.05);display:flex;align-items:flex-start;gap:10px;">';
		$out .= '<span style="color:#0E7FC0;font-weight:700;flex-shrink:0;line-height:1.6;" aria-hidden="true">✓</span>' . esc_html( $f );
		$out .= '</li>';
	}
	$out .= '</ul>';

	if ( $online_price ) {
		$out .= '<div style="background:#F4F8FA;border-radius:12px;padding:16px 18px;margin:0 0 22px;">';
		$out .= '<p style="font:700 16px/1.4 Inter,system-ui,sans-serif;color:#1D1D1F;margin:0;">Tarif: ' . esc_html( $online_price . ' ' . $online_currency ) . '</p>';
		$out .= '<p style="font:400 13px/1.6 Inter,system-ui,sans-serif;color:#5C6268;margin:5px 0 0;">Programarea este confirmată după finalizarea plății online.</p>';
		$out .= '</div>';
	}
	if ( $online_policy ) {
		$out .= '<p style="font:400 13px/1.65 Inter,system-ui,sans-serif;color:#5C6268;margin:0 0 22px;">' . esc_html( $online_policy ) . '</p>';
	}

	if ( $online_cal_url ) {
		$out .= '<a href="' . esc_url( $online_cal_url ) . '" target="_blank" rel="noopener noreferrer" style="' . $s_btn_sage . '">Programează o consultație online</a>';
	}
	if ( $online_email ) {
		$out .= '<p style="font:400 13px/1.6 Inter,system-ui,sans-serif;color:#6E6E73;margin:18px 0 0;">Pentru întrebări strict legate de consultațiile online: <a href="mailto:' . esc_attr( $online_email ) . '" style="color:#0E7FC0;text-decoration:underline;text-underline-offset:2px;">' . esc_html( $online_email ) . '</a></p>';
	}

	$out .= '</div>'; // card

	$out .= '<aside class="gu-online-medical-notice" aria-label="Limitările consultației online">';
	$out .= '<strong class="gu-online-medical-notice__title">Limitările consultației online</strong>';
	$out .= '<p class="gu-online-medical-notice__text">Consultația online nu poate constitui o recomandare medicală fermă, deoarece pacientul nu poate fi examinat clinic, iar anumite aspecte nu pot fi evaluate la distanță.</p>';
	$out .= '</aside>';

	$out .= '</div>';
	$out .= '</section>';

	// ──────────────────────────────────────────────────────
	// SECTION 4 — WHAT TO BRING
	// ──────────────────────────────────────────────────────
	$out .= '<section style="' . $s_section_canvas . '">';
	$out .= '<div style="' . $s_inner_wide . '">';
	$out .= '<h2 style="' . $s_h2 . '">Ce să aduceți la consultație</h2>';

	$checklist = [
		'Investigația imagistică relevantă — de regulă RMN, dar poate fi și CT',
		'Toate investigațiile medicale efectuate pentru afecțiunea evaluată',
		'Recomandarea sau scrisoarea medicului care a indicat evaluarea neurochirurgicală',
		'Lista medicamentelor curente (denumire, doze)',
		'Buletin sau carte de identitate',
	];

	$out .= '<ul class="gu-checklist">';
	foreach ( $checklist as $item ) {
		$out .= '<li>' . esc_html( $item ) . '</li>';
	}
	$out .= '</ul>';

	$out .= '<p style="' . $s_note . '"><strong>Despre imagistică:</strong> Pentru evaluarea neurochirurgicală este necesară o investigație imagistică relevantă. RMN-ul este investigația utilizată cel mai frecvent. Dacă nu știți ce investigație este potrivită, cereți recomandarea medicului care vă îndrumă către consult.</p>';

	$out .= '</div>';
	$out .= '</section>';

	// ──────────────────────────────────────────────────────
	// SECTION 5 — FAQ
	// ──────────────────────────────────────────────────────
	$out .= '<section style="' . $s_section_white . '">';
	$out .= '<div style="' . $s_inner_wide . '">';
	$out .= '<h2 style="' . $s_h2 . 'margin-bottom:40px;">Întrebări Frecvente</h2>';

	$faqs = [
		[
			'q' => 'Când am nevoie de un consult neurochirurgical?',
			'a' => 'În general, evaluarea neurochirurgicală este recomandată de un medic din altă specialitate. Consultația nu este destinată doar interpretării unui RMN și nici prescrierii unui tratament medicamentos pentru durere.',
		],
		[
			'q' => 'Am nevoie de RMN înainte de consultație?',
			'a' => 'Pentru evaluarea neurochirurgicală este necesară o investigație imagistică relevantă. RMN-ul este utilizat cel mai frecvent, dar investigația potrivită depinde de afecțiunea evaluată.',
		],
		[
			'q' => 'Cât durează o consultație?',
			'a' => 'O consultație inițială durează în medie 45–60 de minute. O a doua opinie: 30–45 minute. Un control postoperator: 20–30 minute. Aceste durate pot varia în funcție de complexitatea cazului.',
		],
		[
			'q' => 'Pot veni cu un aparținător?',
			'a' => 'Da, sunteți binevenți să veniți cu un aparținător. De multe ori este util ca un membru al familiei să fie prezent pentru a înțelege împreună diagnosticul și opțiunile de tratament.',
		],
		[
			'q' => 'Ce se întâmplă dacă trebuie să anulez sau reprogramez?',
			'a' => 'Condițiile de anulare, reprogramare și rambursare vor fi afișate înainte de confirmarea și plata programării. Pentru consultațiile online, solicitările se trimit la adresa dedicată indicată în confirmare.',
		],
		[
			'q' => 'Voi fi presat să aleg operația?',
			'a' => 'Nu. Scopul consultației este să înțelegeți complet situația și să aveți toate informațiile necesare pentru a lua o decizie. Chirurgia este recomandată doar când beneficiile depășesc clar riscurile și când opțiunile conservative au fost epuizate sau nu sunt aplicabile.',
		],
		// [CLIENT:] Add back once pricing/CNAS reimbursement info is
		// confirmed (docs/CLIENT_DECISIONS_REQUIRED.md, Q6/Q7) and once
		// international-patient policy is confirmed (Q14).
		[
			'q' => 'Cum se desfășoară consultația online?',
			'a' => 'Consultația online va avea loc prin Google Meet — video și audio în timp real, direct în browser, fără instalarea niciunei aplicații. După confirmare, primiți un email cu linkul de acces și instrucțiuni de pregătire. Dr. Ungureanu discută istoricul simptomelor și investigațiile disponibile, apoi explică pașii medicali care pot fi stabiliți în limitele unei evaluări la distanță.',
		],
		[
			'q' => 'Ce documente trebuie să pregătesc pentru consultația online?',
			'a' => 'Niciun document nu trebuie încărcat obligatoriu înainte. Pentru evaluare trebuie însă să aveți un RMN sau CT recent disponibil. Dacă le aveți, puteți pregăti și scrisori medicale sau biletul de externare.',
		],
		[
			'q' => 'Pot trimite RMN/CT înainte de consultație?',
			'a' => 'Nu trimiteți RMN, CT sau alte documente medicale prin email obișnuit. Instrucțiunile pentru transmiterea securizată vor fi comunicate separat. Încărcarea în avans nu este obligatorie, dar investigația relevantă trebuie să fie disponibilă în timpul consultației.',
		],
		[
			'q' => 'Primesc link video după programare?',
			'a' => 'Da. După confirmarea programării, primiți automat un email cu linkul Google Meet, data și ora consultației, precum și instrucțiunile de pregătire. Linkul este destinat exclusiv consultației programate și nu trebuie transmis altor persoane.',
		],
	];

	// Defense in depth: never render a FAQ item whose answer is empty or a
	// placeholder, regardless of how it got into the array above.
	$faqs = array_values( array_filter( $faqs, fn( $item ) => ! gu_about_content_is_missing( $item['a'] ) ) );

	$out .= '<div class="gu-faq">';
	foreach ( $faqs as $i => $item ) {
		$out .= '<details class="gu-faq__item"' . ( 0 === $i ? ' open' : '' ) . '>';
		$out .= '<summary class="gu-faq__question">' . esc_html( $item['q'] ) . '</summary>';
		$out .= '<div class="gu-faq__answer"><p>' . esc_html( $item['a'] ) . '</p></div>';
		$out .= '</details>';
	}
	$out .= '</div>';

	if ( $contact_email ) {
		$out .= '<p style="' . $s_note . '">Aveți o altă întrebare? Scrieți-ne la <a href="mailto:' . esc_attr( $contact_email ) . '" style="color:#0E7FC0;">' . esc_html( $contact_email ) . '</a></p>';
	}

	$out .= '</div>';
	$out .= '</section>';

	// ──────────────────────────────────────────────────────
	// SECTION 6 — FINAL CTA
	// ──────────────────────────────────────────────────────
	$out .= '<section style="background:#F5F5F7;border-top:1px solid rgba(0,0,0,.06);">';
	$out .= '<div style="' . $s_inner_narrow_c . '">';
	$out .= '<h2 style="' . $s_h2 . '">Primul pas este cel mai ușor.</h2>';
	$out .= '<p style="' . $s_lead . 'margin-left:auto;margin-right:auto;margin-bottom:32px;">Alegeți locația potrivită și contactați direct clinica. Fără angajamente, fără presiune.</p>';
	$out .= '<div style="display:flex;gap:12px;flex-wrap:wrap;justify-content:center;">';
	$out .= '<a href="#clinici" style="' . $s_btn_sage . '">Alegeți o locație ↑</a>';
	if ( $contact_phone ) {
		$phone_href = preg_replace( '/[^0-9+]/', '', $contact_phone );
		$out .= '<a href="tel:' . esc_attr( $phone_href ) . '" style="' . $s_btn_outline_sm . '">' . esc_html( $contact_phone ) . '</a>';
	}
	$out .= '</div>';
	if ( $contact_email ) {
		$out .= '<p style="margin-top:20px;font:400 14px/1.6 Inter,system-ui,sans-serif;color:#86868B;">Sau scrieți la <a href="mailto:' . esc_attr( $contact_email ) . '" style="color:#0E7FC0;">' . esc_html( $contact_email ) . '</a></p>';
	}
	$out .= '</div>';
	$out .= '</section>';

	return $out;
} );


// ─────────────────────────────────────────────────────────────
// 13B. LOCAȚII — card content for the Loop Item template
//
// Used inside an Elementor Loop Grid (post_type = locatii). The Loop Grid
// widget and Loop Item template handle the query, columns and responsive
// grid natively in Elementor; this shortcode renders the per-card body
// (name/city/schedule/address/phone/actions) from the CPT's own fields —
// nothing here is hardcoded per-location data, it all reads from the
// current loop post via get_the_ID().
// ─────────────────────────────────────────────────────────────

add_shortcode( 'gu_location_card', function () {
	$post_id = get_the_ID();
	if ( ! $post_id || ! function_exists( 'get_field' ) ) {
		return '';
	}

	$name      = get_the_title( $post_id );
	$city      = (string) get_field( 'location_city', $post_id );
	$address   = (string) get_field( 'location_address', $post_id );
	$schedule  = (string) get_field( 'location_schedule', $post_id );
	$phone     = (string) get_field( 'location_phone', $post_id );
	$phone_ext = (string) get_field( 'location_phone_ext', $post_id );
	$booking   = (string) get_field( 'location_booking_url', $post_id );
	$map       = (string) get_field( 'location_map_url', $post_id );
	$cta_label = (string) get_field( 'location_cta_label', $post_id ) ?: 'Programează-te';
	$note      = (string) get_field( 'location_note', $post_id );

	$out = '<article class="gu-clinic-card">';

	if ( has_post_thumbnail( $post_id ) ) {
		$out .= '<div class="gu-clinic-card__photo">' . get_the_post_thumbnail( $post_id, 'medium_large', [
			'loading' => 'lazy',
			'alt'     => esc_attr( $name . ' — ' . $city ),
		] ) . '</div>';
	} else {
		$out .= '<div class="gu-clinic-card__photo"><span>Fotografie clinică — în curând</span></div>';
	}

	$out .= '<div class="gu-clinic-card__body">';
	if ( $city ) {
		$out .= '<span class="gu-clinic-card__city">' . esc_html( $city ) . '</span>';
	}
	$out .= '<h3 class="gu-clinic-card__name">' . esc_html( $name ) . '</h3>';

	if ( ! gu_about_content_is_missing( $schedule ) ) {
		$out .= '<p class="gu-clinic-card__schedule">' . esc_html( $schedule ) . '</p>';
	}
	if ( ! gu_about_content_is_missing( $address ) ) {
		$out .= '<p class="gu-clinic-card__address">' . esc_html( $address ) . '</p>';
	}
	if ( ! gu_about_content_is_missing( $phone ) ) {
		$phone_href = preg_replace( '/[^0-9+]/', '', $phone );
		$out .= '<p class="gu-clinic-card__phone-row">';
		$out .= '<a class="gu-clinic-card__phone" href="tel:' . esc_attr( $phone_href ) . '">' . esc_html( $phone ) . '</a>';
		if ( ! gu_about_content_is_missing( $phone_ext ) ) {
			$out .= '<span class="gu-clinic-card__phone-ext">int. ' . esc_html( $phone_ext ) . '</span>';
		}
		$out .= '</p>';
	}

	$out .= '<div class="gu-clinic-card__actions">';
	if ( $booking ) {
		$out .= '<a href="' . esc_url( $booking ) . '" class="gu-btn gu-btn--accent gu-btn--sm" target="_blank" rel="noopener">' . esc_html( $cta_label ) . '</a>';
	}
	if ( $map ) {
		$out .= '<a href="' . esc_url( $map ) . '" class="gu-clinic-card__map-link" target="_blank" rel="noopener">Vezi pe hartă</a>';
	}
	$out .= '</div>';

	if ( ! gu_about_content_is_missing( $note ) ) {
		$out .= '<p class="gu-clinic-card__note">' . esc_html( wp_strip_all_tags( $note ) ) . '</p>';
	}

	$out .= '</div>'; // .gu-clinic-card__body
	$out .= '</article>';

	return $out;
} );


// ─────────────────────────────────────────────────────────────
// 12. RECOMANDĂRI PAGE (/recomandari/)
// Trust & professional validation pillar.
// Philosophy: colleague recommendations first, patient
// testimonials second, no star ratings, no carousels.
// ─────────────────────────────────────────────────────────────

add_filter( 'body_class', function ( array $classes ): array {
	if ( is_page( 'recomandari' ) ) {
		$classes[] = 'page-recomandari';
	}
	return $classes;
} );

add_shortcode( 'gu_recomandari_page', function (): string {

	$cta             = gu_shared_primary_cta();
	$programari_url = esc_url( $cta['url'] );
	$cta_label       = esc_html( $cta['label'] );

	// [CLIENT:] Flip to true once real, approved content exists for each
	// section. Until then the section is not rendered at all — no
	// placeholder or internal note is shown to visitors. See
	// docs/CLIENT_CONTENT_REQUIRED.md for exactly what's needed.
	$has_colleague_recommendations = false;
	$has_patient_testimonials      = false;

	// ── Shared inline style strings ───────────────────────────
	$s_section_white  = 'background:#FFFFFF;border-bottom:1px solid rgba(0,0,0,.06);';
	$s_section_canvas = 'background:#F5F5F7;border-bottom:1px solid rgba(0,0,0,.06);';
	$s_inner_wide     = 'max-width:900px;margin:0 auto;padding:96px 32px;';
	$s_inner_narrow   = 'max-width:720px;margin:0 auto;padding:96px 32px;text-align:center;';
	$s_overline       = 'font:600 11px/1 Inter,system-ui,sans-serif;letter-spacing:.1em;text-transform:uppercase;color:#0E7FC0;margin:0 0 14px;';
	// Floor lowered from 42px to 32px, and the mid-range coefficient raised
	// from 4.8vw to 8vw, so the heading actually shrinks (and keeps
	// scaling) between 320-480px instead of sitting at a flat 42px that
	// doesn't fit a single unbroken word ("Recomandări") at 320px.
	$s_h1             = 'font:700 clamp(32px,8vw,64px)/1.15 Inter,system-ui,sans-serif;color:#1D1D1F;letter-spacing:-.03em;margin:0 0 20px;';
	$s_h2             = 'font:700 clamp(28px,3vw,42px)/1.15 Inter,system-ui,sans-serif;color:#1D1D1F;letter-spacing:-.025em;margin:0 0 16px;';
	$s_lead           = 'font:400 20px/1.7 Inter,system-ui,sans-serif;color:#6E6E73;max-width:600px;margin:0 0 32px;';
	$s_lead_center    = $s_lead . 'margin-left:auto;margin-right:auto;';
	$s_body           = 'font:400 17px/1.75 Inter,system-ui,sans-serif;color:#424245;margin:0 0 20px;';
	$s_note           = 'font:400 14px/1.6 Inter,system-ui,sans-serif;color:#6E6E73;border-left:3px solid #0E7FC0;padding-left:14px;margin:32px 0 0;';
	$s_card_grid      = 'display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:20px;margin-top:36px;';
	$s_card           = 'background:#FFFFFF;border-radius:12px;padding:28px 28px 24px;box-shadow:0 1px 4px rgba(0,0,0,.06),0 0 0 1px rgba(0,0,0,.04);';
	$s_card_role      = 'font:500 13px/1.4 Inter,system-ui,sans-serif;color:#0E7FC0;letter-spacing:.04em;margin:0 0 6px;text-transform:uppercase;font-size:12px;';
	$s_card_name      = 'font:700 18px/1.3 Inter,system-ui,sans-serif;color:#1D1D1F;margin:0 0 4px;letter-spacing:-0.01em;';
	$s_card_inst      = 'font:400 14px/1.5 Inter,system-ui,sans-serif;color:#6E6E73;margin:0 0 14px;';
	$s_card_body      = 'font:400 15px/1.7 Inter,system-ui,sans-serif;color:#424245;margin:0;';
	$s_btn_blue       = 'display:inline-block;background:#0E7FC0;color:#FFFFFF;font:600 16px/1 Inter,system-ui,sans-serif;padding:16px 36px;border-radius:8px;text-decoration:none;transition:background 200ms;';
	$s_btn_sage       = 'display:inline-block;background:#0E7FC0;color:#FFFFFF;font:600 16px/1 Inter,system-ui,sans-serif;padding:16px 36px;border-radius:8px;text-decoration:none;margin-top:8px;';

	$out = '';

	// ────────────────────────────────────────────────────────
	// HERO
	// ────────────────────────────────────────────────────────
	$out .= '<section style="' . $s_section_white . 'padding-bottom:0;">';
	$out .= '<div style="' . $s_inner_narrow . 'padding-top:80px;padding-bottom:80px;">';
	$out .= '<p style="' . $s_overline . '">Trust &amp; Validare Profesională</p>';
	$out .= '<h1 style="' . $s_h1 . '">Recomandări</h1>';
	$out .= '<p style="' . $s_lead_center . '">Parteneri medicali și pacienți despre experiența cu Dr. George Ungureanu — fără stele artificiale, fără scoruri.</p>';
	$out .= '<a href="' . $programari_url . '" style="' . $s_btn_blue . '">' . $cta_label . '</a>';
	$out .= '</div>';
	$out .= '</section>';

	// ────────────────────────────────────────────────────────
	// SECTION 1 — COLLEAGUE DOCTOR RECOMMENDATIONS
	// Not rendered until $has_colleague_recommendations is true (real,
	// approved colleague recommendations exist) — see docs/CLIENT_CONTENT_REQUIRED.md.
	// ────────────────────────────────────────────────────────
	if ( $has_colleague_recommendations ) {
		$out .= '<section style="' . $s_section_canvas . '">';
		$out .= '<div style="' . $s_inner_wide . '">';
		$out .= '<p style="' . $s_overline . '">Colegi medici</p>';
		$out .= '<h2 style="' . $s_h2 . '">Recomandări din partea colegilor medici</h2>';
		$out .= '<p style="' . $s_body . '">O trimitere din partea unui coleg înseamnă că acel medic încredințează proprii pacienți îngrijirilor Dr. George Ungureanu. Este cel mai direct semnal de validare profesională pe care îl poate oferi un medic specialist.</p>';

		// [CLIENT:] Replace with real, approved colleague recommendations —
		// role, name, institution, quote — once available.
		$colleague_cards = [
			// [ 'role' => '...', 'name' => '...', 'institution' => '...', 'quote' => '...' ],
		];
		$out .= '<div style="' . $s_card_grid . '">';
		foreach ( $colleague_cards as $card ) {
			$out .= '<div style="' . $s_card . '">';
			$out .= '<p style="' . $s_card_role . '">' . esc_html( $card['role'] ) . '</p>';
			$out .= '<p style="' . $s_card_name . '">' . esc_html( $card['name'] ) . '</p>';
			$out .= '<p style="' . $s_card_inst . '">' . esc_html( $card['institution'] ) . '</p>';
			$out .= '<p style="' . $s_card_body . ' font-style:italic;">„' . esc_html( $card['quote'] ) . '"</p>';
			$out .= '</div>';
		}
		$out .= '</div>';

		// Editorial note on ethics
		$out .= '<p style="' . $s_note . '">';
		$out .= 'Fiecare recomandare este publicată cu acordul scris al colegului medic. '
			. 'Nu sunt afișate recomandări nesolicitate sau generate automat.';
		$out .= '</p>';

		$out .= '</div>';
		$out .= '</section>';
	}

	// ────────────────────────────────────────────────────────
	// SECTION 2 — PATIENT EXPERIENCES
	// Not rendered until $has_patient_testimonials is true (real, consented
	// testimonials exist) — see docs/CLIENT_CONTENT_REQUIRED.md.
	// ────────────────────────────────────────────────────────
	if ( $has_patient_testimonials ) {
		$out .= '<section style="' . $s_section_white . '">';
		$out .= '<div style="' . $s_inner_wide . '">';
		$out .= '<p style="' . $s_overline . '">Pacienți</p>';
		$out .= '<h2 style="' . $s_h2 . '">Experiențele pacienților</h2>';
		$out .= '<p style="' . $s_body . '">Relatări personale ale pacienților care au ales Dr. George Ungureanu pentru evaluare și tratament neurochirurgical.</p>';

		// Philosophy statement — no stars, no scores
		$out .= '<p style="background:#F5F5F7;border-radius:8px;padding:20px 24px;'
			. 'font:400 15px/1.65 Inter,system-ui,sans-serif;color:#424245;margin:0 0 32px;">';
		$out .= 'Nu afișăm scoruri numerice sau stele. Fiecare experiență de îngrijire medicală este individuală '
			. 'și nu poate fi redusă la o cifră. Relatările de mai jos sunt partajate cu acordul explicit al pacienților.';
		$out .= '</p>';

		$out .= '</div>';
		$out .= '</section>';
	}

	// ────────────────────────────────────────────────────────
	// SECTION 3 — SHARE YOUR EXPERIENCE
	// ────────────────────────────────────────────────────────
	$out .= '<section style="' . $s_section_canvas . '">';
	$out .= '<div style="' . $s_inner_narrow . '">';
	$out .= '<p style="' . $s_overline . '">Contribuiți</p>';
	$out .= '<h2 style="' . $s_h2 . '">Împărtășiți experiența dumneavoastră</h2>';
	$out .= '<p style="' . $s_lead_center . '">Dacă ați primit îngrijiri de la Dr. George Ungureanu și doriți să vă împărtășiți experiența, vă invităm să ne contactați direct.</p>';
	$out .= '<a href="' . $programari_url . '" style="' . $s_btn_blue . '">Contactați-ne</a>';

	$out .= '</div>';
	$out .= '</section>';

	// ────────────────────────────────────────────────────────
	// FINAL CTA
	// ────────────────────────────────────────────────────────
	$out .= '<section style="background:#F5F5F7;border-top:1px solid rgba(0,0,0,.06);">';
	$out .= '<div style="' . $s_inner_narrow . '">';
	$out .= '<h2 style="' . $s_h2 . '">Programați o consultație</h2>';
	$out .= '<p style="' . $s_lead_center . 'margin-bottom:32px;">O evaluare individualizată, fără grabă, cu un neurochirurg dedicat pacientului.</p>';
	$out .= '<a href="' . $programari_url . '" style="' . $s_btn_sage . '">' . $cta_label . '</a>';
	$out .= '</div>';
	$out .= '</section>';

	return $out;
} );


// ─────────────────────────────────────────────────────────────
// 13b. FORCED-DOWNLOAD ENDPOINT FOR THE RECOVERY GUIDE PDF
// ─────────────────────────────────────────────────────────────
// Elementor's native Button widget has no way to put a `download` HTML
// attribute on the actual <a> tag it renders (Custom Attributes only
// targets the widget's outer wrapper div). A Content-Disposition header
// forces the browser to download regardless, so Elementor buttons can
// link to this endpoint instead of the raw file URL.

add_action( 'init', function () {
	if ( ! isset( $_GET['gu_download'] ) || 'ghid-recuperare' !== $_GET['gu_download'] ) {
		return;
	}
	$file = plugin_dir_path( __FILE__ ) . 'assets/downloads/ghidul-pacientului-dupa-interventii-neurochirurgicale-revizia-2026-08.pdf';
	if ( ! file_exists( $file ) ) {
		return;
	}
	nocache_headers();
	header( 'Content-Type: application/pdf' );
	header( 'Content-Disposition: attachment; filename="Ghidul-pacientului-dupa-interventiile-neurochirurgicale.pdf"' );
	header( 'Content-Length: ' . filesize( $file ) );
	readfile( $file );
	exit;
} );

// ─────────────────────────────────────────────────────────────
// 14. PATIENT RECOVERY GUIDE
// ─────────────────────────────────────────────────────────────

add_shortcode( 'gu_recovery_guide', function (): string {
	$pdf_url = GU_DESIGN_SYSTEM_URL . 'assets/downloads/ghidul-pacientului-dupa-interventii-neurochirurgicale-revizia-2026-08.pdf';

	$topics = [
		[ 'id' => 'recuperare-generala', 'title' => 'Recuperare generală', 'text' => 'Ce este normal după operație, îngrijirea plăgii, controlul durerii, mobilizarea, activitățile zilnice și alimentația.' ],
		[ 'id' => 'semne-alarma', 'title' => 'Semne de alarmă', 'text' => 'Situațiile în care trebuie să contactați medicul sau să vă adresați unui serviciu de urgență.' ],
		[ 'id' => 'interventii-craniene', 'title' => 'Intervenții craniene', 'text' => 'Recomandări, exerciții și repere pentru recuperarea funcțiilor neurologice după intervențiile craniene.' ],
		[ 'id' => 'interventii-spinale', 'title' => 'Intervenții spinale', 'text' => 'Recomandări după discectomie, decompresie pentru stenoză, spondilodeză și intervenții pentru tumori vertebrale.' ],
		[ 'id' => 'viata-de-zi-cu-zi', 'title' => 'Viața de zi cu zi', 'text' => 'Exerciții, ergonomie, protejarea coloanei pe termen lung și răspunsuri la întrebările frecvente.' ],
	];

	$red_flags = [
		'Durere care se agravează progresiv sau durere bruscă, foarte intensă',
		'Febră peste 38°C',
		'Secreții, roșeață, căldură locală sau umflare la nivelul plăgii',
		'Slăbiciune ori amorțeală apărută brusc, dificultăți de vorbire sau vedere dublă',
		'Pierderea controlului vezicii sau intestinului',
		'Cefalee severă, convulsii, confuzie sau dificultăți de trezire',
	];

	$out  = '<header class="gu-guide-hero">';
	$out .= '<div class="gu-guide-shell gu-guide-hero__inner">';
	$out .= '<p class="gu-guide-eyebrow">Ghid medical pentru pacienți</p>';
	$out .= '<h1 class="gu-guide-hero__title">Recuperarea după intervențiile neurochirurgicale</h1>';
	$out .= '<p class="gu-guide-hero__lead">Informații clare și practice pentru o recuperare în siguranță, de la primele zile după operație până la revenirea treptată la activitățile importante.</p>';
	$out .= '<div class="gu-guide-actions">';
	$out .= '<a class="gu-btn gu-btn--accent" href="' . esc_url( $pdf_url ) . '" download>Descarcă ghidul complet <span aria-hidden="true">↓</span></a>';
	$out .= '<span class="gu-guide-file-meta">PDF · 27 pagini · aproximativ 49 MB</span>';
	$out .= '</div>';
	$out .= '</div></header>';

	$out .= '<section class="gu-guide-section gu-guide-section--muted"><div class="gu-guide-shell">';
	$out .= '<aside class="gu-guide-disclaimer"><strong>Important</strong><p>Acest ghid nu înlocuiește recomandările personalizate ale medicului dumneavoastră. Dacă ați primit alte instrucțiuni, acestea au prioritate.</p></aside>';
	$out .= '<nav class="gu-guide-topic-grid" aria-label="Cuprinsul ghidului">';
	foreach ( $topics as $topic ) {
		$out .= '<a class="gu-guide-topic" href="#' . esc_attr( $topic['id'] ) . '">';
		$out .= '<strong>' . esc_html( $topic['title'] ) . '</strong><span>' . esc_html( $topic['text'] ) . '</span>';
		$out .= '</a>';
	}
	$out .= '</nav></div></section>';

	$out .= '<section id="recuperare-generala" class="gu-guide-section"><div class="gu-guide-shell">';
	$out .= '<p class="gu-guide-eyebrow">Partea I</p><h2>Recomandări generale pentru recuperare</h2>';
	$out .= '<p class="gu-guide-intro">Durerea moderată, oboseala, furnicăturile, greața discretă, tulburările de somn și rigiditatea musculară pot apărea în perioada de recuperare și ar trebui să se amelioreze treptat. Evoluția este individuală.</p>';
	$out .= '<div class="gu-guide-card-grid">';
	$out .= '<article class="gu-guide-card"><h3>Îngrijirea plăgii</h3><p>Faceți duș conform indicațiilor, păstrați plaga curată și uscată și evitați băile în cadă, piscina sau jacuzzi în primele săptămâni. Nu aplicați creme ori soluții fără recomandare.</p></article>';
	$out .= '<article class="gu-guide-card"><h3>Controlul durerii</h3><p>Respectați schema prescrisă și nu modificați tratamentul fără acordul medicului. Scopul este menținerea durerii la un nivel care permite somnul și mobilizarea.</p></article>';
	$out .= '<article class="gu-guide-card"><h3>Mobilizarea</h3><p>Mișcați-vă zilnic și creșteți treptat distanța parcursă. Evitați statul prelungit în pat și opriți activitatea dacă durerea crește sau apare un simptom neobișnuit.</p></article>';
	$out .= '<article class="gu-guide-card"><h3>Alimentația</h3><p>Hidratați-vă, consumați proteine, legume, fructe și fibre și preveniți constipația. Evitați alcoolul în primele săptămâni și automedicația.</p></article>';
	$out .= '</div></div></section>';

	$out .= '<section id="semne-alarma" class="gu-guide-section gu-guide-section--alert"><div class="gu-guide-shell">';
	$out .= '<p class="gu-guide-eyebrow">Siguranță</p><h2>Când trebuie să contactați medicul</h2>';
	$out .= '<p class="gu-guide-intro">Nu așteptați ca simptomele să se agraveze. Contactați medicul sau cel mai apropiat serviciu de urgență dacă apare oricare dintre următoarele:</p>';
	$out .= '<ul class="gu-guide-alert-list">';
	foreach ( $red_flags as $flag ) {
		$out .= '<li>' . esc_html( $flag ) . '</li>';
	}
	$out .= '</ul></div></section>';

	$out .= '<section id="interventii-craniene" class="gu-guide-section"><div class="gu-guide-shell">';
	$out .= '<p class="gu-guide-eyebrow">Partea II</p><h2>După intervențiile craniene</h2>';
	$out .= '<div class="gu-guide-prose"><p>Recuperarea creierului necesită timp. Respectați tratamentul, evitați efortul fizic și intelectual intens în primele săptămâni, protejați-vă capul și păstrați programul controalelor.</p><p>Ghidul include recomandări despre revenirea la activități, condus, muncă, somn, exerciții cognitive și motorii, precum și recuperarea limbajului, memoriei, echilibrului și forței.</p></div>';
	$out .= '</div></section>';

	$out .= '<section id="interventii-spinale" class="gu-guide-section gu-guide-section--muted"><div class="gu-guide-shell">';
	$out .= '<p class="gu-guide-eyebrow">Recuperare specifică</p><h2>După intervențiile coloanei vertebrale</h2>';
	$out .= '<div class="gu-guide-card-grid">';
	$out .= '<article class="gu-guide-card"><h3>Discectomie cervicală sau lombară</h3><p>Protejarea zonei operate, mers progresiv, evitarea efortului și reluarea activităților conform recomandărilor primite.</p></article>';
	$out .= '<article class="gu-guide-card"><h3>Decompresie pentru stenoză</h3><p>Recuperarea mersului și a funcției poate fi graduală. Kinetoterapia individualizată și consecvența sunt importante.</p></article>';
	$out .= '<article class="gu-guide-card"><h3>Spondilodeză</h3><p>Protejarea implanturilor, evitarea flexiei și torsiunii și renunțarea la fumat susțin consolidarea osoasă.</p></article>';
	$out .= '<article class="gu-guide-card"><h3>Tumori vertebrale</h3><p>Recuperarea neurologică este individuală: progresul poate fi imediat sau poate apărea după mai multe luni. Planul de tratament și recuperare se coordonează cu echipa de oncologie, radioterapie și chirurgie.</p></article>';
	$out .= '</div></div></section>';

	$out .= '<section id="viata-de-zi-cu-zi" class="gu-guide-section"><div class="gu-guide-shell">';
	$out .= '<p class="gu-guide-eyebrow">Pe termen lung</p><h2>Mișcare, activități și protejarea coloanei</h2>';
	$out .= '<div class="gu-guide-prose"><p>Ghidul conține exerciții generale etapizate, recomandări despre ergonomie, ridicarea obiectelor, poziția la birou și în automobil, controlul greutății și activitățile fizice cu impact redus.</p><p>Exercițiile sunt orientative. Programul trebuie adaptat tipului intervenției și recomandărilor medicului și kinetoterapeutului.</p></div>';
	$out .= '<div class="gu-guide-download-panel"><div><h2>Păstrați ghidul la îndemână</h2><p>Descărcați varianta completă pentru toate recomandările, ilustrațiile și întrebările frecvente.</p></div><a class="gu-btn gu-btn--accent" href="' . esc_url( $pdf_url ) . '" download>Descarcă PDF-ul</a></div>';
	$out .= '</div></section>';

	return $out;
} );


// ─────────────────────────────────────────────────────────────
// 15. SFATUL NEUROCHIRURGULUI HUB (/articole/) — Sprint 9.9C
// Option C Hybrid: hub landing with editorial front door,
// section previews, article grid. Sections render only when
// content arrays are populated — no empty placeholders shown.
// ─────────────────────────────────────────────────────────────

add_filter( 'body_class', function ( array $classes ): array {
	if ( is_post_type_archive( 'articole' ) ) {
		$classes[] = 'page-sfatul-hub';
	}
	return $classes;
} );

add_shortcode( 'gu_sfatul_hub', function (): string {
	$cta = gu_shared_primary_cta();

	// ── Content arrays — populate with Dr. George's content ──
	// Each populated array enables its section on the hub page.

	// [CLIENT:] Add myth/truth pairs reviewed by Dr. George
	$myths = [
		// [ 'myth' => 'Text as patients say it.', 'truth' => 'Clinical truth in plain language.' ],
	];

	// [CLIENT:] Add YouTube video list from Dr. George
	$videos = [
		// [
		//   'title'       => 'Hernia de disc lombara - Ce este si cum se trateaza',
		//   'url'         => 'https://youtu.be/EXAMPLE',
		//   'category'    => 'Coloana vertebrala',
		//   'duration'    => '8:24',
		//   'description' => 'Dr. George explica in termeni simpli...',
		// ],
	];

	// [CLIENT:] Add procedure-specific recovery topics from Dr. George
	$recovery_topics = [
		// [
		//   'title'       => 'Recuperare dupa microdiscectomie lombara',
		//   'description' => 'Etapele recuperarii si ce sa asteptati...',
		//   'url'         => '/interventii/microdiscectomie-lombara/',
		//   'duration'    => '4-6 saptamani',
		// ],
	];

	// ── Determine which sections will render ──────────────────
	$has_recuperare = ! empty( $recovery_topics );
	$has_mituri     = ! empty( $myths );
	$has_video      = ! empty( $videos );

	// ── Featured article (manually pinned via wp_options) ─────
	// To pin an article: UPDATE wp_options SET option_value='{ID}'
	// WHERE option_name='gu_hub_pinned_article'
	$pinned_id = (int) get_option( 'gu_hub_pinned_article', 0 );
	$featured  = null;
	if ( $pinned_id ) {
		$p = get_post( $pinned_id );
		if ( $p && $p->post_status === 'publish' && $p->post_type === 'articole' ) {
			$featured = $p;
		}
	}
	if ( ! $featured ) {
		$recent = get_posts( [
			'post_type'   => 'articole',
			'numberposts' => 1,
			'post_status' => 'publish',
		] );
		$featured = $recent ? $recent[0] : null;
	}

	// ── SVG icons (SF Symbols aesthetic, 20x20, stroke 1.5) ──
	$ico_attr    = 'width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"';
	$ico_consult = '<svg ' . $ico_attr . '><path d="M5 3h10a1 1 0 0 1 1 1v13a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1z"/><line x1="7" y1="8" x2="13" y2="8"/><line x1="7" y1="11" x2="13" y2="11"/><line x1="7" y1="14" x2="10" y2="14"/></svg>';
	$ico_recover = '<svg ' . $ico_attr . '><polyline points="1,10 5,10 7,5 10,15 13,7 15,10 19,10"/></svg>';
	$ico_myth    = '<svg ' . $ico_attr . '><path d="M10 2 2 18h16L10 2z"/><line x1="10" y1="9" x2="10" y2="12.5"/><circle cx="10" cy="15" r="0.75" fill="currentColor" stroke="none"/></svg>';
	$ico_video   = '<svg ' . $ico_attr . '><circle cx="10" cy="10" r="7.5"/><polygon points="8,7.5 14,10 8,12.5" fill="currentColor" stroke="none"/></svg>';
	$ico_faq     = '<svg ' . $ico_attr . '><path d="M10 2C5.6 2 2 5.6 2 10c0 2.2.9 4.2 2.3 5.7L3.5 18l3.8-1.2C8.4 17.6 9.2 18 10 18c4.4 0 8-3.6 8-8s-3.6-8-8-8z"/><path d="M8.5 8a1.5 1.5 0 0 1 3 0c0 1-1 1.5-1.5 2"/><circle cx="10" cy="13.5" r=".6" fill="currentColor" stroke="none"/></svg>';

	// ── Nav section list (ordered, conditional) ───────────────
	$nav_sections = [
		[ 'id' => 'prima-consultatie', 'label' => 'Prima consultație', 'icon' => $ico_consult, 'active' => true ],
		[ 'id' => 'ghid-recuperare',   'label' => 'Recuperare',        'icon' => $ico_recover, 'active' => true ],
		[ 'id' => 'mituri',            'label' => 'Mituri',            'icon' => $ico_myth,    'active' => $has_mituri ],
		[ 'id' => 'video',             'label' => 'Video',             'icon' => $ico_video,   'active' => $has_video ],
		[ 'id' => 'intrebari',         'label' => 'Întrebări',         'icon' => $ico_faq,     'active' => true ],
	];

	// ── Shared style strings ──────────────────────────────────
	$s_white    = 'background:#FFFFFF;border-bottom:1px solid rgba(0,0,0,.06);';
	$s_canvas   = 'background:#F5F5F7;border-bottom:1px solid rgba(0,0,0,.06);';
	$s_wide     = 'max-width:960px;margin:0 auto;padding:80px 32px;';
	$s_narrow   = 'max-width:720px;margin:0 auto;padding:80px 32px;';
	$s_narrow_c = 'max-width:720px;margin:0 auto;padding:80px 32px;text-align:center;';
	$s_over     = 'font:600 11px/1 Inter,system-ui,sans-serif;letter-spacing:.1em;text-transform:uppercase;color:#0E7FC0;margin:0 0 14px;';
	// Floor lowered from 40px to 32px, coefficient raised from 4.5vw to
	// 8vw: "Neurochirurgului" alone needs ≤ ~256px at 320px viewport
	// (measured 246px @ 32px, 263px @ 34px) — 32px is the safe floor, and
	// it now actually scales between 320-480px instead of sitting flat.
	$s_h1       = 'font:700 clamp(32px,8vw,60px)/1.15 Inter,system-ui,sans-serif;color:#1D1D1F;letter-spacing:-.03em;margin:0 0 20px;';
	$s_h2       = 'font:700 clamp(26px,3vw,38px)/1.15 Inter,system-ui,sans-serif;color:#1D1D1F;letter-spacing:-.025em;margin:0 0 12px;';
	$s_body     = 'font:400 16px/1.75 Inter,system-ui,sans-serif;color:#424245;margin:0 0 16px;';
	$s_btn_sage = 'display:inline-flex;align-items:center;gap:8px;background:#0E7FC0;color:#FFFFFF;font:600 15px/1 Inter,system-ui,sans-serif;padding:13px 26px;border-radius:8px;text-decoration:none;';
	$s_btn_out  = 'display:inline-flex;align-items:center;background:transparent;color:#0E7FC0;font:600 15px/1 Inter,system-ui,sans-serif;padding:0;border:none;text-decoration:none;gap:6px;';
	$programari_url = esc_url( $cta['url'] );
	$cta_label      = esc_html( $cta['label'] );

	$out = '';

	// ════════════════════════════════════════════════════
	// HERO
	// ════════════════════════════════════════════════════
	$out .= '<section style="' . $s_white . '">';
	$out .= '<div style="' . $s_narrow . 'padding-bottom:64px;">';
	$out .= '<p style="' . $s_over . '">Educație medicală pentru pacienți</p>';
	$out .= '<h1 style="' . $s_h1 . '">Sfatul Neurochirurgului</h1>';
	$out .= '<p style="font:400 19px/1.75 Inter,system-ui,sans-serif;color:#6E6E73;margin:0 0 32px;max-width:600px;">Ghiduri, răspunsuri și resurse medicale redactate de Dr. George Ungureanu &mdash; pentru că un pacient informat are o recuperare mai bună.</p>';
	$out .= '<a href="' . $programari_url . '" style="' . $s_btn_sage . '">' . $cta_label . '</a>';
	$out .= '</div>';
	$out .= '</section>';

	// ════════════════════════════════════════════════════
	// PATIENT RECOVERY GUIDE
	// ════════════════════════════════════════════════════
	$out .= '<section id="ghid-recuperare" class="gu-hub-guide-promo">';
	$out .= '<div class="gu-hub-guide-promo__inner">';
	$out .= '<div><p class="gu-hub-guide-promo__eyebrow">Ghid nou pentru pacienți</p>';
	$out .= '<h2 class="gu-hub-guide-promo__title">Recuperarea după intervențiile neurochirurgicale</h2>';
	$out .= '<p class="gu-hub-guide-promo__text">Recomandări generale și specifice pentru intervențiile craniene și spinale, semne de alarmă, exerciții și revenirea la activitățile zilnice.</p>';
	$out .= '<div class="gu-hub-guide-promo__actions"><a class="gu-btn gu-btn--accent" href="' . esc_url( home_url( '/ghid-recuperare/' ) ) . '">Citește ghidul</a>';
	$out .= '<a class="gu-hub-guide-promo__download" href="' . esc_url( GU_DESIGN_SYSTEM_URL . 'assets/downloads/ghidul-pacientului-dupa-interventii-neurochirurgicale-revizia-2026-08.pdf' ) . '" download>Descarcă PDF-ul ↓</a></div></div>';
	$out .= '<div class="gu-hub-guide-promo__meta"><strong>27</strong><span>pagini ilustrate</span><strong>2</strong><span>trasee de recuperare</span></div>';
	$out .= '</div></section>';

	// ════════════════════════════════════════════════════
	// HUB NAVIGATION STRIP
	// ════════════════════════════════════════════════════
	$active_pills = array_values( array_filter( $nav_sections, fn( $s ) => $s['active'] ) );
	if ( count( $active_pills ) > 1 ) {
		$out .= '<nav class="gu-hub-nav" aria-label="Secțiuni hub">';
		$out .= '<div class="gu-hub-nav__inner">';
		foreach ( $active_pills as $pill ) {
			$out .= '<a href="#' . esc_attr( $pill['id'] ) . '" class="gu-hub-nav__pill">';
			$out .= $pill['icon'];
			$out .= '<span>' . esc_html( $pill['label'] ) . '</span>';
			$out .= '</a>';
		}
		$out .= '</div>';
		$out .= '</nav>';
	}

	// ════════════════════════════════════════════════════
	// FEATURED ARTICLE
	// ════════════════════════════════════════════════════
	if ( $featured ) {
		$f_url     = get_permalink( $featured );
		$f_title   = get_the_title( $featured );
		$f_excerpt = get_the_excerpt( $featured );
		if ( ! $f_excerpt ) {
			$f_excerpt = wp_trim_words( strip_tags( $featured->post_content ), 28 );
		}
		$f_cats = get_the_terms( $featured->ID, 'categorie-articole' );
		$f_cat  = ( $f_cats && ! is_wp_error( $f_cats ) ) ? esc_html( $f_cats[0]->name ) : '';

		$out .= '<section style="' . $s_canvas . '">';
		$out .= '<div style="' . $s_wide . 'padding-top:56px;padding-bottom:56px;">';
		$out .= '<div class="gu-hub-featured">';
		$out .= '<div class="gu-hub-featured__body">';
		if ( $f_cat ) {
			$out .= '<p class="gu-hub-featured__cat">' . $f_cat . '</p>';
		}
		$out .= '<h2 class="gu-hub-featured__title">' . esc_html( $f_title ) . '</h2>';
		$out .= '<p class="gu-hub-featured__excerpt">' . esc_html( $f_excerpt ) . '</p>';
		$out .= '<a href="' . esc_url( $f_url ) . '" class="gu-hub-featured__link">Citește articolul <svg width="16" height="16" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 10h12M12 5l5 5-5 5"/></svg></a>';
		$out .= '</div>';
		$out .= '</div>';
		$out .= '</div>';
		$out .= '</section>';
	}

	// ════════════════════════════════════════════════════
	// PRIMA CONSULTATIE
	// ════════════════════════════════════════════════════
	$out .= '<section id="prima-consultatie" style="' . $s_white . '">';
	$out .= '<div style="' . $s_wide . '">';
	$out .= '<p style="' . $s_over . '">Ghid pentru pacienți</p>';
	$out .= '<h2 style="' . $s_h2 . '">Prima Consultație</h2>';
	$out .= '<p style="' . $s_body . 'margin-bottom:40px;">Tot ce trebuie să știți înainte de prima întâlnire cu Dr. George Ungureanu &mdash; fără surprize, fără anxietate inutilă.</p>';

	$out .= '<div class="gu-guide-grid">';

	// Block 1 — Ce sa aduceti
	$out .= '<div class="gu-guide-block">';
	$out .= '<p class="gu-guide-block__over">Pas 1</p>';
	$out .= '<h3 class="gu-guide-block__title">Ce să aduceți</h3>';
	$bring = [
		'RMN sau CT recente, cu CD/DVD sau link digital (dacă există)',
		'Trimitere de la medicul de familie sau specialist (dacă aveți)',
		'Lista medicamentelor pe care le luați în prezent',
		'Buletin de identitate și cardul de sănătate CNAS',
		'Analize de sânge recente (dacă ați efectuat)',
	];
	$out .= '<ul class="gu-guide-block__list">';
	foreach ( $bring as $item ) {
		$out .= '<li>' . esc_html( $item ) . '</li>';
	}
	$out .= '</ul>';
	$out .= '<p class="gu-guide-block__note">Nu aveți toate documentele? Veniți oricum. O consultație parțial documentată este mai valoroasă decât o întârziere.</p>';
	$out .= '</div>';

	// Block 2 — Cum să vă pregătiți
	$out .= '<div class="gu-guide-block">';
	$out .= '<p class="gu-guide-block__over">Pas 2</p>';
	$out .= '<h3 class="gu-guide-block__title">Cum să vă pregătiți</h3>';
	$prep = [
		'Notați simptomele: de când au apărut, cum s-au modificat în timp',
		'Scrieți întrebările la care doriți răspuns — nu vă bazați pe memorie',
		'Aduceți un aparținător dacă doriți un al doilea set de ochi și urechi',
		'Nu este necesară pregătire specială: diete, post sau modificări de medicație',
	];
	$out .= '<ul class="gu-guide-block__list">';
	foreach ( $prep as $item ) {
		$out .= '<li>' . esc_html( $item ) . '</li>';
	}
	$out .= '</ul>';
	$out .= '</div>';

	// Block 3 — Ce intrebari sa puneti
	$out .= '<div class="gu-guide-block">';
	$out .= '<p class="gu-guide-block__over">Pas 3</p>';
	$out .= '<h3 class="gu-guide-block__title">Ce întrebări să puneți</h3>';
	$qs = [
		'"Ce arată exact investigațiile mele?"',
		'"Cât de urgent este cazul meu?"',
		'"Care sunt opțiunile de tratament și ce implică fiecare?"',
		'"Ce se întâmplă dacă nu tratez acum?"',
		'"Cât de des voi avea nevoie de urmărire?"',
		'"Ce să evit și ce pot face în continuare?"',
	];
	$out .= '<ul class="gu-guide-block__list gu-guide-block__list--questions">';
	foreach ( $qs as $q ) {
		$out .= '<li>' . esc_html( $q ) . '</li>';
	}
	$out .= '</ul>';
	$out .= '</div>';

	$out .= '</div>'; // .gu-guide-grid

	$out .= '<div style="margin-top:40px;padding-top:32px;border-top:1px solid rgba(0,0,0,.06);">';
	$out .= '<a href="' . $programari_url . '" style="' . $s_btn_sage . '">Programează prima consultație</a>';
	$out .= '</div>';
	$out .= '</div>';
	$out .= '</section>';

	// ════════════════════════════════════════════════════
	// RECUPERARE (conditional — needs content from Dr. George)
	// ════════════════════════════════════════════════════
	if ( $has_recuperare ) {
		$out .= '<section id="recuperare" style="' . $s_canvas . '">';
		$out .= '<div style="' . $s_wide . '">';
		$out .= '<p style="' . $s_over . '">Ghiduri de recuperare</p>';
		$out .= '<h2 style="' . $s_h2 . '">Recuperare și îngrijire</h2>';
		$out .= '<p style="' . $s_body . 'margin-bottom:36px;">Ghiduri specifice pe tip de intervenție &mdash; ce să așteptați, când să vă îngrijorați, cum să reveniți la viața de zi cu zi.</p>';
		$out .= '<div class="gu-recovery-grid">';
		foreach ( $recovery_topics as $topic ) {
			$out .= '<div class="gu-recovery-card">';
			$out .= '<h3 class="gu-recovery-card__title">' . esc_html( $topic['title'] ) . '</h3>';
			if ( ! empty( $topic['duration'] ) ) {
				$out .= '<p class="gu-recovery-card__duration">' . esc_html( $topic['duration'] ) . '</p>';
			}
			$out .= '<p class="gu-recovery-card__desc">' . esc_html( $topic['description'] ) . '</p>';
			if ( ! empty( $topic['url'] ) ) {
				$out .= '<a href="' . esc_url( home_url( $topic['url'] ) ) . '" style="' . $s_btn_out . '">Deschide ghidul <svg width="14" height="14" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 10h12M12 5l5 5-5 5"/></svg></a>';
			}
			$out .= '</div>';
		}
		$out .= '</div>';
		$out .= '</div>';
		$out .= '</section>';
	}

	// ════════════════════════════════════════════════════
	// MITURI SI ADEVARURI (conditional — needs Dr. George)
	// ════════════════════════════════════════════════════
	if ( $has_mituri ) {
		$sections_before_mituri = 2 + (int) (bool) $featured + (int) $has_recuperare;
		$myth_bg = ( $sections_before_mituri % 2 === 0 ) ? $s_canvas : $s_white;
		$out .= '<section id="mituri" style="' . $myth_bg . '">';
		$out .= '<div style="' . $s_wide . '">';
		$out .= '<p style="' . $s_over . '">Claritate medicală</p>';
		$out .= '<h2 style="' . $s_h2 . '">Mituri și adevăruri</h2>';
		$out .= '<p style="' . $s_body . 'margin-bottom:36px;">Credințe frecvente despre neurochirurgie &mdash; și ce spune medicina reală.</p>';
		$out .= '<div class="gu-myth-grid">';
		foreach ( $myths as $pair ) {
			$out .= '<div class="gu-myth-pair">';
			$out .= '<div class="gu-myth-card"><p class="gu-myth-card__label">Mit</p><p class="gu-myth-card__text">' . esc_html( $pair['myth'] ) . '</p></div>';
			$out .= '<div class="gu-truth-card"><p class="gu-truth-card__label">Adevărul</p><p class="gu-truth-card__text">' . esc_html( $pair['truth'] ) . '</p></div>';
			$out .= '</div>';
		}
		$out .= '</div>';
		$out .= '</div>';
		$out .= '</section>';
	}

	// ════════════════════════════════════════════════════
	// VIDEO (conditional — needs Dr. George's YouTube list)
	// ════════════════════════════════════════════════════
	if ( $has_video ) {
		$sections_before_video = 2 + (int) (bool) $featured + (int) $has_recuperare + (int) $has_mituri;
		$video_bg = ( $sections_before_video % 2 === 0 ) ? $s_canvas : $s_white;
		$out .= '<section id="video" style="' . $video_bg . '">';
		$out .= '<div style="' . $s_wide . '">';
		$out .= '<p style="' . $s_over . '">Dr. George explică</p>';
		$out .= '<h2 style="' . $s_h2 . '">Video</h2>';
		$out .= '<p style="' . $s_body . 'margin-bottom:36px;">Explicații vizuale despre afecțiuni, proceduri și recuperare.</p>';
		$out .= '<div class="gu-video-grid">';
		foreach ( $videos as $video ) {
			$out .= '<a href="' . esc_url( $video['url'] ) . '" class="gu-video-card" target="_blank" rel="noopener noreferrer">';
			$out .= '<div class="gu-video-card__thumb"><div class="gu-video-card__play">' . $ico_video . '</div>';
			if ( ! empty( $video['duration'] ) ) {
				$out .= '<span class="gu-video-card__duration">' . esc_html( $video['duration'] ) . '</span>';
			}
			$out .= '</div>';
			$out .= '<div class="gu-video-card__body">';
			if ( ! empty( $video['category'] ) ) {
				$out .= '<p class="gu-video-card__cat">' . esc_html( $video['category'] ) . '</p>';
			}
			$out .= '<h3 class="gu-video-card__title">' . esc_html( $video['title'] ) . '</h3>';
			if ( ! empty( $video['description'] ) ) {
				$out .= '<p class="gu-video-card__desc">' . esc_html( $video['description'] ) . '</p>';
			}
			$out .= '<span class="gu-video-card__link">Vizualizează pe YouTube &nearr;</span>';
			$out .= '</div></a>';
		}
		$out .= '</div>';
		$out .= '</div>';
		$out .= '</section>';
	}

	// ════════════════════════════════════════════════════
	// FAQ — EDUCATIONAL (always rendered)
	// ════════════════════════════════════════════════════
	$faq_data = [
		[
			'category' => 'Despre neurochirurgie',
			'items' => [
				[ 'q' => 'Ce este neurochirurgia?',
				  'a' => 'Neurochirurgia este specialitatea medicală care se ocupă cu diagnosticul și tratamentul chirurgical al afecțiunilor sistemului nervos: creier, măduva spinării, coloana vertebrală și nervi periferici. Neurochirurgul poate interveni atât pe afecțiuni urgente (traumatisme, hemoragii) cât și pe afecțiuni degenerative (hernii de disc, stenoze, tumori).' ],
				[ 'q' => 'Care este diferența dintre neurolog și neurochirurg?',
				  'a' => 'Neurologul diagnostichează și tratează afecțiunile neurologice prin metode non-chirurgicale: medicație, terapie, monitorizare. Neurochirurgul intervine chirurgical atunci când tratamentul conservator nu este suficient sau când există o afecțiune structurală ce necesită corecție. Cei doi specialiști colaborează frecvent în îngrijirea aceluiași pacient.' ],
				[ 'q' => 'Când ar trebui să consult un neurochirurg?',
				  'a' => 'În general, consultul neurochirurgical este recomandat de un medic din altă specialitate, atunci când cazul necesită o evaluare chirurgicală de specialitate. Simplul fapt că ați efectuat un RMN sau că doriți un tratament medicamentos pentru durere nu justifică, singur, un consult neurochirurgical.' ],
				[ 'q' => 'Trebuie să am simptome grave pentru a veni la consultație?',
				  'a' => 'Nu gravitatea percepută a simptomelor stabilește singură necesitatea consultului, ci recomandarea medicală și contextul clinic. Medicul care vă evaluează inițial vă poate îndruma către neurochirurgie atunci când este justificat.' ],
			],
		],
		[
			'category' => 'Prima consultație',
			'items' => [
				[ 'q' => 'Ce trebuie să aduc la prima consultație?',
				  'a' => 'Aduceți investigațiile medicale efectuate pentru afecțiunea evaluată, inclusiv investigația imagistică relevantă. RMN-ul este cel mai frecvent utilizat. Aduceți și scrisorile medicale sau biletele de externare pe care le aveți.' ],
				[ 'q' => 'Ce se întâmplă la prima consultație?',
				  'a' => 'Prima consultație include: un interviu clinic detaliat (istoricul simptomelor, medicamentele actuale, antecedente), examinare neurologică, analiza investigațiilor aduse (RMN, CT, analize) și discutarea opțiunilor. Veți pleca cu un plan clar: tratament conservator, investigații suplimentare sau recomandare de intervenție.' ],
				[ 'q' => 'Cât durează o consultație?',
				  'a' => 'O primă consultație durează în medie 30-45 de minute. Consultațiile de urmărire (control post-op sau monitorizare) sunt de obicei mai scurte, 15-20 de minute. Este suficient timp pentru a discuta îngrijorările dumneavoastră fără grabă.' ],
			],
		],
		[
			'category' => 'Despre intervenție',
			'items' => [
				[ 'q' => 'Înseamnă o consultație că voi fi neapărat operat?',
				  'a' => 'Nu. În majoritatea cazurilor evaluate, operația nu este necesară. Scopul consultației este evaluarea indicației și discutarea opțiunilor, nu presupunerea că va urma o intervenție.' ],
				[ 'q' => 'Cine decide dacă am nevoie de operație?',
				  'a' => 'Decizia finală aparține pacientului, după ce a înțeles indicația, riscurile și alternativele. Înainte de o operație la coloană, George Ungureanu recomandă confirmarea indicației de către cel puțin doi medici neurochirurgi.' ],
				[ 'q' => 'Când ar trebui să cer o a doua opinie?',
				  'a' => 'Este recomandat să cereți întotdeauna o a doua opinie, mai ales înaintea unei decizii de operație la coloană.' ],
				[ 'q' => 'Ce opțiuni există în afara operației?',
				  'a' => 'Tratamentul conservator poate include: kinetoterapie și exerciții specifice, fizioterapie (electrostimulare, ultrasunete, laser), medicație (antiinflamatoare, relaxante musculare, neurotrope), infiltrații epidurale sau facetare (în anumite indicații) și monitorizare activă cu RMN-uri periodice. Opțiunile depind de diagnosticul specific.' ],
			],
		],
		[
			'category' => 'Recuperare',
			'items' => [
				[ 'q' => 'Cât durează recuperarea în general?',
				  'a' => 'Durata recuperării depinde de tipul intervenției. Intervențiile minim invazive pe coloana lombară permit revenirea acasă în 1-2 zile și la activitate normală în 4-6 săptămâni. Intervențiile mai extinse pot necesita recuperare mai lungă. Dr. George va oferi un ghid de recuperare specific după stabilirea planului de tratament.' ],
				[ 'q' => 'Ce simptome ar trebui să mă îngrijoreze după o intervenție?',
				  'a' => 'Contactați imediat clinica sau prezentați-vă la urgențe dacă observați: febră peste 38 de grade la mai mult de 48 de ore post-op, roșeață sau scurgeri la nivelul plăgii, dureri nou apărute sau brusc agravate, slăbiciune sau amorțeală nou instalată la membre, sau orice simptom care vi se pare neobișnuit față de ce ați fost pregătit să așteptați.' ],
				[ 'q' => 'Când pot reveni la activitățile zilnice după operație?',
				  'a' => 'Activitățile ușoare (mers, activități casnice simple) pot fi reluate de obicei în prima săptămână. Munca de birou în 2-4 săptămâni. Munca fizică sau sportul la 6-12 săptămâni, în funcție de intervenție și de evoluție. Fiecare caz este diferit; ghidurile specifice sunt discutate la externare.' ],
			],
		],
	];

	$sections_above_faq = 2 + (int) (bool) $featured + (int) $has_recuperare + (int) $has_mituri + (int) $has_video;
	$faq_bg = ( $sections_above_faq % 2 === 0 ) ? $s_white : $s_canvas;

	$out .= '<section id="intrebari" style="' . $faq_bg . '">';
	$out .= '<div style="' . $s_wide . '">';
	$out .= '<p style="' . $s_over . '">Răspunsuri clare</p>';
	$out .= '<h2 style="' . $s_h2 . '">Întrebări Frecvente</h2>';
	$out .= '<p style="' . $s_body . 'margin-bottom:40px;">Răspunsuri la cele mai comune întrebări despre neurochirurgie, consultații și recuperare.</p>';
	foreach ( $faq_data as $faq_sec ) {
		$out .= '<h3 style="font:600 13px/1 Inter,system-ui,sans-serif;letter-spacing:.08em;text-transform:uppercase;color:#6E6E73;margin:36px 0 16px;">' . esc_html( $faq_sec['category'] ) . '</h3>';
		$out .= '<div class="gu-faq" style="margin-bottom:8px;">';
		foreach ( $faq_sec['items'] as $item ) {
			$out .= '<details class="gu-faq__item"><summary class="gu-faq__question">' . esc_html( $item['q'] ) . '</summary>';
			$out .= '<div class="gu-faq__answer"><p>' . esc_html( $item['a'] ) . '</p></div></details>';
		}
		$out .= '</div>';
	}
	$out .= '</div>';
	$out .= '</section>';

	// ════════════════════════════════════════════════════
	// ARTICLE GRID
	// ════════════════════════════════════════════════════
	$grid_bg = ( ( $sections_above_faq + 1 ) % 2 === 0 ) ? $s_white : $s_canvas;
	$out .= '<section style="' . $grid_bg . '">';
	$out .= '<div style="' . $s_wide . '">';
	$out .= '<p style="' . $s_over . '">Lectură aprofundată</p>';
	$out .= '<h2 style="' . $s_h2 . '">Articole</h2>';
	$out .= '<p style="' . $s_body . 'margin-bottom:8px;">Articole detaliate despre afecțiuni, proceduri și viață cu o condiție neurologică.</p>';
	$out .= do_shortcode( '[gu_articole_archive]' );
	$out .= '</div>';
	$out .= '</section>';

	// ════════════════════════════════════════════════════
	// FINAL CTA
	// ════════════════════════════════════════════════════
	$out .= '<section style="background:#F2F2F7;border-top:1px solid rgba(0,0,0,.06);">';
	$out .= '<div style="' . $s_narrow_c . '">';
	$out .= '<p style="font:600 11px/1 Inter,system-ui,sans-serif;letter-spacing:.1em;text-transform:uppercase;color:#6E6E73;margin:0 0 14px;">Pasul urmator</p>';
	$out .= '<h2 style="font:700 clamp(26px,3vw,38px)/1.15 Inter,system-ui,sans-serif;color:#1D1D1F;letter-spacing:-.025em;margin:0 0 16px;">Pregătit pentru o evaluare?</h2>';
	$out .= '<p style="font:400 18px/1.75 Inter,system-ui,sans-serif;color:#424245;margin:0 auto 36px;max-width:500px;">O primă consultație vă oferă claritate &mdash; indiferent de diagnostic.</p>';
	$out .= '<a href="' . $programari_url . '" style="display:inline-block;background:#0E7FC0;color:#FFFFFF;font:600 16px/1 Inter,system-ui,sans-serif;padding:16px 36px;border-radius:8px;text-decoration:none;">' . $cta_label . '</a>';
	$out .= '</div>';
	$out .= '</section>';

	return $out;
} );

/* ── HOMEPAGE FINAL CTA — PHP-INJECTED REBUILD ────────────────────────────
   The Elementor CTA section (#organism-cta-appointment) stores per-element
   colors in the DB and generates post-38.css with specificity (0,4,0) that
   cannot be overridden without ID selectors. Rather than fighting Elementor's
   cascade, we hide that section via CSS (Section 31c) and inject a fully
   controlled replacement here. JS positions it before .elementor-location-footer.
   ────────────────────────────────────────────────────────────────────────── */
add_action( 'wp_footer', function () {
	if ( ! is_front_page() ) {
		return;
	}
	$cta             = gu_shared_primary_cta();
	$url_programari = esc_url( $cta['url'] );
	$url_despre     = esc_url( home_url( '/despre/' ) );
	$cities          = gu_shared_site_setting( 'consultation_cities', 'Cluj-Napoca, Baia Mare' );
	?>
	<section id="gu-cta-rebuilt" class="gu-final-cta" aria-label="Programează o consultație">
		<div class="gu-final-cta__inner">
			<p class="gu-final-cta__overline">Pasul următor</p>
			<h2 class="gu-final-cta__heading">Programează o consultație neurochirurgicală</h2>
			<p class="gu-final-cta__body">O primă consultație oferă un diagnostic precis și un plan terapeutic individualizat — conservator sau chirurgical, în funcție de situația dumneavoastră.</p>
			<p class="gu-final-cta__trust">Consultații disponibile în <?php echo esc_html( $cities ); ?> și online.</p>
			<div class="gu-final-cta__actions">
				<a href="<?php echo $url_programari; ?>" class="gu-final-cta__btn-primary"><?php echo esc_html( $cta['label'] ); ?></a>
				<a href="<?php echo $url_despre; ?>" class="gu-final-cta__btn-secondary">Vezi clinicile <span aria-hidden="true">→</span></a>
			</div>
		</div>
	</section>
	<script>
	(function () {
		var footer = document.querySelector('.elementor-location-footer');
		var section = document.getElementById('gu-cta-rebuilt');
		if (footer && section) {
			footer.parentNode.insertBefore(section, footer);
		}
	}());
	</script>
	<?php
}, 20 );


// ─────────────────────────────────────────────────────────────
// ADMIN — SETUP PAGE
// GU Design System → Setup
// ─────────────────────────────────────────────────────────────

/**
 * Core pages required by the site.
 * 'homepage' => true marks the page that becomes the static front page.
 */
function gu_core_pages_config(): array {
	return [
		[
			'title'    => 'Acasă',
			'slug'     => 'acasa',
			'homepage' => true,
		],
		[
			'title' => 'Despre',
			'slug'  => 'despre',
		],
		[
			'title' => 'Recomandări',
			'slug'  => 'recomandari',
		],
		[
			'title' => 'Programări',
			'slug'  => 'programari',
		],
		[
			'title' => 'Ghidul pacientului după intervenții neurochirurgicale',
			'slug'  => 'ghid-recuperare',
		],
		[
			'title' => 'Sfatul Neurochirurgului',
			'slug'  => 'articole',
		],
	];
}

// ── Admin menu ────────────────────────────────────────────────

add_action( 'admin_menu', function () {
	add_menu_page(
		'GU Design System',
		'GU Design System',
		'manage_options',
		'gu-design-system',
		'gu_admin_setup_page',
		'dashicons-layout',
		80
	);

	// Rename the auto-created duplicate submenu entry.
	add_submenu_page(
		'gu-design-system',
		'Setup — GU Design System',
		'Setup',
		'manage_options',
		'gu-design-system',
		'gu_admin_setup_page'
	);
} );

// ── POST handler — Create / Repair Core Pages ─────────────────

add_action( 'admin_post_gu_create_pages', function () {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( 'Unauthorized.', 403 );
	}
	check_admin_referer( 'gu_create_pages' );

	$created     = [];
	$existing    = [];
	$homepage_id = 0;

	foreach ( gu_core_pages_config() as $cfg ) {
		$page = get_page_by_path( $cfg['slug'], OBJECT, 'page' );

		if ( $page instanceof WP_Post ) {
			$existing[] = $cfg['slug'];
			if ( ! empty( $cfg['homepage'] ) ) {
				$homepage_id = $page->ID;
			}
			continue;
		}

		$id = wp_insert_post( [
			'post_title'   => $cfg['title'],
			'post_name'    => $cfg['slug'],
			'post_status'  => 'publish',
			'post_type'    => 'page',
			'post_content' => '',
			'post_author'  => get_current_user_id(),
		], true );

		if ( is_wp_error( $id ) ) {
			continue;
		}

		$created[] = $cfg['slug'];

		if ( ! empty( $cfg['homepage'] ) ) {
			$homepage_id = $id;
		}
	}

	// Set static front page if we have the Acasă page.
	if ( $homepage_id ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $homepage_id );
	}

	wp_safe_redirect( add_query_arg(
		[
			'page'    => 'gu-design-system',
			'action'  => 'pages_done',
			'created' => count( $created ),
			'skipped' => count( $existing ),
		],
		admin_url( 'admin.php' )
	) );
	exit;
} );

// ── POST handler — Flush Permalinks ───────────────────────────

add_action( 'admin_post_gu_flush_permalinks', function () {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( 'Unauthorized.', 403 );
	}
	check_admin_referer( 'gu_flush_permalinks' );

	flush_rewrite_rules( true );

	wp_safe_redirect( add_query_arg(
		[
			'page'   => 'gu-design-system',
			'action' => 'flushed',
		],
		admin_url( 'admin.php' )
	) );
	exit;
} );

// ── Elementor kit status helper ───────────────────────────────

/**
 * Returns the current state of the Elementor Default Kit.
 *
 * Possible kit_status values:
 *   'not_elementor' — Elementor plugin is not loaded
 *   'ok'            — active kit exists and is published
 *   'trashed'       — active kit option points to a trashed post
 *   'broken'        — active kit option points to a non-published, non-trash post
 *   'restorable'    — option missing/stale but another kit was found (publish/trash/draft)
 *   'missing'       — no kit exists at all; must create new
 *
 * @return array{elementor_active:bool, option_set:bool, kit_id:int, kit_post:WP_Post|null, kit_status:string, restorable:WP_Post|null}
 */
function gu_elementor_kit_status(): array {
	$result = [
		'elementor_active' => class_exists( 'Elementor\Plugin' ),
		'option_set'       => false,
		'kit_id'           => 0,
		'kit_post'         => null,
		'kit_status'       => 'not_elementor',
		'restorable'       => null,
	];

	if ( ! $result['elementor_active'] ) {
		return $result;
	}

	$kit_id               = (int) get_option( 'elementor_active_kit', 0 );
	$result['option_set'] = $kit_id > 0;
	$result['kit_id']     = $kit_id;

	if ( $kit_id > 0 ) {
		$post = get_post( $kit_id );
		if ( $post instanceof WP_Post ) {
			$result['kit_post'] = $post;
			if ( 'publish' === $post->post_status ) {
				$result['kit_status'] = 'ok';
				return $result;
			}
			if ( 'trash' === $post->post_status ) {
				$result['kit_status'] = 'trashed';
				return $result;
			}
			$result['kit_status'] = 'broken';
			return $result;
		}
	}

	// Option missing or post gone — look for any surviving kit.
	$kits = get_posts( [
		'post_type'      => 'elementor_library',
		'post_status'    => [ 'publish', 'trash', 'draft' ],
		'meta_key'       => '_elementor_template_type',
		'meta_value'     => 'kit',
		'numberposts'    => 1,
		'orderby'        => 'date',
		'order'          => 'DESC',
		'no_found_rows'  => true,
	] );

	if ( ! empty( $kits ) ) {
		$result['restorable'] = $kits[0];
		$result['kit_status'] = 'restorable';
	} else {
		$result['kit_status'] = 'missing';
	}

	return $result;
}

// ── POST handler — Repair Elementor Default Kit ───────────────

add_action( 'admin_post_gu_repair_kit', function () {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( 'Unauthorized.', 403 );
	}
	check_admin_referer( 'gu_repair_kit' );

	if ( ! class_exists( 'Elementor\Plugin' ) ) {
		wp_safe_redirect( add_query_arg(
			[ 'page' => 'gu-design-system', 'action' => 'kit_error', 'reason' => 'no_elementor' ],
			admin_url( 'admin.php' )
		) );
		exit;
	}

	$status     = gu_elementor_kit_status();
	$kit_action = 'error';

	switch ( $status['kit_status'] ) {

		case 'ok':
			$kit_action = 'already_ok';
			break;

		case 'trashed':
			// The active kit is in trash — restore it.
			wp_untrash_post( $status['kit_id'] );
			wp_publish_post( $status['kit_id'] );
			$kit_action = 'restored';
			break;

		case 'broken':
			// Post exists but is not published — publish it.
			wp_publish_post( $status['kit_id'] );
			$kit_action = 'restored';
			break;

		case 'restorable':
			// Found an orphaned kit — adopt it and restore if needed.
			$kit = $status['restorable'];
			if ( 'trash' === $kit->post_status ) {
				wp_untrash_post( $kit->ID );
				wp_publish_post( $kit->ID );
			} elseif ( 'publish' !== $kit->post_status ) {
				wp_publish_post( $kit->ID );
			}
			update_option( 'elementor_active_kit', $kit->ID );
			$kit_action = 'restored';
			break;

		case 'missing':
		default:
			// No kit anywhere — create a minimal one.
			$new_id = wp_insert_post( [
				'post_title'  => 'Default Kit',
				'post_type'   => 'elementor_library',
				'post_status' => 'publish',
				'meta_input'  => [
					'_elementor_edit_mode'     => 'builder',
					'_elementor_template_type' => 'kit',
				],
			] );
			if ( ! is_wp_error( $new_id ) && $new_id > 0 ) {
				update_option( 'elementor_active_kit', $new_id );
				$kit_action = 'created';
			}
			break;
	}

	wp_safe_redirect( add_query_arg(
		[ 'page' => 'gu-design-system', 'action' => 'kit_repaired', 'kit_action' => $kit_action ],
		admin_url( 'admin.php' )
	) );
	exit;
} );

// ── Page render ───────────────────────────────────────────────

function gu_admin_setup_page(): void {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	$action  = isset( $_GET['action'] )  ? sanitize_key( $_GET['action'] )  : '';
	$created = isset( $_GET['created'] ) ? (int) $_GET['created']            : 0;
	$skipped = isset( $_GET['skipped'] ) ? (int) $_GET['skipped']            : 0;

	// ── Status data ───────────────────────────────────────────

	$pages_status = [];
	foreach ( gu_core_pages_config() as $cfg ) {
		$page = get_page_by_path( $cfg['slug'], OBJECT, 'page' );
		$pages_status[] = [
			'title'    => $cfg['title'],
			'slug'     => $cfg['slug'],
			'homepage' => ! empty( $cfg['homepage'] ),
			'exists'   => $page instanceof WP_Post,
			'id'       => $page instanceof WP_Post ? $page->ID : null,
			'url'      => $page instanceof WP_Post
			              ? get_permalink( $page->ID )
			              : home_url( '/' . $cfg['slug'] . '/' ),
		];
	}

	$front_type  = get_option( 'show_on_front', 'posts' );
	$front_id    = (int) get_option( 'page_on_front', 0 );
	$acasa_page  = get_page_by_path( 'acasa', OBJECT, 'page' );
	$homepage_ok = $front_type === 'page'
	               && $acasa_page instanceof WP_Post
	               && $front_id === $acasa_page->ID;

	$cpt_archives = [
		[ 'label' => 'Afecțiuni',   'url' => home_url( '/afectiuni/' ) ],
		[ 'label' => 'Intervenții', 'url' => home_url( '/interventii/' ) ],
	];

	$all_pages_exist = ! in_array( false, array_column( $pages_status, 'exists' ), true );

	$kit        = gu_elementor_kit_status();
	$kit_action = isset( $_GET['kit_action'] ) ? sanitize_key( $_GET['kit_action'] ) : '';

	?>
	<div class="wrap">
	<h1>GU Design System — Setup</h1>

	<style>
	.gu-setup-card{background:#fff;border:1px solid #c3c4c7;border-radius:4px;padding:20px 24px;margin:20px 0}
	.gu-setup-card h2{margin-top:0;font-size:13px;font-weight:600;text-transform:uppercase;letter-spacing:.05em;color:#50575e}
	.gu-setup-table{border-collapse:collapse;width:100%;margin:12px 0 0}
	.gu-setup-table th{text-align:left;padding:8px 12px;background:#f6f7f7;border-bottom:1px solid #c3c4c7;font-size:12px;color:#50575e;font-weight:600}
	.gu-setup-table td{padding:10px 12px;border-bottom:1px solid #f0f0f1;font-size:13px;vertical-align:middle}
	.gu-setup-table tr:last-child td{border-bottom:none}
	.gu-setup-actions{display:flex;gap:12px;align-items:center;flex-wrap:wrap;margin-top:16px}
	.gu-badge-ok{display:inline-block;background:#edfaef;color:#00a32a;border-radius:3px;padding:2px 8px;font-size:11px;font-weight:600}
	.gu-badge-miss{display:inline-block;background:#fcf0f1;color:#d63638;border-radius:3px;padding:2px 8px;font-size:11px;font-weight:600}
	</style>

	<?php if ( $action === 'pages_done' ) : ?>
	<div class="notice notice-success is-dismissible"><p>
		<?php if ( $created > 0 ) : ?>
			<strong><?php echo $created; ?> pagini create.</strong>
		<?php endif; ?>
		<?php if ( $skipped > 0 ) : ?>
			<?php echo $skipped; ?> pagini existente — păstrate nemodificate.
		<?php endif; ?>
		<?php if ( $created === 0 && $skipped > 0 ) : ?>
			Toate paginile existau deja. Nicio modificare.
		<?php endif; ?>
	</p></div>
	<?php endif; ?>

	<?php if ( $action === 'flushed' ) : ?>
	<div class="notice notice-success is-dismissible"><p>
		<strong>Permalink-urile au fost reîncărcate.</strong> Arhivele CPT sunt acum accesibile.
	</p></div>
	<?php endif; ?>

	<?php if ( $action === 'kit_repaired' ) : ?>
	<div class="notice notice-<?php echo $kit_action === 'error' ? 'error' : 'success'; ?> is-dismissible"><p>
		<?php if ( $kit_action === 'created' ) : ?>
			<strong>Default Kit creat.</strong> Elementor poate fi acum utilizat.
		<?php elseif ( $kit_action === 'restored' ) : ?>
			<strong>Default Kit restaurat.</strong> Elementor poate fi acum utilizat.
		<?php elseif ( $kit_action === 'already_ok' ) : ?>
			Default Kit este deja activ — nicio modificare.
		<?php else : ?>
			<strong>Eroare:</strong> Kit-ul nu a putut fi creat. Verifică erorile PHP sau reinstalează Elementor.
		<?php endif; ?>
	</p></div>
	<?php endif; ?>

	<?php if ( $action === 'kit_error' ) : ?>
	<div class="notice notice-error is-dismissible"><p>
		<strong>Elementor nu este activ.</strong> Activează pluginul Elementor înainte de a repara kit-ul.
	</p></div>
	<?php endif; ?>


	<!-- ── Core Pages ─────────────────────────────────────── -->
	<div class="gu-setup-card">
		<h2>Core Pages</h2>
		<p style="margin-top:0">Paginile de mai jos trebuie să existe în baza de date WordPress. Conținutul paginilor existente nu este modificat.</p>

		<table class="gu-setup-table">
			<thead>
				<tr>
					<th>Pagină</th>
					<th>Slug</th>
					<th>URL</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ( $pages_status as $row ) : ?>
				<tr>
					<td>
						<strong><?php echo esc_html( $row['title'] ); ?></strong>
						<?php if ( $row['homepage'] ) : ?>
							<span style="color:#646970;font-size:11px"> (homepage)</span>
						<?php endif; ?>
					</td>
					<td><code>/<?php echo esc_html( $row['slug'] ); ?>/</code></td>
					<td>
						<?php if ( $row['exists'] ) : ?>
							<a href="<?php echo esc_url( $row['url'] ); ?>" target="_blank" rel="noopener">
								<?php echo esc_html( $row['url'] ); ?>
							</a>
						<?php else : ?>
							<span style="color:#646970"><?php echo esc_html( home_url( '/' . $row['slug'] . '/' ) ); ?></span>
						<?php endif; ?>
					</td>
					<td>
						<?php echo $row['exists']
							? '<span class="gu-badge-ok">✓ Există</span>'
							: '<span class="gu-badge-miss">✗ Lipsă</span>'; ?>
					</td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>

		<div class="gu-setup-actions">
			<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
				<?php wp_nonce_field( 'gu_create_pages' ); ?>
				<input type="hidden" name="action" value="gu_create_pages">
				<button type="submit" class="button button-primary">
					<?php echo $all_pages_exist ? 'Repair Core Pages' : 'Create / Repair Core Pages'; ?>
				</button>
			</form>
			<?php if ( $all_pages_exist ) : ?>
				<span style="color:#00a32a;font-size:13px">✓ Toate paginile există</span>
			<?php endif; ?>
		</div>
	</div>


	<!-- ── Homepage Setting ───────────────────────────────── -->
	<div class="gu-setup-card">
		<h2>Homepage Setting</h2>

		<?php if ( $homepage_ok ) : ?>
			<p style="color:#00a32a;font-weight:600;margin:0">
				✓ Pagina statică este setată corect: <strong>Acasă</strong> (ID <?php echo $front_id; ?>)
			</p>
		<?php elseif ( $front_type !== 'page' ) : ?>
			<p style="color:#d63638;font-weight:600;margin:0 0 8px">
				✗ Homepage afișează <em>ultimele articole</em>, nu pagina statică Acasă.
			</p>
			<p style="margin:0;color:#646970;font-size:12px">
				Apasă <em>Create / Repair Core Pages</em> — va seta automat Acasă ca pagină statică.
			</p>
		<?php elseif ( ! ( $acasa_page instanceof WP_Post ) ) : ?>
			<p style="color:#d63638;font-weight:600;margin:0">
				✗ Pagina <code>/acasa/</code> lipsește — creaz-o mai întâi.
			</p>
		<?php else : ?>
			<p style="color:#dba617;font-weight:600;margin:0 0 8px">
				⚠ Homepage static este setat la pagina ID <?php echo $front_id; ?>, dar nu este <strong>Acasă</strong> (ID <?php echo $acasa_page->ID; ?>).
			</p>
			<p style="margin:0;color:#646970;font-size:12px">Apasă <em>Repair Core Pages</em> pentru a corecta.</p>
		<?php endif; ?>

		<p style="margin:12px 0 0;font-size:12px;color:#646970">
			Settings → Reading → Your homepage displays:
			<strong><?php echo $front_type === 'page' ? 'Static page (ID ' . $front_id . ')' : 'Latest posts'; ?></strong>
		</p>
	</div>


	<!-- ── CPT Archives ───────────────────────────────────── -->
	<div class="gu-setup-card">
		<h2>CPT Archives</h2>
		<p style="margin-top:0">Aceste URL-uri sunt generate automat din CPT-uri — nu necesită pagini în baza de date. Dacă returnează 404 după activare, apasă <em>Flush Permalinks</em>.</p>

		<table class="gu-setup-table">
			<thead><tr><th>CPT</th><th>URL</th></tr></thead>
			<tbody>
			<?php foreach ( $cpt_archives as $cpt ) : ?>
				<tr>
					<td><strong><?php echo esc_html( $cpt['label'] ); ?></strong></td>
					<td>
						<a href="<?php echo esc_url( $cpt['url'] ); ?>" target="_blank" rel="noopener">
							<?php echo esc_html( $cpt['url'] ); ?>
						</a>
					</td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>


	<!-- ── Elementor Default Kit ─────────────────────────── -->
	<div class="gu-setup-card">
		<h2>Elementor Default Kit</h2>

		<?php if ( ! $kit['elementor_active'] ) : ?>
			<p style="color:#d63638;font-weight:600;margin:0">
				✗ Elementor nu este activ — kit-ul nu poate fi verificat.
			</p>

		<?php elseif ( $kit['kit_status'] === 'ok' ) : ?>
			<p style="color:#00a32a;font-weight:600;margin:0 0 6px">
				✓ Default Kit activ (ID <?php echo esc_html( $kit['kit_id'] ); ?>)
			</p>
			<p style="margin:0;font-size:12px;color:#646970">
				Elementor poate deschide editorul fără erori.
			</p>

		<?php else : ?>
			<?php
			$kit_problem = '';
			if ( $kit['kit_status'] === 'trashed' ) {
				$kit_problem = 'Kit-ul implicit (ID ' . $kit['kit_id'] . ') a fost mutat în Coș. Elementor arată eroarea "Your site doesn\'t have a default kit."';
			} elseif ( $kit['kit_status'] === 'broken' ) {
				$kit_problem = 'Kit-ul (ID ' . $kit['kit_id'] . ') există dar are statusul <code>' . esc_html( $kit['kit_post']->post_status ) . '</code> în loc de <code>publish</code>.';
			} elseif ( $kit['kit_status'] === 'restorable' ) {
				$kit_problem = 'Opțiunea <code>elementor_active_kit</code> lipsește sau este invalidă, dar a fost găsit un kit existent (ID ' . $kit['restorable']->ID . ', status: ' . esc_html( $kit['restorable']->post_status ) . ').';
			} else {
				$kit_problem = 'Niciun kit nu există în baza de date. Elementor va arăta eroarea "Your site doesn\'t have a default kit."';
			}
			?>
			<p style="color:#d63638;font-weight:600;margin:0 0 8px">
				✗ Default Kit lipsește sau este invalid
			</p>
			<p style="margin:0 0 16px;font-size:13px;color:#1d1d1f">
				<?php echo wp_kses( $kit_problem, [ 'code' => [] ] ); ?>
			</p>

			<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
				<?php wp_nonce_field( 'gu_repair_kit' ); ?>
				<input type="hidden" name="action" value="gu_repair_kit">
				<button type="submit" class="button button-primary">Repair Elementor Default Kit</button>
			</form>

			<p style="margin:12px 0 0;font-size:12px;color:#646970">
				<?php if ( $kit['kit_status'] === 'trashed' ) : ?>
					Acțiunea va restaura kit-ul din Coș și îl va republica.
				<?php elseif ( $kit['kit_status'] === 'restorable' ) : ?>
					Acțiunea va seta kit-ul existent ca activ și îl va publica dacă este necesar.
				<?php else : ?>
					Acțiunea va crea un Default Kit nou și îl va seta ca activ.
				<?php endif; ?>
				Nu se șterg sau modifică setările existente ale kit-ului.
			</p>
		<?php endif; ?>

		<p style="margin:16px 0 0;font-size:12px;color:#646970;border-top:1px solid #f0f0f1;padding-top:12px">
			<strong>Opțiune WordPress:</strong> <code>elementor_active_kit</code> = <code><?php echo esc_html( $kit['kit_id'] ?: '(nesetat)' ); ?></code>
		</p>
	</div>


	<!-- ── Flush Permalinks ───────────────────────────────── -->
	<div class="gu-setup-card">
		<h2>Flush Permalinks</h2>
		<p style="margin-top:0">Reîncarcă regulile de rewriting WordPress. Necesar după activarea plugin-ului, crearea paginilor sau dacă arhivele CPT returnează 404.</p>

		<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
			<?php wp_nonce_field( 'gu_flush_permalinks' ); ?>
			<input type="hidden" name="action" value="gu_flush_permalinks">
			<button type="submit" class="button button-secondary">Flush Permalinks</button>
		</form>

		<p style="margin:12px 0 0;font-size:12px;color:#646970">
			Echivalent cu Settings → Permalinks → Save Changes.
		</p>
	</div>


	<!-- ── Quick Reference ────────────────────────────────── -->
	<div class="gu-setup-card">
		<h2>Quick Reference</h2>
		<table class="gu-setup-table">
			<thead><tr><th>Situație</th><th>Acțiune necesară</th></tr></thead>
			<tbody>
				<tr><td>WordPress nou instalat</td><td>Create / Repair Core Pages → Flush Permalinks → Repair Elementor Default Kit → importă template-urile Elementor</td></tr>
				<tr><td>Elementor arată "doesn't have a default kit"</td><td>Repair Elementor Default Kit</td></tr>
				<tr><td>Plugin actualizat (CPT sau slug nou)</td><td>Flush Permalinks</td></tr>
				<tr><td>Activare temă</td><td>Flush Permalinks</td></tr>
				<tr><td>Deploy cPanel Git</td><td>Elementor → Tools → Regenerate CSS (dacă s-a modificat CSS-ul plugin-ului)</td></tr>
			</tbody>
		</table>
	</div>

	</div><!-- .wrap -->
	<?php
}
