<?php
    require_once __DIR__ .'/autoload.php';

    // tong so san pham
    $countProduct = DB::countTable('products');

    // danh muc san pham
    $countCatePro = DB::countTable('category_products');



?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> <?= isset($title_global) ? $title_global : 'Trang admin ' ?>  </title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php require_once __DIR__ .'/layouts/inc_css.php'; ?>
        <!-- <link rel="stylesheet" href="/public/admin/css/bootstrap-tagsinput.css"> -->
    </head>
    <body class="hold-transition skin-blue fixed sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">
            
            <?php require_once __DIR__ .'/layouts/inc_header.php'; ?>
            <!-- ======================HEADER========================= -->
            <?php require_once __DIR__ .'/layouts/inc_sidebar.php'; ?>
            <!-- =======================SIDEBAR======================== -->
            <!-- ======================= CONTENT======================== -->
            <div class="content-wrapper">
                <section class="content-header">
                    <h1>QUẢN TRỊ WEBSITE</h1>
                    <ol class="breadcrumb">
                        <li class="active"><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <!-- Default box -->
                    <div class="box">
                        <div class="box-body border mr-t-10">
                            <div class="row">

                                <!-- ./col -->
                                <div class="col-lg-3 col-xs-6">
                                    <!-- small box -->
                                    <div class="small-box bg-green">
                                        <div class="inner">
                                            <h3><?= $countCatePro ?></h3>
                                            <p> Danh Mục Sản Phẩm </p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-stats-bars"></i>
                                        </div>
                                        <a href="/admin/modules/cate-products" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>

                                <!-- ./col -->
                                <div class="col-lg-3 col-xs-6">
                                    <!-- small box -->
                                    <div class="small-box bg-red">
                                        <div class="inner">
                                            <h3><?= $countProduct ?></h3>
                                            <p> Sản Phẩm </p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-pie-graph"></i>
                                        </div>
                                        <a href="/admin/modules/products" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <!-- ./col -->
                            </div>

                        </div>
                    </div>
                    <!-- /.box -->
                </section>
            </div>
            <!-- =======================END CONTENT======================== -->
            <?php require_once __DIR__ .'/layouts/inc_footer.php'; ?>
        </div>
        <?php require_once __DIR__ .'/layouts/inc_js.php'; ?>