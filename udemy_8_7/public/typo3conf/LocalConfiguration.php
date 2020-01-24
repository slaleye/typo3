<?php
return [
    'BE' => [
        'debug' => false,
        'explicitADmode' => 'explicitAllow',
        'installToolPassword' => '$pbkdf2-sha256$25000$sODC/P66HSM.XBpO/x4IDQ$6cfAQjtp6eRslDZVDW4vAZcEvq6zWgsvek2D2JCbOCo',
        'loginSecurityLevel' => 'normal',
    ],
    'DB' => [
        'Connections' => [
            'Default' => [
                'charset' => 'utf8',
                'driver' => 'mysqli',
                'port' => 3306,
            ],
        ],
    ],
    'EXT' => [
        'extConf' => [
            'bootstrap_package' => 'a:8:{s:16:"disablePageTsRTE";s:1:"0";s:27:"disablePageTsBackendLayouts";s:1:"0";s:20:"disablePageTsTCEMAIN";s:1:"0";s:20:"disablePageTsTCEFORM";s:1:"0";s:28:"disablePageTsContentElements";s:1:"0";s:20:"disableCssProcessing";s:1:"0";s:24:"disableGoogleFontCaching";s:1:"0";s:17:"disableFontLoader";s:1:"0";}',
            'extension_builder' => 'a:3:{s:15:"enableRoundtrip";s:1:"1";s:15:"backupExtension";s:1:"1";s:9:"backupDir";s:35:"uploads/tx_extensionbuilder/backups";}',
            'l10nmgr' => 'a:23:{s:23:"enable_hidden_languages";s:1:"0";s:19:"enable_notification";s:1:"0";s:10:"enable_ftp";s:1:"0";s:16:"enable_stat_hook";s:1:"0";s:22:"enable_neverHideAtCopy";s:1:"1";s:16:"disallowDoktypes";s:14:"255, ---div---";s:11:"l10nmgr_cfg";s:0:"";s:14:"l10nmgr_tlangs";s:0:"";s:15:"email_recipient";s:0:"";s:22:"email_recipient_import";s:0:"";s:12:"email_sender";s:0:"";s:17:"email_sender_name";s:0:"";s:25:"email_sender_organisation";s:0:"";s:16:"email_attachment";s:1:"0";s:10:"ftp_server";s:0:"";s:15:"ftp_server_path";s:0:"";s:19:"ftp_server_downpath";s:0:"";s:19:"ftp_server_username";s:0:"";s:19:"ftp_server_password";s:0:"";s:16:"service_children";s:1:"3";s:12:"service_user";s:0:"";s:11:"service_pwd";s:0:"";s:11:"service_enc";s:0:"";}',
            'memory' => 'a:0:{}',
            'memory_game_fluid_theme' => 'a:0:{}',
            'memory_game_theme' => 'a:0:{}',
            'rsaauth' => 'a:1:{s:18:"temporaryDirectory";s:0:"";}',
            'rte_ckeditor' => 'a:1:{s:15:"ckeditorVersion";s:6:"latest";}',
            'saltedpasswords' => 'a:2:{s:3:"BE.";a:4:{s:21:"saltedPWHashingMethod";s:41:"TYPO3\\CMS\\Saltedpasswords\\Salt\\Pbkdf2Salt";s:11:"forceSalted";i:0;s:15:"onlyAuthService";i:0;s:12:"updatePasswd";i:1;}s:3:"FE.";a:5:{s:7:"enabled";i:1;s:21:"saltedPWHashingMethod";s:41:"TYPO3\\CMS\\Saltedpasswords\\Salt\\Pbkdf2Salt";s:11:"forceSalted";i:0;s:15:"onlyAuthService";i:0;s:12:"updatePasswd";i:1;}}',
            'sl_blockquote' => 'a:0:{}',
            'static_info_tables' => 'a:1:{s:13:"enableManager";s:1:"0";}',
            'tt_news' => 'a:13:{s:17:"requireCategories";s:1:"0";s:17:"showBackEndModule";s:1:"0";s:13:"prependAtCopy";s:1:"1";s:5:"label";s:5:"title";s:9:"label_alt";s:0:"";s:10:"label_alt2";s:0:"";s:15:"label_alt_force";s:1:"0";s:25:"l10n_mode_prefixLangTitle";s:1:"1";s:22:"l10n_mode_imageExclude";s:1:"1";s:20:"hideNewLocalizations";s:1:"0";s:24:"writeCachingInfoToDevlog";s:1:"0";s:23:"writeParseTimesToDevlog";s:1:"0";s:18:"parsetimeThreshold";s:3:"0.1";}',
        ],
    ],
    'FE' => [
        'debug' => false,
        'enableRecordRegistration' => false,
        'loginSecurityLevel' => 'normal',
    ],
    'GFX' => [
        'jpg_quality' => '80',
    ],
    'MAIL' => [
        'transport' => 'smtp',
        'transport_sendmail_command' => '',
        'transport_smtp_encrypt' => '',
        'transport_smtp_password' => '',
        'transport_smtp_server' => 'localhost:25',
        'transport_smtp_username' => '',
    ],
    'SYS' => [
        'caching' => [
            'cacheConfigurations' => [
                'extbase_object' => [
                    'backend' => 'TYPO3\\CMS\\Core\\Cache\\Backend\\Typo3DatabaseBackend',
                    'frontend' => 'TYPO3\\CMS\\Core\\Cache\\Frontend\\VariableFrontend',
                    'groups' => [
                        'system',
                    ],
                    'options' => [
                        'defaultLifetime' => 0,
                    ],
                ],
            ],
        ],
        'devIPmask' => '',
        'displayErrors' => 0,
        'enableDeprecationLog' => false,
        'encryptionKey' => '3c2748632a06c36ebd25f64fd2e266dc18b2c94504c8cad214417f2cc1ab84228d885325ca0921644d8a43607f1aa1ab',
        'exceptionalErrors' => 20480,
        'isInitialDatabaseImportDone' => true,
        'isInitialInstallationInProgress' => false,
        'sitename' => 'Udemy Course',
        'sqlDebug' => 0,
        'systemLogLevel' => 2,
    ],
];
