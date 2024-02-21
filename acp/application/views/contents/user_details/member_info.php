<div class="accordion-item">
	<div id="faq-accordion-content-1" class="accordion-header">
		<button class="accordion-button" type="button" data-tw-toggle="collapse"
				data-tw-target="#faq-accordion-collapse-1" aria-expanded="true"
				aria-controls="faq-accordion-collapse-1">
			[[MEMBER_INFO]]
		</button>
	</div>
	<div id="faq-accordion-collapse-1" class="accordion-collapse collapse show"
		 aria-labelledby="faq-accordion-content-1" data-tw-parent="#faq-accordion-1">
		<div class="accordion-body text-slate-600 dark:text-slate-500 leading-relaxed">
			<div class="intro-y box px-5">
				<div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
					<h2 class="font-medium text-base mr-auto">
						<?php echo $member_detail['userid'] ?> -
						<small><i>(<?php echo $member_detail['f_name'] ?> <?php echo $member_detail['l_name'] ?>
								)</i></small>
					</h2>
					<div class="dropdown ml-auto">
						<div class="dropdown-menu w-40"></div>
					</div>
				</div>
				<div class="flex flex-col lg:flex-row border-b border-slate-200/60 dark:border-darkmode-400 pb-5 -mx-5">
					<div class="mt-6 lg:mt-0 flex-1 px-5 border-l border-r border-slate-200/60 dark:border-darkmode-400 border-t lg:border-t-0 pt-5 lg:pt-0">
						<div class="font-medium text-center lg:text-left lg:mt-3">Network Details</div>
						<div class="mr-2 row">
							<table>
								<tr>
									<td class="truncate sm:whitespace-normal">
										[[SPONSOR]]
									</td>
									<td class="truncate sm:whitespace-normal">
												<span class="ml-3 font-medium text-slate-500">
													<?php
													if (empty($member_detail['sponsor_name'])) {
														echo "N/A";
													} else {
														?>
														<span onclick="getUserDetails(<?php echo $member_detail['sponsor_name'] ?>)"
															  class="clickable text-xs px-1 rounded-md bg-primary text-white mr-1">
															<?php echo $member_detail['sponsor_name']; ?>
														</span>
														<?php
													}
													?>
												</span>
									</td>
								</tr>
								<tr>
									<td class="truncate sm:whitespace-normal">
										[[PLACEMENT]]
									</td>
									<td class="truncate sm:whitespace-normal">
												<span class="ml-3 font-medium text-slate-500">
													<?php
													if (empty($member_detail['matrix_name'])) {
														echo "N/A";
													} else {
														?>
														<span onclick="getUserDetails(<?php echo $member_detail['matrix_name'] ?>)"
															  class="clickable text-xs px-1 rounded-md bg-primary text-white mr-1">
															<?php echo $member_detail['matrix_name']; ?>
														</span>
														<?php
													}
													?>
												</span>
									</td>
								</tr>
								<tr>
									<td class="truncate sm:whitespace-normal">
										[[RANK]]
									</td>
									<td class="truncate sm:whitespace-normal">
										<span class="ml-3 font-medium text-slate-500"><?php echo $member_detail['rank_name'] ?></span>
									</td>
								</tr>
							</table>
						</div>
					</div>
					<div class="mt-6 lg:mt-0 flex-1 px-5 border-l border-r border-slate-200/60 dark:border-darkmode-400 border-t lg:border-t-0 pt-5 lg:pt-0">
						<div class="font-medium text-center lg:text-left lg:mt-3">Contact Details</div>
						<div class="flex flex-col justify-center items-center lg:items-start mt-4">
							<div class="truncate sm:whitespace-normal flex items-center">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
									 viewBox="0 0 24 24" fill="none"
									 stroke="currentColor" stroke-width="2" stroke-linecap="round"
									 stroke-linejoin="round"
									 icon-name="mail" data-lucide="mail"
									 class="lucide lucide-mail w-4 h-4 mr-2">
									<path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
									<polyline points="22,6 12,13 2,6"></polyline>
								</svg>
								<?php echo $member_detail['email'] ?>
							</div>
							<div class="truncate sm:whitespace-normal flex items-center mt-3">
								<svg xmlns="http://www.w3.org/2000/svg" width="14" height="15"
									 viewBox="0 0 24 24" fill="none"
									 stroke="currentColor" stroke-width="2" stroke-linecap="round"
									 stroke-linejoin="round"
									 icon-name="phone" data-lucide="phone"
									 class="lucide lucide-phone w-4 h-4 mr-2 block mx-auto">
									<path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"></path>
								</svg>
								<?php echo $member_detail['mobile'] ?>
							</div>
						</div>
					</div>
					<div class="mt-6 lg:mt-0 flex-1 px-5 border-l border-r border-slate-200/60 dark:border-darkmode-400 border-t lg:border-t-0 pt-5 lg:pt-0">
						<div class="font-medium text-center lg:text-left lg:mt-3">[[SALES_STATS]]</div>
						<div class="flex items-center justify-center lg:justify-start mt-2">
							<div class="mr-2 row">
								<table>
									<tr>
										<td class="truncate sm:whitespace-normal">
											[[ACCU_GROUP_SALES]]
										</td>
										<td class="truncate sm:whitespace-normal">
											<span class="ml-3 font-medium text-slate-500"><?php echo $member_detail['accu_group_sales'] ?></span>
										</td>
									</tr>
									<tr>
										<td class="truncate sm:whitespace-normal">
											[[ACCU_PERSONAL_SALES]]
										</td>
										<td class="truncate sm:whitespace-normal">
											<span class="ml-3 font-medium text-slate-500"><?php echo $member_detail['accu_personal_sales'] ?></span>
										</td>
									</tr>
									<tr>
										<td class="truncate sm:whitespace-normal">
											[[ACCU_DIRECT_SALES]]
										</td>
										<td class="truncate sm:whitespace-normal">
											<span class="ml-3 font-medium text-slate-500"><?php echo $member_detail['accu_direct_sales'] ?></span>
										</td>
									</tr>
									<tr>
										<td class="truncate sm:whitespace-normal">
											[[PACKAGE_NAME]]
										</td>
										<td class="truncate sm:whitespace-normal">
											<span class="ml-3 font-medium text-slate-500"><?php echo $member_detail['package_name'] ?></span>
										</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
