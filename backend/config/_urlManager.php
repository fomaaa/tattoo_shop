<?php

return [
    'class' => yii\web\UrlManager::class,
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'normalizer' => [
                'class' => 'yii\web\UrlNormalizer',
                'action' => yii\web\UrlNormalizer::ACTION_REDIRECT_TEMPORARY,
            ],
    'rules' => [
        // Pages
        ['pattern' => 'errors', 'route' => 'site/errors'],
        ['pattern' => 'catalog', 'route' => 'site/catalog'],
        ['pattern' => 'novelty', 'route' => 'site/novelty'],
        ['pattern' => 'bestsellers', 'route' => 'site/bestsellers'],
        ['pattern' => 'get-products', 'route' => 'site/get-products'],
        ['pattern' => 'uploader', 'route' => 'site/uploader'],
        ['pattern' => '/content/front-page', 'route' => 'site/front-page'],
        ['pattern' => '/content/layout', 'route' => 'site/layout'],
        ['pattern' => '/content/contact', 'route' => 'site/contact'],

    ]
];
