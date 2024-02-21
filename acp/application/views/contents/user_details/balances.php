<div class="accordion-item">
	<div id="faq-accordion-content-2" class="accordion-header">
		<button class="accordion-button collapsed" type="button" data-tw-toggle="collapse"
				data-tw-target="#faq-accordion-collapse-2" aria-expanded="false"
				aria-controls="faq-accordion-collapse-2">
			[[BALANCES]]
		</button>
	</div>
	<div id="faq-accordion-collapse-2" class="accordion-collapse collapse"
		 aria-labelledby="faq-accordion-content-2"
		 data-tw-parent="#faq-accordion-1">
		<div class="accordion-body text-slate-600 dark:text-slate-500 leading-relaxed">
			<div class="intro-y tab-content mt-2.5">
				<div class="tab-pane active" role="tabpanel" aria-labelledby="dashboard-tab">
					<div class="grid grid-cols-12 gap-12">
						<div class="intro-y box col-span-12 lg:col-span-12">
							<div class="p-5">
								<div class="tab-content">
									<div id="latest-tasks-new" class="tab-pane active" role="tabpanel"
										 aria-labelledby="latest-tasks-new-tab">
										<table class="table">
											<thead>
											<tr>
												<th>[[CURRENCY]]</th>
												<th>[[CREDITS]]</th>
												<th>[[DEBITS]]</th>
												<th>[[AVAILABLE]]</th>
											</tr>
											</thead>
											<tbody>
											<tr>
												<td>[[CC]]</td>
												<td><?php echo $reports['CCs']['credit'] ?></td>
												<td><?php echo $reports['CCs']['debit'] ?></td>
												<td><?php echo $reports['CCs']['balance'] ?></td>
											</tr>
											<tr>
												<td>[[RC]]</td>
												<td><?php echo $reports['RCs']['credit'] ?></td>
												<td><?php echo $reports['RCs']['debit'] ?></td>
												<td><?php echo $reports['RCs']['balance'] ?></td>
											</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
