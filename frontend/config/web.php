<?php
$config = [
    'homeUrl' => Yii::getAlias('@frontendUrl'),
        'language' => 'ru',
    'sourceLanguage' => 'en',
    'controllerNamespace' => 'frontend\controllers',
    'defaultRoute' => 'site/index',
    'bootstrap' => ['maintenance'],
    'modules' => [
        'user' => [
            'class' => frontend\modules\user\Module::class,
            'shouldBeActivated' => false,
            'enableLoginByPass' => false,
        ],
		'mailchimp' => [
			'class' => Mailchimp::class,
			'showFirstname' => true,
			'showLastname' => true
		]
    ],
    'components' => [
        'authClientCollection' => [
            'class' => yii\authclient\Collection::class,
            'clients' => [
                'github' => [
                    'class' => yii\authclient\clients\GitHub::class,
                    'clientId' => env('GITHUB_CLIENT_ID'),
                    'clientSecret' => env('GITHUB_CLIENT_SECRET')
                ],
                'facebook' => [
                    'class' => yii\authclient\clients\Facebook::class,
                    'clientId' => env('FACEBOOK_CLIENT_ID'),
                    'clientSecret' => env('FACEBOOK_CLIENT_SECRET'),
                    'scope' => 'email,public_profile',
                    'attributeNames' => [
                        'name',
                        'email',
                        'first_name',
                        'last_name',
                    ]
                ]
            ]
        ],
        'cart' => [
            'class' => 'devanych\cart\Cart',
            'storageClass' => 'devanych\cart\storage\SessionStorage',
            'calculatorClass' => 'devanych\cart\calculators\SimpleCalculator',
            'params' => [
                'key' => 'cart',
                'expire' => 604800,
                'productClass' => 'common\models\ProductModel',
                'productFieldId' => 'id',
                'productFieldPrice' => 'price',
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error'
        ],
        'maintenance' => [
            'class' => common\components\maintenance\Maintenance::class,
            'enabled' => function ($app) {
                if (env('APP_MAINTENANCE') === '1') {
                    return true;
                }
                return $app->keyStorage->get('frontend.maintenance') === 'enabled';
            }
        ],
        'request' => [
            'cookieValidationKey' => env('FRONTEND_COOKIE_VALIDATION_KEY')
        ],
		'breadcrumbs' => [
			'class' => '\common\components\Breadcrumbs'
		],
		'email' => [
			'class' => '\common\components\Email'
		],
		'helper' => [
			'class' => '\frontend\components\Helper'
		],
		'sklad' => [
			'class' => 'backend\components\Sklad'
		],
		'amocrm' => [
			'class' => 'yii\amocrm\Client',
			'subdomain' => 'tattoopromska',
			'login' => 'tattoopromska@yandex.ru',
			'hash' => '15f39637899c43235c03247fb4f038e5deab01a5'
		],
        'user' => [
            'class' => yii\web\User::class,
            'identityClass' => common\models\User::class,
            'loginUrl' => ['/user/sign-in/login'],
            'enableAutoLogin' => true,
            'as afterLogin' => common\behaviors\LoginTimestampBehavior::class
        ],
		'mailchimp' => [
			'class' => MailchimpComponent::class,
			'apiKey' => '4fc051feaae0ec0ff0d4e65060b98ff1-us19'
		],
    ]
];

if (YII_ENV_DEV) {
    $config['modules']['gii'] = [
        'class' => yii\gii\Module::class,
        'generators' => [
            'crud' => [
                'class' => yii\gii\generators\crud\Generator::class,
                'messageCategory' => 'frontend'
            ]
        ]
    ];
}

return $config;
