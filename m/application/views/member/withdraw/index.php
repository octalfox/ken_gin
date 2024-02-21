<?php $_SESSION['asset_file_name'] = "withdraw"; ?>
<div id="appCapsule">
	<div class="section mt-2">
		<div class="card">
			<div class="card-body">
				<div class="alert alert-success"><?php echo $alert; ?></div>
				<form method="post" action="<?php echo base_url("withdraw/confirm") ?>" class="form-horizontal">
					<div class="form-group basic">
						<div class="form-group basic input-prepend">
							<label class="label" for="txtAmtToWithdraw">[[LABEL_AMOUNT_TO_WITHDRAWAL]]</label>
							<div class="input-wrapper">
								<input class="form-control" type="number" min="100" step="100" value="100"
									   id="txtAmountDeducted" name="txtAmountDeducted">
								<span style="color: black!important;">[[LABEL_BALANCE]]: <?php echo number_format((isset($bal['CC']['available_balance']) ? $bal['CC']['available_balance'] : 0), 2); ?></span>
							</div>
						</div>
						<div class="clearfix mt-2"></div>

						<div class="form-group basic input-prepend">
							<label class="label">[[LABEL_ADMIN_FEE]]</label>
							<div class="input-wrapper">
								<input id="txtAdminFee" name="txtAdminFee" class="form-control uneditable-input"
									   value="0.00" readonly>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="form-group basic input-prepend">
							<label class="label">[[LABEL_RECEIVABLE_AMOUNT]]</label>
							<div class="input-wrapper">
								<input id="txtAmtToWithdraw" name="txtAmtToWithdraw" class="form-control uneditable-input" value="0.00" readonly>
							</div>
						</div>

						<div class="form-group basic">
							<label class="label">[[LABEL_WITHDRAWAL_MODE]]</label>
							<div class="input-wrapper">
								<select name="selPaymentMode" id="selPaymentMode" class="form-control" onchange="change_payment(this)">
									<option value="BANK">[[LABEL_BANK_TRANSFER]]</option>
									<option value="PAYNOW">[[LABEL_PAYNOW]]</option>
								</select>
							</div>
						</div>
						<div class="form-group basic" id="div-bank">
							<label class="label">[[LABEL_BANK_NAME]]</label>
							<div class="input-wrapper">
								<?php if (count($banks) <= 0) {
									echo '<a href="' . base_url("bank/add") . '" class="btn btn-primary">[[LABEL_ADD_BANK]]</a>';
								} else {
									?>
									<select required name="bank" id="bank" class="form-control">
										<?php
										foreach ($banks as $bank) {
											echo '<option value="' . $bank['id'] . '">' . $bank['bank_name'] . ' - ' . $bank['account_name'] . '</option>';
										}
										?>
									</select>
									<?php
								}
								?>
							</div>
						</div>
					</div>
					<div class="form-group d-none" id="div-paynow">
						<label class="label">[[LABEL_PAYNOW_ADDRESS]]</label>
						<div class="input-wrapper">
							<input name="paynow" id="paynow" class="form-control">
						</div>
					</div>

					<div class="form-group basic">
						<div class="input-wrapper">
							<button type="submit" class="btn btn-warning btn-lg btn-block" id="btnNext"
									name="btnNext">
								[[DEF_WITHDRAW]]
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
