<?php
//SELECT max(pch_ID) FROM purchasecart WHERE cus_ID= and prv_ID=
session_start();
// print_r($_SESSION);
// die();
$factor = $_SESSION['cus']['order'];
// $fac    = "";
// $tab    =  "                                        ";
// foreach ($factor as $v)
// {
//     // print_r($v);
//     $len = strlen($v['name'].$v['count']);
//     $fac .= $v['name'] ." ". substr($tab, $len) . " (" . $v['count'] . " عدد)<br>";
//     echo "<hr>".$len."<hr>".strlen(substr($tab, $len));
// }
// echo "<hr>".$fac;
// die();
date_default_timezone_set('Asia/Tehran');
$MerchantID = '0f1c6166-0dde-11e8-8c14-005056a205be'; //Required
$Amount     = 100; //Amount will be based on Toman
$Authority  = $_GET['Authority'];
if ($_GET['Status'] == 'OK')
{
    // URL also can be ir.zarinpal.com or de.zarinpal.com
    $client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', array('encoding' => 'UTF-8'));

    $result = $client->PaymentVerification(array(
        'MerchantID' => $MerchantID,
        'Authority'  => $Authority,
        'Amount'     => $Amount,
    ));

    if ($result->Status == 100)
    {
        echo 'Transation success. RefID:' . $result->RefID;
        try
        {
            require_once '../../DataBase/PDO/DBconnect/DBconnect.php';
            $sql = "INSERT INTO purchasecart (cus_ID, prv_ID, sum, date1, address, authority, RefID, verify, items) VALUES(:cus_ID, :prv_ID, :sum, :date1, :address, :authority, :RefID, :verify, :items);";
            $stmt    = $db->prepare($sql);
            $bindArr = array
            (
                ':cus_ID' => $_SESSION['cus_ID'], ':prv_ID' => $_SESSION['cus']['prv_ID'], ':sum' => $_SESSION['cus']['sumAll'], ':date1' => date("Y-m-d H:i:s"), ':address' => $_SESSION['cus']['address'], ':authority' => $Authority, ':RefID' => $result->RefID, ':verify' => 'suspended_order', 'items' => json_encode($_SESSION['cus']['order'], JSON_UNESCAPED_UNICODE),
            );
            $stmt->execute($bindArr);
            $errInfo = $stmt->errorInfo();
            unset($_SESSION['order']);
            $_SESSION['timer'] = time();
            $fac               = "";
            $tab               = "                                        ";
            $i=0;
            foreach ($factor as $v)
            {
                print_r($v);
                $len = strlen($v['name'].$v['count']);
                $fac .= "\n".$v['name'] . "\n" . "(" . $v['count'] . " عدد)";
            }
            $a=explode('|', trim($_SESSION['cus']['address'],"'"));
            $a=end($a);
            $msg = urlencode("فودرز
مدیریت محترم ".$_SESSION['cus']['provideType']." ".$_SESSION['cus']['providerName']." شما یک سفارش جدید از سامانه فودرز دارید.
اطلاعات مشتری
اسم: ".$_COOKIE['fname']." ".$_COOKIE['lname']."
شماره تماس: ".$_SESSION['phone']."
آدرس: ".$a."

فاکتور:$fac
جهت پیگیری و ثبت نهایی سفارش به پنل مدیریتی خود در فودرز مراجعه نمایید.");
            $url = "http://smspanel.Trez.ir/SendMessageWithCode.ashx?Username=noohpishe&Password=106010602055&Mobile=" . $_SESSION['cus']['prv_clg_phone'] . "&Message=$msg";
            $ch  = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_exec($ch);
            curl_close($ch);
//ssssssssssssssssmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmsssssssssssssssssssssss
$delivery_time = date("H:i",($_SESSION['cus']['delTime']*60)+$_SESSION['timer']);
$cus_msg = urlencode("فودرز
".$_COOKIE['fname']." عزیز سفارش شما توسط ".$_SESSION['cus']['provideType']." ".$_SESSION['cus']['providerName']." در حال آماده سازی می‌باشد و تا ".$_SESSION['cus']['delTime']." دقیقه دیگر ($delivery_time) به دست شما خواهد رسید.
فاکتور:$fac
جمع کل: ".number_format($_SESSION['cus']['sumAll'])." تومان
در صورت تاخیر در ارسال سفارش با واحد پشتیبانی تماس حاصل فرمایید.
تلفن پشتیبانی: 07136281488");
            $url = "http://smspanel.Trez.ir/SendMessageWithCode.ashx?Username=noohpishe&Password=106010602055&Mobile=" . $_SESSION['phone'] . "&Message=$cus_msg";
            $ch  = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_exec($ch);
            curl_close($ch);
        }
        catch (Exception $e)
        {
            $err = $e->getMessage();
        }
        // header("Location: ../payment_completed.php");
        // echo $err;
    }
    else
    {
        echo 'Transation failed. Status:' . $result->Status;
    }
}
else
{
    echo 'Transaction canceled by user';
}