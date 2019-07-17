<?php
session_start();
/**
 * Created by PhpStorm.
 * User: unixname
 * Date: 8/18/18
 * Time: 8:41 PM
 */

if ($_SESSION['rnd'] == $_GET['rnd']) echo "ok";
else echo "shit";
unset($_SESSION['rnd']);
//echo "<br>";
//echo "get is: ".print_r($_GET);