<?php $_SESSION['asset_file_name'] = "deliveries"; ?>
<div id="appCapsule">
	<div class="section mt-2">
		<div class="card">
			<div class="card-body">
				<form method="post" class="form-inline">
					<div class="form-group basic">
						<div class="input-wrapper">
							<input type="text" name="txtSearch" id="txtSearch"
								   value="<?php echo $_POST['txtSearch']; ?>"
								   class="form-control" placeholder="[[INVOICE_NUMBER]]"/>
						</div>
					</div>
					<div class="form-group basic">
						<div class="input-wrapper">
							<select name="do_status" id="selDoStatus" class="select form-control">
								<option value="ALL" <?php echo ($_POST['do_status'] == 'ALL') ? 'selected="selected"' : ''; ?>>
									[[DEF_STATUS_ALL]]
								</option>
								<option value="PENDING" <?php echo ($_POST['do_status'] == 'PENDING') ? 'selected="selected"' : ''; ?>>
									[[DEF_STATUS_PENDING]]
								</option>
								<option value="DELIVERED" <?php echo ($_POST['do_status'] == 'DELIVERED') ? 'selected="selected"' : ''; ?>>
									[[DEF_STATUS_DELIVERED]]
								</option>
							</select>
						</div>
					</div>
					<div class="form-group basic">
						<div class="input-wrapper">
							<input type="submit" name="btnSearch" value="[[DEF_SEARCH]]"
								   class="btn btn-lg btn-warning btn-block"/>
						</div>
					</div>
				</form>
			</div>

			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-body">
							<div class="table-responsive">
								<table id="my_custom_dt" class="table table-striped">
									<thead>
									<tr>
										<th>[[LABEL_REFERENCE_NUM]]</th>
										<th>[[LABEL_DATE]]</th>
										<th>[[LABEL_DATE_DELIVERY]]</th>
										<th>[[LABEL_STATUS]]</th>
										<th></th>
									</tr>
									</thead>
									<tbody>
									<?php foreach ($reports as $key => $row) { ?>
										<tr>
											<td><?php echo $row['order_num']; ?></td>
											<td><?php echo $row['order_date']; ?></td>
											<td><?php echo $row['received_date'] == null ? "N/A" : formatDate($row['received_date']); ?></td>
											<td><?php echo $row['received_date'] == null ? "[[".$row['status']."]]" : "[[DELIVERED]]"; ?></td>
											<td>
												<a target="_blank"
												   href="<?php echo api_url("pdf/delivery/" . $row['id']); ?>">
													<ion-icon style="color: black; font-size: 22px" name="print-outline"></ion-icon>
												</a>
											</td>
										</tr>
									<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
						<?php echo isset($pagination) ? $pagination : ''; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
