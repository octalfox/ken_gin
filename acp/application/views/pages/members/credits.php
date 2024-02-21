<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
	<h2 class="text-lg font-medium mr-auto">
		[[LABEL_MEMBERS_UPDATE]]
	</h2>
	<div class="w-full sm:w-auto flex mt-4 sm:mt-0">
		<a href="<?php echo base_url("members"); ?>" class="btn btn-primary shadow-md mr-2">[[LABEL_MEMBERS_LIST]]</a>
	</div>
</div>
<div class="intro-y box">
	<div class="p-10 overflow-auto">

		<div class="p-5">
			<?php $this->load->view("includes/alert"); ?>
			<div class="preview">
				<form id='creaditForm' method="post">

					<div class="input-form">
						<div class="col-md-12 control-label">[[AVAILABLE]] RCs: <strong><?php echo $reports['RCs']['balance']; ?></strong></div>
						<div class="col-md-12">
							<input placeholder="[[LABEL_ENTER_RC_CREDITS]]" type="text" class="form-control mt-2" name="rc_amount">
							<select class="form-control mt-2" name="rc_action">
								<option value="">Add/Deduct</option>
								<option value="+">Add Credits</option>
								<option value="-">Deduct Credits</option>
							</select>
							<input placeholder="[[LABEL_ENTER_RC_DESCRIPTION]]" type="text" class="form-control mt-2" name="rc_description">
						</div>
					</div>

					<div class="input-form mt-5">
						<br>
					</div>

					<div class="input-form mt-5">
						<div class="col-md-12 control-label">[[AVAILABLE]] CCs: <strong><?php echo $reports['CCs']['balance']; ?></strong></div>
						<div class="col-md-12">
							<input placeholder="[[LABEL_ENTER_CC_CREDITS]]" type="text" class="form-control mt-2" name="cc_amount">
							<select class="form-control mt-2" name="cc_action">
								<option value="">Add/Deduct</option>
								<option value="+">Add Credits</option>
								<option value="-">Deduct Credits</option>
							</select>
							<input placeholder="[[LABEL_ENTER_CC_DESCRIPTION]]" type="text" class="form-control mt-2" name="cc_description">
						</div>
					</div>

					<div class="input-form mt-5">
						<button type="submit" id="submitButton" class="btn btn-primary mt-5" onclick="disableSubmit()">[[SUBMIT]]</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
    function disableSubmit() {
        document.getElementById('submitButton').disabled = true;
		document.getElementById('creaditForm').submit();
    }
</script>