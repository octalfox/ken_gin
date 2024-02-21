<?php
if (isset($_SESSION['userSession'])) {
	redirect("");
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
	<title><?php echo "[[GINSENG_ADMIN]]" ?> - [[LOGIN]]</title>
	<link rel="stylesheet" href="<?php echo assets_url("css/app.css") ?>" />
	<link rel="stylesheet" href="<?php echo assets_url("custom/app.css") ?>" />
	<link rel="stylesheet" href="<?php echo assets_url("custom/main.css") ?>"/>
</head>
<body class="login">
<?php echo $view; ?>
<?php $this->load->view("partials/language_switcher"); ?>
<script src="<?php echo assets_url("js/app.js") ?>"></script>
<script src="<?php echo assets_url("custom/main.js") ?>"></script>
</body>
</html>


