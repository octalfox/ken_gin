<?php $_SESSION['asset_file_name'] = "tags"; ?>
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
	<h2 class="text-lg font-medium mr-auto">
		[[LABEL_TAGS_LIST]]
	</h2>
</div>
<div class="intro-y box mt-5">
	<?php $this->load->view("includes/alert"); ?>
	<div class="p-10 overflow-auto">
		<table class="table" id="dataTable" style="width: 100% !important;">
			<thead>
			<tr>
				<th>#</th>
				<th>[[ENGLISH]]</th>
				<th>[[CHINESE]]</th>
				<th width="10">[[ACTION]]</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($list as $key => $item) { ?>
				<tr>
					<td><?php echo $key + 1; ?></td>
					<td class="en_<?php echo $item['id'] ?>"><?php echo $item['en'] ?></td>
					<td class="cn_<?php echo $item['id'] ?>"><?php echo $item['si_cn'] ?></td>
					<td>
						<div class="flex justify-center items-center">
							<button class="flex items-center mr-3" onclick="openTagForm(<?php echo $item['id'] ?>)">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
									 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
									 stroke-linejoin="round" icon-name="code" data-lucide="code"
									 class="lucide lucide-code block mx-auto">
									<polyline points="16 18 22 12 16 6"></polyline>
									<polyline points="8 6 2 12 8 18"></polyline>
								</svg>
							</button>
						</div>
					</td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<?php $this->load->view("modals/tags"); ?>
