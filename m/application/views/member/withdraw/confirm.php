<div id="appCapsule">
	<div class="section mt-2">
		<div class="card">
			<div class="card-body">
				<form method="post" action="<?php echo base_url("withdraw/process") ?>">
					<div class="form-group basic">
						<label class="label">[[LABEL_PAYMENT_MODE]]</label>
						<div class="input-wrapper">
							<input type="hidden" name="selPaymentMode"
								   value="<?php echo $_POST['selPaymentMode'] ?>">
							<?php
							if (isset($_POST['selPaymentMode'])) {
								if ($_POST['selPaymentMode'] == "BANK") {
									echo '<span class="input-xxx">[[LABEL_BANK_TRANSFER]]</span>';
								}
								if ($_POST['selPaymentMode'] == "CHEQUE") {
									echo '<span class="input-xxx">[[Cheque]]</span>';
								}
								if ($_POST['selPaymentMode'] == "PAYNOW") {
									echo '<span class="input-xxx">[[LABEL_PAYNOW_ADDRESS]]</span>';
								}
							}
							?>
							<select name="PaymentMode" id="selPaymentMode" disabled="disabled" class="d-none">
								<?php
								if (isset($_POST['selPaymentMode'])) {
									if ($_POST['selPaymentMode'] == "BANK") {
										echo '<option value="BANK" selected="selected">[[LABEL_BANK_TRANSFER]]</option>';
									}
									if ($_POST['selPaymentMode'] == "CHEQUE") {
										echo '<option value="CHEQUE" selected="selected">[[Cheque]]</option>';
									}
									if ($_POST['selPaymentMode'] == "PAYNOW") {
										echo '<option value="PAYNOW" selected="selected">[[LABEL_PAYNOW_ADDRESS]]</option>';
									}
								}
								?>
							</select>
						</div>
					</div>

					<?php if ($_POST['selPaymentMode'] == "BANK") { ?>
						<div class="form-group basic" id="div-bank">
							<label class="label">[[LABEL_BANK_NAME]]</label>
							<div class="input-wrapper">
								<?php $bnk = isset($_POST['bank']) ? $_POST['bank'] : ""; ?>
								<input type="hidden" name="bank" value="<?php echo $bnk; ?>"/>

								<?php
								foreach ($banks as $bank) {
									$bnksel = $bnk == $bank['id'] ? ' selected="selected"' : '';
									if ($bnksel != "") echo "<span class='input-xxx'>" . $bank['bank_name'] . ' - ' . $bank['account_name'] . "<span>";
								}
								?>
								<select name="selbank" id="bank" disabled="disabled" class="d-none">
									<?php
									foreach ($banks as $bank) {
										$bnksel = $bnk == $bank['id'] ? ' selected="selected"' : '';
										if ($bnksel != "") echo '<option value="' . $bank['id'] . '" ' . $bnksel . '>' . $bank['bank_name'] . ' - ' . $bank['account_name'] . '</option>';
									}
									?>
								</select>
							</div>
						</div>
					<?php } ?>

					<?php if ($_POST['selPaymentMode'] == "PAYNOW") { ?>
						<div class="form-group basic" id="div-paynow">
							<label class="label">[[LABEL_PAYNOW_ADDRESS]]</label>
							<div class="input-wrapper">
								<span class="input-xxx">
									<?php echo $_POST['paynow']; ?>
								</span>
								<input name="paynow" id="paynow" type="hidden" class="form-control input-xxx"
									   value="<?php echo $_POST['paynow']; ?>">
							</div>
						</div>
					<?php } ?>

					<div class="form-group basic input-prepend">
						<label class="label" for="">[[LABEL_AMOUNT_TO_WITHDRAWAL]]</label>
						<div class="input-wrapper">
							<input id="txtAmountDeducted" name="txtAmountDeducted" class="form-control uneditable-input" value="<?php echo isset($_POST['txtAmountDeducted']) ? $_POST['txtAmountDeducted'] : "0.00"; ?>" readonly>
						</div>
					</div>
					<div class="clearfix"></div>

					<div class="form-group basic input-prepend">
						<label class="label">[[LABEL_ADMIN_FEE]]</label>
						<div class="input-wrapper">
							<input id="txtAdminFee" name="txtAdminFee" class="form-control uneditable-input" value="<?php echo isset($_POST['txtAdminFee']) ? $_POST['txtAdminFee'] : "0.00"; ?>" readonly>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="form-group basic input-prepend">
						<label class="label">[[LABEL_RECEIVABLE_AMOUNT]]</label>
						<div class="input-wrapper">
							<input id="txtAmtToWithdraw" name="txtAmtToWithdraw" class="form-control uneditable-input" value="<?php echo isset($_POST['txtAmtToWithdraw']) ? $_POST['txtAmtToWithdraw'] : "0.00"; ?>" readonly>
						</div>
					</div>

					<div class="form-group basic">
						<div class="input-wrapper">
							<button type="submit" class="btn btn-warning btn-lg btn-block" id="btnConfrm"
									name="btnConfrm">[[DEF_CONFIRM]]
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
