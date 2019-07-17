<?php
require_once '../../DataBase/PDO/DBconnect/DBconnect.php';
session_start();
if (isset($_COOKIE['rndToken']) && !empty($_COOKIE['rndToken']))
{
    $tokenII = $_SERVER['REMOTE_ADDR'] . $_COOKIE['rndToken'] . $_SERVER['HTTP_USER_AGENT'] . 'shArAmsHapARE';
    // echo $tokenII;
    $tokenII = sha1($tokenII);
    // setcookie("rndToken", sha1(rand(1000, 9999) . rand(1000, 9999)), time() - (86400 * 30 * 30)); // 86400 = 1 day
    try
    {
        $sql     = "SELECT * FROM provider WHERE token=:token";
        $stmt    = $db->prepare($sql);
        $bindArr = array
        (
            ":token" => $tokenII,
            // ":phone" => $_SESSION['prv_phone'],
        );
        $stmt->execute($bindArr);
        $rowCount = $stmt->rowCount();
    }
    catch (Exception $e)
    {
        $err = $e->getMessage();
    }
    // echo $tokenII;
    // echo $_COOKIE['rndToken'];
    // var_dump($rowCount);

    // if($con==true)
    // {

    // }
}
else
{
    if (!empty($_POST['prv_phone']) && empty($_POST['sec_code']) && isset($_POST['pub_sub']))
    {
        $_SESSION['pubPnlCode'] = rand(10000, 99999);
        $msg                    = urlencode("کد امنیتی \n " . $_SESSION['pubPnlCode']);
        $phone                  = $_POST['prv_phone'];
        $url                    = "http://smspanel.Trez.ir/SendMessageWithCode.ashx?Username=noohpishe&Password=106010602055&Mobile=$phone&Message=$msg";
        file_get_contents($url);
        $_SESSION['prv_phone'] = $_POST['prv_phone'];
    }
    elseif (!empty($_POST['sec_code']) && isset($_POST['pub_sub']) && $_POST['sec_code'] == $_SESSION['pubPnlCode'])
    {
    	// echo 'jjjjjjjjj';
    	$rand = sha1(rand(1000, 9999) . rand(1000, 9999));
        setcookie("rndToken", $rand , time() + (86400 * 30 * 30)); // 86400 = 1 day
        $token               = $_SERVER['REMOTE_ADDR'] . $rand . $_SERVER['HTTP_USER_AGENT'] . 'shArAmsHapARE';
        // echo $token;
        $token               = sha1($token);
        // echo 'hi'.$token;
        try
        {
            $sql     = "UPDATE provider SET token=:token WHERE mobile = :phone";
            $stmt    = $db->prepare($sql);
            $bindArr = array
            (
                ":token" => $token,
                ":phone" => $_SESSION['prv_phone'],
            );
            $stmt->execute($bindArr);
        }
        catch (Exception $e)
        {
            $err = $e->getMessage();
        }
        header("location:public_panel.php");
        // echo $err;
    }
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>ورود رستوران</title>
		<!-- custom-theme -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<!-- //custom-theme -->
		<link href="../css/other_styles.css" rel="stylesheet" type="text/css" media="all" />
		<link href="../css/style.css" rel="stylesheet" type="text/css" media="all" /><!-- Theme-CSS -->
	</head>
	<body>

		<div class="res_login_wrapper">
			<div class="res_login_container">
				<a href="index.php">
					<img src="../images/logo.png" alt="fooderz logo" width="70px" />
				</a>
				<h1 class="res_login_h1">ورود صاحب رستوران به پنل</h1>
				<form class="res_login_form" action="" method="post">
					<input name="prv_phone" type="text" placeholder="تلفن">
					<input name="sec_code" type="password" placeholder="کد امنیتی">
					<button name="pub_sub" type="submit" id="login-button">ورود</button>
				</form>
			</div>

			<ul class="bg-bubbles">
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
			</ul>
		</div>

		<script src="../js/plugins.min.js"></script>
		<script src="../js/layout.js"></script>
	</body>
</html>
<?php 	
} ?>
<?php
if ($rowCount===1)
{
    if (isset($_POST['send']))
    {
        $verify = ($_POST['send'] == 'ok') ? 'accepted_order' : 'canceled_order';
        try
        {
            $sql     = "UPDATE purchasecart SET verify=:verify WHERE pch_ID=:pch_ID";
            $stmt    = $db->prepare($sql);
            $bindArr = array
                (
                ":verify" => $verify,
                ":pch_ID" => $_POST['pch_ID'],
            );
            $stmt->execute($bindArr);
            $errInfo = $stmt->errorInfo();
        }
        catch (Exception $e)
        {
            $err = $e->getMessage();
        }
    }
    try
    {
        $sql = "SELECT purchasecart.pch_ID, concat(customers.fname,' ', customers.lname) fullname, customers.phone, purchasecart.sum, purchasecart.date1,purchasecart.address,purchasecart.description, purchasecart.items
	FROM customers
	INNER JOIN purchasecart ON customers.cus_ID = purchasecart.cus_ID
	INNER JOIN provider ON provider.prv_ID = purchasecart.prv_ID WHERE provider.prv_ID=:prv_ID AND verify='accepted_order' ORDER BY date1 DESC;

	SELECT purchasecart.pch_ID, concat(customers.fname,' ', customers.lname) fullname, customers.phone, purchasecart.sum, purchasecart.date1,purchasecart.address,purchasecart.description, purchasecart.items
	FROM customers
	INNER JOIN purchasecart ON customers.cus_ID = purchasecart.cus_ID
	INNER JOIN provider ON provider.prv_ID = purchasecart.prv_ID WHERE provider.prv_ID=:prv_ID AND verify='canceled_order' ORDER BY date1 DESC";
        $stmt    = $db->prepare($sql);
        $bindArr = array
            (
            ":prv_ID" => '1092',
        );
        $stmt->execute($bindArr);
        $errInfo = $stmt->errorInfo();

    }
    catch (Exception $e)
    {
        $err = $e->getMessage();
    }
    include '../../jdf/jdf.php';
    ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>سفارشات</title>
		<!-- custom-theme -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<!-- //custom-theme -->
		<link href="../css/other_styles.css" rel="stylesheet" type="text/css" media="all" />
		<link href="../css/style.css" rel="stylesheet" type="text/css" media="all" /><!-- Theme-CSS -->
	</head>
	<body class="public_prv_panel">
		<div class="container">
			<h4 class="public_p_title text-center">رستوران <span class="tomato">صوفی</span></h4>
			<h5 class="public_p_title2 text-center">سفارش های جدید</span></h5>
			sadlkfj
			        <div id="order_list_ajax">
			        	<table class="report-table public_p_table" id="prv_new_order_table">
							<tr>
								<th>ردیف</th>
								<th>نام مشتری</th>
								<th>مبلغ</th>
								<th>تاریخ</th>
								<th>ساعت</th>
								<th>بیشتر +</th>
							</tr>
						</table>
                    </div>

			<br /><br /><hr style="border-color: #aaa" />
			<div class="row">
				<input type="text" name="">
				<button>
				جستجو
				</button>
				<h5 class="public_p_title2 text-center">سفارش های اخیر</span></h5>
				<div class="col-md-6">
					<h5 class="public_p_title2 text-center">ارسال شده ها</span></h5>
					<table class="report-table public_p_table">
						<tr>
							<th>ردیف</th>
							<th>نام مشتری</th>
							<th>مبلغ</th>
							<th>تاریخ</th>
							<th>ساعت</th>
							<th>بیشتر +</th>
						</tr>
						<?php
$i = 1;
    while ($row = $stmt->fetch())
    {
        ?>
							<tr class="confirmed">
							<th><?php echo $i++; ?></th>
							<th><?php echo $row['fullname'] ?></th>
							<th><?php echo number_format($row['sum']) ?></th>
							<th><?php echo jdate("j F y", strtotime($row['date1'])) ?></th>
							<th><?php echo substr($row['date1'], 11, 5) ?></th>
							<th><a class="more" p_ID="<?php echo $row['pch_ID'] ?>" href="#" data-toggle="modal" data-target="#more_details">...</a></th>
							</tr>
						<?php
}
    ?>
					</table>
				</div>

				<div class="col-md-6">
					<h5 class="public_p_title2 text-center">ارسال نشده</span></h5>
					<table class="report-table public_p_table">
						<tr>
							<th>ردیف</th>
							<th>نام مشتری</th>
							<th>مبلغ</th>
							<th>تاریخ</th>
							<th>ساعت</th>
							<th>بیشتر +</th>
						</tr>
						<?php
$stmt->nextRowset();
    $i = 1;
    while ($row = $stmt->fetch())
    {
        ?>
							<tr class="not_confirmed">
							<th><?php echo $i++; ?></th>
							<th><?php echo $row['fullname'] ?></th>
							<th><?php echo number_format($row['sum']) ?></th>
							<th><?php echo jdate("j F y", strtotime($row['date1'])) ?></th>
							<th><?php echo substr($row['date1'], 11, 5) ?></th>
							<th><a class="more" p_ID="<?php echo $row['pch_ID'] ?>" href="#" data-toggle="modal" data-target="#more_details">...</a></th>
							</tr>
						<?php
}
    ?>
					</table>
				</div>
			</div>
		</div>





		<!-- hidden factor for restaurant printing -->
        <div class="factor" id="factor" style="border: solid 1px #000;padding: 20px;text-align: right;display: none">
            <div style="margin-bottom: 30px;text-align: center">
                <img src="../images/logo.png" alt="Fooderz" width="50px" style="position:relative; right:30px" />
                <h3 style="float: right">رستوران عطاویچ</h3>
                <p style="float: left">شماره تماس : ۰۷۱۳۵۶۷۸۹۶۴</p>
            </div>
            <h5 style="text-align: center">فاکتور شماره ۱۱۳۶</h5>
            <table style="width: 100%;border: dashed 1px #aaa;text-align: right;direction: rtl;border-bottom: none">
                <tr style="text-align: center;border-bottom: solid .5px #aaa">
                    <th style="padding: 10px;border-bottom: solid 1px #aaa">ردیف</th>
                    <th style="padding: 10px;border-bottom: solid 1px #aaa">نام سفارش</th>
                    <th style="padding: 10px;border-bottom: solid 1px #aaa">تعداد</th>
                    <th style="padding: 10px;border-bottom: solid 1px #aaa">قیمت واحد (تومان)</th>
                </tr>

                <tr style="text-align: center;border-bottom: dashed 1px #aaa">
                    <td style="padding: 10px;border-bottom: dashed 1px #aaa">۱</td>
                    <td style="padding: 10px;border-bottom: dashed 1px #aaa">پیتزا دونفره بزرگ</td>
                    <td style="padding: 10px;border-bottom: dashed 1px #aaa">۱</td>
                    <td style="padding: 10px;border-bottom: dashed 1px #aaa">۲۲۰۰۰</td>
                </tr>

                <tr style="text-align: center;border-bottom: dashed 1px #aaa">
                    <td style="padding: 10px;border-bottom: dashed 1px #aaa">۲</td>
                    <td style="padding: 10px;border-bottom: dashed 1px #aaa">چیز برگر</td>
                    <td style="padding: 10px;border-bottom: dashed 1px #aaa">۱</td>
                    <td style="padding: 10px;border-bottom: dashed 1px #aaa">۱۰۰۰۰</td>
                </tr>

                <tr style="text-align: center;border-bottom: dashed 1px #aaa">
                    <td style="padding: 10px;border-bottom: dashed 1px #aaa">۳</td>
                    <td style="padding: 10px;border-bottom: dashed 1px #aaa">سیب زمینی خانواده</td>
                    <td style="padding: 10px;border-bottom: dashed 1px #aaa">۱</td>
                    <td style="padding: 10px;border-bottom: dashed 1px #aaa">۸۰۰۰</td>
                </tr>

            </table>

            <h5 style="text-align: center;">مشخصات مشتری</h5>
            <table style="width: 100%;border: dashed 1px #aaa;text-align: right;direction: rtl;border-bottom: none !important;">
                <tr style="text-align: center;border-bottom: solid .5px #aaa">
                    <th style="padding: 10px;border-bottom: solid 1px #aaa">نام</th>
                    <th style="padding: 10px;border-bottom: solid 1px #aaa">شماره تماس</th>
                    <th style="padding: 10px;border-bottom: solid 1px #aaa">آدرس</th>
                    <th style="padding: 10px;border-bottom: solid 1px #aaa">توضیحات</th>
                </tr>
                <tr style="text-align: center">
                    <td style="padding: 10px"><?php echo $managerName; ?></td>
                    <td style="padding: 10px">۰۹۱۷۸۱۵۹۹۸۱</td>
                    <td style="padding: 10px">شیراز خیابان عفیف آباد نبش کوچه چهارم . بن بست آخر پلاک ۲۰۰</td>
                    <td style="padding: 10px">توضیحات طولانی توضیحات طولانی توضیحات طولانی توضیحات طولانی توضیحات طولانی توضیحات طولانی</td>
                </tr>
            </table>

            <div style="border-top: dashed 1px #000;padding-top: 30px;text-align: center">
                <p style="float: right"><strong>نوع تسویه : </strong> نقدی</p>
                <p style="float: left"><strong>نام پیک : </strong> <?php echo $managerName; ?></p>
                <h3>جمع کل فاکتور : ۵۸۰۰۰ تومان</h3>
            </div>
            <hr />
            <div style="padding-top: 30px;text-align: center;height: 60px">
                <p style="float: right"><strong>کل سود شما از این فاکتور :  </strong> ۴۹۰۰۰ تومان</p>
                <p style="float: left;"><strong>Fooderz</strong></p>
            </div>
        </div>
        <!-- /hidden factor for restaurant printing -->

		<!-- factor modal -->
		<div class="modal fade" id="more_details" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-wide" role="document">
        <div class="modal-content full_width">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="بستن">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <h5 class="tomato">جزییات سفارش</h5>
                        <table class="report-table">
                            <tr>
                                <th>ردیف</th>
                                <th>نام غذا</th>
                                <th>تعداد</th>
                                <th>مبلغ (تومان)</th>
                                <th>سود شما (تومان)</th>
                            </tr>

                            <tr>
                                <td class="text-center">1</td>
                                <td class="text-center">کباب</td>
                                <td class="text-center">۲</td>
                                <td class="text-center">۲۲۰۰۰</td>
                                <td class="text-center">۱۲۰۰۰</td>
                            </tr>
                            <!-- table footer (do not remove)-->
                            <tr>
                                <th>مبلغ کل</th>
                                <td>-</td>
                                <td>-</td>
                                <th class="green_colored">11223</th>
                                <td>-</td>
                            </tr>
                            <tr>
                                <th>جمع کل سود</th>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <th class="green_colored">123123</th>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-6">
                        <h5 class="tomato">مشخصات مشتری</h5>
                        <table class="report-table">
                            <tr>
                                <th>نام</th>
                                <td>test</td>
                            </tr>
                            <tr>
                                <th>شماره تماس</th>
                                <td>test</td>
                            </tr>
                            <tr>
                                <th>آدرس</th>
                                <td>test</td>
                            </tr>
                            <tr>
                                <th>توضیحات</th>
                                <td>test</td>
                            </tr>
                        </table>
                        <div class="text-center">
                        <label>
                            <input type="radio" value="send" id="send" name="confirm"><span>send</span>
                        </label>
                        <label>
                            <input type="radio" value="cantSend" id="cantSend" name="confirm">cant send
                        </label>

                        </div>
                    </div>
                </div>




            </div>
            <div class="modal-footer">
                <button type="button" class="print btn btn-primary" data-dismiss="modal" aria-label="پرینت">
                    <span aria-hidden="true">پرینت</span>
                </button>
            </div>
        </div>
    </div>
		</div>
		<script src="../js/plugins.min.js"></script>
		<script>
			function printData()
        {
            var divToPrint = document.getElementById("factor");
            divToPrint.style.display="block";
            newWin= window.open("");
            newWin.document.write(divToPrint.outerHTML);
            newWin.print();
            newWin.close();
            divToPrint.style.display="none";
        }

        $('.print').on('click',function(){
            printData();
        })
        function order_list()
	    {
	    	// alert('message?: DOMString')
	    $.post('prv_pnl_ordr_ajax.php', {}, function(ex,sr) {
	        $('#order_list_ajax').html(ex);
	            });
	        setTimeout(order_list,1000);
	    }
	    order_list();
		</script>
	</body>
</html>
	<?php }?>
