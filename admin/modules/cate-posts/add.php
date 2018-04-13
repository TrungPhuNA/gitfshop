<?php
    $modules = 'cate-posts';
    $title_global = ' Thêm mới danh mục bài viết ';
    require_once __DIR__ .'/../../autoload.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> <?= isset($title_global) ? $title_global : 'Trang admin ' ?>  </title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php require_once __DIR__ .'/../../layouts/inc_css.php'; ?>
        <!-- <link rel="stylesheet" href="/public/admin/css/bootstrap-tagsinput.css"> -->
    </head>
    <body class="hold-transition skin-blue fixed sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">
            
            <?php require_once __DIR__ .'/../../layouts/inc_header.php'; ?>
            <!-- ======================HEADER========================= -->
            <?php require_once __DIR__ .'/../../layouts/inc_sidebar.php'; ?>
            <!-- =======================SIDEBAR======================== -->
            <!-- ======================= CONTENT======================== -->
            <div class="content-wrapper">
                <section class="content-header">
                    <h1>
                        <?= isset($title_global) ? $title_global : '' ?>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#"> Danh mục bài viết</a></li>
                        <li class="active"> Thêm mới </li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <!-- Default box -->
                    <div class="box">
                        <div class="box-body">
                            <div class="col-md-8 col-sm-offset-2">
                                <!-- Horizontal Form -->
                                <p><span class="color-red">(*)</span> Những trường ngày bắt buộc phải nhập  | </p>
                                <div class="box box-primary">
                                    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="_token" value="ZPEdLE4Il64joczf4kmj8Q9eQBvPxcz1qVZwfLOB">
                                        <div class="box-body">

                                            <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-2 control-label"> Name <span class="color-red">(*)</span> </label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="name"  placeholder="VD Nguyễn Văn A" autocomplete="off" value="<?= isset($name) ? $name : '' ?>">
                                                    <?php if(isset($errors['name'])) :?>
                                                        <span class="color-red"><i class="fa fa-bug"></i><?= $errors['name'] ?></span>
                                                    <?php endif ;?>
                                                </div>
                                            </div>

                                            <div class="form-group is-empty">
                                                <label for="name" class="col-md-2 control-label"> Email <span class="color-red">(*)</span> </label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" name="email" id="name" value="<?= isset($email) ? $email : '' ?>" autocomplete="off" placeholder=" VD nguyenvana@gmail.com ">
                                                    <?php if(isset($errors['email'])) :?>
                                                        <span class="color-red"><i class="fa fa-bug"></i><?= $errors['email'] ?></span>
                                                    <?php endif ;?>
                                                </div>
                                            </div>
                                            <div class="form-group is-empty">
                                                <label for="name" class="col-md-2 control-label"> Password <span class="color-red">(*)</span> </label>
                                                <div class="col-md-10">
                                                    <input type="password" class="form-control" name="password"  value="<?= isset($password) ? $password : '' ?>" autocomplete="off" placeholder=" VD nguyenvana1234 ">
                                                    <?php if(isset($errors['password'])) :?>
                                                        <span class="color-red"><i class="fa fa-bug"></i><?= $errors['password'] ?></span>
                                                    <?php endif ;?>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- /.box-body -->
                                        <div class="box-footer col-sm-offset-2">
                                            <button type="submit" class="btn btn-primary btn-xs">Cập nhật  </button>
                                            <a href="index.php" class="btn btn-danger btn-xs"> Huỷ bỏ </a>
                                        </div>
                                        <!-- /.box-footer -->
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-footer-->
                    </div>
                    <!-- /.box -->
                </section>
            </div>
            <!-- =======================END CONTENT======================== -->
            <?php require_once __DIR__ .'/../../layouts/inc_footer.php'; ?>
        </div>
        <?php require_once __DIR__ .'/../../layouts/inc_js.php'; ?>
        <!-- <script src="/public/admin/js/bootstrap-tagsinput.min.js"></script> -->
        <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script> -->