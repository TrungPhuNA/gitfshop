<?php

    /**
     * gọi file autoload
     */
    require_once __DIR__. '/autoload.php';
    

    $sql = "SELECT * FROM products WHERE 1";

    $keyword = '';
    if(isset($_GET['keyword']) && $_GET['keyword'] != NULL)
    {
        $keyword = $_GET['keyword'];
        $sql .= " AND prd_name LIKE  '%$keyword%' ";
    }
    // $sql .= " LIMIT 5";
    $kqtk =  DB::fetchsql($sql);
    
?>  



<?php if(isset($kqtk)  && count($kqtk) > 0):?>
     <ul id="retunrsearch">
        <?php foreach($kqtk as $item) :?>
            <li class="item-product-search">
                <a href="chi-tiet-san-pham.php?id=<?= $item['id'] ?>" >
                    <img src="/public/uploads/products/<?php echo $item['prd_thunbar'] ?>" alt="" class="pull-left" width="50px" height="50px">
                    <div class="pull-right" style="width: 75%">
                        <a href="chi-tiet-san-pham.php?id=<?= $item['id'] ?>" title=""><?php echo ColorFind($keyword,$item["prd_name"]); ?></a><br>
                         <?php if($item['prd_sale']) :?>
                            Cũ :<b class="sale"><?= formatPrice($item['prd_price']) ?> đ</b> <br>
                            Mới :<b class="price"><?= formatPrice($item['prd_price'],$item['prd_sale']) ?>đ</b><br>
                        <?php else :?>
                            Giá : <b class="price"><?= formatPrice($item['prd_price']) ?> đ</b><br>
                        <?php endif ;?>
                        <span class="view"><i class="fa fa-eye"></i> <?= $item['prd_view'] ?> : <i class="fa fa-heart-o"></i>  <?= $item['prd_hear'] ?></span>
                    </div>
                    <div class="clearfix"></div>
                </a>
            </li>
        <?php endforeach ; ?>
    </ul>
<?php else : ?>
    <ul id="retunrsearch">
        <li style="color:red;padding: 10px 3px;"> Không có kết quả tìm kiếm </li>
    </ul>
<?php endif ; ?>


