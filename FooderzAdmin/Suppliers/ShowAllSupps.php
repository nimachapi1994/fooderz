<link type="text/css" rel="stylesheet" href="../Css/bootstrap.css">
<script type="text/javascript" src="../Js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="../Js/bootstrap.js"></script>

<?php include "../Shared/Top.php"?>
<?php
include "../../DataBase/PDO/DBconnect/DBconnect.php";

date_default_timezone_set('Asia/Tehran');
include_once '../../jdf/jdf.php';

if (isset($_GET["insert"]))
{
    {
        try {

            $suspendValue = ($_GET["suspend"] == 1) ? 0 : 1;
            $rowid        = $_GET["rowid"];
            $query        = "UPDATE suppliers set suspend=:sus where id =:id ";
            $stmt1        = $db->prepare($query);
            $arr1         = array(":sus" => $suspendValue, ":id" => $rowid);
            $stmt1->execute($arr1);

        }
        catch (Exception $ex)
        {
            $err = $ex->getMessage();
        }

    }

}
//if(isset($_GET["insert0"]))
//{
//    if(!empty($_GET["suspend1"]))
//
//    {
//        $suspendId=$_GET["suspend1"];
//
//        $querySuspend=mysqli_query($conn,"UPDATE suppliers set suspend=0 where id ='$suspendId' ");
//
//
//    }
//
//}

?>


<div class="container  text-center">
    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12 container text-center"style="padding-left: 6%">
            <h3 class="text-center" style="font-family: Tahoma;padding-right: 8%"><span style="color: blue">لیست </span>عمده فروش ها(مرکز پخش)</h3>
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
                    <form action="SuppSearched.php" method="post" >
                        <input name="search" size="70" class="form-control a b" placeholder="جستجو بر اساس نام و نام خانوادگی یا شماره موبایل ..."style="font-family:Tahama;">
                        <button name="btnsrch" class="btn btn-primary">
                            <img src="../image/1Search1.png"style="width: 30px;height: 30px;">
                        </button>
                    </form>


                    <br>
                </div>
                <hr>
<center style="padding-left: 2%">


    <table class="table table-bordered table-responsive" dir="rtl"style="text-align:center;width: 60%">

        <tr style="text-align:right">
            <th style="text-align:right">نام و نام خانوادگی</th>

            <th style="text-align:right"> موبایل اول</th>
            <th style="text-align:right"> موبایل دوم</th>
            <th style="text-align:right">تلفن ثابت</th>
            <th style="text-align:right">نوع فروش</th>
            <th style="text-align:right">تاریخ شروع فعالیت</th>
            <th style="text-align:right">تاریخ پایان فعالیت</th>
            <th style="text-align:right">لوگو</th>

            <th style="text-align:right"id="suspend">
           معلق
            </th>
            <th style="text-align:right">ویرایش</th>
            <th style="text-align:right"id="suspend">
                قرارداد
            </th>

        </tr>
        <?php

try {
    include "../../DataBase/PDO/DBconnect/DBconnect.php";
    $sqlGetPost = "SELECT `id`, `nameAndfname`, `mobile1`, `mobile2`, `telephone`, `orderType`, `logo`, `imagegalley`, `decription`, `contractImg`, `startdate`, `expdate`, `suspend` FROM `suppliers` ORDER by id DESC";
    $stmt       = $db->prepare($sqlGetPost);
    $stmt->execute();
}
catch (Exception $ex)
{
    $err = $ex->getMessage();
}

while ($Tolist = $stmt->fetch())
{

    ?>
        <tr>
            <script>

            </script>
            <td><?php echo $Tolist["nameAndfname"] ?></td>

            <td><?php echo $Tolist["mobile1"] ?></td>
            <td><?php echo $Tolist["mobile2"] ?></td>
            <td><?php echo $Tolist["telephone"] ?></td>
            <td><?php echo $Tolist["orderType"] ?></td>

            <td><?php
$okdate = '';
    if ($Tolist["startdate"] != "0000,00,00")
    {
        $date   = strtotime($Tolist["startdate"]);
        $year   = date("Y", $date);
        $month  = date("m", $date);
        $day    = date("d", $date);
        $okdate = gregorian_to_jalali($year, $month, $day, "/");

    }

    echo $okdate;?></td>
            <td><?php
$okdate = '';
    if ($Tolist["expdate"] != "0000,00,00")
    {
        $date   = strtotime($Tolist["expdate"]);
        $year   = date("Y", $date);
        $month  = date("m", $date);
        $day    = date("d", $date);
        $okdate = gregorian_to_jalali($year, $month, $day, "/");
    }

    echo $okdate;?></td>
            <td><img src="<?php echo $Tolist["logo"] ?>" style="width: 70px;height: 70px"></td>
<td>


    <form action="ShowAllSupps.php"method="get">
<input hidden name="rowid"value="<?php echo $Tolist["id"] ?>">
     <input hidden name="suspend" value="<?php echo $Tolist["suspend"] ?>">



        <?php
if ($Tolist["suspend"] == 0)
    {
        echo '  <button name="insert" class="btn btn-primary btn-sm">
            <img src="../image/start.png"width="25" height="25" >
            فعال کردن</button>  ';

    }
    else
    {
        echo '   <button name="insert" class="btn btn-warning btn-sm">
      <img src="../image/stop.jpg"width="25" height="25">   معلق کردن
   </button>';
    }

    ?>
    </form>

</td>
            <td>
                <form action="update.php"method="get">

                    <input hidden="hidden" name="goid" value="<?php echo $Tolist["id"] ?>">
                    <button name="updatesupp"  class="btn btn-default btn-xs">
                        <img src="../image/edite.png"style="width: 40px;height: 49px;">
                    </button>
                </form>

            </td>
            <td>



                    <a target="_blank" href="<?php echo $Tolist["contractImg"] ?>" class="btn btn-primary">دانلود</a>

            </td>

        </tr>
        <?php
}
?>
    </table>
</center>
            </div>

        </div>

    </div>
<style>
    .a{
        color: #5729ff;
    }
</style>










</div>




<?php include "../Shared/Bottom.php"?>
