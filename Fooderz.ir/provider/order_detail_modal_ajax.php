<?php
require_once '../../DataBase/PDO/DBconnect/DBconnect.php';
try
{
    $sql = "SELECT purchasecart.pch_ID, concat(customers.fname,' ', customers.lname) fullname, customers.phone, purchasecart.sum, purchasecart.date1,purchasecart.address,purchasecart.description, purchasecart.items
            FROM customers
            INNER JOIN purchasecart ON customers.cus_ID = purchasecart.cus_ID
            INNER JOIN provider ON provider.prv_ID = purchasecart.prv_ID WHERE purchasecart.pch_ID=:pch_ID";
    $stmt    = $db->prepare($sql);
    $bindArr = array
        (
        ":pch_ID" => $_POST['pch_ID'],
    );
    $stmt->execute($bindArr);
    $row     = $stmt->fetch();
    $errInfo = $stmt->errorInfo();

}
catch (Exception $e)
{
    $err = $e->getMessage();
}
?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
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
                                <th>نام غذا</th>
                                <th>تعداد</th>
                                <th>مبلغ (تومان)</th>
                                <th>سود شما (تومان)</th>
                            </tr>
                            <?php 
                            $details = json_decode($row['items'],1);
                            $i=0;
                                foreach ($details as $v) {
                                    $i++;
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $i; ?></td>
                                <td class="text-center"><?php echo $v['name'] ?></td>
                                <td class="text-center"><?php echo $v['count'] ?></td>
                                <td class="text-center"><?php echo number_format($v['price']*$v['count']) ?></td>
                                <td class="text-center"><?php echo number_format($v['price']*$v['count']*0.85) ?></td>
                            </tr>
<?php } ?>
                            <!-- table footer (do not remove)-->
                            <tr>
                                <th>مبلغ کل</th>
                                <td>-</td>
                                <td>-</td>
                                <th class="green_colored"><?php echo number_format($row['sum']) ?></th>
                                <td>-</td>
                            </tr>
                            <tr>
                                <th>جمع کل سود</th>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <th class="green_colored"><?php echo number_format($row['sum']*0.85) ?></th>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-6">
                        <h5 class="tomato">مشخصات مشتری</h5>
                        <table class="report-table">
                            <tr>
                                <th>نام</th>
                                <td><?php echo $row['fullname']; ?></td>
                            </tr>
                            <tr>
                                <th>شماره تماس</th>
                                <td><?php echo $row['phone'] ?></td>
                            </tr>                                
                            <tr>
                                <th>آدرس</th>
                                <td><?php $a=explode('|', trim($row['address'],"'")); echo end($a) ?></td>
                            </tr>
                            <tr>
                                <th>توضیحات</th>
                                <td><?php echo $row['description']?></td>
                            </tr>
                        </table>
                        <div class="text-center">
                            <form action=""  method="post">
                                <input type="text" name="pch_ID" value="<?php echo $_POST['pch_ID'] ?>" hidden>
                                <button id="send" name="send" value="ok">
                                    تایید
                                </button>
                                <button id="cantSend" name="send" value="no">
                                    رد
                                </button>                                
                            </form>
<!--                         <label>
                            <input type="radio" value="send" id="send" name="confirm"><span>send</span>
                        </label>
                        <label>
                            <input type="radio" value="cantSend" id="cantSend" name="confirm">cant send                            
                        </label>
 -->                        
                        </div>
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
    <script>
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
    </script>
        <!-- hidden factor for restaurant printing -->
        <div class="factor" id="factor" style="border: solid 1px #000;padding: 20px;text-align: right;display: none">
            <div style="margin-bottom: 30px;text-align: center">
                <img src="../images/logo.png" alt="Fooderz" width="50px" style="position:relative; right:30px" />
                <h3 style="float: right">رستوران عطاویچ</h3>
                <!-- <p style="float: left">شماره تماس : ۰۷۱۳۵۶۷۸۹۶۴</p> -->
            </div>
            <h5 style="text-align: center">فاکتور شماره ۱۱۳۶</h5>
            <table style="width: 100%;border: dashed 1px #aaa;text-align: right;direction: rtl;border-bottom: none">
                <tr style="text-align: center;border-bottom: solid .5px #aaa">
                    <th style="padding: 10px;border-bottom: solid 1px #aaa">ردیف</th>
                    <th style="padding: 10px;border-bottom: solid 1px #aaa">نام سفارش</th>
                    <th style="padding: 10px;border-bottom: solid 1px #aaa">تعداد</th>
                    <th style="padding: 10px;border-bottom: solid 1px #aaa">مبلغ (تومان)</th>
                </tr>

                <?php 
                $i=0;
                foreach ($details as $v) {
                    $i++;
                ?>
                <tr style="text-align: center;border-bottom: dashed 1px #aaa">
                    <td style="padding: 10px;border-bottom: dashed 1px #aaa"><?php echo $i; ?></td>
                    <td style="padding: 10px;border-bottom: dashed 1px #aaa"><?php echo $v['name'] ?></td>
                    <td style="padding: 10px;border-bottom: dashed 1px #aaa"><?php echo $v['count'] ?></td>
                    <td style="padding: 10px;border-bottom: dashed 1px #aaa"><?php echo number_format($v['price']*$v['count']) ?></td>
                </tr>
            <?php } ?>

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
                    <td style="padding: 10px"><?php echo $row['fullname']; ?></td>
                    <td style="padding: 10px"><?php echo $row['phone'] ?></td>
                    <td style="padding: 10px"><?php $a=explode('|', trim($row['address'],"'")); echo end($a) ?></td>
                    <td style="padding: 10px"><?php echo $row['description']?></td>
                </tr>
            </table>

            <div style="border-top: dashed 1px #000;padding-top: 30px;text-align: center">
                <p style="float: right"><strong>نوع تسویه : </strong>آنلاین</p>
                <!-- <p style="float: left"><strong>نام پیک : </strong></p> -->
                <h3>جمع کل فاکتور : <?php echo number_format($row['sum']) ?> تومان</h3>
            </div>
            <hr />
            <div style="padding-top: 30px;text-align: center;height: 60px">
                <p style="float: right"><strong>کل سود شما از این فاکتور :  </strong> <?php echo number_format($row['sum']*0.85) ?> تومان</p>
                <p style="float: left;"><strong>Fooderz</strong></p>
            </div>
        </div>
        <!-- /hidden factor for restaurant printing -->