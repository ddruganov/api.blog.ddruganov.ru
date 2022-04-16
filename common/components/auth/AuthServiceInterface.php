<?php

namespace common\components\auth;

use ddruganov\Yii2ApiEssentials\ExecutionResult;

interface AuthServiceInterface
{
    public function verify(string $accessToken): ExecutionResult;
    public function refresh(string $refreshToken): ExecutionResult;
    public function checkPermission(string $accessToken, string $permissionName): ExecutionResult;
    public function getUserByAccessToken(string $accessToken): AuthServiceUser;
}
