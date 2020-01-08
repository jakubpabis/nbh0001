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
		<footer class="footer scene_element scene_element--fadeinup scene_element--delayed">
			<div class="container">
				<div class="row justify-content-center align-items-end footer__upper">
					<div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 col-12 logo">
						<a href="index.html">
							<img data-src="<?= get_template_directory_uri(); ?>/assets/img/logoW.png" class="lazy" alt="">
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
								<ul>
									<li>
										<a href="">
											Tabele rozmiarów
										</a>
									</li>
									<li>
										<a href="">
											Płatności
										</a>
									</li>
									<li>
										<a href="">
											Wysyłka i czas dostawy
										</a>
									</li>
									<li>
										<a href="">
											Zwroty i reklamacje
										</a>
									</li>
									<li>
										<a href="">
											Twoje konto
										</a>
									</li>
								</ul>
							</div>
							<div class="col-sm-4 col-12">
								<span class="text-size-xxlarge">
									Mapa strony:
								</span>
								<ul>
									<li>
										<a href="index.html">
											Strona główna
										</a>
									</li>
									<li>
										<a href="shop.html">
											Sklep
										</a>
									</li>
									<li>
										<a href="about.html">
											O nas
										</a>
									</li>
									<li>
										<a href="">
											Koszyk
										</a>
									</li>
									<li>
										<a href="contact.html">
											Kontakt
										</a>
									</li>
								</ul>
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
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<?php wp_footer(); ?>
	<script type="text/javascript" src="<?= get_template_directory_uri(); ?>/assets/js/app.js" defer></script>
</body>
</html>