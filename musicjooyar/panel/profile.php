<?php
include('parts/panel-header.php');
$user = get_user_current();
$phone = $user['phone'];
$username = $user['username'];
$first_name = $user['first_name'];
$last_name = $user['last_name'];
$has_avatar = $user['avatar'];
?>
<div class="panel-container glow-box">
    <?php include('parts/panel-sidebar.php') ?>

    <main class="main">
        <header>
            <div class="panel-menu-title">
                <i class="mj mj-user"></i>
                <h1>ویرایش پروفایل</h1>
            </div>
            <div class="panel-menu-actions">

            </div>
        </header>
        <div class="main-content">

            <div id="cropper-wrapper">
                <div class="cropper-box">
                    <div class="croppie">

                    </div>
                    <div class="cropper-footer">
                        <button href="#" class="btn btn-primary crop-croppie">برش و آپلود</button>
                        <button class="btn btn-delete close-croppie-modal">انصراف</button>
                    </div>
                </div>
            </div>

            <form action="#" id="form-edit-profile">
                <div class="form-group profile-image">

                    <label for="avatar">تصویر پروفایل</label>
                    <div class="profile-image-actions <?php echo $has_avatar ? "" : "no-avatar" ?>">
                        <div class="profile-image-container">
                            <span class="profile-upload-progress"></span>
                            <img src="<?php echo get_user_avatar() ?>" class="sidebar-avatar" alt="" width="64"
                                height="64">
                        </div>
                        <label for="avatar" class="btn btn-secondary change-avatar">

                            <span> انتخاب تصویر</span>
                            <span> تغییر تصویر</span>



                        </label>
                        <input type="file" id="avatar" name="avatar" style="display: none">

                        <a href="#" class="btn btn-delete delete-profile">حذف تصویر</a>

                    </div>
                </div><!--.profile-image-->

                <div class="form-group">
                    <label for="phone">تلفن همراه</label>
                    <div class="inline-input">
                        <input type="text" disabled name="phone" id="phone" class="form-control ltr"
                            value="<?php echo $phone ?>">
                        <span class="text-light">غیر قابل تغییر</span>
                    </div>
                </div>

                <div class="form-group field-duplicate-check">
                    <label for="username">نام کاربری</label>
                    <div class="inline-input">
                        <input type="text" name="username" id="username" class="form-control ltr"
                            value="<?php echo $username ?>">
                        <div class="field-exists-check"><!-- .checking, .error, .success -->
                            <div class="field-exists">
                                <i class="mj mj-close-circle"></i>
                                <p>نام کاربری قبلا استفاده شده است</p>
                            </div>
                            <div class="checking">
                                <img src="../images/loading-spinner-primary.svg" alt="spinner" width="16" height="16">
                                در حال بررسی نام کاربری
                            </div>
                            <div class="field-free">
                                <i class="mj mj-tick-circle"></i>
                                <p>نام کاربری برای استفاده آزاد است</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="first_name">نام</label>
                    <div class="inline-input">
                        <input type="text" name="first_name" id="first_name" class="form-control"
                            value="<?php echo $first_name ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="last_name">نام خانوادگی</label>
                    <div class="inline-input">
                        <input type="text" name="last_name" id="last_name" class="form-control"
                            value="<?php echo $last_name ?>">
                    </div>
                </div>
                <?php if (is_current_user_admin()): ?>
                    
                    <div class="form-group">
                        <label for="user_role">نقش کاربر</label>
                        <div class="inline-input">
                            <select name="user_role" id="user_role" class="form-control">
                                <option value="subscriber">کاربر مشترک</option>
                                <option value="author">نویسنده</option>
                                <option value="admin">مدیریت</option>
                            </select>
                        </div>
                    </div>

                <?php endif; ?>

                <button class="btn btn-primary">
                    ذخیره تغییرات
                </button>

            </form><!--#form-edit-profile-->

        </div><!--.main-content-->
    </main><!--.main-->
</div><!--.panel-container-->

<?php include('parts/panel-footer.php') ?>