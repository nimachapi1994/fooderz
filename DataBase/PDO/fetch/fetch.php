<?php
try {
    require_once '../DBconnect/DBconnect.php';
    $sql = 'select cus_ID, phone, password from customers';
    $result = $db->query($sql);
    if(!$result)
    {
        die("Execute query error, because: ". print_r($db->errorInfo(),true) );
    }
//success case
    else{
        //continue flow
    }
} catch (Exception $e) {
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PDO: Fetching a Row</title>
    <link href="../../styles/styles.css" rel="stylesheet" type="text/css">
</head>
<body>
<h1>PDO: Fetching the Next Row</h1>
<?php if (isset($error)) {
    echo "<p>$error</p>";
}
?>
<table>
    <tr>
        <th>number</th>
        <th>phone</th>
        <th>pass</th>
    </tr>
    <?php while($row = $result->fetch()){?>
        <tr>
            <td><?php echo $row[0]; ?></td>
            <td><?php echo $row[1]; ?></td>
            <td><?php echo $row[2]; ?></td>
        </tr>
    <?php }?>
</table>
</body>
</html>