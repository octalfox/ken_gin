<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
	<h2 class="text-lg font-medium mr-auto">
		[[LABEL_CURRENCIES_LIST]]
	</h2>
</div>
<div class="intro-y box mt-5">
	<?php $this->load->view("includes/alert"); ?>
	<div class="p-10 overflow-auto">
		<form method="post">
			<table id="currency_table" class="table" style="width: 100% !important;">
				<tr>
					<th>[[BASE_CURRENCY]]</th>
					<th>[[COUNTER_CURRENCY]]</th>
					<th>[[DEPOSITE_RATE]]</th>
					<th>[[WITHDRAW_RATE]]</th>
					<th>[[IS_ACTIVE]]</th>
				</tr>
				<?php foreach ($list as $key => $item) { ?>
					<tr style="width: 100%">
						<td><?php echo $item['base_currency']; ?></td>
						<td><?php echo $item['counter_currency']; ?></td>
						<td>
							<input type="text" class="form-control"
								   name="data[<?php echo $item['id'] ?>][deposit_currency_rate]"
								   value="<?php echo $item['deposit_currency_rate'] ?>">
						</td>
						<td>
							<input type="text" class="form-control"
								   name="data[<?php echo $item['id'] ?>][withdrawal_currency_rate]"
								   value="<?php echo $item['withdrawal_currency_rate'] ?>">
						</td>
						<td>
							<select class="form-control"
									name="data[<?php echo $item['id'] ?>][is_active]">
								<option <?php echo $item['is_active'] == "1" ? "selected" : ""; ?> value="1">
									Activate
								</option>
								<option <?php echo $item['is_active'] == "0" ? "selected" : ""; ?> value="0">
									Deactivate
								</option>
							</select>
						</td>
					</tr>
					<?php
				}
				?>
			</table>
			<table class="table" style="width: 100% !important;">
				<tbody>
				<tr>
					<td>
						<a id="append_new_row" class="btn btn-sm btn-primary shadow-md mr-2 w-full mt-4">
							[[ADD_ROW]]
						</a>
						<button type="submit" class="btn btn-sm btn-primary shadow-md mr-2 w-full mt-4">
							[[SAVE]]
						</button>
					</td>
				</tr>
				</tbody>
			</table>
		</form>
	</div>
</div>
