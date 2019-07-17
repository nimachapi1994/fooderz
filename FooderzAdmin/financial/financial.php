<?php include '../Shared/Top.php'?>
    <link type="text/css" rel="stylesheet" href="../Css/bootstrap.css">
    <script type="text/javascript" src="../Js/jquery-1.10.2.js"></script>
    <script type="text/javascript" src="../Js/bootstrap.js"></script>
<?php
date_default_timezone_set('Asia/Tehran');
try
{
    $now = date('Y-m-d');
    if (isset($_POST['srch'])) 
    {
        $like = "%".$_POST['srch']."%";        
    }
    $sql  = "SELECT deposite.ID, deposite.willBePaydate, deposite.income, provider.prv_ID, deposite.willBePaydate, provider.providerName, provider.managerName, provider.mobile, provider.telephone, provider.city, provider.address FROM deposite inner JOIN provider ON provider.prv_ID = deposite.prv_ID WHERE income='' AND t_action='' AND willBePaydate < '2018-12-11' AND provider.providerName like \"$like\";
 
             SELECT deposite.ID, deposite.willBePaydate, deposite.income, provider.prv_ID, deposite.willBePaydate, provider.providerName, provider.managerName, provider.mobile, provider.telephone, provider.city, provider.address FROM deposite inner JOIN provider ON provider.prv_ID = deposite.prv_ID WHERE income='' AND t_action='' AND provider.providerName like \"$like\";
 
             SELECT deposite.t_action, deposite.ID, deposite.willBePaydate, deposite.income, provider.prv_ID, deposite.willBePaydate, provider.providerName, provider.managerName, provider.mobile, provider.telephone, provider.city, provider.address FROM deposite inner JOIN provider ON provider.prv_ID = deposite.prv_ID WHERE deposite.income != 'START' AND deposite.income != '' AND provider.providerName like \"$like\"";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $rows1 = $stmt->fetchAll();
    $stmt->nextRowset();
    $rows2 = $stmt->fetchAll();
    $stmt->nextRowset();
    $rows3 = $stmt->fetchAll();
    $errInfo = $stmt->errorInfo();
    $stmt->closeCursor();
    // header("Location: BuyReport.php");
}
catch (Exception $e)
{
    $err = $e->getMessage();
}
// die($sql);
// echo 'jjjjjjjjjjjjjjj';
// var_dump($rows);
// die()
// var_dump($_POST);
// die();
?>
<script>
// alert(<php echo ($_POST['sub']) ?>);
    // alert('jjjjjjjj');
</script>
<body id="bd"></body>
    <style>
        .c{
            display: inline;
            width: 5%;
            font-family: Tahoma !important;
            padding: 6px 0px;

        }
        .b{
            display: inline;
            width: 40%;
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
    <div class="container text-center"style="margin: auto;width: 100%;font-family: Tahoma">
     <div style="padding-right: 5%">
         <h3 class="text-center" style="font-family: Tahoma"><span style="color: blue">لیست</span> گزارشات واریزی و درآمد ها </h3>
         <br>    <br>
         <form action="" method="post">
         <input size="30" name="srch" class="form-control a b" placeholder="جستجو بر اساس نام رستوران"style="font-family:Tahama;">

<!--          بر اساس
         <select class="form-control b">
             <option>نام و نام خانوادگی</option>
             <option>شماره موبایل</option>
             <option>اسم مغازه</option>
             <option>بیشترین دریافتی</option>
         </select>

         یا


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
         <button class="btn btn-primary" type="submit">        <a href="" style="float: left"><img src="../image/1Search1.png"style="width: 30px;height: 30px;"></a></button>
         </form>
         <br>
         <br><hr><br>
         <b style="color: mediumblue">مجموع درآمد :</b> <span style="font-size: medium;padding-left: 10%;color: mediumblue">3.000.000.000</span>
         <b style="color: mediumblue">مجموع واریزی :</b> <span style="font-size: medium;color:mediumblue">15.000.000.000</span>
         <hr><br>
         <table class="table-bordered table-striped table-responsive table-hover container text-center">
             <tr>
                 <th style="text-align: center"> نام رستوران </th>

                 <th style="text-align: center"> مدیر </th>
                 <th style="text-align: center">شهر </th>

                 <th style="text-align: center"> شماره همراه  </th>
                 <th style="text-align: center"> تلفن ثابت </th>
                 <th style="text-align: center"> مبلغ تسویه </th>
                 <th style="text-align: center"> شماره تراکنش </th>
                 <th style="text-align: center"> وضعیت </th>

             </tr>             
                <?php
                // for($i=0; $i<3; $i++)
                // {
                // if ($i!=0)
                // {
                     // $stmt->nextRowset();
                // } 
                     // echo '<hr>'.$i;
                echo "<tr><td colspan='8'>لیست تسویه</td></tr>";
                foreach ($rows1 as $row)
                    {
                        // print_r($row['prv_ID']);
                        // die();
                        try
                        {
                            $sql2  = "SELECT sum(sum) as prchSum FROM purchasecart WHERE prv_ID=" . $row['prv_ID'] . " AND deposite_ID=0 AND date1 < '$now'";
                            $stmt2 = $db->prepare($sql2);
                            $stmt2->execute();
                            $rcnt = $stmt2->rowCount();
                            // echo $sql2;
                            // var_dump($rcnt);
                            // die();
                            $sum       = $stmt2->fetch()['prchSum'];
                            // var_dump($stmt2->fetch()['prchSum']);
                            // die();
                            // echo $sum;
                            // $i=1;
                            // echo " n ".$i++;
                        if ($sum === NULL) 
                        {
                            // echo "jjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj";
                            continue;
                        }
                            $sumFormat = number_format($sum);
                            $errInfo2 = $stmt2->errorInfo();
                        }
                        catch (Exception $e2)
                        {
                            $err2 = $e2->getMessage();
                            var_dump($err2);
                            // die();
                        }

    ?>
             <tr>
                 <td style="text-align: center">
                <form name="sb" id="sb" action="../../Fooderz.ir/menu.php" method="post" accept-charset="utf-8">
                <input type="text" name="prvID" value="<?php echo $row['prv_ID'] ?>" hidden id="">
                <button type="submit" class="btn btn-xs btn-primary" id="">
                <img src="../image/provider.png" width="30" height="30"><?php echo $row['providerName'] ?></button>
                </form></td>
                 <form  action="financial_update.php" method="post" >
                 <td style="text-align: center"><?php echo $row['managerName'] ?></td>
                 <td style="text-align: center"><?php echo $row['city'] ?></td>
                 <td style="text-align: center"><?php echo $row['mobile'] ?></td>
                 <td style="text-align: center"><?php echo $row['telephone'] ?></td>
                 <td style="text-align: center"><?php echo $sum ?></td>
<!--
                     <div class="col-sm-12 col-xs-12 col-md-12 text-center"style="font-family:Tahoma;font-size:large"dir="ltr">
            <pre>          شیراز بلوار سستارخان فست فود شاورما
  </pre>
                  -->
                 <td style="text-align: center">
                    <input type="text" name="auth" id="">
                    <input type="text" name="prv_ID" value="<?php echo $row['prv_ID'] ?>" hidden id="">
                    <input type="text" name="income" value="<?php echo $sum ?>" hidden id="">
                    <input type="text" name="ID" value="<?php echo $row['ID'] ?>" hidden id="">
                 </td>
                 <td><button type="submit" name="sub" class="btn btn-primary" id="btnShowModalhhhhhhh">تایید</button> </td>
                </form>
             </tr>
                <?php }
                  // echo "<tr><td>$i</td></tr>";  }
                ?>
                

                <!-- // table two 2 -->


                    <?php
                    echo "<tr><td colspan='8'>ارایه دهندگان در صف تسویه</td></tr>";
                    foreach ($rows2 as $row)
                    {
                        // print_r($row['prv_ID']);
                        // die();
                        try
                        {
                            $sql2  = "SELECT sum(sum) as prchSum FROM purchasecart WHERE prv_ID=" . $row['prv_ID'] . " AND deposite_ID=0 AND date1 < '$now'";
                            $stmt2 = $db->prepare($sql2);
                            $stmt2->execute();
                            $rcnt = $stmt2->rowCount();
                            // echo $sql2;
                            // var_dump($rcnt);
                            // die();
                            $sum       = $stmt2->fetch()['prchSum'];
                            // var_dump($stmt2->fetch()['prchSum']);
                            // die();
                            // echo $sum;
                            // $i=1;
                            // echo " n ".$i++;
                        if ($sum === NULL) 
                        {
                            // echo "jjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj";
                            continue;
                        }
                            $sumFormat = number_format($sum);
                            $errInfo2 = $stmt2->errorInfo();
                        }
                        catch (Exception $e2)
                        {
                            $err2 = $e2->getMessage();
                            var_dump($err2);
                            // die();
                        }

    ?>
             <tr>
                 <td style="text-align: center">
                <form name="sb" id="sb" action="../../Fooderz.ir/menu.php" method="post" accept-charset="utf-8">
                <input type="text" name="prvID" value="<?php echo $row['prv_ID'] ?>" hidden id="">
                <button type="submit" class="btn btn-xs btn-primary" id="">
                <img src="../image/provider.png" width="30" height="30"><?php echo $row['providerName'] ?></button>
                </form></td>
                 <form  action="financial_update.php" method="post" >
                 <td style="text-align: center"><?php echo $row['managerName'] ?></td>
                 <td style="text-align: center"><?php echo $row['city'] ?></td>
                 <td style="text-align: center"><?php echo $row['mobile'] ?></td>
                 <td style="text-align: center"><?php echo $row['telephone'] ?></td>
                 <td style="text-align: center"><?php echo $sum ?></td>
<!--
                     <div class="col-sm-12 col-xs-12 col-md-12 text-center"style="font-family:Tahoma;font-size:large"dir="ltr">
            <pre>          شیراز بلوار سستارخان فست فود شاورما
  </pre>
                  -->
                 <td style="text-align: center">
                    <input type="text" name="auth" id="">
                    <input type="text" name="prv_ID" value="<?php echo $row['prv_ID'] ?>" hidden id="">
                    <input type="text" name="income" value="<?php echo $sum ?>" hidden id="">
                    <input type="text" name="ID" value="<?php echo $row['ID'] ?>" hidden id="">
                 </td>
                 <td><button type="submit" name="sub" class="btn btn-primary" id="btnShowModalhhhhhhh">تایید</button> </td>
                </form>
             </tr>
                <?php }
                  // echo "<tr><td>$i</td></tr>";  }
                ?>
                

                <!-- // table 3 -->


                
                    <?php
                    echo "<tr><td colspan='8'>لیست تسویه شده ها</td></tr>";
                    foreach ($rows3 as $row)
                    {
                        // print_r($row['prv_ID']);
                        // die();
                        try
                        {
                            $sql2  = "SELECT sum(sum) as prchSum FROM purchasecart WHERE prv_ID=" . $row['prv_ID'];
                            $stmt2 = $db->prepare($sql2);
                            $stmt2->execute();
                            $rcnt = $stmt2->rowCount();
                            // echo $sql2;
                            // var_dump($rcnt);
                            // die();
                            $sum       = $stmt2->fetch()['prchSum'];
                            // var_dump($stmt2->fetch()['prchSum']);
                            // die();
                            // echo $sum;
                            // $i=1;
                            // echo " n ".$i++;
                            if ($sum === NULL) 
                            {
                                // echo "jjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj";
                                continue;
                            }
                            $sumFormat = number_format($sum);
                            $errInfo2 = $stmt2->errorInfo();
                        }
                        catch (Exception $e2)
                        {
                            $err2 = $e2->getMessage();
                            var_dump($err2);
                            // die();
                        }

    ?>
             <tr>
                 <td style="text-align: center">
                <form name="sb" id="sb" action="../../Fooderz.ir/menu.php" method="post" accept-charset="utf-8">
                <input type="text" name="prvID" value="<?php echo $row['prv_ID'] ?>" hidden id="">
                <button type="submit" class="btn btn-xs btn-primary" id="">
                <img src="../image/provider.png" width="30" height="30"><?php echo $row['providerName'] ?></button>
                </form></td>
                 <form  action="financial_update.php" method="post" >
                 <td style="text-align: center"><?php echo $row['managerName'] ?></td>
                 <td style="text-align: center"><?php echo $row['city'] ?></td>
                 <td style="text-align: center"><?php echo $row['mobile'] ?></td>
                 <td style="text-align: center"><?php echo $row['telephone'] ?></td>
                 <td style="text-align: center"><?php echo $sum ?></td>
<!--
                     <div class="col-sm-12 col-xs-12 col-md-12 text-center"style="font-family:Tahoma;font-size:large"dir="ltr">
            <pre>          شیراز بلوار سستارخان فست فود شاورما
  </pre>
                  -->
                 <td style="text-align: center">
                    <?php echo $row['t_action'] ?>
                 </td>
                <input type="text" name="prv_ID" value="<?php echo $row['prv_ID'] ?>" hidden id="">
                <input type="text" name="income" value="<?php echo $sum ?>" hidden id="">
                <input type="text" name="ID" value="<?php echo $row['ID'] ?>" hidden id="">
                 <td>
                    <button type="button" class="btn btn-primary" id="btnShowModalhhhhhhh">تایید شده</button> 
                </td>
                </form>
             </tr>
                <?php }
                  // echo "<tr><td>$i</td></tr>";  }
                ?>
         </table>
     </div>

    </div>


<div class="modal fade"id="modal" role="dialog">
    <div class="modal-dialog" style="width: 70%">
        <div class="modal-content">
            <div class="modal-body container text-center">
                <div >
                    <h4 style="font-family: Tahoma">نام رستوران : <span>شاورما</span></h4>
<br>
                    <br>
                    <b style="color: mediumblue">مجموع درآمد :</b> <span style="font-size: medium;padding-left: 10%;color: mediumblue">3.000.000.000</span>
                    <b style="color: mediumblue">مجموع واریزی :</b> <span style="font-size: medium;color:mediumblue">15.000.000.000</span>
                    <hr><br>
                    <table class="table-bordered table-striped table-responsive table-hover container text-center">
                        <tr>
                            <th style="text-align: center">تاریخ و ساعت  </th>
                            <th style="text-align: center" > مبلغ </th>
                            <th style="text-align: center">  کد تراکنش </th>
                        </tr>
                        <tr style="font-size: medium">

                            <td style="text-align: center"><div style="padding-left: 1cm;padding-right: 1cm">1397/9/3 24:01</div>  </td>
                            <td style="text-align: center"> <div style="padding-left: 1cm;padding-right: 1cm">3.000.000</div> </td>
                            <td style="text-align: center"> <div style="padding-left: 4cm;padding-right: 4cm">000000000000000000000000000078812103 </div></td>
                        </tr>
                    </table>  </div>

            </div>

        </div>
        </div>
    </div>
</div>



    <script>
        let Arr=Array('فروردین','اردیبهشت','خرداد','تیر','مرداد','شهریور','مهر','آبان','آذر','دی','بهمن','اسفند')

        $(bd).html(function () {
            for(let i=1;i<=31;i++)
                $(SlcDay).append('<option value="'+i+'">'+i+'</option>')
            for(let i=0;i<=11;i++)
                $(SlcMonth).append('<option value="'+(i+1)+'">'+Arr[i]+'</option>')
            for(let i=1397;i<=1405;i++)
                $(SlcYear).append('<option value="'+i+'">'+i+'</option>')
        })
    </script>

<script>
    $(btnShowModal).click(function () {
        $(modal).modal();
    })
</script>

<?php include '../Shared/Bottom.php'?>