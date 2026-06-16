<?php include('parts/panel-header.php')?>
    <div class="panel-container glow-box">
    <?php include('parts/panel-sidebar.php')?>

        <main class="main">
            <header>
                <div class="panel-menu-title">
                    <i class="mj mj-setting-3"></i>
                    <h1>تنظیمات</h1>
                </div>
                <div class="panel-menu-actions">

                </div>
            </header>
            <div class="main-content">

                <form action="#" id="options">
                    <fieldset>
                        <legend>تنظیمات عمومی</legend>
                        <div class="form-group">
                            <label for="per_page">تعداد موزیک در صفحه</label>
                            <input type="number" class="form-control ltr" name="per_page" id="per_page" value=""/>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>تنظیمات پیامک</legend>
                        <p class="info-box">
                            با ثبت الگوی پیامکی در سامانه فراز دقت کنید که متغیر کد را با %code% تعریف کنید
                        </p>
                        <div class="form-group">
                            <label for="sms_api_key">کلید Api پیامک فراز</label>
                            <input type="text" class="form-control ltr" name="sms_api_key" id="sms_api_key" value=""/>
                        </div>
                        <div class="form-group">
                            <label for="otp_pattern">شناسه الکوی پیامک OTP</label>
                            <input type="text" class="form-control ltr" name="otp_pattern" id="otp_pattern" value=""/>
                        </div>
                        <div class="options-cols">
                            <div class="form-group">
                                <label for="otp_length">تعداد رقم کد تأیید</label>
                                <input type="number" class="form-control ltr" name="otp_length" id="otp_length" value=""/>
                            </div>
                            <div class="form-group">
                                <label for="otp_ttl">طول عمر کد تأیید به ثانیه</label>
                                <input type="number" class="form-control ltr" name="otp_ttl" id="otp_ttl" value=""/>
                            </div>
                        </div>
                    </fieldset>
                    <button class="btn btn-primary">
                        ذخیره تنظیمات
                    </button>
                </form><!--#options-->

            </div><!--.main-content-->
        </main><!--.main-->
    </div><!--.panel-container-->
<?php include('parts/panel-header.php')?>