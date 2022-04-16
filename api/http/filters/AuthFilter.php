<?php

namespace api\http\filters;

use api\components\AccessTokenProviderInterface;
use common\components\auth\AuthServiceInterface;
use Yii;
use yii\base\ActionFilter;

final class AuthFilter extends ActionFilter
{
    public array $exceptions = [];

    public function beforeAction($action)
    {
        if (in_array($this->getActionId($action), $this->exceptions)) {
            return parent::beforeAction($action);
        }

        /** @var \api\components\AccessTokenProviderInterface */
        $accessTokenProvider = Yii::$app->get(AccessTokenProviderInterface::class);

        /** @var \common\components\auth\AuthServiceInterface */
        $authService = Yii::$app->get(AuthServiceInterface::class);

        $result = $authService->verify($accessTokenProvider->getAccessToken());
        if ($result->isSuccessful()) {
            return parent::beforeAction($action);
        }

        Yii::$app->getResponse()->data = $result;
        Yii::$app->getResponse()->setStatusCode(401);
        Yii::$app->end();
    }
}
