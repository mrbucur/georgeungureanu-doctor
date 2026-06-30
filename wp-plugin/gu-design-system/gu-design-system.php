<?php
/**
 * Plugin Name:  GU Design System
 * Plugin URI:   https://georgeungureanu.doctor
 * Description:  Loads the approved Direction B+ (Warm Academic Medicine) design system for georgeungureanu.doctor. Enqueues Google Fonts (Lora + Inter), CSS custom properties (color, typography, spacing, layout, motion tokens), and utility classes. Safe to activate/deactivate — removes everything on deactivation. Does not modify Elementor database settings, does not create pages or templates, and does not depend on Elementor Pro APIs.
 * Version:      1.1.0
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

define( 'GU_DESIGN_SYSTEM_VERSION', '1.1.0' );
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
