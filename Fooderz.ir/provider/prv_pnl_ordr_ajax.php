<!-- <h4 class="main-title">لیست فروش</h4>
<table class="report-table">
                <tr>
                    <th>ردیف</th>
                    <th>نام مشتری</th>
                    <th>مبلغ</th>
                    <th>تاریخ</th>
                    <th>ساعت</th>
                    <th>بیشتر +</th>
                </tr> -->
<table class="report-table public_p_table" id="prv_new_order_table">
    <tr>
        <th>ردیف</th>
        <th>نام مشتری</th>
        <th>مبلغ</th>
        <th>تاریخ</th>
        <th>ساعت</th>
        <th>بیشتر +</th>
    </tr>
<!-- </table> -->
<?php
// $milliseconds1 = round(microtime(true) * 10000);
date_default_timezone_set('Asia/Tehran');
try
{
//        echo $_POST['phoneSrch'];
    require_once '../../DataBase/PDO/DBconnect/DBconnect.php';
    $sql = "SELECT purchasecart.pch_ID, concat(customers.fname,' ', customers.lname) fullname, customers.phone, purchasecart.sum, purchasecart.date1,purchasecart.address,purchasecart.description, purchasecart.items
FROM customers
INNER JOIN purchasecart ON customers.cus_ID = purchasecart.cus_ID
INNER JOIN provider ON provider.prv_ID = purchasecart.prv_ID WHERE provider.prv_ID=:prv_ID AND verify='suspended_order' ORDER BY date1 DESC";
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
// var_dump($errInfo);
// print_r($row);
$i=1;
    include_once '../../jdf/jdf.php';

while ($row = $stmt->fetch())
{
$date = $row['date1'];
    $GLOBALS['date2'] = substr($date, 11, 5);
    // $date1 = substr($date, 0, 10);
    // $year  = substr($date1, 0, 4);
    // $month = substr($date1, 5, 2);
    // $day   = substr($date1, 8, 2);
    // $GLOBALS['date1'] = gregorian_to_jalali($year, $month, $day, "/");

    ?>
                            <tr class="">
                                <th><?php echo $i; ?></th>
                                <th><?php echo $row['fullname']; ?></th>
                                <th><?php echo number_format($row['sum']) ?></th>
                                <th><?php echo jdate("j F y", strtotime($row['date1'])) ?></th>
                                <th><?php echo $date2 ?></th>
                                <th><a class="more" p_ID="<?php echo $row['pch_ID'] ?>" href="#" data-toggle="modal" data-target="#more_details">...</a></th>
                            </tr>
<?php
$i++;
}
// function dateCal($date)
// {
// }
//     $milliseconds2 = round(microtime(true) * 10000);
// $milliseconds = $milliseconds2-$milliseconds1;
// echo $milliseconds;
?>
</table>

<script>
    $(".more").click(function(){
        $.post('order_detail_modal_ajax.php', {pch_ID: $(this).attr('p_ID')}, function(ex) {
            $("#more_details").html(ex)
        });
    });
</script>