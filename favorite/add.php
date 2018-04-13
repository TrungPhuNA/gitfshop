<?php

    require_once __DIR__. '/../autoload.php';

    // B1 =. Lay id cua sp can them vao gio hang

    if( isset($_GET['idProduct']))
    {
        $id = $_GET['idProduct'];
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