<?php
// print_r($_POST['order']);
// die();
require_once '../DataBase/PDO/DBconnect/DBconnect.php';
$prv_ID = $_POST['prv_ID'];
try
{
    $sql   = "call menu($prv_ID)";
    $stmt0 = $db->prepare($sql);
    $stmt0->execute();
    $errInfo0 = $stmt0->errorInfo();
    $rcrd     = $stmt0->fetch();
    $res      = json_decode($rcrd['menu'], 1)['menu'];
    $prvName  = $rcrd['providerName'];
    // var_dump($res);
    // die();
}
catch (Exception $e)
{
    $err0 = $e->getMessage();
}
foreach ($res as $k => $v)
{
    foreach ($v as $k1 => $v1)
    {
        $foods[$k1] = $v1['price'];
    }
}
// print_r($foods);
// die();
$sum   = 0;
$order = $_POST['order'];
// foreach ($order as $v)
// {
//     var_dump($v['name']);
// }
for ($i = 1; $i < count($order)+1; $i++)
{
	$order[$i]['price'] = $foods[$order[$i]['name']];
	$sum += $order[$i]['count'] * $order[$i]['price'];
}
print_r($order);
echo $sum;