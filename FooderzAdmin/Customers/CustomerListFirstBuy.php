<?php include('../Shared/Top.php')  ?>

    <link type="text/css" rel="stylesheet" href="../Css/bootstrap.css">
    <script type="text/javascript" src="../Js/jquery-1.10.2.js"></script>
    <script type="text/javascript" src="../Js/bootstrap.js"></script>


    <div id="div1">

</div>
<?php
include_once '../../jdf/jdf.php';


include "../../DataBase/PDO/DBconnect/DBconnect.php";
try
{


    $query='select cus_ID, fname,lname, phone from customers where firstBuyCall=:firstBuyCall order by cus_ID';
    $stmt=$db->prepare($query);
    $arrCustomer=[":firstBuyCall"=>0];
    $stmt->execute($arrCustomer);
    $errinfo=$stmt->errorInfo();


}catch (Exception $ex)
{
    $err=$ex->getMessage();
}

?>
<script>
    document.onload=function () {
        for(int i=0;i<=4;i++)
            div1.innerHTML +='<br>'
    }
</script>

<div class="container  text-center">
    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12 container text-center"style="padding-left: 9%">
            <h3 class="text-center" style="font-family: Tahoma;padding-right: 8%"><span style="color: blue">لیست </span>اولین سفارش مشتریان</h3>
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
                    <input size="70" class="form-control a b" placeholder="جستجو بر اساس نام و نام خانوادگی یا شماره موبایل ..."style="font-family:Tahama;"><button class="btn btn-primary">        <a href="" style="float: left"><img src="../image/1Search1.png"style="width: 30px;height: 30px;"></a></button>

                    <br>
                </div>
            <hr>

        </div>

    </div>

</div>








<div class="container text-center">
    <table class="table table-bordered table-responsiv" dir="rtl"style="text-align:right;width: 60%;margin: auto">
        <tr style="text-align:right">

            <th style="text-align:right">نام</th>
            <th style="text-align:right">نام خانوادگی</th>


            <th style="text-align:right">تلفن همراه</th>

            <th style="text-align:right">شهر</th>
            <th style="text-align:right;color: #0c88e0;font-family: Tahoma"id="TitleIsCalled">تماس</th>


        </tr>
        <?php
           if(isset($_POST["called"]))
           {
               try
               {
                   $id=$_POST["cus_id"];
                   $query='update Customers set firstBuyCall =:val where cus_ID= :id';
                   $stmtw=$db->prepare($query);
                   $arrTakeGiftCustomer=[":val"=>1,":id"=>$id];
                   $stmtw->execute($arrTakeGiftCustomer);
                   $stmtw->errorInfo();
                   echo '<meta http-equiv="refresh" content="0;url=CustomerListFirstBuy.php">';
               }

               catch (Exception $ex)
               {
                   $err=
                       $ex->getMessage();
               }

           }
        ?>
        <?php
        while ($tolist=$stmt->fetch())
        {


        ?>
        <tr>


            <td><?php echo $tolist["lname"]?></td>
            <td><?php echo $tolist["fname"]?></td>

            <td><?php echo $tolist["phone"]?></td>
            <td>شیراز</td>


<td><form action="CustomerListFirstBuy.php"method="post">
        <input hidden="hidden" id="cus_id" name="cus_id" value="<?php echo $tolist["cus_ID"]?>" >
        <input name="called" type="submit" style="color: white;border-width: medium;background-color: #0c88e0" class="btn  btn-xs"value="تماس گرفته شد" id="txtChbIsCalled"/>

    </form>

</td>
<?php
}
 ?>

        </tr>
    </table>
</div>
    <script>
        $(document).ready(function () {
            TitleIsCalled.innerHTML="تماس";
        })
        $(txtChbIsCalled).change(function () {
            if(txtChbIsCalled.checked===true)
            {
                TitleIsCalled.innerHTML="تماس گرفته شده";
                TitleIsCalled.style.color='green';


            }else
            {
                TitleIsCalled.innerHTML="تماس";
                TitleIsCalled.style.color='orangered';

            }


        })
    </script>

<?php include('../Shared/Bottom.php') ?>