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

get_header();

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
//do_action( 'woocommerce_before_main_content' );
?>

<?php if ( function_exists('yoast_breadcrumb') ) : ?>
	<aside class="breadcrumbs <?= is_tax('marka') ? 'bg-grey1' : null ?>">
		<div class="container">
			<div class="row">
				<?php 
					$args = array(
						'delimiter' => '➞',
						'wrap_before' => '<div class="col-12"><span>',
						'wrap_after' => '</span></div>',
						'before' => '<span>',
						'after' => '</span>'
					);
					woocommerce_breadcrumb($args);
				?>
			</div>
		</div>
	</aside>
<?php endif; ?>

<?php if( is_tax('marka') ): 
	$taxID = get_queried_object()->term_id; 
	$term = get_term($taxID);
	$image = get_field('img', 'marka_'.$term->term_id); 
	//var_dump($image);
	if($image): 
		$size = $image['sizes']['medium'];
		$alt = $image['alt'];
		$title = get_field('title', 'marka_'.$term->term_id) ? get_field('title', 'marka_'.$term->term_id) : $term->name;
		$text = $term->description;
	endif; ?>

	<section class="cards bg-grey brands__archive">
		<div class="container">
		
			<div class="row cards__item brands__archive">
				<?php if($image): ?>
				<div class="col-12 mb-4">
					<h1 class="text-size-giant text-upper text-tertiary title">
						<?= $title; ?>
					</h1>
				</div>
				<div class="col-lg-3 col-sm-4 col-12 cards__item-img mb-4">
					<div class="cards__item-img-cont">
						<img data-src="<?= esc_url($size); ?>" class="bg-cover lazy" alt="<?= $alt; ?>">
					</div>
				</div>
				<div class="col-sm-8 col-12 cards__item-text">
					<?= $text; ?>
				</div>
				<?php else: ?>
				<div class="col-12 mb-4">
					<h1 class="text-size-giant text-upper text-tertiary title">
						<?= $title; ?>
					</h1>
				</div>
				<div class="col-sm-9 cards__item-text">
					<?= $text; ?>
				</div>
				<?php endif; ?>
			</div>

		</div>
	</section>

<?php endif; ?>

<section class="products__list">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-12">
				<div class="row products__list-top justify-content-between align-items-end">
					<?php if( !is_tax('marka') ): ?>
					<div class="col-xl-8 col-md-7 col-12 products__list-title">
					<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
						<h1 class="text-size-huge"><?php woocommerce_page_title(); ?></h1>
					<?php endif; ?>
					</div>
					<div class="col-lg-4 col-md-5 col-12 products__list-filter">
					<?php else: ?>
					<div class="col-auto products__list-filter">
					<?php endif; ?>
						<?php sative_catalog_ordering(); ?>
					</div>
				</div>
				<div class="row">

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
