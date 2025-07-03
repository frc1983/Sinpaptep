<?php

/** @var yii\web\View $this */
/** @var common\models\User $user */

$verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['site/verify-email', 'token' => $user->verification_token]);
?>
Olá <?= $user->username ?>,

Para ativar sua conta, acesse o link abaixo para verificar seu e-mail:

<?= $verifyLink ?>
