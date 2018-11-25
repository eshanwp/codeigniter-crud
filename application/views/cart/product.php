<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<?php if (isset($product_data)) { ?>
		<div class="col-lg-12">

			<div class="ibox product-detail">
				<div class="ibox-content">

					<div class="row">
						<div class="col-md-5">


							<div class="product-images">

								<div>
									<div class="image-imitation">
										[IMAGE 1]
									</div>
								</div>
								<div>
									<div class="image-imitation">
										[IMAGE 2]
									</div>
								</div>
								<div>
									<div class="image-imitation">
										[IMAGE 3]
									</div>
								</div>


							</div>

						</div>
						<div class="col-md-7">

							<h2 class="font-bold m-b-xs">
								<?= $product_data->product_name; ?>
							</h2>
							<hr>
							<div>
								<button class="btn btn-primary pull-right">Add to cart</button>
								<h1 class="product-main-price">$<?= $product_data->sale_price; ?> <small class="text-muted">Exclude Tax</small> </h1>
							</div>
							<hr>
							<h4>Product description</h4>

							<div class="small text-muted">
								It is a long established fact that a reader will be distracted by the readable
								content of a page when looking at its layout. The point of using Lorem Ipsum is
								that it has a more-or-less normal distribution of letters, as opposed to using
								'Content here, content here', making it look like readable English.
								<br/>
								<br/>
								There are many variations of passages of Lorem Ipsum available, but the majority
								have suffered alteration in some form, by injected humour, or randomised words
								which don't look even slightly believable.
							</div>
							
							


						</div>
					</div>

				</div>

			</div>

		</div>
		<?php  } ?>
	</div>
</div>


</div>
</div>
<script type="text/javascript">

	$(document).ready(function() {
		
		$('.product-images').slick({
			dots: true
		});

	});

</script>
