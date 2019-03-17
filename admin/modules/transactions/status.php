<?php
    /**
     * gọi file autoload
     */
    
    require_once __DIR__ .'/../../autoload.php';

    /**
     *  lấy id url
     */
    $id = (int)Input::get('id');

    // lay id admin 
    $id_admin = (int)$_SESSION['admin_id'];

    /**
     * lấy id cần  sửa 
     * kiểm tra xem có tồn tại trong csdl không 
     */
    
    $transaction = DB::fetchOne('transactions',$id);

    /**
     * nếu trống thì id không tồn tại
     */

    if ( empty($transaction))
    {
        $_SESSION['error'] = '  Không có dữ liệu trong DB   ';
        header("Location: ".baseServerName().'/admin/modules/transactions');exit();
    }
  
    $time_pay = date('Y-m-d');  
    $status = $transaction['tst_status'] == 1 ? 0 : 1;
    $update = DB::update("transactions",array('tst_status' => $status,'tst_date_payment' => $time_pay,'tst_admin_id' => $id_admin) ,array("id" => $id));

    if ( $update && $update > 0 )
    {
        $orders = DB::query('orders','*',' and od_transaction_id = '. $id);
        if ( $orders )
        {
            foreach ($orders as $key => $item) {
                $product = DB::fetchOne('products',(int)$item['od_product_id']);
                if( $product )
                {
                    $pay    = ($status  == 1) ? $product['prd_pay'] + $item['od_qty'] : $product['prd_pay'] - $item['od_qty'];
                    $number = ($status  == 1) ? $product['prd_number'] - $item['od_qty'] : $product['prd_number'] + $item['od_qty'];
                    $upPay  = DB::update("products",array('prd_pay' => $pay,'prd_number' => $number) ,array("id" => (int)$item['od_product_id']));
                }
            }
        }
        $_SESSION['success'] = ' Cập nhật thành công ';
    }else 
    {
        $_SESSION['error'] = ' Cập nhật thất bại  ';
    }
    
    header("Location: ".baseServerName().'/admin/modules/transactions');exit();
 ?>