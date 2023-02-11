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
					<a class="logo d-inline-block" href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
            <?php echo wp_get_attachment_image( get_field('logo', 'option'), 'full', false, ['class' => 'img-fluid' ] ); ?>
					</a>
				</div>
			</div>
		</div>

		<div class="main-footer__copy">
			<div class="container d-flex flex-column flex-md-row align-items-center align-items-md-start justify-content-md-between text-center text-md-left">
        <p>© Copyright <?php echo date('Y') ?> - <?php bloginfo( 'name' ); ?> - Todos direitos reservados.</p>
				<?php _partial( '_bfriend' ); ?>
			</div>
		</div>
	</footer>

  <!-- <script src="https://maps.googleapis.com/maps/api/js?key=['KEY']"></script> -->
<?php wp_footer(); ?>
</body>
</html>