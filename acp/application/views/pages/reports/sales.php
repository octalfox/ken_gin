<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
	<h2 class="text-lg font-medium mr-auto">
		[[LABEL_SALES_REPORT]]
	</h2>
</div>
<div class="intro-y box mt-5">
	<div class="section mt-2">
		<div class="card">
			<div class="intro-y box mt-5">
				<table class="table" id="dataTable">
					<thead>
					<tr>
						<th>[[USERID]]</th>
						<th>[[FULLNAME]]</th>
						<th>[[PERIOD]]</th>
						<th>[[GROUP_SALES]]</th>
						<th>[[PERSONAL_SALES]]</th>
						<th>[[DIRECT_SALES]]</th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($reports as $the_year => $row) { ?>
						<tr>
							<td>
								<span onclick="getUserDetails(<?php echo $row['userid']; ?>)"
									  class="clickable text-md px-1 rounded-md bg-primary text-white mr-1">
									<?php echo $row['userid']; ?>
								</span>
							</td>
							<td><?php echo $row['f_name']; ?> <?php echo $row['l_name']; ?></td>
							<td><?php echo $row['period']; ?></td>
							<td><?php echo $row['group_sales']; ?></td>
							<td><?php echo $row['personal_sales']; ?></td>
							<td><?php echo $row['direct_sales']; ?></td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
