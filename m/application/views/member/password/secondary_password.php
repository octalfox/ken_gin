<?php $_SESSION['asset_file_name'] = "password"; ?>
<div id="appCapsule">
	<div class="section mt-2">
		<div class="card">
			<div class="card-body">
				<form name="frmSetSecPass" method="post" class="form-horizontal">
					<?php echo (isset($msg)) ? $msg : ''; ?>
					<?php if ($_SESSION['logged']['secondary_salt'] != "") { ?>
						<div class="form-group basic">
							<div class="input-wrapper">
								<label class="label"
									   for="old_secondary_password">[[LABEL_OLD_SECONDARY_PASSWORD]]</label>
								<input type="password" class="form-control" name="old_secondary_password"
									   id="old_secondary_password" value=""/>
							</div>
						</div>
					<?php } ?>

					<div class="form-group basic">
						<div class="input-wrapper">
							<label class="label" for="txtSecondPassword">[[LABEL_SECONDARY_PASSWORD]]</label>
							<input type="password" class="form-control" name="sec_password" id="sec_password" value=""/>
						</div>
						<div class="input-info">[[Password at least 8 numbers]]</div>
					</div>

					<div class="form-group basic">
						<div class="input-wrapper">
							<label class="label" for="txtConfirmSecondPassword">[[LABEL_CONFIRM_PASSWORD]]</label>
							<input type="password" class="form-control" name="conf_sec_password" id="conf_sec_password"
								   value=""/>
						</div>
					</div>

					<div class="form-group basic">
						<div class="input-wrapper">
							<button type="submit" class="btn btn-warning btn-lg btn-block" name="btnSave">
								[[DEF_UPDATE]]
							</button>
						</div>
					</div>

					<div class="form-group basic">
						<div class="input-wrapper">
							<button type="button" class="btn btn-warning btn-lg btn-block" onclick="mnc()">
								[[DEF_RESET_SECURITY_PASSWORD]]
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
