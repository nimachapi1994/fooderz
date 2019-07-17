<?php
try {
    require_once '../DBconnect/DBconnect.php';
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO customers(fname, lname, phone) VALUES ('hossein', 'noohpishe', '09887767567')";
    $affected = $db->exec($sql);
//    $dbErr = $db->errorInfo();
//    if ($dbErr)
//    {
//        $error = $dbErr[2];
//    }
    echo $affected . ' row affected with ID: ' . $db->lastInsertId();
} catch (Exception $e) {
    $error = $e->getMessage();
}
if (isset($error)) {
    echo $error;
}