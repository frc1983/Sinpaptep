<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Convencao;
use app\models\CategoriaConvencao;

class ConvencoesController extends Controller
{
    public function actionIndex()
    {
        $modelSindipaineis = Convencao::find()->where('Id_Categoria_Convencao = :id_categoria',[':id_categoria' => 1])->orderBy('id desc')->all();
        $modelAgencias = Convencao::find()->where('Id_Categoria_Convencao = :id_categoria',[':id_categoria' => 2])->orderBy('id desc')->all();
        $modelSindilistas = Convencao::find()->where('Id_Categoria_Convencao = :id_categoria',[':id_categoria' => 3])->orderBy('id desc')->all();
        return $this->render('index', [
                'paineis' => ["titulo" => "Sindipainéis", "documentos" => $modelSindipaineis],
                'agencias' => ["titulo" => "Agências", "documentos" => $modelAgencias],
                'listas' => ["titulo" => "Sindilistas", "documentos" => $modelSindilistas],
            ]);
    }
}
