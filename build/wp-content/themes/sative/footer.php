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
						<!-- Begin Mailchimp Signup Form -->
						<div id="mc_embed_signup" class="mt-3">
							<form action="https://nbhdskate.us19.list-manage.com/subscribe/post?u=db235ebb14bd6255c04b21a45&amp;id=f2471e3797" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
								<div id="mc_embed_signup_scroll" class="line">
									<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="Twój email ziomuś...">
									<div id="mce-responses" class="clear">
										<div class="response" id="mce-error-response" style="display:none"></div>
										<div class="response" id="mce-success-response" style="display:none"></div>
									</div>
									<div style="position: absolute; left: -5000px;" aria-hidden="true">
										<input type="text" name="b_db235ebb14bd6255c04b21a45_f2471e3797" tabindex="-1" value="">
									</div>
									<input type="submit" value="Zapisuj mnie!" name="subscribe" id="mc-embedded-subscribe" class="btn btn__border">
								</div>
							</form>
						</div>
						<!--End mc_embed_signup-->
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
								<a href="https://www.youtube.com/channel/UCQAnw7wS8peE9UFIjT3EF2Q" target="_blank"><i class="fab fa-youtube"></i></a>
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
		<!-- Load Facebook SDK for JavaScript -->
		<div id="fb-root"></div>
	</div><!-- #wrapper -->
	<!-- Modal -->
	<div class="search__modal modal fade" id="searchModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<div class="modal-body d-flex">
					<?php echo do_shortcode('[wcas-search-form]'); ?>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="open-modal-newsletter" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 560px;">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">
						Zapisz się do newslettera i odbierz <br/><span style="color: #ff0000;">kod rabatowy -10%</span>
					</h3>
					<button type="button" class="close text-size-xxxlarge" data-dismiss="modal" aria-label="Zamknij">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form class="d-flex align-items-center flex-wrap" method="POST" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" accept-charset="UTF-8" role="form" id="newsletter-form-modal" enctype="multipart/form-data">
						<input class="mr-3 my-2" type="email" name="newsletter-email" value="" placeholder="Wpisz tutaj swój e-mail" required>
						<input type="hidden" name="action" value="newsletter_form">
						<?php wp_nonce_field( 'newsletter_form', 'newsletter_form_nonce' ); ?>
						<button type="submit" class="btn btn__normal my-2"><span>Zapisz się</span></button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php if( isset( $_GET['already'] ) ): ?>
	<div class="modal fade" id="already-modal-newsletter" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">Sorka, ale przyznaliśmy Ci już kupon...</h3>
					<button type="button" class="close text-size-xxxlarge" data-dismiss="modal" aria-label="Zamknij">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<?php if( isset( $_GET['code'] ) ): ?>
	<div class="modal fade" id="code-modal-newsletter" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">
						Dzięki! Wysłaliśmy właśnie twój kod rabatowy na maila!
					</h3>
					<button type="button" class="close text-size-xxxlarge" data-dismiss="modal" aria-label="Zamknij">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<!-- Your customer chat code -->
	<div class="fb-customerchat"
		attribution=setup_tool
		page_id="436289680462922"
		theme_color="#F5A623"
		greeting_dialog_display=hide
		logged_in_greeting="Siemanko! Potrzebujesz pomocy Ziomuś? Pisz co jest grane..."
		logged_out_greeting="Siemanko! Potrzebujesz pomocy Ziomuś? Pisz co jest grane...">
	</div>
	<script src="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.js" data-cfasync="false"></script>
	<script>
		window.cookieconsent.initialise({
			"palette": {
				"popup": {
					"background": "#000"
				},
				"button": {
					"background": "#F5A623"
				}
			},
			"position": "bottom-left",
			"content": {
				"message": "Używamy ciasteczek jak każdy, wiadomo... Kliknij, że wiesz o co kaman, albo sobie poczytaj, jak wolisz...",
				"dismiss": "Czaje, czaje...",
				"link": "Chce poczytać o cookies",
				"href": "/polityka-prywatnosci/"
			}
		});
	</script>
	<?php wp_footer(); ?>
</body>
</html>