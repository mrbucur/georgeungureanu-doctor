<?php
/**
 * Archive — Afecțiuni neurochirurgicale
 * URL: /afectiuni/
 */

get_header();
?>

<main class="gu-archive" aria-label="Afecțiuni neurochirurgicale">

	<div class="gu-archive__header">
		<div class="gu-archive__header-inner">
			<p class="gu-archive__overline">Neurochirurgie</p>
			<h1 class="gu-archive__title">Afecțiuni neurochirurgicale</h1>
			<p class="gu-archive__desc">
				Diagnosticul și tratamentul afecțiunilor sistemului nervos central și periferic —
				de la hernia de disc la tumori cerebrale și traumatisme craniene.
			</p>
		</div>
	</div>

	<div class="gu-archive__body">

		<?php if ( have_posts() ) : ?>

		<div class="gu-archive-grid">
			<?php while ( have_posts() ) : the_post(); ?>
			<a href="<?php the_permalink(); ?>" class="gu-archive-card">
				<h2 class="gu-archive-card__title"><?php the_title(); ?></h2>
				<?php
				$summary = function_exists( 'get_field' )
					? wp_strip_all_tags( (string) get_field( 'short_summary' ) )
					: '';
				if ( ! $summary ) {
					$summary = get_the_excerpt();
				}
				if ( $summary ) :
				?>
				<p class="gu-archive-card__excerpt">
					<?php echo esc_html( wp_trim_words( $summary, 22 ) ); ?>
				</p>
				<?php endif; ?>
				<span class="gu-archive-card__cta">Citește mai mult →</span>
			</a>
			<?php endwhile; ?>
		</div>

		<div class="gu-archive__body">
			<?php
			the_posts_pagination( [
				'prev_text' => '← Anterioară',
				'next_text' => 'Următoare →',
			] );
			?>
		</div>

		<?php else : ?>

		<div class="gu-archive-empty-state">
			<svg width="48" height="48" viewBox="0 0 48 48" fill="none" aria-hidden="true">
				<circle cx="24" cy="24" r="20" stroke="#C7C7CC" stroke-width="2"/>
				<path d="M24 14v10M24 30v2" stroke="#C7C7CC" stroke-width="2.5" stroke-linecap="round"/>
			</svg>
			<p class="gu-archive-empty-state__heading">Conținut în pregătire</p>
			<p class="gu-archive-empty-state__text">
				Fișele de afecțiuni vor fi disponibile în curând. Reveniti sau programați o consultație.
			</p>
			<a href="<?php echo esc_url( home_url( '/programari/' ) ); ?>"
			   class="gu-btn gu-btn--accent gu-btn--sm">
				Programează o consultație
			</a>
		</div>

		<?php endif; ?>

	</div>

</main>

<?php get_footer(); ?>
