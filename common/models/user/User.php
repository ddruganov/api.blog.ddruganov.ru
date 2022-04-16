<?php

namespace common\models\user;

use yii\db\ActiveRecord;

/**
 * @property int $id
 */
final class User extends ActiveRecord
{
    public static function tableName()
    {
        return 'user.user';
    }

    public function rules()
    {
        return [
            [['id'], 'safe']
        ];
    }

    public function getId()
    {
        return $this->id;
    }
}
