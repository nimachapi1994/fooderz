<?php
session_start();
if (isset($_GET['ss']) && $_GET['ss']==10) 
{
    $_SESSION['provider_login'] = "";
    // session_destroy();
    header("location: ../restaurant_login.php");
    die();
    // echo '<meta http-equiv="refresh" content="0;url=../restaurant_login.php">';
}
// var_dump($_SESSION);
// die();
include $_SERVER["DOCUMENT_ROOT"] . "/Fooderz/funx.php";
require_once '../../DataBase/PDO/DBconnect/DBconnect.php';
try
{
//        echo $_POST['phoneSrch'];
    $sql = "SELECT purchasecart.pch_ID, concat(customers.fname,' ', customers.lname) fullname, customers.phone, purchasecart.sum, purchasecart.date1,purchasecart.address,purchasecart.description, purchasecart.items
            FROM customers
            INNER JOIN purchasecart ON customers.cus_ID = purchasecart.cus_ID
            INNER JOIN provider ON provider.prv_ID = purchasecart.prv_ID WHERE provider.prv_ID=:prv_ID";
    $stmt    = $db->prepare($sql);
    $bindArr = array
    (
        ":prv_ID" => '1092',
    );
    $stmt->execute($bindArr);
    $row     = $stmt->fetch();
    $errInfo = $stmt->errorInfo();
}
catch (Exception $e)
{
    $err = $e->getMessage();
}
// if (isset($_POST['prvSub']))
// {
//     $dis      = 'disabled';
//     $prvPhone = $_POST['prvPhone'];
//     $prvPass  = $_POST['prvPass'];//     try
//     {
// //        echo $_POST['phoneSrch'];
//         $sql = "SELECT `prv_ID`, `providerName`, `telephone`, `managerName`, `mobile`, `email`, `address`, `latitude`, `longitude`, `country`, `state`, `city`, `regions`, `postalCode`, `provideType`, `resturantTpe`, `password`, `datenTime`, `bornDate`, `minimomOrder`, `weeklyWorkTIme`, `deliveryCost`, `URL`, `logoPath`, `natCardPath`, `contractPath`, `confirmByAdmin`, `reserve`, `sheba_number`, `motto`, `description`, `total_visitors`,
//     `branch` FROM `provider` WHERE mobile=:mobile and password=:password";
//         $stmt    = $db->prepare($sql);
//         $bindArr = array
//             (
//             ":mobile"   => $prvPhone,
//             ":password" => $prvPass,
//             );
//         $stmt->execute($bindArr);
//         $row     = $stmt->fetch();
//         $errInfo = $stmt->errorInfo();

//     }
//     catch (Exception $e)
//     {
//         $err = $e->getMessage();
//     }
//     $managerName = $stmt->fetch()['managerName'];

// }
// if ($_SESSION['provider_login'] === 'auth')
// {
//     $access = "verified";
// }
if (isset($_SESSION['provider_login']) && $_SESSION['provider_login']!='') // true1 || 1
{
    $prv_ID = $_SESSION['provider_login'];
    $dis    = 'disabled';
    try
    {
//        echo $_POST['phoneSrch'];
        require_once '../../DataBase/PDO/DBconnect/DBconnect.php';
        $sql = "SELECT `prv_ID`, `providerName`, `telephone`, `managerName`, `mobile`, `email`, `address`, `latitude`,
 `longitude`, `country`, `state`, `city`, `regions`, `postalCode`, `provideType`, `resturantType`, `password`,
  `datenTime`, `bornDate`, `minimomOrder`, `weeklyWorkTIme`, `deliveryCost`, `URL`, `logoPath`,
   `natCardPath`, `contractPath`, `confirmByAdmin`, `reserve`, `sheba_number`, `motto`, `description`, `total_visitors`,
    `branch`, `discount`, `deliveryTime` FROM `provider` WHERE prv_ID=:prv_ID";
        $stmt    = $db->prepare($sql);
        $bindArr = array
            (
            ':prv_ID' => $prv_ID,
        );
        $stmt->execute($bindArr);
        $row = $stmt->fetch();

        $errInfo = $stmt->errorInfo();

    }
    catch (Exception $e)
    {
        $err = $e->getMessage();
    }
    $access = "verified";

    //new DB call
    try
    {
//        echo $_POST['phoneSrch'];
        require_once arp('DataBase/PDO/DBconnect/DBconnect.php');
        $sql     = "SELECT  menu from provider where prv_ID=:prv_ID";
        $stmt    = $db->prepare($sql);
        $bindArr = array
            (
            ":prv_ID" => $prv_ID,
        );
        $stmt->execute($bindArr);
        $giftRow = $stmt->fetch()['menu'];
        $errInfo = $stmt->errorInfo();
        $giftRow = json_decode($giftRow, true);
        // print_r($giftRow);
        $gifted  = (isset($giftRow['gift'])) ? $giftRow['gift'] : array();
        $giftRow = $giftRow['menu'];
        //     print_r($giftRow);
        // die();
    }
    catch (Exception $e)
    {
        $err = $e->getMessage();
    }
// die();
    //new DB call
}
elseif ((isset($_SESSION['rnd']) && isset($_GET['rnd']) && $_SESSION['rnd'] == $_GET['rnd'])) // true1 || 1
{
    $prv_ID = $_GET['prv_ID'];
    $dis    = 'disabled';
    try
    {
//        echo $_POST['phoneSrch'];
        require_once '../../DataBase/PDO/DBconnect/DBconnect.php';
        $sql = "SELECT `prv_ID`, `providerName`, `telephone`, `managerName`, `mobile`, `email`, `address`, `latitude`,
 `longitude`, `country`, `state`, `city`, `regions`, `postalCode`, `provideType`, `resturantType`, `password`,
  `datenTime`, `bornDate`, `minimomOrder`, `weeklyWorkTIme`, `deliveryCost`, `URL`, `logoPath`,
   `natCardPath`, `contractPath`, `confirmByAdmin`, `reserve`, `sheba_number`, `motto`, `description`, `total_visitors`,
    `branch`, `discount`, `deliveryTime` FROM `provider` WHERE prv_ID=:prv_ID";
        $stmt    = $db->prepare($sql);
        $bindArr = array
            (
            ':prv_ID' => $prv_ID,
        );
        $stmt->execute($bindArr);
        $row = $stmt->fetch();

        $errInfo = $stmt->errorInfo();

    }
    catch (Exception $e)
    {
        $err = $e->getMessage();
    }
    $access = "verified";

    //new DB call
    try
    {
//        echo $_POST['phoneSrch'];
        require_once arp('DataBase/PDO/DBconnect/DBconnect.php');
        $sql     = "SELECT  menu from provider where prv_ID=:prv_ID";
        $stmt    = $db->prepare($sql);
        $bindArr = array
            (
            ":prv_ID" => $prv_ID,
        );
        $stmt->execute($bindArr);
        $giftRow = $stmt->fetch()['menu'];
        $errInfo = $stmt->errorInfo();
        $giftRow = json_decode($giftRow, true);
        // print_r($giftRow);
        $gifted  = (isset($giftRow['gift'])) ? $giftRow['gift'] : array();
        $giftRow = $giftRow['menu'];
        //     print_r($giftRow);
        // die();
    }
    catch (Exception $e)
    {
        $err = $e->getMessage();
    }
// die();
    //new DB call
}
else
{
    $access = "denied";
}

unset($_SESSION['rnd']);
//if (isset($_SESSION['pname']))
if ($access == "verified") // true1  || 1
{
    $managerName   = $row['managerName'];
    $providerName  = $row['providerName'];
    $prvPhone      = $row['telephone'];
    $prvMobile     = $row['mobile'];
    $address       = $row['address'];
    $provideType   = $row['provideType'];
    $prvPhone      = $row['telephone'];
    $postalCode    = $row['postalCode'];
    $resturantType = $row['resturantType'];
    $discount      = ($row['discount']) ? $row['discount'] : "0";
    // die($discount2);
    $delTime    = $row['deliveryTime'];
    $delTime    = json_decode($delTime, 1);
    $minDelTime = $delTime['min'];
    $maxDelTime = $delTime['max'];

    if ($provideType != 'رستوران')
    {
        $naam = $provideType;
        $noo  = 'خدمات';
        $noo2 = $provideType;
    }
    else
    {
        $naam = 'رستوران';
        $noo  = 'رستوران';
        $noo2 = $resturantType;
    }
    //weeklyWorkTIme Array
    $weeklyWorkTIme = $row['weeklyWorkTIme'];
    $weeklyWorkTIme = json_decode($weeklyWorkTIme, true);
    $morningFrom    = $weeklyWorkTIme['morning']['From'];
    $morningTo      = $weeklyWorkTIme['morning']['To'];
    $eveningFrom    = $weeklyWorkTIme['evening']['From'];
    $eveningTo      = $weeklyWorkTIme['evening']['To'];
    $midnightFrom   = $weeklyWorkTIme['midnight']['From'];
    $midnightTo     = $weeklyWorkTIme['midnight']['To'];
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>اطلاعات رستوران</title>
    <!-- custom-theme -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <!-- //custom-theme -->
    <link href="../css/other_styles.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="../css/style.css" rel="stylesheet" type="text/css" media="all"/><!-- Theme-CSS -->
</head>
<body class="">

	<!-- panel mobile menu -->
	<div class="menu_transparent_layer"></div>
	<div class="mobile-menu">
		<div class="profile">
			<svg class="icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 55 55" >
				<path d="M55,27.5C55,12.337,42.663,0,27.5,0S0,12.337,0,27.5c0,8.009,3.444,15.228,8.926,20.258l-0.026,0.023l0.892,0.752  c0.058,0.049,0.121,0.089,0.179,0.137c0.474,0.393,0.965,0.766,1.465,1.127c0.162,0.117,0.324,0.234,0.489,0.348  c0.534,0.368,1.082,0.717,1.642,1.048c0.122,0.072,0.245,0.142,0.368,0.212c0.613,0.349,1.239,0.678,1.88,0.98  c0.047,0.022,0.095,0.042,0.142,0.064c2.089,0.971,4.319,1.684,6.651,2.105c0.061,0.011,0.122,0.022,0.184,0.033  c0.724,0.125,1.456,0.225,2.197,0.292c0.09,0.008,0.18,0.013,0.271,0.021C25.998,54.961,26.744,55,27.5,55  c0.749,0,1.488-0.039,2.222-0.098c0.093-0.008,0.186-0.013,0.279-0.021c0.735-0.067,1.461-0.164,2.178-0.287  c0.062-0.011,0.125-0.022,0.187-0.034c2.297-0.412,4.495-1.109,6.557-2.055c0.076-0.035,0.153-0.068,0.229-0.104  c0.617-0.29,1.22-0.603,1.811-0.936c0.147-0.083,0.293-0.167,0.439-0.253c0.538-0.317,1.067-0.648,1.581-1  c0.185-0.126,0.366-0.259,0.549-0.391c0.439-0.316,0.87-0.642,1.289-0.983c0.093-0.075,0.193-0.14,0.284-0.217l0.915-0.764  l-0.027-0.023C51.523,42.802,55,35.55,55,27.5z M2,27.5C2,13.439,13.439,2,27.5,2S53,13.439,53,27.5  c0,7.577-3.325,14.389-8.589,19.063c-0.294-0.203-0.59-0.385-0.893-0.537l-8.467-4.233c-0.76-0.38-1.232-1.144-1.232-1.993v-2.957  c0.196-0.242,0.403-0.516,0.617-0.817c1.096-1.548,1.975-3.27,2.616-5.123c1.267-0.602,2.085-1.864,2.085-3.289v-3.545  c0-0.867-0.318-1.708-0.887-2.369v-4.667c0.052-0.519,0.236-3.448-1.883-5.864C34.524,9.065,31.541,8,27.5,8  s-7.024,1.065-8.867,3.168c-2.119,2.416-1.935,5.345-1.883,5.864v4.667c-0.568,0.661-0.887,1.502-0.887,2.369v3.545  c0,1.101,0.494,2.128,1.34,2.821c0.81,3.173,2.477,5.575,3.093,6.389v2.894c0,0.816-0.445,1.566-1.162,1.958l-7.907,4.313  c-0.252,0.137-0.502,0.297-0.752,0.476C5.276,41.792,2,35.022,2,27.5z M42.459,48.132c-0.35,0.254-0.706,0.5-1.067,0.735  c-0.166,0.108-0.331,0.216-0.5,0.321c-0.472,0.292-0.952,0.57-1.442,0.83c-0.108,0.057-0.217,0.111-0.326,0.167  c-1.126,0.577-2.291,1.073-3.488,1.476c-0.042,0.014-0.084,0.029-0.127,0.043c-0.627,0.208-1.262,0.393-1.904,0.552  c-0.002,0-0.004,0.001-0.006,0.001c-0.648,0.16-1.304,0.293-1.964,0.402c-0.018,0.003-0.036,0.007-0.054,0.01  c-0.621,0.101-1.247,0.174-1.875,0.229c-0.111,0.01-0.222,0.017-0.334,0.025C28.751,52.97,28.127,53,27.5,53  c-0.634,0-1.266-0.031-1.895-0.078c-0.109-0.008-0.218-0.015-0.326-0.025c-0.634-0.056-1.265-0.131-1.89-0.233  c-0.028-0.005-0.056-0.01-0.084-0.015c-1.322-0.221-2.623-0.546-3.89-0.971c-0.039-0.013-0.079-0.027-0.118-0.04  c-0.629-0.214-1.251-0.451-1.862-0.713c-0.004-0.002-0.009-0.004-0.013-0.006c-0.578-0.249-1.145-0.525-1.705-0.816  c-0.073-0.038-0.147-0.074-0.219-0.113c-0.511-0.273-1.011-0.568-1.504-0.876c-0.146-0.092-0.291-0.185-0.435-0.279  c-0.454-0.297-0.902-0.606-1.338-0.933c-0.045-0.034-0.088-0.07-0.133-0.104c0.032-0.018,0.064-0.036,0.096-0.054l7.907-4.313  c1.36-0.742,2.205-2.165,2.205-3.714l-0.001-3.602l-0.23-0.278c-0.022-0.025-2.184-2.655-3.001-6.216l-0.091-0.396l-0.341-0.221  c-0.481-0.311-0.769-0.831-0.769-1.392v-3.545c0-0.465,0.197-0.898,0.557-1.223l0.33-0.298v-5.57l-0.009-0.131  c-0.003-0.024-0.298-2.429,1.396-4.36C21.583,10.837,24.061,10,27.5,10c3.426,0,5.896,0.83,7.346,2.466  c1.692,1.911,1.415,4.361,1.413,4.381l-0.009,5.701l0.33,0.298c0.359,0.324,0.557,0.758,0.557,1.223v3.545  c0,0.713-0.485,1.36-1.181,1.575l-0.497,0.153l-0.16,0.495c-0.59,1.833-1.43,3.526-2.496,5.032c-0.262,0.37-0.517,0.698-0.736,0.949  l-0.248,0.283V39.8c0,1.612,0.896,3.062,2.338,3.782l8.467,4.233c0.054,0.027,0.107,0.055,0.16,0.083  C42.677,47.979,42.567,48.054,42.459,48.132z" fill="#D80027"/>
			</svg>
		</div>
		<ul class="menu-list">
			<li id="manager_info_tab2" class="active"><a href="#"><i class="fas fa-user"></i>&nbsp; اطلاعات شخصی مدیر رستوران</a></li>
            <li id="restaurant_info_tab2"><a href="#"><i class="fas fa-list-alt"></i>&nbsp; تنظیمات رستوران و منو</a></li>
            <li id="peyk_tab2"><a href="#"><i class="fas fa-motorcycle"></i>&nbsp; درخواست پیک موتوری</a></li>
            <li id="gift_tab2"><a href="#"><i class="fas fa-gift"></i>&nbsp; تخفیف ها و هدایا</a></li>
            <li id="report_tab2"><a href="#"><i class="fas fa-chart-pie"></i>&nbsp; گزارش مالی</a></li>
            <li><a href="#"><i class="fas fa-sign-out-alt"></i>&nbsp; خروج از پنل</a></li>
		</ul>
	</div>




<div class="row no-margin all_content">
    <!-- side bar panel -->
    <div class="col-md-2 panel_sidebar">
        <!-- logo -->
        <div class="text-center">
            <img src="../images/logo.png" width="60px"/>
        </div>
        <nav>
            <ul>
                <li id="manager_info_tab" class="active"><a href="#"><i class="fas fa-user"></i>&nbsp; اطلاعات شخصی مدیر رستوران</a></li>
                <li id="restaurant_info_tab"><a href="#"><i class="fas fa-list-alt"></i>&nbsp; تنظیمات رستوران و منو</a></li>
                <li id="peyk_tab"><a href="#"><i class="fas fa-motorcycle"></i>&nbsp; درخواست پیک موتوری</a></li>
                <li id="gift_tab"><a href="#"><i class="fas fa-gift"></i>&nbsp; تخفیف ها و هدایا</a></li>
                <li id="report_tab"><a href="#"><i class="fas fa-chart-pie"></i>&nbsp; گزارش مالی</a></li>
                <li id="exit"><a href="provider_info.php?ss=10"><i class="fas fa-sign-out-alt"></i>&nbsp; خروج از پنل</a></li>
            </ul>
        </nav>
    </div>

    <div class="col-md-10 panel_main_box">
        <!-- /manager panel -->
        <div class="panel_bar active" id="manager_info_panel">
            <!-- page-title -->
            <div class="title-bar">
                <button class="panel_menu_btn"><i class="fa fa-bars"></i></button>
                <h1 class="page-title provider-title"><i class="fas fa-user"></i>&nbsp; اطلاعات شخصی مدیر رستوران</h1>
                <div class="dropholder pull-left">
                    <p>سلام، <?php echo $managerName; ?></p>
                </div>
            </div>

            <!-- main content -->
            <div class="main-content fadeIn">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h4 class="panel_internal_title tomato">نام مدیر</h4>
                                    <div class="pull-right input_icon"><i class="fas fa-user"></i></div>
                                    <input class="iconed_input" type="text" value="<?php echo $managerName; ?>" <?php echo $dis; ?>/>
                                </div>
                                <div class="col-sm-6">
                                    <h4 class="panel_internal_title tomato">تاریخ تولد</h4>
                                    <div class="pull-right input_icon"><i class="fas fa-user"></i></div>
                                    <input class="iconed_input" type="text" value="<?php echo 'تاریخ تولد'; ?>" <?php echo $dis; ?>/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <h4 class="panel_internal_title tomato">شماره موبایل</h4>
                                    <div class="pull-right input_icon"><i class="fas fa-mobile-alt"></i></div>
                                    <input class="iconed_input" type="text" value="<?php echo $prvMobile; ?>" <?php echo $dis; ?>/>
                                </div>
                                <div class="col-sm-6">
                                    <h4 class="panel_internal_title tomato">شماره تلفن ثابت</h4>
                                    <div class="pull-right input_icon"><i class="fas fa-phone"></i></div>
                                    <input class="iconed_input" type="text" value="<?php echo $prvPhone; ?>" <?php echo $dis; ?>/>
                                </div>
                            </div>
                            <h4 class="panel_internal_title tomato">آدرس محل سکونت</h4>
                            <div class="pull-right input_icon"><i class="fas fa-map-marker-alt"></i></div>
                            <input class="iconed_input" type="text" value="<?php echo $address; ?>" <?php echo $dis; ?>/>

                            <h4 class="panel_internal_title tomato">شماره شبای بانکی</h4>
                            <div class="pull-right input_icon"><i class="fas fa-dollar-sign"></i></div>
                            <input class="iconed_input" type="text" value="<?php echo $row['sheba_number'] ?>" <?php echo $dis; ?>/>
							
							<hr />
							<form action="../restaurant_login.php" method="post">
								<h4 class="panel_internal_title">تغییر رمز</h4>
								<br />
								<div class="row">
									<div class="col-sm-6">
										<h4 class="panel_internal_title tomato">رمز انتخابی جدید</h4>
										<div class="pull-right input_icon editable"><i class="fas fa-key"></i></div>
										<input name="ch_pass" class="iconed_input" type="password" placeholder="رمز جدید را وارد کنید"/>
									</div>
									<div class="col-sm-6">
										<h4 class="panel_internal_title tomato">ورود دوباره رمز جدید</h4>
										<div class="pull-right input_icon editable"><i class="fas fa-key"></i></div>
										<input name="ch_repass" class="iconed_input" type="password" placeholder="رمز جدید را دوباره وارد کنید" />
									</div>
								<div class="text-center">
									<button type="submit" name="ch_sub" class="fooderz_btn single_submit">تغییر رمز</button>
								</div>
                            </div>
							</form>
							
							
                        </div>
                        <div class="col-md-6 text-center desc">
							<div class="panel_infoo_box">
								<p>
									<div class="text-center">
										<svg class="bell_svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 511.998 511.998" style="enable-background:new 0 0 511.998 511.998;" xml:space="preserve">
											<linearGradient id="SVGID_1_" gradientUnits="userSpaceOnUse" x1="228.382" y1="110.8574" x2="321.162" y2="-43.7726" gradientTransform="matrix(1.0667 0 0 -1.0667 3.267 557.5334)">
												<stop offset="0" style="stop-color:#FFC200"/>
												<stop offset="0.268" style="stop-color:#FFBB00"/>
												<stop offset="0.659" style="stop-color:#FFA801"/>
												<stop offset="1" style="stop-color:#FF9102"/>
											</linearGradient>
											<circle style="fill:url(#SVGID_1_);" cx="255.995" cy="454.485" r="57.513"/>
											<linearGradient id="SVGID_2_" gradientUnits="userSpaceOnUse" x1="320.4345" y1="26.8998" x2="197.0945" y2="150.2398" gradientTransform="matrix(1.0667 0 0 -1.0667 3.267 557.5334)">
												<stop offset="0" style="stop-color:#FFC200;stop-opacity:0"/>
												<stop offset="0.203" style="stop-color:#FFBB00;stop-opacity:0.203"/>
												<stop offset="0.499" style="stop-color:#FFA700;stop-opacity:0.499"/>
												<stop offset="0.852" style="stop-color:#FF8800;stop-opacity:0.852"/>
												<stop offset="1" style="stop-color:#FF7800"/>
											</linearGradient>
											<path style="fill:url(#SVGID_2_);" d="M255.995,396.975c-29.957,0-54.554,22.907-57.255,52.158l62.609,62.61  c29.251-2.702,52.158-27.298,52.158-57.255C313.507,422.724,287.758,396.975,255.995,396.975z"/>
											<linearGradient id="SVGID_3_" gradientUnits="userSpaceOnUse" x1="182.8628" y1="237.0479" x2="414.4429" y2="-148.9121" gradientTransform="matrix(1.0667 0 0 -1.0667 3.267 557.5334)">
												<stop offset="0" style="stop-color:#FFC200"/>
												<stop offset="0.268" style="stop-color:#FFBB00"/>
												<stop offset="0.659" style="stop-color:#FFA801"/>
												<stop offset="1" style="stop-color:#FF9102"/>
											</linearGradient>
											<path style="fill:url(#SVGID_3_);" d="M444.458,354.192H67.532c-25.743,0-46.611,20.868-46.611,46.612  c0,25.743,20.868,46.612,46.611,46.612h376.926c25.743,0,46.612-20.869,46.612-46.612  C491.069,375.06,470.201,354.192,444.458,354.192z"/>
											<linearGradient id="SVGID_4_" gradientUnits="userSpaceOnUse" x1="182.14" y1="328.1452" x2="393.4199" y2="129.1352" gradientTransform="matrix(1.0667 0 0 -1.0667 3.267 557.5334)">
												<stop offset="0" style="stop-color:#FFC200"/>
												<stop offset="0.268" style="stop-color:#FFBB00"/>
												<stop offset="0.659" style="stop-color:#FFA801"/>
												<stop offset="1" style="stop-color:#FF9102"/>
											</linearGradient>
											<path style="fill:url(#SVGID_4_);" d="M417.478,319.025v-93.437c0-75.566-51.902-138.983-121.996-156.602  c3.998-6.803,6.313-14.729,6.313-23.187C301.794,20.508,281.286,0,255.995,0s-45.799,20.508-45.799,45.799  c0,8.459,2.315,16.384,6.313,23.187C146.413,86.605,94.525,150.023,94.525,225.588v93.437c0,20.227-16.398,36.626-36.625,36.626  h396.19C433.862,355.651,417.478,339.252,417.478,319.025z M255.995,64.106c-10.114,0-18.32-8.192-18.32-18.306  c0-10.128,8.206-18.32,18.32-18.32s18.32,8.192,18.32,18.32C274.315,55.914,266.109,64.106,255.995,64.106z"/>
											<linearGradient id="SVGID_5_" gradientUnits="userSpaceOnUse" x1="433.7985" y1="142.993" x2="-2.9415" y2="97.923" gradientTransform="matrix(1.0667 0 0 -1.0667 3.267 557.5334)">
												<stop offset="0" style="stop-color:#FFC200;stop-opacity:0"/>
												<stop offset="0.203" style="stop-color:#FFBB00;stop-opacity:0.203"/>
												<stop offset="0.499" style="stop-color:#FFA700;stop-opacity:0.499"/>
												<stop offset="0.852" style="stop-color:#FF8800;stop-opacity:0.852"/>
												<stop offset="1" style="stop-color:#FF7800"/>
											</linearGradient>
											<path style="fill:url(#SVGID_5_);" d="M21.5,410.067c3.519,22.257,22.786,39.277,46.032,37.172h376.926  c23.247,2.105,42.513-14.915,46.032-37.172H21.5z"/>
											<linearGradient id="SVGID_6_" gradientUnits="userSpaceOnUse" x1="433.6726" y1="215.738" x2="356.0627" y2="293.348" gradientTransform="matrix(1.0667 0 0 -1.0667 3.267 557.5334)">
												<stop offset="0" style="stop-color:#FFC200;stop-opacity:0"/>
												<stop offset="0.203" style="stop-color:#FFBB00;stop-opacity:0.203"/>
												<stop offset="0.499" style="stop-color:#FFA700;stop-opacity:0.499"/>
												<stop offset="0.852" style="stop-color:#FF8800;stop-opacity:0.852"/>
												<stop offset="1" style="stop-color:#FF7800"/>
											</linearGradient>
											<path style="fill:url(#SVGID_6_);" d="M417.478,252.114v53.852l-71.708-71.708l0.261-0.015c3.686-0.203,7.289,0.953,10.276,3.122  c13.62,9.888,30.373,15.717,48.49,15.717C409.118,253.083,413.34,252.746,417.478,252.114z"/>
											<linearGradient id="SVGID_7_" gradientUnits="userSpaceOnUse" x1="342.7278" y1="443.2198" x2="409.7978" y2="283.4499" gradientTransform="matrix(1.0667 0 0 -1.0667 3.267 557.5334)">
												<stop offset="0" style="stop-color:#D63305"/>
												<stop offset="0.366" style="stop-color:#CF3004"/>
												<stop offset="0.899" style="stop-color:#BC2602"/>
												<stop offset="1" style="stop-color:#B72401"/>
											</linearGradient>
											<circle style="fill:url(#SVGID_7_);" cx="404.805" cy="170.432" r="86.272"/>
											<path style="fill:#FFFFFF;" d="M385.346,135.879c0-2.798,1.13-5.006,3.391-6.62l16.793-16.146c1.183-1.183,2.637-1.776,4.359-1.776  c1.938,0,3.685,0.512,5.248,1.534c1.559,1.024,2.341,2.397,2.341,4.117v106.891c0,1.723-0.863,3.095-2.583,4.117  c-1.723,1.024-3.714,1.534-5.974,1.534c-2.369,0-4.387-0.51-6.055-1.534c-1.67-1.022-2.502-2.395-2.502-4.117v-89.775l-5.651,7.105  c-1.077,1.077-2.26,1.614-3.552,1.614c-1.615,0-2.988-0.726-4.117-2.179C385.911,139.189,385.346,137.602,385.346,135.879z"/>
										</svg>
									</div>

									از طریق این قسمت میتوانید مشخصات فردی خود را (مدیر رستوران) ببینید. اطلاعات قابلیت
									ویرایش ندارند
								</p>
							</div>
                        </div>
                    </div>
            </div>
        </div>

        <!-- /restaurant panel -->
        <div class="panel_bar" id="restaurant_info_panel">
            <!-- page-title -->
            <div class="title-bar">
                <button class="panel_menu_btn"><i class="fa fa-bars"></i></button>
                <h1 class="page-title provider-title"><i class="fas fa-utensils"></i>&nbsp; اطلاعات رستوران</h1>
                <div class="dropholder pull-left">
                    <p>سلام، <?php echo $managerName; ?></p>
                </div>
            </div>

            <!-- main content -->
            <div class="main-content fadeIn">
                <!-- internal tabs -->
                <div class="panel_main_tabs">
                    <button class="tabs" id="add_menu_tab">منو</button>
                    <button class="tabs active" id="restaurant_inform_tab">اطلاعات رستوران</button>
                </div>

                <!-- rastaurant basic info form -->
                <form method="post" action="vardump.php" class="internal_tab_form fadeIn active" id="restaurant_info_form">
                    <div class="">
                        <div class="two-col">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h4 class="panel_internal_title tomato">نام <?php echo $naam ?></h4>
                                    <div class="pull-right input_icon"><i class="fas fa-utensils"></i></div>
                                    <input class="iconed_input" type="text" value="<?php echo $providerName; ?>" <?php echo $dis; ?>/>
                                </div>
                                <div class="col-sm-6">
                                    <h4 class="panel_internal_title tomato">نوع <?php echo $noo ?></h4>
                                    <div class="pull-right input_icon"><i class="fas fa-utensil-spoon"></i></div>
                                    <select class="iconed_input" <?php echo $dis; ?>>
                                        <option selected><?php echo $noo2; ?></option>
                                    </select>
                                </div>
                            </div>

                            <div class="row no-margin">
                                <h4 class="panel_internal_title tomato">نوع سفارش</h4>
                                <div class="pull-right input_icon"><i class="fas fa-utensil-spoon"></i></div>
                                <select class="iconed_input" <?php echo $dis; ?>>
                                    <option selected>غذای ایرانی</option>
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <h4 class="panel_internal_title tomato">شماره تلفن</h4>
                                    <div class="pull-right input_icon"><i class="fas fa-phone"></i></div>
                                    <input class="iconed_input" type="text" value="<?php echo $prvPhone; ?>" <?php echo $dis; ?>/>
                                </div>
                                <div class="col-sm-6">
                                    <h4 class="panel_internal_title tomato">کد پستی</h4>
                                    <div class="pull-right input_icon"><i class="fas fa-envelope-open"></i></div>
                                    <input class="iconed_input" type="text" value="<?php echo $postalCode; ?>" <?php echo $dis; ?>/>
                                </div>
                            </div>
                            <h4 class="panel_internal_title tomato">آدرس</h4>
                            <div class="pull-right input_icon"><i class="fas fa-map-marker-alt"></i></div>
                            <input class="iconed_input" type="text" value="<?php echo $address; ?>" <?php echo $dis; ?>/>

                            <h4 class="panel_internal_title tomato">شعار رستوران شما (در حد یک جمله)</h4>
                            <div class="pull-right input_icon"><i class="fas fa-question"></i></div>
                            <input class="iconed_input" type="text" value="<?php echo $row['motto'] ?>" <?php echo $dis; ?>/>

                            <div class="row no-margin">
                                <h4 class="panel_internal_title tomato">ساعت کاری</h4>
                                <h4 class="panel_internal_title">شیفت صبح</h4>
                                <div class="col-sm-6">
                                    <label class="input-top-label">از</label>
                                    <div class="pull-right input_icon"><i class="far fa-clock"></i></div>
                                    <input name="morningFrom" value="<?php echo $morningFrom; ?>" class="iconed_input"  value="از" <?php echo $dis; ?>/>
                                </div>
                                <div class="col-sm-6">
                                    <label class="input-top-label">الی</label>
                                    <div class="pull-right input_icon"><i class="far fa-clock"></i></div>
                                    <input value="<?php echo $morningTo; ?>" name="morningTo" class="iconed_input" value="الی" <?php echo $dis; ?>/>
                                </div>
                            </div>
                            <div class="row no-margin">
                                <h4 class="panel_internal_title">شیفت عصر</h4>
                                <div class="col-sm-6">
                                    <label class="input-top-label">از</label>
                                    <div class="pull-right input_icon"><i class="far fa-clock"></i></div>
                                    <input value="<?php echo $eveningFrom; ?>" name="eveningFrom" class="iconed_input"  value="از" <?php echo $dis; ?>/>
                                </div>
                                <div class="col-sm-6">
                                    <label class="input-top-label">الی</label>
                                    <div class="pull-right input_icon"><i class="far fa-clock"></i></div>
                                    <input value="<?php echo $eveningTo; ?>" name="eveningTo" class="iconed_input"  value="الی" <?php echo $dis; ?>/>
                                </div>
                            </div>
                            <div class="row no-margin">
                                <h4 class="panel_internal_title">نیمه شب</h4>
                                <div class="col-sm-6">
                                    <label class="input-top-label">از</label>
                                    <div class="pull-right input_icon"><i class="far fa-clock"></i></div>
                                    <input value="<?php echo $midnightFrom; ?>" name="midnightFrom" class="iconed_input"  value="از" <?php echo $dis; ?>/>
                                </div>
                                <div class="col-sm-6">
                                    <label class="input-top-label">الی</label>
                                    <div class="pull-right input_icon"><i class="far fa-clock"></i></div>
                                    <input value="<?php echo $midnightTo; ?>" name="midnightTo" class="iconed_input" value="الی" <?php echo $dis; ?>/>
                                </div>
                            </div>
                            <div class="row no-margin">
                                <h4 class="panel_internal_title tomato">مدت زمان تحویل سفارش</h4>
                                <div class="col-sm-6">
                                    <label class="input-top-label">حداقل(دقیقه)</label>
                                    <div class="pull-right input_icon"><i class="fas fa-long-arrow-alt-down"></i></div>
                                    <input class="iconed_input" onblur="if(this.value.length<2) alert('عدد باید ۲ کاراکتر یا بیشتر باشد.')" value="<?php echo $minDelTime ?>" type="number" name="minDelTime" placeholder="حداقل(دقیقه)" <?php echo $dis; ?>/>
                                </div>
                                <div class="col-sm-6">
                                    <label class="input-top-label">حداکثر(دقیقه)</label>
                                    <div class="pull-right input_icon"><i class="fas fa-long-arrow-alt-up"></i></div>
                                    <input class="iconed_input" onblur="if(this.value.length<2) alert('عدد باید ۲ کاراکتر یا بیشتر باشد.')" type="number" value="<?php echo $maxDelTime ?>" name="maxDelTime" placeholder="حداکثر(دقیقه)" <?php echo $dis; ?>/>
                                </div>
                            </div>
                            <label class="tomato input-top-label" >حداقل سفارش</label>
                            <div class="pull-right input_icon"><i class="fas fa-dollar-sign"></i></div>
                            <input id="min-basket-value" class="" type="" value="۷۰۰۰ تومان" <?php echo $dis; ?>/>
							
							<div class="text-center">
								<input class="fooderz_btn single_submit" type="submit" name="subm" value="ذخیره تغییرات">
							</div>

                        </div>
                        <div class="two-col map-container">
							<!-- map -->
							<div id="map"></div>
                            <input type="text" name="prv_ID" value="<?php echo $prv_ID; ?>" hidden />
                        </div>
                    </div>
                    
                </form>

                <!-- menu addition form -->
                <form method="post" enctype="multipart/form-data" action="vardump.php" class="internal_tab_form fadeIn active" id="add_menu_form">
                    <div class="menu-box" style="position:relative">
                        <img class="menu_head dashboard" src="../images/menu_head-min.jpg" alt="" />
                        <img class="menu_footer" src="../images/footer.jpg" alt="" />
                        <div class="restaurant_title">
                            <?php
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
    ?>
                            <div class="restaurant_logo"><img src="<?php echo $dhPath . $logoName ?>" alt="logo" /></div>
                            <img class="title_img" src="../images/menu_title_img.png" alt="" />
                            <h3 class="title"><?php echo $providerName ?></h3>
							<div class="ordering_activation">
								<h4 class="title">وضعیت سفارش گیری</h4>
								<label class="ordering_label" for="actived">
									فعال
									<input type="radio" class="ordering_radio" id="actived" name="ordering_issue" checked />
								</label>
								<label class="ordering_label" for="deactived">
									غیر فعال
									<input type="radio" class="ordering_radio" id="deactived" name="ordering_issue" />
								</label>
							</div>
                            <button type="button" id="add_category" class="add_category_btn"><i class="fas fa-plus-circle"></i> افزودن سرمنو</button>
						
                        </div>

                        <div class="row no-margin menu_row">
     <?php $id_num = 1;
    $j                 = 1;
    foreach ($giftRow as $k => $v)
    {
        // $j = foodCount($j);

        ?>
        <div class="each_cat_box fadeIn" id="box_num<?php echo $j ?>">
            <button class="fooderz_btn food-cat-close" type="button">
                ×
            </button>
            <input value="<?php echo $k ?>" class="food-input category_title width85_767" id="cat_food<?php echo $j ?>" name="cat_food<?php echo $j ?>" placeholder="نام سرمنو (مثلا کباب ها)" type="text">
                <button class="add_food_btn" type="button">
                    <svg aria-hidden="true" class="svg-inline--fa fa-plus-circle fa-w-16" data-fa-i2svg="" data-icon="plus-circle" data-prefix="fas" role="img" viewbox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                        <path d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm144 276c0 6.6-5.4 12-12 12h-92v92c0 6.6-5.4 12-12 12h-56c-6.6 0-12-5.4-12-12v-92h-92c-6.6 0-12-5.4-12-12v-56c0-6.6 5.4-12 12-12h92v-92c0-6.6 5.4-12 12-12h56c6.6 0 12 5.4 12 12v92h92c6.6 0 12 5.4 12 12v56z" fill="currentColor">
                        </path>
                    </svg>
                    <!-- <i class="fas fa-plus-circle"></i> -->
                    افزودن غذا
                </button>
                <?php
$j++;
        foreach ($v as $k1 => $v1)
        {
            // $id_num = foodCount($i);

            $name   = str_replace(' ', '_', $k1);
            $bgPath = "/Fooderz/images/foodPics/";
            $bgImg  = $bgPath . md5($prv_ID . 'khardal') . '/' . $name . '.jpg';
            $bgImg  = (file_exists($_SERVER['DOCUMENT_ROOT'] . $bgImg)) ? "style='background-image: url($bgImg);'" : '';

            ?>
                <div class="food-box fadeIn" id="food<?php echo $id_num ?>" name="food<?php echo $id_num ?>">
                    <button class="fooderz_btn food-close" type="button">
                        ×
                    </button>
                    <div class="row">
                        <div class="col-sm-4 img-box">
                            <div <?php echo $bgImg; ?> class="image js--image-preview" id="upload<?php echo $id_num ?>">
                                <img alt="" class="food_img_uploaded" id="img<?php echo $id_num ?>" src="">
                                    <label class="upload" for="upload-photo">
                                        آپلود تصویر
                                    </label>
                                    <input accept="image/*" class="upload_btn image-upload" id="upload<?php echo $id_num ?>" name="upload<?php echo $id_num ?>" placeholder="آپلود تصویر" type="file"/>
                                </img>
                            </div>
                        </div>
                        <div class="col-sm-8 details">
                            <input value="<?php echo $k1 ?>" class="food-input food-name" name="ffood<?php echo $id_num ?>" placeholder="نام غذا" type="text">
                                <input value="<?php echo @$v1['description'] ?>" class="food-input desc" name="tfood<?php echo $id_num ?>" placeholder="توضیحات کوتاه" type="text">
                                    <input value="<?php echo $v1['price'] ?>" class="food-input food-price" name="gfood<?php echo $id_num ?>" placeholder="قیمت" type="text"/>
                                </input>
                            </input>
                        </div>
                    </div>
                </div>
            <?php
$id_num++;
        }?>
            </input>
        </div>
    </br>
    <?php }?>
                        </div>
                        <input type="text" name="prv_ID" value="<?php echo $prv_ID; ?>" hidden />
                        <input hidden type="text" name="providerName" value="<?php echo $providerName ?>" id="">
                        <input type="text" name="json" id="json" hidden>
                        <div class="text-center food_menu_submit">
                            <br /><br />
                            <div class="text-center validate-error fadeIn">
                                <i class="fa fa-times error-icon"></i>
                                خطا! لطفا تمامی فیلدهای قیمت ، نام و نام سرمنو برای منوهای انتخابی را وارد نمایید.
                            </div>
                            <input type="button" id="menu-submit" class="fooderz_btn single_submit" name="sub" value="ذخیره منو" >
                        </div>
                    </div>

                </form>
            </div>
        </div>


        <!-- peyk -->
        <div class="panel_bar" id="peyk_panel">
            <!-- page-title -->
            <div class="title-bar">
                <button class="panel_menu_btn"><i class="fa fa-bars"></i></button>
                <h1 class="page-title provider-title"><i class="fas fa-utensils"></i>&nbsp; اطلاعات رستوران</h1>
                <div class="dropholder pull-left">
                    <p>سلام، <?php echo $managerName; ?></p>
                </div>
            </div>

            <div class="text-center">
                <img class="hero-img" src="../images/peyk.gif" alt="fooderz peyk" />
                <p class="hero-text text-center">به زودی ...</p>
            </div>
        </div>

        <!-- gifts and discounts panel -->
        <div class="panel_bar" id="gift_panel">
            <!-- page-title -->
            <div class="title-bar">
                <button class="panel_menu_btn"><i class="fa fa-bars"></i></button>
                <h1 class="page-title provider-title"><i class="fas fa-gift"></i>&nbsp;تخفیف ها و هدایا</h1>
                <div class="dropholder pull-left">
                    <p>سلام، <?php echo $managerName; ?></p>
                </div>
            </div>

            <!-- main content -->
            <div class="main-content fadeIn">
                <div class="row no-margin">
                    <div class="discount col-md-6">

                        <h4 class="panel_internal_title tomato text-center">میزان تخفیف رستوران شما</h4>
                        <p class="text-center">اگر مایل به قرار دادن تخفیف روی کلیه غذاهای خود به یک میزان ثابت هستید ، از طریق اسلایدر زیر درصد تخفیف خود را انتخاب نمایید.</p>
                        <br />
                        <div id="discount-container">
                            <div class="dot-wrapper">
                                <div class="dot" style="left: <?php echo round($discount * 93 / 100) . "%" ?>">
                                    <div class="dot-label">
                                        <span id="dot-percentage" class="dot-percentage"><?php echo $discount; ?>%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br />
                        <div class="text-center">
                            <p id="percent-success-txt" class="text-success animated fadeInDown">
                               تغییرات با موفقیت ذخیره شد
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="25px" height="25px" viewBox="0 0 426.667 426.667" style="position: relative;top: 9px;right: 5px;">
                                    <path style="fill:#6AC259;" d="M213.333,0C95.518,0,0,95.514,0,213.333s95.518,213.333,213.333,213.333  c117.828,0,213.333-95.514,213.333-213.333S331.157,0,213.333,0z M174.199,322.918l-93.935-93.931l31.309-31.309l62.626,62.622  l140.894-140.898l31.309,31.309L174.199,322.918z"/>
                                </svg>
                            </p>
                            <button id="sendDiscount" class="fooderz_btn animated fadeIn">ذخیره تغییرات</button>
                        </div>
                    </div>

                    <div class="col-md-6 eshantion-section">
                        <h4 class="panel_internal_title tomato text-center">انتخاب اشانتیون</h4>
                        <p class="text-center">در صورت تمایل به ارائه اشانتیون روی سفارش به مشتریان میتوانید با کلیک روی دکمه زیر از منوی خود اشانتیون را انتخاب کنید.</p>
                        <div class="text-center">
                            <br /> <br />
                            <button class="fooderz_btn" data-toggle="modal" data-target="#eshantion">انتخاب اشانتیون</button>
                        </div>
                        <br />
                        <hr />
                        <h4 class="panel_internal_title">اشانتیون های رستوران شما :</h4>
                        <ul id="showGift" class="your-eshantions">
                            <?php
if (isset($gifted))
    {
        foreach ($gifted as $value)
        {
            echo "<li>$value</li>";
        }
    }
    ?>

                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <!-- financial report panel -->
        <div class="panel_bar" id="report_panel">
            <!-- page-title -->
            <div class="title-bar">
                <button class="panel_menu_btn"><i class="fa fa-bars"></i></button>
                <h1 class="page-title provider-title"><i class="fas fa-list-alt"></i>&nbsp; گزارش مالی</h1>
                <div class="dropholder pull-left">
                    <p>سلام، <?php echo $managerName; ?></p>
                </div>
            </div>

            <!-- main content -->
            <div class="main-content  fadeIn">

                <div class="row no-margin">
                    <div class="date">
                        <div class="row no-margin text-center">
                            <br />
                            <h4 class="tomato">تاریخ شروع و پایان تراکنش های مالی</h4>
                            <br />
                            <div class="col-md-6">
                                <div class="start-date text-center">
                                    <input type="text" id="start-date" placeholder="تاریخ شروع" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="end-date text-center">
                                    <input type="text" id="end-date" placeholder="تاریخ پایان" />
                                </div>
                            </div>
                        </div>
                        <hr />
                    </div>

                    <!-- chart-->
                    <div id="report-chart" class="text-center"></div>

                    <hr />
                    <div class="text-center">
                     <div class="circle-rate">۱۲۰۰۰۰۰۰ تومان</div>
                    </div>
                    <div id="order_list_ajax" class="col-md-6 text-center report-table-container right">

                    </div>
                    <div class="col-md-6 text-center report-table-container">
                        <h4 class="main-title">لیست برداشت از حساب</h4>
                        <table class="report-table">
                            <tr>
                                <th>شماره تراکنش</th>
                                <th>مبلغ</th>
                                <th>تاریخ و ساعت</th>
                            </tr>
                            <tr>
                                <td>۱۲۱۳۱</td>
                                <th>۱۴۰۰۰</th>
                                <th>۲/۵/۹۷</th>
                            </tr>
                            <tr>
                                <td>۱۲۱۳۱</td>
                                <th>۱۴۰۰۰</th>
                                <th>۲/۵/۹۷</th>
                            </tr>
                            <tr>
                                <td>۱۲۱۳۱</td>
                                <th>۱۴۰۰۰</th>
                                <th>۲/۵/۹۷</th>
                            </tr>
                            <tr>
                                <td>۱۲۱۳۱</td>
                                <th>۱۴۰۰۰</th>
                                <th>۲/۵/۹۷</th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- hidden factor for restaurant printing -->

<!--         <div class="factor" id="factor" style="border: solid 1px #000;padding: 20px;text-align: right;display: none">
            <div style="margin-bottom: 30px;text-align: center">
                <img src="../images/logo.png" alt="Fooderz" width="50px" style="position:relative; right:30px" />
                <h3 style="float: right">رستوران عطاویچ</h3>
                <p style="float: left">شماره تماس : ۰۷۱۳۵۶۷۸۹۶۴</p>
            </div>
            <h5 style="text-align: center">فاکتور شماره ۱۱۳۶</h5>
            <table style="width: 100%;border: dashed 1px #aaa;text-align: right;direction: rtl;border-bottom: none">
                <tr style="text-align: center;border-bottom: solid .5px #aaa">
                    <th style="padding: 10px;border-bottom: solid 1px #aaa">ردیف</th>
                    <th style="padding: 10px;border-bottom: solid 1px #aaa">نام سفارش</th>
                    <th style="padding: 10px;border-bottom: solid 1px #aaa">تعداد</th>
                    <th style="padding: 10px;border-bottom: solid 1px #aaa">قیمت واحد (تومان)</th>
                </tr>

                <?php 
                 ?>
                <tr style="text-align: center;border-bottom: dashed 1px #aaa">
                    <td style="padding: 10px;border-bottom: dashed 1px #aaa">۱</td>
                    <td style="padding: 10px;border-bottom: dashed 1px #aaa">پیتزا دونفره بزرگ</td>
                    <td style="padding: 10px;border-bottom: dashed 1px #aaa">۱</td>
                    <td style="padding: 10px;border-bottom: dashed 1px #aaa">۲۲۰۰۰</td>
                </tr>

                <tr style="text-align: center;border-bottom: dashed 1px #aaa">
                    <td style="padding: 10px;border-bottom: dashed 1px #aaa">۲</td>
                    <td style="padding: 10px;border-bottom: dashed 1px #aaa">چیز برگر</td>
                    <td style="padding: 10px;border-bottom: dashed 1px #aaa">۱</td>
                    <td style="padding: 10px;border-bottom: dashed 1px #aaa">۱۰۰۰۰</td>
                </tr>

                <tr style="text-align: center;border-bottom: dashed 1px #aaa">
                    <td style="padding: 10px;border-bottom: dashed 1px #aaa">۳</td>
                    <td style="padding: 10px;border-bottom: dashed 1px #aaa">سیب زمینی خانواده</td>
                    <td style="padding: 10px;border-bottom: dashed 1px #aaa">۱</td>
                    <td style="padding: 10px;border-bottom: dashed 1px #aaa">۸۰۰۰</td>
                </tr>

            </table>

            <h5 style="text-align: center;">مشخصات مشتری</h5>
            <table style="width: 100%;border: dashed 1px #aaa;text-align: right;direction: rtl;border-bottom: none !important;">
                <tr style="text-align: center;border-bottom: solid .5px #aaa">
                    <th style="padding: 10px;border-bottom: solid 1px #aaa">نام</th>
                    <th style="padding: 10px;border-bottom: solid 1px #aaa">شماره تماس</th>
                    <th style="padding: 10px;border-bottom: solid 1px #aaa">آدرس</th>
                    <th style="padding: 10px;border-bottom: solid 1px #aaa">توضیحات</th>
                </tr>
                <tr style="text-align: center">
                    <td style="padding: 10px"><?php echo $managerName; ?></td>
                    <td style="padding: 10px">۰۹۱۷۸۱۵۹۹۸۱</td>
                    <td style="padding: 10px">شیراز خیابان عفیف آباد نبش کوچه چهارم . بن بست آخر پلاک ۲۰۰</td>
                    <td style="padding: 10px">توضیحات طولانی توضیحات طولانی توضیحات طولانی توضیحات طولانی توضیحات طولانی توضیحات طولانی</td>
                </tr>
            </table>

            <div style="border-top: dashed 1px #000;padding-top: 30px;text-align: center">
                <p style="float: right"><strong>نوع تسویه : </strong> نقدی</p>
                <p style="float: left"><strong>نام پیک : </strong> <?php echo $managerName; ?></p>
                <h3>جمع کل فاکتور : ۵۸۰۰۰ تومان</h3>
            </div>
            <hr />
            <div style="padding-top: 30px;text-align: center;height: 60px">
                <p style="float: right"><strong>کل سود شما از این فاکتور :  </strong> ۴۹۰۰۰ تومان</p>
                <p style="float: left;"><strong>Fooderz</strong></p>
            </div>
        </div>
 -->        <!-- /hidden factor for restaurant printing -->


    </div>

</div>


<!-- modals -->
<!-- financial panel more options modal -->
<div class="modal fade" id="more_details" tabindex="-1" role="dialog" aria-hidden="true">

</div>
<!-- select eshantion modal -->
<div class="modal fade" id="eshantion" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="pull-left">انتخاب اشانتیون</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="بستن">
                    <span aria-hidden="true">&times;</span>
                </button>
                <br />
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="text" hidden name="prv_ID" id="prv_ID" value="<?php echo $prv_ID ?>">
                    <?php
$i = 0;
    foreach ($giftRow as $k => $value)
    {

        ?>
                    <div class="eshantion-category">
                        <h4 class="panel_internal_title tomato text-center"><?php echo $k ?></h4>
                        <?php foreach ($value as $k1 => $v1)
        {

            ?>
                        <label class="checkbox-container"><i class="fa fa-gift icon tomato"></i><?php echo $k1 ?>
                            <input type="checkbox" <?php if (in_array($k1, $gifted))
            {
                echo 'checked';
            }
            ?> class="giftCheck" name="id<?php echo $i ?>" value="<?php echo $k1 ?>">
                            <span class="checkmark"></span>
                        </label>
                    <?php $i++;}?>
                    </div>
                <?php }?>
                </div>
            </div>
            <div class="modal-footer">
                <button id="sendGift" type="button" class="btn btn-primary" data-dismiss="modal" aria-label="انتخاب">
                    <span aria-hidden="true">انتخاب</span>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- new order popup -->
<div class="popup_back_layer animated fadeIn">
	<div class="popup text-center notif_popup">
		<h2 class="title tomato">شما سفارش جدیدی دریافت کرده اید!</h2>
		<hr />
		<h4 class="text">برای رسیدگی به وضعیت سفارش <a href="#" class="link" id="see_new_order">اینجا</a> کلیک کنید</h4>
		<br />
		<h5>تعداد سفارش های بررسی نشده: <span class="tomato">2</span> عدد</h5>
		<div class="notif">1</div>
		<div class="close">&times;</div>
	</div>
</div>
<!-- /modals -->
<script src="../js/plugins.min.js"></script>
<script src="js/provider_info.js"></script>
<script>

    // $("#exit").click(function(){
        // 
    // });
    
    $('#sendDiscount').click(function(){
       $.post('provider_info_ajax.php',
            {
                percent: $('#dot-percentage').html(),
                prv_ID: <?php echo $prv_ID ?>
            },
        function(ex,st){
            if (st=='success')
            {
                // $('#showGift').html('ksdjhf');
            }

        })
    });


    $('#sendGift').click(function(){
        $.post('provider_info_ajax.php',

           $("#prv_ID, .giftCheck").serialize(),

        function(ex){
            // let a = JSON.parse(ex);
            // $(a).each(function(k,v){
            //   $('#showGift').append('<li>'+v+'</li>');
            // })
            $('#showGift').html(ex);

        })
    });



    $(document).ready(function(){
        var cat_count = 500;
        var food_count = 500;
        cat_count = foodCount(cat_count);

        $('.menu-box .category_title').prepend("<i class='fas fa-utensils'></i>");

        $('#add_category').click(function(){
            var cat_id = "cat_food";
            var cat_id = cat_id+cat_count;


            var box_id = "box_num"
            var box_id = box_id+cat_count;


            $('.menu_row').append("<br style='clear:both;' /><div class='each_cat_box fadeIn' id='"+box_id+"'>"
                +"<button type='button' class='fooderz_btn food-cat-close'>&times;</button>"
                +"<input type='text' id='"+cat_id+"' name='"+cat_id+"' class='food-input category_title width85_767' placeholder='نام سرمنو (مثلا کباب ها)' />"
                +"<button type='button' class='add_food_btn'><i class='fas fa-plus-circle'></i> افزودن غذا</button>"
                +"</div>"
            );

            cat_count++;



        });

        $(document).on("click", ".add_food_btn", function(){

            food_count = foodCount(food_count);
            // console.log(food_count);

            var food_id = "food";
            var food_id = food_id+food_count;

            var img_id = "img";
            var img_id = img_id+food_count;

            var upload_id = "upload";
            var upload_id = upload_id+food_count;

            var upload_img_id = "upload";
            var upload_img_id = upload_img_id+food_count;

            var parent = $(this).parent()[0].id;
            var parent_id = "#"+parent;

// var a = document.getElementByClassName('.each_cat_box');
 // a = a[0];
// a = a..getElementByClassName('.each_cat_box');

            // var arr = [];
            // $(""+ parent_id +"").child();
            // console.log($(""+ parent_id +"").child());

                $(""+ parent_id +"").append("<div id='"+food_id+"' name='"+food_id+"' class='food-box fadeIn'>"
                    +"<button type='button' class='fooderz_btn food-close'>&times;</button>"
                    +"<div class='row'>"
                    +"<div class='col-sm-4 img-box'>"
                    +"<div class='image js--image-preview' id='"+upload_img_id+"'>"
                    +"<img id='"+img_id+"'  class='food_img_uploaded' src='' alt='' />"
                    +"<label class='upload' for='upload-photo'>آپلود تصویر</label>"
                    +"<input name='"+upload_id+"' type='file' class='upload_btn image-upload' id='"+upload_id+"' placeholder='آپلود تصویر' accept=\'image/*\' >"
                    +"</div>"
                    +"</div>"
                    +"<div class='col-sm-8 details'>"
                    +"<input type='text' name='f"+food_id+"'  class='food-input food-name' placeholder='نام غذا' />"
                    +"<input type='text' name='t"+food_id+"'  class='food-input desc' placeholder='توضیحات کوتاه' />"
                    +"<input type='text' name='g"+food_id+"' class='food-input food-price' placeholder='قیمت' />"
                    +"</div>"
                    +"</div>"
                    +"</div>"
                );

            food_count++;
        });

        $(document).on("click", ".food-close", function () {
           var this_parent = $(this).parent()[0].id;
            $("#"+this_parent+"").remove();
        });

        $(document).on("click", ".food-cat-close", function () {
            var this_parent = $(this).parent()[0].id;
            $("#"+this_parent+"").remove();
        });

        // datepicker of financial report panel
        $("#start-date, #end-date").persianDatepicker();







        function foodCount(fc)
            {
                zero_num = (4 - fc.toString().length);
                for (var i = 0; i < zero_num; i++)
                {
                    fc = "0"+fc;
                }
                return fc;
            }



        function printData()
        {
            var divToPrint = document.getElementById("factor");
            divToPrint.style.display="block";
            newWin= window.open("");
            newWin.document.write(divToPrint.outerHTML);
            newWin.print();
            newWin.close();
            divToPrint.style.display="none";
        }

        $('.print').on('click',function(){
            printData();
        })




        // discount selection for restaurant
        var $dot         = $('.dot'),
            $dotWrap     = $('.dot-wrapper'),
            $dotLabel    = $('.dot-label'),
            $spanPercent = $('span.dot-percentage');

        /**
         Convert passed in percentage to pixels
         */
        function convertPercentToPixel($elem, $elemParent, percentage, inside) {
            var width = $elemParent.width() - (inside ? $elem.width() : 0);
            return width * (percentage/100);
        };

        /**
         Convert pixels to pecentage value
         */
        function convertPixelToPercent($elem, $elemParent, pixels, inside) {
            var width = $elemParent.width() - (inside ? $elem.width() : 0);
            return (pixels / width) * 100;
        };


        Draggable.create($dot, {
            type: 'left',
            bounds: $dotWrap,

            onDrag: function() {
                var percent = convertPixelToPercent($dot, $dotWrap, parseFloat($dot.css('left')), true);
                $spanPercent.text(Math.round(percent) + '%');
                $('#percent-success-txt').css('display','none')
                $('#sendDiscount').css('display','-webkit-inline-box');
            },

            onPress: function() {
                $dot.css('left', convertPercentToPixel($dot, $dotWrap, this.percent, false));
                this.update();
            },

            onDragStart: function() {
                $dotLabel.addClass('moving');
            },

            onDragEnd: function() {
                $dotLabel.removeClass('moving');
                this.percent = convertPixelToPercent($dot, $dotWrap, this.x, false);
                $dot.css('left', this.percent + '%');
            }
        });

        //Set the initial position of the text
        // var initLeftPx = convertPercentToPixel($dot, $dotWrap, parseInt($spanPercent.text()), true);
        // TweenMax.set($dot, { left: initLeftPx });

        $('.your-eshantions li').prepend("<svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"20px\" height=\"20px\" viewBox=\"0 0 612.005 612.005\" style='position:relative;top:3px;margin-left:7px'>\n" +
            "\t\t\t<path d=\"M595.601,81.553c-21.892-21.891-57.362-21.891-79.253,0L183.03,414.87l-88.629-76.133     c-21.592-21.593-56.596-21.593-78.207,0c-21.592,21.592-21.592,56.614,0,78.206l132.412,113.733     c21.592,21.593,56.596,21.593,78.207,0c2.167-2.166,3.979-4.576,5.716-6.985c0.317-0.299,0.672-0.505,0.99-0.804l362.083-362.101     C617.473,138.914,617.473,103.425,595.601,81.553z\" fill=\"#91DC5A\"/>\n" +
            "</svg>")


        var tl = new TimelineMax();
        tl
            .fromTo('.bell_svg', .1, {rotation:0},{rotation: 20})
            .fromTo('.bell_svg', .1, {rotation:20},{rotation: -20})
            .fromTo('.bell_svg', .1, {rotation:-20},{rotation: 0})
            .fromTo('.bell_svg', .1, {rotation:0},{rotation: 20})
            .fromTo('.bell_svg', .1, {rotation:20},{rotation: -20})
            .fromTo('.bell_svg', .1, {rotation:-20},{rotation: 0})
            .fromTo('.bell_svg', .1, {rotation:0},{rotation: 20})
            .fromTo('.bell_svg', .1, {rotation:20},{rotation: -20})
            .fromTo('.bell_svg', .1, {rotation:-20},{rotation: 0})
            .fromTo('.bell_svg', .1, {rotation:0},{rotation: 20})
            .fromTo('.bell_svg', .1, {rotation:20},{rotation: -20})
            .fromTo('.bell_svg', .1, {rotation:-20},{rotation: 0})
            .fromTo('.bell_svg', .1, {rotation:0},{rotation: 20})
            .fromTo('.bell_svg', .1, {rotation:20},{rotation: -20})
            .fromTo('.bell_svg', .1, {rotation:-20},{rotation: 0})
            .fromTo('.bell_svg', .1, {rotation:0},{rotation: 20})
            .fromTo('.bell_svg', .1, {rotation:20},{rotation: -20})
            .fromTo('.bell_svg', .1, {rotation:-20},{rotation: 0})
            .fromTo('.bell_svg', .1, {rotation:0},{rotation: 20})
            .fromTo('.bell_svg', .1, {rotation:20},{rotation: -20})
            .fromTo('.bell_svg', .1, {rotation:-20},{rotation: 0})

        $('#menu-submit').click(function () {
            var food_names = $('.food-input.food-name').val();
            var food_prices = $('.food-input.food-price').val();
            var food_cats = $('.food-input.category_title').val();
            if(food_names=="" || food_prices=="" || food_cats==""){
                $('.validate-error').css('display','block');
            }else {
                // var a = document.querySelector('.each_cat_box');
                // var obj = JSON.stringify(JsonML.fromHTML(a));
                // $('#json').html(obj);
                var x = document.getElementsByClassName("each_cat_box");
                // var b = a.value;

                let myJson = {};
                for(var i=0; i<x.length; i++)
                {
                    pDiv = x[i];
                    sarMenu = pDiv.getElementsByClassName('food-input category_title width85_767')[0].value;
                    myJson[sarMenu] = {};
                    var divFoodNum = pDiv.getElementsByClassName("food-name").length;
                    for(var j=0; j<divFoodNum; j++)
                    {
                        myFoodName = pDiv.getElementsByClassName("food-name")[j].value;
                        myJson[sarMenu][myFoodName]= {};
                        myJson[sarMenu][myFoodName]['price'] = pDiv.getElementsByClassName('food-price')[j].value;
                        myJson[sarMenu][myFoodName]['description'] = pDiv.getElementsByClassName('desc')[j].value;
                        pDiv.getElementsByClassName('image-upload')[j].setAttribute('name',myFoodName);

                    }
                }
                var myJson2 = JSON.stringify(myJson);
                arr = ['lasdkj','sldkfj','jslakdj'];
                console.log(arr);
                console.log(myJson2);
                document.getElementById('json').value = myJson2;
                $('.validate-error').css('display','none');
                $('#menu-submit').prop("type","submit")
            }
        });
        var btn1 = $('.image-upload');
        var img1 = $('.food_img_uploaded')

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var c = input
                    var vv = c.id;
                    $("#"+vv+"").css('background-image', 'url('+e.target.result +')');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $(document).on("change", ".image-upload" ,function() {
            var btn1id = $(this)[0].id;
            var aa = $(this).parent()[0].id;
            readURL(this);
        });

        $('#sendDiscount').click(function () {
            $(this).css('display','none');
            $('#percent-success-txt').css('display','block')
        })

    });

    var chart = c3.generate({
    bindto: '#report-chart',
    data: {
      columns: [
        ['آمار فروش ماهیانه', 1200, 1500, 2000, 3000, 2000, 500, 3000, 1000, 3000, 4000],
      ],
      types: {
        'آمار فروش ماهیانه': 'area-spline'
      },
      axis: {
       x: {
       type: 'category',
       categories: [12/3, 13,3, 14/3, 15/3, 16/3, 17/3, 18/3, 19/3, 20/3, 21/3, 22/3],
       },
      },
    }
});
</script>
</body>
</html>
    <?php
}
else
{
    // header("location: ../../FooderzAdmin/Providers/ProviderConfirm.php");
        header("location: ../restaurant_login.php");
}
function foodCount($fc)
{
    $zero_num = (4 - strlen($fc));
    for ($i = 0; $i < $zero_num; $i++)
    {
        $fc = "0" . $fc;
    }
    return $fc;
}
?>