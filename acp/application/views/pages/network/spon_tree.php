<div class="transactions p-5">

				<?php if (count($members) > 0) {
					?>
					<table class="table table-report -mt-2">
						<?php
						foreach ($members as $member) { ?>
							<tr class="intro-x">
								<td>
									<a href="<?php echo base_url("network/sponsored/" . $member['userid']); ?>"
									   class="intro-x" style="box-shadow: 0 1px 3px 0 rgb(0 0 0 / 9%);">
										<div class="detail">
											<div>
												<strong class="flex items-center">
													<?php echo $member['userid']; ?>
													- <?= $member['rank_name'] ?>
												</strong>
												<p>
													Date Join: <?php echo formatDate($member['join_date'], false); ?>
													Sponsored: <?php echo $member['sponsored']; ?>
												</p>
											</div>
										</div>
										<div class="right">
											<div class="price">
												<ion-icon name="chevron-forward-outline"></ion-icon>
											</div>
										</div>
									</a>
                                  	<br>
                                  <button class="btn btn-info btn-sm" onclick="get_sponsored(<?php echo $member['userid']; ?>)">[[CHECK_SPONSORED_TREE]]</button><br>
                                  <div class="view_<?php echo $member['userid']; ?>"></div>
								</td>
							</tr>
						<?php }
						?>
					</table>
					<?php
				} ?>
			</div>