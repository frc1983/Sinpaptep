<?php
/* @var $this yii\web\View */

use yii\widgets\MaskedInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php if (Yii::$app->session->hasFlash('success')): ?>
    <div class="alert alert-success">
        <?= Yii::$app->session->getFlash('success'); ?>
    </div>
<?php else: ?>
    <div class="alert alert-error">
        <?= Yii::$app->session->getFlash('error'); ?>
    </div>
<?php endif; ?>

<h1>Contato</h1>

<p class="first justify">Para falar conosco você pode preencher o formulário ou 
    entrar em contato através de nosso telefone e e-mail abaixo.</p>
<br />
<div class="left col-md-5">
    <p><b>Fone/Fax:</b>(51) 3361.2495</p>
    <p><b>E-mail:</b><a href="mailto: sindicatopublicitariosrs@gmail.com"> 
            sindicatopublicitariosrs@gmail.com</a>
    </p>
    <p>
        <b>NOSSO ENDEREÇO:</b><br>
        Av. João Wallig, 518<br>
        Bairro Passo D’Areia <br>
        Porto Alegre, RS<br>
        CEP: 91340-000
    </p>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3454.728136331381!2d-51.16672698430695!3d-30.015961736914086!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x951977768f319573%3A0x3b7347e2bcd36ed7!2sSINPAPTEP+-+RS!5e0!3m2!1spt-BR!2sbr!4v1456774048145" width="640" height="480" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>
<!--div class="left col-md-7">
    <?php
    $form = ActiveForm::begin([
                'action' => ['send'],
                'method' => 'post',
                'id' => 'login-form',
                'options' => ['class' => 'form-horizontal'],
            ])
    ?>
    <?= $form->field($model, 'nome') ?>
    <?= $form->field($model, 'email')->input('email') ?>
    <?=
    $form->field($model, 'telefone')->widget(MaskedInput::className(), [
        'mask' => '(99)99999-9999',
        'options' => [
            'class' => 'form-control',
            'required' => '',
            'minlength' => '13',
            'type' => 'tel',
            'title' => 'Tamanho']
    ])
    ?>
    <?= $form->field($model, 'mensagem')->textarea(['rows' => '6']) ?>

    <div class="form-group">
        <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end() ?>

</div-->
