<?php
try
{
    require_once '../../DataBase/PDO/DBconnect/DBconnect.php';
    $sql  = 'SELECT latitude, longitude, X, Y FROM provider';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $errorInfo = $stmt->errorInfo();
    if (isset($errorInfo[2]))
    {
        $error = $errorInfo[2];
    }
}
catch (Exception $e)
{
    $error = $e->getMessage();
}
print_r(json_encode($stmt->fetchAll()));
