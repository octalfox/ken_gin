<div id="appCapsule">
	<div class="section mb-5 p-3">
		<form class="form-horizontal" action="<?php echo base_url("password/reset") ?>" method="post">
			<div class="card">
				<div class="card-body pb-1">
					<div class="section text-center">
						<?php $this->load->view('partials/guest_logo'); ?>
					</div>
					<div class="card-title d-flex justify-content-around align-items-center">
						<div class="row">
							<h2 class="text-center m-0">[[DEF_CHECK_OTP]]</h2>
						</div>
						<div class="row">
							<?php $this->load->view('partials/language_changer'); ?>
						</div>
					</div>

					<div class="form-group basic">
						<div class="input-wrapper">
							<label for="otp" class="mb-2 text-center">[[LABEL_OPT_MSG]]</label>
							<input type="text" name="otp" class="form-control verification-input" id="otp"
								   placeholder="••••••" maxlength="6" style="min-width: 250px !important;">
						</div>
					</div>
					<div class="form-group basic">
						<div class="transparent mt-2 mb-2">
							<button type="submit" id="btnSubmit"
									class="btn btn-warning btn-block btn-lg"
									style="border-radius: 10px !important;">[[DEF_SUBMIT]]
							</button>
						</div>
					</div>
					<div class="form-links mt-2">
						<div><a href="<?php echo BASE_URL; ?>member_login" class="text-white">[[DEF_BACK]]</a></div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
