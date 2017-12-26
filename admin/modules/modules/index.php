<?php
    require_once __DIR__ .'/../../autoload.php';
    $arr_module = [];
    // kiem tra folder co ton tai khong 
    if(is_dir(MODULES))
    {
        // lay het cac folder trong thu muc
        $data_folder = glob(MODULES.'*',GLOB_ONLYDIR);
        
        foreach ($data_folder as $item)
        {
            $data = [] ; 
            $data = 
            [
                'name' => str_replace(MODULES,'',$item),
                'path' => $item
            ];
            $arr_module[] = $data;
        }
    }
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
    
        $name = isset($_POST['add_module']) ? $_POST['add_module'] : '';
        $module = isset($_POST['module']) ? $_POST['module'] : '';

        if($name == 'add_module')
        {
        
            // kiem tra thu mục đã tồn tai hay chưa
            // nếu chưa thì tiến hành tạo thư mục
            
            $create_folder = MODULES . $module;
            $check = createFolder(MODULES,$module);
        
            if($check['code'] == 1)
            {
                // $copy = copy( MAIN ,$create_folder);
                $copy = exec ( " cp -r ".MAIN."*" . ' ' .$create_folder);
            }
            header("Location: /admin/modules/modules/");exit();
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
                        Quản lý các thư mục modules 
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">News (modules)</a></li>
                        <li class="active">Categorys</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <!-- Default box -->
                    <div class="box">
                        <div class="box-header with-border">
                            
                        </div>
                        <div class="box-body">

                            <div class="col-sm-6">
                                <div class="box box-primary">
                                    <h2> Danh sách modules </h2>
                                    <div class="box-body table-responsive no-padding">
                                        <table class="table table-hover ">
                                            <thead>
                                                <tr>
                                                    <th>STT</th>
                                                    <th> Ten modules </th>
                                                    <th> Thao tác </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($arr_module as $key => $item) :?>
                                                    <tr>
                                                        <td> <?= $key + 1 ?></td>
                                                        <td> <?= $item['name'] ?></td>
                                                        
                                                        <td>
                                                            <a href="" class="custome-btn btn-info btn-xs"><i class="fa fa-pencil-square"></i> Edit </a>
                                                            <a href="delete.php?path=<?= $item['path'] ?>" class="custome-btn btn-danger btn-xs delete" ><i class="fa fa-trash"></i> Trash </a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach ;?>
                                                
                                            </tbody>
                                        </table>  
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="box box-primary">
                                    <h2> Thêm mới modules </h2>
                                    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-2 control-label"> Name </label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="module" id="inputEmail3" placeholder="VD laravel" autocomplete="off" value="" required="">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                        <div class="box-footer col-sm-offset-2">
                                            <input type="submit" class="btn btn-xs btn-success" value="Thêm mới" /> 
                                            <input type="hidden" name="add_module"  value="add_module"> 
                                        </div>
                                        <!-- /.box-footer -->
                                    </form>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <!-- /.box -->
                </section>
            </div>
            <!-- =======================END CONTENT======================== -->
            <?php require_once __DIR__ .'/../../layouts/inc_footer.php'; ?>
        </div>
        <?php require_once __DIR__ .'/../../layouts/inc_js.php'; ?>