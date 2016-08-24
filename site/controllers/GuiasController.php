<?php

namespace app\controllers;

class GuiasController extends \yii\web\Controller
{
    public function actionAssistencial()
    {
        return $this->render('assistencial');
    }
    
    public function actionSindical()
    {
        return $this->render('sindical');
    }
}
