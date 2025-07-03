<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;

$this->title = 'Editar Notícia: ' . $model->Titulo;
?>
<h1><?= Html::encode($this->title) ?></h1>
<div class="noticia-update">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <?= $form->field($model, 'Id_Categoria')->dropDownList(\common\models\Categoria::find()->select(['Nome', 'Id'])->indexBy('Id')->column(), ['prompt' => 'Selecione uma categoria']) ?>
    <?= $form->field($model, 'Titulo')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'Sub_Titulo')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'Texto')->widget(TinyMce::class, [
        'options' => ['rows' => 10],
        'language' => 'pt_BR',
        'clientOptions' => [
            'plugins' => [
                'advlist autolink lists link charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
            ],
            'toolbar' => 'undo redo | formatselect | bold italic backcolor | \
                alignleft aligncenter alignright alignjustify | \
                bullist numlist outdent indent | removeformat | help',
        ],
    ]) ?>
    <?php if ($model->imagens): ?>
        <div class="mb-3">
            <label>Imagens atuais:</label><br>
            <?php foreach ($model->imagens as $img): ?>
                <div style="display:inline-block;margin:5px;">
                    <img src="<?= Yii::getAlias('@web') . '/' . $img->Url ?>" style="max-width:120px;max-height:120px;display:block;">
                    <a href="<?= Yii::$app->urlManager->createUrl(['/noticia/remover-imagem', 'id' => $img->Id]) ?>" class="btn btn-sm btn-danger mt-1" onclick="return confirm('Remover esta imagem?')">Remover</a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <?= $form->field($model, 'imagemFile[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div> 