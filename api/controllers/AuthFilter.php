<?php

namespace api\http\filters;

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

        /** @var \common\components\auth\AuthServiceInterface */
        $authService = Yii::$app->get(AuthServiceInterface::class);

        $result = $authService->verify($this->getAccessToken());
        if ($result->isSuccessful()) {
            return parent::beforeAction($action);
        }

        Yii::$app->getResponse()->data = $result;
        Yii::$app->getResponse()->setStatusCode(401);
        Yii::$app->end();
    }

    private function getAccessToken(): string
    {
        $accessToken = Yii::$app->getRequest()->getHeaders()->get('Authorization') ?? '';
        $accessToken = str_replace('Bearer', '', $accessToken);
        return trim($accessToken);
    }
}
