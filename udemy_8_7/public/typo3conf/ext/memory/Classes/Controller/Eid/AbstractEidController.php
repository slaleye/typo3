<?php

namespace Slaleye\Memory\Controller\Eid;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use function GuzzleHttp\json_encode;
use TYPO3\CMS\Frontend\Utility\EidUtility;

abstract class AbstractEidController
{
    /**
     * Helper Object with global information about the plugin
     * @var \stdClass
     */
    protected $pluginStruct;

    /**
     * $objectManager
     * @var \TYPO3\CMS\Extbase\Object\ObjectManager
     */
    protected $objectManager;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager
     */
    protected $persistenceManager;

    /**
     *  Holds TS Settings as array
     * @var array
     */
    protected $settings = [];

    /**
     * Initialize AbastractEidController
     * @param integer $inStoragePid
     * @return void
     */
    public function initialize($inStoragePid)
    {
        if (is_numeric($inStoragePid)){
            $this->pluginStruct = new \stdClass(); // Possible to create dynamic properties using the arrow operator
            $this->pluginStruct->extensionName = 'memory';
            $this->pluginStruct->pid = intval($inStoragePid);
        }else{
            throw new \Exception(
              LocalizationUtility::translate('typoscript.error.configuration','memory'),
              time()
            );
        }

        // Initialise Extension TCA
        EidUtility::initExtensionTCA(
            GeneralUtility::camelCaseToLowerCaseUnderscored($this->pluginStruct->extensionName)
        );

        // Initialise Language
        EidUtility::initLanguage();

        // Initialisation for the memory game
        $this->initializeTS();

        // Initialize the objectManager

        if(!$this->objectManager){
            $this->objectManager = GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\ObjectManager');
        }

        // COmmit the db transaction : initialize persistence Manager
        if (!$this->persistenceManager) {
            $this->persistenceManager = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager');
        }

    }

    /**
     *  Initialize Typoscript
     * @return void
     */
    public function initializeTS()
    {
        $pageId = GeneralUtility::_GET('id') ?: 1; # Gets current page id, if unset returns 1

        // TS frontendcontroller
        $typoscriptFrontendController = GeneralUtility::makeInstance(
            'TYPO3\\CMS\\Frontend\\Controller\TypoScriptFrontendController',
            $GLOBALS['TYPO3_CONF_VARS'],
            $pageId,
            0, // do not use cache
            true // enforce cHash, checks hash of server requests
        );

        //Initialize the TSFE
        $GLOBALS['TSFE'] = $typoscriptFrontendController;
        // Prepare Database Connection
        $GLOBALS['TSFE']->connectToDB();
        // configure front end user
        $GLOBALS['TSFE']->fe_user = EidUtility::initFeUser();
        $GLOBALS['TSFE']->determineId();
        $GLOBALS['TSFE']->initTemplate();
        $GLOBALS['TSFE']->getConfigArray();

        //echo '<pre>'.var_dump($GLOBALS['TSFE']->tmpl->setup['plugin.']).'</pre>';
        //initialize Typo3 TCA
        EidUtility::initTCA();

        // Load TypoScript Service
        $typoScriptService= GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Service\\TypoScriptService');
        // Read plugin configuration
        //T3 objects contains "." in their notation
        $pluginConfiguration = $typoScriptService->convertTypoScriptArrayToPlainArray( $GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_memory.']);
        // Assign t3 settings to this settings
        $this->settings = $pluginConfiguration['settings'];

    }

}