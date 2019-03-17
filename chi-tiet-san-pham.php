<?php
    require_once __DIR__. '/autoload.php';
    $id = (int)Input::get('id');
    // lay chi tiet san pham

    $sql_product_detaul = "SELECT products.*, category_products.cpr_name FROM products LEFT JOIN 
        category_products ON category_products.id = products.prd_category_product_id WHERE 1 and prd_active = 1
     and  products.id = ".$id;
    $product_defail = DB::fetchsql($sql_product_detaul);
    $product = $product_defail[0];


    // check dang nhap 
    // kiem tra dang nhap
    if (isset($_SESSION['id_user']))
    {
        $user = DB::fetchOne('users' , (int)$_SESSION['id_user']);
    }

    // lấy danh sách comment của sản phẩm 
    $sql  = "SELECT comments.* , users.avatar as avatar FROM comments 
        LEFT JOIN users ON users.id = comments.cmt_user_id WHERE 1  AND cmt_product_id = ".$id." ORDER BY ID DESC lIMIT 6
    ";

    $comment = DB::fetchsql($sql);



    // xử lý comment sản phẩm 
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $name    = Input::get('cmt_name');
        $content = Input::get('cmt_content');
        $data = 
        [
            'cmt_name'          => $name ,
            'cmt_content'       => $content,
            'cmt_product_id'    => $id 
        ];

        if ($user)
        {
            $data['cmt_user_id'] = $user['id'];
        }

        //tiến hành insert 
        $id_insert = DB::insert('comments',$data);

        if($id_insert > 0)
        {
            // insert thanh cong
            // gán session thông báo thành công
            $_SESSION['success'] = "Thêm mới thành công ";
            $_SESSION['flag_comment'] = 1;
            header("Location: ".'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);exit();
        }
    }

    // tinh luot view
    if ( !isset($_COOKIE['view_product'.$id]))
    {

        setcookie('view_product'.$id,$id,time() + 30);
        DB::update('products',array('prd_view' => $product['prd_view'] + 1), ' id = '.$id);
    }

    // Xoá comment

    $id_comment = (int)Input::get('id_comment');
    if ($id_comment && $user)
    {
        $check_comment = DB::fetchOne('comments',' cmt_user_id = '.$user["id"].' and id = '.$id_comment);
        if ($check_comment)
        {
            DB::delete('comments',(int)$id_comment);
            $_SESSION['success'] = "Xoá bình luận thành công ";
            
        } 
        echo "<script> window.location.href = location.pathname+'?id='+$id;</script>";
    
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <title>  Chi tiết sản phẩm  </title>
        <meta charset="utf-8">
        <?php require_once __DIR__.'/layouts/inc_head.php'; ?>
        <link rel="stylesheet" href="/public/app/css/bootstrap3-wysihtml5.min.css">
        <style>
            .box-icon{ display: none}
            .box-icon a{ background: #516eab;border: 1px solid #516eab}
            .box-icon a i{color: white;font-weight: bold;}
            .box-icon a:hover i { font-size: 17px;}
        </style>
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
                            <!--  <marquee direction="down" onmouseover="this.stop()" onmouseout="this.start()"  > -->
                            <ul> 
                                <?php foreach($productNew as $item) :?>
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

                        <div class="box-left box-menu">
                            <h3 class="box-title"><i class="fa fa-warning"></i>  Sản phẩm hót  </h3>
                            <!--  <marquee direction="down" onmouseover="this.stop()" onmouseout="this.start()"  > -->
                            <ul> 
                                <?php foreach($productHot as $item) :?>
                                <li class="clearfix">
                                    <a href="/chi-tiet-san-pham.php?id=<?= $item['id'] ?>">
                                        <img src="/public/uploads/products/<?= $item['prd_thunbar'] ?>" class="img-responsive pull-left" width="80" height="80">
                                        <div class="info pull-right">
                                            <p class="name"> <?= $item['prd_name'] ?> </p >
                                            <?php if($item['prd_sale']) :?>
                                                Cũ :<b class="sale"><?= formatPrice($item['prd_price']) ?> đ</b> <br>
                                                Mới :<b class="price"><?= formatPrice($item['prd_price'],$item['prd_sale']) ?>đ</b><br>
                                            <?php else :?>
                                                Giá : <b class="price"><?= formatPrice($item['prd_price']) ?> đ</b><br>
                                            <?php endif ;?>
                                            <span class="view"><i class="fa fa-eye"></i> <?= $item['prd_view'] ?> : <i class="fa fa-heart-o"></i> <?= $item['prd_hear'] ?></span
                                        </div>
                                    </a>
                                </li>
                                <?php endforeach ; ?>
                            </ul>
                            <!-- </marquee> -->
                        </div>
                    </div>
                    
                    <div class="col-md-9 bor">
                    <section class="box-main1" >
                        <div class="col-sm-12">
                            <div class="breadcrumb-content">
                                <ol class="breadcrumb" style="background-color: white;margin-bottom: 0;padding-left: 0;border-radius: 0;border-bottom: 1px solid #dedede">
                                    <li><a href="/">Trang chủ </a></li>
                                    <li><a href="#"><?= $product['cpr_name'] ?></a></li>
                                    <li class="active"><?= $product['prd_name'] ?></li>
                                </ol>
                            </div>
                        </div>
                            <div class="col-md-6 text-center">
                                <img src="/public/uploads/products/<?= $product['prd_thunbar'] ?>" class="img-responsive bor" id="imgmain" width="100%" height="370" data-zoom-image="images/16-270x270.png">
                                
                                <ul class="text-center bor clearfix" id="imgdetail">
                                    <li>
                                        <a href="">
                                            <img src="/public/uploads/products/<?= $product['prd_thunbar'] ?>" class="img-responsive pull-left" width="80" height="80" style="padding:5px 2px">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">
                                            <img src="/public/uploads/products/<?= $product['prd_thunbar'] ?>" class="img-responsive pull-left" width="80" height="80" style="padding:5px 2px;">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">
                                            <img src="/public/uploads/products/<?= $product['prd_thunbar'] ?>" class="img-responsive pull-left" width="80" height="80" style="padding:5px 2px">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">
                                            <img src="/public/uploads/products/<?= $product['prd_thunbar'] ?>" class="img-responsive pull-left" width="80" height="80" style="padding:5px 2px">
                                        </a>
                                    </li>
                                    <div class="clearfix"></div>   
                                </ul>
                            </div>
                            <div class="col-md-6 bor" style="margin-top: 20px;padding: 30px;">
                               <ul id="right">
                                    <li><h1 style="border-bottom: 1px solid #dedede;padding-bottom: 10px;font-size: 22px"> <?= $product['prd_name'] ?> </h1></li>
                                    <li><p> Mô tả : <?= $product['prd_description'] ?> </p></li>
                                    <li>
                                        <?php if($product['prd_sale']) :?>
                                            <p>Giá cũ : <strike class="sale"><?= formatPrice($product['prd_price']) ?> đ</strike> <b class="price">Giá mới : <?= formatPrice($product['prd_price'],$product['prd_sale']) ?>đ</b></p>
                                        <?php else :?>
                                            <p><b class="price"> Giá sản phẩm : <?= formatPrice($product['prd_price']) ?> đ</b></p>
                                        <?php endif ;?>    
                                    </li>
                                    <li>
                                        Tình trạng : <span style="color:red"><?= $product['prd_number'] > 0 ? " Còn hàng "  : " Hết Hàng "?></span> | <span class="view" >Lượt xem <i class="fa fa-eye" style="background: none;color: #666"></i> <?= $product['prd_view'] ?></span> | <span class="view" >Lượt thích <i class="fa fa-heart-o" style="background: none;color: #666"></i> <?= $product['prd_hear'] ?></span>
                                    </li>
                                    <li>
                                        <a href="javascript:;void(0)" class="btn btn-default add_to_cart" data-id-product=<?= $product['id'] ?>> <i class="fa fa-shopping-basket"></i>Add TO Cart</a>
                                    <input type="number" name="qty" id="qty" style="padding: 5px;border-radius: 2px;box-shadow: none;outline: none;width:100px;" min="1" max="10" value="1">
                                    </li>
                               </ul>
                            </div>

                        </section>
                        <div class="col-md-12" id="tabdetail">
                            <div class="row">
                                    
                                <ul class="nav nav-tabs">
                                    <li class="<?= (!isset($_SESSION['flag_comment'])) ? 'active'  : '' ?>"><a data-toggle="tab" href="#home">Mô tả sản phẩm </a></li>
                                    <li class="<?= isset($_SESSION['flag_comment']) && $_SESSION['flag_comment'] == 1 ? 'active' : '' ?>"><a data-toggle="tab" href="#menu1"> Xem bình luận </a></li>
                                    <li><a data-toggle="tab" href="#menu2"> Hướng dẫn mua hàng  </a></li>
                                    <li><a data-toggle="tab" href="#menu3"> Hướng dẫn thanh toán </a></li>
                                </ul>
                                
                                <div class="tab-content">
                                    <div id="home" class="tab-pane fade <?= (!isset($_SESSION['flag_comment'])) ? 'in active'  : '' ?>">
                                        <h3>Nội dung</h3>
                                        <div>
                                            <?=  $product['prd_content'] ?>
                                        </div>
                                    </div>
                                    <div id="menu1" class="tab-pane fade <?= isset($_SESSION['flag_comment']) && $_SESSION['flag_comment'] == 1 ? 'in active' : '' ?>">
                                        <div style="padding: 20px ;border: 1px solid #dedede;margin-bottom: 10px;background-color: white">
                                            <div id="form-comment" class="col-sm-12">
                                                <h5 style="border-bottom: 2px solid ;padding-bottom: 10px;padding-top: 10px;"> Gủi bình luận của bạn </h5>
                                                <form method="POST" action="">
                                                    <div class="form-group" style="padding-top: 10px;">
                                                        <label for="usr">Họ Tên <span style="color: red">*</span></label>
                                                        <?php if (isset($_SESSION['username'])) :?>
                                                             <input type="text" class="form-control" id="usr" name="cmt_name" readonly="" value="<?= $_SESSION['username'] ?>">
                                                        <?php else : ?>
                                                             <input type="text" class="form-control" id="usr" name="cmt_name" required="" value="">
                                                        <?php endif ; ?>
                                                       
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="usr">Nội Dung <span style="color: red">*</span></label>
                                                        <textarea name="cmt_content" id="" cols="30" rows="3" class="form-control wysihtml5" required=""></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="submit" class="form-control btn btn-xs btn-success" id="pwd" value="&nbsp;Gửi đi">
                                                    </div>
                                                </form>
                                            </div>
                                            
                                            <div class="clearfix"></div>
                                            <div class="col-sm-12" id="content-comment" style="margin-top:50px;">
                                                <div style="padding-left: 30px;padding-right: 30px;">
                                                    <h5 style="border-bottom: 2px solid ;padding-bottom: 20px;margin-bottom:20px"> List Comment </h5>
                                                    <!-- Left-aligned media object -->
                                                    <?php if(count($comment) > 0 ) :?>
                                                        <?php foreach($comment as $cmt) :?>
                                                        <div class="col-sm-12" style="margin-bottom:5px;">
                                                            <div class="media" style="position: relative;">
                                                                <div class="media-left">
                                                                    <img src="/public/uploads/user/<?= $cmt['avatar'] ?>" onerror="this.onerror=null;this.src='/public/user-default.png';" class="media-object" style="width:60px">
                                                                </div>
                                                                <div class="media-body">
                                                                    <h6 style="font-size:14px;" class="media-heading"><a href="javascript:;void(0)" style="color:red;font-weight:bold"><?= $cmt['cmt_name'] ?></a></h6>
                                                                    <p> <b>Nội dung</b></p> 
                                                                    <div class="main-comment">
                                                                        <?php echo $cmt['cmt_content'] ?>.
                                                                    </div>
                                                                </div>

                                                                <?php
                                                                    $flag = 0;

                                                                    if (isset($user) && $cmt['cmt_user_id'] == $user['id'])
                                                                    {
                                                                        $flag = 1;
                                                                    }
                                                                ?>

                                                                <?php if ($flag == 1) :?>
                                                                    <div class="hidenitem">
                                                                        <p><a href="javascript:;void(0)" class="update-item-comment" data-id="<?= $id ?>" data-comment="<?= $cmt['id'] ?>"><i class="fa fa-pencil-square"></i></a></p>
                                                                        <p><a href="chi-tiet-san-pham.php?id=<?= $id ?>&&delete=comment&&id_comment=<?= $cmt['id'] ?>"  data-id="<?= $cmt['id'] ?>"><i class="fa fa-trash"></i> </a></p>
                                                                    </div>
                                                                <?php endif; ?>
                                                                <?php if (isset($user)) :?>
                                                                <div class="box-icon" style="position: absolute;right: 50px;top: 5px;display: flex">
                                                                    <a class="option_like" href="javascript:;void(0)" data-comment-id="<?= $cmt['id'] ?>" data-product-id="<?= $id ?>" data-type="like" style="margin-right:5px;width: 30px;height: 30px;border: 1px solid #dedede;border-radius: 50%"><i style="line-height: 30px;text-align: center;display: block" class="fa fa-hand-o-right" aria-hidden="true"></i></a>
                                                                    <a class="option_like" href="javascript:;void(0)" data-comment-id="<?= $cmt['id'] ?>" data-product-id="<?= $id ?>" data-type="dislike" style="margin-right:5px;width: 30px;height: 30px;border: 1px solid #dedede;border-radius: 50%"><i style="line-height: 30px;text-align: center;display: block" class="fa fa-hand-o-down" aria-hidden="true"></i></a>
                                                                </div>
                                                                <?php endif ;?>
                                                            </div>
                                                            
                                                        </div>
                                                        <?php endforeach ; ?>
                                                    <?php else : ?>
                                                        <p class="text-danger"> Chưa có bình luận nào !</p>
                                                    <?php endif; ?>
                                                    <?php if (isset($_SESSION['flag_comment'])) unset($_SESSION['flag_comment']) ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="menu2" class="tab-pane fade">
                                        <h3 style="margin-bottom: 20px;border-bottom: 1px solid #dedede;padding-bottom: 20px;"> Hướng dẫn mua hàng  </h3>
                                        <ul>
                                            <li style="margin-bottom: 20px;"> 
                                                <h5 style="padding-bottom: 10px;">Thanh toán thực tuyến</h5>
                                                <p ">
                                                    - Phương thức thanh toán trực tiếp: Sau khi nhận được hàng mua, doanh nghiệp thương mại thanh toán ngay tiền cho người bán, có thể bằng tiền mặt, bằng tiền cán bộ tạm ứng, bằng chuyển khoản, có thể thanh toán bằng hàng (hàng đổi hàng)…
                                                </p>
                                            </li>
                                            <li style="margin-bottom: 20px;"> 
                                                <h5 style="padding-bottom: 10px;">Thanh toán chậm trả </h5>
                                                <p ">
                                                    - Doanh nghiệp đã nhận hàng nhưng chưa thanh toán tiền cho người bán. Việc thanh toán chậm trả có thể thực hiện theo điều kiện tín dụng ưu đãi theo thoả thuận. Chẳng hạn, điều kiện “1/10, n/20″ có nghĩa là trong 10 ngày đầu kể từ ngày chấp nhận nợ, nếu người mua thanh toán công nợ sẽ được hưởng chiết khấu thanh toán là 1%. Từ ngày thứ 11 đến hết ngày thứ 20, người mua phải thanh toán toàn bộ công nợ là “n”. Nếu hết 20 ngày mà người mua chưa thanh toán nợ thì họ sẽ phải chịu lãi suất tín dụng.
                                                </p>
                                            </li>
                                        </ul>
                                    </div>
                                    <div id="menu3" class="tab-pane fade">
                                        <h3 style="margin-bottom: 20px;border-bottom: 1px solid #dedede;padding-bottom: 20px;"> Cách thức thanh toán </h3>
                                        <ul>
                                            <li style="margin-bottom: 20px;"> 
                                                <h5 style="padding-bottom: 10px;">Thanh toán thực tuyến</h5>
                                                <p ">
                                                    - Phương thức thanh toán trực tiếp: Sau khi nhận được hàng mua, doanh nghiệp thương mại thanh toán ngay tiền cho người bán, có thể bằng tiền mặt, bằng tiền cán bộ tạm ứng, bằng chuyển khoản, có thể thanh toán bằng hàng (hàng đổi hàng)…
                                                </p>
                                            </li>
                                            <li style="margin-bottom: 20px;"> 
                                                <h5 style="padding-bottom: 10px;">Thanh toán chậm trả </h5>
                                                <p ">
                                                    - Doanh nghiệp đã nhận hàng nhưng chưa thanh toán tiền cho người bán. Việc thanh toán chậm trả có thể thực hiện theo điều kiện tín dụng ưu đãi theo thoả thuận. Chẳng hạn, điều kiện “1/10, n/20″ có nghĩa là trong 10 ngày đầu kể từ ngày chấp nhận nợ, nếu người mua thanh toán công nợ sẽ được hưởng chiết khấu thanh toán là 1%. Từ ngày thứ 11 đến hết ngày thứ 20, người mua phải thanh toán toàn bộ công nợ là “n”. Nếu hết 20 ngày mà người mua chưa thanh toán nợ thì họ sẽ phải chịu lãi suất tín dụng.
                                                </p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               <?php require_once __DIR__.'/layouts/inc_footer.php'; ?>
               <script type="text/javascript" src="/public/app/js/bootstrap3-wysihtml5.all.min.js"></script>
               <script type="text/javascript">
                   $(function(){
                        // $('textarea.wysihtml5').wysihtml5();
                   })
               </script>