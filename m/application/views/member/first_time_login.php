<div id="appCapsule">
	<div class="section mt-2">
		<div class="card">
			<div class="card-body">
				<form name="frmSetPass" method="post" class="form-horizontal">
					<div class="col-md-12">
						<div class="form-group basic">
							<label for="old_password"
								   class="col-md-12 control-label">[[LABEL_OLD_PASSWORD]]</label>
							<div class="col-md-12">
								<input type="password" class="form-control" name="old_password"
									   id="old_password" value=""/>
							</div>
						</div>
						<div class="form-group basic">
							<label for="txtPrimaryPassword"
								   class="col-md-12 control-label">[[LABEL_PASSWORD]]</label>
							<div class="col-md-12">
								<input type="password" class="form-control" name="password" id="password"
									   value=""/><small>[[LABEL_PASSWORD_8]]</small>
							</div>
						</div>
						<div class="form-group basic">
							<label for="txtConfirmPrimaryPassword" class="col-md-12 control-label">[[LABEL_CONFIRM_PASSWORD]]</label>
							<div class="col-md-12">
								<input type="password" class="form-control" name="conf_password"
									   id="conf_password" value=""/>
							</div>
						</div>
						<?php if ($_SESSION['logged']['secondary_salt'] != "") { ?>
							<div class="form-group basic">
								<label for="old_secondary_password" class="col-md-12 control-label">[[LABEL_OLD_SECONDARY_PASSWORD]]</label>
								<div class="col-md-12">
									<input type="password" class="form-control" name="old_secondary_password"
										   id="old_secondary_password" value=""/>
								</div>
							</div>
						<?php } ?>
						<div class="form-group basic">
							<label for="txtSecondPassword"
								   class="col-md-12 control-label">[[LABEL_SECONDARY_PASSWORD]]</label>
							<div class="col-md-12">
								<input type="password" class="form-control" name="sec_password"
									   id="sec_password" value=""/><small>[[LABEL_PASSWORD_8]]</small>
							</div>
						</div>
						<div class="form-group basic">
							<label for="txtConfirmSecondPassword" class="col-md-12 control-label">[[LABEL_CONFIRM_SEC_PASSWORD]]</label>
							<div class="col-md-12">
								<input type="password" class="form-control" name="conf_sec_password"
									   id="conf_sec_password" value=""/>
							</div>
						</div>
						<div class="form-group mt-2">
							<div class="col-md-offset-12 col-md-12">
								<button type="submit" class="btn btn-warning btn-lg btn-block">
									[[DEF_UPDATE]]
								</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
