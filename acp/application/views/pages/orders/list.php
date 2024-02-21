<div class="flex flex-col sm:flex-row items-center border-b">
	<h2 class="font-medium text-base mr-auto">
		[[LABEL_ORDER_LIST]]
	</h2>
</div>
<div class="intro-y box mt-5">
	<div class="p-5 overflow-auto">
		<form method="get" class="search-form">
			<div class="intro-x mt-5">
				<input name="userid" value="<?php echo $userid ?>" type="text"
					   class="form-control"
					   placeholder="[[USERID]]">
			</div>
			<div class="intro-x mt-5">
				<select name="type" class="form-control">
					<option <?php echo $type == "All"? "selected" : ""; ?> value="All">All</option>
					<option <?php echo $type == "STRIPE"? "selected" : ""; ?> value="STRIPE">Stripe</option>
					<option <?php echo $type == "HITPAY"? "selected" : ""; ?> value="HITPAY">Hitpay</option>
					<option <?php echo $type == "E-WALLET"? "selected" : ""; ?> value="E-WALLET">E-Wallet</option>
					<option <?php echo $type == "COD"? "selected" : ""; ?> value="COD">COD</option>
					<option <?php echo $type == "CASH"? "selected" : ""; ?> value="CASH">CASH</option>
				</select>
			</div>
			<div class="mt-5">
				<button class="btn w-full btn-primary">[[SIGN_IN]]</button>
			</div>
		</form>
	</div>
	<div class="pt-5 px-10 overflow-auto">
		<a target="_blank" href="<?php  echo api_url("admin/export/order$query"); ?>" class="btn btn-primary float-right">
			[[EXPORT_REPORT_COUNT]]: <?php echo $counter; ?>
		</a>
	</div>
	<div class="p-5 overflow-auto">
		<table class="table w-full">
			<thead>
			<tr>
				<th>#</th>
				<!--				<th>[[STATUS]]</th>-->
				<th>[[ACTION]]</th>
				<th>[[ACTION_DATES]]</th>
				<th>[[ORDER_BY]]</th>
				<th>[[ORDER_NUMBER]]</th>
				<th>[[TYPE]]</th>
				<th>[[AMOUNT]]</th>
				<th>[[PAYMENT]]</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($list as $key => $order) { ?>
				<tr>
					<td><?php echo ($key + 1) + (($page-1) * $per_page) ; ?></td>
					<!--					<td>--><?php //echo $order['status']; ?><!--</td>-->
					<td class="text-center" style="line-height: 28px">
						<?php
						if ($order['status'] == 'PENDING') {
							echo "<a class='rounded-md p-1 text-white bg-primary' href='" . base_url('orders/approve/' . $order['id']) . "'>[[APPROVE]]</a>";
							echo "<br><a class='rounded-md p-1 text-white bg-danger mt-5' href='" . base_url('orders/reject/' . $order['id']) . "'>[[REJECT]]</a>";
						}
						if ($order['status'] == 'CANCELLED') {
							echo "REJECTED";
						}
						if ($order['status'] == 'PAID') {
							echo "<a class='rounded-md p-1 text-white bg-primary' href='" . base_url('orders/deliver/' . $order['id']) . "'>[[DELIVER]]</a>";
						}
						if ($order['status'] == 'COMPLETED') {
							echo "COMPLETED";
						}
						?>
					</td>
					<td>
						<?php
						echo "[[ORDER_DATE]]:<br> " . ($order['order_date'] == null ? "N/A" : formatDate($order['order_date'])) . "<hr class='mt-1 mb-1'>";
						if ($order['status'] == 'CANCELLED') {
							echo "[[REJECTION_DATE]]: <br>" . ($order['rejected_date'] == null ? "N/A" : formatDate($order['rejected_date'])) . "<br>";
						} else {
							echo "[[APPROVAL_DATE]]:<br> " . ($order['approved_date'] == null ? "N/A" : formatDate($order['approved_date'])) . "<hr class='mt-1 mb-1'>";
							echo "[[DELIVERY_DATE]]:<br> " . ($order['received_date'] == null ? "N/A" : formatDate($order['received_date'])) . "<br>";
						}
						?>
					</td>
					<td>
						<span onclick="getUserDetails(<?php echo $order['userid'] ?>)"
							  class="clickable text-xs px-1 rounded-md bg-primary text-white mr-1">
							<?php echo $order['userid']; ?>
						</span>
						<br>
						<small>(<?php echo $order['f_name']; ?> <?php echo $order['l_name']; ?>)</small>
					</td>
					<td><a class="underline"
						   href="<?php echo base_url("orders/details/" . $order['id']); ?>"><?php echo $order['order_num']; ?></a>
					</td>
					<td><?php echo $order['order_type']; ?></td>
					<td><?php echo $order['total_amount']; ?></td>
					<td><?php echo $order['payment_type']; ?></td>
				</tr>
			<?php } ?>
			</tbody>
		</table>

		<?php
		$this->load->view("partials/pagination", array(
				"link" => "orders",
				"per_page" => $per_page,
				"page" => $page,
				"counter" => $counter,
				"query" => $query
		));
		?>
	</div>
</div>
