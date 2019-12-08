<?php

/**
 * Extension Manager/Repository config file for ext "memory_game_theme".
 */
$EM_CONF[$_EXTKEY] = [
    'title' => 'Memory Game Theme',
    'description' => '',
    'category' => 'templates',
    'constraints' => [
        'depends' => [
            'typo3' => '8.7.0-9.5.99',
            'rte_ckeditor' => '8.7.0-9.5.99',
            'bootstrap_package' => '10.0.0-10.0.99'
        ],
        'conflicts' => [
        ],
    ],
    'autoload' => [
        'psr-4' => [
            'Slaleye\\MemoryGameTheme\\' => 'Classes'
        ],
    ],
    'state' => 'stable',
    'uploadfolder' => 0,
    'createDirs' => '',
    'clearCacheOnLoad' => 1,
    'author' => 'Slaleye',
    'author_email' => 'slaleye@mail.com',
    'author_company' => 'Slaleye',
    'version' => '1.0.0',
];
