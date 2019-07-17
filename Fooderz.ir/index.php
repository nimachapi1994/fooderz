<?php
session_start();
include_once '../funx.php';
// session_destroy();
if (isset($_POST['loginSub']))
{
    $uPhone = $_POST['user_phone'];
    $uPass  = $_POST['user_pass'];

}
try
{
//        echo $_POST['phoneSrch'];
    require_once '../DataBase/PDO/DBconnect/DBconnect.php';
    $sql     = "SELECT discount, providerName, prv_ID FROM provider WHERE confirmByAdmin=1 and discount>0;SELECT regionName FROM regions ORDER BY region_id;";
    $stmt    = $db->prepare($sql);
    $stmt->execute();
    $discounts = $stmt->fetchAll();
    $stmt->nextRowset();
    $errInfo = $stmt->errorInfo();
}
catch (Exception $e)
{
    $err = $e->getMessage();
}
// print_r($discounts);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Fooderz</title>
		<!-- custom-theme -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<!-- //custom-theme -->
		<link href="css/other_styles.css" rel="stylesheet" type="text/css" media="all" />
		<link href="css/style.css" rel="stylesheet" type="text/css" media="all" /><!-- Theme-CSS -->
	</head>

	<body>
	<!-- page loading -->
	<div class="page-loading">
		<div class="assets">
			<img src="images/logo.png" alt="لوگوی فودرز" width="100px" />
			<p>FOODERZ</p>
			<img src="ajax_loading.gif" alt="در حال بارگذاری" />
		</div>
	</div>

	<!-- mobile menu -->
	<div class="menu_transparent_layer"></div>
	<div class="mobile-menu">
		<div class="profile">
			<svg class="icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 55 55" >
				<path d="M55,27.5C55,12.337,42.663,0,27.5,0S0,12.337,0,27.5c0,8.009,3.444,15.228,8.926,20.258l-0.026,0.023l0.892,0.752  c0.058,0.049,0.121,0.089,0.179,0.137c0.474,0.393,0.965,0.766,1.465,1.127c0.162,0.117,0.324,0.234,0.489,0.348  c0.534,0.368,1.082,0.717,1.642,1.048c0.122,0.072,0.245,0.142,0.368,0.212c0.613,0.349,1.239,0.678,1.88,0.98  c0.047,0.022,0.095,0.042,0.142,0.064c2.089,0.971,4.319,1.684,6.651,2.105c0.061,0.011,0.122,0.022,0.184,0.033  c0.724,0.125,1.456,0.225,2.197,0.292c0.09,0.008,0.18,0.013,0.271,0.021C25.998,54.961,26.744,55,27.5,55  c0.749,0,1.488-0.039,2.222-0.098c0.093-0.008,0.186-0.013,0.279-0.021c0.735-0.067,1.461-0.164,2.178-0.287  c0.062-0.011,0.125-0.022,0.187-0.034c2.297-0.412,4.495-1.109,6.557-2.055c0.076-0.035,0.153-0.068,0.229-0.104  c0.617-0.29,1.22-0.603,1.811-0.936c0.147-0.083,0.293-0.167,0.439-0.253c0.538-0.317,1.067-0.648,1.581-1  c0.185-0.126,0.366-0.259,0.549-0.391c0.439-0.316,0.87-0.642,1.289-0.983c0.093-0.075,0.193-0.14,0.284-0.217l0.915-0.764  l-0.027-0.023C51.523,42.802,55,35.55,55,27.5z M2,27.5C2,13.439,13.439,2,27.5,2S53,13.439,53,27.5  c0,7.577-3.325,14.389-8.589,19.063c-0.294-0.203-0.59-0.385-0.893-0.537l-8.467-4.233c-0.76-0.38-1.232-1.144-1.232-1.993v-2.957  c0.196-0.242,0.403-0.516,0.617-0.817c1.096-1.548,1.975-3.27,2.616-5.123c1.267-0.602,2.085-1.864,2.085-3.289v-3.545  c0-0.867-0.318-1.708-0.887-2.369v-4.667c0.052-0.519,0.236-3.448-1.883-5.864C34.524,9.065,31.541,8,27.5,8  s-7.024,1.065-8.867,3.168c-2.119,2.416-1.935,5.345-1.883,5.864v4.667c-0.568,0.661-0.887,1.502-0.887,2.369v3.545  c0,1.101,0.494,2.128,1.34,2.821c0.81,3.173,2.477,5.575,3.093,6.389v2.894c0,0.816-0.445,1.566-1.162,1.958l-7.907,4.313  c-0.252,0.137-0.502,0.297-0.752,0.476C5.276,41.792,2,35.022,2,27.5z M42.459,48.132c-0.35,0.254-0.706,0.5-1.067,0.735  c-0.166,0.108-0.331,0.216-0.5,0.321c-0.472,0.292-0.952,0.57-1.442,0.83c-0.108,0.057-0.217,0.111-0.326,0.167  c-1.126,0.577-2.291,1.073-3.488,1.476c-0.042,0.014-0.084,0.029-0.127,0.043c-0.627,0.208-1.262,0.393-1.904,0.552  c-0.002,0-0.004,0.001-0.006,0.001c-0.648,0.16-1.304,0.293-1.964,0.402c-0.018,0.003-0.036,0.007-0.054,0.01  c-0.621,0.101-1.247,0.174-1.875,0.229c-0.111,0.01-0.222,0.017-0.334,0.025C28.751,52.97,28.127,53,27.5,53  c-0.634,0-1.266-0.031-1.895-0.078c-0.109-0.008-0.218-0.015-0.326-0.025c-0.634-0.056-1.265-0.131-1.89-0.233  c-0.028-0.005-0.056-0.01-0.084-0.015c-1.322-0.221-2.623-0.546-3.89-0.971c-0.039-0.013-0.079-0.027-0.118-0.04  c-0.629-0.214-1.251-0.451-1.862-0.713c-0.004-0.002-0.009-0.004-0.013-0.006c-0.578-0.249-1.145-0.525-1.705-0.816  c-0.073-0.038-0.147-0.074-0.219-0.113c-0.511-0.273-1.011-0.568-1.504-0.876c-0.146-0.092-0.291-0.185-0.435-0.279  c-0.454-0.297-0.902-0.606-1.338-0.933c-0.045-0.034-0.088-0.07-0.133-0.104c0.032-0.018,0.064-0.036,0.096-0.054l7.907-4.313  c1.36-0.742,2.205-2.165,2.205-3.714l-0.001-3.602l-0.23-0.278c-0.022-0.025-2.184-2.655-3.001-6.216l-0.091-0.396l-0.341-0.221  c-0.481-0.311-0.769-0.831-0.769-1.392v-3.545c0-0.465,0.197-0.898,0.557-1.223l0.33-0.298v-5.57l-0.009-0.131  c-0.003-0.024-0.298-2.429,1.396-4.36C21.583,10.837,24.061,10,27.5,10c3.426,0,5.896,0.83,7.346,2.466  c1.692,1.911,1.415,4.361,1.413,4.381l-0.009,5.701l0.33,0.298c0.359,0.324,0.557,0.758,0.557,1.223v3.545  c0,0.713-0.485,1.36-1.181,1.575l-0.497,0.153l-0.16,0.495c-0.59,1.833-1.43,3.526-2.496,5.032c-0.262,0.37-0.517,0.698-0.736,0.949  l-0.248,0.283V39.8c0,1.612,0.896,3.062,2.338,3.782l8.467,4.233c0.054,0.027,0.107,0.055,0.16,0.083  C42.677,47.979,42.567,48.054,42.459,48.132z" fill="#D80027"/>
			</svg>
			<?php if (isset($_SESSION['user']) && $_SESSION['user'] == 'login')
{
    ?>
			<a class="login_link" href="user_panel.php">ورود به پنل</a>
			<?php }
else
{
    ?>
			<a class="login_link" href="#" data-toggle="modal" data-target="#login-modal">ورود/ثبت نام</a>
			<?php }?>

			<p class="login_link text-center">اعتبار شما: ۲۰۰۰ تومان</p>
			<p class="login_link log_out text-center">
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 529.286 529.286" style="enable-background:new 0 0 529.286 529.286;" xml:space="preserve" width="512px" height="512px">
					<path d="M358.099,74.604c0,0-28.097-12.644-28.097,16.896s27.837,49.363,28.19,49.3c49.147,32.081,81.629,87.559,81.629,150.629     c0,97.746-78.016,177.269-175.177,179.7c-97.161-2.431-175.177-81.954-175.177-179.7c0-63.071,32.483-118.547,81.629-150.629     c0.353,0.063,28.189-19.761,28.189-49.3s-28.097-16.896-28.097-16.896C88.7,111.958,31.31,194.983,31.31,291.429     c0,129.865,104.053,235.413,233.334,237.857c129.281-2.445,233.332-107.992,233.332-237.857     C497.977,194.983,440.587,111.958,358.099,74.604z" fill="#D80027"/>
					<path d="M266.278,0c-26.143,0-34.312,19.141-34.312,26.627v117.159v117.159c0,7.487,8.17,26.627,34.312,26.627     c26.143,0,31.045-19.141,31.045-26.627V143.786V26.627C297.322,19.14,292.421,0,266.278,0z" fill="#D80027"/>
				</svg>
			</p>
		</div>
		<ul class="menu-list">
			<li><a href="">ورود به پنل کاربری</a></li>
			<li><a href="">تماس با فودرز</a></li>
			<li><a href="">قوانین</a></li>
			<li><a href="">راهنمای خرید</a></li>
		</ul>
		<div class="social text-center">
			<a title="اینستاگرام" class="social-link" href="">
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 551.034 551.034">
					<path style="fill:#fff;" d="M386.878,0H164.156C73.64,0,0,73.64,0,164.156v222.722   c0,90.516,73.64,164.156,164.156,164.156h222.722c90.516,0,164.156-73.64,164.156-164.156V164.156   C551.033,73.64,477.393,0,386.878,0z M495.6,386.878c0,60.045-48.677,108.722-108.722,108.722H164.156   c-60.045,0-108.722-48.677-108.722-108.722V164.156c0-60.046,48.677-108.722,108.722-108.722h222.722   c60.045,0,108.722,48.676,108.722,108.722L495.6,386.878L495.6,386.878z"/>
					<path style="fill:#fff;" d="M275.517,133C196.933,133,133,196.933,133,275.516s63.933,142.517,142.517,142.517   S418.034,354.1,418.034,275.516S354.101,133,275.517,133z M275.517,362.6c-48.095,0-87.083-38.988-87.083-87.083   s38.989-87.083,87.083-87.083c48.095,0,87.083,38.988,87.083,87.083C362.6,323.611,323.611,362.6,275.517,362.6z"/>
					<circle style="fill:#fff" cx="418.31" cy="134.07" r="34.15"/>
				</svg>
			</a>
			<a title="تلگرام" class="social-link" href="">
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"viewBox="0 0 300 300">
					<path id="XMLID_497_" d="M5.299,144.645l69.126,25.8l26.756,86.047c1.712,5.511,8.451,7.548,12.924,3.891l38.532-31.412   c4.039-3.291,9.792-3.455,14.013-0.391l69.498,50.457c4.785,3.478,11.564,0.856,12.764-4.926L299.823,29.22   c1.31-6.316-4.896-11.585-10.91-9.259L5.218,129.402C-1.783,132.102-1.722,142.014,5.299,144.645z M96.869,156.711l135.098-83.207   c2.428-1.491,4.926,1.792,2.841,3.726L123.313,180.87c-3.919,3.648-6.447,8.53-7.163,13.829l-3.798,28.146   c-0.503,3.758-5.782,4.131-6.819,0.494l-14.607-51.325C89.253,166.16,91.691,159.907,96.869,156.711z" fill="#fff"/>
				</svg>
			</a>
		</div>
	</div>

	<!-- banner -->
		<div class="banner-header">
			<!--header-->
			<div class="header" id="main_header">
				<div class="container">
					<nav class="navbar navbar-default" id="main_navbar">
						<div class="navbar-header navbar-left">
							<button id="mobile-menu-icon" type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
								<span class="sr-only">منو</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<div class="w3_navigation_pos">
								<h1><a href="index.php">FOODERZ <img class="fooderz_logo rounded" src="images/logo.png" alt="لوگوی فودرز" /></a></h1>
							</div>
						</div>
						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">

						<ul class="menu cf">
							<?php if (isset($_SESSION['user']) && $_SESSION['user'] == 'login')
{

    ?>
							 <li id="user-panel-toggle">
								<a href="#">ورود به پنل</a>
								<div id="panel-dropdown" class="animated zoomIn">
									<svg class="icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 55 55" >
										<path d="M55,27.5C55,12.337,42.663,0,27.5,0S0,12.337,0,27.5c0,8.009,3.444,15.228,8.926,20.258l-0.026,0.023l0.892,0.752  c0.058,0.049,0.121,0.089,0.179,0.137c0.474,0.393,0.965,0.766,1.465,1.127c0.162,0.117,0.324,0.234,0.489,0.348  c0.534,0.368,1.082,0.717,1.642,1.048c0.122,0.072,0.245,0.142,0.368,0.212c0.613,0.349,1.239,0.678,1.88,0.98  c0.047,0.022,0.095,0.042,0.142,0.064c2.089,0.971,4.319,1.684,6.651,2.105c0.061,0.011,0.122,0.022,0.184,0.033  c0.724,0.125,1.456,0.225,2.197,0.292c0.09,0.008,0.18,0.013,0.271,0.021C25.998,54.961,26.744,55,27.5,55  c0.749,0,1.488-0.039,2.222-0.098c0.093-0.008,0.186-0.013,0.279-0.021c0.735-0.067,1.461-0.164,2.178-0.287  c0.062-0.011,0.125-0.022,0.187-0.034c2.297-0.412,4.495-1.109,6.557-2.055c0.076-0.035,0.153-0.068,0.229-0.104  c0.617-0.29,1.22-0.603,1.811-0.936c0.147-0.083,0.293-0.167,0.439-0.253c0.538-0.317,1.067-0.648,1.581-1  c0.185-0.126,0.366-0.259,0.549-0.391c0.439-0.316,0.87-0.642,1.289-0.983c0.093-0.075,0.193-0.14,0.284-0.217l0.915-0.764  l-0.027-0.023C51.523,42.802,55,35.55,55,27.5z M2,27.5C2,13.439,13.439,2,27.5,2S53,13.439,53,27.5  c0,7.577-3.325,14.389-8.589,19.063c-0.294-0.203-0.59-0.385-0.893-0.537l-8.467-4.233c-0.76-0.38-1.232-1.144-1.232-1.993v-2.957  c0.196-0.242,0.403-0.516,0.617-0.817c1.096-1.548,1.975-3.27,2.616-5.123c1.267-0.602,2.085-1.864,2.085-3.289v-3.545  c0-0.867-0.318-1.708-0.887-2.369v-4.667c0.052-0.519,0.236-3.448-1.883-5.864C34.524,9.065,31.541,8,27.5,8  s-7.024,1.065-8.867,3.168c-2.119,2.416-1.935,5.345-1.883,5.864v4.667c-0.568,0.661-0.887,1.502-0.887,2.369v3.545  c0,1.101,0.494,2.128,1.34,2.821c0.81,3.173,2.477,5.575,3.093,6.389v2.894c0,0.816-0.445,1.566-1.162,1.958l-7.907,4.313  c-0.252,0.137-0.502,0.297-0.752,0.476C5.276,41.792,2,35.022,2,27.5z M42.459,48.132c-0.35,0.254-0.706,0.5-1.067,0.735  c-0.166,0.108-0.331,0.216-0.5,0.321c-0.472,0.292-0.952,0.57-1.442,0.83c-0.108,0.057-0.217,0.111-0.326,0.167  c-1.126,0.577-2.291,1.073-3.488,1.476c-0.042,0.014-0.084,0.029-0.127,0.043c-0.627,0.208-1.262,0.393-1.904,0.552  c-0.002,0-0.004,0.001-0.006,0.001c-0.648,0.16-1.304,0.293-1.964,0.402c-0.018,0.003-0.036,0.007-0.054,0.01  c-0.621,0.101-1.247,0.174-1.875,0.229c-0.111,0.01-0.222,0.017-0.334,0.025C28.751,52.97,28.127,53,27.5,53  c-0.634,0-1.266-0.031-1.895-0.078c-0.109-0.008-0.218-0.015-0.326-0.025c-0.634-0.056-1.265-0.131-1.89-0.233  c-0.028-0.005-0.056-0.01-0.084-0.015c-1.322-0.221-2.623-0.546-3.89-0.971c-0.039-0.013-0.079-0.027-0.118-0.04  c-0.629-0.214-1.251-0.451-1.862-0.713c-0.004-0.002-0.009-0.004-0.013-0.006c-0.578-0.249-1.145-0.525-1.705-0.816  c-0.073-0.038-0.147-0.074-0.219-0.113c-0.511-0.273-1.011-0.568-1.504-0.876c-0.146-0.092-0.291-0.185-0.435-0.279  c-0.454-0.297-0.902-0.606-1.338-0.933c-0.045-0.034-0.088-0.07-0.133-0.104c0.032-0.018,0.064-0.036,0.096-0.054l7.907-4.313  c1.36-0.742,2.205-2.165,2.205-3.714l-0.001-3.602l-0.23-0.278c-0.022-0.025-2.184-2.655-3.001-6.216l-0.091-0.396l-0.341-0.221  c-0.481-0.311-0.769-0.831-0.769-1.392v-3.545c0-0.465,0.197-0.898,0.557-1.223l0.33-0.298v-5.57l-0.009-0.131  c-0.003-0.024-0.298-2.429,1.396-4.36C21.583,10.837,24.061,10,27.5,10c3.426,0,5.896,0.83,7.346,2.466  c1.692,1.911,1.415,4.361,1.413,4.381l-0.009,5.701l0.33,0.298c0.359,0.324,0.557,0.758,0.557,1.223v3.545  c0,0.713-0.485,1.36-1.181,1.575l-0.497,0.153l-0.16,0.495c-0.59,1.833-1.43,3.526-2.496,5.032c-0.262,0.37-0.517,0.698-0.736,0.949  l-0.248,0.283V39.8c0,1.612,0.896,3.062,2.338,3.782l8.467,4.233c0.054,0.027,0.107,0.055,0.16,0.083  C42.677,47.979,42.567,48.054,42.459,48.132z" />
									</svg>
									<p class="credit text-center">اعتبار شما: ۲۰۰۰ تومان</p>
									<br />
									<div class="row no-margin">
										<div class="col-xs-6 text-center">
											<a href="user_panel.php">پروفایل</a>
										</div>
										<div class="col-xs-6 text-center">
											<svg class="logout_link" title="خروج" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="logOut" x="0px" y="0px" viewBox="0 0 529.286 529.286" style="enable-background:new 0 0 529.286 529.286;" xml:space="preserve" width="512px" height="512px">
												<path d="M358.099,74.604c0,0-28.097-12.644-28.097,16.896s27.837,49.363,28.19,49.3c49.147,32.081,81.629,87.559,81.629,150.629     c0,97.746-78.016,177.269-175.177,179.7c-97.161-2.431-175.177-81.954-175.177-179.7c0-63.071,32.483-118.547,81.629-150.629     c0.353,0.063,28.189-19.761,28.189-49.3s-28.097-16.896-28.097-16.896C88.7,111.958,31.31,194.983,31.31,291.429     c0,129.865,104.053,235.413,233.334,237.857c129.281-2.445,233.332-107.992,233.332-237.857     C497.977,194.983,440.587,111.958,358.099,74.604z" fill="#D80027"/>
												<path d="M266.278,0c-26.143,0-34.312,19.141-34.312,26.627v117.159v117.159c0,7.487,8.17,26.627,34.312,26.627     c26.143,0,31.045-19.141,31.045-26.627V143.786V26.627C297.322,19.14,292.421,0,266.278,0z" fill="#D80027"/>
											</svg>
										</div>
									</div>
								</div>
							 </li>
						<?php }
else
{
    ?>
							<li id="enter"><a href="#" data-toggle="modal" data-target="#login-modal">ورود/ثبت نام</a></li>
						<?php }?>
							<li><a href="contact.php">ارتباط با ما</a></li>

						</ul>

						</div>
					</nav>
				</div>
			</div>
			<!--//header-->
		</div>

		<!-- slider -->
		<div id="myCarousel" class="carousel slide" data-ride="carousel">
			<div class="search animated fadeInDownBig">
				<form action="restaurant-list.php" method="get">
					<h2 class="title text-center animated fadeInDown">سفارش آنلاین غذا با فودرز</h2>
					<div class="row">
						<div class="col-md-4">
							  <select class="location-input js-states form-control" id="id_label_single">
                            <?php while ($row = $stmt->fetch())
{
    echo "<option>$row[0]</option>";
}
?>							  </select>

						</div>
						<div class="col-md-5">
							<input name="resName" class="food_name" type="text" placeholder="نام رستوران" />
						</div>
						<input type="" name="region" id="region" hidden>
						<div class="col-md-3">
							<button id="sub" type="submit" class="submit"><i class="fa fa-search"></i> جستجو </button>
						</div>
					</div>
					<div class="col-12 text-center">
						<div class="mainflex">
							<div class="near-restaurants-title">رستورانهای نزدیک من</div>
							<div class="biggestwhite" id="search_locator">

								<div class="box1">
									<div class="biggestblack">
										<div class="midwhite">
											<div class="box2">
												<div class="smallblack">
													<div class="smallestwhite"><i class="fa fa-location-arrow"></i></div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<!-- Indicators -->
			<ol class="carousel-indicators">
				<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				<li data-target="#myCarousel" data-slide-to="1" class=""></li>
				<li data-target="#myCarousel" data-slide-to="2" class=""></li>
				<li data-target="#myCarousel" data-slide-to="3" class=""></li>
				<li data-target="#myCarousel" data-slide-to="4" class=""></li>
			</ol>
			<div class="carousel-inner" role="listbox">
				<div class="item active">
					<div class="banner-dott">
					<div class="container">

					</div>
					</div>
				</div>
				<div class="item item1">
					<div class="banner-dott">
					<div class="container">

					</div>
					</div>
				</div>
				<div class="item item2">
					<div class="banner-dott">
					<div class="container">

					</div>
					</div>
				</div>
				<div class="item item3">
					<div class="banner-dott">
					<div class="container">

					</div>
					</div>
				</div>

				<div class="item item4">
					<div class="banner-dott">
					<div class="container">

					</div>
					</div>
				</div>
			</div>
			<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
				<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>
				<span class="sr-only"></span>
			</a>
			<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
				<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
				<span class="sr-only"></span>
			</a>
		</div>
		<!-- //slider -->
		<!-- // banner -->

		<!-- banner bottom section -->
			<div id="gallery" class="gallery_main">
				<div class="container">
					<h2 class="heading">غذا چی میل داری؟</h2>
					<div class="w3l_gallery_grids">
						<ul class="w3l_gallery_grid gallery" id="lightGallery">
							<li id="gallery1" data-src="images/gallery1.jpg" data-responsive-src="images/1.jpg">
								<div class="w3_w3l_gallery_grid box">
									<a href="#">
										<img src="images/gallery1.jpg" alt=" " class="img-responsive" />
										<div class="caption scale-caption">
											<h3>شروع سفارش</h3>
											<p>کباب ها</p>
										</div>
									</a>
								</div>
							</li>
							<li id="gallery2" data-src="images/gallery2.jpg" data-responsive-src="images/7.jpg">
								<div class="w3_w3l_gallery_grid box">
									<a href="#">
										<img src="images/gallery2.jpg" alt=" " class="img-responsive" />
										<div class="caption scale-caption">
											<h3>شروع سفارش</h3>
											<p>غذای سنتی و آش</p>
										</div>
									</a>
								</div>
							</li>
							<li id="gallery3" data-src="images/gallery3.jpg" data-responsive-src="images/5.jpg">
								<div class="w3_w3l_gallery_grid box">
									<a href="#">
										<img src="images/gallery3.jpg" alt=" " class="img-responsive" />
										<div class="caption scale-caption">
											<h3>شروع سفارش</h3>
											<p>غذای گیاهی</p>
										</div>
									</a>
								</div>
							</li>
						</ul>
						<div class="clearfix"> </div>
					</div>
				</div>
			</div>

			<!-- mobile app description -->
			<div class="why-choose-agile">
				<div class="container">
					<div class="w3-heading-grid">
					<br />
						<h3 class="heading black">اپلیکیشن موبایل فودرز</h3>
						<div class="text-center bold">
							<h5><strong>جهت خرید راحت تر میتوانید نرم افزار موبایل را از طریق لینک زیر دانلود کنید.</strong></h5>
						</div>
					</div>
					<div class="why-choose-agile-grids-top">
						<div class="col-md-4 agileits-w3layouts-grid">
							<nav class="circular-menu">
								<div class="circle">
									<a href="apk/apk.apk" class="">دانلود مستقیم</a>
									<a href="https://cafebazaar.ir/app/com.puzzley.fooderz23515/?l=fa" target="_blank" class="">از طریق بازار</a>
									<a href="" class="" data-toggle="modal" data-target="#app_get_modal">از طریق موبایل</a>
								</div>
								<a href="#" class="menu-button">دریافت اپلیکیشن</a>
							</nav>

							<div class="clearfix"> </div>
						</div>
						<div class="col-md-8 agileits-w3layouts-grid img text-center">
							<img id="mobile-app-img" src="images/mobile.png" alt="fooserz-app" />
						</div>
						<div class="clearfix"> </div>
					</div>
				</div>
			</div>
			<!-- //choose-us -->
			<div class="best_restaurant">
				<div class="container">
					<h2 class="heading">رستوران های تخفیف دار</h2>
					<div class="site_carousel owl-carousel">
						<?php 
						foreach ($discounts as $v) 
						{
							$dh = arp("images/logo/") . $v['prv_ID'] . "/";
						if (is_dir($dh))
						{
							$logoName = scandir($dh);
							$logoName = end($logoName);
						}
						 ?>
						<div class="elem">
							<div class="percent">
								<?php echo $v['discount'] ?>%
							</div>
							<div class="img-container">
								<img class="" src="<?php echo arp2('images/logo/') . $v['prv_ID'] . '/' . $logoName ?>" alt="" />
							</div>
							<h5><?php echo $v['providerName'] ?></h5>
						</div>
						<?php 
						} ?>
						
					</div>

					<br />
					<!-- best restaurants -->
					<!-- <h2 class="heading">رستوران های ویژه</h2> -->
					<!-- <div class="site_carousel owl-carousel">
						<div class="elem">
							<div class="img-container">
								<img class="" src="images/gallery1.jpg" alt="" />
							</div>
							<h5>نام رستوران</h5>
						</div>
						<div class="elem">
							<div class="img-container">
								<img class="" src="images/gallery8.jpg" alt="" />
							</div>
							<h5>نام رستوران</h5>
						</div>
						<div class="elem">
							<div class="img-container">
								<img class="" src="images/post2.jpg" alt="" />
							</div>
							<h5>نام رستوران</h5>
						</div>
						<div class="elem">
							<div class="img-container">
								<img class="" src="images/blog1.jpg" alt="" />
							</div>
							<h5>نام رستوران</h5>
						</div>
						<div class="elem">
							<div class="img-container">
								<img class="" src="images/post1.jpg" alt="" />
							</div>
							<h5>نام رستوران</h5>
						</div>
						<div class="elem">
							<div class="img-container">
								<img class="" src="images/gallery3.jpg" alt="" />
							</div>
							<h5>نام رستوران</h5>
						</div>
						<div class="elem">
							<div class="img-container">
								<img class="" src="images/gallery2.jpg" alt="" />
							</div>
							<h5>نام رستوران</h5>
						</div>
						<div class="elem">
							<div class="img-container">
								<img class="" src="images/gallery8.jpg" alt="" />
							</div>
							<h5>نام رستوران</h5>
						</div>
						<div class="elem">
							<div class="img-container">
								<img class="" src="images/gallery6.jpg" alt="" />
							</div>
							<h5>نام رستوران</h5>
						</div>
						<div class="elem">
							<div class="img-container">
								<img class="" src="images/gallery1.jpg" alt="" />
							</div>
							<h5>نام رستوران</h5>
						</div>
					</div> -->
				</div>
			</div>


			<!-- restaurant register part -->
			<div class="restaurant-sign text-center">
				<div class="container">
					<div class="row no-margin">
					<div class="background"></div>
						<img class="icon" src="images/service.png" alt="register to fooderz" />
						<div class="col-12">
							<p class="text">با ثبت رستوران خود در فودرز، بصورت آنلاین سفارش بگیرید.</p>
							<a class="fooderz_btn link" href="restaurant_register.php">
								ثبت رستوران
								<svg class="left-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z"/></svg>
							</a>
						</div>
					</div>
				</div>
			</div>

		<!-- footer -->
		<footer class="fooderz-footer homepage">
			<div class="transparent_layer"></div>
			<div class="container">
				<div class="row no-margin">
					<h4 class="text-center">با فودرز، طعم راحتی و اعتماد را در خرید الکترونیکی بچشید.</h4>
					<br /><br />
					<div class="col-md-4">
						<div class="footer-nav">
							<h3 class="footer-title">لینک های مفید</h3>
							<ul>
								<li><a href="contact.php">تماس با ما</li>
								<li><a href="about.php">درباره ما</li>
								<li><a href="faq.php">قوانین</li>
<!--								<li><a href="">راهنمای جامع خرید</li>-->
<!--								<li><a href="">وبلاگ فودرز</li>-->
							</ul>
						</div>
					</div>
					<div class="col-md-4">
						<div class="social text-center">
							<h3 class="footer-title text-center">آدرس ما در شبکه های اجتماعی</h3>
							<a title="اینستاگرام" class="social-link" href="">
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 551.034 551.034">
									<linearGradient id="SVGID_1_" gradientUnits="userSpaceOnUse" x1="275.517" y1="4.57" x2="275.517" y2="549.72" gradientTransform="matrix(1 0 0 -1 0 554)">
										<stop offset="0" style="stop-color:#E09B3D"/>
										<stop offset="0.3" style="stop-color:#C74C4D"/>
										<stop offset="0.6" style="stop-color:#C21975"/>
										<stop offset="1" style="stop-color:#7024C4"/>
									</linearGradient>
									<path style="fill:url(#SVGID_1_);" d="M386.878,0H164.156C73.64,0,0,73.64,0,164.156v222.722   c0,90.516,73.64,164.156,164.156,164.156h222.722c90.516,0,164.156-73.64,164.156-164.156V164.156   C551.033,73.64,477.393,0,386.878,0z M495.6,386.878c0,60.045-48.677,108.722-108.722,108.722H164.156   c-60.045,0-108.722-48.677-108.722-108.722V164.156c0-60.046,48.677-108.722,108.722-108.722h222.722   c60.045,0,108.722,48.676,108.722,108.722L495.6,386.878L495.6,386.878z"/>

										<linearGradient id="SVGID_2_" gradientUnits="userSpaceOnUse" x1="275.517" y1="4.57" x2="275.517" y2="549.72" gradientTransform="matrix(1 0 0 -1 0 554)">
										<stop offset="0" style="stop-color:#E09B3D"/>
										<stop offset="0.3" style="stop-color:#C74C4D"/>
										<stop offset="0.6" style="stop-color:#C21975"/>
										<stop offset="1" style="stop-color:#7024C4"/>
									</linearGradient>
									<path style="fill:url(#SVGID_2_);" d="M275.517,133C196.933,133,133,196.933,133,275.516s63.933,142.517,142.517,142.517   S418.034,354.1,418.034,275.516S354.101,133,275.517,133z M275.517,362.6c-48.095,0-87.083-38.988-87.083-87.083   s38.989-87.083,87.083-87.083c48.095,0,87.083,38.988,87.083,87.083C362.6,323.611,323.611,362.6,275.517,362.6z"/>

										<linearGradient id="SVGID_3_" gradientUnits="userSpaceOnUse" x1="418.31" y1="4.57" x2="418.31" y2="549.72" gradientTransform="matrix(1 0 0 -1 0 554)">
										<stop offset="0" style="stop-color:#E09B3D"/>
										<stop offset="0.3" style="stop-color:#C74C4D"/>
										<stop offset="0.6" style="stop-color:#C21975"/>
										<stop offset="1" style="stop-color:#7024C4"/>
									</linearGradient>
									<circle style="fill:url(#SVGID_3_);" cx="418.31" cy="134.07" r="34.15"/>
								</svg>
							</a>
							<a title="تلگرام" class="social-link" href="">
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"viewBox="0 0 300 300">
									<path id="XMLID_497_" d="M5.299,144.645l69.126,25.8l26.756,86.047c1.712,5.511,8.451,7.548,12.924,3.891l38.532-31.412   c4.039-3.291,9.792-3.455,14.013-0.391l69.498,50.457c4.785,3.478,11.564,0.856,12.764-4.926L299.823,29.22   c1.31-6.316-4.896-11.585-10.91-9.259L5.218,129.402C-1.783,132.102-1.722,142.014,5.299,144.645z M96.869,156.711l135.098-83.207   c2.428-1.491,4.926,1.792,2.841,3.726L123.313,180.87c-3.919,3.648-6.447,8.53-7.163,13.829l-3.798,28.146   c-0.503,3.758-5.782,4.131-6.819,0.494l-14.607-51.325C89.253,166.16,91.691,159.907,96.869,156.711z" fill="#5295c4"/>
								</svg>
							</a>
						</div>
					</div>
					<div class="col-md-4">
						<h3 class="footer-title text-center">نمادهای اعتبار</h3>
						<div class="namad text-center owl-carousel">
							<div class="item">
								<img src="images/namad.png" alt="namad" />
							</div>
							<div class="item">
								<img src="images/namad.png" alt="namad" />
							</div>
							<div class="item">
								<img src="images/namad.png" alt="namad" />
							</div>
						</div>
					</div>
					<div class="copyright text-center">&copy; تمام حقوق متعلق به فودرز می باشد.</div>
				</div>
			</div>
		</footer>

		<!-- modals -->
		<!-- get mobile application via phone number modal -->
		<div class="modal fade" id="app_get_modal" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<h5 class="modal-title" id="exampleModalLongTitle">جهت دریافت لینک دانلود اپلیکیشن، شماره موبایل خود را وارد نمایید.</h5>
					<input class="no-border" id="smsPhone" type="text" placeholder="شماره موبایل ..." />
				</div>
				<div class="modal-footer">
					<button type="button" id="smsApp" class="fooderz_btn">دریافت اپلیکیشن</button>
				</div>
				</div>
			</div>
		</div>

		<!-- login modal -->
    <?php
    include 'partialCode_LoginModal.php';
    ?>
		<!-- map popup -->
		<div class="popup_back_layer search_map_popup animated fadeIn">
			<div class="popup text-center">
				<div id="search_map"></div>
				<div class="text-center">
				<br />
					<a class="fooderz_btn single_submit" href="restaurant-list.php">مشاهده تمام رستورانهای اطراف</a>
				</div>
			</div>
		</div>
		<!-- /modals -->
		<script src="js/plugins.min.js"></script>
		<script src="js/layout.js"></script>
		<script src="js/conv.js"></script>
		<script src="js/main.js"></script>
				<script>
			$("#sub").click(function(){
				s = $("#select2-id_label_single-container").attr('title');
				$("#region").val(s)
			});
			$('.site_carousel.owl-carousel').click(function(){
				// $(this).children('form').submit();
				alert('message?: DOMString')
			})
		</script>
	</body>
</html>