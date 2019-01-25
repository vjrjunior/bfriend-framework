<!-- slideshow -->
<?php if( have_rows('slideshow',get_option( 'page_on_front' )) ): ?>
  <div class="slideshow" role="banner">
    <div class="banner">
      <?php
        while ( have_rows('slideshow',get_option( 'page_on_front' )) ) : the_row();
        $image = get_sub_field('image_slider');
        $url = $image['url'];
        $size = 'slide';
        $thumb = $image['sizes'][ $size ];
      ?>
        <div>
          <div class="banner-mask">
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
          <img src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" class="img-fluid" />
        </div>
      <?php endwhile; ?>
    </div>
  </div>
<?php endif; ?>
<!-- slideshow end -->