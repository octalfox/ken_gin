<div class="intro-y box mt-5">
	<div class="flex flex-col sm:flex-row items-center p-5 border-b">
		<h2 class="font-medium text-base mr-auto">
			[[LABEL_TOPUPS_LIST]]
		</h2>
	</div>
	<div class="p-10">
		<table class="table" id="dataTable" style="width: 100% !important;">
			<thead>
			<tr>
				<th>#</th>
				<th>[[STATUS]]</th>
				<th>[[USER]]</th>
				<th>[[DEPOSIT]]</th>
				<th>[[TRANSFER]]</th>
				<th>[[PAYMENT]]</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($topups as $key => $topup) { ?>
				<tr>
					<td><?php echo $key + 1; ?></td>
					<td class="text-center" style="line-height: 28px">
						<?php if ($topup['status'] == "OPEN") {
							echo "<a class='rounded-md p-1 text-white bg-primary' href='" . base_url('topup/approve/' . $topup['id']) . "'>[[APPROVE]]</a>";
							echo "<br><a class='rounded-md p-1 text-white bg-danger mt-5' href='" . base_url('topup/reject/' . $topup['id']) . "'>[[REJECT]]</a>";
						} else {
							echo $topup['status'];
						}
						?>
					</td>
					<td>
						<span onclick="getUserDetails(<?php echo $topup['userid'] ?>)"
							  class="clickable text-xs px-1 rounded-md bg-primary text-white mr-1">
							<?php echo $topup['userid']; ?>
						</span>
						<br>
						<small>(<?php echo $topup['f_name']; ?> <?php echo $topup['l_name']; ?>)</small>
					</td>
					<td><?php echo $topup['deposit_amount']; ?></td>
					<td><?php echo $topup['transfer_amount']; ?></td>
					<td>
						<img alt="" src="<?php echo API_URL . "assets/payment_slip/" . $topup['payment_slip']; ?>"
							 data-action="zoom"
							 class="w-24 rounded-md">
					</td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>
