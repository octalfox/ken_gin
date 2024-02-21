<?php if(isset($is_index) && $is_index){ ?>
	<div class="appHeader bg-primary text-light">
		<div class="left">
			<a href="#" class="headerButton text-black" data-bs-toggle="modal" data-bs-target="#sidebarPanel">
				<ion-icon name="menu-outline"></ion-icon>
			</a>
		</div>
		<div class="right">
			<a href="<?php echo base_url("cart"); ?>" class="headerButton text-black">
				<ion-icon class="icon" name="cart-outline"></ion-icon>
			</a>
			<a href="<?php echo base_url("announcements"); ?>" class="headerButton text-black">
				<ion-icon class="icon" name="notifications-outline"></ion-icon>
			</a>
			<a href="#" class="headerButton text-black" data-bs-toggle="modal" data-bs-target="#switchActionSheet">
				<ion-icon class="icon" name="person-circle-outline"></ion-icon>
			</a>
		</div>
	</div>
<?php } else { ?>
	<div class="appHeader">
		<div class="left">
			<?php if(isset($header_back_url)){ ?>
			<a href="<?php echo base_url($header_back_url); ?>" class="headerButton">
				<?php }else{ ?>
				<a href="<?php echo base_url('home'); ?>" class="headerButton">
					<?php } ?>
					<ion-icon name="chevron-back-outline" style="color: black !important;"></ion-icon>
				</a>
		</div>
		<div class="pageTitle">
			<?php echo isset($title)?$title:"";?>
		</div>
	</div>
<?php } ?>
