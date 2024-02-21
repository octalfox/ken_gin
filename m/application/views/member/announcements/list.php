<div id="appCapsule">
	<div class="section mt-2">
		<div class="card">
			<div class="card-body">
				<div class="transactions mt-2" id="table_data">
					<?php foreach ($reports as $report) { ?>
						<a href="<?php echo base_url("announcements/get/" . $report['id']); ?>" class="item news_item">
							<div class="detail">
								<div>
									<p style="color: gray"><?php echo $report['date_created'] ?></p>
									<strong><?php echo $report['title'] ?></strong>
								</div>
							</div>
							<div class="right">
								<div class="price">
									<ion-icon name="chevron-forward-outline"></ion-icon>
								</div>
							</div>
						</a>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>
