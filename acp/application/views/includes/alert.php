<?php
if (isset($_SESSION['alert'])) {
	?>
	<div class="row">
		<div class="alert alert-<?php echo $_SESSION['alert']['class']; ?>">
			<?php echo $_SESSION['alert']['content']; ?>
		</div>
	</div>
	<?php
	unset($_SESSION['alert']);
}
?>
