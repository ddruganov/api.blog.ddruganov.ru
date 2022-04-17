<?php

namespace api\components;

use ddruganov\Yii2ApiAuthProxy\components\AuthService as BaseAuthService;
use ddruganov\Yii2ApiAuthProxy\components\AuthServiceRequestInterface;
use Exception;
use Yii;

final class AuthService extends BaseAuthService
{
    public function getUser(string $accessToken): AuthServiceUser
    {
        $baseUrl = Yii::$app->params['authentication']['externalService']['url'];

        $result = Yii::$app->get(AuthServiceRequestInterface::class)->make(
            method: AuthServiceRequestInterface::GET,
            url: $baseUrl . '/' . self::CURRENT_USER_ENDPOINT,
            data: [],
            accessToken: $accessToken
        );

        if (!$result->isSuccessful()) {
            throw new Exception('Error getting user from a remote auth server');
        }

        return new AuthServiceUser($result->getData());
    }
}
