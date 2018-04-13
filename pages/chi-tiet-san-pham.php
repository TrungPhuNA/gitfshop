<?php
    require_once __DIR__. '/../autoload.php';
    $id = Input::get('id');
    // lay chi tiet san pham
    $product = DB::fetchOne('products',' id = '.$id.' and prd_active = 1 ' );

    // lay danh sach sản phẩm kèm theo 

    // lấy danh sách comment của sản phẩm 
    $comment = DB::query('comments' ,'*',' and cmt_product_id = ' .$id . ' ORDER BY ID DESC lIMIT 3' );
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
        //tiến hành insert 
        $id_insert = DB::insert('comments',$data);

        if($id_insert > 0)
        {
            // insert thanh cong
            // gán session thông báo thành công
            $_SESSION['success'] = "Thêm mới thành công ";
            header("Location: ".'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);exit();
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>  Chi tiết sản phẩm  </title>
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
                    <div class="col-md-3  fixside" >
                        <?php require_once __DIR__.'/../layouts/inc_left.php' ;?>
                        <div class="box-left box-menu">
                            <h3 class="box-title title-new" style="position: relative;">
                                <i class="fa fa-warning"></i>  Sản phẩm mới 
                                <img src="/public/images/new_neeraj.gif">
                            </h3>
                            <!--  <marquee direction="down" onmouseover="this.stop()" onmouseout="this.start()"  > -->
                            <ul> 
                                <?php foreach($productNew as $item) :?>
                                <li class="clearfix">
                                    <a href="/pages/chi-tiet-san-pham.php?id=<?= $item['id'] ?>">
                                        <img src="/public/uploads/products/<?= $item['prd_thunbar'] ?>" class="img-responsive pull-left" width="80" height="80">
                                        <div class="info pull-right">
                                            <p class="name"> <?= $item['prd_name'] ?> </p >
                                            <?php if($item['prd_sale']) :?>
                                                Cũ :<b class="sale"><?= formatPrice($item['prd_price']) ?> đ</b> <br>
                                                Mới :<b class="price"><?= formatPrice($item['prd_price'],$item['prd_sale']) ?>đ</b><br>
                                            <?php else :?>
                                                Giá : <b class="price"><?= formatPrice($item['prd_price']) ?> đ</b><br>
                                            <?php endif ;?>
                                            <span class="view"><i class="fa fa-eye"></i> 100000 : <i class="fa fa-heart-o"></i> 10</span>
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
                                    <a href="/pages/chi-tiet-san-pham.php?id=<?= $item['id'] ?>">
                                        <img src="/public/uploads/products/<?= $item['prd_thunbar'] ?>" class="img-responsive pull-left" width="80" height="80">
                                        <div class="info pull-right">
                                            <p class="name"> <?= $item['prd_name'] ?> </p >
                                            <?php if($item['prd_sale']) :?>
                                                Cũ :<b class="sale"><?= formatPrice($item['prd_price']) ?> đ</b> <br>
                                                Mới :<b class="price"><?= formatPrice($item['prd_price'],$item['prd_sale']) ?>đ</b><br>
                                            <?php else :?>
                                                Giá : <b class="price"><?= formatPrice($item['prd_price']) ?> đ</b><br>
                                            <?php endif ;?>
                                            <span class="view"><i class="fa fa-eye"></i> 100000 : <i class="fa fa-heart-o"></i> 10</span>
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
                                    <li><h3 style="border-bottom: 1px solid #dedede;padding-bottom: 10px;"> Tên sản phẩm :  <?= $product['prd_name'] ?> </h3></li>
                                    <li><p> Mô tả : <?= $product['prd_description'] ?> </p></li>
                                    <li>
                                        <?php if($product['prd_sale']) :?>
                                            <p>Giá cũ : <strike class="sale"><?= formatPrice($product['prd_price']) ?> đ</strike> <b class="price">Giá mới : <?= formatPrice($product['prd_price'],$product['prd_sale']) ?>đ</b></p>
                                        <?php else :?>
                                            <p><b class="price"> Giá sản phẩm : <?= formatPrice($product['prd_price']) ?> đ</b></p>
                                        <?php endif ;?>    
                                    </li>
                                    <li>
                                        Tình trạng : <span style="color:red"><?= $product['prd_number'] > 0 ? " Còn hàng "  : " Hết Hàng "?></span>
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
                                    <li class="active"><a data-toggle="tab" href="#home">Mô tả sản phẩm </a></li>
                                    <li><a data-toggle="tab" href="#menu1"> Xem bình luận </a></li>
                                    <li><a data-toggle="tab" href="#menu2"> Hướng dẫn mua hàng  </a></li>
                                    <li><a data-toggle="tab" href="#menu3"> Hướng dẫn thanh toán </a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="home" class="tab-pane fade in active">
                                        <h3>Nội dung</h3>
                                        <div>
                                            <?=  $product['prd_content'] ?>
                                        </div>
                                    </div>
                                    <div id="menu1" class="tab-pane fade">
                                        <div style="padding: 20px ;border: 1px solid #dedede;margin-bottom: 10px;background-color: white">
                                            <div id="form-comment" class="col-sm-6 ">
                                                <h5 style="border-bottom: 2px solid ;padding-bottom: 20px;"> Gủi bình luận của bạn </h5>
                                                <form method="POST" action="">
                                                    <div class="form-group">
                                                        <label for="usr">Họ Tên <span style="color: red">*</span></label>
                                                        <input type="text" class="form-control" id="usr" name="cmt_name" required="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="usr">Nội Dung <span style="color: red">*</span></label>
                                                        <textarea name="cmt_content" id="" cols="30" rows="3" class="form-control" required=""></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="submit" class="form-control btn btn-xs btn-success" id="pwd" value="&nbsp;Gửi đi">
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-sm-6" id="content-comment">
                                                <div style="padding-left: 30px;padding-right: 30px;">
                                                    <h5 style="border-bottom: 2px solid ;padding-bottom: 20px;"> List Comment News </h5>
                                                    <!-- Left-aligned media object -->
                                                    <?php if(count($comment) > 0 ) :?>
                                                        <?php foreach($comment as $cmt) :?>
                                                            <div class="media">
                                                                <div class="media-left">
                                                                    <img src="http://news.loca/frontend/img_avatar1.png" class="media-object" style="width:60px">
                                                                </div>
                                                                <div class="media-body">
                                                                    <h6 style="font-size:14px;" class="media-heading"><a href="javascript:;void(0)" style="color:red;font-weight:bold"><?= $cmt['cmt_name'] ?></a></h6>
                                                                    <p> <b>Nội dung</b> : <?= $cmt['cmt_content'] ?>.</p>
                                                                </div>
                                                            </div>
                                                        <?php endforeach ; ?>
                                                    <?php else : ?>
                                                        <p class="text-danger"> Chưa có bình luận nào !</p>
                                                    <?php endif; ?>
                                                    
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-sm-12" id="content-comment" style="margin-top:50px;">
                                                <div style="padding-left: 30px;padding-right: 30px;">
                                                    <h5 style="border-bottom: 2px solid ;padding-bottom: 20px;margin-bottom:20px"> List Comment </h5>
                                                    <!-- Left-aligned media object -->
                                                    <?php if(count($comment) > 0 ) :?>
                                                        <?php foreach($comment as $cmt) :?>
                                                        <div class="col-sm-6" style="margin-bottom:5px;">
                                                            <div class="media">
                                                                    <div class="media-left">
                                                                        <img src="http://news.loca/frontend/img_avatar1.png" class="media-object" style="width:60px">
                                                                    </div>
                                                                    <div class="media-body">
                                                                        <h6 style="font-size:14px;" class="media-heading"><a href="javascript:;void(0)" style="color:red;font-weight:bold"><?= $cmt['cmt_name'] ?></a></h6>
                                                                        <p> <b>Nội dung</b> : <?= $cmt['cmt_content'] ?>.</p>
                                                                    </div>
                                                                </div>
                                                        </div>
                                                            
                                                        <?php endforeach ; ?>
                                                    <?php else : ?>
                                                        <p class="text-danger"> Chưa có bình luận nào !</p>
                                                    <?php endif; ?>
                                                    
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
               <?php require_once __DIR__.'/../layouts/inc_footer.php'; ?>