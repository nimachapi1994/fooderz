<?php
try {
    require_once '../DBconnect/DBconnect.php';
    $sql = 'select cus_ID, phone, password from customers';
    $result = $db->query($sql);
    $all = $result->fetchAll(PDO::FETCH_ASSOC);

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
<pre>
    <?php
        echo print_r($all);
    ?>
</pre>
</body>
</html>