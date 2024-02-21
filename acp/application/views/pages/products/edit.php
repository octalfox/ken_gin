<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
	<h2 class="text-lg font-medium mr-auto">
		[[LABEL_PRODUCT_UPDATE]]
	</h2>
	<div class="w-full sm:w-auto flex mt-4 sm:mt-0">
		<a href="<?php echo base_url("products"); ?>"
		   class="btn btn-primary shadow-md mr-2">[[LABEL_PRODUCT_LIST]]</a>
	</div>
</div>
<div class="intro-y box">
	<div class="p-10 overflow-auto">

		<?php $this->load->view("includes/alert"); ?>
		<div class="preview">
			<form method="post">

				<header class="text-2xl font-medium leading-none">
					<h2>[[DEF_DETAILS]]</h2>
				</header>
				<div class="input-form mt-5">
					<label>[[LABEL_STATUS]]</label>
					<section class="col col-6">
						<?php
						$arrStatus = array("1" => "[[DEF_STATUS_ACTIVE]]", "0" => "[[DEF_STATUS_INACTIVE]]");
						$sel = "";
						?>
						<select class="form-control" name="is_active">
							<?php
							foreach ($arrStatus as $key => $val) {
								$sel = "";
								if (isset($prod['is_active']) && $prod['is_active'] == $key) {
									$sel = "selected=selected";
								}
								?>
								<option value="<?php echo $key; ?>" <?php echo $sel; ?>><?php echo $val; ?></option>
								<?php
							}
							?>
						</select>
					</section>
				</div>
				<div class="input-form mt-5">
					<label>[[LABEL_NEED_DELIVERY]]</label>
					<section class="col col-6">
						<select class="form-control" name="need_delivery">
							<option value="1" <?php echo isset($prod['need_delivery']) && $prod['need_delivery'] == "1" ? ' selected="selected"' : ''; ?>>
								YES
							</option>
							<option value="0" <?php echo (isset($prod['need_delivery']) && $prod['need_delivery'] == "0") || !isset($prod['need_delivery']) ? ' selected="selected"' : ''; ?>>
								NO
							</option>
						</select>
					</section>
				</div>

				<div class="input-form mt-5">
					<label>[[LABEL_PRODUCT_CODE]]</label>
					<input type="text" name="code" id="code" class="form-control"
						   value="<?php echo isset($prod['code']) ? $prod['code'] : ''; ?>"/>
				</div>
				<div class="input-form mt-5">
					<label>[[LABEL_NAME]]</label>
					<input type="text" name="name" id="name" class="form-control"
						   value="<?php echo isset($prod['name']) ? $prod['name'] : ''; ?>"/>
				</div>
				<div class="input-form mt-5">
					<label>[[DEF_DESCRIPTION]]</label>
					<textarea rows="5" name="description" class="form-control"><?php echo isset($prod['description']) ? $prod['description'] : ''; ?></textarea>
				</div>
				<div class="input-form mt-5">
					<label>[[LABEL_IMAGE_PATH]]<br></label>
					<input type="file" name="fileimg" id="fileimg" class="input-xxlarge"
						   value="<?php echo isset ($_FILES['fileimg']) ? $_FILES['fileimg']['name'] : ''; ?>"/>
				</div>
				<header class="text-2xl font-medium leading-none mt-10">
					<h2>[[ADM_PRODUCT_COST]]</h2>
				</header>
				<div class="input-form mt-5">
					<label>[[LABEL_PRICE]]</label>
					<input type="text" name="price" class="form-control"
						   value="<?php echo isset($prod['price']) ? $prod['price'] : ''; ?>"/>
				</div>
				<header class="text-2xl font-medium leading-none mt-10">
					<h2>[[ADM_PRODUCT_SETTINGS]]</h2>
				</header>
				<div class="input-form mt-5">
					<label>[[LABEL_SPONSOR_BONUS]]</label>
					<input type="text" name="sponsor_bonus" class="form-control"
						   value="<?php echo isset($prod['sponsor_bonus']) ? $prod['sponsor_bonus'] : ''; ?>"/>
				</div>
				<div class="input-form mt-5">
					<label>[[LABEL_BV]]</label>
					<input type="text" name="BV" class="form-control"
						   value="<?php echo isset($prod['BV']) ? $prod['BV'] : ''; ?>"/>
				</div>

				<input type="hidden" name="category_id" value="2">
				<input type="hidden" name="type_id" value="2">
				<input type="hidden" name="id" value="<?php echo isset($prod['id']) ? $prod['id'] : ''; ?>">

				<div class=" mt-5">
					<button type="submit" class="btn btn-primary mt-5">[[SUBMIT]]</button>
				</div>
			</form>
		</div>
	</div>
</div>

