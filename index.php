<?php
    require_once __DIR__. '/autoload.php';
    
    // danh sach sp thuoc danh muc hot 
    $cateHot = DB::query("category_products","*"," AND cpr_active = 1 AND cpr_hot = 1 ORDER BY ID DESC  ");

    // lay ra san pham thuoc danh muc hot
    $productCateHot = [];
    if( $cateHot )
    {
        foreach ($cateHot as $key => $value) {
            $productCateHot[] = [
                'name'    => $value['cpr_name'],
                'product' => DB::query('products', '*' , ' AND prd_active = 1 AND prd_category_product_id = '. $value['id'] .' LIMIT 8')
            ];
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Đồ án tốt nghiệp</title>
        <meta charset="utf-8">
        <?php require_once __DIR__.'/layouts/inc_head.php'; ?>
    </head>
    <body>
        <div id="wrapper">
            <!---->
            <!--HEADER-->
            <?php require_once __DIR__.'/layouts/inc_header.php'; ?>
            <!--END HEADER-->


            <!--MENUNAV-->
            <?php require_once __DIR__.'/layouts/inc_menu.php' ;?>
            <!--ENDMENUNAV-->
            
            <div id="maincontent">
                <div class="container">
                    <div class="col-md-3  fixside" >
                        <?php require_once __DIR__.'/layouts/inc_left.php' ;?>
                        <div class="box-left box-menu">
                            <h3 class="box-title title-new" style="position: relative;">
                                <i class="fa fa-warning"></i>  Sản phẩm mới 
                                <img src="/public/images/new_neeraj.gif">
                            </h3>
                            <ul> 
                                <?php foreach($productNew as $item) :?>
                                <li class="clearfix">
                                    <a href="/san-pham/<?= $item['prd_slug'] ?>-<?= $item['id'] ?>.html">
                                        <img src="/public/uploads/products/<?= $item['prd_thunbar'] ?>" class="img-responsive pull-left" width="80" height="80">
                                        <div class="info pull-right">
                                            <p class="name"> <?= $item['prd_name'] ?> </p >
                                            <?php if($item['prd_sale']) :?>
                                                Cũ :<b class="sale"><?= formatPrice($item['prd_price']) ?> đ</b> <br>
                                                Mới :<b class="price"><?= formatPrice($item['prd_price'],$item['prd_sale']) ?>đ</b><br>
                                            <?php else :?>
                                                Giá : <b class="price"><?= formatPrice($item['prd_price']) ?> đ</b><br>
                                            <?php endif ;?>
                                            <span class="view"><i class="fa fa-eye"></i> <?= $item['prd_view'] ?> : <i class="fa fa-heart-o"></i> <?= $item['prd_hear'] ?></span>
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
                                    <a href="chi-tiet-san-pham.php?id=<?= $item['id'] ?>">
                                        <img src="/public/uploads/products/<?= $item['prd_thunbar'] ?>" class="img-responsive pull-left" width="80" height="80">
                                        <div class="info pull-right">
                                            <p class="name"> <?= $item['prd_name'] ?> </p >
                                            <?php if($item['prd_sale']) :?>
                                                Cũ :<b class="sale"><?= formatPrice($item['prd_price']) ?> đ</b> <br>
                                                Mới :<b class="price"><?= formatPrice($item['prd_price'],$item['prd_sale']) ?>đ</b><br>
                                            <?php else :?>
                                                Giá : <b class="price"><?= formatPrice($item['prd_price']) ?> đ</b><br>
                                            <?php endif ;?>
                                            <span class="view"><i class="fa fa-eye"></i> <?= $item['prd_view'] ?> : <i class="fa fa-heart-o"></i> <?= $item['prd_hear'] ?></span>
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
                        <section id="slide" class="text-center" >
                            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                <!-- Indicators -->
                                <ol class="carousel-indicators">
                                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                    <li data-target="#myCarousel" data-slide-to="1"></li>
                                    <li data-target="#myCarousel" data-slide-to="2"></li>
                                </ol>
                                <!-- Wrapper for slides -->
                                <div class="carousel-inner">
                                    <div class="item active">
                                        <img src="/public/frontend/images/slide/sl1.jpg" style="width: 100%" alt="Los Angeles">
                                    </div>
                                    <div class="item">
                                        <img src="/public/frontend/images/slide/sl2.jpg" style="width: 100%" alt="Chicago">
                                    </div>
                                    <div class="item">
                                        <img src="/public/frontend/images/slide/sl2.jpg" style="width: 100%" alt="New York">
                                    </div>
                                </div>
                                <!-- Left and right controls -->
                                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </section>
                        <!-- END SLIDE -->    
                        <section class="box-main1" style="margin-bottom:50px;">
                            <?php  foreach($productCateHot as $product) :?>
                                <h3 class="title-main" style="text-align: center;"><a href="javascript:void(0)"> <?= $product['name'] ?>  </a> </h3>
                                <div class="showitem clearfix">
                                    <?php foreach($product['product'] as $item) :?>
                                        <div class="col-md-3 item-product bor clearfix">
                                            <a href="chi-tiet-san-pham.php?id=<?= $item['id'] ?>">
                                                <img src="/public/uploads/products/<?= $item['prd_thunbar'] ?>" class="" width="100%" height="180">
                                            </a>
                                            <div class="info-item">
                                                <a href="chi-tiet-san-pham.php?id=<?= $item['id'] ?>"><?= $item['prd_name'] ?></a>
                                                <?php if($item['prd_sale']) :?>
                                                    <p><strike class="sale"><?= formatPrice($item['prd_price']) ?> đ</strike> <b class="price"><?= formatPrice($item['prd_price'],$item['prd_sale']) ?>đ</b></p>
                                                <?php else :?>
                                                    <p><b class="price"><?= formatPrice($item['prd_price']) ?> đ</b></p>
                                                <?php endif ;?>
                                                
                                            </div>
                                            <div class="hidenitem">
                                                <p><a href="chi-tiet-san-pham.php?id=<?= $item['id'] ?>"><i class="fa fa-search"></i></a></p>
                                                <p><a href="javascript:;void(0)" class="addFavorite" data-id="<?= $item['id'] ?>"><i class="fa fa-heart"></i></a></p>
                                                <p><a href="javascript:;void(0)"  class="add_to_cart" data-id-product=<?= $item['id'] ?>> <i class="fa fa-shopping-basket"></i></a></p>
                                            </div>
                                        </div>
                                    <?php endforeach ; ?>

                                </div>
                            <?php endforeach ; ?>
                            
                        </section>
                        <!-- SAN PHAM MOI -->
                        <section class="box-main1" style="margin-bottom:50px;">
                            <h3 class="title-main" style="text-align: center;"><a href="javascript:void(0)"> Sản phẩm mới </a> </h3>
                            <div class="showitem clearfix">
                                <?php foreach($productNew as $item) :?>
                                    <div class="col-md-3 item-product bor clearfix">
                                        <a href="chi-tiet-san-pham.php?id=<?= $item['id'] ?>">
                                            <img src="/public/uploads/products/<?= $item['prd_thunbar'] ?>" class="" width="100%" height="180">
                                        </a>
                                        <div class="info-item">
                                            <a href="chi-tiet-san-pham.php?id=<?= $item['id'] ?>"><?= $item['prd_name'] ?></a>
                                            <?php if($item['prd_sale']) :?>
                                                <p><strike class="sale"><?= formatPrice($item['prd_price']) ?> đ</strike> <b class="price"><?= formatPrice($item['prd_price'],$item['prd_sale']) ?>đ</b></p>
                                            <?php else :?>
                                                <p><b class="price"><?= formatPrice($item['prd_price']) ?> đ</b></p>
                                            <?php endif ;?>
                                            
                                        </div>
                                        <div class="hidenitem">
                                            <p><a href="chi-tiet-san-pham.php?id=<?= $item['id'] ?>"><i class="fa fa-search"></i></a></p>
                                            <p><a href="" class="addFavorite" data-id="<?= $item['id'] ?>"><i class="fa fa-heart"></i></a></p>
                                            <p><a href="javascript:;void(0)"  class="add_to_cart" data-id-product=<?= $item['id'] ?>> <i class="fa fa-shopping-basket"></i></a></p>
                                        </div>
                                    </div>
                                <?php endforeach ; ?>

                            </div>
                        </section>
                        <!-- /SAN PHAM MOI -->
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
               <?php require_once __DIR__.'/layouts/inc_footer.php'; ?>