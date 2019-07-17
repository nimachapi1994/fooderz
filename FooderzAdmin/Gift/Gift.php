<link type="text/css" rel="stylesheet" href="../Css/bootstrap.css">
<script type="text/javascript" src="../Js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="../Js/bootstrap.js"></script>
<?php
include '../Shared/Top.php';

date_default_timezone_set('Asia/Tehran');
include_once '../../jdf/jdf.php';


include "../../DataBase/PDO/DBconnect/DBconnect.php";
$dateNow=date('m-d');

try
{


    $query='select * from customers where Gift=:val;select * from provider where Gift=:val';
    $stmt=$db->prepare($query);
    $arrCustomer=[":val"=>0];
    $stmt->execute($arrCustomer);
    $errinfo=$stmt->errorInfo();

}catch (Exception $ex)
{
  $err=$ex->getMessage();
}
?>
<body id="bd"></body>
<br>
<h3 class="text-center" style="font-family: Tahoma;padding-right: 6%;color: blue;"><span style="color: blue"><img width="100"height="100" src="../image/present.jpg"> </span>هدیه</h3>

<div class="container text-center">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3 container text-center">

        </div>
        <div class="col-md-3"></div>
    </div>
</div>

<div class="container text-center">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-2"style="padding-right: 20%">
<button class="btn btn-default"style="font-size: large;border-radius: 10px" id="OpenProviders">ارائه دهندگان</button>

        </div>
    <div class="col-md-2"style="padding-right: 5%">


    <button class="btn btn-default"style="font-size: large;border-radius: 10px" id="OpenCustomers">مشتریان</button>

    </div>
        <div class="col-md-5"></div>
    </div>
</div>


<hr>

<div class="container text-center"id="Customers">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8"style="padding-right: 1%;overflow: scroll;height: 66%">


            <span style="color: blue;font-family: Tahoma;font-size: large;color:;"id="cusCount">     </span>

            <br><br>
           <table class="table table-bordered tabler table-hover">
               <tr>
                   <th style="font-size: small;text-align: center">نام</th>
                   <th style="font-size: small;text-align: center">تاریخ تولد</th>
                   <th style="font-size: small;text-align: center">شماره تماس</th>
                   <th style="font-size: small;text-align: center">آدرس</th>
                   <th style="font-size: small;text-align: center"id="NoDelivery">ارسال </th>

               </tr>
               <?php
               $cusCount=0;
              while($row = $stmt->fetch()) {
                  if (substr($row["bornDate"], -5) == $dateNow) {
                      $cusCount++;

                      ?>
                      <tr>
                          <td id="cus_name"><?php echo $row["fname"] . ' ' . $row["lname"] ?></td>

                          <td id="cus_date"><?php

                              $PersianDate = '';
                              if ($row["bornDate"] != "0000,00,00") {
                                  $date = strtotime($row["bornDate"]);
                                  $PersianDate = gregorian_to_jalali(date("Y", $date), date("m", $date), date("d", $date), "-");

                              }
                              echo $PersianDate;
                              ?></td>
                          <td id="cus_phone"><?php echo $row["phone"] ?></td>
                          <td style="text-align: center">
                              <div class="col-sm-12 col-xs-12 col-md-12 text-center"
                                   style="font-family:Tahoma;font-size:large" dir="ltr">
            <pre id="cus_address"><?php
                echo $row["address"]
                ?>
  </pre>
                          </td>
                          <td id="">
                              <!--                         z-->
                              <span id="cus_delivery"></span><br>
                              <div style="padding-right: 30%"><input size="20" value="<?php echo $row["cus_ID"] ?>"
                                                                     style="padding: 3%" type="checkbox"
                                                                     id="chkBoxDelivery"></div>
                          </td>
                      </tr>

                      </tr>
                      <?php
                  }
              }
               ?>
           </table>
        </div>

        <div class="col-md-2"></div>
    </div>
</div>

<div class="container text-center"id="Providers">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8"style="padding-right: 1%;overflow: scroll;height: 66%">


            <span style="color: blue;font-family: Tahoma;font-size: large;color:;"id="prvCount">
</span>

            <br><br>
            <table class="table table-bordered tabler table-hover">
                <tr>
                    <th style="font-size: small;text-align: center">نام</th>
                    <th style="font-size: small;text-align: center">تاریخ تولد</th>
                    <th style="font-size: small;text-align: center">شماره تماس</th>
                    <th style="font-size: small;text-align: center">آدرس</th>
                    <th style="font-size: small;text-align: center"id="NoDelivery">ارسال </th>

                </tr>
                <?php
                $stmt->nextRowset();
                $prvCount=0;

                while($row1=$stmt->fetch())
                {
                    if(substr($row1["bornDate"],-5)==$dateNow) {
                        $prvCount++;
                        ?>
                        <tr>
                            <td>
                                <span id="prv_name"> <?php echo $row1["managerName"] . ' _' . $row1["providerName"] ?></span>
                            </td>

                            <td id="cus_date"><?php
                                $PersianDate1 = '';
                                if ($row1["bornDate"] != "0000,00,00") {
                                    $date1 = strtotime($row1["bornDate"]);
                                    $PersianDate1 = gregorian_to_jalali(date("Y", $date1), date("m", $date1), date("d", $date1), "-");

                                }
                                echo $PersianDate1;
                                ?></td>
                            <td id="cus_phone"><?php echo $row1["mobile"] ?></td>
                            <td style="text-align: center">
                                <div class="col-sm-12 col-xs-12 col-md-12 text-center"
                                     style="font-family:Tahoma;font-size:large" dir="ltr">
            <pre id="cus_address"><?php
                echo $row1["address"]
                ?>
  </pre>
                            </td>
                            <td id="">
                                <!--                         z-->
                                <span id="cus_delivery"></span><br>
                                <div style="padding-right: 30%"><input size="20" value="<?php echo $row1["prv_ID"] ?>"
                                                                       style="padding: 3%" type="checkbox"
                                                                       id="chkBoxDeliveryP"></div>
                            </td>
                        </tr>

                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
        </div>

        <div class="col-md-2"></div>
    </div>
</div>
<script type="text/javascript" src="../Js/jquery-1.10.2.js"></script>
<script>
    $(chkBoxDelivery).change(function () {
        if(this.checked)
        {

            jQuery.post('GiftServerCode.php', {cusname : $(this).val()
           },function (ex) {
                alert(ex);
            });

        }


    })
</script>
<script>
    $(chkBoxDeliveryP).change(function () {
        if(this.checked)
        {

            jQuery.post('GiftServerCode.php', {prvname : $(this).val()
            },function (ex) {
                alert(ex);
            });


        }


    })
</script>
<script>
    $(bd).html(function () {
        $(Providers).hide()
        $(Customers).hide()
    })
</script>
<script>
    $(function () {
        $(OpenProviders).click(function () {
             // $(this).class("btn btn-primary");

            $(Customers).hide()
            $(Providers).show(1000)

            // $('$OpenProviders').attr('class','btn btn-primary');

            OpenProviders.style.backgroundColor='blue'
            OpenProviders.style.color='white';
            OpenCustomers.style.backgroundColor=''
            OpenCustomers.style.color='';


        })
        $(OpenCustomers).click(function () {
            $(Providers).hide()
            $(Customers).show(1000)
            OpenCustomers.style.backgroundColor='blue'
            OpenCustomers.style.color='white';
            OpenProviders.style.backgroundColor=''
            OpenProviders.style.color='';
        })
    })
</script>

<script>
    $(document).ready(()=>
    {
        $(cusCount).html('<?php echo ' تعداد '. $cusCount.' مشتری جدید  '; ?>')
        $(prvCount).html('<?php echo ' تعداد '. $prvCount.' ارائه دهنده جدید  '; ?>')

    })
</script>








<?php
include '../Shared/Bottom.php';
?>
