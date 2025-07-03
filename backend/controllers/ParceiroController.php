<?php

namespace backend\controllers;

use common\models\Parceiro;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use Yii;

/**
 * ParceiroController implements the CRUD actions for Parceiro model.
 */
class ParceiroController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Parceiro models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new Parceiro();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Parceiro model.
     * @param int $Id Id
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($Id)
    {
        return $this->render('view', [
            'model' => $this->findModel($Id),
        ]);
    }

    /**
     * Creates a new Parceiro model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Parceiro();

        if ($this->request->isPost) {
            $post = $this->request->post();
            if (isset($post['Parceiro'])) {
                unset($post['Parceiro']['created_at'], $post['Parceiro']['updated_at']);
            }
            if ($model->load($post)) {
                $model->scenario = $model->isNewRecord ? 'create' : 'update';
                $model->logoFile = UploadedFile::getInstance($model, 'logoFile');
                if (empty($model->logoFile)) {
                    $model->logoFile = null;
                }
                if ($model->logoFile) {
                    $model->upload();
                }
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Parceiro criado com sucesso!');
                    return $this->redirect(['view', 'Id' => $model->Id]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Parceiro model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $Id Id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($Id)
    {
        $model = $this->findModel($Id);

        if ($this->request->isPost) {
            $post = $this->request->post();
            if (isset($post['Parceiro'])) {
                unset($post['Parceiro']['created_at'], $post['Parceiro']['updated_at']);
            }
            if ($model->load($post)) {
                $model->scenario = $model->isNewRecord ? 'create' : 'update';
                $model->logoFile = UploadedFile::getInstance($model, 'logoFile');
                if (empty($model->logoFile)) {
                    $model->logoFile = null;
                }
                if ($model->logoFile) {
                    $model->upload();
                }
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Parceiro atualizado com sucesso!');
                    return $this->redirect(['view', 'Id' => $model->Id]);
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Parceiro model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $Id Id
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($Id)
    {
        $model = $this->findModel($Id);
        
        // Remover arquivo de logo se existir
        if ($model->Logo) {
            $logoPath = Yii::getAlias('@webroot/uploads/parceiros/') . $model->Logo;
            if (file_exists($logoPath)) {
                unlink($logoPath);
            }
        }
        
        $model->delete();
        Yii::$app->session->setFlash('success', 'Parceiro excluído com sucesso!');

        return $this->redirect(['index']);
    }

    /**
     * Finds the Parceiro model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $Id Id
     * @return Parceiro the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Id)
    {
        if (($model = Parceiro::findOne(['Id' => $Id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('O parceiro solicitado não foi encontrado.');
    }

    public function actionRemoverLogo($id)
    {
        $model = $this->findModel($id);
        if ($model->Logo) {
            $logoPath = Yii::getAlias('@webroot/uploads/parceiros/') . $model->Logo;
            if (file_exists($logoPath)) {
                unlink($logoPath);
            }
            $model->Logo = null;
            $model->save(false);
            Yii::$app->session->setFlash('success', 'Logo removido com sucesso!');
        }
        return $this->redirect(['update', 'Id' => $model->Id]);
    }
} 