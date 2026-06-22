<?php include('parts/panel-header.php') ?>

<div class="panel-container glow-box">
    <?php include('parts/panel-sidebar.php') ?>
    <main class="main">
        <header>
            <div class="panel-menu-title">
                <i class="mj mj-category"></i>
                <h1>پیشخوان</h1>
            </div>
            <div class="panel-menu-actions">

            </div>
        </header>
        <div class="main-content">
            <?php if (is_current_user_admin()): ?>
                <div class="widget-stats">

                    <div class="stat stat-comments">
                        <i class="mj mj-message"></i>
                        <strong>1,120</strong>
                        <span>دیدگاه</span>
                    </div>
                    <div class="stat stat-artists">
                        <i class="mj mj-microphone-2"></i>
                        <strong>1,120</strong>
                        <span>هنرمند</span>
                    </div>
                    <div class="stat stat-musics">
                        <i class="mj mj-music"></i>
                        <strong>1,120</strong>
                        <span>موزیک</span>
                    </div>
                    <div class="stat stat-view">
                        <i class="mj mj-eye"></i>
                        <strong>1,120</strong>
                        <span>بازدید</span>
                    </div>
                    <div class="stat stat-view">
                        <i class="mj mj-eye"></i>
                        <strong>1,120</strong>
                        <span>بازدید</span>
                    </div>
                </div><!--.widget-stats-->

            
            <div class="view-chart">
                <h2>بازدید اخیر</h2>
                <div id="chart" style="height: 300px;"></div>
            </div>

        </div><!--.main-content-->
    </main><!--.main-->
    <?php endif; ?>
</div><!--.panel-container-->
<?php include('parts/panel-footer.php') ?>