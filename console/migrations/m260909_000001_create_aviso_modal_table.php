<?php

use yii\db\Migration;

/**
 * Cria a tabela Aviso_Modal para gerenciamento dos comunicados exibidos no modal da home
 */
class m260909_000001_create_aviso_modal_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('Aviso_Modal', [
            'Id'        => $this->primaryKey(),
            'Titulo'    => $this->string(255)->notNull()->comment('Título exibido no cabeçalho do modal'),
            'Conteudo'  => $this->text()->notNull()->comment('Conteúdo HTML do aviso'),
            'Ativo'     => $this->boolean()->notNull()->defaultValue(true)->comment('Apenas um aviso ativo é exibido no site'),
            'Criado_Em' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'Atualizado_Em' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ]);

        // Insere o aviso atual (conteúdo que estava fixo no index.php)
        $this->insert('Aviso_Modal', [
            'Titulo'   => 'COMUNICADO DA DIRETORIA',
            'Conteudo' => '<h3 class="text-center mb-4">CONTRAPONTO DO SINDICATO DOS PUBLICITÁRIOS DO RS AO COMUNICADO DO SINAPRO-RS</h3>

<p>Em resposta ao comunicado publicado pelo Sindicato Patronal – SINAPRO-RS em seu site, o Sindicato dos Publicitários do Estado do Rio Grande do Sul vem a público prestar os seguintes esclarecimentos aos trabalhadores da categoria:</p>

<p>O Sindicato dos Publicitários do RS encaminhou ao SINAPRO-RS, em <strong>25 de março de 2026</strong>, a pauta de reivindicações para as negociações da <strong>Convenção Coletiva de Trabalho 2026/2027</strong>, dando início formal ao processo de negociação coletiva.</p>

<p>Posteriormente, em <strong>28 de abril de 2026</strong>, o Sindicato Patronal encaminhou e-mail manifestando sua concordância com a manutenção da data-base em <strong>1º de maio</strong>, o que permitiu o prosseguimento das tratativas.</p>

<p>Em <strong>12 de maio de 2026</strong>, ocorreu a primeira e única reunião entre as entidades. Na oportunidade, o SINAPRO-RS solicitou que o Sindicato dos Publicitários indicasse algumas das cláusulas constantes da pauta para que pudessem ser priorizadas nas negociações.</p>

<p>Embora a pauta apresentada fosse composta por <strong>38 cláusulas</strong>, o Sindicato dos Publicitários, buscando facilitar o entendimento e possibilitar o avanço das negociações, selecionou e encaminhou ao Sindicato Patronal <strong>12 cláusulas consideradas prioritárias</strong>, justamente com o objetivo de encontrar pontos de consenso e dar continuidade ao processo negocial.</p>

<p>Entretanto, em <strong>12 de junho de 2026</strong>, o SINAPRO-RS informou, por e-mail, que não poderia agendar nova reunião em razão de um de seus diretores estar submetido a procedimento cirúrgico.</p>

<p>Demonstrando disposição para solucionar o impasse, em <strong>15 de junho de 2026</strong>, o Sindicato dos Publicitários encaminhou novo e-mail ao presidente do SINAPRO-RS, solicitando o agendamento de uma reunião para a retomada e conclusão das negociações. Não houve qualquer resposta ao pedido.</p>

<div class="card border-success shadow-sm mt-4 mb-4">
    <div class="card-header text-white" style="background-color:#206839;">
        <h5 class="mb-0"><i class="fas fa-bullhorn me-2"></i>Esclarecimento à categoria</h5>
    </div>
    <div class="card-body">
        <p>Diante da ausência de retorno e da paralisação das negociações, o Sindicato dos Publicitários buscou uma alternativa institucional para solucionar o impasse, requerendo mediação junto à <strong>Superintendência Regional do Trabalho</strong>, sob o protocolo <strong>SM003742/2026</strong>.</p>
        <p class="mb-0">Contudo, a tentativa de mediação também não pôde avançar, em razão de a diretoria do Sindicato Patronal apresentar irregularidade em seu registro, situação que impediu o prosseguimento da mediação naquele momento.</p>
    </div>
</div>

<p>Assim, é importante esclarecer à categoria que o Sindicato dos Publicitários do RS <strong>não se omitiu e tampouco deixou de buscar o diálogo</strong>. Pelo contrário: apresentou a pauta dentro do prazo, participou da reunião realizada, atendeu à solicitação do Sindicato Patronal, reduziu a pauta de 38 para 12 cláusulas prioritárias, solicitou formalmente a retomada das negociações e, diante da ausência de resposta, buscou inclusive a mediação junto ao órgão competente.</p>

<p>A paralisação das negociações, portanto, <strong>não pode ser atribuída à falta de iniciativa ou de disposição do Sindicato dos Publicitários do RS.</strong></p>

<p>Nosso compromisso continua sendo com a defesa dos direitos e interesses dos trabalhadores da categoria, com a valorização profissional e com a construção de uma Convenção Coletiva que assegure avanços nas condições de trabalho.</p>

<p>Seguiremos buscando todos os meios legais e institucionais necessários para que as negociações sejam retomadas e para que a categoria não fique sem uma solução para a <strong>Convenção Coletiva 2026/2027.</strong></p>

<hr>

<p class="text-center mb-0 assinatura"><strong>Sindicato dos Publicitários do Estado do Rio Grande do Sul</strong><br>Porto Alegre, 15 de agosto de 2026.</p>',
            'Ativo' => true,
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('Aviso_Modal');
    }
}
