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
                <form action="#" id="category-form">
                    <?php

                    $cat_name = "";
                    $cat_parent = 0;
                    $cat_id = 0;

                    if (isset($_GET['action']) && $_GET['action'] == "edit" && isset($_GET['id'])) {

                        $cat_id = intval($_GET['id']);

                        $cat = get_cats_by("ID", $cat_id);

                        if ($cat) {
                            $cat_name = $cat['title'];
                            $cat_parent = $cat['parent'];
                        }

                        $cats = get_cats();


                    }

                    ?>
                    <h2>ثبت/ویرایش دسته بندی</h2>
                    <div class="form-group">
                        <label for="category_name">نام دسته</label>
                        <input type="text" id="category_name" name="category_name" value="<?php echo $cat_name; ?>"
                            class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="category_parent">دسته والد</label>
                        <select name="category_parent" id="category_parent" class="form-control select2"
                            style="width: 100%">

                            <option value="0">بدون والد</option>
                            <?php $cats = get_cats();
                            foreach ($cats as $cat): ?>
                                <option value="<?php echo $cat["ID"] ?>" <?php echo $cat_parent == $cat["ID"] ? 'selected' : "" ?>><?php echo $cat["title"] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <input type="hidden" name="id" value="<?php echo $cat_id ?>">

                    <button class="btn btn-full">ثبت</button>
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
                                    <th style="width: 40px;">#</th>
                                    <th>
                                        دسته
                                    </th>
                                    <th>والد</th>
                                    <th style="width: 80px;">تعداد</th>
                                    <th style="width: 80px;">عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($cats)): ?>
                                    <?php foreach ($cats as $cat_index => $cat): ?>
                                        <tr>
                                            <td><?php echo $cat_index ?></td>
                                            <td>
                                               <?php echo $cat["title"] ?>
                                            </td>
                                            <td>
                                                -
                                            </td>
                                            <td>
                                                <a href="#">-</a>
                                            </td>
                                            <td>
                                                <a href="#" class="action action-delete">
                                                    <i class="mj mj-trash"></i>
                                                </a>
                                                <a href="?action=edit&id=<?php echo $cat['ID']; ?>" class="action action-edit">
                                                    <i class="mj mj-edit-2"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>

                                    <tr>
                                        <td colspan="5">ستون دسته نیست :(</td>
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