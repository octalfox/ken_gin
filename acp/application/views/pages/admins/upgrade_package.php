<div class="intro-y flex flex-col sm:flex-row items-center mt-8 mb-8">
	<h2 class="text-lg font-medium mr-auto">
		[[LABEL_PACKAGE_UPDATE]]
	</h2>
	<!-- <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
		<a href="<?php echo base_url("packages"); ?>"
		   class="btn btn-primary shadow-md mr-2">[[LABEL_PACKAGE_LIST]]</a>
	</div> -->
</div>
<div class="intro-y box">
	<div class="p-10 overflow-auto">

		<?php $this->load->view("includes/alert"); ?>
		<div class="preview">
			<form method="post" enctype="multipart/form-data">

				<div class="input-form mt-5">
					<label>[[LABEL_USERID]]</label>
					<input type="text" name="txtUserId"  id="txtUserId" value="<?php echo isset($memberInfo['userid']) ? $memberInfo['userid'] : (isset($_POST['txtUserId']) ? $_POST['txtUserId'] : "");  ?>" class="form-control"/>
				</div>

                <div class="input-form mt-5">
					<label>[[LABEL_NAME]]</label>
					<input type="text" name="txtUserName"  id="txtUserName" value="-" readonly="readonly" class="form-control"/>
				</div>

                <div class="input-form mt-5">
					<label>[[LABEL_EXISTING_PACKAGE]]</label>
					<input type="text"name="txtExistingPackage"  id="txtExistingPackage" value="-" readonly="readonly" class="form-control"/>
				</div>

                <div class="input-form mt-5">
					<label>[[LABEL_AMOUNT_PAID]]</label>
					<input type="text" name="txtAmountPaid"  id="txtAmountPaid" value="-" readonly="readonly" class="form-control"/>
				</div>

				<div class="input-form mt-5">
					<label>[[LABEL_UPGRADE_PACKAGE_TO]]</label>
					<select class="form-control" id="selPackage" name="selPackage" onchange="getPackageCost()">
						<option value="-1">Please select a package</option>
					</select>
				</div>

                <div class="input-form mt-5">
					<label>[[LABEL_COST]]</label>
					<input type="text" name="txtCost"  id="txtCost" value="-" readonly="readonly" class="form-control"/>
				</div>

                <div class="input-form mt-5">
					<label>[[LABEL_AMOUNT_TO_BE_PAID]]</label>
					<input type="text" name="txtAmountToBePaid"  id="txtAmountToBePaid" value="-" readonly="readonly" class="form-control"/>
				</div>


                <div class="input-form mt-5">
					<label>[[LABEL_PAYMENT_MODE]]</label>
					<select class="form-control" name="payment_mode">
                            <option value="CASH">[[LABEL_TYPE_CASH]]</option>
                            <option value="E-WALLET">E-WALLET</option>
					</select>
				</div>

				<div class=" mt-5">
					<button type="submit" id="btnSave" name="btnSave" class="btn btn-primary mt-5">[[SUBMIT]]</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function() {
        getUserData();
        $("#txtUserId").blur(function()
        {
            getUserData();
        });
    });
    
    function getUserData() {
        var userid = $("#txtUserId").val();
        $.ajax({
            type: "POST",
            url: `${API_URL}/admin/members/get`,
            accepts: "application/json; charset=utf-8",
            data: {
                access_token: TOKEN,
                userid: userid,
                language: LANGUAGE,
            },
            success: function (data) {
                    let responseData = JSON.parse(data);
                    //console.log(responseData.data);
                    //return false;
                    var name = responseData.data.member.member_detail.f_name + ' ' + responseData.data.member.member_detail.l_name;
                    var package_name = responseData.data.member.member_detail.package_name;
                    var amount_paid = responseData.data.member.member_detail.accu_personal_sales;

                    if(name != '')
                    {
                        $("#txtUserName").val(name);
                    }				
                    else
                    { 
                        $("#txtUserName").val('-');      		
                    }

                    if(package_name != '')
                    {
                        $("#txtExistingPackage").val(package_name);
                    }				
                    else
                    { 
                        $("#txtExistingPackage").val('-');      		
                    }
                   
                    if(amount_paid != '')
                    {
                        $("#txtAmountPaid").val(amount_paid);
                    }				
                    else
                    { 
                        $("#txtAmountPaid").val('-');      		
                    } 

                    if(data.packageDetails != '')
                    {
                        $('#selPackage').html(responseData.data.packageDetails);
                	
                    }				
                    else
                    { 
                        $(' #selPackage').html('-');		
                    }
                }
        });
    }

    function getPackageCost() 
    {
	    var package_id = $("#selPackage").val();
        $.ajax({
            type: "POST",
            url: `${API_URL}/admin/members/get_packages`,
            accepts: "application/json; charset=utf-8",
            data: {
                access_token: TOKEN,
                package_id: package_id,
                language: LANGUAGE,
            },
            success: function (data) {
                let responseData = JSON.parse(data);
                var txtCost = responseData.data.price;
                if(txtCost != '')
                {
                    $("#txtCost").val(txtCost);
                }				
                else
                { 
                    $("#txtCost").val('-');     		
                }
            }
        });

        var uid = $("#txtUserId").val();
        $.ajax( {
            type: "POST",
            url: `${API_URL}/admin/members/ajaxGetPackageTopUpPrice`,
            accepts: "application/json; charset=utf-8",
            data: {
                access_token: TOKEN,
                cid: package_id+"_" + uid,
                language: LANGUAGE,
            },
            success: function(data) {
                let responseData = JSON.parse(data);
                
                if(responseData.data != '')
                {
                    $("#txtAmountToBePaid").val(responseData.data);	
                }				
                else
                { 
                    $("#txtAmountToBePaid").val('-');        		
                }
            }
        });
    }
</script>
