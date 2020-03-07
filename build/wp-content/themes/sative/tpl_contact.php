<?php
/**
 * Template Name: Kontakt
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
            <div class="col-lg-7 col-md-9">
                <h1>
                    Kontaktuj mordeczko!
                </h1>
            </div>
        </div>
    </div>
</header>

<section class="cards contact">
	<div class="container">
        <div class="row cards__item">
            <div class="col-md-5 col-sm-10 col-12 cards__item-text contact__text">
                <h2 class="text-tertiary title">
                    Chcesz przyjechać?
                </h2>
                <p class="text-size-large font-primary text-bold">
                    <strong class="text-bold">NBHD Skate</strong><br/>
                    Dolna 2A<br/>
                    32-540 Trzebinia<br/>
                    <br/>
                    <a href="tel:+48735970079" class="text-bold">+48 735 970 079</a><br/>
                    <a href="tel:+48505485958" class="text-bold">+48 505 485 958</a><br/>
                    <br/>
                    <a href="mailto:info@nbhdskate.pl" class="text-bold">info@nbhdskate.pl</a><br/>
                </p>
                <a class="mr-3 fa-2x" href="https://www.facebook.com/Neighbourhood-Skateshop-436289680462922/" target="_blank"><i class="fab fa-facebook-f"></i></a>
                <a class="mr-3 fa-2x" href="https://www.instagram.com/nbhdskate.pl/" target="_blank"><i class="fab fa-instagram"></i></a>
                <a class="mr-3 fa-2x" href="https://www.youtube.com/channel/UCQAnw7wS8peE9UFIjT3EF2Q" target="_blank"><i class="fab fa-youtube"></i></a>
            </div>
            <div class="col-md-7 col-sm-10 col-12 contact__form">
                <h3 class="text-tertiary title">
                    Jakieś pytania?
                </h3>
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer();