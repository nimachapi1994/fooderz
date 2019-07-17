<link type="text/css" rel="stylesheet" href="../Css/bootstrap.css">
<script type="text/javascript" src="../Js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="../Js/bootstrap.js"></script>

<?php include "../Shared/Top.php"?>

<?php
date_default_timezone_set('Asia/Tehran');
include_once '../../jdf/jdf.php';



if(isset($_POST["btninsert"]))
{
    if(!empty($_POST["name"])&&!empty($_POST["mobile1"])&&!empty($_POST["mobile2"])&&
!empty($_POST["phone"])&&!empty($_POST["OrderType"])&&!empty($_POST["sday"])&&
        !empty($_POST["smonth"])&&!empty($_POST["syear"])
    &&!empty($_POST["xday"])&&
        !empty($_POST["xmonth"])&&!empty($_POST["xyear"])&&!empty($_FILES["logo"])&&!empty($_FILES["contract"])
    &&!empty($_FILES["gallery"])&&!empty($_POST["dec"])&&!empty($_POST["brand"]))

    {

        $name=$_POST["name"];
        $mobile1=$_POST["mobile1"];
        $mobile2=$_POST["mobile2"];
        $phone=$_POST["phone"];
        $ordertype=$_POST["OrderType"];
        $brandname=$_POST["brand"];
        $startDate=($_POST["sday"]&&$_POST["smonth"]&&$_POST["syear"]!='')?
            jalali_to_gregorian('13'.$_POST["syear"],$_POST["smonth"],$_POST["sday"],"-"):'';
        $expDate=($_POST["xday"]&&$_POST["xmonth"]&&$_POST["xyear"]!='')?
            jalali_to_gregorian('13'.$_POST["xyear"],$_POST["xmonth"],$_POST["xday"],"-"):'';
        //LogoImg
        $FileFirstSave=$_FILES["logo"]["tmp_name"];
        $fileSaveToDb='/Fooderz/Fooderz.ir/Suppliers/Logo/'.$name.$mobile1.'-'. $_FILES["logo"]["name"];
        $filenameAndAddressTarget=$_SERVER["DOCUMENT_ROOT"].$fileSaveToDb;
        $description=$_POST["dec"];

        if(is_uploaded_file($FileFirstSave))
        {
            if(move_uploaded_file($FileFirstSave,$filenameAndAddressTarget))
            {
               echo '<meta http-equiv="refresh" content="0;url=NewSupp.php?ok=10">';
            }
        }
        //ContractImg
        $ContractImgFirstSaved=$_FILES["contract"]["tmp_name"];
        $ContractImgSavedToDb='/Fooderz/FooderzAdmin/Suppliers/ContractImg/'.$name.$mobile1.'--'.$_FILES["contract"]["name"];
        $ContractImgTargetAddress=$_SERVER["DOCUMENT_ROOT"].$ContractImgSavedToDb;
        if(is_uploaded_file($ContractImgFirstSaved))
        {
            move_uploaded_file($ContractImgFirstSaved,$ContractImgTargetAddress);
            echo '<meta http-equiv="refresh" content="0;url=NewSupp.php?ok=10">';
        }



//Img Gallery

        $dirName=$_POST["name"].'-'.$_POST["mobile1"];

        mkdir($_SERVER["DOCUMENT_ROOT"]."/Fooderz/Fooderz.ir/Suppliers/imgGallery/".$dirName);


        for ($i=0; $i<count($_FILES["gallery"]["tmp_name"]); $i++)
        {


            $k= $_FILES["gallery"]["tmp_name"][$i];
            $path='/Fooderz/Fooderz.ir/Suppliers/imgGallery/'.$dirName.'/'.$name.'--'. $_FILES["gallery"]["name"][$i];
            $Address=$_SERVER["DOCUMENT_ROOT"].$path;


            if(is_uploaded_file($k))
            {
                if(move_uploaded_file($k,$Address))
                {
                    echo '<meta http-equiv="refresh" content="0;url=NewSupp.php?ok=10">';
                }
            }

        }

        try
        {
            include "../../DataBase/PDO/DBconnect/DBconnect.php";
            $queryInsert="INSERT INTO
`suppliers`(nameAndfname, mobile1, mobile2, telephone, orderType,startdate,expdate,Logo,ContractImg,decription,brandName)
                      VALUES (:name,:mobile1,:mobile2,:phone,:ordertype,:startDate,:expDate,:fileSaveToDb,:ContractImgSavedToDb,:description,:brandname)";
            $stmt=$db->prepare($queryInsert);
            $arr=array
            (
                ':name'=>$name,
                ':mobile1'=>$mobile1,
                ':mobile2'=>$mobile2,
                ':phone'=>$phone,
                ':ordertype'=>$ordertype,
                ':startDate'=>$startDate,
                ':expDate'=>$expDate,
                ':fileSaveToDb'=>$fileSaveToDb,
                ':ContractImgSavedToDb'=>$ContractImgSavedToDb,
                ':description'=>$description,
                ':brandname'=>$brandname
            );
            $stmt->execute($arr);
            $errorInf=$db->errorInfo();

        }catch (Exception $ex)
        {
            $err=$ex->getMessage();
        }






    }



}








?>
<div style="margin: auto;width: 50%;border: 10px;border-radius: 10px">
    <h3 style="font-family: Tahoma;font-size: large" ><span style="color: blue;">ثبت</span> مرکز پخش یا عمده فروش  <span><img src="../image/car_scania.png" width="200"height="150"></span> </h3>


</div>



<form action="NewSupp.php"method="post"enctype="multipart/form-data">
    <div class="row" >
        <div class="col-md-2"></div>
        <div class="col-md-4"style="overflow: scroll;height: 60%">
            <div class="form-group">
                <?php
                    if(isset($_GET["ok"]))
                        echo '<span style="color:green;font-family: Tahoma;font-size: medium">
لوگو با موفقیت ذخیره شد.
</span>'
                ?>
                <br>
                <label class="control-label"id="lbllogo">لوگو</label>
                <input class="form-control"tabindex="6"type="file"name="logo" id="logo" onblur="f1('logo','لوگو')">
            </div>
            <div class="form-group">
                <?php
                if(isset($_GET["ok"]))
                    echo '<span style="color:green;font-family: Tahoma;font-size: medium">
قرارداد با موفقیت ذخیره شد.
</span>'
                ?>
<br>
                <label class="control-label"id="lblcontract">قرار داد</label>
                <input class="form-control"tabindex="7"type="file"name="contract"id="contract" onblur="f1('contract','قرار داد')">
            </div>
            <button type="button" class="btn btn-primary btn-block"id="btnModalIimagesGallery">گالری تصاویر</button><br>
            <div class="form-group">
                <label class="control-label"id="lbldec">توضیحات</label><br>
                <textarea style="height: 300px;width: 475px;max-width: 475px;max-height: 300px;min-width: 475px;min-height:300px "tabindex="8"name="dec" id="dec"onblur="f3('dec','توضیحات')" >


        </textarea>
            </div>

        </div>
        <div class="col-md-4"style="overflow: scroll;height: 60%">
            <div class="form-group">
                <label class="control-label"id="lblbrand">نام برند</label>
                <input class="form-control"tabindex="1"name="brand"id="brand" onblur="f1('brand','نام برند')">
            </div>
            <div class="form-group">
                <label class="control-label"id="lblname">نام و نام خانوادگی</label>
                <input class="form-control"tabindex="1"name="name"id="name" onblur="f1('name','نام و نام خانوادگی')">
            </div>
            <div class="form-group">
                <label class="control-label"id="lblmobile1">شماره موبایل اول</label>
                <input class="form-control"tabindex="2"name="mobile1"id="mobile1"onblur="f1('mobile1','شماره موبایل اول')"placeholder=" مثال: 09179999999   اقای محمدی  "
            <div class="form-group">
                <label class="control-label"id="lblmobile2">شماره موبایل دوم</label>
                <input class="form-control"tabindex="3"name="mobile2"id="mobile2"onblur="f1('mobile2','شماره موبایل دوم')"placeholder=" مثال: 09179999999   اقای محمدی  ">
            </div>
            <div class="form-group">
                <label class="control-label"id="lblphone">شماره تلفن ثابت</label>
                <input class="form-control"tabindex="4"name="phone"id="phone"onblur="f1('phone','شماره تلفن ثابت')">
            </div>
            <div class="form-group">
                <label class="control-label"id="lblOrderType">نوع فروش</label>
                <input class="form-control"tabindex="5"name="OrderType"id="OrderType"onblur="f1('OrderType','نوع فروش')">
            </div>
            <div class="form-inline"id="divsdate">
                <label class="control-label"id="lblsdate">تاریخ شروع فعالیت</label><br>

                <input minlength="2"  maxlength="2" style="border-color: #13a7ff;font-size: small;font-family:BYekan" size="8" tabindex="5"name="sday"id="sdate"onblur="f1('sdate','تاریخ شروع فعالیت')"placeholder="روز مثال 03">
                / <input maxlength="2" style="border-color: #13a7ff;font-size: small;font-family:BYekan"size="15" tabindex="5"name="smonth"id="smonth"onblur="f1('smonth','تاریخ شروع فعالیت')"placeholder="ماه مثال 09 یا 12 ">
                / <input maxlength="2" style="border-color: #13a7ff;font-size: small;font-family:BYekan "size="18" tabindex="5"name="syear"id="syear"onblur="f1('syear','تاریخ شروع فعالیت')"placeholder="سال مثال 97">


            </div>

            <br>
            <div class="form-group">
                <label class="control-label"id="lblxdate">تاریخ پایان فعالیت</label><br>
                <input maxlength="2" style="border-color: #13a7ff;font-size: small;font-family:BYekan" size="8" tabindex="5"name="xday"id="xdate"onblur="f1('xdate','تاریخ پایان فعالیت')"placeholder="روز">
                / <input maxlength="2" style="border-color: #13a7ff;font-size: small;font-family:BYekan "size="15" tabindex="5"name="xmonth"id="xmonth"onblur="f1('xmonth','تاریخ پایان فعالیت')"placeholder="ماه">
                / <input maxlength="2"  style="border-color: #13a7ff;font-size: small;font-family:BYekan "size="18" tabindex="5"name="xyear"id="xyear"onblur="f1('xyear','تاریخ پایان فعالیت')"placeholder="سال">

            </div>


        </div>
        <div class="col-md-2"></div>
    </div>
    <br>
    <div class="modal fade" role="dialog" id="modalGallery">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="container text-center"style="font-family: Tahoma">                گالری تصاویر

                    </h2>
                    <div class="modal-body">

                        <div class="form-group">
                            <label class="control-label">انتخاب چند عکس</label>
                            <button type="button"class="btn btn-danger btn-xs"id="btnDeleteAllGalleryFilesSelected">&times;</button>
                            <input id="txtGetGalleryImg"name="gallery[]"  multiple class="form-control"tabindex="7"type="file">
                        </div>
                        <div class="form-group">
                            <label class="control-label">تصاویر</label>
                            <div id="divshowimg">

                            </div>
                        </div>
<!--                        <button class="btn btn-primary btn-block"name="btnInsertGallery">ثبت و ذخیره</button>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container text-center"style="width: 30%">
        <button class="btn btn-primary btn-block"id="btninsert"name="btninsert">ثبت و ذخیره</button>
    </div> <br> <br>
    <br><br>
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