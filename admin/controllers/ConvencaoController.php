<?php

namespace app\controllers;

use Yii;
use app\models\Convencao;
use app\models\ConvencaoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

class ConvencaoController extends Controller {

    private $DIR = '../uploads/convencoes/';

    public function behaviors() {
        return [
	    'access' => [
                'class' => \yii\filters\AccessControl::className(),
                //'only' => ['create','update','delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex() {
        $searchModel = new ConvencaoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate() {
        $model = new Convencao();
        $transaction = Yii::$app->db->beginTransaction();

        try {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {   
   		$this->saveFile($model);
	        $model->save();
	        $transaction->commit();
	
	        return $this->redirect('index');
            } else {
                return $this->render('create', [
                            'model' => $model,
                ]);
            }
        } catch (Exception $e) {
            $transaction->rollBack();
        }
    }

    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $transaction = Yii::$app->db->beginTransaction();
	
        try {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $this->saveFile($model);
                $model->save();
                $transaction->commit();

                return $this->redirect(['index']);
            } else {
                return $this->render('update', [
                            'model' => $model,
                ]);
            }
        } catch (Exception $e) {
            $transaction->rollBack();
        }
    }

    public function actionDelete($id) {
        $model = $this->findModel($id);
        $this->removeFile($model->Url);
        $model->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id) {
        if (($model = Convencao::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    private function saveFile($model) {
        $model->Image = UploadedFile::getInstance($model, 'Image');
        $path = $this->DIR . $model->Id . '.' . $model->Image->extension;
        $model->Image->saveAs($path);
        $model->Url = $path;
    }

    private function removeFile($path){
        if($path != "" && file_exists($path)){
            unlink($path);
        }
    }
}