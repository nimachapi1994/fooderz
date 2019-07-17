 <?php
/**
 * Created by PhpStorm.
 * User: unixname
 * Date: 9/8/18
 * Time: 1:49 AM
 */
// //var_dump($_POST);
// $type = $_POST['type'];
// if ($type == 'login_submit')
// {
    
// }
?> 
<!doctype html>
 <html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatibe" content="ie=edge">
    <title>form</title>
</head>ttttttttttttttttttttttttttttttttttttttttttttttttttt
<body>
hello
<form action="">
    <?php
   if (true)
   {
       $time = time();
       $hash1 = md5($time.'MYSALT');
       $ip = $_SERVER["REMOTE_ADDR"];
       $hash2 = md5($hash1 . $ip);
       setcookie('secret', $hash1, time() + 3600);
       $_SESSION['user'] = 'hossein';
       $_SESSION['secret'] = $hash2;
       header('Location: welcome.php');

   }
   ?>
</form>
</body>
</html>