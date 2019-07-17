<?php
include $_SERVER["DOCUMENT_ROOT"] . "/Fooderz/funx.php";
$rand = rand(100, 9999);
session_start();
$_SESSION['rnd'] = $rand;
try {
    $prv_ID = $_POST['prv_ID'];
    require_once '../../DataBase/PDO/DBconnect/DBconnect.php';
    $sql = "SELECT `prv_ID`, `providerName`, `telephone`, `managerName`, `mobile`, `email`, `address`, `latitude`,
`longitude`, `country`, `state`, `city`, `regions`, `postalCode`, `provideType`, `resturantType`, `password`, `datenTime`,
 `bornDate`, `minimomOrder`, `weeklyWorkTIme`, `deliveryCost`, `URL`, `logoPath`, `natCardPath`,
  `contractPath`, `confirmByAdmin`, `reserve`, `sheba_number`, `motto`, `description`, `total_visitors`, `branch`, `orderType`, `colleague_mobile`
  FROM `provider` WHERE prv_ID=:prv_ID";
    $stmt = $db->prepare($sql);
    $BindArr = array
    (
        ':prv_ID' => $prv_ID,
    );
    $stmt->execute($BindArr);
    $row = $stmt->fetch();

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    $PDOerr = $e->getMessage();
}
$prvDir = $row['prv_ID'] . "_" . $row['providerName'] . "_" . $row['managerName'] . "/"; //provider ID
date_default_timezone_set('Asia/Tehran');
include_once '../../jdf/jdf.php';
if ($row['bornDate'] != "0000-00-00") {
    $d = strtotime($row['bornDate']);
    $year = date("Y", $d);
    $month = date("m", $d);
    $day = date("d", $d);
    $date = gregorian_to_jalali($year, $month, $day);
    $year = substr($date[0], 2);
    $month = (strlen($date[1]) == 1) ? "0" . $date[1] : $date[1];
    $day = (strlen($date[2]) == 1) ? "0" . $date[2] : $date[2];
}
$dh = arp("images/logo/" . $prv_ID . "/");
if (is_dir($dh)) {
    $logoName = scandir($dh);
    // var_dump($logoName);
    // die();
    $logoName = end($logoName);

    // $logoName = $logoName[2];
}
// var_dump($logoName);
// die();
?>
<link href="../Css/bootstrap.css" rel="stylesheet" type="text/css">
<script src="../Js/jquery-1.10.2.js" type="text/javascript">
</script>
<script src="../Js/bootstrap.js" type="text/javascript">
</script>
<style>
    .c {
        display: inline;
        width: 5%;
        font-family: Tahoma !important;
        padding: 6px 0px;

    }

    .b {
        display: inline;
        width: 18%;
        font-family: Tahoma !important;
        padding: 6px 0px;

    }

    .a:focus {
        border-color: #66afe9;
        outline: 0;
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(102, 175, 233, 0.6);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(102, 175, 233, 0.6);
    }
</style>
<style>
    .b1 {
        display: inline;
        width: 80%;
        font-family: Tahoma !important;
        padding: 6px 0px;

    }

    .a1:focus {
        border-color: #66afe9;
        outline: 0;
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(102, 175, 233, 0.6);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(102, 175, 233, 0.6);
    }
</style>
<div class="modal-dialog" style="width:80%">
    <div class="row">
        <div class="modal-content text-center" style="margin: auto;font-family: Tahoma">
            <div class="modal-body">
                <div class="container text-center" id="md">
                    <form action="modalInsert.php" enctype="multipart/form-data" method="post">
                        <div class="container text-center" style="font-family: Tahama">
                            <h3 style="font-family:Tahoma">
                                اطلاعات تکمیلی
                            </h3>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <div style="overflow: scroll;height: 500px">
                                            <div class="form-group" dir="rtl">
                                                <a class="btn btn-primary"
                                                   href="../../Fooderz.ir/provider/provider_info.php?rnd=<?php echo $rand ?>&prv_ID=<?php echo $prv_ID ?>"
                                                   type="button">
                                                    ورود به پنل ارایه دهنده
                                                </a>
                                            </div>
                                            <div class="form-group" dir="rtl">
                                                <label class="pull-right" dir="rtl" for="txtResName"
                                                       style="font-family: Tahoma">
                                                    طول جغرافیایی(longitude) </label>
                                                <input class="form-control" id="shortOrder" name="latitude"
                                                       tabindex="11" value="<?php echo $row['longitude'] ?>">
                                                </input>
                                            </div>
                                            <div class="form-group" dir="rtl">
                                                <label class="pull-right" dir="rtl" for="txtResName"
                                                       style="font-family: Tahoma">
                                                    عرض جغرافیایی(latitude) </label>
                                                <input class="form-control" id="shortOrder" name="longitude"
                                                       tabindex="11" value="<?php echo $row['latitude'] ?>">
                                                </input>
                                            </div>
                                            <div class="form-group" dir="rtl" id="divGetFirstLogo">
                                                <label class="pull-right" dir="rtl" for="txtGetLogo"
                                                       style="font-family: Tahoma">
                                                    انتخاب لوگو
                                                </label>
                                                <input class="form-control" id="txtGetLogo" name="logoImg" tabindex="10"
                                                       type="file">
                                                <br>

                                                <div id="divGetLogo">
                                                    <img src="<?php echo $logo_path_inc . $prv_ID . '/' . $logoName ?>"
                                                         class="img img-responsive img-rounded img-thumbnail"
                                                         height="300" id="imgGetLogo" style="border-radius: 10px"
                                                         width="200">
                                                    <button id="btnDeleteImg"
                                                            style="background-color: orangered;color:white;size: landscape"
                                                            type="button">
                                                        ×
                                                    </button>
                                                    </img>
                                                </div>
                                                </br>
                                                </input>
                                            </div>
                                            <div class="form-group" dir="rtl">
                                                <label class="pull-right" dir="rtl" for="txtResName"
                                                       style="font-family: Tahoma">
                                                    حداقل سفارش
                                                </label>
                                                <input class="form-control" id="shortOrder" name="minimomOrder"
                                                       tabindex="11" value="<?php echo $row['minimomOrder'] ?>">
                                                </input>
                                            </div>
                                            <div class="form-group" dir="rtl">
                                                <label class="pull-right" dir="rtl" for="txtResName"
                                                       style="font-family: Tahoma">
                                                    هزینه پیک
                                                </label>
                                                <input class="form-control" id="shortOrder" name="deliveryCost"
                                                       tabindex="11" value="<?php echo $row['deliveryCost'] ?>">
                                                </input>
                                            </div>
                                            <div class="form-group" dir="rtl" id="divGetFirstCart">
                                                <label class="pull-right" dir="rtl" for="txtGetCart"
                                                       style="font-family: Tahoma">
                                                    اسکن کارت ملی(پشت و رو)
                                                </label>
                                                <input class="form-control" id="txtGetCart" name="nationalCardImg"
                                                       tabindex="12" type="file">
                                                <br>
                                                <div id="divGetCart">
                                                    <img class="img img-responsive img-rounded img-thumbnail"
                                                         height="200" id="imgGetCart" style="border-radius: 10px"
                                                         width="200">
                                                    <button id="btnDeleteCart"
                                                            style="background-color: orangered;color:white;size: landscape"
                                                            type="button">
                                                        ×
                                                    </button>
                                                    </img>
                                                </div>
                                                </br>
                                                </input>
                                            </div>
                                            <br>
                                            <div class="form-group" dir="rtl" id="divGetFirstContract">
                                                <label class="pull-right" dir="rtl" for="txtGetContract"
                                                       style="font-family: Tahoma;padding-right: 3%">
                                                    اسکن قرارداد(اسکن شده در قالب فایل
                                                    zip)
                                                </label>
                                                <input class="form-control" id="txtGetContract" name="contractZip"
                                                       tabindex="13" type="file">
                                                <br>
                                                <div id="divGetContract">
                                                    <a href="file:///home/imaohw/images/<? echo $prvDir ?>"
                                                       target="_blank">
                                                        <button class="btn btn-primary" type="button">
                                                            دانلود از سرور
                                                            <img height="30" src="../image/download_square.png"
                                                                 width="30">
                                                            </img>
                                                        </button>
                                                    </a>
                                                    <button id="btnDeleteContract"
                                                            style="background-color: orangered;color:white;size: landscape"
                                                            type="button">
                                                        ×
                                                    </button>
                                                </div>
                                                </br>
                                                </input>
                                            </div>
                                            <hr>
                                            <div class="form-group" dir="rtl">
                                                <button class="btn btn-primary" onclick="btn2()" type="button">
                                                    <img height="30"
                                                         src="../image/png-location-location-pin-icon-512.png"
                                                         width="30">
                                                    لیست محدوده های سروریس دهی
                                                    </img>
                                                </button>
                                            </div>
                                            <!--                                            <hr>-->
                                            <!--                                            <br>-->
                                            <!--                                            <div class="form-group" dir="rtl">-->
                                            <!--                                                <button type="button" class="btn btn-primary"> ارسال اس ام اس تایید-->
                                            <!--                                                </button>-->
                                            <!--                                            </div>-->
                                            <!--                                            <hr>-->
                                            </hr>
                                            </br>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div style="overflow: scroll;height: 500px">
                                            <div class="form-group" dir="rtl">
                                                <label class="pull-right" dir="rtl" for="txtResName"
                                                       style="font-family: Tahoma;padding-right: 1%">
                                                    نام رستوران
                                                </label>
                                                <input class="form-control" id="txtResName" name="providerName"
                                                       tabindex="1" value="<?php echo $row['providerName'] ?>">
                                                </input>
                                            </div>
                                            <div class="form-group" dir="rtl">
                                                <label class="pull-right" dir="rtl" for="txtResName"
                                                       style="font-family: Tahoma;padding-right: 1%">
                                                    نام مدیر
                                                </label>
                                                <input class="form-control" id="txtResName" name="managerName"
                                                       tabindex="2" value="<?php echo $row['managerName'] ?>">
                                                </input>
                                            </div>
                                            <div class="form-group" dir="rtl">
                                                <label class="pull-right" dir="rtl" for="txtResName"
                                                       style="font-family: Tahoma;padding-right: 1%">
                                                    شهر
                                                </label>
                                                <input class="form-control" id="txtResName" name="city" tabindex="3"
                                                       value="<?php echo $row['city'] ?>">
                                                </input>
                                            </div>
                                            <div class="form-group" dir="rtl">
                                                <label class="pull-right" dir="rtl" for="txtResName"
                                                       style="font-family: Tahoma;padding-right: 1%">
                                                    آدرس
                                                </label>
                                                <input class="form-control" id="txtResName" name="address" tabindex="4"
                                                       value="<?php echo $row['address'] ?>">
                                                </input>
                                            </div>
                                            <div class="form-group" dir="rtl">
                                                <label class="pull-right" dir="rtl" for="txtResName"
                                                       style="font-family: Tahoma;padding-right: 1%">
                                                    کد پستی
                                                </label>
                                                <input class="form-control" id="txtResName" name="postalCode"
                                                       tabindex="4" value="<?php echo $row['postalCode'] ?>">
                                                </input>
                                            </div>
                                            <div class="form-group" dir="rtl">
                                                <label class="pull-right" dir="rtl" for="txtResName"
                                                       style="font-family: Tahoma;padding-right: 1%">
                                                    شماره شبا
                                                </label>
                                                <input class="form-control" id="txtResName" name="sheba" tabindex="4"
                                                       value="<?php echo $row['sheba_number'] ?>">
                                                </input>
                                            </div>
                                            <div class="form-group" dir="rtl">
                                                <label class="pull-right" dir="rtl" for="txtResName"
                                                       style="font-family: Tahoma;padding-right: 1%">
                                                    موبایل
                                                </label>
                                                <input class="form-control" id="txtResName" name="mobile" tabindex="5"
                                                       value="<?php echo $row['mobile'] ?>">
                                                </input>

                                                        <div class="form-group" dir="rtl">
                                                            <label class="pull-right" dir="rtl" for="txtResName" style="font-family: Tahoma;padding-right: 1%">
                                                                شماره موبایل همکار (sms های تراکنش)
                                                            </label>
                                                            <input class="form-control" id="txtResName" name="colleague_mobile" tabindex="4" value="<?php echo $row['colleague_mobile'] ?>">
                                                            </input>
                                                        </div>                                                <div class="form-group form-inline" dir="rtl">
                                                </div>
                                                <label class="pull-right" dir="rtl" for="txtResName"
                                                       style="font-family: Tahoma;padding-right: 1%">
                                                    تاریخ تولد
                                                </label>
                                                <input class="form-control a b" id="day" name="day"
                                                       onkeyup="if(this.value.length>=2) month.focus()"
                                                       placeholder="روز" tabindex="5" value="<?php if (isset($day)) {
                                                    echo $day;
                                                }
                                                ?>">
                                                <input class="form-control a b" id="month" name="month"
                                                       onkeyup="if(this.value.length>=2) year.focus()" placeholder="ماه"
                                                       size="1" tabindex="5" value="<?php if (isset($month)) {
                                                    echo $month;
                                                }
                                                ?>">
                                                <input class="form-control a b" id="year" name="year"
                                                       onkeyup="if(this.value.length>=2) telephone.focus()"
                                                       placeholder="سال" size="1" tabindex="5"
                                                       value="<?php if (isset($year)) {
                                                           echo $year;
                                                       }
                                                       ?>">
                                                </input>
                                                </input>
                                                </input>
                                            </div>
                                            <div class="form-group" dir="rtl">
                                                <label class="pull-right" dir="rtl" for="txtResName"
                                                       style="font-family: Tahoma;padding-right: 3%">
                                                    تلفن ثابت
                                                </label>
                                                <input class="form-control" id="telephone" name="telephone" tabindex="6"
                                                       value="<?php echo $row['telephone'] ?>">
                                                </input>
                                            </div>
                                            <div class="form-group" dir="rtl">
                                                <label class="pull-right" dir="rtl" for="txtResName"
                                                       style="font-family: Tahoma;padding-right: 3%">
                                                    نوع خدمات
                                                </label>
                                                <input class="form-control" id="txtResName" name="provideType"
                                                       tabindex="7" value="<?php echo $row['provideType'] ?>">
                                                </input>
                                            </div>
                                            <?php if ($row['resturantType'] != 'empty') {
                                                ?>
                                                <div class="form-group" dir="rtl">
                                                    <label class="pull-right" dir="rtl" for="txtResName"
                                                           style="font-family: Tahoma;padding-right: 4%">
                                                        نوع رستوران
                                                    </label>
                                                    <input class="form-control" id="txtResName" name="resturantType"
                                                           value="<?php echo $row['resturantType'] ?>">
                                                    </input>
                                                </div>
                                                <?php
                                            } ?>
                                            <div class="form-group" dir="rtl">
                                                <label class="pull-right" dir="rtl" for="txtResName"
                                                       style="font-family: Tahoma;padding-right: 3%">
                                                    نوع سفارش
                                                </label>
                                                <input class="form-control" id="txtResName" name="orderType"
                                                       tabindex="7" value="<?php echo $row['orderType'] ?>">
                                                </input>
                                            </div>
                                            <div class="form-group" dir="rtl">
                                                <label class="pull-right" dir="rtl" for="txtResName"
                                                       style="font-family: Tahoma;padding-right: 4%">
                                                    شعبه
                                                </label>
                                                <input class="form-control" id="txtResName" name="branch" tabindex="8"
                                                       value="<?php echo $row['branch'] ?>">
                                                </input>
                                            </div>
                                            <div class="form-group" dir="rtl">
                                                <label class="pull-right" dir="rtl" for="txtResName"
                                                       style="font-family: Tahoma;padding-right: 4%">شعار
                                                    رستوران</label>
                                                <input class="form-control" id="txtResName" name="motto" tabindex="8"
                                                       value="<?php echo $row['motto'] ?>">
                                                </input>
                                            </div>
                                            <div class="form-group" dir="rtl">
                                                <label class="pull-right" dir="rtl" for="txtResName"
                                                       style="font-family: Tahoma;padding-right: 4%">
                                                    توضیحات
                                                </label>
                                                <input hidden="" id="myJSON" name="myJSON" type="text" value="">
                                                <input hidden="" id="prv_ID" name="prv_ID" type="text"
                                                       value="<?php echo $prv_ID ?>">
                                                <input class="form-control" id="txtResName" name="description"
                                                       tabindex="9" value="<?php echo $row['description'] ?>">
                                                </input>
                                                </input>
                                                </input>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                </br>
                                </br>
                                </br>
                                </br>
                                </br>
                                </br>
                                </br>
                                </br>
                            </div>
                            <br>
                            <div class="col-md-12">
                                <div class="container text-center" style="margin: auto;padding-right: 2%">
                                                <span style="padding-right: 10%">
                                                <nima id="Confirm" style="font-size: x-large">
                                                    تایید :
                                                </nima>
                                                <input <?php if($row['confirmByAdmin']==1) echo 'checked' ?> id="chConfirm" name="chConfirm" style="padding: 10%"
                                                       type="checkbox">
                                                </span>
                                    <span style="padding-right: 15%">
                                                    <hossein id="lblSmsConfirm" style="font-size: x-large">
                                                    ارسال sms تایید :
                                                </hossein>
                                                <input id="smsConfirm" name="chConfirm" style="padding: 10%"
                                                       type="checkbox">
                                                </span>

                                    <div>
                                        <button class="btn btn-primary btn-block" name="modalSub" type="submit">
                                            ثبت و
                                            ذخیره اطلاعات
                                        </button>
                                    </div>
                                    </input>
                                </div>
                            </div>
                            </br>
                            </hr>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            $(chConfirm).change(function () {
                if (chConfirm.checked === true) {
                    Confirm.innerHTML = 'تایید شده';
                    Confirm.style.color = 'green';
                }
                else {
                    Confirm.innerHTML = 'تایید';
                    Confirm.style.color = 'black';
                }
            })
            $(smsConfirm).change(function () {
                if (smsConfirm.checked === true) {
                    // Confirm.innerHTML='تایید شده';
                    lblSmsConfirm.style.color = 'green';
                }
                else {
                    // Confirm.innerHTML='تایید';
                    lblSmsConfirm.style.color = 'black';
                }
            })
        </script>
    </div>
    <div class="modal fade" id="modalInsertRegions" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body" style="height: 300px">
                    <div class="form-group">
                    </div>
                    <div class="form-group">
                        <input class="form-control" id="selectedRegion" list="list1">
                        <br>
                        <datalist id="list1">
                            <?php
                            $regionSQL = "SELECT regionName FROM `regions` ORDER BY region_id";
                            $regionRes = $db->
                            query($regionSQL);

                            while ($regionRow = $regionRes->fetchColumn(0)) {
                                ?>
                                <option>
                                    <?php echo $regionRow ?>
                                </option>
                                <?php
                            } ?>
                        </datalist>
                        <div id="divGetRegions">
                            <?php
                            $regionSQL = "SELECT regions FROM provider WHERE prv_ID=$prv_ID";
                            $regionRes = $db->
                            query($regionSQL);
                            $regArr = json_decode($regionRes->fetch()[0]);
                            $arr = [];
                            if (isset($regArr)) {

                                foreach ($regArr as $v) {
                                    $arr[] = $v;
                                    $ran = rand(100, 999); ?>
                                    <input id="txtRegion<?php echo $ran ?>" onloadeddata="looop(<?php echo $v ?>)"
                                           value="<?php echo $v ?>">
                                    <button id="txtRegion<?php echo $ran ?>" onclick="f2(this.id)">
                                        ×
                                    </button>
                                    <?php
                                }
                                echo "<hr>
                                            ";
                            }
                            ?>
                            </input>
                        </div>
                        <br>
                        <div id="divGetRegionsAndGoMysql">
                            <input hidden="" id="regions" name="regions">
                            </input>
                        </div>
                        </br>
                        </br>
                        </input>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let region = [];
        <?php foreach ($arr as $v)
        {
        ?>
        region.push("<?php echo $v ?>");
        <?php
        }?>
        let myjson = JSON.stringify(region);
        document.getElementById("myJSON").value = myjson;
        $(selectedRegion).keyup(function (event) {


            if (event.keyCode == 13) {
                selectedRegion.focus();
                let ran = Math.floor(Math.random() * 99);

                divGetRegions.innerHTML += "<input name='regg' id='txtRegion" + ran + "' value='" + selectedRegion.value + "'>";

                divGetRegions.innerHTML += "<button  id='txtRegion" + ran + "'  onclick='f2(this.id)' >&times;</button>";

                region.push(selectedRegion.value);
                let myjson = JSON.stringify(region);
                document.getElementById("myJSON").value = myjson;
                // alert(region);
                selectedRegion.value = '';
                ran = '';
            }


        })

        function f2(name1) {
            let value1 = document.getElementById(name1).value;
            let valIndex = region.indexOf(value1);
            region.splice(valIndex, 1);
            let myjson = JSON.stringify(region);
            document.getElementById("myJSON").value = myjson;
            document.getElementById(name1).remove();
            document.getElementById(name1).remove();

        }
    </script>
    <script>
        // $(btnShowModalInsertRegions).click(function ()
        // {
        //     $(modalInsertRegions).modal();
        // })
    </script>
    <script>
        $(btnDeleteImg).click(function () {
            $(txtGetLogo).val('');
            $(txtGetLogo).attr('src', '');
            imgGetLogo.src = '';
            imgGetLogo.value = '';
            $(divGetLogo).hide(1000)

        })
        $(btnDeleteCart).click(function () {
            $(txtGetCart).val('');
            $(txtGetCart).attr('src', '');
            imgGetCart.src = '';
            imgGetCart.value = '';
            $(divGetCart).hide(1000)

        })
        $(btnDeleteContract).click(function () {
            $(txtGetContract).val('');
            $(txtGetContract).attr('src', '');
            // imgGetContract.src='';
            // imgGetContract.value='';

        })
    </script>
    <script>
        $(txtGetLogo).change(function () {

            let reader = new FileReader();

            reader.readAsDataURL(txtGetLogo.files[0]);
            reader.onloadend = function (ex) {

                $(divGetLogo).show(1000);
                imgGetLogo.src = ex.target.result;

            }
        })
    </script>
    <script>
        $(txtGetCart).change(function () {
            let reader = new FileReader();

            reader.readAsDataURL(txtGetCart.files[0]);
            reader.onloadend = function (ex) {
                $(divGetCart).show(1000);
                imgGetCart.src = ex.target.result;
            }
        })
    </script>
    <script>
        $(btnShowModal).click(function () {
            $(Modal1).modal('show');
        })
    </script>
</div>
</link>