<?php
    require_once __DIR__. '/../autoload.php';
    $filter = [] ;
    $idcate = Input::get('id');
    $filter['id'] = $idcate;
    $sql = "SELECT products.* , category_products.cpr_name FROM products 
        LEFT JOIN category_products ON category_products.id = products.prd_category_product_id
        WHERE 1 and products.prd_category_product_id = ".$idcate."
    ";
    
    if( Input::get('price'))
    {
        $key = Input::get('price');
        if(array_key_exists($key,$arrayPrice))
        {
            if(count($arrayPrice[$key]) == 2)
            {
                $sql .= ' AND prd_price BETWEEN ' .$arrayPrice[$key][0] . ' AND ' . $arrayPrice[$key][1] . ' ';
            }else 
            {
                $sql .= ' AND prd_price > ' .$arrayPrice[$key][0] . ' ';
            }
        }else 
        {
            $sql .= ' AND prd_price <=  1000000';
        }
        $filter['price'] = $key;
    }
    $products = Pagination::pagination('products',$sql,'page',12);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>  Danh mục sản phẩm </title>
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
                    <div class="col-md-3  fixside" >
                        <?php require_once __DIR__.'/../layouts/inc_left.php' ;?>
                        <div class="box-left box-menu" >
                            <h3 class="box-title"><i class="fa fa-search"></i> Tìm kiếm theo khoảng giá </h3>
                            <ul>
                                <li class="<?= Input::get('price') == '<1' ? 'active' : '' ?>">
                                    <a href="<?= \vendor\Utils\Url::addParams(['price' => '<1']) ?>"> Bé hơn 1tr đồng   </a>
                                </li>
                                <li class="<?= Input::get('price') == '1-3'   ? 'active' : '' ?>"><a href="<?= \vendor\Utils\Url::addParams(['price' => '1-3']) ?>"> 1.000.000đ - 3.000.000đ  </a></li>
                                <li class="<?= Input::get('price') == '3-5'   ? 'active' : '' ?>"><a href="<?= \vendor\Utils\Url::addParams(['price' => '3-5']) ?>"> 3.000.000đ - 5.000.000đ  </a></li>
                                <li class="<?= Input::get('price') == '5-7'   ? 'active' : '' ?>"><a href="<?= \vendor\Utils\Url::addParams(['price' => '5-7']) ?>"> 5.000.000đ - 7.000.000đ  </a></li>
                                <li class="<?= Input::get('price') == '7-10'  ? 'active' : '' ?>"><a href="<?= \vendor\Utils\Url::addParams(['price' => '7-10']) ?>"> 7.000.000đ - 10.000.000đ </a></li>
                                <li class="<?= Input::get('price') == '10-15' ? 'active' : '' ?>"><a href="<?= \vendor\Utils\Url::addParams(['price' => '10-15']) ?>"> 10.000.000đ - 15.000.000đ </a></li>
                                <li class="<?= Input::get('price') == '15-20' ? 'active' : '' ?>"><a href="<?= \vendor\Utils\Url::addParams(['price' => '15-20']) ?>"> 15.000.000đ - 20.000.000đ </a></li>
                                <li class="<?= Input::get('price') == '20'    ? 'active' : '' ?>"><a href="<?= \vendor\Utils\Url::addParams(['price' => '20']) ?>"> Trên 20.000.000 đ </a></li>
                            </ul>
                        </div>
                        </ul>
                    </div>
                    <div class="col-md-9 bor">
                                              
                        
                        <section class="box-main1">
                            <h3 class="title-main" style="text-align: left;"><a href="javascript:void(0)"> Danh mục sản phẩm |  Có  <?= Pagination::getTotalQuery() ?> kết quả được tìm thấy </a> </h3>
                            <div class="showitem clearfix">
                                <?php foreach($products as $item) :?>
                                    <div class="col-md-3 item-product bor clearfix">
                                        <a href="/pages/chi-tiet-san-pham.php?id=<?= $item['id'] ?>">
                                            <img src="/public/uploads/products/<?= $item['prd_thunbar'] ?>" class="" width="100%" height="180">
                                        </a>
                                        <div class="info-item">
                                            <a href="/pages/chi-tiet-san-pham.php?id=<?= $item['id'] ?>"><?= $item['prd_name'] ?></a>
                                            <?php if($item['prd_sale']) :?>
                                                <p><strike class="sale"><?= formatPrice($item['prd_price']) ?> đ</strike> <b class="price"><?= formatPrice($item['prd_price'],$item['prd_sale']) ?>đ</b></p>
                                            <?php else :?>
                                                <p><b class="price"><?= formatPrice($item['prd_price']) ?> đ</b></p>
                                            <?php endif ;?>
                                            
                                        </div>
                                        <div class="hidenitem">
                                            <p><a href="/pages/chi-tiet-san-pham.php?id=<?= $item['id'] ?>"><i class="fa fa-search"></i></a></p>
                                            <p><a href=""><i class="fa fa-heart"></i></a></p>
                                            <p><a href=""><i class="fa fa-shopping-basket"></i></a></p>
                                        </div>
                                    </div>
                                <?php endforeach ; ?>
                            </div>
                            <div>
                                <?= Pagination::getListpage($filter) ?>
                            </div>
                        </section>

                    </div>
                </div>

                
               <?php require_once __DIR__.'/../layouts/inc_footer.php'; ?>