<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Compelling
 */

get_header(); ?>

<main id="primary" class="site-main">

	<?php if ( have_posts() ) : ?>

		<header class="archive-header">
			<h1 class="archive-title">
				<?php
				/* translators: %s: search query. */
				printf( esc_html__( 'Search Results for &ldquo;%s&rdquo;', 'compelling' ), get_search_query() );
				?>
			</h1>
		</header><!-- .page-header -->

		<?php
		/* Start the Loop */
		while ( have_posts() ) : the_post();

			/**
			 * Run the loop for the search to output the results.
			 * If you want to overload this in a child theme then include a file
			 * called content-search.php and that will be used instead.
			 */
			get_template_part( 'template-parts/content', 'search' );

		endwhile;

		the_posts_navigation( array(
			'prev_text' => esc_html__( '&laquo; Older Posts', 'compelling' ),
			'next_text' => esc_html__( 'Newer Posts &raquo;', 'compelling' )
		) );

	else :

		get_template_part( 'template-parts/content', 'none' );

	endif; ?>

</primary><!-- #main -->

<?php
get_sidebar();
get_footer();