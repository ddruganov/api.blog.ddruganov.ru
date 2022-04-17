<?php

namespace api\controllers;

use api\collectors\auth\CurrentUserCollector;
use ddruganov\Yii2ApiAuthProxy\http\controllers\AuthController as BaseAuthController;
use ddruganov\Yii2ApiEssentials\http\actions\FormAction;
use yii\helpers\ArrayHelper;

final class AuthController extends BaseAuthController
{
    public function actions()
    {
        return ArrayHelper::merge(parent::actions(), [
            'current-user' => [
                'class' => FormAction::class,
                'formClass' => CurrentUserCollector::class
            ]
        ]);
    }
}
