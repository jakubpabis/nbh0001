<div class="col-md-4 col-sm-6 col-10 products__list-item scene_element scene_element--fadeinleft-wide scene_element--delayed4">
	<div class="products__list-item-content text-center">
		<div class="products__list-item-content-img">
			<img src="<?= get_the_post_thumbnail_url('', 'medium') ?>" alt="" class="bg-cover">
		</div>
		<div class="products__list-item-content-text">
			<h2 class="title text-size-normal text-bold">
				<?= get_the_title(); ?>
			</h2>
			<span class="price text-size-xlarge">
				<?= wc_price(get_post_meta( get_the_ID(), '_price', true )); ?>
			</span>
		</div>
		<a href="<?= get_permalink(); ?>" class="whole-element-link"></a>
	</div>
</div>