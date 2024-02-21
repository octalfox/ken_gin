<div id="appCapsule">
	<div class="section mt-2">
		<div class="card">
			<div class="card-body">
				<?php if ($return['response'] == 'error') { ?>
					<div class="row">
						<div class="col-md-12">
							<div class="alert alert-danger">
								<?php echo $return['message'] ?>
							</div>
						</div>
					</div>
					<div class="row pt-3">
						<div class="col-md-12">
							<?php foreach ($return['data'] as $error) {
								?>
								<div class="row"><strong>&emsp;<?php echo $error; ?></strong></div>
								<?php
							} ?>
						</div>
					</div>
				<?php } ?>
				<?php if ($return['response'] == 'success') { ?>
					<div class="row">
						<div class="col-md-12">
							<div class="alert alert-success">
								<?php echo $return['message']; ?>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
