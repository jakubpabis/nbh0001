<?php
/**
 * Template Name: Sale
 */

get_header('shop'); 

$query_args = array(
    'posts_per_page'    => 6,
    'no_found_rows'     => 0,
    'post_status'       => 'publish',
    'post_type'         => 'product',
    'meta_query'        => WC()->query->get_meta_query(),
	'post__in'          => array_merge( array( 0 ), wc_get_product_ids_on_sale() ),
	'meta_query' 		=> array(
		array(
			'key' 	=> '_stock_status',
			'value' => 'instock'
		)
	),
	'paged' 			=> get_query_var('paged') ? get_query_var('paged') : 1
);
$products = new WP_Query( $query_args ); ?>


<section class="products__list">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-12">
				<div class="row products__list-top justify-content-between align-items-start">
					<div class="col-xl-8 col-md-7 col-sm-6 products__list-title">
					<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
						<h1 style="color: red;">SALE!</h1>
					<?php endif; ?>
					</div>
					<div class="col-lg-4 col-md-5 col-sm-6 products__list-filter">
						<?php sative_catalog_ordering(); ?>
					</div>
				</div>
				<div class="row justify-content-center">

					<?php if ( woocommerce_product_loop() ) {

						while ( $products->have_posts() ) : $products->the_post(); ?>
							
							<?php if($product->is_in_stock()): ?>
							<div class="col-md-4 col-sm-6 col-10 products__list-item <?= $product->is_on_sale() ? 'salesale' : null ?>">
								<div class="products__list-item-content text-center">
									<div class="products__list-item-content-img">
										<img src="<?= get_the_post_thumbnail_url('', 'medium') ?>" alt="" class="bg-cover">
									</div>
									<div class="products__list-item-content-text">
										<h2 class="title text-size-normal text-bold">
											<?= get_the_title(); ?>
										</h2>
										<?php if( $product->is_on_sale() ) : ?>
										<span class="price text-size-xlarge" style="color: red;">
											<?php if( $product->is_type( 'variable' ) ): ?>
												<small><?= wc_price($product->get_variation_regular_price('min')); ?></small>
											<?php else: ?>
												<small><?= wc_price($product->get_regular_price()); ?></small>
											<?php endif; ?>
											<i class="fas fa-long-arrow-alt-right"></i>
											<?= wc_price(get_post_meta( get_the_ID(), '_price', true )); ?>
										</span>
										<?php else: ?>
										<span class="price text-size-xlarge">
											<?= wc_price(get_post_meta( get_the_ID(), '_price', true )); ?>
										</span>
										<?php endif; ?>
									</div>
									<a href="<?= get_permalink(); ?>" class="whole-element-link"></a>
								</div>
							</div>
							<?php endif; ?>

						<?php endwhile;

					} else {
						
						do_action( 'woocommerce_no_products_found' );

					} ?>

				</div>
			</div>
		</div>
		<div class="row justify-content-center">
			<nav class="woocommerce-pagination">
			<?php 
			$big = 999999999; // need an unlikely integer
			echo paginate_links( array(
				'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
				'format' => '?paged=%#%',
				'current' => max( 1, get_query_var('paged') ),
				'total' => $products->max_num_pages
			) ); 
			?>
			</nav>
		</div>
	</div>
</section>

<?php get_footer();
