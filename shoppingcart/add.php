<?php 
	require_once __DIR__. '/../autoload.php';
	
	// B1 =. Lay id cua sp can them vao gio hang
    $qty = 1;
    if( isset($_GET['qty']))
    {
        $qty = $_GET['qty'];
    }

    if( isset($_GET['idProduct']))
    {
        $id = $_GET['idProduct'];
    }

    // kiem tra xem số lượng sản phẩm mua
    // có lớn hơn số lượng sản phẩm trong giỏ hàng không
    // nếu lơn hơn thì thông báo 
    // bé hơn thì tiếp tục mua hàng
    $product = DB::fetchOne("products",(int)$id);

    if( $product['prd_number'] < $qty )
    {
        echo 0;die;
    }
	// B2 
    // Ktra xem da ton tai session['cart'] 

    if(isset($_SESSION['cart']))
    {
        /// da ton tai 
        if(isset($_SESSION['cart'][$id]))
        {
            $_SESSION['cart'][$id]['qty'] += $qty;
        }
        else 
        {
            $_SESSION['cart'][$id]['qty'] = $qty;
        }
        
        $_SESSION['cart'][$id]['name'] = $product['prd_name'];
        $_SESSION['cart'][$id]['img']   = $product['prd_thunbar'];
        $_SESSION['cart'][$id]['price'] = money($product['prd_price'],$product['prd_sale']);
        echo 1;die;
    }
    else 
    {
    
        $_SESSION['cart'][$id]['qty']   = 1;
        $_SESSION['cart'][$id]['name']  = $product['prd_name'];
        $_SESSION['cart'][$id]['img']   = $product['prd_thunbar'];
        $_SESSION['cart'][$id]['price'] = money($product['prd_price'],$product['prd_sale']);
        echo 1;die;
    }

	