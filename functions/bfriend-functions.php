<?php
// dequeue native styles and enqueue styles of theme
function bfriend_dequeue_styles( $enqueue_styles ) {
  unset( $enqueue_styles['woocommerce-general'] );
  unset( $enqueue_styles['woocommerce-layout'] );
  // unset( $enqueue_styles['woocommerce-smallscreen'] );
  return $enqueue_styles;
}
add_filter( 'woocommerce_enqueue_styles', 'bfriend_dequeue_styles' );

function wp_enqueue_woocommerce_style(){
  wp_register_style( 'bfriend-woocommerce', get_template_directory_uri() . '/assets/css/min/woocommerce-min.css' );
  wp_register_style( 'bfriend-woocommerce-layout', get_template_directory_uri() . '/assets/css/min/woocommerce-layout-min.css' );
  
  if ( class_exists( 'woocommerce' ) ) {
    wp_enqueue_style( 'bfriend-woocommerce' );
    wp_enqueue_style( 'bfriend-woocommerce-layout' );
  }
}
add_action( 'wp_enqueue_scripts', 'wp_enqueue_woocommerce_style' );

// woocommerce mini cart
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );
function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
  ob_start();
  
  // add anchor on header
?>
  <a class="cart-customlocation car" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="Carrinho de compras">
    <i class="icon icon-cart mr-2"></i>
    Carrinho (<?php echo sprintf ( _n( '%d', '%d', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?>)
  </a>
<?php
	$fragments['a.cart-customlocation'] = ob_get_clean();
	return $fragments;
}

// thumbnail sizes of woocommerce
// add_filter( 'single_product_archive_thumbnail_size', function( $size ) {
//   return 'product-thumb';
// } );