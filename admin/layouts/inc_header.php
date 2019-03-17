<header class="main-header">
    <!-- Logo -->
    <a href="/" target="_blank" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>LT</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Vũ Phan Linh</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="hidden-xs"><?= $_SESSION['admin_name'] ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-footer">
                            <!-- <div class="pull-left">
                                <a href="#" class="btn btn-success btn-flat"> Cập nhật thông tin </a>
                            </div> -->
                            <div class="pull-right">
                                <a href="/authenticate/thoat.php" class="btn btn-danger btn-flat"> Thoát hệ thống </a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li> -->
            </ul>
        </div>
    </nav>
</header>