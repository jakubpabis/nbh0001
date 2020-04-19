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

if( !$product->is_in_stock() ) : ?>
<div class="col-lg-4 col-md-6 products__list-item outstock">
<?php elseif( $product->is_on_sale() ) : ?>
<div class="col-lg-4 col-md-6 products__list-item salesale">
<?php else: ?>
<div class="col-lg-4 col-md-6 products__list-item">
<?php endif; ?>
	<div class="products__list-item-content text-center">
		<div class="products__list-item-content-img">
			<img src="<?= get_the_post_thumbnail_url('', 'medium') ?>" alt="" class="bg-cover">
		</div>
		<div class="products__list-item-content-text">
			<h2 class="title text-size-normal text-bold">
				<?= get_the_title(); ?>
			</h2>
			<?php if( $product->is_on_sale() && $product->is_in_stock() ) : ?>
			<span class="price text-size-xlarge" style="color: red;">
				<small><?= wc_price($product->get_regular_price()); ?></small>
				<i class="fas fa-long-arrow-alt-right"></i>
				<?= wc_price(get_post_meta( get_the_ID(), '_price', true )); ?>
			</span>
			<?php else: ?>
			<span class="price text-size-xlarge">
				<?= wc_price(get_post_meta( get_the_ID(), '_price', true )); ?>
			</span>
			<?php endif; ?>
		</div>
		<?php if( !$product->is_in_stock() ) : ?>
			<h4 class="outstock">Na zamówienie</h4>
		<?php elseif( $product->is_on_sale() ) : ?>
			<h4 class="onsale">SALE!</h4>
		<?php endif; ?>
		<a href="<?= get_permalink(); ?>" class="whole-element-link"></a>
	</div>
</div>
