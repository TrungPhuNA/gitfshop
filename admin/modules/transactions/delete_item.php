<?php
    require_once __DIR__ .'/../../autoload.php';
    $id = (int)Input::get('id');

    // lay chi tiet don hang 
    $itemOrder = DB::fetchOne('orders',$id);
    if ($itemOrder)
    {
        $price = $itemOrder['od_qty'] * $itemOrder['od_price'];

        $transaction = DB::fetchOne('transactions',(int)$itemOrder['od_transaction_id']); 
    
        DB::update('transactions',array('tst_total' => $transaction['tst_total'] - $price) , array('id' => (int)$itemOrder['od_transaction_id']));
        $iddelete = DB::delete('orders',$id);
        echo 1;die;
    }

    echo 0;die;