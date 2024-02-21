<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
	<h2 class="text-lg font-medium mr-auto">
		[[LABEL_ADMINS_UPDATE]]
	</h2>
	<div class="w-full sm:w-auto flex mt-4 sm:mt-0">
		<a href="<?php echo base_url("admins"); ?>" class="btn btn-primary shadow-md mr-2">[[LABEL_ADMINS_LIST]]</a>
	</div>
</div>
<div class="intro-y box mt-5">
	<div class="p-10 overflow-auto">

		<div class="p-5">
			<?php $this->load->view("includes/alert"); ?>
			<div class="preview">
				<form method="post">

					<div class="input-form mt-5">
						<label class="  col-md-12 control-label"
							   for="txtFirstName">[[LABEL_FIRST_NAME]]</label>
						<div class="col-md-12">
							<input required placeholder="[[LABEL_FIRST_NAME]]" type="text" class="form-control"
								   name="f_name" id="txtFirstName"
								   value="<?php echo $user['f_name']; ?>">
						</div>
					</div>


					<div class="input-form mt-5">
						<label class=" col-md-12 control-label"
							   for="txtLastName">[[LABEL_LAST_NAME]]</label>
						<div class="col-md-12">
							<input required type="text" class="form-control" name="l_name" id="txtLastName"
								   placeholder="[[LABEL_LAST_NAME]]"
								   value="<?php echo $user['l_name']; ?>">
						</div>
					</div>

					<div class="input-form mt-5">
						<label class="col-md-12 control-label " for="txtEmail">[[LABEL_EMAIL]]</label>
						<div class="col-md-12">
							<input required placeholder="[[LABEL_EMAIL]]" class="form-control" name="login" type="text"
								   value="<?php echo $user['login']; ?>">
						</div>
					</div>

					<div class="input-form mt-5">
						<label class="col-md-12 control-label " for="txtEmail">[[LABEL_PASSWORD]]</label>
						<div class="col-md-12">
							<input placeholder="[[LABEL_PASSWORD]]" type="password"
								   class="form-control" name="password" id="password">
						</div>
					</div>

					<div class="input-form mt-5">
						<label class=" control-label col-md-12"
							   for="txtMobileNo">[[LABEL_GROUP]]</label>
						<div class="col-md-12">
							<select class="form-control" name="group_id">
								<?php foreach ($list as $value) { ?>
									<option <?php echo $user['group_id'] == $value['id']? "selected" : ""; ?> value="<?php echo $value['id'] ?>"><?php echo $value['name'] ?></option>
								<?php } ?>
							</select>
							<input type="hidden" name="id" value="<?php echo $user['id']; ?>">
						</div>
					</div>

					<button type="submit" class="btn btn-primary mt-5">[[SUBMIT]]</button>
				</form>
			</div>
		</div>
	</div>
</div>
