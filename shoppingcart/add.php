<?php 
	session_start();
	require_once __DIR__."/../autoload.php";
	$db = new DB();
	// B1 =. Lay id cua sp can them vao gio hang
	$id = isset($_GET['id']) ? (int)$_GET['id'] : '';

	// select * from  product where id = 232323
	// ket noi csdl 
	//

	$product = $db->fetchOne("products",$id);
	if ($product)
	{
		// B2 
		// Ktra xem da ton tai session['cart'] 

		if(isset($_SESSION['cart']))
		{
			/// da ton tai 
			
			if(isset($_SESSION['cart'][$id]))
			{
				$_SESSION['cart'][$id]['qty'] += 1;
			}
			else 
			{
				$_SESSION['cart'][$id]['qty'] = 1;
			}
			$_SESSION['cart'][$id]['name'] = $product['name'];
			$_SESSION['success'] = ' Tồn tại giỏ hàng ! Cập nhật mới thành công ';
			header("Location: http://basephp.dev/");exit();
		}
		else 
		{
		
			$_SESSION['cart'][$id]['qty'] = 1;
			$_SESSION['cart'][$id]['name'] = $product['name'];
			$_SESSION['success'] = ' Tạo mới giỏ hàng thành công !!! ';
			header("Location: http://basephp.dev/");exit();
		}
	}
	else
	{
		$_SESSION['success'] = ' Không tồn tại sp trong csdl  !!! ';
		header("Location: http://basephp.dev/");exit();
	}
	