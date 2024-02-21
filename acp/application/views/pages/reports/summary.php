<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
	<h2 class="text-lg font-medium mr-auto">
		[[LABEL_SUMMARY_REPORT]]
	</h2>
</div>
<div class="intro-y box p-3 mt-5">
	<div class="section mt-2">
		<div class="card">
			<div class="card-body">
				<form name="frmSearch" method="post" class="form-horizontal">
					<div class="form-group">
						<div class="input-wrapper">
							<select name="period" id="period" class="form-control">
								<?php
								$the_year = '2019';
								$the_month = '2019-08';
								$this_year = date('Y');
								$this_month = date('Y-m');
								while ($the_year <= $this_year) {
									$selected = $the_year == $period ? ' selected="selected"' : '';
									?>
									<?php while ($the_month <= $this_month) {
										$selected = $the_month == $period ? ' selected="selected"' : '';
										?>
										<option value="<?php echo $the_month ?>" <?php echo $selected; ?>>
											<?php echo date('M Y', strtotime($the_month . "-01")); ?>
										</option>
										<?php $the_month = date("Y-m", strtotime("+1 month", strtotime($the_month)));
									} ?>
									<?php $the_year = date('Y', strtotime("+1 year", strtotime($the_year)));
									$the_month = $the_year . "-01";
								} ?>
							</select>
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
          
          

          <div class="p-5 px-10 overflow-auto">
              <a target="_blank" href="<?php echo api_url("admin/export/summary$query"); ?>"
                 class="btn btn-primary float-right">
                  [[EXPORT_REPORT_COUNT]]
              </a>
          </div>

			<div class="intro-y box mt-5">
				<table class="table">
					<thead>
					<tr>
						<th>#</th>
						<th>[[LABEL_AMOUNT]]</th>
					</tr>
					</thead>
					<tbody>
					<tr>
						<td>[[COM_TOTAL_MEMBERS]]</td>
						<td>
							<?php echo $reports['main_members']; ?>
						</td>
					</tr>
					<tr>
						<td>[[COM_TOTAL_NODES]]</td>
						<td>
							<?php echo $reports['members']; ?>
						</td>
					</tr>
					<tr>
						<td>[[COM_TOTAL_SALES]]</td>
						<td>
							<?php echo number_format($reports['sales'], 2); ?>
						</td>
					</tr>
					<tr>
						<td>
							[[COM_TOTAL_SALES_IN]] <?php echo strlen($period) == 4 ? $period : date('M Y', strtotime($period . "-01")); ?>
						</td>
						<td>
							<?php echo number_format($reports['period_sales'], 2); ?>
						</td>
					</tr>
					<?php foreach ($reports['ledgers'] as $ledger) { ?>
							<tr>
								<td>[[<?php echo preg_replace("/[\s-]/", "_", $ledger['trans_source_type']); ?>]] (<?php echo $ledger['currency'] ?>)</td>
								<td><?php echo $ledger['dr'] == 0 ? $ledger['cr'] : $ledger['dr']; ?></td>
							</tr>
					<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
