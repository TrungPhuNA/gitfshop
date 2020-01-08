<?php
require_once __DIR__ . '/autoload.php';
$filter       = [];
$idcate       = (int)Input::get('id');
$filter['id'] = $idcate;
$sql          = "SELECT products.* , category_products.cpr_name FROM products 
        LEFT JOIN category_products ON category_products.id = products.prd_category_product_id
        WHERE 1 ";

if ($idcate) {
    $sql .= "and products.prd_category_product_id = " . $idcate ." ";
}
$idProducer = (int)Input::get('producer');
if ($idProducer) {
	$sql .= "and products.prd_producer_id = " . $idProducer ." ";
}


if (Input::get('price')) {
	$key = Input::get('price');
	if (array_key_exists($key, $arrayPrice)) {

		if (count($arrayPrice[$key]) == 2) {
			$sql .= ' AND prd_price BETWEEN ' . $arrayPrice[$key][0] . ' AND ' . $arrayPrice[$key][1] . ' ';
		} else {
			$sql .= ' AND prd_price > ' . $arrayPrice[$key][0] . ' ';
		}
	} else {
		$sql .= ' AND prd_price <=  1000000';
	}

	$filter['price'] = $key;
}

$products = Pagination::pagination('products', $sql, 'page', 12);
?>

<?php
    require "layouts/inc_header.php";
?>
<?php if (!empty($products)) :?>
    <div class="row">
        <?php foreach($products as $item) :?>
            <div class="col-sm-4 col-lg-4 col-md-4">
                <div class="thumbnail">
                    <img src="<?= baseServerName() ?>public/uploads/products/<?= $item['prd_thunbar'] ?>" alt="">
                    <div class="caption">
                        <h4 class="pull-right"><?= formatPrice($item['prd_price']) ?></h4>
                        <h4><a href="<?= baseServerName() ?>chi-tiet-san-pham.php?id=<?= $item['id'] ?>"><?= $item['prd_name'] ?></a></h4>
                        <p><?= $item['prd_description'] ?></p>
                    </div>
                </div>
            </div>
		<?php endforeach;?>
    </div>
<?php endif ;?>
<?php require "layouts/inc_footer.php"; ?>