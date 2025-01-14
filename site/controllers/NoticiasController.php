<?php


namespace app\controllers;

use app\models\Noticia;


class NoticiasController extends \yii\web\Controller
{
    
    public function actionNoticia($id)
    {
        $model = Noticia::findOne($id);
        
        return $this->render('index', ['noticia' => $model]);
    }

}