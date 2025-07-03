<?php
use yii\db\Migration;

class m240601_000003_create_pagina_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('pagina', [
            'id' => $this->primaryKey(),
            'titulo' => $this->string()->notNull(),
            'conteudo' => $this->text()->notNull(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('pagina');
    }
} 