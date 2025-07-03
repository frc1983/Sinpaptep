<?php

use yii\db\Migration;

/**
 * Class m240703_000001_create_parceiro_table
 */
class m240703_000001_create_parceiro_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%parceiro}}', [
            'Id' => $this->primaryKey(),
            'Nome' => $this->string(255)->notNull(),
            'Descricao' => $this->text(),
            'Logo' => $this->string(255),
            'Site' => $this->string(255),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        // Índices
        $this->createIndex('idx_parceiro_nome', '{{%parceiro}}', 'Nome');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%parceiro}}');
    }
} 