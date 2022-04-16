<?php

namespace api\controllers;

use api\collectors\auth\CurrentUserCollector;
use api\forms\auth\LoginForm;
use api\http\controllers\SecureApiController;
use ddruganov\Yii2ApiEssentials\http\actions\FormAction;
use yii\helpers\ArrayHelper;

final class AuthController extends SecureApiController
{
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'auth' => [
                'exceptions' => ['login', 'refresh']
            ],
            'rbac' => [
                'rules' => [
                    'current-user' => 'authenticate',
                ],
                'exceptions' => ['login', 'refresh']
            ]
        ]);
    }

    public function actions()
    {
        return [
            'login' => [
                'class' => FormAction::class,
                'formClass' => LoginForm::class
            ],
            'refresh' => [
                'class' => FormAction::class,
                'formClass' => RefreshForm::class
            ],
            'current-user' => [
                'class' => FormAction::class,
                'formClass' => CurrentUserCollector::class
            ]
        ];
    }
}
