<?php
// duong dan toi module trong admin
define("MODULES", $_SERVER['DOCUMENT_ROOT'] ."/admin/modules/");

// duong dan toi  layouts
define("MAIN", $_SERVER['DOCUMENT_ROOT'] ."/admin/layouts/main/");

// duong dan upload
define("UPLOADS", $_SERVER['DOCUMENT_ROOT'] ."/public/uploads/");


// config database
define("LOCALHOST","localhost");
define("USER","root");
define("PASS","UGgy6G2VBabLLJ");
define("DATABASE","doantotnghiep_giftshop");

//define("PASS","root");
//define("DATABASE","doantotnghiep_webmaytinh");



// Config thông tin website

define("INFO_NAME","Nguyễn Văn A");
define("INFO_CLASS","TTKK57");
define("INFO_ADDRESS","Tân Triều - Thanh Xuân - Hà Nội");
define("INFO_PHONE","0986.420.994");
define("INFO_EMAIL","phupt.humg.94@@gmail.com");


$arrayPrice = [
    '1-3' => [
        '1000000',
        '3000000'
    ],
    '3-5' =>[
        '3000000',
        '5000000'
    ],
    '5-7' =>[
        '5000000',
        '7000000'
    ],
    '7-10' => [
        '7000000',
        '10000000'
    ],
    '10-15' => [
        '10000000',
        '15000000'
    ],
    '15-20' => [
        '15000000',
        '20000000'
    ]
];
