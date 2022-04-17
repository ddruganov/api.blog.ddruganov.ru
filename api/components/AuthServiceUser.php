<?php

namespace api\components;

use ddruganov\Yii2ApiAuthProxy\components\AuthServiceUser as BaseAuthServiceUser;

final class AuthServiceUser extends BaseAuthServiceUser
{
    public bool $isBanned;

    public function isBanned()
    {
        return $this->isBanned;
    }
}
