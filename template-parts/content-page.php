<?php
/**
 * Template part for displaying static page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Compelling
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<figure class="entry-thumbnail">
			<?php the_post_thumbnail(); ?>
		</figure>
	<?php endif; ?>	

	<div class="entry-inner">
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</header><!-- .entry-header -->
	
		<div class="entry-content">
			<?php
			the_content();
	
			wp_link_pages( array(
				'before'      => sprintf( '<div class="page-links">%s', esc_html__( 'Pages:', 'compelling' ) ),
				'after'       => '</div>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>'
			) );
			?>
		</div><!-- .entry-content -->
	
		<?php if ( get_edit_post_link() ) : ?>
			<footer class="entry-footer">
				<?php
				edit_post_link(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Edit %s', 'compelling' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						'<span class="screen-reader-text">' . get_the_title() . '</span>'
					),
					'<span class="edit-link">',
					'</span>'
				);
				?>
			</footer><!-- .entry-footer -->
		<?php endif; ?>
	</div><!-- .entry-inner -->
</article><!-- #post-<?php the_ID(); ?> -->
