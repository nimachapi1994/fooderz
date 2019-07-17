<?php
/**
 * Created by PhpStorm.
 * User: unixname
 * Date: 8/1/18
 * Time: 3:32 PM
 */
//begin of file
$milliseconds1 = round(microtime(true) * 1000);







//end of file
$milliseconds2 = round(microtime(true) * 1000);
$milliseconds = $milliseconds2-$milliseconds1;
echo $milliseconds;