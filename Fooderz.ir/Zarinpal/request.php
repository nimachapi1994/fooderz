<?php
session_start();
// var_dump($_GET);
// die();
$_SESSION['cus']['address']=$_GET['address'];
$MerchantID  = '0f1c6166-0dde-11e8-8c14-005056a205be'; //Required
$Amount      = 100; //$_SESSION['order']['sumAll']; //$_SESSION['sumAll']; //Amount will be based on Toman  - Required
$Description = 'سامانه غذای آنلاین'; // Required
$Email       = 'noohpishehhossein@gmail.com'; // Optional
$Mobile      = $_SESSION['phone']; // Optional
$CallbackURL = 'http://localhost/Fooderz/Fooderz.ir/Zarinpal/verify.php'; // Required
//http://www.fooderz.ir/Zarinpal/

// URL also can be ir.zarinpal.com or de.zarinpal.compact(varname)
$client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', array('encoding' => 'UTF-8'));

$result = $client->PaymentRequest(array(
    'MerchantID'  => $MerchantID,
    'Amount'      => $Amount,
    'Description' => $Description,
    'Email'       => $Email,
    'Mobile'      => $Mobile,
    'CallbackURL' => $CallbackURL,
));

//Redirect to URL You can do it also by creating a form
if ($result->Status == 100)
{
    header('Location: https://www.zarinpal.com/pg/StartPay/' . $result->Authority);
}
// printer_draw_elipse(printer_handle, ul_x, ul_y, lr_x, lr_y)
else
{
    echo 'ERR: ' . $result->Status;
}