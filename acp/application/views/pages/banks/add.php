<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
	<h2 class="text-lg font-medium mr-auto">
		[[LABEL_BANK_UPDATE]]
	</h2>
	<div class="w-full sm:w-auto flex mt-4 sm:mt-0">
		<a href="<?php echo base_url("banks"); ?>" class="btn btn-primary shadow-md mr-2">[[LABEL_BANK_LIST]]</a>
	</div>
</div>
<div class="intro-y box">
	<div class="p-10 overflow-auto">

		<?php $this->load->view("includes/alert"); ?>
		<div class="preview">
			<form method="post" enctype="multipart/form-data">


				<div class="input-form mt-5">
					<label class="col-md-3 control-label" for="country">[[LABEL_BANK_NAME]] (*)</label>
					<div class="col-md-6">
						<select required name="bank_id" class="form-control">
							<option value="">[[MSG_NO_BANK_SELECTED]]</option>
							<?php
							if(isset($_POST['bank_id'])){
								$bank_id = $_POST['bank_id'];
							}elseif(!isset($_POST['bank_id']) && $bank['bank_id']){
								$bank_id =  $bank['bank_id'];
							}
							foreach($banklist as $key => $row){
								$sel = '';

								if(isset($bank_id) &&  $row['id'] == $bank_id){
									$sel = 'selected="selected"';
								}
								echo '<option value="'.$row['id'].'" '.$sel.'>'.$row['bank_name'].' ('.$row['country_name'].')</option>';
							}
							?>
						</select>
					</div>
				</div>

				<div class="input-form mt-5">
					<label class="col-md-3 control-label" for="branch">[[LABEL_BRANCH]] (*)</label>
					<div class="col-md-6">
						<input type="text" class="form-control" id="branch"  name="branch" value="<?php echo isset($_POST['branch']) ? $_POST['branch'] : (isset($bank['branch']) ? $bank['branch'] : "");?>" />
					</div>
				</div>

				<div class="input-form mt-5">
					<label class="col-md-3 control-label" for="phone">[[LABEL_BANK_PHONE]]</label>
					<div class="col-md-6">
						<input type="text"  class="form-control" name="phone" id="phone" value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : (isset($bank['phone']) ? $bank['phone'] : "");?>" />
					</div>
				</div>

				<div class="input-form mt-5">
					<label class="col-md-3 control-label" for="account_name">[[LABEL_BANK_ACCT_NAME]] (*)</label>
					<div class="col-md-6">
						<input type="text" required id="account_name" class="form-control" name="account_name" value="<?php echo isset($_POST['account_name']) ? $_POST['account_name'] : (isset($bank['account_name']) ? $bank['account_name'] : "");?>" />
					</div>
				</div>

				<div class="input-form mt-5">
					<label class="col-md-3 control-label" for="account_number">[[LABEL_BANK_ACCT_NO]] (*)</label>
					<div class="col-md-6">
						<input type="text" required class="form-control" id="account_number" name="account_number" value="<?php echo isset($_POST['account_number']) ? $_POST['account_number'] : (isset($bank['account_number']) ? $bank['account_number'] : "");?>" />
					</div>
				</div>

				<div class="input-form mt-5">
					<label class="col-md-3 control-label" for="bank_code">[[LABEL_BSB_NO]] </label>
					<div class="col-md-6">
						<input type="text" class="form-control" name="bank_code" id="bank_code" value="<?php echo isset($_POST['bank_code']) ? $_POST['bank_code'] : (isset($bank['bank_code']) ? $bank['bank_code'] : "");?>" />
					</div>
				</div>

				<div class="input-form mt-5">

					<div class="col-md-6 col-md-offset-3">
						[[MSG_CHECK_WITH_BANK]]
					</div>
				</div>
				<div class="input-form mt-5">
					<label class="col-md-3 control-label" for="swift_code">[[LABEL_SWIFT_CODE]] </label>
					<div class="col-md-6">
						<input type="text" class="form-control" id="swift_code" name="swift_code" value="<?php echo isset($_POST['swift_code']) ? $_POST['swift_code'] : (isset($bank['swift_code']) ? $bank['swift_code'] : "");?>" />
					</div>
				</div>

				<div class="input-form mt-5">
					<label class="col-md-3 control-label" for="address">[[LABEL_BANK_ADDRESS]] (*)</label>
					<div class="col-md-6">
						<input type="text" class="form-control" id="address" name="address" value="<?php echo isset($_POST['address']) ? $_POST['address'] : (isset($bank['address']) ? $bank['address'] : "");?>" />
					</div>
				</div>

				<div class="input-form mt-5">
					<label class="col-md-3 control-label" for="city">[[LABEL_BANK_ADDRESS_CITY]] (*)</label>
					<div class="col-md-6">
						<input type="text" class="form-control" id="city" name="city" value="<?php echo isset($_POST['city']) ? $_POST['city'] : (isset($bank['city']) ? $bank['city'] : "");?>" />
					</div>
				</div>

				<div class="input-form mt-5">
					<label class="col-md-3 control-label" for="state">[[LABEL_BANK_ADDRESS_STATE]] (*)</label>
					<div class="col-md-6">
						<input type="text" class="form-control" id="state" name="state" value="<?php echo isset($_POST['state']) ? $_POST['state'] : (isset($bank['state']) ? $bank['state'] : "");?>" />
					</div>
				</div>

				<div class="input-form mt-5">
					<label class="col-md-3 control-label" for="zip">[[LABEL_BANK_ADDRESS_ZIP]]</label>
					<div class="col-md-6">
						<input type="text" class="form-control" id="zip"  name="zip" value="<?php echo isset($_POST['zip']) ? $_POST['zip'] : (isset($bank['zip']) ? $bank['zip'] : "");?>" />
					</div>
				</div>
				<div class="input-form mt-5">
					<label class="col-md-3 control-label" for="zip">[[LABEL_STATUS]]</label>
					<div class="col-md-6">
						<?php
						$arrStatus = array("1"=>"[[DEF_STATUS_ACTIVE]]", "0"=>"[[DEF_STATUS_INACTIVE]]");
						$sel = "";

						if(isset($_POST['is_active'])){
							$bank_is_active = $_POST['is_active'];
						}elseif(!isset($_POST['is_active']) && isset($bank['is_active'])){
							$bank_is_active =  $bank['is_active'];
						}
						?>
						<select class="form-control" name="is_active">
							<?php
							foreach($arrStatus as $key=>$val){
								$sel = "";
								if(isset($bank_is_active) && $bank_is_active == $key){
									$sel ="selected=selected";
								}
								?>
								<option value="<?php echo $key; ?>" <?php echo $sel; ?>><?php echo $val; ?></option>
								<?php
							}
							?>
						</select>
					</div>
				</div>

				<div class=" mt-5">
					<button type="submit" class="btn btn-primary mt-5">[[SUBMIT]]</button>
				</div>
			</form>
		</div>
	</div>
</div>

