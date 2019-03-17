<?php
    require_once __DIR__ .'/../autoload.php';
    $id = (int)Input::get('id');
    try{

        DB::delete('orders',' od_transaction_id = '.$id);

        $iddelete = DB::delete('transactions',$id);
        // 
        ( $iddelete ) ? $_SESSION['success'] = ' Xoá Thành Công ' : $_SESSION['error'] = ' Xoá Thất Bại  ';

        // xoa tiep o chi tiet don hang 

        header("Location: ".baseServerName().'/user/don-hang.php');exit();
    }catch (\Exception $e)
    {
        dd(" Xoá đơn hàng thất bại  " . $e->getMessage());
    }