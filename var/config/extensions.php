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
        ],
        "SimpleFormsBundle\\SimpleFormsBundle" => TRUE,
        "CustomerManagementFrameworkBundle\\PimcoreCustomerManagementFrameworkBundle" => TRUE,
        "Pimcore\\Bundle\\NumberSequenceGeneratorBundle\\NumberSequenceGeneratorBundle" => TRUE,
        "Pimcore\\Bundle\\ObjectMergerBundle\\ObjectMergerBundle" => TRUE
    ],
    "areabrick" => [

    ]
];
