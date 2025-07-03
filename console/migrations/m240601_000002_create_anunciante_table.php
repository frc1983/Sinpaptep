<?php
use yii\db\Migration;

class m240601_000002_create_anunciante_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('anunciante', [
            'id' => $this->primaryKey(),
            'nome' => $this->string()->notNull(),
            'banner' => $this->string(),
            'url' => $this->string(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('anunciante');
    }
} 