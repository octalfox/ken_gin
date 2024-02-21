<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
	<h2 class="text-lg font-medium mr-auto">
		[[LABEL_NEWS_UPDATE]]
	</h2>
	<div class="w-full sm:w-auto flex mt-4 sm:mt-0">
		<a href="<?php echo base_url("announcements"); ?>"
		   class="btn btn-primary shadow-md mr-2">[[LABEL_NEWS_LIST]]</a>
	</div>
</div>
<div class="intro-y box">
	<div class="p-10 overflow-auto">

		<?php $this->load->view("includes/alert"); ?>
		<div class="preview">
			<form method="post">

				<div class="intro-y border-slate-200/60 rounded-md border-2 p-3">
					<div class="input-form mt-5">
						<label for="txtFirstName">[[TYPE]]</label>
						<select name="type" class="form-control">
							<?php
							$array = array("All", "Free_Members", "Distributors", "Public");
							foreach ($array as $key => $val) {
								echo '<option value="' . $val . '">[[LABEL_' . strtoupper($val) . ']]</option>';
							}
							?>
						</select>
					</div>
				</div>

				<div class="intro-y border-slate-200/60 rounded-md border-2 mt-5 p-3">
					<div class="input-form mt-5">
						<strong>[[ENGLISH_NEWS]]</strong>
					</div>
					<div class="input-form mt-5">
						<label for="txtFirstName">[[ENG_TITLE]]</label>
						<input required placeholder="[[ENG_TITLE]]" type="text" class="form-control" name="title">
					</div>

					<div class="input-form mt-5">
						<label for="txtLastName">[[ENG_CONTENT]]</label>
						<textarea type="text" class="form-control editor" name="contents"></textarea>
					</div>
				</div>

				<div class="intro-y border-slate-200/60 rounded-md border-2 mt-5 p-3">
					<div class="input-form mt-5">
						<strong>[[CHINESE_NEWS]]</strong>
					</div>
					<div class="input-form mt-5">
						<label for="txtFirstName">[[CN_TITLE]]</label>
						<input required placeholder="[[CN_TITLE]]" type="text" class="form-control" name="title_si_cn">
					</div>

					<div class="input-form mt-5">
						<label for="txtLastName">[[CN_CONTENT]]</label>
						<textarea type="text" class="form-control editor" name="contents_si_cn"></textarea>
					</div>
				</div>
				<div class=" mt-5">
					<button type="submit" class="btn btn-primary mt-5">[[SUBMIT]]</button>
				</div>
			</form>
		</div>
	</div>
</div>

