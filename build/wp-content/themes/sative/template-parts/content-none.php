<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_Bootstrap_Starter
 */

?>

<?php if ( function_exists('yoast_breadcrumb') ) : ?>
	<aside class="breadcrumbs scene_element scene_element--fadeindown scene_element--delayed">
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

<section id="singlePage" class="scene_element scene_element scene_element--fadeindown scene_element--delayed2">
	<main id="main" class="site-main" role="main">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-10 col-12">

					<section class="error-404 not-found text-center">
						<header class="page-header">
							<h1 class="page-title mb-3"><?php esc_html_e( 'Nie ma bata!', 'sative' ); ?></h1>
						</header><!-- .page-header -->

						<div class="page-content">
							<h4 class="mb-3"><?php esc_html_e( 'Nie da rady tego znaleźć...', 'sative' ); ?></h4>
							<h5><?php esc_html_e( 'Ale spróbuj szczęścia z szukajką poniżej, ziom!', 'sative' ); ?></h5>
							<?php
								get_search_form();
							?>

						</div><!-- .page-content -->
					</section><!-- .error-404 -->

				</div>
			</div>
		</div>
	</main><!-- #main -->
</section><!-- #primary -->
