<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Compelling
 */

?>

<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title">
			<?php
			if ( is_search() ) {
				printf( __( 'No results for &ldquo;%s&rdquo;', 'compelling' ), get_search_query() );
			} else {
				_e( 'Nothing Found', 'compelling' );
			}
			?>
		</h1>
	</header><!-- .page-header -->

	<div class="page-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php
				printf(
					wp_kses(
						/* translators: 1: link to WP admin new post page. */
						__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'compelling' ),
						array(
							'a' => array(
								'href' => array(),
							),
						)
					),
					esc_url( admin_url( 'post-new.php' ) )
				);
			?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'compelling' ); ?></p>
			<?php
			get_search_form();

		else : ?>

			<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'compelling' ); ?></p>
			<?php
			get_search_form();

		endif; ?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
