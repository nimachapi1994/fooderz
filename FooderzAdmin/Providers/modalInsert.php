<meta charset="utf-8">
<?php
include $_SERVER["DOCUMENT_ROOT"]."/Fooderz/funx.php";
/**
 *
 */
var_dump($_POST);
date_default_timezone_set('Asia/Tehran');
include arp("jdf/jdf.php");
$year = "13" . $_POST['year'];
$month = $_POST['month'];
$day = $_POST['day'];
$bornDate = ($day != '') ? jalali_to_gregorian($year, $month, $day, "-") : "";
//date end
$branch = $_POST["branch"];
if (empty($branch))
{
    $branch = "NO BRANCH";
}

$minimomOrder = $_POST["minimomOrder"];
$providerName = $_POST["providerName"];
$managerName = $_POST["managerName"];
$city = $_POST["city"];
$address = $_POST["address"];
$postalCode = $_POST["postalCode"];
$mobile = $_POST["mobile"];
$telephone = $_POST["telephone"];
$provideType = $_POST["provideType"];
$resturantType = (!empty($_POST["resturantType"])) ? $_POST["resturantType"] : "NOT RESTAURANT";
$myJSON = $_POST["myJSON"];
$prv_ID = $_POST["prv_ID"];
$description = $_POST["description"];
$modalSub = $_POST["modalSub"];
$chConfirm = (isset($_POST["chConfirm"])) ? 1 : null;
$smsConfirm = (isset($_POST["smsConfirm"])) ? 1 : null;
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];
$sheba = $_POST['sheba'];
$motto = $_POST['motto'];
$deliveryCost = $_POST['deliveryCost'];
$orderType = $_POST['orderType'];
$colleague_mobile = $_POST['colleague_mobile'];
echo "chForm is: " . $chConfirm;
foreach ($_FILES as $k => $v)
{
    uploadFile($k);
}
/**
 * @param $file
 */
function uploadFile($file)
{
    $tmpPath = $_FILES[$file]['tmp_name'];
    $name = $_FILES[$file]["name"];
    $exp = explode(".", $name);
    $ext = end($exp);
    $fileName = $file . "_" . $GLOBALS['providerName'] . "_" . $GLOBALS['managerName'] . "." . $ext;
    $myPath = ($file == "logoImg") ? "../../images/logo/" : "/home/imaohw/images/";
    $prvName = $_POST['prv_ID'] . "/"; //provider ID
    $prvID = $_POST['prv_ID'];
//    $prvName = str_replace(" ","",$prvName);
    $absolutePath = $myPath . $prvName . $fileName;
    if (!is_dir($myPath . $prvName))
    {
        mkdir($myPath . $prvName);
    }

    if (is_uploaded_file("$tmpPath"))
    {
        if ($file == "logoImg")
        {
            $files = glob($myPath . $prvName . "*");
            foreach ($files as $file)
            { // iterate files
                if (is_file($file))
            {
                    unlink($file);
                }
                // delete file
            }
        }
        move_uploaded_file($tmpPath, $absolutePath) or die("not to copy");
    }
    switch ($file)
    {
    case 'logoImg':
        $GLOBALS['logoImg'] = $absolutePath;
        break;
    case 'nationalCardImg':
        $GLOBALS['nationalCardImg'] = $absolutePath;
        break;
    case 'contractZip':
        $GLOBALS['contractZip'] = $absolutePath;
        break;
    }
}
//end
$datenTime = "";
if ($smsConfirm == 1)
{
//    $code = rand(10000,99999);
    $msg = urlencode("با سلام \n " . $managerName . " عزیز رستوران شما توسط ادمین تایید شد!!!");
    $url = "http://smspanel.Trez.ir/SendMessageWithCode.ashx?Username=noohpishe&Password=106010602055&Mobile=$mobile&Message=$msg";
    file_get_contents($url);

    $datenTime = date("Y-m-d H:i:s");
}

//database

//`email`=[value-6],`AverageDeliveryTime`=[value-22],`weeklyWorkTIme`=[value-21],`deliveryCost`=[value-23],`URL`=[value-24],`sheba_number`=[value-30],
//,`bornDate`='$bornDate' ,`reserve`='$r'
require_once "../../DataBase/PDO/DBconnect/DBconnect.php";
$country = "iran";
$state = "فارس";
$sql = "UPDATE provider SET providerName= :providerName,telephone= :telephone,managerName= :managerName,
mobile= :mobile,address= :address,country= :country,state= :state,city= :city,regions= :myJSON,postalCode= :postalCode,
provideType= :provideType,resturantType= :resturantType,datenTime= :datenTime,bornDate= :bornDate,minimomOrder= :minimomOrder,
logoPath= :logoImg,natCardPath= :nationalCardImg,contractPath= :contractZip,confirmByAdmin= :chConfirm,description= :description,
branch= :branch, latitude=:latitude, longitude=:longitude, sheba_number=:sheba, motto=:motto, deliveryCost=:deliveryCost, orderType=:orderType, colleague_mobile=:colleague_mobile";
if ($chConfirm==1) 
{
    $sql.=", password = :password";
}
$sql.=' WHERE prv_ID = :prv_ID';
$stmt = $db->prepare($sql);
$country = "iran";
$state = "فارس";
$BindArr = array
    (
    ':providerName' => "$providerName",
    ':telephone' => "$telephone",
    ':managerName' => "$managerName",
    ':mobile' => "$mobile",
    ':address' => "$address",
    ':country' => "$country",
    ':state' => "$state",
    ':city' => "$city",
    ':myJSON' => "$myJSON",
    ':postalCode' => "$postalCode",
    ':provideType' => "$provideType",
    ':resturantType' => "$resturantType",
    ':datenTime' => "$datenTime",
    ':bornDate' => "$bornDate",
    ':minimomOrder' => "$minimomOrder",
    ':logoImg' => "$logoImg",
    ':nationalCardImg' => "$nationalCardImg",
    ':contractZip' => "$contractZip",
    ':chConfirm' => $chConfirm,
    ':description' => "$description",
    ':branch' => "$branch",
    ':prv_ID' => "$prv_ID",
    ':latitude' => "$latitude",
    ':longitude' => "$longitude",
    ':sheba' => "$sheba",
    ':motto' => "$motto",
    ':deliveryCost' => "$deliveryCost",
    ':orderType' => "$orderType",
    ':colleague_mobile' => $colleague_mobile
);
if ($chConfirm==1)
{
    $BindArr['password'] = sha1('123456');
    try
    {
        $curDate = date('Y-m-d H:i:s');
        $nextDate = date('Y-m-d', strtotime($curDate.' +9 days'));
        $sql     = "call financial($prv_ID, '$curDate', '$nextDate')";
        $stmt    = $db->prepare($sql);
        $stmt->execute();
        $errInfo = $stmt->errorInfo();
        // header("Location: BuyReport.php");
    }
    catch (Exception $e)
    {
        $err = $e->getMessage();
    }
}
$stmt->execute($BindArr);