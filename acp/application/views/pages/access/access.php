<?php $_SESSION['asset_file_name'] = "access";
$access_list = explode(",",$group['access_list']);
?>
<form method="post">
	<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
		<h2 class="text-lg font-medium mr-auto">
			[[LABEL_ACCESS_LIST_FOR_GROUP]] <?php echo $group['name'] ?>
		</h2>
		<div class="w-full sm:w-auto flex mt-4 sm:mt-0">
			<input class="btn btn-primary shadow-md mr-2" type="submit" value="[[LABEL_SAVE]]">
		</div>
	</div>
	<div class="intro-y box mt-5">
		<?php $this->load->view("includes/alert"); ?>
		<div class="p-10 overflow-auto">
			<table class="table" style="width: 100% !important;">
				<thead>
				<tr>
					<th>#</th>
					<th>[[MODULE]]</th>
					<th>[[ITEM]]</th>
					<th>[[LINK]]</th>
					<th width="10">
						<input type="checkbox" id="chk_box">
					</th>
				</tr>
				</thead>
				<tbody>
				<?php
				$n = 1;
				foreach ($list as $key => $item) {
					foreach ($item['children'] as $k => $child) {
						if ($item['parent']['name'] == "ADM_NAVI_ADMIN") {
							continue;
						}
						?>
						<tr>
							<td><?php echo $n++; ?></td>
							<td>[[<?php echo $item['parent']['name'] ?>]]</td>
							<td>[[<?php echo $child['name'] ?>]]</td>
							<td><?php echo $child['page_link'] ?></td>
							<td class="text-left">
								<input type="checkbox" <?php echo in_array($child['id'], $access_list)? "checked" : "" ?> class="checkbox" name="tag_<?php echo $child['id'] ?>"
									   value="<?php echo $child['id'] ?>">
							</td>
						</tr>
						<?php
					}
				}
				?>
				</tbody>
			</table>
		</div>
	</div>
</form>
