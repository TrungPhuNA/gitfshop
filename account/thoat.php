<?php
    require_once __DIR__. '/../autoload.php';
    
    unset($_SESSION['username']);
    $_SESSION['success'] = ' Đăng xuất thành công ! Cảm ơn bạn đã quan tâm tới website ';
    header("Location: ".baseServerName().'/pages');exit();
    
