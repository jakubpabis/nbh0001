<nav role="navigation" class="main-navigation">
	<div class="container">
		<div class="row main-navigation__upper justify-content-between align-items-center">
			<div class="col-auto logo">
                <a href="<?php echo esc_url( home_url( '/' )); ?>">
                    <img src="<?php echo esc_url(get_theme_mod( 'wp_bootstrap_starter_logo' )); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
                </a>
            </div>
            <div class="col-auto text-right side-menu-container d-md-flex d-none">
                <ul class="social-menu">
                    <li>
                        <a href="https://www.facebook.com/Neighbourhood-Skateshop-436289680462922/" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    </li>
                    <li>
                        <a href="https://www.instagram.com/nbhdskate.pl/" target="_blank"><i class="fab fa-instagram"></i></a>
                    </li>
                    <li>
                        <a href="https://www.youtube.com/" target="_blank"><i class="fab fa-youtube"></i></a>
                    </li>
                </ul>
				<ul class="side-menu">
					<li>
                    <?php if ( is_user_logged_in() ) : ?>
                        <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('Moje konto','sative'); ?>">
                            <?php _e('Moje konto','sative'); ?>
                        </a>
                    <?php else : ?>
                        <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('Zaloguj się','sative'); ?>">
                            <?php _e('Zaloguj się','sative'); ?>
                        </a>
                    <?php endif; ?>
					</li>
					<li>
                        <div class="main-navigation__search">
                            <?php echo do_shortcode('[wcas-search-form]'); ?>
                        </div>
						<a href="javascript:void(0)" class="searchOpen">
							<i class="fas fa-search"></i>
						</a>
					</li>
					<li>
						<a href="<?= wc_get_cart_url(); ?>" class="cartOpen">
							<i class="fas fa-shopping-cart"></i>
						</a>
					</li>
				</ul>
            </div>
        </div>
    </div>
    <div class="text-center main-menu-container">
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-auto">
                <?php
                    wp_nav_menu(array(
                        'theme_location'    => 'primary',
                        'container'       => '',
                        'container_id'    => '',
                        'container_class' => '',
                        'menu_id'         => false,
                        'menu_class'      => 'main-menu',
                        'depth'           => 2,
                        'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
                        'walker'          => new wp_bootstrap_navwalker()
                    ));
                ?>
                </div>
            </div>
        </div>
    </div>
    <div class="mobile-navigation d-md-none d-block">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-auto">
                    <button id="menuOpen" type="button" onclick="menuOpen(this)">
                        <i class="fas fa-bars"></i>
                        <span>MENU</span>
                    </button>
                </div>
                <div class="col-auto">
                    <ul class="side-menu">
                        <li class="d-sm-block d-none">
                        <?php if ( is_user_logged_in() ) : ?>
                            <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('Moje konto','sative'); ?>">
                                <?php _e('Moje konto','sative'); ?>
                            </a>
                        <?php else : ?>
                            <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('Zaloguj się','sative'); ?>">
                                <?php _e('Zaloguj się','sative'); ?>
                            </a>
                        <?php endif; ?>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="fas fa-search"></i>
                            </a>
                        </li>
                        <li>
                            <a href="<?= wc_get_cart_url(); ?>" class="cartOpen">
                                <i class="fas fa-shopping-cart"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>