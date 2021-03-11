<?php

use Sitemaped\Sitemap;

return [
    'class' => 'yii\web\UrlManager',
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'normalizer' => [
        'class' => 'yii\web\UrlNormalizer',
        'action' => yii\web\UrlNormalizer::ACTION_REDIRECT_TEMPORARY,
    ],
    'rules' => [
		['pattern'=>'/images/lazyload/<image>', 'route'=>'storage/lazyload'],
		['pattern'=>'/images/<image>', 'route'=>'storage/index'],

		['pattern'=>'/images/lazyload/<path:[\w\s_\/-]+>/<image>', 'route'=>'storage/lazyload'],
		['pattern'=>'/images/<path:[\w\s_\/-]+>/<image>', 'route'=>'storage/index'],

		['pattern'=>'/images/lazyload/<image>/<size>', 'route'=>'storage/lazyload'],
		['pattern'=>'/images/<image>/<size>', 'route'=>'storage/index'],


		['pattern'=>'/images/lazyload/<path:[\w\s_\/-]+>/<image>/<size>', 'route'=>'storage/lazyload'],
		['pattern'=>'/images/<path:[\w\s_\/-]+>/<image>/<size>', 'route'=>'storage/index'],

        ['pattern' => 'blog', 'route' => 'article/index'],
        ['pattern' => 'blog/index', 'route' => 'article/index'],
        ['pattern' => 'blog/attachment-download', 'route' => 'article/attachment-download'],
        ['pattern' => 'blog/<slug>', 'route' => 'article/view'],

        //Products
        ['pattern' => 'catalog', 'route' => 'product/index'],
        ['pattern' => 'catalog/<category:[\w\s_\/-]+>', 'route' => 'product/category'],
        ['pattern' => 'catalog/<category:[\w\s_\/-]+>/<product>', 'route' => 'product/product'],
        ['pattern' => 'catalog/attachment-download', 'route' => 'product/attachment-download'],

        //['pattern' => 'cart/get-minicart', 'route' => 'cart/minicart'],
        ['pattern' => 'cart/add-item', 'route' => 'cart/add-item'],
        ['pattern' => 'cart/add-certificate', 'route' => 'cart/add-certificate'],
        ['pattern' => 'cart/remove-item/<id>', 'route' => 'cart/remove-item'],
        ['pattern' => 'cart/add-item-single', 'route' => 'cart/add-single'],
        ['pattern' => 'cart/get-cart', 'route' => 'cart/get-cart'],
        ['pattern' => 'cart', 'route' => 'cart/index'],
        ['pattern' => 'cart/clear', 'route' => 'cart/clear'],
        ['pattern' => 'order', 'route' => 'orders/index'],

        ['pattern' => 'search', 'route' => 'search/index'],

        ['pattern' => 'favorites', 'route' => 'favorites/index'],
        ['pattern' => 'favorites/action/<id>', 'route' => 'favorites/action'],

        ['pattern' => 'contact', 'route' => 'site/contact'],

        ['pattern' => 'logout', 'route' => 'site/logout'],
        ['pattern' => 'login', 'route' => 'user/sign-in/login'],
        ['pattern' => 'registration', 'route' => 'user/sign-in/signup'],

        ['pattern' => 'sitemap.xml', 'route' => 'site/sitemap', 'defaults' => ['format' => Sitemap::FORMAT_XML]],
        ['pattern' => 'sitemap.txt', 'route' => 'site/sitemap', 'defaults' => ['format' => Sitemap::FORMAT_TXT]],
        ['pattern' => 'sitemap.xml.gz', 'route' => 'site/sitemap', 'defaults' => ['format' => Sitemap::FORMAT_XML, 'gzip' => true]],

        ['pattern' => 'page/<slug>/page/<page:\d+>', 'route' => 'page/view'],
        ['pattern' => '<slug>', 'route' => 'page/view'],
    ]
];
