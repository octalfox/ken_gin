<style>
#memberAdd .row{
    display: flex;
    /* gap: 10rem */
    justify-content: space-between;
    height: 2em;
}
#memberAdd fieldset{
    max-width: 25%;
}

</style>
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
	<h2 class="text-lg font-medium mr-auto">
		[[LABEL_MEMBERS]]
	</h2>
</div>

<div class="intro-y box mt-5">
	<div class="p-10 overflow-auto">

		<div class="p-5">
			<?php $this->load->view("includes/alert"); ?>
			<div class="preview">
                    <form  id="memberAdd" class="smart-form" novalidate="novalidate" name="frmRegister" method="post">
                        <fieldset>
                            <div class="row">
                                <label class="label col col-3">[[LABEL_USERID]]</label>
                                <section class="col col-9">
                                    <label class="input">
                                        <span class="input-xlarge uneditable-input"><?php echo $user['userid']; ?></span>
                                    </label>
                                </section>
                            </div>
                            <div class="row">
                                <label class="label col col-3">[[LABEL_NAME]]</label>
                                <section class="col col-9">
                                    <label class="input">
                                        <span class="input-xlarge uneditable-input"><?php echo $user['f_name'].' '.$user['l_name']; ?></span>
                                    </label>
                                </section>
                            </div>
                            <div class="row">
                                <label class="label col col-3">[[LABEL_EXISTING_PACKAGE]]</label>
                                <section class="col col-9">
                                    <label class="input">
                                        <span class="input-xlarge uneditable-input"><?php echo $current_package['name']; ?></span>
                                    </label>
                                </section>
                            </div>
                            <div class="row">
                                <label class="label col col-3">[[LABEL_AMOUNT_PAID]]</label>
                                <section class="col col-9">
                                    <label class="input">
                                        <span class="input-xlarge uneditable-input"><?php $amount_paid = $current_package['price'] + $current_package['gst']; echo $amount_paid; ?></span>
                                    </label>
                                </section>
                            </div>
                            <div class="row">
                                <label class="label col col-3" >[[LABEL_UPGRADE_PACKAGE_TO]]</label>
                                <section class="col col-9">
                                    <label class="input">
                                        <span class="input-xlarge uneditable-input"><?php echo $new_package['name']; ?></span>
                                    </label>
                                </section>
                            </div>
                            <div class="row">
                                <label class="label col col-3">[[LABEL_COST]]</label>
                                <section class="col col-9">
                                    <label class="input">
                                        <span class="input-xlarge uneditable-input"><?php echo $new_package['price']; ?></span>
                                    </label>
                                </section>
                            </div>
                            <div class="row">
                                <label class="label col col-3">[[LABEL_AMOUNT_TO_BE_PAID]]</label>
                                <section class="col col-9">
                                    <label class="input">
                                        <span class="input-xlarge uneditable-input"><?php echo $new_package['topup']; ?></span>
                                    </label>
                                </section>
                            </div>
                            <div class="row">
                                <label class="label col col-3">[[LABEL_PAYMENT_MODE]]</label>
                                <section class="col col-9">
                                    <label class="input">
                                        <span class="input-xlarge uneditable-input"><?php echo $payment_mode; ?></span>
                                    </label>
                                </section>
                            </div>
                            
                            <?php if ($payment_mode == "E-WALLET") {
                                if ($ewallet_balance >= $new_package['topup']) {
                                    $disabled = "";
                                } else {
                                    $disabled = ' disabled="disabled"';
                                }
                                ?>
                            <div class="row">
                                <label class="label col col-3">[[LABEL_EWALLET_BALANCE]]</label>
                                <section class="col col-9">
                                    <label class="input">
                                        <span class="input-xlarge uneditable-input"><?php echo $ewallet_balance;?></span>
                                    </label>
                                </section>
                            </div>
                            <?php } ?>
                            <footer>
                                <button type="submit" class="btn btn-primary" id="btnBack" name="btnBack">[[DEF_BACK]]</button>
                                <button type="submit" class="btn btn-primary" id="btnSave" name="btnSave" <?php echo isset($disabled) ? $disabled : "";?>>[[DEF_SUBMIT]]</button>
                            </footer>
                        </fieldset>
                    </form>
			</div>
		</div>
	</div>
</div>