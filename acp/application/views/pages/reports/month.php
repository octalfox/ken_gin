<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
	<h2 class="text-lg font-medium mr-auto">
		[[LABEL_DAILY_REPORT]]
	</h2>
</div>
<div class="intro-y box mt-5">
	<div class="section mt-2">
		<div class="card">
			<div class="intro-y box mt-5">
				<table class="table">
					<thead>
					<tr>
						<th>[[DATE]]</th>
						<th>[[TOTAL_SALES]]</th>
						<th>[[TOTAL_COMMISSION]]</th>
						<th>[[SPONSOR_BONUS]]</th>
						<th>[[BINARY_BONUS]]</th>
						<th>[[MATCHING_BONUS]]</th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($reports as $the_date => $row) { ?>
						<tr>
							<td>
								<?php echo formatDate($the_date, false); ?>
							</td>
							<td>
								<a class="underline" href="<?php echo base_url("sales/get/" . $the_date); ?>">
									<?php echo number_format($row['SALES'], 2); ?>
								</a>
							</td>
							<td>
								<a class="underline" href="<?php echo base_url("commissions/get/all/" . $the_date); ?>">
									<?php echo number_format($row['SPONSOR'] + $row['BINARY'] + $row['MATCHING'], 2); ?>
								</a>
							</td>
							<td>
								<a class="underline" href="<?php echo base_url("commissions/get/sponsor/" . $the_date); ?>">
									<?php echo number_format($row['SPONSOR'], 2); ?>
								</a>
							</td>
							<td>
								<a class="underline" href="<?php echo base_url("commissions/get/binary/" . $the_date); ?>">
									<?php echo number_format($row['BINARY'], 2); ?>
								</a>
							</td>
							<td>
								<a class="underline" href="<?php echo base_url("commissions/get/matching/" . $the_date); ?>">
									<?php echo number_format($row['MATCHING'], 2); ?>
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
