<?php $_SESSION['asset_file_name'] = "cart_payment"; ?>
<div id="appCapsule">
	<div class="section mt-2 mb-2">
		<div class="card <?php echo count($products) <= 0 ? "" : " d-none "; ?>" id="empty_card">
			<div class="card-body">
				<div class="alert alert-warning">
					[[LABEL_NOTHING_IN_CART]]
				</div>
				<form id="frmBuyProduct" name="frmBuyProduct" method="post" class="form-horizontal">
					<div class="row m-1 mt-5">
						<div class="col-md-12">
							[[LABEL_GOTO_PRODUCT_PAGE]] <a href="<?php echo base_url("products"); ?>">[[LABEL_CLICK_HERE]]</a>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="card <?php echo count($products) <= 0 ? " d-none " : ""; ?>" id="cart_form">
			<div class="card-body">
				<form id="frmBuyProduct" name="frmBuyProduct" method="post" class="form-horizontal">
					<table class="table table-condensed table-striped">
						<thead>
						<tr>
							<th>[[LABEL_PRODUCT_NAME]]</th>
							<th>[[LABEL_QUANTITY]]</th>
							<th></th>
							<th style="width: 125px">[[LABEL_UNIT_PRICE]]</th>
							<th style="width: 125px !important;">[[LABEL_AMOUNT]]</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$total_amount = 0.00;
						foreach ($products as $p) {
							$amount = $p['qty'] * $p['unit_price'];
							$total_amount += $amount;
							?>
							<tr class="cart__<?php echo $p['id'] ?>">
								<td><?php echo (isset($p['code']) ? ($p['code'] . ' - ') : "") . $p['name'] ?></td>
								<td>
									<select class="val_qty form-control custom_select"
											onchange="updateCart(this.value, <?php echo $p['id'] ?>)">
										<?php for ($i = 1; $i <= 999; $i++) { ?>
											<option <?php echo $i == $p['qty'] ? "selected" : ""; ?>
													value="<?php echo $i; ?>"><?php echo $i; ?></option>
										<?php } ?>
									</select>
								</td>
								<td>
									<div onclick="updateCart(0, <?php echo $p['id'] ?>)"
										 class="badge badge-danger custom_badge">Remove
									</div>
								</td>
								<td>
									$ <?php echo number_format($p['unit_price'], 2); ?>
									<input type="hidden" class="val_price" value="<?php echo $p['unit_price']; ?>">
								</td>
								<td class="val_qtotal">$ <?php echo number_format($amount, 2); ?></td>
							</tr>
							<?php
						}
						?>
						</tbody>
					</table>
					<table class="table table-responsive">
						<tr>
							<td style="text-align:right;">[[LABEL_SUBTOTAL]] :</td>
							<td style="width: 125px !important;" class="val_subtotal">
								$ <?php echo number_format($total_amount, 2) ?></td>
						</tr>
						<tr>
							<td style="text-align:right;">[[LABEL_DELIVERY_CHARGE]] :</td>
							<td>$ 0.00</td>
						</tr>
						<tr>
							<td style="text-align:right;">[[LABEL_TOTAL_AMOUNT]] :</td>
							<td class="val_total">$ <?php echo number_format($total_amount, 2) ?></td>
						</tr>
					</table>


					<table class="table table-responsive">
						<tr>
							<td>
								<strong>[[LABEL_OTHER_CURRENCY_RATE]]:</strong> &emsp; (<small><i>[[NOT_APPLICATION_FOR_WALLET]]</i></small>)
								<br>
								<select id="change_currency">
									<option
											data-base="USD"
											data-counter="USD"
											data-rate="1"
									>[[PAY_USD_DEFAULT]]</option>
									<?php
									$rates = $_SESSION['constants']['CURR_RATES'];
									foreach ($rates as $rate) {
										?>
										<option
												data-base="<?php echo $rate['base_currency'] ?>"
												data-counter="<?php echo $rate['counter_currency'] ?>"
												data-rate="<?php echo $rate['deposit_currency_rate'] ?>"
										>
											<?php echo $rate['base_currency'] ?>
											[[TO]]
											<?php echo $rate['counter_currency'] ?>:
											&emsp;
											<?php echo $rate['deposit_currency_rate'] ?>
										</option>
										<?php
									}
									?>
								</select>
							</td>
							<td style="text-align:right;">[[LABEL_PAYABLE]]:</td>
							<td style="width: 125px !important;" id="converted_payable">$ <?php echo number_format($total_amount, 2) ?></td>
						</tr>
					</table>
					<?php
					if (count($gateways) > 0) {
						$counter = 0;
						?>
						<div class="clearfix"></div>
						<div style="height:20px;"></div>
						<strong>[[LABEL_PAYMENT_MODE]]</strong>
						<div style="height:10px;"></div>
						[[MSG_NON_REFUND]]
						<div style="height:20px;"></div>
						<?php
					}
					?>
					<div class="form-group basic select_pament_mode">
						<div class="input-wrapper">
							<select class="form-control" id="selected_payment_mode" onchange="triggerConfirm()">
								<option value="">[[LABEL_SELECT_ONE]]</option>
								<?php
								foreach ($gateways as $g) { ?>
									<option value="<?php echo $g['gateway']; ?>">[[<?php echo $g['gateway']; ?>]]
									</option>
									<?php
								}
								?>
							</select>
						</div>
					</div>
					<input type="hidden" value="" name="paymentMode" id="paymentMode">
					<input type="hidden" value="" name="currency_converted" id="currency_converted">
					<input type="hidden" value="" name="amount_converted" id="amount_converted">
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade dialogbox show" id="paymentConfirmation" data-bs-backdrop="static" tabindex="-1" role="dialog"
	 aria-modal="true" style="display: none;">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">[[LABEL_ARE_YOU_SURE]]</h5>
			</div>
			<div class="modal-body">
				[[LABEL_PAYABLE]]: <span id="label_amount"></span>
			</div>
			<div class="modal-footer">
				<div class="btn-inline">
					<a href="#" class="btn btn-text-danger" data-bs-dismiss="modal" onclick="cancelPayment()">
						[[CANCEL]]
					</a>
					<a href="#" class="btn btn-text-primary" data-bs-dismiss="modal" onclick="changePaymentMode()">
						[[PROCEED]]
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
