<!-- App Capsule -->
<div id="appCapsule">
	<div class="section mt-2">
		<div class="card">
			<div class="card-body">
				<form method="post" action="<?php echo base_url("convert/confirm") ?>">
					<?php echo (isset($msg)) ? $msg : ''; ?>

					<div class="form-group basic">
						<div class="input-wrapper">
							<label class="col-md-12 control-label">[[LABEL_SOURCE_CURRENCY]]</label>
							<div class="col-md-12">
								<select class="form-control" name="base_currency" id="base_currency">
									<?php foreach ($currencies as $currency) {
										if ($currency['can_convert_from']) {
											?>
											<option value="<?php echo $currency['name']; ?>">
												[[<?php echo $currency['name']; ?>]]
											</option>
										<?php }
									} ?>
								</select>
							</div>
						</div>
					</div>

					<div class="form-group basic">
						<div class="input-wrapper">
							<label class="col-md-12 control-label">[[LABEL_AMOUNT]]</label>
							<div class="col-md-12">
								<input type="text" class="form-control" name="base_amount" id="base_amount"/>
							</div>
							<div class="col-md-12">
								<strong>
									[[LABEL_AVAILABLE]]: <?php echo $CCs['balance']; ?>
								</strong>
							</div>
						</div>
					</div>

					<div class="form-group basic">
						<div class="input-wrapper">
							<label class="col-md-12 control-label"></label>
							<div class="col-md-12">
								<input type="submit" name="btnConvert" value="[[Convert]]"
									   class="btn btn-lg btn-warning btn-block"/>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
