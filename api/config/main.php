<?php

use api\components\AccessTokenProviderInterface;
use api\components\HeaderAccessTokenProvider;
use yii\helpers\ArrayHelper;

return ArrayHelper::merge(
    require Yii::getAlias('@common/config/main.php'),
    [
        'id' => 'app-api',
        'basePath' => Yii::getAlias('@api'),
        'controllerNamespace' => 'api\controllers',
        'components' => [
            'urlManager' => [
                'enablePrettyUrl' => true,
                'showScriptName' => false,
                'enableStrictParsing' => true,
                'rules' => require 'routes.php',
                'cache' => false
            ],
            AccessTokenProviderInterface::class => HeaderAccessTokenProvider::class
        ],
        'params' => require 'params.php',
    ],
    file_exists(Yii::getAlias('@api/config/main-local.php')) ? require Yii::getAlias('@api/config/main-local.php') : []
);
