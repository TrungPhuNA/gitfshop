<?php
require_once __DIR__. '/../autoload.php';
    $sql = "SELECT * FROM posts WHERE 1 ORDER BY ID DESC ";
    $posts = Pagination::pagination('posts',$sql,'page',8);
    $filter = [];
?>
    <!DOCTYPE html>
    <html>
    <head>
        <title> Danh sách chi tiết </title>
        <meta charset="utf-8">
        <?php require_once __DIR__.'/../layouts/inc_head.php'; ?>
        <style>
            .box-menu .active a{ color:red !important }
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
        <div class="row">
            <div class="col-sm-8">
                <div class="list-post">
                    <div class="row">
                        <h2 style="padding-bottom: 10px;border-bottom: 1px solid #dedede;margin: 19px;"> Danh sách các câu hỏi </h2>
                        <?php foreach($posts as $post) :?>
                            <div class="col-sm-6" style="margin-bottom: 30px;">
                                <div class="item-post" style="border: 1px solid #f2f2f2">
                                    <div class="col-sm-5">
                                        <a href="chi-tiet.php?id=<?= $post['id'] ?>&&slug=<?= $post['p_slug'] ?>">
                                            <img src="/public/uploads/posts/<?= $post['p_thunbar'] ?>" style="height:120px;margin-top: 15px;" class=" img img-responsive" alt="">
                                        </a>
                                    </div>
                                    <div class="col-sm-7">
                                        <h2 style="font-size: 20px;">
                                            <a href="chi-tiet.php?id=<?= $post['id'] ?>&&slug=<?= $post['p_slug'] ?>" style="display: block;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;font-size: 20px;padding-top: 10px;"><?= $post['p_title'] ?></a>
                                        </h2>
                                        <p style="font-size: 14px;"><?= mb_substr($post['p_descriptions'],0,120) ?>...</p>
                                        <p><i class="fa fa-user"></i>TrungPhuNa | <i class="fa fa-times-o"></i>  19:20:20s</p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div>
                    <?= Pagination::getListpage($filter) ?>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="row">
                    <h2 style="padding-bottom: 10px;border-bottom: 1px solid #dedede;margin: 19px;"> Các bài viết mới nhất</h2>
                    <?php for($i = 1 ; $i <= 6; $i++) :?>
                        <div class="col-sm-5">
                            <a href="chi-tiet.php">
                                <img src="/public/post1.jpg" style="height:120px;margin-top: 15px;" class=" img img-responsive" alt="">
                            </a>
                        </div>
                        <div class="col-sm-7">
                            <h2 style="font-size: 20px;">
                                <a href="chi-tiet.php" style="display: block;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;font-size: 20px;padding-top: 10px;">Cách khắc phục lỗi màn hình máy tính bị đen trên Windows 10</a>
                            </h2>
                            <p style="font-size: 14px;">Sự cố màn hình bị đen trên máy tính tuy không thường gặp nhưng là một trong những sự</p>
                            <p><i class="fa fa-user"></i>TrungPhuNa | <i class="fa fa-times-o"></i>  19:20:20s</p>
                        </div>
                        <div class="clearfix"></div>
                    <?php endfor ; ?>
                </div>
            </div>
        </div>
    </div>


<?php require_once __DIR__.'/../layouts/inc_footer.php'; ?>