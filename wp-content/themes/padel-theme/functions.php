<?php

// filters
function search_filter( $query ) {
	if ( $query->is_search ) {
		$query->set( 'category_name', 'vuorot' );
	}

	return $query;
}

add_filter( 'pre_get_posts', 'search_filter' );

function my_breadcrumb_title_swapper( $title, $type, $id ) {
	if ( in_array( 'home', $type ) ) {
		$title = __( 'Home' );
	}

	return $title;
}

add_filter( 'bcn_breadcrumb_title', 'my_breadcrumb_title_swapper', 3, 10 );


// actions
function theme_setup(): void {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-header' );
	add_theme_support( 'custom-logo', [
		'height'      => 100,
		'width'       => 200,
		'flex-height' => true,
	] );
	add_theme_support( 'html5', array( 'search-form' ) );

	// Set the default Post Thumbnail size
	set_post_thumbnail_size( 200, 200, true ); // 200px wide by 200px high, hard crop mode

	// Add custom image sizes
	add_image_size( 'custom-header', 1200, 400, true ); // Custom header size

	// Add menu
	register_nav_menu( 'main-menu', __( 'Main Menu' ) );
}

add_action( 'after_setup_theme', 'theme_setup' );

// load styles

function style_setup(): void {
	wp_enqueue_style( 'main-style', get_stylesheet_uri() );
    wp_enqueue_style( 'output', get_template_directory_uri() . '/src/output.css', array() );
}

add_action( 'wp_enqueue_scripts', 'style_setup' );

// load javascript

function script_setup(): void {
	wp_enqueue_script( 'single-post', get_template_directory_uri() . '/js/singlePost.js', [], '1.0', true );
	$script_data = [
		'ajax_url' => admin_url( 'admin-ajax.php' ),
	];
	wp_localize_script( 'single-post', 'singlePost', $script_data );
}

add_action( 'wp_enqueue_scripts', 'script_setup' );

function enqueue_user_data_js() {
    wp_enqueue_script('user-data-handler', get_template_directory_uri() . '/js/userDataHandler.js', array('jquery'), null, true);

    // Localize the script with data that we want to access in JavaScript
    wp_localize_script('user-data-handler', 'ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('ajax-nonce')
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_user_data_js');

// custom functions
require_once( __DIR__ . '/inc/article-function.php' );
require_once( __DIR__ . '/inc/random-image.php' );
require_once( __DIR__ . '/ajax-functions/single-post-function.php' );