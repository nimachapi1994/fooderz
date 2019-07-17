<?php
session_start();
require_once '../DataBase/PDO/DBconnect/DBconnect.php';
	try
	{
		$sql = "SELECT cus_ID, password FROM customers WHERE phone=:phone";
		// $sql = "INSERT INTO customers(phone) VALUES()";
		$stmt0 = $db->prepare($sql);
		$stmt0->execute([':phone' => $_SESSION['phone']]);
		$res1 = $stmt0->fetch();
		$passwd = $res1['password'];
		$_SESSION['cus_ID'] = $res1['cus_ID'];
		$errInfo0 = $stmt0->errorInfo();
		// var_dump($res);
		// die();
	}
	catch (Exception $e)
	{
		$err0 = $e->getMessage();
	}
var_dump($res1);