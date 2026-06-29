<?php
/**
 * Plugin Name:  GU Design System
 * Plugin URI:   https://georgeungureanu.doctor
 * Description:  Loads the approved Direction B+ (Warm Academic Medicine) design system for georgeungureanu.doctor. Enqueues Google Fonts (Lora + Inter), CSS custom properties (color, typography, spacing, layout, motion tokens), and utility classes. Safe to activate/deactivate — removes everything on deactivation. Does not modify Elementor database settings, does not create pages or templates, and does not depend on Elementor Pro APIs.
 * Version:      1.0.0
 * Author:       georgeungureanu.doctor
 * License:      Private — All rights reserved
 * Text Domain:  gu-design-system
 *
 * Governing source: docs/design-system/APPROVED_VISUAL_DIRECTION.md (Direction B+)
 * CSS source:       elementor/custom.css (adapted — @import removed; fonts via wp_enqueue_style)
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Prevent direct file access.
}

define( 'GU_DESIGN_SYSTEM_VERSION', '1.0.0' );
define( 'GU_DESIGN_SYSTEM_URL', plugin_dir_url( __FILE__ ) );


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
	$out = '<div class="gu-afectiuni-grid" style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:24px;">';
	while ( $query->have_posts() ) {
		$query->the_post();
		$summary = function_exists( 'get_field' ) ? wp_strip_all_tags( (string) get_field( 'short_summary' ) ) : get_the_excerpt();
		$out    .= '<article style="background:#FDFBF7;border:1px solid #D6CFC4;border-radius:8px;padding:28px;">';
		$out    .= '<h3 style="font-family:Lora,serif;font-size:20px;font-weight:700;margin:0 0 10px;"><a href="' . esc_url( get_permalink() ) . '" style="color:#231E1A;text-decoration:none;">' . esc_html( get_the_title() ) . '</a></h3>';
		$out    .= '<p style="font-family:Inter,system-ui,sans-serif;font-size:15px;color:#5A5550;margin:0 0 14px;">' . esc_html( wp_trim_words( $summary, 20 ) ) . '</p>';
		$out    .= '<a href="' . esc_url( get_permalink() ) . '" style="font-size:14px;font-weight:600;color:#4D7A70;text-decoration:none;">Citește mai mult →</a>';
		$out    .= '</article>';
	}
	wp_reset_postdata();
	$out .= '</div>';
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
	$out = '<div class="gu-interventii-grid" style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:24px;">';
	while ( $query->have_posts() ) {
		$query->the_post();
		$summary = function_exists( 'get_field' ) ? wp_strip_all_tags( (string) get_field( 'short_summary' ) ) : get_the_excerpt();
		$out    .= '<article style="background:#FDFBF7;border:1px solid #D6CFC4;border-radius:8px;padding:28px;">';
		$out    .= '<h3 style="font-family:Lora,serif;font-size:20px;font-weight:700;margin:0 0 10px;"><a href="' . esc_url( get_permalink() ) . '" style="color:#231E1A;text-decoration:none;">' . esc_html( get_the_title() ) . '</a></h3>';
		$out    .= '<p style="font-family:Inter,system-ui,sans-serif;font-size:15px;color:#5A5550;margin:0 0 14px;">' . esc_html( wp_trim_words( $summary, 20 ) ) . '</p>';
		$out    .= '<a href="' . esc_url( get_permalink() ) . '" style="font-size:14px;font-weight:600;color:#4D7A70;text-decoration:none;">Detalii intervenție →</a>';
		$out    .= '</article>';
	}
	wp_reset_postdata();
	$out .= '</div>';
	return $out;
} );
