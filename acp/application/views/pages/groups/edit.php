<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
	<h2 class="text-lg font-medium mr-auto">
		[[LABEL_GROUPS_UPDATE]]
	</h2>
	<div class="w-full sm:w-auto flex mt-4 sm:mt-0">
		<a href="<?php echo base_url("groups"); ?>" class="btn btn-primary shadow-md mr-2">[[LABEL_GROUPS_LIST]]</a>
	</div>
</div>
<div class="intro-y box mt-5">
	<div class="p-10 overflow-auto">

		<div class="p-5">
			<?php $this->load->view("includes/alert"); ?>
			<div class="preview">
				<form method="post">

					<div class="input-form mt-5">
						<label>[[LABEL_NAME]]</label>
						<div class="col-md-12">
							<input required placeholder="[[LABEL_NAME]]" type="text" class="form-control"
								   name="name" value="<?php echo $group['name']; ?>">
						</div>
					</div>

					<input type="hidden" name="id" value="<?php echo $group['id']; ?>">
					<button type="submit" class="btn btn-primary mt-5">[[SUBMIT]]</button>
				</form>
			</div>
		</div>
	</div>
</div>
