<div id="appCapsule">
	<div class="section mb-5 p-3">
		<form class="form-horizontal" action="<?php echo base_url("password/process") ?>" method="post">
			<div class="card">
				<div class="card-body pb-1">
					<div class="section text-center">
						<?php $this->load->view('partials/guest_logo'); ?>
					</div>
					<div class="card-title d-flex justify-content-around align-items-center">
						<div>
							<h2 class="text-center m-0">[[DEF_FORGET_PASSWORD]]</h2>
						</div>
					</div>

						<div class="form-group basic">
							<div class="input-wrapper">
								<input type="password" class="form-control" name="password" placeholder="[[LABEL_NEW_PASSWORD]]">
							</div>
						</div>

						<div class="form-group basic">
							<div class="input-wrapper">
								<input type="password" class="form-control" name="conf_password" placeholder="[[LABEL_NEW_CONFIRM_PASSWORD]]">
							</div>
						</div>


						<div class="transparent mt-2 mb-2">
							<button type="submit" id="btnSubmit" class="btn btn-warning btn-block btn-lg" style="border-radius: 10px !important;">
								[[DEF_SUBMIT]]
							</button>
						</div>

				</div>
			</div>
			<div class="form-links mt-2">
				<div><a href="<?php echo BASE_URL; ?>member_login" class="text-white">[[DEF_BACK]]</a></div>
			</div>
		</form>
	</div>
</div>
