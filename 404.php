<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Compelling
 */

get_header(); ?>

<main id="primary" class="site-main">

	<section class="error-404 not-found">
		<header class="page-header">
			<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'compelling' ); ?></h1>
		</header><!-- .page-header -->

		<div class="page-content">
			<p><?php printf( wp_kses( __( 'It looks like nothing was found at this location. Try <a href="%1$s">returning home</a> or performing a search.', 'compelling' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( home_url( '/' ) ) )
				?></p>

			<?php get_search_form(); ?>

		</div><!-- .page-content -->
	</section><!-- .error-404 -->

</main><!-- #primary -->

<?php
get_footer();
