<?php 
$orderID = '';
$val = '';

if(isset($_GET['Val']) && isset($_GET['orderID'])){
    $orderID = $_GET['orderID'];
    $val = $_GET['Val'];
}else{
    echo  '{"error": "OrderFailed"}';
    die;
}

require_once('config/db.php');

$postData = array('SiteCode' => $siteCode,
                    'CountryCode' => 'ZA',
                    'CurrencyCode' => 'ZAR',
                    'Amount' => $val,
                    'TransactionReference' => $orderID,
                    'BankReference' => 'QueensOD-'.$orderID,
                    'CancelUrl' => 'https://dragoon.co.za/QweensOnlineDeli/notice.php?CANCEL',
                    'ErrorUrl' => 'https://dragoon.co.za/QweensOnlineDeli/notice.php?ERROR',
                    'SuccessUrl' => 'https://dragoon.co.za/QweensOnlineDeli/notice.php?SUCCESS',
                    'NotifyUrl' => 'https://dragoon.co.za/QweensOnlineDeli/notice.php?NOTICE',
                    'IsTest' => 'true');

$hashString = strtolower(implode('', $postData) . $privateKey);
$hashCheck = hash('sha512', $hashString);
$postData['HashCheck'] = $hashCheck;
$ozowResult = getPaymentLinkModel($postData, $apiKey);

if (!empty($ozowResult->errorMessage)) {
    die($ozowResult->errorMessage);
}

//echo $ozowResult->url;
header('Location:'. $ozowResult->url, true);
die();

function getPaymentLinkModel($postData, $apiKey)
{
    $jsonRequest = json_encode($postData);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Accept: application/json',
        'ApiKey:' . $apiKey,
        'Content-Type: application/json'
    ));

    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonRequest);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, 'https://api.ozow.com/postpaymentrequest');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $requestResult = curl_exec($ch);

    if ($requestResult === false) {
        die('Error generating Ozow URL: curl error');
    }
    
    return json_decode($requestResult);
}