<?php
/**
 * Page Template — Despre
 * URL: /despre/
 *
 * [CLIENT_CONTENT] sections are marked below.
 */

get_header();
?>

<main class="gu-page-main" aria-label="Despre Dr. George Ungureanu">

	<!-- ── HERO ───────────────────────────────────────────── -->
	<div class="gu-page-hero">
		<div class="gu-page-hero__inner">
			<p class="gu-page-hero__overline">Neurochirurg specialist</p>
			<h1 class="gu-page-hero__title">Despre Dr. George Ungureanu</h1>
			<p class="gu-page-hero__sub">
				Medic specialist neurochirurgie cu experiență în diagnosticul și tratamentul
				afecțiunilor sistemului nervos central și periferic.
			</p>
		</div>
	</div>

	<!-- ── PROFIL ─────────────────────────────────────────── -->
	<div class="gu-page-section gu-page-section--white">
		<div class="gu-page-section__inner">
			<div class="gu-despre-profile">

				<!-- Portrait [CLIENT_CONTENT: înlocuiți cu fotografie reală] -->
				<div class="gu-despre-portrait">
					<div class="gu-despre-portrait__placeholder">
						<svg width="48" height="48" viewBox="0 0 48 48" fill="none" aria-hidden="true">
							<circle cx="24" cy="20" r="10" stroke="#C7C7CC" stroke-width="2"/>
							<path d="M6 42c0-9.941 8.059-18 18-18s18 8.059 18 18"
							      stroke="#C7C7CC" stroke-width="2" stroke-linecap="round"/>
						</svg>
						<span>Fotografie Dr. Ungureanu<br>[CLIENT_CONTENT]</span>
					</div>
				</div>

				<div class="gu-despre-bio">
					<h2 class="gu-despre-bio__name">Dr. George Ungureanu</h2>
					<p class="gu-despre-bio__title">Medic Specialist Neurochirurgie</p>

					<!-- [CLIENT_CONTENT: biografie scurtă] -->
					<p class="gu-despre-bio__body">
						Dr. George Ungureanu este medic specialist neurochirurg cu pregătire în cadrul
						celor mai importante centre neurochirurgicale din România. Activează în
						Cluj&#8209;Napoca și Baia Mare, oferind consultații și intervenții chirurgicale
						pentru afecțiuni ale coloanei vertebrale, creierului și sistemului nervos periferic.
					</p>
					<p class="gu-despre-bio__body" style="font-size:14px;color:#6E6E73">
						[CLIENT_CONTENT: biografie detaliată, specializări, formare profesională]
					</p>

					<a href="<?php echo esc_url( home_url( '/programari/' ) ); ?>"
					   class="gu-btn gu-btn--accent">
						Programează o consultație
					</a>
				</div>

			</div>
		</div>
	</div>

	<!-- ── CREDENȚIALE ────────────────────────────────────── -->
	<div class="gu-page-section gu-page-section--gray">
		<div class="gu-page-section__inner">
			<h2 class="gu-page-section__heading" style="margin-bottom:32px">Formare și credențiale</h2>

			<div class="gu-credentials">

				<div class="gu-credential">
					<p class="gu-credential__label">Specializare</p>
					<p class="gu-credential__value">Medic Specialist Neurochirurgie</p>
					<p class="gu-credential__sub">[CLIENT_CONTENT: instituție, an]</p>
				</div>

				<div class="gu-credential">
					<p class="gu-credential__label">Facultate</p>
					<p class="gu-credential__value">[CLIENT_CONTENT: universitate]</p>
					<p class="gu-credential__sub">Medicină Generală</p>
				</div>

				<div class="gu-credential">
					<p class="gu-credential__label">Afiliere</p>
					<p class="gu-credential__value">[CLIENT_CONTENT: spital / clinică]</p>
					<p class="gu-credential__sub">[CLIENT_CONTENT: departament]</p>
				</div>

				<div class="gu-credential">
					<p class="gu-credential__label">Locații</p>
					<p class="gu-credential__value">Cluj&#8209;Napoca · Baia Mare</p>
					<p class="gu-credential__sub">și consultații online</p>
				</div>

				<div class="gu-credential">
					<p class="gu-credential__label">Experiență</p>
					<p class="gu-credential__value">[CLIENT_CONTENT: ani]+</p>
					<p class="gu-credential__sub">ani în neurochirurgie</p>
				</div>

				<div class="gu-credential">
					<p class="gu-credential__label">Membri</p>
					<p class="gu-credential__value">[CLIENT_CONTENT: societăți profesionale]</p>
					<p class="gu-credential__sub">&nbsp;</p>
				</div>

			</div>
		</div>
	</div>

	<!-- ── FILOZOFIE ──────────────────────────────────────── -->
	<div class="gu-page-section gu-page-section--white">
		<div class="gu-page-section__inner--narrow" style="text-align:center">
			<h2 class="gu-page-section__heading">Abordarea mea</h2>
			<p class="gu-page-section__sub">
				Fiecare pacient este unic — planul terapeutic este stabilit după un diagnostic complet,
				cu explicații clare despre opțiunile disponibile.
			</p>
		</div>
		<div class="gu-page-section__inner" style="margin-top:0">
			<div class="gu-philosophy-pillars">

				<div class="gu-philosophy-pillar">
					<p class="gu-philosophy-pillar__num">01</p>
					<p class="gu-philosophy-pillar__title">Diagnostic precis</p>
					<p class="gu-philosophy-pillar__text">
						Evaluare completă: anamneză, examen clinic și interpretare imagistică (RMN, CT).
						Nicio recomandare chirurgicală fără certitudinea diagnosticului.
					</p>
				</div>

				<div class="gu-philosophy-pillar">
					<p class="gu-philosophy-pillar__num">02</p>
					<p class="gu-philosophy-pillar__title">Plan individualizat</p>
					<p class="gu-philosophy-pillar__text">
						Opțiunile conservatoare sunt explorate înainte de chirurgie.
						Decizia se ia împreună cu pacientul, cu timp pentru întrebări.
					</p>
				</div>

				<div class="gu-philosophy-pillar">
					<p class="gu-philosophy-pillar__num">03</p>
					<p class="gu-philosophy-pillar__title">Suport continuu</p>
					<p class="gu-philosophy-pillar__text">
						Consultații de urmărire, ghid de recuperare și disponibilitate
						pentru întrebări după intervenție.
					</p>
				</div>

			</div>
		</div>
	</div>

	<!-- ── EXPERIENȚĂ / TIMELINE ──────────────────────────── -->
	<div class="gu-page-section gu-page-section--gray">
		<div class="gu-page-section__inner--narrow">
			<h2 class="gu-page-section__heading" style="margin-bottom:40px">Parcurs profesional</h2>
			<p class="gu-placeholder-notice">
				<strong>[CLIENT_CONTENT]</strong> — Înlocuiți elementele de mai jos cu datele reale
				(an, instituție, rol).
			</p>

			<div class="gu-timeline">

				<div class="gu-timeline-item">
					<div class="gu-timeline-item__year">
						[AN]
						<div class="gu-timeline-item__dot"></div>
					</div>
					<div class="gu-timeline-item__content">
						<p class="gu-timeline-item__title">[CLIENT_CONTENT: poziție / etapă carieră]</p>
						<p class="gu-timeline-item__desc">[CLIENT_CONTENT: instituție, detalii]</p>
					</div>
				</div>

				<div class="gu-timeline-item">
					<div class="gu-timeline-item__year">
						[AN]
						<div class="gu-timeline-item__dot"></div>
					</div>
					<div class="gu-timeline-item__content">
						<p class="gu-timeline-item__title">[CLIENT_CONTENT: poziție / etapă carieră]</p>
						<p class="gu-timeline-item__desc">[CLIENT_CONTENT: instituție, detalii]</p>
					</div>
				</div>

				<div class="gu-timeline-item">
					<div class="gu-timeline-item__year">
						[AN]
						<div class="gu-timeline-item__dot"></div>
					</div>
					<div class="gu-timeline-item__content">
						<p class="gu-timeline-item__title">[CLIENT_CONTENT: poziție / etapă carieră]</p>
						<p class="gu-timeline-item__desc">[CLIENT_CONTENT: instituție, detalii]</p>
					</div>
				</div>

			</div>
		</div>
	</div>

	<!-- ── CTA FINAL ──────────────────────────────────────── -->
	<div class="gu-inline-cta">
		<div class="gu-inline-cta__inner">
			<p class="gu-inline-cta__overline">Primul pas</p>
			<h2 class="gu-inline-cta__heading">Programați o consultație</h2>
			<p class="gu-inline-cta__body">
				Cluj&#8209;Napoca, Baia Mare sau online — alegeți locația care vă convine.
			</p>
			<a href="<?php echo esc_url( home_url( '/programari/' ) ); ?>"
			   class="gu-inline-cta__btn">
				Programează acum
			</a>
		</div>
	</div>

</main>

<?php get_footer(); ?>
