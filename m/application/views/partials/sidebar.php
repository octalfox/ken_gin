<div class="modal fade panelbox panelbox-left" id="sidebarPanel" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body p-0">
				<!-- profile box -->
				<div class="profileBox pt-2 pb-2">
					<div class="in">
						<strong><?php echo $_SESSION['logged']['f_name']." ".$_SESSION['logged']['l_name']. " (".$_SESSION['logged']['userid'].")"; ?></strong>
					</div>
					<a href="#" class="btn btn-link btn-icon sidebar-close text-danger" data-bs-dismiss="modal">
						<ion-icon name="close-outline"></ion-icon>
					</a>
				</div>
				<div class="sidebar-balance">
					<div class="listview-title text-black font-weight-bold" style="color: black !important;">[[CC]]</div>
					<div class="in">
						<h1 class="amount" style="color: black !important;">$<?php echo number_format($CCs['balance'], 2); ?></h1>
					</div>
				</div>
				<div class="sidebar-balance">
					<div class="listview-title text-black font-weight-bold" style="color: black !important;">[[RC]]</div>
					<div class="in">
						<h1 class="amount" style="color: black !important;">$<?php echo number_format($RCs['balance'], 2); ?></h1>
					</div>
				</div>
				<div class="listview-title mt-1"></div>
				<ul class="listview flush transparent no-line image-listview">
					<li>
						<a href="<?php echo base_url('logout'); ?>" class="item">
							<div class="icon-box text-danger">
								<ion-icon name="log-out-outline"></ion-icon>
							</div>
							<div class="in">
								[[DEF_LOGOUT]]
							</div>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
