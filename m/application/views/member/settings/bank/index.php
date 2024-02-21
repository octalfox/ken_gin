<div id="appCapsule">
	<div class="section mt-2">
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-striped">
						<thead>
						<tr>
							<th scope="col">
								<strong>
									<a href="<?php echo base_url("settings/bank") ?>">+ Add Bank Info</a>
								</strong>
							</th>
							<th scope="col" class="text-end"></th>
						</tr>
						</thead>
						<tbody>
						<?php foreach ($banks as $bank) { ?>
							<tr>
								<td>
									<?php echo empty($bank['bank_name'])? $bank['b_name'] : $bank['bank_name']; ?><br>
									<?php echo $bank['account_name']; ?><br>
									<?php echo $bank['account_number']; ?>
								</td>
								<td style="text-align: center">
									<a href="<?php echo base_url("settings/bank/" . $bank['id']); ?>">
										<ion-icon class="icon_styling" name="create-outline"></ion-icon>
									</a>
								</td>
							</tr>
						<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

