<article <?php post_class( 'block__result' ); ?>>
  <header class="block__result--header">
    <figure>
      <a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
        <?php the_post_thumbnail( 'post-thumb', ['class' => 'img-fluid'] ); ?>
      </a>
    </figure>
  </header>

  <div class="block__result--content">
    <ul class="infos">
      <li class="time"><time><?php the_time('l, d \d\e F \d\e Y'); ?></time></li>
      <li class="author"><?php _e( 'Publicado por', 'bfriend' ); ?> <?php the_author_posts_link(); ?></li>
      <li class="comments"><?php comments_number( '0 comentário', '1 comentário', '% comentários' ); ?></li>
    </ul>
    <p><?php the_category(', '); ?></p>
    <p><?php echo content(40); ?></p>
  </div>

  <footer class="block__result--footer">
    <a href="<?php the_permalink(); ?>" title="Saiba mais sobre: <?php the_title(); ?>" class="btn btn__classic">saiba mais</a>
  </footer>
</article>