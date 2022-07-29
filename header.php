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

    <?php if ( get_field('integrations', 'option') ) : ?>
      <?php echo get_field('integrations', 'option'); ?>
    <?php endif; ?>

    <?php wp_head(); ?>
	</head>
  <body <?php body_class(); ?>>
    <h1 class="visually-hidden"><?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?></h1>

    <header class="main-header fixed-top">
      <div class="container">
        <nav id="navbar" class="navbar navbar-expand-lg bsnav">
          <a class="navbar-brand" href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
            <?php if ( get_field('logo', 'option') ) : ?>
              <?php echo wp_get_attachment_image( get_field('logo', 'option'), 'full', false, ['class' => 'img-fluid' ] ); ?>          
            <?php else : ?>
              <h2><?php bloginfo( 'name' ); ?></h2>
            <?php endif; ?>
          </a>

          <button class="navbar-toggler toggler-spring"><span class="navbar-toggler-icon"></span></button>

          <?php
            wp_nav_menu([
              'theme_location'  => 'global',
              'container'       => 'div',
              'container_class' => 'collapse navbar-collapse justify-content-md-center',
              'menu_id'         => false,
              'menu_class'      => 'navbar-nav navbar-mobile ms-auto',
              'depth'           => 1,
              'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
              'walker'          => new wp_bootstrap_navwalker(),
            ]);
          ?>
        </nav>
      </div>
    </header>

    <div class="bsnav-mobile">
      <div class="bsnav-mobile-overlay"></div>
      <div class="navbar justify-content-start">
        <button type="button" class="btn-close btn-close-menu ms-auto" aria-label="Close"></button>
      </div>
    </div>