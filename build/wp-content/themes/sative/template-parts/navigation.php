<?php
if( is_shop() || is_product() || is_product_category() || is_product_taxonomy() || is_product_tag() ) {
    $shop = true;
} else {
    $shop = false;
}
?>
<nav role="navigation" class="main-navigation <?= $shop == true ? 'shop_page' : null ?> scene_element scene_element--fadeindown scene_element--delayed">
	<div class="container">
		<div class="row justify-content-between align-items-center">
			<div class="col-auto logo">
                <a href="<?php echo esc_url( home_url( '/' )); ?>">
                    <img src="<?php echo esc_url(get_theme_mod( 'wp_bootstrap_starter_logo' )); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
                </a>
            </div>
            <div class="col-auto text-center main-menu-container">
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
            <div class="col-auto text-right side-menu-container d-md-block d-none">
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
						<a href="javascript:void(0)" data-toggle="modal" data-target="#searchModal">
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
    <?php if($shop): ?>
    <?php
        $categories = get_terms( ['taxonomy' => 'product_cat'] );
        //var_dump($categories);
        global $wp;
        $curr = home_url( $wp->request ).'/';
    ?>
        <div class="shop-navigation d-md-block d-none">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-auto">
                        <ul class="shop-menu">
                            <?php foreach($categories as $cat) : ?>
                            <li <?= get_term_link( $cat->term_id, 'product_cat' ) == $curr ? 'class="active"' : null ?>>
                                <a href="<?= get_term_link( $cat->term_id, 'product_cat' ); ?>">
                                    <?= $cat->name; ?>
                                </a>
                            </li>
                            <?php endforeach; ?>
                            <!--<li>
                                <a href="shop.html">
                                    Kompletne deski
                                </a>
                            </li>
                            <li>
                                <a href="shop.html">
                                    Kółka
                                </a>
                            </li>
                            <li>
                                <a href="shop.html">
                                    Trucki
                                </a>
                            </li>
                            <li>
                                <a href="shop.html">
                                    Łożyska
                                </a>
                            </li>
                            <li>
                                <a href="shop.html">
                                    Akcesoria   
                                </a>
                            </li>-->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</nav>