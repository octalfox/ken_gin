
<div class="accordion-item">
	<div id="faq-accordion-content-2" class="accordion-header">
		<button class="accordion-button collapsed" type="button" data-tw-toggle="collapse"
				data-tw-target="#faq-accordion-collapse-2" aria-expanded="false"
				aria-controls="faq-accordion-collapse-2">
			[[BANK_DETAILS]]
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
										<?php foreach ($banks as $bank) { ?>
											<div class="flex items-center">
												<div class="border-l-2 border-primary dark:border-primary pl-4">
													<div class="text-slate-500">
														[[BANK_NAME]]: <?php echo $bank['bank_name'] ?></a>
														<div class="text-slate-500">
															[[ACCOUNT_NAME]]: <?php echo $bank['account_name'] ?></div>
														<div class="text-slate-500">
															[[ACCOUNT_NUMBER]]: <?php echo $bank['account_number'] ?></div>
														<div class="text-slate-500">
															<strong>[[BRANCH]]: </strong><?php echo $bank['branch'] ?>
														</div>
													</div>
												</div>
											</div>
										<?php } ?>
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
