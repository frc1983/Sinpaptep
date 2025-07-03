<?php
use yii\db\Migration;

class m240601_000004_create_usuario_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('usuario', [
            'id' => $this->primaryKey(),
            'username' => $this->string(50)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'auth_key' => $this->string(32),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('usuario');
    }
} 