<?php
// key acf google maps
function bfriend_acf_init() {
  acf_update_setting('google_api_key', '[KEY]');
}
add_action('acf/init', 'bfriend_acf_init');  

// taxonomy background
function taxonomy_thumbnail_bg( $nomeField ) {
  global $post;
  $queried_object = get_queried_object();
  $taxonomy = $queried_object->taxonomy;
  $term_id = $queried_object->term_id;

  if (get_field($nomeField, $queried_object)) {
    $src = get_field($nomeField, $queried_object);
  } else {
    return;
  }
  echo 'style="background-image: url('. $src .' );"';
}

// acf field background
function acf_thumbnail_bg( $nomeField ) {
  global $post;
  if (get_field($nomeField)) {
    $src = get_field($nomeField);
  } else {
    return;
  }
  echo 'style="background-image: url('. $src .' );"';
}

// acf sub_field background
function acf_sub_thumbnail_bg( $nomeField ) {
  global $post;
  if (get_sub_field($nomeField)) {
    $src = get_sub_field($nomeField);
  } else {
    return;
  }
  echo 'style="background-image: url('. $src .' );"';
}

// json sync
add_filter('acf/settings/save_json', 'bf_acf_json_save_point');
function bf_acf_json_save_point( $path ) {  
  $path = get_stylesheet_directory() . '/assets/json';
  return $path;
}

add_filter('acf/settings/load_json', 'bf_acf_json_load_point');
function bf_acf_json_load_point( $paths ) {
  unset($paths[0]);
  $paths[] = get_stylesheet_directory() . '/assets/json';
  return $paths;   
}