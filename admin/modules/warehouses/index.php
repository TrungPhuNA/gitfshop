<?php
    $modules = 'warehouses';
    $title_global = ' Quản lý kho ';
    require_once __DIR__ .'/../../autoload.php';

    $sql = "SELECT products.* , category_products.cpr_name FROM products 
        LEFT JOIN category_products ON category_products.id = products.prd_category_product_id
        WHERE 1 
    ";
    $filter = [];
    if ( Input::get('pheptinh') )
    {
        $filter['pheptinh'] = Input::get('pheptinh');
        $pheptinh = Input::get('pheptinh');
    }
    else
    {
        $pheptinh = ">=";
    }

    if (Input::get('number'))
    {
        
        $sql .= " AND  prd_number " . $pheptinh . "  " .Input::get('number');
        $filter['number'] = Input::get('number');
    }

    if (Input::get('view'))
    {
        
        $sql .= " AND  prd_view " . $pheptinh . "  " .Input::get('view');
        $filter['view'] = Input::get('view');
    }

     if (Input::get('hear'))
    {
        
        $sql .= " AND  prd_hear " . $pheptinh . "  " .Input::get('hear');
        $filter['hear'] = Input::get('hear');
    }

    $keyword = Input::get('name');
    if ( $keyword ) {
        $sql .= ' AND prd_name LIKE \'%'.$keyword.'%\'' ;
        $filter['name'] = $keyword;
    }


    if ( Input::get('id') ) {
        $sql .= ' AND products.id = '.Input::get('id') ;
        $filter['id'] = Input::get('id');
    }


    if ( Input::get('time') ) {
        $time = Input::get('time');
        $date = get_start_and_time($time);

        $sql .= " AND DAY(products.created_at) BETWEEN  '".$date['start']."' AND '".$date['end']."' ";
        $filter['time'] = Input::get('time');
    }

    $products = Pagination::pagination('products',$sql,'page',9);

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> <?= isset($title_global) ? $title_global : 'Trang admin ' ?>  </title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php require_once __DIR__ .'/../../layouts/inc_css.php'; ?>
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
                        <li><a href="#"> Sản Phẩm </a></li>
                        <li class="active"> Danh sách</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
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

                                <div class="form-group col-sm-2">
                                    <select class="form-control" name="number">
                                        <option value=''>-- Số lượng sản phẩm  --</option>
                                        <?php for($i = 0; $i <= 100 ; $i = $i + 5) :?>
                                            <option value="<?=$i?>" <?= Input::get('number') && Input::get('number') == $i? "selected = 'selected'" : "" ?>> còn <?= $i ?> sản phẩm</option>
                                        <?php endfor ;?>
                                    </select>
                                </div>

                                <div class="form-group col-sm-2">
                                    <select class="form-control" name="view">
                                        <option value=''>-- Số lượng xem  --</option>
                                        <?php for($i = 0; $i <= 100 ; $i = $i + 5) :?>
                                            <option value="<?=$i?>" <?= Input::get('view') && Input::get('view') == $i? "selected = 'selected'" : "" ?>>  <?= $i ?> lần</option>
                                        <?php endfor ;?>
                                    </select>
                                </div>

                                <div class="form-group col-sm-2">
                                    <select class="form-control" name="hear">
                                        <option value=''>-- Số lượng thích  --</option>
                                        <?php for($i = 0; $i <= 100 ; $i = $i + 5) :?>
                                            <option value="<?=$i?>" <?= Input::get('hear') && Input::get('hear') == $i? "selected = 'selected'" : "" ?>>  <?= $i ?> lần</option>
                                        <?php endfor ;?>
                                    </select>
                                </div>

                                <div class="form-group col-sm-3">
                                    <input type="text" class="form-control" autocomplete="off" name="name" placeholder=" Tên sản phẩm  " value="<?= Input::get('name') ? Input::get('name') : '' ?>">
                                </div>
                                
                            
                                <div class="form-group col-sm-1">
                                    <input type="number" name="id" class="form-control" value="<?= Input::get('id') ?>" placeholder="ID">
                                </div>

                                <div id="reportrange" style="background: #fff; cursor: pointer;border-radius: 2px" class="form-group col-sm-3">
                                    <input type="text" style="text-indent: 13px;"  value="<?= Input::get('time') ? Input::get('time') : '' ?>" name="time" autocomplete="off" placeholder="Thời gian thêm" class="form-control w-300">
                                </div>    
                                 <div class="form-group col-sm-2">
                                    <select class="form-control" name="pheptinh">
                                        <option value=">=" <?= Input::get('pheptinh') && Input::get('pheptinh') == '>=' ? "selected='selected'": ''?>> >= </option>
                                        <option value="<=" <?= Input::get('pheptinh') && Input::get('pheptinh') == '<=' ? "selected='selected'": ''?>> <= </option>
                                        <option value="=" <?= Input::get('pheptinh') && Input::get('pheptinh') == '=' ? "selected='selected'": ''?>> = </option>
                                    </select>
                                </div>                        

                                <div class="form-group col-sm-3">
                                    <input type="submit" value="Tìm Kiếm" class="btn  btn-success">
                                    <a  href="index.php" class="btn  btn-danger"> Làm mới<a/>
                                </div>
                                
                                
                            </form>
                        </div>
                    </div>
                    <!-- Default box -->
                    <div class="box">

                        <div class="box-body">
                            <div class="box-body table-responsive no-padding">
                                <table class="table table-hover border">
                                    <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Thunbar</th>
                                        <th>Info</th>
                                    </tr>
                                    <?php foreach($products as $pro) :?>
                                        <tr class='<?= $pro['prd_number'] <= 5 ? "bg-danger-nhat" : "" ?>'>
                                            <td><?= $pro['id'] ?></td>
                                            <td><?= $pro['prd_name'] ?></td>
                                            <td>
                                                <img src="/public/uploads/products/<?= $pro['prd_thunbar'] ?>" alt="<?= $pro['prd_name'] ?>" style="width:50px;height:50px;" class="img img-responsive">
                                            </td>
                                            <td>
                                                Danh Mục : <span class="label label-success"><?= $pro['cpr_name'] ?></span><br>
                                                Số Lượng : <b><?= $pro['prd_number'] ?></b> | Sale : <b><?= $pro['prd_sale'] ?> (%) </b><br>
                                                Giá : <b> <?= formatPrice($pro['prd_price']) ?> đ </b> <?= $pro['prd_sale'] != 0 ? " | <b>".formatPrice($pro['prd_price'],$pro['prd_sale'])." đ</b>" : '' ?>
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
