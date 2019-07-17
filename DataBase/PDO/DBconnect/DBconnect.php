<?php
//$connection = mysqli_connect('localhost', 'root', '', 'vmzonuak_fooderz1');
//mysqli_set_charset($connection, 'utf8');
//if (mysqli_connect_errno($connection)) die('connection failed!!!');
$dsn = 'mysql:host=localhost;dbname=vmzonuak_fooderz1';
$db = new PDO($dsn, 'root', 'drlecter');
$db->exec("SET CHARACTER SET utf8");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

