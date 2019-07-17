<?php
if (isset($_POST['srch']))
{
    try
    {
//        echo $_POST['phoneSrch'];
        require_once '../DBconnect/DBconnect.php';
        $sql = 'SELECT fname, lname, phone FROM customers WHERE phone LIKE :phoneSrch';
        $stmt = $db->prepare($sql);
//        $stmt->bindValue(':fname', 'fname');
//        $stmt->bindValue(':lname', 'lname');
//        $stmt->bindValue(':phone', 'phone');
        $stmt->bindValue(':phoneSrch', '%' . $_POST['phoneSrch'] . '%');
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
if (isset($err))
{
    print_r($err);
}
if (isset($errInfo[2]))
{
    echo $errInfo[2];
}

if (isset($_POST['srch']))
{
if ($stmt->rowCount() != 0)
{
?>
<br>
<table>
    <tr>
        <td>fname</td>
        <td>lname</td>
        <td>phone</td>
    </tr>
    <?php
    while ($row = $stmt->fetch())
    {
        ?>
        <tr>
            <td><?php echo $row[0] ?></td>
            <td><?php echo $row[1] ?></td>
            <td><?php echo $row[2] ?></td>
        </tr>
        <?php
    }
    }
    else
    {
        echo 'No Result';
    }

    }

    ?>
</table>
</body>
</html>