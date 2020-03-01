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
<section class="cards bg-grey">
	<div class="container">

        <?php $i = 0; foreach($terms as $term): ?>

        <?php $image = get_field('img', 'marka_'.$term->term_id); ?>

        <?php if($image): ?>

        <?php 
            $size = $image['sizes']['medium_large'];
            $alt = $image['alt'];
            $title = get_field('title', 'marka_'.$term->term_id) ? get_field('title', 'marka_'.$term->term_id) : $term->name;
            $text = $term->description;
            $link = get_term_link($term, 'marka');
        ?>

        <div class="row justify-content-center align-items-center cards__item">
            <?php if( $i % 2 == 0 ) : ?>
                <div class="col-xl-6 col-md-7 col-sm-10 col-11 cards__item-img">
                    <div class="cards__item-img-cont">
                        <a href="<?= $link; ?>">
                            <img data-src="<?= esc_url($size); ?>" class="bg-cover lazy" alt="<?= $alt; ?>">
                        </a>
                    </div>
                </div>
                <div class="col-md-5 col-sm-10 col-11 cards__item-text">
                    <h2 class="text-upper text-tertiary title">
                        <?= $title; ?>
                    </h2>
                    <?= $text; ?>
                    <a href="<?= $link; ?>" class="btn btn__border">Obczaj <?= $term->name; ?></a>
                </div>
            <?php else : ?>
                <div class="col-md-5 col-sm-10 col-11 order-md-1 order-12 cards__item-text">
                    <h2 class="text-upper text-tertiary title">
                        <?= $title; ?>
                    </h2>
                    <?= $text; ?>
                    <a href="<?= $link; ?>" class="btn btn__border">Obczaj <?= $term->name; ?></a>
                </div>
                <div class="col-xl-6 col-md-7 col-sm-10 col-11 order-md-12 order-1 cards__item-img">
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
<?php /*
if(have_rows('section_big_cards')) : ?>

<section class="cards grey-bg">
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
                            <img data-src="<?= esc_url($size); ?>" class="bg-cover lazy" alt="<?= $alt; ?>">
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
                            <img data-src="<?= esc_url($size); ?>" class="bg-cover lazy" alt="<?= $alt; ?>">
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <?php endwhile; ?>
	</div>
</section>

<?php endif; */ ?> 

<?php get_footer();
