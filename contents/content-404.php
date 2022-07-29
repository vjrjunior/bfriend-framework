<div class="container">
	<div class="row">
		<div class="col-md-12">
      <article <?php post_class('p p__404'); ?> >
        <h1><?php _e( 'Página não encontrada :(', 'bfriend' ); ?></h1>
        <p><?php _e( 'Acho que você se perdeu, digite abaixo o que procura ou volte para a página inicial.', 'bfriend' ); ?></p>
        <?php get_search_form(); ?>
      </article>
		</div>
	</div>
</div>

<script type="text/javascript">
	document.getElementById('s') && document.getElementById('s').focus();
</script>