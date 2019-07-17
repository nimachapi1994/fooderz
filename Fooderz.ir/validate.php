<?php
/**
 * Created by PhpStorm.
 * User: unixname
 * Date: 8/7/18
 * Time: 8:14 PM
 */
//     $coo = json_decode($_POST['hidden_coords'],1);
// print_r($coo['phi']);
// die();
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $coo = json_decode($_POST['hidden_coords'],1);
    $resName = test_input($_POST['resName']);
    $mngrName = test_input($_POST['mngrName']);
    $city = test_input($_POST['city']);
    $address = test_input($_POST['address']);
    $phone = test_input($_POST['phone']);
    $mobile = test_input($_POST['mobile']);
    $provType = test_input($_POST['provType']);
    $resType = (isset($_POST['resType']) ? test_input($_POST['resType']) : '');
    $desc = test_input($_POST['desc']);
    $lat = test_input($coo['phi']);
    $lng = test_input($coo['landa']);
    $X = test_input($coo['x']);
    $Y = test_input($coo['y']);
    $Arr = [];
    $err = '';
    if ($resName == '')
    {
//        echo 'فیلد رستوران خالی است.' . "<br>";
        $Arr['resErr'] = 'فیلد رستوران خالی است.';
        $err = 'err';
    }
    if ($mngrName == '')
    {
//        echo 'فیلد نام مدیر خالی است' . "<br>";
        $Arr['mngErr'] = 'فیلد نام مدیر خالی است';
        $err = 'err';
    }
    if ($phone == '')
    {
//        echo 'فیلد تلفن خالی است' . "<br>";
        $Arr['phoneErr'] = 'فیلد تلفن خالی است';
        $err = 'err';
    } elseif (!preg_match('/^0[0-9]{10}$/', $phone))
    {
//        echo 'شماره تلفن اشتباه است' . "<br>";
        $Arr['phoneErr'] = 'شماره تلفن اشتباه است';
        $err = 'err';
    }
    if ($mobile == '')
    {
//        echo 'فیلد موبایل خالی است' . "<br>";
        $Arr['mobileErr'] = 'فیلد موبایل خالی است';
        $err = 'err';
    } elseif (!preg_match('/^09[0-9]{9}$/', $mobile))
    {
//        echo 'شماره موبایل اشتباه است' . "<br>";
        $Arr['mobileErr'] = 'شماره موبایل اشتباه است';
        $err = 'err';
    }
    if ($provType == "--نوع ارایه خدمات--")
    {
//        echo 'نوع خدمات خود را انتخاب کنید.' . "<br>";
        $Arr['prvErr'] = 'نوع خدمات خود را انتخاب کنید.';
        $err = 'err';
    }
    else
    {
        if ($provType == "رستوران" && $resType == "--نوع رستوران--")
        {
//            echo 'نوع رستوران خود را انتخاب کنید.' . "<br>";
            $Arr['resTypeErr'] = 'نوع رستوران خود را انتخاب کنید.';
            $err = 'err';
        }
        elseif ($provType != "رستوران")
        {
            $resType = 'empty';
        }
    }
    if ($err == '')
    {
        date_default_timezone_set('Asia/Tehran');
        $early_datenTime = date("Y-m-d H:i:s");
        try
        {
            require_once '../DataBase/PDO/DBconnect/DBconnect.php';
            $sql = 'INSERT INTO provider(providerName, managerName, city, address, telephone, mobile, provideType, resturantType, description, early_datenTime, latitude, longitude, X, Y)
                    VALUES(:resName, :mngrName, :city, :address, :telephone, :mobile, :provideType, :resturantType, :description, :early_datenTime, :latitude, :longitude, :X, :Y)';
            $stmt = $db->prepare($sql);
            $BindArr = array
            (
                ':resName' => $resName,
                ':mngrName' => $mngrName,
                ':city' => $city,
                ':address' => $address,
                ':telephone' => $phone,
                ':mobile' => $mobile,
                ':provideType' => $provType,
                ':resturantType' => $resType,
                ':description' => $desc,
                ':early_datenTime' => $early_datenTime,
                ':latitude' => $lat,
                ':longitude' => $lng,
                ':X' => $X,
                ':Y' => $Y
            );
            $stmt->execute($BindArr);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $Arr['ok'] = 'yes';
        }
        catch (Exception $e)
        {
            $PDOerr = $e->getMessage();
        }

    }


//    foreach ($_POST as $k => $v)
//    {
//        echo $k . " ==> " . $v . "<br>";
//    }
}
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return trim($data);
}
if (isset($errInfo))
{
    print_r($errInfo);
}
if (isset($PDOerr))
{
    var_dump($PDOerr);
}
echo json_encode($Arr);