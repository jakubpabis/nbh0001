<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WP_Bootstrap_Starter
 */

?>
		<footer class="footer">
			<div class="container">
				<div class="row justify-content-center align-items-end footer__upper">
					<div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 col-12 logo">
						<a href="/">
							<img src="<?= get_template_directory_uri(); ?>/assets/img/logoW.png" alt="Neighbourhood Skateshop logo - NBHD Skate">
						</a>
					</div>
					<div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 col-12 newsletter">
						<span class="text-size-xlarge">
							Zapisz się do newsletter’a
						</span>
						<form class="mt-3" action="">
							<div class="line">
								<input type="email" name="email" placeholder="Twój email ziomuś...">
								<button type="submit" class="btn btn__border desktop">Zapisuj mnie!</button>
							</div>
							<div class="check pretty p-default p-thick p-pulse">
								<input type="checkbox" name="agree"/>
								<div class="state p-warning-o">
									<label><span>Daj znać, że zapoznałeś się z naszym <a href="">REGULAMINEM</a></span></label>
								</div>
							</div>
							<button type="submit" class="btn btn__border mobile">Zapisuj mnie!</button>
						</form>
					</div>
				</div>
				<div class="row justify-content-center footer__mid">
					<div class="col-xl-10 col-12">
						<div class="row justify-content-between">
							<div class="col-sm-4 col-12">
								<span class="text-size-xxlarge">
									Info:
								</span>
								<p>
									NBHD<br>
									Dolna 2A<br/>
									32-540 Trzebinia<br/>
									<br/>
									<a href="tel:+48735970079">+48 735 970 079</a><br/>
									<a href="tel:+48505485958">+48 505 485 958</a><br/>
									<br/>
									<a href="mailto:info@nbhdskate.pl">info@nbhdskate.pl</a>
								</p>
							</div>
							<div class="col-sm-4 col-12">
								<span class="text-size-xxlarge">
									Pomoc:
								</span>
								<?php
									wp_nav_menu(array(
										'theme_location'    => 'footer1',
										'container'       => '',
										'container_id'    => '',
										'container_class' => '',
										'menu_id'         => false,
										'menu_class'      => '',
										'depth'           => 1,
										'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
										'walker'          => new wp_bootstrap_navwalker()
									));
								?>
							</div>
							<div class="col-sm-4 col-12">
								<span class="text-size-xxlarge">
									Mapa strony:
								</span>
								<?php
									wp_nav_menu(array(
										'theme_location'    => 'footer2',
										'container'       => '',
										'container_id'    => '',
										'container_class' => '',
										'menu_id'         => false,
										'menu_class'      => '',
										'depth'           => 1,
										'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
										'walker'          => new wp_bootstrap_navwalker()
									));
								?>
							</div>
						</div>
					</div>
				</div>
				<div class="row justify-content-center footer__lower">
					<div class="col-xl-10 col-12">
						<div class="row justify-content-between align-items-center">
							<div class="col-lg-auto col-md-8 col-12 socials">
								<h3>Social media:</h3>
								<a href="https://www.facebook.com/Neighbourhood-Skateshop-436289680462922/" target="_blank"><i class="fab fa-facebook-f"></i></a>
								<a href="https://www.instagram.com/nbhdskate.pl/" target="_blank"><i class="fab fa-instagram"></i></a>
								<a href="https://www.youtube.com/" target="_blank"><i class="fab fa-youtube"></i></a>
							</div>
							<div class="col-lg-auto col-md-8 col-12 text-right text-bold text-size-small">
								<span>Copyright &copy; <?php echo date('Y'); ?> NBHDSKATE</span>
								<a href="https://www.sative.co.uk" target="_blank" class="madeby">Made with <i class="fas fa-heart"></i> by <span>SATIVE</span></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</footer>
	</div><!-- #wrapper -->
	<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModalTitle" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Szukajka produktów</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<?php echo do_shortcode('[wcas-search-form]'); ?>
				</div>
			</div>
		</div>
	</div>
	<?php wp_footer(); ?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous" defer></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous" defer></script>
	<script src="<?= get_template_directory_uri(); ?>/assets/js/app.js" defer></script>
</body>
</html>