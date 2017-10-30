<?php
/**
 * Template Name: Front Page Template
 *
 * Use this template for a unique home page look
 *
 * @link https://developer.wordpress.org/themes/template-files-section/page-template-files/
 *
 * @package Compelling
 */

get_header(); ?>

<main id="primary" class="site-main">

	<?php
	while ( have_posts() ) : the_post();

		get_template_part( 'template-parts/content', 'front' );
		
	endwhile; // End of the loop.
	
	$front_page_args = array(
		'posts_per_page' => get_option( 'posts_per_page' )
	);
	
	$front_page_query = new WP_Query( $front_page_args );
	
	if ( $front_page_query->have_posts() ) : ?>
		
		<div class="recent-posts">
			<?php
			/* Start the Loop */
			while ( $front_page_query->have_posts() ) : $front_page_query->the_post();
	
				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'recent' );
	
			endwhile;
			
			printf( '<a href="%1$s" class="see-more">%2$s</a>',
				esc_url( get_permalink( get_option( 'page_for_posts' ) ) ),
				__( 'See More&hellip;', 'compelling' )
			);
			?>
		</div>
	
	<?php
	else :
	
		get_template_part( 'template-parts/content', 'none' );
		
	endif;
	?>
	
</main><!-- #primary -->

<?php
get_sidebar();
get_footer();
