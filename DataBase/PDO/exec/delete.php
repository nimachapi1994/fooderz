<?php
try {
    require_once '../DBconnect/DBconnect.php';
    $sql = "DELETE FROM customers WHERE fname='hossein'";
    $affected = $db->exec($sql);
    echo $affected . ' row affected with ID: ' . $db->lastInsertId();
} catch (Exception $e) {
    $error = $e->getMessage();
}
if (isset($error)) {
    echo $error;
}