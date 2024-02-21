<div id="appCapsule">
	<div class="listview-title mt-1"></div>
	<ul class="listview image-listview inset">
		<?php if ($_SESSION['logged']['main_acct_id'] == 0) { ?>
			<li>
				<a href="<?php echo base_url("settings/profile") ?>" class="item">
					<div class="icon-box">
						<ion-icon name="person-outline"></ion-icon>
					</div>
					<div class="in">
						[[LABEL_MY_ACCOUNT]]
					</div>
				</a>
			</li>
			<li>
				<a href="<?php echo base_url("settings/banks") ?>" class="item">
					<div class="icon-box">
						<ion-icon name="home-outline"></ion-icon>
					</div>
					<div class="in">
						[[DEF_BANK_DETAILS]]
					</div>
				</a>
			</li>
			<li>
				<a href="<?php echo base_url("reset/primary_password") ?>" class="item">
					<div class="icon-box">
						<ion-icon name="key-outline"></ion-icon>
					</div>
					<div class="in">
						[[LABEL_PRIMARY_PASSWORD]]
					</div>
				</a>
			</li>
			<li>
				<a href="<?php echo base_url("reset/secondary_password") ?>" class="item">
					<div class="icon-box">
						<ion-icon name="key-outline"></ion-icon>
					</div>
					<div class="in">
						[[LABEL_SECONDARY_PASSWORD]]
					</div>
				</a>
			</li>
		<?php } ?>
		<li>
			<a href="<?php echo base_url("settings/share") ?>" class="item">
				<div class="icon-box">
					<ion-icon name="key-outline"></ion-icon>
				</div>
				<div class="in">
					<div>[[LABEL_SHARE]]</div>
				</div>
			</a>
		</li>
		<li>
			<a href="<?php echo base_url("settings/binary") ?>" class="item">
				<div class="icon-box">
					<ion-icon name="key-outline"></ion-icon>
				</div>
				<div class="in">
					<div>[[COM_BINARY_SETTING]]</div>
				</div>
			</a>
		</li>
		<li>
			<a target="_blank" href="https://wa.me/6586912749" class="item">
				<div class="icon-box">
					<ion-icon name="chatbubbles-outline"></ion-icon>
				</div>
				<div class="in">
					[[MBR_NAVI_HELPDESK]]
				</div>
			</a>
		</li>
		<li>
			<a href="#" data-bs-toggle="modal" data-bs-target="#switchLangaugeSheet" class="item">
				<div class="icon-box">
					<ion-icon name="language-outline"></ion-icon>
				</div>
				<div class="in">
					[[LABEL_SEL_LANGUAGE]]
				</div>
			</a>
		</li>
	</ul>

	<div class="modal fade action-sheet" id="switchLangaugeSheet" tabindex="-1" role="dialog">
		<div class="modal-dialog mb-1" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">[[LABEL_SEL_LANGUAGE]]</h5>
				</div>
				<div class="modal-body">
					<div class="action-sheet-content">
						<ul class="listview image-listview text inset">
							<li>
								<a href="<?php echo base_url("language/change/en") ?>">
									<div class="in">
										<div>English</div>
									</div>
								</a>
								<ion-icon name="chevron-forward-outline"></ion-icon>
							</li>
							<li>
								<a href="<?php echo base_url("language/change/si_cn") ?>">
									<div class="in">
										<div>简体中文</div>
									</div>
								</a>
								<ion-icon name="chevron-forward-outline"></ion-icon>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
