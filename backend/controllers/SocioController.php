<?php
namespace backend\controllers;

use Yii;
use common\models\Socio;
use common\models\SocioDadosEmpresa;
use common\models\SocioEndereco;
use common\models\SocioFilho;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

class SocioController extends Controller
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
            'query' => Socio::find(),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionView($id)
    {
        $socio = $this->findModel($id);
        $empresa = SocioDadosEmpresa::findOne(['Id_Socio' => $id]);
        $endereco = SocioEndereco::findOne(['Id_Socio' => $id]);
        $filhos = SocioFilho::findAll(['Id_Socio' => $id]);
        return $this->render('view', compact('socio', 'empresa', 'endereco', 'filhos'));
    }

    public function actionCreate()
    {
        $socio = new Socio();
        $empresa = new SocioDadosEmpresa();
        $endereco = new SocioEndereco();
        $filhos = [new SocioFilho()];
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $socio->load($post);
            $empresa->load($post);
            $endereco->load($post);
            $filhosData = $post['SocioFilho'] ?? [];
            $filhos = [];
            foreach ($filhosData as $filhoData) {
                $f = new SocioFilho();
                $f->load(['SocioFilho' => $filhoData]);
                $filhos[] = $f;
            }
            $valid = $socio->validate() && $empresa->validate() && $endereco->validate();
            foreach ($filhos as $f) {
                $valid = $f->validate() && $valid;
            }
            if ($valid) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if (!$socio->save(false)) throw new \Exception('Erro ao salvar sócio');
                    $empresa->Id_Socio = $socio->Id;
                    $endereco->Id_Socio = $socio->Id;
                    if (!$empresa->save(false)) throw new \Exception('Erro ao salvar empresa');
                    if (!$endereco->save(false)) throw new \Exception('Erro ao salvar endereço');
                    foreach ($filhos as $f) {
                        $f->Id_Socio = $socio->Id;
                        if (!$f->save(false)) throw new \Exception('Erro ao salvar filho');
                    }
                    $transaction->commit();
                    Yii::$app->session->setFlash('success', 'Sócio cadastrado com sucesso!');
                    return $this->redirect(['view', 'id' => $socio->Id]);
                } catch (\Exception $e) {
                    $transaction->rollBack();
                    Yii::$app->session->setFlash('error', 'Erro ao salvar cadastro: ' . $e->getMessage());
                }
            }
        }
        return $this->render('form', compact('socio', 'empresa', 'endereco', 'filhos'));
    }

    public function actionUpdate($id)
    {
        $socio = $this->findModel($id);
        $empresa = SocioDadosEmpresa::findOne(['Id_Socio' => $id]) ?? new SocioDadosEmpresa();
        $endereco = SocioEndereco::findOne(['Id_Socio' => $id]) ?? new SocioEndereco();
        $filhos = SocioFilho::findAll(['Id_Socio' => $id]);
        if (!$filhos) $filhos = [new SocioFilho()];
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $socio->load($post);
            $empresa->load($post);
            $endereco->load($post);
            $filhosData = $post['SocioFilho'] ?? [];
            $filhos = [];
            foreach ($filhosData as $filhoData) {
                $f = new SocioFilho();
                $f->load(['SocioFilho' => $filhoData]);
                $filhos[] = $f;
            }
            $valid = $socio->validate() && $empresa->validate() && $endereco->validate();
            foreach ($filhos as $f) {
                $valid = $f->validate() && $valid;
            }
            if ($valid) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if (!$socio->save(false)) throw new \Exception('Erro ao salvar sócio');
                    $empresa->Id_Socio = $socio->Id;
                    $endereco->Id_Socio = $socio->Id;
                    if (!$empresa->save(false)) throw new \Exception('Erro ao salvar empresa');
                    if (!$endereco->save(false)) throw new \Exception('Erro ao salvar endereço');
                    SocioFilho::deleteAll(['Id_Socio' => $socio->Id]);
                    foreach ($filhos as $f) {
                        $f->Id_Socio = $socio->Id;
                        if (!$f->save(false)) throw new \Exception('Erro ao salvar filho');
                    }
                    $transaction->commit();
                    Yii::$app->session->setFlash('success', 'Sócio atualizado com sucesso!');
                    return $this->redirect(['view', 'id' => $socio->Id]);
                } catch (\Exception $e) {
                    $transaction->rollBack();
                    Yii::$app->session->setFlash('error', 'Erro ao atualizar cadastro: ' . $e->getMessage());
                }
            }
        }
        return $this->render('form', compact('socio', 'empresa', 'endereco', 'filhos'));
    }

    public function actionDelete($id)
    {
        $socio = $this->findModel($id);
        SocioDadosEmpresa::deleteAll(['Id_Socio' => $id]);
        SocioEndereco::deleteAll(['Id_Socio' => $id]);
        SocioFilho::deleteAll(['Id_Socio' => $id]);
        $socio->delete();
        Yii::$app->session->setFlash('success', 'Sócio excluído com sucesso!');
        return $this->redirect(['index']);
    }

    public function actionImprimir($id)
    {
        $socio = $this->findModel($id);
        $empresa = \common\models\SocioDadosEmpresa::findOne(['Id_Socio' => $id]);
        $endereco = \common\models\SocioEndereco::findOne(['Id_Socio' => $id]);
        $filhos = \common\models\SocioFilho::findAll(['Id_Socio' => $id]);
        $this->layout = false;
        return $this->render('imprimir', compact('socio', 'empresa', 'endereco', 'filhos'));
    }

    protected function findModel($id)
    {
        if (($model = Socio::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('O sócio não foi encontrado.');
    }
} 