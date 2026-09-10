<?php

namespace app\controllers;

use Yii;
use app\models\Parceiro;
use app\models\ParceiroSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ParceiroController implements the CRUD actions for Parceiro model.
 */
class ParceiroController extends Controller
{
    private $DIR = '../uploads/parceiros/';
    
    public function behaviors()
    {
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

    /**
     * Lists all Parceiro models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ParceiroSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Parceiro model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Parceiro model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Parceiro();
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

    /**
     * Updates an existing Parceiro model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
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

    /**
     * Deletes an existing Parceiro model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $this->removeFile($model->Logo);
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Parceiro model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Parceiro the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Parceiro::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    private function saveFile($model) {
        $model->Image = UploadedFile::getInstance($model, 'Image');
        $path = $this->DIR . $model->Id . '.' . $model->Image->extension;
        $model->Image->saveAs($path);
        $model->Logo = $path;
    }

    private function removeFile($path){
        if($path != "" && file_exists($path)){
            unlink($path);
        }
    }
}