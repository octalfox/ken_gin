<div id="appCapsule">
	<div class="section mt-2">
		<div class="card">
			<div class="card-body">
				<form method="post" action="<?php echo base_url("transfer/confirm") ?>">
					<?php echo (isset($msg)) ? $msg : ''; ?>

					<div class="form-group basic">
						<div class="input-wrapper">
							<div class="btn btn-lg btn-warning btn-block"
								 onclick="window.location='<?php echo base_url('transfer/history') ?>'">
								[[MBR_NAVI_TRANSFER_HISTORY]]
							</div>
						</div>
					</div>

					<div class="form-group basic">
						<div class="input-wrapper">
							<label class="col-md-12 control-label" for="txtUserID">[[LABEL_USERID]]</label>
							<div class="col-md-12">
								<input type="text" class="form-control" name="txtUserID" id="txtUserID" value=""/>
							</div>
						</div>
					</div>
					<div class="form-group basic">
						<div class="input-wrapper">
							<label class="col-md-12 control-label" for="txtAmt">[[RC]]</label>
							<div class="col-md-12">
								<?php $fldnm = 'RC_amount'; ?>
								<input type="text" class="form-control amtcls" name="<?php echo $fldnm ?>" id="<?php echo $fldnm; ?>"
									   value="<?php echo isset($_POST[$fldnm]) ? $_POST[$fldnm] : "0.00"; ?>"/>
							</div>
							<div class="col-md-12">
								<strong>
									[[LABEL_AVAILABLE]]: <?php echo $CCs['balance']; ?>
								</strong>
							</div>
						</div>
					</div>
					<input type='hidden' name='hidAction' value='transfer_out'>
					<div class="form-group basic">
						<div class="input-wrapper">
							<input type="submit" name="btnSubmit" id="btnSave" value="[[DEF_SUBMIT]]"
								   class="btn btn-lg btn-warning btn-block"/>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
