<div id="appCapsule">
	<div class="section mt-2">
		<div class="card">
			<div class="card-body">
				<?php if(isset($member['f_name'])){ ?>
				<form method="post" action="<?php echo base_url("transfer/process") ?>">
					<div class="form-group basic">
						<label class="col-md-12 control-label" for="txtUserID">[[LABEL_USERID]]</label>
						<div class="col-md-12 ">
								<input class="form-control" type="text" readonly name="txtUserID" value="<?php echo $post['txtUserID']; ?>" />
						</div>
					</div>
					<div class="form-group basic">
						<label class="col-md-12 control-label" for="txtUserID">[[LABEL_USERNAME]]</label>
						<div class="col-md-12 ">
							<input class="form-control" type="text" readonly value="<?php echo $member['f_name'] . " " . $member['l_name']; ?>" />
						</div>
					</div>
					<div class="form-group basic">
						<label class="col-md-12 control-label" for="txtUserID">[[RC]]</label>
						<div class="col-md-12 ">
								<input class="form-control" type="text" readonly name="RC_amount" value="<?php echo $post["RC_amount"]; ?>"/><br/>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-12">
							<input type="submit" name="btnConfrm" id="btnConfrm" value="[[DEF_CONFIRM]]" class="btn btn-warning btn-lg btn-block"/>
						</div>
					</div>
				</form>
				<?php } else {
					?>
					<div class="form-group basic">
						<div class="col-md-12 ">
							<div class="alert alert-danger">[[LABEL_INVALID_USER]]</div>
						</div>
					</div>
					<?php
				} ?>
			</div>
		</div>
	</div>
</div>
