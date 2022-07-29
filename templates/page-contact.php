<?php
  /* Template name: Contact */
  get_header();

	if ( have_posts() ) while ( have_posts() ) : the_post(); 
  _partial('_wrap-start');
  _partial('_h-page');

?>
  <article <?php post_class( 'p__contact' ); ?>>
    <header class="p__contact--header"></header>
    
    <div class="p__contact--content"></div>
    
    <footer class="p__contact--footer">
      <?php 
        $location = get_field('location_info', 'option');
        if( $location ): 
      ?>
        <div class="acf-map" data-zoom="16">
          <div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>"></div>
        </div>
      <?php endif; ?>
    </footer>
  </article>
<?php 
  _partial('_wrap-end');
  endwhile; 
  get_footer();
?>