<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Ginseng</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover"/>
	<meta name="description" content="Ginseng">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo assets_url("css/custom.css"); ?>">
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="<?php echo assets_url("finapp/css/style.css"); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo assets_url("login/style/style.css"); ?>">
</head>
<body style="background-color: black">
<div id="loader">
	<img src="<?php echo assets_url("img/logo_member.png"); ?>" alt="icon" class="loading-icon">
</div>
<?php echo $view; ?>
<script src="<?php echo assets_url("js/lib/bootstrap.bundle.min.js"); ?>"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="<?php echo assets_url("js/plugins/splide/splide.min.js"); ?>"></script>
<script src="<?php echo assets_url("js/base.js"); ?>"></script>
<script src="<?php echo assets_url("js/custom.js"); ?>"></script>
<script src="<?php echo assets_url("js/common.js"); ?>"></script>
<?php $this->load->view('partials/notify'); ?>
</body>
</html>
