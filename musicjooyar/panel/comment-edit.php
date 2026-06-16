<?php include('parts/panel-header.php')?>
<div class="panel-container glow-box">
    <?php include('parts/panel-sidebar.php')?>

  <main class="main">
    <header>
      <div class="panel-menu-title">
        <i class="mj mj-message"></i>
        <h1>ویرایش دیدگاه</h1>
      </div>
      <div class="panel-menu-actions">

      </div>
    </header>
    <div class="main-content">

      <form action="" id="comment-edit">
        <p>
          ویرایش دیدگاه در «عصر پاییزی مرتضی پاشایی»
        </p>
        <div class="form-group">
          <label for="comment">متن دیدگاه</label>
          <textarea name="comment" id="comment" cols="30" rows="10" class="form-control" placeholder="متن دیدگاه"></textarea>
        </div>
        <div class="form-group">
          <label for="status">وضعیت</label>
          <select name="status" id="status" class="form-control">
            <option value="pending">درانتظار</option>
            <option value="deleted">حذف شده</option>
            <option value="publish">تأیید شده</option>
            <option value="spam">هرزنامه</option>
          </select>
        </div>
        <button class="btn btn-primary">ویرایش دیدگاه</button>
      </form>

    </div><!--.main-content-->
  </main><!--.main-->
</div><!--.panel-container-->

<?php include('parts/panel-footer.php')?>