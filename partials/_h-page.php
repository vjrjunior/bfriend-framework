<div class="s__h-page" 
  <?php 
    if ( is_singular('post') || is_home() ) { 
      thumbnail_bg_posts('header-full'); 
    } else { 
      thumbnail_bg( 'header-full' ); 
    } 
  ?>>
  <div class="container">
    <?php
      if (is_home() || is_singular('post')) :
        echo '<h1>Blog</h1>';
        echo '<h4>' . get_field('subtitle', get_option('page_for_posts')) . '</h4>';

      else :
        the_title('<h1>', '</h1>');
        echo '<h4>' . get_field('subtitle') . '</h4>';
      endif;
    ?>
  </div>

  <div class="container">
    <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
  </div>
</div>