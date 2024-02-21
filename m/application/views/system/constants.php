<script>
	<?php
	foreach ($_SESSION['constants'] as $cons => $val) {
		if ($cons != "CURR_RATES") {
			echo "var $cons = '$val';";
		}
	}
	echo "var LANGUAGE = '" . $_SESSION['language'] . "';
";?>
	var API_URL = "<?php echo api_url(); ?>";
	var BASE_URL = "<?php echo base_url(); ?>";
	var TOKEN = "<?php echo $_SESSION['userSession'];?>";
	var LABEL_ACCUMULATED = "[[LABEL_ACCUMULATED]]";
	var LABEL_TODAY_ADDITION = "[[LABEL_TODAY_ADDITION]]";
	var LABEL_TODAY_MATCHING = "[[LABEL_TODAY_MATCHING]]";
	var LABEL_TODAY_BALANCE = "[[LABEL_TODAY_BALANCE]]";
</script>
