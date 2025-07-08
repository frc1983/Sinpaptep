<?php
namespace backend\controllers;

use Yii;
use common\models\Noticia;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

class NoticiaController extends Controller
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
            'query' => Noticia::find()
                ->select(['Noticia.*', 'Categoria_Noticia.Nome as CategoriaNome'])
                ->leftJoin('Categoria_Noticia', 'Noticia.Id_Categoria = Categoria_Noticia.Id')
                ->with(['imagens']),
            'sort' => [
                'defaultOrder' => ['Id' => SORT_DESC],
                'attributes' => [
                    'Id' => [
                        'asc' => ['Noticia.Id' => SORT_ASC],
                        'desc' => ['Noticia.Id' => SORT_DESC],
                        'default' => SORT_DESC,
                        'label' => 'ID',
                    ],
                    'Titulo' => [
                        'asc' => ['Noticia.Titulo' => SORT_ASC],
                        'desc' => ['Noticia.Titulo' => SORT_DESC],
                        'default' => SORT_ASC,
                        'label' => 'Título',
                    ],
                    'Sub_Titulo' => [
                        'asc' => ['Noticia.Sub_Titulo' => SORT_ASC],
                        'desc' => ['Noticia.Sub_Titulo' => SORT_DESC],
                        'default' => SORT_ASC,
                        'label' => 'Subtítulo',
                    ],
                    'categoria' => [
                        'asc' => ['Categoria_Noticia.Nome' => SORT_ASC],
                        'desc' => ['Categoria_Noticia.Nome' => SORT_DESC],
                        'default' => SORT_ASC,
                        'label' => 'Categoria',
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
        $model = new Noticia();
        if ($model->load(Yii::$app->request->post())) {
            $model->imagemFile = UploadedFile::getInstances($model, 'imagemFile');
            if ($model->save(false)) {
                if ($model->imagemFile) {
                    foreach ($model->imagemFile as $file) {
                        $caminho = 'uploads/noticias/' . uniqid() . '.' . $file->extension;
                        $file->saveAs(Yii::getAlias('@backend/web/') . $caminho);
                        $imagem = new \common\models\Imagem();
                        $imagem->Id_Noticia = $model->Id;
                        $imagem->Url = $caminho;
                        $imagem->save(false);
                    }
                }
                return $this->redirect(['view', 'id' => $model->Id]);
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
            $model->imagemFile = UploadedFile::getInstances($model, 'imagemFile');
            if ($model->save(false)) {
                if ($model->imagemFile) {
                    foreach ($model->imagemFile as $file) {
                        $caminho = 'uploads/noticias/' . uniqid() . '.' . $file->extension;
                        $file->saveAs(Yii::getAlias('@backend/web/') . $caminho);
                        $imagem = new \common\models\Imagem();
                        $imagem->Id_Noticia = $model->Id;
                        $imagem->Url = $caminho;
                        $imagem->save(false);
                    }
                }
                return $this->redirect(['view', 'id' => $model->Id]);
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

    public function actionRemoverImagem($id)
    {
        $imagem = \common\models\Imagem::findOne($id);
        if ($imagem) {
            $filePath = Yii::getAlias('@backend/web/') . $imagem->Url;
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            $noticiaId = $imagem->Id_Noticia;
            $imagem->delete();
            Yii::$app->session->setFlash('success', 'Imagem removida com sucesso!');
            return $this->redirect(['update', 'id' => $noticiaId]);
        }
        throw new NotFoundHttpException('Imagem não encontrada.');
    }

    protected function findModel($id)
    {
        if (($model = Noticia::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('A notícia não foi encontrada.');
    }
} 