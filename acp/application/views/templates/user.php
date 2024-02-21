<?php
if (!isset($_SESSION['userSession'])) {
	redirect("login");
}
?>
<!DOCTYPE html>
<!--
Author: TitaHaze
Website: http://www.titanhaze.com/
Contact: info@titanhaze.com
-->
<html lang="en" class="light">
<head>
	<meta charset="utf-8">
	<link href="<?php echo assets_url("images/logo.svg") ?>" rel="shortcut icon">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo "[[GINSENG_ADMIN]]" ?></title>
	<link rel="stylesheet" href="<?php echo assets_url("dt/datatables.min.css") ?>"/>
	<link rel="stylesheet" href="<?php echo assets_url("css/app.css") ?>"/>
	<link rel="stylesheet" href="<?php echo assets_url("custom/main.css") ?>"/>
</head>
<body class="py-5">
<?php $this->load->view('system/constants'); ?>
<div class="mobile-menu md:hidden">
	<div class="mobile-menu-bar">
		<a href="" class="flex mr-auto">
			<span class="text-white text-lg ml-3"> <?php echo ProjectName ?> </span>
		</a>
		<a href="javascript:;" class="mobile-menu-toggler">
			<i data-lucide="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i>
		</a>
	</div>
	<div class="scrollable">
		<a href="javascript:;" class="mobile-menu-toggler">
			<i data-lucide="x-circle" class="w-8 h-8 text-white transform -rotate-90"></i>
		</a>
		<?php $this->load->view("partials/mobile_sidebar"); ?>
	</div>
</div>
<!-- END: Mobile Menu -->
<div class="flex mt-[4.7rem] md:mt-0">
	<!-- BEGIN: Side Menu -->
	<nav class="side-nav">
		<a href="" class="intro-x flex items-center pl-5 pt-4">
			<span class="hidden xl:block text-white text-lg ml-3"> <?php echo ProjectName; ?> </span>
		</a>
		<div class="side-nav__devider my-6"></div>
		<?php $this->load->view("partials/sidebar"); ?>
	</nav>
	<div class="content">
		<?php $this->load->view("partials/topbar"); ?>
		<?php echo $view; ?>
	</div>
</div>
<div id="render_data"></div>
<?php $this->load->view("partials/language_switcher"); ?>
<script src="<?php echo assets_url("js/app.js") ?>"></script>
<script src="<?php echo assets_url("js/ckeditor-classic.js") ?>"></script>
<script src="<?php echo assets_url("js/jquery.js") ?>"></script>
<script src="<?php echo assets_url("dt/datatables.min.js") ?>"></script>
<script src="<?php echo assets_url("custom/main.js") ?>"></script>
<script>
	$(document).ready(function () {
		$('#dataTable').DataTable();
	});
</script>
<script src="<?php echo assets_url("js/jqueryui.js") ?>"></script>
<?php
if (isset($_SESSION['asset_file_name']) and $_SESSION['asset_file_name'] != null) {
	?>
	<script src="<?php echo assets_url("js/" . $_SESSION['asset_file_name'] . ".js"); ?>"></script>
	<?php
	unset($_SESSION['asset_file_name']);
}
?>
</body>
</html>


