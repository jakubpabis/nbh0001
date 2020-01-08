<?php
/**
 * Template part for displaying posts
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

<article id="post-<?php the_ID(); ?>" <?php post_class('scene_element scene_element--fadeindown scene_element--delayed2'); ?>>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-8 col-12">

				<?php if(get_the_post_thumbnail()): ?>
					<div class="post-thumbnail">
						<?php the_post_thumbnail(); ?>
					</div>
				<?php endif; ?>

				<header class="entry-header">
					<?php
					if ( is_single() ) :
						the_title( '<h1 class="entry-title">', '</h1>' );
					else :
						the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
					endif;

					if ( 'post' === get_post_type() ) : ?>
					<div class="entry-meta">
						<?php wp_bootstrap_starter_posted_on(); ?>
					</div><!-- .entry-meta -->
					<?php
					endif; ?>
				</header><!-- .entry-header -->

				<main class="entry-content">
					<?php
					if ( is_single() ) :
						the_content();
					else :
						the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'wp-bootstrap-starter' ) );
					endif;

						wp_link_pages( array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wp-bootstrap-starter' ),
							'after'  => '</div>',
						) );
					?>
				</main><!-- .entry-content -->
				
				<?php if(wp_bootstrap_starter_entry_footer()): ?>
					<footer class="entry-footer">
						<?php wp_bootstrap_starter_entry_footer(); ?>
					</footer><!-- .entry-footer -->
				<?php endif; ?>

			</div>
		</div>
	</div>	
</article><!-- #post-## -->
