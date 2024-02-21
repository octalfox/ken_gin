<div id="appCapsule">
	<div class="section wallet-card-section pt-1">
		<div class="wallet-card">
			<div class="balance">
				<div class="left">
					<span class="title">[[CC]]</span>
					<h1 class="total">$<?php echo number_format($CCs['balance'], 2); ?></h1>
				</div>
				<div class="right">
					<a class="button" href="<?php echo base_url("convert"); ?>">
						<ion-icon name="add-outline" role="img" class="md hydrated" style="color: red"
								  aria-label="add outline"></ion-icon>
					</a>
				</div>
			</div>
			<div class="wallet-footer">
				<div class="item">
					<a href="<?php echo base_url('user/downline'); ?>">
						<div class="icon-wrapper">
							<ion-icon name="person-add-outline"></ion-icon>
						</div>
						<strong>[[LABEL_ADD_MEMBER]]</strong>
					</a>
				</div>
				<div class="item">
					<a href="<?php echo base_url('reports'); ?>">
						<div class="icon-wrapper bg-success">
							<ion-icon name="stats-chart-outline"></ion-icon>
						</div>
						<strong>[[LABEL_REPORTS]]</strong>
					</a>
				</div>
				<div class="item">
					<a href="<?php echo base_url("invoices"); ?>">
						<div class="icon-wrapper bg-danger">
							<ion-icon name="document-text-outline"></ion-icon>
						</div>
						<strong>[[LABEL_INVOICE]]</strong>
					</a>
				</div>
				<div class="item">
					<a href="<?php echo base_url("deliveries"); ?>">
						<div class="icon-wrapper bg-warning">
							<ion-icon name="calculator-outline"></ion-icon>
						</div>
						<strong>[[LABEL_DO]]</strong>
					</a>
				</div>
			</div>
			<div class="wallet-footer border-0">
				<div class="item">
					<a href="<?php echo base_url("topup"); ?>">
						<div class="icon-wrapper bg-dark">
							<ion-icon name="arrow-up-outline"></ion-icon>
						</div>
						<strong>[[LABEL_TOPUP_RC]]</strong>
					</a>
				</div>
				<div class="item">
					<a href="<?php echo base_url("transfer"); ?>">
						<div class="icon-wrapper bg-warning">
							<ion-icon name="swap-vertical"></ion-icon>
						</div>
						<strong>[[LABEL_TRANSFER]]</strong>
					</a>
				</div>
				<div class="item">
					<a href="<?php echo base_url("ranks"); ?>">
						<div class="icon-wrapper bg-info">
							<ion-icon name="people-outline"></ion-icon>
						</div>
						<strong>[[LABEL_RANK_TALLY]]</strong>
					</a>
				</div>
				<div class="item">
					<a href="<?php echo base_url("withdraw"); ?>">
						<div class="icon-wrapper bg-secondary">
							<ion-icon name="arrow-down-outline"></ion-icon>
						</div>
						<strong>[[LABEL_WITHDRAW]]</strong>
					</a>
				</div>
			</div>
		</div>
	</div>


	<div class="col-12 mt-2 mb-4">
		<div class="card margin-home-card">
			<div class="card-body pt-0">

				<ul class="nav nav-tabs lined" role="tablist">
					<li class="nav-item">
						<a class="nav-link tblo active" id="tdl1" data-toggle="tab" onclick="selectTab(1)" role="tab">
							<?= $title_1[0] ?>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link tblo" id="tdl2" data-toggle="tab" onclick="selectTab(2)" role="tab">
							<?= $title_2[0] ?>
						</a>
					</li>
				</ul>

				<div class="tab-content tblo mt-2">
					<div class="tab-pane tblo fade show active" id="tb1" role="tabpanel">
						<div class="col-sm-12" style="vertical-align: top;">
							<div class="row">
								<article class="col-xs-12">
									<div class="jarviswidget jarviswidget-color-darken">
										<div class="widget-body">
											<h4 id="subtitle" class="text-center"><?= $title_1[1] ?></h4>
											<br>
											<div class="sponsor table-responsive">
												<table style="width: 100%"
													   class="table table-sm table-striped">
													<tbody>
													<?php foreach ($summary as $key => $val) { ?>
														<tr>
															<td>[[<?php echo $key ?>]]</td>
															<td><?php echo $val ?></td>
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
											<h4 id="subtitle_2" class="text-center"><?= $title_2[1] ?></h4>
											<br>
											<div class="sponsor table-responsive">
												<table style="width: 100%"
													   class="table table-sm table-striped">
													<tbody>
													<?php foreach ($career as $key => $val) { ?>
														<tr>
															<td>[[<?php echo $key ?>]]</td>
															<td><?php echo $val ?></td>
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

	<div class="modal fade action-sheet" id="switchActionSheet" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">[[LABEL_SWTICH_ACCOUNT]]</h5>
				</div>
				<div class="modal-body">
					<div class="action-sheet-content">
						<?php
						$subMax = count($SUB_ACCOUNTS);
						$li = '<div class="row">';
						$ps = "";
						if ($subMax > 0) {
							$ps .= '<div class="col-md-12">
										<div class="title switcher" onclick="javascript:switch_account(' . $MAIN_ACCOUNT['userid'] . ')">
											<ion-icon name="people-outline" role="img" class="nanga" aria-label="people outline"></ion-icon>
											' . $MAIN_ACCOUNT['userid'] . '
										</div>
									</div>';
							foreach ($SUB_ACCOUNTS as $sub => $row) {
								$ps .= '<div class="col-md-12">
											<div class="title switcher" onclick="javascript:switch_account(' . $row['userid'] . ')">
												<ion-icon name="people-outline" role="img" class="nanga" aria-label="people outline"></ion-icon>
												' . $row['userid'] . '
											</div>
										</div>';
							}
						}
						if ($ps != "") {
							$li .= $ps;
						} else {
							$li .= '<div class="text-center title col-md-12">[[LABEL_NO_ACCOUNT]]</div>';
						}

						$li .= '</div>';
						echo $li;
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
