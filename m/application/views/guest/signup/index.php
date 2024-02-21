<div id="appCapsule" style="height: 100vh;">
	<div class="section mb-5 p-3">
		<div class="card">
			<div class="card-body pb-1">
				<div class="section text-center">
					<?php $this->load->view('partials/guest_logo'); ?>
				</div>

				<div class="card-title d-flex justify-content-around align-items-center">
					<div class="row">
						<h2 class="text-center m-0">[[LABEL_REGISTER]]</h2>
					</div>
					<div class="row">
						<?php $this->load->view('partials/language_changer'); ?>
					</div>
				</div>
			</div>

			<div class="card">
				<div class="card-body pb-1">
					<form name="frmRegister" method="post" class="form-horizontal">

						<div class="form-group basic">
							<div class="input-wrapper">
								<div class="alert alert-success">
									<strong><?php echo $available['userid'] ?></strong>
									[[LABEL_AVAILABLE_SLOT_UNDER]]
									<strong><?php echo $sponsor['userid'] ?></strong><br>
									[[LABEL_USER_PLACEMENT_WILLBE]] <?php
									if ($side == "L") echo "[[LEFT]]";
									if ($side == "R") echo "[[RIGHT]]";
									if ($side == "A") echo "[[AUTO]]";
									?>
								</div>
							</div>
						</div>

						<input type="hidden" id="downline_type" name="downline_type" value="0">
						<input type="hidden" id="user" name="user" value="<?php echo $sponsor['userid'] ?>">
						<input type="hidden" id="id" name="id" value="<?php echo $sponsor['id'] ?>">
						<input type="hidden" id="sponsor_user" name="sponsor_user"
							   value="<?php echo $sponsor['userid'] ?>">
						<input type="hidden" id="sponsor_id" name="sponsor_id" value="<?php echo $sponsor['id'] ?>">
						<input type="hidden" id="matrix_user" name="matrix_user"
							   value="<?php echo $available['userid'] ?>">
						<input type="hidden" id="matrix_id" name="matrix_id" value="<?php echo $available['id'] ?>">
						<input type="hidden" id="matrix_side" name="matrix_side" value="<?php echo $side ?>">
						<input type="hidden" id="myEmail" name="myEmail" value="<?php echo $sponsor['email']; ?>">
						<input type="hidden" id="myFirstName" name="myFirstName"
							   value="<?php echo $sponsor['f_name']; ?>">
						<input type="hidden" id="myLastName" name="myLastName"
							   value="<?php echo $sponsor['l_name']; ?>">
						<input type="hidden" id="myCountry" name="myCountry"
							   value="<?php echo $sponsor['country']; ?>">
						<input type="hidden" id="myMobile" name="myMobile"
							   value="<?php echo $sponsor['mobile']; ?>">

						<div class="main_account_area">
							<div class="form-group basic">
								<div class="input-wrapper">
									<label class="col-md-12 control-label d-none"
										   for="txtEmail">[[LABEL_EMAIL]]</label>
									<div class="col-md-12">
										<input required placeholder="[[LABEL_EMAIL]]" required type="email"
											   class="form-control" name="email" id="txtEmail" value="">
									</div>
								</div>
							</div>

							<div class="form-group basic">
								<div class="input-wrapper">
									<label class=" d-none col-md-12 control-label" for="txtFirstName">[[LABEL_FIRST_NAME]]</label>
									<div class="col-md-12">
										<input required placeholder="[[LABEL_FIRST_NAME]]" type="text"
											   class="form-control" name="f_name" id="txtFirstName" value="">
									</div>
								</div>
							</div>


							<div class="form-group basic">
								<div class="input-wrapper">
									<label class="d-none col-md-12 control-label"
										   for="txtLastName">[[LABEL_LAST_NAME]]</label>
									<div class="col-md-12">
										<input required type="text" class="form-control" name="l_name"
											   id="txtLastName" value="" placeholder="[[LABEL_LAST_NAME]]">
									</div>
								</div>
							</div>


							<div class="form-group basic">
								<div class="input-wrapper">
									<label class="col-md-12 control-label d-none"
										   for="selCountry">[[LABEL_COUNTRY]]</label>
									<div class="col-md-12">
										<select required name="country" id="selCountry" class="form-control"
												style="padding-left: 10px !important;">
											<?php foreach ($countries as $country) { ?>
												<option data-code="<?php echo $country['id']; ?>"
														<?php echo $country['id'] == 194 ? "selected" : ""; ?>
														value="<?php echo $country['id'] ?>">
													<?php echo $country['full_name'] ?>
												</option>
											<?php } ?>
										</select>
									</div>
								</div>
							</div>

							<div class="form-group basic">
								<div class="input-wrapper">
									<label class="d-none control-label col-md-12"
										   for="txtMobileNo">[[LABEL_MOBILE]]\</label>
									<div class="col-md-12">
										<table width="100%">
											<tbody>
											<tr>
												<td style="width: 40px"><span
															class="input-group-addon my_cc">65</span>
												</td>
												<td>
													<input required type="text" placeholder="[[LABEL_MOBILE]]"
														   class="form-control" name="mobile" id="txtMobileNo"
														   value="">
												</td>
											</tr>
											</tbody>
										</table>
										<p style="color:red;">[[MBM_MOBILE_MSG]]</p>
									</div>
								</div>
							</div>

						</div>
						<div class="form-group basic">
							<div class="input-wrapper">
								<div class="col-md-12">
									<input type="submit" class="btn btn-lg btn-warning btn-block" value="Submit">
								</div>
							</div>
						</div>
				</div>
			</div>
		</div>
	</div>
	<div class="form-links mt-2">
		<div><a href="<?php echo base_url("login") ?>" class="text-white">[[DEF_BACK_TO_LOGIN]]</a></div>
	</div>
</div>
