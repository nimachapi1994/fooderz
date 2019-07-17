<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="loginform">

                    <form id="login-form" method="post" action="">
                        <!-- Tabs Titles -->
                        <h2 class="" id="login-link"> جهت ورود یا ثبت نام شماره موبایل خود را وارد نمایید </h2>
                        <!-- Icon -->
                        <div class="fadeIn first">
                            <img src="images/user-icon.svg" id="icon" alt="User Icon" />
                        </div>
                        <!-- Login Form -->
                        <input type="text" id="login" class="fadeIn" name="user_Phone" placeholder="شماره موبایل">
                        <input type="button" name="loginSub" id="login_submit" class="fadeIn second fooderz_btn full_width" value="ادامه">
                    </form>

                    <div id="formFooter" style="display: none;">
                        <a class="forgetpass-link" href="#">رمز عبورم را فراموش کرده ام</a>
                    </div>

                    <!-- forget password part -->
                    <div id="forgetpass">
                        <h6>شماره موبایل خود را جهت دریافت رمز جدید وارد نمایید</h6>
                        <input type="text"  class="fadeIn" name="" placeholder="شماره موبایل ">
                        <input type="button" id="forgetpass_submit" class="fadeIn fooderz_btn full_width" value="ارسال">
                    </div>

                    <div id="confirm_code">
                        <h6>لطفا کد تاییدی که برایتان پیامک شده را وارد نمایید</h6>
                        <input type="text" id="confirm_code_inp"  class="fadeIn" name="" placeholder="کد تایید">
                        <input type="button" id="confirm_code_submit" class="fadeIn fooderz_btn full_width" value="ثبت">
                    </div>

                    <!-- login continue Form -->
                    <form id="login-cont-form">
                        <h6>شماره موبایل : 09178159981</h6>
                        <br />
                        <input type="password" id="login_pass" class="fadeIn" name="signup-mobile" placeholder="رمز عبور">
                        <input type="button" id="signin_submit" class="fadeIn second fooderz_btn full_width" value="ورود">
                        <a class="forgetpass-link full_width fadeIn third" style="display:block" href="#">رمز عبورم را فراموش کرده ام</a>
                    </form>

                    <!-- sign up Form -->
                    <form id="signup-form">
                        <input type="text" class="fadeIn" placeholder="نام">
                        <input type="text" class="fadeIn" placeholder="نام خانوادگی">
                        <input type="password" id="pass" class="fadeIn" name="signup-mobile" placeholder="رمز عبور">
                        <input type="password" id="rePass" class="fadeIn second" name="login" placeholder="تکرار رمز عبور">
                        <input type="button" id="signup_submit" class="fadeIn third fooderz_btn full_width" value="ثبت">
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
