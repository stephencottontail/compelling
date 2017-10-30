<?php
/**
 * Template part for displaying the content of the page assigned as the static
 * front page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Compelling
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'front' ); ?>>
	<div class="entry-inner">
		<header class="entry-header">
			<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
		</header><!-- .entry-header -->
	
		<div class="entry-content">
			<?php
			the_content( sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading %s', 'compelling' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				'<span class="screen-reader-text">' . get_the_title() . '</span>'
			) );
	
			wp_link_pages( array(
				'before'      => sprintf( '<div class="page-links">%s', __( 'Pages:', 'compelling' ) ),
				'after'       => '</div>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>'
			) );
			?>
		</div><!-- .entry-content -->
	</div><!-- .entry-inner -->
</article><!-- #post-<?php the_ID(); ?> -->
