<?php
/**
 * Archive — Sfatul Neurochirurgului (articole CPT)
 * URL: /articole/
 */

get_header();
?>

<main class="gu-archive" aria-label="Sfatul Neurochirurgului">

	<div class="gu-archive__header">
		<div class="gu-archive__header-inner">
			<p class="gu-archive__overline">Dr. George Ungureanu</p>
			<h1 class="gu-archive__title">Sfatul Neurochirurgului</h1>
			<p class="gu-archive__desc">
				Articole medicale validate, ghiduri pentru pacienți și explicații clare despre
				afecțiunile și intervențiile neurochirurgicale.
			</p>
		</div>
	</div>

	<div class="gu-archive__body">

		<?php if ( have_posts() ) : ?>

		<div class="gu-archive-grid">
			<?php while ( have_posts() ) : the_post(); ?>
			<?php
			$has_acf     = function_exists( 'get_field' );
			$reading_min = $has_acf ? (int) get_field( 'reading_time' ) : 0;
			$summary     = $has_acf
				? wp_strip_all_tags( (string) get_field( 'short_summary' ) )
				: '';
			if ( ! $summary ) {
				$summary = get_the_excerpt();
			}
			?>
			<a href="<?php the_permalink(); ?>" class="gu-archive-card">
				<?php if ( $reading_min > 0 ) : ?>
				<p class="gu-archive-card__meta"><?php echo $reading_min; ?> min citire</p>
				<?php endif; ?>
				<h2 class="gu-archive-card__title"><?php the_title(); ?></h2>
				<?php if ( $summary ) : ?>
				<p class="gu-archive-card__excerpt">
					<?php echo esc_html( wp_trim_words( $summary, 22 ) ); ?>
				</p>
				<?php endif; ?>
				<span class="gu-archive-card__cta">Citește articolul →</span>
			</a>
			<?php endwhile; ?>
		</div>

		<?php
		the_posts_pagination( [
			'prev_text' => '← Anterioară',
			'next_text' => 'Următoare →',
		] );
		?>

		<?php else : ?>

		<div class="gu-archive-empty-state">
			<svg width="48" height="48" viewBox="0 0 48 48" fill="none" aria-hidden="true">
				<rect x="10" y="8" width="28" height="32" rx="4" stroke="#C7C7CC" stroke-width="2"/>
				<path d="M16 18h16M16 24h12M16 30h8" stroke="#C7C7CC" stroke-width="2" stroke-linecap="round"/>
			</svg>
			<p class="gu-archive-empty-state__heading">Articolele vor fi publicate în curând</p>
			<p class="gu-archive-empty-state__text">
				Ghiduri pentru pacienți, explicații despre afecțiuni și sfaturi de recuperare.
			</p>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"
			   class="gu-btn gu-btn--accent gu-btn--sm">
				Înapoi acasă
			</a>
		</div>

		<?php endif; ?>

	</div>

</main>

<?php get_footer(); ?>
