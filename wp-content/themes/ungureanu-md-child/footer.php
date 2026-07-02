<?php
/**
 * Site Footer — Ungureanu MD Child
 *
 * Native footer rendering. CSS in assets/css/theme.css (.gu-site-footer).
 *
 * The plugin's wp_footer CTA (#gu-cta-rebuilt) is repositioned before this
 * footer by functions.php priority-25 hook. Do not add another CTA here.
 */

$year = gmdate( 'Y' );
?>

<footer id="gu-site-footer" class="gu-site-footer" role="contentinfo">

	<div class="gu-site-footer__inner">

		<!-- Brand column -->
		<div class="gu-site-footer__brand">
			<p class="gu-site-footer__name">Dr. George Ungureanu</p>
			<p class="gu-site-footer__specialty">Medic Specialist Neurochirurgie</p>
			<p class="gu-site-footer__desc">
				Consultații neurochirurgicale în Cluj-Napoca, Baia Mare și online.
				Diagnostic precis, tratament individualizat — conservator sau chirurgical.
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
			&copy; <?php echo esc_html( $year ); ?> Dr. George Ungureanu. Toate drepturile rezervate.
		</p>
		<a href="<?php echo esc_url( home_url( '/confidentialitate/' ) ); ?>"
		   class="gu-site-footer__privacy">
			Politica de confidențialitate
		</a>
	</div>

</footer>

<?php wp_footer(); ?>
</body>
</html>
