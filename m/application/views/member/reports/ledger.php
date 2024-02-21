<div id="appCapsule">
	<div class="section mt-2">
		<div class="card">
			<div class="card-body">
				<form method="post" class="form-horizontal">
					<?php echo (isset($msg)) ? $msg : ''; ?>

					<div class="form-group basic">
						<div class="input-wrapper">
							<label class=" control-label" for="txtGroupName">[[CREDIT_TYPE]]</label>
							<div class="">
								<select name="currency" id="currency" class="form-control">
									<?php
									foreach ($currencies as $currency) {
										$sel = isset($_POST['currency']) && $_POST['currency'] == $currency['name'] ? ' selected ' : '';
										?>
										<option value="<?php echo $currency['name']; ?>" <?php echo $sel ?>>
											[[<?php echo $currency['name']; ?>]]
										</option>
										<?php
									}
									?>
								</select>
							</div>
						</div>
					</div>

					<div class="form-group basic">
						<div class="input-wrapper">
							<label class=" control-label" for="txtGroupName">[[LABEL_FROM]]</label>
							<div class="row">
								<div class="col-5">
									<select name="selyrfrom" id="year_start" class="form-control">
										<?php
										$join_date = isset($member['join_date']) ? $member['join_date'] : date("Y-m-d 00:00:00");
										$defYear = ((date('Y') - 20) > date('Y', strtotime($join_date)) ? (date('Y') - 20) : date('Y', strtotime($join_date)));
										for ($year = date('Y'); $year > $defYear - 1; $year--) {
											$sel = $year == isset($_POST['selyrfrom']) && $_POST['selyrfrom'] ? ' selected="selected"' : '';
											echo '<option value="' . $year . '"' . $sel . ' >' . $year . '</option>';
										}
										?>
									</select>
								</div>
								<div class="col-2 text-center"> -</div>
								<div class="col-5">
									<select name="selmonfrom" id="month_start" class="form-control">
										<?php
										for ($m = 2; $m < 14; $m++) {
											$month = date("m", mktime(0, 0, 0, $m, 0, 0));
											$monthd = date("M", mktime(0, 0, 0, $m, 0, 0));
											$sel = isset($_POST['selmonfrom']) && $month == $_POST['selmonfrom'] ? ' selected="selected"' : '';
											echo '<option value="' . $month . '"' . $sel . '>[[DEF_' . strtoupper($monthd) . ']]</option>';
										}
										?>
									</select>
								</div>
							</div>
						</div>
					</div>

					<div class="form-group basic">
						<div class="input-wrapper">
							<label class=" control-label" for="txtGroupName">[[DEF_UNTIL]]</label>
							<div class="row">
								<div class="col-5">
									<select name="selyrto" id="year_end" class="form-control">
										<?php
										$defYear = ((date('Y') - 20) > date('Y', strtotime($join_date)) ? (date('Y') - 20) : date('Y', strtotime($join_date)));
										for ($year = date('Y'); $year > $defYear - 1; $year--) {
											$sel = isset($_POST['selyrto']) && $year == $_POST['selyrto'] ? ' selected="selected"' : '';
											echo '<option value="' . $year . '"' . $sel . '>' . $year . '</option>';
										}
										?>
									</select>
								</div>
								<div class="col-2 text-center">
									-
								</div>
								<div class="col-5">
									<select name="selmonto" id="month_end" class="form-control">
										<?php
										for ($m = 2; $m < 14; $m++) {
											$month = date("m", mktime(0, 0, 0, $m, 0, 0));
											$monthd = date("M", mktime(0, 0, 0, $m, 0, 0));
											$sel = isset($_POST['selmonto']) && $month == $_POST['selmonto'] ? ' selected="selected"' : '';
											echo '<option value="' . $month . '"' . $sel . '>[[DEF_' . strtoupper($monthd) . ']]</option>';
										}
										?>
									</select>
								</div>
							</div>
						</div>
					</div>

					<div class="form-group basic">
						<div class="input-wrapper">
							<input type="submit" name="btnSubmit" value="[[DEF_VIEW]]"
								   class="btn btn-warning btn-block btn-lg mt-2 mb-2"/>
						</div>
					</div>
				</form>

				<div class="card">
					<div class="table-responsive">
						<table id="my_custom_dt" class="table table-striped">
							<thead>
							<tr>
								<th>#</th>
								<th>[[LABEL_REFERENCE_NUM]]</th>
								<th data-hide="phone">[[DEF_DATE]]</th>
								<th data-class="expand">[[DEF_DESCRIPTION]]</th>
								<th data-hide="phone">[[LABEL_CREDIT]]</th>
								<th data-hide="phone">[[LABEL_DEBIT]]</th>
								<th data-hide="phone">[[LABEL_BALANCE]]</th>
							</tr>
							</thead>
							<tbody>
							<?php foreach ($reports as $key => $report) { ?>
								<tr>
									<td><?php echo $key + 1; ?></td>
									<td><?php echo $report['trans_no']; ?></td>
									<td><?php echo formatDate($report['insert_time']); ?></td>
									<td><?php echo $report['description']; ?></td>
									<td><?php echo $report['credit']; ?></td>
									<td><?php echo $report['debit']; ?></td>
									<td><?php echo $report['balance']; ?></td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
