<?php
    require_once __DIR__. '/../autoload.php';
?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>MaxShop : Đồ án tốt nghiệp</title>
        <meta charset="utf-8">
        <?php require_once __DIR__.'/../layouts/inc_head.php'; ?>
        <style type="text/css">
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
            <div class="col-sm-12">
                <div class="" style="padding: 20px;border: 1px solid red">
                    <?php
                        $conn  = mysqli_connect('localhost','root','root','da_basephp') or die ( ' Lỗi kết nối cơ sở dữ liệu  ' );
                        // gan kieu du lieu
                        mysqli_set_charset($conn,"utf8");
                        $sql  = 'SELECT * FROM products WHERE 1 ';
                        $result = mysqli_query($conn,$sql);
                        $data = [];
                        if ($result)
                        {
                            while ($num = mysqli_fetch_assoc($result))
                            {
                                $data[] = $num;
                            }
                        }

                    ?>
                    <img src="/public/vidu.png" alt="" class="img img-responsive">

                </div>

                <div>
                    <table class="table">
                        <tr>
                            <td>ID</td>
                            <td>Name</td>
                        </tr>
                        <?php foreach($data as $item) :?>
                            <tr>
                                <td> <?= $item['id'] ?></td>
                                <td> <?= $item['prd_name'] ?></td>
                            </tr>
                        <?php endforeach ;?>

                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>

<?php require_once __DIR__.'/../layouts/inc_footer.php'; ?>