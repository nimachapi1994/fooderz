<!DOCTYPE html>
<html lang="en">
<head>


    <title>تماس با ما</title>
    <!-- custom-theme -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- //custom-theme -->
    <link href="css/other_styles.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" /><!-- Theme-CSS -->
    <link rel="shortcut icon" type="image/x-icon" href="css/images/logo.png">
    <script src="js/plugins.min.js"></script>

</head>
<body class="pages_body">
<!-- mobile menu -->
<div class="menu_transparent_layer"></div>
<?php
include 'mobile_Menu_Top.php';
include 'header_Top.php';
?>
<img class="menu_head" src="images/menu_head-min.jpg" alt="" />
<img class="menu_footer" src="images/footer.jpg" alt="" />
<div class="fooderz-total-container">
    <!-- contact -->
    <div class="contact">
        <div class="container">
            <div class="col-md-12">
                <h2 class="heading">تماس با ما</h2>
            </div>
            <br />
            <div class="contact-agileinfo">
                <div id="divGetMsgSended"></div>
                <div class="col-md-7 contact-right">
                    <!-- <form action="#" method="post" id="contactFrm"> -->
                    <label class="validation_label_contact" id="lblname"></label>
                    <input type="text"aria-required="true"onblur="funReg1('fname','lblname','مقدار فیلد خالی است','مقدار ورودی فیلد نا صحیح است')"id="fname" name="fname" placeholder="نام ">
                    <label class="validation_label_contact" id="lblEmail" ></label>
                    <input type="email"id="Email" class="email"
                           onblur="funReg(/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/,'Email','lblEmail','مقدار فیلد خالی است','مقدار ورودی فیلد نا صحیح است')"name="Email" placeholder="ایمیل">
                    <label class="validation_label_contact" id="lblPhone" ></label>
                    <input type="text"id="phone" name="Phone"
                           onblur="funReg(/^0[0-9]{10}$/,'phone','lblPhone','مقدار فیلد خالی است','مقدار ورودی فیلد نا صحیح است')"placeholder="شماره تلفن" >
                    <label class="validation_label_contact" id="lblTxt" ></label>
                    <textarea id="Txt" name="Message"
                              onblur="funReg1('Txt','lblTxt','مقدار فیلد خالی است','مقدار ورودی فیلد نا صحیح است')"placeholder="متن پیام" name="" ></textarea>
                    <input type="submit"‌ class="fooderz_btn" value="ارسال" id="btnsend">
                    <!-- </form> -->
                </div>
                <script>
                    $(btnsend).click(function(){

                        $.post('contactAjax.php',{fname:$(fname).val(),email:$(Email).val()
                            ,phone:$(phone).val(),txt:$(Txt).val()},function(ex,ss)
                        {


                            divGetMsgSended.innerHTML=ex;

                        })

                    })
                </script>
                <script>
                    function funReg(pattren, tagId, lblShow, msgEmpty,msgNotMatch)
                    {
                        inp_Id=document.getElementById(tagId).value;

                        if(inp_Id=='')
                        {
                            document.getElementById(lblShow).innerHTML=msgEmpty;
                        }else{
                            if(pattren.test(inp_Id))
                            {

                                // document.getElementById(tagId).style.color='green';
                                document.getElementById(lblShow).innerHTML=''
                            }else
                            {
                                document.getElementById(lblShow).innerHTML=msgNotMatch;
                            }
                        }


                    }
                    function funReg1( tagId, lblShow, msgEmpty)
                    {
                        inp_Id=document.getElementById(tagId).value;

                        if(inp_Id=='')
                        {
                            document.getElementById(lblShow).innerHTML=msgEmpty;
                        }else{
                            if(inp_Id!='')
                            {

                                document.getElementById(tagId).style.color='green';
                                document.getElementById(lblShow).innerHTML=''
                            }

                        }


                    }
                </script>


                <div class="col-md-5 contact-left">
                    <div class="address">
                        <h5>آدرس دفتر مرکزی</h5>
                        <p><i class="glyphicon glyphicon-home"></i> شیراز، تقاطع خیابان عفیف آباد و قصرالدشت</p>
                    </div>
                    <div class="address address-mdl">
                        <h5>شماره های تماس با پشتیبانی</h5>
                        <p><i class="glyphicon glyphicon-earphone"></i> 07138222222</p>
                        <p><i class="glyphicon glyphicon-phone"></i> 07138446566</p>
                    </div>
                    <div class="address">
                        <h5>پست الکترونیکی</h5>
                        <p><i class="glyphicon glyphicon-envelope"></i> <a href="mailto:info@example.com">mail@example.com</a></p>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>


            <!-- questions -->
            <h1 class="main-title text-center">سوالات متداول</h1>
            <section>
                <ul class="container anim-label-4 anim-art ">

                    <li>
                        <input type="radio" id="ac-1" name="ac-3D" checked="checked"/>
                        <label for="ac-1" onclick="" title="پروفایل چیست؟">پروفایل چیست؟</label>
                        <article>
                            <p>
                                پروفایل شامل اطلاعات ارتباطی – آدرس و لوکیشن(موقعیت جغرافیایی شما) است که باید قبل از عملیات ثبت سفارش آنها را بصورت کامل تکمیل کنید.
                            </p>
                        </article>
                    </li>

                    <li>
                        <input type="radio" id="ac-2" name="ac-3D"/>
                        <label for="ac-2" onclick="" title="چگونه سفارش ثبت کنم؟">چگونه سفارش ثبت کنم؟</label>
                        <article>
                            <p>
                                جهت سفارش ابتدا باید در سایت فودرز ثبت نام کنید و بعد از آن می توانید غذای مورد نظر خود را در قسمت جستجوی صفحه اصلی پیدا کرده یا بر روی دکمه ی دایره ای قرمز رنگ کلیک کرده تا لیست رستوران های اطراف خود را پیدا کنید بعد از آن بر روی منوی غذایی رستوران ها رفته و توسط علامت مثبتی که کنار هر غذا است آنرا انتخاب کرده و به سبد خرید خود اضافه کنید بعد از انجام این مرحله باید اطلاعات ارتباطی شامل:(لوکشین – شماره تماس – آدرس)خود را ثبت کرده یا قبل اقدام برای خرید اطلاعات مربوط به پروفایل خود را ثبت کنید و بعد از اینکه سبد خرید و اطلاعات شخصی خود را ثبت کردید به درگاه پرداخت بانکی متصل میشود هزینه را بصورت آنلاین پرداخت کرده و غذای مورد نظر با پیک رستوران به همان آدرس و لوکیشن شما ارسال میشود.
                            </p>
                        </article>
                    </li>



                    <li>
                        <input type="radio" id="ac-3" name="ac-3D"/>
                        <label for="ac-3" onclick="" title="محدوده منطقه ای چیست؟">محدوده منطقه ای چیست؟</label>
                        <article>
                            <p>
                                محدوده منطقه ای در صفحه هر رستوران با عنوان محدوده ها مشخص شده است که اگر شما در آن محدوده ها قرار دارید هزینه ارسال غذا از همان رستوران رایگان می باشد. درصورتی که خارج از آن محدوده ها باشید هزینه ارسال پیک جداگانه حساب می شود.
                            </p>
                        </article>
                    </li>
                    <li>
                        <input type="radio" id="ac-4" name="ac-3D"/>
                        <label for="ac-4" onclick="" title="چه ساعتی اقدام به سفارش کنیم؟">چه ساعتی اقدام به سفارش کنیم؟</label>
                        <article>
                            <p>

                                زمان سفارش بر اساس بازه زمانی هر رستوران می باشد و شما باید در آن زمان اقدام به سفارش نمایید.

                            </p>
                        </article>
                    </li>


                    <li>
                        <input type="radio" id="ac-5" name="ac-3D"/>
                        <label for="ac-5" onclick="" title="روش پرداخت چگونه است؟">روش پرداخت چگونه است؟</label>
                        <article>
                            <p>

                                -پرداخت آنلاین از طریق درگاه بانک ملت توسط تمام کارت‌های عضو شتاب
                                <br>
                                -پرداخت اعتباری از طریق کیف پول شخصی که در حساب کاربری شما وجود دارد(Fooderz wallet)


                            </p>
                        </article>
                    </li>

                    <li>
                        <input type="radio" id="ac-6" name="ac-3D"/>
                        <label for="ac-6" onclick="" title="آیا می توان از طریق تلفن در فودرز سفارش ثبت کرد؟">آیا می توان از طریق تلفن در فودرز سفارش ثبت کرد؟</label>
                        <article>
                            <p>
                                خیر شما باید بصورت آنلاین و فقط در سامانه(سایت , اپ یا ربات تلگرام فودرز)
                                اقدام به سفارش نمایید. تماس تلفنی صرفا جهت پیگیری سفارش و پشتیبانی فروش می باشد.



                            </p>
                        </article>
                    </li>

                    <li>
                        <input type="radio" id="ac-7" name="ac-3D"/>
                        <label for="ac-7" onclick="" title="پرداخت آنلاین چیست؟">پرداخت آنلاین چیست؟</label>
                        <article>
                            <p>

                                در سیستم فودرز شما بعد از تکمیل سبد خرید خود به درگاه پرداخت بانکی متصل می شوید و با داشتن کارت هایی که عضو شتاب هستند اطلاعات آن    را   که شامل( شماره کارت - رمز دوم - CVV2 و تاریخ انقضا است) را وارد نمایید تا خریدتان تکمیل گردد بعد از آن یک رسید از طرف بانک مربوطه و پیامکی مبنی بر پرداخت موفق از طرف سامانه فودرز برای شما ارسال می شود که حاوی شماره  تراکنش سفارش جاری شما می باشد.<br> در صورت ایجادهر گونه مشکل شماره تراکنش خود را برای ما ارسال کنید تا تیم پشتیبانی فودرز سفارش شما را بررسی نمایند.


                            </p>
                        </article>
                    </li>


                    <li>
                        <input type="radio" id="ac-8" name="ac-3D"/>
                        <label for="ac-8" onclick="" title=" تحویل سفارش چقدر زمان می برد؟"> تحویل سفارش چقدر زمان می برد؟</label>
                        <article>
                            <p>


                                ما در فودرز می‌دانیم که سرعت و کیفیت ارسال سفارش برای شما بسیار با اهمیت است و تمام سعی خود را می کنیم که این شرایط از جانب ما به هیچ وجه دچار مشکل نگردد. این شرایط به تعداد سفارش‌های همزمان رستوران و فاصله شما از آن بستگی دارد

                            </p>
                        </article>
                    </li>


                    <li>
                        <input type="radio" id="ac-9" name="ac-3D"/>
                        <label for="ac-9" onclick="" title=" آیا می توان از منوی چند رستوران به طور همزمان سفارش ثبت کرد؟"> آیا می توان از منوی چند رستوران به طور همزمان سفارش ثبت کرد؟</label>
                        <article>
                            <p>


                                متاسفانه این امکان وجود ندارد و هر سفارشی فقط از یک رستوران می توانید ثبت کنید.

                            </p>
                        </article>
                    </li>

                    <li>
                        <input type="radio" id="ac-10" name="ac-3D"/>
                        <label for="ac-10" onclick="" title=" آیا قیمت منو غذایی در فودرز با منوی داخل رستوران متفاوت است؟"> آیا قیمت منو غذایی در فودرز با منوی داخل رستوران متفاوت است؟</label>
                        <article>
                            <p>


                                قیمت غذاها در سایت فودرز (Fooderz) کاملا با منوی رستوران مطابقت دارد. ما تمام سعی خود را می‌کنیم تا فرآیند سفارش غذا را برای شما ساده‌تر، سریعتر و حتی کم‌هزینه‌تر کنیم، پس هیچ هزینه اضافی به شما تحمیل نخواهیم کرد.

                            </p>
                        </article>
                    </li>


                    <li>
                        <input type="radio" id="ac-11" name="ac-3D"/>
                        <label for="ac-11" onclick="" title="  دلیل تاخیر در دریافت غذا چیست؟">  دلیل تاخیر در دریافت غذا چیست؟</label>
                        <article>
                            <p>


                                ما سعی کرده ایم تا با استارندارد های بالا هیچ تاخیری در ارسال غذای گرم نداشته باشیم و در صورتی که تاخیری روی دهد از کنترل فودرز خارج است اما تیم پشتیبانی فودرز در کنار شما است و شما می توانید با ما تماس گرفته تا از وضعیت سفارش خود با خبر شوید..

                            </p>
                        </article>
                    </li>
                </ul>
                <!-- /questions -->
        </div>
    </div>

    <!-- map -->
    <div id="map"></div>
    <!-- /map -->

    <!-- //contact -->


    <!-- footer -->
    <?php
    include 'footer_buttom.php';

    ?>
</div>

<!-- login modal -->
<?php
include 'partialCode_LoginModal.php';
?>
<!-- /modals -->

</div>


<script src="js/plugins.min.js"></script>
<script src="js/layout.js"></script>
<script src="js/contact-us.js"></script>

</body>

</html>