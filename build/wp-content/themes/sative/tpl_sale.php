<?php
/**
 * Template Name: Sale
 */

get_header('shop'); 

$query_args = array(
    'posts_per_page'    => 9,
    'no_found_rows'     => 1,
    'post_status'       => 'publish',
    'post_type'         => 'product',
    'meta_query'        => WC()->query->get_meta_query(),
    'post__in'          => array_merge( array( 0 ), wc_get_product_ids_on_sale() )
);
$products = new WP_Query( $query_args ); ?>


<section class="products__list">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-12">
				<div class="row products__list-top justify-content-between align-items-start">
					<div class="col-xl-8 col-md-7 col-sm-6 products__list-title">
					<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
						<h1><?php woocommerce_page_title(); ?></h1>
					<?php endif; ?>
					</div>
					<div class="col-lg-4 col-md-5 col-sm-6 products__list-filter">
						<?php sative_catalog_ordering(); ?>
					</div>
				</div>
				<div class="row justify-content-center">

					<?php if ( woocommerce_product_loop() ) {

						if ( wc_get_loop_prop( 'total' ) ) {
							while ( $products->have_posts() ) {
								$products->the_post();
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
