<?php
    require_once __DIR__. '/autoload.php';
    $sql = "SELECT * FROM posts WHERE 1 ORDER BY ID DESC ";
    $posts = Pagination::pagination('posts',$sql,'page',8);
    $filter = [];

    // Bài viết mới 
    $sqlPostHot = "SELECT * FROM posts WHERE 1  ORDER BY ID DESC LIMIT 5";
    $postHot = DB::fetchsql($sqlPostHot);

?>
<!DOCTYPE html>
    <html>
    <head>
        <title> Danh sách chi tiết </title>
        <meta charset="utf-8">
        <?php require_once __DIR__.'/layouts/inc_head.php'; ?>
        <style>
            .box-menu .active a{ color:red !important }
        </style>
    </head>
<body>
<div id="wrapper">
    <!---->
    <!--HEADER-->
<?php require_once __DIR__.'/layouts/inc_header.php'; ?>
    <!--END HEADER-->


    <!--MENUNAV-->
<?php require_once __DIR__.'/layouts/inc_menu.php' ;?>
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
                                        <a href="/tin-tuc/<?= $post['p_slug'] ?>-<?= $post['id'] ?>.html">
                                            <img src="/public/uploads/posts/<?= $post['p_thunbar'] ?>" style="height:120px;margin-top: 15px;" class=" img img-responsive" alt="">
                                        </a>
                                    </div>
                                    <div class="col-sm-7">
                                        <h2 style="font-size: 20px;">
                                            <a href="chi-tiet.php?id=<?= $post['id'] ?>&&slug=<?= $post['p_slug'] ?>" style="display: block;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;font-size: 20px;padding-top: 10px;"><?= $post['p_title'] ?></a>
                                        </h2>
                                        <p style="font-size: 14px;"><?= mb_substr($post['p_descriptions'],0,120) ?>...</p>
                                        <p><i class="fa fa-user"></i> Admin | <i class="fa fa-times-o"></i> <?= $post['created_at'] ?></p>
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
                    <?php foreach($postHot as $pt) :?>
                        <div class="col-sm-5">
                            <a href="chi-tiet.php?id=<?= $pt['id'] ?>&&slug=<?= $pt['p_slug'] ?>">
                                <img src="/public/uploads/posts/<?= $pt['p_thunbar'] ?>" style="height:120px;margin-top: 15px;" class=" img img-responsive" alt="">
                            </a>
                        </div>
                        <div class="col-sm-7">
                            <h2 style="font-size: 20px;">
                                <a href="chi-tiet.php?id=<?= $pt['id'] ?>&&slug=<?= $pt['p_slug'] ?>" style="display: block;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;font-size: 20px;padding-top: 10px;"><?= $pt['p_title'] ?></a>
                            </h2>
                            <p style="font-size: 14px;"><?= mb_substr($post['p_descriptions'],0,120) ?>...</p>
                            <p><i class="fa fa-user"></i> Admin | <i class="fa fa-times-o"></i>   <?= $pt['created_at'] ?></p>
                        </div>
                        <div class="clearfix"></div>
                    <?php endforeach ; ?>
                </div>
            </div>
        </div>
    </div>


<?php require_once __DIR__.'/layouts/inc_footer.php'; ?>