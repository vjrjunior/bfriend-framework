<?php
function register_acf_block_types() {
  // register a full width slideshow block.
  acf_register_block_type([
    'name'              => 'slideshow',
    'title'             => __('Slideshow Full'),
    'description'       => __('Bloco para slideshow full.'),
    'render_template'   => 'partials/blocks/slideshow/_full.php',
    'category'          => 'common',
    'icon'              => 'dashicons-images-alt2',
    'keywords'          => ['slideshow', 'full', 'banner'],
  ]);
}

if( function_exists('acf_register_block_type') ) {
  add_action('acf/init', 'register_acf_block_types');
}
