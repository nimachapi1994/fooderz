<?php
require_once '../../DataBase/PDO/DBconnect/DBconnect.php';



if(isset($_POST["pch_id"]))
{
//    echo $_POST["pch_id"];

    try {


        $query = 'SELECT `items`,`sum` FROM `purchasecart` WHERE pch_ID=:pch_ID ';

        $itemsPurchase = $db->prepare($query);
        $arrCustomer = [":pch_ID" => $_POST["pch_id"]];
        $itemsPurchase->execute($arrCustomer);
        $errinfo = $itemsPurchase->errorInfo();


    } catch (Exception $ex) {
        $err = $ex->getMessage();
    }

}


?>



<div class="modal-dialog"style="margin: auto">
    <div class="row">

        <div class="modal-content text-center"style="width: 80%;margin: auto">
            <div class="modal-body">
                <div class="container text-center" >
                    <h3 class="text-center" style="font-family: Tahoma">لیست خرید</h3>
                    <br>




                    <table class="table-bordered table-responsive table-striped"style="width: 100%">
                        <tr>
                            <th style="text-align: center">اسم غذا </th>
                            <th style="text-align: center">تعداد</th>
                            <th style="text-align: center">قیمت </th>


                        </tr>
                        <?php

                        $rcrd  = $itemsPurchase->fetch();
                        $list   = json_decode($rcrd['items'], 1);

                        foreach ($list as $v)
                        {

//var_dump($rcrd);
                        ?>

                        <tr>
                            <td style="text-align: center"> <?php echo $v["name"]?> </td>
                            <td style="text-align: center"> <?php echo $v["count"]?>  </td>
                            <td style="text-align: center"> <?php echo $v["price"]?> </td>

                        </tr>
                        <?php


                        }
                        ?>
                        <hr>


                    </table>

                </div>
                <hr>
                <br>
                <div style="border: 1cm;color: #1d75b3"><label>مجموع سبد خرید: <span><?php echo $rcrd["sum"]?></span></label></div>
            </div>


        </div>


    </div>
</div></div>