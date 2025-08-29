<?php

error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
date_default_timezone_set('Asia/Ho_Chi_Minh');

require_once("./config.php");

// Dùng GET nếu bạn truyền tham số qua URL
$vnp_TxnRef = $_GET['order_id']; // Mã đơn hàng
$vnp_Amount = $_GET['amount'];   // Số tiền (VND)
$vnp_Locale = 'vn'; // hoặc 'en' tùy ý
$vnp_BankCode = ''; // để rỗng hoặc truyền vào
$vnp_IpAddr = $_SERVER['REMOTE_ADDR']; // IP khách

$expire = date('YmdHis', strtotime('+15 minutes'));

$inputData = array(
    "vnp_Version" => "2.1.0",
    "vnp_TmnCode" => $vnp_TmnCode,
    "vnp_Amount" => $vnp_Amount * 100, // nhân 100 theo yêu cầu của VNPay
    "vnp_Command" => "pay",
    "vnp_CreateDate" => date('YmdHis'),
    "vnp_CurrCode" => "VND",
    "vnp_IpAddr" => $vnp_IpAddr,
    "vnp_Locale" => $vnp_Locale,
    "vnp_OrderInfo" => "Thanh toan GD: " . $vnp_TxnRef,
    "vnp_OrderType" => "other",
    "vnp_ReturnUrl" => $vnp_Returnurl,
    "vnp_TxnRef" => $vnp_TxnRef,
    "vnp_ExpireDate" => $expire
);

if (!empty($vnp_BankCode)) {
    $inputData['vnp_BankCode'] = $vnp_BankCode;
}

ksort($inputData);
$query = "";
$hashdata = "";

foreach ($inputData as $key => $value) {
    $query .= urlencode($key) . "=" . urlencode($value) . '&';
    $hashdata .= urlencode($key) . "=" . urlencode($value) . '&';
}
$hashdata = rtrim($hashdata, '&');
$query = rtrim($query, '&');

$vnp_SecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
$vnp_Url = $vnp_Url . "?" . $query . '&vnp_SecureHash=' . $vnp_SecureHash;

header('Location: ' . $vnp_Url);
exit();