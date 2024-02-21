<?php
$loop = $counter / $per_page;
$last = ceil($loop);
$started = ($page - 3) < 1? 1 : $page - 3;
$ended = ($page + 3) > $last? $last : $page + 3;
if($page > $last and $_GET['page'] != 1){
	redirect($link. $query . "page=1");
	exit;
}
?>
<?php if($loop > 1){ ?>
<table class="pagination_table float-right mt-10">
	<tr>
		<td>
			<a href="<?php echo base_url($link . $query . "page=1") ?>" class="btn btn-sm <?php echo 1 == $page? "btn-primary" : "btn-info"; ?> ml-1">
				[[First]]
			</a>
		</td>
		<?php if($started > 1){ ?>
			<td>
				<a href="javascript:;" class="btn btn-sm btn-info ml-1">
					---
				</a>
			</td>
		<?php } ?>
		<?php for ($i = $started; $i <= $ended; $i++) { ?>
			<td>
				<a href="<?php echo base_url($link . $query . "page=" . $i) ?>" class="btn btn-sm <?php echo $i == $page? "btn-primary" : "btn-info"; ?> ml-1">
					<?php echo $i; ?>
				</a>
			</td>
		<?php } ?>
		<?php if($ended < $last){ ?>
			<td>
				<a href="javascript:;" class="btn btn-sm btn-info ml-1">
					---
				</a>
			</td>
		<?php } ?>
		<td>
			<a href="<?php echo base_url($link . $query. "page=" . $last) ?>" class="btn btn-sm <?php echo $last == $page? "btn-primary" : "btn-info"; ?> ml-1">
				[[Last]]
			</a>
		</td>
	</tr>
</table>
<?php } ?>
