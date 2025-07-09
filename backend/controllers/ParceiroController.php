<?php

namespace backend\controllers;

use common\models\Parceiro;
use common\models\ParceiroImagem;
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
        $model = $this->findModel($Id);
        $imagens = ParceiroImagem::getImagensByParceiroId($Id);

        return $this->render('view', [
            'model' => $model,
            'imagens' => $imagens,
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
            try {
                $post = $this->request->post();
                if (isset($post['Parceiro'])) {
                    unset($post['Parceiro']['created_at'], $post['Parceiro']['updated_at']);
                }
                
                if ($model->load($post) && $model->save()) {
                    // Processar upload de imagens
                    $result = $this->processImageUploads($model->Id);
                    
                    if ($result['errors'] > 0) {
                        Yii::$app->session->setFlash('warning', "{$result['uploaded']} imagens salvas com sucesso. {$result['errors']} imagens não puderam ser salvas.");
                    } elseif ($result['uploaded'] > 0) {
                        Yii::$app->session->setFlash('success', "{$result['uploaded']} imagens salvas com sucesso!");
                    }
                    
                    Yii::$app->session->setFlash('success', 'Parceiro criado com sucesso!');
                    return $this->redirect(['view', 'Id' => $model->Id]);
                }
            } catch (\Exception $e) {
                Yii::error('Erro ao criar parceiro: ' . $e->getMessage());
                Yii::$app->session->setFlash('error', 'Erro ao criar parceiro: ' . $e->getMessage());
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
            try {
                $post = $this->request->post();
                if (isset($post['Parceiro'])) {
                    unset($post['Parceiro']['created_at'], $post['Parceiro']['updated_at']);
                }
                
                if ($model->load($post) && $model->save()) {
                    // Processar upload de imagens
                    $result = $this->processImageUploads($model->Id);
                    
                    if ($result['errors'] > 0) {
                        Yii::$app->session->setFlash('warning', "{$result['uploaded']} imagens salvas com sucesso. {$result['errors']} imagens não puderam ser salvas.");
                    } elseif ($result['uploaded'] > 0) {
                        Yii::$app->session->setFlash('success', "{$result['uploaded']} imagens salvas com sucesso!");
                    }
                    
                    Yii::$app->session->setFlash('success', 'Parceiro atualizado com sucesso!');
                    return $this->redirect(['view', 'Id' => $model->Id]);
                }
            } catch (\Exception $e) {
                Yii::error('Erro ao atualizar parceiro: ' . $e->getMessage());
                Yii::$app->session->setFlash('error', 'Erro ao atualizar parceiro: ' . $e->getMessage());
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
        
        // Remover todas as imagens associadas
        $imagens = ParceiroImagem::getImagensByParceiroId($Id);
        foreach ($imagens as $imagem) {
            $imagem->delete(); // Isso também remove o arquivo físico
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





    /**
     * Processa o upload de múltiplas imagens
     * @param int $parceiroId
     * @return array ['uploaded' => int, 'errors' => int]
     */
    private function processImageUploads($parceiroId)
    {
        $uploadedCount = 0;
        $errorCount = 0;
        
        $imagemFiles = UploadedFile::getInstancesByName('Parceiro[imagemFile]');
        Yii::info('Arquivos recebidos: ' . print_r($imagemFiles, true));
        if ($imagemFiles && is_array($imagemFiles)) {
            foreach ($imagemFiles as $index => $file) {
                Yii::info("Arquivo recebido: {$file->name}, temp: {$file->tempName}, existe: " . (file_exists($file->tempName) ? 'sim' : 'nao'));
                try {
                    // Verificar se o arquivo é válido
                    if (!$file || !$file->tempName || !file_exists($file->tempName)) {
                        Yii::error("Arquivo inválido ou temporário não encontrado: índice {$index}");
                        $errorCount++;
                        continue;
                    }
                    
                    // Verificar se o arquivo não está vazio
                    if ($file->size === 0) {
                        Yii::error("Arquivo vazio: {$file->name}");
                        $errorCount++;
                        continue;
                    }
                    
                    $parceiroImagem = new ParceiroImagem();
                    $parceiroImagem->ParceiroId = $parceiroId;
                    $parceiroImagem->imagemFile = $file;
                    
                    // Primeiro faz o upload, depois salva
                    if ($parceiroImagem->upload()) {
                        if ($parceiroImagem->save(false)) {
                            $uploadedCount++;
                            Yii::info("Imagem salva com sucesso: {$file->name}");
                        } else {
                            $errorCount++;
                            Yii::error("Falha ao salvar no banco: {$file->name} - " . json_encode($parceiroImagem->errors));
                        }
                    } else {
                        $errorCount++;
                        Yii::error("Falha no upload: {$file->name}");
                    }
                } catch (\Exception $e) {
                    $errorCount++;
                    Yii::error("Erro ao salvar imagem {$file->name}: " . $e->getMessage());
                }
            }
        }
        
        return ['uploaded' => $uploadedCount, 'errors' => $errorCount];
    }

    /**
     * Remove uma imagem do parceiro
     * @param int $id
     * @return \yii\web\Response
     */
    public function actionRemoverImagem($id)
    {
        $model = ParceiroImagem::findOne($id);
        if ($model) {
            $parceiroId = $model->ParceiroId;
            $model->delete();
            Yii::$app->session->setFlash('success', 'Imagem removida com sucesso!');
            return $this->redirect(['view', 'Id' => $parceiroId]);
        }
        
        throw new NotFoundHttpException('Imagem não encontrada.');
    }
} 