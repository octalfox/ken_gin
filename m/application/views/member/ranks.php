<div id="appCapsule">
	<div class="section mt-2">
		<div class="card">
			<div class="card-body">
				<div class="col-12 mt-2 mb-4">
					<div class="card margin-home-card">
						<div class="card-body pt-0">
							<ul class="nav nav-tabs lined" role="tablist">
								<li class="nav-item">
									<a class="nav-link tblo active" id="tdl1" data-toggle="tab" onclick="selectTab(1)" role="tab">
										[[LABEL_RANK_TALLY]]
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link tblo" id="tdl2" data-toggle="tab" onclick="selectTab(2)" role="tab">
										[[LABEL_RANK_HISTORY]]
									</a>
								</li>
							</ul>

							<div class="tab-content tblo mt-2">
								<div class="tab-pane tblo fade show active" id="tb1" role="tabpanel">
<!--
        							<div class="col-sm-12" style="vertical-align: top;">
										<a target="_blank" href="https://api.gs.ezymlm.net/crons/update/process/<?php echo $_SESSION['logged']['userid']; ?>">TEMPORARY GENERATE</a>
									</div>
-->
									<div class="col-sm-12" style="vertical-align: top;">
										<div class="row">
											<article class="col-xs-12">
												<div class="jarviswidget jarviswidget-color-darken">
													<div class="widget-body">
														<div class="sponsor table-responsive">
															<table class="table table-striped">
																<thead>
																<tr>
																	<th>[[LABEL_RANK]]</th>
																	<th>[[LABEL_LEFT]]</th>
																	<th>[[LABEL_RIGHT]]</th>
																</tr>
																</thead>
																<tbody>
																<?php foreach ($ranks['ranks'] as $row) {
																	$rank = $row['id'];
																	?>
																	<tr>
																		<td><?php echo $row['name'] ?></td>
																		<td><?php echo isset($rank_tally['L'][$rank]) ? $rank_tally['L'][$rank] : 0; ?></td>
																		<td><?php echo isset($rank_tally['R'][$rank]) ? $rank_tally['R'][$rank] : 0; ?></td>
																	</tr>
																<?php } ?>
																</tbody>
															</table>
														</div>
													</div>
												</div>
											</article>
										</div>
									</div>
								</div>

								<div class="tab-pane tblo fade" id="tb2" role="tabpanel">
									<div class="col-sm-12" style="vertical-align: top;">
										<div class="row">

											<article class="col-xs-12">
												<div class="jarviswidget jarviswidget-color-darken">
													<div class="widget-body">
														<div class="sponsor table-responsive">
															<table class="table table-striped">
																<thead>
																<tr>
																	<th>[[LABEL_PERIOD]]</th>
																	<th>[[LEFT_BV]]</th>
																	<th>[[RIGHT_BV]]</th>
																	<th>[[LABEL_LEFT]]</th>
																</tr>
																</thead>
																<tbody>
																<?php foreach ($history as $row) {
																	$summary = explode("__", $row['month1']);
																	if($_SESSION['logged']['join_date'] > $summary[0]){
																		continue;
																	}
																	?>
																	<tr>
																		<td><?php echo $summary[0] ?></td>
																		<td><?php echo $summary[1] ?></td>
																		<td><?php echo $summary[2] ?></td>
																		<td><?php echo $row['rank1'] ?></td>
																	</tr>
																<?php } ?>
																</tbody>
															</table>
														</div>
													</div>
												</div>
											</article>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
			<div>
			</div>
		</div>
