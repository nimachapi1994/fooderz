<?php
include $_SERVER["DOCUMENT_ROOT"]."/Fooderz/funx.php";
try
{
    require_once arp('DataBase/PDO/DBconnect/DBconnect.php');;
    if (isset($_POST['srch']) && $_POST['srch'] != "")
    {
        $like = "%" . $_POST['srch'] . "%";
        $sql = 'select * from provider where confirmByAdmin = :confirmByAdmin and (providerName like :liking or telephone like :liking or mobile like :liking or managerName like :liking) ORDER BY datenTime';
        $stmt = $db->prepare($sql);
        $stmt->execute(array(":confirmByAdmin" => 0, ":liking" => "$like"));
    }
    else
    {
        $sql = 'select * from provider where confirmByAdmin = :confirmByAdmin  ORDER BY datenTime';
        $stmt = $db->prepare($sql);
        $stmt->execute(array(":confirmByAdmin" => 0));
    }
//    die();


    if (!$stmt)
    {
        die("Execute query error, because: " . print_r($db->errorInfo(), true));
    } //success case
    else
    {
        //continue flow
    }
} catch (Exception $e)
{
}
?>
<?php include arp('FooderzAdmin/Shared/Top.php') ?>
    <br>
    <link type="text/css" rel="stylesheet" href="../Css/bootstrap.css">
    <script type="text/javascript" src="../Js/jquery-1.10.2.js"></script>
    <script type="text/javascript" src="../Js/bootstrap.js"></script>
    <script>
        function btn1(id)
        {
            // alert(id);
            $.post("modal.php",
                {
                    prv_ID: id,
                },
                function (ex)
                {
                    //if (ex == 'پیام شما با موفقیت ارسال شد!!!') document.getElementById("divCm").className = "alert alert-success";

                    $(Modal1).html(ex);
                });
            $(Modal1).modal('show');
        }

        function btn2()
        {
            $(modalInsertRegions).modal();
        }

    </script>
    <style>
        .b1 {
            display: inline;
            width: 80%;
            font-family: Tahoma !important;
            padding: 6px 0px;

        }

        .a1:focus {
            border-color: #66afe9;
            outline: 0;
            -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(102, 175, 233, 0.6);
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(102, 175, 233, 0.6);
        }
    </style>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="container text-center" style="margin: auto;width: 50%">
                <h3 class="text-center" style="font-family: Tahoma">لیست فروشنده های تایید <span style="color: red">نشده!</span>
                </h3>
                <br>
                <form action="" method="post">
                    <input name="srch" size="70" class="form-control a1 b1"
                           placeholder="جستجو بر اساس نام و نام خانوادگی , شماره موبایل یا اسم مغازه ..."
                           style="font-family:Tahama;">

                    <button type="submit" name="subSrch" class="btn btn-primary"><img src="../image/1Search1.png"
                                                                                      style="width: 30px;height: 30px;">
                    </button>
                </form>
            </div>
            <br>
            <table class="table-bordered table-striped table-responsive table-hover container text-center">
                <tr>
                    <th style="text-align: center"> نام رستوران</th>

                    <th style="text-align: center"> مدیر</th>
                    <th style="text-align: center">شهر</th>

                    <th style="text-align: center"> شماره همراه</th>
                    <th style="text-align: center"> تلفن ثابت</th>
                    <th style="text-align: center"> آدرس</th>
                    <th style="text-align: center"> مشخصات کامل</th>

                </tr>
                <?php while ($row = $stmt->fetch())
                {
                    ?>
                    <tr>
                        <td style="text-align: center"><?php echo $row['providerName'] ?></td>
                        <td style="text-align: center"><?php echo $row['managerName'] ?></td>
                        <td style="text-align: center"><?php echo $row['city'] ?></td>
                        <td style="text-align: center"><?php echo $row['mobile'] ?></td>
                        <td style="text-align: center"><?php echo $row['telephone'] ?></td>
                        <td style="text-align: center">
                            <div class="col-sm-12 col-xs-12 col-md-12 text-center"
                                 style="font-family:Tahoma;font-size:large" dir="ltr">
                                <pre><?php echo $row['address'] ?></pre>
                        </td>
                        <td>
                            <button class="btn btn-primary" id="<?php echo $row['prv_ID'] ?>"
                                    onclick="btn1(<?php echo $row['prv_ID'] ?>)">بیشتر +
                            </button>
                        </td>


                    </tr>
                    <?php
                } ?>
            </table>
        </div>
        <div class="col-md-1"></div>
    </div>
    <div class="modal fade" id="Modal1" role="dialog">

    </div>


<?php include arp('FooderzAdmin/Shared/Bottom.php') ?>