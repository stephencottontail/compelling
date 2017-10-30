<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Compelling
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	if ( has_post_thumbnail() ) :
		if ( is_singular() ) {
			$destination = esc_url( get_attachment_link( get_post_thumbnail_id() ) );
		} else {
			$destination = esc_url( get_permalink() );
		}
		?>
		<figure class="entry-thumbnail">
			<a href="<?php echo $destination; ?>" rel="bookmark">
				<?php the_post_thumbnail(); ?>
			</a>
		</figure>
	<?php endif; ?>
	
	<div class="entry-inner">
		<header class="entry-header">
			<?php
			if ( is_singular() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( sprintf( '<h2 class="entry-title"><a href="%1$s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
			endif;
	
			if ( 'post' === get_post_type() ) : ?>
				<div class="entry-meta">
					<?php compelling_posted_on(); ?>
				</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->
	
		<div class="entry-content">
			<?php
			if ( is_singular() ) {
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
			} else {
				the_excerpt();
			}
			?>
		</div><!-- .entry-content -->

		<?php if ( is_singular() ) : ?>
			<footer class="entry-footer entry-meta">
				<?php compelling_entry_footer(); ?>
			</footer><!-- .entry-footer -->
		<?php endif; ?>
	</div><!-- .entry-inner -->
</article><!-- #post-<?php the_ID(); ?> -->
