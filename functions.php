<?php
/**
 * Leoraw Timber 
 * https://github.com/timber/starter-theme
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

/**
 * If you are installing Timber as a Composer dependency in your theme, you'll need this block
 * to load your dependencies and initialize Timber. If you are using Timber via the WordPress.org
 * plug-in, you can safely delete this block.
 */
$composer_autoload = __DIR__ . '/vendor/autoload.php';
if ( file_exists( $composer_autoload ) ) {
	require_once $composer_autoload;
	$timber = new Timber\Timber();
}

/**
 * This ensures that Timber is loaded and available as a PHP class.
 * If not, it gives an error message to help direct developers on where to activate
 */
if ( ! class_exists( 'Timber' ) ) {

	add_action(
		'admin_notices',
		function() {
			echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
		}
	);

	add_filter(
		'template_include',
		function( $template ) {
			return get_stylesheet_directory() . '/static/no-timber.html';
		}
	);
	return;
}

/**
 * Sets the directories (inside your theme) to find .twig files
 */
Timber::$dirname = array( 'templates', 'views' );

/**
 * By default, Timber does NOT autoescape values. Want to enable Twig's autoescape?
 * No prob! Just set this value to true
 */
Timber::$autoescape = false;


/**
 * We're going to configure our theme inside of a subclass of Timber\Site
 * You can move this to its own file and include here via php's include("MySite.php")
 */
class StarterSite extends Timber\Site {
	/** Add timber support. */
	public function __construct() {
		add_action( 'after_setup_theme', array( $this, 'theme_supports' ) );
		add_filter( 'timber/context', array( $this, 'add_to_context' ) );
		add_filter( 'timber/twig', array( $this, 'add_to_twig' ) );
		add_action( 'init', array( $this, 'register_post_types' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ) );
		add_filter( 'avatar_defaults', 'leoraw_timber_gravatar');
		// add_action( 'init', 'leoraw_timber_artcat_taxonomy' );
		parent::__construct();
	}
	/** This is where you can register custom post types. */
	public function register_post_types() {
		/*
  * The $labels describes how the post type appears.
  */
  $labels = array(
        'name'          => 'Arts', // Plural name
        'singular_name' => 'Art'   // Singular name
    );

    /*
     * The $supports parameter describes what the post type supports
     */
    $supports = array(
        'title',        // Post title
        'editor',       // Post content
        'excerpt',      // Allows short description
        'author',       // Allows showing and choosing author
        'thumbnail',    // Allows feature images
        'revisions',    // Shows autosaved version of the posts
        'custom-fields' // Supports by custom fields
    );

    /*
     * The $args parameter holds important parameters for the custom post type
     */
    $args = array(
        'labels'              => $labels,
        'description'         => 'Post type post art', // Description
        'supports'            => $supports,
        'taxonomies'          => array( 'artcat' ), // Allowed taxonomies
        'hierarchical'        => false, // Allows hierarchical categorization, if set to false, the Custom Post Type will behave like Post, else it will behave like Page
        'public'              => true,  // Makes the post type public
        'show_ui'             => true,  // Displays an interface for this post type
        'show_in_menu'        => true,  // Displays in the Admin Menu (the left panel)
        'show_in_nav_menus'   => true,  // Displays in Appearance -> Menus
        'show_in_admin_bar'   => true,  // Displays in the black admin bar
        'menu_position'       => 5,     // The position number in the left menu
        'menu_icon'           => true,  // The URL for the icon used for this post type
        'can_export'          => true,  // Allows content export using Tools -> Export
        'has_archive'         => true,  // Enables post type archive (by month, date, or year)
        'exclude_from_search' => false, // Excludes posts of this type in the front-end search result page if set to true, include them if set to false
        'publicly_queryable'  => true,  // Allows queries to be performed on the front-end part if set to true
        'capability_type'     => 'post' // Allows read, edit, delete like “Post”
    );

    register_post_type('art', $args); //Create a post type with the slug is ‘product’ and arguments in $args.


	}
	/** This is where you can register custom taxonomies. */
	public function register_taxonomies() {

			$labels = array(
				'name' => _x( 'Art Tags', 'taxonomy general name' ),
				'singular_name' => _x( 'Art Tag', 'taxonomy singular name' ),
				'search_items' =>  __( 'Search Art Tags' ),
				'all_items' => __( 'All Art Tags' ),
				'parent_item' => null,
				'parent_item_colon' => null,
				'edit_item' => __( 'Edit Art Tag' ), 
				'update_item' => __( 'Update Art Tag' ),
				'add_new_item' => __( 'Add New Art Tag' ),
				'new_item_name' => __( 'New Art Tag Name' ),
				'menu_name' => __( 'artcat' ),
			  );    
			  
			// Now register the taxonomy
			  register_taxonomy('artcat', array('art'), array(
				'hierarchical' => false,
				'label' => __( 'Art Tags' ),
				'show_ui' => true,
				'show_in_rest' => true,
				'show_admin_column' => true,
				'query_var' => true,
				'rewrite' => array( 'slug' => 'artcat' ),
			  ));

	}

	/** This is where you add some context
	 *
	 * @param string $context context['this'] Being the Twig's {{ this }}.
	 */
	public function add_to_context( $context ) {
		$context['foo']   = 'bar';
		$context['stuff'] = 'I am a value set in your functions.php file';
		$context['notes'] = 'These values are available everytime you call Timber::context();';
		$context['main']  = new Timber\Menu('Main');
		$context['footer'] = new TimberMenu('Footer');
		$context['social'] = new TimberMenu('Social Menu');
		$context['blog'] = new TimberMenu('Blog Menu');
		$context['primary'] = new TimberMenu('Primary Menu');
		$context['site']  = $this;
		$context['is_front_page'] = is_front_page();
		return $context;
	}

	public function theme_supports() {
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

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
 * Register widget area.
 *
 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
 */
function leoraw_timber_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'leoraw Timber Sidebar Blog', 'leoraw_timber' ),
		'id'            => 'sidebar-1',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'leoraw Timber Sidebar Art', 'leoraw_timber' ),
		'id'            => 'sidebar-2',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}

add_action( 'widgets_init', 'leoraw_timber_widgets_init' );

function leoraw_timber_customize_register( $wp_customize ) {
   //All our sections, settings, and controls will be added here
	  $wp_customize->add_section('leoraw_timber_banner_image-section', array(
        'title' => 'Banner Image'
    ));

    $wp_customize->add_setting('leoraw_timber_banner_image-display', array(
        'default' => 'No'
    ));

    $wp_customize->add_setting('leoraw_timber_banner_image-image');

    $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'leoraw_timber_banner_image-control', array(
            'label' => 'Image',
            'section' => 'leoraw_timber_banner_image-section',
            'settings' => 'leoraw_timber_banner_image-image',
            'flex_width'  => true,
            'flex_height' => true,
            'width'       => 1500,
            'height'      => 400,
        )));
	
}
add_action( 'customize_register', 'leoraw_timber_customize_register' );

/**
 * Enqueue a script
 */
function leoraw_timber_enqueue_scripts() {
	wp_enqueue_script( 'navigation', get_template_directory_uri() . '/js/navigation.js', array(), true );
}
add_action( 'wp_enqueue_scripts', 'leoraw_timber_enqueue_scripts' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		 */
		add_theme_support(
			'post-formats',
			array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
				'gallery',
				'audio',
			)
		);

		add_theme_support( 'menus' );
	}

	/** This Would return 'foo bar!'.
	 *
	 * @param string $text being 'foo', then returned 'foo bar!'.
	 */
	public function myfoo( $text ) {
		$text .= ' bar!';
		return $text;
	}

	/** This is where you can add your own functions to twig.
	 *
	 * @param string $twig get extension.
	 */
	public function add_to_twig( $twig ) {
		$twig->addExtension( new Twig\Extension\StringLoaderExtension() );
		$twig->addFilter( new Twig\TwigFilter( 'myfoo', array( $this, 'myfoo' ) ) );
		return $twig;
	}

	/*AVATAR
	=========================*/
	
	public function leoraw_timber_gravatar ($avatar_defaults) {
		$myavatar = get_bloginfo('template_directory') . '/images/stars.jpg';
		$avatar_defaults[$myavatar] = "Leoraw Blog Avatar";
		return $avatar_defaults;
	}

}

new StarterSite();
