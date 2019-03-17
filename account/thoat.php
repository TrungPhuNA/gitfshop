<?php
    require_once __DIR__. '/../autoload.php';
    
    unset($_SESSION['username']);
    unset($_SESSION['id_user']);
    unset($_SESSION['img_user']);
   
    $_SESSION['success'] = ' Đăng xuất thành công ! Cảm ơn bạn đã quan tâm tới website ';
    header("Location: ".baseServerName().'/');exit();
    
