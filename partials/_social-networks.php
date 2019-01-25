<?php if( have_rows('social_info', 'option') ): ?>
  <ul class="social-networks">
    <li>Conecte-se conosco:</li>
    <?php  while ( have_rows('social_info', 'option') ) : the_row(); ?>
      <li>
        <a href="<?php the_sub_field('url_info'); ?>" target="_blank">
          <?php the_sub_field('icon_info'); ?>
        </a>
      </li>
    <?php endwhile; ?>
  </ul>
<?php endif; ?>