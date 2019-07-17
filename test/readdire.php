<?php
$dir = $_SERVER['DOCUMENT_ROOT'] . "/fooderz/images/logo/1092/";
// echo $dir;
if (is_dir($dir))
{
	{
		$file = scandir($dir,1);
		//var_dump($file);
	}
}
echo getcwd();

$files = glob($dir."*");
foreach($files as $file){ // iterate files
  if(is_file($file))
    unlink($file); // delete file
}
?>