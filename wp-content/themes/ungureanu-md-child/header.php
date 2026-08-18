<?php
/**
 * Site Header — Ungureanu MD Child
 *
 * Renders the Elementor Theme Builder "header" location (currently Header
 * 135) when a document is assigned to it for the current request. Falls
 * back to the native markup below only if elementor_theme_do_location()
 * did not print anything — the native markup mirrors gu_render_header()
 * exactly so gu-header.js and plugin CSS classes still apply during
 * fallback.
 *
 * The plugin's gu_render_header hook on wp_body_open is removed in
 * functions.php so it never fires as a third source of header markup.
 */

$nav_items = gu_get_navigation_items();
$cta       = gu_get_primary_cta();
$brand     = gu_get_theme_setting( 'brand_name' );
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

<?php
$gu_header_rendered =
	function_exists( 'elementor_theme_do_location' )
	&& elementor_theme_do_location( 'header' );

if ( ! $gu_header_rendered ) :
?>
<header class="gu-header" id="gu-header" role="banner">
	<div class="gu-header__inner">

		<a class="gu-header__logo"
		   href="<?php echo esc_url( home_url( '/' ) ); ?>"
		   aria-label="<?php echo esc_attr( $brand . ' — Pagina principală' ); ?>">
			<span class="gu-header__logo-name"><?php echo esc_html( $brand ); ?></span>
			<span class="gu-header__logo-title"><?php echo esc_html( gu_get_theme_setting( 'brand_short_role' ) ); ?></span>
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
<?php endif; ?>
