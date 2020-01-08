<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<div class="col-md-4 col-sm-6 col-10 products__list-item scene_element scene_element--fadeinleft-wide scene_element--delayed4">
	<div class="products__list-item-content text-center">
		<div class="products__list-item-content-img">
			<img src="<?= get_the_post_thumbnail_url('', 'medium') ?>" alt="" class="bg-cover">
		</div>
		<div class="products__list-item-content-text">
			<h2 class="title text-size-normal text-bold">
				<?= get_the_title(); ?>
			</h2>
			<span class="price text-size-xlarge">
				<?= wc_price(get_post_meta( get_the_ID(), '_price', true )); ?>
			</span>
		</div>
		<a href="<?= get_permalink(); ?>" class="whole-element-link"></a>
	</div>
</div>
