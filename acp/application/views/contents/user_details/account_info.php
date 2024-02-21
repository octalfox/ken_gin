<div class="accordion-item">
	<div id="faq-accordion-content-3" class="accordion-header">
		<button class="accordion-button collapsed" type="button" data-tw-toggle="collapse"
				data-tw-target="#faq-accordion-collapse-3" aria-expanded="false"
				aria-controls="faq-accordion-collapse-3">
			[[ACCOUNT_INFO]]
		</button>
	</div>
	<div id="faq-accordion-collapse-3" class="accordion-collapse collapse"
		 aria-labelledby="faq-accordion-content-3"
		 data-tw-parent="#faq-accordion-1">
		<div class="accordion-body text-slate-600 dark:text-slate-500 leading-relaxed">
			<div class="intro-y tab-content mt-2.5">
				<div class="tab-pane active" role="tabpanel" aria-labelledby="dashboard-tab">
					<div class="grid grid-cols-12 gap-12">
						<div class="intro-y box col-span-12 lg:col-span-12">
							<div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
								<h2 class="font-medium text-base mr-auto">
									[[MAIN_SUB_ACCOUNTS]]
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
											<li id="example-11-tab" class="nav-item flex-1" role="presentation">
												<button class="nav-link w-full py-2 active"
														data-tw-toggle="pill"
														data-tw-target="#example-tab-11" type="button"
														role="tab"
														aria-controls="example-tab-11" aria-selected="true">
													[[MAIN_ACCOUNT]]
												</button>
											</li>
											<li id="example-12-tab" class="nav-item flex-1" role="presentation">
												<button class="nav-link w-full py-2" data-tw-toggle="pill"
														data-tw-target="#example-tab-12" type="button"
														role="tab"
														aria-controls="example-tab-12" aria-selected="false">
													[[SUB_ACCOUNTS]]
												</button>
											</li>
										</ul>
										<div class="tab-content border-l border-r border-b">
											<div id="example-tab-11" class="tab-pane leading-relaxed p-5 active"
												 role="tabpanel"
												 aria-labelledby="example-11-tab">
												<table class="table">
													<tr>
														<th>[[USERID]]</th>
														<td>
															<span onclick="getUserDetails(<?php echo $reports['MAIN_ACCOUNT']['userid'] ?>)"
																  class="clickable text-xs px-1 rounded-md bg-primary text-white mr-1">
																<?php echo $reports['MAIN_ACCOUNT']['userid']; ?>
															</span>
														</td>
													</tr>
													<tr>
														<th>[[FIRST_NAME]]</th>
														<td><?php echo $reports['MAIN_ACCOUNT']['f_name']; ?></td>
													</tr>
													<tr>
														<th>[[LAST_NAME]]</th>
														<td><?php echo $reports['MAIN_ACCOUNT']['l_name']; ?></td>
													</tr>
													<tr>
														<th>[[EMAIL]]</th>
														<td><?php echo $reports['MAIN_ACCOUNT']['email']; ?></td>
													</tr>
													<tr>
														<th>[[MOBILE]]</th>
														<th><?php echo $reports['MAIN_ACCOUNT']['mobile']; ?></th>
													</tr>
												</table>
											</div>
											<div id="example-tab-12" class="tab-pane leading-relaxed p-5"
												 role="tabpanel" aria-labelledby="example-12-tab">
												<h4 class="text-center">[[CLICK_TO_VIEW_DETAIL]]</h4>
												<?php foreach ($reports['SUB_ACCOUNTS'] as $subacc) {
													?>
													<span onclick="getUserDetails(<?php echo $subacc['userid'] ?>)"
														  class="clickable text-xs px-1 rounded-md bg-primary text-white mr-1">
																	<?php echo $subacc['userid']; ?>
																</span>
													<?php
												} ?>
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
