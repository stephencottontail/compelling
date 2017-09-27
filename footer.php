<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Compelling
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="site-info">
			<?php
			$footer_text = get_theme_mod( 'footer_text' );
			
			if ( $footer_text ) :
				echo wp_kses( $footer_text,
					array( 'a' => array( 'href' => array() ),
						'strong' => array(),
						'em'     => array(),
						'span'   => array( 'class' => array() )
					)
				);
			else : ?>
				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'compelling' ) ); ?>"><?php
					/* translators: %s: CMS name, i.e. WordPress. */
					printf( esc_html__( 'Proudly powered by %s', 'compelling' ), 'WordPress' );
				?></a>
				<span class="sep"> | </span>
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s', 'compelling' ), 'Compelling', '<a href="https://stephencottontail.com/">Stephen Dickinson</a>' );
			
			endif;
			?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
