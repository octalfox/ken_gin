<!-- App Capsule -->
<div id="appCapsule">
	<div class="section mt-2">
		<div class="card">
			<div class="card-body">
				<form name="frmAdminGroup" method="post" class="form-horizontal">
					<div class="form-group basic">
						<div class="input-wrapper">
							<label class="label" for="userid">[[COM_MATRIX]]</label>
							<input type="text" class="form-control" name="userid" id="userid"
								   value="<?php echo $member['userid']; ?>"/>
						</div>
					</div>
					<div class="form-group basic">
						<div class="input-wrapper">
							<select id="referral_side" name="side" class="form-control custom-select">
								<option value="A" <?php echo $member['side'] == "A" ? ' selected="selected"' : ''; ?>>
									[[COM_AUTO_SIDE]]
								</option>
								<option value="L" <?php echo $member['side'] == "L" ? ' selected="selected"' : ''; ?>>
									[[LABEL_LEFT]]
								</option>
								<option value="R" <?php echo $member['side'] == "R" ? ' selected="selected"' : ''; ?>>
									[[LABEL_RIGHT]]
								</option>
							</select>
						</div>
					</div>

					<div class="form-group basic">
						<div class="input-wrapper">
							<button type="submit" class="btn btn-warning btn-lg btn-block">
								[[DEF_UPDATE]]
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
