<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use unclead\multipleinput\MultipleInput;

/* @var $this yii\web\View */
/* @var $model app\models\Socio */
/* @var $form ActiveForm */
?>
<div class="socios-index">

    <?php
    $estadosBrasileiros = array(
        'AC' => 'Acre',
        'AL' => 'Alagoas',
        'AP' => 'Amapá',
        'AM' => 'Amazonas',
        'BA' => 'Bahia',
        'CE' => 'Ceará',
        'DF' => 'Distrito Federal',
        'ES' => 'Espírito Santo',
        'GO' => 'Goiás',
        'MA' => 'Maranhão',
        'MT' => 'Mato Grosso',
        'MS' => 'Mato Grosso do Sul',
        'MG' => 'Minas Gerais',
        'PA' => 'Pará',
        'PB' => 'Paraíba',
        'PR' => 'Paraná',
        'PE' => 'Pernambuco',
        'PI' => 'Piauí',
        'RJ' => 'Rio de Janeiro',
        'RN' => 'Rio Grande do Norte',
        'RS' => 'Rio Grande do Sul',
        'RO' => 'Rondônia',
        'RR' => 'Roraima',
        'SC' => 'Santa Catarina',
        'SP' => 'São Paulo',
        'SE' => 'Sergipe',
        'TO' => 'Tocantins'
    );
    $escolaridade = array(
        'Ensino Fundamental' => 'Ensino Fundamental (1º Grau)',
        'Ensino Médio' => 'Ensino Médio (2º Grau)',
        'Ensino Técnico' => 'Ensino Técnico',
        'Superior' => 'Superior',
        'Pós-graduação' => 'Pós-graduação',
        'Mestrado' => 'Mestrado',
        'Doutorado' => 'Doutorado'
    );
    ?>
    <h1>Ficha de Sócio</h1>
    <h4>Preencha o formulário abaixo para associar-se.</h4>

    <?php if ($sucesso) { ?>
        <div class="alert alert-success" role="alert">
            <?php echo $mensagem ?>
        </div>
    <?php } else if (!$sucesso && $mensagem != "") { ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $mensagem ?>
        </div>
    <?php } ?>


    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <?= $form->field($model, 'Nome', ['options' => ['class' => 'col-md-8']]) ?>
        <?=
        $form->field($model, 'CPF', ['options' => ['class' => 'col-sm-4']])->widget(\yii\widgets\MaskedInput::className(), [
            'mask' => '99999999999'
        ])->label('CPF')
        ?>
    </div>
    <div class="row">
        <?= $form->field($model, 'CidadeNascimento', ['options' => ['class' => 'col-md-4']])->label('Cidade de Nascimento') ?>
        <?=
        $form->field($model, 'DataNascimento', ['options' => ['class' => 'col-md-4']])->widget(\kartik\date\DatePicker::className(), [
            'value' => date('Y-m-d', strtotime('+2 days')),
            'options' => [],
            'pluginOptions' => [
                'format' => 'dd/mm/yyyy',
                'todayHighlight' => true
            ]
        ])->label('Data de Nascimento')
        ?>
        <?= $form->field($model, 'EstadoCivil', ['options' => ['class' => 'col-md-4']])->label('Estado Civíl') ?>
    </div>
    <div class="row">
        <?= $form->field($model, 'Nacionalidade', ['options' => ['class' => 'col-md-4']]) ?>
        <?= $form->field($model, 'Identidade', ['options' => ['class' => 'col-md-4']]) ?>
        <?= $form->field($model, 'OrgaoEmissor', ['options' => ['class' => 'col-md-4']])->label('Orgão Emissor') ?>
    </div>
    <div class="row">
        <?= $form->field($model, 'NomeMae', ['options' => ['class' => 'col-md-6']])->label('Nome da Mãe') ?>
        <?= $form->field($model, 'NomePai', ['options' => ['class' => 'col-md-6']])->label('Nome do Pai') ?>
    </div>
    <div class="row">
        <?= $form->field($model, 'NomeConjuge', ['options' => ['class' => 'col-md-8']])->label('Nome do Cônjuge') ?>
        <?=
        $form->field($model, 'DataNascimentoConjuge', ['options' => ['class' => 'col-md-4']])->widget(\kartik\date\DatePicker::className(), [
            'value' => date('Y-m-d', strtotime('+2 days')),
            'options' => [],
            'pluginOptions' => [
                'format' => 'dd/mm/yyyy',
                'todayHighlight' => true
            ]
        ])->label('Data de Nascimento do Cônjuge')
        ?>
    </div>
    <div class="row">
        <?= $form->field($model, 'TituloEleitor', ['options' => ['class' => 'col-md-6']])->label('Nº Título de Eleitor') ?>    
        <?= $form->field($model, 'UFTituloEleitor', ['options' => ['class' => 'col-md-2']])->dropDownList($estadosBrasileiros)->label('UF')->label('UF Título de Eleitor') ?>
        <?=
        $form->field($model, 'DataExpiracaoTituloEleitor', ['options' => ['class' => 'col-md-4']])->widget(\kartik\date\DatePicker::className(), [
            'value' => date('Y-m-d', strtotime('+2 days')),
            'options' => [],
            'pluginOptions' => [
                'format' => 'dd/mm/yyyy',
                'todayHighlight' => true
            ]
        ])->label('Data de Expiração')
        ?>    
    </div>
    <div class="row">
        <?= $form->field($endereco, 'Logradouro', ['options' => ['class' => 'col-md-6']]) ?> 
        <?= $form->field($endereco, 'Numero', ['options' => ['class' => 'col-md-2']])->label('Número') ?> 
        <?= $form->field($endereco, 'Complemento', ['options' => ['class' => 'col-md-4']]) ?> 
    </div>
    <div class="row">
        <?= $form->field($endereco, 'Bairro', ['options' => ['class' => 'col-md-4']]) ?> 
        <?= $form->field($endereco, 'Cidade', ['options' => ['class' => 'col-md-4']]) ?> 
        <?=
        $form->field($endereco, 'CEP', ['options' => ['class' => 'col-md-2']])->widget(\yii\widgets\MaskedInput::className(), [
            'mask' => '99999999'
        ])->label('CEP')
        ?> 
        <?= $form->field($endereco, 'UF', ['options' => ['class' => 'col-md-2']])->dropDownList($estadosBrasileiros)->label('UF') ?> 
    </div>
    <div class="row">
        <?=
        $form->field($endereco, 'Telefone', ['options' => ['class' => 'col-md-4']])->widget(\yii\widgets\MaskedInput::className(), [
            'mask' => '(99) 99999-9999'
        ])
        ?> 
        <?=
        $form->field($endereco, 'Celular', ['options' => ['class' => 'col-md-4']])->widget(\yii\widgets\MaskedInput::className(), [
            'mask' => '(99) 99999-9999'
        ])
        ?>
        <?= $form->field($endereco, 'Email', ['options' => ['class' => 'col-md-4']]) ?>        
    </div>

    <h3>Filhos</h3>
    <?=
    $form->field($model, 'socioFilhos')->widget(MultipleInput::className(), [
        'columns' => [
            [
                'name' => 'Nome',
                'title' => 'Nome do Filho',
                'enableError' => true,
                'options' => [
                    'class' => ''
                ],
                'headerOptions' => [
                    'class' => 'col-sm-12 col-md-8'
                ]
            ],
            [
                'name' => 'DataNascimento',
                'type' => \kartik\date\DatePicker::className(),
                'title' => 'Data de Nascimento',
                'options' => [
                    'pluginOptions' => [
                        'format' => 'dd/mm/yyyy',
                        'todayHighlight' => true
                    ]
                ],
                'headerOptions' => [
                    'class' => 'col-sm-12 col-md-4'
                ]
            ]
        ]
    ])->label(false);
    ?>

    <h3>Dados Profissionais</h3>
    <div class="row">
        <?= $form->field($empresa, 'Nome', ['options' => ['class' => 'col-md-12']])->label("Nome da Empresa") ?> 
    </div>
    <div class="row">
        <?= $form->field($empresa, 'Logradouro', ['options' => ['class' => 'col-md-6']]) ?> 
        <?= $form->field($empresa, 'Numero', ['options' => ['class' => 'col-md-3']])->label('Número') ?> 
        <?= $form->field($empresa, 'Complemento', ['options' => ['class' => 'col-md-3']]) ?> 
    </div>
    <div class="row">
        <?= $form->field($empresa, 'Bairro', ['options' => ['class' => 'col-md-4']]) ?> 
        <?= $form->field($empresa, 'Cidade', ['options' => ['class' => 'col-md-4']]) ?> 
        <?=
        $form->field($empresa, 'CEP', ['options' => ['class' => 'col-md-2']])->widget(\yii\widgets\MaskedInput::className(), [
            'mask' => '99999999'
        ])->label('CEP')
        ?> 
        <?= $form->field($empresa, 'UF', ['options' => ['class' => 'col-md-2']])->dropDownList($estadosBrasileiros)->label('UF') ?> 
    </div>
    <div class="row">
        <?=
        $form->field($empresa, 'Telefone', ['options' => ['class' => 'col-md-4']])->widget(\yii\widgets\MaskedInput::className(), [
            'mask' => '(99) 99999-9999'
        ])
        ?> 
        <?=
        $form->field($empresa, 'Celular', ['options' => ['class' => 'col-md-4']])->widget(\yii\widgets\MaskedInput::className(), [
            'mask' => '(99) 99999-9999'
        ])
        ?> 
        <?= $form->field($empresa, 'Email', ['options' => ['class' => 'col-md-4']]) ?> 
    </div>
    <div class="row">
        <?= $form->field($empresa, 'CargoAtual', ['options' => ['class' => 'col-md-8']])->label('Cargo Atual') ?> 
        <?=
        $form->field($empresa, 'DataInicioCargoAtual', ['options' => ['class' => 'col-md-4']])->widget(\kartik\date\DatePicker::className(), [
            'value' => date('d-M-Y', strtotime('+2 days')),
            'options' => [],
            'pluginOptions' => [
                'format' => 'dd/mm/yyyy',
                'todayHighlight' => true
            ]
        ])->label('Data de Início')
        ?> 
    </div>
    <div class="row">
        <?= $form->field($empresa, 'NumeroCTPS', ['options' => ['class' => 'col-md-3']])->label('Número da CTPS') ?> 
        <?= $form->field($empresa, 'SerieCTPS', ['options' => ['class' => 'col-md-3']])->label('Série da CTPS') ?> 
        <?= $form->field($empresa, 'NumeroRegistroAutonomo', ['options' => ['class' => 'col-md-3']])->label('Nº Registro Autônomo') ?> 
        <?= $form->field($empresa, 'NumeroRegistroDRTE', ['options' => ['class' => 'col-md-3']])->label('Nº Registro DRTE') ?>
    </div>
    <div class="row">
        <?= $form->field($empresa, 'GrauInstrucao', ['options' => ['class' => 'col-md-4']])->label('Grau de Instrução')->dropDownList($escolaridade) ?> 
        <?= $form->field($empresa, 'Observacoes', ['options' => ['class' => 'col-md-8']])->label('Observações') ?>     
    </div>
    <div class="form-group dontprint">
        <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- socios-index -->
