<?php

use ddruganov\Yii2ApiAuthProxy\components\AccessTokenProviderInterface;
use ddruganov\Yii2ApiAuthProxy\components\AuthService;
use ddruganov\Yii2ApiAuthProxy\components\AuthServiceInterface;
use ddruganov\Yii2ApiAuthProxy\components\AuthServiceRequestInterface;
use ddruganov\Yii2ApiAuthProxy\components\GuzzleAuthServiceRequest;
use ddruganov\Yii2ApiAuthProxy\components\HeaderAccessTokenProvider;
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
            AccessTokenProviderInterface::class => HeaderAccessTokenProvider::class,
            AuthServiceInterface::class => AuthService::class,
            AuthServiceRequestInterface::class => GuzzleAuthServiceRequest::class
        ],
        'params' => require 'params.php',
    ],
    file_exists(Yii::getAlias('@api/config/main-local.php')) ? require Yii::getAlias('@api/config/main-local.php') : []
);
