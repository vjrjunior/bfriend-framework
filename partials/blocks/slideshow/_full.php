<?php

/**
 * Slideshow Full Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'slideshow-' . $block['id'];
if( !empty($block['anchor']) ) {
  $id = $block['anchor'];
}

$className = 'slideshow';
if( !empty($block['className']) ) {
  $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
  $className .= ' align' . $block['align'];
}

// $text = get_field('slideshow') ?: 'Your testimonial here...';
?>
<?php if( have_rows('slideshow', get_option( 'page_on_front' )) ): ?>
  <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>" role="banner">
    <div class="banner">
      <?php
        while ( have_rows('slideshow', get_option( 'page_on_front' )) ) : the_row();
        $image = get_sub_field('image_slider');
      ?>
        <div class="banner--content" style="background-image: url(<?php echo $image['sizes']['slide']; ?>);">
          <?php
            if( get_sub_field('title_slider') ):
              echo '<h4>' . get_sub_field('title_slider') . '</h4>';
            endif;
            if( get_sub_field('desc_slider') ):
              echo '<p>' . get_sub_field('desc_slider') . '</p>';
            endif;
            if( get_sub_field('btn_slider') ):
              echo '<a href="' . get_sub_field('btn_slider')['url'] . '">'. get_sub_field('btn_slider')['title'] .'</a>';
            endif;
          ?>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
<?php endif; ?>
