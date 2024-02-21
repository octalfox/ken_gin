<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
	<h2 class="text-lg font-medium mr-auto">
		[[LABEL_NEWS_LIST]]
	</h2>
	<div class="w-full sm:w-auto flex mt-4 sm:mt-0">
		<a href="<?php echo base_url("announcements/add"); ?>" class="btn btn-primary shadow-md mr-2">[[ADD_NEW_NEWS]]</a>
	</div>
</div>
<div class="intro-y box mt-5">
	<?php $this->load->view("includes/alert"); ?>
	<div class="p-10 overflow-auto">
		<table class="table" id="dataTable" style="width: 100% !important;">
			<thead>
			<tr>
				<th>#</th>
				<th>[[DATE]]</th>
				<th>[[TITLE]]</th>
				<th>[[TYPE]]</th>
				<th width="10">[[ACTION]]</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($list as $key => $item) { ?>
				<tr>
					<td><?php echo $key + 1; ?></td>
					<td><?php echo $item['date_created'] ?></td>
					<td><?php echo $item['title'] ?></td>
					<td><?php echo $item['type'] ?></td>
					<td>
						<div class="flex justify-center items-center">
							<?php $this->load->view("elems/edit_btn", array('link' => "announcements/edit/" . $item['id'])) ?>
							<?php $this->load->view("elems/delete_btn", array(
									'link' => "announcements/delete/" . $item['id'],
									'id' => $item['id']
							)); ?>
						</div>
					</td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>
