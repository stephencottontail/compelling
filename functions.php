<?php
/**
 * Compelling functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Compelling
 */

if ( ! function_exists( 'compelling_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function compelling_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Compelling, use a find and replace
	 * to change 'compelling' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'compelling', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'compelling' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
	
	/**
	 * Add support for editor styling
	 */
	add_editor_style( array( 'inc/css/editor-style.css', compelling_fonts_url() ) );
	 
	/**
	 * Add support for Jetpack features
	 *
	 * @link https://jetpack.com/
	 */
	add_theme_support( 'jetpack-social-menu' );
}
endif;
add_action( 'after_setup_theme', 'compelling_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function compelling_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'compelling_content_width', 640 );
}
add_action( 'after_setup_theme', 'compelling_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function compelling_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'compelling' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'compelling' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'compelling_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function compelling_scripts() {
	wp_enqueue_style( 'compelling-google-fonts', compelling_fonts_url() );
	wp_enqueue_style( 'compelling-style', get_stylesheet_uri() );

	wp_enqueue_script( 'compelling-functions', get_theme_file_uri( '/js/compelling.js' ), array( 'jquery' ), '20151215', true );
	wp_localize_script( 'compelling-functions', 'compellingMenuText', array(
		/* translators: this text appears only for scfeen readers, to indicate that the menu panel will be opened */
		'open'  => esc_html__( 'open menu', 'compelling' ),
		/* translators: this text appears only for screen readers, to indicate that the menu panel will be closed */
		'close' => esc_html__( 'close menu', 'compelling' )
	) );

	wp_enqueue_script( 'compelling-skip-link-focus-fix', get_theme_file_uri( '/js/skip-link-focus-fix.js' ), array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'compelling_scripts', 10 );

/**
 * Enqueue (and possibly dequeue) Google fonts
 */
function compelling_fonts_url() {
	$fonts = array();
	$fonts_url = '';
	
	/* translators: If there are characters in your language that are not supported by Cormorant Garamond, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Cormorant Garamond font: on or off', 'compelling' ) ) {
		$fonts[] = 'Cormorant Garamond:300,300i,400,400i,700,700i';
	}
	
	/* translators: If there are characters in your language that are not supported by Muli, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Muli font: on or off', 'compelling' ) ) {
		$fonts[] = 'Muli:300,300i,400,400i,700,700i';
	}
	
	/* translators: If there are characters in your language that are not supported by Inconsolata, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'compelling' ) ) {
		$fonts[] = 'Inconsolata';
	}
	
	if ( $fonts ) {
		$query_args = array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => 'latin,latin-ext'
		);
		
		$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
	}
	
	return esc_url_raw( $fonts_url );
}

/**
 * We use excerpts in some places, so let's make them more interesting
 */
function compelling_set_excerpt_length() {
	return 15;
}
add_filter( 'excerpt_length', 'compelling_set_excerpt_length' );

function compelling_set_read_more( $more ) {
	global $post;
	
	$read_more_text = sprintf( esc_html__( 'Continue Reading %s', 'compelling' ), '<span class="screen-reader-text">' . get_the_title() . '</span>' );
	
	return sprintf( '&hellip;<div class="read-more"><a href="%1$s" class="read-more-link" rel="bookmark">%2$s</a></div>',
		esc_url( get_permalink() ),
		$read_more_text
	);
}
add_filter( 'excerpt_more', 'compelling_set_read_more' );

/**
 * Custom template tags for this theme.
 */
require get_theme_file_path( '/inc/template-tags.php' );

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_theme_file_path( '/inc/template-functions.php' );

/**
 * Customizer additions.
 */
require get_theme_file_path( '/inc/customizer.php' );

/**
 * Load Jetpack compatibility file.
 */
require get_theme_file_path( '/inc/jetpack.php' );
