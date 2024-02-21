<div class="flex flex-col sm:flex-row items-center p-5 border-b">
	<h2 class="font-medium text-base mr-auto">
		[[LABEL_STAR_REPORT]]
	</h2>
</div>
<div class="intro-y box mt-5">
	<div class="p-10 overflow-auto">
		<form class="search-form" method="get">
			<div class="form-group">
				<input type="text" class="form-control" name="userid" id="userid" value="<?php echo $userid; ?>" placeholder="[[ADM_SEARCH_MEMBER_TEXTFIELD]]">
			</div>
			<div class="form-group">
				<select name="period" id="period" class="form-control">
					<?php
					$the_month = '2019-08';
					$this_month = date('Y-m');
					$next_month = date("Y-m", strtotime("+1 month", strtotime(date("Y-m-d"))));
					while ($the_month <= $this_month) {
						$selected = $the_month == $period ? ' selected="selected"' : '';
						?>
						<option value="<?php echo $the_month ?>" <?php echo $selected; ?>><?php echo date('M Y', strtotime($the_month . "-01")); ?></option>
						<?php $the_month = date("Y-m", strtotime("+1 month", strtotime($the_month)));
					} ?>
				</select>
			</div>
			<div class="form-group">
				<select name="fl_rank" id="fl_rank" class="form-control">
					<option <?php echo $fl_rank == 'any' ? 'selected' : '' ?> value="any">Star Members
						Only
					</option>
					<option <?php echo $fl_rank == 'all' ? 'selected' : '' ?> value="all">All Members
					</option>
				</select>
			</div>
			<div class="mt-2">
				<div class="w-full mt-4">
					<button type="submit" class="w-full btn btn-primary shadow-md mr-2">[[GET_REPORT]]
					</button>
				</div>
			</div>
		</form>
	</div>
	<div class="p-5 px-10 overflow-auto">
		<a target="_blank" href="<?php  echo api_url("admin/export/star$query"); ?>" class="btn btn-primary float-right">
			[[EXPORT_REPORT_COUNT]]: <?php echo $counter; ?>
		</a>
	</div>
	<div class="px-10 overflow-auto">
		<table class="table w-full">
			<thead>
			<tr>
				<th>#</th>
				<th>[[MEMBER]]</th>
				<th>[[PERIOD]]</th>
				<th>[[LEFT_BV]]</th>
				<th>[[RIGHT_BV]]</th>
				<th>[[RANK]]</th>
			</tr>
			</thead>
			<tbody>
			<?php
			$n = 0;
			foreach ($list as $key => $result) {
				$prd = "";
				$lbv = "";
				$rbv = "";
				$rnk = "";

				for ($i = 1; $i <= 6; $i++) {
					$mnth = explode("__", $result['month' . $i]);
					$prd .= $i == 1 ? $mnth[0] : "<br>" . $mnth[0];
					$lbv .= $i == 1 ? $mnth[1] : "<br>" . $mnth[1];
					$rbv .= $i == 1 ? $mnth[2] : "<br>" . $mnth[2];
					$rnk .= $i == 1 ? $result['rank' . $i] : "<br>" . $result['rank' . $i];
				}
				?>
				<tr>
					<td><?php echo ($key + 1) + (($page-1) * $per_page) ; ?></td>
					<td><?php echo $result['userid'] . "<br>" . $result['f_name'] . " " . $result['l_name']; ?></td>
					<td><?php echo $prd; ?></td>
					<td><?php echo $lbv; ?></td>
					<td><?php echo $rbv; ?></td>
					<td><?php echo $rnk; ?></td>
				</tr>
				<?php
			}
			?>
			</tbody>
		</table>
		<?php
		$this->load->view("partials/pagination", array(
				"link" => "report/star",
				"per_page" => $per_page,
				"page" => $page,
				"counter" => $counter,
				"query" => $query
		));
		?>
	</div>
</div>
