<?php
defined('TYPO3_MODE') || die();

call_user_func(function()
{
    /**
     * Temporary variables
     */
    $extensionKey = 'memory_game_fluid_theme';

    /**
     * Default TypoScript for MemoryGameFluidTheme
     */
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
        $extensionKey,
        'Configuration/TypoScript',
        'Memory Game Fluid Theme'
    );
});
