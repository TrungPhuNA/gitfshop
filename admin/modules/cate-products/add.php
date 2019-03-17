<?php
    $modules = 'cate-products';
    $title_global = 'Thêm mới danh mục ';
    require_once __DIR__ .'/../../autoload.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        /**
         *  lay giá trị từ input
         */
        $name     = Input::get("cpr_name");
        $hot      = Input::get("cpr_hot");
        $active   = Input::get("cpr_active");
        $sort = Input::get("cpr_sort");
        // kiểm tra lỗi
        if($name == '')
        {
            // nếu giá trị trống thì gán vào 1 mảng lỗi 
            $errors['cpr_name'] = ' Mời bạn điền đầy đủ thông tin';
        }
        // nếu mảng errors trống => Ko có lỗi  tiến hành insert 
        if(empty($errors))
        {
            // gán vào 1 mảng giá trị để insertt 
            $data = 
            [
                'cpr_name'     => $name ,
                'cpr_hot'    => $hot,
                'cpr_active'   => $active ,
                'cpr_sort'   => $sort 
            ];
            //tiến hành insert 
            $id_insert = DB::insert('category_products',$data);

            if($id_insert > 0)
            {
                // insert thanh cong
                // gán session thông báo thành công
                //chuyển về trang index trong thư mục category_products
                $_SESSION['success'] = "Thêm mới thành công ";
                header("Location: ".baseServerName().'/admin/modules/cate-products');exit();
            }
            else 
            {
                // gán session thông báo thất bại
                // giữ nguyên trang để nhập lai
            }
        }
    }
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
                        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Danh Mục Sản phẩm </a></li>
                        <li class="active">Thêm mới</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <!-- Default box -->
                    <div class="box">
                        <div class="box-body">
                            <div class="col-md-8 col-sm-offset-2">
                                <!-- Horizontal Form -->
                                <div class="box box-primary">
                                    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="_token" value="ZPEdLE4Il64joczf4kmj8Q9eQBvPxcz1qVZwfLOB">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Parent </label>
                                                <div class="col-sm-10">
                                                    <select class="form-control" name="parent_id">
                                                        <option value="0"> - ROOT - </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-2 control-label"> Name </label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="cpr_name" id="inputEmail3" placeholder="VD Máy tính" autocomplete="off" value="<?= isset($name) ? $name : ''?>">
                                                    <?php if(isset($errors['cpr_name'])) :?>
                                                        <span class="color-red"><i class="fa fa-bug"></i><?= $errors['cpr_name'] ?></span>
                                                    <?php endif ;?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-2 control-label"> Hot </label>
                                                <div class="col-sm-3">
                                                    <div class="radio">
                                                        <label>
                                                        <input type="radio" name="cpr_hot" id="optionsRadios1" value="1">
                                                        Có
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label>
                                                        <input type="radio" name="cpr_hot" id="optionsRadios2" value="0" checked="">
                                                        Không
                                                        </label>
                                                    </div>
                                                </div>
                                                <label for="" class="col-sm-2 control-label"> Active </label>
                                                <div class="col-sm-3">
                                                    <div class="radio">
                                                        <label>
                                                        <input type="radio" name="cpr_active" id="optionsRadios2" value="1" checked="">
                                                        Có
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label>
                                                        <input type="radio" name="cpr_active" id="optionsRadios1" value="0" >
                                                        Không
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-2 control-label"> Sort </label>
                                                <div class="col-sm-3">
                                                    <input type="number" name="cpr_sort" class="form-control" value="">
                                                </div>
                                                <label for="" class="col-sm-2 control-label">Icon</label>
                                                <div class="col-sm-5">
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" class="form-control" name="icon">
                                                        <span class="input-group-btn">
                                                        <button type="button" class="btn btn-info btn-flat"><i class="fa fa-search"></i></button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                        <div class="box-footer col-sm-offset-2">
                                            <button type="submit" class="btn btn-primary btn-xs"> Thêm mới  </button>
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
