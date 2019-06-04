<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />

		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<link href="<?php images_url('favicon.ico'); ?>" rel="shortcut icon" type="image/x-icon" />

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- google maps -->
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1P-H_fyEh6IaGS_mdIAPnMUIiQhKON2s"></script>
    <?php wp_head(); ?>
	</head>
  <body <?php body_class(); ?>>
    <div class="preloader"><div class="preloader__loader"><?php for ($i = 1; $i <= 2; $i++) { echo '<div></div>'; } ?></div></div>

    <header class="main-header">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <nav id="navbar" class="navbar navbar-expand-lg bsnav">
              <a class="navbar-brand" href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
                <img src="<?php echo get_field('logo', 'option'); ?>" class="img-fluid" />
              </a>
              <button class="navbar-toggler toggler-spring"><span class="navbar-toggler-icon"></span></button>
              <?php
                wp_nav_menu([
                  'theme_location'  => 'global',
                  'container'       => 'div',
                  'container_class' => 'collapse navbar-collapse justify-content-md-end',
                  'menu_id'         => false,
                  'menu_class'      => 'navbar-nav navbar-mobile',
                  'depth'           => 2,
                  'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
                  'walker'          => new wp_bootstrap_navwalker()
                ]);
              ?>
            </nav>

            <div class="bsnav-mobile">
              <div class="bsnav-mobile-overlay"></div>
              <div class="navbar"></div>
            </div>
          </div>
        </div>
      </div>
    </header>