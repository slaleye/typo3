<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Slaleye.Memory',
            'Game',
            [
                'Game' => 'board,saveHighscoreForm'
            ],
            // non-cacheable actions
            [
                'Game' => 'board,saveHighscoreForm'
            ]
        );

    // wizards
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'mod {
            wizards.newContentElement.wizardItems.plugins {
                elements {
                    game {
                        iconIdentifier = memory-plugin-game
                        title = LLL:EXT:memory/Resources/Private/Language/locallang_db.xlf:tx_memory_game.name
                        description = LLL:EXT:memory/Resources/Private/Language/locallang_db.xlf:tx_memory_game.description
                        tt_content_defValues {
                            CType = list
                            list_type = memory_game
                        }
                    }
                }
                show = *
            }
       }'
    );
		$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
		
        $iconRegistry->registerIcon(
            'memory-plugin-game',
            \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
            ['source' => 'EXT:memory/Resources/Public/Icons/user_plugin_game.svg']
        );

        // Registering GameEid
        $GLOBALS['TYPO3_CONF_VARS']['FE']['eID_include']['GameEidController::SaveHighscore'] =
            \Slaleye\Memory\Controller\Eid\GameEidController::class. '::saveHighscore';

    }
);
