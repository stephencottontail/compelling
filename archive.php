<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Compelling
 */

get_header(); ?>

<main id="primary" class="site-main">

	<?php
	if ( have_posts() ) : ?>

		<header class="archive-header">
			<?php
			the_archive_title( '<h1 class="archive-title">', '</h1>' );
			the_archive_description( '<div class="archive-description">', '</div>' );
			?>
		</header><!-- .page-header -->

		<?php
		/* Start the Loop */
		while ( have_posts() ) : the_post();

			/*
			 * Include the Post-Format-specific template for the content.
			 * If you want to override this in a child theme, then include a file
			 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
			 */
			get_template_part( 'template-parts/content', get_post_format() );

		endwhile;

		the_posts_navigation( array(
			'prev_text' => esc_html__( '&laquo; Older Posts', 'compelling' ),
			'next_text' => esc_html__( 'Newer Posts &raquo;', 'compelling' )
		) );

	else :

		get_template_part( 'template-parts/content', 'none' );

	endif; ?>

</main><!-- #primary -->

<?php
get_sidebar();
get_footer();