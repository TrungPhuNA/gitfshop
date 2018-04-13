<?php
    require_once __DIR__. '/../autoload.php';
    // kiểm tra xem giỏ hàng có tồn tại không 
    if( ! isset($_SESSION['cart']) ||  count($_SESSION['cart']) == 0 )
    {
        redirectUrl('/pages');
    }


    //  gán danh sách giỏ hàng vào 1 mảng 
    $cartProduct = $_SESSION['cart'];
    $sum = 0 ;

    // xac nhan thanh toan
    // xu ly thanh toan 
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
       $name    = Input::get('name');
       $email   = Input::get('email');
       $phone   = Input::get('phone');
       $address = Input::get('address');

       $data = [
            'tst_email'   => $email,
            'tst_name'    => $name,
            'tst_phone'   => $phone,
            'tst_address' => $address,
            'tst_total'   => $_SESSION['total']
       ];
        $idTransaction = DB::insert('transactions',$data);

        foreach($cartProduct as $key => $val)
        {
            $order = [
                'od_transaction_id' => $idTransaction,
                'od_product_id'     => $key,
                'od_price'          => $val['price'],
                'od_qty'            => $val['qty']
            ];
            $idOrder = DB::insert('orders',$order);
        }
        unset($_SESSION['cart']);
        $_SESSION['thongbao'] = ' Xác nhận thanh toán thành công ';
        redirectUrl('/shoppingcart/thong-bao.php');
       
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Thanh toán đơn hàng  </title>
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
                    <div class="col-md-12">
                        <section class="box-main1" >
                        <div class="col-sm-4">
                        <form action="" method="POST">
                            <div class="panel panel-primary">
                            
                                <div class="panel-heading"> Thông tin thanh toán </div>
                                <div class="panel-body">
                                    
                                        <div class="form-group">
                                            <label for="email"> Họ Và Tền <span style="color:red">(*)</span></label>
                                            <input type="text" required="" class="form-control" id="email" placeholder=" Họ tên đầy đủ " name="name">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email <span style="color:red">(*)</span></label>
                                            <input type="email" required="" class="form-control" id="email" placeholder="Email cá nhân" name="email">
                                        </div>
                                        <div class="form-group">
                                            <label for="email"> Địa chỉ  <span style="color:red">(*)</span></label>
                                            <input type="text"  required="" class="form-control" id="email" placeholder="Địa chỉ nhận hàng" name="address">
                                        </div>
                                        <div class="form-group">
                                            <label for="email"> Số điện thoại  <span style="color:red">(*)</span></label>
                                            <input type="number" required="" class="form-control" id="email" placeholder="Số điện thoại liên hệ " name="phone">
                                        </div>
                                        
                                    
                                </div>
                                <div class="panel-footer">
                                    <div class="pull-right">
                                        <button  type="submit" class="btn btn-xs btn-success"> Xác nhận </button>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            </form>
                        </div>
                        <div class="col-sm-4">
                            <div class="panel panel-primary">
                                <div class="panel-heading"> Mời bạn đọc danh sách các điều khoản  </div>
                                <div class="panel-body">
                                
                                </div>
                            
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="panel panel-primary">
                                <div class="panel-heading"> Danh sách sản phẩm giỏ hàng </div>
                                <div class="panel-body">
                                    <?php foreach($cartProduct as $item) :?>
                                        <div class="media">
                                            <div class="media-left">
                                                <img src="/public/uploads/products/<?= $item['img'] ?>" class="media-object" style="width:60px">
                                            </div>
                                            <div class="media-body">
                                                <h4 class="media-heading"><?= $item['name'] ?></h4>
                                                <p>Số Lượng : <span><?= $item['qty'] ?></span></p>
                                                <p> Giá : <span><?= formatPrice($item['price']* $item['qty']) ?>đ</span></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <?php $sum += $item['price']* $item['qty']; ?>
                                    <?php endforeach ; ?>
                                    <?= $_SESSION['total'] = $sum ?>
                                    <p> Thành tiền : <span class="label label-success"><?= formatPrice($sum) ?> đ</span></p>
                                </div>
                                
                            </div>
                        </div>
                           
                       
                        </section>
                        
                    </div>
                </div>
               <?php require_once __DIR__.'/../layouts/inc_footer.php'; ?>