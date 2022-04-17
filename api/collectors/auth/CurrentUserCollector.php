<?php

namespace api\collectors\auth;

use ddruganov\Yii2ApiAuthProxy\components\AccessTokenProviderInterface;
use ddruganov\Yii2ApiAuthProxy\components\AuthServiceInterface;
use ddruganov\Yii2ApiEssentials\ExecutionResult;
use ddruganov\Yii2ApiEssentials\forms\Form;
use Yii;

final class CurrentUserCollector extends Form
{
    protected function _run(): ExecutionResult
    {
        /** @var \ddruganov\Yii2ApiAuthProxy\components\AccessTokenProviderInterface */
        $accessTokenProvider = Yii::$app->get(AccessTokenProviderInterface::class);

        /** @var \ddruganov\Yii2ApiAuthProxy\components\AuthServiceInterface */
        $authService = Yii::$app->get(AuthServiceInterface::class);

        $result = $authService->getUserDataByAccessToken($accessTokenProvider->getAccessToken());
        if (!$result->isSuccessful()) {
            return ExecutionResult::exception('Ошибка получения данных о пользователе');
        }

        return $result;
    }
}
