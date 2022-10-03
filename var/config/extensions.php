<?php

return [
    "bundle" => [
        "Pimcore\\Bundle\\EcommerceFrameworkBundle\\PimcoreEcommerceFrameworkBundle" => TRUE,
        "FormBuilderBundle\\FormBuilderBundle" => [
            "enabled" => TRUE,
            "priority" => 11,
            "environments" => [

            ]
        ],
        "FrontendPermissionToolkitBundle\\FrontendPermissionToolkitBundle" => [
            "enabled" => TRUE,
            "priority" => 12,
            "environments" => [

            ]
        ]
    ],
    "areabrick" => [

    ]
];
