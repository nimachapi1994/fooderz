<link type="text/css" rel="stylesheet" href="../Css/bootstrap.css">
<script type="text/javascript" src="../Js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="../Js/bootstrap.js"></script>

<?php include "../Shared/Top.php"?>
<?php

$conn=mysqli_connect("localhost","root","","vmzonuak_fooderz1","3306");
mysqli_set_charset($conn,"uft8");
if(mysqli_connect_errno($conn)){
    die("");
}else  {
    echo "";
}
if(isset($_GET["insert1"]))
{
    if(!empty($_GET["suspend1"]))

    {
        $suspendId=$_GET["suspend1"];

        $querySuspend=mysqli_query($conn,"UPDATE suppliers set suspend=1 where id ='$suspendId' ");


    }

}
if(isset($_POST["showAll"]))
{
    echo '<meta http-equiv="refresh"  content="1;url:ShowAllSupps.php"/>';
}
if(isset($_GET["insert0"]))
{
    if(!empty($_GET["suspend1"]))

    {
        $suspendId=$_GET["suspend1"];

        $querySuspend=mysqli_query($conn,"UPDATE suppliers set suspend=0 where id ='$suspendId' ");


    }

}


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
                    <form action="ShowAllSupps.php"method="post">
                        <button name="showAll" class="btn btn-primary">مشاهده کل</button>
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

                        if(isset($_POST["btnsrch"]))
                        {
                            setcookie("m","1","5000");
                            if(!empty($_POST["search"]))
                            {
                                $serachedValue=$_POST["search"];
                                $sqlQuery=  mysqli_query($conn,"SELECT * from suppliers where nameAndfname like '%$serachedValue%' OR 
mobile1 like '%$serachedValue%' or mobile2 like '%$serachedValue%'
or telephone like '%$serachedValue%' or orderType like '%$serachedValue%' order by id desc ");
                                if($sqlQuery)
                                {
                                    while ($Tolist=mysqli_fetch_assoc($sqlQuery))
                                    {







                            ?>
                            <tr>

                                <td><?php echo $Tolist["nameAndfname"] ?></td>

                                <td><?php echo $Tolist["mobile1"] ?></td>
                                <td><?php echo $Tolist["mobile2"] ?></td>
                                <td><?php echo $Tolist["telephone"] ?></td>
                                <td><?php echo $Tolist["orderType"] ?></td>

                                <td><?php echo $Tolist["startdate"] ?></td>
                                <td><?php echo $Tolist["expdate"] ?></td>
                                <td><img src="<?php echo $Tolist["logo"] ?>" style="width: 70px;height: 70px"></td>
                                <td>

                                    <form action="ShowAllSupps.php"method="get">
                                        <input hidden name="suspend1"value="<?php echo $Tolist["id"] ?>">
                                        <?php
                                        if($Tolist["suspend"]==1)
                                        {
                                            echo '   <button name="insert0" class="btn btn-primary btn-sm">
   <img src="../image/start.png"width="25" height="25">
   فعال</button>';

                                        }else{
                                            echo '   <button name="insert1" class="btn btn-warning btn-sm">
      <img src="../image/stop.jpg"width="25" height="25">
   معلق
   </button>';
                                        }





                                        ?>
                                    </form>

                                </td>
                                <td>
                                    <form action="update.php"method="post">

                                        <input hidden="hidden" name="goid" value="<?php echo $Tolist["id"]?>">
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
                                }else{
                                    if(!$sqlQuery)
                                    echo "<tr><td>
<br><hr><p style='color:green;font-family: Tahoma'>هیچ موردی یافت نشد</p><hr><br>'

</td></tr>";
                                }
                            }
                            setcookie("m","1","-5000");
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
