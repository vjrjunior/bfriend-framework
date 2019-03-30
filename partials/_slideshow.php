<?php if( have_rows('slideshow', get_option( 'page_on_front' )) ): ?>
  <div class="slideshow" role="banner">
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
