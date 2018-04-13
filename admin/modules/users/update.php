<?php
$modules = 'users';
$title_global = ' Thêm mới thành viên ';
require_once __DIR__ .'/../../autoload.php';
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    /**
     *  lay giá trị từ input
     */
    $name  = Input::get("name");
    $email = Input::get("email");
    // kiểm tra lỗi
    if($name == '')
    {
        // nếu giá trị trống thì gán vào 1 mảng lỗi
        $errors['name'] = ' Mời bạn điền đầy đủ thông tin';
    }
    if($email == '')
    {
        // nếu giá trị trống thì gán vào 1 mảng lỗi
        $errors['email'] = ' Mời bạn điền đầy đủ thông tin';
    }

    // nếu mảng errors trống => Ko có lỗi  tiến hành insert
    if(empty($errors))
    {
        // gán vào 1 mảng giá trị để insertt
        $data =
            [
                'name'     => $name ,
                'email'    => $email,
                'password' => md5(123456)
            ];

        //tiến hành insert
        $id_insert = DB::insert('users',$data);
        if($id_insert > 0)
        {
            // insert thanh cong
        }
        else
        {
            // insert that bai
        }

        // kiểm tra xem insert thành công hay không và thông báo

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
    <style type="text/css">

    </style>
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
                <?= isset($title_global) ? $title_global : 'Trang admin ' ?>
            </h1>
            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i> Trang chủ </a></li>
                <li><a href="#"> Thành viên </a></li>
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
                                        </div>
                                    </div>

                                    <div class="form-group is-empty">
                                        <label for="name" class="col-md-2 control-label"> Email <span class="color-red">(*)</span> </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="email" id="name" value="<?= isset($email) ? $email : '' ?>" autocomplete="off" placeholder=" VD nguyenvana@gmail.com ">
                                        </div>
                                    </div>
                                    <div class="form-group is-empty">
                                        <label for="name" class="col-md-2 control-label"> Password <span class="color-red">(*)</span> </label>
                                        <div class="col-md-10">
                                            <input type="password" class="form-control" name="password"  value="<?= isset($password) ? $password : '' ?>" autocomplete="off" placeholder=" VD nguyenvana1234 ">
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


<script type="text/javascript">
    $(function() {
        $('input').mouseleave(function() {
            let $value = $(this).val();
            console.log($value.length);
            if($value.length <= 0)
            {
                $(this).addClass('border-red');
            }
            else
            {
                if($(this).hasClass('border-red'))
                {
                    $(this).removeClass('border-red');
                }

            }
        })
    })
</script>