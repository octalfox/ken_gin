<div id="appCapsule" style="height: 100vh;">
	<div class="section mb-5 p-3">
		<form class="form-horizontal" action="<?php echo base_url("password/verify") ?>" method="post">
			<div class="card">
				<div class="card-body pb-1">
					<div class="section text-center">
						<?php $this->load->view('partials/guest_logo'); ?>
					</div>
					<div class="card-title d-flex justify-content-around align-items-center">
						<div class="row">
							<h2 class="text-center m-0">[[DEF_FORGET_PASSWORD]]</h2>
						</div>
						<div class="row">
							<?php $this->load->view('partials/language_changer'); ?>
						</div>
					</div>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <input type="text" class="form-control" id="userid" name="userid"
                                   placeholder="[[LABEL_USERID]]" value="<?php echo isset($userid) ? $userid : ""; ?>">
                        </div>
                    </div>
                    <div class="transparent mt-2 mb-2">
                        <button type="submit" id="btnSubmit" class="btn btn-warning btn-block btn-lg">
							[[DEF_SUBMIT]]
                        </button>
                    </div>
                </div>
            </div>
            <div class="form-links mt-2">
                <div><a href="<?php echo base_url("login"); ?>" class="text-white">[[DEF_BACK]]</a></div>
            </div>
        </form>
    </div>
</div>

