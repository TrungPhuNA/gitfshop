<?php
$modules = 'producer';
$title_global = ' Hãng sản xuất ';
require_once __DIR__ .'/../../autoload.php';

$id = (int)Input::get('id');
$producer = DB::fetchOne('producers',$id);


if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	/**
	 *  lay giá trị từ input
	 */
	$name            = Input::get("name");

	// bat loi
	$errors['name']          = $name == '' ? 'Mời bạn điền đầy đủ thông tin' : null;

	//  chuyen doi mang chi muc - loai bo key trung nhau
	if( isset ($errors ))
	{
		$errors = (array_unique(array_values($errors)));
	}

	// neu bien errors  thi ko co loi tien hanh insert
	if ( count($errors) == 1)
	{
		// gán vào 1 mảng giá trị để insertt
		$data =
			[
				'name'                   => $name
			];

		//tiến hành insert
		$id_update = DB::update('producers',$data , ' id = '.$id);

		if($id_update > 0)
		{
			// insert thanh cong
			// gán session thông báo thành công
			//chuyển về trang index trong thư mục category_products
			$_SESSION['success'] = "Cập nhật thành công";
			header("Location: ".baseServerName().'/admin/modules/producer/');exit();
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
                                <div class="box-body">

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label"> Name <span class="color-red">(*)</span> </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="name"  placeholder="" autocomplete="off" value="<?= $producer['name'] ?>">
											<?php if(isset($errors['name'])) :?>
                                                <span class="color-red"><i class="fa fa-bug"></i><?= $errors['name'] ?></span>
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