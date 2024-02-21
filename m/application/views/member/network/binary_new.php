<style>
	#binary_card {
		width: 100% !important;
	}

	.grid_class {
		margin: 0 !important;
		padding: 10px;
		position: relative;
		z-index: 5;
	}

	.groupTreegoup {
		display: flex;
		gap: 5px;
	}

	.tree {
		max-width: 100%;
		z-index: 1;
		position: relative;
		padding-bottom: 35px;
		overflow: auto;
		margin-top: -40px;
		zoom: .9;
		-moz-transform: scale(0.9);
	}

	.tree ul {
		padding-top: 25px;
		margin-top: -7px;
		position: relative;
		padding-left: 5px;
		transition: all 0.5s;
		-webkit-transition: all 0.5s;
		-moz-transition: all 0.5s;
	}

	.tree li {
		float: left;
		text-align: center;
		display: block;
		list-style-type: none;
		position: relative;
		/*padding: 25px 3px 0 3px;*/
		padding: 25px 3px 0 0;

		transition: all 0.5s;
		-webkit-transition: all 0.5s;
		-moz-transition: all 0.5s;
	}

	/*We will use ::before and ::after to draw the connectors*/

	.tree li::before, .tree li::after {
		content: '';
		position: absolute;
		top: 0;
		right: 50%;
		border-top: 1px solid rgb(0, 138, 110);
		width: 50%;
		height: 25px;
	}

	.tree li:after {
		right: auto;
		left: 50%;
		border-left: 1px solid rgb(0, 138, 110);
	}

	/*We need to remove left-right connectors from elements without
	any siblings*/
	.tree li:only-child::after, .tree li:only-child::before {
		display: none;
	}

	/*Remove space from the top of single children*/
	.tree li:only-child {
		padding-top: 0;
		min-width: -webkit-max-content;
	}

	/*Remove left connector from first child and
	right connector from last child*/
	.tree li:first-child::before, .tree li:last-child::after {
		border: 0 none;
	}

	/*Adding back the vertical connector to the last nodes*/
	.tree li:last-child::before {
		border-right: 1px solid rgb(0, 138, 110);
		border-radius: 0 0px 0 0;
		-webkit-border-radius: 0 0px 0 0;
		-moz-border-radius: 0 0px 0 0;
	}

	.tree li:first-child::after {
		border-radius: 0px 0 0 0;
		-webkit-border-radius: 0px 0 0 0;
		-moz-border-radius: 0px 0 0 0;
	}

	/*Time to add downward connectors from parents*/
	.tree ul ul::before {
		content: '';
		position: absolute;
		top: 0;
		left: 50%;
		border-left: 1px solid rgb(0, 138, 110);
		width: 0;
		height: 25px;
		margin-left: -1px;
	}

	.tree li > a {
		text-decoration: none;
		color: #666;
		font-family: arial, verdana, tahoma;
		font-size: 1.8rem;
		display: inline-block;
		cursor: pointer;
		position: relative;
		min-width: 110px;
		min-height: 110px;
		max-height: 140px;
		margin-bottom: 7px;

		border-radius: 10px;
		-webkit-border-radius: 10px;
		-moz-border-radius: 10px;

		transition: all 0.5s;
		-webkit-transition: all 0.5s;
		-moz-transition: all 0.5s;
		/*background: linear-gradient(to right, #dcdcdc, #ffffff);*/
		background: #dcdcdc;
		/*overflow: hidden;*/
	}

	.tree li a .grid_class .hydrated {
		margin-top: 40px !important;
		margin-bottom: 40px !important;
	}

	/*.tree li > a.ownposition {*/
	/*	width: 135px;*/
	/*	height: 135px;*/
	/*}*/

	/*Time for some hover effects*/
	/*We will apply the hover effect the the lineage of the element also*/
	.tree li > a:hover, .tree li > a:hover + ul li > a {
		background: linear-gradient(to right, rgba(20, 197, 147, 0.45), rgba(0, 67, 72, 0.21));
		color: #808080;
		border: 0 solid #000000;
		box-shadow: inset 0 0 15px #a8f3ff inset;
		padding: 2px;
	}

	/*Connector styles on hover*/
	.tree li > a:hover + ul li::after,
	.tree li > a:hover + ul li::before,
	.tree li > a:hover + ul::before,
	.tree li > a:hover + ul ul::before {
		border-color: #3db8d7;
	}

	.tree li > a:hover + ul li::after {
	}

	.tree li > a:hover + ul li::before {
	}

	.tree li > a:hover + ul::before {
	}

	.tree li > a:hover + ul ul::before {
	}

	.tree li > a.just-line {
		display: none;
	}

	.tree a.just-line + ul {
		padding-top: 74px;
	}

	.tree a.just-line + ul:before {
		height: 74px;
	}

	/* START HORIZONTAL BINARY */
	.tree {
		transition: all 1s;
	}

	.tree.tree_horizontal {
		padding-top: 260px !important;
		/*zoom: .75;*/
	}

	.tree.tree_horizontal li a.itsuser {
		position: absolute;
		left: 0;
		right: 0;
		margin: 0 auto;
		top: 41%;
		min-width: 110px !important;
		min-height: 140px;
		padding-top: 15px;
		max-width: 110px !important;
	}

	.tree.tree_horizontal li > a {
		min-width: 140px !important;
		max-height: 110px !important;
	}

	.tree.tree_horizontal a .grid_class {
		margin-top: -20px !important;
	}

	.tree.tree_horizontal .structureblock_1 {
		transform: rotate(90deg);
		left: 213px;
	}

	.tree.tree_horizontal .structureblock_2 {
		transform: rotate(-90deg);
		right: 9%;
	}

	.tree.tree_horizontal .structureblock_1 a .grid_class {
		transform: rotate(-90deg);
	}

	.tree.tree_horizontal .structureblock_2 a .grid_class {
		transform: rotate(90deg);
	}

	.tree.tree_horizontal .structureblock_1::after {
		border-top: 0;
	}

	.tree.tree_horizontal .structureblock_2::before {
		border-top: 0;
	}

	.tree.tree_horizontal li a.selectedposition + ul:before {
		border-left: 0;
	}

	.tree.tree_horizontal ul ul::before {
		content: '';
		position: absolute;
		top: -6px !important;
		left: 50%;
		border-left: 1px solid rgb(0, 138, 110);
		width: 0;
		height: 30px !important;
		margin-left: -1px;
	}

	/*.tree.tree_horizontal .structureblock_1 a .grid_class {*/
	/*	transform: rotate(90deg);*/
	/*}*/

	/*.tree.tree_horizontal .structureblock_2 a .grid_class {*/
	/*	transform: rotate(-90deg);*/
	/*}*/

	/* END GORIZONTAL BINARY */
</style>

<?php $_SESSION['asset_file_name'] = "binary"; ?>
<div id="appCapsule binary_tree_x">
	<div class="section mt-150">
		<div class="card">
			<div class="card-body">
				<form class="search-form" method="post">
					<div class="form-group basic">
						<div class="input-wrapper">
							<input type="text" class="form-control" name="txtSearch" id="txtSearch" value="<?php echo $txtSearch; ?>" placeholder="[[ADM_SEARCH_MEMBER_TEXTFIELD]]" />
						</div>
					</div>
					<div class="form-group basic">
						<div class="input-wrapper">
							<input type="submit" name="btnSearch" id="btnSearch" value="[[DEF_SEARCH]]" class="btn btn-warning btn-lg btn-block"/>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div id="error-msg"></div>
		<div class="listview-title mt-1"></div>
		<div class="binary_fill_in">
			<div class="card" id="binary_card">
				<div class="card-body" style="z-index: 999 !important;">
					<div class="groupTreegoup">
						<a href="javascript:goHorizontal()" style="float:left">
							<ion-icon style="font-size: 25px" name="expand-outline"></ion-icon>
						</a>
						<a href="javascript:goUp()" style="float:left">
							<ion-icon style="font-size: 25px" name="arrow-up-circle-outline"></ion-icon>
						</a>
						<a href="javascript:goFullTop()" style="float:left">
							<ion-icon style="font-size: 25px" name="swap-vertical-outline"></ion-icon>
						</a>
					</div>
				</div>
				<div class="card-body group-scroll" style="max-width: 100%;" id="refreshGTB">
					<div class="tree" id="treeload">
						<ul>
							<li class="tree_center_leg structureblock_0">
								<a class="position_1_1 selectedposition itsuser" id="cell-1-1"></a>
								<ul>
									<li class="structureblock_1">
										<a id="cell-2-1">
											<span class="positiondeep positiondeep_2_1"></span>
										</a>
										<ul>
											<li class="structureblock_3">
												<a id="cell-3-1">
													<span class="positiondeep positiondeep_3_1"></span>
												</a>
												<ul>
													<li class="structureblock_5">
														<a id="cell-4-1">
															<span class="positiondeep positiondeep_4_1"></span>
														</a>
														<ul>
															<li class="structureblock_7">
																<a id="cell-5-1">
																	<span class="positiondeep positiondeep_5_1"></span>
																</a>
															</li>
															<li class="structureblock_8">
																<a id="cell-5-2">
																	<span class="positiondeep positiondeep_5_2"></span>
																</a>
															</li>
														</ul>
													</li>
													<li class="structureblock_6">
														<a id="cell-4-2">
															<span class="positiondeep positiondeep_4_2"></span>
														</a>
														<ul>
															<li class="structureblock_7">
																<a id="cell-5-3">
																	<span class="positiondeep positiondeep_5_3"></span>
																</a>
															</li>
															<li class="structureblock_8">
																<a id="cell-5-4">
																	<span class="positiondeep positiondeep_5_4"></span>
																</a>
															</li>
														</ul>
													</li>
												</ul>
											</li>
											<li class="structureblock_4">
												<a id="cell-3-2">
													<span class="positiondeep positiondeep_3_2"></span>
												</a>
												<ul>
													<li class="structureblock_5">
														<a id="cell-4-3">
															<span class="positiondeep positiondeep_4_3"></span>
														</a>
														<ul>
															<li class="structureblock_7">
																<a id="cell-5-5">
																	<span class="positiondeep positiondeep_5_6"></span>
																</a>
															</li>
															<li class="structureblock_8">
																<a id="cell-5-6">
																	<span class="positiondeep positiondeep_5_7"></span>
																</a>
															</li>
														</ul>
													</li>
													<li class="structureblock_6">
														<a id="cell-4-4">
															<span class="positiondeep positiondeep_4_4"></span>
														</a>
														<ul>
															<li class="structureblock_7">
																<a id="cell-5-7">
																	<span class="positiondeep positiondeep_5_8"></span>
																</a>
															</li>
															<li class="structureblock_8">
																<a id="cell-5-8">
																	<span class="positiondeep positiondeep_5_9"></span>
																</a>
															</li>
														</ul>
													</li>
												</ul>
											</li>
										</ul>
									</li>
									<li class="structureblock_2">
										<a id="cell-2-2">
											<span class="positiondeep positiondeep_2_1"></span>
										</a>
										<ul>
											<li class="structureblock_3">
												<a id="cell-3-3">
													<span class="positiondeep positiondeep_3_3"></span>
												</a>
												<ul>
													<li class="structureblock_5">
														<a id="cell-4-5">
															<span class="positiondeep positiondeep_4_5"></span>
														</a>
														<ul>
															<li class="structureblock_7">
																<a id="cell-5-9">
																	<span class="positiondeep positiondeep_5_9"></span>
																</a>
															</li>
															<li class="structureblock_8">
																<a id="cell-5-10">
																	<span class="positiondeep positiondeep_5_10"></span>
																</a>
															</li>
														</ul>
													</li>
													<li class="structureblock_6">
														<a id="cell-4-6">
															<span class="positiondeep positiondeep_4_6"></span>
														</a>
														<ul>
															<li class="structureblock_7">
																<a id="cell-5-11">
																	<span class="positiondeep positiondeep_5_11"></span>
																</a>
															</li>
															<li class="structureblock_8">
																<a id="cell-5-12">
																	<span class="positiondeep positiondeep_5_12"></span>
																</a>
															</li>
														</ul>
													</li>
												</ul>
											</li>
											<li class="structureblock_4">
												<a id="cell-3-4">
													<span class="positiondeep positiondeep_3_4"></span>
												</a>
												<ul>
													<li class="structureblock_5">
														<a id="cell-4-7">
															<span class="positiondeep positiondeep_4_7"></span>
														</a>
														<ul>
															<li class="structureblock_7">
																<a id="cell-5-13">
																	<span class="positiondeep positiondeep_5_13"></span>
																</a>
															</li>
															<li class="structureblock_8">
																<a id="cell-5-14">
																	<span class="positiondeep positiondeep_5_14"></span>
																</a>
															</li>
														</ul>
													</li>
													<li class="structureblock_6">
														<a id="cell-4-8">
															<span class="positiondeep positiondeep_4_8"></span>
														</a>
														<ul>
															<li class="structureblock_7">
																<a id="cell-5-15">
																	<span class="positiondeep positiondeep_5_15"></span>
																</a>
															</li>
															<li class="structureblock_8">
																<a id="cell-5-16">
																	<span class="positiondeep positiondeep_5_16"></span>
																</a>
															</li>
														</ul>
													</li>
												</ul>
											</li>
										</ul>
									</li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
