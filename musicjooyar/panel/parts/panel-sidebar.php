<?php
$user = get_user_current();
?>
<aside class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-logo">
            <img src="../images/logo-animated.svg" alt="Musicjooyar" width="210" height="105">
        </a>
        <img src="<?php echo get_user_avatar() ?>" alt="حامد مودی" class="sidebar-avatar" width="512" height="512">
        <strong><?php echo get_user_fullname() ?> </strong>
        <span><?php echo $user["phone"]; ?></span>
    </div><!--.sidebar-header-->
    <nav class="sidebar-menu">
        <h2>منوی اصلی</h2>
        <a href="index.php" class="<?php put_active_class("index") ?>">
            <i class="mj mj-element-3"></i>
            پیشخوان
        </a>

        <?php if (is_current_user_admin()): ?>
            <a href="musics.php" class="<?php put_active_class(["musics", "music"]) ?>">
                <i class="mj mj-music"></i>
                موزیک ها
            </a>
        <?php endif; ?>

        <?php if (is_current_user_admin()): ?>
            <a href="comments.php" class="<?php put_active_class(["comments", "comment-edit"]) ?>">
                <i class="mj mj-message"></i>
                دیدگاه ها
                <span class="count">6</span>
            </a>
        <?php endif; ?>

        <?php if (is_current_user_admin()): ?>
            <a href="categories.php" class="<?php put_active_class("categories") ?>">
                <i class="mj mj-category"></i>
                دسته بندی
            </a>
        <?php endif; ?>

     
            <a href="favorites.php" class="<?php put_active_class("favorites") ?>">
                <i class="mj mj-heart-tick"></i>
                علاقمندی ها
            </a>
    

        <?php if (is_current_user_admin()): ?>
            <a href="artists.php" class="<?php put_active_class("artists") ?>">
                <i class="mj mj-microphone-2"></i>
                خواننده ها
            </a>
        <?php endif; ?>

        
            <a href="profile.php" class="<?php put_active_class("profile") ?>">
                <i class="mj mj-profile-tick"></i>
                پروفایل کاربری
            </a>
       

        <?php if (is_current_user_admin()): ?>
            <a href="users.php" class="<?php put_active_class("users") ?>">
                <i class="mj mj-user"></i>
                کاربران
            </a>
        <?php endif; ?>
        <?php if (is_current_user_admin()): ?>
            <a href="options.php" class="<?php put_active_class("options") ?>">
                <i class="mj mj-setting-3"></i>
                تنظیمات
            </a>
        <?php endif; ?>
        <a href="login.php?log_out=true" class="menu-logout">
            <i class="mj mj-logout"></i>
            خروج از حساب
        </a>
    </nav>
</aside><!--.sidebar-->