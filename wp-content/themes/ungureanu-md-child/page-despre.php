<?php
/**
 * Page Template — Despre
 * URL: /despre/
 *
 * Hybrid architecture: header and footer come from the child theme;
 * page content is managed entirely via the Elementor visual editor.
 *
 * To build this page: WP Admin → Pages → Despre → Edit with Elementor.
 * Starter template: elementor-starters/despre.json (import via
 * Elementor → Templates → Saved Templates → Import Templates).
 */

get_header();

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		?>
		<main id="content" class="gu-elementor-page"
		      aria-label="<?php the_title_attribute(); ?>">

			<?php the_content(); ?>

			<?php
			// Admin hint: only shown to editors when no Elementor content exists yet.
			if ( current_user_can( 'edit_posts' )
				&& empty( get_post_meta( get_the_ID(), '_elementor_data', true ) ) ) :
			?>
			<div style="padding:72px 32px;text-align:center;background:#F2F2F7;
			            font-family:system-ui,-apple-system,sans-serif">
				<p style="color:#6E6E73;font-size:15px;margin:0 0 12px">
					Nicio secțiune Elementor adăugată pe această pagină.
				</p>
				<a href="<?php echo esc_url( admin_url( 'post.php?post=' . get_the_ID() . '&action=elementor' ) ); ?>"
				   style="color:#0E7FC0;font-size:14px;font-weight:600;text-decoration:none">
					→ Deschide Elementor pentru această pagină
				</a>
				<p style="color:#A1A1A6;font-size:12px;margin:16px 0 0">
					Import starter: <code>elementor-starters/despre.json</code>
				</p>
			</div>
			<?php endif; ?>

		</main>
		<?php
	endwhile;
endif;

get_footer();
