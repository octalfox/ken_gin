<div class="nav-item dropdown" style="list-style: none; background: white; border-radius: 30px">
	<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
	   aria-haspopup="true" aria-expanded="false">

		<?php if ($_SESSION['language'] == 'en') { ?>
			<img class="lng-img mr-1" style="display: inline-block !important;"
				 src="<?php echo assets_url("login/image/gb.png"); ?>" alt="lng-image">
			<span class="m-0" style="display: inline-block !important;">[[LABEL_LANG_ENGLISH]]</span>
		<?php } else { ?>
			<img class="lng-img mr-1" style="display: inline-block !important;"
				 src="<?php echo assets_url("login/image/cn.png"); ?>" alt="lng-image">
			<span class="m-0" style="display: inline-block !important;">[[LABEL_LANG_CHINESE]]</span>
		<?php } ?>
	</a>
	<div class="dropdown-menu">
		<a class="dropdown-item" href="<?php echo base_url("language/change/en") ?>">
			<img class="lng-img mr-1" style="display: inline-block !important;"
				 src="<?php echo assets_url("login/image/gb.png"); ?>" alt="lng-image">
			<p class="m-0" style="display: inline-block !important;">
				[[LABEL_LANG_ENGLISH]]</p>
		</a>
		<a class="dropdown-item" href="<?php echo base_url("language/change/si_cn") ?>">
			<img class="lng-img mr-1" style="display: inline-block !important;"
				 src="<?php echo assets_url("login/image/cn.png"); ?>" alt="lng-image">
			<p class="m-0" style="display: inline-block !important;">
				[[LABEL_LANG_CHINESE]]</p>
		</a>
	</div>
</div>
