<?php
  /* Template name: Empresa */
  get_header();

	if ( have_posts() ) while ( have_posts() ) : the_post(); 
  get_template_part('partials/_wrap-start');
  get_template_part('partials/_h-page');

?>
  <article <?php post_class( 'p p__company' ); ?>>
    <header></header>
    
    <div class="p__company--content"></div>
    
    <footer></footer>
  </article>
<?php 
  get_template_part('partials/_wrap-end');
  endwhile; 
  get_footer();
?>