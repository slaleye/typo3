## Section 6
Programming the mini game

Namespace in extensions
VendorName \ ExtensionName \ FolderInClasses\
namespace Slaleye\Memory\Domain\Repository;


In COnfiguration\Typoscript\setup.ts
view, the template partial and layout are loaded
with their priority set, the highest will override the other entries
templateRootPahts.0 is overriden by templateRootPahts.1

> EXT: is a command for getting the absolute path to the 'typo3conf/ext' folder
 to acess a constant in typoscript use {}
{$plugin.tx_memory_game.view.templateRootPath}
constants are defined in constants.ts
````
plugin.{extension.shortExtensionKey}_{plugin.key} {
    view {
        templateRootPaths.0 = EXT:{extension.extensionKey}/Resources/Private/Templates/
        templateRootPaths.1 = {$plugin.tx_memory_game.view.templateRootPath}
        partialRootPaths.0 = EXT:memory/Resources/Private/Partials/
        partialRootPaths.1 = {$plugin.tx_memory_game.view.partialRootPath}
        layoutRootPaths.0 = EXT:memory/Resources/Private/Layouts/
        layoutRootPaths.1 = {$plugin.tx_memory_game.view.layoutRootPath}
    }

````

TCA : Table Content Array: contains the backend
 representation of the database table
 
 The ExtensionBuilder
 settings.yaml
 generates settings for the export of the Extension, in case a new property
 is added to a model it will be saved in that folder
 setting set with **merge** , will override the current settings,Ex: controllers
 Settings set to **keep** , will not be overrriden EX: Templates
 
 Documentation.tmpl
 Contains documentation for the plugin,
  needs to be renamed to Documentation.
  
  Resources
  contains private (templates, backend layout ...)and public subfolders
  Templates contains controller names and their action as html
  In templates/ControllerName / ActionName.html
  Templates/Game/Board.html
  
  
  ````php
   public function boardAction()
      {
          $cards = $this->cardsRepository->findAll();
          $this->view->assign('cardss', $cards);
      }
  ````
  
  Tests folder contains tests, for unit test
  ExtBase can create default tests 
  
  Composer.json
  in autoload to allow new classes to be found
  ````json
     "autoload": {
            "psr-4": {
                "Slaleye\\Memory\\": "Classes"
            }
        },
````
IN the backend install tool, you can make Typo3 redump autoload information
for extensions
Dump Autoload Information
This (re-)dumps autoload information for all active third party extensions.

ext_emconf.php
common config file

ext_localconf.php
    config file for frontend and frontend plugins
Define controller and their actions
````php
 \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Slaleye.Memory',
            'Game',
            [
                'Game' => 'board'
            ],
            // non-cacheable actions
            [
                'Game' => 'board'
            ]
        );
````


wizards configuration to make the plugin appear in the content creation plugin

````php
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

````

Sets the plugin icon

`````php 
$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
		
			$iconRegistry->registerIcon(
				'memory-plugin-game',
				\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
				['source' => 'EXT:memory/Resources/Public/Icons/user_plugin_game.svg']
			);
		
    }
`````
ext_tables.php
    config file for backend 
    
    need to register the plugin here#
 ext_tables.sql
  sql queries needed to create table for extensions
  
 extensionBuilder.json
 no changes in that folder, automatic generated extensionbuilder properties
 
## Lesson 12 : Creating FlexForms
Flex form: XML file, extends the editor of content elements, Live codi

````xml
<?xml version="1.0" encoding="utf-8" standalone="yes" ?>
<T3DataStructure>
    <sheets>
        <sDEF>
            <ROOT>
                <TCEforms>
                    <sheetTitle>LLL:EXT:extkey/Resources/Private/Language/Backend.xlf:settings.registration.title</sheetTitle>
                </TCEforms>
                <type>array</type>
                <el>
                    <!-- Add settings here ... -->

                    <!-- Example setting: input field with name settings.timeRestriction -->
                    <settings.includeCategories>
                        <TCEforms>
                            <label>LLL:EXT:example/Resources/Private/Language/Backend.xlf:settings.registration.includeCategories</label>
                            <config>
                                <type>check</type>
                                <default>0</default>
                                <items type="array">
                                    <numIndex index="0" type="array">
                                        <numIndex index="0">LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:setting.registration.includeCategories.title</numIndex>
                                    </numIndex>
                                </items>
                            </config>
                        </TCEforms>
                    </settings.includeCategories>

                    <!-- end of settings -->

                </el>
            </ROOT>
        </sDEF>
    </sheets>
</T3DataStructure>
````

## lesson 13 
Registering FlexForms
need to edit the ext_tables.php file

Absolute paths
* EXT: to typo3conf/ext
* FILE:EXT: to a file in typo3conf/ext
* LLL:EXT: to a language file file in typo3conf/ext

````php
    $pluginSignature = 'memory_game';
    $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
     // Add path to the Flexform
     \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature,
      'FILE:EXT:memory/Configuration/Flexforms/Game.xml');
````

## Lesson 17 : Creating partials

Partial folder defined in the  ext/memory/Configuration/TypoScript/setup.ts

````
    partialRootPaths.0 = EXT:memory/Resources/Private/Partials/
    partialRootPaths.1 = {$plugin.tx_memory_game.view.partialRootPath}
````
Place partial in folder Resources/Private/Partials
- Create a partial  in Game/HisghscoreProfile.html
Partial are rendered using: 
````
<f:render partial="Game/HighscoreForm"></f:render>
````


In the partial create a fluid form 

````xml
<div id="highscore-form" title="{f:translate(key:'highscore-form-title')}">
        <f:form action="saveHighscoreForm" object="{highscore}">
            <fieldset>
                <f:form.textfield id="highscore-form-username" property="username"
                value="" placeholder="{f:translate(key:'highscore-form-username')}" />
            </fieldset>
        </f:form>
    </div>
````

By using property username, it will automatically be set to required as defined in the 
Highscore Model

`````php
    /**
     * username
     * 
     * @var string
     * @validate NotEmpty
     */
    protected $username = '';

`````