<?php
// print_r($_POST);
// die();
if (isset($_POST['prvID'])) 
{
	$prv_ID = $_POST['prvID'];	
}
else
{
	header("Location:restaurant-list.php");
	die();
}
if (@json_decode($_COOKIE['order'], 1) != NULL)
{
	$jsCookie = json_decode($_COOKIE['order'], 1);
    foreach ($jsCookie['purchase'] as $k => $v)
    {
        $jsCookie2[$v['name']] = $v;
        $jcNames[$k]           = $v['name'];
    }
}
// print_r($jsCookie);
// die();
include $_SERVER["DOCUMENT_ROOT"] . "/Fooderz/funx.php";
require_once '../DataBase/PDO/DBconnect/DBconnect.php';
$dh = arp("images/logo/") . $prv_ID . "/";
if (is_dir($dh))
{
    $dhPath   = "/Fooderz/images/logo/" . $prv_ID . "/";
    $logoName = scandir($dh);
    // var_dump($logoName);
    // die();
    $logoName = end($logoName);

    // $logoName = $logoName[2];
}
try
{
    $sql   = "call menu($prv_ID)";
    $stmt0 = $db->prepare($sql);
    $stmt0->execute();
    $errInfo0 = $stmt0->errorInfo();
    $rcrd     = $stmt0->fetch();
    $res      = json_decode($rcrd['menu'], 1)['menu'];
    $prvName  = $rcrd['providerName'];
    // var_dump($res);
    // die();
}
catch (Exception $e)
{
    $err0 = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>منو</title>
		<!-- custom-theme -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<!-- //custom-theme -->
		<link href="css/other_styles.css" rel="stylesheet" type="text/css" media="all" />
		<link href="css/style.css" rel="stylesheet" type="text/css" media="all" /><!-- Theme-CSS -->
	</head>
	<body class="pages_body menu_page_body_style">



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

		<!-- header -->
		<div class="fooderz-header grid_page_header" id="main_header">
			<div class="container">
				<nav class="grid_page_navbar" id="main_navbar">
					<div class="w3_navigation_pos pull-left">
						<h1><a href="index.php">FOODERZ <img class="fooderz_logo rounded" src="images/logo.png" alt="لوگوی فودرز" /></a></h1>
					</div>
					<button id="mobile-menu-icon" type="button" class="navbar-toggle collapsed">
						<span class="sr-only">منو</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<ul class="menu pages_menu">
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
										<svg class="logout_link" title="خروج" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 529.286 529.286" style="enable-background:new 0 0 529.286 529.286;" xml:space="preserve" width="512px" height="512px">
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

					<div id="cart-icon" class="pull-left">
						<span class="number">0</span>
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 459.529 459.529" style="enable-background:new 0 0 459.529 459.529;" xml:space="preserve" width="512px" height="512px">
							<path d="M17,55.231h48.733l69.417,251.033c1.983,7.367,8.783,12.467,16.433,12.467h213.35c6.8,0,12.75-3.967,15.583-10.2    l77.633-178.5c2.267-5.383,1.7-11.333-1.417-16.15c-3.117-4.817-8.5-7.65-14.167-7.65H206.833c-9.35,0-17,7.65-17,17    s7.65,17,17,17H416.5l-62.9,144.5H164.333L94.917,33.698c-1.983-7.367-8.783-12.467-16.433-12.467H17c-9.35,0-17,7.65-17,17    S7.65,55.231,17,55.231z" fill="#FFFFFF"/>
							<path d="M135.433,438.298c21.25,0,38.533-17.283,38.533-38.533s-17.283-38.533-38.533-38.533S96.9,378.514,96.9,399.764    S114.183,438.298,135.433,438.298z" fill="#FFFFFF"/>
							<path d="M376.267,438.298c0.85,0,1.983,0,2.833,0c10.2-0.85,19.55-5.383,26.35-13.317c6.8-7.65,9.917-17.567,9.35-28.05    c-1.417-20.967-19.833-37.117-41.083-35.7c-21.25,1.417-37.117,20.117-35.7,41.083    C339.433,422.431,356.15,438.298,376.267,438.298z" fill="#FFFFFF"/>
						</svg>
					</div>
				</nav>
			</div>
		</div>




		<div class="row no-margin">
			<!-- sidebar part -->

			<div class="col-sm-9">
				<div class="menu-box restaurant_page" style="position:relative">
					<img class="menu_head" src="images/menu_head-min.jpg" alt="" />
					<img class="menu_footer" src="images/footer.jpg" alt="" />

					<div class="restaurant_title">
						<div class="restaurant_logo"><img src="<?php echo $dhPath . $logoName ?>" alt="logo" /></div>
						<img class="title_img" src="images/menu_title_img.png" alt="" />
						<h3 class="title"><?php echo $prvName ?></h3>
						<div class="properties">
							<p>هزینه پیک : <?php echo $rcrd['deliveryCost'] ?> تومان</p>
							<p>حداقل سبد خرید : <?php echo $rcrd['minimomOrder'] ?> تومان</p>
							<p>
							<fieldset class="rating rating2">
								<input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="امتیاز : ۵"></label>
								<input type="radio" id="star4half" name="rating" value="4 and a half" /><label class="half" for="star4half" title="امتیاز : ۴/۵"></label>
								<input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="امتیاز : ۴"></label>
								<input type="radio" id="star3half" name="rating" value="3 and a half" /><label class="half" for="star3half" title="امتیاز : ۳/۵"></label>
								<input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="امتیاز : ۳"></label>
								<input type="radio" id="star2half" name="rating" value="2 and a half" /><label class="half" for="star2half" title="امتیاز : ۲/۵"></label>
								<input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="امتیاز : ۲"></label>
								<input type="radio" id="star1half" name="rating" value="1 and a half" /><label class="half" for="star1half" title="امتیاز : ۱/۵"></label>
								<input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="امتیاز : ۱"></label>
								<input type="radio" id="starhalf" name="rating" value="half" /><label class="half" for="starhalf" title="امتیاز : ۰/۵"></label>
							</fieldset>
							</p>

							<button class="favorite_btn active" type="button" title="افزودن به رستورانهای محبوب" name="addToFavorite" id="addToFavorite" value="addToFavorite">
								<svg class="like" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 50 50">
                                    <path d="M24.85,10.126c2.018-4.783,6.628-8.125,11.99-8.125c7.223,0,12.425,6.179,13.079,13.543  c0,0,0.353,1.828-0.424,5.119c-1.058,4.482-3.545,8.464-6.898,11.503L24.85,48L7.402,32.165c-3.353-3.038-5.84-7.021-6.898-11.503  c-0.777-3.291-0.424-5.119-0.424-5.119C0.734,8.179,5.936,2,13.159,2C18.522,2,22.832,5.343,24.85,10.126z"></path>
                                </svg>
							</button>

						</div>
						<svg xmlns="http://www.w3.org/2000/svg" id="open-label" viewBox="0 0 58 58">
							<path style="fill:#bf9e4a;" d="M8,24.5c-0.256,0-0.512-0.098-0.707-0.293c-0.391-0.391-0.391-1.023,0-1.414l17-17   c0.391-0.391,1.023-0.391,1.414,0s0.391,1.023,0,1.414l-17,17C8.512,24.402,8.256,24.5,8,24.5z"/>
							<path style="fill:#bf9e4a;" d="M50,24.5c-0.256,0-0.512-0.098-0.707-0.293l-17-17c-0.391-0.391-0.391-1.023,0-1.414   s1.023-0.391,1.414,0l17,17c0.391,0.391,0.391,1.023,0,1.414C50.512,24.402,50.256,24.5,50,24.5z"/>
							<circle style="fill:#861d1d;" cx="29" cy="6.5" r="4"/>
							<rect y="23.5" style="fill: #663300b8;" width="58" height="32"/>
							<foreignObject id="text" x="0px" y="50%" width="100%" height="50%">
								<?php echo (!empty($_POST['opCL'])) ? 'بسته است' : 'باز است' ?>
							</foreignObject>
						</svg>

					</div>
					
					<div class="filter_carousel owl-carousel">
						<div class="filter_item">
							کباب ها
						</div>
						<div class="filter_item">
							پلویی
						</div>
						<div class="filter_item">
							ساندویچ ها
						</div>
						<div class="filter_item">
							پیتزاها
						</div>
						<div class="filter_item">
							پیش غذا
						</div>
						<div class="filter_item">
							نوشیدنی ها
						</div>
						<div class="filter_item">
							غذاهای فرنگی
						</div>
					</div>

					<div class="row no-margin menu_row grid" id="menu-view">
						<!-- category of food part -->
						<?php foreach ($res as $k => $v)
{
    ?>
						<br style="clear:both;" />
						<div id="<?php echo $k ?>" class="each_cat_box fadeIn">
							<h2 class="category_title width85_767">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 496" width="25px" height="25px">
									<path d="M472,272V168c0-13.232-10.768-24-24-24h-16c-6.168,0-11.744,2.408-16,6.24c-4.256-3.84-9.832-6.24-16-6.24h-16     c-6.168,0-11.744,2.408-16,6.24c-4.256-3.84-9.832-6.24-16-6.24h-16c-13.232,0-24,10.768-24,24v102.656     c-18.456-12.792-45.392-23.68-84.832-28.288l12.6-88.208c0.152-1.064,0.232-2.144,0.232-3.224     C240,138.288,229.712,128,217.064,128H144V56c0-4.408,3.592-8,8-8h64c13.232,0,24-10.768,24-24S229.232,0,216,0h-72     c-26.472,0-48,21.528-48,48v80H22.936C10.288,128,0,138.288,0,150.936c0,1.08,0.08,2.16,0.232,3.248l19.28,134.944     C0.496,311.776,0,334.112,0,336c0,13.952,9.024,25.712,21.496,30.088C18.032,371.2,16,377.368,16,384     c0,8.528,3.4,16.232,8.856,21.976C10.056,414.16,0,429.92,0,448c0,26.472,21.528,48,48,48h240h16h192V328v-8v-24     C496,282.768,485.232,272,472,272z M424,168c0-4.408,3.592-8,8-8h16c4.408,0,8,3.592,8,8v104h-32V168z M376,168     c0-4.408,3.592-8,8-8h16c4.408,0,8,3.592,8,8v104h-32V168z M328,168c0-4.408,3.592-8,8-8h16c4.408,0,8,3.592,8,8v104h-32V168z      M200,16h16c4.408,0,8,3.592,8,8s-3.592,8-8,8h-16V16z M168,16h16v16h-16V16z M112,48c0-17.648,14.352-32,32-32h8v16     c-13.232,0-24,10.768-24,24v72h-16V48z M17.224,160l-1.152-8.056c-0.048-0.336-0.072-0.672-0.072-1.008     c0-3.824,3.112-6.936,6.936-6.936H96h48h73.064c3.824,0,6.936,3.112,6.936,6.936c0,0.336-0.024,0.672-0.064,0.984l-1.16,8.08H200     v16h20.488l-4.568,32H24.08l-4.568-32H184v-16H17.224z M213.64,224l-2.416,16.928C202.656,240.336,193.632,240,184,240h-16     c-69.712,0-110.432,16.232-134.296,35.352L26.368,224H213.64z M16,336c0-0.8,1.736-80,152-80h16c149.224,0,151.96,76.784,152,80     c0,8.824-7.176,16-16,16h-8h-8H48H32C23.176,352,16,344.824,16,336z M48,400c-8.824,0-16-7.176-16-16c0-8.824,7.176-16,16-16h256     c8.824,0,16,7.176,16,16c0,8.824-7.176,16-16,16H48z M270.608,416l-32.824,38.296L150.24,416H270.608z M304,480h-16H48     c-17.648,0-32-14.352-32-32s14.352-32,32-32h62.328l131.888,57.704L291.68,416H304c17.648,0,32,14.352,32,32S321.648,480,304,480     z M327.152,405.976C332.6,400.232,336,392.528,336,384c0-5.856-1.696-11.272-4.448-16H448v80h-96c0-5.616-1.024-10.984-2.8-16     H400v-16h-60.32C336.096,412.008,331.88,408.592,327.152,405.976z M480,320h-16v16h16v144H339.68     c4.152-4.624,7.408-10.032,9.52-16H464V352H347.552c2.752-4.728,4.448-10.144,4.448-16h96v-16h-98.712     c-2.6-8.896-7.736-20.44-17.752-32H472c4.408,0,8,3.584,8,8V320z" fill="#545454"/>
									<rect x="416" y="416" width="16" height="16" fill="#545454"/>
									<rect x="104" y="272" width="16" height="16" fill="#545454"/>
									<rect x="136" y="288" width="16" height="16" fill="#545454"/>
									<rect x="168" y="272" width="16" height="16" fill="#545454"/>
									<rect x="216" y="296" width="16" height="16" fill="#545454"/>
									<rect x="256" y="272" width="16" height="16" fill="#545454"/>
									<rect x="56" y="304" width="16" height="16" fill="#545454"/>
								</svg>
								<?php echo ($k) ?>
							</h2>
						</div>
<?php foreach ($v as $k1 => $v1)
    {
        // var_dump($v1);
        $regions = json_decode($rcrd['regions']);
        $reg_str = $regions[0];

        $deliveryTime = json_decode($rcrd['deliveryTime'], 1);
        $minDelTime   = $deliveryTime['min'];
        $maxDelTime   = $deliveryTime['max'];
        $deliveryTime = "$minDelTime - $maxDelTime دقیقه";
        for ($i = 1; $i < count($regions); $i++)
        {
            $reg_str .= " - " . $regions[$i];
        }

        $name   = str_replace(' ', '_', $k1);
        $bgPath = "/Fooderz/images/foodPics/";
        $bgImg  = $bgPath . md5($prv_ID . 'khardal') . '/' . $name . '.jpg';
        $bgImg  = (file_exists($_SERVER['DOCUMENT_ROOT'] . $bgImg)) ? $bgImg : '';

        $wwt = $rcrd['weeklyWorkTIme'];
        $wwt = json_decode($wwt, 1);
        ?>
							<div class="food-box fadeIn">
								<div class="row">
									<div class="col-sm-4 img-box">
										<div class="image">
											<img class="food_img_uploaded" src="<?php echo $bgImg ?>" alt="" />
										</div>
									</div>
									<div class="col-sm-8 details user-end">
										<h4 class="food-name"><?php echo $k1 ?></h4>
										<p class="desc"><?php echo $v1['description'] ?></p>
										<p class="price">
											<span class="count"><?php echo $v1['price'] ?></span>
											<span>تومان</span>
											<!-- <span class="line-through-price">۲۵۰۰۰ تومان </span> -->
										</p>
										<div class="add-to-cart">
											<button class="add-btn">+</button>
											<span class="num"><?php echo @(in_array($k1, $jcNames)) ? $jsCookie2[$k1]['count'] : 0 ?></span>
											<button class="minus-btn">-</button>
										</div>
									</div>
								</div>
							</div>
						<?php }
}?>

					</div>

					<div class="row no-margin menu_row grid fadeIn" id="comments-view">
						<div class="text-center star">
							<h4><strong>مجموع امتیاز : ۴/۵ از ۵</strong></h4>
							<hr />
							<p class="text-right">
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 473 473" width="15px" height="15px">
									<path d="M403.581,69.3c-44.7-44.7-104-69.3-167.2-69.3s-122.5,24.6-167.2,69.3c-86.4,86.4-92.4,224.7-14.9,318    c-7.6,15.3-19.8,33.1-37.9,42c-8.7,4.3-13.6,13.6-12.1,23.2s8.9,17.1,18.5,18.6c4.5,0.7,10.9,1.4,18.7,1.4    c20.9,0,51.7-4.9,83.2-27.6c35.1,18.9,73.5,28.1,111.6,28.1c61.2,0,121.8-23.7,167.4-69.3c44.7-44.7,69.3-104,69.3-167.2    S448.281,114,403.581,69.3z M384.481,384.6c-67.5,67.5-172,80.9-254.2,32.6c-5.4-3.2-12.1-2.2-16.4,2.1c-0.4,0.2-0.8,0.5-1.1,0.8    c-27.1,21-53.7,25.4-71.3,25.4h-0.1c20.3-14.8,33.1-36.8,40.6-53.9c1.2-2.9,1.4-5.9,0.7-8.7c-0.3-2.7-1.4-5.4-3.3-7.6    c-73.2-82.7-69.4-208.7,8.8-286.9c81.7-81.7,214.6-81.7,296.2,0C466.181,170.1,466.181,302.9,384.481,384.6z" fill="green"/>
								</svg>
								<strong>نظرات مشتریان</strong>
							</p>

							<div class="comments">
								<header class="text-right">
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 258.75 258.75" width="25px" height="25px">
										<circle cx="129.375" cy="60" r="60" fill="#cc2828"/>
										<path d="M129.375,150c-60.061,0-108.75,48.689-108.75,108.75h217.5C238.125,198.689,189.436,150,129.375,150z" fill="#cc2828"/>
									</svg>
									<span class="name">سعید جمالی</span>
									<span class="pull-left date">۲ روز پیش</span>
								</header>
								<p class="excerpt text-right">بد نبود ...</p>
								<br />
								<div class="category">زرشک پلو با مرغ</div>
								<div class="category">نوشابه خانواده</div>
							</div>
							<div class="comments">
								<header class="text-right">
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 258.75 258.75" width="25px" height="25px">
										<circle cx="129.375" cy="60" r="60" fill="#cc2828"/>
										<path d="M129.375,150c-60.061,0-108.75,48.689-108.75,108.75h217.5C238.125,198.689,189.436,150,129.375,150z" fill="#cc2828"/>
									</svg>
									<span class="name">سعید جمالی</span>
									<span class="pull-left date">۲ روز پیش</span>
								</header>
								<p class="excerpt text-right">بد نبود ...</p>
								<br />
								<div class="category">زرشک پلو با مرغ</div>
								<div class="category">نوشابه خانواده</div>
							</div>
							<div class="comments">
								<header class="text-right">
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 258.75 258.75" width="25px" height="25px">
										<circle cx="129.375" cy="60" r="60" fill="#cc2828"/>
										<path d="M129.375,150c-60.061,0-108.75,48.689-108.75,108.75h217.5C238.125,198.689,189.436,150,129.375,150z" fill="#cc2828"/>
									</svg>
									<span class="name">سعید جمالی</span>
									<span class="pull-left date">۲ روز پیش</span>
								</header>
								<p class="excerpt text-right">بد نبود ...</p>
								<br />
								<div class="category">زرشک پلو با مرغ</div>
								<div class="category">نوشابه خانواده</div>
							</div>
							<div class="comments">
								<header class="text-right">
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 258.75 258.75" width="25px" height="25px">
										<circle cx="129.375" cy="60" r="60" fill="#cc2828"/>
										<path d="M129.375,150c-60.061,0-108.75,48.689-108.75,108.75h217.5C238.125,198.689,189.436,150,129.375,150z" fill="#cc2828"/>
									</svg>
									<span class="name">سعید جمالی</span>
									<span class="pull-left date">۲ روز پیش</span>
								</header>
								<p class="excerpt text-right">بد نبود ...</p>
								<br />
								<div class="category">زرشک پلو با مرغ</div>
								<div class="category">نوشابه خانواده</div>
							</div>
						</div>
					</div>

					<div class="row no-margin menu_row grid fadeIn" id="other_info-view">
						<div class="comments">
							<table class="info full_width">
								<tr>
									<th>نوع سفارش</th>
									<td><?php echo $rcrd['orderType'] ?></td>
								</tr>
								<tr>
									<th>آدرس</th>
									<td><?php echo $rcrd['address'] ?></td>
								</tr>
								<tr>


									<th>محدوده سرویس دهی</th>
									<td><?php echo $reg_str ?></td>
								</tr>
								<tr>
									<th>زمان ارسال سفارش</th>
									<td><?php echo $deliveryTime ?></td>
								</tr>
								<tr>
									<th>حداقل مبلغ سفارش</th>
									<td><?php echo $rcrd['minimomOrder'] ?> تومان</td>
								</tr>
							</table>
							<div class="text-right">
								<h4><strong>ساعت کاری هر روز</strong></h4>
							</div>
							<table class="info full_width">
								<tr>
									<th>شیفت صبح</th>
									<td><?php echo $wwt['morning']['From'] . " - " . $wwt['morning']['To'] ?></td>
								</tr>
								<tr>
									<th>شیفت عصر</th>
									<td><?php echo $wwt['evening']['From'] . " - " . $wwt['evening']['To'] ?></td>
								</tr>
								<tr>
									<th>شیفت نیمه شب</th>
									<td><?php echo $wwt['midnight']['From'] . " - " . $wwt['midnight']['To'] ?></td>
								</tr>
							</table>
							<div class="map text-center">
								محل نمایش نقشه
							</div>
						</div>
					</div>

				</div>
			</div>

			<div class="col-sm-3 no-padding">
				<div class="cart-details">
					<h4 class="text-center"><strong>سبد خرید</strong></h4><hr />

					<div class="text-center empty-cart">
						<svg xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 24 24"><path d="M13.5 18c-.828 0-1.5.672-1.5 1.5 0 .829.672 1.5 1.5 1.5s1.5-.671 1.5-1.5c0-.828-.672-1.5-1.5-1.5zm-3.5 1.5c0 .829-.672 1.5-1.5 1.5s-1.5-.671-1.5-1.5c0-.828.672-1.5 1.5-1.5s1.5.672 1.5 1.5zm13.257-14.5h-1.929l-3.473 12h-13.239l-4.616-11h2.169l3.776 9h10.428l3.432-12h4.195l-.743 2zm-12.257 1.475l2.475-2.475 1.414 1.414-2.475 2.475 2.475 2.475-1.414 1.414-2.475-2.475-2.475 2.475-1.414-1.414 2.475-2.475-2.475-2.475 1.414-1.414 2.475 2.475z"/></svg>
						<h5 class="tomato">سبد خرید شما خالیست</h5>
					</div>

					<div class="products">
						<div class="food-row fadeIn" id="food-row-title">
							<div class="name text-right"><strong>نام غذا</strong></div>
							<div class="count text-center"><strong>تعداد</strong></div>
							<div class="price text-left"><strong>قیمت</strong></div>
						</div>
					</div>
					<table class="first-factor full_width text-right fadeIn second">
						<tr>
							<th>جمع سفارش</th>
							<td id="total_food_price"> - </td>
						</tr>
						<tr>
							<th>هزینه پیک</th>
							<td id="peyk_price"> <?php echo $rcrd['deliveryCost'] ?> </td>
						</tr>
						<tr>
							<th>هزینه بسته بندی</th>
							<td id="packing_cost"> <?php echo $rcrd['packingCost'] ?> </td>
						</tr>
						<tr>
							<th>قابل پرداخت</th>
							<td id="total_pay"> - </td>
						</tr>
					</table>
					<form method="post" id="orderForm" action="pay.php">
						<input id="order" name="order" hidden>
						<input id="prv_ID" name="prv_ID" value="<?php echo $prv_ID ?>" hidden>
					</form>
					<div class="text-center fadeIn third" id="sabte_sefaresh">
						<a class="fooderz_btn full_width" href="#">ثبت سفارش</a>
					</div>

				</div>


				<!--<div class="sidebar-filter grid-page">
					<button class="grid-page-tab" id="menu-view-tab">منو</button>
					<button class="grid-page-tab" id="comments-view-tab">نظرات</button>
					<button class="grid-page-tab" id="other_info-tab">سایر اطلاعات</button>
					<hr />
					<!--<p class="text-justify">آدرس: خیابان عفیف آباد. نبش کوچه ۷ - جنب مجتمع تجاری ستاره فارس - پلاک ۲۱۷</p>
					<hr />
					<p class="text-justify">مدت زمان ارسال : ۳۰ تا ۶۰ دقیقه</p>
					<hr />-->
<!--<php foreach ($res as $k => $v)
{
    ?>
					<div class="filter-container">
						<svg class="board" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  viewBox="0 81 63 19">
							<defs>
								<linearGradient id="linear-gradient" x1="22.02" y1="163.09" x2="13.3" y2="163.09" gradientUnits="userSpaceOnUse">
									<stop offset="0" stop-color="#f9ba19"/>
									<stop offset="0.48" stop-color="#c5b185"/>
									<stop offset="0.58" stop-color="#ce7101"/>
									<stop offset="0.77" stop-color="#ae4e01"/>
									<stop offset="1" stop-color="#7f1c01"/>
								</linearGradient>
								<linearGradient id="linear-gradient-2" x1="71.28" y1="163.61" x2="58.96" y2="163.61" gradientTransform="translate(19.59 -7.04) rotate(6.72)" xlink:href="#linear-gradient"/>
								<linearGradient id="linear-gradient-3" x1="45.93" y1="157.02" x2="45.93" y2="206.48" gradientUnits="userSpaceOnUse">
									<stop offset="0.01" stop-color="#b08a4a"/>
									<stop offset="0.53" stop-color="#cbb78b"/>
									<stop offset="0.62" stop-color="rgba(177, 168, 31, 0.4)"/>
									<stop offset="0.79" stop-color="rgba(177, 168, 31, 0.4)"/>
									<stop offset="1" stop-color="rgba(177, 168, 31, 0.4)"/>
								</linearGradient>
								<linearGradient id="linear-gradient-4" x1="45.93" y1="148.01" x2="45.93" y2="191.26" xlink:href="#linear-gradient-3"/>
								<linearGradient id="linear-gradient-5" x1="55.98" y1="88.36" x2="55.98" y2="85.17" gradientUnits="userSpaceOnUse">
									<stop offset="0" stop-color="#f9d600"/>
									<stop offset="0.49" stop-color="#da7e01"/>
									<stop offset="0.59" stop-color="#ce7101"/>
									<stop offset="0.77" stop-color="#ae4e01"/>
									<stop offset="1" stop-color="#7f1c01"/>
								</linearGradient>
								<linearGradient id="linear-gradient-6" x1="70.4" y1="162.21" x2="70.4" y2="160.28" gradientUnits="userSpaceOnUse">
									<stop offset="0.01" stop-color="#f9ba19"/>
									<stop offset="0.49" stop-color="#da7e01"/>
									<stop offset="0.59" stop-color="#ce7101"/>
									<stop offset="0.77" stop-color="#ae4e01"/>
									<stop offset="1" stop-color="#7f1c01"/>
								</linearGradient>
								<radialGradient id="radial-gradient" cx="70.4" cy="160.53" r="0.83" gradientUnits="userSpaceOnUse">
									<stop offset="0" stop-color="#fff"/>
									<stop offset="1" stop-color="#b2b2b2"/>
								</radialGradient>
								<linearGradient id="linear-gradient-7" x1="303.5" y1="378.89" x2="303.72" y2="378.89" gradientTransform="translate(167.05 -315.27) rotate(50.18)" xlink:href="#radial-gradient"/>
								<linearGradient id="linear-gradient-8" x1="7.52" y1="87.48" x2="7.52" y2="84.29" xlink:href="#linear-gradient-5"/>
								<linearGradient id="linear-gradient-9" x1="21.94" y1="161.33" x2="21.94" y2="159.4" xlink:href="#linear-gradient-6"/>
								<radialGradient id="radial-gradient-2" cx="21.94" cy="159.65" r="0.83" xlink:href="#radial-gradient"/>
								<linearGradient id="linear-gradient-10" x1="271.79" y1="415.55" x2="272.01" y2="415.55" gradientTransform="translate(167.05 -315.27) rotate(50.18)" xlink:href="#radial-gradient"/>
								<linearGradient id="linear-gradient-11" x1="21.99" y1="170.14" x2="21.99" y2="166.96" xlink:href="#linear-gradient-5"/>
								<linearGradient id="linear-gradient-12" x1="21.99" y1="170.68" x2="21.99" y2="168.75" xlink:href="#linear-gradient-6"/>
								<radialGradient id="radial-gradient-3" cx="21.99" cy="169.01" r="0.83" xlink:href="#radial-gradient"/>
								<linearGradient id="linear-gradient-13" x1="279" y1="421.51" x2="279.23" y2="421.51" gradientTransform="translate(167.05 -315.27) rotate(50.18)" xlink:href="#radial-gradient"/>
								<linearGradient id="linear-gradient-14" x1="70.69" y1="170.23" x2="70.69" y2="167.04" xlink:href="#linear-gradient-5"/>
								<linearGradient id="linear-gradient-15" x1="70.69" y1="170.77" x2="70.69" y2="168.84" xlink:href="#linear-gradient-6"/>
								<radialGradient id="radial-gradient-4" cx="70.69" cy="169.09" r="0.83" xlink:href="#radial-gradient"/>
								<linearGradient id="linear-gradient-16" x1="310.26" y1="384.15" x2="310.48" y2="384.15" gradientTransform="translate(167.05 -315.27) rotate(50.18)" xlink:href="#radial-gradient"/>
							</defs>
							<foreignObject x="0px" y="50%" width="100%" height="50%">
								<php echo (!empty($_POST['opCL'])) ? 'بسته است' : 'باز است' ?>
							</foreignObject>
							<g>
								<g>
									<path d="M19,154.56c.64,0,1.64,0,2.61,0,0,0,1.42,3.31.77,5.86s.65,6.93.65,8.27,0,2.71,0,2.71H18.57a10.82,10.82,0,0,0,.79-3.72c0-1.88-.26-5.76.13-7.64s-1.1-5.42-1.1-5.42Z" transform="translate(-14.43 -73.31)" fill="#c5b185"/>
									<path d="M21.65,154.55a14.22,14.22,0,0,1,.59,5.95c-.5,2.59.51,7.05.51,8.41s0,2.76,0,2.76H19.31a14.15,14.15,0,0,0,.6-3.78,65,65,0,0,1,.11-7.77c.3-1.91-.92-5.59-.92-5.59S20.39,154.47,21.65,154.55Z" transform="translate(-14.43 -73.31)" fill="#c5b185"/>
								</g>
								<g>
									<path d="M72,155.17a19.09,19.09,0,0,0-.12,6,55.5,55.5,0,0,1,.57,8.45c0,1.37,0,2.77,0,2.77h-2.8a8.79,8.79,0,0,1-.19-4.86c1-3.31-.44-4.83-.1-6.75s-1-5.63-1-5.63S70.55,155.09,72,155.17Z" transform="translate(-14.43 -73.31)" fill="#c5b185"/>
									<path d="M72,155.17a21.51,21.51,0,0,0-.12,5.75,44.28,44.28,0,0,1-.25,8.73c-.17,1.4-.3,2.84-.3,2.84l-3.79-.44a7,7,0,0,1,.32-5c1.77-3.23,0-5,.68-6.91.48-1.31-.29-3.56-.4-4.93,0-.29,1.34,0,3.59,0Z" transform="translate(-14.43 -73.31)" fill="#c5b185"/>
								</g>
								<g>
									<path d="M14.43,158.09a1.62,1.62,0,0,1,1-1.16s7.24,1.13,32.71,1,22.94,1,26.31.33c2.77-.55,1.42,4.21,1.69,7.05.21,2.28-2.4,2.17-2.4,2.17l1.54,1s.84,1.44-.14,2.32c-.7.63.34,1,.56,1.24-.11.27-.84.75-.84.75s-1.67.72-6.72.06a147.38,147.38,0,0,0-18.53-.33c-.84.17-7.57.66-9.89.66s-12.21-.49-12.21-.49l-.76,0-2-.05L22,172.5l-3-.08c-1,0-1.95-.08-2.92-.14-.2,0-.32,0-.48-.12l-.38-.38a2.42,2.42,0,0,1-.64-1.25,9.39,9.39,0,0,1,0-1.59,2.91,2.91,0,0,1,.52-1.13,2.16,2.16,0,0,0,.23-1.37,17,17,0,0,0-.59-1.83,7.53,7.53,0,0,1-.11-1.84,12.74,12.74,0,0,1,0-1.85,2.17,2.17,0,0,1,.76-1.09S14.33,160,14.43,158.09Z" transform="translate(-14.43 -73.31)" fill="#8b5c29"/>
									<path d="M76.14,167.68a5.67,5.67,0,0,1,.06,2.3,7,7,0,0,1-.48,2s-1.67.73-6.72.06a149.2,149.2,0,0,0-18.52-.33c-.85.17-7.58.66-9.9.66s-12.2-.49-12.2-.49l-.77,0-1.93-.05-2.8-.07-3-.08-3-.1a2.14,2.14,0,0,1-.36,0,2.37,2.37,0,0,1-.77-.71,1.76,1.76,0,0,1-.44-1.07,4.41,4.41,0,0,1,.29-2.1,2.89,2.89,0,0,0,.42-2c-.13-.63-.44-1.21-.6-1.83a7.53,7.53,0,0,1-.11-1.84c0-.58-.26-1.32,0-1.85.07-.13.79-.85.79-.85s-1-.07-.92-2c0-.49.19-.45.68-.53,0,0,7.58.5,33,.33s22.88.43,26.31.33c2.44-.07.63,4.81.84,7.13s-1.55,2.09-1.55,2.09a4.21,4.21,0,0,0,.73.32C75.58,167.09,76,167.2,76.14,167.68Z" transform="translate(-14.43 -73.31)" fill="url(#linear-gradient-3)"/>
									<path d="M40.13,167.22c11.91,0,21.57-.3,21.57-.61s-9.66-.53-21.57-.5-21.57.29-21.57.6S28.22,167.25,40.13,167.22Zm0-.95c11.37,0,20.59.13,20.59.35s-9.22.41-20.59.44-20.59-.13-20.59-.35S28.75,166.29,40.13,166.27Zm10.51,5.12h-.57l-3,0h-.5c-3.68,0-7.42-.06-11.08,0H34.41c-1.11,0-2.22.06-3.32.06l-1.08,0-.58,0h-.58c-.7,0-1.42,0-2.14,0h-.54c-1.62,0-3.23,0-4.88,0H18l-.56,0-1.13,0a1,1,0,0,0,.18.13l1,0h3.3c1.12,0,2.23,0,3.29,0h1.1c1.1,0,2.2,0,3.33,0h.62l.6,0h3.88c.29,0,.56,0,.81,0H35c3.89-.05,7.93,0,11.84,0h4.61l1.37.08,3.42,0c-1.3,0-2.6-.09-3.88-.17Zm14-1.44H51.2l-1.09-.06c-2.66-.19-5.41.16-8.16.16a20.22,20.22,0,0,1-3.26-.06H37.6l-1.07,0H23c-2.55,0-5.1,0-7.64,0a1.81,1.81,0,0,0,.06.27c2.46,0,5,0,7.4,0H36.58l1.15,0h1.16a43.88,43.88,0,0,0,7.87-.17c1.61-.12,3,.12,4.6.13h1c1,0,1.93,0,2.91,0h.81c2.91,0,5.76,0,8.63,0h.56a95.34,95.34,0,0,1,11-.16v0c0-.06,0-.11,0-.16C72.44,169.69,68.38,169.72,64.61,170Zm-28.47-1.72a95.66,95.66,0,0,1,9.85.37c5,.44,5.26-.29,10-.5s4.45.23,12.9.13l7.37-.11a1.15,1.15,0,0,1,0-.16c-3.8.1-10.53.23-16.18.06-8.4-.27-9.25,1-13.92.47-1.68-.21-3.72-.33-5.64-.4,6.44-.06,14.26-.3,20.72-.58,2.12.05,8.1.14,14.77-.18a1.44,1.44,0,0,0-.6-.31c-3.43.21-8.41.44-12.52.42,6.36-.29,11-.62,11-.83a7.66,7.66,0,0,0-1.89-.26c1.24-.07,2.58-.09,3.8-.09a1,1,0,0,0,.14-.2c-2.58,0-4.58.12-5.62.16-4.12-.28-11.26-.59-18.52-.78,1.25,0,7.77-.18,12.87,0,3.4.12,8.2.12,11.47.11a1.55,1.55,0,0,0,0-.21c-3.32,0-8.38,0-11.58-.14-5-.15-13.53,0-17.79.12-3.14-.06-6.17-.1-8.86-.09-8.4,0-16.39.4-21.79.81v.21c3.53-.45,12-.78,21.79-.8,13,0,30.9.57,30.83,1.17,0,.43-17.81,1.24-30.82,1.27-10,0-18.62-.28-22-.73l-.09.2c4.61.35,11.18.66,18.4.74A11.07,11.07,0,0,0,36.14,168.23Zm34.71,4a16.35,16.35,0,0,0,4.27-.1l-1.05,0C73,172.18,71.93,172.22,70.85,172.25Zm-30.72-4.73c13.67,0,24.74-.44,24.74-.91s-11.08-.83-24.75-.8c-11.62,0-21.37.33-24,.71a2.74,2.74,0,0,1-.09.39C18.51,167.28,28.36,167.54,40.13,167.52Zm0-1.58c13.15,0,23.81.27,23.81.67s-10.66.75-23.81.78-23.81-.27-23.81-.67S27,166,40.13,165.94Zm-24.68,2.39c3.74-.08,8.09-.52,8.09-.52l-1.93,0s-3.09.37-6.13.42Zm59.05-8.81h-.33c-3.17-.05-6.2,0-9.35,0H58.34a88.84,88.84,0,0,0-14.3-.11l-2,.06-1.74,0-1.12-.07a15,15,0,0,0-3.42.09H33.41a25.11,25.11,0,0,0-3.68,0h-1c-.34,0-.86,0-1.05,0-3.92.25-7.87.24-11.81.13l-.12.13c3.79,0,7.62,0,11.6-.08h1.18l1.06,0a21.81,21.81,0,0,1,4.71,0h1.45a19.92,19.92,0,0,1,3.45-.09l1.14.07,1.66,0,1.79,0a81.26,81.26,0,0,1,14.21.11h7.18c3,0,6.15-.07,9.16,0h2.27c0-.06,0-.11,0-.17Zm-8.89,9.6H62c-3.84,0-7.61.06-11.39,0-.43,0-.87,0-1.35,0-2.76-.21-5.51.2-8.36.05-.32,0-.67,0-1,0H33c-1.09,0-2.3,0-3.46,0h-.49l-.95,0h-1c-.58,0-1.29,0-1.93,0l-1,0H20.31c-.5,0-1,0-1.56,0H15.38v.24h3.55c1.26,0,2.51,0,3.76,0h1.48c1.8-.05,3.51,0,5.31-.07H30c.79,0,1.57,0,2.37.05h7c1.26,0,2.18.2,3.33.14a50.8,50.8,0,0,1,8-.1h1.14c2.64,0,5.29-.07,7.87,0h4.85c3.46-.1,8.14.17,11.76.06a.76.76,0,0,0,0-.15C72.69,169.35,69.11,169.19,65.61,169.12ZM19,169c4.42,0,11.21-.15,15.37-.05s9.33-.1,9.33-.1c1.53-.16-3.65-.16-4.58-.16s-7.13-.05-9.51-.05-7,.05-10.69.15c-1.14,0-2.32,0-3.47,0a1.55,1.55,0,0,0,0,.22Zm22.89,3.25h-.58c-2.68,0-5.31-.08-7.93-.09,2.83.13,6.06.26,7.25.26,1,0,2.74-.08,4.52-.2h-.36C43.78,172.21,42.81,172.22,41.84,172.21Zm31.45-3.46c-5,.12-7.25-.15-13.43-.15s-8.34.23-8.34.23c4.52,0,11.46,0,16.94.2,2.82.08,5.69,0,7.81-.13v-.24C75.46,168.69,74.48,168.73,73.29,168.75ZM69.38,161c-1.51,0-3,0-4.57,0h-3.7a26.71,26.71,0,0,0-4.56,0H53.46c-2.48-.09-5.26,0-7.78,0h-3c-2.38,0-4.51.43-7.08.26-1.92-.16-3.84-.27-5.77-.25h-2.4a103,103,0,0,0-12.16-.24,1.27,1.27,0,0,0,0,.2,70.91,70.91,0,0,1,11.46.22h2.65a87.14,87.14,0,0,0,14,0h1.5l1.39,0h1.39c.76,0,1.83,0,2.78,0h3.84c.66,0,1.32,0,2,0h.5c1.71-.09,3.43,0,5.12,0H76.45l0-.19h-7.1Zm2.55,1.38h-.86c-.28,0-.57,0-.88,0a36.18,36.18,0,0,0-5.09-.08,22.49,22.49,0,0,1-5.38.17,6,6,0,0,0-.88,0H56.42c-2.57-.08-5.18-.06-7.79,0H47.5l-1.23-.08c-.43,0-.88,0-1.27-.05-1.07,0-2.14.11-3,.11-4.7.16-9.18,0-13.88,0H25.72c-1,0-1.91,0-2.86,0l-.57,0h-.47l-.48,0-1.17-.05c-1.23,0-2.72-.15-4-.06l-.79,0v.24l.9-.06a23.07,23.07,0,0,1,2.9.06h1c1,0,2.05,0,3,.11l.45,0c1.07,0,2.2,0,3.24,0H28c5.67-.07,11.44-.12,17.29-.08l1.16,0,1.18,0,.59,0c3-.09,5.9,0,8.81.07h1.6a35.86,35.86,0,0,0,4.39.07,29.54,29.54,0,0,1,7.51-.12h5.72l0-.24H71.93ZM16,165.29c0,.12.07.24.1.36,3.84-.28,9.07-.47,9.07-.47A74.67,74.67,0,0,0,16,165.29Zm52.82-3.52c-2.79-.28-5.31.36-8.1,0l-.76,0c-.78,0-1.56,0-2.36,0h-1l-2,0H53.39c-1.94,0-3.86,0-5.79,0H46.45a8.89,8.89,0,0,1-1.15,0,10.9,10.9,0,0,0-1.26,0c-5.23.43-10.36.1-15.48,0l-1.87,0-1.79,0c-3.15-.09-6.47-.47-9.56-.26a2.48,2.48,0,0,1,0,.27,11.38,11.38,0,0,1,2.72-.11c1.71.21,3.63.27,5.5.33l1.46,0H28c2.71.06,5.7-.05,8.48.11,3,.17,5.76-.16,8.59-.23l1.2,0,1.2.06h8.87l1.12,0h2c.27,0,.55,0,.77.05a5.52,5.52,0,0,0,1.71.11c2.52,0,5.27-.35,7.83-.12l.76,0h5.86l0-.24H69.88C69.53,161.79,69.19,161.79,68.8,161.77ZM73,158l-1.08,0-1,0H66.66c-1.92,0-3.73,0-5.61,0h-1c-.67,0-1.35,0-2.14,0a96.92,96.92,0,0,1-15.52.07l-1.53,0H37.24l-1,0c-1.27,0-3,.27-3.86,0a6,6,0,0,0-.83-.06c-1.26-.05-2.53,0-3.75,0h-.45l-4.61.05-1.52,0c-1.4.09-3.11,0-4.56,0H15.29s0,.1,0,.15l1.09,0c2.33.08,4.89,0,7.25-.06l1.83,0h1.86c.69,0,1.4,0,2.09-.06s1.36,0,2,0a5.89,5.89,0,0,1,.8.08c.77.33,2.79,0,4,0l1.22,0h1.7c.24,0,.44,0,.64,0h1.74a137.87,137.87,0,0,0,17.13-.06l1.79,0H61c1.76.06,3.48.06,5.22,0h4.66l1,0h1c1.23,0,2.44,0,3.62,0a1.14,1.14,0,0,0-.1-.19C75.2,158,74.08,158,73,158Zm-47.19-.55h.8a24.7,24.7,0,0,1,4.94,0h.57l1.7,0h.53c1.6,0,3.2.09,4.8.07l.53,0h2.56c.5,0,1-.05,1.56,0a61.73,61.73,0,0,0,13.52,0c.38,0,.79,0,1.23,0h3.2c1.8.05,3.62,0,5.4,0h4.05a26.24,26.24,0,0,0,4.6.08,1.37,1.37,0,0,0-.47-.07,21,21,0,0,1-2.43-.06c-.75,0-1.52,0-2.3-.12l-.69,0H58.24c-.47-.07-1.05-.1-1.59-.13-4.6.64-8.23.37-13.06.09l-1.69.06-1.73,0-.94.05a13.22,13.22,0,0,1-2.89-.06l-.48,0H32.14c-.37,0-.75,0-1.13,0l-.81-.09-2.4,0c-.52,0-1.05.09-1.56.16H24.85c-2.43,0-5.14,0-7.65,0-.43,0-1.05,0-1.53,0h-.39v.06a.66.66,0,0,0,0,.14C18.74,157.56,22.26,157.46,25.79,157.45Zm45.89,1.16H65c-1.61,0-3.26,0-4.91,0H58.81c-5.27-.23-10.82.15-16.14,0l-1.78,0H36.25c-1.2,0-2.41.09-3.62.07l-.9,0H29.5l-1.11,0H26.65l-1.9,0a51.94,51.94,0,0,1-9.25,0,.9.9,0,0,0,.22.3,67.84,67.84,0,0,0,11.39-.24l1.28.07,1.24,0c1.64,0,3.31-.06,4.93-.08h.76l.79,0H40.8l1.8,0c5.39,0,10.52-.23,15.78,0h1.54c1.49,0,3-.06,4.53-.06h1c1.07,0,2.18,0,3.27,0h7.81l0-.19Zm-1.12,4.59a2.94,2.94,0,0,1-.44,0,24.52,24.52,0,0,0-5.48.12c-2.07.11-3.9-.06-5.74-.12h-.5c-1.7,0-3.4.07-5,.06h-5L47,163.19H43.79a108.66,108.66,0,0,0-14.21,0c-.74,0-1.42,0-2.09-.06s-1.36-.07-2-.09l-.51,0-.47,0H24c-1.67,0-3.18.16-4.71.26H17.12l-.93,0-.79,0c0,.07,0,.13,0,.2h4.26c1.25-.06,2.36-.16,3.61-.15h.54c.89,0,1.78,0,2.67.05l.48,0,1.91.06a120,120,0,0,1,15.4,0h1.26l1.26,0h.5c.5,0,1,0,1.53,0H54l1.61,0h.53c.8-.07,1.6-.09,2.4-.08h.48c1,0,2.14.09,3.06.15,2.75.06,5.5-.35,8.28-.09h2.69l1.6,0h1.48c0-.06,0-.11,0-.17H74.84C73.41,163.19,72,163.18,70.56,163.2Zm-43.68,1.44,1.08.05c.71,0,1.42.08,2.15.1h1.08c.72,0,1.43,0,2.1.06h1.17l1,0h4.79c1.15,0,2.31,0,3.47,0h1.16a25.29,25.29,0,0,1,4.44,0H59.57c1.44-.05,2.75-.1,4.17,0l1,0,1,0c3.44.22,6.91.34,10.39.23v-.2c-3.51.14-6.91-.1-10.46-.25h-.58l-.91,0h-.93c-1.37-.05-2.79,0-4.23.07H49.28c-1.2,0-2.51-.11-3.72,0H44.41c-1.53,0-3.06,0-4.64,0H36.55l-2.42,0H32.87c-.82,0-1.62,0-2.43-.06H30l-1,0-1.05,0a19.36,19.36,0,0,0-4.19.08l-.53,0h-.56l-2.84,0h-.65c-1.13,0-2.26,0-3.38,0a1.59,1.59,0,0,1,.07.2c1.13,0,2.25,0,3.36,0h.58l2.92,0h1.21l.44,0,.44,0A10.37,10.37,0,0,1,26.88,164.64Zm42,6.76H65.81c-1.71.1-3.41.16-5.09.19.91,0,1.82,0,2.7.06l3.15-.09h1.25l1.24,0c.41,0,.82,0,1.23-.09,1.84-.14,3.54.13,5.44.07h.16a.56.56,0,0,1,0-.12A56.85,56.85,0,0,0,68.9,171.4Zm-3.4-.81H63.92l-1.57,0H50.41c-1.13,0-2-.15-3.19-.1a56.56,56.56,0,0,1-7.23.11H35.36c-4.85,0-9.8,0-14.66,0h-.56c-1.48,0-3,0-4.48,0a.91.91,0,0,0,.11.16c1.14,0,2.28,0,3.41,0l1.05,0c4.83-.1,9.67,0,14.55-.05h5.36c3.41.19,6.62-.16,10.13,0h4.57c3,.07,6,.12,9,0H66c3.34-.06,6.74-.38,10.09-.2,0-.07,0-.14,0-.21C72.69,170.18,69.17,170.51,65.5,170.59ZM76,160.1H73.38c-1.06,0-2.17,0-3.28,0h-2c-3.3,0-6.73,0-10.07,0h-2A60,60,0,0,0,44,160l-1.53,0-1.53,0-1.36,0c-.89,0-1.77,0-2.66,0H34.13a22.1,22.1,0,0,0-4.6,0H27.22c-3.84-.17-7.83,0-11.79,0l0,0a.36.36,0,0,0,0,.09c4.25,0,8.52-.26,12.83,0h1.68a20.85,20.85,0,0,1,3.71-.08l1.28,0h4l1.22,0h1.22l1.86,0,1.92-.05a70.22,70.22,0,0,1,11,.13h4.59c2.92,0,5.83,0,8.73,0H71.3c.41,0,.71,0,1.09,0h4.16a.88.88,0,0,0,0-.17H76Zm-5.72,3.72-1.06.07h-.92c-2.49,0-5.24.05-7.7-.11l-.85,0-.87,0h-.52l-1.6,0H49.28l-1.47,0h-6c-3.87-.47-7.71.12-11.8-.07-.43,0-.87,0-1.32,0h-.54l-1.13,0c-1.06,0-2.18-.07-3.31,0-.37,0-.74,0-1.11.08l-.34,0h-1c-1.92,0-3.85.06-5.78.07l.07.22,6.68-.09h.58c.28-.05.57-.09.85-.12a28.51,28.51,0,0,1,4.72,0h.51q.76,0,1.5.06c.49,0,1,.07,1.43.13,3.33-.05,6.53-.22,10,0h.5c1.72,0,3.44,0,5.17,0H59.1c.7,0,1.43-.05,2.16-.06.24,0,.48,0,.73,0,1.73,0,3.33.14,5.19.07h1.34c2.46,0,5,0,7.62,0v-.2C74.17,163.94,72.27,163.74,70.25,163.82Z" transform="translate(-14.43 -73.31)" fill="url(#linear-gradient-4)"/>
									<g>
										<circle cx="55.98" cy="87.22" r="1.33" fill="url(#linear-gradient-5)"/>
										<path d="M71.4,160.53a1,1,0,1,1-2,0,1,1,0,0,1,2,0Z" transform="translate(-14.43 -73.31)" fill="url(#linear-gradient-6)"/>
										<path d="M71.23,160.53a.83.83,0,1,1-1.66,0,.83.83,0,0,1,1.66,0Z" transform="translate(-14.43 -73.31)" fill="url(#radial-gradient)"/>
										<path d="M69.72,161l0,.07a.43.43,0,0,0,.1.09l1.26-1a1,1,0,0,1-.08-.11l-.06-.06Z" transform="translate(-14.43 -73.31)" fill="url(#linear-gradient-7)"/>
									</g>
									<g>
										<circle cx="7.52" cy="86.34" r="1.33" fill="url(#linear-gradient-8)"/>
										<path d="M22.94,159.65a1,1,0,1,1-2,0,1,1,0,0,1,2,0Z" transform="translate(-14.43 -73.31)" fill="url(#linear-gradient-9)"/>
										<path d="M22.77,159.65a.83.83,0,1,1-.83-.83A.83.83,0,0,1,22.77,159.65Z" transform="translate(-14.43 -73.31)" fill="url(#radial-gradient-2)"/>
										<path d="M21.26,160.1l0,.07.1.09,1.26-1-.08-.11-.06-.06Z" transform="translate(-14.43 -73.31)" fill="url(#linear-gradient-10)"/>
									</g>
									<g>
										<path d="M23.32,169A1.33,1.33,0,1,1,22,167.68,1.33,1.33,0,0,1,23.32,169Z" transform="translate(-14.43 -73.31)" fill="url(#linear-gradient-11)"/>
										<path d="M23,169a1,1,0,1,1-1-1A1,1,0,0,1,23,169Z" transform="translate(-14.43 -73.31)" fill="url(#linear-gradient-12)"/>
										<path d="M22.82,169a.83.83,0,1,1-1.66,0,.83.83,0,1,1,1.66,0Z" transform="translate(-14.43 -73.31)" fill="url(#radial-gradient-3)"/>
										<path d="M21.31,169.45l.05.07.09.1,1.26-1.05a.75.75,0,0,0-.07-.12l-.06-.06Z" transform="translate(-14.43 -73.31)" fill="url(#linear-gradient-13)"/>
									</g>
									<g>
										<path d="M72,169.09a1.33,1.33,0,1,1-1.33-1.33A1.32,1.32,0,0,1,72,169.09Z" transform="translate(-14.43 -73.31)" fill="url(#linear-gradient-14)"/>
										<path d="M71.69,169.09a1,1,0,1,1-2,0,1,1,0,0,1,2,0Z" transform="translate(-14.43 -73.31)" fill="url(#linear-gradient-15)"/>
										<path d="M71.52,169.09a.83.83,0,1,1-1.66,0,.83.83,0,0,1,1.66,0Z" transform="translate(-14.43 -73.31)" fill="url(#radial-gradient-4)"/>
										<path d="M70,169.54l0,.07.1.09,1.26-1-.08-.11-.06-.06Z" transform="translate(-14.43 -73.31)" fill="url(#linear-gradient-16)"/>
									</g>
									<path d="M75.31,157.47c-3.43.1-.84-.49-26.31-.33s-33-.33-33-.33c-.49.08-.67,0-.68.53,0,.14,0,.27,0,.39a.41.41,0,0,1,0-.11c0-.49.19-.45.68-.53,0,0,7.58.5,33,.33s22.88.44,26.31.33c1,0,1.27.73,1.29,1.79C76.62,158.33,76.36,157.44,75.31,157.47Z" transform="translate(-14.43 -73.31)" fill="#fcd797"/>
								</g>
							</g>
							<line x1="56.31" y1="80.27" x2="127.02" y2="9.55" fill="none"/>
							<line x1="85.57" x2="145.44" fill="none"/>
							<line x1="56.31" y1="98.27" x2="127.02" y2="27.55" fill="none"/>
						</svg>
						<div class="text">
							<a href="#<php echo $k ?>" ><php echo $k ?></a>
						</div>
					</div>
<php }?>
				</div>-->
			</div>
		</div>



		<!-- login modal -->
		<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="loginform">

							<form id="login-form" method="post" action="">
								<!-- Tabs Titles -->
								<h2 class="" id="login-link"> جهت ورود یا ثبت نام شماره موبایل خود را وارد نمایید </h2>
								<!-- Icon -->
								<div class="fadeIn first">
								  <img src="images/user-icon.svg" id="icon" alt="User Icon" />
								</div>
								<!-- Login Form -->
								<input type="text" id="login" class="fadeIn" name="user_Phone" placeholder="شماره موبایل">
								<input type="button" name="loginSub" id="login_submit" class="fadeIn second fooderz_btn full_width" value="ادامه">
							</form>

							<div id="formFooter" style="display: none;">
								<a class="forgetpass-link" href="#">رمز عبورم را فراموش کرده ام</a>
							</div>

							<!-- forget password part -->
							<div id="forgetpass">
								<h6>شماره موبایل خود را جهت دریافت رمز جدید وارد نمایید</h6>
								<input type="text"  class="fadeIn" name="" placeholder="شماره موبایل ">
								<input type="button" id="forgetpass_submit" class="fadeIn fooderz_btn full_width" value="ارسال">
							</div>

							<div id="confirm_code">
								<h6>لطفا کد تاییدی که برایتان پیامک شده را وارد نمایید</h6>
								<input type="text" id="confirm_code_inp"  class="fadeIn" name="" placeholder="کد تایید">
								<input type="button" id="confirm_code_submit" class="fadeIn fooderz_btn full_width" value="ثبت">
							</div>

							<!-- login continue Form -->
							<form id="login-cont-form">
								<h6>شماره موبایل : 09178159981</h6>
								<br />
								<input type="password" id="login_pass" class="fadeIn" name="signup-mobile" placeholder="رمز عبور">
								<input type="button" id="signin_submit" class="fadeIn second fooderz_btn full_width" value="ورود">
								<a class="forgetpass-link full_width fadeIn third" style="display:block" href="#">رمز عبورم را فراموش کرده ام</a>
							</form>

							<!-- sign up Form -->
							<form id="signup-form">
								<input type="text" class="fadeIn" placeholder="نام">
								<input type="text" class="fadeIn" placeholder="نام خانوادگی">
								<input type="password" id="pass" class="fadeIn" name="signup-mobile" placeholder="رمز عبور">
								<input type="password" id="rePass" class="fadeIn second" name="login" placeholder="تکرار رمز عبور">
								<input type="button" id="signup_submit" class="fadeIn third fooderz_btn full_width" value="ثبت">
							</form>

						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /modals -->


		<script src="js/plugins.min.js"></script>
		<script src="js/layout.js"></script>
		<script src="js/menu.js"></script>
		<script>
			$('#addToFavorite').click(function(){
       			 $.post('favorite_ajax.php', {add: <?php echo $prv_ID ?>}, function(ex) {
       			 });
    		});
			$('#delFavorite').click(function(){
       			 $.post('favorite_ajax.php', {del: <?php echo $prv_ID ?>}, function(ex) {
       			 });
    		});
			$('#sabte_sefaresh').click(function(){
				var name = $('.cart-details .food-row .name');
				var count = $('.cart-details .food-row .count');
				var name_length = name.length;
				var order = {}
				order['purchase'] = {}
				order['details'] = {prv_ID: $("#prv_ID").val()}
				for (var i=1; i<name_length; i++)
				{
					order['purchase'][i] = {};
					order['purchase'][i]['name'] = name[i].innerHTML;
					order['purchase'][i]['count'] = count[i].innerHTML;
				}
				console.log(order);

				// var order_names =[];
				// var order_counts =[];
				// for (var i=1; i<name_length; i++){
				// 	order_names.push(name[i].innerHTML)
				// 	order_counts.push(count[i].innerHTML)
				// }
				// var order_details = {
				// 	name: order_names,
				// 	count: order_counts
				// }
				$("#order").val(JSON.stringify(order));
				$("#orderForm").submit();
		        // $.post('order_ajax.php', {order: order, prv_ID: <php echo $prv_ID ?>}, function(data) {
		        //     alert(data)
		        // });

			})
		</script>
	</body>
</html>