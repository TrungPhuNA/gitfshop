<?php
@session_start();
// goi file Function
require_once __DIR__ .'/../vendor/init.php';

// goi file Config
require_once __DIR__ .'/../config.php';

// check login admin 
if ( ! isset($_SESSION['admin_name']))
{
	header("Location: ".baseServerName().'/authenticate/login.php');exit();
}