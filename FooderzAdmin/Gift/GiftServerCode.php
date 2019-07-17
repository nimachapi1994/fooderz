<?php

include "../../DataBase/PDO/DBconnect/DBconnect.php";

if(isset($_POST["cusname"]))
{
    echo $_POST["cusname"];
    try
    {
        $id=$_POST["cusname"];
        $query='update Customers set Gift =:val where cus_ID= :id';
        $stmt=$db->prepare($query);
        $arrTakeGiftCustomer=[":val"=>1,":id"=>$id];
        $stmt->execute($arrTakeGiftCustomer);
        $stmt->errorInfo();


    }
    catch (Exception $ex)
    {
        $err=
            $ex->getMessage();
    }
}




if(isset($_POST["prvname"]))
{
    echo $_POST["prvname"];
    try
    {
        $id1=$_POST["prvname"];
        $query1='update provider set Gift =:val where prv_ID= :id';
        $stmt1=$db->prepare($query1);
        $arrTakeGiftProvider=[":val"=>1,":id"=>$id1];
        $stmt1->execute($arrTakeGiftProvider);
        $stmt1->errorInfo();


    }
    catch (Exception $ex)
    {
        $err=
            $ex->getMessage();
    }
}

