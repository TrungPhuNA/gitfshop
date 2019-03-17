#MÔ TẢ HỆ THỐNG  CẤU TRÚC ĐỒ ÁN 
* Mình sẽ mô tả lần lượt chức năng của từng thư mục, từng file để bạn hiểu rõ hơn
## Thư mục "account"
    ** Thư mục này dùng để lưu các file đăng ký đăng nhập và đăng xuất dành cho user.
        * dang-ky.ptp : Dùng để đăng ký thành viên 
        * dang-nhap.php : Đăng ký xong thì sẽ đăng nhập .
        * thoat.php : Dùng để đăng xuất khi đã đăng nhập.
## Thư mục "admin"
    ** Toàn bộ nội dung  phần admin hệ thống sẽ được lưu ở trong thư mục này 
        * Phần này mình sẽ mô tả sau.
## Thư mục "authenticate"
    ** THư mục này gồm 2 file
        * login.php : Dùng để login vào hệ thống admin
        * thoat.php : Dùng để đăng xuất hệ thống
## Favorite
    ** THư mục này lưu trữ phần  sản phẩm yêu thích bao gồm
        * add.php thêm mới sản phẩm yêu thích
        * index.php Danh sách sản phẩm yêu thích
        * remote.php Xoá sản phẩm yêu thích
## Thư mục "Icon"
## Thư mục "layouts"
    ** THư  mục này chưa các giao diên có nôi dung gần như cố định và không thay đổi như header , footer sidebar 
        * inc_footer.php : Chứa code của chân trang website
        ![Atom](https://lh4.googleusercontent.com/1XtWrbwyDfTWTOc1vSR6AeMGVmrYm963C2JXyGpY-nw1rkpwyP11zeZmlTJBXP4fQ8GHpQCgcW-2SnR_dc6S=w2880-h1482-rw)
        * inc_head.php Lưu trữ các file link tới css của giao diện 
        * inc_header.php  : Lưu code các mục  như thông tin , link đăng ký , đăng nhập
        * inc_menu.php  : Lưu trữ menu điều hướng
        * inc_left.php Phần này show thông tin như danh mục sản phẩm ,  sản phẩm nổi bật , nhiều view vvv.
## Tất các các file code Frontend 
    ** Thư mục này chưa toàn bộ code của các trang  trong website như trang chủ , giới thiệu , sản phẩm , tin tức , chi tiết tin tức
        * chi-tiet.php Trang này là chi tiết của tin tức
        * chi-tiet-san-pham.php : Chi tiết sản phẩm :D
        * gioi-thieu.php Trang giới thiệu
        * gui-phan-hoi.php Trang gủi phản hồi của hệ thống
        * index.php Là trang chủ của website 
        * lien-he.php Trang cho người dùng nhập liên hệ
        * san-pham.php Show ra các sharn phẩm thuộc danh mục nào 
        * tim-kiem.php Trang tim kiếm, sp tìm kiếm sẽ được đổ về đây
        * tin-tuc.php Trang tin tức 
        
## Thư mục "public"

## Thư mục "shoppingcart"

## Thư mục "user"

## Thư mục "vendor"

## .htaccess
## autoload.php

        