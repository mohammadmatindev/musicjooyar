<?php include('parts/panel-header.php') ?>

<body>
    <div class="panel-container glow-box">
        <?php include('parts/panel-sidebar.php') ?>

        <?php

        $music_title = "";
        $music_content = "";
        $music_q320 = "";
        $music_q128 = "";
        $music_q320_size = 0;
        $music_q128_size = 0;
        $music_cover = "";
        $music_status = "draft";
        $selected_artists = [];
        $selected_cats = [];

        $music_id = 0;

        if (isset($_GET['action']) && $_GET['action'] == "edit" && isset($_GET['id'])) {

            $music_id = intval($_GET['id']);

            $music = get_music($music_id);


            if ($music) {

                $music_title = $music["title"];
                $music_content = $music["content"];
                $music_q320 = $music["quality_320"];
                $music_q128 = $music["quality_128"];
                $music_cover = $music["cover"];
                $music_status = $music["status"];

                $selected_artists = get_music_artist_ids($music_id);
                $selected_cats = get_music_category_ids($music_id);

            } else {
                $music_id = 0;
            }

            if($music_q128){
                $size = get_size_from_url($music_q128);
                $music_q128_size = byte_to_megabyte($size );
            }
            if($music_q320){
                $size = get_size_from_url($music_q320);
                $music_q320_size = byte_to_megabyte($size );
            }

       
           
        }

        ?>

        <main class="main">
            <header>
                <div class="panel-menu-title">
                    <i class="mj mj-music"></i>
                    <h1>

                        <?php if ($music_id): ?>
                            <?php echo "ویرایش موزیک " . "  <  " . $music_title . "  >  " ?>
                        <?php else: ?>
                            + موزیک جدید
                        <?php endif; ?>
                        </a>
                    </h1>
                </div>
                <div class="panel-menu-actions">
                    <a href="#" class="btn btn-secondary">
                        + موزیک جدید
                    </a>
                </div>
            </header>
            <div class="main-content">

                <form action="#" class="form-save-music" id="form-save-music">
                    <div class="music-form-right">
                        <div class="form-group">
                            <label for="title">عنوان موزیک</label>
                            <input type="text" name="title" id="title" value="<?php echo $music_title; ?>"
                                class="form-control" placeholder="عنوان موزیک را وارد کنید" required>
                        </div>
                        <div class="form-group">
                            <label for="content">محتوای متنی موزیک</label>
                            <textarea name="content" id="content" rows="10" class="form-control"
                                placeholder="عنوان موزیک را وارد کنید" required><?php echo $music_content; ?></textarea>
                        </div>
                        <div class="music-metas">
                            <div class="form-group">
                                <label for="artist">خواننده</label>
                                <select name="artists[]" id="artist" required multiple class="form-control select2"
                                    style="width: 100%">
                                    <?php foreach (get_artists() as $artist): ?>
                                        <option value="<?php echo $artist["ID"] ?> " <?php selected(in_array($artist["ID"], $selected_artists)) ?>>
                                            <?php echo $artist["first_name"] . " " . $artist["last_name"]; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="category">دسته موزیک</label>
                                <select name="categoryies[]" id="category" multiple required
                                    class="form-control select2" style="width: 100%">
                                    <?php foreach (get_cats() as $cats): ?>
                                        <option value="<?php echo $cats["ID"] ?> " <?php selected(in_array($cats["ID"], $selected_cats)) ?>>
                                            <?php echo $cats["title"]; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">وضعیت</label>
                                <select name="status" id="status" required class="form-control" style="width: 100%">
                                    <option value="draft" <?php selected($music_status == "draft") ?>>پیش نویس</option>
                                    <option value="publish" <?php selected($music_status == "publish") ?>>منتشر شده
                                    </option>
                                    <option value="pending" <?php selected($music_status == "pending") ?>>درانتظار
                                        بررسی</option>
                                    <option value="delted" <?php selected($music_status == "delted") ?>>حذف شده
                                    </option>
                                </select>
                            </div>
                            <div class="form-group has-unit">
                                <label for="duration">مدت زمان</label>
                                <input type="text" name="duration" disabled id="duration" class="form-control"
                                    placeholder="00:00">
                                <span class="unit">دقیقه</span>
                            </div>
                        </div>
                        <button class="btn btn-primary">ذخیره/ویرایش موزیک</button>
                        <input type="hidden" name="id" value="<?php echo $music_id; ?>">
                    </div><!--.music-form-right-->

                    <div class="music-form-left">

                        <div class="cover-container"><!-- .file-hover, .error, .uploading, .uploaded -->
                            <label for="cover" class="cover-uploader">
                                <div class="cover-uploader-icons">
                                    <img src="../images/icon-png.png" alt="Png" class="icon-png" width="142"
                                        height="142">
                                    <img src="../images/icon-jpg.png" alt="Png" class="jpg" width="142" height="142">
                                </div>
                                <p>کاور و تصویر موزیک را به اینجا بکشید</p>
                                <p>یا</p>
                                <input type="file" id="cover" name="cover" style="display: none;">
                                <p class="click-for-upload">کلیک کنید</p>
                                <p class="upload-drop-text">
                                    فایل را رها کنید
                                </p>
                                <p class="uploading-error">
                                    خطا در آپلود فایل
                                </p>
                                <div class="uploading-status"
                                    style="background-image: url('../images/music-cover.jpg')">
                                    <div class="uploading-text">
                                        در حال بارگذاری فایل:
                                        <strong class="uploading-percent">0%</strong>
                                    </div>
                                </div>
                            </label>
                            <div class="uploaded-image" style="background-image: url('<?php echo $music_cover; ?>')">
                                <i class="mj mj-trash delete-cover"></i>
                            </div>
                        </div><!--.cover-container-->

                        <div class="music-uploader <?php echo $music_q128 ? "selected uploaded" : $music_q128 ?></div>"  ><!-- .selected, .uploading, .uploaded, .error -->
                            <label for="music128">
                                <img src="../images/icon-mp3.png" alt="Mp3" width="92" height="92" loading="lazy">
                                <div class="upload-music-text">
                                    <p>موزیک/صوت را به اینجا بکشید</p>
                                    <strong>یا کلیک کنید</strong>
                                </div>
                                <input type="file" name="music128" accept="audio/mpeg" id="music128">
                                <input type="hidden" name="q128" value="<?php echo $music_q128; ?>">

                            </label>
                            <input type="hidden" name="cover" class="music_cover_url"
                                value="<?php echo $music_cover; ?>">
                            <span class="music-quality quality-128">128kbps</span>
                            <div class="music-item">
                                <i class="mj mj-close music-cancel-upload"></i>
                                <p class="music-item-title">
                                    <i class="mj mj-tick-circle upload-status-icon"></i>
                                    <i class="mj mj-close-circle upload-status-icon"></i>
                                    <svg width="36" height="36" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <style>
                                            .spinner_d9Sa {
                                                transform-origin: center
                                            }

                                            .spinner_qQQY {
                                                animation: spinner_ZpfF 9s linear infinite
                                            }

                                            .spinner_pote {
                                                animation: spinner_ZpfF .75s linear infinite
                                            }

                                            @keyframes spinner_ZpfF {
                                                100% {
                                                    transform: rotate(360deg)
                                                }
                                            }
                                        </style>
                                        <path
                                            d="M12,1A11,11,0,1,0,23,12,11,11,0,0,0,12,1Zm0,20a9,9,0,1,1,9-9A9,9,0,0,1,12,21Z" />
                                        <rect class="spinner_d9Sa spinner_qQQY" x="11" y="6" rx="1" width="2"
                                            height="7" />
                                        <rect class="spinner_d9Sa spinner_pote" x="11" y="11" rx="1" width="2"
                                            height="9" />
                                    </svg>
                                    <span class="uploader-music-title">J
                                        <?php echo get_filename_from_url($music_q128); ?>
                                    </span>
                                    <span class="music-size"><?php echo $music_q128_size . "MB" ?></span>
                                </p>
                                <div class="upload-progress-bar">
                                    <div class="upload-progress">
                                        <span>95%</span>
                                    </div>
                                </div>
                                <audio src="<?php echo $music_q128 ?>" controls></audio>
                            </div><!--.music-item-->
                            <p class="error-text">
                                <i class="mj mj-close-circle"></i>
                                <span>حجم آپلود بیش از مورد نیاز است</span>
                            </p>
                        </div><!--.music-container-->

                        <div class="music-uploader <?php echo $music_q320 ? "selected uploaded" : "" ?> </div>"  ><!-- .selected, .uploading, .uploaded, .error -->
                            <label for="music320">
                                <img src="../images/icon-mp3.png" alt="Mp3" width="92" height="92" loading="lazy">
                                <div class="upload-music-text">
                                    <p>موزیک/صوت را به اینجا بکشید</p>
                                    <strong>یا کلیک کنید</strong>
                                </div>
                                <input type="file" name="music320" accept="audio/mpeg" id="music320">
                                <input type="hidden" name="q320" value="<?php echo $music_q320; ?>">

                            </label>
                            <span class="music-quality">320kbps</span>
                            <div class="music-item">
                                <i class="mj mj-close music-cancel-upload"></i>
                                <p class="music-item-title">
                                    <i class="mj mj-tick-circle upload-status-icon"></i>
                                    <i class="mj mj-close-circle upload-status-icon"></i>
                                    <svg width="36" height="36" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <style>
                                            .spinner_d9Sa {
                                                transform-origin: center
                                            }

                                            .spinner_qQQY {
                                                animation: spinner_ZpfF 9s linear infinite
                                            }

                                            .spinner_pote {
                                                animation: spinner_ZpfF .75s linear infinite
                                            }

                                            @keyframes spinner_ZpfF {
                                                100% {
                                                    transform: rotate(360deg)
                                                }
                                            }
                                        </style>
                                        <path
                                            d="M12,1A11,11,0,1,0,23,12,11,11,0,0,0,12,1Zm0,20a9,9,0,1,1,9-9A9,9,0,0,1,12,21Z" />
                                        <rect class="spinner_d9Sa spinner_qQQY" x="11" y="6" rx="1" width="2"
                                            height="7" />
                                        <rect class="spinner_d9Sa spinner_pote" x="11" y="11" rx="1" width="2"
                                            height="9" />
                                    </svg>
                                    <span class="uploader-music-title">
                                        <?php echo get_filename_from_url($music_q320); ?>
                                    </span>
                                    <span class="music-size"><?php echo $music_q320_size . "MB" ?></span>
                                </p>
                                <div class="upload-progress-bar">
                                    <div class="upload-progress">
                                        <span>95%</span>
                                    </div>
                                </div>
                                <audio src="<?php echo $music_q320 ?>" controls></audio>
                            </div><!--.music-item-->
                            <p class="error-text">
                                <i class="mj mj-close-circle"></i>
                                <span>حجم آپلود بیش از مورد نیاز است</span>
                            </p>
                        </div>

                    </div><!--.music-form-left-->
                </form><!--.table-filter-->

            </div><!--.main-content-->
        </main><!--.main-->
    </div><!--.panel-container-->
    <?php include('parts/panel-footer.php') ?>