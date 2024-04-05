<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />

		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<link href="<?php images_url('favicon.ico'); ?>" rel="shortcut icon" type="image/x-icon" />

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php if ( get_field('integrations_head', 'option') ) : ?>
      <?php echo get_field('integrations_head', 'option'); ?>
    <?php endif; ?>

    <?php wp_head(); ?>
	</head>
  <body <?php body_class(); ?>>
    <?php if ( get_field('integrations_body', 'option') ) : ?>
      <?php echo get_field('integrations_body', 'option'); ?>
    <?php endif; ?>
    <h1 class="visually-hidden"><?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?></h1>

    <header id="header" class="main-header">
      <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
          <?php if ( get_field('logo', 'option') ) : ?>
            <?php echo wp_get_attachment_image( get_field('logo', 'option'), 'full', false, ['class' => 'img-fluid' ] ); ?>
          <?php else : ?>
            <h2><?php bloginfo( 'name' ); ?></h2>
          <?php endif; ?>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#headerNavbar" aria-controls="headerNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="headerNavbar" aria-labelledby="headerNavbarLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="headerNavbarLabel">
              <?php if ( get_field('logo', 'option') ) : ?>
                <?php echo wp_get_attachment_image( get_field('logo', 'option'), 'full', false, ['class' => 'img-fluid' ] ); ?>
              <?php else : ?>
                <?php bloginfo( 'name' ); ?>
              <?php endif; ?>
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>

          <?php
            wp_nav_menu([
              'theme_location'  => 'global',
              'container'       => 'div',
              'container_class' => 'offcanvas-body',
              'menu_id'         => false,
              'menu_class'      => 'navbar-nav justify-content-start align-items-md-center flex-grow-1',
              'depth'           => 2,
              'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
              'walker'          => new wp_bootstrap_navwalker(),
            ]);
          ?>
        </div>
      </nav>
    </header>