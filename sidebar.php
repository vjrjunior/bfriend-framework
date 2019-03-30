<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.1
 */
if ( is_active_sidebar( 'sidebar-main' ) ) :

	echo '<aside class="main-sidebar col-md-4">';
		dynamic_sidebar( 'sidebar-main' );
	echo '</aside>';

endif;