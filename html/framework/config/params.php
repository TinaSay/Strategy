<?php

return [
    'HTMLPurifier' => [
        'Attr.AllowedFrameTargets' => [
            '_blank',
            '_self',
            '_parent',
            '_top',
        ],
        'HTML.Trusted' => true,
        'Filter.YouTube' => true,
    ],
    'menu' => [
        [
            'label' => 'Content',
            'icon' => 'ti-files',
            'items' => [
                [
                    'label' => 'Content',
                    'url' => ['/content/default'],
                ],
                [
                    'label' => 'Html',
                    'url' => ['/html/html'],
                ],
                [
                    'label' => 'Metatag',
                    'url' => ['/metatag/default'],
                ],
                [
                    'label' => 'News',
                    'url' => ['/news/default'],
                ],
                [
                    'label' => 'Review',
                    'url' => ['/review/default'],
                ],
                [
                    'label' => 'Expert',
                    'url' => ['/expert/expert'],
                ],
            ],
        ],
        [
            'label' => 'Menu',
            'icon' => 'ti-settings',
            'url' => ['/menu/default'],
        ],
    ],
    'dropdown' => [
        [
            'label' => 'Users',
            'icon' => 'ti-user',
            'items' => [
                [
                    'label' => 'Auth',
                    'url' => ['/auth/auth'],
                ],
                [
                    'label' => 'Social network',
                    'url' => ['/auth/social'],
                ],
                [
                    'label' => 'Log',
                    'url' => ['/auth/log'],
                ],
            ],
        ],
        [
            'label' => 'Systemic',
            'icon' => 'ti-settings',
            'items' => [
                [
                    'label' => 'Configure',
                    'url' => ['/configure'],
                ],
                [
                    'label' => 'Clear cache',
                    'url' => ['/system/default/flush-cache'],
                ],
                [
                    'label' => 'Backup',
                    'url' => ['/backup/default'],
                ],
            ],
        ],
    ],
    'imageConfig' => [
        'initial' => [],
        //news
        'list' => ['w' => 365, 'h' => 245, 'fit' => 'fill'],
    ],
];
