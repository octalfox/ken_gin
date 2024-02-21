<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
	<h2 class="text-lg font-medium mr-auto">
		[[LABEL_POS_LIST]]
	</h2>
	<div class="w-full sm:w-auto flex mt-4 sm:mt-0">
		<a href="<?php echo base_url("inventory/add"); ?>" class="btn btn-primary shadow-md mr-2">[[ADD_NEW_POS]]</a>
	</div>
</div>
<div class="intro-y box mt-5">
	<?php $this->load->view("includes/alert"); ?>
	<div class="p-10 overflow-auto">
		<table class="table" id="dataTable" style="width: 100% !important;">
			<thead>
			<tr>
				<th>#</th>
				<th>[[LABEL_PO_NUM]]</th>
				<th>[[LABEL_PURCHASE_DATE]]</th>
				<th>[[LABEL_DESCRIPTION]]</th>
				<th>[[LABEL_VENDOR]]</th>
				<th>[[LABEL_PAYMENT_MODE]]</th>
				<th>[[REFERENCE]]</th>
				<th width="10">[[ACTION]]</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($list['POs'] as $key => $item) {
				?>
				<tr>
					<td><?php echo $key + 1; ?></td>
					<td><?php echo $item['po_number'] ?></td>
					<td><?php echo $item['purchase_date'] ?></td>
					<td><?php echo $item['description'] ?></td>
					<td><?php echo $item['vendor'] ?></td>
					<td><?php echo ucfirst($item['payment_mode']); ?></td>
					<td><?php echo $item['payment_reference'] ?></td>
					<td>
						<div class="flex justify-center items-center">
							<?php $this->load->view("elems/detail_btn", array('link' => "inventory/view/" . $item['id'])) ?>
						</div>
					</td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>
