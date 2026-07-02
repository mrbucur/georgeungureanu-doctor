<?php
/**
 * 404 Page — Ungureanu MD Child
 * Apple Health style. No Elementor dependency.
 */

get_header();
?>

<main class="gu-404" aria-label="Pagina nu a fost găsită">
	<div class="gu-404__inner">

		<span class="gu-404__code" aria-hidden="true">404</span>

		<h1 class="gu-404__heading">Pagina nu a fost găsită</h1>

		<p class="gu-404__body">
			Pagina pe care o căutați nu există sau a fost mutată.
			Reveniți la pagina principală sau accesați secțiunea de programări.
		</p>

		<div class="gu-404__actions">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"
			   class="gu-hero__btn-primary">
				Înapoi acasă
			</a>
			<a href="<?php echo esc_url( home_url( '/programari/' ) ); ?>"
			   class="gu-hero__btn-secondary">
				Programări
			</a>
		</div>

	</div>
</main>

<?php get_footer(); ?>
