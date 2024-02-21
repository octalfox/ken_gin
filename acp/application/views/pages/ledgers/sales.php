<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
	<h2 class="text-lg font-medium mr-auto">
		[[LABEL_<?php echo strtoupper($type); ?>_LEDGER]]
	</h2>
</div>
<div class="intro-y box mt-5">
	<div class="p-5 overflow-auto">
		<form method="get" class="form-horizontal">
			<div class="input-form mt-5">
				<div class="row">
					<div class="col-6">
						<label class=" control-label" for="txtGroupName">[[USERID]]</label>
						<input class="form-control" type="text" name="member_id"
							   value="<?php echo $_GET['member_id'] ?>">
					</div>
					<div class="col-6">
						<label class=" control-label" for="txtGroupName">[[CREDIT_TYPE]]</label>
						<select name="currency" id="currency" class="form-control">
							<?php
							foreach ($currencies as $c) {
								$sel = isset($_GET['currency']) && $_GET['currency'] == $c['name'] ? ' selected ' : '';
								?>
								<option value="<?php echo $c['name']; ?>" <?php echo $sel ?>>
									[[<?php echo $c['name']; ?>]]
								</option>
								<?php
							}
							?>
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
	</div>

	<div class="p-5 px-10 overflow-auto">
		<a target="_blank" href="<?php echo api_url("admin/export/ledger$query"); ?>"
		   class="btn btn-primary float-right">
			[[EXPORT_REPORT_COUNT]]: <?php echo $counter; ?>
		</a>
	</div>
	<div class="px-10 overflow-auto">
		<table class="table w-full">
			<thead>
			<tr>
				<th>#</th>
				<th data-hide="phone">[[USERID]]</th>
				<th data-class="expand">[[CURRENCY]]</th>
				<th data-hide="phone">[[TRANS_SOURCE]]</th>
				<th data-hide="phone">[[LABEL_TRANSID]]</th>
				<th data-hide="phone">[[LABEL_DESCRIPTION]]</th>
				<th data-hide="phone">[[LABEL_DEBIT]]</th>
				<th data-hide="phone">[[LABEL_CREDIT]]</th>
				<th data-hide="phone">[[LABEL_BALANCE]]</th>
				<th data-hide="phone">[[DATE]]</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($list as $key => $report) { ?>
				<tr>
					<td><?php echo ($key + 1) + (($page - 1) * $per_page); ?></td>
					<td>
                        <span onclick="getUserDetails(<?php echo $report['userid'] ?>)"
                              class="clickable text-xs px-1 rounded-md bg-primary text-white mr-1">
                          <?php echo $report['userid']; ?>
                        </span>
					</td>
					<td><?php echo $report['currency']; ?></td>
					<td><?php echo $report['trans_source_type']; ?></td>
					<td><?php echo $report['trans_id']; ?></td>
					<td><?php echo $report['description']; ?></td>
					<td><?php echo $report['debit']; ?></td>
					<td><?php echo $report['credit']; ?></td>
					<td><?php echo $report['balance']; ?></td>
					<td><?php echo formatDate($report['insert_time']); ?></td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
		<?php
		$this->load->view("partials/pagination", array(
				"link" => "ledger/$type",
				"per_page" => $per_page,
				"page" => $page,
				"counter" => $counter,
				"query" => $query
		));
		?>
	</div>
</div>
