<?php

namespace app\controllers;

class InformacoesController extends \yii\web\Controller {

    public function actionTerceirizacao() {
        return $this->render('terceirizacao');
    }

    public function actionConsulta() {
        return $this->render('consulta');
    }

}
