<?php
/**
 * Twenty Twelve functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are used
 * in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

if ( ! function_exists( 'twentytwelve_entry_meta' ) ) :
/**
 * 
 * Custom twentytwelve_entry_meta() to override the parent theme.
 * 
 */
function twentytwelve_entry_meta() {

	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'twentytwelve' ) );
	
	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'twentytwelve' ) );
	
	$date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);
	
	$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
		//esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_url( get_the_author_meta( 'user_url' ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'twentytwelve' ), get_the_author() ) ),
		get_the_author()
	);
	
	// Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
	//$utility_text = __( 'This entry was posted on %3$s<span class="by-author"> by %4$s</span>.', 'twentytwelve' );
	$utility_text = __( 'Posted on %3$s <span class="by-author">by %4$s</span>', 'twentytwelve' );
	
	printf(
		$utility_text,
		$categories_list,
		$tag_list,
		$date,
		$author
	);
}
endif;


/*
 * Customize excerpt more string
 */
function custom_excerpt_more($more) {
	return '...';
}
add_filter('excerpt_more', 'custom_excerpt_more');


/*
 * Customize excerpt's length
 */
function custom_excerpt_length($length) {
	return 22;
}
add_filter('excerpt_length', 'custom_excerpt_length');


/*
 * Conditional deregister BMoExpo
 */
function conditional_bmoexpo_deregister_style() {
	if( !( is_single() && ( in_category('slideshow') || in_category('news') || in_category('bahan-aktivitas-kelas') ) ) ) {
		wp_deregister_style('cssBMoExpo');
	}
}
add_action('wp_print_styles', 'conditional_bmoexpo_deregister_style');


/*
 * Conditional dequeue responsive slider stylesheets
 */
function conditional_responsive_slider_dequeue_stylesheets() {
	if( !is_home() ) {
		wp_dequeue_style('responsive-slider');
	}
}
add_action( 'template_redirect', 'conditional_responsive_slider_dequeue_stylesheets' );


/*
 * Conditional dequeue responsive slider scripts
 */
function conditional_responsive_slider_dequeue_scripts() {
	if( !is_home() ) {
		wp_dequeue_script('responsive-slider_flex-slider');
	}
}
add_action( 'template_redirect', 'conditional_responsive_slider_dequeue_scripts' );


/*
 * Register Download Monitor only in single post type
 */
function conditional_DM_deregister_style() {
	if(!is_single()) {
		wp_deregister_style('dlm-frontend');
	}
}
add_action('wp_print_styles', 'conditional_DM_deregister_style');


/*
 * Conditionally Hide Recent Post widget
 */
function conditional_hide_recentpost_widget($sidebars_widgets) {
	/* disable it only at home */
	if(is_home()) {
		/* get each sidebar / widget area */
		foreach($sidebars_widgets as $widget_area => $widget_list){
			/* get all widget list in the area */
			foreach( $widget_list as $pos => $widget_id ){
//				echo($widget_id);
				/* widget with id "recent-posts-2" */
				if ( $widget_id == 'recent-posts-2'){
					/* remove it */
					unset( $sidebars_widgets[$widget_area][$pos] );
				}
			}
		}
	}

	return $sidebars_widgets;
}
add_filter( 'sidebars_widgets', 'conditional_hide_recentpost_widget' );


/*
function load_google_jquery() {
	wp_dequeue_script('jquery');

	wp_enqueue_script(
		'jquery', //name
		'http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js', //google hosted, protocol independent
		array(), //dependencies (empty)
		NULL, //removes version
		true //load in footer, 'false' for header
	);
}
add_action('wp_enqueue_scripts', 'load_google_jquery');
*/


/*

add_action('wp_enqueue_scripts', 'load_jquery_onfooter');
function load_jquery_onfooter() {
	wp_deregister_script('jquery');
	wp_register_script(
		'jquery',
		false,
		array( 'jquery-core', 'jquery-migrate' ),
		'1.10.2',
		true
	);
	wp_enqueue_script('jquery');
}
*/


/*

add_action('wp_enqueue_scripts', 'load_jquerycore_onfooter');
function load_jquerycore_onfooter() {

	//$rhandle = 'jquery-core';
	//$rlist = 'enqueued';
	//if(wp_script_is($rhandle, $rlist)) {
	//	echo "jquery-core is enqueued\n";
	//} else {
	//	echo "jquery-core is not enqueued yet\n";
	//}
	
	wp_deregister_script('jquery-core');

	//if(wp_script_is($rhandle, $rlist)) {
	//	echo "jquery-core is enqueued\n";
	//} else {
	//	echo "jquery-core is not enqueued yet\n";
	//}
	
	wp_register_script(
		'jquery-core', //name
		'/wp-includes/js/jquery/jquery.js',
		array(),
		null,
		true //load in footer, 'false' for header
	);

	//if(wp_script_is($rhandle, $rlist)) {
	//	echo "jquery-core is enqueued\n";
	//} else {
	//	echo "jquery-core is not enqueued yet\n";
	//}
	
	wp_enqueue_script('jquery-core');
}
*/


/*

add_action('wp_enqueue_scripts', 'load_jquerymigrate_onfooter');
function load_jquerymigrate_onfooter() {

	//$rhandle = 'jquery-migrate';
	//$rlist = 'registered';
	//if(wp_script_is($rhandle, $rlist)) {
	//	echo "jquery-migrate is registered\n";
	//} else {
	//	echo "jquery-migrate is not registered yet\n";
	//}
		
	wp_deregister_script('jquery-migrate');

	//if(wp_script_is($rhandle, $rlist)) {
	//	echo "jquery-migrate is registered\n";
	//} else {
	//	echo "jquery-migrate is not registered yet\n";
	//}


  	$suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
	
	wp_register_script(
		'jquery-migrate', //name
		"/wp-includes/js/jquery/jquery-migrate$suffix.js",
		array(),
		null,
		true //load in footer, 'false' for header
	);

	//if(wp_script_is($rhandle, $rlist)) {
	//	echo "jquery-migrate is registered\n";
	//} else {
	//	echo "jquery-migrate is not registered yet\n";
	//}
	
	wp_enqueue_script('jquery-migrate');
}
*/


/*
 * Add the Open Graph and Facebook nameserver
 */
/*
*/
function add_opengraph_doctype( $output ) {
	return $output . ' xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml"';
}
add_filter('language_attributes', 'add_opengraph_doctype');


/*
 * Add the Open Graph meta info
 */
/*
*/
function insert_fb_in_head() {
	global $post;

	if ( !is_singular() )
		return;

	//echo '<meta property="fb:admins" content="YOUR USER ID"/>';
	echo '<meta property="og:site_name" content="' . get_bloginfo('name') . '"/>';
	echo '<meta property="og:url" content="' . get_permalink() . '"/>';
	echo '<meta property="og:type" content="article"/>';
	echo '<meta property="og:title" content="' . get_the_title() . '"/>';

	if ($post->post_excerpt) {  
        	$child_excerpt = $post->post_excerpt;
	}
	else {
		// If post excerpt is not set then take first 55 words from post content
		$child_excerpt_length = 22;
		// Clean post content
		$text = str_replace("\r\n", " ", strip_tags(strip_shortcodes($post->post_content)));
		$tmp = explode(' ', $text, $child_excerpt_length + 1);
		if (count($tmp) > $child_excerpt_length) {
			array_pop($tmp);
			$child_excerpt = implode(' ', $tmp);
//			return $excerpt;
		}
	}  
	echo '<meta property="og:description" content="' . $child_excerpt . '"/>';

	if(!has_post_thumbnail( $post->ID )) {
		$default_image="http://example.com/image.jpg";
		echo '<meta property="og:image" content="' . $default_image . '"/>';
	}
	else {
		$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
		echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
	}
	//echo '<meta property="fb:admins" content="2243253283320"/>';
	echo "	";
}
add_action( 'wp_head', 'insert_fb_in_head' );


/*
 * Add dashicons
 */
/*
add_action( 'wp_enqueue_scripts', 'add_dashicon_to_twentytwelve');
function add_dashicon_to_twentytwelve() {
	wp_enqueue_style( 'twentytwelve-child', get_stylesheet_uri(), array( 'dashicon' ));
}
*/


/*
 * Add search bar to navigation menu
 */
/*
add_filter( 'wp_nav_menu_items','add_search_box', 10, 2 );
function add_search_box( $items, $args ) {
	if( 'primary' === $args -> theme_location ) {
		$items .= '<li class="menu-item menu-item-search">';
		$items .= get_search_form( false );
		$items .= '</li>';
	}
	return $items;
}
*/


/*
 * Remove query string from style and script on wordpress' loading
 */
/*
*/
add_filter( 'script_loader_src', 'pu_remove_script_version' );
add_filter( 'style_loader_src', 'pu_remove_script_version' );
function pu_remove_script_version( $src ) {
	return remove_query_arg( 'ver', $src );
}


/*
 * Extend Wordpress HTTP Request Timeout Lengths
 */
/*
add_filter( 'http_request_timeout', 'extend_http_request_timeout' );
function extend_http_request_timeout( $timeout ) {
	return 30;
}
*/


//add_filter( 'dlm_access_denied_redirect', 'redirect_download_url' );
/* Downloads Monitor redirection to login page for non-logged in members trying to download content
 *
 */
function redirect_download_url() {
	//phpinfo();
	//$redirected_url = $_SERVER['HTTP_REFERER'];
 	//echo $redirected_url;
	//echo '\n';
	//$download_url = $_SERVER['REQUEST_URI'];
	//echo $download_url;
	//echo '\n';
	//$download_redirect = urlencode("{$redirected_url}?redirect-to={$download_url}");
	//echo $download_redirect;
	//echo '\n';
	//$myreturn = esc_url( __( home_url('/login.php'), 'twentytwelve' ) );
	//echo $myreturn;

	return esc_url( __( home_url('/wp-login.php'), 'twentytwelve' ) );
}


//add_filter( 'login_redirect', 'redirect_login_download' );
function redirect_login_download() {
	phpinfo();

	if ( isset( $_REQUEST['redirect_to'] ) ) {
		$redirected_url = $_REQUEST['redirect_to'];
	} else {
		$redirected_url = $_SERVER['HTTP_REFERER'];
	}
	//echo $redirected_url;
	//$download_url = $_SERVER['REQUEST_URI'];
	//echo $download_url;

	return esc_url( __( $redirected_url, 'twentytwelve' ) );	
}


//add_filter( 'loop_shop_columns', 'wc_loop_shop_columns', 1, 10 );
/*
* Return a new number of maximum columns for shop archives
* @param int Original value
* @return int New number of columns
*/
function wc_loop_shop_columns( $number_columns ) {

	return 2;
}
