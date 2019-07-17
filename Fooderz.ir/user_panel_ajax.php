<?php
session_start();
// var_dump($_SESSION);
var_dump($_POST);
require_once '../DataBase/PDO/DBconnect/DBconnect.php';
if (!empty($_POST['lname']))
{
    try
    {
        $sql     = "update customers set fname=:fname, lname=:lname, cardNum=:cardNumber WHERE phone=:phone";
        $stmt    = $db->prepare($sql);
        $bindArr = array
            (
            ":phone"      => $_SESSION['phone'],
            ":fname"      => $_POST['fname'],
            ":lname"      => $_POST['lname'],
            ":cardNumber" => $_POST['cardNumber'],
        );
        $stmt->execute($bindArr);
        $errInfo = $stmt->errorInfo();
    }
    catch (Exception $e)
    {
        $err = $e->getMessage();
    }
}
if (!empty($_POST['re_pass']))
{
    if (!empty($_POST['pass']) && !empty($_POST['current_pass']) && $_POST['pass'] == $_POST['re_pass'])
    {
        $pass = $_POST['current_pass'];
        $sha1 = sha1($pass);
        try
        {
            $sql  = "SELECT cus_ID FROM customers WHERE phone=:phone and password=:password";
            $stmt = $db->prepare($sql);
            $stmt->execute(array(':phone' => $_SESSION['phone'], ':password' => $sha1));
            $res     = $stmt->rowCount();
            $errInfo = $stmt->errorInfo();
        }
        catch (Exception $e)
        {
            $err = $e->getMessage();
        }
        // echo $sha1;
        // echo $res['password'];
        // var_dump($res);
        if ($res === 1)
        {
            try
            {
                $sql     = "update customers set password=:password WHERE phone=:phone";
                $stmt    = $db->prepare($sql);
                $bindArr = array
                    (
                    ":phone"    => $_SESSION['phone'],
                    ":password" => sha1($_POST['pass']),
                );
                $stmt->execute($bindArr);
                $errInfo = $stmt->errorInfo();
            }
            catch (Exception $e)
            {
                $err = $e->getMessage();
            }
        }
    }
}
// echo $err;
