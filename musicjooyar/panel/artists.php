<?php include('parts/panel-header.php') ?>

<div class="panel-container glow-box">
    <?php include('parts/panel-sidebar.php') ?>

    <main class="main">
        <header>
            <div class="panel-menu-title">
                <i class="mj mj-microphone-2"></i>
                <h1>خواننده ها</h1>
            </div>
            <div class="panel-menu-actions">

            </div>
        </header>
        <div class="main-content">

            <div class="panel-main-content-cols">
                <form action="#" id="artist-form">

                    <?php

                    $art_name = "";
                    $art_family = "";
                    $art_birthdate = "";
                    $art_description = "";
                    $art_avatar = "";

                    $artisit_id = 0;

                    if (isset($_GET['action']) && $_GET['action'] == "edit" && isset($_GET['id'])) {



                        $artisit_id = intval($_GET['id']);

                        $artisit = get_artisit_by("ID", $artisit_id);

                        if ($artisit) {

                            $art_name = $artisit["first_name"];
                            $art_family = $artisit["last_name"];
                            $art_birthdate = str_replace(["\\r\\n", "\\n"], PHP_EOL, $artisit["birthdate"]);
                            $art_description = $artisit["biography"];
                            $art_avatar = $artisit["avatar"];

                        }



                    }

                    $artists = get_artists();

                    ?>

                    <h2>ثبت/ویرایش خواننده</h2>
                    <div class="artist-form-cols">
                        <div class="artist-col-names">
                            <div class="form-group">
                                <label for="name">نام</label>
                                <input type="text" id="name" name="name" class="form-control"
                                    value="<?php echo $art_name; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="family">نام خانواگی</label>
                                <input type="text" id="family" name="family" class="form-control"
                                    value="<?php echo $art_family; ?>" required>
                            </div>
                        </div>

                        <div id="cropper-wrapper">
                            <div class="cropper-box">
                                <div class="croppie">

                                </div>
                                <div class="cropper-footer">
                                    <button href="#" class="btn btn-primary crop-croppie-artist">برش و آپلود</button>
                                    <button class="btn btn-delete close-croppie-modal">انصراف</button>
                                </div>
                            </div>
                        </div>

                        <div class="artist-col-avatar <?php echo $art_avatar ? 'uploaded' : ''; ?>">
                            <!-- .uploaded, .uploading, .error, .file-hover -->
                            <label for="artist_avatar" class="flex-cc flex-col">
                                <i class="mj mj-image"></i>
                                <p>تصویر خواننده</p>
                                <p class="click-for-upload">کلیک کنید</p>
                                <p class="artist-avatar-status upload-drop-text">
                                    رها کنید
                                </p>
                                <p class="artist-avatar-status uploading-error flex-cc">
                                    خطا در آپلود فایل
                                </p>
                                <div class="artist-avatar-status uploading-status"
                                    style="background-image: url('../images/hamedmoody.jpg')">
                                    <div class="avatar-uploading-text">
                                        در حال بارگذاری فایل:
                                        <strong class="uploading-percent">2%</strong>
                                    </div>
                                </div>
                            </label>

                            <input type="file" name="artist_avatar" id="artist_avatar" accept="image/*"
                                style="display: none;">
                            <div class="artist-avatar-image">
                                <i class="mj mj-trash remove-artist-avatar"></i>
                                <img src="<?php echo $art_avatar; ?>" alt="Hamed Moodi" id="avatar-artist" width="64"
                                    height="64">
                            </div>
                        </div>
                    </div>
                    <div class="form-group has-unit">
                        <label for="birthdate">تاریخ تولد</label>
                        <input type="text" id="birthdate" name="birthdate" class="form-control ltr"
                            value="<?php echo $art_birthdate; ?>" required>
                        <input type="hidden" id="birthdate_real" name="birthdate_real" value=" ">
                        <div class="unit">
                            <i class="mj mj-calendar-edit"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description">زندگینامه</label>
                        <textarea id="description" rows="5" name="description" class="form-control"
                            required><?php echo $art_description; ?></textarea>
                    </div>
                    <div class="form-group hide ">

                        <input type="hideen" name="artist_avatar_url" class="form-control ltr " id="artist-avatar-url"
                            placeholder="" readonly>
                        <input type="file" id="artist_avatar" accept="image/*" name="artist_avatar"
                            style="display: none">
                    </div>
                    <button class="btn btn-full">ثبت</button>
                    <input type="hidden" name="id" value="<?php echo $artisit_id; ?>">
                </form>

                <div class="artist-table-container">
                    <form action="#" class="table-filter">
                        <div class="right-filters">
                            <div class="form-filter">
                                <label for="search">
                                    <i class="mj mj-search-normal-1"></i>

                                </label>
                                <input type="search" id="search" name="search" placeholder="جستجو کنید">
                            </div><!--.form-filter-->
                            <button class="btn">
                                <i class="mj mj-filter"></i>
                            </button>
                        </div><!--.right-filters-->
                        <div class="left-filters">
                            <div class="form-filter">
                                <label for="per_page">آیتم در صفحه</label>
                                <select name="per_page" id="per_page">
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <option value="500">500</option>
                                </select>
                            </div>
                            <a href="#" class="table-refresh">
                                <i class="mj mj-refresh"></i>
                            </a>
                        </div><!--.left-filters-->
                    </form><!--.table-filter-->

                    <div class="table-container">
                        <table id="table-comments">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>
                                        خواننده
                                    </th>
                                    <th>ت تولد</th>

                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($artists)): ?>
                                    <?php foreach ($artists as $artist): ?>
                                        <tr>
                                            <td>1</td>
                                            <td>
                                                <div class="row-title">
                                                    <img src="<?php echo $artist["avatar"] ?>"
                                                        alt="<?php echo $artist["avatar"] != "" ? $artist["first_name"] : "Not found :)" ?>"
                                                        width="32" height="32">
                                                    <?php echo $artist["first_name"] != "" ? $artist["first_name"] : "" ?>
                                                    <?php echo $artist["last_name"] != "" ? $artist["last_name"] : "" ?>
                                                </div>
                                            </td>
                                            <td class="ltr">
                                                <?php echo $artist["birthdate"] != "" ? jdate("Y/m/d", strtotime($artist["birthdate"])) : "" ?>
                                            </td>
                                            <td>
                                                <a href="#" class="action action-delete">
                                                    <i class="mj mj-trash"></i>
                                                </a>
                                                <a href="?action=edit&id=<?php echo $artist["ID"]; ?>"
                                                    class="action action-edit">
                                                    <i class="mj mj-edit-2"></i>
                                                </a>
                                            </td>
                                        </tr>

                                    <?php endforeach; ?>

                                <?php else: ?>

                                    <tr>
                                        <td colspan="3">هیچ ندارم برای نمایش سطان :)</td>
                                    </tr>
                                <?php endif; ?>

                            </tbody>
                        </table>
                    </div><!--.table-container-->

                    <div class="table-footer">
                        <div class="result-summary">
                            57 نتیجه، صفحه 1 از 4
                        </div>
                        <div class="pagination">
                            <a href="#" class="prev">
                                <i class="mj mj-arrow-left"></i>
                            </a>
                            <a href="#">
                                1
                            </a>
                            <a href="#" class="current">
                                2
                            </a>
                            <a href="#">
                                3
                            </a>
                            <a href="#">
                                4
                            </a>
                            <a href="#" class="more">
                                ...
                            </a>
                            <a href="#" class="next">
                                <i class="mj mj-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

            </div>



        </div><!--.main-content-->
    </main><!--.main-->
</div><!--.panel-container-->
<?php include('parts/panel-footer.php') ?>