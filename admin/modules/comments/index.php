<?php
    $modules = 'comment';
    $title_global = 'Quản lý comments ';
    require_once __DIR__ .'/../../autoload.php';

      $sql = "SELECT comments.*,products.prd_name, products.id as id_pro FROM comments 
        LEFT JOIN products ON products.id = comments.cmt_product_id
        WHERE 1 ";

    $comments = Pagination::pagination('comments',$sql,'page',9);

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
                        <li><a href="#"> Comment  </a></li>
                        <li class="active"> Danh sách</li>
                    </ol>
                    <div class="clearfix"></div>
                </section>
                <!-- Main content -->
                <section class="content clearfix">
                    <!-- Default box -->
                    <div class="box">
                      
                        <div class="box-body">
                            <div class="box-body table-responsive no-padding">
                                <table class="table table-hover">
                                    <tbody>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Nội dung</th>
                                            <th>Sản phẩm</th>
                                            <th>Action</th>
                                        </tr>
                                        <?php foreach($comments as $comment) :?>
                                        <tr>
                                            <td><?= $comment['id'] ?></td>
                                            <td><?= $comment['cmt_name'] ?></td>

                                           <td style="width: 40%">
                                               <div style="width: 100%;max-height: 400px;overflow: scroll;"><?= $comment['cmt_content'] ?></div>
                                           </td>
                                            <td style="width: 20%"><a target="_blank" href="/pages/chi-tiet-san-pham.php?id=<?= $comment['id_pro'] ?>" class="custome-btn"><?= $comment['prd_name'] ?></a></td>
                                            <td>
                                                <a href="delete.php?id=<?= $comment['id'] ?>" class="custome-btn btn-danger btn-xs delete" ><i class="fa fa-trash"></i> Trash </a>
                                            </td>
                                        </tr>
                                        <?php endforeach ;?>
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
                                    <?php echo Pagination::getListpage() ?>
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
