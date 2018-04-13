<?php
    session_start();
    @ob_start();
    // goi file Function
    require_once __DIR__ .'/vendor/init.php';

    // goi file Config
    require_once __DIR__ .'/config.php';

    // lay danh muc san pham
    $categorys = DB::query("category_products","*"," AND cpr_active = 1  ORDER BY ID DESC  ");
    $categoHot = DB::query("category_products","*"," AND cpr_active = 1  and cpr_hot = 1 ORDER BY ID DESC LIMIT 5 ");

    // danh sách sản  sản phẩm mới 
    $sqlProductNew = "SELECT * FROM products WHERE 1 AND prd_active = 1 ORDER BY ID DESC LIMIT 6";
    $productNew = DB::fetchsql($sqlProductNew);

    // san pham noi bat 
    $sqlProductHot = "SELECT * FROM products WHERE 1 AND prd_active = 1 and prd_hot = 1  ORDER BY ID DESC LIMIT 6";
    $productHot = DB::fetchsql($sqlProductHot);

    // sản phẩm có danh mục hot 
?>