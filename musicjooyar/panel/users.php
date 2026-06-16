<?php include('parts/panel-header.php')?>

<div class="panel-container glow-box">
    <?php include('parts/panel-sidebar.php')?>

  <main class="main">
    <header>
      <div class="panel-menu-title">
        <i class="mj mj-user"></i>
        <h1>کاربران</h1>
      </div>
      <div class="panel-menu-actions">

      </div>
    </header>
    <div class="main-content">

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
            <label for="role">
              نقش
            </label>
            <select name="role" id="role">
              <option value="all">همه</option>
              <option value="subscriber">مشترک</option>
              <option value="author">نویسنده</option>
              <option value="admin">مدیر</option>
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
                کاربر
              </a>
            </th>
            <th>نقش</th>
            <th>وضعیت</th>
            <th>آخرین ورود</th>
            <th>تاریخ ثبت نام</th>
            <th>عملیات</th>
          </tr>
          </thead>
          <tbody>

          <tr>
            <td>1</td>
            <td>
              <div class="row-title">
                <img src="../images/hamedmoody.jpg" alt="Music Cover" width="32" height="32">
                حامد مودی
              </div>
            </td>
            <td>مشترک</td>
            <td>
              <span class="status active">
                فعال
              </span>
            </td>

            <td class="ltr">
              1405/01/16 12:13
            </td>
            <td>
              1405/01/16 12:13
            </td>
            <td>

              <a href="#" class="action action-delete">
                <i class="mj mj-trash"></i>
              </a>
              <a href="profile.html" class="action action-edit">
                <i class="mj mj-edit-2"></i>
              </a>

            </td>
          </tr>

          <tr>
            <td>1</td>
            <td>
              <div class="row-title">
                <img src="../images/hamedmoody.jpg" alt="Music Cover" width="32" height="32">
                حامد مودی
              </div>
            </td>
            <td>مشترک</td>
            <td>
              <span class="status inactive">
                غیر فعال
              </span>
            </td>

            <td class="ltr">
              1405/01/16 12:13
            </td>
            <td>
              1405/01/16 12:13
            </td>
            <td>

              <a href="#" class="action action-delete">
                <i class="mj mj-trash"></i>
              </a>
              <a href="profile.html" class="action action-edit">
                <i class="mj mj-edit-2"></i>
              </a>

            </td>
          </tr>

          <tr>
            <td>1</td>
            <td>
              <div class="row-title">
                <img src="../images/hamedmoody.jpg" alt="Music Cover" width="32" height="32">
                حامد مودی
              </div>
            </td>
            <td>مشترک</td>
            <td>
              <span class="status pending">
                منتظر تأیید
              </span>
            </td>

            <td class="ltr">
              1405/01/16 12:13
            </td>
            <td>
              1405/01/16 12:13
            </td>
            <td>

              <a href="#" class="action action-delete">
                <i class="mj mj-trash"></i>
              </a>
              <a href="profile.html" class="action action-edit">
                <i class="mj mj-edit-2"></i>
              </a>

            </td>
          </tr>

          <tr>
            <td>1</td>
            <td>
              <div class="row-title">
                <img src="../images/hamedmoody.jpg" alt="Music Cover" width="32" height="32">
                حامد مودی
              </div>
            </td>
            <td>مشترک</td>
            <td>
              <span class="status deleted">
                حذف شده
              </span>
            </td>

            <td class="ltr">
              1405/01/16 12:13
            </td>
            <td>
              1405/01/16 12:13
            </td>
            <td>

              <a href="#" class="action action-delete">
                <i class="mj mj-trash"></i>
              </a>
              <a href="profile.html" class="action action-edit">
                <i class="mj mj-edit-2"></i>
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
