<?php

/* ----------------------------------------------------- */
/* Criando Custom Post Type */
/* ----------------------------------------------------- */
add_action( 'init', 'register_cpt_type' );

function register_cpt_type() {
  $labels_post = [
    'name'               => _x( 'Type', 'bfriend' ),
    'singular_name'      => _x( 'Type', 'bfriend' ),
    'add_new'            => _x( 'Adicionar novo', 'bfriend' ),
    'add_new_item'       => _x( 'Adicionar novo type', 'bfriend' ),
    'edit_item'          => _x( 'Editar type', 'bfriend' ),
    'new_item'           => _x( 'Novo type', 'bfriend' ),
    'view_item'          => _x( 'Ver type', 'bfriend' ),
    'search_items'       => _x( 'Buscar type', 'bfriend' ),
    'not_found'          => _x( 'Nenhum type encontrado', 'bfriend' ),
    'not_found_in_trash' => _x( 'Nenhum type encontrado na lixeira', 'bfriend' ),
    'parent_item_colon'  => _x( 'Parent type:', 'bfriend' ),
    'menu_name'          => _x( 'Types', 'bfriend' )
  ];

  $args = [
    'labels'              => $labels_post,
    'hierarchical'        => false,
    'taxonomies'          => array( 'cat-type' ),
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'menu_position'       => 5,
    'menu_icon'           => 'dashicons-admin-generic',
    'show_in_nav_menus'   => true,
    'publicly_queryable'  => true,
    'exclude_from_search' => false,
    'has_archive'         => true,
    'query_var'           => true,
    'can_export'          => true,
    'rewrite'             => true,
    'capability_type'     => 'post',
    'supports'            => [
      'title', 
      'editor', 
      'thumbnail',
      // 'excerpt',
      // 'custom-fields',
      // 'trackbacks',
      // 'comments',
      // 'author', 
      // 'revisions',
      // 'page-attributes',
      // 'post-formats'
    ]
  ];
  register_post_type( 'type', $args );

  // register taxonomy
  $labels_tax = [
    'name'              => _x( 'Categorias ', 'taxonomy general name' ),
    'singular_name'     => _x( 'Categoria', 'taxonomy singular name' ),
    'search_items'      =>  __( 'Buscar categoria' ),
    'all_items'         => __( 'Todas categorias' ),
    'parent_item'       => __( 'Parent categoria' ),
    'parent_item_colon' => __( 'Parent categoria:' ),
    'edit_item'         => __( 'Editar categoria' ),
    'update_item'       => __( 'Atualizar categoria' ),
    'add_new_item'      => __( 'Adicionar nova categoria' ),
    'new_item_name'     => __( 'Novo nome de categoria' )
  ];
  register_taxonomy('cat-type',array('type'), array(
    'hierarchical' => true,
    'labels'       => $labels_tax,
    'show_ui'      => true,
    'query_var'    => true,
  ));
}