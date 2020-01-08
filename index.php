<?php
    require "layouts/inc_header.php";
?>
<main>
    <!--- First Slider -->
    <div class="container-fluid p-0">
        <div class="site-slider">
            <div class="slider-one">
                <div>
                    <img src="<?= baseServerName() ?>public/frontend/assets/item-1.jpg" class="img-fluid"
                         alt="Banner 1"/>
                </div>
                <div>
                    <img src="<?= baseServerName() ?>public/frontend/assets/item-2.jpg" class="img-fluid"
                         alt="Banner 2"/>
                </div>
                <div>
                    <img src="<?= baseServerName() ?>public/frontend/assets/item-3.jpg" class="img-fluid"
                         alt="Banner 3"/>
                </div>
            </div>
            <div class="slider-btn">
                <span class="prev position-top"><i class="fas fa-chevron-left"></i></span>
                <span class="next position-top right-0"><i class="fas fa-chevron-right"></i></span>
            </div>
        </div>
    </div>
    <!--- /First Slider -->

    <!-- New, Best and Features sellers -->
	<?php if (!empty($datasHome)) : ?>
        <div class="container text-center">
            <div class="features">
                <h1>Sản phẩm chứa danh mục nổi bật</h1>
                <p class="text-secondary">Danh sách sản phẩm thuộc danh mục nổi bật</p>
            </div>
        </div>
        <div class="container">
            <div class="newseller" style="margin-top: 10px !important;">
                <div class="row">
					<?php foreach ($datasHome as $cate => $datas) : ?>
						<?php if (!empty($datas)) : ?>
                            <div class="col-md-4 col-sm-6">
                                <h3 class="text-secondary"><?= $cate ?></h3>
								<?php foreach ($datas as $item) : ?>
                                    <div class="row py-3">
                                        <div class="col-md-3 p-0">
                                            <div class="items border">
                                                <img src="<?= baseServerName() ?>public/uploads/products/<?= $item['prd_thunbar'] ?>"
                                                     alt="Image 1" class="img-fluid">
                                            </div>
                                        </div>
                                        <div class="col-md-9 p-0 py-4 py-md-0">
                                            <div class="px-4">
                                                <h6><?= $item['prd_name'] ?></h6>
                                                <div class="rating pb-2">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star-half-alt"></i>
                                                </div>
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
                                        </div>
                                    </div>
								<?php endforeach; ?>
                            </div>
						<?php endif; ?>
					<?php endforeach; ?>
                </div>
            </div>
        </div>
	<?php endif; ?>
    <!-- /New, Best and Features sellers -->

    <!-- Second Slider -->
    <div class="container-fluid">
        <div class="site-slider-two px-md-4">
            <div class="row slider-two text-center">
                <div class="col-md-2 product pt-md-5 pt-4">
                    <img src="<?= baseServerName() ?>public/frontend/assets/id-9-cat-1.jpg" alt="Product 1"/>
                    <span class="border site-btn btn-span">SOFA & CHAIRS</span>
                </div>
                <div class="col-md-2 product pt-md-5 pt-4">
                    <img src="<?= baseServerName() ?>public/frontend/assets/id-9-cat-2.jpg" alt="Product 2"/>
                    <span class="border site-btn btn-span">FURNITURES & DECOR</span>
                </div>
                <div class="col-md-2 product pt-md-5 pt-4">
                    <img src="<?= baseServerName() ?>public/frontend/assets/id-9-cat-3.jpg" alt="Product 3"/>
                    <span class="border site-btn btn-span">LAMP & LIGHTING</span>
                </div>
                <div class="col-md-2 product pt-md-5 pt-4">
                    <img src="<?= baseServerName() ?>public/frontend/assets/id-9-cat-4.jpg" alt="Product 4"/>
                    <span class="border site-btn btn-span">SOUND & LIFE</span>
                </div>
                <div class="col-md-2 product pt-md-5 pt-4">
                    <img src="<?= baseServerName() ?>public/frontend/assets/id-9-cat-5.jpg" alt="Product 5"/>
                    <span class="border site-btn btn-span">APPLIANCES</span>
                </div>
                <div class="col-md-2 product pt-md-5 pt-4">
                    <img src="<?= baseServerName() ?>public/frontend/assets/id-9-cat-3.jpg" alt="Product 3"/>
                    <span class="border site-btn btn-span">LAMP & LIGHTING</span>
                </div>
            </div>
            <div class="slider-btn">
                    <span class="prev position-top"><i class="fas fa-chevron-left fa-2x text-secondary"></i
                        ></span>
                <span class="next position-top right-0"><i class="fas fa-chevron-right fa-2x text-secondary"></i
                    ></span>
            </div>
        </div>
    </div>

    <!-- /Second Slider -->

    <hr class="hr"/>

    <!-- Features Section -->

    <div class="container text-center">
        <div class="features">
            <h1>Sản phẩm nổi bật</h1>
            <p class="text-secondary">Danh sách sản phẩm nổi bật được chúng tôi đề xuất cho bạn</p>
        </div>
    </div>
    <?php if (!empty($productHot)) :?>
    <!-- /Features Section -->
    <div class="container-fluid">
        <div class="site-slider-four px-md-4" style="margin-top: 0">
            <div class="slider-four row text-center">
                <?php foreach($productHot as $item) :?>
                <div class="col-md-2 product pt-md-5">
                    <img src="<?= baseServerName() ?>public/uploads/products/<?= $item['prd_thunbar'] ?>" class="border img-fluid"
                         alt="<?=  $item['pro_name'] ?>">
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
    <div class="container my-5">
        <div class="row">
            <div class="col-md-8 col-12">
                <img src="<?= baseServerName() ?>public/frontend/assets/id-9-banner-1.jpg" class="img-fluid"
                     alt="Banner 1">
            </div>
            <div class="col-md-4 col-12">
                <img src="<?= baseServerName() ?>public/frontend/assets/id-9-banner-2.jpg" class="img-fluid"
                     alt="Banner 2">
            </div>
        </div>
        <div class="row my-md-3">
            <div class="col-md-4 col-12">
                <img src="<?= baseServerName() ?>public/frontend/assets/id-9-banner-3.jpg" class="img-fluid"
                     alt="Banner 3">
            </div>
            <div class="col-md-8 col-12">
                <img src="<?= baseServerName() ?>public/frontend/assets/id-9-banner-4.jpg" class="img-fluid"
                     alt="Banner 4">
            </div>
        </div>
    </div>

	<?php require "layouts/inc_footer.php"; ?>
