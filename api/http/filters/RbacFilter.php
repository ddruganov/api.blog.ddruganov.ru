<?php

namespace api\http\filters;

use api\components\AccessTokenProviderInterface;
use common\components\auth\AuthServiceInterface;
use Yii;
use yii\base\ActionFilter;

final class RbacFilter extends ActionFilter
{
    public array $rules = [];
    public array $exceptions = [];

    public function beforeAction($action)
    {
        if (in_array($this->getActionId($action), $this->exceptions)) {
            return parent::beforeAction($action);
        }

        $permissionName = $this->rules[$this->getActionId($action)] ?? null;

        /** @var \api\components\AccessTokenProviderInterface */
        $accessTokenProvider = Yii::$app->get(AccessTokenProviderInterface::class);

        /** @var \common\components\auth\AuthServiceInterface */
        $authService = Yii::$app->get(AuthServiceInterface::class);
        $result = $authService->checkPermission($accessTokenProvider->getAccessToken(), $permissionName);
        if ($result->isSuccessful()) {
            return parent::beforeAction($action);
        }

        Yii::$app->getResponse()->data = $result;
        Yii::$app->getResponse()->setStatusCode(403);
        Yii::$app->end();
    }
}
