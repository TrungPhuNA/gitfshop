<?php
    require_once __DIR__ .'/../../autoload.php';
    $id = Input::get('id');
    $sql = " SELECT orders.*  , products.prd_name as name ,products.prd_thunbar as hinhanh FROM  orders 
        LEFT JOIN products ON products.id = orders.od_product_id
        WHERE 1 AND od_transaction_id = $id 
    ";
    $orders = DB::fetchsql($sql);
    if( ! $orders )
    {
       echo 0 ;die;
    }
?>

<?php foreach ($orders as $key => $item) :?>
    <tr class="delete_tr">
        <td><?= $item['id'] ?></td>
        <td> <?= $item['name'] ?></td>
        <td>
            <img src="/public/uploads/products/<?= $item['hinhanh'] ?>" alt="" style="width: 50px;height: 50px;">
        </td>
        <td>
            <?= formatPrice($item['od_price']) ?>
        </td>
        <td><?= $item['od_qty'] ?></td>
        <td> <?= formatPrice($item['od_price'] * $item['od_qty']) ?> đ</td>
        <td><a href="javascript:void(0)" class="delete_item_order btn btn-xs btn-danger" data-id_order=<?= $item['id'] ?>> Huỷ sản phẩm </a></td>
    </tr>
<?php endforeach; ?>