<?php
	@ob_start();
	session_start();
	if( ! isset($_SESSION['cart']))
	{
		header("Location: http://basephp.dev/");exit();
	}

	$key = isset($_GET['key']) ? (int)$_GET['key'] : '';
	if ( $key )
	{

		if( array_key_exists($key,$_SESSION['cart']))
		{
			unset($_SESSION['cart'][$key]);
			$_SESSION['success'] = ' Xoa Gio Hang Thanh Cong ';
		}
	}
	header("Location: http://basephp.dev/list-cart.php");exit();
?>