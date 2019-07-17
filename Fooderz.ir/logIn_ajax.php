<?php
// var_dump($_POST);
session_start();
// var_dump($_SESSION);
// die();
if (isset($_POST['logout']) && $_POST['logout'] == 'oui') {
	session_unset();
	// echo 'logout';
	// die();
}
if (isset($_POST['phone']) && preg_match("/^09[0-9]{9}$/", $_POST['phone']))
{
	$phone = $_POST['phone'];
	// die('correct');
}
// var_dump($_POST);
// die();
include $_SERVER["DOCUMENT_ROOT"] . "/Fooderz/funx.php";
require_once '../DataBase/PDO/DBconnect/DBconnect.php';
if (isset($phone))
{
	// $DBphone = (isset($phone))?$phone:$_SESSION['phone'];
	try
	{
		$sql = "SELECT cus_ID, password FROM customers WHERE phone=:phone";
		// $sql = "INSERT INTO customers(phone) VALUES()";
		$stmt0 = $db->prepare($sql);
		$stmt0->execute([':phone' => $phone]);
		$var = $stmt0->fetch()['cus_ID'];
		$errInfo0 = $stmt0->errorInfo();
		// var_dump($res);
		// die();
	}
	catch (Exception $e)
	{
		$err0 = $e->getMessage();
	}
	if (empty($var))
	{
		// session_destroy();
		$_SESSION['code'] = rand(1000, 9999);
		$msg = urlencode("کد فعال سازی \n " . $_SESSION['code']);
		$url = "http://smspanel.Trez.ir/SendMessageWithCode.ashx?Username=noohpishe&Password=106010602055&Mobile=$phone&Message=$msg";
		file_get_contents($url);
		$_SESSION['level'] = 2;
	}
	else
	{
		$_SESSION['level'] = 'phone_exist';
		$_SESSION['phoneSTS'] = 'exist';
		// $passwd = $stmt0->fetch()['password'];
	}
	$_SESSION['phone'] = $phone;

}
elseif (empty($var) && isset($_SESSION['phone']) && !isset($_SESSION['phoneSTS']))
{
	if ($_SESSION['level'] == 2 && $_POST['cnfCode'] == $_SESSION['code'] && !isset($_SESSION['position']))
	{
		try
		{
			$sql = "INSERT INTO customers(phone, SignupDate) VALUES(:phone, :SignupDate)";
			$stmt0 = $db->prepare($sql);
			$stmt0->execute([':phone' => $_SESSION['phone'], ':SignupDate' => date("Y-m-d H:i:s")]);
			$errInfo0 = $stmt0->errorInfo();
		}
		catch (Exception $e)
		{
			$err0 = $e->getMessage();
		}
		$_SESSION['level'] = 'sms_confirmed';

	}
	elseif ($_SESSION['level'] == 'sms_confirmed' && isset($_POST['pass']) && isset($_POST['rePass']) && $_POST['rePass'] == $_POST['pass'])
	{
		$password = sha1($_POST['pass']);
		try
		{
			$sql = "UPDATE customers SET password=:password, fname=:fname, lname=:lname WHERE phone=:phone";
			$stmt0 = $db->prepare($sql);
			$stmt0->execute([':phone' => $_SESSION['phone'], ':password' => $password, ':fname' => $_POST['fname'], ':lname' => $_POST['lname']]);
			$errInfo0 = $stmt0->errorInfo();
		}
		catch (Exception $e)
		{
			$err1 = $e->getMessage();
		}
		session_unset();
		$_SESSION['level'] = 'pass_saved';
	}
	else
	{
		echo ('error');
	}
}
elseif ($_SESSION['level'] == 'phone_exist' && isset($_POST['enTpass']))
{
	try
	{
		$sql = "SELECT cus_ID, password, fname, lname  FROM customers WHERE phone=:phone";
		// $sql = "INSERT INTO customers(phone) VALUES()";
		$stmt0 = $db->prepare($sql);
		$stmt0->execute([':phone' => $_SESSION['phone']]);
		$res1 = $stmt0->fetch();
		$passwd = $res1['password'];
		$_SESSION['cus_ID'] = $res1['cus_ID'];
		setcookie("fname", $res1['fname'], time() + (86400 * 30)); // 86400 = 1 day
		setcookie("lname", $res1['lname'], time() + (86400 * 30)); // 86400 = 1 day
		$errInfo0 = $stmt0->errorInfo();
		// var_dump($res1);
		// die();
	}
	catch (Exception $e)
	{
		$err0 = $e->getMessage();
	}
	// echo $passwd.'<br>';
	// echo sha1($_POST['enTpass']);
	if ($passwd == sha1($_POST['enTpass']))
	{
		// session_unset();
		$_SESSION['user'] = 'login';
		$_SESSION['level'] = 'login';
		// var_dump($_SESSION);
		// die();
	}
	else
	{
		echo 'pass wrong';
	}
}
elseif (isset($_POST['forget']) && $_POST['forget'] == 'pass')
{
	$phone1 = $_SESSION['phone'];
	$_SESSION['code'] = rand(1000, 9999);
	$msg = urlencode("کد فعال سازی \n " . $_SESSION['code']);
	$url = "http://smspanel.Trez.ir/SendMessageWithCode.ashx?Username=noohpishe&Password=106010602055&Mobile=$phone1&Message=$msg";
	file_get_contents($url);
	$_SESSION['level'] = 2;
	$_SESSION['position'] = 'forget';
}
elseif ($_SESSION['position'] == 'forget' && @$_POST['cnfCode'] == $_SESSION['code'])
{
	$_SESSION['level'] = 'sms_confirmed';
	unset($_SESSION['phoneSTS']);
}
echo $_SESSION['level'];
?>