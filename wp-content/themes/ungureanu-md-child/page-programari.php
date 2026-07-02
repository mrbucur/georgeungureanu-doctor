<?php
/**
 * Page Template — Programări
 * URL: /programari/
 *
 * [CLIENT_CONTENT] sections are marked below.
 * Cal.com embed: replace [CALCOM_USERNAME] with the actual username.
 */

get_header();
?>

<main class="gu-page-main" aria-label="Programați o consultație">

	<!-- ── HERO ───────────────────────────────────────────── -->
	<div class="gu-page-hero">
		<div class="gu-page-hero__inner">
			<p class="gu-page-hero__overline">Consultații neurochirurgicale</p>
			<h1 class="gu-page-hero__title">Programați o consultație</h1>
			<p class="gu-page-hero__sub">
				Disponibil în Cluj&#8209;Napoca, Baia Mare și online.
				Diagnostic precis, plan terapeutic individualizat.
			</p>
		</div>
	</div>

	<!-- ── CLINICI ────────────────────────────────────────── -->
	<div class="gu-page-section gu-page-section--gray">
		<div class="gu-page-section__inner">
			<h2 class="gu-page-section__heading" style="margin-bottom:8px">Locații fizice</h2>
			<p class="gu-page-section__sub">Consultații față-în-față în două orașe.</p>

			<div class="gu-programari-clinics">

				<!-- Cluj-Napoca -->
				<div class="gu-programari-clinic">
					<p class="gu-programari-clinic__city">Cluj-Napoca</p>
					<p class="gu-programari-clinic__name">
						[CLIENT_CONTENT: denumire clinică / spital]
					</p>

					<div class="gu-programari-clinic__row">
						<span class="gu-programari-clinic__label">Adresă</span>
						<p class="gu-programari-clinic__value">
							[CLIENT_CONTENT: stradă, număr, Cluj-Napoca]
						</p>
					</div>

					<div class="gu-programari-clinic__row">
						<span class="gu-programari-clinic__label">Program</span>
						<p class="gu-programari-clinic__value">
							[CLIENT_CONTENT: zile și ore]
						</p>
					</div>

					<div class="gu-programari-clinic__row">
						<span class="gu-programari-clinic__label">Telefon</span>
						<p class="gu-programari-clinic__value">
							<a href="tel:[CLIENT_CONTENT]" style="color:inherit;text-decoration:none">
								[CLIENT_CONTENT: număr telefon]
							</a>
						</p>
					</div>

					<div class="gu-programari-clinic__actions">
						<a href="tel:[CLIENT_CONTENT]" class="gu-btn gu-btn--accent">
							Sună pentru programare
						</a>
					</div>
				</div>

				<!-- Baia Mare -->
				<div class="gu-programari-clinic">
					<p class="gu-programari-clinic__city">Baia Mare</p>
					<p class="gu-programari-clinic__name">
						[CLIENT_CONTENT: denumire clinică / spital]
					</p>

					<div class="gu-programari-clinic__row">
						<span class="gu-programari-clinic__label">Adresă</span>
						<p class="gu-programari-clinic__value">
							[CLIENT_CONTENT: stradă, număr, Baia Mare]
						</p>
					</div>

					<div class="gu-programari-clinic__row">
						<span class="gu-programari-clinic__label">Program</span>
						<p class="gu-programari-clinic__value">
							[CLIENT_CONTENT: zile și ore]
						</p>
					</div>

					<div class="gu-programari-clinic__row">
						<span class="gu-programari-clinic__label">Telefon</span>
						<p class="gu-programari-clinic__value">
							<a href="tel:[CLIENT_CONTENT]" style="color:inherit;text-decoration:none">
								[CLIENT_CONTENT: număr telefon]
							</a>
						</p>
					</div>

					<div class="gu-programari-clinic__actions">
						<a href="tel:[CLIENT_CONTENT]" class="gu-btn gu-btn--accent">
							Sună pentru programare
						</a>
					</div>
				</div>

			</div>
		</div>
	</div>

	<!-- ── ONLINE ─────────────────────────────────────────── -->
	<div class="gu-page-section gu-page-section--white">
		<div class="gu-page-section__inner--narrow">

			<div class="gu-programari-online">
				<h2 class="gu-programari-online__heading">Consultație online</h2>
				<p class="gu-programari-online__sub">
					Consultații video disponibile pentru pacienți din orice localitate.
					Programați direct prin calendarul online.
				</p>

				<!-- Cal.com embed placeholder.
				     [CLIENT_CONTENT] Replace with actual Cal.com inline embed.
				     Example:
				     <div id="my-cal-inline" style="width:100%;height:700px;overflow:scroll"></div>
				     <script>
				       (function(C,A,L){...})(window,document,"https://cal.com/embed.js");
				       Cal("inline",{elementOrSelector:"#my-cal-inline",calLink:"[CALCOM_USERNAME]"});
				     </script>
				-->
				<div class="gu-programari-online__embed">
					<svg width="40" height="40" viewBox="0 0 40 40" fill="none"
					     aria-hidden="true" style="margin:0 auto 12px;display:block">
						<rect x="6" y="8" width="28" height="26" rx="4"
						      stroke="#C7C7CC" stroke-width="1.5"/>
						<path d="M6 16h28" stroke="#C7C7CC" stroke-width="1.5"/>
						<path d="M13 6v4M27 6v4" stroke="#C7C7CC" stroke-width="1.5"
						      stroke-linecap="round"/>
					</svg>
					Calendar online — în pregătire<br>
					<span style="font-size:12px">
						[CLIENT_CONTENT: configurați Cal.com și înlocuiți acest bloc cu embed-ul]
					</span>
				</div>
			</div>

		</div>
	</div>

	<!-- ── FAQ ────────────────────────────────────────────── -->
	<div class="gu-page-section gu-page-section--gray">
		<div class="gu-page-section__inner--narrow">
			<h2 class="gu-page-section__heading" style="margin-bottom:32px">Întrebări frecvente</h2>

			<div class="gu-programari-faq">

				<details class="gu-programari-faq__item">
					<summary>Ce să aduc la prima consultație?</summary>
					<div class="gu-programari-faq__answer">
						Aduceți toate investigațiile imagistice disponibile (RMN, CT pe CD sau film),
						biletele de externare din spitalizări anterioare, lista medicamentelor curente
						și un act de identitate. Dacă aveți trimitere de la medicul de familie sau un
						specialist, aduceți și aceasta.
					</div>
				</details>

				<details class="gu-programari-faq__item">
					<summary>Cât durează o consultație?</summary>
					<div class="gu-programari-faq__answer">
						Prima consultație durează de obicei 30–45 de minute. Include anamneză,
						examen clinic și discutarea investigațiilor. Consultațiile de urmărire
						durează în medie 20–30 de minute.
					</div>
				</details>

				<details class="gu-programari-faq__item">
					<summary>Este necesar un bilet de trimitere?</summary>
					<div class="gu-programari-faq__answer">
						Nu este obligatoriu. Puteți solicita o consultație direct, în regim privat.
						Dacă doriți decontare prin asigurarea de sănătate (CNAS), este necesară
						o trimitere de la medicul de familie. [CLIENT_CONTENT: confirmați cu clinica]
					</div>
				</details>

				<details class="gu-programari-faq__item">
					<summary>Ce tipuri de afecțiuni sunt tratate?</summary>
					<div class="gu-programari-faq__answer">
						Afecțiuni ale coloanei vertebrale (hernie de disc, stenoze de canal),
						tumori cerebrale și spinale, traumatisme cranio-cerebrale, hidrocefalie,
						nevralgii și compresii nervoase. Consultați
						<a href="<?php echo esc_url( home_url( '/afectiuni/' ) ); ?>"
						   style="color:#0E7FC0">pagina de afecțiuni</a> pentru lista completă.
					</div>
				</details>

				<details class="gu-programari-faq__item">
					<summary>Cum funcționează consultația online?</summary>
					<div class="gu-programari-faq__answer">
						Consultațiile online se desfășoară prin videoconferință securizată.
						Programați prin calendarul de mai sus și veți primi un link de acces.
						Aduceți investigațiile în format digital (PDF, JPEG) sau trimiteți-le
						în avans pe e-mail.
						[CLIENT_CONTENT: adăugați detalii specifice platformei Cal.com]
					</div>
				</details>

			</div>
		</div>
	</div>

	<!-- ── CTA FINAL ──────────────────────────────────────── -->
	<div class="gu-inline-cta">
		<div class="gu-inline-cta__inner">
			<p class="gu-inline-cta__overline">Faceți primul pas</p>
			<h2 class="gu-inline-cta__heading">Solicitați o consultație astăzi</h2>
			<p class="gu-inline-cta__body">
				Diagnostic precis și plan de tratament individualizat —
				conservator sau chirurgical, în funcție de situația dumneavoastră.
			</p>
			<a href="tel:[CLIENT_CONTENT]" class="gu-inline-cta__btn">
				Sună acum
			</a>
		</div>
	</div>

</main>

<?php get_footer(); ?>
