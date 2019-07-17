
<!DOCTYPE html>
<html lang="en">
<head>
    <title>ثبت نام رستوران</title>
    <!-- custom-theme -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- //custom-theme -->
    <link href="css/other_styles.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" /><!-- Theme-CSS -->
    <link rel="shortcut icon" type="image/x-icon" href="css/images/logo.png">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script>
        // validation of registration form
        $(document).ready(function(){
            $('#msg1').hide();
            //if (fullName.value != '' && email.value != '' && message.value != '')
            {
                $("#sub").click(function () {
                    $.post("validate.php", $('#theForm').serialize(),
                        function (ex) {
                            //if (ex == 'پیام شما با موفقیت ارسال شد!!!') document.getElementById("divCm").className = "alert alert-success";
                            alert(ex)
                            $(msg1).show();
                            $(msg1).html(ex);
                        });
                });
            }
        });
        prvArr=Array(`--نوع ارایه خدمات--`, 'رستوران', 'کافی شاپ', 'پزندگی', 'کله پزی');
        resArr=Array('--نوع رستوران--', 'ایرانی', 'فرنگی', 'دریایی', 'فست فود', 'چینی', 'غیره');

        function t()
        {
            alert("dd");
            let prvkey=document.getElementById('provType').value;
            let resKey=document.getElementById('resType').value;
            if (prvkey == 0)
            {
                document.getElementById('prvErr').innerHTML='لطفا نوع خدمات خود را انتخاب کنید!';
            }
            else
            {
                document.getElementById('prvErr').innerHTML=null;
                if (prvkey != 1)
                {
                    document.getElementById('resType').hidden=true;
                }
                else
                {
                    if (resKey == 0)
                    {
                        document.getElementById('resErr').innerHTML='لطفا نوع رستوران را انتخاب کنید!';
                    }
                    document.getElementById('resType').removeAttribute('hidden');
                    document.getElementById('resType').innerHTML=null;
                    for (let i=0; i<resArr.length; i++)
                    {

                        document.getElementById('resType').innerHTML+="<option value='" + i + "'>" + resArr[i] + "</option>";
                    }
                }
            }


        }

        function regFunc(myPattern, myId, msgId, err)
        {
            let valueId=document.getElementById(myId).value;
            if (valueId == '')
            {
                document.getElementById(msgId).innerHTML='تکمیل این فیلد اجباری است';
                document.getElementById(myId).style.borderColor='red';
            }
            else if (myPattern.test(valueId))
            {
                document.getElementById(msgId).innerHTML='ok';
                document.getElementById(myId).style.borderColor='black';
            }
            else
            {
                document.getElementById(msgId).innerHTML=err;
                document.getElementById(myId).style.borderColor='red';
            }
        }

        function regExec()
        {
            let arr=
                [
                    [/^[0-9]$/, 'resName', 'msg', 'ارور'],
                    [/^[a-z]$/, 'mngrName', 'msg1', 'ارور ۱'],
                ];
            for (let i=0; i<arr.length; i++)
            {
                let j=0;
                regFunc(arr[i][j], arr[i][++j], arr[i][++j], arr[i][++j]);
            }
        }

    </script>

</head>

<body style="background: url('images/restaurant_register_back.jpg')">
<!-- mobile menu -->
<div class="menu_transparent_layer"></div>
<?php
include 'mobile_Menu_Top.php';
 include 'header_Top.php';
?>

<div class="text-center">
    <div class="container">
        <div class="col-md-12 register-icon">

            <p>
                از طریق فرم زیر ، رستوران خود را در فودرز ثبت کنید و سفارشات خود را آنلاین دریافت کنید
            </p>
            <img src="images/cook.png" alt="">
        </div>
    </div>
    <div class="a">
        <form id="theForm" name="theForm" method="post" class="restaurant_register">
            <div class="input-container">
                <div class="input-icon"><i class="fa fa-home"></i></div>
                <input name="resName" id="resName" class="with-icon" type="text" placeholder="نام رستوران"
                       onblur="regFunc(/./, 'resName', 'resNameErr', 'شماره تلفن اشتباه است!')" />
                <p class="validation" id="resNameErr"></p>
            </div>

            <div class="input-container">
                <div class="input-icon"><i class="fa fa-user"></i></div>
                <input class="with-icon" type="text" name="mngrName" id="mngrName" placeholder="نام مدیر رستوران"
                       onblur="regFunc(/./, 'mngrName', 'mngrNameErr', 'شماره تلفن اشتباه است!')" />
                <p class="validation" id="mngrNameErr"></p>
            </div>

            <div class="input-container">
                <div class="input-icon"><i class="fa fa-building"></i></div>
                <select class="register" name="city" id="city">
                    <option>shiraz</option>
                </select>
            </div>

            <div class="input-container">
                <div class="input-icon"><i class="fa fa-map-marker"></i></div>
                <input class="with-icon" type="text" name="address" id="address" placeholder="آدرس" />
            </div>

            <div class="input-container">
                <div class="input-icon"><i class="fa fa-phone"></i></div>
                <input class="with-icon" type="text" name="phone" id="phone" placeholder="شماره تلفن"
                       onblur="regFunc(/^0[0-9]{10}$/, 'phone', 'phoneErr', 'شماره تلفن اشتباه است!')" />
                <p class="validation" id="phoneErr"></p>
            </div>

            <div class="input-container">
                <div class="input-icon"><i class="fa fa-phone"></i></div>
                <input class="with-icon" type="text" name="mobile" id="mobile" placeholder="شماره موبایل"
                       onblur="regFunc(/^0[0-9]{10}$/, 'mobile', 'mobileErr', 'شماره تلفن اشتباه است!')" />
                <p class="validation" id="mobileErr"></p>
            </div>

            <div class="input-container">
                <div class="input-icon"><i class="fa fa-check-circle"></i></div>
                <select class="register" name="provType" id="provType" onchange="t()">
                    <script>
                        for (let i=0; i<prvArr.length; i++)
                        {
                            document.write("<option value='" + prvArr[i] + "'>" + prvArr[i] + "</option>");
                        }
                    </script>
                </select>
                <p class="validation" id="prvErr"></p>
            </div>

            <div class="input-container" id="resTypeDiv" hidden="hidden">
                <p class="full_width" id="resErr"></p>
                <div class="input-icon"><i class="fa fa-check-circle"></i></div>
                <select class="register full_width" name="resType" id="resType"  onclick="resErr.innerHTML=''">
                    <script>

                    </script>
                </select>
                <p class="validation" id="resTypeErr"></p>
            </div>


            <textarea name="desc" id="desc" class="register" placeholder="توضیحات ..."></textarea>

            <div class="text-center">
                <input type="button" name="sub" value="ثبت رستوران" id="sub" class="btn btn-primary fooderz_btn full_width" />
            </div>

            <input name="hidden_coords" type="text" id="hidden_coords" hidden />
        </form>
    </div>

    <!-- successful confirmation box -->
    <div class="container">
        <div id="ok" class="confirm-box text-center">
            <i class="fa fa-check confirm-check"></i>
            با تشکر <br />
            رستوران شما با موفقیت در سامانه فودرز ثبت گردید
        </div>
    </div>
</div>

<!-- footer -->
<footer class="fooderz-footer internal_pages register">
    <div class="container">
        <div class="row no-margin">
            <h4 class="text-center">با فودرز، طعم راحتی و اعتماد را در خرید الکترونیکی بچشید.</h4>
            <br /><br />
            <div class="col-md-4">
                <div class="footer-nav">
                    <h3 class="footer-title">لینک های مفید</h3>
                    <ul>
                        <li><a href="contact.php">تماس با ما</li>
                        <li><a href="about.php">درباره ما</li>
                        <li><a href="faq.php">قوانین</li>
                        <!--								<li><a href="">راهنمای جامع خرید</li>-->
                        <!--								<li><a href="">وبلاگ فودرز</li>-->
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="social text-center">
                    <h3 class="footer-title text-center">آدرس ما در شبکه های اجتماعی</h3>
                    <a title="اینستاگرام" class="social-link" href="">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 551.034 551.034">
                            <linearGradient id="SVGID_1_" gradientUnits="userSpaceOnUse" x1="275.517" y1="4.57" x2="275.517" y2="549.72" gradientTransform="matrix(1 0 0 -1 0 554)">
                                <stop offset="0" style="stop-color:#E09B3D"/>
                                <stop offset="0.3" style="stop-color:#C74C4D"/>
                                <stop offset="0.6" style="stop-color:#C21975"/>
                                <stop offset="1" style="stop-color:#7024C4"/>
                            </linearGradient>
                            <path style="fill:url(#SVGID_1_);" d="M386.878,0H164.156C73.64,0,0,73.64,0,164.156v222.722   c0,90.516,73.64,164.156,164.156,164.156h222.722c90.516,0,164.156-73.64,164.156-164.156V164.156   C551.033,73.64,477.393,0,386.878,0z M495.6,386.878c0,60.045-48.677,108.722-108.722,108.722H164.156   c-60.045,0-108.722-48.677-108.722-108.722V164.156c0-60.046,48.677-108.722,108.722-108.722h222.722   c60.045,0,108.722,48.676,108.722,108.722L495.6,386.878L495.6,386.878z"/>

                            <linearGradient id="SVGID_2_" gradientUnits="userSpaceOnUse" x1="275.517" y1="4.57" x2="275.517" y2="549.72" gradientTransform="matrix(1 0 0 -1 0 554)">
                                <stop offset="0" style="stop-color:#E09B3D"/>
                                <stop offset="0.3" style="stop-color:#C74C4D"/>
                                <stop offset="0.6" style="stop-color:#C21975"/>
                                <stop offset="1" style="stop-color:#7024C4"/>
                            </linearGradient>
                            <path style="fill:url(#SVGID_2_);" d="M275.517,133C196.933,133,133,196.933,133,275.516s63.933,142.517,142.517,142.517   S418.034,354.1,418.034,275.516S354.101,133,275.517,133z M275.517,362.6c-48.095,0-87.083-38.988-87.083-87.083   s38.989-87.083,87.083-87.083c48.095,0,87.083,38.988,87.083,87.083C362.6,323.611,323.611,362.6,275.517,362.6z"/>

                            <linearGradient id="SVGID_3_" gradientUnits="userSpaceOnUse" x1="418.31" y1="4.57" x2="418.31" y2="549.72" gradientTransform="matrix(1 0 0 -1 0 554)">
                                <stop offset="0" style="stop-color:#E09B3D"/>
                                <stop offset="0.3" style="stop-color:#C74C4D"/>
                                <stop offset="0.6" style="stop-color:#C21975"/>
                                <stop offset="1" style="stop-color:#7024C4"/>
                            </linearGradient>
                            <circle style="fill:url(#SVGID_3_);" cx="418.31" cy="134.07" r="34.15"/>
                        </svg>
                    </a>
                    <a title="تلگرام" class="social-link" href="">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"viewBox="0 0 300 300">
                            <path id="XMLID_497_" d="M5.299,144.645l69.126,25.8l26.756,86.047c1.712,5.511,8.451,7.548,12.924,3.891l38.532-31.412   c4.039-3.291,9.792-3.455,14.013-0.391l69.498,50.457c4.785,3.478,11.564,0.856,12.764-4.926L299.823,29.22   c1.31-6.316-4.896-11.585-10.91-9.259L5.218,129.402C-1.783,132.102-1.722,142.014,5.299,144.645z M96.869,156.711l135.098-83.207   c2.428-1.491,4.926,1.792,2.841,3.726L123.313,180.87c-3.919,3.648-6.447,8.53-7.163,13.829l-3.798,28.146   c-0.503,3.758-5.782,4.131-6.819,0.494l-14.607-51.325C89.253,166.16,91.691,159.907,96.869,156.711z" fill="#5295c4"/>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <h3 class="footer-title text-center">نمادهای اعتبار</h3>
                <div class="namad text-center owl-carousel">
                    <div class="item">
                        <img src="images/namad.png" alt="namad" />
                    </div>
                    <div class="item">
                        <img src="images/namad.png" alt="namad" />
                    </div>
                    <div class="item">
                        <img src="images/namad.png" alt="namad" />
                    </div>
                </div>
            </div>
            <div class="copyright text-center">کپی رایت2018&copy;<br>
                تمام حقوق متعلق به فودرز می باشد.
            </div>
        </div>
    </div>
</footer>
</div>

<!-- login modal -->
<?php
include 'partialCode_LoginModal.php';
?>

<!-- /modals -->
<p id="msg1"></p>
<!-- /modals -->
<!--<script src="js/plugins.min.js"></script>-->
<!--<script src="js/layout.js"></script>-->
<!--<script src="js/conv.js"></script>-->
<!--<script src="js/restaurant-register.js"></script>-->


</body>
</html>