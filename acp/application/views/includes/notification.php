<?php
$notify_bg = isset($_SESSION['notify_message']['notify_bg']) ? $_SESSION['notify_message']['notify_bg'] : "";
$notify_title = isset($_SESSION['notify_message']['notify_title']) ? $_SESSION['notify_message']['notify_title'] : "";
$notify_time = isset($_SESSION['notify_message']['notify_time']) ? $_SESSION['notify_message']['notify_time'] : "";
$notify_subtitle = isset($_SESSION['notify_message']['notify_subtitle']) ? $_SESSION['notify_message']['notify_subtitle'] . "<br>" : "";
$notify_summary = isset($_SESSION['notify_message']['notify_summary']) ? $_SESSION['notify_message']['notify_summary'] : "";
?>
<div id="notification_body" class="toastify-content hidden flex">
	<i data-lucide="hard-drive"></i>
	<div class="ml-4 mr-4">
		<div class="font-medium notification_title">
			<?php echo $notify_title; ?>
			<br>
			<small><?php echo $notify_time; ?></small>
		</div>
		<div class="text-slate-500 mt-1 notification_content">
			<?php echo $notify_subtitle; ?>
			<?php echo $notify_summary; ?>
		</div>
	</div>
</div>
