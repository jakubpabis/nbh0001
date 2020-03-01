<?php
/**
 * Template Name: Team
 */

get_header(); ?>

<?php if ( function_exists('yoast_breadcrumb') ) : ?>
    <aside class="breadcrumbs">
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

<header class="team__header">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <h1>
                    <?= get_field('team-title'); ?>
                </h1>
            </div>
        </div>
    </div>
</header>

<?php if(have_rows('people')) : ?>
<section class="team__people">
    <div class="container">
        <div class="row">
            <?php while(have_rows('people')) : the_row(); ?>
            <div class="col-lg-4 team__people-person">
                <div class="person-img">
                    <img src="<?= get_sub_field('img')['url']; ?>" alt="" class="bg-cover">
                </div>
                <div class="person-text">
                    <h2>
                        <?= get_sub_field('name'); ?>
                    </h2>
                    <div class="socials">
                        
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<?php endif; ?>


<?php get_footer();
