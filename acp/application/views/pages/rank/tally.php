<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
	<h2 class="text-lg font-medium mr-auto">
		[[LABEL_RANK_TALLY]]
	</h2>
</div>
<div class="intro-y box mt-5 p-5">
	<div class="section mt-2">
		<div class="card">
			<div class="card-body">
				<form name="frmSearch" method="post" class="form-horizontal">
					<div class="form-group">
						<div class="input-wrapper">
							<input type="text" name="txtSearch" id="txtSearch"
								   value="<?php echo isset($txtSearch) ? $txtSearch : '1000000'; ?>"
								   class="form-control"
								   placeholder="[[LABEL_USERID_USERNAME]]"/>
						</div>
					</div>
					<div class="form-group basic mt-2">
						<div class="w-full flex mt-4">
							<button type="submit" class="w-full btn btn-primary shadow-md mr-2">[[ADD_NEW_ADMIN]]
							</button>
						</div>
					</div>
				</form>
			</div>

			<div class="transactions mt-5">
				<span onclick="getUserDetails(<?php echo isset($txtSearch) ? $txtSearch : '1000000'; ?>)"
					  class="clickable text-md px-1 rounded-md bg-primary text-white mr-1">
					[[CHECK_USER_DETAILS]]
				</span>
			</div>

			<div class="intro-y box mt-5">
				<table class="table">
					<thead>
					<tr>
						<th>[[LABEL_RANK]]</th>
						<th>[[LABEL_LEFT]]</th>
						<th>[[LABEL_RIGHT]]</th>
					</tr>
					</thead>
					<tbody>
					<?php
					foreach ($ranks as $row) {
						$rank = $row['id'];
						echo "<tr>";
						echo "<td>" . $row['name'] . "</td>";
						if (isset($report['L'][$rank])) {
							echo "<td>" . $report['L'][$rank] . "</td>";
						} else {
							echo "<td>0</td>";
						}
						if (isset($report['R'][$rank])) {
							echo "<td>" . $report['R'][$rank] . "</td>";
						} else {
							echo "<td>0</td>";
						}
						echo "</tr>";
					}
					?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
