<?php
require_once __DIR__. '/../autoload.php';

// B1 =. Lay id cua sp can them vao gio hang
if( isset($_GET['idProduct']))
{
    $id = $_GET['idProduct'];
}


// B2
// Ktra xem da ton tai session['cart']

if(isset($_SESSION['hear']))
{
    /// da ton tai
    if(isset($_SESSION['hear'][$id]))
    {
        unset($_SESSION['hear'][$id]);
        echo 1;die;
    }
    echo 0;die;
}
echo 0;die;

