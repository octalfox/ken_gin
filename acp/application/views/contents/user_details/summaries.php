<div class="accordion-item">
	<div id="faq-accordion-content-2" class="accordion-header">
		<button class="accordion-button collapsed" type="button" data-tw-toggle="collapse"
				data-tw-target="#faq-accordion-collapse-2" aria-expanded="false"
				aria-controls="faq-accordion-collapse-2">
			[[SUMMARIES]]
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
							<div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
								<h2 class="font-medium text-base mr-auto">
									LABEL_REPORT
								</h2>
								<div class="dropdown ml-auto">
									<div class="dropdown-menu w-40"></div>
								</div>
							</div>
							<div class="p-5">
								<div class="tab-content">
									<div id="latest-tasks-new" class="tab-pane active" role="tabpanel"
										 aria-labelledby="latest-tasks-new-tab">
										<ul class="nav nav-tabs" role="tablist">
											<li id="example-1-tab" class="nav-item flex-1" role="presentation">
												<button class="nav-link w-full py-2 active"
														data-tw-toggle="pill"
														data-tw-target="#example-tab-1" type="button" role="tab"
														aria-controls="example-tab-1" aria-selected="true">
													<?= $reports['title_1'][0] ?>
												</button>
											</li>
											<li id="example-2-tab" class="nav-item flex-1" role="presentation">
												<button class="nav-link w-full py-2" data-tw-toggle="pill"
														data-tw-target="#example-tab-2" type="button" role="tab"
														aria-controls="example-tab-2" aria-selected="false">
													<?= $reports['title_2'][0] ?>
												</button>
											</li>
										</ul>
										<div class="tab-content border-l border-r border-b">
											<div id="example-tab-1" class="tab-pane leading-relaxed p-5 active"
												 role="tabpanel"
												 aria-labelledby="example-1-tab">
												<h4 class="text-center"><?= $reports['title_1'][1] ?></h4>
												<br>
												<div class="sponsor table-responsive">
													<table style="width: 100%"
														   class="table table-sm table-striped">
														<tbody>
														<?php foreach ($reports['summary'] as $key => $val) { ?>
															<tr>
																<td>[[<?php echo $key ?>]]</td>
																<td><?php echo $val ?></td>
															</tr>
														<?php } ?>
														</tbody>
													</table>
												</div>
											</div>
											<div id="example-tab-2" class="tab-pane leading-relaxed p-5"
												 role="tabpanel"
												 aria-labelledby="example-2-tab">
												<h4 class="text-center"><?= $reports['title_2'][1] ?></h4>
												<br>
												<div class="sponsor table-responsive">
													<table style="width: 100%"
														   class="table table-sm table-striped">
														<tbody>
														<?php foreach ($reports['career'] as $key => $val) { ?>
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

