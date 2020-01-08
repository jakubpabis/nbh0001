<?php $ids = wc_get_featured_product_ids(); ?>
<div class="row justify-content-center">
    <?php foreach($ids as $id) :
        $product = wc_get_product( $id ); ?>
        <div class="col-xl-3 col-md-4 col-sm-6 col-10 products__list-item">
            <div class="products__list-item-content text-center">
                <div class="products__list-item-content-img">
                    <img src="<?= wp_get_attachment_image_src( $product->get_image_id(), 'medium' )[0]; ?>" width="<?= wp_get_attachment_image_src( $product->get_image_id(), 'medium' )[1]; ?>" height="<?= wp_get_attachment_image_src( $product->get_image_id(), 'medium' )[2]; ?>" class=" bg-cover" alt="">
                </div>
                <div class="products__list-item-content-text">
                    <h2 class="title text-size-normal text-bold">
                        <?= $product->get_name(); ?>
                    </h2>
                    <span class="price text-size-xlarge">
                        <?= number_format((float)$product->get_price(), 2, '.', ''); ?>
                    </span>
                </div>
                <a href="<?= get_permalink( $product->get_id() ); ?>" class="whole-element-link"></a>
            </div>
        </div>
    <?php endforeach; ?>
</div>