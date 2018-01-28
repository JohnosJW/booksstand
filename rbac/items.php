<?php
return [
    'viewBook' => [
        'type' => 2,
        'description' => 'View a Book',
    ],
    'create' => [
        'type' => 2,
        'description' => 'Create',
    ],
    'update' => [
        'type' => 2,
        'description' => 'Update',
    ],
    'delete' => [
        'type' => 2,
        'description' => 'Delete',
    ],
    'subscription' => [
        'type' => 2,
        'description' => 'Subscription',
    ],
    'report' => [
        'type' => 2,
        'description' => 'Report',
    ],
    'guest' => [
        'type' => 1,
        'children' => [
            'viewBook',
            'subscription',
        ],
    ],
    'user' => [
        'type' => 1,
        'children' => [
            'viewBook',
            'create',
            'update',
            'delete',
            'report',
        ],
    ],
];
