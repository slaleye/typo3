<?php


namespace Slaleye\SlBlockquote\Utility;


use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

class AddContentElementHelperUtility
{

    /**
    * Add content element in Configuration/Overrides/tt_content.php
    *
    * @param $title The title of the content element (LLL:...)
    * @param $cType The CType of the content element, e.g. sl_text
    * @param string $showItems The showitem section of the content element
    * @param string $extensionKey The extension the content element is stored
    * @param $iconPath The path to the icon file
    * @param $typeIconClass The typeicon class, e.g. ext-vatemplate-content-blockquote-icon, that is registered in ext_localconf.php
    * @param string $flexform The path to the flexform values
    */
    public static function addContentElement($title, $cType, $showItems, $extensionKey = 'sl_blockquote', $iconPath = '', $typeIconClass = '', $flexform = '') {
        ExtensionManagementUtility::addPlugin(
            array(
                $title,
                $cType,
                $iconPath?$iconPath:'EXT:sl_blockquote/ext_icon.svg'
            ),
            'CType',
            $extensionKey
        );

        if($flexform){
            ExtensionManagementUtility::addPiFlexFormValue('*', $flexform, $cType);
        }

        $GLOBALS['TCA']['tt_content']['types'][$cType]['showitem'] = $showItems;

        if($typeIconClass === ''){
            $typeIconClass = str_replace('_', '', $extensionKey);
            $typeIconClass = str_replace('-', '', $typeIconClass);
            $typeIconClass = 'ext-' . $typeIconClass . '-content-' . str_replace($typeIconClass . '_', '', $cType) . '-icon';
        }

        $GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes'][$cType] = $typeIconClass;
    }

}