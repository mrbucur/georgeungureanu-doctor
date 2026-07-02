<?php
/**
 * Site Header — Ungureanu MD Child
 *
 * HTML structure mirrors the plugin's gu_render_header() exactly so that
 * gu-header.js (compact scroll, mobile drawer) and all plugin CSS classes
 * continue to work without modification.
 *
 * The plugin's gu_render_header hook on wp_body_open is removed in
 * functions.php so only this template renders the header.
 */

$nav_items = [
	'Acasă'                   => home_url( '/' ),
	'Afecțiuni'               => home_url( '/afectiuni/' ),
	'Intervenții'             => home_url( '/interventii/' ),
	'Sfatul Neurochirurgului' => home_url( '/articole/' ),
	'Recomandări'             => home_url( '/recomandari/' ),
	'Despre'                  => home_url( '/despre/' ),
];
$cta_url = home_url( '/programari/' );
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

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
