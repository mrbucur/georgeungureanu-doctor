<?php
/**
 * Page Template — Ghidul pacientului după intervenții neurochirurgicale
 * URL: /ghid-recuperare/
 */

get_header();
?>
<main id="content" class="gu-recovery-guide-page">
	<?php echo do_shortcode( '[gu_recovery_guide]' ); ?>
</main>
<?php
get_footer();
