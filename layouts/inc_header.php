<?php
    include __DIR__ .'/../autoload.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Online Store</title>

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"/>

    <!--  Font Awesome CDN -->
    <script src="https://kit.fontawesome.com/23412c6a8d.js"></script>

    <!-- Slick Slider -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>

    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="<?= baseServerName() ?>public/frontend/css/style.css"/>
</head>

<body>

<!-- header -->
<header>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-12 col-12">
                <div class="btn-group">
                    <button class="btn border dropdown-toggle my-md-4 my-2 text-white" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                        Eng
                    </button>
                    <div class="dropdown-menu">
                        <a href="#" class="dropdown-item">Vn</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-12 text-center">
                <h2 class="my-md-3 site-title text-white">Online Store</h2>
            </div>
            <div class="col-md-4 col-12 text-right">
                <p class="my-md-4 header-links">
                    <a href="#" class="px-2">Sign In</a>
                    <a href="#" class="px-1">Create an Account</a>
                </p>
            </div>
        </div>
    </div>

    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg navbar-light bg-white">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="./">HOME<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown">

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">PRODUCTS</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a href="<?= baseServerName() ?>danh-muc-san-pham.php" class="dropdown-item">View All</a>
                            <?php foreach($categories as $item) :?>
                                <a class="dropdown-item"
                                   href="<?= baseServerName() ?>danh-muc-san-pham.php?id=<?= $item['id'] ?>">
                                    <?= $item['cpr_name'] ?></a>
                            <?php endforeach;?>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">BRANDS</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a href="<?= baseServerName() ?>danh-muc-san-pham.php" class="dropdown-item">View All</a>
							<?php foreach($producers as $item) :?>
                                <a class="dropdown-item"
                                   href="<?= baseServerName() ?>danh-muc-san-pham.php?producer=<?= $item['id'] ?>">
									<?= $item['name'] ?></a>
							<?php endforeach;?>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">ABOUT US</a>
                    </li>
                </ul>
            </div>
            <div class="navbar-nav">
                <li class="nav-item  rounded-circle mx-2 search-icon">
                    <i class="fas fa-search p-2"></i>
                </li>
                <li class="nav-item  rounded-circle mx-2 basket-icon">
                    <i class="fas fa-shopping-basket p-2"></i>
                </li>
            </div>
        </nav>
    </div>
</header>