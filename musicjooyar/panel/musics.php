<?php include('parts/panel-header.php')?>

    <div class="panel-container glow-box">
    <?php include('parts/panel-sidebar.php')?>

        <main class="main">
            <header>
                <div class="panel-menu-title">
                    <i class="mj mj-music"></i>
                    <h1>لیست موزیک ها</h1>
                </div>
                <div class="panel-menu-actions">
                    <a href="music.html" class="btn btn-secondary">
                        + موزیک جدید
                    </a>
                </div>
            </header>
            <div class="main-content">

                <div class="modal">
                    <div class="modal-box">
                        <i class="mj mj-close close-modal"></i>
                        <audio src="" id="music-preview" controls></audio>
                        <footer>
                            <button class="btn btn-error">بستن</button>
                        </footer>
                    </div>
                </div>

                <form action="#" class="table-filter">
                    <div class="right-filters">
                        <div class="form-filter">
                            <label for="search">
                                <i class="mj mj-search-normal-1"></i>
                                جستجو
                            </label>
                            <input type="search" id="search" name="search" placeholder="جستجو کنید">
                        </div><!--.form-filter-->
                        <div class="form-filter">
                            <label for="status">
                                وضعیت
                            </label>
                            <select name="status" id="status">
                                <option value="all">همه</option>
                                <option value="deleted">حذف شده</option>
                                <option value="publish">منتشر شده</option>
                                <option value="draft">پیش نویس</option>
                            </select>
                        </div><!--.form-filter-->
                        <button class="btn">
                            <i class="mj mj-filter"></i>
                            اعمال فیلتر
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
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>
                                    <a href="#">
                                        عنوان موزیک
                                    </a>
                                </th>
                                <th><i class="mj mj-message"></i></th>
                                <th>خواننده</th>
                                <th>وضعیت</th>
                                <th>کیفیت ها</th>
                                <th>سبک</th>
                                <th>
                                    <a href="#" class="order-desc"><!-- .order-asc -->
                                        زمان
                                    </a>
                                </th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>1</td>
                                <td>
                                    <div class="music-title">
                                        <img src="../images/music-cover.jpg" class="music-cover-thumbnail" alt="Music Cover" width="32" height="32">
                                        آهنگ کارتون کارآگاه گجت کامل و جدید جدید
                                    </div>
                                </td>
                                <td>
                                    <a href="#" class="comment-count unread-comment">
                                        5
                                    </a>
                                </td>
                                <td>
                                    <div class="music-artist">
                                        <img src="../images/hamedmoody.jpg" class="music-artist-thumbnail" alt="Music Artist" width="32" height="32">
                                        علیرضا آقایی
                                    </div>
                                </td>
                                <td>
                                    <span class="status deleted">
                                        حذف شده
                                    </span>
                                </td>
                                <td>
                                    <span class="quality q320">320</span>
                                    <span class="quality q128">128</span>
                                </td>
                                <td>
                                    رپ و شاد
                                </td>
                                <td>
                                    04:19
                                </td>
                                <td>
                                    <a href="#" class="action action-play">
                                        <i class="mj mj-play"></i>
                                    </a>
                                    <a href="#" class="action action-delete">
                                        <i class="mj mj-trash"></i>
                                    </a>
                                    <a href="#" class="action action-edit">
                                        <i class="mj mj-edit-2"></i>
                                    </a>
                                    <a href="#" class="action action-view">
                                        <i class="mj mj-eye"></i>
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>2</td>
                                <td>
                                    <div class="music-title">
                                        <img src="../images/music-cover.jpg" class="music-cover-thumbnail" alt="Music Cover" width="32" height="32">
                                        آهنگ کارتون کارآگاه گجت کامل
                                    </div>
                                </td>
                                <td>
                                    <a href="#" class="comment-count">
                                        5
                                    </a>
                                </td>
                                <td>
                                    <div class="music-artist">
                                        <img src="../images/hamedmoody.jpg" class="music-artist-thumbnail" alt="Music Artist" width="32" height="32">
                                        علیرضا آقایی
                                    </div>
                                </td>
                                <td>
                                    <span class="status publish">
                                        منتشر شده
                                    </span>
                                </td>
                                <td>
                                    <span class="quality q320">320</span>
                                    <span class="quality q128">128</span>
                                </td>
                                <td>
                                    رپ و شاد
                                </td>
                                <td>
                                    04:19
                                </td>
                                <td>
                                    <a href="#" class="action action-play">
                                        <i class="mj mj-play"></i>
                                    </a>
                                    <a href="#" class="action action-delete">
                                        <i class="mj mj-trash"></i>
                                    </a>
                                    <a href="#" class="action action-edit">
                                        <i class="mj mj-edit-2"></i>
                                    </a>
                                    <a href="#" class="action action-view">
                                        <i class="mj mj-eye"></i>
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>3</td>
                                <td>
                                    <div class="music-title">
                                        <img src="../images/music-cover.jpg" class="music-cover-thumbnail" alt="Music Cover" width="32" height="32">
                                        آهنگ کارتون کارآگاه گجت کامل
                                    </div>
                                </td>
                                <td>
                                    <a href="#" class="comment-count unread-comment">
                                        5
                                    </a>
                                </td>
                                <td>
                                    <div class="music-artist">
                                        <img src="../images/hamedmoody.jpg" class="music-artist-thumbnail" alt="Music Artist" width="32" height="32">
                                        علیرضا آقایی
                                    </div>
                                </td>
                                <td>
                                    <span class="status draft">
                                        پیش نویس
                                    </span>
                                </td>
                                <td>
                                    <span class="quality q320">320</span>
                                    <span class="quality q128">128</span>
                                </td>
                                <td>
                                    رپ و شاد
                                </td>
                                <td>
                                    04:19
                                </td>
                                <td>
                                    <a href="#" class="action action-play">
                                        <i class="mj mj-play"></i>
                                    </a>
                                    <a href="#" class="action action-delete">
                                        <i class="mj mj-trash"></i>
                                    </a>
                                    <a href="#" class="action action-edit">
                                        <i class="mj mj-edit-2"></i>
                                    </a>
                                    <a href="#" class="action action-view">
                                        <i class="mj mj-eye"></i>
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>4</td>
                                <td>
                                    <div class="music-title">
                                        <img src="../images/music-cover.jpg" class="music-cover-thumbnail" alt="Music Cover" width="32" height="32">
                                        آهنگ کارتون کارآگاه گجت کامل
                                    </div>
                                </td>
                                <td>
                                    <a href="#" class="comment-count unread-comment">
                                        5
                                    </a>
                                </td>
                                <td>
                                    <div class="music-artist">
                                        <img src="../images/hamedmoody.jpg" class="music-artist-thumbnail" alt="Music Artist" width="32" height="32">
                                        علیرضا آقایی
                                    </div>
                                </td>
                                <td>
                                    <span class="status pending">
                                        منتظر تأیید
                                    </span>
                                </td>
                                <td>
                                    <span class="quality q320">320</span>
                                    <span class="quality q128">128</span>
                                </td>
                                <td>
                                    رپ و شاد
                                </td>
                                <td>
                                    04:19
                                </td>
                                <td>
                                    <a href="#" class="action action-play">
                                        <i class="mj mj-play"></i>
                                    </a>
                                    <a href="#" class="action action-delete">
                                        <i class="mj mj-trash"></i>
                                    </a>
                                    <a href="#" class="action action-edit">
                                        <i class="mj mj-edit-2"></i>
                                    </a>
                                    <a href="#" class="action action-view">
                                        <i class="mj mj-eye"></i>
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>1</td>
                                <td>
                                    <div class="music-title">
                                        <img src="../images/music-cover.jpg" class="music-cover-thumbnail" alt="Music Cover" width="32" height="32">
                                        آهنگ کارتون کارآگاه گجت کامل
                                    </div>
                                </td>
                                <td>
                                    <a href="#" class="comment-count unread-comment">
                                        5
                                    </a>
                                </td>
                                <td>
                                    <div class="music-artist">
                                        <img src="../images/hamedmoody.jpg" class="music-artist-thumbnail" alt="Music Artist" width="32" height="32">
                                        علیرضا آقایی
                                    </div>
                                </td>
                                <td>
                                    <span class="status deleted">
                                        حذف شده
                                    </span>
                                </td>
                                <td>
                                    <span class="quality q320">320</span>
                                    <span class="quality q128">128</span>
                                </td>
                                <td>
                                    رپ و شاد
                                </td>
                                <td>
                                    04:19
                                </td>
                                <td>
                                    <a href="#" class="action action-play">
                                        <i class="mj mj-play"></i>
                                    </a>
                                    <a href="#" class="action action-delete">
                                        <i class="mj mj-trash"></i>
                                    </a>
                                    <a href="#" class="action action-edit">
                                        <i class="mj mj-edit-2"></i>
                                    </a>
                                    <a href="#" class="action action-view">
                                        <i class="mj mj-eye"></i>
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>2</td>
                                <td>
                                    <div class="music-title">
                                        <img src="../images/music-cover.jpg" class="music-cover-thumbnail" alt="Music Cover" width="32" height="32">
                                        آهنگ کارتون کارآگاه گجت کامل
                                    </div>
                                </td>
                                <td>
                                    <a href="#" class="comment-count">
                                        5
                                    </a>
                                </td>
                                <td>
                                    <div class="music-artist">
                                        <img src="../images/hamedmoody.jpg" class="music-artist-thumbnail" alt="Music Artist" width="32" height="32">
                                        علیرضا آقایی
                                    </div>
                                </td>
                                <td>
                                    <span class="status publish">
                                        منتشر شده
                                    </span>
                                </td>
                                <td>
                                    <span class="quality q320">320</span>
                                    <span class="quality q128">128</span>
                                </td>
                                <td>
                                    رپ و شاد
                                </td>
                                <td>
                                    04:19
                                </td>
                                <td>
                                    <a href="#" class="action action-play">
                                        <i class="mj mj-play"></i>
                                    </a>
                                    <a href="#" class="action action-delete">
                                        <i class="mj mj-trash"></i>
                                    </a>
                                    <a href="#" class="action action-edit">
                                        <i class="mj mj-edit-2"></i>
                                    </a>
                                    <a href="#" class="action action-view">
                                        <i class="mj mj-eye"></i>
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>3</td>
                                <td>
                                    <div class="music-title">
                                        <img src="../images/music-cover.jpg" class="music-cover-thumbnail" alt="Music Cover" width="32" height="32">
                                        آهنگ کارتون کارآگاه گجت کامل
                                    </div>
                                </td>
                                <td>
                                    <a href="#" class="comment-count unread-comment">
                                        5
                                    </a>
                                </td>
                                <td>
                                    <div class="music-artist">
                                        <img src="../images/hamedmoody.jpg" class="music-artist-thumbnail" alt="Music Artist" width="32" height="32">
                                        علیرضا آقایی
                                    </div>
                                </td>
                                <td>
                                    <span class="status draft">
                                        پیش نویس
                                    </span>
                                </td>
                                <td>
                                    <span class="quality q320">320</span>
                                    <span class="quality q128">128</span>
                                </td>
                                <td>
                                    رپ و شاد
                                </td>
                                <td>
                                    04:19
                                </td>
                                <td>
                                    <a href="#" class="action action-play">
                                        <i class="mj mj-play"></i>
                                    </a>
                                    <a href="#" class="action action-delete">
                                        <i class="mj mj-trash"></i>
                                    </a>
                                    <a href="#" class="action action-edit">
                                        <i class="mj mj-edit-2"></i>
                                    </a>
                                    <a href="#" class="action action-view">
                                        <i class="mj mj-eye"></i>
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>4</td>
                                <td>
                                    <div class="music-title">
                                        <img src="../images/music-cover.jpg" class="music-cover-thumbnail" alt="Music Cover" width="32" height="32">
                                        آهنگ کارتون کارآگاه گجت کامل
                                    </div>
                                </td>
                                <td>
                                    <a href="#" class="comment-count unread-comment">
                                        5
                                    </a>
                                </td>
                                <td>
                                    <div class="music-artist">
                                        <img src="../images/hamedmoody.jpg" class="music-artist-thumbnail" alt="Music Artist" width="32" height="32">
                                        علیرضا آقایی
                                    </div>
                                </td>
                                <td>
                                    <span class="status pending">
                                        منتظر تأیید
                                    </span>
                                </td>
                                <td>
                                    <span class="quality q320">320</span>
                                    <span class="quality q128">128</span>
                                </td>
                                <td>
                                    رپ و شاد
                                </td>
                                <td>
                                    04:19
                                </td>
                                <td>
                                    <a href="#" class="action action-play">
                                        <i class="mj mj-play"></i>
                                    </a>
                                    <a href="#" class="action action-delete">
                                        <i class="mj mj-trash"></i>
                                    </a>
                                    <a href="#" class="action action-edit">
                                        <i class="mj mj-edit-2"></i>
                                    </a>
                                    <a href="#" class="action action-view">
                                        <i class="mj mj-eye"></i>
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>1</td>
                                <td>
                                    <div class="music-title">
                                        <img src="../images/music-cover.jpg" class="music-cover-thumbnail" alt="Music Cover" width="32" height="32">
                                        آهنگ کارتون کارآگاه گجت کامل
                                    </div>
                                </td>
                                <td>
                                    <a href="#" class="comment-count unread-comment">
                                        5
                                    </a>
                                </td>
                                <td>
                                    <div class="music-artist">
                                        <img src="../images/hamedmoody.jpg" class="music-artist-thumbnail" alt="Music Artist" width="32" height="32">
                                        علیرضا آقایی
                                    </div>
                                </td>
                                <td>
                                    <span class="status deleted">
                                        حذف شده
                                    </span>
                                </td>
                                <td>
                                    <span class="quality q320">320</span>
                                    <span class="quality q128">128</span>
                                </td>
                                <td>
                                    رپ و شاد
                                </td>
                                <td>
                                    04:19
                                </td>
                                <td>
                                    <a href="#" class="action action-play">
                                        <i class="mj mj-play"></i>
                                    </a>
                                    <a href="#" class="action action-delete">
                                        <i class="mj mj-trash"></i>
                                    </a>
                                    <a href="#" class="action action-edit">
                                        <i class="mj mj-edit-2"></i>
                                    </a>
                                    <a href="#" class="action action-view">
                                        <i class="mj mj-eye"></i>
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>2</td>
                                <td>
                                    <div class="music-title">
                                        <img src="../images/music-cover.jpg" class="music-cover-thumbnail" alt="Music Cover" width="32" height="32">
                                        آهنگ کارتون کارآگاه گجت کامل
                                    </div>
                                </td>
                                <td>
                                    <a href="#" class="comment-count">
                                        5
                                    </a>
                                </td>
                                <td>
                                    <div class="music-artist">
                                        <img src="../images/hamedmoody.jpg" class="music-artist-thumbnail" alt="Music Artist" width="32" height="32">
                                        علیرضا آقایی
                                    </div>
                                </td>
                                <td>
                                    <span class="status publish">
                                        منتشر شده
                                    </span>
                                </td>
                                <td>
                                    <span class="quality q320">320</span>
                                    <span class="quality q128">128</span>
                                </td>
                                <td>
                                    رپ و شاد
                                </td>
                                <td>
                                    04:19
                                </td>
                                <td>
                                    <a href="#" class="action action-play">
                                        <i class="mj mj-play"></i>
                                    </a>
                                    <a href="#" class="action action-delete">
                                        <i class="mj mj-trash"></i>
                                    </a>
                                    <a href="#" class="action action-edit">
                                        <i class="mj mj-edit-2"></i>
                                    </a>
                                    <a href="#" class="action action-view">
                                        <i class="mj mj-eye"></i>
                                    </a>
                                </td>
                            </tr>

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

            </div><!--.main-content-->
        </main><!--.main-->
    </div><!--.panel-container-->

<?php include('parts/panel-footer.php')?>