<?php $_SESSION['asset_file_name'] = "product"; ?>
<div id="appCapsule">
	<div class="section mt-2">
		<div class="card">
			<div class="card-body">
				<div id="error-div"></div>
				<div class="section mb-5 p-2">

					<div class="row mt-2" id="product">
						<?php foreach ($reports as $row) { ?>
							<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
								<a href="<?php echo base_url("products/get/"); ?><?php echo $row['id']; ?>">
									<div class="bill-box">
										<div class="img-wrapper">
											<img src="<?php echo $row['img_file'] ? api_url() . 'assets/img_product/' . $row['img_file'] : 'https://via.placeholder.com/150x150'; ?>"
												 alt="img" class="image-block d-block w-100 imaged p-1 product_image product_icon">
										</div>
										<div class="price prod_name"><?php echo $row['name']; ?></div>
										<p class="prod_price"><?php echo "[[LABEL_PRICE]] : $" . $row['unit_price']; ?></p>
									</div>
								</a>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
