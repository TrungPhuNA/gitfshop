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
define("PASS","root");
define("DATABASE","da_basephp");


// Config thông tin website

define("INFO_NAME","Trần Thị Pha");
define("INFO_CLASS","151A0101");
define("INFO_ADDRESS","1114/2/13 quốc lộ 1A khu phố 2 phường tân tạo A quận Bình tân tp hcm");
define("INFO_PHONE","0969041520");
define("INFO_EMAIL","tranthipha2510@gmail.com");


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
