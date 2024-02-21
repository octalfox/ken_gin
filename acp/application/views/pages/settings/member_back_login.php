<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
	<h2 class="text-lg font-medium mr-auto">
		[[MEMBER_BACK_LOGIN]]
	</h2>
</div>
<div class="intro-y box mt-5">
	<?php $this->load->view("includes/alert"); ?>
	<div class="p-10 overflow-auto">
		<form method="post">
			<table class="table" style="width: 100% !important;">
				<thead>
				<tr>
					<th>[[CONSTANT]]</th>
					<th>[[LIVE_KEY]]</th>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($list as $key => $item) {
					if ($item['elem_type'] == 'input') {
						?>
						<tr>
							<td><?php echo $item['item']; ?></td>
							<td>
								<input type="text" class="form-control" name="data[<?php echo $item['id'] ?>][value]"
									   value="<?php echo $item['value'] ?>">
							</td>
							<td class="d-none">
								<input type="text" class="form-control" name="data[<?php echo $item['id'] ?>][dummy]"
									   value="<?php echo $item['dummy'] ?>">
							</td>
						</tr>
						<?php
					}
					if ($item['elem_type'] == 'select') {
						?>
						<tr>
							<td><?php echo $item['item']; ?></td>
							<td>
								<select class="form-control" name="data[<?php echo $item['id'] ?>][value]">
									<option <?php echo $item['value'] == 1? 'selected="selected"' : 0 ?> value="1">
										[[ENABLE]]
									</option>
									<option <?php echo $item['value'] == 0? 'selected="selected"' : 0 ?> value="0">
										[[DISABLE]]
									</option>
								</select>
							</td>
							<td class="d-none">
								<input type="text" class="form-control" name="data[<?php echo $item['id'] ?>][dummy]"
									   value="<?php echo $item['dummy'] ?>">
							</td>
						</tr>
						<?php
					}
				}
				?>
				<tr>
					<td colspan="3">
						<button type="submit" class="btn btn-primary shadow-md mr-2 w-full mt-4">
							[[SAVE]]
						</button>
					</td>
				</tr>
				</tbody>
			</table>
		</form>
	</div>
</div>
