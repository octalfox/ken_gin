<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
	<h2 class="text-lg font-medium mr-auto">
		[[LABEL_YEARLY_REPORT]]
	</h2>
</div>
<div class="intro-y box mt-5">
	<div class="section mt-2">
		<div class="card">
			<div class="intro-y box mt-5">
				<table class="table">
					<thead>
					<tr>
						<th>[[YEAR]]</th>
						<th>[[TOTAL_SALES]]</th>
						<th>[[TOTAL_COMMISSION]]</th>
						<th>[[SPONSOR_BONUS]]</th>
						<th>[[BINARY_BONUS]]</th>
						<th>[[MATCHING_BONUS]]</th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($reports as $the_year => $row) { ?>
						<tr>
							<td>
								<a href="<?php echo base_url("report/year/" . $the_year); ?>"
								   class="clickable text-md px-1 rounded-md bg-primary text-white mr-1">
									<?php echo $the_year; ?>
								</a>
							</td>
							<td>
								<a class="underline" href="<?php echo base_url("sales/get/" . $the_year); ?>">
									<?php echo number_format($row['SALES'], 2); ?>
								</a>
							</td>
							<td>
								<a class="underline" href="<?php echo base_url("commissions/get/all/" . $the_year); ?>">
									<?php echo number_format($row['SPONSOR'] + $row['BINARY'] + $row['MATCHING'], 2); ?>
								</a>
							</td>
							<td>
								<a class="underline" href="<?php echo base_url("commissions/get/sponsor/" . $the_year); ?>">
									<?php echo number_format($row['SPONSOR'], 2); ?>
								</a>
							</td>
							<td>
								<a class="underline" href="<?php echo base_url("commissions/get/binary/" . $the_year); ?>">
									<?php echo number_format($row['BINARY'], 2); ?>
								</a>
							</td>
							<td>
								<a class="underline" href="<?php echo base_url("commissions/get/matching/" . $the_year); ?>">
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
