<?php
namespace backend\controllers;

use yii\web\Controller;

class BoletosController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
} 