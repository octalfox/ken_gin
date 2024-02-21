<div class="appBottomMenu">
	<?php if (isset($is_index) && $is_index){ ?>
	<a href="<?php echo base_url("home"); ?>" class="item active">
		<?php }else{ ?>
		<a href="<?php echo base_url("home"); ?>" class="item">
			<?php } ?>
			<div class="col">
				<ion-icon name="pie-chart-outline"></ion-icon>
				<strong>[[LABEL_OVERVIEW]]</strong>
			</div>
		</a>
		<?php if (isset($is_genology) && $is_genology){ ?>
		<a class="item active" href="<?php echo base_url("network"); ?>">
			<?php }else{ ?>
			<a class="item" href="<?php echo base_url("network"); ?>">
				<?php } ?>
				<div class="col">
					<ion-icon name="people-outline"></ion-icon>
					<strong>[[LABEL_MY_TEAM]]</strong>
				</div>
			</a>
			<a class="item" href="#">
				<div class="col">
					<div class="action-button large">
						<img src="<?php echo assets_url("img/logo_member.png"); ?>" width="30px" height="30px"
							 alt="logo" class="logo">
					</div>
				</div>
			</a>
			<?php if (isset($is_withdraw) && $is_withdraw){ ?>
			<a href="<?php echo base_url("products"); ?>" class="item active">
				<?php }else{ ?>
				<a href="<?php echo base_url("products"); ?>" class="item">
					<?php } ?>
					<div class="col">
						<ion-icon name="cart-outline"></ion-icon>
						<strong>[[LABEL_STORE]]</strong>
					</div>
				</a>
				<?php if (isset($is_setting) && $is_setting){ ?>
				<a href="<?php echo base_url("settings"); ?>" class="item active">
					<?php }else{ ?>
					<a href="<?php echo base_url("settings"); ?>" class="item">
						<?php } ?>
						<div class="col">
							<ion-icon name="settings-outline"></ion-icon>
							<strong>[[LABEL_SETTINGS]]</strong>
						</div>
					</a>
				</a>
			</a>
		</a>
	</a>
</div>
