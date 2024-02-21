<div id="appCapsule">
	<div class="section mt-2">
		<div class="card">
			<div class="card-body">
				<form method="post" action="<?php echo base_url("convert/process") ?>">
					<?php if (isset($msg)) echo $msg; ?>
					<div class="form-group basic">
						<div class="input-wrapper">
							<label class="col-md-12 control-label">[[LABEL_SOURCE_CURRENCY]]</label>
							<div class="col-md-12">
								<select name="base_currency" id="base_currency"
										disabled="disabled" class="form-control">
									<?php foreach ($currencies as $currency) {
										if ($currency['can_convert_from']) {
											?>
											<option value="<?php echo $currency['name']; ?>">
												[[<?php echo $currency['name']; ?>]]
											</option>
										<?php }
									} ?>
									<div class="col-md-12">
								</select>
							</div>
						</div>
					</div>
					<div class="form-group basic">
						<div class="input-wrapper">
							<label class="col-md-12 control-label">[[LABEL_AMOUNT]]</label>
							<div class="col-md-12">
								<input type="text" class="form-control" name="base_amount"
									   id="base_amount"
									   value="<?php echo $post['base_amount']; ?>" readonly/>
							</div>
						</div>
					</div>

					<div class="form-group basic">
						<div class="input-wrapper">
							<label class="col-md-12 control-label">[[LABEL_CONVERTED_POINT]]</label>
							<div class="col-md-12">
								<span class="add-on">[[<?php echo $post['counter_currency']; ?>]]</span>
								<input type="text" class="form-control" name="counter_amount"
									   id="counter_amount" readonly
									   value="<?php echo $post['counter_amount']; ?>"/>
								<input type="hidden" class="form-control" name="secondary_password"
									   id="secondary_password" value="<?php echo $post['secondary_password']; ?>"/>
							</div>
						</div>
					</div>
					<div class="form-group basic">
						<div class="input-wrapper">
							<input type="submit" value="Confirm" name="btnSubmit"
								   class="btn btn-lg btn-warning btn-block"/>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
