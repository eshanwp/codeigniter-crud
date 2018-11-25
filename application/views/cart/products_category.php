
<div class="wrapper wrapper-content animated fadeInRight">
	
	<!-- Category Start -->
	<?php if (isset($category_datas)) { ?>
	<?php $array_chunk =  array_chunk($category_datas, '4');?>
	<?php foreach ($array_chunk as $category_datas) { ?>
	<div class="row">
		<?php foreach ($category_datas as $category_data) { ?>

		<div class="col-md-3">
			<div class="ibox">
				<div class="ibox-content product-box">

					<div class="product-desc">
						<a href="#" class="product-name"> <?= $category_data->category_name ?></a>
						<div class="small m-t-xs">
							Many desktop publishing packages and web page editors now.
						</div>
						<div class="m-t text-righ">

							<a href="<?= base_url().'cart/products_category/'.$category_data->category_url.'/' ?>" class="btn btn-xs btn-outline btn-primary">Info <i class="fa fa-long-arrow-right"></i> </a>
						</div>
					</div>

				</div>
			</div>
		</div>
		<?php  } ?>
	</div>
	<?php  } ?>
	<?php } ?>
	<!-- Category End -->

		<!-- Category Start -->
	<?php if (isset($category_product_datas)) { ?>
	<?php $array_chunk =  array_chunk($category_product_datas, '4');?>
	<?php foreach ($array_chunk as $category_product_datas) { ?>
	<div class="row">
		<?php foreach ($category_product_datas as $category_product_data) { ?>

		<div class="col-md-3">
			<div class="ibox">
				<div class="ibox-content product-box">

					<div class="product-desc">
						<a href="#" class="product-name"> <?= $category_product_data->product_name ?></a>
						<div class="small m-t-xs">
							Many desktop publishing packages and web page editors now.
						</div>
						<div class="m-t text-righ">

							<a href="<?= base_url().'cart/product/'.$category_product_data->product_url.'/' ?>" class="btn btn-xs btn-outline btn-primary">Info <i class="fa fa-long-arrow-right"></i> </a>
						</div>
					</div>

				</div>
			</div>
		</div>
		<?php  } ?>
	</div>
	<?php  } ?>
	<?php } ?>
	<!-- Category End -->

	

</div>


</div>
</div>
<script type="text/javascript">

	$(document).ready(function() {
		


	});

</script>
