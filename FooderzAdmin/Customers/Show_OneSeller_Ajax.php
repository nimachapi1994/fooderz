
<?php
require_once '../../DataBase/PDO/DBconnect/DBconnect.php';
if(isset($_POST["prv_id"]))
{
    $prvid='';



    $prvid = $_POST["prv_id"];
    try {


        $query = 'SELECT `prv_ID`, `telephone`, `managerName`, `providerName`,`mobile`,
  `address`FROM `provider` WHERE prv_ID=:prv_id';
        $providerInfo = $db->prepare($query);
        $arrCustomer = [":prv_id" => $prvid];
        $providerInfo->execute($arrCustomer);
        $errinfo = $providerInfo->errorInfo();


    } catch (Exception $ex) {
        $err = $ex->getMessage();
    }


}
?>









<div class="modal-dialog"style="width:80%;margin: auto">


        <div class="modal-content container text-center"style="margin: auto">
            <div class="modal-body" style="margin: auto">
                <div class="container container text-center" >
                    <h3 class="text-center" style="font-family: Tahoma">مشخصات فروشنده</h3>
                    <br>

                    <hr>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <table style="width: 100%" class="table-bordered table-striped table-responsive table-hovere container text-center">
                                <tr>
                                    <td style="text-align: center"> ارائه دهنده </td>
                                    <td style="text-align: center"> نام مدیریت </td>

                                    <td style="text-align: center"> شماره همراه  </td>
                                    <td style="text-align: center"> تلفن ثابت </td>
                                    <td style="text-align: center"> آدرس </td>


                                    <td style="text-align: center"> مشخصات کامل </td>

                                </tr>
                                <?php
                                while ($row=$providerInfo->fetch()) {


                                    ?>
                                    <tr>
                                        <td style="text-align: center"><?php echo $row["providerName"] ?></td>
                                        <td style="text-align: center"><?php echo $row["managerName"] ?></td>
                                        <td style="text-align: center"><?php echo $row["mobile"] ?></td>
                                        <td style="text-align: center"> <?php echo $row["telephone"] ?></td>

                                        <td style="text-align: center">
                                            <div class="col-sm-12 col-xs-12 col-md-12 text-center"
                                                 style="font-family:Tahoma;font-size:large" dir="ltr">
            <pre>       <?php echo $row["address"] ?>
  </pre>
                                        </td>

                                        <td>
                                            <form name="sb" id="sb" action="../../Fooderz.ir/menu.php" method="post" accept-charset="utf-8">
                                                <input type="text" name="prvID" value="<?php echo $row['prv_ID'] ?>" hidden="hidden" id=""><br>
                                                <button type="submit" class="btn btn-primary" id="tnShowModalSeller">بیشتر +</button>
                                            </form>

                                        </td>


                                    </tr>
                                    <?php
                                }
                                ?>
                            </table>  </div>
                    </div>
                    <div class="col-md-1"></div>
                </div>

            </div>


        </div>



</div>