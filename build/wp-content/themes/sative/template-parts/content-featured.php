<?php $ids = wc_get_featured_product_ids(); ?>
<div class="row justify-content-center">
    <?php foreach($ids as $id) :
        $product = wc_get_product( $id ); ?>
        <?php if( $product->is_on_sale() ) : ?>
        <div class="col-lg-4 col-md-6 products__list-item salesale">
        <?php else: ?>
        <div class="col-lg-4 col-md-6 products__list-item">
        <?php endif; ?>
            <div class="products__list-item-content text-center">
                <div class="products__list-item-content-img">
                    <img data-src="<?= wp_get_attachment_image_src( $product->get_image_id(), 'medium' )[0]; ?>" width="<?= wp_get_attachment_image_src( $product->get_image_id(), 'medium' )[1]; ?>" height="<?= wp_get_attachment_image_src( $product->get_image_id(), 'medium' )[2]; ?>" class=" bg-cover lazy" alt="">
                </div>
                <div class="products__list-item-content-text">
                    <h2 class="title text-size-normal text-bold">
                        <?= $product->get_name(); ?>
                    </h2>
                    <?php if( $product->is_on_sale() && $product->is_in_stock() ) : ?>
                    <span class="price text-size-xlarge" style="color: red;">
                        <?php if( $product->is_type( 'variable' ) ): ?>
                            <small><?= wc_price($product->get_variation_regular_price('min')); ?></small>
                        <?php else: ?>
                            <small><?= wc_price($product->get_regular_price()); ?></small>
                        <?php endif; ?>
                        <i class="fas fa-long-arrow-alt-right"></i>
                        <?= wc_price($product->get_price(), array()); ?>
                    </span>
                    <?php else: ?>
                    <span class="price text-size-xlarge">
                        <?= wc_price($product->get_price(), array()); ?>
                    </span>
                    <?php endif; ?>
                    <span class="price text-size-xlarge">
                        <?= wc_price($product->get_price(), array()); ?>
                    </span>
                </div>
                <?php if( $product->is_on_sale() ) : ?>
                    <h4 class="onsale">SALE!</h4>
                <?php endif; ?>
                <a href="<?= get_permalink( $product->get_id() ); ?>" class="whole-element-link"></a>
            </div>
        </div>
    <?php endforeach; ?>
</div>