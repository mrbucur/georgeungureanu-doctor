<?php
/**
 * Central, dependency-free theme configuration.
 *
 * Values are editable in Appearance > Customize and always have safe defaults,
 * so templates never need to repeat brand or contact copy.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function gu_theme_defaults(): array {
	return [
		'brand_name'       => 'George Ungureanu',
		'brand_specialty'  => 'Medic Primar Neurochirurg, Doctor în Medicină',
		'brand_short_role' => 'Medic Primar Neurochirurg',
		'cta_label'       => 'Programează o consultație',
		'cta_url'         => home_url( '/programari/' ),
		'contact_phone'   => '',
		'contact_email'   => '',
		'about_photo_id'  => '0',
		'online_consultation_url'   => 'https://cal.com/georgeungureanu/consultatie-online',
		'online_consultation_email' => 'consultatii@georgeungureanu.doctor',
		'online_consultation_price' => '',
		'online_consultation_currency' => 'RON',
		'online_reschedule_cutoff_hours' => '',
		'online_booking_policy' => '',
		'consultation_cities' => 'Cluj-Napoca, Baia Mare',
		'career_start_year'    => '2011',
		'specialist_year'      => '2018',
		'primary_year'         => '2024',
		'phd_year'             => '2025',
		'phd_institution'      => 'Universitatea de Medicină și Farmacie „Iuliu Hațieganu” Cluj-Napoca',
		'phd_thesis'           => 'Modele de interacțiune între meningioamele de bază de craniu și elementele vasculare și nervoase cerebrale și influența cisternelor arahnoidiene în dezvoltarea tumorală',
		'operated_patients_min' => '1500',
		'expertise'             => 'Neurochirurgie tumorală și chirurgie spinală degenerativă',
		'professional_difference' => 'Experiența chirurgicală și pregătirea internațională dobândită în centre de neurochirurgie din Europa susțin o practică riguroasă, orientată către dezvoltarea chirurgiei tumorilor spinale în România și către binele pacientului.',
		'personal_interests'     => 'Drumeție, meditație, alergare și ciclism',
		'footer_copy'     => 'Consultații neurochirurgicale în Cluj-Napoca, Baia Mare și online. Diagnostic precis, tratament individualizat — conservator sau chirurgical.',
	];
}

function gu_get_theme_setting( string $key ): string {
	$defaults = gu_theme_defaults();
	$default  = $defaults[ $key ] ?? '';
	$value    = get_theme_mod( 'gu_' . $key, $default );

	return is_string( $value ) ? trim( $value ) : $default;
}

function gu_get_primary_cta(): array {
	return [
		'label' => gu_get_theme_setting( 'cta_label' ),
		'url'   => gu_get_theme_setting( 'cta_url' ),
	];
}

function gu_default_navigation_items(): array {
	return [
		[ 'title' => 'Acasă', 'url' => home_url( '/' ) ],
		[ 'title' => 'Afecțiuni', 'url' => home_url( '/afectiuni/' ) ],
		[ 'title' => 'Intervenții', 'url' => home_url( '/interventii/' ) ],
		[ 'title' => 'Sfatul Neurochirurgului', 'url' => home_url( '/articole/' ) ],
		[ 'title' => 'Recomandări', 'url' => home_url( '/recomandari/' ) ],
		[ 'title' => 'Despre', 'url' => home_url( '/despre/' ) ],
	];
}

function gu_get_navigation_items(): array {
	$locations = get_nav_menu_locations();
	$menu_id   = $locations['primary'] ?? 0;
	$items     = $menu_id ? wp_get_nav_menu_items( $menu_id ) : false;

	if ( ! $items ) {
		return gu_default_navigation_items();
	}

	return array_values( array_map(
		static fn( $item ): array => [
			'title' => $item->title,
			'url'   => $item->url,
		],
		array_filter( $items, static fn( $item ): bool => 0 === (int) $item->menu_item_parent )
	) );
}

add_action( 'customize_register', function ( WP_Customize_Manager $customizer ): void {
	$customizer->add_section( 'gu_site_identity', [
		'title'       => 'Identitate și contact',
		'description' => 'Sursa unică pentru informațiile repetate în site.',
		'priority'    => 25,
	] );

	$fields = [
		'brand_name'       => [ 'Numele afișat', 'sanitize_text_field', 'text' ],
		'brand_specialty'  => [ 'Specialitatea completă', 'sanitize_text_field', 'text' ],
		'brand_short_role' => [ 'Specialitatea scurtă', 'sanitize_text_field', 'text' ],
		'cta_label'        => [ 'Text buton principal', 'sanitize_text_field', 'text' ],
		'cta_url'          => [ 'Link buton principal', 'esc_url_raw', 'url' ],
		'contact_phone'    => [ 'Telefon', 'sanitize_text_field', 'text' ],
		'contact_email'    => [ 'Email', 'sanitize_email', 'email' ],
		'about_photo_id'   => [ 'ID fotografie pagina Despre', 'absint', 'number' ],
		'online_consultation_url'   => [ 'Link programări online', 'esc_url_raw', 'url' ],
		'online_consultation_email' => [ 'Email exclusiv consultații online', 'sanitize_email', 'email' ],
		'online_consultation_price' => [ 'Tarif consultație online', 'sanitize_text_field', 'text' ],
		'online_consultation_currency' => [ 'Monedă consultație online', 'sanitize_text_field', 'text' ],
		'online_reschedule_cutoff_hours' => [ 'Termen reprogramare (ore)', 'absint', 'number' ],
		'online_booking_policy' => [ 'Politică programare online', 'sanitize_textarea_field', 'textarea' ],
		'consultation_cities' => [ 'Orașe de consultație', 'sanitize_text_field', 'text' ],
		'career_start_year'    => [ 'Început în neurochirurgie', 'absint', 'number' ],
		'specialist_year'      => [ 'Medic specialist din', 'absint', 'number' ],
		'primary_year'         => [ 'Medic primar din', 'absint', 'number' ],
		'phd_year'             => [ 'An doctorat', 'absint', 'number' ],
		'phd_institution'      => [ 'Instituția doctoratului', 'sanitize_text_field', 'text' ],
		'phd_thesis'           => [ 'Titlul tezei de doctorat', 'sanitize_textarea_field', 'textarea' ],
		'operated_patients_min' => [ 'Pacienți operați (minimum)', 'absint', 'number' ],
		'expertise'             => [ 'Direcții principale de expertiză', 'sanitize_text_field', 'text' ],
		'professional_difference' => [ 'Diferențiator profesional', 'sanitize_textarea_field', 'textarea' ],
		'personal_interests'     => [ 'Interese personale', 'sanitize_text_field', 'text' ],
		'footer_copy'      => [ 'Descriere footer', 'sanitize_textarea_field', 'textarea' ],
	];

	foreach ( $fields as $key => [ $label, $sanitize_callback, $type ] ) {
		$customizer->add_setting( 'gu_' . $key, [
			'default'           => gu_theme_defaults()[ $key ],
			'sanitize_callback' => $sanitize_callback,
			'transport'         => 'refresh',
		] );
		$customizer->add_control( 'gu_' . $key, [
			'section' => 'gu_site_identity',
			'label'   => $label,
			'type'    => $type,
		] );
	}
} );
