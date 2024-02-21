<?php
$notify_bg = isset($_SESSION['notify_message']['notify_bg']) ? $_SESSION['notify_message']['notify_bg'] : "";
$notify_title = isset($_SESSION['notify_message']['notify_title']) ? $_SESSION['notify_message']['notify_title'] : "";
$notify_time = isset($_SESSION['notify_message']['notify_time']) ? $_SESSION['notify_message']['notify_time'] : "";
$notify_subtitle = isset($_SESSION['notify_message']['notify_subtitle']) ? $_SESSION['notify_message']['notify_subtitle'] : "";
$notify_summary = isset($_SESSION['notify_message']['notify_summary']) ? $_SESSION['notify_message']['notify_summary'] : "";
?>
<div class="notify_ajax notification-box">
	<div class="notification-dialog ios-style notify_bg <?php echo $notify_bg; ?>">
		<div class="notification-header">
			<div class="in">
				<strong class="notify_title"><?php echo $notify_title; ?></strong>
			</div>
			<div class="right">
				<span class="notify_time text-white"><?php echo $notify_time; ?></span>
				<a href="#" class="close-button" onclick="hide_notification()">
					<ion-icon name="close-circle" role="img" class="md hydrated" aria-label="close circle"></ion-icon>
				</a>
			</div>
		</div>
		<div class="notification-content">
			<div class="in">
				<h3 class="subtitle notify_subtitle"><?php echo $notify_subtitle; ?></h3>
				<div class="text notify_summary"><?php echo $notify_summary; ?></div>
			</div>
		</div>
	</div>
</div>
<?php
if (isset($_SESSION['asset_file_name']) and $_SESSION['asset_file_name'] != null) {
	?>
	<script src="<?php echo assets_url("js/" . $_SESSION['asset_file_name'] . ".js"); ?>"></script>
	<?php
	unset($_SESSION['asset_file_name']);
}
if (isset($_SESSION['notify_message']['notify_bg'])) {
	?>
	<script>
		$(document).ready(function () {
			trigger_notification();
		});
	</script>
	<?php
	$_SESSION['notify_message'] = null;
}
?>
