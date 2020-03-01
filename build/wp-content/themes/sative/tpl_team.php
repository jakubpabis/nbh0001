<?php
/**
 * Template Name: Team
 */

get_header(); ?>

<header class="team__header">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-auto text-center">
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
        <div class="row justify-content-center">
            <?php while(have_rows('people')) : the_row(); ?>
            <div class="col-lg-4 team__people-person">
                <div class="person-img">
                    <img src="<?= get_sub_field('img')['url']; ?>" alt="" class="bg-cover">
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<?php endif; ?>


<?php get_footer();
