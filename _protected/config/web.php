<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'name' => 'RestoBook',
    //'language' => 'sr',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [    		
    	'authClientCollection' => [
    				'class' => 'yii\authclient\Collection',
    				'clients' => [
    						'facebook' => [
    								'class' => 'yii\authclient\clients\Facebook',
    								'clientId' => '1553656018251147',
    								'clientSecret' => '560f44487fc8afeaa4c098ea453f1a1a',
    						],
    	], ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) 
            // - this is required by cookie validation
            'cookieValidationKey' => '3TlDYkHdHT3XkRbIB19UA01QH-Q5HSt7',
        ],
        // you can set your theme here 
        // - template comes with: 'default', 'slate', 'spacelab' and 'cerulean'
        'view' => [
            'theme' => [
                'pathMap' => ['@app/views' => '@webroot/themes/kvn'],
                'baseUrl' => '@web/themes/kvn',
            ],
            'class' => 'istranger\rSmartLoad\View',
            'smartLoadConfig' => [
            // Hashing method for resource names (if string value),
            // see possible values: http://php.net/manual/en/function.hash.php#104987
            // Can be assigned "callable", for example: function ($str) { return hash('sha256', $str); }
             'hashMethod'               => 'md5', // default = 'crc32b'
 
            // Types of resources, that will be tracked by current extension
            // If =null, include all resource types: ['jsFile', 'cssFile', 'jsInline', 'cssInline']
             'resourceTypes'            => ['jsFile', 'jsInline', 'cssFile', 'cssInline'],  // default = ['jsFile']
 
            // Enable log on server and client side (debug mode)
            // 'enableLog'                => true, // default = false
 
            // Activate "smart" disabling of resources on all pages
             'activateOnAllPages'       => true, // default = true
 
            // List of resources, that always should be loaded on client
            // (by name, hash, or full URL)
            // 'alwaysReloadableResources' => ['bootstrap.js'],  // default = []
             'alwaysReloadableResources' => ['bootstrap.min.js', 'facebook.js'],  // default = []
            // Disable native script filter 
            // (only for resource types specified in 'resourceTypes')
            // 'disableNativeScriptFilter' => false, // default = true
            ]
        ],
        'assetManager' => [
            'bundles' => [
                // we will use bootstrap css from our theme
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [], // do not use yii default one
                ],
                // use bootstrap js from CDN
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'sourcePath' => null,   // do not use file from our server
                    'js' => [
                        'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js']
                ],
                // use jquery from CDN
                'yii\web\JqueryAsset' => [
                    'sourcePath' => null,   // do not use file from our server
                    'js' => [
                        '//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js',
                    ]
                ],
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => false,
            'showScriptName' => false,
        ],
        'user' => [
            'identityClass' => 'app\models\UserIdentity',
            'enableAutoLogin' => false,
        ],
        'session' => [
            'class' => 'yii\web\Session',
            'savePath' => '@app/runtime/session'
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/translations',
                    'sourceLanguage' => 'en',
                ],
                'yii' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/translations',
                    'sourceLanguage' => 'en'
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
