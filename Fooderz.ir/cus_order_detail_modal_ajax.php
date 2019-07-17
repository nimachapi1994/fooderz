<?php 
// var_dump($_POST);
// die();
date_default_timezone_set('Asia/Tehran');
include_once '../jdf/jdf.php';
require_once '../DataBase/PDO/DBconnect/DBconnect.php';
try
{
    $sql = "SELECT provider.prv_ID, purchasecart.RefID, provider.deliveryCost, purchasecart.pch_ID, concat(customers.fname,' ', customers.lname) fullname, customers.phone, purchasecart.sum, purchasecart.date1,purchasecart.address,purchasecart.description, purchasecart.items
            FROM customers
            INNER JOIN purchasecart ON customers.cus_ID = purchasecart.cus_ID
            INNER JOIN provider ON provider.prv_ID = purchasecart.prv_ID WHERE purchasecart.pch_ID=:pch_ID";
    $stmt    = $db->prepare($sql);
    $bindArr = array
        (
        ":pch_ID" => $_POST['pid'],
    );
    $stmt->execute($bindArr);
    $row     = $stmt->fetch();
    $errInfo = $stmt->errorInfo();

}
catch (Exception $e)
{
    $err = $e->getMessage();
}
// print_r($row['items']);
?>
									<div class="row">
										<div class="col-md-6">
											<table class="full_width">
												<tr>
													<th>شرح</th>
													<th>تعداد</th>
													<th class="price">مبلغ (تومان)</th>
												</tr>
												<?php $item = $row['items'];
												foreach (json_decode($item,1) as $v) 
												{
												 // foreach ($item as $v) 
												 // {
												 // 	print_r($v);
												 // 	echo "<br>";
												 // }
												?>
												<tr class="food">
													<td>
														<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 24 24"><path d="M11.415 12.393l1.868-2.289c.425-.544.224-.988-.055-2.165-.205-.871-.044-1.854.572-2.5 1.761-1.844 5.343-5.439 5.343-5.439l.472.37-3.693 4.728.79.617 3.87-4.59.479.373-3.558 4.835.79.618 3.885-4.58.443.347-3.538 4.85.791.617 3.693-4.728.433.338s-2.55 4.36-3.898 6.535c-.479.771-1.425 1.161-2.334 1.167-1.211.007-1.685-.089-2.117.464l-2.281 2.795c2.445 2.962 4.559 5.531 5.573 6.829.771.987.065 2.421-1.198 2.421-.42 0-.853-.171-1.167-.573l-8.36-10.072s-.926.719-1.944 1.518c-3.172-5.184-6.267-11.661-6.267-13.955 0-.128-.034-.924.732-.924.245 0 .493.116.674.344.509.642 5.415 6.513 10.002 12.049m-2.952 3.617l1.953 2.365-4.115 5.055c-.295.378-.736.576-1.182.576-1.198 0-1.991-1.402-1.189-2.428l4.533-5.568z" fill="#030405"/></svg>
														<?php echo $v['name'] ?>
													</td>
													<td><?php echo $v['count'] ?></td>
													<td class="price"><?php echo number_format($v['price']) ?></td>
												</tr>
												<?php
												} ?>
												<tr>
													<td>جمع سبد خرید</td>
													<td></td>
													<td class="price"><?php echo number_format($row['sum']) ?></td>
												</tr>
<!-- 												<tr>
													<td>هزینه بسته بندی</td>
													<td class="price"></td>
												</tr>
 -->												<tr>
													<td>هزینه ارسال</td>
													<td></td>
													<td class="price"><?php echo number_format($row['deliveryCost']) ?></td>
												</tr>
												<tr>
													<th>مبلغ کل</th>
													<th></th>
													<th class="price"><?php echo number_format($row['sum']+$row['deliveryCost']) ?></th>
												</tr>
											</table>
										</div>
										<div class="col-md-6">
											<p class="date"><span class="title">تاریخ: </span><?php echo jdate('j F y', strtotime($row['date1'])) ?></p>
											<p class="code"><span class="title">کد رهگیری: </span><?php echo $row['RefID'] ?></p>
											<p class="pay_kind"><span class="title">نوع پرداخت: </span>آنلاین</p>
											<p class="address"><span class="title">آدرس ارسال: </span><?php $a=explode('|', trim($row['address'],"'")); echo end($a) ?></p>
											<br />
											<form action="menu.php" method="post">
												<input type="text" class="purch" hidden value='<?php echo $item ?>'>
												<input type="text" name="prvID" hidden value='<?php echo $row['prv_ID'] ?>'>
												<button id="buy_again" name="buy_again" type="submit"  class="fooderz_btn full_width re_order_link" href="">
													سفارش مجدد از رستوران
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z"/></svg>
												</button>
												
											</form>
											<script>
												$(document).ready(function() {
														alert('message?: DOMString')
													console.log($(".purch").val())
													});
											</script>
										</div>
									</div>

												<script>

													$("#buy_again").click(function(){
														var ordObj = $(this).siblings(".purch").val()
														setCookie("order", ordObj, 365)
														;
													})
													function setCookie(cname, cvalue, exdays) 
													{
													    var d = new Date();
													    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
													    var expires = "expires="+d.toUTCString();
													    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
													}
													function getCookie(cname) 
													{
													    var name = cname + "=";
													    var ca = document.cookie.split(';');
													    for(var i = 0; i < ca.length; i++) {
													        var c = ca[i];
													        while (c.charAt(0) == ' ') {
													            c = c.substring(1);
													        }
													        if (c.indexOf(name) == 0) {
													            return c.substring(name.length, c.length);
													        }
													    }
													    return "";
													}

												</script>

<?php 

?>