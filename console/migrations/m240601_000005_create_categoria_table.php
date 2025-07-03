<?php
use yii\db\Migration;

class m240601_000005_create_categoria_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('categoria', [
            'Id' => $this->primaryKey(),
            'Nome' => $this->string(255)->notNull()->comment('Nome da categoria'),
            'Descricao' => $this->text()->comment('Descrição da categoria'),
            'Slug' => $this->string(255)->unique()->comment('URL amigável'),
            'Status' => $this->smallInteger()->defaultValue(1)->comment('1=Ativo, 0=Inativo'),
            'Ordem' => $this->integer()->defaultValue(0)->comment('Ordem de exibição'),
            'Cor' => $this->string(7)->defaultValue('#007bff')->comment('Cor da categoria (hex)'),
            'Icone' => $this->string(50)->comment('Classe do ícone (FontAwesome)'),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ]);

        // Índices para melhor performance
        $this->createIndex('idx_categoria_slug', 'categoria', 'Slug');
        $this->createIndex('idx_categoria_status', 'categoria', 'Status');
        $this->createIndex('idx_categoria_ordem', 'categoria', 'Ordem');

        // Inserir categorias padrão
        $this->insert('categoria', [
            'Nome' => 'Política',
            'Descricao' => 'Notícias relacionadas à política local, nacional e internacional',
            'Slug' => 'politica',
            'Status' => 1,
            'Ordem' => 1,
            'Cor' => '#dc3545',
            'Icone' => 'fas fa-landmark'
        ]);

        $this->insert('categoria', [
            'Nome' => 'Economia',
            'Descricao' => 'Notícias sobre economia, finanças e mercado',
            'Slug' => 'economia',
            'Status' => 1,
            'Ordem' => 2,
            'Cor' => '#28a745',
            'Icone' => 'fas fa-chart-line'
        ]);

        $this->insert('categoria', [
            'Nome' => 'Tecnologia',
            'Descricao' => 'Notícias sobre tecnologia, inovação e digital',
            'Slug' => 'tecnologia',
            'Status' => 1,
            'Ordem' => 3,
            'Cor' => '#17a2b8',
            'Icone' => 'fas fa-microchip'
        ]);

        $this->insert('categoria', [
            'Nome' => 'Esportes',
            'Descricao' => 'Notícias esportivas e eventos esportivos',
            'Slug' => 'esportes',
            'Status' => 1,
            'Ordem' => 4,
            'Cor' => '#ffc107',
            'Icone' => 'fas fa-futbol'
        ]);

        $this->insert('categoria', [
            'Nome' => 'Cultura',
            'Descricao' => 'Notícias sobre cultura, arte e entretenimento',
            'Slug' => 'cultura',
            'Status' => 1,
            'Ordem' => 5,
            'Cor' => '#6f42c1',
            'Icone' => 'fas fa-palette'
        ]);

        $this->insert('categoria', [
            'Nome' => 'Saúde',
            'Descricao' => 'Notícias sobre saúde, medicina e bem-estar',
            'Slug' => 'saude',
            'Status' => 1,
            'Ordem' => 6,
            'Cor' => '#e83e8c',
            'Icone' => 'fas fa-heartbeat'
        ]);

        $this->insert('categoria', [
            'Nome' => 'Educação',
            'Descricao' => 'Notícias sobre educação e ensino',
            'Slug' => 'educacao',
            'Status' => 1,
            'Ordem' => 7,
            'Cor' => '#fd7e14',
            'Icone' => 'fas fa-graduation-cap'
        ]);

        $this->insert('categoria', [
            'Nome' => 'Meio Ambiente',
            'Descricao' => 'Notícias sobre meio ambiente e sustentabilidade',
            'Slug' => 'meio-ambiente',
            'Status' => 1,
            'Ordem' => 8,
            'Cor' => '#20c997',
            'Icone' => 'fas fa-leaf'
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('categoria');
    }
} 