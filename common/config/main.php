<?php

use yii\helpers\ArrayHelper;
use yii\log\FileTarget;

return ArrayHelper::merge(
    [
        'vendorPath' => Yii::getAlias('@vendor'),
        'bootstrap' => ['log'],
        'components' => [
            'log' => [
                'targets' => [
                    [
                        'class' => FileTarget::class,
                        'categories' => ['application'],
                        'logVars' => [],
                        'logFile' => '@logs/main.log',
                        'enableRotation' => false,
                        'prefix' => fn () => ''
                    ]
                ],
            ]
        ],
        'params' => require 'params.php',
    ],
    file_exists(Yii::getAlias('@common/config/main-local.php')) ? require Yii::getAlias('@common/config/main-local.php') : []
);
