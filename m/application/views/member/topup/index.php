<?php $_SESSION['asset_file_name'] = "topup"; ?>
<div id="appCapsule">
	<div class="section mt-2">
		<div class="card">
			<div class="card-body">
				<form method="post" enctype="multipart/form-data" action="<?php echo base_url("topup/process") ?>"
					  class="form-horizontal">
					<div class="form-group basic">
						<div class="input-wrapper">
							<input type="number" value="100" id="deposit_amount" name="deposit_amount" min="100"
								   step="100" class="form-control" placeholder="Amount to Topup" required>
						</div>
						<div class="input-info">[[MIN_AMOUNT_USD]] 100.00</div>
					</div>
					<div class="form-group basic">
						<div class="input-wrapper">
							<input class="form-control" pattern="\d*" id="dummy_amount"
								   value="<?php echo "100"; ?>" min="<?php echo "100"; ?>"
								   readonly="readonly"/>
							<input type="hidden" id="transfer_amount" name="transfer_amount">
							<input type="hidden" id="transfer_currency" name="transfer_currency">
						</div>
						<div class="input-info">
							<div class="clearfix"></div>
							<div style="height:20px;"></div>
							<strong>[[LABEL_CURRENCY_RATE]]:</strong>
							<select id="change_currency">
								<option data-base="USD" data-counter="USD" data-rate="1">
									[[PAY_USD_DEFAULT]]
								</option>
								<?php
								$rates = $_SESSION['constants']['CURR_RATES'];
								foreach ($rates as $rate) {
									?>
									<option data-base="<?php echo $rate['base_currency'] ?>" data-counter="<?php echo $rate['counter_currency'] ?>" data-rate="<?php echo $rate['deposit_currency_rate'] ?>">
										<?php echo $rate['base_currency'] ?> [[TO]]
										<?php echo $rate['counter_currency'] ?>: &emsp;
										<?php echo $rate['deposit_currency_rate'] ?>
									</option>
									<?php
								}
								?>
							</select>
						</div>
						<!--						<div class="input-info">-->
						<!--							<span class="add-on">[[LABEL_CURRENCY_RATE]]: [[USD_SGD_TOPUP]]</span>-->
						<!--							<span class="input-medium uneditable-input">-->
						<?php //echo $_SESSION['constants']['USD_SGD_TOPUP']; ?><!--</span><br/>-->
						<!--							<input type="hidden" id="counter_currency" name="counter_currency" value="USD" />-->
						<!--							<input type="hidden" id="currency_rate" name="currency_rate" value="-->
						<?php //echo $_SESSION['constants']['USD_SGD_TOPUP']; ?><!--" />-->
						<!--						</div>-->
					</div>
					<div class="form-group basic">
						<div class="input-wrapper">
							<?php
							if (count($banklist) > 0) {
								?>
								<select onchange="show_bank(this)" name="bank_id" class="form-control">
									<option value="">[[MSG_SELECT_COMPANY_BANK]]</option>
									<?php
									foreach ($banklist as $key => $row) {
										$sel = ($row['id'] == $bank['bank_id']) ? 'selected="selected"' : '';
										echo '<option value="' . $row['id'] . '" ' . $sel . '>' . $row['bank_name'] . '</option>';
									}
									?>
								</select>
								<?php
							} else {
								?>
								<label class="form-label"
									   for="country"><?php echo isset($banklist[0]['bank_name']) ? $banklist[0]['bank_name'] : "[[MSG_NO_BANK_SELECTED]]"; ?></label>
								<?php
							}
							?>
						</div>
					</div>
					<div class="form-group basic">
						<div class="input-wrapper">
							<?php
							$i = 0;
							foreach ($banklist as $row) {
								$i++;
								?>
								<div class="row all_banks bank_dtl_<?php echo $row['id']; ?>" style="display: none">
									<div class="form-group">
										<label class="col-md-4 form-label" for="phone">[[LABEL_BANK_NAME]]</label>
										<label style="float: right" class="col-md-7 form-label"
											   for="phone"><?php echo $row['bank_name']; ?></label>
									</div>
									<div class="form-group">
										<label class="col-md-4 form-label" for="phone">[[LABEL_BRANCH]]</label>
										<label style="float: right" class="col-md-7 form-label"
											   for="phone"><?php echo $row['branch']; ?></label>
									</div>
									<div class="form-group">
										<label class="col-md-4 form-label" for="phone">[[LABEL_BANK_ACCT_NAME]]</label>
										<label style="float: right" class="col-md-7 form-label"
											   for="phone"><?php echo $row['account_name']; ?></label>
									</div>
									<div class="form-group">
										<label class="col-md-4 form-label" for="phone">[[LABEL_BANK_ACCT_NO]]</label>
										<label style="float: right" class="col-md-7 form-label"
											   for="phone"><?php echo $row['account_number']; ?></label>
									</div>
								</div>
								<?php
								if (($i > 0) && $i < count($banklist)) {
									?>
									<hr>
									<?php
								}
							}
							?>
						</div>
					</div>
					<div class="form-group basic">
						<label class="label">[[LABEL_UPLOAD_PAYMENT_SLIP]]</label><br>
						<div class="custom-file-upload" id="fileUpload1">
							<input type="file" required id="fileuploadInput" name="payment_slip"
								   accept=".png, .jpg, .jpeg">
							<label for="fileuploadInput">
								<span>
									<strong>
										<ion-icon name="arrow-up-circle-outline" role="img"
												  class="md hydrated"
												  class="md hydrated"
												  aria-label="arrow up circle outline"></ion-icon>
										<i>[[LABEL_UPLOAD_PAYMENT_SLIP]]</i>
									</strong>
								</span>
							</label>
						</div>
					</div>

					<div class="form-group basic">
						<div class="input-wrapper">
							<button type="submit" class="btn btn-warning btn-lg btn-block" name="btnSave">
								[[DEF_SUBMIT]]
							</button>
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>
