var frontend = {

    /**
     *  chu thich
     * - add gio hang 
     *  - class add_to_cart | lay id  data-id-product
     */
    
    configSelecter :{
        base_Url: location.origin, // duong dan url 
    },
    init : function () {
        let _this = this;
        _this.addCart();
        _this.showModalCart();
        _this.updateCart();
        _this.removeItemCart();
        _this.clickItemResultSearch();
        _this.addFavorite() ; // them san pham yeu thich
    },
    addCart()
    {
        let _this = this;
        $(".add_to_cart").click( function () {
            let $idProduct = $(this).attr("data-id-product");
            let $qty = $("#qty").val();
            $.ajax({
                type: "GET",
                url:  _this.configSelecter.base_Url + '/shoppingcart/add.php',
                data: { idProduct : $idProduct,qty : $qty },
                success: function( msg ) {
                    if( msg == 1)
                    {
                        $.notify(' Thêm vào giỏ hàng thành công ','success');
                    }else 
                    {
                        $.notify(' Thêm vào giỏ hàng thất bại ','error'); 
                    }
                },
                error : function () {
                    console.log(" LOI AJAX ");
                }
            });
        })
    },
    showModalCart()
    {
        let _this = this;
        $('.index-cart a, .mobile-cart a').click(function() {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                dataType : 'json',
                url:  '/shoppingcart/list-cart',
                success: function( msg ) {
                    let string = '';
                    $.each(msg.cart , function (index , value ) {
                        string += '<div class="clearfix cart_product productid-14154690">\n' +
                            '    <a class="cart_image" href="" title=""><img src="/uploads/products/'+value.options.thunbar+'" alt=""></a>\n' +
                            '    <div class="cart_info">\n' +
                            '        <div class="cart_name"><a href="/noi-chien-nuong-chan-khong-iruka" title="Nồi chiên nướng chân không">'+value.name+'</a></div>\n' +
                            '        <div class="row-cart-left">\n' +
                            '            <div class="cart_item_name">\n' +
                            '                <label class="cart_size variant-title-popup hidden" style="display: none;">Default Title</label>\n' +
                            '                <div>\n' +
                            '                    <label class="cart_quantity">Số lượng</label>\n' +
                            '                    <div class="cart_select">\n' +
                                '                        <div class="input-group-btn"><input class="variantID" type="hidden" name="variantId" value="14154690"><button onclick="var result = document.getElementById(value.id); var qtyItem14154690 = result.value; if( !isNaN( qtyItem14154690 ) &amp;&amp; qtyItem14154690 > 1 ) result.value--;return false;" class="reduced items-count btn-minus btn btn-default" type="button">–</button><input type="text" maxlength="12" min="0" class="input-text number-sidebar qtyItem14154690" id="'+value.id+'" name="Lines" size="4" value="'+value.qty+'"><button onclick="var result = document.getElementById(value.id); var qtyItem14154690 = result.value; if( !isNaN( qtyItem14154690 )) result.value++;return false;" class="increase items-count btn-plus btn btn-default" type="button">+</button></div>\n' +
                            '                    </div>\n' +
                            '                </div>\n' +
                            '            </div>\n' +
                            '            <div class="text-right cart_prices">\n' +
                            '                <div class="cart__price"><span class="cart__sale-price">'+_this.currency(value.price)+'₫</span></div>\n' +
                            '                <a class="cart__btn-remove remove-item-cart" href="javascript:void(0)" data-id="'+value.rowId+'">Bỏ sản phẩm</a>\n' +
                            '            </div>\n' +
                            '        </div>\n' +
                            '    </div>\n' +
                            '</div>'
                    })
                    $(".total-price").html(msg.total)
                    $(".cart_body").html($(string));
                },
                error : function () {
                    console.log(" LOI AJAX ");
                }
            });
        	$("#cart-sidebars").addClass('active');
        	$(".backdrop__body-backdrop___1rvky").addClass('active');
        });
    },
    removeItemCart()
    {
        let _this = this;
        $(".remove-item-cart").click(function(){
            console.log(location.href);
            $this = $(this);
            $key = $(this).attr('data-id-product');
            $.ajax({
                type: "GET",
                url:  _this.configSelecter.base_Url + '/shoppingcart/remove.php',
                data: { idProduct : $key},
                success: function( msg ) {
                    if( msg == 1)
                    {
                        $this.parents('.delete_tr').remove();
                        $.notify(' Xoá sản phẩm thành công ','success');
                    }else 
                    {
                        $.notify(' Xoá sản phẩm trong giỏ hàng thất bại ','error'); 
                    }
                },
                error : function () {
                    console.log(" LOI AJAX ");
                }
            });
            console.log($key);
        })
    
    },
    updateCart()
    {
        let _this = this;
        $(".update-item-cart").click(function(){
            $this = $(this);
            $key = $(this).attr('data-id-product');
            $qty = $this.parents('.delete_tr').find('#qty').val();
            $.ajax({
                type: "GET",
                url:  _this.configSelecter.base_Url + '/shoppingcart/update.php',
                data: { idProduct : $key , qty : $qty},
                success: function( msg ) {
                    if( msg == 1)
                    {
                        $.notify(' Cập nhật thành công ','success');
                    }else 
                    {
                        $.notify(' Cập nhật qty trong giỏ hàng thất bại ','error'); 
                    }
                },
                error : function () {
                    console.log(" LOI AJAX ");
                }
            })
        });
    },
    clickItemResultSearch()
    {
        $(document).on("click",".item-product-search" , function(){
            console.log("OK");  
        })
        $(".item-product-search").on("click",function(){
            
        })
    },
    currency(nStr)
    {
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + '.' + '$2');
        }
        return x1 + x2;
    },
    addFavorite()
    {
        let _this = this;
        $(".addFavorite").click(function () {

            $id = $(this).attr('data-id');
            $.ajax({
                type: "GET",
                url:  _this.configSelecter.base_Url + '/favorite/add.php',
                data: { idProduct : $id},
                success: function( msg ) {
                    if( msg == 1)
                    {
                        $.notify('  Thêm sản phẩm yêu thích thành công ','success');
                    }else
                    {
                        $.notify(' Sản phẩm đã trong list yêu thích của bạn ','error');
                    }
                },
                error : function () {
                    console.log(" LOI AJAX ");
                }
            })
        })
    }
}

$(function () {
    frontend.init()
})
