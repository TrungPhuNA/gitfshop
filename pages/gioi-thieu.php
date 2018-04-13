<?php
    require_once __DIR__. '/../autoload.php';
    $navActive = 'gioi-thieu';
    // danh sach sp thuoc danh muc hot 
    $cateHot = DB::query("category_products","*"," AND cpr_active = 1 AND cpr_hot = 1 ORDER BY ID DESC  ");
    
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Giới thiệu </title>
        <meta charset="utf-8">
        <?php require_once __DIR__.'/../layouts/inc_head.php'; ?>
        <style type="text/css">
        </style>
    </head>
    <body>
        <div id="wrapper">
            <!---->
            <!--HEADER-->
            <?php require_once __DIR__.'/../layouts/inc_header.php'; ?>
            <!--END HEADER-->


            <!--MENUNAV-->
            <?php require_once __DIR__.'/../layouts/inc_menu.php' ;?>
            <!--ENDMENUNAV-->
            
            <div id="maincontent">
                <div class="container">
                    <div class="col-md-3  fixside" >
                        <?php require_once __DIR__.'/../layouts/inc_left.php' ;?>
                        <div class="box-left box-menu">
                            <h3 class="box-title title-new" style="position: relative;">
                                <i class="fa fa-warning"></i>  Sản phẩm mới 
                                <img src="/public/images/new_neeraj.gif">
                            </h3>
                            <!--  <marquee direction="down" onmouseover="this.stop()" onmouseout="this.start()"  > -->
                            <ul> 
                                <?php foreach($productNew as $item) :?>
                                <li class="clearfix">
                                    <a href="/pages/chi-tiet-san-pham.php?id=<?= $item['id'] ?>">
                                        <img src="/public/uploads/products/<?= $item['prd_thunbar'] ?>" class="img-responsive pull-left" width="80" height="80">
                                        <div class="info pull-right">
                                            <p class="name"> <?= $item['prd_name'] ?> </p >
                                            <?php if($item['prd_sale']) :?>
                                                Cũ :<b class="sale"><?= formatPrice($item['prd_price']) ?> đ</b> <br>
                                                Mới :<b class="price"><?= formatPrice($item['prd_price'],$item['prd_sale']) ?>đ</b><br>
                                            <?php else :?>
                                                Giá : <b class="price"><?= formatPrice($item['prd_price']) ?> đ</b><br>
                                            <?php endif ;?>
                                            <span class="view"><i class="fa fa-eye"></i> 100000 : <i class="fa fa-heart-o"></i> 10</span>
                                        </div>
                                    </a>
                                </li>
                                <?php endforeach ; ?>
                            </ul>
                            <!-- </marquee> -->
                        </div>

                        <div class="box-left box-menu">
                            <h3 class="box-title"><i class="fa fa-warning"></i>  Sản phẩm hót  </h3>
                            <!--  <marquee direction="down" onmouseover="this.stop()" onmouseout="this.start()"  > -->
                            <ul> 
                                <?php foreach($productHot as $item) :?>
                                <li class="clearfix">
                                    <a href="/pages/chi-tiet-san-pham.php?id=<?= $item['id'] ?>">
                                        <img src="/public/uploads/products/<?= $item['prd_thunbar'] ?>" class="img-responsive pull-left" width="80" height="80">
                                        <div class="info pull-right">
                                            <p class="name"> <?= $item['prd_name'] ?> </p >
                                            <?php if($item['prd_sale']) :?>
                                                Cũ :<b class="sale"><?= formatPrice($item['prd_price']) ?> đ</b> <br>
                                                Mới :<b class="price"><?= formatPrice($item['prd_price'],$item['prd_sale']) ?>đ</b><br>
                                            <?php else :?>
                                                Giá : <b class="price"><?= formatPrice($item['prd_price']) ?> đ</b><br>
                                            <?php endif ;?>
                                            <span class="view"><i class="fa fa-eye"></i> 100000 : <i class="fa fa-heart-o"></i> 10</span>
                                        </div>
                                    </a>
                                </li>
                                <?php endforeach ; ?>
                            </ul>
                            <!-- </marquee> -->
                        </div>
                    </div>
                    <div class="col-md-9 bor">
                        <!-- SLIDE -->
                        <section style="padding: 20px;">
                            <h2 style="padding-bottom: 10px;border-bottom: 1px solid #dedede;margin-bottom: 20px;"> Giới thiệu về website bán hàng  </h2>
                            <p style="font-size: 14px;"> 1. Tất cả các sản phẩm đều được cam kết hàng chuẩn đạt chuẩn chất lượng cao. Có nguồn gốc xuất sứ rõ hàng và đã được qua kiểm định </p>
                            <p style="font-size: 14px;"> 2. Mọi đóng góp hay thắc mắc xin vui lòng gủi về email <b>admin@gmail.com</b> hoạc call <b>0986.420.994</b></p>
                            <div class="about-item" style="margin: 20px 0">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <img src="/public/images/socialmedia-Copy.jpg" class="img img-responsive">
                                    </div>
                                    <div class="col-sm-6">
                                        <h2 style="margin-bottom: 10px;"> Tối ưu hoá hoàn hảo </h2>
                                        <ul class="nav" >
                                            <li style="font-size: 14px;padding-bottom: 10px;">Mã nguồn được viết để tối ưu tốt nhất cho việc SEO top google. Trang web của bạn sẽ nhanh chóng được xuất hiện trong kết quả tìm kiếm của Google</li>
                                            <li style="font-size: 14px;padding-bottom: 10px;">
                                                Hệ thống tính điểm SEO trong mỗi trang được tích hợp trong khu vực quản trị viên.
                                            </li>
                                            <li style="font-size: 14px;padding-bottom: 10px;">
                                                Tích hợp các công cụ đo lường tự khóa trong nội dung bài viết
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="about-item" style="margin: 20px 0">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h2 style="margin-bottom: 10px;"> Tối ưu hoá hoàn hảo </h2>
                                        <ul class="nav" >
                                            <li style="font-size: 14px;padding-bottom: 10px;">Mã nguồn được viết để tối ưu tốt nhất cho việc SEO top google. Trang web của bạn sẽ nhanh chóng được xuất hiện trong kết quả tìm kiếm của Google</li>
                                            <li style="font-size: 14px;padding-bottom: 10px;">
                                                Hệ thống tính điểm SEO trong mỗi trang được tích hợp trong khu vực quản trị viên.
                                            </li>
                                            <li style="font-size: 14px;padding-bottom: 10px;">
                                                Tích hợp các công cụ đo lường tự khóa trong nội dung bài viết
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-6">
                                        <img src="/public/images/socialmedia-Copy.jpg" class="img img-responsive">
                                    </div>
                                </div>
                            </div>
                            <div class="about-item" style="margin: 20px 0">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <img src="/public/images/socialmedia-Copy.jpg" class="img img-responsive">
                                    </div>
                                    <div class="col-sm-6">
                                        <h2 style="margin-bottom: 10px;"> Tối ưu hoá hoàn hảo </h2>
                                        <ul class="nav" >
                                            <li style="font-size: 14px;padding-bottom: 10px;">Mã nguồn được viết để tối ưu tốt nhất cho việc SEO top google. Trang web của bạn sẽ nhanh chóng được xuất hiện trong kết quả tìm kiếm của Google</li>
                                            <li style="font-size: 14px;padding-bottom: 10px;">
                                                Hệ thống tính điểm SEO trong mỗi trang được tích hợp trong khu vực quản trị viên.
                                            </li>
                                            <li style="font-size: 14px;padding-bottom: 10px;">
                                                Tích hợp các công cụ đo lường tự khóa trong nội dung bài viết
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="about-item" style="margin: 20px 0">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h2 style="margin-bottom: 10px;"> Tối ưu hoá hoàn hảo </h2>
                                        <ul class="nav" >
                                            <li style="font-size: 14px;padding-bottom: 10px;">Mã nguồn được viết để tối ưu tốt nhất cho việc SEO top google. Trang web của bạn sẽ nhanh chóng được xuất hiện trong kết quả tìm kiếm của Google</li>
                                            <li style="font-size: 14px;padding-bottom: 10px;">
                                                Hệ thống tính điểm SEO trong mỗi trang được tích hợp trong khu vực quản trị viên.
                                            </li>
                                            <li style="font-size: 14px;padding-bottom: 10px;">
                                                Tích hợp các công cụ đo lường tự khóa trong nội dung bài viết
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-6">
                                        <img src="/public/images/socialmedia-Copy.jpg" class="img img-responsive">
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>

                <div class="container">
                    <div class="col-md-4 bottom-content">
                        <a href=""><img src="/public/frontend/images/free-shipping.png"></a>
                    </div>
                    <div class="col-md-4 bottom-content">
                        <a href=""><img src="/public/frontend/images/guaranteed.png"></a>
                    </div>
                    <div class="col-md-4 bottom-content">
                        <a href=""><img src="/public/frontend/images/deal.png"></a>
                    </div>
                </div>
               <?php require_once __DIR__.'/../layouts/inc_footer.php'; ?>