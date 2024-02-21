<?php $_SESSION['asset_file_name'] = "share"; ?>
<div id="appCapsule">
	<div class="section mt-2">
		<div class="card">
			<div class="card-body">
				<form name="frmAdminGroup" method="post" class="form-horizontal">
					<div style="text-align:center;">
						<div id="qr_image_section" class="share_qr_code"></div>
						<h4 style="margin: 5px auto !important;" id="qr_link_section"></h4>
					</div>
					<div class="form-group basic">
						<div class="input-wrapper">
							<button type="button" class="btn btn-warning btn-lg btn-block"
									onclick="copyRefLink(this, 'link_to_copy')">[[LABEL_COPY]]
							</button>
						</div>
					</div>
					<input style="position: absolute; top: -1000000px;" id="link_to_copy" class="link_to_copy_input"
						   value="<?php echo base_url("u/" . $_SESSION['logged']['userid']); ?>">
					<div class="form-group basic">
						<div class="input-wrapper">
							<a href="dataURL" class="btn btn-warning btn-lg btn-block" id="downloadButton"
							   target="_blank" download style="float: left;">[[DEF_DOWNLOAD]]</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

