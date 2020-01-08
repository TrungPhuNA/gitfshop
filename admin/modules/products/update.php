<?php
    $modules = 'products';
    $title_global = 'Cập Nhật Sản Phẩm ';
    require_once __DIR__ .'/../../autoload.php';
    $id = (int)Input::get('id');
    $product = DB::fetchOne('products',$id);
    $producers = DB::query('producers');
    if( ! $product )
    {
        $_SESSION['error'] = "  Không tồn tại dữ liệu ";
        header("Location: ".baseServerName().'/admin/modules/products');exit();
    }
    //load danh muc san pham
    $catePro = DB::query('category_products');

    // kiem tra neu submit 
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        /**
         *  lay giá trị từ input
         */


		$name        = Input::get("prd_name");
		$cate        = Input::get("prd_category_product_id");
		$keywords    = Input::get("prd_keywords");
		$description = Input::get("prd_description");
		$hot         = Input::get('prd_hot');
		$active      = Input::get('prd_active');
		$number      = Input::get('prd_number');
		$sale        = Input::get('prd_sale');
		$content     = Input::get('prd_content');
		$price       = Input::get('prd_price');
		$prod        = Input::get('producer');

        // bat loi 
        $errors['name'] = $name == '' ? 'Mời bạn điền đầy đủ thông tin' : null;  
        $errors['cate'] = $cate == '' ? 'Mời bạn điền đầy đủ thông tin' : null;
        $errors['keywords'] = $keywords == '' ? 'Mời bạn điền đầy đủ thông tin' : null;
        $errors['description'] = $description == '' ? 'Mời bạn điền đầy đủ thông tin' : null;
        $errors['number'] = $number == '' ? 'Mời bạn điền đầy đủ thông tin' : null;
        $errors['content'] = $content == '' ? 'Mời bạn điền đầy đủ thông tin' : null;
        $errors['price'] = $price == '' ? 'Mời bạn điền đầy đủ thông tin' : null;
		$errors['prod'] = $prod == '' ? 'Mời bạn điền đầy đủ thông tin' : null;

        if ( isset ($_FILES['prd_thunbar']) && $_FILES['prd_thunbar']['name'] != NULL )
        {
            $file_name = $_FILES['prd_thunbar']['name'];
            $file_tmp  = $_FILES['prd_thunbar']['tmp_name'];
            $file_type = $_FILES['prd_thunbar']['type'];
            $file_erro = $_FILES['prd_thunbar']['error'];
            if ($file_erro == 0)
            {
                $hinhanh = $file_name;
                $_SESSION['hinhanh'] = $hinhanh;
            }
        }
        
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
                'prd_name'                   => $name ,
                'prd_slug'                   => str_slug($name),
                'prd_category_product_id'    => $cate,
                'prd_keywords'               => $keywords,
                'prd_description'            => $description,
                'prd_active'                 => $active ,
                'prd_hot'                    => $hot,
                'prd_number'                 => $number,
                'prd_content'                => $content,
                'prd_price'                  => $price,
                'prd_sale'                   => $sale,
				'prd_producer_id'            => $prod,
                'prd_thunbar'                => $hinhanh ?? $product['prd_thunbar']
            ];
    
            //tiến hành update 
            $id_update = DB::update('products',$data , ' id = '.$id);

            if($id_update > 0)
            {
                // insert thanh cong
                // gán session thông báo thành công
                //chuyển về trang index trong thư mục category_products
                if (isset($hinhanh))
                {
                    move_uploaded_file($file_tmp,UPLOADS.'/products/'.$hinhanh);    
                }
                
                $_SESSION['success'] = "Cập nhật thành công ";
                header("Location: ".baseServerName().'/admin/modules/products/');exit();
            }
            else 
            {
                // gán session thông báo thất bại
                // giữ nguyên trang để nhập lai
                $_SESSION['error'] = "Cập nhật thất bại  ";
                header("Location: ".baseServerName().'/admin/modules/products/');exit();
                _dd("DIE");
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
        <script type="text/javascript" src="/public/admin/ckeditor/ckeditor.js"></script>
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
                        <li><a href="#">Sản phẩm </a></li>
                        <li class="active">Thêm mới</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <!-- Default box -->
                    <div class="box">
                        <div class="box-body">
                            <div class="box box-primary">
                                <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                                    <div class="box-body">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-2 control-label"> Thunbar   </label>
                                                <div class="col-sm-10">
                                                    <input type="file" class="form-control" name="prd_thunbar" id="imgInp">
                                                    <?php if( isset( $errors['hinhanh']) ): ?>
                                                        <span class="color-red"><i class="fa fa-bug"></i><?= $errors['hinhanh'] ?></span>
                                                    <?php endif ; ?>
                                                </div>
                                                <div class="col-sm-10" style="margin-top: 10px;margin-left: 17%">
                                                    <img src="/public/uploads/products/<?= $product['prd_thunbar'] ?>" alt="" class="img img-responsive" id="blah" title=" Logo " style="width: 100%;height: 258px;border: 1px solid #dedede">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label"> Danh mục </label>
                                                <div class="col-sm-10">
                                                    <select class="form-control" name="prd_category_product_id">
                                                        <option value=""> - Chọn danh mục  - </option>
                                                        <?php if(count($catePro) > 0) :?>
                                                            <?php foreach($catePro as $catep) :?>
                                                                <option value="<?= $catep['id'] ?>" <?= $product['prd_category_product_id'] && $product['prd_category_product_id'] == $catep['id'] ? 'selected="selected"' : '' ?> ><?php echo $catep['cpr_name'] ?></option>
                                                            <?php endforeach ;?>
                                                        <?php endif; ?>
                                                    </select>
                                                    <?php if( isset( $errors['cate']) ): ?>
                                                        <span class="color-red"><i class="fa fa-bug"></i><?= $errors['cate'] ?></span>
                                                    <?php endif ; ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label"> Nhà sản xuất </label>
                                                <div class="col-sm-10">
                                                    <select class="form-control" name="producer">
                                                        <option value=""> - Chọn   - </option>
														<?php if(count($producers) > 0) :?>
															<?php foreach($producers as $producer) :?>
                                                                <option value="<?= $producer['id'] ?>" <?= $product['prd_producer_id'] == $producer['id'] ? 'selected="selected"' : '' ?> ><?php echo $producer['name'] ?></option>
															<?php endforeach ;?>
														<?php endif; ?>
                                                    </select>
													<?php if( isset( $errors['prod']) ): ?>
                                                        <span class="color-red"><i class="fa fa-bug"></i><?= $errors['prod'] ?></span>
													<?php endif ; ?>
                                                </div>

                                            </div>
                                            <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-2 control-label"> Tiêu đề </label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="prd_name" value="<?= $product['prd_name'] ?>"  placeholder=" Tên sản phẩm không quá 200 từ" autocomplete="off">
                                                    <?php if( isset( $errors['name']) ): ?>
                                                        <span class="color-red"><i class="fa fa-bug"></i><?= $errors['name'] ?></span>
                                                    <?php endif ; ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-2 control-label" style="margin-bottom: 10px;"> Keywords </label>
                                                <div class="col-sm-10" style="margin-right: 0;margin-left: 0">
                                                    <textarea name="prd_keywords"  cols="10" rows="3" class="form-control" placeholder="Dùng để seo nội dung , không quá 100 ký tự"><?= $product['prd_keywords'] ?></textarea>
                                                    <?php if( isset( $errors['keywords']) ): ?>
                                                        <span class="color-red"><i class="fa fa-bug"></i><?= $errors['keywords'] ?></span>
                                                    <?php endif ; ?>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-2 control-label" style="margin-bottom: 10px;"> Description </label>
                                                <div class="col-sm-10" style="margin-right: 0;margin-left: 0">
                                                    <textarea name="prd_description"  cols="10" rows="3" class="form-control" placeholder=" Mô tả ngắn về nội dung bài viết , không quá 250 ký tự"><?= $product['prd_description'] ?></textarea>
                                                    <?php if( isset( $errors['description']) ): ?>
                                                        <span class="color-red"><i class="fa fa-bug"></i><?= $errors['description'] ?></span>
                                                    <?php endif ; ?>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-2 control-label"> Hot </label>
                                                <div class="col-sm-4">
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="prd_hot" id="optionsRadios2" value="1" <?= $product['prd_hot'] == 1 ? "checked='checked'" : '' ?>>
                                                            Có
                                                        </label>
                                                        <label>
                                                            <input type="radio" name="prd_hot" id="optionsRadios1" value="0" <?= $product['prd_hot'] == 0 ? "checked='checked'" : '' ?> >
                                                            Không
                                                        </label>
                                                    </div>
                                                </div>
                                                <label for="" class="col-sm-2 control-label"> Active </label>
                                                <div class="col-sm-4">
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="prd_active" id="optionsRadios2" value="1"  <?= $product['prd_active'] == 1 ? "checked='checked'" : '' ?>>
                                                            Có
                                                        </label>
                                                        <label>
                                                            <input type="radio" name="prd_active" id="optionsRadios1" value="0" <?= $product['prd_active'] == 0 ? "checked='checked'" : '' ?> >
                                                            Không
                                                        </label>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label" style="text-align: left;padding-left: 45px;"> Số Lượng  </label>
                                        <div class="col-sm-2">
                                            <input type="number" min="0" max="1000" placeholder="số lượng sp " name="prd_number" class="form-control" value="<?= $product['prd_number'] ?>">
                                            <?php if( isset( $errors['number']) ): ?>
                                                <span class="color-red"><i class="fa fa-bug"></i><?= $errors['number'] ?></span>
                                            <?php endif ; ?>
                                        </div>
                                        <label for="" class="col-sm-1 control-label"> Giá SP  </label>
                                        <div class="col-sm-3">
                                            <input type="number" min="0" placeholder=" Giá Sp" name="prd_price" class="form-control" value="<?= $product['prd_price'] ?>">
                                            <?php if( isset( $errors['price']) ): ?>
                                                <span class="color-red"><i class="fa fa-bug"></i><?= $errors['price'] ?></span>
                                            <?php endif ; ?>
                                        </div>
                                        <label for="" class="col-sm-1 control-label"> Sale ( % )  </label>
                                        <div class="col-sm-2">
                                            <input type="number" min="0" max="10" placeholder=" 1 - 10 (%)" name="prd_sale" class="form-control" value="<?= $product['prd_sale'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin:5px 0">
                                        <label for="inputEmail3" class="col-sm-12 control-label" style="text-align: left;margin-bottom: 10px;padding-right: 30px;padding-left: 30px;"> Nội dung </label>
                                        <div class="col-sm-12" style="padding-left: 30px ;padding-right: 30px">
                                            <textarea name="prd_content" id="my-editor" cols="10" rows="10" class="form-control" placeholder=" Mời bạn nhập nội dung bài viết "><?= $product['prd_content'] ?></textarea>
                                            <?php if( isset( $errors['content']) ): ?>
                                                <span class="color-red"><i class="fa fa-bug"></i><?= $errors['content'] ?></span>
                                            <?php endif ; ?>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>

                                    <!-- /.box-body -->
                                    <div class="" style="position: fixed;right: 15px;top: 50%;transform: translateY(-50%);">
                                        <button type="submit" class="btn btn-primary btn-xs" style="width: 75px"> Cập nhật </button><br>
                                        <a href="index.php" class="btn btn-danger btn-xs" style="width: 75px"> Huỷ bỏ </a>
                                    </div>
                                    <!-- /.box-footer -->
                                </form>
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
            CKEDITOR.replace( 'my-editor', {
                height:'400px'
            });
        </script>