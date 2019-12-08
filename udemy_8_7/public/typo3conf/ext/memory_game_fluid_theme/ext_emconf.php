<?php

/**
 * Extension Manager/Repository config file for ext "memory_game_fluid_theme".
 */
$EM_CONF[$_EXTKEY] = [
    'title' => 'Memory Game Fluid Theme',
    'description' => 'Memory Game fluid theme from sitepackage',
    'category' => 'templates',
    'constraints' => [
        'depends' => [
            'typo3' => '8.7.0-8.7.99',
            'fluid_styled_content' => '8.7.0-8.7.99',
            'rte_ckeditor' => '8.7.0-8.7.99'
        ],
        'conflicts' => [
        ],
    ],
    'autoload' => [
        'psr-4' => [
            'Slaleye\\MemoryGameFluidTheme\\' => 'Classes'
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
