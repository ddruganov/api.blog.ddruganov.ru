<?php

namespace api\forms\auth;

use common\components\auth\AuthServiceInterface;
use ddruganov\Yii2ApiEssentials\ExecutionResult;
use ddruganov\Yii2ApiEssentials\forms\Form;
use Yii;

final class RefreshForm extends Form
{
    public ?string $refreshToken = null;

    public function rules()
    {
        return [
            [['refreshToken'], 'required'],
            [['refreshToken'], 'string']
        ];
    }

    protected function _run(): ExecutionResult
    {
        return $this->getAuthService()->refresh($this->refreshToken);
    }

    private function getAuthService(): AuthServiceInterface
    {
        return Yii::$app->get(AuthServiceInterface::class);
    }
}
