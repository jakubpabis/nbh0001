<?php
/**
 * The template for displaying Woocommerce Product
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_Bootstrap_Starter
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
    <?php endif; 

    if ( have_posts() && (is_shop() || is_product_category() || is_product_taxonomy() || is_product_tag()) ) : ?>

        <section class="products__list">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-10 col-lg-11 col-12">
                        <div class="row products__list-top justify-content-between align-items-start">
                            <div class="col-xl-8 products__list-title">
                                <h1>
                                    <?php if(is_shop()) : ?>
                                        <?= get_the_title( wc_get_page_id('shop') ); ?>
                                    <?php else : ?>
                                        <?= get_the_ID(); ?>
                                        <?= get_the_title(); ?>
                                    <?php endif; ?>
                                </h1>
                            </div>
                            <div class="col-auto products__list-filter">
                                <?php sative_catalog_ordering(); ?>
                            </div>
                        </div>
                        <div class="row justify-content-center">

                            <?php
                            /* Start the Loop */
                            while ( have_posts() ) : the_post();

                                /*
                                    * Include the Post-Format-specific template for the content.
                                    * If you want to override this in a child theme, then include a file
                                    * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                    */
                                if(is_shop() || is_product_category() || is_product_taxonomy() || is_product_tag()) {
                                    get_template_part( 'template-parts/shop', get_post_format() );
                                } else {
                                    get_template_part( 'template-parts/content', get_post_format() );
                                }

                            endwhile; ?>

                        </div>
                    </div>
                </div>
                <div class="row justify-content-center mt-5">
                    <div class="col-12 text-center">
                        <a href="" class="btn btn__full">Ładuj więcej stuff'u!</a>
                    </div>
                </div>
            </div>
        </section>

    <?php elseif(is_product()) : 
    
        get_template_part( 'template-parts/product' );

    else :    

        get_template_part( 'template-parts/content', 'none' );

    endif; ?>

<?php
get_footer();
