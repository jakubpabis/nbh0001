<?php
/**
 * Template Name: Marki
 */

get_header(); ?>

<?php if ( function_exists('yoast_breadcrumb') ) : ?>
    <aside class="breadcrumbs bg-grey1">
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

<?php
$terms = get_terms( array(
    'taxonomy' => 'marka',
    'hide_empty' => false,
    'posts_per_page' => -1,
) );
?>

<?php if(count($terms) > 0): ?>
<section class="cards bg-grey brands__archive">
	<div class="container">

        <?php $i = 0; foreach($terms as $term): ?>

        <?php $image = get_field('img', 'marka_'.$term->term_id); ?>

        <?php if($image): ?>

        <?php 
            $size = $image['sizes']['medium_large'];
            $sizeS = $image['sizes']['medium'];
            $alt = $image['alt'];
            $title = get_field('title', 'marka_'.$term->term_id) ? get_field('title', 'marka_'.$term->term_id) : $term->name;
            $text = $term->description;
            $link = get_term_link($term, 'marka');
        ?>

        <?php if( $i % 2 == 0 ) : ?>
            <div class="row justify-content-lg-center justify-content-md-start cards__item brands">
                <div class="col-xl-6 col-lg-7 col-md-6 col-sm-10 col-12 cards__item-img">
                    <div class="cards__item-img-cont">
                        <a href="<?= $link; ?>">
                            <picture class="bg-cover">
                                <source class="lazyset" media="(max-width: 991px)" data-srcset="<?= esc_url($sizeS); ?>">
                                <source class="lazyset" data-srcset="<?= esc_url($size); ?>">
                                <img class="bg-cover lazy" data-src="<?= esc_url($size); ?>" alt="<?= $alt; ?>">
                            </picture>
                        </a>
                    </div>
                </div>
                <div class="col-lg-5 col-12 cards__item-text">
                    <h2 class="text-size-xxxxlarge text-upper text-tertiary title">
                        <?= $title; ?>
                    </h2>
                    <?= $text; ?>
                    <a href="<?= $link; ?>" class="btn btn__border">Obczaj <?= $term->name; ?></a>
                </div>
        <?php else : ?>
            <div class="row justify-content-lg-center justify-content-md-end cards__item brands">
                <div class="col-lg-5 col-12 order-lg-1 order-12 cards__item-text text-md-right">
                    <h2 class="text-size-xxxxlarge text-upper text-tertiary title">
                        <?= $title; ?>
                    </h2>
                    <?= $text; ?>
                    <a href="<?= $link; ?>" class="btn btn__border">Obczaj <?= $term->name; ?></a>
                </div>
                <div class="col-xl-6 col-lg-7 col-md-6 col-sm-10 col-12 order-lg-12 order-1 cards__item-img">
                    <div class="cards__item-img-cont">
                        <a href="<?= $link; ?>">
                            <img data-src="<?= esc_url($size); ?>" class="bg-cover lazy" alt="<?= $alt; ?>">
                        </a>
                    </div>
                </div>
        <?php endif; ?>
        </div>

        <?php $i++; endif; ?>

        <?php endforeach; ?>

    </div>
</section>
<?php endif; ?>

<?php get_footer();
