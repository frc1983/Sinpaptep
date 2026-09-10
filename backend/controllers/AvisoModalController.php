<?php

namespace backend\controllers;

use Yii;
use common\models\AvisoModal;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class AvisoModalController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                    'ativar' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => AvisoModal::find()->orderBy(['Id' => SORT_DESC]),
            'pagination' => ['pageSize' => 20],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new AvisoModal();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Aviso criado com sucesso!');
            return $this->redirect(['view', 'id' => $model->Id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Aviso atualizado com sucesso!');
            return $this->redirect(['view', 'id' => $model->Id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', 'Aviso excluído.');
        return $this->redirect(['index']);
    }

    /**
     * Ativa um aviso específico e desativa os demais.
     */
    public function actionAtivar($id)
    {
        $model = $this->findModel($id);
        $model->Ativo = true;
        $model->save();
        Yii::$app->session->setFlash('success', "Aviso #{$id} ativado. Os demais foram desativados.");
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = AvisoModal::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('O aviso não foi encontrado.');
    }
}
