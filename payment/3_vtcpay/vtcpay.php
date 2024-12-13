<?php
// Edited by ELAN - Toanld


function vtcpay_config() {
	global $params;

	# Invoice Variables
	 $invoiceid 	= $params['invoiceid'];
	 $description 	= $params["description"];
    $amount 		= $params['amount']; # Format: ##.##
    $currency 		= $params['currency']; # Currency Code


   $configarray = [
		"FriendlyName" => ["Type" => "System", "Value" => "vtcPay"],
		"instructions" => ["FriendlyName" => "Payment Instructions", "Type" => "textarea", "Rows" => "5", "Description" => "Mo ta ve phuong thuc thanh toan",],
	];

	return $configarray;
	 
}

function vtcpay_link($params) {

	global $_LANG;

	# Invoice Variables
	$invoiceid = $params['invoiceid'];
	$description = $params["description"];
    $amount = $params['amount']; # Format: ##.##
    $currency = $params['currency']; # Currency Code
	
/**KHACH HANG SUA THONG TIN SAU**************************************************************/
	$index 					= 'Url website'; // dia chi website cua ban
	$business				= 'Account VTCPAY';//tai khoan VTC Pay nhan tien dang ky tai pay.vtc.vn
	$merchant_id			=  ""; // Ma websiteid duoc gen tren 
	$secure_pass			= 'Secrete Key'; // ma bao mat duoc dien tren pay.vtc.vn
	$pay_url = 'https://vtcpay.vn/bank-gateway/checkout.html'; //url thanh toan 
	$return_url="Url Return"; // Đưa link VTCPay_Listener vào đây
	/*
		sanbox url: http://sandbox1.vtcebank.vn/pay.vtc.vn/gate/checkout.html
		Triển khai url: https://pay.vtc.vn/cong-thanh-toan/checkout.html
	*/
/**HET PHAN SUA******************************************************************************************/
	
	$order_id				=  $params['invoiceid'];
	$total_amount			=	intval($params['amount']);
	$order_description	=	nl2br($params['description']);
	$url_success			=	$index;
	$url_cancel				= "$index/clientarea.php";
	$url_detail				= "$index/viewinvoice.php?id=$order_id";
	
	$transaction_info="thanhtoantaiwebsite";
	$customer_mobile="";
	$param_extend="";
	
	$url =createRequestUrl($return_url, $business, $transaction_info, $order_id, $total_amount,$customer_mobile,$merchant_id,$secure_pass,$pay_url,$param_extend);
	
	$code = '<a href="'.$url.'"><img src="https://lh3.googleusercontent.com/-gBkC9DqZC6o/YXjIFIt_1NI/AAAAAAAAOwE/cwH74tVpdr0OT7-tSd6Kud0p97DEEXyxgCLcBGAsYHQ/s0/VTC_Pay_logo.png" /></a>';

	return $code;
}

function createRequestUrl($return_url, $receiver, $transaction_info, $order_code, $amount,$customer_mobile,$websiteid,$secret_key,$vtcpay_url,$param_extend)
{
	// M?ng các tham s? chuy?n t?i VTC Pay
	
	$arr_param = array(
		'return_url'		=>	strtolower(urlencode($return_url)),
		'receiver'			=>	strval($receiver),
		'transaction_info'	=>	strval($transaction_info),
		'order_code'		=>	strval($order_code),
		'amount'			=>	strval($amount)					
	);
	$currency = 'VND';	
	
	
	$plaintext = $arr_param['amount']."|".$currency."|".$param_extend."|". $arr_param['receiver']."|".$arr_param['order_code']."|".$return_url."|".$websiteid ."|".$secret_key;

		$sign = strtoupper(hash('sha256', $plaintext));
		
		$data = "?website_id=" . $websiteid  . "&currency=" . $currency . "&reference_number=" . $arr_param['order_code'] . "&amount=" . $arr_param['amount'] . "&receiver_account=" .  $arr_param['receiver']. "&url_return=" .  urlencode($return_url). "&signature=" . $sign. "&payment_type=" . $param_extend;
	
	
	$destinationUrl = $vtcpay_url . $data;
	$destinationUrl = str_replace("%3a",":",$destinationUrl);
	$destinationUrl = str_replace("%2f","/",$destinationUrl);
	return $destinationUrl;
}
function format_price_vtcpay($price){
		$price_vtcpay 	= str_replace(',','',$price);
		$price_vtcpay 	= str_replace('.','',$price_vtcpay);
		$price_vtcpay 	= strip_tags($price_vtcpay);
		$price_vtcpay	= trim($price_vtcpay);
		return $price_vtcpay;
}
?>