<?php
// content section
function content_section( $field, $class = false, $id = false ) {

  $title = get_field($field.'_title', $id);
  $sub   = get_field($field.'_subtitle', $id);
  $desc  = get_field($field.'_desc', $id);
  $btn   = get_field($field.'_btn', $id);

  if ( $title || $sub) :
    echo '<div class="s__h-section '.$class.'">';
      if ($title) { echo '<h2>'. $title .'</h2>'; }
      if ($sub)   { echo '<h3>'. $sub .'</h3>'; }
      if ($desc)  { echo '<p>'. $desc .'</p>'; }
      if ($btn)   { echo '<a href="'.esc_url( $btn['url'] ).'" target="'.esc_attr( $btn['target'] ).'" class="btn btn__classic">'.esc_html( $btn['title'] ).'</a>'; }
    echo '</div>';
  endif;
}

// classic button
function btn_classic( $field, $class = '', $id = false ) {
  $field = get_field( $field, $id );
  if ( $field ) :
    $link_url    = $field['url'];
    $link_title  = $field['title'];
    $link_target = $field['target'] ? $field['target'] : '_self';
    
    echo '<a href="'.esc_url( $link_url ).'" class="btn btn__classic '.$class.'" target="'.esc_attr( $link_target ).'">'. esc_html( $link_title ) .'</a>';
  endif;
}

// customize medium-editor
add_filter('medium-editor-theme', 'bf_medium_editor_theme_function');
function bf_medium_editor_theme_function($theme) {
  $theme = 'beagle';
  return $theme;
}