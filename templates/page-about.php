<?php
  /* Template name: About */
  get_header();

	if ( have_posts() ) while ( have_posts() ) : the_post(); 
  _partial('_wrap-start');
  _partial('_h-page');

?>
  <article <?php post_class( 'p__about' ); ?>>
    <header class="p__about--header"></header>
    
    <div class="p__about--content"></div>
    
    <footer class="p__about--footer"></footer>
  </article>
<?php 
  _partial('_wrap-end');
  endwhile; 
  get_footer();
?>