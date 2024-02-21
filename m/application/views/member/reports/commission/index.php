<div id="appCapsule">
	<div class="section mt-2">
		<div class="card">
			<div class="card-body">
				<form method="post" class="form-inline">
					<div class="form-group basic">
						<div class="input-wrapper">
							<label class="form-label">[[LABEL_SELECT_PERIOD]]</label>
							<div class="controls">
								<select name="selPeriod" id="selPeriod" class="form-control">
									<?php
									$join_period = date('Y-m', strtotime($_SESSION['myAccount']['join_date']));
									$cur_period = strtotime(date('Y-m'));
									for ($i = 0; $i < 12; $i++) {
										$the_period = date('Y-m', strtotime("-" . $i . " month", $cur_period));
										$the_period_name = date('M Y', strtotime($the_period . "-1"));
										$selected = ($report['period'] == $the_period) ? 'selected="selected"' : '';
										if ($the_period >= $join_period) {
											echo '<option value="' . $the_period . '" ' . $selected . '>' . $the_period_name . '</option>';
										}
									}
									?>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group basic">
						<div class="input-wrapper">
							<input type="submit" name="btnView" value="[[DEF_VIEW]]"
								   class="btn btn-warning btn-lg btn-block"/>
						</div>
					</div>
				</form>
				<div>
					<?php
					$sponsor = $report['SPONSOR_BONUS'];
					$binary = $report['BINARY_BONUS'];
					$matching = $report['MATCHING_BONUS'];
					$total = $sponsor + $matching + $binary;
					?>
					<h3><?php echo date('M Y', strtotime($report['period'])) . ": $ " . number_format($total, 2, '.', ',') . ''; ?></h3>
				</div>
				<div class="listview-title mt-1"></div>
				<ul class="listview image-listview text inset">
					<li>
						<a href="<?php echo base_url("reports/commission/sponsor/" . $report['period']) ?>" class="item">
							<div class="in">
								[[LABEL_SPONSOR_BONUS]] - $ <?php echo number_format($sponsor, 2, '.', ',') ?>
							</div>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url("reports/commission/matching/" . $report['period']) ?>" class="item">
							<div class="in">
								[[LABEL_MATCHING_BONUS]] - $ <?php echo number_format($matching, 2, '.', ',') ?>
							</div>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url("reports/commission/binary/" . $report['period']) ?>" class="item">
							<div class="in">
								[[LABEL_BINARY_BONUS]] - $ <?php echo number_format($binary, 2, '.', ',') ?>
							</div>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
