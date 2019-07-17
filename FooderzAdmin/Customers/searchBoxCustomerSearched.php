<?php include('../Shared/Top.php') ?>

    <link type="text/css" rel="stylesheet" href="../Css/bootstrap.css">
    <script type="text/javascript" src="../Js/jquery-1.10.2.js"></script>
    <script type="text/javascript" src="../Js/bootstrap.js"></script>

<?php
include_once '../../jdf/jdf.php';


include "../../DataBase/PDO/DBconnect/DBconnect.php";

if(!empty(isset($_POST["searchbox"])))
{
    $search=$_POST["searchbox"];
    try
    {

        $query="SELECT `cus_ID`, `fname`, `lname`, `bornDate`, `phone`, `password`, `email`, `cardNum`, `location`, `address`, `city`, `credit`, `Gift`, `favorite_restaurants`, `firstBuyCall`, `SignupDate` FROM `customers` where fname like  '%$search%'OR   lname like '%$search%'OR phone like '%$search%' OR city like '%$search%'
OR email like '%$search%'order by SignupDate desc";
        $stmtReadAllCus=$db->prepare($query);

        $stmtReadAllCus->execute();
        $errinfo=$stmtReadAllCus->errorInfo();


    }catch (Exception $ex)
    {
        $err=$ex->getMessage();
    }

}

?>
    <div id="div1">

    </div>
    <script>
        document.onload=function () {
            for(int i=0;i<=4;i++)
            div1.innerHTML +='<br>'
        }
    </script>

    <div class="container  text-center">


        <h3 class="text-center" style="font-family: Tahoma;padding-right: 8%"><span style="color: blue">لیست </span>مشتریان</h3>
        <br>

        <div class="form-group" style="font-family: Tahoma;padding-right: 10%">
            <style>
                .b{
                    display: inline;
                    width: 60%;
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
            <div class="container text-center"style="margin: auto;width: 80%;font-family: Tahoma">
                <br>
                <form action="searchBoxCustomerSearched.php" method="post">
                    <input size="70" class="form-control a b" placeholder="جستجو بر اساس نام و نام خانوادگی, ایمیل, شهر یا شماره موبایل ..."style="font-family:Tahama;"name="searchbox"><button class="btn btn-primary">      <img src="../image/1Search1.png"style="width: 30px;height: 30px;"></button>

                </form>

                <br>
            </div>
            <hr></div>




        <?php



        echo '<p style="color:blue;font-family: Tahoma;font-size: large"> مجموع تعداد مشتریان: '. $stmtReadAllCus->rowCount().' '.'  نفر </p>';
        ?>
    </div>
    <div style="padding-right: 25%">
        <table class="table table-bordered table-responsive" dir="rtl"style="width: 70%">
            <tr style="text-align:right">
                <th style="text-align:right">نام</th>
                <th style="text-align:right">نام خانوادگی</th>
                <th style="text-align:right">تاریخ تولد</th>
                <th style="text-align:right">ایمیل</th>
                <th style="text-align:right">تلفن همراه</th>

                <!--                    <th style="text-align:right">شماره کارت</th>-->
                <th style="text-align:right">شهر</th>
                <!--                <th style="text-align:right">لوکیشن</th>-->
                <!---->
                <!--                <th style="text-align:right">اعتبار</th>-->
                <th style="text-align:right">خرید ها</th>
            </tr>
            <?php
            while ($row=$stmtReadAllCus->fetch()) {

                $id=$row["cus_ID"];
                ?>
                <tr>
                    <td><?php echo $row["fname"] ?></td>
                    <td><?php echo $row["lname"] ?></td>
                    <?php
                    $okdate = '';
                    if ($row["bornDate"] != "0000,00,00")
                    {
                        $date   = strtotime($row["bornDate"]);

                        $okdate = jdate("j F y",$date);

                    }
                    ?>
                    <td ><p style="padding-right: 5%"><?php echo $okdate ?></p></td>
                    <td><?php echo $row["email"] ?></td>
                    <td><?php echo $row["phone"] ?></td>
                    <td><?php echo $row["city"] ?></td>
                    <!--                    <td><button class="btn btn-success"id="btnShowModalLocations">لوکیشن ها<img src="../image/png-location-location-pin-icon-512.png" width="30" height="30"></button> </td>-->


                    <!--                    <td><button class="btn btn-success"id="btnShowModalCredits"><img src="../image/$.png" width="30" height="30">اعتبار</button> </td>-->
                    <td>
                        <button class="btn btn-success" onclick="showmodalbuy(<?php echo $id?>)" id="btnShowModalPurchases"><img src="../image/money.png"
                                                                                                                                 width="30" height="30">خریدها
                        </button>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
    <div class="modal fade" id="ModalShowCredits"role="dialog" >
        <div class="modal-dialog"style="width:70%">
            <div class="row">

                <div class="modal-content">

                    <div class="modal-body">
                        <h3 class="text-center" style="font-family: Tahoma"><span style="color:blue;">لیست</span> تراکنش و دریافت اعتبار ها</h3>


                        <div class="container text-center"style="margin: auto;width: 80%;font-family: Tahoma">
                            <br>
                            <input size="70" class="form-control a b" placeholder="جستجو"style="font-family:Tahama;"><button class="btn btn-primary">        <a href="" style="float: left"><img src="../image/1Search1.png"style="width: 30px;height: 30px;"></a></button>

                            <br>
                        </div>


                        <hr>
                        <div class="table-bordered table-responsive active">
                            <table class="table table-bordered table-responsive" style="font-family: Tahoma">
                                <tr >
                                    <th style="text-align: center">مبلغ</th>
                                    <th style="text-align: center">تاریخ</th>

                                    <th style="text-align: center">کد تراکنش</th>
                                    <th style="text-align: center">وضعیت</th>
                                    <th style="text-align: center">توضیحات</th>
                                </tr>
                                <tr >
                                    <td>100.000</td>
                                    <td>1397/8/10</td>
                                    <td>کد تراکنش</td>
                                    <td style="color: green">پرداخت شده</td>

                                    <td>پرداخت با موفقیت انجام شده</td>
                                </tr>



                            </table>


                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>

        $(btnShowModalCredits).click(function () {
            $(ModalShowCredits).modal('show');
        });

    </script>









    <div class="modal fade" id="ModalShowPurchases"role="dialog" >

    </div>
    <script>
        function  showmodalbuy(id)
        {

            $.post("List_Cus_Buys_Ajax.php",{ cus_ID: id},function (ex)
            {

                $(ModalShowPurchases).html(ex);

            });
            $(ModalShowPurchases).modal('show');
        }
    </script>



















    <div class="modal fade" id="ModalShowLocation"role="dialog" >
        <div class="modal-dialog"style="width:70%">
            <div class="row">

                <div class="modal-content">

                    <div class="modal-body">
                        <h3 class="text-center" style="font-family: Tahoma">لیست لوکیشن های کاربر</h3>
                        <br>
                        <div class="table-bordered table-responsive active">
                            btnShowModalLocations



                        </div>
                        <br>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
        $(btnShowModalLocations).click(function () {
            $(ModalShowLocation).modal('show');
        })
    </script>




<?php include('../Shared/Bottom.php') ?>