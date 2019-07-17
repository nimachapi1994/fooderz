<?php include('../Shared/Top.php');
   include "../../DataBase/PDO/DBconnect/DBconnect.php";
    $query='SELECT * FROM contact_us ORDER BY date_Time DESC';
    $stmtq=$db->prepare($query);
    $stmtq->execute();

 ?>


    <link type="text/css" rel="stylesheet" href="../Css/bootstrap.css">
    <script type="text/javascript" src="../Js/jquery-1.10.2.js"></script>
    <script type="text/javascript" src="../Js/bootstrap.js"></script>
    <br>


    <div class="container text-center"style="padding-right: 6%">
        <h3 style="font-family: Tahoma"><span style="color:blue">لیست</span> پیام مشتریان به ادمین <span style="color:blue"></span></h3>
        <hr>
        <table  class="table table-responsive table-hover table-bordered" style="margin: auto;width: 90%">
            <tr>
           <th style="text-align: center">نام و نام خانوادگی</th>
               <th style="text-align: center">شماره تماس</th>

                <th style="text-align: center">ایمیل</th>
              
              

                <th style="text-align: center">متن</th>
                     <th style="text-align: center">تاریخ</th>
            </tr>
            <?php
            while($row=$stmtq->fetch())
            {


            ?>
            <tr>
          
                <td style="text-align: center"><?php echo $row["fullName"];   ?></td>
                <td style="text-align: center"><?php echo $row["phone"];   ?></td>
                <td style="text-align: center">ا<?php echo $row["email"];   ?></td>
                <td style="text-align: center">
                    <div class="col-sm-12 col-xs-12 col-md-12 text-center"style="font-family:Tahoma;font-size:small"dir="ltr">
                        <pre><?php echo $row["txt"];   ?></pre>
                    </div>
                </td>
      <td style="text-align: center"><?php
      date_default_timezone_set('Asia/Tehran');
include_once '../../jdf/jdf.php';
          $okdate='';
                if($row["date_Time"]!="0000,00,00")
                {
                    $date=strtotime($row["date_Time"]);
                    $year=date("Y",$date);
                    $month=date("m",$date);
                    $day=date("d",$date);
                    $okdate=gregorian_to_jalali($year,$month,$day,"/");


                }

             echo $okdate;
      ?></td>
            <tr>
            <?php } ?>
        </table>
    </div>

    <script>
        $(ckbConfirm).change(function () {
            if(ckbConfirm.checked===true){
                Confirm.innerHTML='تایید شده';
                Confirm.style.color='green';
            }
            else{
                Confirm.innerHTML='تایید';
                Confirm.style.color='black';
            }
        })

    </script>

<?php include('../Shared/Bottom.php') ?>