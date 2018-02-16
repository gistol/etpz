<?php 

return [
    1 => [
        "id" => 1,
        "name" => "product view",
        "pattern" => "/\\/products\\/([0-9]+)/",
        "reverse" => "/products/%item_id",
        "module" => NULL,
        "controller" => "etpz",
        "action" => "product",
        "variables" => "item_id",
        "defaults" => "",
        "siteId" => [

        ],
        "priority" => 0,
        "creationDate" => 1518617594,
        "modificationDate" => 1518617715
    ],
    2 => [
        "id" => 2,
        "name" => "Import product",
        "pattern" => "/\\/import/",
        "reverse" => "/import",
        "module" => NULL,
        "controller" => "etpz",
        "action" => "importproducts",
        "variables" => NULL,
        "defaults" => NULL,
        "siteId" => [

        ],
        "priority" => 0,
        "creationDate" => 1518617715,
        "modificationDate" => 1518618269
    ],
    3 => [
        "id" => 3,
        "name" => "Export product",
        "pattern" => "/\\/export/",
        "reverse" => "/export",
        "module" => "",
        "controller" => "etpz",
        "action" => "exportproducts",
        "variables" => NULL,
        "defaults" => NULL,
        "siteId" => [

        ],
        "priority" => 0,
        "creationDate" => 1518617723,
        "modificationDate" => 1518618272
    ],
    4 => [
        "id" => 4,
        "name" => "Brand view",
        "pattern" => "/\\/brands\\/([a-z]+)/",
        "reverse" => "/brands/%brand_name",
        "module" => "",
        "controller" => "etpz",
        "action" => "brandview",
        "variables" => "brand_name",
        "defaults" => NULL,
        "siteId" => [

        ],
        "priority" => 0,
        "creationDate" => 1518637370,
        "modificationDate" => 1518637444
    ],
    5 => [
        "id" => 5,
        "name" => "Category view",
        "pattern" => "/\\/statistics\\/([\\w_\\/-]+)/",
        "reverse" => "/statistics/%category",
        "module" => NULL,
        "controller" => "etpz",
        "action" => "statisticscategory",
        "variables" => "category",
        "defaults" => "",
        "siteId" => [

        ],
        "priority" => 0,
        "creationDate" => 1518680157,
        "modificationDate" => 1518680276
    ]
];
