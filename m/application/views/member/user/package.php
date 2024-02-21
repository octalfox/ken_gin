<?php $_SESSION['asset_file_name'] = "signup_packages"; ?>
<div id="appCapsule">
	<div class="section mt-2">
		<div class="card">
			<div class="card-body">
				<form id="frmRegister" name="frmRegister" method="post" class="form-horizontal">
					<div class="form-group basic">
						<div class="input-wrapper">
							<label class="col-md-12 control-label">[[LABEL_TYPE_PACKAGE]]</label>
							<div class="col-md-12">
								<select class="form-control" id="package_id" name="package_id">
									<?php foreach ($packages as $row) {
										if ($row['for_admin'] == 1) {
											continue;
										}
										?>
										<option value="<?php echo $row['id'] ?>"><?php echo $row['name'] . " (" . $row['price'] . ")" ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
					</div>
					<?php
					$n = 0;
					foreach ($packages as $row) {
						?>
						<div class="form-group basic secs sec_<?php echo $row['id'] ?> <?php echo $n == 0 ? '' : 'd-none' ?>">
							<div class="input-wrapper">
								<label class="col-md-12 control-label">
									<?php echo $row['name'] ?>
								</label>
								<div class="col-md-12">
									<center>
										<img width="350"
											 src="<?php echo $row['img_file'] ? BASE_URL . 'public/img_product/' . $row['img_file'] : 'https://via.placeholder.com/150x150'; ?>"
											 alt="">
									</center>
								</div>
							</div>
						</div>
						<?php
						$n++;
					}
					?>
					<div class="form-group basic">
						<div class="input-wrapper">
							<label class="col-md-12 control-label">[[LABEL_PAYMENT_MODE]]</label>
							<div class="col-md-12">
								<select class="form-control" name="payment_gateway" id="payment_gateway">
									<?php
									foreach ($gateways as $paygate) {
										if ($paygate['member_signup'] == 0) continue;
										$gateway_name = $paygate['gateway'];
										echo '<option value="' . $paygate['gateway'] . '"> [[' . $gateway_name . ']]</option>';
									}
									?>
								</select>
							</div>
						</div>
					</div>

					<div class="form-group basic">
						<div class="input-wrapper">
							<div class="col-md-12 col-xs-offset-5">
								<input type="submit" class="btn btn-lg btn-warning btn-block" value="[[DEF_SUBMIT]]"/>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
