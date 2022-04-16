<?php

namespace common\forms\user;

use common\models\user\User;
use ddruganov\Yii2ApiEssentials\ExecutionResult;
use ddruganov\Yii2ApiEssentials\forms\Form;

final class CreateForm extends Form
{
    public ?int $id = null;

    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
            [['id'], 'unique', 'targetClass' => User::class]
        ];
    }

    protected function _run(): ExecutionResult
    {
        $model = new User([
            'id' => $this->id
        ]);
        if (!$model->save()) {
            return ExecutionResult::exception('Ошибка создания пользователя');
        }

        return ExecutionResult::success([
            'id' => $model->getId()
        ]);
    }
}
