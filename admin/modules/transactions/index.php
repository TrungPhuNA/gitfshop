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

    if ( Input::get('status') ) {
        $status = Input::get('status') == 2 ? 0 : 1;
        $sql .= ' AND tst_status = '. $status ;
        $filter['status'] = Input::get('status');
    }

    if ( Input::get('time') ) {
        $time = Input::get('time');
        $date = get_start_and_time($time);

        $sql .= " AND tst_date_payment BETWEEN  '".$date['start']."' AND '".$date['end']."' ";
        $filter['time'] = Input::get('time');
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
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <style type="text/css">
            #reportrange { position: relative; }
            #reportrange:before {
                content : "\f073";
                position: absolute;
                font-family: FontAwesome;
                top: 50%;
                transform: translateY(-50%);
            }
            /*<i class="fa fa-calendar"></i>&nbsp;*/
        </style>
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
                    <div class="box">
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
                                <div id="reportrange" style="background: #fff; cursor: pointer;border-radius: 2px" class="form-group col-sm-3">
                                    <input type="text" style="text-indent: 13px;"  value="<?= Input::get('time') ? Input::get('time') : '' ?>" name="time" autocomplete="off" placeholder="Lọc thời gian" class="form-control w-300 time_processing">
                                </div>

                                <div class="form-group col-sm-2">
                                    <select class="form-control" name="status">
                                        <option>-- Trạng thai --</option>
                                        <option value="1" <?= Input::get('status') && Input::get('status') == 1? "selected = 'selected'" : "" ?>>Đã thanh toán</option>
                                        <option value="2" <?= Input::get('status') && Input::get('status') == 2? "selected = 'selected'" : "" ?>>Chưa thanh toán</option>
                                    </select>
                                </div>

                                <div class="form-group col-sm-3">
                                    <input type="submit" value="Tìm Kiếm" class="btn  btn-success">
                                    <a  href="index.php" class="btn  btn-danger"> Làm mới<a/>
                                </div>
                                
                                
                            </form>
                        </div>
                    </div>
                    <div class="box">
                        
                        <div class="box-body">
                            <div class="box-body table-responsive no-padding">
                                <table class="table table-hover">
                                    <tbody>
                                        <tr>
                                            <th>ID</th>
                                            <th>Họ Tên</th>
                                            <th>Email</th>
                                            <th>Số đt</th>
                                            <th>Địa chỉ</th>
                                            <th>Tổng tiền</th>
                                            <th>Trạng thái</th>
                                            <th>Ngày Xử Lý</th>
                                            <th>Thao tác</th>
                                        </tr>
                                        <?php foreach ($transactions as $key => $item) :?>
                                            <tr class="item_product">
                                                <td> <?= $item['id'] ?></td>
                                                <td><span class="name"><?= $item['tst_name'] ?></span></td>
                                                <td><?= $item['tst_email'] ?></td>
                                                <td><?= $item['tst_phone'] ?></td>
                                                <td><?= $item['tst_address'] ?></td>
                                                <td><span class="total"><?= formatPrice($item['tst_total']) ?> đ</span></td>
                                                <td>
                                                    <a href="status.php?id=<?= $item['id'] ?>" class="custome-btn label <?= $item['tst_status'] == 1 ? 'label-info' : 'label-default' ?>"><span> <?= $item['tst_status'] == 1 ? ' Đã thanh toán ' : ' Chưa thanh toán ' ?></span></a>
                                                </td>
                                                <td><?= $item['tst_date_payment'] ?></td>
                                                <td>
                                                    <a data-toggle="tooltip" title="Xem chi tiết" href="javascript:;void(0)" class="custome-btn btn-info btn-xs item-order" data-id=<?= $item['id' ] ?>><i class="fa fa-pencil-square"></i>  </a>
                                                    <a data-toggle="tooltip" title="Xoá đơn hàng" href="delete.php?id=<?= $item['id']?>" class="custome-btn btn-danger btn-xs comfirm_delete" ><i class="fa fa-trash"></i>  </a>
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
                                <div class="pull-right">
                                    <?php echo Pagination::getListpage($filter) ?>
                                </div>
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
                            <h4 class="modal-title"> Chi tiết đơn hàng | <span>Họ Tên <b id="auth-transaction" style="color: red"></b></span> | <span>Tổng tiền <b id="total-transaction" style="color: red"></b></span></h4>
                            
                        </div>
                        <div class="modal-body">
                            <table class="table table-hover" id="vieworder-content">
                                <tbody>
                                    <tr class="bg-tr">
                                        <th>ID</th>
                                        <th>ID SP</th>
                                        <th style="width: 40%">Tên sản phẩm</th>
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
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <script>
            $(document).ready(function(){
                $('[data-toggle="tooltip"]').tooltip();   
            });

            $('#reportrange input').daterangepicker({
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear'
                },
                ranges: {
                    'Hôm nay': [moment(), moment()],
                    'Hôm qua': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    '7 ngày trước': [moment().subtract(6, 'days'), moment()],
                    '30 ngày trước': [moment().subtract(29, 'days'), moment()],
                    'Tháng này': [moment().startOf('month'), moment().endOf('month')],
                    'Tháng trước': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            })
            .on('apply.daterangepicker', function (ev, picker) {
                $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
            })
            .on('cancel.daterangepicker', function (ev, picker) {
                $(this).val('');
            });

        </script>
