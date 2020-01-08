<?php
    require_once __DIR__. '/../autoload.php';
    
    
     // kiem tra dang nhap
    if (isset($_SESSION['id_user']))
    {
        $user = DB::fetchOne('users' , (int)$_SESSION['id_user']);
    }else 
    {
        header("Location: ".baseServerName().'/pages');exit();
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        /**
         *  lay giá trị từ input
         */
        $name     = Input::get("name");
        $email    = Input::get("email");
        $phone    = Input::get("phone");
        $address  = Input::get("address");
        $password = Input::get("password");
        // kiểm tra lỗi
        if($name == '')
        {
            // nếu giá trị trống thì gán vào 1 mảng lỗi 
            $errors['name'] = ' Mời bạn điền đầy đủ thông tin';
        }
        if($phone == '')
        {
            // nếu giá trị trống thì gán vào 1 mảng lỗi 
            $errors['phone'] = ' Mời bạn điền đầy đủ thông tin';
        }
        if($address == '')
        {
            // nếu giá trị trống thì gán vào 1 mảng lỗi 
            $errors['address'] = ' Mời bạn điền đầy đủ thông tin';
        }

        if($email == '')
        {
            // nếu giá trị trống thì gán vào 1 mảng lỗi 
            $errors['email'] = ' Mời bạn điền đầy đủ thông tin';
        }
        else
        {
            if ($email != $user['email'])
            {
                // check xem email da trung chua
                $emailCheck = DB::fetchOne('users',' email = "'.$email.'"');
                if(count($emailCheck))
                {
                    // email trung gan vao error
                    $errors['email'] = ' Email đã tồn tại ! ';
                }
            }
        }

        $avatar = '';
        if ( isset ($_FILES['avatar']) && $_FILES['avatar']['name'] != NULL )
        {
            $file_name = $_FILES['avatar']['name'];
            $file_tmp  = $_FILES['avatar']['tmp_name'];
            $file_type = $_FILES['avatar']['type'];
            $file_erro = $_FILES['avatar']['error'];
            if ($file_erro == 0)
            {
                $avatar = $file_name;
                move_uploaded_file($file_tmp,UPLOADS.'/user/'.$file_name);
            }
        }
        
        if(empty($errors))
        {
            // gán vào 1 mảng giá trị để insertt 
            $data = 
            [
                'name'     => $name ,
                'email'    => $email,
                'address'  => $address,
                'phone'    => $phone,
            ];

            if ($avatar) $data['avatar'] = $avatar;

            if ($password)
            {
                $data['password'] = md5($password);
            }
            dd($data);

            //tiến hành insert 
            $id_update = DB::update('users',$data,array('id' => $user['id']));

            if($id_update > 0)
            {
                // insert thanh cong
                // gán session thông báo thành công
                //chuyển về trang index trong thư mục users
                $_SESSION['success'] = " Cập nhật thông tin thành công ";
                header("Location: ".baseServerName().'/user/profile.php');exit();
            }
            
        }
        
    }
    
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Cập nhật thông tin  </title>
        <meta charset="utf-8">
        <?php require_once __DIR__.'/../layouts/inc_head.php'; ?>
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
                   <div class="row">
                    <div class="col-md-8 col-md-offset-2 bor">
                        <!-- SLIDE -->
                        <section style="padding: 20px;">
                             <div class="panel panel-primary">
                                  <div class="panel-heading"> Cập nhật thông tin</div>
                                  <div class="panel-body">
                                      <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="email"> Họ và Tên <span style="color:red">(*)</span></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" value="<?= isset($name) ? $name : $user['name'] ?>" placeholder=" Họ và tên : Nguyễn Văn A" name="name">
                                                <?php if(isset($errors['name'])) :?>
                                                    <span class="color-red"><i class="fa fa-bug"></i><?= $errors['name'] ?></span>
                                                <?php endif ;?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="email">Email <span style="color: red">(*)</span></label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" value="<?= isset($email) ? $email : $user['email'] ?>" placeholder=" user@gmail.com" name="email">
                                                <?php if(isset($errors['email'])) :?>
                                                    <span class="color-red"><i class="fa fa-bug"></i><?= $errors['email'] ?></span>
                                                <?php endif ;?>
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label class="control-label col-sm-2" for="email"> Số điện thoại <span style="color:red">(*)</span></label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control" value="<?= isset($phone) ? $phone : $user['phone'] ?>" placeholder=" 0986.222.333 " name="phone">
                                                <?php if(isset($errors['phone'])) :?>
                                                    <span class="color-red"><i class="fa fa-bug"></i><?= $errors['phone'] ?></span>
                                                <?php endif ;?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="email"> Địa chỉ  <span style="color:red">(*)</span></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" value="<?= isset($address) ? $address : $user['address'] ?>" placeholder=" Cổ Nhuế - Từ Liêm - Hà Nội " name="address">
                                                <?php if(isset($errors['address'])) :?>
                                                    <span class="color-red"><i class="fa fa-bug"></i><?= $errors['address'] ?></span>
                                                <?php endif ;?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="email"> Avatar </label>
                                            <div class="col-sm-10">
                                                <input type="file" class="form-control" name="avatar">
                                                <?php if(isset($errors['avatar'])) :?>
                                                    <span class="color-red"><i class="fa fa-bug"></i><?= $errors['avatar'] ?></span>
                                                <?php endif ;?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="pwd">Password </label>
                                            <div class="col-sm-10">          
                                                <input type="password" class="form-control" id="pwd" placeholder="********" name="password">
                                                <?php if(isset($errors['password'])) :?>
                                                    <span class="color-red"><i class="fa fa-bug"></i><?= $errors['password'] ?></span>
                                                <?php endif ;?>
                                            </div>
                                        </div>
                                       
                                        <div class="form-group">
                                            <div class="col-sm-offset-4 col-sm-3">
                                                <button type="submit" class="btn btn-primary btn-xs"> Cập nhật </button>
                                                <a href="/" class="btn btn-danger btn-xs"> Huỷ bỏ  </a>
                                            </div>
                                        </div>
                                    </form>
                                  </div>
                                </div>
                            
                        </section>
                    </div>
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