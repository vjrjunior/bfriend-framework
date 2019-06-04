<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.1
 */
?>

	<footer class="main-footer" role="contentinfo">
		<div class="container">
			<div class="row">
				<div class="col-md-2">
					<a id="logotipo" class="logotipo d-inline-block" href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
						<img src="<?php echo get_field('logo_footer', 'option'); ?>" class="img-fluid" />
					</a>
				</div>
			</div>
		</div>

		<div class="main-footer__copy">
			<div class="container d-flex justify-content-between">
        <p>© Copyright <?php echo date('Y') ?> - <?php bloginfo( 'name' ); ?> - Todos direitos reservados.</p>
				<?php get_template_part( 'partials/_bfriend' ); ?>
			</div>
		</div>
	</footer>

<?php wp_footer(); ?>
<script>jQuery(document).ready(function($) { jQuery('body').addClass('preload'); }); jQuery(window).load(function() { jQuery('.preloader').fadeOut(500); jQuery('body').removeClass('preload'); });</script>
</body>
</html>