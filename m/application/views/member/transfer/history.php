<div id="appCapsule">
	<div class="section mt-2">
		<div class="card">
			<div class="card-body">
				<div class="card">
					<div class="table-responsive">
						<table id="my_custom_dt" class="table table-striped">
							<thead>
							<tr>
								<th>[[LABEL_TRANS_NO]]</th>
								<th data-hide="phone">[[CURRENCY]]</th>
								<th data-hide="phone">[[DEF_LEDGER_DATE]]</th>
								<th data-class="expand">[[DEF_DESCRIPTION]]</th>
								<th data-hide="phone">[[LABEL_CREDIT]]</th>
								<th data-hide="phone">[[LABEL_DEBIT]]</th>
							</tr>
							</thead>
							<tbody>
							<?php foreach ($results as $transfer){
								?>
									<tr>
										<td><?php echo $transfer['trans_id']; ?></td>
										<td><?php echo formatDate($transfer['currency']); ?></td>
										<td><?php echo formatDate($transfer['insert_time']); ?></td>
										<td><?php echo $transfer['description']; ?></td>
										<td><?php echo $transfer['credit']; ?></td>
										<td><?php echo $transfer['debit']; ?></td>
									</tr>
								<?php
							} ?>
							</tbody>
						</table>
					</div>
					<div id="sg_footer">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
