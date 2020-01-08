<?php
    require_once __DIR__. '/autoload.php';
    $id = (int)Input::get('id');
    // lay chi tiet san pham

    $sql_product_detaul = "SELECT products.*, category_products.cpr_name as cateName, producers.name as producersName FROM products LEFT JOIN 
         producers ON producers.id = products.prd_producer_id
         LEFT JOIN  category_products ON category_products.id = products.prd_category_product_id
         WHERE 1 and prd_active = 1
     and  products.id = ".$id;
    $product_defail = DB::fetchsql($sql_product_detaul);
    $product = $product_defail[0];

    // tinh luot view
    if ( !isset($_COOKIE['view_product'.$id]))
    {
        setcookie('view_product'.$id,$id,time() + 30);
        DB::update('products',array('prd_view' => $product['prd_view'] + 1), ' id = '.$id);
    }

    // sản phẩm liên quan
    $sqlProductSuggest = "SELECT products.*,category_products.cpr_name as cateName  FROM products LEFT JOIN 
        category_products ON category_products.id = products.prd_category_product_id
     WHERE 1 AND prd_active = 1 and prd_category_product_id = ". $product['prd_category_product_id'] ."
      ORDER BY ID DESC LIMIT 6";
    $productSuggest = DB::fetchsql($sqlProductSuggest);

?>
<?php
require "layouts/inc_header.php";
?>
<main>
    <!-- detail Section -->
    <div class="container-fluid sofa bg-light">
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="row box">
                    <div class="col-md-2 p-0 pl-md-3 bg-white offset-1 d-flex flex-md-column flex-sm-row"></div>
                    <div class="col-md-8 p-0 bg-white">
                        <div class="text-left">
                            <img src="<?= baseServerName() ?>public/uploads/products/<?= $product['prd_thunbar'] ?>" alt="Sofa" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12 pt-5">
                <h4 class="text-left"><?= $product['prd_name'] ?></h4>
                <p class="text-secondary pr-5 pt-3">
                    <small>
						<?= $product['prd_description'] ?>
                    </small>
                </p>
                <div class="rating lightblue">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <h4 class="pt-2">
					<?php if ($product['prd_sale']) : ?>
                        <small><s class="text-secondary">
								<?= formatPrice($product['prd_sale']) ?>
                            </s></small>
                        <span class="text-color"><?= formatPrice($product['prd_price'], $product['prd_sale']) ?></span>
					<?php else : ?>
                        <span class="text-color"><?= formatPrice($product['prd_price']) ?></span>
					<?php endif; ?>
                </h4>
                <div class="cart mt-4 row">
                    <div class="col-md-4 col-sm-12 p-0">
                        <button class="border site-btn btn-span bg-primary-color text-white">Add to Cart</button>
                    </div>
                    <div class="col-md-5 col-sm-12 p-0 mt-3">
                        <span class="p-3 bg-white border rounded-circle"><i class="far fa-heart"></i></span>
                        <span class="p-3 bg-white border rounded-circle"><i class="fas fa-sync-alt"></i></span>
                        <span class="p-3 bg-white border rounded-circle"><i class="fas fa-search"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- /detail Section -->

    <hr class="hr" />

    <!-- Features Section -->

    <div class="container text-center">
        <div class="features">
            <h1>Sản phẩm liên quan</h1>
            <p class="text-secondary">
                Danh sách sản phẩm liên quan được lấy theo danh mục
            </p>
        </div>
    </div>
    <?php if (!empty($productSuggest)) :?>
    <!-- Features third Slider -->
    <div class="container-fluid">
        <div class="site-slider-three px-md-4">
            <div class="slider-three row text-center px-4">
                <?php foreach ($productSuggest as $item) :?>
                <div class="col-md-2 product pt-md-5">
                    <img src="<?= baseServerName() ?>public/uploads/products/<?= $item['prd_thunbar'] ?>" class="img-fluid" alt="Image 1" />
                    <div class="cart-details">
                        <h6 class="pro-title p-0"><?= $item['prd_name'] ?></h6>
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <div class="pro-price py-2">
                            <h5>
								<?php if ($item['prd_sale']) : ?>
                                    <small><s class="text-secondary">
											<?= formatPrice($item['prd_sale']) ?>
                                        </s></small>
                                    <span class="text-color"><?= formatPrice($item['prd_price'], $item['prd_sale']) ?></span>
								<?php else : ?>
                                    <span class="text-color"><?= formatPrice($item['prd_price']) ?></span>
								<?php endif; ?>
                            </h5>
                        </div>
                        <div class="cart mt-4">
                            <button class="border site-btn btn-span">Add to Cart</button>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="slider-btn">
                    <span class="prev position-top"><i class="fas fa-chevron-left fa-2x text-secondary"></i
                        ></span>
                <span class="next position-top right-0"><i class="fas fa-chevron-right fa-2x text-secondary"></i
                    ></span>
            </div>
        </div>
    </div>
	<?php endif ;?>

    <div class="container">
        <div class="row">
            <h2>So sánh sản phẩm cùng danh mục</h2>
            <table class="table table-hover">
                <thead>
                <tr>
                    <td>Hình ảnh</td>
                    <td>Giá</td>
                    <td>Phân Loại</td>
                    <td>Hãng sản xuất</td>
                    <td>Sale</td>
                    <td>Mô tả</td>
                </tr>

                </thead>
                <tbody>
                    <?php foreach ($productSuggest as $item) :?>
                        <tr>
                            <td>
                                <img style="width: 100px;height: 80px;" src="<?= baseServerName() ?>public/uploads/products/<?= $item['prd_thunbar'] ?>" class="img-fluid" alt="Image 1" />
                            </td>
                            <td><?= formatPrice($item['prd_price']) ?></td>
                            <td><a href="javascript:;void(0)" class="label label-success"><?= $item['cateName'] ?></a></td>
                            <td><a href="javascript:;void(0)" class="label label-success"><?= $item['producersName'] ?></a></td>
                            <td><b><?= $item['prd_sale'] ?> %</b></td>
                            <td><p><?= $item['prd_description'] ?></p></td>
                        </tr>
	                <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
<main>
<?php require "layouts/inc_footer.php"; ?>