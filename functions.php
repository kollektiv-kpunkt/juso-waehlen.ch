<?php

/* Script Enqueue */
function enqueue_files_juso() {
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/lib/font-awesome/css/font-awesome.min.css' );
    wp_enqueue_style( 'style', get_template_directory_uri() . '/public/style/style.css' );
    wp_enqueue_script( 'script', get_template_directory_uri() . '/public/js/script.js', array('jquery'), '1.0.0', false );
}
add_action( 'wp_enqueue_scripts', 'enqueue_files_juso' );

/* Theme supports */
function theme_setup_juso(){
    /** automatic feed link*/
    add_theme_support( 'automatic-feed-links' );
 
    /** tag-title **/
    add_theme_support( 'title-tag' );
 
    /** post formats */
    $post_formats = array('aside','image','gallery','video','audio','link','quote','status');
    add_theme_support( 'post-formats', $post_formats);
 
    /** post thumbnail **/
    add_theme_support( 'post-thumbnails' );
}
add_action('after_setup_theme','theme_setup_juso');



/* Default Plugins */

require_once __DIR__ . '/lib/plugins/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'register_required_plugins' );

function register_required_plugins() {
	$plugins = array( 

        array(
            'name' => 'Advanced Custom Fields: Image Aspect Ratio Crop',
            'slug' => 'acf-image-aspect-ratio-crop',
            'source'    => __DIR__ . '/lib/plugins/acf-image-aspect-ratio-crop.zip',
            'required' => true,
            'force_activation' => false,
            'force_deactivation' => true
        ),
        
        array(
            'name' => 'Custom Post Type UI',
            'slug' => 'custom-post-type-ui',
            'source'    => __DIR__ . '/lib/plugins/custom-post-type-ui.zip',
            'required' => true,
            'force_activation' => false,
            'force_deactivation' => true
        ),
        
        array(
            'name' => 'Favicon by RealFaviconGenerator',
            'slug' => 'favicon-by-realfavicongenerator',
            'source'    => __DIR__ . '/lib/plugins/favicon-by-realfavicongenerator.zip',
            'required' => true,
            'force_activation' => false,
            'force_deactivation' => true
        ),
        
        array(
            'name' => 'The SEO Framework',
            'slug' => 'autodescription',
            'source'    => __DIR__ . '/lib/plugins/autodescription.zip',
            'required' => true,
            'force_activation' => false,
            'force_deactivation' => true
        ),

    );

    $config = array(
        'id'           => 'tgm_act',
        'default_path' => '',
        'menu'         => 'tgmpa-install-plugins',
        'parent_slug'  => 'themes.php',
        'capability'   => 'edit_theme_options',
        'has_notices'  => true,
        'dismissable'  => true,
        'dismiss_msg'  => '',
        'is_automatic' => true,
        'message'      => '',
    );

    
    tgmpa( $plugins, $config );
}

// ACF - Advanced Custom Fields
// Define path and URL to the ACF plugin.
define( 'MY_ACF_PATH', get_stylesheet_directory() . '/lib/plugins/acf/' );
define( 'MY_ACF_URL', get_stylesheet_directory_uri() . '/lib/plugins/acf/' );

// Include the ACF plugin.
include_once( MY_ACF_PATH . 'acf.php' );

// Customize the url setting to fix incorrect asset URLs.
add_filter('acf/settings/url', 'my_acf_settings_url');
function my_acf_settings_url( $url ) {
    return MY_ACF_URL;
}

add_filter('acf/settings/save_json', 'my_acf_json_save_point');
 
function my_acf_json_save_point( $path ) {
    $path = MY_ACF_PATH . '/acf-json';
    return $path;
}


add_filter('acf/settings/load_json', 'add_acf_json_load_folder');
function add_acf_json_load_folder( $paths ) {
    unset($paths[0]);
    $paths[] = MY_ACF_PATH . '/acf-json';;
    return $paths;
}

// Hide the ACF admin menu item.
add_filter('acf/settings/show_admin', 'my_acf_settings_show_admin');
function my_acf_settings_show_admin( $show_admin ) {
    return true;
}


/* Register Menus */
function register_juso_menus() {
    register_nav_menu( 'primary', __( 'Primary Navigation Menu', 'primary' ) );
}

add_action( 'after_setup_theme', 'register_juso_menus' );


// Custom Functions
function get_juso_partial($name) {
    get_template_part("templates/template_parts/{$name}/index");

    if (file_exists(__DIR__ . "/templates/template_parts/{$name}/style.css")) {
        wp_enqueue_style( $name, get_template_directory_uri() . "/templates/template_parts/{$name}/style.css");
    }
    
    if (file_exists(__DIR__ . "/templates/template_parts/{$name}/script.js")) {
        wp_enqueue_script( $name, get_template_directory_uri() . "/templates/template_parts/{$name}/script.js", array('jquery'), '1.0.0', true );
    }
}

function get_nav_location( $location, $args = [] ) {
 
    // Get all locations
    $locations = get_nav_menu_locations();
 
    // Get object id by location
    $object = wp_get_nav_menu_object( $locations[$location] );
 
    // Get menu items by menu name
    $menu_items = wp_get_nav_menu_items( $object->name, $args );
 
    // Return menu post objects
    return $menu_items;
}



/* Custome API Endpoints */
function filter_rest_gemeinde_query( $args, $request ) { 
    $params = $request->get_params(); 
    if(isset($params['gemeinde_slug'])){
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'gemeinde',
                'field' => 'slug',
                'terms' => explode(',', $params['gemeinde_slug'])
            )
        );
    }
    return $args; 
}   
// add the filter 
add_filter( "rest_kandidierende_query", 'filter_rest_gemeinde_query', 10, 2 ); 


class all_terms
{
    public function __construct()
    {
        $version = '2';
        $namespace = 'wp/v' . $version;
        $base = 'all-terms';
        register_rest_route($namespace, '/' . $base, array(
            'methods' => 'GET',
            'callback' => array($this, 'get_all_terms'),
        ));
    }

    public function get_all_terms($object)
    {
        $return = array();
        $args = array(
            'public' => true,
            '_builtin' => false
        );
        $output = 'names'; // or objects
        $operator = 'and'; // 'and' or 'or'
        $taxonomies = get_taxonomies($args, $output, $operator);
        foreach ($taxonomies as $key => $taxonomy_name) {
            if($taxonomy_name = $_GET['term']){
            $return = get_terms($taxonomy_name);
        }
        }
        return new WP_REST_Response($return, 200);
    }
}



/* Shortcodes */

function juso_kandimap_shortcode($atts) { 
    ob_start();
    get_juso_partial("kandimap");
    return ob_get_clean();

} 

add_shortcode('juso-kandimap', 'juso_kandimap_shortcode'); 

function juso_sektionenmap_shortcode($atts) { 
    ob_start();
    get_juso_partial("sektionenmap");
    return ob_get_clean();

} 

add_shortcode('juso-sektionenmap', 'juso_sektionenmap_shortcode'); 


function juso_kandis_shortcode($atts) { 
    global $post;
    $atts = shortcode_atts(array(
        "sektion" => $post->post_name,
    ), $atts);
    ob_start();
    get_template_part("templates/template_parts/kandis/index", null, $atts);
    return ob_get_clean();

} 

add_shortcode('juso-kandis', 'juso_kandis_shortcode'); 


function juso_bestellformular_shortcode($atts) { 
    global $post;
    $atts = shortcode_atts(array(
        "sektion" => $post->post_name,
    ), $atts);
    wp_enqueue_style( 'notyf', "https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css" );
    wp_enqueue_style( 'bestellformular', get_template_directory_uri() . '/templates/template_parts/bestellformular/style.css' );
    wp_enqueue_script( 'notyf', "https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js", array('jquery'), '1.0.0', false);
    wp_enqueue_script( 'bestellformular', get_template_directory_uri() . '/templates/template_parts/bestellformular/script.js', array('jquery'), '1.0.0', false);
    ob_start();
    get_template_part("templates/template_parts/bestellformular/index", null, $atts);
    return ob_get_clean();

} 

add_shortcode('juso-bestellformular', 'juso_bestellformular_shortcode'); 


/* Blocks */

add_action('acf/init', 'juso_init_block_types');
function juso_init_block_types() {

    // Check function exists.
    if( function_exists('acf_register_block_type') ) {

        // register a testimonial block.
        acf_register_block_type(array(
            'name'              => 'details',
            'title'             => __('Details'),
            'description'       => __('Details block for expandable details.'),
            'render_template'   => 'templates/blocks/details/details.php',
            'category'          => 'formatting',
            'icon'              => 'info-outline',
            'keywords'          => array( 'details', 'more' ),
        ));
    }
}