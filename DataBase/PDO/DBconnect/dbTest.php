<?php
/**
 * Created by PhpStorm.
 * User: unixname
 * Date: 8/1/18
 * Time: 3:06 PM
 */
try
{
    require_once 'DBconnect.php';
} catch (Exception $e)
{
    $error = $e->getMessage();
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
if ($db)
{
    echo '<h1>connection successfully</h1>';
} elseif ($error)
{
    echo $error;
}
?>
</body>
</html>
