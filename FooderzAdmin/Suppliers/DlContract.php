<?php
$conn=mysqli_connect("localhost","root","","vmzonuak_fooderz1","3306");
mysqli_set_charset($conn,"uft8");
if(mysqli_connect_errno($conn)){
    die("");
}else  {
    echo "";
}

if(isset($_POST["dl"]))
{
    if(!empty($_POST["name"]))
    {



       $filename=basename(str_replace(substr($_POST["name"],0,44),"",substr($_POST["name"],0,100)));

       $filePath= substr($_POST["name"],0,44).$filename;


        if(!empty($fileName) && file_exists($filePath)){
            // Define headers
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$fileName");
            header("Content-Type: image/jpg");
            header("Content-Transfer-Encoding: binary");

            // Read the file
            readfile($filePath);

            exit;
        }else{
            echo '';
        }


    }
}