<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $related_products ) : ?>

	<section class="products__single-related products__list">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12 text-center">
					<h3 class="text-size-xxxlarge text-upper text-tertiary mb-4">
						Obczaj też te fanty!
					</h3>
				</div>
			</div>

			<div class="row justify-content-center">

				<?php foreach ( $related_products as $related_product ) : ?>

					<?php
						$post_object = get_post( $related_product->get_id() );

						setup_postdata( $GLOBALS['post'] =& $post_object );

						wc_get_template_part( 'content', 'product' ); ?>

				<?php endforeach; ?>

			</div>

		</div>
	</section>

<?php endif;

wp_reset_postdata();
