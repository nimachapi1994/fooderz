<?php
session_start();
// print_r($_SESSION);
// die();
require_once '../DataBase/PDO/DBconnect/DBconnect.php';
if (isset($_POST['sub']))
{
    try {
        $sql  = 'SELECT * FROM provider WHERE mobile=:user AND password=:password';
        $stmt = $db->prepare($sql);
        $stmt->execute(
            array(
                ':password' => sha1($_POST['pass']),
                ':user'     => $_POST['user'],
            )
        );
        $errorInfo = $stmt->errorInfo();
    }
    catch (Exception $e)
    {
        $error = $e->getMessage();
    }
    $login = $stmt->rowCount();
    if ($login === 1)
    {
        $_SESSION['provider_login'] = $stmt->fetch()['prv_ID'];
        header("Location: provider/provider_info.php");
    }
}
elseif (isset($_POST['ch_sub']) && isset($_SESSION['provider_login']) && $_SESSION['provider_login'] != "")
{
    try
    {
        $sql  = 'UPDATE provider SET password=:password WHERE prv_ID=:prv_ID';
        $stmt = $db->prepare($sql);
        $stmt->execute(
            array(
                ':password' => sha1($_POST['ch_pass']),
                ':prv_ID'   => $_SESSION['provider_login'],
            )
        );
        $errorInfo = $stmt->errorInfo();
    }
    catch (Exception $e)
    {
        $error = $e->getMessage();
    }
    $_SESSION['provider_login'] = "";
}
elseif (isset($_SESSION['provider_login']) && $_SESSION['provider_login'] != "")
{
    header("Location: provider/provider_info.php");
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>ورود رستوران</title>
		<!-- custom-theme -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<!-- //custom-theme -->
		<link href="css/other_styles.css" rel="stylesheet" type="text/css" media="all" />
		<link href="css/style.css" rel="stylesheet" type="text/css" media="all" /><!-- Theme-CSS -->
	</head>
	<body>

		<div class="res_login_wrapper">
			<div class="res_login_container">
				<a href="index.php">
					<img src="images/logo.png" alt="fooderz logo" width="70px" />
				</a>
				<h1 class="res_login_h1">ورود صاحب رستوران به پنل</h1>
				<form class="res_login_form" action="" method="post">
					<input name="user" type="text" placeholder="نام کاربری">
					<input name="pass" type="password" placeholder="رمز عبور">
					<button name="sub" type="submit" id="login-button">ورود</button>
				</form>
			</div>

			<ul class="bg-bubbles">
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
			</ul>
		</div>

		<script src="js/plugins.min.js"></script>
		<script src="js/layout.js"></script>
	</body>
</html>
