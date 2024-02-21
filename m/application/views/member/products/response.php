<div id="appCapsule">
	<div class="section mt-2">
		<div class="card">
			<div class="card-body">
				<?php if ($return['response'] == 'error') { ?>
					<div class="row">
						<div class="col-md-12">
							<div class="alert alert-danger">
								<?php echo $return['message'] ?>
							</div>
						</div>
					</div>
					<div class="row pt-3">
						<div class="col-md-12">
							<?php foreach ($return['data'] as $error) {
								?>
								<div class="row"><strong>&emsp;<?php echo $error; ?></strong></div>
								<?php
							} ?>
						</div>
					</div>
				<?php } ?>
				<?php if ($return['response'] == 'success') { ?>
					<div class="row">
						<div class="col-md-12">
							<div class="alert alert-success">
								<?php echo $return['message']; ?>
							</div>
						</div>
					</div>
					<div class="row pt-3">
						<div class="col-md-12">
							<div class="card">
								<div class="table-responsive">
									<table class="table table-striped">
										<tr>
											<th>[[LABEL_ORDER_NUMBER]]</th>
											<td><?php echo $return['data']['order_num']; ?></td>
										</tr>
										<tr>
											<th>[[LABEL_ORDER_AMOUNT]]</th>
											<td><?php echo $return['data']['amount']; ?></td>
										</tr>
										<tr>
											<th>[[LABEL_ORDER_TOTAL_BV]]</th>
											<td><?php echo $return['data']['total_bv']; ?></td>
										</tr>
										<tr>
											<th>[[LABEL_ORDER_STATUS]]</th>
											<td><?php echo $return['data']['status']; ?></td>
										</tr>
										<tr>
											<th>[[LABEL_ORDER_PAYMENT_MODE]]</th>
											<td><?php echo $return['data']['payment_mode']; ?></td>
										</tr>
										<tr>
											<th>[[LABEL_ORDER_PLACEMENT_TIME]]</th>
											<td><?php echo $return['data']['trans_time']; ?></td>
										</tr>
									</table>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
