<?php

namespace api\forms\auth;

use common\forms\user\CreateForm;
use common\components\auth\AuthServiceInterface;
use common\models\user\User;
use ddruganov\Yii2ApiEssentials\ExecutionResult;
use ddruganov\Yii2ApiEssentials\forms\Form;
use Yii;

final class LoginForm extends Form
{
    public ?string $accessToken = null;

    public function rules()
    {
        return [
            [['accessToken'], 'required'],
            [['accessToken'], 'string']
        ];
    }

    protected function _run(): ExecutionResult
    {
        $result = $this->getAuthService()->verify($this->accessToken);
        if (!$result->isSuccessful()) {
            return ExecutionResult::exception('Ошибка проверки валидности авторизации');
        }

        $authServiceUser = $this->getAuthService()->getUserByAccessToken($this->accessToken);

        $user = User::findOne($authServiceUser->getId());
        if (!$user) {
            $createForm = new CreateForm([
                'id' => $authServiceUser->getId()
            ]);
            $result = $createForm->run();
            if (!$result->isSuccessful()) {
                return ExecutionResult::exception('Ошибка создания пользователя');
            }
            $user = User::findOne($authServiceUser->getId());
        }

        return ExecutionResult::success();
    }

    private function getAuthService(): AuthServiceInterface
    {
        return Yii::$app->get(AuthServiceInterface::class);
    }
}
