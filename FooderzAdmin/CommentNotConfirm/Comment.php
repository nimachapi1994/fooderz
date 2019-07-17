<?php include('../Shared/Top.php') ?>


    <link type="text/css" rel="stylesheet" href="../Css/bootstrap.css">
    <script type="text/javascript" src="../Js/jquery-1.10.2.js"></script>
    <script type="text/javascript" src="../Js/bootstrap.js"></script>
<br>


<div class="container text-center"style="padding-right: 3%">
    <h3 style="font-family: Tahoma">لیست کامنت های تایید <span style="color: darkred;">نشده</span></h3>
    <hr>
    <table  class="table table-responsive table-hover table-bordered" style="margin: auto;width: 90%">
        <tr>
            <th style="text-align: center">تاریخ</th>
            <th style="text-align: center">متن کامنت</th>
            <th style="text-align: center;font-size: small"id="Confirm">تایید</th>
            <th style="text-align: center">مشتری</th>
        </tr>

        <tr>
            <td style="text-align: center">1397/11/21</td>
            <td style="text-align: center">
                <div class="col-sm-12 col-xs-12 col-md-12 text-center"style="font-family:Tahoma;font-size:large"dir="ltr">
                    <pre>ddddddddddddddddddddddddddddddddddfffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffdddd44ttttttttttttttttttttttttttttttttttttttttttt444444444444444444444444444444444444ddddddddddddddddddddddd</pre>
                </div>
            </td>
            <td style="text-align: center">
                <div class="checkbox">
                    <input type="checkbox"id="ckbConfirm">
                </div>
            </td>
            <td style="text-align: center"><button class="btn btn-primary"><img src="../image/customer.png"width="20" height="20">مشخصات کاربر</button> </td>
        </tr>
        <tr></tr>
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