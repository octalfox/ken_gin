<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
	<h2 class="text-lg font-medium mr-auto">
		[[LABEL_GROUPS_LIST]]
	</h2>
	<div class="w-full sm:w-auto flex mt-4 sm:mt-0">
		<a href="<?php echo base_url("groups/add"); ?>" class="btn btn-primary shadow-md mr-2">[[ADD_NEW_GROUP]]</a>
	</div>
</div>
<div class="intro-y box mt-5">
	<?php $this->load->view("includes/alert"); ?>
	<div class="p-10 overflow-auto">
		<table class="table" id="dataTable" style="width: 100% !important;">
			<thead>
			<tr>
				<th>#</th>
				<th>[[LABEL_NAME]]</th>
				<th width="10">[[ACTION]]</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($list as $key => $item) {
				if(strtolower($item['name']) == 'root'){
					continue;
				}
				?>
				<tr>
					<td><?php echo $key + 1; ?></td>
					<td><?php echo $item['name'] ?></td>
					<td>
						<div class="flex justify-center items-center">
							<?php $this->load->view("elems/goto_btn", array('link' => "access/change/" . $item['id'])) ?>
						</div>
					</td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>
