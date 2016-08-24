<?php

namespace app\controllers;

use yii\filters\VerbFilter;

class SindicatoController extends \yii\web\Controller
{
    
    public function actionIndex()
    {
        return $this->render('index');
    }

}