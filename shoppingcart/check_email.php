<?php 
	require_once __DIR__. '/../autoload.php';
	
	// B1 = lay email
    if( isset($_GET['email']))
    {
        $email = $_GET['email'];
    }
    
    $emailCheck = DB::fetchOne('users',' email = "'.$email.'"');

    if ($emailCheck )
    {
        echo 0 ;die;
    }
    echo 1 ;die;

	