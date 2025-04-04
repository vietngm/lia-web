<?php

include_once 'StringeeApi/StringeeCurlClient.php';

$keySid = 'SK.0.VJXG28jT0Z9VvBjyRUpAEEDfn6dVtQ4e';
$keySecret = 'OUdhQWNTcnFNQVdWd05INjU3cVZDREtTZDhQbFdzZg==';

$curlClient = new StringeeCurlClient($keySid, $keySecret);

$url = 'https://api.stringee.com/v1/sms';


function send_sms_otp($phone, $otp) {
	global $url;
	global $curlClient;

	if ($phone[0] == "0") {
		$phone = "84" . substr($phone, 1);
	} else if ($phone[0] == "+") {
		$phone = substr($phone, 1);
	}

	/*
	* $sms['text'] is string if you use brandname Stringee or your brandname
		"text" => "CONTENT_SMS"
	* 
	* $sms['text'] is array if you use brandname Notify-GSMS-VSMS:
		"text" => [
					"template" => 5689, 
					"params" => ["param1"]
				]
	*/
	$smses[] = array(
		'from' => 'TrangBeauty', 
		'to' => $phone,
		'text' => "TrangBeauty - Ma OTP cua quy khach cho phongkhamtrangbeauty.com la: $otp. De dam bao an toan, vui long KHONG chia se OTP cho bat ky ai.",	
	);
	$data = array(
		'sms' => $smses,
	);

	$postData = json_encode($data);
	$res = $curlClient->post($url, $postData, 15);
	$statusCode = $res->getStatusCode();
	$content = $res->getContent();
	$decoded_response = json_decode($content);
	$decoded_response->success = $decoded_response->smsSent > 0;
	return $decoded_response;
}

// Date format: dd/mm/yyyy
function send_sms_booking_success($phone, $date) {
	global $url;
	global $curlClient;

	if ($phone[0] == "0") {
		$phone = "84" . substr($phone, 1);
	} else if ($phone[0] == "+") {
		$phone = substr($phone, 1);
	}

	/*
	* $sms['text'] is string if you use brandname Stringee or your brandname
		"text" => "CONTENT_SMS"
	* 
	* $sms['text'] is array if you use brandname Notify-GSMS-VSMS:
		"text" => [
					"template" => 5689, 
					"params" => ["param1"]
				]
	*/
	$smses[] = array(
		'from' => 'TrangBeauty', 
		'to' => $phone,
		'text' => "PK LiA Beauty da nhan duoc lich hen cua quy khach vào ngày $date, chung toi se lien he lai cho quy khach de xac nhan lich hen. Moi thong tin chi tiet vui long lien he Hotline: 0986690666 de duoc ho tro.",	
	);
	$data = array(
		'sms' => $smses,
	);

	$postData = json_encode($data);
	$res = $curlClient->post($url, $postData, 15);
	$statusCode = $res->getStatusCode();
	$content = $res->getContent();
	$decoded_response = json_decode($content);
	$decoded_response->success = $decoded_response->smsSent > 0;
	return $decoded_response;
}