<?php
/**
 * Single — Afecțiuni neurochirurgicale
 */

get_header();

if ( ! have_posts() ) {
	get_footer();
	return;
}

the_post();

$has_acf  = function_exists( 'get_field' );
$subtitle = $has_acf ? (string) get_field( 'subtitle' )      : '';
$summary  = $has_acf ? (string) get_field( 'short_summary' ) : '';

$acf_sections = [
	'symptoms'  => 'Simptome',
	'causes'    => 'Cauze',
	'diagnosis' => 'Diagnostic',
	'treatment' => 'Tratament',
	'recovery'  => 'Recuperare',
	'faq'       => 'Întrebări frecvente',
];
?>

<main class="gu-single" aria-label="<?php echo esc_attr( get_the_title() ); ?>">

	<!-- Header -->
	<div class="gu-single__header">
		<div class="gu-single__header-inner">

			<a href="<?php echo esc_url( get_post_type_archive_link( 'afectiuni' ) ); ?>"
			   class="gu-single__back">
				← Afecțiuni neurochirurgicale
			</a>

			<?php if ( $subtitle ) : ?>
			<p class="gu-single__overline"><?php echo esc_html( $subtitle ); ?></p>
			<?php endif; ?>

			<h1 class="gu-single__title"><?php the_title(); ?></h1>

			<?php if ( $summary ) : ?>
			<p class="gu-single__lead"><?php echo esc_html( $summary ); ?></p>
			<?php endif; ?>

		</div>
	</div>

	<!-- Body -->
	<div class="gu-single__body">

		<div class="gu-single__content">
			<?php
			$post_content = trim( get_the_content() );

			if ( $post_content ) {
				the_content();
			} elseif ( $has_acf ) {
				foreach ( $acf_sections as $field_name => $label ) {
					$val = get_field( $field_name );
					if ( $val ) {
						echo '<h2>' . esc_html( $label ) . '</h2>';
						echo wp_kses_post( $val );
					}
				}
			} else {
				echo '<p style="color:#6E6E73">Conținut în pregătire.</p>';
			}
			?>
		</div>

		<div class="gu-single__cta">
			<p class="gu-single__cta-text">
				Aveți simptome sau întrebări? Solicitați o consultație neurologică.
			</p>
			<a href="<?php echo esc_url( home_url( '/programari/' ) ); ?>"
			   class="gu-btn gu-btn--accent">
				Programează o consultație
			</a>
		</div>

	</div>

</main>

<?php get_footer(); ?>
