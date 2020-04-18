<?php

return [
    'role_structure' => [
        'superadministrator' => [
            'home-menu'=>'r',
                'home' => 'r',
            'acl-menu'=>'r',
                'user' => 'c,r,u,d',
                // 'permission' => 'r',
                // 'role'=>'c,r,u',
        ],
        'administrator' => [
            'home-menu'=>'r',
                'home' => 'r',
            'acl-menu'=>'r',
                'user' => 'c,r,u,d',
                // 'permission' => 'r',
                // 'role'=>'c,r,u',
        ],
        'user' => [
            'home-menu'=>'r',
                'home' => 'r',
        ],
    ],
    'permission_structure' => [
        // 'cru_user' => [
        //     'profile' => 'c,r,u'
        // ],
    ],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
