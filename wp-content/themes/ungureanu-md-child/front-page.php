<?php
/**
 * Front Page — Ungureanu MD Child
 *
 * Renders the homepage natively. Replaces Elementor homepage template.
 * The final CTA section (#gu-cta-rebuilt) is injected by the plugin via
 * wp_footer and repositioned before #gu-site-footer by functions.php.
 *
 * Sections:
 *   1. Hero
 *   2. Trust strip
 *   3. Specializations (afectiuni CPT, max 6)
 *   4. Approach
 *   [CTA — from plugin, repositioned by functions.php]
 *   Footer
 */

get_header();
?>

<!-- ═══════════════════════════════════════════════════════════
     SECTION 1 — HERO
     ═══════════════════════════════════════════════════════════ -->

<section class="gu-hero" aria-label="Introducere">
	<div class="gu-hero__inner">

		<p class="gu-hero__overline">Neurochirurgie de înaltă calitate</p>

		<h1 class="gu-hero__name">Dr. George Ungureanu</h1>

		<p class="gu-hero__specialty">Medic Specialist Neurochirurgie</p>

		<p class="gu-hero__body">
			O primă consultație oferă un diagnostic precis și un plan terapeutic
			individualizat — conservator sau chirurgical, în funcție de situația
			dumneavoastră.
		</p>

		<div class="gu-hero__actions">
			<a href="<?php echo esc_url( home_url( '/programari/' ) ); ?>"
			   class="gu-hero__btn-primary">
				Programează o consultație
			</a>
			<a href="<?php echo esc_url( home_url( '/afectiuni/' ) ); ?>"
			   class="gu-hero__btn-secondary">
				Explorează afecțiunile
			</a>
		</div>

		<p class="gu-hero__availability">
			Consultații disponibile în Cluj&#8209;Napoca, Baia Mare și online.
		</p>

	</div>
</section>

<!-- ═══════════════════════════════════════════════════════════
     SECTION 2 — TRUST STRIP
     [CLIENT: update values to match real credentials]
     ═══════════════════════════════════════════════════════════ -->

<section class="gu-trust-strip" aria-label="Credențiale">
	<div class="gu-trust-strip__inner">

		<div class="gu-trust-item">
			<span class="gu-trust-item__value">15+</span>
			<span class="gu-trust-item__label">ani de experiență în neurochirurgie</span>
		</div>

		<div class="gu-trust-item">
			<span class="gu-trust-item__value">3</span>
			<span class="gu-trust-item__label">locații de consultație</span>
		</div>

		<div class="gu-trust-item">
			<span class="gu-trust-item__value">Cluj · BM</span>
			<span class="gu-trust-item__label">și consultații online</span>
		</div>

		<div class="gu-trust-item">
			<span class="gu-trust-item__value">100%</span>
			<span class="gu-trust-item__label">abordare individualizată</span>
		</div>

	</div>
</section>

<!-- ═══════════════════════════════════════════════════════════
     SECTION 3 — SPECIALIZATIONS (afectiuni CPT)
     ═══════════════════════════════════════════════════════════ -->

<section class="gu-specializations" aria-label="Domenii de expertiză">
	<div class="gu-specializations__inner">

		<h2 class="gu-section-heading">Domenii de expertiză</h2>
		<p class="gu-section-sub">
			Afecțiuni diagnosticate și tratate prin metode moderne, minim invazive.
		</p>

		<?php
		$afectiuni = new WP_Query( [
			'post_type'      => 'afectiuni',
			'posts_per_page' => 6,
			'post_status'    => 'publish',
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
		] );

		if ( $afectiuni->have_posts() ) :
		?>
		<div class="gu-spec-grid">
			<?php while ( $afectiuni->have_posts() ) : $afectiuni->the_post(); ?>
			<a href="<?php the_permalink(); ?>" class="gu-spec-card">
				<h3 class="gu-spec-card__title"><?php the_title(); ?></h3>
				<?php if ( has_excerpt() ) : ?>
				<p class="gu-spec-card__excerpt"><?php echo wp_trim_words( get_the_excerpt(), 18 ); ?></p>
				<?php endif; ?>
				<span class="gu-spec-card__cta">Citește mai mult →</span>
			</a>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>
		<?php else : ?>
		<!-- Fallback static cards when no afectiuni posts exist yet -->
		<div class="gu-spec-grid">
			<?php
			$fallback = [
				[ 'Hernia de disc lombară',       'Compresia rădăcinilor nervoase din zona lombară — cauze, simptome și opțiuni de tratament.' ],
				[ 'Stenoza de canal vertebral',   'Îngustarea canalului rahidian cu afectarea măduvei spinării sau a rădăcinilor nervoase.' ],
				[ 'Tumorile cerebrale',           'Formațiuni intra- sau extracraniene diagnosticate și tratate multidisciplinar.' ],
				[ 'Nevralgii și compresii',       'Nevralgia de trigemen, compresia nervului sciatic și alte afecțiuni ale nervilor periferici.' ],
				[ 'Traumatisme cranio-cerebrale', 'Evaluarea și tratamentul leziunilor cerebrale post-traumatice.' ],
				[ 'Hidrocefalia',                 'Acumularea excesivă de lichid cefalorahidian — diagnostic și tratament chirurgical.' ],
			];
			foreach ( $fallback as $card ) : ?>
			<a href="<?php echo esc_url( home_url( '/afectiuni/' ) ); ?>" class="gu-spec-card">
				<h3 class="gu-spec-card__title"><?php echo esc_html( $card[0] ); ?></h3>
				<p class="gu-spec-card__excerpt"><?php echo esc_html( $card[1] ); ?></p>
				<span class="gu-spec-card__cta">Citește mai mult →</span>
			</a>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>

		<p class="gu-spec-more">
			<a href="<?php echo esc_url( home_url( '/afectiuni/' ) ); ?>">
				Vezi toate afecțiunile tratate →
			</a>
		</p>

	</div>
</section>

<!-- ═══════════════════════════════════════════════════════════
     SECTION 4 — APPROACH
     ═══════════════════════════════════════════════════════════ -->

<section class="gu-approach" aria-label="Abordarea mea">
	<div class="gu-approach__inner">

		<h2 class="gu-section-heading">Abordarea mea</h2>
		<p class="gu-approach__body">
			Fiecare pacient este unic. Planul terapeutic — conservator sau chirurgical
			— este stabilit după un diagnostic complet, ținând cont de istoricul
			medical, imagistica și obiectivele personale ale pacientului.
		</p>

		<div class="gu-approach-pillars">

			<div class="gu-approach-pillar">
				<p class="gu-approach-pillar__title">Diagnostic precis</p>
				<p class="gu-approach-pillar__text">
					Evaluare completă prin anamneză, examen clinic și interpretarea
					investigațiilor imagistice (RMN, CT).
				</p>
			</div>

			<div class="gu-approach-pillar">
				<p class="gu-approach-pillar__title">Plan individualizat</p>
				<p class="gu-approach-pillar__text">
					Decizia terapeutică se ia împreună cu pacientul, cu explicații clare
					despre opțiunile conservatoare și chirurgicale.
				</p>
			</div>

			<div class="gu-approach-pillar">
				<p class="gu-approach-pillar__title">Suport pre- și post-operator</p>
				<p class="gu-approach-pillar__text">
					Consultații de urmărire, ghid de recuperare și disponibilitate pentru
					întrebări pe parcursul tratamentului.
				</p>
			</div>

		</div>

	</div>
</section>

<!-- Plugin injects #gu-cta-rebuilt via wp_footer (priority 20).
     functions.php (priority 25) repositions it before #gu-site-footer. -->

<?php get_footer(); ?>
