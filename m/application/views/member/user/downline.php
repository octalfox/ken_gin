<div id="appCapsule">
	<div class="section mt-2">
		<div class="card">
			<div class="card-body">
				<form method="post" class="form-horizontal">

					<div class="form-group basic">
						<div class="input-wrapper">
							<div class="alert alert-success">[[LABEL_USER_PLACEMENT_AS_PER_BINARY_SETTING]]</div>
						</div>
					</div>

						<div class="form-group basic">
						<div class="input-wrapper">
							<label class=" control-label" for="txtGroupName">[[DEF_SELECT_PLACEMENT]]</label>
							<select name="matrixid" id="matrixid" class="form-control select2">
								<option value="<?php echo $_SESSION['logged']['userid']; ?>">
									<?php echo $_SESSION['logged']['userid']; ?> -
									<?php echo $_SESSION['logged']['f_name']; ?>
									<?php echo $_SESSION['logged']['l_name']; ?>
								</option>
								<?php foreach ($members as $member) { ?>
									<option value="<?php echo $member['userid']; ?>">
										<?php echo $member['userid']; ?> -
										<?php echo $member['f_name']; ?>
										<?php echo $member['l_name']; ?>
									</option>
								<?php } ?>
							</select>
						</div>
					</div>

					<div class="form-group basic">
						<div class="input-wrapper">
							<label class=" control-label" for="txtGroupName">[[DEF_SELECT_SIDE]]</label>
							<select name="side" id="side" class="form-control">
								<option value="L">[[LABEL_LEFT]]</option>
								<option value="R">[[LABEL_RIGHT]]</option>
								<option value="A">[[LABEL_AUTO]]</option>
							</select>
						</div>
					</div>

					<div class="form-group basic">
						<div class="input-wrapper">
							<input type="submit" name="btnSubmit" value="[[DEF_SUBMTI]]"
								   class="btn btn-warning btn-block btn-lg mt-2 mb-2"/>
						</div>
					</div>
				</form>

			</div>
		</div>
	</div>
</div>
