<?php

use yii\db\Migration;

class m220416_171652_create_user_table extends Migration
{
    private function getSchemaName()
    {
        return '"user"';
    }

    private function getTableName()
    {
        return $this->getSchemaName() . '.user';
    }

    public function safeUp()
    {
        $this->execute('create schema ' . $this->getSchemaName());

        $this->createTable($this->getTableName(), [
            'id' => $this->primaryKey(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable($this->getTableName());
        $this->execute('drop schema ' . $this->getSchemaName());
    }
}
