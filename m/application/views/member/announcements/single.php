<?php
if ($_SESSION['language'] == 'en') {
	$title = $report['title'];
	$contents = $report['contents'];
} elseif ($_SESSION['language'] == 'si_cn') {
	$title = $report['title_si_cn'];
	$contents = $report['contents_si_cn'];
} elseif ($_SESSION['language'] == 'my') {
	$title = $report['title_my'];
	$contents = $report['contents_my'];
}
?>
<div id="appCapsule">
	<div class="listview-title mt-1"></div>
	<div class="card p-1 m-2">
		<div class="card-body">
			<div style="text-align:right;">
				<h6 id="date_created">
					<?php echo $report['date_created']; ?>
				</h6>
			</div>
			<h1 id="news_title"><?php echo $title; ?></h1>
			<div id="news_content">
				<?php echo html_entity_decode($contents); ?>
			</div>
			<div id="file_content">
				<?php
				$file = $report['file_content'];

				if ($file != '') {
//					if (substr($file, -3) != 'pdf') {
/*						echo '<img style="max-width:100%" src="<?php echo BASE_URL;?>public/announcement/' . $file . '">';*/
//					} else {
/*						echo '<object style="height: 700px;" data="<?php echo BASE_URL;?>public/announcement/' .$file. '>" type="application/pdf" width="100%" height="100%">';*/
/*						echo '<p>It appears you don\'t have a PDF plugin for this browser. No biggie... you can <a href="<?php echo BASE_URL;?>pub/view_pdf/announcement/' + file + '">click here to download the PDF file.</a></p>';*/
//						echo '</object>';
//					}
				}
				?>
			</div>
		</div>
	</div>
</div>
