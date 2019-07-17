<?php
// @print_r($_POST);
$ch = curl_init("https://www.fooderz.ir");
// curl_setopt($ch,CURLOPT_HEADER,1);
// curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
// curl_setopt($ch, CURLOPT_NOBODY, 1);
// curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
// curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$resault = curl_exec($ch);
echo $resault;
curl_close($ch);
?>
