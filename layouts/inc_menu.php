<div id="menunav">
    <div class="container">
        <nav>
            <div class="home pull-left">
                <a href="/pages">Trang chủ</a>
            </div>
            <!--menu main-->
            <ul id="menu-main">
                <li class="<?= isset($navActive)  && $navActive == 'san-pham' ? 'active-menu' : ''?>">
                    <a href="/pages/san-pham.php">Shop</a>
                </li>
                <li class="<?= isset($navActive)  && $navActive == 'gui-phan-hoi' ? 'active-menu' : ''?>">
                    <a href="/pages/gui-phan-hoi.php">Gủi phản hồi </a>
                </li>
                <li class="<?= isset($navActive)  && $navActive == 'tin-tuc' ? 'active-menu' : ''?>">
                    <a href="/pages/tin-tuc.php"> Tin tức </a>
                </li>
                <li class="<?= isset($navActive)  && $navActive == 'gioi-thieu' ? 'active-menu' : ''?>">
                    <a href="/pages/gioi-thieu.php"> Giới thiệu </a>
                </li>
            </ul>
            <!-- end menu main-->

            <!--Shopping-->
            <ul class="pull-right" id="main-shopping">
                <li>
                    <a href="/shoppingcart/danh-sach-gio-hang.php"><i class="fa fa-shopping-basket"></i> My Cart </a>
                </li>
            </ul>
            <!--end Shopping-->
        </nav>
    </div>
</div>