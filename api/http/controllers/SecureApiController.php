<?php

namespace api\http\controllers;

use api\http\filters\AuthFilter;
use api\http\filters\RbacFilter;
use ddruganov\Yii2ApiEssentials\http\controllers\ApiController;
use yii\helpers\ArrayHelper;

abstract class SecureApiController extends ApiController
{
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'auth' => [
                'class' => AuthFilter::class
            ],
            'rbac' => [
                'class' => RbacFilter::class
            ]
        ]);
    }
}
