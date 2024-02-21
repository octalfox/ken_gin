<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
	<h2 class="text-lg font-medium mr-auto">
		[[LABEL_ADD_POS]]
	</h2>
	<div class="w-full sm:w-auto flex mt-4 sm:mt-0">
		<a href="<?php echo base_url("inventory"); ?>" class="btn btn-primary shadow-md mr-2">[[LABEL_POS_LIST]]</a>
	</div>
</div>

<div class="intro-y box mt-5">
	<div class="p-10 overflow-auto">

		<div class="p-5">
			<?php $this->load->view("includes/alert"); ?>
			<div class="preview">
				<form method="post">

					<div class="input-form">
						<div class="col-md-12 mt-2">
							[[LABEL_DATE]]: <br>
							<input readonly type="text" class="form-control" value="<?php echo $POs['purchase_date'] ?>">
						</div>

						<div class="col-md-12 mt-2">
							[[LABEL_DESCRIPTION]]: <br>
							<textarea readonly class="form-control"><?php echo $POs['description'] ?></textarea>
						</div>

						<div class="col-md-12">
							[[LABEL_VENDOR]]: <br>
							<input readonly type="text" class="form-control" value="<?php echo $POs['vendor'] ?>">
						</div>

						<div class="col-md-12 mt-2">
							[[LABEL_PAYMENT_REFERENCE]]: <br>
							<input readonly type="text" class="form-control" value="<?php echo $POs['payment_reference'] ?>">
						</div>

						<div class="col-md-12 mt-2">
							[[LABEL_PAYMENT_MODE]]: <br>
							<input readonly type="text" class="form-control" value="<?php echo ucfirst($POs['payment_mode']) ?>">
						</div>

					</div>

					<div>
						<table id="child__html" class="table table-sm mt-5">
							<tr>
								<th>[[LABEL_PRODUCT]]</th>
								<th>[[LABEL_QUANTITY]]</th>
								<th>[[LABEL_UNIT_PRICE]]</th>
								<th>[[LABEL_FEE]]</th>
								<th>[[LABEL_TAX]]</th>
							</tr>
							<?php foreach ($details as $detail){ ?>
							<tr>
								<td><?php echo $detail['name'] ?></td>
								<td><?php echo $detail['quantity'] ?></td>
								<td><?php echo $detail['unit_price'] ?></td>
								<td><?php echo $detail['fee'] ?></td>
								<td><?php echo $detail['tax'] ?></td>
							</tr>
							<?php } ?>
						</table>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>


<table id="parent__html" class="d-none">
	<tr>
		<td>
			<select required class="form-control" name="po[product_id][]">
				<?php foreach($list['products'] as $p){ ?>
					<option value="<?php echo $p['id'] ?>"><?php echo $p['name'] ?></option>
				<?php } ?>
			</select>
		</td>
		<td><input required class="form-control" type="text" name="po[quantity][]"></td>
		<td><input required class="form-control" type="text" name="po[unit_price][]"></td>
		<td><input required class="form-control" type="text" name="po[fee][]"></td>
		<td><input class="form-control" type="text" name="po[tax][]"></td>
		<td><input type="button" value="x" onclick="removeChildHTML(this)" class="btn btn-danger"></td>
	</tr>
</table>
