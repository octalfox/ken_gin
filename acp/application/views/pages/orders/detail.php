<?php
$m = $order['master'];
$d = $order['details'];
?>
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
	<h2 class="text-lg font-medium mr-auto">
		[[LABEL_ORDER_DETAILS]]
	</h2>
	<div class="w-full sm:w-auto flex mt-4 sm:mt-0">
		<a href="<?php echo base_url("orders"); ?>"
		   class="btn btn-primary shadow-md mr-2">[[LABEL_ORDER_LIST]]</a>
	</div>
</div>
<div class="intro-y box overflow-hidden mt-5">
	<div class="border-b border-slate-200/60 dark:border-darkmode-400 text-center sm:text-left">
		<div class="px-5 py-10 sm:px-20 sm:py-20">
			<div class="text-primary font-semibold text-3xl">[[ORDER_DETAIL]]</div>
			<div class="mt-2"> Receipt <span class="font-medium">#<?php echo $m['order_num']; ?></span></div>
			<div class="mt-1"><?php echo formatDate($m['order_date']); ?></div>
		</div>
		<div class="flex flex-col lg:flex-row px-5 sm:px-20 pb-10 sm:pb-20">
			<div>
				<div class="text-base text-slate-500">[[CLIENT_DETAILS]]</div>
				<div class="text-lg font-medium text-primary mt-2">
					<?php echo $m['userid'] . " - " . $m['f_name'] . " " . $m['l_name']; ?>
				</div>
				<div class="mt-1">[[EMAIL]]: <?php echo $m['email']; ?></div>
				<div class="mt-1">[[MOBILE]]: <?php echo $m['mobile']; ?></div>
			</div>
			<div class="lg:text-right mt-10 lg:mt-0 lg:ml-auto">
				<div class="text-base text-slate-500">[[PAYMENT_DETAIL]]</div>
				<div class="text-lg font-medium text-primary mt-2"><?php echo $m['payment_type'] ?></div>
			</div>
		</div>
	</div>
	<div class="px-5 sm:px-16 py-10 sm:py-20">
		<div class="overflow-x-auto">
			<table class="table">
				<thead>
				<tr>
					<th class="border-b-2 dark:border-darkmode-400 whitespace-nowrap">DESCRIPTION</th>
					<th class="border-b-2 dark:border-darkmode-400 text-right whitespace-nowrap">QTY</th>
					<th class="border-b-2 dark:border-darkmode-400 text-right whitespace-nowrap">PRICE</th>
					<th class="border-b-2 dark:border-darkmode-400 text-right whitespace-nowrap">SUBTOTAL</th>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($d as $detail) { ?>
					<tr>
						<td class="border-b dark:border-darkmode-400">
							<div class="font-medium whitespace-nowrap"><?php echo $detail['name'] ?></div>
							<div class="text-slate-500 text-sm mt-0.5"><?php echo $detail['description'] ?></div>
						</td>
						<td class="text-right border-b dark:border-darkmode-400 w-32"><?php echo $detail['qty'] ?></td>
						<td class="text-right border-b dark:border-darkmode-400 w-32">
							$<?php echo $detail['unit_price'] ?></td>
						<td class="text-right border-b dark:border-darkmode-400 w-32 font-medium">
							$<?php echo $detail['amount'] ?></td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="px-5 sm:px-20 pb-10 sm:pb-20 flex flex-col-reverse sm:flex-row">
		<div class="text-center sm:text-left mt-10 sm:mt-0">
			<div class="text-lg text-primary font-medium mt-2">[[PROCESSING_DETAILS]]</div>
			<div class="mt-1">
				<?php
				echo "[[ORDER_DATE]]: " . ($m['order_date'] == null? "N/A" : formatDate($m['order_date'])) . "<hr class='mt-1 mb-1'>";
				if ($m['status'] == 'CANCELLED') {
					echo "[[REJECTION_DATE]]: " . ($m['rejected_date'] == null? "N/A" : formatDate($m['rejected_date'])) . "";
				} else {
					echo "[[APPROVAL_DATE]]: " . ($m['approved_date'] == null? "N/A" : formatDate($m['approved_date'])) . "<hr class='mt-1 mb-1'>";
					echo "[[DELIVERY_DATE]]: " . ($m['received_date'] == null? "N/A" : formatDate($m['received_date']));
				}
				?>
			</div>
			<div class="mt-5">
				<?php
				if ($m['status'] == 'PENDING') {
					echo "<a class='rounded-md p-1 text-white bg-primary' href='" . base_url('orders/approve/' . $m['id']) . "'>[[APPROVE]]</a>";
					echo "<a class='rounded-md p-1 text-white bg-danger mt-5' href='" . base_url('orders/reject/' . $m['id']) . "'>[[REJECT]]</a>";
				}
				if ($m['status'] == 'CANCELLED') {
					echo "REJECTED";
				}
				if ($m['status'] == 'PAID') {
					echo "<a class='rounded-md p-1 text-white bg-primary' href='" . base_url('orders/deliver/' . $m['id']) . "'>[[DELIVER]]</a>";
				}
				if ($m['status'] == 'COMPLETED') {
					echo "COMPLETED";
				}
				?>
			</div>
		</div>
		<div class="text-center sm:text-right sm:ml-auto">
			<div class="text-base text-slate-500">[[TOTAL_AMOUNT]]</div>
			<div class="text-xl text-primary font-medium mt-2">$<?php echo $m['payment_amount'] ?></div>
			<div class="mt-1">[[TAXES_INCLUDED]]</div>
		</div>
	</div>
</div>
