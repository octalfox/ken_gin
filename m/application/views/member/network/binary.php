<?php $_SESSION['asset_file_name'] = "binary"; ?>
<div id="appCapsule binary_tree_x">
	<div class="section mt-150">
		<div class="card">
			<div class="card-body">
				<form class="search-form" method="post">
					<div class="form-group basic">
						<div class="input-wrapper">
							<input type="text" class="form-control" name="txtSearch" id="txtSearch"
								   value="<?php echo $txtSearch; ?>"
								   placeholder="[[ADM_SEARCH_MEMBER_TEXTFIELD]]">
						</div>
					</div>
					<div class="form-group basic">
						<div class="input-wrapper">
							<input type="submit" name="btnSearch" id="btnSearch" value="[[DEF_SEARCH]]"
								   class="btn btn-warning btn-lg btn-block"/>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div id="error-msg"></div>
		<div class="listview-title mt-1"></div>
		<div class="binary_fill_in">
			<div class="card" id="binary_card">
				<div class="card-body group-scroll" id="refreshGTB">
					<div class="groupTreegoup">
						<a href="javascript:goUp()" style="float:left">
							<ion-icon style="font-size: 25px" name="arrow-up-circle-outline"></ion-icon>
						</a>
					</div>
					<div class="group-tree-box">
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
