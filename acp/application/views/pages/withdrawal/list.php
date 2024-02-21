<div class="intro-y box mt-5">
	<div class="flex flex-col sm:flex-row items-center p-5 border-b">
		<h2 class="font-medium text-base mr-auto">
			[[LABEL_WITHDRAWALS_LIST]]
		</h2>
	</div>
	<div class="p-10">
		<table class="table" id="dataTable" style="width: 100% !important;">
			<thead>
			<tr>
				<th>#</th>
				<th>[[ACTION]]</th>
				<th>[[STATUS]]</th>
				<th>[[USER]]</th>
				<th>[[AMOUNT]]</th>
				<th>[[TO_TRANSFER]]</th>
				<th>[[CASHBANK_TYPE]]</th>
				<th>[[CASHBANK_NAME]]</th>
				<th>[[DUE_DATE]]</th>
				<th>[[REQUEST_DATE]]</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($withdrawals as $key => $withdrawal) { ?>
				<tr>
					<td><?php echo $key + 1; ?></td>
					<td class="text-center" style="line-height: 28px">
						<?php if ($withdrawal['status'] == "PENDING" or $withdrawal['status'] == "HOLD") {
							if ($withdrawal['status'] == "PENDING") {
								echo "<a class='rounded-md p-1 text-white bg-primary' href='" . base_url('withdrawal/approve/' . $withdrawal['id']) . "'>[[APPROVE]]</a>";
								echo "<br><a class='rounded-md p-1 text-white bg-warning mt-5' href='" . base_url('withdrawal/hold/' . $withdrawal['id']) . "'>[[HOLD]</a>";
								echo "<br><a class='rounded-md p-1 text-white bg-danger mt-5' href='" . base_url('withdrawal/reject/' . $withdrawal['id']) . "'>[[REJECT]]</a>";
							}
							if ($withdrawal['status'] == "HOLD") {
								echo "<a class='rounded-md p-1 text-white bg-primary' href='" . base_url('withdrawal/approve/' . $withdrawal['id']) . "'>[[APPROVE]]</a>";
								echo "<br><a class='rounded-md p-1 text-white bg-danger mt-5' href='" . base_url('withdrawal/reject/' . $withdrawal['id']) . "'>[[REJECT]]</a>";
							}
						} else {
							echo "--";
						}
						?>
					</td>
					<td><?php echo $withdrawal['status']; ?></td>
					<td>
						<span onclick="getUserDetails(<?php echo $withdrawal['userid'] ?>)"
							  class="clickable text-xs px-1 rounded-md bg-primary text-white mr-1">
							<?php echo $withdrawal['userid']; ?>
						</span>
						<br>
						<small>(<?php echo $withdrawal['f_name']; ?> <?php echo $withdrawal['l_name']; ?>)</small>
					</td>
					<td><?php echo $withdrawal['debit']; ?></td>
					<td><?php echo $withdrawal['member_rcv']; ?></td>
					<td><?php echo $withdrawal['cashbank_type']; ?></td>
					<td><?php echo $withdrawal['cashbank_name']; ?></td>
					<td><?php echo $withdrawal['due_date']; ?></td>
					<td><?php echo $withdrawal['trans_date']; ?></td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>
