<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
//header('Content-Type: text/html; charset=utf-8');
/**
 * Created by PhpStorm.
 * User: unixname
 * Date: 9/1/18
 * Time: 6:24 PM
 */
var_dump($_POST);
if (isset($_POST['sub']))
{
    //array begining

    // $menu = [];
    // $sarMenu = [];
    // $ghaza = [];
    // $parent['menu'] = $menu;
    if (!is_dir("/home/imaohw/images/" . md5($_POST['prv_ID']."khardal")))
    {
        mkdir("/home/imaohw/images/" . md5($_POST['prv_ID']."khardal"));
    }
    foreach ($_POST as $k => $v)
    {
        if (substr($k, 0, 3) == 'cat')
        {
            $GLOBALS['sname'] = $v;
            $parent['parent']['menu'][$sname] = [] ;
        }
        elseif (substr($k, 0, 2) == 'ff')
        {
            $GLOBALS['fname'] = $v;
            $parent['parent']['menu'][$sname][$fname] = [];
            $img_id = "upload" . substr($k, -4);
            $gfood = "gfood". substr($k, -4);
            $GLOBALS['tmp'] = $_FILES[$img_id]['tmp_name'];
            $parent['parent']['menu'][$sname][$fname]['path'] = uploadFile($img_id, $v, $gfood);
            //when you want show this in provider menu ==>make value of inp:file and if value was filled change path and remove current image form dir
        }
        elseif (substr($k, 0, 2) == 'tf')
        {
            $parent['parent']['menu'][$sname][$fname]['desc'] = $v;
        }
        elseif (substr($k, 0, 2) == 'gf')
        {
            $parent['parent']['menu'][$sname][$fname]['price'] = $v;
        }
        // uploadFile($_FILES);
    }
    // var_dump($parent);
    echo "post: ".var_dump($_POST);
    $jsonAll = json_encode($parent, JSON_UNESCAPED_UNICODE);
    //array ending
    try
    {
        require_once "../../DataBase/PDO/DBconnect/DBconnect.php";
        $sql = "UPDATE provider SET menu=:menu WHERE prv_ID=:prv_ID";
        $stmt = $db->prepare($sql);
        $prv_ID = $_POST['prv_ID'];
        $BindArr = array
        (
            ':menu' => "$jsonAll",
            ':prv_ID' => "$prv_ID",
        );
        $stmt->execute($BindArr);
    }
    catch (Exception $e)
    {
        $err = $e->getMessage();
    }

    // var_dump($json);
    // print_r($parent['menu']);
}
elseif (isset($_POST['subm']))
{
    echo 'resturant time info is ';
    // var_dump($_POST);
    $weeklyWorkTIme = [];
    $weeklyWorkTIme['morning']['From'] = $_POST['morningFrom'];
    $weeklyWorkTIme['morning']['To'] = $_POST['morningTo'];
    $weeklyWorkTIme['evening']['From'] = $_POST['eveningFrom'];
    $weeklyWorkTIme['evening']['To'] = $_POST['eveningTo'];
    $weeklyWorkTIme['midnight']['From'] = $_POST['midnightFrom'];
    $weeklyWorkTIme['midnight']['To'] = $_POST['midnightTo'];
    $weeklyWorkTIme = json_encode($weeklyWorkTIme);
    var_dump($weeklyWorkTIme);

    $delTime['min'] = $_POST['minDelTime'];
    $delTime['max'] = $_POST['maxDelTime'];
    $delTime = json_encode($delTime);
    //import to database
    try
    {
        require_once "../../DataBase/PDO/DBconnect/DBconnect.php";
        $sql = "UPDATE provider SET deliveryTime=:deliveryTime, weeklyWorkTIme=:weeklyWorkTIme WHERE prv_ID=:prv_ID";
        $stmt = $db->prepare($sql);
        $prv_ID = $_POST['prv_ID'];
        $BindArr = array
            (
            ':weeklyWorkTIme' => "$weeklyWorkTIme",
            ':prv_ID' => "$prv_ID",
            ':deliveryTime' => $delTime
        );
        $stmt->execute($BindArr);
    }
    catch (Exception $e)
    {
        $err = $e->getMessage();
    }

}

function uploadFile($file, $food_name, $price)
{
    $tmpPath = $_FILES[$file]['tmp_name'];
    $name = $_FILES[$file]["name"];
    $exp = explode(".", $name);
    $ext = end($exp);
    $fileName = $food_name . "_" . $price . "." . $ext;
    $myPath = "/home/imaohw/images/";
    $prvID = $_POST['prv_ID'];
    $new_dir = md5($prvID."khardal") . "/"; //provider ID
    // $new_dir = str_replace(    " ","",$new_dir);
    $absolutePath = $myPath . $new_dir . $fileName;
    if (is_uploaded_file("$tmpPath"))
    {
        move_uploaded_file($tmpPath, $absolutePath) or die("not to copy");
    }
    return $absolutePath;
}
?>
</body>
</html>