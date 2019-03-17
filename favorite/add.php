<?php

    require_once __DIR__. '/../autoload.php';

    // B1  Lấy id sản phẩm được thêm vào yêu thích 
    $id = 0;
    if( isset($_GET['idProduct']))
    {
        $id = $_GET['idProduct'];
    }

    // kiểm tra tồn tại trong DB

    $product = DB::fetchOne('products',(int)$id);
    if ($product)
    {
        DB::update('products',array('prd_hear' => $product['prd_hear'] + 1),array('id' => $id));
    }

    if(isset($_SESSION['hear']))
    {
        if(isset($_SESSION['hear'][$id]))
        {
            echo 0; die;
        }
        else
        {
            $_SESSION['hear'][$id] = $id;
            echo  1;die;
        }
    }else
    {
        $_SESSION['hear'][$id] = $id;
    }
    echo 1;die;