<?php
/**
 * gọi file autoload
 */

require_once __DIR__ .'/../../autoload.php';

/**
 *  lấy id url
 */
$id = (int)Input::get('id');

/**
 * lấy id cần  sửa
 * kiểm tra xem có tồn tại trong csdl không
 */

$product = DB::fetchOne('products',' id = '.$id);


?>
<tr class='item_product_content' style="background: white">
    <td colspan="6" style="padding: 20px">
        <h4>CHI TIẾT SẢN PHẨM </h4>
        <div style="overflow: hidden;width: 100%;height: 100%">
            <?= $product['prd_content'] ?>
        </div>

    </td>
</tr>
