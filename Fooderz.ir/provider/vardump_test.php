<?php
include $_SERVER["DOCUMENT_ROOT"] . "/Fooderz/funx.php";
$prv_ID = '1092';
try
{
//        echo $_POST['phoneSrch'];
	require_once arp('DataBase/PDO/DBconnect/DBconnect.php');
	$sql = "SELECT  menu from provider where prv_ID=:prv_ID";
	$stmt = $db->prepare($sql);
	$bindArr = array
		(
		":prv_ID" => $prv_ID,
	);
	$stmt->execute($bindArr);
	$row = $stmt->fetch()['menu'];
	$errInfo = $stmt->errorInfo();
	$row = json_decode($row, true);
	var_dump($row['parent']['menu']);


	// foreach ($row as $k => $value)
	// {
	// 	// print_r($value);
	// 	echo "<hr>".$k."<hr>";
	// 	foreach ($value as $k1=>$v1)
	// 	{
	// 		echo $k1."<br>";
	// 	}
	// }

}
catch (Exception $e)
{
	$err = $e->getMessage();
}
?>