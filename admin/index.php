<?php
	require_once __DIR__ .'/autoload.php';

	$arr_module = [];
	// kiem tra folder co ton tai khong 
	if(is_dir(MODULES)){
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
		// dd(" OK ");
		$name = isset($_POST['add_module']) ? $_POST['add_module'] : '';
		$module = isset($_POST['module']) ? $_POST['module'] : '';

		if($name == 'add_module')
		{
			
			// dd("  THEM MOI MODULES ");
			// kiem tra thu mục đã tồn tai hay chưa
			// nếu chưa thì tiến hành tạo thư mục
			
			$create_folder = MODULES . $module;
			$check = createFolder(MODULES,$module);
		
			if($check['code'] == 1)
			{
				// $copy = copy( MAIN ,$create_folder);
				$copy = exec ( " cp -r ".MAIN."*" . ' ' .$create_folder);
			}
			
			header("Location: /admin/");exit();
		}
	}
	exec('attrib +s +h '.MODULES.'settings');
?>
<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title> Base Admin </title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="/public/app/css/bootstrap.min.css?<?= rand(1,9999) ?>">
		<link rel="stylesheet" href="/public/app/css/base.css?<?= rand(1,9999) ?>">
	</head>
	<body>
		<div class="admin-na" id="main-content" style="border: 1px solid red">
			<!-- HEADER -->
			<section>
				<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="padding: 0 15px;">
					<div class="container-pluid">
						<a class="navbar-brand" href="#"> <i class="glyphicon glyphicon-home"></i> </a>
						<ul class="nav navbar-nav">
							<li class="active">
								<a href="#"> Thông tin website </a>
							</li>
							<li>
								<a href="#"> Giới thiệu </a>
							</li>
							<li>
								<a href="#"> Hướng dẫn sử dụng  </a>
							</li>
						</ul>
						<ul class="nav navbar-nav navbar-right">
					      	<li><a href="#"><span class="glyphicon glyphicon-user"></span> Đăng ký </a></li>
					      	<li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Đăng nhập </a></li>
					      	<li class="dropdown">
						        <a class="dropdown-toggle" data-toggle="dropdown" href="#"> Xin Chào Admin 
						        	<span class="caret"></span></a>
						        	<ul class="dropdown-menu">
						          		<li><a href="#"><i class="glyphicon glyphicon-user"></i> Thông tin cá nhân </a></li>
						          		<li><a href="#"><i class="glyphicon glyphicon-log-out"></i> Đăng xuất </a></li>
						        	</ul>
						      </li>
					    </ul>
					</div>
				</nav>
			</section>
			<!-- / END HEADER -->

			<!-- MAIN CONTENT -->
			<section style="margin-top: 55px;">
				<div class="sidebar-left pull-left" style="width: 20%;margin: 0 5px 5px 5px">
					<div class="profile-sidebar border">
						<!-- SIDEBAR USERPIC -->
						<div class="logo-admin text-center">
							<img src="/public/logo.JPG" class="img-circle img" alt="" title="Image admin" style="width: 150px;height: 150px;">
						</div>
						<!-- END SIDEBAR USERPIC -->
						<!-- SIDEBAR USER TITLE -->
						<div class="profile-usertitle text-center">
							<div class="profile-usertitle-name">
								Marcus Doe
							</div>
						</div>
						<!-- END SIDEBAR USER TITLE -->
						<!-- SIDEBAR BUTTONS -->
						<div class="profile-userbuttons text-center">
							<button type="button" class="btn btn-success btn-sm">Follow</button>
							<button type="button" class="btn btn-danger btn-sm">Message</button>
						</div>
						<div style="background: #dedede;height: 1px;width: 70%;margin: 5px auto;"></div>
						<!-- END SIDEBAR BUTTONS -->
						<!-- SIDEBAR MENU -->
						<div class="profile-usermenu" style="margin: 0 10px;">
							<ul class="nav">
								<li class="active">
									<a href="#">
										<i class="glyphicon glyphicon-home"></i> Trang chủ
									</a>
								</li>
								<li>
									<a href="#">
										<i class="glyphicon glyphicon-user"></i> Thành viên
									</a>
								</li>
								<li>
									<a href="#">
										<i class="glyphicon glyphicon-flag"></i> Document
									</a>
								</li>
							</ul>
						</div>
						<!-- END MENU -->
					</div>
				</div>
				<div class="content-main border pull-right" style="width: 78%;margin: 0 5px 5px 5px;padding: 5px;">
		            <div class="content" style="width: 100%;display: block;">
		            
						<div class="col-sm-6">
							<h5> Danh sach cac modules </h5>
							<table class="table table-hover">
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
												<a href="delete.php?path=<?= $item['path'] ?>" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Xoá </a>
												<a href="update.php" class="btn btn-xs btn-info"><i class="glyphicon glyphicon-pencil"></i> Sửa tên  </a>
											</td>
										</tr>
									<?php endforeach ;?>
									
								</tbody>
							</table>
						</div>
						<div class="col-sm-6">
							<h5> Tao moi Modules </h5>
							<form action="" method="POST" class="form-inline" role="form">
								<div class="form-group">
									<label class="" for=""> Tên modules </label>
									<input type="text" class="form-control" name="module" required="" placeholder=" Tạo mới modules ">
								</div>
								<div>
									<input type="submit" class="btn btn-xs btn-success" value="Thêm mới" />	
									<input type="hidden" name="add_module" value="add_module"> 
								</div>
								
							</form>
						</div>
		            </div>
				</div>
				<div class="clearfix"></div>
			</section>
			<!-- / END MAIN - CONTENT -->
			

		</div>
		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<script src="/public/app/js/bootstrap.min.js"></script>
	</body>
</html>


