<div id="appCapsule">
	<div class="section mt-2">
		<div class="card">
			<div class="card-body">
				<form name="frmAdminGroup" method="post" class="form-horizontal">
					<div class="form-group basic">
						<div class="input-wrapper">
							<label class="label">[[LABEL_NAME]]</label>
							<input type="text" class="form-control" id="disabledInput" disabled
								   placeholder="<?php echo $mem['f_name'] . ' ' . $mem['l_name']; ?>">
						</div>
					</div>

					<div class="form-group basic">
						<div class="input-wrapper">
							<label class="label">[[LABEL_DATE_JOINED]]</label>
							<input type="text" class="form-control" id="disabledInput"
								   placeholder="<?php echo $mem['join_date']; ?>" disabled>
						</div>
					</div>

					<div class="form-group basic">
						<div class="input-wrapper">
							<label class="label" for="txtEmail">[[LABEL_EMAIL]]</label>
							<input type="text" class="form-control" name="email" id="txtEmail" disabled
								   value="<?php echo $mem['email']; ?> "/>
						</div>
					</div>

					<div class="form-group basic">
						<div class="input-wrapper">
							<label class="label"
								   for="selCountry">[[LABEL_COUNTRY]]</label>
						</div>
						<div class="input-wrapper">
							<input type="text" class="form-control" name="country" id="txtEmail" disabled
								   value="<?php echo $mem['full_name']; ?> "/>
						</div>
					</div>

					<div class="form-group basic">
						<div class="input-wrapper mobile_span">
							<label class="label" for="txtMobileNo">
								[[LABEL_MOBILE]]
							</label>
							+<?php echo $mem['code']; ?>
							<input type="text" class="form-control mobile_input" disabled
								   value="<?php echo $mem['mobile']; ?>"/>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
