
<?php
$content = "";
foreach ($gateways as $paygate) {
	if ($paygate['gateway'] == 'HITPAY') {
		continue;
	}
	if (strtolower($paygate['gateway']) != "pin" && strtolower($paygate['gateway']) != "e-wallet" && strtolower($paygate['gateway']) != "cod") {
		$content .= file_get_contents("system/application/views/common/payment_gateway_" . strtolower($paygate['gateway']) . ".html", true);
		$content = str_replace("[-merchant-]", (isset($payment[strtolower($paygate['gateway'])]['merchant']) ? $payment[strtolower($paygate['gateway'])]['merchant'] : ""), $content);
		$content = str_replace("[-userid-]", (isset($payment[strtolower($paygate['gateway'])]['userid']) ? $payment[strtolower($paygate['gateway'])]['userid'] : ""), $content);
		$content = str_replace("[-ref_id-]", (isset($payment[strtolower($paygate['gateway'])]['ref_id']) ? $payment[strtolower($paygate['gateway'])]['ref_id'] : ""), $content);
		$content = str_replace("[-paygate currency-]", (isset($payment[strtolower($paygate['gateway'])]['currency']) ? $payment[strtolower($paygate['gateway'])]['currency'] : ""), $content);
		$content = str_replace("[-shipment_cost-]", (isset($payment[strtolower($paygate['gateway'])]['shipment_cost']) ? $payment[strtolower($paygate['gateway'])]['shipment_cost'] : ""), $content);
		$content = str_replace("[-tax-]", (isset($payment[strtolower($paygate['gateway'])]['tax']) ? $payment[strtolower($paygate['gateway'])]['tax'] : ""), $content);
		$content = str_replace("[-total_amount-]", (isset($payment[strtolower($paygate['gateway'])]['total_amount']) ? $payment[strtolower($paygate['gateway'])]['total_amount'] : ""), $content);
		$content = str_replace("[-signature-]", (isset($payment[strtolower($paygate['gateway'])]['signature']) ? $payment[strtolower($paygate['gateway'])]['signature'] : ""), $content);
		$content = str_replace("[-trans_id-]", (isset($payment[strtolower($paygate['gateway'])]['trans_id']) ? $payment[strtolower($paygate['gateway'])]['trans_id'] : ""), $content);
	}
}
$content = str_replace("[-smoovpay_item-]", getGatewayItems($payment, "smoovpay"), $content);
$content = str_replace("[-payza_item-]", getGatewayItems($payment, "payza"), $content);
$content = str_replace("[-stp_item-]", getGatewayItems($payment, "solidtrustpay"), $content);
$content = str_replace("[-paypal_item-]", getGatewayItems($payment, "paypal"), $content);
$content = str_replace("[-Site URL-]", SITE_URL, $content);
$content = str_replace("[-action-]", $action, $content);
$content = str_replace("[-GWaction-]", $GWaction, $content);
echo $content;


function getGatewayItems($payment, $gateway)
{
	$txt = "";
	if ($gateway == "smoovpay") {
		if (isset($payment["smoovpay"])) {
			for ($i = 0; $i < count($payment['smoovpay']['code']); $i++) {
				$j = $i + 1;
				$txt .= '<input type="hidden" name="item_name_' . $j . '" value="' . (isset($payment['smoovpay']['code'][$i]) ? $payment['smoovpay']['code'][$i] : "") . '"/>
                                                <input type="hidden" name="item_description_' . $j . '" value="' . (isset($payment['smoovpay']['name'][$i]) ? $payment['smoovpay']['name'][$i] : "") . '" />
                                                <input type="hidden" name="item_quantity_' . $j . '" value="' . (isset($payment['smoovpay']['qty'][$i]) ? $payment['smoovpay']['qty'][$i] : "") . '" />
                                                <input type="hidden" name="item_amount_' . $j . '" value="' . (isset($payment['smoovpay']['unit_price'][$i]) ? $payment['smoovpay']['unit_price'][$i] : "") . '" />';
			}
		}
	} else if ($gateway == "paypal") {
		if (isset($payment["paypal"])) {
			for ($i = 0; $i < count($payment['paypal']['code']); $i++) {
				$j = $i + 1;
				$txt .= '<input type="hidden" name="item_name_' . $j . '" value="' . (isset($payment['paypal']['name'][$i]) ? $payment['paypal']['name'][$i] : "") . '"/>
                                                <input type="hidden" name="item_number_' . $j . '" value="' . (isset($payment['paypal']['code'][$i]) ? $payment['paypal']['code'][$i] : "") . '" />
                                                <input type="hidden" name="quantity_' . $j . '" value="' . (isset($payment['paypal']['qty'][$i]) ? $payment['paypal']['qty'][$i] : "") . '" />
                                                <input type="hidden" name="amount_' . $j . '" value="' . (isset($payment['paypal']['unit_price'][$i]) ? $payment['paypal']['unit_price'][$i] : "") . '" />';
			}
		}
	} else if ($gateway == "payza") {
		if (isset($payment["payza"])) {
			for ($i = 0; $i < count($payment['payza']['code']); $i++) {
				if ($i == 0) {
					$txt .= '<input type="hidden" name="ap_itemname" value="' . (isset($payment['smoovpay']['name'][$i]) ? $payment['smoovpay']['name'][$i] : "") . '"/>
                                                    <input type="hidden" name="ap_itemcode" value="' . (isset($payment['smoovpay']['code'][$i]) ? $payment['smoovpay']['code'][$i] : "") . '" />
                                                    <input type="hidden" name="ap_description" value="' . (isset($payment['smoovpay']['name'][$i]) ? $payment['smoovpay']['name'][$i] : "") . '" />
                                                    <input type="hidden" name="ap_quantity" value="' . (isset($payment['smoovpay']['qty'][$i]) ? $payment['smoovpay']['qty'][$i] : "") . '" />
                                                    <input type="hidden" name="ap_amount" value="' . (isset($payment['smoovpay']['unit_price'][$i]) ? $payment['smoovpay']['unit_price'][$i] : "") . '" />';
				} else {
					$txt .= '<input type="hidden" name="ap_itemname_' . $i . '" value="' . (isset($payment['smoovpay']['name'][$i]) ? $payment['smoovpay']['name'][$i] : "") . '"/>
                                                    <input type="hidden" name="ap_itemcode_' . $i . '" value="' . (isset($payment['smoovpay']['code'][$i]) ? $payment['smoovpay']['code'][$i] : "") . '" />
                                                    <input type="hidden" name="ap_description_' . $i . '" value="' . (isset($payment['smoovpay']['name'][$i]) ? $payment['smoovpay']['name'][$i] : "") . '" />
                                                    <input type="hidden" name="ap_quantity_' . $i . '" value="' . (isset($payment['smoovpay']['qty'][$i]) ? $payment['smoovpay']['qty'][$i] : "") . '" />
                                                    <input type="hidden" name="ap_amount_' . $i . '" value="' . (isset($payment['smoovpay']['unit_price'][$i]) ? $payment['smoovpay']['unit_price'][$i] : "") . '" />';
				}
			}
		}
	} else {
		if (isset($payment[$gateway])) {
			for ($i = 0; $i < count($payment[$gateway]['code']); $i++) {
				if ($txt != "") $txt .= ", ";
				$txt .= (isset($payment[$gateway]['qty'][$i]) ? $payment[$gateway]['qty'][$i] . "  " : "") .
					(isset($payment[$gateway]['code'][$i]) ? '(' . $payment[$gateway]['code'][$i] . ') ' : "") .
					(isset($payment[$gateway]['name'][$i]) ? $payment[$gateway]['name'][$i] . "  " : "");
			}
		}
	}
	return $txt;
}

?>
