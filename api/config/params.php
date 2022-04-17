<?php

use yii\helpers\ArrayHelper;

return ArrayHelper::merge(
    [
        'authentication' => [
            'externalService' => [
                'url' => 'http://api.hub.ddruganov.ru.nginx:2000/api/v1'
            ]
        ]
    ],
    file_exists(Yii::getAlias('@api/config/params-local.php')) ? require Yii::getAlias('@api/config/params-local.php') : []
);
