<?php
    require_once __DIR__. '/../autoload.php';
    // kiểm tra xem giỏ hàng có tồn tại không 
    if( ! isset($_SESSION['cart']) ||  count($_SESSION['cart']) == 0 )
    {
        redirectUrl('/');
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
       
    }
    //  gán danh sách giỏ hàng vào 1 mảng 
    $cartProduct = $_SESSION['cart'];
    $sum = 0 ;
?>
<!DOCTYPE html>


<html>
    <head>
        <title> Danh sách giỏ hàng  </title>
        <meta charset="utf-8">
        <?php require_once __DIR__.'/../layouts/inc_head.php'; ?>
        <style type="text/css">
            .load-wrapp {
                float: left;
                border-radius: 5px;
                text-align: center;
                display: none;

                /* style them */
                position: absolute;
                top: 8px;
                left: 50%;transform: translateX(-50%);
            }

            .load-wrapp p {padding: 0 0 20px;}
            .load-wrapp:last-child {margin-right: 0;}
            .ring-1 {
                width: 10px;
                height: 10px;
                margin: 0 auto;
                padding: 10px;
                border: 7px dashed #4b9cdb;
                border-radius: 100%;
            }



            /* =Animate the stuff
            ------------------------ */
            

            .load-4 .ring-1 {animation: loadingD 1.5s .3s cubic-bezier(.17,.37,.43,.67) infinite;}

        
            @keyframes loadingD {
                0 {transform: rotate(0deg);}
                50% {transform: rotate(180deg);}
                100% {transform: rotate(360deg);}
            }
        </style>
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
                        <div class="panel panel-primary">
                            <div class="panel-heading"> Danh sách sản phẩm giỏ hàng </div>
                            <div class="panel-body">
                                <table class="table">
                                    <thead>

                                        <tr>
                                            <th>STT</th>
                                            <th>Tên Sản Phẩm </th>
                                            <th>Hình Ảnh</th>
                                            <th> Giá </th>
                                            <th style="width: 10%"> Số Lượng </th>
                                            <th> Thành Tiền </th>
                                            <th> Thao Tác </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($cartProduct as $key => $item) :?>
                                        <tr class="delete_tr">
                                            <td><?= $key ?></td>
                                            <td><?= $item['name'] ?></td>
                                            <td>
                                                <img src="/public/uploads/products/<?= $item['img'] ?>" alt="" style="width:50px;height:50px;">
                                            </td>
                                            <td><?= formatPrice($item['price']) ?>đ</td>
                                            <td>
                                                <input type="number" name="qty" id="qty" value="<?= $item['qty'] ?>" class="form-control item-qty-cart" style="width:100%">
                                            </td>
                                            <td><?= formatPrice($item['price']* $item['qty']) ?>đ</td>
                                            <td> 
                                                <a href="javascript:;void(0)" class="btn btn-xs btn-info update-item-cart" data-id-product=<?= $key ?>> Cập Nhật </a>
                                                <a href="javascript:;void(0)" class="btn btn-xs btn-danger remove-item-cart" data-id-product=<?= $key ?>> Huỷ Bỏ  </a>
                                            </td>
                                        </tr>
                                        <?php $sum += $item['price']* $item['qty']; ?>
                                    <?php endforeach ; ?>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Tổng Số Tiền </td>
                                        <td><span class="label label-success" style="font-size:14px;"><?= formatPrice($sum) ?> đ</span></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="panel-footer">
                                <div class="pull-right">
                                    <a href="/" class="btn btn-xs btn-danger">Tiếp tục mua hàng </a>
                                    <a href="thanh-toan.php" class="btn btn-xs btn-success">Tiến hành thanh toán  </a>
                                </div>

                                <div class="clearfix"></div>
                            </div>
                        </div>
                       
                        </section>
                        
                    </div>
                </div>
               <?php require_once __DIR__.'/../layouts/inc_footer.php'; ?>
