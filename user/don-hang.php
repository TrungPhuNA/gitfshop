<?php
    require_once __DIR__. '/../autoload.php';
    // kiểm tra xem giỏ hàng có tồn tại không 
    // check login admin 
    if ( ! isset($_SESSION['id_user']))
    {
        header("Location: ".baseServerName().'/pages');exit();
    }
    $id_user = (int)$_SESSION['id_user'];

    $sql = "SELECT transactions.* ,users.name as name ,admins.name as name_admin from transactions
        LEFT JOIN users ON transactions.tst_user_id = users.id
        LEFT JOIN admins ON transactions.tst_admin_id = admins.id
        WHERE 1 and tst_user_id = $id_user ";
    $transaction = Pagination::pagination('transactions',$sql,'page',9);
    
    $sum = 0;
?>
<!DOCTYPE html>


<html>
    <head>
        <title> Danh sách đơn hàng </title>
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
                        <div class="panel panel-primary">
                            <div class="panel-heading"> Danh sách sản phẩm giỏ hàng </div>
                            <div class="panel-body">
                                <table class="table">
                                    <thead>

                                        <tr>
                                            <th>STT</th>
                                            <th> Tên </th>
                                            <th> Tổng tiền </th>
                                            <th> Trạng thái </th>
                                            <th> Ngày mua </th>
                                            <th> Người xử lý </th>
                                            <th> Thao Tác </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if( count($transaction) > 0) :?>
                                            <?php foreach($transaction as $item) :?>
                                                <tr class="delete_tr">
                                                    <td><?= $item['id'] ?></td>
                                                    <td><?= $item['name'] ?></td>
                                                    <td><?= formatPrice($item['tst_total']) ?>đ</td>
                                                    <td> 
                                                        <?php if ($item['tst_status'] == 1) :?>
                                                            <a href="javascript:;void(0)" class="btn btn-xs btn-info" data-id-product=<?= $item['id'] ?>> Đã thanh toán </a>
                                                        <?php else :?>
                                                            <a href="javascript:;void(0)" class="btn btn-xs btn-default" data-id-product=<?= $item['id'] ?>> Chưa thanh toán  </a>
                                                        <?php endif ;?>
                                                    </td>
                                                    <td><?= $item['created_at'] ?></td>
                                                    <td><b><?= $item['name_admin'] ?></b></td>
                                                    <td>
                                                        <?php if($item['tst_status'] != 1) :?>
                                                        <a href="delete.php?id=<?= $item['id'] ?>" class="btn btn-xs btn-danger remove-item-cart" data-id-product=<?= $item['id'] ?>> Huỷ Bỏ  </a>
                                                        <?php endif ;?>
                                                    </td>
                                                </tr>
                                                <?php $sum += $item['tst_total'] ?>
                                            <?php endforeach ; ?>
                                        <?php else :?>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>Không có  đơn hàng nào  </td>
                                                <td><span class="label label-success" style="font-size:14px;">0 đ</span></td>
                                            </tr>
                                        <?php endif ;?>
                                    <tr>
                                    
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><b style="font-weight: bold">Tổng Số Tiền </b></td>
                                        <td><span class="label label-success" style="font-size:14px;"><?= formatPrice($sum) ?> đ</span></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
<!--                            <div class="panel-footer">-->
<!--                                <div class="pull-right">-->
<!--                                    <a href="thanh-toan.php" class="btn btn-xs btn-success">Tiến hành thanh toán  </a>-->
<!--                                </div>-->
<!---->
<!--                                <div class="clearfix"></div>-->
<!--                            </div>-->
                        </div>
                       
                        </section>
                        
                    </div>
                </div>
               <?php require_once __DIR__.'/../layouts/inc_footer.php'; ?>
