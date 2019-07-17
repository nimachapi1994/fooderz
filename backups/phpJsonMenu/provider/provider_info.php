<?php
session_start();
include $_SERVER["DOCUMENT_ROOT"] . "/Fooderz/funx.php";
if (isset($_POST['prvSub']))
{
    $dis = 'disabled';
    $prvPhone = $_POST['prvPhone'];
    $prvPass = $_POST['prvPass'];
    try
    {
//        echo $_POST['phoneSrch'];
        require_once '../../DataBase/PDO/DBconnect/DBconnect.php';
        $sql = "SELECT `prv_ID`, `providerName`, `telephone`, `managerName`, `mobile`, `email`, `address`, `latitude`, `longitude`, `country`, `state`, `city`, `regions`, `postalCode`, `provideType`, `resturantTpe`, `password`, `datenTime`, `bornDate`, `minimomOrder`, `weeklyWorkTIme`, `deliveryCost`, `URL`, `logoPath`, `natCardPath`, `contractPath`, `confirmByAdmin`, `reserve`, `sheba_number`, `motto`, `description`, `total_visitors`,
    `branch` FROM `provider` WHERE mobile=:mobile and password=:password";
        $stmt = $db->prepare($sql);
        $bindArr = array
            (
            ":mobile" => $prvPhone,
            ":password" => $prvPass,
        );
        $stmt->execute($bindArr);
        $row = $stmt->fetch();
        $errInfo = $stmt->errorInfo();

    }
    catch (Exception $e)
    {
        $err = $e->getMessage();
    }
    $managerName = $stmt->fetch()['managerName'];

}
elseif ((isset($_SESSION['rnd']) && isset($_GET['rnd']) && $_SESSION['rnd'] == $_GET['rnd'])) // true1 || 1
{
    $prv_ID = $_GET['prv_ID'];
    $dis = '';
    try
    {
//        echo $_POST['phoneSrch'];
        require_once '../../DataBase/PDO/DBconnect/DBconnect.php';
        $sql = "SELECT `prv_ID`, `providerName`, `telephone`, `managerName`, `mobile`, `email`, `address`, `latitude`,
 `longitude`, `country`, `state`, `city`, `regions`, `postalCode`, `provideType`, `resturantType`, `password`,
  `datenTime`, `bornDate`, `minimomOrder`, `weeklyWorkTIme`, `deliveryCost`, `URL`, `logoPath`,
   `natCardPath`, `contractPath`, `confirmByAdmin`, `reserve`, `sheba_number`, `motto`, `description`, `total_visitors`,
    `branch`, `discount`, `deliveryTime` FROM `provider` WHERE prv_ID=:prv_ID";
        $stmt = $db->prepare($sql);
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
        $sql = "SELECT  menu from provider where prv_ID=:prv_ID";
        $stmt = $db->prepare($sql);
        $bindArr = array
            (
            ":prv_ID" => $prv_ID,
        );
        $stmt->execute($bindArr);
        $giftRow = $stmt->fetch()['menu'];
        $errInfo = $stmt->errorInfo();
        $giftRow = json_decode($giftRow, true);
        $gifted = @$giftRow['parent']['gift'];
        $giftRow = $giftRow['parent']['menu'];

        $food_id = 0;
        foreach ($giftRow as $k => $value)
        {
            $food_id += count($value);
        }
        $cat_id = count($giftRow);
        $cat_id = ($cat_id)?$cat_id+1:1 ;
        $food_id = ($food_id)?$food_id+1:1 ;
        // die($c);
        // var_dump($row);

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
    $managerName = $row['managerName'];
    $providerName = $row['providerName'];
    $prvPhone = $row['telephone'];
    $prvMobile = $row['mobile'];
    $address = $row['address'];
    $provideType = $row['provideType'];
    $prvPhone = $row['telephone'];
    $postalCode = $row['postalCode'];
    $resturantType = $row['resturantType'];
    $discount = ($row['discount']) ? $row['discount'] : "0%";
    $delTime = $row['deliveryTime'];
    $delTime = json_decode($delTime, 1);
    $minDelTime = $delTime['min'];
    $maxDelTime = $delTime['max'];

    if ($provideType != 'رستوران')
    {
        $naam = $provideType;
        $noo = 'خدمات';
        $noo2 = $provideType;
    }
    else
    {
        $naam = 'رستوران';
        $noo = 'رستوران';
        $noo2 = $resturantType;
    }
    //weeklyWorkTIme Array
    $weeklyWorkTIme = $row['weeklyWorkTIme'];
    $weeklyWorkTIme = json_decode($weeklyWorkTIme, true);
    $morningFrom = $weeklyWorkTIme['morning']['From'];
    $morningTo = $weeklyWorkTIme['morning']['To'];
    $eveningFrom = $weeklyWorkTIme['evening']['From'];
    $eveningTo = $weeklyWorkTIme['evening']['To'];
    $midnightFrom = $weeklyWorkTIme['midnight']['From'];
    $midnightTo = $weeklyWorkTIme['midnight']['To'];
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
<div class="row no-margin all_content">
    <!-- side bar panel -->
    <div class="col-md-2 panel_sidebar">
        <!-- logo -->
        <div class="text-center">
            <img src="../images/logo.png" width="75px"/>
        </div>
        <nav>
            <ul>
                <li id="manager_info_tab" class="active"><a href="#"><i class="fas fa-user"></i>&nbsp; اطلاعات شخصی مدیر رستوران</a></li>
                <li id="restaurant_info_tab"><a href="#"><i class="fas fa-list-alt"></i>&nbsp; تنظیمات رستوران و منو</a></li>
                <li><a href="#"><i class="fas fa-motorcycle"></i>&nbsp; درخواست پیک موتوری</a></li>
                <li id="gift_tab"><a href="#"><i class="fas fa-gift"></i>&nbsp; تخفیف ها و هدایا</a></li>
                <li id="report_tab"><a href="#"><i class="fas fa-chart-pie"></i>&nbsp; گزارش مالی</a></li>
                <li><a href="#"><i class="fas fa-sign-out-alt"></i>&nbsp; خروج از پنل</a></li>
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

                        </div>
                        <div class="col-md-6 text-center desc">
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
                    <button class="tabs">پیک ها</button>
                </div>

                <!-- rastaurant basic info form -->
                <form method="post" action="vardump.php" class="internal_tab_form fadeIn active" id="restaurant_info_form">
                    <div class="row">
                        <div class="col-md-6">
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
                                    <input name="morningFrom" value="<?php echo $morningFrom; ?>" class="iconed_input" type="number" value="از" <?php echo $dis; ?>/>
                                </div>
                                <div class="col-sm-6">
                                    <label class="input-top-label">الی</label>
                                    <div class="pull-right input_icon"><i class="far fa-clock"></i></div>
                                    <input value="<?php echo $morningTo; ?>" name="morningTo" class="iconed_input" type="number" value="الی" <?php echo $dis; ?>/>
                                </div>
                            </div>
                            <div class="row no-margin">
                                <h4 class="panel_internal_title">شیفت عصر</h4>
                                <div class="col-sm-6">
                                    <label class="input-top-label">از</label>
                                    <div class="pull-right input_icon"><i class="far fa-clock"></i></div>
                                    <input value="<?php echo $eveningFrom; ?>" name="eveningFrom" class="iconed_input" type="number" value="از" <?php echo $dis; ?>/>
                                </div>
                                <div class="col-sm-6">
                                    <label class="input-top-label">الی</label>
                                    <div class="pull-right input_icon"><i class="far fa-clock"></i></div>
                                    <input value="<?php echo $eveningTo; ?>" name="eveningTo" class="iconed_input" type="number" value="الی" <?php echo $dis; ?>/>
                                </div>
                            </div>
                            <div class="row no-margin">
                                <h4 class="panel_internal_title">نیمه شب</h4>
                                <div class="col-sm-6">
                                    <label class="input-top-label">از</label>
                                    <div class="pull-right input_icon"><i class="far fa-clock"></i></div>
                                    <input value="<?php echo $midnightFrom; ?>" name="midnightFrom" class="iconed_input" type="number" value="از" <?php echo $dis; ?>/>
                                </div>
                                <div class="col-sm-6">
                                    <label class="input-top-label">الی</label>
                                    <div class="pull-right input_icon"><i class="far fa-clock"></i></div>
                                    <input value="<?php echo $midnightTo; ?>" name="midnightTo" class="iconed_input" type="number" value="الی" <?php echo $dis; ?>/>
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

                            <!-- map -->

                            <!-- /map -->
                        </div>
                        <div class="col-md-6 text-center desc">
                            <p>
                                اطلاعات رستوران شکا در این قسمت نشان داده میشنود.
                            </p>
                            <input type="text" name="prv_ID" value="<?php echo $prv_ID; ?>" hidden />
                        </div>
                    </div>
                            <input class="fooderz_btn" type="submit" name="subm" value="ذخیره تغییرات">

                </form>

                <!-- menu addition form -->
                <form method="post" enctype="multipart/form-data" action="vardump.php" class="internal_tab_form fadeIn active" id="add_menu_form">
                    <div class="menu-box" style="position:relative">
                        <img class="menu_head" src="../images/menu_head-min.jpg" alt="" />
                        <img class="menu_footer" src="../images/footer.jpg" alt="" />
                        <div class="restaurant_title">
                            <div class="restaurant_logo"><img src="../images/atawich.jpg" alt="logo" /></div>
                            <img class="title_img" src="../images/menu_title_img.png" alt="" />
                            <h3 class="title">فست فود عطاویچ</h3>

                            <button type="button" id="add_category" class="add_category_btn"><i class="fas fa-plus-circle"></i> افزودن سرمنو</button>

                        </div>

                        <div class="row no-margin menu_row">
     <?php $i = 1;
    $j = 1;
    $id_num = foodCount($i);
    $j = foodCount($j);
    foreach ($giftRow as $k => $v)
    {
        ?>
        <div class="each_cat_box fadeIn" id="box_num1">
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
            ?>
                <div class="food-box fadeIn" id="food<?php echo $id_num ?>" name="food<?php echo $id_num ?>">
                    <button class="fooderz_btn food-close" type="button">
                        ×
                    </button>
                    <div class="row">
                        <div class="col-sm-4 img-box">
                            <div class="image js--image-preview" id="upload<?php echo $id_num ?>">
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
                                <input class="food-input desc" name="tfood<?php echo $id_num ?>" placeholder="توضیحات کوتاه" type="text">
                                    <input value="<?php echo $v1['price'] ?>" class="food-input food-price" name="gfood<?php echo $id_num ?>" placeholder="قیمت" type="text"/>
                                </input>
                            </input>
                        </div>
                    </div>
                </div>
            <?php
}?>
            </input>
        </div>
    </br>
    <?php }?>
                        </div>
                        <input type="text" name="prv_ID" value="<?php echo $prv_ID; ?>" hidden />
                        <input hidden type="text" name="providerName" value="<?php echo $providerName ?>" id="">

                        <div class="text-center food_menu_submit">
                            <br /><br />
                            <div class="text-center validate-error fadeIn">
                                <i class="fa fa-times error-icon"></i>
                                خطا! لطفا تمامی فیلدهای قیمت ، نام و نام سرمنو برای منوهای انتخابی را وارد نمایید.
                            </div>
                            <input type="button" id="menu-submit" class="fooderz_btn" name="sub" value="ذخیره منو" >
                        </div>
                    </div>

                </form>
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
                                <div class="dot style="left: <?php echo ($discount * 93 / 100) ?>%">
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

                    <div class="col-md-6">
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
foreach ($gifted as $value)
    {
        echo "<li>$value</li>";
    }?>

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

                    <div id="report-chart" class="text-center" style="height: 200px; padding: 0"></div>
                    <hr />
                    <div class="text-center">
                     <div class="circle-rate">۱۲۰۰۰۰۰۰ تومان</div>
                    </div>
                    <div class="col-md-6 text-center report-table-container right">
                        <h4 class="main-title">لیست فروش</h4>
                        <table class="report-table">
                            <tr>
                                <th>شماره تراکنش</th>
                                <th>نام مشتری</th>
                                <th>مبلغ</th>
                                <th>نام پیک</th>
                                <th>تاریخ و ساعت</th>
                                <th>بیشتر +</th>
                            </tr>
                            <tr>
                                <td>۱۲۱۳۱</td>
                                <th><?php echo $managerName; ?></th>
                                <th>۱۴۰۰۰</th>
                                <th><?php echo $managerName; ?></th>
                                <th>۲/۵/۹۷</th>
                                <th><a class="more" href="#" data-toggle="modal" data-target="#more_details">...</a></th>
                            </tr>
                            <tr>
                                <td>۱۲۱۳۱</td>
                                <th><?php echo $managerName; ?></th>
                                <th>۱۴۰۰۰</th>
                                <th><?php echo $managerName; ?></th>
                                <th>۲/۵/۹۷</th>
                                <th><a class="more" href="#" data-toggle="modal" data-target="#more_details">...</a></th>
                            </tr>
                            <tr>
                                <td>۱۲۱۳۱</td>
                                <th><?php echo $managerName; ?></th>
                                <th>۱۴۰۰۰</th>
                                <th><?php echo $managerName; ?></th>
                                <th>۲/۵/۹۷</th>
                                <th><a class="more" href="#" data-toggle="modal" data-target="#more_details">...</a></th>
                            </tr>
                            <tr>
                                <td>۱۲۱۳۱</td>
                                <th><?php echo $managerName; ?></th>
                                <th>۱۴۰۰۰</th>
                                <th><?php echo $managerName; ?></th>
                                <th>۲/۵/۹۷</th>
                                <th><a class="more" href="#" data-toggle="modal" data-target="#more_details">...</a></th>
                            </tr>
                        </table>
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

        <div class="factor" id="factor" style="border: solid 1px #000;padding: 20px;text-align: right;display: none">
            <div style="margin-bottom: 30px;text-align: center">
                <img src="../images/logo.png" alt="Fooderz" width="100px" />
                <h3 style="float: right">رستوران عطاویچ</h3>
                <p style="float: left">شماره تماس : ۰۷۱۳۵۶۷۸۹۶۴</p>
            </div>
            <h5 style="text-align: center">فاکتور شماره ۱۱۳۶</h5>
            <table style="width: 100%;border: dashed 1px #aaa;text-align: right;direction: rtl;border-bottom: none">
                <tr style="text-align: center;border-bottom: solid .5px #aaa">
                    <th style="padding: 10px;border-bottom: solid 1px #aaa">ردیف</th>
                    <th style="padding: 10px;border-bottom: solid 1px #aaa">نام سفارش</th>
                    <th style="padding: 10px;border-bottom: solid 1px #aaa">تعداد</th>
                    <th style="padding: 10px;border-bottom: solid 1px #aaa">مبلغ (تومان)</th>
                </tr>

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
        <!-- /hidden factor for restaurant printing -->


    </div>

</div>


<!-- modals -->
<!-- financial panel more options modal -->
<div class="modal fade" id="more_details" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-wide" role="document">
        <div class="modal-content full_width">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="بستن">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <h5 class="tomato">جزییات سفارش</h5>
                        <table class="report-table">
                            <tr>
                                <th>ردیف</th>
                                <th>نام سفارش</th>
                                <th>تعداد</th>
                                <th>مبلغ (تومان)</th>
                                <th> سود شما (تومان)</th>
                            </tr>

                            <tr>
                                <td>۱</td>
                                <td>پیتزا دونفره بزرگ</td>
                                <td>۱</td>
                                <td>۲۲۰۰۰</td>
                                <td>۲۰۰۰۰</td>
                            </tr>

                            <tr>
                                <td>۲</td>
                                <td>چیزبرگر</td>
                                <td>۲</td>
                                <td>۱۸۰۰۰</td>
                                <td>۱۶۰۰۰</td>
                            </tr>

                            <tr>
                                <td>۳</td>
                                <td>زرشک پلو با مرغ سرخ شده</td>
                                <td>۳</td>
                                <td>۱۸۰۰۰</td>
                                <td>۱۶۰۰۰</td>
                            </tr>

                            <!-- table footer (do not remove)-->
                            <tr>
                                <th>مبلغ کل</th>
                                <td>-</td>
                                <td>-</td>
                                <th class="green_colored">۵۸۰۰۰</th>
                                <td>-</td>
                            </tr>
                            <tr>
                                <th>جمع کل سود</th>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <th class="green_colored">۵۲۰۰۰</th>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-6">
                        <h5 class="tomato">مشخصات مشتری</h5>
                        <table class="report-table">
                            <tr>
                                <th>نام</th>
                                <th>شماره تماس</th>
                                <th>آدرس</th>
                                <th>توضیحات</th>
                            </tr>
                            <tr>
                                <td><?php echo $managerName; ?></td>
                                <td>۰۹۱۷۸۱۵۹۹۸۱</td>
                                <td>شیراز خیابان عفیف آباد نبش کوچه چهارم . بن بست آخر پلاک ۲۰۰</td>
                                <td>توضیحات طولانی توضیحات طولانی توضیحات طولانی توضیحات طولانی توضیحات طولانی توضیحات طولانی</td>
                            </tr>

                        </table>
                    </div>
                </div>




            </div>
            <div class="modal-footer">
                <button type="button" class="print btn btn-primary" data-dismiss="modal" aria-label="پرینت">
                    <span aria-hidden="true">پرینت</span>
                </button>
            </div>
        </div>
    </div>
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
<!-- /modals -->
<script src="../js/plugins.min.js"></script>
<script src="js/provider_info.js"></script>
<script>

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
        var cat_count = <?php echo $cat_id?>;
        var food_count = <?php echo $food_id ?>;
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
            console.log(food_count);

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


        //chart
        var chart = $('#report-chart').chartinator({

            columns: [
                {label: 'ماه', type: 'string'},
                {label: 'نرخ', type: 'number'}
            ],

            rows: [
                ['آذر ۹۶', 18],
                ['دی ۹۶', 12],
                ['بهمن ۹۶', 10],
                ['اسفند ۹۶', 5],
                ['فروردین ۹۷', 6],
                ['اردیبهشت ۹۷', 4]],

            createTable: 'table-chart',

            dataTitle: 'تراکنش ها',

            chartClass: 'col',

            tableClass: 'col-table',


            chartType: 'AreaChart',

            chartAspectRatio: 1.5,

            // Google Area Chart Options
            areaChart: {

                // Width of chart in pixels - Number
                width: null,

                // Height of chart in pixels - Number
                //height: 400,

                chartArea: {
                    left: "10%",
                    top: 10,
                    width: "100%",
                    height: "90%"
                },


                fontName: 'isans',

                // Chart Title - String
                title: '',

                titleTextStyle: {

                    fontSize: 'h4'
                },
                legend: {
                    position: 'bottom'
                },

                // Array of colours
                colors: ['#123456'],

                tooltip: {
                    trigger: 'focus'
                }
            },

            // Show table as well as chart - String
            // Options: 'show', 'hide', 'remove'
            showTable: 'hide'
        });




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



</script>
</body>
</html>
    <?php
}
else
{
    header("location: ../../FooderzAdmin/Providers/ProviderConfirm.php");
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