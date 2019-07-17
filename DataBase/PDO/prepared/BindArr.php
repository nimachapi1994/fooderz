<?php
// if (isset($_POST['srch']))
{
    try
    {
//        echo $_POST['phoneSrch'];
        require_once '../DBconnect/DBconnect.php';
        $sql = 'SELECT fname, lname, phone FROM customers WHERE phone LIKE :phoneSrch';
        $sql = 'select * from food_filters';
        $stmt = $db->prepare($sql);
        $BindArr = array(':phoneSrch' => '%' . $_POST['phoneSrch'] . '%');
        // $stmt->execute($BindArr);
        $stmt->execute();
        $errInfo = $stmt->errorInfo();


    } catch (Exception $e)
    {
        $err = $e->getMessage();
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDO: Binding</title>
    <link href="../../styles/styles.css" rel="stylesheet" type="text/css">
</head>
<body>
<h2>PDO: Binding</h2><br>
<form action="" method="post">
    <input type="text" name="phoneSrch" id="phoneSrch">
    <input type="submit" name="srch" id="" value="search">
</form>
<?php
  ?>
</table>


<?php
                 var_dump($stmt->fetch());
                while ($row22= $stmt->fetch()) 
                {
                    
                 ?>
                <label class="checkbox-container"><?php echo $row22['food_filter'] ?>
                    <input class="ajaxCall" type="checkbox" name="filter['<?php echo $row22['food_filter'] ?>']">
                    <span class="checkmark"></span>
                </label>
            <?php } ?>
</body>
</html>