<div id="appCapsule" style="height: 100vh;">
	<div class="section mb-5 p-3">
		<form class="form-horizontal" name="frmMemberLogin" method="post">
			<div class="card">
				<div class="card-body pb-1">
					<div class="section text-center">
						<?php $this->load->view('partials/guest_logo'); ?>
					</div>

					<div class="card-title d-flex justify-content-around align-items-center">
						<div class="row">
							<h2 class="text-center m-0">[[LABEL_MEMBER_LOGIN]]</h2>
						</div>
						<div class="row">
							<?php $this->load->view('partials/language_changer'); ?>
						</div>
					</div>
					<div class="form-group basic">
						<div class="input-wrapper">
							<input type="hidden" name="access_token" id="access_token"
								   value="<?php echo isset($_SESSION['access']['access_token']) ? $_SESSION['access']['access_token'] : ''; ?>">
							<input type="text" class="form-control" id="username" name="username"
								   placeholder="[[LABEL_USERNAME]]">
						</div>
					</div>

					<div class="form-group basic">
						<div class="input-wrapper">
							<input type="password" class="form-control" id="password" name="password"
								   placeholder="[[LABEL_PASSWORD]]">
						</div>
					</div>
					<div class="transparent mt-2 mb-2">
						<button type="submit" class="btn btn-warning btn-block btn-lg">
							[[DEF_LOGIN]]
						</button>
					</div>
				</div>
			</div>

			<div class="form-links mt-2">
				<div><a href="<?php echo base_url("password"); ?>" class="text-white">[[DEF_FORGET_PASSWORD]]</a></div>
			</div>
		</form>
	</div>
</div>
