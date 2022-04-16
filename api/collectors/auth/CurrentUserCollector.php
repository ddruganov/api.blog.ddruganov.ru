<?php

namespace api\collectors\auth;

use api\components\AccessTokenProviderInterface;
use common\components\auth\AuthServiceInterface;
use ddruganov\Yii2ApiEssentials\ExecutionResult;
use ddruganov\Yii2ApiEssentials\forms\Form;
use Yii;

final class CurrentUserCollector extends Form
{
    protected function _run(): ExecutionResult
    {
        /** @var \api\components\AccessTokenProviderInterface */
        $accessTokenProvider = Yii::$app->get(AccessTokenProviderInterface::class);

        /** @var \common\components\auth\AuthServiceInterface */
        $authService = Yii::$app->get(AuthServiceInterface::class);

        $user = $authService->getUserByAccessToken($accessTokenProvider->getAccessToken());

        return ExecutionResult::success([
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'name' => $user->getName(),
            'isBanned' => $user->isBanned()
        ]);
    }
}
