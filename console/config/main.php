<?php

use yii\helpers\ArrayHelper;

return ArrayHelper::merge(
    require Yii::getAlias('@common/config/main.php'),
    [
        'id' => 'app-console',
        'basePath' => Yii::getAlias('@console'),
        'controllerNamespace' => 'console\controllers',
        'params' => require 'params.php',
    ],
    file_exists(Yii::getAlias('@console/config/main-local.php')) ? require Yii::getAlias('@console/config/main-local.php') : []
);
