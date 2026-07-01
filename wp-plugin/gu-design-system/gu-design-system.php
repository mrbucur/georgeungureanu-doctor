<?php
/**
 * Plugin Name:  GU Design System
 * Plugin URI:   https://georgeungureanu.doctor
 * Description:  Loads the approved Direction B+ (Warm Academic Medicine) design system for georgeungureanu.doctor. Enqueues Google Fonts (Lora + Inter), CSS custom properties (color, typography, spacing, layout, motion tokens), and utility classes. Safe to activate/deactivate — removes everything on deactivation. Does not modify Elementor database settings, does not create pages or templates, and does not depend on Elementor Pro APIs.
 * Version:      1.3.0
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

define( 'GU_DESIGN_SYSTEM_VERSION', '1.3.0' );
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
	$icon = '<svg width="40" height="40" viewBox="0 0 24 24" fill="none"'
		. ' stroke="#4D7A70" stroke-width="1.5" stroke-linecap="round"'
		. ' stroke-linejoin="round" aria-hidden="true">'
		. '<circle cx="12" cy="12" r="10"/>'
		. '<polyline points="12 6 12 12 16 14"/>'
		. '</svg>';
	return '<div class="gu-archive-empty-state">'
		. $icon
		. '<h3 class="gu-archive-empty-state__heading">Conținut în curs de actualizare</h3>'
		. '<p class="gu-archive-empty-state__text">Noi resurse pentru pacienți vor fi adăugate periodic. Urmăriți această secțiune.</p>'
		. '<a class="gu-btn gu-btn--accent gu-btn--sm"'
		. ' href="' . esc_url( home_url( '/programari/' ) ) . '">Programează o consultație</a>'
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
		$out    .= '<article style="background:#FDFBF7;border:1px solid #D6CFC4;border-radius:8px;padding:28px;">';
		$out    .= '<h3 style="font-family:Lora,serif;font-size:20px;font-weight:700;margin:0 0 10px;"><a href="' . esc_url( get_permalink() ) . '" style="color:#231E1A;text-decoration:none;">' . esc_html( get_the_title() ) . '</a></h3>';
		$out    .= '<p style="font-family:Inter,system-ui,sans-serif;font-size:15px;color:#5A5550;margin:0 0 14px;">' . esc_html( wp_trim_words( $summary, 20 ) ) . '</p>';
		$out    .= '<a href="' . esc_url( get_permalink() ) . '" style="font-size:14px;font-weight:600;color:#4D7A70;text-decoration:none;">Citește mai mult →</a>';
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
		$out    .= '<article style="background:#FDFBF7;border:1px solid #D6CFC4;border-radius:8px;padding:28px;">';
		$out    .= '<h3 style="font-family:Lora,serif;font-size:20px;font-weight:700;margin:0 0 10px;"><a href="' . esc_url( get_permalink() ) . '" style="color:#231E1A;text-decoration:none;">' . esc_html( get_the_title() ) . '</a></h3>';
		$out    .= '<p style="font-family:Inter,system-ui,sans-serif;font-size:15px;color:#5A5550;margin:0 0 14px;">' . esc_html( wp_trim_words( $summary, 20 ) ) . '</p>';
		$out    .= '<a href="' . esc_url( get_permalink() ) . '" style="font-size:14px;font-weight:600;color:#4D7A70;text-decoration:none;">Detalii intervenție →</a>';
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
		return '<p style="font-family:Inter,sans-serif;color:#5A4E47;">Nu există articole publicate.</p>';
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
	$cred     = get_field( 'author_credentials' )  ?: 'MD, Neurochirurg';
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
			'name'     => 'Dr. George Ungureanu',
			'jobTitle' => 'Neurochirurg',
			'url'      => $home_url . 'despre/',
			'worksFor' => [
				'@type' => 'MedicalOrganization',
				'name'  => 'Cabinet Neurochirurgie Dr. George Ungureanu',
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
	$title       = (string) get_field( 'author_credentials' )  ?: 'MD, Neurochirurg';
	$bio         = (string) get_field( 'author_bio_short' );
	$review_raw  = (string) get_field( 'medical_review_date' );
	$review_str  = $review_raw ? date_i18n( 'd F Y', strtotime( $review_raw ) ) : '';
	$about_url   = home_url( '/despre/' );

	$out  = '<div class="gu-author-block">';
	$out .= '<div class="gu-author-block__avatar" aria-hidden="true">';
	// SVG silhouette placeholder — replaced when photography is available
	$out .= '<svg viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg" width="80" height="80"><circle cx="40" cy="40" r="40" fill="#C8C0B8"/><circle cx="40" cy="30" r="14" fill="#FDFBF7"/><ellipse cx="40" cy="72" rx="24" ry="18" fill="#FDFBF7"/></svg>';
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

// ── 10c. Physician schema — full enriched node on /despre/ ────

add_action( 'wp_head', function () {
	if ( ! is_page( 'despre' ) ) { return; }
	$home_url  = trailingslashit( home_url() );
	$about_url = $home_url . 'despre/';
	$phys_id   = $about_url . '#physician';
	$years     = (int) gu_get_about_field( 'about_years_experience' );
	$hospital  = gu_get_about_field( 'about_hospital' );
	$lang_raw  = gu_get_about_field( 'about_languages' ) ?: 'Română';
	$languages = array_values( array_filter( array_map( 'trim', explode( ',', $lang_raw ) ) ) );

	$desc_parts = [ 'Dr. George Ungureanu este medic primar neurochirurg' ];
	if ( $years > 0 ) { $desc_parts[] = "cu {$years}+ ani de experiență clinică"; }
	$desc_parts[] = 'în neurochirurgie spinală și craniană.';

	$physician = [
		'@type'         => 'Physician',
		'@id'           => $phys_id,
		'name'          => 'Dr. George Ungureanu',
		'jobTitle'      => 'Medic primar neurochirurg',
		'url'           => $about_url,
		'description'   => implode( ' ', $desc_parts ),
		'knowsAbout'    => [ 'Neurosurgery', 'Spine Surgery', 'Brain Surgery', 'Minimally Invasive Neurosurgery' ],
		'knowsLanguage' => $languages,
		'worksFor'      => [
			'@type' => 'MedicalOrganization',
			'@id'   => $home_url . '#practice',
			'name'  => $hospital ?: 'Cabinet Neurochirurgie Dr. George Ungureanu',
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
				[ '@type' => 'ListItem', 'position' => 2, 'name' => 'Despre Dr. George Ungureanu' ],
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
	$tagline  = gu_get_about_field( 'about_tagline' ) ?: '[CLIENT: Tagline de completat]';
	$years    = (int) gu_get_about_field( 'about_years_experience' );
	$hospital = gu_get_about_field( 'about_hospital' ) ?: '[CLIENT: Spital / Cabinet]';

	$pid       = gu_get_about_page_id();
	$photo_arr = ( $pid && function_exists( 'get_field' ) ) ? get_field( 'about_photo', $pid ) : null;
	if ( is_array( $photo_arr ) && ! empty( $photo_arr['url'] ) ) {
		$photo_html = '<img src="' . esc_url( $photo_arr['url'] ) . '"'
			. ' alt="Dr. George Ungureanu - Medic primar neurochirurg"'
			. ' class="gu-about-hero__photo" width="440" height="540" loading="eager">';
	} else {
		$photo_html  = '<div class="gu-about-hero__photo-placeholder" role="img"'
			. ' aria-label="[CLIENT: PORTRET PROFESIONAL NECESAR]">';
		$photo_html .= '<svg viewBox="0 0 440 540" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">'
			. '<rect width="440" height="540" fill="#C8C0B8"/>'
			. '<circle cx="220" cy="185" r="82" fill="#FDFBF7"/>'
			. '<ellipse cx="220" cy="490" rx="148" ry="120" fill="#FDFBF7"/>'
			. '<text x="220" y="345" font-family="Georgia,serif" font-size="11" fill="#6B5E57"'
			. ' text-anchor="middle">[CLIENT: PORTRET</text>'
			. '<text x="220" y="362" font-family="Georgia,serif" font-size="11" fill="#6B5E57"'
			. ' text-anchor="middle">PROFESIONAL NECESAR]</text>'
			. '</svg>'
			. '</div>';
	}

	$years_label = $years > 0 ? ( $years . '+ ani experiență' ) : '[CLIENT: ani experiență]';

	$out  = '<div id="physician" class="gu-about-hero">';
	$out .= '<div class="gu-about-hero__photo-wrap">' . $photo_html . '</div>';
	$out .= '<div class="gu-about-hero__content">';
	$out .= '<h1 class="gu-about-hero__name">Dr. George Ungureanu</h1>';
	$out .= '<p class="gu-about-hero__title">Medic primar neurochirurg</p>';
	$out .= '<p class="gu-about-hero__tagline">' . esc_html( $tagline ) . '</p>';
	$out .= '<ul class="gu-about-hero__badges" aria-label="Informații cheie">';
	$out .= '<li class="gu-about-hero__badge">' . esc_html( $years_label ) . '</li>';
	$out .= '<li class="gu-about-hero__badge">Coloana vertebrală &amp; creier</li>';
	$out .= '<li class="gu-about-hero__badge">' . esc_html( $hospital ) . '</li>';
	$out .= '</ul>';
	$out .= '<a class="gu-btn gu-btn--accent" href="' . esc_url( home_url( '/programari/' ) ) . '">Programează o consultație</a>';
	$out .= '</div></div>';
	return $out;
} );

// Credentials strip — 3-4 scannable facts.
add_shortcode( 'gu_about_credentials_strip', function () {
	$years    = (int) gu_get_about_field( 'about_years_experience' );
	$hospital = gu_get_about_field( 'about_hospital' ) ?: '[CLIENT: Spital]';
	$langs    = gu_get_about_field( 'about_languages' ) ?: 'Română';
	$y_val    = $years > 0 ? ( $years . '+' ) : '[X]+';
	$out  = '<div class="gu-credentials-strip" role="list">';
	$out .= '<div class="gu-credentials-strip__item" role="listitem">'
		. '<span class="gu-credentials-strip__value">' . esc_html( $y_val ) . '</span>'
		. '<span class="gu-credentials-strip__label">ani de experiență clinică</span></div>';
	$out .= '<div class="gu-credentials-strip__item" role="listitem">'
		. '<span class="gu-credentials-strip__value">Neurochirurg</span>'
		. '<span class="gu-credentials-strip__label">medic primar specialist</span></div>';
	$out .= '<div class="gu-credentials-strip__item" role="listitem">'
		. '<span class="gu-credentials-strip__value">' . esc_html( $hospital ) . '</span>'
		. '<span class="gu-credentials-strip__label">afiliere clinică</span></div>';
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
	if ( empty( trim( strip_tags( $bio ) ) ) ) { return ''; }
	return '<h2 class="gu-about-section-heading">Cine este Dr. George Ungureanu</h2>'
		. '<div class="gu-about-bio">' . wp_kses_post( $bio ) . '</div>';
} );

// Philosophy of care — rendered inside dark section.
add_shortcode( 'gu_about_philosophy', function () {
	$phil = gu_get_about_field( 'about_philosophy' );
	if ( empty( trim( strip_tags( $phil ) ) ) ) { return ''; }
	return '<div class="gu-about-philosophy">'
		. '<h2 class="gu-about-section-heading gu-about-section-heading--light">Filosofia mea de practică</h2>'
		. '<div class="gu-about-philosophy__content">' . wp_kses_post( $phil ) . '</div>'
		. '</div>';
} );

// Education & Training.
add_shortcode( 'gu_about_education', function () {
	$edu = gu_get_about_field( 'about_education' );
	if ( empty( trim( strip_tags( $edu ) ) ) ) { return ''; }
	return '<h2 class="gu-about-section-heading">Educație &amp; Formare</h2>'
		. '<div class="gu-about-education">' . wp_kses_post( $edu ) . '</div>';
} );

// Clinical Experience.
add_shortcode( 'gu_about_experience', function () {
	$exp = gu_get_about_field( 'about_experience' );
	if ( empty( trim( strip_tags( $exp ) ) ) ) { return ''; }
	return '<h2 class="gu-about-section-heading">Experiență Clinică</h2>'
		. '<div class="gu-about-experience">' . wp_kses_post( $exp ) . '</div>';
} );

// Special Interests — links to conditions/procedures.
add_shortcode( 'gu_about_interests', function () {
	$content = gu_get_about_field( 'about_interests' );
	$out     = '<h2 class="gu-about-section-heading">Domenii de Interes Special</h2>';
	if ( ! empty( trim( strip_tags( $content ) ) ) ) {
		return $out . '<div class="gu-about-interests">' . wp_kses_post( $content ) . '</div>';
	}
	$items = [
		[ 'Chirurgie minim invaziva a coloanei', 'Microdiscectomie, laminectomie si proceduri endoscopice lombare si cervicale.', '/interventii/microdiscectomie-lombara/' ],
		[ 'Patologie discala lombara', 'Hernie de disc, stenoza de canal spinal si instabilitate vertebrala lombara.', '/afectiuni/hernie-de-disc-lombara/' ],
		[ 'Neurochirurgie craniana', '[CLIENT: Descriere domeniu de completat dupa revizuire.]', '/afectiuni/' ],
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
	if ( empty( trim( strip_tags( $content ) ) ) ) { return ''; }
	return '<div class="gu-about-conditional gu-about-conditional--warm">'
		. '<div class="gu-about-conditional__inner">'
		. '<h2 class="gu-about-section-heading">Cercetare &amp; Publicații</h2>'
		. '<div class="gu-about-research">' . wp_kses_post( $content ) . '</div>'
		. '</div></div>';
} );

// Teaching & Academic.
add_shortcode( 'gu_about_teaching', function () {
	$content = gu_get_about_field( 'about_teaching' );
	if ( empty( trim( strip_tags( $content ) ) ) ) { return ''; }
	return '<h2 class="gu-about-section-heading">Activitate Didactică</h2>'
		. '<div class="gu-about-teaching">' . wp_kses_post( $content ) . '</div>';
} );

// Professional Memberships.
add_shortcode( 'gu_about_memberships', function () {
	$content = gu_get_about_field( 'about_memberships' );
	if ( empty( trim( strip_tags( $content ) ) ) ) { return ''; }
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
	return '<div class="gu-about-cta">'
		. '<h2 class="gu-about-cta__heading">Vorbiți cu Dr. George Ungureanu</h2>'
		. '<p class="gu-about-cta__text">O consultație vă oferă o evaluare individualizată a simptomelor dumneavoastră și o discuție deschisă despre toate opțiunile de tratament disponibile.</p>'
		. '<a class="gu-btn gu-btn--light" href="' . esc_url( home_url( '/programari/' ) ) . '">Programează o consultație</a>'
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
	$nav_items = [
		'Acasă'                    => home_url( '/' ),
		'Afecțiuni'                => home_url( '/afectiuni/' ),
		'Intervenții'              => home_url( '/interventii/' ),
		'Sfatul Neurochirurgului'  => home_url( '/articole/' ),
		'Recomandări'              => home_url( '/recomandari/' ),
		'Despre'                   => home_url( '/despre/' ),
	];
	$cta_url = home_url( '/programari/' );
	?>
	<header class="gu-header" id="gu-header" role="banner">
		<div class="gu-header__inner">

			<a class="gu-header__logo"
			   href="<?php echo esc_url( home_url( '/' ) ); ?>"
			   aria-label="Dr. George Ungureanu — Pagina principală">
				<span class="gu-header__logo-name">Dr. George Ungureanu</span>
				<span class="gu-header__logo-title">Neurochirurg</span>
			</a>

			<nav class="gu-header__nav" aria-label="Navigare principală">
				<ul class="gu-header__nav-list" role="list">
					<?php foreach ( $nav_items as $label => $url ) : ?>
					<li class="gu-header__nav-item">
						<a class="gu-header__nav-link<?php echo gu_nav_is_active( $url ) ? ' is-active' : ''; ?>"
						   href="<?php echo esc_url( $url ); ?>">
							<?php echo esc_html( $label ); ?>
						</a>
					</li>
					<?php endforeach; ?>
				</ul>
			</nav>

			<div class="gu-header__actions">
				<a class="gu-btn gu-btn--accent gu-header__cta"
				   href="<?php echo esc_url( $cta_url ); ?>">
					Programează o consultație
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
					<?php foreach ( $nav_items as $label => $url ) : ?>
					<li>
						<a class="gu-mobile-drawer__link"
						   href="<?php echo esc_url( $url ); ?>">
							<?php echo esc_html( $label ); ?>
						</a>
					</li>
					<?php endforeach; ?>
				</ul>
			</nav>

			<a class="gu-btn gu-btn--accent gu-mobile-drawer__cta"
			   href="<?php echo esc_url( $cta_url ); ?>">
				Programează o consultație
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

	// ── Shared inline style strings ──────────────────────────
	$s_section_white  = 'background:#FFFFFF;border-bottom:1px solid rgba(0,0,0,.06);';
	$s_section_canvas = 'background:#F5F5F7;border-bottom:1px solid rgba(0,0,0,.06);';
	$s_inner_wide     = 'max-width:900px;margin:0 auto;padding:96px 32px;';
	$s_inner_narrow   = 'max-width:720px;margin:0 auto;padding:96px 32px;';
	$s_inner_narrow_c = 'max-width:720px;margin:0 auto;padding:96px 32px;text-align:center;';
	$s_overline       = 'font:600 11px/1 Inter,system-ui,sans-serif;letter-spacing:.1em;text-transform:uppercase;color:#3D6B5E;margin:0 0 14px;';
	$s_h1             = 'font:700 clamp(42px,4.8vw,64px)/1.1 Lora,Georgia,serif;color:#1D1D1F;letter-spacing:-.025em;margin:0 0 20px;';
	$s_h2             = 'font:700 clamp(28px,3vw,42px)/1.15 Lora,Georgia,serif;color:#1D1D1F;letter-spacing:-.02em;margin:0 0 16px;';
	$s_lead           = 'font:400 20px/1.7 Inter,system-ui,sans-serif;color:#6E6E73;max-width:600px;margin:0 0 32px;';
	$s_body           = 'font:400 17px/1.75 Inter,system-ui,sans-serif;color:#424245;margin:0 0 20px;';
	$s_note           = 'font:400 14px/1.6 Inter,system-ui,sans-serif;color:#6E6E73;border-left:3px solid #3D6B5E;padding-left:14px;margin:32px 0 0;';
	$s_client_box     = 'background:#FBFBFD;border:1px dashed rgba(61,107,94,.35);border-radius:10px;padding:28px 32px;margin:32px 0 0;font:400 15px/1.65 Inter,system-ui,sans-serif;color:#6E6E73;';
	$s_city_badge     = 'display:inline-block;background:rgba(61,107,94,.1);color:#3D6B5E;font:600 12px/1 Inter,system-ui,sans-serif;padding:6px 14px;border-radius:100px;letter-spacing:.04em;';
	$s_btn_sage       = 'display:inline-block;background:#3D6B5E;color:#FFFFFF;font:600 16px/1 Inter,system-ui,sans-serif;padding:16px 36px;border-radius:8px;text-decoration:none;';
	$s_btn_sage_sm    = 'display:inline-block;background:#3D6B5E;color:#FFFFFF;font:600 14px/1 Inter,system-ui,sans-serif;padding:12px 22px;border-radius:8px;text-decoration:none;';
	$s_btn_outline_sm = 'display:inline-block;background:transparent;color:#3D6B5E;border:1.5px solid #3D6B5E;font:600 14px/1 Inter,system-ui,sans-serif;padding:11px 22px;border-radius:8px;text-decoration:none;';

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
	$out .= '</div>';
	$out .= '</div>';
	$out .= '</section>';

	// ──────────────────────────────────────────────────────
	// SECTION 2 — CLINIC CARDS
	// ──────────────────────────────────────────────────────
	$out .= '<section id="clinici" style="' . $s_section_canvas . '">';
	$out .= '<div style="' . $s_inner_wide . '">';
	$out .= '<p style="' . $s_overline . '">Locații</p>';
	$out .= '<h2 style="' . $s_h2 . '">Unde consultă Dr. George Ungureanu</h2>';
	$out .= '<p style="' . $s_lead . '">Consultații disponibile în două locații, cu programare directă la fiecare clinică.</p>';

	$clinics = [
		[
			'city'        => 'Cluj-Napoca',
			'name'        => '[CLIENT: Denumire clinică / spital]',
			'description' => '[CLIENT: Scurtă descriere a clinicii și tipul de consultații disponibile la această locație — ex: Consultații neurochirurgicale în regim privat, luni–vineri]',
			'booking_url' => '#',
			'map_url'     => '#',
		],
		[
			'city'        => 'Baia Mare',
			'name'        => '[CLIENT: Denumire clinică / spital]',
			'description' => '[CLIENT: Scurtă descriere a clinicii și tipul de consultații disponibile la această locație — ex: Consultații neurochirurgicale, program la cerere]',
			'booking_url' => '#',
			'map_url'     => '#',
		],
	];

	$out .= '<div class="gu-clinic-grid">';
	foreach ( $clinics as $clinic ) {
		$out .= '<div class="gu-clinic-card">';

		// Photo placeholder
		$out .= '<div class="gu-clinic-card__photo">';
		$out .= '<span>Fotografie clinică — în curând</span>';
		$out .= '</div>';

		// Card body
		$out .= '<div class="gu-clinic-card__body">';
		$out .= '<span class="gu-clinic-card__city">' . esc_html( $clinic['city'] ) . '</span>';
		$out .= '<h3 class="gu-clinic-card__name">' . esc_html( $clinic['name'] ) . '</h3>';
		$out .= '<p class="gu-clinic-card__desc">' . esc_html( $clinic['description'] ) . '</p>';
		$out .= '<div class="gu-clinic-card__actions">';
		$out .= '<a href="' . esc_url( $clinic['map_url'] ) . '" style="' . $s_btn_outline_sm . '">[CLIENT: Hartă →]</a>';
		$out .= '<a href="' . esc_url( $clinic['booking_url'] ) . '" style="' . $s_btn_sage_sm . '">[CLIENT: Programează]</a>';
		$out .= '</div>';
		$out .= '</div>'; // .gu-clinic-card__body

		$out .= '</div>'; // .gu-clinic-card
	}
	$out .= '</div>'; // .gu-clinic-grid

	$out .= '</div>';
	$out .= '</section>';

	// ──────────────────────────────────────────────────────
	// SECTION 3 — ONLINE CONSULTATION
	// ──────────────────────────────────────────────────────
	$out .= '<section style="' . $s_section_white . '">';
	$out .= '<div style="' . $s_inner_wide . '">';
	$out .= '<p style="' . $s_overline . '">La Distanță</p>';
	$out .= '<h2 style="' . $s_h2 . '">Consultație Online</h2>';
	$out .= '<p style="' . $s_body . '">O consultație online permite evaluarea simptomelor, revizuirea investigațiilor imagistice existente și orientarea pacientului — fără deplasare. Este indicată mai ales pentru a doua opinie sau pentru evaluarea preliminară.</p>';
	$out .= '<p style="' . $s_body . '">Consultația online nu înlocuiește examinarea clinică directă atunci când aceasta este necesară.</p>';

	$out .= '<div style="' . $s_client_box . '">';
	$out .= '<strong style="color:#3D6B5E;">[CLIENT: DETALII CONSULTAȚIE ONLINE NECESARE]</strong><br><br>';
	$out .= 'Vă rugăm să confirmați:<br>';
	$out .= '<ul style="margin:10px 0 0 20px;line-height:2;">';
	$out .= '<li>Dacă oferiți consultații online și prin ce platformă (Zoom, Teams, alt sistem)</li>';
	$out .= '<li>Tariful pentru consultația online</li>';
	$out .= '<li>Modalitatea de programare online (link direct, email, telefon)</li>';
	$out .= '<li>Ce materiale trebuie trimise înainte de consultație</li>';
	$out .= '</ul>';
	$out .= '</div>';

	$out .= '</div>';
	$out .= '</section>';

	// ──────────────────────────────────────────────────────
	// SECTION 4 — WHAT TO BRING
	// ──────────────────────────────────────────────────────
	$out .= '<section style="' . $s_section_canvas . '">';
	$out .= '<div style="' . $s_inner_wide . '">';
	$out .= '<h2 style="' . $s_h2 . '">Ce să aduceți la consultație</h2>';

	$checklist = [
		'RMN sau CT — pe CD, film sau în format digital (dacă ați efectuat)',
		'Bilet de trimitere de la medicul de familie sau specialist (opțional)',
		'Lista medicamentelor curente (denumire, doze)',
		'Rezultate analize recente (dacă sunt disponibile)',
		'Buletin sau carte de identitate',
	];

	$out .= '<ul class="gu-checklist">';
	foreach ( $checklist as $item ) {
		$out .= '<li>' . esc_html( $item ) . '</li>';
	}
	$out .= '</ul>';

	$out .= '<p style="' . $s_note . '"><strong>Nu aveți toate documentele?</strong> Veniți oricum — consultația inițială se bazează pe evaluarea simptomelor, nu neapărat pe investigații. Le puteți efectua ulterior dacă este necesar.</p>';

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
			'q' => 'Am nevoie de o trimitere de la medicul de familie?',
			'a' => 'Nu este obligatorie. Puteți programa o consultație direct, fără trimitere. Dacă aveți bilet de trimitere, aduceți-l — ajută la documentare. Dacă nu, evaluarea se poate face pe baza simptomelor și a investigațiilor existente.',
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
			'a' => 'Dacă nu puteți ajunge la programare, vă rugăm să ne anunțați cu cel puțin 24 de ore înainte, telefonic sau prin email. Reprogramarea se face fără costuri suplimentare.',
		],
		[
			'q' => 'Voi fi presat să aleg operația?',
			'a' => 'Nu. Scopul consultației este să înțelegeți complet situația și să aveți toate informațiile necesare pentru a lua o decizie. Chirurgia este recomandată doar când beneficiile depășesc clar riscurile și când opțiunile conservative au fost epuizate sau nu sunt aplicabile.',
		],
		[
			'q' => 'Cât costă o consultație? Este decontată de CNAS?',
			'a' => '[CLIENT: Informații tarif consultație și decontare CNAS — ex: Consultația inițială costă X lei. Decontarea CNAS este disponibilă / nu este disponibilă deoarece...]',
		],
		[
			'q' => 'Consultați și pacienți din alte țări?',
			'a' => '[CLIENT: Confirmare dacă se acceptă pacienți internaționali și detalii specifice — ex: Consultez și pacienți din Republica Moldova, diaspora românească și pacienți internaționali. Consultația se poate organiza online sau la una dintre clinicile partenere.]',
		],
	];

	$out .= '<div class="gu-faq">';
	foreach ( $faqs as $i => $item ) {
		$out .= '<details class="gu-faq__item"' . ( 0 === $i ? ' open' : '' ) . '>';
		$out .= '<summary class="gu-faq__question">' . esc_html( $item['q'] ) . '</summary>';
		$out .= '<div class="gu-faq__answer"><p>' . esc_html( $item['a'] ) . '</p></div>';
		$out .= '</details>';
	}
	$out .= '</div>';

	$out .= '<p style="' . $s_note . '">Aveți o altă întrebare? Scrieți-ne la <a href="mailto:[CLIENT: email]" style="color:#3D6B5E;">[CLIENT: email contact]</a></p>';

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
	$out .= '<a href="#" style="' . $s_btn_outline_sm . '">[CLIENT: +40 7XX XXX XXX]</a>';
	$out .= '</div>';
	$out .= '<p style="margin-top:20px;font:400 14px/1.6 Inter,system-ui,sans-serif;color:#86868B;">Sau scrieți la <a href="mailto:[CLIENT: email]" style="color:#3D6B5E;">[CLIENT: email contact]</a></p>';
	$out .= '</div>';
	$out .= '</section>';

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

	$programari_url = esc_url( home_url( '/programari/' ) );

	// ── Shared inline style strings ───────────────────────────
	$s_section_white  = 'background:#FFFFFF;border-bottom:1px solid rgba(0,0,0,.06);';
	$s_section_canvas = 'background:#F5F5F7;border-bottom:1px solid rgba(0,0,0,.06);';
	$s_inner_wide     = 'max-width:900px;margin:0 auto;padding:96px 32px;';
	$s_inner_narrow   = 'max-width:720px;margin:0 auto;padding:96px 32px;text-align:center;';
	$s_overline       = 'font:600 11px/1 Inter,system-ui,sans-serif;letter-spacing:.1em;text-transform:uppercase;color:#3D6B5E;margin:0 0 14px;';
	$s_h1             = 'font:700 clamp(42px,4.8vw,64px)/1.1 Lora,Georgia,serif;color:#1D1D1F;letter-spacing:-.025em;margin:0 0 20px;';
	$s_h2             = 'font:700 clamp(28px,3vw,42px)/1.15 Lora,Georgia,serif;color:#1D1D1F;letter-spacing:-.02em;margin:0 0 16px;';
	$s_lead           = 'font:400 20px/1.7 Inter,system-ui,sans-serif;color:#6E6E73;max-width:600px;margin:0 0 32px;';
	$s_lead_center    = $s_lead . 'margin-left:auto;margin-right:auto;';
	$s_body           = 'font:400 17px/1.75 Inter,system-ui,sans-serif;color:#424245;margin:0 0 20px;';
	$s_note           = 'font:400 14px/1.6 Inter,system-ui,sans-serif;color:#6E6E73;border-left:3px solid #3D6B5E;padding-left:14px;margin:32px 0 0;';
	$s_client_box     = 'background:#FBFBFD;border:1px dashed rgba(61,107,94,.35);border-radius:10px;padding:28px 32px;margin:32px 0 0;font:400 15px/1.65 Inter,system-ui,sans-serif;color:#6E6E73;';
	$s_card_grid      = 'display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:20px;margin-top:36px;';
	$s_card           = 'background:#FFFFFF;border-radius:12px;padding:28px 28px 24px;box-shadow:0 1px 4px rgba(0,0,0,.06),0 0 0 1px rgba(0,0,0,.04);';
	$s_card_role      = 'font:500 13px/1.4 Inter,system-ui,sans-serif;color:#3D6B5E;letter-spacing:.04em;margin:0 0 6px;text-transform:uppercase;font-size:12px;';
	$s_card_name      = 'font:700 18px/1.3 Lora,Georgia,serif;color:#1D1D1F;margin:0 0 4px;';
	$s_card_inst      = 'font:400 14px/1.5 Inter,system-ui,sans-serif;color:#6E6E73;margin:0 0 14px;';
	$s_card_body      = 'font:400 15px/1.7 Inter,system-ui,sans-serif;color:#424245;margin:0;';
	$s_btn_ink        = 'display:inline-block;background:#1D1D1F;color:#FFFFFF;font:600 16px/1 Inter,system-ui,sans-serif;padding:16px 36px;border-radius:8px;text-decoration:none;transition:background 200ms;';
	$s_btn_sage       = 'display:inline-block;background:#3D6B5E;color:#FFFFFF;font:600 16px/1 Inter,system-ui,sans-serif;padding:16px 36px;border-radius:8px;text-decoration:none;margin-top:8px;';

	$out = '';

	// ────────────────────────────────────────────────────────
	// HERO
	// ────────────────────────────────────────────────────────
	$out .= '<section style="' . $s_section_white . 'padding-bottom:0;">';
	$out .= '<div style="' . $s_inner_narrow . 'padding-top:80px;padding-bottom:80px;">';
	$out .= '<p style="' . $s_overline . '">Trust &amp; Validare Profesională</p>';
	$out .= '<h1 style="' . $s_h1 . '">Recomandări</h1>';
	$out .= '<p style="' . $s_lead_center . '">Parteneri medicali și pacienți despre experiența cu Dr. George Ungureanu — fără stele artificiale, fără scoruri.</p>';
	$out .= '<a href="' . $programari_url . '" style="' . $s_btn_ink . '">Programează o consultație</a>';
	$out .= '</div>';
	$out .= '</section>';

	// ────────────────────────────────────────────────────────
	// SECTION 1 — COLLEAGUE DOCTOR RECOMMENDATIONS
	// ────────────────────────────────────────────────────────
	$out .= '<section style="' . $s_section_canvas . '">';
	$out .= '<div style="' . $s_inner_wide . '">';
	$out .= '<p style="' . $s_overline . '">Colegi medici</p>';
	$out .= '<h2 style="' . $s_h2 . '">Recomandări din partea colegilor medici</h2>';
	$out .= '<p style="' . $s_body . '">O trimitere din partea unui coleg înseamnă că acel medic încredințează proprii pacienți îngrijirilor Dr. George Ungureanu. Este cel mai direct semnal de validare profesională pe care îl poate oferi un medic specialist.</p>';

	// Three placeholder colleague cards
	$colleague_cards = [
		[ 'Specialist neurolog', '[CLIENT: Prenume Nume]', '[CLIENT: Spital / Clinică]' ],
		[ 'Medic ortoped', '[CLIENT: Prenume Nume]', '[CLIENT: Spital / Clinică]' ],
		[ 'Medic de familie / internist', '[CLIENT: Prenume Nume]', '[CLIENT: Spital / Clinică]' ],
	];
	$out .= '<div style="' . $s_card_grid . '">';
	foreach ( $colleague_cards as [ $role, $name, $institution ] ) {
		$out .= '<div style="' . $s_card . '">';
		$out .= '<p style="' . $s_card_role . '">' . esc_html( $role ) . '</p>';
		$out .= '<p style="' . $s_card_name . '">' . esc_html( $name ) . '</p>';
		$out .= '<p style="' . $s_card_inst . '">' . esc_html( $institution ) . '</p>';
		$out .= '<p style="' . $s_card_body . ' font-style:italic;">'
			. '„[CLIENT: Citat agreat de colegul medic înainte de publicare.]"'
			. '</p>';
		$out .= '</div>';
	}
	$out .= '</div>';

	// Editorial note on ethics
	$out .= '<p style="' . $s_note . '">';
	$out .= 'Fiecare recomandare este publicată cu acordul scris al colegului medic. '
		. 'Nu sunt afișate recomandări nesolicitate sau generate automat.';
	$out .= '</p>';

	// Client action required
	$out .= '<div style="' . $s_client_box . '">';
	$out .= '<strong style="color:#3D6B5E;">[CLIENT: RECOMMENDATION CONTENT REQUIRED]</strong><br>';
	$out .= '<br>Pentru fiecare recomandare publicată este necesară:<br>';
	$out .= '<ul style="margin:10px 0 0 20px;line-height:2;">';
	$out .= '<li>Acordul scris al colegului medic</li>';
	$out .= '<li>Verificarea identității și specializării</li>';
	$out .= '<li>Citatul agreeat și aprobat de medic</li>';
	$out .= '<li>Afilierea instituțională actuală</li>';
	$out .= '</ul>';
	$out .= '</div>';

	$out .= '</div>';
	$out .= '</section>';

	// ────────────────────────────────────────────────────────
	// SECTION 2 — PATIENT EXPERIENCES
	// ────────────────────────────────────────────────────────
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

	// Client placeholder
	$out .= '<div style="' . $s_client_box . '">';
	$out .= '<strong style="color:#3D6B5E;">[CLIENT: PATIENT TESTIMONIAL WORKFLOW REQUIRED]</strong><br>';
	$out .= '<br>Format recomandat pentru fiecare testimonial:<br>';
	$out .= '<ul style="margin:10px 0 0 20px;line-height:2;">';
	$out .= '<li>Prenume (sau inițiale) + procedura efectuată + anul</li>';
	$out .= '<li>Relatare liberă în 2–4 propoziții, în cuvintele pacientului</li>';
	$out .= '<li>Fără: stele, scoruri, afirmații medicale sau de vindecare garantată</li>';
	$out .= '<li>Cu: acordul scris al pacientului sau anonimizare completă</li>';
	$out .= '</ul>';
	$out .= '<br>Sursă recomandată: formular intern de feedback trimis post-consultație / post-intervenție.';
	$out .= '</div>';

	$out .= '</div>';
	$out .= '</section>';

	// ────────────────────────────────────────────────────────
	// SECTION 3 — SHARE YOUR EXPERIENCE
	// ────────────────────────────────────────────────────────
	$out .= '<section style="' . $s_section_canvas . '">';
	$out .= '<div style="' . $s_inner_narrow . '">';
	$out .= '<p style="' . $s_overline . '">Contribuiți</p>';
	$out .= '<h2 style="' . $s_h2 . '">Împărtășiți experiența dumneavoastră</h2>';
	$out .= '<p style="' . $s_lead_center . '">Dacă ați primit îngrijiri de la Dr. George Ungureanu și doriți să vă împărtășiți experiența, vă invităm să ne contactați direct.</p>';

	$out .= '<div style="' . $s_client_box . 'text-align:left;">';
	$out .= '<strong style="color:#3D6B5E;">[CLIENT: PATIENT TESTIMONIAL WORKFLOW REQUIRED]</strong><br>';
	$out .= '<br>Opțiuni de implementare:<br>';
	$out .= '<ul style="margin:10px 0 0 20px;line-height:2;">';
	$out .= '<li>Formular de contact intern cu câmpuri specifice (recomandată)</li>';
	$out .= '<li>E-mail dedicat (ex. recomandari@georgeungureanu.doctor)</li>';
	$out .= '<li>Integrare Google My Business Reviews (cu moderare manuală)</li>';
	$out .= '</ul>';
	$out .= '</div>';

	$out .= '</div>';
	$out .= '</section>';

	// ────────────────────────────────────────────────────────
	// FINAL CTA
	// ────────────────────────────────────────────────────────
	$out .= '<section style="background:#F5F5F7;border-top:1px solid rgba(0,0,0,.06);">';
	$out .= '<div style="' . $s_inner_narrow . '">';
	$out .= '<h2 style="' . $s_h2 . '">Programați o consultație</h2>';
	$out .= '<p style="' . $s_lead_center . 'margin-bottom:32px;">O evaluare individualizată, fără grabă, cu un neurochirurg dedicat pacientului.</p>';
	$out .= '<a href="' . $programari_url . '" style="' . $s_btn_sage . '">Programează o consultație</a>';
	$out .= '</div>';
	$out .= '</section>';

	return $out;
} );


// ─────────────────────────────────────────────────────────────
// 14. SFATUL NEUROCHIRURGULUI HUB (/articole/) — Sprint 9.9C
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
		[ 'id' => 'prima-consultatie', 'label' => 'Prima consultatie', 'icon' => $ico_consult, 'active' => true ],
		[ 'id' => 'recuperare',        'label' => 'Recuperare',        'icon' => $ico_recover, 'active' => $has_recuperare ],
		[ 'id' => 'mituri',            'label' => 'Mituri',            'icon' => $ico_myth,    'active' => $has_mituri ],
		[ 'id' => 'video',             'label' => 'Video',             'icon' => $ico_video,   'active' => $has_video ],
		[ 'id' => 'intrebari',         'label' => 'Intrebari',         'icon' => $ico_faq,     'active' => true ],
	];

	// ── Shared style strings ──────────────────────────────────
	$s_white    = 'background:#FFFFFF;border-bottom:1px solid rgba(0,0,0,.06);';
	$s_canvas   = 'background:#F5F5F7;border-bottom:1px solid rgba(0,0,0,.06);';
	$s_wide     = 'max-width:960px;margin:0 auto;padding:80px 32px;';
	$s_narrow   = 'max-width:720px;margin:0 auto;padding:80px 32px;';
	$s_narrow_c = 'max-width:720px;margin:0 auto;padding:80px 32px;text-align:center;';
	$s_over     = 'font:600 11px/1 Inter,system-ui,sans-serif;letter-spacing:.1em;text-transform:uppercase;color:#3D6B5E;margin:0 0 14px;';
	$s_h1       = 'font:700 clamp(40px,4.5vw,60px)/1.1 Lora,Georgia,serif;color:#1D1D1F;letter-spacing:-.025em;margin:0 0 20px;';
	$s_h2       = 'font:700 clamp(26px,3vw,38px)/1.15 Lora,Georgia,serif;color:#1D1D1F;letter-spacing:-.02em;margin:0 0 12px;';
	$s_body     = 'font:400 16px/1.75 Inter,system-ui,sans-serif;color:#424245;margin:0 0 16px;';
	$s_btn_sage = 'display:inline-flex;align-items:center;gap:8px;background:#3D6B5E;color:#FFFFFF;font:600 15px/1 Inter,system-ui,sans-serif;padding:13px 26px;border-radius:8px;text-decoration:none;';
	$s_btn_out  = 'display:inline-flex;align-items:center;background:transparent;color:#3D6B5E;font:600 15px/1 Inter,system-ui,sans-serif;padding:0;border:none;text-decoration:none;gap:6px;';
	$programari_url = esc_url( home_url( '/programari/' ) );

	$out = '';

	// ════════════════════════════════════════════════════
	// HERO
	// ════════════════════════════════════════════════════
	$out .= '<section style="' . $s_white . '">';
	$out .= '<div style="' . $s_narrow . 'padding-bottom:64px;">';
	$out .= '<p style="' . $s_over . '">Educatie medicala pentru pacienti</p>';
	$out .= '<h1 style="' . $s_h1 . '">Sfatul Neurochirurgului</h1>';
	$out .= '<p style="font:400 19px/1.75 Inter,system-ui,sans-serif;color:#6E6E73;margin:0 0 32px;max-width:600px;">Ghiduri, raspunsuri si resurse medicale redactate de Dr. George Ungureanu &mdash; pentru ca un pacient informat are o recuperare mai buna.</p>';
	$out .= '<a href="' . $programari_url . '" style="' . $s_btn_sage . '">Programeaza o consultatie</a>';
	$out .= '</div>';
	$out .= '</section>';

	// ════════════════════════════════════════════════════
	// HUB NAVIGATION STRIP
	// ════════════════════════════════════════════════════
	$active_pills = array_values( array_filter( $nav_sections, fn( $s ) => $s['active'] ) );
	if ( count( $active_pills ) > 1 ) {
		$out .= '<nav class="gu-hub-nav" aria-label="Sectiuni hub">';
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
		$out .= '<a href="' . esc_url( $f_url ) . '" class="gu-hub-featured__link">Citeste articolul <svg width="16" height="16" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 10h12M12 5l5 5-5 5"/></svg></a>';
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
	$out .= '<p style="' . $s_over . '">Ghid pentru pacienti</p>';
	$out .= '<h2 style="' . $s_h2 . '">Prima Consultatie</h2>';
	$out .= '<p style="' . $s_body . 'margin-bottom:40px;">Tot ce trebuie sa stiti inainte de prima intalnire cu Dr. George Ungureanu &mdash; fara surprize, fara anxietate inutila.</p>';

	$out .= '<div class="gu-guide-grid">';

	// Block 1 — Ce sa aduceti
	$out .= '<div class="gu-guide-block">';
	$out .= '<p class="gu-guide-block__over">Pas 1</p>';
	$out .= '<h3 class="gu-guide-block__title">Ce sa aduceti</h3>';
	$bring = [
		'RMN sau CT recente, cu CD/DVD sau link digital (daca exista)',
		'Trimitere de la medicul de familie sau specialist (daca aveti)',
		'Lista medicamentelor pe care le luati in prezent',
		'Buletin de identitate si cardul de sanatate CNAS',
		'Analize de sange recente (daca ati efectuat)',
	];
	$out .= '<ul class="gu-guide-block__list">';
	foreach ( $bring as $item ) {
		$out .= '<li>' . esc_html( $item ) . '</li>';
	}
	$out .= '</ul>';
	$out .= '<p class="gu-guide-block__note">Nu aveti toate documentele? Veniti oricum. O consultatie partial documentata este mai valoroasa decat o intarziere.</p>';
	$out .= '</div>';

	// Block 2 — Cum sa va pregatiti
	$out .= '<div class="gu-guide-block">';
	$out .= '<p class="gu-guide-block__over">Pas 2</p>';
	$out .= '<h3 class="gu-guide-block__title">Cum sa va pregatiti</h3>';
	$prep = [
		'Notati simptomele: de cand au aparut, cum s-au modificat in timp',
		'Scrieti intrebarile la care doriti raspuns — nu va bazati pe memorie',
		'Aduceti un apartinator daca doriti un al doilea set de ochi si urechi',
		'Nu este necesara pregatire speciala: diete, post sau modificari de medicatie',
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
	$out .= '<h3 class="gu-guide-block__title">Ce intrebari sa puneti</h3>';
	$qs = [
		'"Ce arata exact investigatiile mele?"',
		'"Cat de urgent este cazul meu?"',
		'"Care sunt optiunile de tratament si ce implica fiecare?"',
		'"Ce se intampla daca nu tratez acum?"',
		'"Cat de des voi avea nevoie de urmarire?"',
		'"Ce sa evit si ce pot face in continuare?"',
	];
	$out .= '<ul class="gu-guide-block__list gu-guide-block__list--questions">';
	foreach ( $qs as $q ) {
		$out .= '<li>' . esc_html( $q ) . '</li>';
	}
	$out .= '</ul>';
	$out .= '</div>';

	$out .= '</div>'; // .gu-guide-grid

	$out .= '<div style="margin-top:40px;padding-top:32px;border-top:1px solid rgba(0,0,0,.06);">';
	$out .= '<a href="' . $programari_url . '" style="' . $s_btn_sage . '">Programeaza prima consultatie</a>';
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
		$out .= '<h2 style="' . $s_h2 . '">Recuperare si ingrijire</h2>';
		$out .= '<p style="' . $s_body . 'margin-bottom:36px;">Ghiduri specifice pe tip de interventie &mdash; ce sa asteptati, cand sa va ingrijorati, cum sa reveniti la viata de zi cu zi.</p>';
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
		$out .= '<p style="' . $s_over . '">Claritate medicala</p>';
		$out .= '<h2 style="' . $s_h2 . '">Mituri si adevaruri</h2>';
		$out .= '<p style="' . $s_body . 'margin-bottom:36px;">Credinte frecvente despre neurochirurgie &mdash; si ce spune medicina reala.</p>';
		$out .= '<div class="gu-myth-grid">';
		foreach ( $myths as $pair ) {
			$out .= '<div class="gu-myth-pair">';
			$out .= '<div class="gu-myth-card"><p class="gu-myth-card__label">Mit</p><p class="gu-myth-card__text">' . esc_html( $pair['myth'] ) . '</p></div>';
			$out .= '<div class="gu-truth-card"><p class="gu-truth-card__label">Adevarul</p><p class="gu-truth-card__text">' . esc_html( $pair['truth'] ) . '</p></div>';
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
		$out .= '<p style="' . $s_over . '">Dr. George explica</p>';
		$out .= '<h2 style="' . $s_h2 . '">Video</h2>';
		$out .= '<p style="' . $s_body . 'margin-bottom:36px;">Explicatii vizuale despre afectiuni, proceduri si recuperare.</p>';
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
			$out .= '<span class="gu-video-card__link">Vizualizeaza pe YouTube &nearr;</span>';
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
				  'a' => 'Neurochirurgia este specialitatea medicala care se ocupa cu diagnosticul si tratamentul chirurgical al afectiunilor sistemului nervos: creier, maduva spinarii, coloana vertebrala si nervi periferici. Neurochirurgul poate interveni atat pe afectiuni urgente (traumatisme, hemoragii) cat si pe afectiuni degenerative (hernii de disc, stenoze, tumori).' ],
				[ 'q' => 'Care este diferenta dintre neurolog si neurochirurg?',
				  'a' => 'Neurologul diagnosticheaza si trateaza afectiunile neurologice prin metode non-chirurgicale: medicatie, terapie, monitorizare. Neurochirurgul intervine chirurgical atunci cand tratamentul conservator nu este suficient sau cand exista o afectiune structurala ce necesita corectie. Cei doi specialisti colaboreaza frecvent in ingrijirea aceluiasi pacient.' ],
				[ 'q' => 'Cand ar trebui sa consult un neurochirurg?',
				  'a' => 'Consultati un neurochirurg daca aveti: dureri lombare sau cervicale care iradeaza in membre, amorteli sau slabiciune la nivelul brantelor sau picioarelor, dureri de cap persistente sau neobisnuite, probleme de echilibru sau coordonare, sau un diagnostic RMN cu afectiuni structurale ale coloanei sau creierului. O consultatie nu inseamna neaparat ca veti fi operat.' ],
				[ 'q' => 'Trebuie sa am simptome grave pentru a veni la consultatie?',
				  'a' => 'Nu. O evaluare timpurie este adesea mai valoroasa — permite un diagnostic precis inainte ca situatia sa devina mai complexa. Multi pacienti vin la prima consultatie cu simptome moderate si pleaca cu un plan de tratament conservator, fara sa fie nevoie de operatie.' ],
			],
		],
		[
			'category' => 'Prima consultatie',
			'items' => [
				[ 'q' => 'Pot veni fara trimitere?',
				  'a' => 'Da, puteti veni fara trimitere la o consultatie privata. Trimiterea poate fi necesara pentru decontarea prin CNAS, dar nu este obligatorie pentru a programa sau efectua consultatia. Detalii despre costuri si decontare la sectiunea Programari.' ],
				[ 'q' => 'Ce se intampla la prima consultatie?',
				  'a' => 'Prima consultatie include: un interviu clinic detaliat (istoricul simptomelor, medicamentele actuale, antecedente), examinare neurologica, analiza investigatiilor aduse (RMN, CT, analize) si discutarea optiunilor. Veti pleca cu un plan clar: tratament conservator, investigatii suplimentare sau recomandare de interventie.' ],
				[ 'q' => 'Cat dureaza o consultatie?',
				  'a' => 'O prima consultatie dureaza in medie 30-45 de minute. Consultatiile de urmarire (control post-op sau monitorizare) sunt de obicei mai scurte, 15-20 de minute. Este suficient timp pentru a discuta ingrijorarile dumneavoastra fara graba.' ],
			],
		],
		[
			'category' => 'Despre interventie',
			'items' => [
				[ 'q' => 'Inseamna o consultatie ca voi fi neaparat operat?',
				  'a' => 'Nu. Scopul consultatiei este evaluarea, nu vanzarea unei operatii. Multi pacienti care vin cu temeri despre o interventie posibila pleaca cu un plan de tratament conservator (kinetoterapie, medicatie, monitorizare). Decizia de operare se ia impreuna cu pacientul, pe baza beneficiilor si riscurilor clare.' ],
				[ 'q' => 'Cine decide daca am nevoie de operatie?',
				  'a' => 'Decizia finala apartine intotdeauna pacientului, dupa ce a primit toate informatiile necesare. Dr. George Ungureanu va explica indicatiile interventiei, riscurile si alternativele, astfel incat decizia sa fie informata si asumata. Nu exista presiune pentru o anumita varianta de tratament.' ],
				[ 'q' => 'Ce optiuni exista in afara operatiei?',
				  'a' => 'Tratamentul conservator poate include: kinetoterapie si exercitii specifice, fizioterapie (electrostimulare, ultrasunete, laser), medicatie (antiinflamatoare, relaxante musculare, neurotrope), infiltratii epidurale sau facetare (in anumite indicatii) si monitorizare activa cu RMN-uri periodice. Optiunile depind de diagnosticul specific.' ],
			],
		],
		[
			'category' => 'Recuperare',
			'items' => [
				[ 'q' => 'Cat dureaza recuperarea in general?',
				  'a' => 'Durata recuperarii depinde de tipul interventiei. Interventiile minim invazive pe coloana lombara permit revenirea acasa in 1-2 zile si la activitate normala in 4-6 saptamani. Interventiile mai extinse pot necesita recuperare mai lunga. Dr. George va oferi un ghid de recuperare specific dupa stabilirea planului de tratament.' ],
				[ 'q' => 'Ce simptome ar trebui sa ma ingrijoreze dupa o interventie?',
				  'a' => 'Contactati imediat clinica sau prezentati-va la urgente daca observati: febra peste 38 grade la mai mult de 48 de ore post-op, roseata sau scurgeri la nivelul plagii, dureri nou aparute sau brusc agravate, slabiciune sau amorteala nou instalata la membre, sau orice simptom care vi se pare neobisnuit fata de ce ati fost pregatit sa asteptati.' ],
				[ 'q' => 'Cand pot reveni la activitatile zilnice dupa operatie?',
				  'a' => 'Activitatile usoare (mers, activitati casnice simple) pot fi reluate de obicei in prima saptamana. Munca de birou in 2-4 saptamani. Munca fizica sau sportul la 6-12 saptamani, in functie de interventie si de evolutie. Fiecare caz este diferit; ghidurile specifice sunt discutate la externare.' ],
			],
		],
	];

	$sections_above_faq = 2 + (int) (bool) $featured + (int) $has_recuperare + (int) $has_mituri + (int) $has_video;
	$faq_bg = ( $sections_above_faq % 2 === 0 ) ? $s_white : $s_canvas;

	$out .= '<section id="intrebari" style="' . $faq_bg . '">';
	$out .= '<div style="' . $s_wide . '">';
	$out .= '<p style="' . $s_over . '">Raspunsuri clare</p>';
	$out .= '<h2 style="' . $s_h2 . '">Intrebari Frecvente</h2>';
	$out .= '<p style="' . $s_body . 'margin-bottom:40px;">Raspunsuri la cele mai comune intrebari despre neurochirurgie, consultatii si recuperare.</p>';
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
	$out .= '<p style="' . $s_over . '">Lectura aprofundata</p>';
	$out .= '<h2 style="' . $s_h2 . '">Articole</h2>';
	$out .= '<p style="' . $s_body . 'margin-bottom:8px;">Articole detaliate despre afectiuni, proceduri si viata cu o conditie neurologica.</p>';
	$out .= do_shortcode( '[gu_articole_archive]' );
	$out .= '</div>';
	$out .= '</section>';

	// ════════════════════════════════════════════════════
	// FINAL CTA
	// ════════════════════════════════════════════════════
	$out .= '<section style="background:#1D1D1F;">';
	$out .= '<div style="' . $s_narrow_c . '">';
	$out .= '<p style="font:600 11px/1 Inter,system-ui,sans-serif;letter-spacing:.1em;text-transform:uppercase;color:rgba(255,255,255,.5);margin:0 0 14px;">Pasul urmator</p>';
	$out .= '<h2 style="font:700 clamp(26px,3vw,38px)/1.15 Lora,Georgia,serif;color:#FFFFFF;letter-spacing:-.02em;margin:0 0 16px;">Pregatit pentru o evaluare?</h2>';
	$out .= '<p style="font:400 18px/1.75 Inter,system-ui,sans-serif;color:rgba(255,255,255,.65);margin:0 auto 36px;max-width:500px;">O prima consultatie va ofera claritate &mdash; indiferent de diagnostic.</p>';
	$out .= '<a href="' . $programari_url . '" style="display:inline-block;background:#3D6B5E;color:#FFFFFF;font:600 16px/1 Inter,system-ui,sans-serif;padding:16px 36px;border-radius:8px;text-decoration:none;">Programeaza o consultatie</a>';
	$out .= '</div>';
	$out .= '</section>';

	return $out;
} );
