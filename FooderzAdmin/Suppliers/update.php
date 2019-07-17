<link type="text/css" rel="stylesheet" href="../Css/bootstrap.css">
<script type="text/javascript" src="../Js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="../Js/bootstrap.js"></script>

<?php include "../Shared/Top.php"?>

<?php
date_default_timezone_set('Asia/Tehran');
include_once '../../jdf/jdf.php';


include "../../DataBase/PDO/DBconnect/DBconnect.php";



//if(isset($_GET["updatesupp"]))
{

    if(!empty($_GET["goid"]))
    {
        $GLOBALS['id']=$_GET["goid"];
//        die($id);
    }
   try{
       $querySelect=
           "select * from suppliers where id=:id";
       $pdoSelect=$db->prepare($querySelect);
       $arrselect=[":id"=>$id];
       $pdoSelect->execute($arrselect);
   }catch (Exception $ex)
   {
       $err1=$ex->getMessage();
   }
}













?>
<div style="margin: auto;width: 50%;border: 10px;border-radius: 10px">
    <h3 style="font-family: Tahoma;font-size: large" ><span style="color: blue;">ثبت</span> مرکز پخش یا عمده فروش  <span><img src="../image/car_scania.png" width="200"height="150"></span> </h3>


</div>






    <form action="f.php" method="post" enctype="multipart/form-data">
        <?php
        $row=$pdoSelect->fetch();
        {


        ?>
        <div class="row">

            <div class="col-md-2"></div>
            <div class="col-md-4" style="overflow: scroll;height: 60%">
                <div class="form-group">
                    <?php
                    if (isset($_GET["ok"]))
                        echo '<span style="color:green;font-family: Tahoma;font-size: medium">
لوگو با موفقیت ذخیره شد.
</span>'
                    ?>
                    <br>
                    <label class="control-label" id="lbllogo">لوگو</label>
                    <input class="form-control" tabindex="6" type="file" name="logo" id="logo"
                       onblur="f1('logo','لوگو')">
                    <div class="container text-center" style="margin: auto;text-align: center" id="divgetlogo">
                        <button type="button" id="btndeletelogo">&times;</button>
                        <img id="imglogo" src="<?php echo $row["logo"] ;  ?>"style="width:150px;height: 150px">
                    </div>
                    <script>
                        $(btndeletelogo).click(function () {
                            imglogo.src='';
                            imglogo.value='';
                            logo.src='';
                            logo.value='';
                            $(imglogo).hide();
                            $(this).hide();
                        })
                    </script>
                </div>
                <div class="form-group">
                    <?php
                    if (isset($_GET["ok"]))
                        echo '<span style="color:green;font-family: Tahoma;font-size: medium">
قرارداد با موفقیت ذخیره شد.
</span>'
                    ?>
                    <br>
                    <label class="control-label" id="lblcontract">قرار داد</label>
                    <span style="padding-right: 3%"><a   href="<?php echo $row["contractImg"] ;  ?>"target="_blank" class="btn btn-primary" type="button" id="btndeletelogo">دریافت قرار داد</a></span>
                    <br><br>

                    <input class="form-control" tabindex="7" type="file" name="contract" id="contract"
                           onblur="f1('contract','قرار داد')">


                </div>
                <button type="button" class="btn btn-primary btn-block" id="btnModalIimagesGallery">گالری تصاویر
                </button>
                <br>
                <div class="form-group">
                    <label class="control-label" id="lbldec">توضیحات</label><br>
                    <textarea
                            style="height: 300px;width: 475px;max-width: 475px;max-height: 300px;min-width: 475px;min-height:300px "
                            tabindex="8" name="dec" id="dec" onblur="f3('dec','توضیحات')">

<?php
echo $row["decription"];
?>
        </textarea>
                </div>

            </div>
            <div class="col-md-4" style="overflow: scroll;height: 60%">
                <div class="form-group">
                    <label class="control-label" id="lblname">نام و نام خانوادگی</label>
                    <input class="form-control" tabindex="1" name="name" id="name"value="<?php echo $row["nameAndfname"]; ?>"
                           onblur="f1('name','نام و نام خانوادگی')">
                </div>
                <div class="form-group">
                    <label class="control-label" id="lblmobile1">شماره موبایل اول</label>
                    <input class="form-control" tabindex="2" name="mobile1" id="mobile1" value="<?php echo $row["mobile1"]; ?>"
                           onblur="f1('mobile1','شماره موبایل اول')" placeholder=" مثال: 09179999999   اقای محمدی  "
                    <div class="form-group">
                        <label class="control-label" id="lblmobile2">شماره موبایل دوم</label>
                        <input class="form-control" tabindex="3" name="mobile2" id="mobile2"value="<?php echo $row["mobile2"]; ?>"
                               onblur="f1('mobile2','شماره موبایل دوم')"
                               placeholder=" مثال: 09179999999   اقای محمدی  ">
                    </div>
                    <div class="form-group">
                        <label class="control-label" id="lblphone">شماره تلفن ثابت</label>
                        <input class="form-control" tabindex="4" name="phone" id="phone"value="<?php echo $row["telephone"]; ?>"
                               onblur="f1('phone','شماره تلفن ثابت')">
                    </div>
                    <div class="form-group">
                        <label class="control-label" id="lblOrderType">نوع فروش</label>
                        <input class="form-control" tabindex="5" name="OrderType" id="OrderType"value="<?php echo $row["orderType"]; ?>"
                               onblur="f1('OrderType','نوع فروش')">
                    </div>
                    <div class="form-inline" id="divsdate">
                        <?php
                        $okdate1='';
                        if($row["expdate"]!="0000,00,00")
                        {
                            $date=strtotime($row["expdate"]);
                            $year=date("Y",$date);
                            $month=date("m",$date);
                            $day=date("d",$date);
                            $okdate1=gregorian_to_jalali($year,$month,$day);
                        }
                        $okdate2='';
                        if($row["startdate"]!="0000,00,00")
                        {
                            $date1=strtotime($row["startdate"]);
                            $year1=date("Y",$date1);
                            $month1=date("m",$date1);
                            $day1=date("d",$date1);
                            $okdate2=gregorian_to_jalali($year1,$month1,$day1);
                        }

                         ?>
                        <label class="control-label" id="lblsdate">تاریخ شروع فعالیت</label><br>

                        <input style="border-color: #13a7ff;font-size: small;font-family:BYekan" size="8" tabindex="5"value="<?php echo  $okdate1[2] ;?>"
                               name="sday" id="sdate" onblur="f1('sdate','تاریخ شروع فعالیت')" placeholder="روز">
                        / <input style="border-color: #13a7ff;font-size: small;font-family:BYekan" size="15"value="<?php echo  $okdate1[1] ;?>"
                                 tabindex="5" name="smonth" id="smonth" onblur="f1('smonth','تاریخ شروع فعالیت')"
                                 placeholder="ماه">
                        / <input style="border-color: #13a7ff;font-size: small;font-family:BYekan " size="18"value="<?php echo  $okdate1[0] ;?>"
                                 tabindex="5" name="syear" id="syear" onblur="f1('syear','تاریخ شروع فعالیت')"
                                 placeholder="سال">


                    </div>

                    <br>
                    <div class="form-group">
                        <label class="control-label" id="lblxdate">تاریخ پایان فعالیت</label><br>
                        <input style="border-color: #13a7ff;font-size: small;font-family:BYekan" size="8" tabindex="5"
                               name="xday" id="xdate" onblur="f1('xdate','تاریخ پایان فعالیت')" placeholder="روز"value="<?php echo  $okdate2[2] ;?>">
                        / <input style="border-color: #13a7ff;font-size: small;font-family:BYekan " size="15"
                                 tabindex="5" name="xmonth" id="xmonth" onblur="f1('xmonth','تاریخ پایان فعالیت')"value="<?php echo  $okdate2[1] ;?>""
                                 placeholder="ماه">
                        / <input style="border-color: #13a7ff;font-size: small;font-family:BYekan " size="18"
                                 tabindex="5" name="xyear" id="xyear" onblur="f1('xyear','تاریخ پایان فعالیت')"value="<?php echo  $okdate2[0] ;?>""
                                 placeholder="سال">

                    </div>


                </div>
                <div class="col-md-2"></div>
            </div>
            <br>
            <div class="modal fade" role="dialog" id="modalGallery">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="container text-center" style="font-family: Tahoma"> گالری تصاویر

                            </h2>
                            <div class="modal-body">

                                <div class="form-group">
                                    <label class="control-label">انتخاب چند عکس</label>
                                    <button type="button" class="btn btn-danger btn-xs"
                                            id="btnDeleteAllGalleryFilesSelected">&times;
                                    </button>
                                    <input id="txtGetGalleryImg" name="gallery[]" multiple class="form-control"
                                           tabindex="7" type="file">
                                    <br>
                                    <button type="button"class="btn btn-warning btn-xs" id="btndeletegallery">&times;</button>
                                </div>
                                <?php
//                                $dirName=$_POST[""].'-'.$_POST["mobile1"];
//                                $path='/Fooderz/Fooderz.ir/Suppliers/imgGallery/'.$dirName.'/'.$name.'--';
                                $p='/Fooderz/Fooderz.ir/Suppliers/imgGallery/'.$row["nameAndfname"].'-'.$row["mobile1"].'/';
                                $path=$_SERVER["DOCUMENT_ROOT"].$p;



//

                                ?>

                                <div class="form-group">
                                    <label class="control-label">تصاویر</label>
                                    <?php
                                    $scanArr = scandir($path);
//                                    print_r($scanArr);
                                    unset($scanArr[0],$scanArr[1]);
                                    foreach ($scanArr as $v)
                                    {
                                        echo "<img id='imggallery' width='250px' src=".$p.$v.">";
                                    }

                                    ?>
                                    <div id="divshowimg">

                                    </div>
                                    <script>
                                        $(btndeletegallery).click(function () {
                                            imggallery.src='';
                                            $(imggallery).hide()
                                        })
                                    </script>
                                </div>
                                <!--                        <button class="btn btn-primary btn-block"name="btnInsertGallery">ثبت و ذخیره</button>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container text-center" style="width: 30%">
                <button class="btn btn-primary btn-block" id="btninsert" name="btnupdate">ثبت و ذخیره</button>
            </div>
            <br> <br>
            <br><br>
        </div>
            <?php
        }
        ?>

    </form>


<script>

    $(function () {
        let count=1;
        $(txtGetGalleryImg).change(function () {

            for (var i = 0; i < txtGetGalleryImg.files.length; i++) {

                var reader = new FileReader();
                reader.readAsDataURL(txtGetGalleryImg.files[i]);
                reader.onloadend = function (ex) {
                    count +=1;
                    $(divshowimg).append(' <img src="'
                        + ex.target.result +
                        '" id="ctrlimg" class="img-thumbnail" width="150" name="imgGallery--'+count+'"  height="150"/>')
                }
            }
        })
    })
</script>

<script>
    $(btnDeleteAllGalleryFilesSelected).click(()=>
    {
        $(txtGetGalleryImg).attr("src",'');
        $(txtGetGalleryImg).val('');
        $(divshowimg).html('')
    })
</script>
<script>
    $(btnModalIimagesGallery).click(()=>{
        $(modalGallery).modal();
    })
</script>
<script>
    function f1(GetId,lbl)
    {
        if(document.getElementById(GetId).value=="")
        {
            let tag='<span style="color:red">'+lbl+'</span>';
            let str="  مقدار فیلد "+ tag +" خالی است ";
            document.getElementById('lbl'+GetId).innerHTML=str;
        }else{
            let tag='<span style="color:green">'+lbl+'</span>';

            document.getElementById('lbl'+GetId).innerHTML=tag;
        }
    }
    function f3(GetId,lbl)
    {

        if(document.getElementById(GetId).innerText=="")
        {
            let tag='<span style="color:red">'+lbl+'</span>';
            let str="  مقدار فیلد "+ tag +" خالی است ";
            document.getElementById('lbl'+GetId).innerHTML=str;
        }else{
            if(document.getElementById(GetId).value=="")
            {
                let tag='<span style="color:green">'+lbl+'</span>';

                document.getElementById('lbl'+GetId).innerHTML=tag;
            }
        }

    }

</script>
<?php include "../Shared/Bottom.php"?>