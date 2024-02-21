<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
	<h2 class="text-lg font-medium mr-auto">
		[[LABEL_STOCK_SUMMARY]]
	</h2>
</div>

<div class="intro-y box mt-5">
	<div class="p-10 overflow-auto">

		<div class="p-5">
			<?php $this->load->view("includes/alert"); ?>
			<div class="preview">
				<form method="post">

					<div>
						<table id="child__html" class="table table-sm mt-5">
							<tr>
								<th>[[LABEL_PRODUCT]]</th>
								<th>[[LABEL_SOLD]]</th>
								<th>[[TOTAL]]</th>
								<th>[[AVAILABLE]]</th>
							</tr>
							<?php foreach ($list as $detail) {
								$available = $detail['total'] - $detail['sold'];
								if($available >= 50){
									$class = "success";
								}
								if($available < 50){
									$class = "warning";
								}
								if($available <= 0){
									$class = "danger";
								}
								?>
								<tr>
									<td><?php echo $detail['name'] ?></td>
									<td><?php echo $detail['sold'] ?></td>
									<td><?php echo $detail['total'] ?></td>
									<td>
										<div style="width: 50%; min-width: 50px; padding: 2px !important;" class="btn btn-sm btn-<?php echo $class ?>">
											<?php echo $available ?>
										</div>
									</td>
								</tr>
							<?php } ?>
						</table>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>

