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
							<input required placeholder="[[LABEL_DATE]]" type="text" class="date__picker form-control" name="purchase_date" value="">
						</div>

						<div class="col-md-12 mt-2">
							<textarea required placeholder="[[LABEL_DESCRIPTION]]" class="form-control" name="description"></textarea>
						</div>

						<div class="col-md-12">
							<input required placeholder="[[LABEL_VENDOR]]" type="text" class="form-control" name="vendor" value="">
						</div>

						<div class="col-md-12 mt-2">
							<input required placeholder="[[LABEL_PAYMENT_REFERENCE]]" type="text" class="form-control" name="payment_reference" value="">
						</div>

						<div class="col-md-12 mt-2">
							<select name="payment_mode" class="form-control">
								<option value="">[[LABEL_SELECT]]</option>
								<option value="cash">[[CASH]]</option>
								<option value="cheque">[[CHEQUE]]</option>
							</select>
						</div>

					</div>


					<div class="input-form form-group mt-10">
						<div class="col-md-12">
							<a href="javascript:void(0)" id="trigger_html" class="btn btn-primary mt-5">
								[[LABEL_ADD_MORE_PRODUCT]]
							</a>
						</div>
					</div>

					<div>
						<table id="child__html" class="mt-5">
							<tr>
								<th>[[LABEL_PRODUCT]]</th>
								<th>[[LABEL_QUANTITY]]</th>
								<th>[[LABEL_UNIT_PRICE]]</th>
								<th>[[LABEL_FEE]]</th>
								<th>[[LABEL_TAX]]</th>
								<th>[[LABEL_ACTION]]</th>
							</tr>
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
								<td></td>
							</tr>
						</table>
					</div>

					<div class="input-form form-group mt-5">
						<div class="col-md-12">
							<button type="submit" class="btn btn-primary mt-5">
								[[SUBMIT]]
							</button>
						</div>
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
