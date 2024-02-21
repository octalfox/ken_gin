<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
	<h2 class="text-lg font-medium mr-auto">
		[[LABEL_MEMBERS_UPDATE]]
	</h2>
	<div class="w-full sm:w-auto flex mt-4 sm:mt-0">
		<a href="<?php echo base_url("members"); ?>" class="btn btn-primary shadow-md mr-2">[[LABEL_MEMBERS_LIST]]</a>
	</div>
</div>
<div class="intro-y box mt-5">
	<div class="p-10 overflow-auto">

		<div class="p-5">
			<?php $this->load->view("includes/alert"); ?>
			<div class="preview">
				<form method="post">

					<div class="input-form mt-5">
						<div class="col-md-12">
							<input value="<?php echo $mid; ?>" id="sponsor_id" onkeyup="getUserDTL('sponsor')" name="sponsor_id" placeholder="[[SPONSOR]]" required class="form-control" type="text">
						</div>
						<div class="col-md-12 p-3" id="sponsor_name">--</div>
					</div>

					<div class="input-form mt-5">
						<div class="col-md-12">
							<input value="<?php echo $mid; ?>" onkeyup="getUserDTL('matrix')" name="matrix_id" id="matrix_id" placeholder="[[PLACEMENT]]" required class="form-control" type="text">
						</div>
						<div class="col-md-12 p-3" id="matrix_name">--</div>
					</div>

					<div class="input-form mt-5">
						<div class="col-md-12">
							<select name="matrix_side" required class="form-control">
								<option value="">[[MATRIX_SIDE]]</option>
								<option <?php echo $side == 'L' ? "selected" : "" ?> value="L">[[LEFT]]</option>
								<option <?php echo $side == 'R' ? "selected" : "" ?> value="R">[[RIGHT]]</option>
								<option value="A">[[AUTO]]</option>
							</select>
						</div>
					</div>

					<div class="input-form mt-5">
						<div class="col-md-12">[[ACCOUNT_TYPE]]</div>
						<div class="col-md-12">
							<input checked type="radio" onclick="setUserValue(0)" value="0" name="downline_type"> [[MAIN_ACCOUNT]]
							<br>
							<input type="radio" onclick="setUserValue(1)" value="1" name="downline_type"> [[SUB_ACCOUNT]]
						</div>
					</div>

					<div class="input-form mt-5">
						<div class="col-md-12">
							<input id="f_name" name="f_name" placeholder="[[FIRST_NAME]]" required class="form-control" type="text">
						</div>
					</div>

					<div class="input-form mt-5">
						<div class="col-md-12">
							<input id="l_name" name="l_name" placeholder="[[LAST_NAME]]" class="form-control" type="text">
						</div>
					</div>

					<div class="input-form mt-5">
						<div class="col-md-12">
							<input id="mobile" name="mobile" placeholder="[[MOBILE]]" required class="form-control" type="number">
						</div>
					</div>

					<div class="input-form mt-5">
						<div class="col-md-12">
							<input id="email" name="email" placeholder="[[EMAIL]]" required class="form-control" type="email">
						</div>
					</div>

					<div class="input-form mt-5">
						<div class="col-md-12">[[SPONSOR_TYPE]]</div>
						<div class="col-md-12">
							<input checked type="radio" onclick="setUserAccount('Free')" value="0" name="account_type"> [[COMPANY_SPONSORED]]
							<br>
							<input type="radio" onclick="setUserAccount('Normal')" value="1" name="account_type"> [[NORMAL]]
						</div>
					</div>

					<div class="input-form mt-5 package_wrapper d-none">
						<div class="col-md-12">
							<select onchange="updatePackageId(this.value)" required class="form-control">
								<?php foreach ($packages as $package) {
									if($package['id'] == 0){
										continue;
									}
									?>
									<option value="<?php echo $package['id'] ?>"><?php echo $package['name'] . " (" . $package['price'] . ")" ?></option>
								<?php } ?>
							</select>
						</div>
					</div>

					<input name="country" type="hidden" required value="194">
					<input name="package_id" id="package_id" type="hidden" required value="0">
					<button type="submit" id="submit_btn" class="btn btn-primary mt-5 d-none">[[SUBMIT]]</button>
				</form>
			</div>
		</div>
	</div>
</div>
