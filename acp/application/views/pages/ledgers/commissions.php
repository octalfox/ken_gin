<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
	<h2 class="text-lg font-medium mr-auto">
		[[LABEL_COMMISSIONS_LEDGER]]
	</h2>
</div>
<div class="intro-y box p-3 mt-5">
	<div class="section mt-2">
		<div class="card">
			<div class="card-body">
				<form method="post" class="form-horizontal">
					<div class="input-form mt-5">
						<div class="row">
							<div class="col-6">
								<label class=" control-label" for="txtGroupName">[[USERID]]</label>
								<input class="form-control" type="text" name="member_id"
									   value="<?php echo $_GET['member_id'] ?>">
							</div>
							<div class="col-6">
								<label class=" control-label" for="txtGroupName">[[BONUS_TYPE]]</label>
								<select name="bonus" id="bonus" class="form-control">
									<option <?php echo $_GET['bonus'] == "ALL_BONUS" ? "selected='selected'" : ""; ?>
											value="ALL_BONUS">[[ALL_BONUS]]
									</option>
									<option <?php echo $_GET['bonus'] == "SPONSOR_BONUS" ? "selected='selected'" : ""; ?>
											value="SPONSOR_BONUS">[[SPONSOR_BONUS]]
									</option>
									<option <?php echo $_GET['bonus'] == "BINARY_BONUS" ? "selected='selected'" : ""; ?>
											value="BINARY_BONUS">[[BINARY_BONUS]]
									</option>
									<option <?php echo $_GET['bonus'] == "MATCHING_BONUS" ? "selected='selected'" : ""; ?>
											value="MATCHING_BONUS">[[MATCHING_BONUS]]
									</option>
									<option <?php echo $_GET['bonus'] == "RANKING_BONUS" ? "selected='selected'" : ""; ?>
											value="RANKING_BONUS">[[RANKING_BONUS]]
									</option>
									<option <?php echo $_GET['bonus'] == "MODEL_BONUS" ? "selected='selected'" : ""; ?>
											value="MODEL_BONUS">[[MODEL_BONUS]]
									</option>
								</select>
							</div>
						</div>
					</div>

					<div class="input-form mt-2">
						<div class="row">
							<div class="col-6">
								<label class=" control-label" for="txtGroupName">[[LABEL_FROM_YEAR]]</label>
								<select name="selyrfrom" id="year_start" class="form-control">
									<?php
									$defYear = "2018";
									for ($year = date('Y'); $year > $defYear - 1; $year--) {
										$sel = $year == $_GET['selyrfrom'] ? ' selected="selected"' : '';
										echo '<option value="' . $year . '"' . $sel . ' >' . $year . '</option>';
									}
									?>
								</select>
							</div>
							<div class="col-6">
								<label class=" control-label" for="txtGroupName">[[LABEL_FROM_MONTH]]</label>
								<select name="selmonfrom" id="month_start" class="form-control">
									<?php
									for ($m = 2; $m < 14; $m++) {
										$month = date("m", mktime(0, 0, 0, $m, 0, 0));
										$monthd = date("M", mktime(0, 0, 0, $m, 0, 0));
										$sel = isset($_GET['selmonfrom']) && $month == $_GET['selmonfrom'] ? ' selected="selected"' : '';
										echo '<option value="' . $month . '"' . $sel . '>[[DEF_' . strtoupper($monthd) . ']]</option>';
									}
									?>
								</select>
							</div>
						</div>
					</div>

					<div class="input-form mt-2">
						<div class="row">
							<div class="col-6">
								<label class=" control-label" for="txtGroupName">[[DEF_UNTIL_YEAR]]</label>
								<select name="selyrto" id="year_end" class="form-control">
									<?php
									$defYear = ((date('Y') - 20) > date('Y', strtotime($join_date)) ? (date('Y') - 20) : date('Y', strtotime($join_date)));
									for ($year = date('Y'); $year > $defYear - 1; $year--) {
										$sel = isset($_GET['selyrto']) && $year == $_GET['selyrto'] ? ' selected="selected"' : '';
										echo '<option value="' . $year . '"' . $sel . '>' . $year . '</option>';
									}
									?>
								</select>
							</div>
							<div class="col-6">
								<label class=" control-label" for="txtGroupName">[[DEF_UNTIL_MONTH]]</label>
								<select name="selmonto" id="month_end" class="form-control">
									<?php
									for ($m = 2; $m < 14; $m++) {
										$month = date("m", mktime(0, 0, 0, $m, 0, 0));
										$monthd = date("M", mktime(0, 0, 0, $m, 0, 0));
										$sel = isset($_GET['selmonto']) && $month == $_GET['selmonto'] ? ' selected="selected"' : '';
										echo '<option value="' . $month . '"' . $sel . '>[[DEF_' . strtoupper($monthd) . ']]</option>';
									}
									?>
								</select>
							</div>
						</div>
					</div>

					<div class="input-form mt-5">
						<div class="col-12">
							<input type="submit" name="btnSubmit" value="[[DEF_VIEW]]"
								   class="btn btn-primary w-full mt-2 mb-2"/>
						</div>
					</div>
				</form>

				<div class="card">
					<div class="table-responsive">
						<table id="dataTable" class="table table-striped">
							<thead>
							<tr>
								<th>#</th>
								<th data-hide="phone">[[USERID]]</th>
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
									<td>
										<span onclick="getUserDetails(<?php echo $report['userid'] ?>)"
											  class="clickable text-xs px-1 rounded-md bg-primary text-white mr-1">
											<?php echo $report['userid']; ?>
										</span>
									</td>
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
