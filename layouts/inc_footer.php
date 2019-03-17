<div class="container-pluid">
                <section id="footer">
                    <div class="container">
                        <div class="col-md-3" id="shareicon">
                            <ul>
                                <li>
                                    <a href=""><i class="fa fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a href=""><i class="fa fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href=""><i class="fa fa-google-plus"></i></a>
                                </li>
                                <li>
                                    <a href=""><i class="fa fa-youtube"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-8" id="title-block">
                            <div class="pull-left">
                                
                            </div>
                            <div class="pull-right">
                                
                            </div>
                        </div>
                       
                    </div>
                </section>
                <section id="footer-button">
                    <div class="container-pluid">
                        <div class="container">
                            <div class="col-md-3" id="ft-about">
                                <p> Tên tôi là ABC.</p>
                            </div>
                            <div class="col-md-3 box-footer" >
                                <h3 class="tittle-footer"> Danh mục sản phẩm </h3>
                                <ul>
                                    <?php foreach($categoHot as $item) :?>
                                        <li>
                                            <i class="fa fa-angle-double-right"></i>
                                            <a href="/danh-muc-san-pham.php?id=<?= $item['id'] ?>"><i></i> <?= $item['cpr_name'] ?></a>
                                        </li>
                                    <?php endforeach ; ?>
                                </ul>
                            </div>
                            <div class="col-md-3 box-footer">
                                <h3 class="tittle-footer"> Thông tin </h3>
                               <ul>
                                    <li>
                                        <i class="fa fa-angle-double-right"></i>
                                        <a href="/gioi-thieu.php"><i></i> Giới thiệu</a>
                                    </li>
                                    <li>
                                        <i class="fa fa-angle-double-right"></i>
                                        <a href=""><i></i> Liên hệ </a>
                                    </li>
                                    <!-- <li>
                                        <i class="fa fa-angle-double-right"></i>
                                        <a href=""><i></i>  Contact </a>
                                    </li>
                                    <li>
                                        <i class="fa fa-angle-double-right"></i>
                                        <a href=""><i></i> My Account</a>
                                    </li> -->
                                </ul>
                            </div>
                            <div class="col-md-3" id="footer-support">
                                <h3 class="tittle-footer"> Liên hệ</h3>
                                <ul>
                                    <li>
                                        <p><i class="fa fa-home" style="font-size: 16px;padding-right: 5px;"></i> 378 Quang Trung Hà Đông - Hà Nội</p>
                                        <p><i class="sp-ic fa fa-mobile" style="font-size: 22px;padding-right: 5px;"></i> 12121</p>
                                        <p><i class="sp-ic fa fa-envelope" style="font-size: 13px;padding-right: 5px;"></i>12121@gmail.com</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="ft-bottom">
                    <p class="text-center">Đồ án tốt nghiệp 2019 ...!!! </p>
                </section>
            </div>
        </div>      
    </div>
            </div>      
        </div>

        <div class="qc__left" style="position: fixed;left: 40px; top: 30%;">
            <a href=""><img src="/public/images/banner1.png"></a>
        </div>
        <div class="qc__right" style="position: fixed;right: 40px; top: 30%;">
            <a href=""><img src="/public/images/banner1.png"></a>
        </div>
    <script  src="/public/frontend/js/slick.min.js"></script>
    <script  src="/public/frontend/js/app.js"></script>
    <script  src="/public/app/js/notify.js"></script>
    </body>
    <!-- <style type="text/css">
        #left_ads_float{bottom:24px;left: 10px;position:fixed;top: 200px; }
        #right_ads_float{bottom:24px;right: 10px;position:fixed;top: 200px;}
    </style>
    <div id='left_ads_float' class="fix-ads">
        <div>
            <a href='' target='_blank'><img border='0' height='500px' src='/public/images/fptarena1.png' width='100px'/></a>
        </div>
    </div>
    <div id='right_ads_float' class="fix-ads">
        <div>
            <a href='' target='_blank'><img border='0' height='500px;' src='/public/images/fptarena1.png'' width='100px'/></a>
        </div>
    </div> -->
        
</html>

<script type="text/javascript">
    $(function() {
        $hidenitem = $(".hidenitem");
        $itemproduct = $(".item-product");
        $itemproduct.hover(function(){
            $(this).children(".hidenitem").show(100);
        },function(){
            $hidenitem.hide(500);
        })
    })
</script>
<?php
    if( isset($_SESSION['success']))
    {
        $string = $_SESSION['success'];
        unset($_SESSION['success']);
        echo "<script>$.notify('$string','success');</script>";
    }

    if( isset($_SESSION['error']))
    {
        $string = $_SESSION['error'];
        unset($_SESSION['error']);
        echo "<script>$.notify('$string','error');</script>";
    }
?>

<script>
window.onscroll = function() {myFunction()};

    var header = document.getElementById("menunav");
    var sticky = header.offsetTop;

    function myFunction() {
      if (window.pageYOffset >= sticky) {
        header.classList.add("sticky");
        $(".fix-ads").css("top","70px")
      } else {
        header.classList.remove("sticky");
        $(".fix-ads").css("top","200px")
      }
    }
</script>


<script type="text/javascript">
    $(function(){
        
    })
</script>