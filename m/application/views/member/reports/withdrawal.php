<div id="appCapsule">
	<div class="section mt-2">
		<div class="card">
			<div class="card-body">
				<form name="frmEnrolledCourse" method="post">
					<div class="control-group form-horizontal fright" style="text-align: left;padding:10px 0;">
						<a class="btn btn-warning" href="<?php echo base_url("withdraw"); ?>">+ [[LABEL_WITHDRAW]]</a>
					</div>
				</form>
				<div class="jarviswidget-editbox"></div>
				<div class="widget-body">
					<div class="card">
						<div class="table-responsive">
							<table id="my_custom_dt" class="table table-striped">
								<thead>
								<tr>
									<th data-class="expand">#</th>
									<th data-class="expand">[[LABEL_DATE]]</th>
									<th data-hide="phone">[[LABEL_STATUS]]</th>
									<th data-hide="phone">[[LABEL_PAYMENT_MODE]]</th>
									<th data-hide="phone">[[LABEL_ACCOUNT_NUMBER]]</th>
									<th data-hide="phone">[[LABEL_AMOUNT]]</th>
									<th data-hide="phone">[[MBR_ADMIN_FEE]]</th>
									<th data-hide="phone">[[MBR_MEMBER_RCV]]</th>
								</tr>
								</thead>
								<tbody>
								<?php foreach ($reports as $key => $report) { ?>
									<tr>
										<td><?php echo $key + 1; ?></td>
										<td><?php echo formatDate($report['trans_date']); ?></td>
										<td><?php echo $report['status']; ?></td>
										<td><?php echo $report['cashbank_type']; ?></td>
										<td><?php echo $report['cashbank_name']; ?></td>
										<td><?php echo $report['debit']; ?></td>
										<td><?php echo $report['admin_fee']; ?></td>
										<td><?php echo $report['member_rcv']; ?></td>
									</tr>
									<?php
								}
								?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
