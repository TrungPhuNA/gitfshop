<?php
    $modules = 'transactions';
    $title_global = ' Danh sách đơn hàng ';
    require_once __DIR__ .'/../../autoload.php';

    $sql = "SELECT * FROM transactions  WHERE 1 ";
    $filter = [];

    $keyword = Input::get('keyword');
    if ( $keyword ) {
        $sql .= ' AND tst_name LIKE \'%'.$keyword.'%\'' ;
        $filter['keyword'] = $keyword;
    }
    if ( Input::get('email') ) {
        $sql .= ' AND tst_email LIKE \'%'.Input::get('email').'%\'' ;
        $filter['email'] = Input::get('email');
    }
    if ( Input::get('id') ) {
        $sql .= ' AND id = '.Input::get('id') ;
        $filter['id'] = Input::get('id');
    }
    $transactions = Pagination::pagination('transactions',$sql,'page',9);
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
                        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#"> Đơn hàng  </a></li>
                        <li class="active"> Danh sách</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <!-- Default box -->
                    <div class="box <?= empty($filter) ? 'collapsed-box' : ''  ?>">
                        <div class="box-header with-border">
                            <h3 class="box-title"> Bộ Lọc Tìm Kiếm </h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">
                            <form action="">
                                <div class="form-group col-sm-3">
                                    <input type="text" class="form-control" name="keyword" placeholder=" Tên khách hàng  " value="<?= Input::get('keyword') ? Input::get('keyword') : '' ?>">
                                </div>
                                 <div class="form-group col-sm-3">
                                    <input type="text" class="form-control" name="email" placeholder=" Email khách hàng  " value="<?= Input::get('email') ? Input::get('email') : '' ?>">
                                </div>
                                
                                <div class="form-group col-sm-1">
                                    <input type="number" name="id" class="form-control" value="<?= Input::get('id') ?>" placeholder="ID">
                                </div>
                                <div class="form-group col-sm-3">
                                    <input type="submit" value="Tìm Kiếm" class="btn btn-xs btn-success">
                                    <a  href="index.php" class="btn btn-xs btn-danger"> Làm mới<a/>
                                </div>
                                
                                
                            </form>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-header with-border">
                            <a href="/public/admin/news/categorys/add" class="btn btn-xs btn-success"><i class="fa fa-plus"></i> Thêm mới </a>
                            
                        </div>
                        <div class="box-body">
                            <div class="box-body table-responsive no-padding">
                                <table class="table table-hover">
                                    <tbody>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Pay</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        <?php foreach ($transactions as $key => $item) :?>
                                            <tr>
                                                <td> <?= $item['id'] ?></td>
                                                <td><?= $item['tst_name'] ?></td>
                                                <td><?= $item['tst_email'] ?></td>
                                                <td><?= $item['tst_phone'] ?></td>
                                                <td><?= $item['tst_address'] ?></td>
                                                <td><?= formatPrice($item['tst_total']) ?> đ</td>
                                                <td>
                                                    <a href="status.php?id=<?= $item['id'] ?>" class="custome-btn label <?= $item['tst_status'] == 1 ? 'label-info' : 'label-default' ?>"><span> <?= $item['tst_status'] == 1 ? ' Đã thanh toán ' : ' Chưa thanh toán ' ?></span></a>
                                                </td>
                                                <td>
                                                    <a href="javascript:;void(0)" class="custome-btn btn-info btn-xs item-order" data-id=<?= $item['id' ] ?>><i class="fa fa-pencil-square"></i> Xem chi tiết </a>
                                                    <a href="delete.php?id=<?=1?>" class="custome-btn btn-danger btn-xs delete" ><i class="fa fa-trash"></i> Huỷ đơn hàng  </a>
                                                </td>
                                            </tr>
                                        <?php endforeach ; ?>
                                        
                                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <div class="custome-paginate">
                                <div class="pull-left">
                                    <p>Trang 1 - Số bản ghi hiển thị 20 - Tổng số trang 1 - Tổng số bản ghi 3</p>
                                </div>
                                <div class="pull-right"></div>
                            </div>
                        </div>
                        <!-- /.box-footer-->
                    </div>
                    <!-- /.box -->
                </section>
            </div>
            <div class="modal fade" id="modal-vieworder">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title"> Chi tiết đơn hàng </h4>
                        </div>
                        <div class="modal-body">
                            <table class="table table-hover" id="vieworder-content">
                                <tbody>
                                    <tr class="bg-tr">
                                        <th>ID</th>
                                        <th>Tên sản phẩm</th>
                                        <th> Hình ảnh </th>
                                        <th class="text-center">Giá </th>
                                        <th>Số Lượng</th>
                                        <th>Thành Tiền</th>
                                        <th>Thao Tác</th>
                                    </tr>
                                </tbody>
                                <tbody id="order-content">
                                    
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- =======================END CONTENT======================== -->
            <?php require_once __DIR__ .'/../../layouts/inc_footer.php'; ?>
        </div>
        <?php require_once __DIR__ .'/../../layouts/inc_js.php'; ?>
