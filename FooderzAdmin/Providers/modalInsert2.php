<?php
/**
 *
 */
var_dump($_POST);
date_default_timezone_set('Asia/Tehran');
$datenTime = date("Y-m-d h:i:s");
$branch = $_POST["branch"];
if (empty($branch)) $branch = "NO BRANCH";
$minimomOrder = $_POST["minimomOrder"];
$providerName = $_POST["providerName"];
$managerName = $_POST["managerName"];
$city = $_POST["city"];
$address = $_POST["address"];
$postalCode = $_POST["postalCode"];
$mobile = $_POST["mobile"];
$bornDate = $_POST["bornDate"];
$telephone = $_POST["telephone"];
$provideType = $_POST["provideType"];
$resturantType = $_POST["resturantType"];
$myJSON = $_POST["myJSON"];
$prv_ID = $_POST["prv_ID"];
$description = $_POST["description"];
$modalSub = $_POST["modalSub"];
$chConfirm = (isset($_POST["chConfirm"])) ? 1 : 0;
echo $chConfirm;
foreach ($_FILES as $k => $v)
{
   uploadFile($k);
}
function uploadFile($file)
{
   $tmpPath = $_FILES[$file]['tmp_name'];
    $fileName = $file."_".$_FILES[$file]['name'];
    $myPath = "/home/unixname/images/";
    $prvName = $_POST['prv_ID']."/"; //provider ID
    $absolutePath = $myPath.$prvName.$fileName;
    if (!is_dir($myPath.$prvName))
        mkdir($myPath.$prvName);
    if(is_uploaded_file("$tmpPath"))
    {
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
//`email`=[value-6],`AverageDeliveryTime`=[value-22],`weeklyWorkTIme`=[value-21],`deliveryCost`=[value-23],`URL`=[value-24],`sheba_number`=[value-30],
//,`bornDate`='$bornDate' ,`reserve`='$r'
require_once "../../DataBase/PDO/DBconnect/DBconnect.php";
$country ="iran";
$state = "فارس";
$sql = "UPDATE provider SET providerName= '$providerName',telephone= '$telephone',managerName= '$managerName',
mobile= '$mobile',address= '$address',country= '$country',state= '$state',city= '$city',regions= '$myJSON',postalCode= '$postalCode',
provideType= '$provideType',resturantType= '$resturantType',datenTime= '$datenTime',bornDate= '$bornDate',minimomOrder= '$minimomOrder',
logoPath= '$logoImg',natCardPath= '$nationalCardImg',contractPath= '$contractZip',confirmByAdmin= '$chConfirm',description= '$description',
branch= '$branch' WHERE prv_ID = '$prv_ID'";
$stmt = $db->exec($sql);
$country ="iran";
$state = "فارس";
//$BindArr = array
//(
//    ':providerName' => $providerName,
//    ':telephone' => $telephone,
//    ':managerName' => $managerName,
//    ':mobile' => $mobile,
//    ':address' => $address,
//    ':country' => $country,
//    ':state' => $state,
//    ':city' => $city,
//    ':regions' => $myJSON,
//    ':postalCode' => $postalCode,
//    ':provideType' => $provideType,
//    ':resturantType' => $resturantType,
//    ':datenTime' => "$datenTime",
//    ':bornDate' => $bornDate,
//    ':minimomOrder' => $minimomOrder,
//    ':logoPath' => $logoImg,
//    ':natCardPath' => $nationalCardImg,
//    ':contractPath' => $contractZip,
//    ':confirmByAdmin' => $chConfirm,
//    ':description' => $description,
//    ':branch' => $branch,
//    ':prv_ID' => $prv_ID
//);
//$stmt->execute($BindArr);
//echo $logoImg;