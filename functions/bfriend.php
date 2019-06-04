<?php
// support title
add_theme_support( 'title-tag' );

// custom image sizes
add_action('init', 'bfriend_custom_image_sizes');
function bfriend_custom_image_sizes() {
  add_image_size('slide', 1920, 450, true);
  add_image_size('header-full', 1920, 300, true);
  add_image_size('post-thumb', 1000, 800, true);
}

// content limit
function content( $limit ) {
  $content = explode(' ', get_the_content(), $limit);
  if (count($content)>=$limit) {
    array_pop($content);
    $content = implode(" ",$content).'...';
  } else {
    $content = implode(" ",$content);
  }
  $content = preg_replace('/\[.+\]/','', $content);
  $content = apply_filters('the_content', $content);
  $content = str_replace(']]>', ']]&gt;', $content);
  return strip_tags($content);
}

// content limit based on $excerpt
function excerpt( $limit ) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }
  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
  return $excerpt;
}

// background thumbnail
function thumbnail_bg( $tamanho = 'full' ) {
  global $post;
  $get_post_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), $tamanho, false, '' );
  if ($get_post_thumbnail) {
    echo 'style="background-image: url('.$get_post_thumbnail[0].' );"';  
  } else if ($post->post_parent > 0 ) {
    $get_post_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->post_parent), $tamanho, false, '' );
    echo 'style="background-image: url('.$get_post_thumbnail[0].' );"';  
  } else {
    echo "no-bg";
  }    
}

// get background thumbnail
function get_thumbnail_bg( $tamanho = 'full' ) {
  global $post;
  $get_post_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), $tamanho, false, '' );
  if ($get_post_thumbnail) {
    return 'style="background-image: url('.$get_post_thumbnail[0].' );"';  
  } else if ($post->post_parent > 0 ) {
    $get_post_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->post_parent), $tamanho, false, '' );
    return 'style="background-image: url('.$get_post_thumbnail[0].' );"';  
  } else {
    return "no-bg";
  }    
}

// background thumbnail of page_for_posts
function thumbnail_bg_posts( $tamanho = 'full' ) {
  $get_post_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(get_option('page_for_posts')), $tamanho, false, '' );
  if ($get_post_thumbnail) {
    return 'style="background-image: url('.$get_post_thumbnail[0].' );"';
  } else {
    return "no-bg";
  }    
}

// clear url
function clear_url( $input ) {
  $input = trim($input, '/');
  if (!preg_match('#^http(s)?://#', $input)) {
    $input = 'http://' . $input;
  }
  $urlParts = parse_url($input);
  $domain = preg_replace('/^www\./', '', $urlParts['host']);
  return $domain;
}

// images url
function images_url( $file ) {
  echo get_stylesheet_directory_uri() . '/assets/images/'. $file;
}

// get images url
function get_images_url($file) {
  return get_stylesheet_directory_uri() . '/assets/images/'. $file;
}

// related posts
function bfriend_related( $args = [] ) { 
  global $post;
  $postTypeObj = get_post_type_object($post->post_type);    
  $taxonomies = isset($args['taxonomies']) ? $args['taxonomies'] : $postTypeObj->taxonomies;
  
  $defaultargsQuery = $argsQuery = array(       
    'post__not_in' => array($post->ID), 
    'post_type' => $post->post_type,
    'posts_per_page' => (isset($args['posts_per_page']) ? $args['posts_per_page'] : 3), 
  );

  $terms = wp_get_post_terms($post->ID, $taxonomies, ['fields' => 'ids']);
  $argsQuery['tax_query'] = [[
    'taxonomy' => $taxonomies[0],
    'field' => 'term_id',
    'terms' => $terms
  ]];

  $relatedPostsQuery = new WP_Query($argsQuery);
  if (!$relatedPostsQuery->have_posts()) {
    $relatedPostsQuery = new WP_Query($defaultargsQuery);
  } 

  if( $relatedPostsQuery->have_posts() ) {
    echo '<div id="post-relacionados">',
      '<h4 class="title"><i></i>'.(isset($args['title']) ? $args['title'] : 'Leia Também:').'</h4>',
      '<div class="items">';                      
        while ( $relatedPostsQuery->have_posts() ) : $relatedPostsQuery->the_post();
          get_template_part( 'contents/_loop' );
        endwhile;
    echo '</div>',
    '</div>';
  }

  wp_reset_query(); 
}

// default gallery
remove_shortcode('gallery');
add_shortcode('gallery', 'bfriend_default_gallery');
function bfriend_default_gallery($atts) {
  global $post;
  $pid = $post->ID;
  $gallery = '<div class="gallery">';

  if (empty($pid)) {$pid = $post['ID'];}

  extract(shortcode_atts(array('ids' => ''), $atts));    

  $args = [
    'post_type' => 'attachment', 
    'post__in' => explode(",",$ids),
    'post_mime_type' => 'image', 
    'numberposts' => -1
  ];  

  $images = get_posts($args);
  
  foreach ( $images as $image ) {
    $thumbnail = wp_get_attachment_image_src($image->ID, 'post-gallery');
    $thumbnail = $thumbnail[0];
    $gallery .= "
      <figure href='".$image->guid."' data-caption='".$image->post_title."' data-fancybox='gallery-".$ids."'>
        <img class='img-fluid' src='".$thumbnail."'>
        <figcaption>
          <p class='img-title'>".$image->post_title." <br> <small>".$image->post_excerpt."</small></p>          
        </figcaption>
      </figure>";
  }
  $gallery .= '</div>';
  return $gallery;
}

// wp_pagenavi with bootstrap
function bfriend_pagenavi_to_bootstrap($html) {
  $out = '';
  $out = str_replace('<div','',$html);
  $out = str_replace('class=\'wp-pagenavi\' role=\'navigation\'>','',$out);
  $out = str_replace('<a','<li class="page-item"><a class="page-link"',$out);
  $out = str_replace('</a>','</a></li>',$out);
  $out = str_replace('<span aria-current=\'page\' class=\'current\'','<li aria-current="page" class="page-item active"><span class="page-link current"',$out);
  $out = str_replace('<span class=\'pages\'','<li class="page-item"><span class="page-link pages"',$out);
  $out = str_replace('<span class=\'extend\'','<li class="page-item"><span class="page-link extend"',$out);  
  $out = str_replace('</span>','</span></li>',$out);
  $out = str_replace('</div>','',$out);
  return '<ul class="pagination" role="navigation">'.$out.'</ul>';
}
add_filter( 'wp_pagenavi', 'bfriend_pagenavi_to_bootstrap', 10, 2 );

// remove fixed width of images with non-captioned on .hentry
add_shortcode('wp_caption', 'fixed_img_caption_shortcode');
add_shortcode('caption', 'fixed_img_caption_shortcode');
function fixed_img_caption_shortcode($attr, $content = null) {
  if ( ! isset( $attr['caption'] ) ) {
    if ( preg_match( '#((?:<a [^>]+>\s*)?<img [^>]+>(?:\s*</a>)?)(.*)#is', $content, $matches ) ) {
      $content = $matches[1];
      $attr['caption'] = trim( $matches[2] );
    }
  }

  $output = apply_filters('img_caption_shortcode', '', $attr, $content);
  if ( $output != '' )
    return $output;

  extract(shortcode_atts(array(
    'id'    => '',
    'align'   => 'alignnone',
    'width'   => '',
    'caption' => ''
  ), $attr));

  if ( 1 > (int) $width || empty($caption) )
    return $content;

  if ( $id ) $id = 'id="' . esc_attr($id) . '" ';

  return '<div ' . $id . 'class="wp-caption ' . esc_attr($align) . '" style="width: auto">'
  . do_shortcode( $content ) . '<p class="wp-caption-text">' . $caption . '</p></div>';
}

// filter for responsive embed container
add_filter('embed_oembed_html', 'wrap_embed_with_div', 10, 3);
function wrap_embed_with_div($html, $url, $attr) {
  return "<div class=\"embed-responsive\">".$html."</div>";
}

// custom widget
class Custom_Widget extends WP_Widget {

  function __construct() {
    parent::__construct(
      'custom_widget',
      __('Banners', 'bfriend'),
      [ 'description' => __( 'Widget para banners.', 'bfriend' ) ]
    );
  }

  /**
   * Front-end display of widget.
   *
   * @see WP_Widget::widget()
   *
   * @param array $args     Widget arguments.
   * @param array $instance Saved values from database.
   */
  public function widget( $args, $instance ) {
    echo $args['before_widget'];
    if ( !empty($instance['title']) ) {
      echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
    }

    // repeater of banners
    if( have_rows('banners_widget', 'widget_' . $args['widget_id']) ):
    while ( have_rows('banners_widget', 'widget_' . $args['widget_id']) ) : the_row();
    
      $titulo = get_sub_field('titulo_banner');
      $image = get_sub_field('img_banner');
      $texto = get_sub_field('texto_banner');
      $url = get_sub_field('link_banner');
        echo '<div class="box-banner" style="background-image: url('. $image['sizes']['banner-thumb'] .')">',
                '<a href="'. $url .'">';
          if( !empty($titulo) ) :
            echo '<h1>'. $titulo .'</h1>',
                 '<p>'. $texto .'</p>';
          endif;
        echo    '</a>',
             '</div>';
    endwhile;
    endif;
    echo $args['after_widget'];
  }

  /**
   * Back-end widget form.
   *
   * @see WP_Widget::form()
   *
   * @param array $instance Previously saved values from database.
   */
  public function form( $instance ) {
    if ( isset($instance['title']) ) {
      $title = $instance['title'];
    }
    else {
      $title = __( 'Título', 'text_domain' );
    }
    ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
    </p>
    <?php
  }

  /**
   * Sanitize widget form values as they are saved.
   *
   * @see WP_Widget::update()
   *
   * @param array $new_instance Values just sent to be saved.
   * @param array $old_instance Previously saved values from database.
   *
   * @return array Updated safe values to be saved.
   */
  public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

    return $instance;
  }

}
add_action( 'widgets_init', function() { register_widget( 'Custom_Widget' ); });

class Mais_Lidos extends WP_Widget {
  /**
   * Registrando widget para campos acf
   */
  function __construct() {
    parent::__construct(
      'popular_widget',
      __('Mais lidos', 'text_domain'),
      array( 'description' => __( 'Exibe posts mais lidos.', 'text_domain' ), )
    );
  }

  /**
   * Front-end display of widget.
   *
   * @see WP_Widget::widget()
   *
   * @param array $args     Widget arguments.
   * @param array $instance Saved values from database.
   */
  public function widget( $args, $instance ) {
    echo $args['before_widget'];
    if ( !empty($instance['title']) ) {
      echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
    }
      $my_query = new WP_Query( array( 'post_type' => 'post', 'orderby' => 'meta_value_num', 'order' => 'DESC', 'posts_per_page' => 8  ) ); 
      echo '<div class="widget mais-acessados">';
      echo '<h3><i class="fa fa-heart"></i> Mais lidos</h3>';

      while ( $my_query->have_posts() ) : $my_query->the_post(); 
    ?>
      <article class="box-ultimas">
        <figure class="thumb pull-left">
          <a href="<?php the_permalink(); ?>" title="Continue lendo sobre: <?php the_title(); ?>">
            <?php the_post_thumbnail( 'post-small', array( 'class' => 'img-responsive' ) ); ?>
          </a>
        </figure>
        <header class="conteudo-home pull-right">
          <a href="<?php the_permalink(); ?>" title="Continue lendo sobre: <?php the_title(); ?>"><?php the_title(); ?></a>
          <p><i class="fa fa-calendar"></i> <?php the_time('j \d\e F \d\e Y'); ?></p>
        </header>
      </article>
    <?php endwhile; 
      echo '</div>';
      wp_reset_query();
    echo $args['after_widget'];
  }

  /**
   * Back-end widget form.
   *
   * @see WP_Widget::form()
   *
   * @param array $instance Previously saved values from database.
   */
  public function form( $instance ) {
    if ( isset($instance['title']) ) {
      $title = $instance['title'];
    }
    else {
      $title = __( 'Título', 'text_domain' );
    }
    ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
    </p>
    <?php
  }

  /**
   * Sanitize widget form values as they are saved.
   *
   * @see WP_Widget::update()
   *
   * @param array $new_instance Values just sent to be saved.
   * @param array $old_instance Previously saved values from database.
   *
   * @return array Updated safe values to be saved.
   */
  public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

    return $instance;
  }

}
add_action( 'widgets_init', function() { register_widget( 'Mais_Lidos' ); });

// change post class for into posts
function custom_post_class( $classes, $class, $post_id ) {
  if ( is_home() ) {
    $classes[] = 'block__post--into';
  }
  return $classes;
}
add_filter( 'post_class', 'custom_post_class', 10, 3 );

// change recent posts widget
Class My_Recent_Posts_Widget extends WP_Widget_Recent_Posts {
  function widget($args, $instance) {
    extract( $args );
    
    $title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts') : $instance['title'], $instance, $this->id_base);
        
    if( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
      $number = 10;
          
    $r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );
    if( $r->have_posts() ) :
      
      echo $before_widget;
      if( $title ) echo $before_title . $title . $after_title; 
  ?>
    <ul class="recent-posts">
      <?php $i=1; while( $r->have_posts() ) : $r->the_post(); ?>				
        <li class="media">
          <a href="<?php the_permalink(); ?>" title="Saiba mais: <?php the_title(); ?>" aria-hidden="true" tabindex="-1" class="mr-3">
            <figure class="mb-0">
              <?php the_post_thumbnail( 'thumbnail', ['class' => 'img-fluid'] ); ?>
              <span class="count"><?php echo $i.'.'; ?></span>
              <span class="mask"></span>
            </figure>
          </a>
          <span class="media-body">
            <a href="<?php the_permalink(); ?>" class="title" title="<?php the_title(); ?>"><?php the_title(); ?></a>
            <time class="mb-2 d-flex align-items-center"><i class="icon icon-calendar mr-2"></i><?php the_time('d \d\e F \d\e Y'); ?></time>
          </span>
        </li>
      <?php $i++; endwhile; ?>
    </ul>
  <?php
      echo $after_widget;
      wp_reset_postdata();
    
    endif;
  }
}
add_action('widgets_init', 'bfriend_recent_widget_registration');
function bfriend_recent_widget_registration() {
  unregister_widget('WP_Widget_Recent_Posts');
  register_widget('My_Recent_Posts_Widget');
}