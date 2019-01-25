<?php

  get_header();

    get_template_part('partials/_wrap-start');

      if (is_home()) :
        get_template_part( 'contents/_loop-index' );

      elseif (is_singular('post')) :
        get_template_part( 'contents/_loop-single' );

      elseif (is_404()) :
        get_template_part( 'contents/_loop-404' );

      elseif (is_search()) :
        get_template_part( 'contents/_loop-search' );

      else :
        get_template_part( 'contents/_loop-page' );

      endif;

    get_template_part('partials/_wrap-end');
  
  get_footer();