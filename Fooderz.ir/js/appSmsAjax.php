<?php 
$msg = "لینک دانلود کافه بازار";
$phone = $_POST['phone'];
$url = "http://smspanel.Trez.ir/SendMessageWithCode.ashx?Username=noohpishe&Password=106010602055&Mobile=$phone&Message=$msg";
file_get_contents($url);
 ?>