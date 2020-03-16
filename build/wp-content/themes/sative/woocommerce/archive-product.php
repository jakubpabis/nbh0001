<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
//do_action( 'woocommerce_before_main_content' );
?>

<?php if( is_tax('marka') ): 
	$taxID = get_queried_object()->term_id; 
	$term = get_term($taxID);
	$image = get_field('img', 'marka_'.$term->term_id); 
	//var_dump($image);
	if($image): 
		$size = $image['sizes']['medium_large'];
		$alt = $image['alt'];
		$title = get_field('title', 'marka_'.$term->term_id) ? get_field('title', 'marka_'.$term->term_id) : $term->name;
		$text = $term->description;
	endif; ?>

	<section class="cards bg-grey">
		<div class="container">
		
			<div class="row justify-content-center align-items-end cards__item brands">
				<?php if($image): ?>
				<div class="col-xl-4 col-md-5 col-sm-10 col-11 cards__item-img">
					<div class="cards__item-img-cont">
						<img data-src="<?= esc_url($size); ?>" class="bg-cover lazy" alt="<?= $alt; ?>">
					</div>
				</div>
				<?php endif; ?>
				<div class="col-xl-8 col-md-7 col-sm-10 col-11 cards__item-text">
					<h1 class="text-upper text-tertiary title">
						<?= $title; ?>
					</h1>
					<?= $text; ?>
				</div>
			</div>

		</div>
	</section>

<?php endif; ?>

<section class="products__list">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-12">
				<div class="row products__list-top justify-content-between align-items-start">
					<div class="col-xl-8 col-md-7 col-12 products__list-title">
					<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
						<?php if( is_tax('marka') ): ?>
							<h2 class="text-size-xxxxlarge"><?php woocommerce_page_title(); ?></h2>
						<?php else: ?>
							<h1><?php woocommerce_page_title(); ?></h1>
						<?php endif; ?>
					<?php endif; ?>
					</div>
					<div class="col-lg-4 col-md-5 col-12 products__list-filter">
						<?php sative_catalog_ordering(); ?>
					</div>
				</div>
				<div class="row justify-content-center">

					<?php if ( woocommerce_product_loop() ) {

						if ( wc_get_loop_prop( 'total' ) ) {
							while ( have_posts() ) {
								the_post();
								wc_get_template_part( 'content', 'product' );
							}
						}

					} else {
						
						do_action( 'woocommerce_no_products_found' );

					} ?>

				</div>
			</div>
		</div>
		<div class="row justify-content-center">
			<?php do_action( 'woocommerce_after_shop_loop' ); ?>
		</div>
	</div>
</section>

<?php get_footer();
