<?php
date_default_timezone_set('Asia/Tehran');
include "../../DataBase/PDO/DBconnect/DBconnect.php";
if (isset($_POST['sub']) && !empty($_POST['auth']))
{
    var_dump($_POST);
    // die();
    $nowTime  = date('Y-m-d H:i:s');
    $nowDate  = date('Y-m-d');
    $nextDate = date('Y-m-d', strtotime($nowDate . ' +9 days'));
    $id       = $_POST['ID'];
    $prv_ID   = $_POST['prv_ID'];
    $income   = $_POST['income'];
    $auth     = $_POST['auth'];
    try
    {
        $now = date('Y-m-d');
        $sql = "UPDATE deposite SET income='$income', t_action='$auth', dateAndTimePeyment = '$nowTime' WHERE income='' AND t_action='' AND willBePaydate < '$nowDate' AND prv_ID=$prv_ID;

		        UPDATE purchasecart SET deposite_ID=$id WHERE prv_ID=prv_ID AND date1 < '$nowDate' AND prv_ID=$prv_ID;

		        INSERT INTO deposite(prv_ID,willBePaydate) VALUES($prv_ID,'$nextDate');";
        $stmt = $db->prepare($sql);
        // echo $sql;
        // die();
        $stmt->execute();
        $errInfo = $stmt->errorInfo();
        header("Location: financial.php");
    }
    catch (Exception $e)
    {
        $err = $e->getMessage();
    }
}
