<?php $_SESSION['asset_file_name'] = "sponsored"; ?>
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
	<h2 class="text-lg font-medium mr-auto">
		[[LABEL_SPONSORED_NETWORK]]
	</h2>
</div>
<div class="intro-y box mt-5">
	<div class="section mt-2 p-5">
		<div class="card">
			<div class="card-body">
				<form name="frmSearch" method="post" class="form-horizontal">
					<div class="form-group">
						<div class="input-wrapper">
							<input type="text" name="txtSearch" id="txtSearch"
								   value="<?php echo isset($txtSearch) ? $txtSearch : '1000000'; ?>"
								   class="form-control"
								   placeholder="[[LABEL_USERID_USERNAME]]"/>
						</div>
					</div>
					<div class="form-group basic mt-2">
						<div class="w-full flex mt-4">
							<button type="submit" class="w-full btn btn-primary shadow-md mr-2">[[SUBMIT]]
							</button>
						</div>
					</div>
				</form>
				<div class="transactions mt-5">
					<span onclick="getUserDetails(<?php echo isset($txtSearch) ? $txtSearch : '1000000'; ?>)"
						  class="clickable text-md px-1 rounded-md bg-primary text-white mr-1">
						[[CHECK_USER_DETAILS]]
					</span>
				</div>
			</div>

          	<div class="view_<?php echo isset($txtSearch) ? $txtSearch : '1000000'; ?>"></div>
			
		</div>
	</div>
</div>
<input type="hidden" id="first_node" value="<?php echo isset($txtSearch) ? $txtSearch : '1000000'; ?>">
