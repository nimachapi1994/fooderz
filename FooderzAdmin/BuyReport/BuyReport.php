<?php include '../Shared/Top.php'?>
<?php
// session_start();
// $_SESSION['admin_login'] = 'oui';
// var_dump($_POST);
// die();  
include_once '../../DataBase/PDO/DBconnect/DBconnect.php';
include_once '../../jdf/jdf.php';
if (isset($_POST['send']))
{
    $verify = ($_POST['send'] == 'ok') ? 'accepted_order' : 'canceled_order';
    try
    {
        $sql     = "UPDATE purchasecart SET verify=:verify WHERE pch_ID=:pch_ID";
        $stmt    = $db->prepare($sql);
        $bindArr = array
            (
                ":verify" => $verify,
                ":pch_ID" => $_POST['pch_ID'],
            );
        $stmt->execute($bindArr);
        $errInfo = $stmt->errorInfo();
        // header("Location: BuyReport.php");
    }
    catch (Exception $e)
    {
        $err = $e->getMessage();
    }
}
?>
<body id="bd"></body>
<link type="text/css" rel="stylesheet" href="../Css/bootstrap.css">
<!-- <link href="../../Fooderz.ir/css/other_styles.css" rel="stylesheet" type="text/css" media="all"/>
<link href="../../Fooderz.ir/css/style.css" rel="stylesheet" type="text/css" media="all"/>
 --><script type="text/javascript" src="../Js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="../Js/bootstrap.js"></script>
<style>
    .c{
        display: inline;
        width: 5%;
        font-family: Tahoma !important;
        padding: 6px 0px;

    }
    .b{
        display: inline;
        width: 50%;
        font-family: Tahoma !important;
        padding: 6px 0px;

    }
    .a:focus {
        border-color: #66afe9;
        outline: 0;
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(102, 175, 233, 0.6);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(102, 175, 233, 0.6);
    }
    .report-table-container .main-title {
    padding: 30px 0px;
}
table.report-table {
    width: 100%;
    overflow-x: auto;
}
@media (max-width: 767px) {
    table.report-table {
        width: 767px;
    }
}
table.report-table th, td {
    width: auto;
    text-align: center;
    padding: 10px;
}
.report-table-container.right {
    border-left: dashed .5px #aaa;
}

</style>
<div class="container text-center"style="margin: auto;width: 100%;font-family: Tahoma">
    <div style="padding-right: 5%">
        <h3 class="text-center" style="font-family: Tahoma"><span style="color: blue">لیست</span> گزارشات خرید </h3>
        <br>    <br>
        <input id="searchInput" size="180" class="form-control a b" placeholder="جستجو بر اساس نام و نام خانوادگ, شماره موبایل یا کد پیگیری"style="font-family:Tahama;size: 10%">

<!--         بر اساس
        <select class="form-control a b">
            <option>نام و نام خانوادگی</option>
            <option>شماره موبایل</option>
            <option>کد پیگیری</option>

        </select>
 -->
<!-- lllllll

        بر اساس تاریخ
        <select class="form-control a c"id="SlcDay">

        </select>
        <select class="form-control a c"id="SlcMonth">

        </select>
        <select class="form-control a c"id="SlcYear">

        </select>
        تا
        <select class="form-control a c"id="SlcDay">

        </select>
        <select class="form-control a c"id="SlcMonth">

        </select>
        <select class="form-control a c"id="SlcYear">

        </select>
 -->
        <button id="search" class="btn btn-primary"><a href="" style="float: left"><img src="../image/1Search1.png"style="width: 30px;height: 30px;"></a></button>
        <br>
        <hr>

    </div>

</div>




        <br>
<div style="padding-right: 5%">
    <div style="padding-right: 40%">
        <form action="BuyReportAjax.php" method="post" id="verify_form">
            <input class="verify_class" type="radio" name="verify" value="" class="text-center" id="">همه&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
            <input class="verify_class" type="radio" name="verify" value="accepted_order" class="text-center" id="">ارسال شده&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
            <input class="verify_class" type="radio" name="verify" value="canceled_order" class="text-center" id="">رد شده&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input class="verify_class" type="radio" name="verify" value="suspended_order" class="text-center" id="">معلق&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;            
        </form>
    </div>
    <br>
<div id="buyReportAjax">
    
</div>
</div>
<div class="modal fade" id="modalShowDelivery"role="dialog">
    <div class="modal-dialog"style="width:50%">
        <div class="modal-content text-center"style="margin: auto ">

            <div class="modal-body text-center">
                <h3 style="font-family: Tahoma">  مشخصات<span style="color: blue">  تحویل</span></h3>
                <hr>

                <table class="table table-responsive table-bordered">
                    <tr>
                        <th style="text-align: center">مشخصات پیک</th>
                        <th style="text-align: center">آدرس مشتری</th>

                    </tr>
                    <tr>
                        <td style="text-align: center">
                            <table class="table table-bordered table-hover table-responsive">
                                <tr>
                                    <th style="text-align: center">نام و نام خانوادگی</th>
                                    <th style="text-align: center">موبایل</th>
                                </tr>
                                <tr>
                                    <td style="text-align: center">محسن حمیدی</td>
                                    <td style="text-align: center">09178134699</td>
                                </tr>
                            </table>
                        </td>

                        <td style="text-align: center">
                            <div class="col-sm-12 col-xs-12 col-md-12 text-center"style="font-family:Tahoma;font-size:large"dir="ltr">
                                <pre>ddddddddddddddddddddddddddddddddddfffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffdddd44ttttttttttttttttttttttttttttttttttttttttttt444444444444444444444444444444444444ddddddddddddddddddddddd</pre>
                            </div>
                        </td>


                    </tr>
                </table>
                <h4 style="font-family: Tahoma;color: black"> موقعیت مشتری روی نقشه</h4>
                <div class="container text-center"style="margin: auto;width: 100%;border: 2px;border-radius: 4px ;border-color: dimgrey;border-style: ridge">
location
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(btnShowModalDelivery).click(function () {
        $(modalShowDelivery).modal();
    })
</script>

<div class="modal fade" id="modalShowFactor"role="dialog">

</div>

<script>
</script>
<div class="modal fade" id="modalShowSeller"role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body text-center">
                <h3 style="font-family: Tahoma">مشخصات <span style="color: blue">فروشنده</span></h3>
                <hr>
                <br>
                <table class="table table-responsive table-bordered">
                    <tr>
                        <th style="text-align: center">نام و نام خانوادگی</th>
                        <th style="text-align: center">شماره تماس</th>
                        <th style="text-align: center">اسم مغازه</th>
                        <th style="text-align: center">مشخصات کامل</th>
                    </tr>
                    <tr>
                        <td style="text-align: center">حسن حسنی</td>
                        <td style="text-align: center">09178134699</td>
                        <td style="text-align: center">عطاویچ</td>
                        <td style="text-align: center"><button class="btn btn-primary">بیشتر +</button> </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(btnShowModalSeller).click(function () {
        $(modalShowSeller).modal();
    })
</script>

<div class="modal fade" id="modalShowCustomer"role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body text-center">
                <h3 style="font-family: Tahoma">مشخصات <span style="color: blue">خریدار</span></h3>
                <hr>
                <br>
                <table class="table table-responsive table-bordered">
                    <tr>
                        <th style="text-align: center">نام و نام خانوادگی</th>
                        <th style="text-align: center">شماره تماس</th>
                    </tr>
                    <tr>
                        <td style="text-align: center">حسن حسنی</td>
                        <td style="text-align: center">09178134699</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(btnShowModalCustomer).click(function () {
        $(modalShowCustomer).modal();
    })
</script>
<script>
    let Arr=Array('فروردین','اردیبهشت','خرداد','تیر','مرداد','شهریور','مهر','آبان','آذر','دی','بهمن','اسفند')
    // $(bd).html(function () {
    //     for(let i=1;i<=31;i++)
    //         $(SlcDay).append('<option value="'+i+'">'+i+'</option>')
    //     for(let i=0;i<=11;i++)
    //         $(SlcMonth).append('<option value="'+(i+1)+'">'+Arr[i]+'</option>')
    //     for(let i=1397;i<=1407;i++)
    //         $(SlcYear).append('<option value="'+i+'">'+i+'</option>')
    // })
    $(".verify_class").change(function(){
        // $("#verify_form").submit();
        BRJX({verify: $(".verify_class:checked").val()});
    })
    function BRJX(post)
    {
        $.post('BuyReportAjax.php', post, function(ex) {
            $("#buyReportAjax").html(ex);
            // alert(ex)
        })
    }
    BRJX({verify: $(".verify_class:checked").val()});
    $("#search").click(function() {
        BRJX({verify: $(".verify_class:checked").val(), like: $("#searchInput").val()})   
    });
</script>
<?php include '../Shared/Bottom.php'?>