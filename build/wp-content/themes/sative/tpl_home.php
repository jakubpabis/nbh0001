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

<?php endif; 

if(have_rows('section_big_cards')) : ?>

<section class="cards grey-bg scene_element scene_element--fadeinright-wide scene_element--delayed3">
	<div class="container">
        <?php while ( have_rows('section_big_cards') ) : the_row(); ?>
		<div class="row justify-content-center align-items-center cards__item">
            <?php 
                $image = get_sub_field('img');
                $size = $image['sizes']['medium_large'];
                $alt = $image['alt'];
                $title = get_sub_field('title');
                $text = get_sub_field('text');
                $button = get_sub_field('button');
            ?>
            <?php if( get_row_index() % 2 == 0 ) : ?>
                <div class="col-xl-6 col-md-7 col-sm-10 col-11 cards__item-img">
                    <div class="cards__item-img-cont">
                        <a href="<?= $button['url']; ?>">
                            <img src="<?= esc_url($size); ?>" class="bg-cover" alt="<?= $alt; ?>">
                        </a>
                    </div>
                </div>
                <div class="col-xl-4 col-md-5 col-sm-10 col-11 cards__item-text">
                    <h2 class="text-upper text-tertiary title">
                        <?= $title; ?>
                    </h2>
                    <?= $text; ?>
                    <a href="<?= $button['url']; ?>" class="btn btn__border"><?= $button['title']; ?></a>
                </div>
            <?php else : ?>
                <div class="col-xl-4 col-md-5 col-sm-10 col-11 order-md-1 order-12 cards__item-text">
                    <h2 class="text-upper text-tertiary title">
                        <?= $title; ?>
                    </h2>
                    <?= $text; ?>
                    <a href="<?= $button['url']; ?>" class="btn btn__border"><?= $button['title']; ?></a>
                </div>
                <div class="col-xl-6 col-md-7 col-sm-10 col-11 order-md-12 order-1 cards__item-img">
                    <div class="cards__item-img-cont">
                        <a href="<?= $button['url']; ?>">
                            <img src="<?= esc_url($size); ?>" class="bg-cover" alt="<?= $alt; ?>">
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <?php endwhile; ?>
	</div>
</section>

<?php endif; ?>

<section class="home__insta scene_element scene_element--fadeinleft-wide scene_element--delayed4">
	<div class="container">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
				<h2 class="text-center text-upper text-tertiary mb-0">
					Na insta też się dzieje!
				</h2>
			</div>
        </div>
        <?= do_shortcode('[instagram-feed]'); ?>
	</div>
</section>

<?php get_footer();
