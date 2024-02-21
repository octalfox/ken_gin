<div id="content" style="
    background: white;
    padding: 15px;
    border-radius: 10px;
    margin: 15PX;
    margin-top: 65px;">
	<section id="widget-grid" class="">
		<div class="row">
			<article class="col-sm-12 sortable-grid ui-sortable">
				<div class="main ">    <!-- Commissions Details -->
					<div class="sponsor">
						<div class="jarviswidget jarviswidget-color-darken">
							<header>
								<h2><?php echo '[[LABEL_' . strtoupper($comm_type) . ($comm_type != 'roi' ? '_BONUS]]' : ']]'); ?></h2>
							</header>
							<div id="widget-grid">
								<!--                                <form method="post" class="form-horizontal">
                                    <div class="control-group">
                                        <a class="btn btn-warning"
                                           href="<?php echo BASE_URL; ?>member/commissions/<?php echo $period;
								?>">[[DEF_BACK]]</a>
                                    </div>
                                </form> -->

								<div class="control-group">
									<label class="control-label"></label>
									<div class="controls">
									</div>
								</div>
								<div class="card">
									<div class="table-responsive">
										<table id="my_custom_dt" class="table table-striped">
											<thead>
											<tr>
												<th data-hide="phone">[[LABEL_REFERENCE_NUM]]</th>
												<th data-hide="phone">[[LABEL_FROM]]</th>
												<th data-hide="phone">[[LABEL_NAME]]</th>
												<?php if ($comm_type == 'sponsor') { ?>
													<th data-class="expand">[[LABEL_AMOUNT]]</th>
													<th data-class="expand">[[LABEL_PERCENT]]</th>
												<?php } else { ?>
													<th data-class="expand">[[LABEL_AMOUNT]]</th>
												<?php } ?>
												<th data-hide="phone">[[LABEL_DATE]]</th>
											</tr>
											</thead>
											<tbody>
											<?php foreach ($reports as $row) { ?>
												<tr>
													<td><?php echo $row['id']; ?></td>
													<td><?php echo $row['userid']; ?></td>
													<td><?php echo $row['f_name'] . " " . $row['l_name']; ?></td>
													<?php if ($comm_type == 'sponsor') { ?>
														<td>$ <?php echo number_format($row['amount'], 2, '.', ','); ?></td>
														<td><?php echo $row['percent']; ?></td>
													<?php } else { ?>
														<td>$ <?php echo number_format($row['amount'], 2, '.', ','); ?></td>
													<?php } ?>
													<?php if ($comm_type != 'roi') { ?>
														<td><?php echo formatDate($row['date_created']); ?></td>
													<?php } else { ?>
														<td><?php echo formatDate($row['period']); ?></td>
													<?php } ?>
												</tr>
											<?php } ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
			</article>
		</div>
	</section>
</div>
