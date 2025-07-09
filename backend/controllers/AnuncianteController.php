<?php
namespace backend\controllers;

use Yii;
use common\models\Anunciante;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

class AnuncianteController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Anunciante::find(),
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC],
                'attributes' => [
                    'id' => [
                        'asc' => ['id' => SORT_ASC],
                        'desc' => ['id' => SORT_DESC],
                        'default' => SORT_DESC,
                        'label' => 'ID',
                    ],
                    'nome' => [
                        'asc' => ['nome' => SORT_ASC],
                        'desc' => ['nome' => SORT_DESC],
                        'default' => SORT_ASC,
                        'label' => 'Nome',
                    ],
                    'link' => [
                        'asc' => ['link' => SORT_ASC],
                        'desc' => ['link' => SORT_DESC],
                        'default' => SORT_ASC,
                        'label' => 'Link',
                    ],
                ],
            ],
            'pagination' => [
                'pageSize' => 20,
            ],
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
        $model = new Anunciante();
        if ($model->load(Yii::$app->request->post())) {
            $model->bannerFile = UploadedFile::getInstance($model, 'bannerFile');
            if ($model->bannerFile) {
                $caminho = 'uploads/anunciantes/' . uniqid() . '.' . $model->bannerFile->extension;
                $model->bannerFile->saveAs(Yii::getAlias('@backend/web/') . $caminho);
                $model->banner = $caminho;
            }
            if ($model->save(false)) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            $model->bannerFile = UploadedFile::getInstance($model, 'bannerFile');
            if ($model->bannerFile) {
                $caminho = 'uploads/anunciantes/' . uniqid() . '.' . $model->bannerFile->extension;
                $model->bannerFile->saveAs(Yii::getAlias('@backend/web/') . $caminho);
                $model->banner = $caminho;
            }
            if ($model->save(false)) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Anunciante::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('O anunciante não foi encontrado.');
    }
} 