<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'Slaleye.Memory',
            'Game',
            'Memory'
        );

        if (TYPO3_MODE === 'BE') {

            \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
                'Slaleye.Memory',
                'tools', // Make module a submodule of 'tools'
                'highscore', // Submodule key
                '', // Position for sorting order, left empty to append to the end
                [
                    'Highscore' => 'leaderboard', // Highscore controller to display action leaderboard in the module
                    
                ],
                [
                    'access' => 'user,group', // Which use has access to the module
                    'icon'   => 'EXT:memory/Resources/Public/Icons/user_mod_highscore.svg',
                    'labels' => 'LLL:EXT:memory/Resources/Private/Language/locallang_highscore.xlf',
                ]
            );

        }
        // Adding a Flex Form to the extension
        $pluginSignature = 'memory_game';
        $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
        // Add path to the Flexform
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature,
            'FILE:EXT:memory/Configuration/Flexforms/Game.xml');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('memory', 'Configuration/TypoScript', 'Memory');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_memory_domain_model_cards', 'EXT:memory/Resources/Private/Language/locallang_csh_tx_memory_domain_model_cards.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_memory_domain_model_cards');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_memory_domain_model_highscore', 'EXT:memory/Resources/Private/Language/locallang_csh_tx_memory_domain_model_highscore.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_memory_domain_model_highscore');

    }
);
