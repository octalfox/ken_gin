<div id="appCapsule">
	<div class="section mt-2">
		<div class="card">
			<div class="card-body">
				<form name="frmSearch" method="post" class="form-horizontal">
					<div class="form-group basic">
						<div class="input-wrapper">
							<input type="text" name="txtSearch" id="txtSearch"
								   value="<?php echo isset($txtSearch) ? $txtSearch : ''; ?>"
								   class="form-control"
								   placeholder="[[LABEL_USERID_USERNAME]]"/>
						</div>
					</div>
					<div class="form-group basic">
						<div class="input-wrapper">
							<input type="submit" name="btnSearch" id="btnSearch" value="[[DEF_SEARCH]]"
								   class="btn btn-lg btn-warning btn-block"/>
						</div>
					</div>
				</form>
			</div>

			<div class="transactions mt-2" style="padding-left: 16px; padding-right: 16px; ">
				<?php if (count($members) > 0) {
					foreach ($members as $member) { ?>
						<a href="<?php echo base_url("network/sponsored/".$member['userid']); ?>" class="item"
						   style="box-shadow: 0 1px 3px 0 rgb(0 0 0 / 9%);">
							<div class="detail">
								<div>
									<strong><?php echo $member['userid']; ?> - <?= $member['rank_name'] ?></strong>
									<p>Date Join: <?php echo formatDate($member['join_date'], false); ?>
										Sponsored: <?php echo $member['sponsored']; ?></p>
								</div>
							</div>
							<div class="right">
								<div class="price">
									<ion-icon name="chevron-forward-outline"></ion-icon>
								</div>
							</div>
						</a>
					<?php }
				} ?>
			</div>
		</div>
	</div>
</div>
