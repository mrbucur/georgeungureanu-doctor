<?php
/**
 * Site Footer — Ungureanu MD Child
 *
 * Renders the Elementor Theme Builder "footer" location (Footer 12) when a
 * document is assigned to it for the current request. Falls back to the
 * native footer below only if elementor_theme_do_location() did not print
 * anything. wp_footer() always runs exactly once, outside the fallback.
 *
 * The plugin's wp_footer CTA (#gu-cta-rebuilt) is repositioned before the
 * native footer by functions.php priority-25 hook. Do not add another CTA
 * here.
 */

$year = gmdate( 'Y' );
$brand = gu_get_theme_setting( 'brand_name' );

$gu_footer_rendered =
	function_exists( 'elementor_theme_do_location' )
	&& elementor_theme_do_location( 'footer' );

if ( ! $gu_footer_rendered ) :
?>

<footer id="gu-site-footer" class="gu-site-footer" role="contentinfo">

	<div class="gu-site-footer__inner">

		<!-- Brand column -->
		<div class="gu-site-footer__brand">
			<p class="gu-site-footer__name"><?php echo esc_html( $brand ); ?></p>
			<p class="gu-site-footer__specialty"><?php echo esc_html( gu_get_theme_setting( 'brand_specialty' ) ); ?></p>
			<p class="gu-site-footer__desc">
				<?php echo esc_html( gu_get_theme_setting( 'footer_copy' ) ); ?>
			</p>
		</div>

		<!-- Pages column -->
		<div class="gu-site-footer__col">
			<p class="gu-site-footer__col-heading">Pagini</p>
			<ul role="list">
				<li><a href="<?php echo esc_url( home_url( '/despre/' ) ); ?>">Despre</a></li>
				<li><a href="<?php echo esc_url( home_url( '/afectiuni/' ) ); ?>">Afecțiuni</a></li>
				<li><a href="<?php echo esc_url( home_url( '/interventii/' ) ); ?>">Intervenții</a></li>
				<li><a href="<?php echo esc_url( home_url( '/recomandari/' ) ); ?>">Recomandări</a></li>
			</ul>
		</div>

		<!-- Resources column -->
		<div class="gu-site-footer__col">
			<p class="gu-site-footer__col-heading">Resurse</p>
			<ul role="list">
				<li><a href="<?php echo esc_url( home_url( '/articole/' ) ); ?>">Sfatul Neurochirurgului</a></li>
				<li><a href="<?php echo esc_url( home_url( '/programari/' ) ); ?>">Programări</a></li>
			</ul>
		</div>

	</div>

	<div class="gu-site-footer__bottom">
		<p class="gu-site-footer__copyright">
			&copy; <?php echo esc_html( $year . ' ' . $brand ); ?>. Toate drepturile rezervate.
		</p>
		<a href="<?php echo esc_url( home_url( '/politica-de-confidentialitate/' ) ); ?>"
		   class="gu-site-footer__privacy">
			Politica de confidențialitate
		</a>
	</div>

</footer>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
