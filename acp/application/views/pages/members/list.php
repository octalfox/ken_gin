<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
	<h2 class="text-lg font-medium mr-auto">
		[[LABEL_MEMBERS_LIST]]
	</h2>
	<div class="w-full sm:w-auto flex mt-4 sm:mt-0">
		<a href="<?php echo base_url("members/add"); ?>" class="btn btn-primary shadow-md mr-2">[[ADD_NEW_MEMBER]]</a>
	</div>
</div>
<div class="intro-y box mt-5">
	<div class="p-5 overflow-auto">
		<form class="search-form" method="get">
			<div class="intro-x mt-8">
				<input name="userid" value="<?php echo $userid ?>" type="text" class="intro-x login__input form-control py-3 px-4 block"
					   placeholder="[[USERID]]">
			</div>
			<div class="mt-5">
				<button class="btn w-full btn-primary">[[LABEL_SEARCH]]</button>
			</div>
		</form>
	</div>
	<div class="p-5 px-10 overflow-auto">
		<a target="_blank" href="<?php  echo api_url("admin/export/member$query"); ?>" class="btn btn-primary float-right">
			[[EXPORT_REPORT_COUNT]]: <?php echo $counter; ?>
		</a>
	</div>
	<div class="px-10 overflow-auto">
		<table class="table w-full">
			<thead>
			<tr>
				<th>#</th>
				<th>[[WHATSAPP]]</th>
				<th>[[USERID]]</th>
				<th>[[TYPE]]</th>
				<th>[[LABEL_NAME]]</th>
				<th>[[RANK]]</th>
				<th>[[MATRIX]]</th>
				<th>[[SPONSOR]]</th>
				<th>[[PACKAGE]]</th>
				<th width="10">[[ACTION]]</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($list as $key => $item) { ?>
				<tr class="row_<?php echo $item['userid']; ?>">
					<td><?php echo ($key + 1) + (($page-1) * $per_page) ; ?></td>
					<td>
						<?php
						if ($item['mobile'] == "") {
							echo "N/A";
						} else {
							?>
							<a class="clickable text-xs px-1 rounded-md bg-cyan-900 text-white mr-1"
							   target="_blank" href="<?php echo "https://wa.me/65" . $item['mobile']; ?>">
								<?php echo $item['mobile']; ?>
							</a>
							<?php
						}
						?>
					</td>
					<td onclick="getUserDetails(<?php echo $item['userid'] ?>)">
						<span class="clickable text-xs px-1 rounded-md bg-primary/80 text-white mr-1"><?php echo $item['userid'] ?></span>
					</td>
					<td><?php echo $item['special_account'] == 1 ? "Free" : "Normal" ?></td>
					<td><?php echo $item['f_name'] ?><?php echo $item['l_name'] ?></td>
					<td><?php echo $item['rank_name'] ?></td>
					<?php if (!empty($item['matrix_name'])) { ?>
						<td onclick="getUserDetails(<?php echo $item['matrix_name'] ?>)">
							<span class="clickable text-xs px-1 rounded-md bg-primary/80 text-white mr-1"><?php echo $item['matrix_name'] ?></span>
						</td>
					<?php } else {
						?>
						<td>N/A</td>
						<?php
					} ?>
					<?php if (!empty($item['sponsor_name'])) { ?>
						<td onclick="getUserDetails(<?php echo $item['sponsor_name'] ?>)">
							<span class="clickable text-xs px-1 rounded-md bg-primary/80 text-white mr-1"><?php echo $item['sponsor_name'] ?></span>
						</td>
					<?php } else {
						?>
						<td>N/A</td>
						<?php
					} ?>
					<td><?php echo $item['package_name'] ?></td>
					<td>
						<div class="flex justify-center items-center">
							<?php $this->load->view("elems/edit_btn", array('link' => "members/edit/" . $item['userid'])) ?>
							<?php $this->load->view("elems/credits_btn", array('link' => "members/credit/" . $item['userid'])) ?>
						</div>
					</td>
				</tr>
			<?php } ?>
			</tbody>
		</table>

		<?php
		$this->load->view("partials/pagination", array(
				"link" => "members",
				"per_page" => $per_page,
				"page" => $page,
				"counter" => $counter,
				"query" => "?userid=$userid&"
		));
		?>

	</div>

</div>
