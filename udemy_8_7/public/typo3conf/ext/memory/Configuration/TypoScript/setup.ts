
plugin.{extension.shortExtensionKey}_{plugin.key} {
    view {
        templateRootPaths.0 = EXT:{extension.extensionKey}/Resources/Private/Templates/
        templateRootPaths.1 = {$plugin.tx_memory_game.view.templateRootPath}
        partialRootPaths.0 = EXT:memory/Resources/Private/Partials/
        partialRootPaths.1 = {$plugin.tx_memory_game.view.partialRootPath}
        layoutRootPaths.0 = EXT:memory/Resources/Private/Layouts/
        layoutRootPaths.1 = {$plugin.tx_memory_game.view.layoutRootPath}
    }
    persistence {
        # Disable to force Extbase to use defined Storage PiD
        #storagePid = {$plugin.tx_memory_game.persistence.storagePid}
        #recursive = 1
    }
    features {
        #skipDefaultArguments = 1
        # if set to 1, the enable fields are ignored in BE context
        ignoreAllEnableFieldsInBe = 0
        # Should be on by default, but can be disabled if all action in the plugin are uncached
        requireCHashArgumentForActionArguments = 1
    }
    mvc {
        #callDefaultActionIfActionCantBeResolved = 1
    }
}

# these classes are only used in auto-generated templates
plugin.tx_memory._CSS_DEFAULT_STYLE (
    textarea.f3-form-error {
        background-color:#FF9F9F;
        border: 1px #FF0000 solid;
    }

    input.f3-form-error {
        background-color:#FF9F9F;
        border: 1px #FF0000 solid;
    }

    .tx-memory table {
        border-collapse:separate;
        border-spacing:10px;
    }

    .tx-memory table th {
        font-weight:bold;
    }

    .tx-memory table td {
        vertical-align:top;
    }

    .typo3-messages .message-error {
        color:red;
    }

    .typo3-messages .message-ok {
        color:green;
    }
)

# Module configuration
# name of module_sub moodule_name of action module
module.tx_memory_tools_memoryhighscore {
    persistence {
        storagePid = {$module.tx_memory_highscore.persistence.storagePid}
    }
    view {
        templateRootPaths.0 = EXT:{extension.extensionKey}/Resources/Private/Backend/Templates/
        templateRootPaths.1 = {$module.tx_memory_highscore.view.templateRootPath}
        partialRootPaths.0 = EXT:memory/Resources/Private/Backend/Partials/
        partialRootPaths.1 = {$module.tx_memory_highscore.view.partialRootPath}
        layoutRootPaths.0 = EXT:memory/Resources/Private/Backend/Layouts/
        layoutRootPaths.1 = {$module.tx_memory_highscore.view.layoutRootPath}
    }
}

# Include CSS and JS  for memory
page {
    includeCSS {
        memory_game_style = EXT:memory/Resources/Public/Css/memory_style.css
        jquery_ui_style = EXT:memory/Resources/Public/Css/jquery-ui.css
    }
    includeJSFooterlibs {
        memory_game_jquery_ui = EXT:memory/Resources/Public/JavaScript/Js/jquery-ui.min.js
    }
    includeJSFooter {
        memory_game_js = EXT:memory/Resources/Public/JavaScript/Js/memory_script.js
    }
}


# Creating an Asynchronous JavaScript XML ( AJAX)  page object
ajax = PAGE
ajax {
    typeNum = 100

    10  < tt_content.list.20.memory_game

    config {
        disableAllHeaderCode = 1
        xhtml_cleaning = 0
        admPanel = 0
        debug = 0
        no_cache = 1
        contentObjectExceptionHandler = 1
    }
}