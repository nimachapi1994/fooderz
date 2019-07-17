<?php
date_default_timezone_set('Asia/Tehran');
include_once '../../jdf/jdf.php';


include "../../DataBase/PDO/DBconnect/DBconnect.php";
if(isset($_POST["btnupdate"]))
{
    if(!empty($_POST["name"])&&!empty($_POST["mobile1"])&&!empty($_POST["mobile2"])&&
        !empty($_POST["phone"])&&!empty($_POST["OrderType"])&&!empty($_POST["sday"])&&
        !empty($_POST["smonth"])&&!empty($_POST["syear"])
        &&!empty($_POST["xday"])&&
        !empty($_POST["xmonth"])&&!empty($_POST["xyear"])&&!empty($_POST["dec"]))

    {
        try{

            $name=$_POST["name"];
            $mobile1=$_POST["mobile1"];
            $mobile2=$_POST["mobile2"];
            $phone=$_POST["phone"];
            $ordertype=$_POST["OrderType"];
            $startDate=($_POST["sday"]&&$_POST["smonth"]&&$_POST["syear"]!='')?
                jalali_to_gregorian('13'.$_POST["syear"],$_POST["smonth"],$_POST["sday"],"-"):'';
            $expDate=($_POST["xday"]&&$_POST["xmonth"]&&$_POST["xyear"]!='')?
                jalali_to_gregorian('13'.$_POST["xyear"],$_POST["xmonth"],$_POST["xday"],"-"):'';
            $description=$_POST["dec"];


            $Update ="update suppliers set
nameAndfname =:name, mobile1=:mobile1, mobile2=:mobile2,
, telephone=:phone, orderType=:ordertype,startdate=:startDate,expdate=:expDate,decription=:description
where id=:id";
            $pdo=$db->prepare($Update);
            $arrUpdate=[
                ":name"=>$name,
                ":mobile1"=>$mobile1,
                ":mobile2"=>$mobile2,
                ":phone"=>$phone,
                ":orderType"=>$ordertype,
                ":startDate"=>$startDate,
                ":expDate"=>$expDate,
                ":description"=>$description,
                "id"=>18
            ];
            $ok= $pdo->execute($arrUpdate);
            $error=$pdo->errorInfo();
            if($ok) header("location:ShowAllSupps.php");

//        if($queryok)
//        {
//
//        }
//die('successssssssssssssssssssss');
        }
        catch (Exception $e)
        {
            $err = $e->getMessage();
        }
//        die($err);
//die();



    }



}