<div id="header">
                <div id="header-top">
                    <div class="container">
                        <div class="row clearfix">
                            <div class="col-md-6" id="header-text">
                                <a>Chu Văn Thắng</a><b> Đồ án tốt nghiệp - Lớp Tin Trắc Địa K58</b>
                            </div>
                            <div class="col-md-6">
                                <nav id="header-nav-top">
                                    <ul class="list-inline pull-right" id="headermenu">
                                        <?php if(! isset($_SESSION['username'])) :?>
                                            <li>
                                                <a href="/account/dang-ky.php"><i class="fa fa-sign-in"></i> Đăng ký </a>
                                            </li>
                                            <li>
                                                <a href="/account/dang-nhap.php"><i class="fa fa-lock"></i> Đăng Nhập </a>
                                            </li>
                                            <li>
                                                <a href="/favorite/index.php"><i class="fa fa-head"></i>Sản phẩm yêu thích</a>
                                            </li>
                                        <?php else : ?>
                                        <li>
                                            <a href=""><i class="fa fa-user"></i> <?= $_SESSION['username'] ?> <i class="fa fa-caret-down"></i></a>
                                            <ul id="header-submenu">
                                                <li><a href=""> Trang cá nhân </a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="fa fa-head"></a> Sản phẩm yêu thích
                                        </li>
                                        <li>
                                            <a href="/account/thoat.php"><i class="fa fa-share-square-o"></i> Thoát </a>
                                        </li>
                                        <?php endif ;?>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row" id="header-main">
                        <style type="text/css">
                            #suggesstion-box {
                                position: absolute;
                                z-index: 9999999;
                                background: white;
                                border: 1px solid #dedede;
                                width: 71.7%;
                                border-top: 0;
                                height: 400px;
                                overflow-y: auto;
                                display: none;
                            }
                            #suggesstion-box li { padding: 5px 10px ;border-bottom: 1px solid #dedede }
                        </style>
                        <script type="text/javascript">
                            $(document).ready(function(){

                                $("#header-search").keyup(function(){
                                    $.ajax({
                                    type: "get",
                                    url: "/pages/tim-kiem.php",
                                    data:'keyword='+$(this).val(),
                                    beforeSend: function(){
                                        $("#header-search").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
                                    },
                                    success: function(data){
                                        $("#suggesstion-box").show();
                                        $("#suggesstion-box").html('').append(data);
                                        $("#header-search").css("background","#FFF");
                                    }
                                    });
                                });
                                $('#header-search').blur(function(){
//                                    $("#suggesstion-box").css("display","none");
                                })
                            });
                            //To select country name
                            function selectCountry(val) {
                                $("#header-search").val(val);
                                $("#suggesstion-box").hide();
                            }
                        </script>
                        <div class="col-md-5">
                            <form class="form-inline" id="formtim">
                                <div class="form-group">
                                    <label>
                                        <select name="category" class="form-control">
                                            <option> Tên sản phẩm </option>
                                        </select>
                                    </label>
                                    <input type="text" name="keywork" id="header-search" placeholder=" input keywork" class="form-control">
<!--                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>-->
                                </div>
                            </form>
                        
                            <div id="suggesstion-box"></div>
                        </div>
                        <div class="col-md-4">
                            <a href="">
                                <img src="/public/frontend/images/logo-default.png">
                            </a>
                        </div>
                        <div class="col-md-3" id="header-right">
                            <div class="pull-right">
                                <div class="pull-left">
                                    <i class="glyphicon glyphicon-phone-alt"></i>
                                </div>
                                <div class="pull-right">
                                    <p id="hotline">HOTLINE</p>
                                    <p>0986420994</p>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>