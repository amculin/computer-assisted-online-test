<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'language' => 'id-ID',
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager'
        ],
        'user' => [
            'identityClass' => 'app\models\UserIdentity',
            'enableAutoLogin' => true,
            'enableSession' => true,
            'loginUrl' => '/index'
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'g8YmxqMisd2clcQo458yIe8z-e03ndUTGlX6n-7MIAUXlQGjqnpFzV2rH',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        /* 'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'enableSession' => true,
            'loginUrl' => '/index'
        ], */
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
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'index' => 'site/index',
                'login' => 'site/index',
                'logout' => 'site/logout',
                'register' => 'site/register',
                'student/dashboard' => 'student/dashboard/index',
                'student/test-type' => 'student/test-type/index',
                'student/test' => 'student/test/index',
            ],
        ],
        'view' => [
            'theme' => [
                'basePath' => '@app/themes/hyriudsgn',
                'baseUrl' => '@web/themes/hyriudsgn',
                'pathMap' => [
                    '@app/views' => '@app/themes/hyriudsgn/views',
                    '@app/modules' => '@app/themes/hyriudsgn/modules',
                ],
            ],
        ],
    ],
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module'
        ],
        'student' => [
            'class' => 'app\modules\student\Module',
        ],
        'super-user' => [
            'class' => 'mdm\admin\Module',
        ],
        'setting' => [
            'class' => 'app\modules\setting\Module',
        ],
    ],
    'params' => $params,
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            //'*',
            'site/index',
            'site/logout',
            'site/register',
            'super-user/*',
            'admin/*',
            'setting/*',
            'student/*',
            'gii/*'
        ]
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    /* $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ]; */

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
