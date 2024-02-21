<div id="appCapsule">
	<div class="section mt-2">
		<div class="card">
			<div class="card-body">
				<form name="frmSetSecPass" method="post" class="form-horizontal">
					<div class="form-group basic">
						<div class="input-wrapper">
							<label class="label" for="sec_password_otp">[[LABEL_OTP]]</label>
							<input type="text" class="form-control verification-input" name="sec_password_otp"
								   id="sec_password_otp" style="min-width: 250px !important;"
								   placeholder="••••••" value="" maxlength="6" minlength="6" required/>
						</div>
					</div>
					<div class="form-group basic">
						<div class="input-wrapper">
							<button type="submit" class="btn btn-warning btn-lg btn-block" name="btnOtp">
								[[DEF_VERIFY]]
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
