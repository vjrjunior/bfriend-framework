<div class="h-page">
  <div <?php if ( is_single() || is_home() ) { thumbnail_bg_posts('header-full'); } else { thumbnail_bg( 'header-full' ); } ?>>
    <div class="container">
      <?php
        if (is_home() || is_single()) :
          echo '<h1>Blog</h1>';
          echo '<h4>' . get_field('subtitle', get_option('page_for_posts')) . '</h4>';

        else :
          the_title('<h1>', '</h1>');
          echo '<h4>' . get_field('subtitle') . '</h4>';
        endif;
      ?>
    </div>

    <div class="container">
      <?php
        if ( function_exists('yoast_breadcrumb') ) :
          yoast_breadcrumb(' <p id="breadcrumbs">','</p> ');
        endif;
      ?>
    </div>
  </div>
</div>