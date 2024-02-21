<?php $_SESSION['asset_file_name'] = "bank"; ?>
<div id="appCapsule">
	<div class="section mt-2">
		<div class="card">
			<div class="card-body">
				<form method="post" class="form-horizontal" action="<?php echo base_url("settings/updateBank/".$bankid); ?>">
					<div class="form-group basic">
						<div class="input-wrapper">
							<label class="label" for="country">[[LABEL_BANK_NAME]]</label>
							<select required name="bank_id" class="form-control" id="bank_id" >
								<option value="">[[MSG_NO_BANK_SELECTED]]</option>
								<?php
								foreach ($banks as $key => $row) {
									$sel = (isset($bank['bank_id']) && $row['id'] == $bank['bank_id']) ? 'selected="selected"' : '';
									echo '<option value="' . $row['id'] . '" ' . $sel . '>' . $row['bank_name'] . '</option>';
								}
								?>
							</select>
						</div>
					</div>

					<div class="form-group basic">
						<div class="input-wrapper">
							<label class="label" for="bank_name">[[LBL_OTHER_BANK]]</label>
							<input type="checkbox" id="otherbank"
								   value="[[LABEL_ENABLE]]" <?php echo ($mode == "Edit" && isset($bank['bank_id']) && $bank['bank_id'] == 0) ? 'checked' : ''; ?> />
							<input type="text" class="form-control" name="bank_name" id="bank_name"
								   value="<?php echo isset($_POST['bank_name']) ? $_POST['bank_name'] : (isset($bank['bank_name']) ? $bank['bank_name'] : ""); ?>"
								   placeholder="[[LABEL_INPUT_BANK]]"/>
						</div>
					</div>

					<div class="form-group basic">
						<div class="input-wrapper">
							<label class="label" for="branch">[[LABEL_BRANCH]]</label>
							<input required type="text" class="form-control" id="branch" name="branch"
								   value="<?php echo isset($_POST['branch']) ? $_POST['branch'] : (isset($bank['branch']) ? $bank['branch'] : ""); ?>"/>
						</div>
					</div>

					<div class="form-group basic">
						<div class="input-wrapper">
							<label class="label" for="account_name">[[LABEL_BANK_ACCT_NAME]]</label>
							<input required type="text" id="account_name" class="form-control"
								   name="account_name" <?php if ($mode == "Edit") echo 'readonly="readonly"' ?>
								   value="<?php echo isset($_POST['account_name']) ? $_POST['account_name'] : (isset($bank['account_name']) ? $bank['account_name'] : ""); ?>"/>
						</div>
					</div>

					<div class="form-group basic">
						<div class="input-wrapper">
							<label class="label" for="account_number">[[LABEL_BANK_ACCT_NO]]</label>
							<input required type="text" class="form-control" id="account_number" name="account_number"
								   value="<?php echo isset($_POST['account_number']) ? $_POST['account_number'] : (isset($bank['account_number']) ? $bank['account_number'] : ""); ?>"/>
						</div>
					</div>

					<div class="form-group basic">
						<div class="input-wrapper">
							<button type="submit" class="btn btn-warning btn-lg btn-block">
								[[DEF_UPDATE]]
							</button>
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>
