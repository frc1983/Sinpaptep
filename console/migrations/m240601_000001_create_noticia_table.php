<?php
use yii\db\Migration;

class m240601_000001_create_noticia_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('noticia', [
            'id' => $this->primaryKey(),
            'titulo' => $this->string()->notNull(),
            'conteudo' => $this->text()->notNull(),
            'imagem' => $this->string(),
            'data_publicacao' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('noticia');
    }
} 