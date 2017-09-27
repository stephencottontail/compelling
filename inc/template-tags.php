<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Compelling
 */

if ( ! function_exists( 'compelling_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post's date
 */
function compelling_posted_on() {
	printf( '<time class="entry-date published" datetime="%1$s"><a href="%2$s" rel="bookmark">%3$s</a></time>',
		esc_attr( get_the_date( 'c' ) ),
		esc_url( get_permalink() ),
		esc_html( get_the_date() )
	);
}
endif;

if ( ! function_exists( 'compelling_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function compelling_entry_footer() {
	// Hide categories, tags, author for pages.
	if ( 'post' === get_post_type() ) {
		$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		);
		
		printf( esc_html_x( 'by %s', 'post author', 'compelling' ), $author );
		 
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'compelling' ) );
		if ( $categories_list ) {
			/* translators: 1: list of categories. */
			printf( '<span class="cat-links meta-info">' . esc_html__( 'Posted in %1$s', 'compelling' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'compelling' ) );
		if ( $tags_list ) {
			/* translators: 1: list of tags. */
			printf( '<span class="tags-links meta-info">' . esc_html__( 'Tagged %1$s', 'compelling' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}
	
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
		'<span class="edit-link meta-info">',
		'</span>'
	);
}
endif;

if ( ! function_exists( 'compelling_show_comment' ) ) :
/**
 * Custom function to display comments
 */
function compelling_show_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	global $post;
  
	if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>
		<li id="div-comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
			<article class="pingback-body">
				<header class="pingback-header">
					<?php esc_html_e( 'Pingback', 'compelling' ); ?>
				</header><!-- .pingback-header -->
				
				<div class="pingback-content">
					<cite><?php comment_author_link(); ?></cite>
					<?php edit_comment_link( esc_html__( 'Edit', 'compelling' ), '<span class="pingback-edit">', '</span>' ); ?>
				</div>
			</article>
	
	<?php else : ?>
		<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
			<article class="comment-body">
				<header class="comment-header">
					<?php
					if ( '0' != $args['avatar_size'] ) {
						echo get_avatar( $comment, $args['avatar_size'] );
					}
					?>
			
					<cite class="fn"><?php echo get_comment_author_link(); ?></cite>
					
					<?php
					if ( ! empty( $comment->comment_parent ) ) :
						$parent_comment = get_comment( $comment->comment_parent );
						
						$reply_to = sprintf( '<a href="%1$s">%2$s</a>',
							esc_url( get_comment_link( $parent_comment ) ),
							esc_html( $parent_comment->comment_author )
						);
						?>
						<span class="in-reply-to"><?php printf( esc_html__( 'In reply to %s', 'compelling' ), $reply_to ); ?></span>
					<?php endif; ?>
				</header><!-- .comment-header -->
				
				<div class="comment-content">
					<?php
					if ( '0' == $comment->comment_approved ) : ?>
						<span class="awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'compelling' ); ?></span>
					<?php
					endif;
					
					comment_text();
					?>
				</div><!-- .comment-content -->
				
				<footer class="comment-footer">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>" class="comment-time meta-info"><time datetime="<?php comment_time( 'c' ); ?>"><?php printf( esc_html_x( '%1$s, %2$s', '1: date, 2: time', 'compelling' ),
						get_comment_date(), /* %1$s */
						get_comment_time() /* %2$s */
					); ?></time></a>
					
					<div class="comment-actions">
						<?php
						comment_reply_link( array_merge( $args, array(
							'add_below' => 'comment',
							'depth'     => $depth,
							'max_depth' => $args['max_depth'],
							'before'    => '<span class="comment-reply meta-info">',
							'after'     => '</span>',
						) ) );
						
						edit_post_link( esc_html__( 'Edit', 'compelling' ), '<span class="comment-edit meta-info">', '</span>' );
						?>
					</div><!-- .comment-actions -->
				</footer><!-- .comment-footer -->
			</article>
			
	<?php
	endif; // end check for comment type
	
} // end of function
endif; // end of check for function's existence
