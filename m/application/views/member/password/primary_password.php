<div id="appCapsule">
	<div class="section mt-2">
		<div class="card">
			<div class="card-body">
				<form name="frmSetSecPass" method="post" class="form-horizontal">
					<div class="form-group basic">
						<div class="input-wrapper">
							<label class="label" for="old_password">[[LABEL_OLD_PASSWORD]]</label>
							<input type="password" class="form-control" name="old_password" id="old_password" value=""/>
						</div>
					</div>

					<div class="form-group basic">
						<div class="input-wrapper">
							<label class="label" for="txtPrimaryPassword">[[LABEL_PASSWORD]]</label>
							<input type="password" class="form-control" name="password" id="password" value=""/>
						</div>
						<div class="input-info">[[Password at least 8 numbers]]</div>
					</div>

					<div class="form-group basic">
						<div class="input-wrapper">
							<label class="label" for="txtConfirmPrimaryPassword">[[LABEL_CONFIRM_PASSWORD]]</label>
							<input type="password" class="form-control" name="conf_password" id="conf_password" value=""/>
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
