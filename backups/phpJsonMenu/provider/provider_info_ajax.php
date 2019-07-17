    <meta charset=utf-8"/>
	<?php
include $_SERVER["DOCUMENT_ROOT"] . "/Fooderz/funx.php";
//var_dump($_POST);
$prv_ID = $_POST['prv_ID'];
unset($_POST['prv_ID']);
if (isset($_POST['percent']))
{
	$percent = $_POST['percent'];
	$percent = substr($percent, 0,-1);
	try
	{
		require_once arp('DataBase/PDO/DBconnect/DBconnect.php');
		$sql = 'update provider set discount = :discount where prv_ID=:prv_ID';
		$stmt = $db->prepare($sql);
		$bindArr =
			[
			':prv_ID' => $prv_ID,
			':discount' => $percent,
		];
		$stmt->execute($bindArr);
	}
	catch (Exeption $e)
	{

	}

}
else
{
	try
	{
		require_once arp('DataBase/PDO/DBconnect/DBconnect.php');
		$sql = 'select menu from provider where prv_ID=:prv_ID';
		$stmt = $db->prepare($sql);
		$bindArr =
			[
			':prv_ID' => $prv_ID,
		];
		$stmt->execute($bindArr);
		$result = $stmt->fetch()['menu'];
		$result = json_decode($result, 1);
		$result['parent']['gift'] = $_POST;
	}
	catch (Exeption $e)
	{

	}

	try
	{
		$newMenu = json_encode($result);
		require_once arp('DataBase/PDO/DBconnect/DBconnect.php');
		$sql = 'update provider set menu = :menu where prv_ID=:prv_ID';
		$stmt = $db->prepare($sql);
		$bindArr =
			[
			':prv_ID' => $prv_ID,
			':menu' => $newMenu,
		];
		$stmt->execute($bindArr);

	}
	catch (Exeption $e)
	{

	}
	//li list
	foreach ($_POST as $v)
	{
		echo '<li><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px" viewBox="0 0 612.005 612.005" style="position:relative;top:3px;margin-left:7px">
			<path d="M595.601,81.553c-21.892-21.891-57.362-21.891-79.253,0L183.03,414.87l-88.629-76.133     c-21.592-21.593-56.596-21.593-78.207,0c-21.592,21.592-21.592,56.614,0,78.206l132.412,113.733     c21.592,21.593,56.596,21.593,78.207,0c2.167-2.166,3.979-4.576,5.716-6.985c0.317-0.299,0.672-0.505,0.99-0.804l362.083-362.101     C617.473,138.914,617.473,103.425,595.601,81.553z" fill="#91DC5A"/>
</svg>' . $v . "</li>";
	}
}
?>