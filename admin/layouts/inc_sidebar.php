<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/public/admin/images/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Chu Văn Thắng</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Bảng Điều Khiển</li>
            <li class="">
                <a href="/admin"><i class="fa fa-dashboard"></i> <span>Home</span></a>
            </li>
             <li class="<?= isset($modules) && $modules == 'users' ? 'active' : ''?>">
                <a href="/admin/modules/users/"><i class="fa fa-user"></i> <span>Thành viên</span></a>
            </li>
            <li class="header"> Bài viết </li>
            <li class="<?= isset($modules) && $modules == 'posts' ? 'active' : ''?>">
                <a href="/admin/modules/posts"><i class="fa fa-book"></i> <span>Bài viết</span></a>
            </li>
            <li class="header"> Sản phẩm  </li>
            <li class="<?= isset($modules) && $modules == 'cate-products' ? 'active' : ''?>">
                <a href="/admin/modules/cate-products"><i class="fa fa-list"></i> <span>Danh mục</span></a>
            </li>
            <li class="<?= isset($modules) && $modules == 'products' ? 'active' : ''?>">
                <a href="/admin/modules/products"><i class="fa fa-book"></i> <span>Sản phẩm</span></a>
            </li>
            <li class="<?= isset($modules) && $modules == 'transactions' ? 'active' : ''?>">
                <a href="/admin/modules/transactions"><i class="fa fa-book"></i> <span> Đơn hàng </span></a>
            </li>
            <li class="<?= isset($modules) && $modules == 'warehouses' ? 'active' : ''?>">
                <a href="/admin/modules/warehouses"><i class="fa fa-book"></i> <span> Quản lý kho </span></a>
            </li>
<!--            <li class="">-->
<!--                <a href="/admin/modules/modules"><i class="fa fa-book"></i> <span>Modules</span></a>-->
<!--            </li>-->
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>