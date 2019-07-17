<?php 
include_once '../../DataBase/PDO/DBconnect/DBconnect.php';
include_once '../../jdf/jdf.php';
// var_dump($_POST);
// die();
try
{
//        echo $_POST['phoneSrch'];
    $sql = "SELECT purchasecart.RefID, provider.prv_ID, provider.mobile, purchasecart.authority, provider.providerName, purchasecart.pch_ID, concat(customers.fname,' ', customers.lname) fullname, customers.phone, purchasecart.sum, purchasecart.date1,purchasecart.address,purchasecart.description, purchasecart.items, purchasecart.verify
                FROM customers
                INNER JOIN purchasecart ON customers.cus_ID = purchasecart.cus_ID
                INNER JOIN provider ON provider.prv_ID = purchasecart.prv_ID";
    if (isset($_POST['verify']) && !empty($_POST['verify']))
    {
        $verifyPost = $_POST['verify'];
        $sql .= " WHERE verify='$verifyPost'";
    }
    if (isset($_POST['like'])) 
    {
		$like = "%" . $_POST['like'] . "%";
		$sql .= " AND (customers.phone like \"$like\" or customers.lname like \"$like\" or customers.fname like \"$like\" or purchasecart.RefID like \"$like\")";
    }
    $sql .= ' ORDER BY date1 DESC';
	// var_dump($sql);
	// die();
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $errInfo = $stmt->errorInfo();
}
catch (Exception $e)
{
    $err = $e->getMessage();
}
?>
    <table style="margin: auto;width: 75%" class="table-bordered table-striped table-responsive table-hover container text-center">
        <tr>
            <th style="text-align: center"> نام مشتری </th>
            <th style="text-align: center"> تاریخ و ساعت </th>
            <th style="text-align: center"> کد پیگیری </th>
            <th style="text-align: center"> شماره تماس </th>
            <th style="text-align: center"> فروشنده</th>
            <th style="text-align: center"> وضعیت </th>


        </tr>
        <?php while ($row = $stmt->fetch())
{

    switch ($row['verify'])
    {
        case 'accepted_order':
            $verify   = 'ارسال شده';
            $btnClass = 'btn-success';
            break;
        case 'canceled_order':
            $verify   = 'رد شده';
            $btnClass = 'btn-danger';
            break;
        case 'suspended_order':
            $verify   = 'معلق';
            $btnClass = 'btn-warning';
            break;
        default:
            $verify = 'err';
            break;
    }
    ?>
        <tr>
            <td style="text-align: center"> <?php echo $row['fullname'] ?>   </td>
            <td style="text-align: center"> <?php echo jdate("j F y", strtotime($row['date1'])) ?> </td>
            <td style="text-align: center"> <?php echo $row['RefID'] ?> </td>
            <td style="text-align: center"> <?php echo $row['mobile'] ?> </td>
            <td style="text-align: center">			
	            <form name="sb" id="sb" action="../../Fooderz.ir/menu.php" method="post" accept-charset="utf-8">
				<input type="text" name="prvID" value="<?php echo $row['prv_ID'] ?>" hidden id="">
				<button type="submit" class="btn btn-xs btn-primary" id="tnShowModalSeller"><img src="../image/provider.png" width="30" height="30"><?php echo $row['providerName'] ?></button></form>
			</td>
            <td style="text-align: center;"><button style="width: 100px" class="btn <?php echo $btnClass; ?> btnShowModalFactor" pch_id='<?php echo $row['pch_ID'] ?>'><?php echo $verify; ?></button></td>
        </tr>
    <?php }?>
    </table>
<script>
	//console.log('hi')
    setTimeout(BRJX,300000)
        $('.btnShowModalFactor').click(function () {
        x = $(this).attr('pch_id')
        console.log(x)
        $.post('../../Fooderz.ir/provider/order_detail_modal_ajax.php', {pch_ID: x}, function(ex) {
	        $(modalShowFactor).html(ex);
        });
        $(modalShowFactor).modal();
    })
</script>