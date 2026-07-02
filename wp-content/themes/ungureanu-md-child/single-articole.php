<?php
/**
 * Single — Sfatul Neurochirurgului (articole CPT)
 */

get_header();

if ( ! have_posts() ) {
	get_footer();
	return;
}

the_post();

$has_acf      = function_exists( 'get_field' );
$subtitle     = $has_acf ? (string) get_field( 'subtitle' )             : '';
$summary      = $has_acf ? (string) get_field( 'short_summary' )        : '';
$reading_min  = $has_acf ? (int)    get_field( 'reading_time' )         : 0;
$author_name  = $has_acf ? (string) get_field( 'author_display_name' )  : 'Dr. George Ungureanu';
$author_cred  = $has_acf ? (string) get_field( 'author_credentials' )   : 'MD, Neurochirurg';
$review_raw   = $has_acf ? (string) get_field( 'medical_review_date' )  : '';
$review_date  = $review_raw ? date_i18n( 'd.m.Y', strtotime( $review_raw ) ) : '';
$takeaways    = $has_acf ? get_field( 'key_takeaways' )                  : '';

if ( ! $author_name ) {
	$author_name = 'Dr. George Ungureanu';
}

// Related posts (up to 3 — post_object fields)
$related_posts = [];
if ( $has_acf ) {
	foreach ( range( 1, 3 ) as $n ) {
		$p = get_field( "related_article_{$n}" );
		if ( $p instanceof WP_Post ) {
			$related_posts[] = $p;
		}
	}
}

// FAQ pairs
$faqs = [];
if ( $has_acf ) {
	foreach ( range( 1, 5 ) as $n ) {
		$q = (string) get_field( "faq_{$n}_question" );
		$a = (string) get_field( "faq_{$n}_answer" );
		if ( $q && $a ) {
			$faqs[] = [ 'q' => $q, 'a' => $a ];
		}
	}
}
?>

<main class="gu-single" aria-label="<?php echo esc_attr( get_the_title() ); ?>">

	<!-- Header -->
	<div class="gu-single__header">
		<div class="gu-single__header-inner">

			<a href="<?php echo esc_url( get_post_type_archive_link( 'articole' ) ); ?>"
			   class="gu-single__back">
				← Sfatul Neurochirurgului
			</a>

			<?php if ( $subtitle ) : ?>
			<p class="gu-single__overline"><?php echo esc_html( $subtitle ); ?></p>
			<?php endif; ?>

			<h1 class="gu-single__title"><?php the_title(); ?></h1>

			<?php if ( $summary ) : ?>
			<p class="gu-single__lead"><?php echo esc_html( $summary ); ?></p>
			<?php endif; ?>

			<div class="gu-single__meta">
				<span class="gu-single__meta-item">
					<strong><?php echo esc_html( $author_name ); ?></strong>
					<?php if ( $author_cred ) : ?>
					&middot; <?php echo esc_html( $author_cred ); ?>
					<?php endif; ?>
				</span>
				<?php if ( $reading_min > 0 ) : ?>
				<span class="gu-single__meta-item"><?php echo $reading_min; ?> min citire</span>
				<?php endif; ?>
				<?php if ( $review_date ) : ?>
				<span class="gu-single__meta-item">Revizuit: <?php echo esc_html( $review_date ); ?></span>
				<?php endif; ?>
			</div>

		</div>
	</div>

	<!-- Body -->
	<div class="gu-single__body">

		<!-- Key Takeaways -->
		<?php if ( $takeaways ) : ?>
		<div class="gu-single__takeaways">
			<h3>Concluzii cheie</h3>
			<?php echo wp_kses_post( $takeaways ); ?>
		</div>
		<?php endif; ?>

		<!-- Main content -->
		<?php $post_content = trim( get_the_content() ); ?>
		<?php if ( $post_content ) : ?>
		<div class="gu-single__content">
			<?php the_content(); ?>
		</div>
		<?php endif; ?>

		<!-- FAQ -->
		<?php if ( ! empty( $faqs ) ) : ?>
		<div class="gu-single__content">
			<h2>Întrebări frecvente</h2>
			<?php foreach ( $faqs as $faq ) : ?>
			<details class="gu-programari-faq__item" style="margin-bottom:0">
				<summary><?php echo esc_html( $faq['q'] ); ?></summary>
				<div class="gu-programari-faq__answer">
					<?php echo wp_kses_post( wpautop( $faq['a'] ) ); ?>
				</div>
			</details>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>

		<!-- Related articles -->
		<?php if ( ! empty( $related_posts ) ) : ?>
		<div class="gu-single__related">
			<h2>Articole înrudite</h2>
			<ul class="gu-single__related-list">
				<?php foreach ( $related_posts as $rp ) : ?>
				<li>
					<a href="<?php echo esc_url( get_permalink( $rp->ID ) ); ?>">
						<?php echo esc_html( get_the_title( $rp->ID ) ); ?> →
					</a>
				</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<?php endif; ?>

		<!-- CTA -->
		<div class="gu-single__cta">
			<p class="gu-single__cta-text">
				Aveți simptome sau întrebări? Solicitați o consultație.
			</p>
			<a href="<?php echo esc_url( home_url( '/programari/' ) ); ?>"
			   class="gu-btn gu-btn--accent">
				Programează o consultație
			</a>
		</div>

	</div>

</main>

<?php get_footer(); ?>
