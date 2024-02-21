<?php $_SESSION['asset_file_name'] = "product"; ?>
<div id="appCapsule">
	<div class="section mb-5 p-2">
		<div class="card">
			<div class="card-body">
				<div>
					<div class="row">
						<div class="col-12">
							<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
								<div class="carousel-inner" id="slider">
									<div class="carousel-item active">
										<center>
											<img class="d-block w-100 product_single_img" alt="slide"
												 src="<?php echo api_url() . 'assets/img_product/' . $product['img_file']; ?>">
										</center>
									</div>
								</div>
								<a class="carousel-control-prev" href="#carouselExampleControls" role="button"
								   data-slide="prev">
									<span class="carousel-control-prev-icon" aria-hidden="true"></span>
									<span class="sr-only">Previous</span>
								</a>
								<a class="carousel-control-next" href="#carouselExampleControls" role="button"
								   data-slide="next">
									<span class="carousel-control-next-icon" aria-hidden="true"></span>
									<span class="sr-only">Next</span>
								</a>
							</div>
						</div>
					</div>

					<div class="row mt-2">
						<div class="col-12">
							<!--new-->
							<div class="card-body pt-0">
								<span>[[LABEL_DESCRIPTION]]</span>
								<p id="description"><?php echo $product['description']; ?></p>

								<span>[[LABEL_PRICE]]</span>
								<p id="price"><?php echo $product['price']; ?></p>
							</div>
							<form onsubmit="return false" method="post">
								<div class="form-group basic">
									<div class="input-wrapper">
										<label for="quantity">[[LABEL_QUANTITY]]</label>
										<input type="number" class="form-control" id="quantity" inputmode="numeric"
											   pattern="[0-9]*" name="quantity" min="1" value="1" required
											   placeholder="Quantity">
										<input type="hidden" class="form-control" id="product_id" name="product_id">
										<input type="hidden" class="form-control" id="product_price"
											   name="product_price"
											   value="<?php echo $product['price']; ?>">
									</div>
								</div>
								<div class="form-group basic">
									<div class="input-wrapper">
										<button type="button" class="btn btn-lg btn-warning btn-block" id="add">
											[[LABEL_ADD]]
										</button>
									</div>
								</div>
							</form>
						</div>
					</div>

					<div class="modal fade dialogbox" id="orderModal" data-backdrop="static" tabindex="-1"
						 role="dialog">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">
										[[LABEL_PAYMENT]]
									</h5>
									<ion-icon class="btn btnClose" name="close-circle-outline"></ion-icon>
								</div>
								<div class="modal-body">
									<div class="error-div"></div>
									<div class="form-group basic">
										<div class="input-wrapper">
											<label for="total_amount">[[LABEL_TOTAL_AMOUNT]]</label>
											<input type="number" class="form-control total_amount" id="total_amount"
												   name="total_amount" readonly>
										</div>
									</div>

									<div class="form-group basic">
										<div class="input-wrapper">
											<button type="submit" onclick="add_to_cart('<?php echo $product['id']; ?>', quantity.value)"
													id="paymentBtn1" class="paymentBtn btn btn-lg btn-warning btn-block">
												[[LABEL_ADD_TO_CART]]
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="modal fade dialogbox" id="paymentModal" data-backdrop="static" tabindex="-1"
						 role="dialog">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">
										[[LABEL_PAYMENT]]
									</h5>
									<ion-icon class="btn btnClose" name="close-circle-outline"></ion-icon>
								</div>
								<div class="modal-body">
									<div id="qrcode" class="share_qr_code"></div>
								</div>
								<div class="modal-footer">
									<div class="form-group basic">
										<div class="input-wrapper">
											<button type="submit" id="paymentBtn" class="paymentBtn btn btn-primary">
												[[LABEL_PAY_NOW]]
											</button>
										</div>
									</div>
									<ion-icon class="btn btnClose" name="close-circle-outline"></ion-icon>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
