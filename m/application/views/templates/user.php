<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>[[GINSENG]] - <?php echo isset($title) ? $title : "[[LABEL_WEBSITE_TITLE]]"; ?></title>
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="<?php echo assets_url("finapp/css/style.css"); ?>">
	<link rel="stylesheet" href="<?php echo assets_url("css/custom.css"); ?>">
	<meta name="viewport"
		  content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover"/>
	<meta name="description" content="Ginseng">
</head>
<body>
<?php $this->load->view('system/constants'); ?>
<div id="loader" style="display: none !important;">
	<img src="<?php echo assets_url("img/pre_loader.png"); ?>" alt="icon" class="loading-icon">
</div>
<?php if (isset($is_index) && $is_index) { ?>
	<?php $this->load->view('partials/sidebar'); ?>
<?php } ?>
<?php $this->load->view('partials/header'); ?>
<?php echo $view; ?>
<?php $this->load->view('partials/bottom'); ?>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js" integrity="sha512-CNgIRecGo7nphbeZ04Sc13ka07paqdeTu0WR1IM4kNcpmBAUSHSQX0FslNhTDadL4O5SAGapGt4FodqL8My0mA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="<?php echo assets_url("finapp/js/lib/bootstrap.bundle.min.js"); ?>"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="<?php echo assets_url("finapp/js/plugins/splide/splide.min.js"); ?>"></script>
<script src="<?php echo assets_url("finapp/js/base.js"); ?>"></script>
<script src="https://js.stripe.com/v3/"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="<?php echo assets_url("js/custom.js"); ?>"></script>
<script src="<?php echo assets_url("js/common.js"); ?>"></script>
<?php $this->load->view('partials/notify'); ?>
</body>
</html>
