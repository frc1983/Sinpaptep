<?php
/* @var $this yii\web\View */

use yii\helpers\Html
?>
<h1>Contribuição Sindical</h1>
<h3>Passo a passo para gerar Guia Sindical:</h3>
<p>1º Acesse o seguinte link do site da Caixa: <a href='http://sindical.caixa.gov.br' target="_blank">http://sindical.caixa.gov.br</a>, escolha a opção “Contribuinte” e clique em “Continuar”.</p>
<p>
    <?php echo Html::img('@web/images/passo-1.jpg', ['class' => 'img-responsive']); ?>
</p>
<p>2º Insira o código colorido e confirme.</p>
<p>
    <?php echo Html::img('@web/images/passo-2.jpg', ['class' => 'img-responsive']); ?>
</p>
<p>3º Clique no link “Incluir guia”, presente no menu localizado a esquerda.</p>
<p>
    <?php echo Html::img('@web/images/passo-3.jpg', ['class' => 'img-responsive']); ?>
</p>
<p>4º Neste passo serão solicitados os dados do Sindicato, preencher com as seguintes informações.<br>
    Em Tipo de identificação, selecione uma das seguintes opções CNPJ ou Código da Entidade.<br>
    Caso escolha a opção CNPJ, preencha o campo seguinte com o seguinte número: <strong class="text-danger">90.900.127/0001-50.</strong><br>
    Caso tenha optado por informar o Código da Entidade informe os seguintes dígitos: <strong class="text-danger">01257</strong>.<br>
    Em Grau da Entidade, selecione “Sindicato” e confirme.
</p>
<p>
    <?php echo Html::img('@web/images/passo-4.jpg', ['class' => 'img-responsive']); ?>
</p>
<p>5º No passo seguinte serão exibidos os dados do sindicato, apenas confirme.</p>
<p>
    <?php echo Html::img('@web/images/passo-5.jpg', ['class' => 'img-responsive']); ?>
</p>
<p>6º Agora basta preencher o formulário com as informações solicitadas e confirmar.<br>
    Obs: Quando for solicitado o código de atividade digitar <strong class="text-danger">942</strong>.</p>
<p>
    <?php echo Html::img('@web/images/passo-6.jpg', ['class' => 'img-responsive']); ?>
</p>
