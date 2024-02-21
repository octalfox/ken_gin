<?php
$member_detail = $member['member_detail'];
?>

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
						<label class=" d-none col-md-12 control-label"
							   for="txtFirstName">[[LABEL_FIRST_NAME]]</label>
						<div class="col-md-12">
							<input required placeholder="[[LABEL_FIRST_NAME]]" type="text" class="form-control"
								   name="f_name" id="txtFirstName"
								   value="<?php echo $member_detail['f_name']; ?>">
						</div>
					</div>


					<div class="input-form mt-5">
						<label class="d-none col-md-12 control-label"
							   for="txtLastName">[[LABEL_LAST_NAME]]</label>
						<div class="col-md-12">
							<input type="text" class="form-control" name="l_name" id="txtLastName"
								   placeholder="[[LABEL_LAST_NAME]]"
								   value="<?php echo $member_detail['l_name']; ?>">
						</div>
					</div>

					<div class="input-form mt-5">
						<label class="col-md-12 control-label d-none" for="txtEmail">[[LABEL_EMAIL]]</label>
						<div class="col-md-12">
							<input required placeholder="[[LABEL_EMAIL]]" type="email"
								   class="form-control" name="email" id="txtEmail"
								   value="<?php echo $member_detail['email']; ?>">
						</div>
					</div>

					<div class="input-form mt-5">
						<label class="d-none control-label col-md-12"
							   for="txtMobileNo">[[LABEL_MOBILE]]</label>
						<div class="col-md-12">
							<table width="100%">
								<tbody>
								<tr>
									<td style="width: 40px">
										<span class="input-group-addon my_cc"><?php echo $member_detail['country_code']; ?></span>
									</td>
									<td>
										<input required type="text" placeholder="[[LABEL_MOBILE]]"
											   class="form-control" name="mobile" id="txtMobileNo"
											   value="<?php echo $member_detail['mobile']; ?>">
									</td>
								</tr>
								</tbody>
							</table>
							<p style="color:red;">[[MBM_MOBILE_MSG]]</p>
						</div>
					</div>

					<button type="submit" class="btn btn-primary mt-5">[[SUBMIT]]</button>
				</form>
			</div>
		</div>
	</div>
</div>
