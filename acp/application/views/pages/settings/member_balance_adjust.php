<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
	<h2 class="text-lg font-medium mr-auto">
		[[ADM_MEMBER_BALANCE_ADJUST]]
	</h2>
</div>
<div class="intro-y box mt-5">
	<?php $this->load->view("includes/alert"); ?>
	<div class="p-10 overflow-auto">
		<form method="post" autocomplete="off">
			<table class="table" style="width: 100% !important;">
				<tbody>
				<tr>
					<td colspan="3">
						<input name="userid" value="<?php echo $userid ?>" type="text" class="intro-x login__input form-control py-3 px-4 block" placeholder="[[USERID]]">
					</td>
				</tr>
				<tr>
					<td colspan="3">
						<button type="submit" class="btn btn-primary shadow-md mr-2 w-full mt-4">
							[[ADJUST_BALANCE]]
						</button>
					</td>
				</tr>
				</tbody>
			</table>
		</form>
	</div>
</div>
