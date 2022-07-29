<?php

  get_header();

    _partial('_wrap-start');
      _partial('_h-page');

      if (is_home()) :
        _content('content-index');

      elseif (is_singular('post')) :
        _content('content-single');

      elseif (is_404()) :
        _content('content-404');

      elseif (is_search()) :
        _content('content-search');

      else :
        _content('content-page');

      endif;

    _partial('_wrap-end');
  
  get_footer();