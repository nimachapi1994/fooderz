<?php
require_once '../../DataBase/PDO/DBconnect/DBconnect.php';
$cusid='';


 if(isset($_POST["cus_ID"]))
 {
     $cusid = $_POST["cus_ID"];
     try {


         $query = 'SELECT `pch_ID`, `cus_ID`, `prv_ID`, `description`, `sum`,
 `deliveryMan`, `date1`, `date2`, `latitude`, `longitude`, 
 `address`, `gate`, `authority`, `RefID`, `comment(satisfy, comment, dateTime)`,
  `rate`, `items`, `shake`, `pre-order`, `verify` FROM `purchasecart` WHERE cus_ID=:cus_ID order by  date1 desc ';
         $buycus = $db->prepare($query);
         $arrCustomer = [":cus_ID" => $cusid];
         $buycus->execute($arrCustomer);
         $errinfo = $buycus->errorInfo();


     } catch (Exception $ex) {
         $err = $ex->getMessage();
     }

 }


?>

<div class="modal-dialog" style="width:60%">


        <div class="modal-content text-center" style="margin: auto">
            <div class="modal-body">
                <div class="container text-center" style="padding-right: 0%">
                    <h3 class="text-center" style="font-family: Tahoma">لیست خرید ها</h3>

                    <hr>

                    <table class="table-bordered table-responsive table-striped"style="width: 160%">
                        <tr>
                            <td style="text-align: center">تاریخ</td>

                            <td style="text-align: center"> کد تراکنش</td>
                            <td style="text-align: center">فاکتور خرید</td>
                            <td style="text-align: center">فروشنده</td>
<!--                            <th style="text-align: center">کامنت ارسالی</th>-->
                            <td style="text-align: center">وضعیت سفارش</td>
                        </tr>
                        <?php
                        while ($row=$buycus->fetch())
                        {

                            ?>
                            <tr>
                                <?php
                                include_once '../../jdf/jdf.php';
                                $okdate = '';
                                if ($row["date1"] != "0000,00,00")
                                {
                                    $date   = strtotime($row["date1"]);
//                    $year   = jdate("Y", $date);
//                    $month  = jdate("m",$date);
//                    $day    = jdate("j", $date);
                                    $okdate = jdate("j F y",$date);

                                }
                                ?>
                                <td style="text-align: center"><?php echo $okdate ?></td>
                                <td style="text-align: center"> <?php echo $row["authority"]?></td>
                                <td style="text-align: center">
                                    <button class="btn btn-primary" onclick="openSeller(<?php echo $row["prv_ID"] ?>)"><img
                                            src="../image/provider.png" width="30" height="30">مشخصات
                                    </button>
                                </td>
                                <td style="text-align: center">
                                    <button class="btn btn-primary" onclick="openPurchaseCart(<?php echo $row["pch_ID"] ?>)"><img
                                            src="../image/black-shopping-cart_icon-icons.com_56198.png" width="30"
                                            height="30" >سبد خرید
                                    </button>
                                </td>
<!--                                <td style="text-align: center">-->
<!--                                    <div class="col-sm-12 col-xs-12 col-md-12 text-center"-->
<!--                                         style="font-family:Tahoma;font-size:large" dir="ltr">-->
<!--                                        <pre>ddddddddddddddddddddddddddddddddddfffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffdddd44ttttttttttttttttttttttttttttttttttttttttttt444444444444444444444444444444444444ddddddddddddddddddddddd</pre>-->
<!--                                    </div>-->
<!--                                </td>-->
                                <td style="text-align: center">
                                    <?php
                                    if($row["verify"]=='accepted_order')
                                        echo '<p style="color: green;font-family: Tahoma;font-size:medium">ارسال شده</p>';
                                    if($row["verify"]=='canceled_order')
                                        echo '<p style="color: red;font-family: Tahoma;font-size:medium">رد شده</p>';

                                    if($row["verify"]=='suspended_order')
                                        echo '<p style="color: orange;font-family: Tahoma;font-size:medium">معلق</p>';

                                    ?>
                                </td>
                            </tr>

                            <?php
                        }
                        ?>

                    </table>
                </div>


            </div>



        </div>

</div>

<div class="modal fade" id="ModalShowSeller"role="dialog" >
    <script>
        function  openSeller(id) {
            $.post('Show_OneSeller_Ajax.php',
                {
                    prv_id:id
                },function (ex)
                {
                   $(ModalShowSeller).html(ex);
                })
            $(ModalShowSeller).modal('show');
        }
    </script>
</div>

<div class="modal fade" id="ModalShowBasket"role="dialog" >

</div>
<script>
    function  openPurchaseCart(id) {

        $.post('Show_PurchaseCart_Ajax.php',
            {
                pch_id:id
            },function (ex)
            {


                 $(ModalShowBasket).html(ex);

            })
         $(ModalShowBasket).modal('show');
    }
</script>