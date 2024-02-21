<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
	<h2 class="text-lg font-medium mr-auto">
		[[LABEL_COMMISSION_REPORT]]
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
						<th>[[AMOUNT]]</th>
						<th>[[COMMISSION]]</th>
						<th>[[TYPE]]</th>
						<th>[[DESCRIPTION]]</th>
						<th>[[DATE]]</th>
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
							<td><?php echo $row['based_on']; ?></td>
							<td><?php echo $row['amount']; ?></td>
							<td>[[<?php echo $row['comm_type']; ?>]]</td>
							<td><?php echo $row['description']; ?></td>
							<td><?php echo $row['date_created']; ?></td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
