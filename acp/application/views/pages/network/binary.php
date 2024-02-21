<?php $_SESSION['asset_file_name'] = "binary"; ?>
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
	<h2 class="text-lg font-medium mr-auto">
		[[LABEL_BINARY_NETWORK]]
	</h2>
</div>
<div id="appCapsule binary_tree_x">
	<div class="section mt-2">
		<div class="card">
			<div class="card-body">
				<form class="search-form" method="post">
					<div class="form-group basic">
						<div class="input-wrapper">
							<input type="text" class="form-control" name="txtSearch" id="txtSearch"
								   value="<?php echo $txtSearch; ?>" placeholder="[[ADM_SEARCH_MEMBER_TEXTFIELD]]">
						</div>
					</div>
					<div class="form-group basic mt-2">
						<div class="w-full flex mt-4">
							<button type="submit" class="w-full btn btn-primary shadow-md mr-2">[[LABEL_SUBMIT]]
							</button>
						</div>
					</div>
				</form>
			</div>

			<div class="transactions mt-5">
				<span onclick="getUserDetails()"
					  class="clickable text-md px-1 rounded-md bg-primary text-white mr-1">
					[[CHECK_USER_DETAILS]]
				</span>
			</div>

		</div>
		<div class="listview-title mt-1"></div>
		<div class="groupTreegoup">
			<a href="javascript:goUp()" style="position: absolute; margin-top: 65px">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
					 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
					 stroke-linejoin="round" icon-name="corner-left-up" data-lucide="corner-left-up"
					 class="lucide lucide-corner-left-up block mx-auto">
					<polyline points="14 9 9 4 4 9"></polyline>
					<path d="M20 20h-7a4 4 0 01-4-4V4"></path>
				</svg>
			</a>
		</div>
		<div class="binary_fill_in">
			<div class="card">
				<div class="card-body group-scroll">
					<div id="refreshGTB">
						<div class="group-tree-box" id="binary_card">
							<div class="grid_class group-row-1" id="cell-1-1">
							</div>
							<div class="grid_class group-row-2" id="cell-2-1">
							</div>
							<div class="grid_class group-row-2" id="cell-2-2">
							</div>
							<?php for ($i = 1; $i <= 4; $i++) { ?>
								<div class="grid_class group-row-3" id="cell-3-<?php echo $i; ?>">
								</div>
							<?php } ?>
							<?php for ($i = 1;
							$i <= 8;
							$i++){ ?>
							<?php if ($i % 2 != 0){ ?>
							<div class="grid_class group-row-4-left" id="cell-4-<?php echo $i; ?>">
								<?php } else { ?>
								<div class="grid_class group-row-4-right" id="cell-4-<?php echo $i; ?>">
									<?php } ?>
								</div>
								<?php } ?>
								<?php for ($i = 1;
								$i <= 16;
								$i++){ ?>
								<?php if ($i % 2 == 0){ ?>
								<div class="grid_class group-row-5-left" id="cell-5-<?php echo $i; ?>">
									<?php } else { ?>
									<div class="grid_class group-row-5-right" id="cell-5-<?php echo $i; ?>">
										<?php } ?>
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
