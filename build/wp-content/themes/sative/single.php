<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WP_Bootstrap_Starter
 */

get_header(); ?>

<?php if ( function_exists('yoast_breadcrumb') ) : ?>
	<aside class="breadcrumbs">
		<div class="container">
			<div class="row">
				<?php //yoast_breadcrumb( '<div class="col-12">','</div>' ); ?>
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

<section id="singlePage">
	<main id="main" class="site-main" role="main">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12">

					<?php
					while ( have_posts() ) : the_post();

						get_template_part( 'template-parts/content', get_post_format() );

							the_post_navigation();

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile; // End of the loop.
					?>

				</div>
			</div>
		</div>
	</main><!-- #main -->
</section><!-- #primary -->

<?php get_footer();
