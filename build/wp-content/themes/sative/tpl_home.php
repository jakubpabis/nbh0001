<?php
/**
 * Template Name: Homepage
 */

get_header();

if(get_field('slides')) {
    get_template_part( 'template-parts/content', 'slider' );
}

if(!empty(wc_get_featured_product_ids())) : ?>

<section class="products__list home scene_element scene_element--fadeinleft-wide scene_element--delayed2">
	<div class="container">
        <?php get_template_part( 'template-parts/content', 'featured' ); ?>
    </div>
    <div class="row justify-content-center mt-3">
        <div class="col-12 text-center">
            <a href="<?= get_permalink( wc_get_page_id( 'shop' ) ); ?>" class="btn btn__border">Poka wszystko!</a>
        </div>
    </div>
</section>

<?php endif; ?>

<section class="home__insta scene_element scene_element--fadeinleft-wide scene_element--delayed4">
	<div class="container">
        <?= do_shortcode('[instagram-feed]'); ?>
	</div>
</section>

<?php get_footer();
