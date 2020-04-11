<?php
/**
 * WP Bootstrap Starter functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package sative
 */


class WP_HTML_Compression
{
    // Settings
    protected $compress_css = true;
    protected $compress_js = true;
    protected $info_comment = true;
    protected $remove_comments = true;

    // Variables
    protected $html;
    public function __construct($html)
    {
   	 if (!empty($html))
		{
			$this->parseHTML($html);
		}
    }
    public function __toString()
    {
   	 	return $this->html;
    }
    protected function bottomComment($raw, $compressed)
    {
		$raw = strlen($raw);
		$compressed = strlen($compressed);
		
		$savings = ($raw-$compressed) / $raw * 100;
		
		$savings = round($savings, 2);
		
		return '<!--HTML compressed, size saved '.$savings.'%. From '.$raw.' bytes, now '.$compressed.' bytes-->';
    }
    protected function minifyHTML($html)
    {
		$pattern = '/<(?<script>script).*?<\/script\s*>|<(?<style>style).*?<\/style\s*>|<!(?<comment>--).*?-->|<(?<tag>[\/\w.:-]*)(?:".*?"|\'.*?\'|[^\'">]+)*>|(?<text>((<[^!\/\w.:-])?[^<]*)+)|/si';
		preg_match_all($pattern, $html, $matches, PREG_SET_ORDER);
		$overriding = false;
		$raw_tag = false;
		// Variable reused for output
		$html = '';
		foreach ($matches as $token)
		{
			$tag = (isset($token['tag'])) ? strtolower($token['tag']) : null;
			
			$content = $token[0];
			
			if (is_null($tag))
			{
				if ( !empty($token['script']) )
				{
					$strip = $this->compress_js;
				}
				else if ( !empty($token['style']) )
				{
					$strip = $this->compress_css;
				}
				else if ($content == '<!--wp-html-compression no compression-->')
				{
					$overriding = !$overriding;
					
					// Don't print the comment
					continue;
				}
				else if ($this->remove_comments)
				{
					if (!$overriding && $raw_tag != 'textarea')
					{
						// Remove any HTML comments, except MSIE conditional comments
						$content = preg_replace('/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/s', '', $content);
					}
				}
			}
			else
			{
				if ($tag == 'pre' || $tag == 'textarea')
				{
					$raw_tag = $tag;
				}
				else if ($tag == '/pre' || $tag == '/textarea')
				{
					$raw_tag = false;
				}
				else
				{
					if ($raw_tag || $overriding)
					{
						$strip = false;
					}
					else
					{
						$strip = true;
						
						// Remove any empty attributes, except:
						// action, alt, content, src
						$content = preg_replace('/(\s+)(\w++(?<!\baction|\balt|\bcontent|\bsrc)="")/', '$1', $content);
						
						// Remove any space before the end of self-closing XHTML tags
						// JavaScript excluded
						$content = str_replace(' />', '/>', $content);
					}
				}
			}
			
			if ($strip)
			{
				$content = $this->removeWhiteSpace($content);
			}
			
			$html .= $content;
   	 }
   	 
   	 return $html;
    }
   	 
    public function parseHTML($html)
    {
		$this->html = $this->minifyHTML($html);
		
		if ($this->info_comment)
		{
			$this->html .= "\n" . $this->bottomComment($html, $this->html);
		}
    }
    
    protected function removeWhiteSpace($str)
    {
		$str = str_replace("\t", ' ', $str);
		$str = str_replace("\n",  '', $str);
		$str = str_replace("\r",  '', $str);
		
		while (stristr($str, '  '))
		{
			$str = str_replace('  ', ' ', $str);
		}
		
		return $str;
    }
}

function wp_html_compression_finish($html)
{
    return new WP_HTML_Compression($html);
}

function wp_html_compression_start()
{
    ob_start('wp_html_compression_finish');
}
add_action('get_header', 'wp_html_compression_start');

if ( ! function_exists( 'sative_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function sative_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on WP Bootstrap Starter, use a find and replace
	 * to change 'sative' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'sative', get_template_directory() . '/languages' );

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
	add_image_size( 'size640', 640, 640, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'sative' ),
		'footer1' => esc_html__( 'Footer 1', 'sative' ),
		'footer2' => esc_html__( 'Footer 2', 'sative' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'sative_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

    function sative_add_editor_styles() {
        add_editor_style( 'custom-editor-style.css' );
    }
    add_action( 'admin_init', 'sative_add_editor_styles' );

}
endif;
add_action( 'after_setup_theme', 'sative_setup' );

// Remove all WooCommerce styles and scripts
//add_filter( 'woocommerce_enqueue_styles', '__return_false' );


/**
 * Remove Post from menu
 */
function post_remove() 
{ 
   remove_menu_page('edit.php');
}
add_action('admin_menu', 'post_remove'); 

/* Disable WordPress Admin Bar for all users but admins. */
show_admin_bar(false);

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function sative_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'sative_content_width', 1170 );
}
add_action( 'after_setup_theme', 'sative_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function sative_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'sative' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Add widgets here.', 'sative' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer 1', 'sative' ),
        'id'            => 'footer-1',
        'description'   => esc_html__( 'Add widgets here.', 'sative' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer 2', 'sative' ),
        'id'            => 'footer-2',
        'description'   => esc_html__( 'Add widgets here.', 'sative' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer 3', 'sative' ),
        'id'            => 'footer-3',
        'description'   => esc_html__( 'Add widgets here.', 'sative' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'sative_widgets_init' );



//Remove Gutenberg Block Library CSS from loading on the frontend
function smartwp_remove_wp_block_library_css()
{
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
}
add_action( 'wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css' );

add_action('wp_enqueue_scripts', function(){
	if (!is_admin()) {
		wp_deregister_script('wp-embed');
		wp_deregister_script('wp-emoji');
	}
	if ( !is_admin() && ( !is_cart() || !is_checkout() || !is_shop() || !is_page( array('koszyk', 'platnosc') ) ) ) {
		//wp_deregister_script('jquery');
	}
});

remove_action( 'wp_head', 'print_emoji_detection_script', 7 ); 
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' ); 
remove_action( 'wp_print_styles', 'print_emoji_styles' ); 
remove_action( 'admin_print_styles', 'print_emoji_styles' );

/**
 * Enqueue scripts and styles.
 */
function sative_scripts() {
	// load bootstrap css
	
	wp_enqueue_style( 'sative-bootstrap-css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css' );
	wp_enqueue_style( 'sative-gfonts', 'https://fonts.googleapis.com/css?family=Barlow:400,500,600,700&display=swap&subset=latin-ext' );
	wp_enqueue_style( 'sative-prettycheckbox', 'https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css' );

	wp_enqueue_script('sative-jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js', array(), '', false );
	wp_enqueue_script('sative-popper', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js', array(), '', true );
	wp_enqueue_script('sative-bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js', array(), '', true );
	wp_enqueue_script('sative-app', get_template_directory_uri() . '/assets/js/main.min.js', array(), '', true );
	// Internet Explorer HTML5 support
    wp_enqueue_script( 'html5hiv',get_template_directory_uri().'/inc/assets/js/html5.js', array(), '3.7.0', false );
    wp_script_add_data( 'html5hiv', 'conditional', 'lt IE 9' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'sative_scripts', 0 );


function sative_password_form() {
    global $post;
    $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
    $o = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
    <div class="d-block mb-3">' . __( "To view this protected post, enter the password below:", "sative" ) . '</div>
    <div class="form-group form-inline"><label for="' . $label . '" class="mr-2">' . __( "Password:", "sative" ) . ' </label><input name="post_password" id="' . $label . '" type="password" size="20" maxlength="20" class="form-control mr-2" /> <input type="submit" name="Submit" value="' . esc_attr__( "Submit", "sative" ) . '" class="btn btn-primary"/></div>
    </form>';
    return $o;
}
add_filter( 'the_password_form', 'sative_password_form' );



/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load plugin compatibility file.
 */
require get_template_directory() . '/inc/plugin-compatibility/plugin-compatibility.php';

/**
 * Load custom WordPress nav walker.
 */
if ( ! class_exists( 'wp_bootstrap_navwalker' )) {
    require_once(get_template_directory() . '/inc/wp_bootstrap_navwalker.php');
}

// Remove all currency symbols
function sww_remove_wc_currency_symbols( $currency_symbol, $currency ) {
	$currency_symbol = 'PLN';
	return $currency_symbol;
}
add_filter('woocommerce_currency_symbol', 'sww_remove_wc_currency_symbols', 10, 2);

// Our hooked in function - $fields is passed via the filter!
function custom_override_checkout_fields_sative( $fields ) {
	$fields['billing']['billing_address_2']['label'] = 'Ciąg dalszy adresu ';
	$fields['shipping']['shipping_address_2']['label'] = 'Ciąg dalszy adresu ';
	return $fields;
}
add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields_sative' );

/**
 * @snippet       Disable Payment Gateway For Specific Shipping Method
 * @how-to        Get CustomizeWoo.com FREE
 * @author        Rodolfo Melogli
 * @testedwith    WooCommerce 3.6.2
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */
function gateway_disable_shipping( $available_gateways ) 
{
	//if ( ! is_admin() ) {
	$chosen_methods = WC()->session->get( 'chosen_shipping_methods' );
	$chosen_shipping = $chosen_methods[0];
	if ( isset( $available_gateways['przelewy24'] ) && 0 === strpos( $chosen_shipping, 'flat_rate' ) ) {
		unset( $available_gateways['przelewy24'] );
	}
	//}
   	return $available_gateways;
}
add_filter( 'woocommerce_available_payment_gateways', 'gateway_disable_shipping' );


// Register Custom Taxonomy
function custom_taxonomy_marka()  {

	$labels = array(
		'name'                       => 'Nasze marki',
		'singular_name'              => 'Marka',
		'menu_name'                  => 'Marki',
		'all_items'                  => 'Wszystkie marki',
		'parent_item'                => 'Marka nadrzędna',
		'parent_item_colon'          => 'Marka nadrzędna:',
		'new_item_name'              => 'Nowa marka',
		'add_new_item'               => 'Dodaj nową markę',
		'edit_item'                  => 'Edytuj markę',
		'update_item'                => 'Aktualizuj markę',
		'separate_items_with_commas' => 'Marki przedzielone kropką',
		'search_items'               => 'Szukaj marek',
		'add_or_remove_items'        => 'Dodaj lub usuń markę',
		'choose_from_most_used'      => 'Wybierz z pośród najpopularniejszych marek',
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'marka', 'product', $args );
	
}
add_action( 'init', 'custom_taxonomy_marka', 0 );


if ( ! function_exists( 'sative_catalog_ordering' ) ) {

	/**
	 * Output the product sorting options.
	 */
	function sative_catalog_ordering() {
		if ( ! wc_get_loop_prop( 'is_paginated' ) || ! woocommerce_products_will_display() ) {
			return;
		}
		$show_default_orderby    = 'menu_order' === apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby', 'menu_order' ) );
		$catalog_orderby_options = apply_filters(
			'woocommerce_catalog_orderby',
			array(
				'menu_order' => __( 'Normalnie', 'woocommerce' ),
				'popularity' => __( 'Popularność', 'woocommerce' ),
				'rating'     => __( 'Po ocenach', 'woocommerce' ),
				'date'       => __( 'Po świeżości', 'woocommerce' ),
				'price'      => __( 'Hajs rosnąco', 'woocommerce' ),
				'price-desc' => __( 'Hajs malejąco', 'woocommerce' ),
			)
			// array(
			// 	'menu_order' => __( 'Default sorting', 'woocommerce' ),
			// 	'popularity' => __( 'Sort by popularity', 'woocommerce' ),
			// 	'rating'     => __( 'Sort by average rating', 'woocommerce' ),
			// 	'date'       => __( 'Sort by latest', 'woocommerce' ),
			// 	'price'      => __( 'Sort by price: low to high', 'woocommerce' ),
			// 	'price-desc' => __( 'Sort by price: high to low', 'woocommerce' ),
			// )
		);

		$default_orderby = wc_get_loop_prop( 'is_search' ) ? 'relevance' : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby', '' ) );
		$orderby         = isset( $_GET['orderby'] ) ? wc_clean( wp_unslash( $_GET['orderby'] ) ) : $default_orderby; // WPCS: sanitization ok, input var ok, CSRF ok.

		if ( wc_get_loop_prop( 'is_search' ) ) {
			$catalog_orderby_options = array_merge( array( 'relevance' => __( 'Relevance', 'woocommerce' ) ), $catalog_orderby_options );

			unset( $catalog_orderby_options['menu_order'] );
		}

		if ( ! $show_default_orderby ) {
			unset( $catalog_orderby_options['menu_order'] );
		}

		if ( ! wc_review_ratings_enabled() ) {
			unset( $catalog_orderby_options['rating'] );
		}

		if ( ! array_key_exists( $orderby, $catalog_orderby_options ) ) {
			$orderby = current( array_keys( $catalog_orderby_options ) );
		}

		wc_get_template(
			'loop/orderby.php',
			array(
				'catalog_orderby_options' => $catalog_orderby_options,
				'orderby'                 => $orderby,
				'show_default_orderby'    => $show_default_orderby,
			)
		);
	}
}

//remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
//remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

/**
 * Ensure variation combinations are working properly - standard limit is 30
 */
function woo_custom_ajax_variation_threshold( $qty, $product ) 
{
    return 500;
}       
add_filter( 'woocommerce_ajax_variation_threshold', 'woo_custom_ajax_variation_threshold', 10, 2 );

/**
 * Disable out of stock variations
 * https://github.com/woocommerce/woocommerce/blob/826af31e1e3b6e8e5fc3c1004cc517c5c5ec25b1/includes/class-wc-product-variation.php
 * @return Boolean
 */
function wcbv_variation_is_active( $active, $variation ) 
{
	if( ! $variation->is_in_stock() ) {
		return false;
	}
	return $active;
}
add_filter( 'woocommerce_variation_is_active', 'wcbv_variation_is_active', 10, 2 );


/**
 * Output the related products.
 */
if ( ! function_exists( 'woocommerce_output_related_products' ) ) 
{
	function woocommerce_output_related_products() 
	{
		global $upsellsused;
		if($upsellsused == false) { 
			$args = array(
				'posts_per_page' => 3,
				'columns'        => 3,
				'orderby'        => 'rand', // @codingStandardsIgnoreLine.
			);
			woocommerce_related_products( apply_filters( 'woocommerce_output_related_products_args', $args ) );
		}
	}
}

add_filter( 'woocommerce_hide_invisible_variations', '__return_true' );

// /**
//  * @snippet       Display "Quantity: #" @ WooCommerce Single Product Page
//  * @how-to        Get CustomizeWoo.com FREE
//  * @author        Rodolfo Melogli
//  * @testedwith    WooCommerce 3.6.2
//  */
// add_filter( 'woocommerce_get_availability_text', 'bbloomer_custom_get_availability_text', 99, 2 );  
// function bbloomer_custom_get_availability_text( $availability, $product ) 
// {
// 	$stock = $product->get_stock_quantity();
// 	if ( $product->is_in_stock() && $product->managing_stock() ) $availability = __( 'Ostatnia sztuka!', 'woocommerce' );
// 	return $availability;
// }