<?php
namespace backend\controllers;

use Yii;
use common\models\Boleto;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BoletosController implements the CRUD actions for Boleto model.
 */
class BoletosController extends Controller
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
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Boleto models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Boleto::find(),
            'sort' => [
                'defaultOrder' => ['Id' => SORT_DESC],
                'attributes' => [
                    'Id' => [
                        'asc' => ['Id' => SORT_ASC],
                        'desc' => ['Id' => SORT_DESC],
                        'default' => SORT_DESC,
                        'label' => 'ID',
                    ],
                    'Nome' => [
                        'asc' => ['Nome' => SORT_ASC],
                        'desc' => ['Nome' => SORT_DESC],
                        'default' => SORT_ASC,
                        'label' => 'Nome',
                    ],
                    'CNPJ' => [
                        'asc' => ['CNPJ' => SORT_ASC],
                        'desc' => ['CNPJ' => SORT_DESC],
                        'default' => SORT_ASC,
                        'label' => 'CNPJ',
                    ],
                    'Valor' => [
                        'asc' => ['Valor' => SORT_ASC],
                        'desc' => ['Valor' => SORT_DESC],
                        'default' => SORT_ASC,
                        'label' => 'Valor',
                    ],
                    'DataVencimento' => [
                        'asc' => ['DataVencimento' => SORT_ASC],
                        'desc' => ['DataVencimento' => SORT_DESC],
                        'default' => SORT_ASC,
                        'label' => 'Vencimento',
                    ],
                    'Cidade' => [
                        'asc' => ['Cidade' => SORT_ASC],
                        'desc' => ['Cidade' => SORT_DESC],
                        'default' => SORT_ASC,
                        'label' => 'Cidade',
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

    /**
     * Displays a single Boleto model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Boleto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Boleto();

        if ($this->request->isPost) {
            $post = $this->request->post();
            if (isset($post['Boleto'])) {
                $post['Boleto']['Valor'] = $this->brToDecimal($post['Boleto']['Valor']);
                $post['Boleto']['Multa'] = $this->brToDecimal($post['Boleto']['Multa']);
                $post['Boleto']['DespesaBancaria'] = $this->brToDecimal($post['Boleto']['DespesaBancaria']);
                $post['Boleto']['CEP'] = $this->onlyNumbers($post['Boleto']['CEP']);
                $post['Boleto']['CNPJ'] = $this->onlyNumbers($post['Boleto']['CNPJ']);
            }
            if ($model->load($post) && $model->save()) {
                Yii::$app->session->setFlash('success', 'Boleto criado com sucesso!');
                return $this->redirect(['view', 'id' => $model->Id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Boleto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost) {
            $post = $this->request->post();
            if (isset($post['Boleto'])) {
                $post['Boleto']['Valor'] = $this->brToDecimal($post['Boleto']['Valor']);
                $post['Boleto']['Multa'] = $this->brToDecimal($post['Boleto']['Multa']);
                $post['Boleto']['DespesaBancaria'] = $this->brToDecimal($post['Boleto']['DespesaBancaria']);
                $post['Boleto']['CEP'] = $this->onlyNumbers($post['Boleto']['CEP']);
                $post['Boleto']['CNPJ'] = $this->onlyNumbers($post['Boleto']['CNPJ']);
            }
            if ($model->load($post) && $model->save()) {
                Yii::$app->session->setFlash('success', 'Boleto atualizado com sucesso!');
                return $this->redirect(['view', 'id' => $model->Id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Boleto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', 'Boleto excluído com sucesso!');
        return $this->redirect(['index']);
    }

    /**
     * Finds the Boleto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Boleto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Boleto::findOne(['Id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('O boleto solicitado não foi encontrado.');
    }

    /**
     * Converte valor monetário brasileiro para decimal (float)
     */
    private function brToDecimal($valor)
    {
        if ($valor === null || $valor === '') return null;
        $valor = str_replace(['.', ' '], '', $valor);
        $valor = str_replace(',', '.', $valor);
        return floatval($valor);
    }

    /**
     * Remove caracteres não numéricos
     */
    private function onlyNumbers($valor)
    {
        return $valor === null ? null : preg_replace('/\D/', '', $valor);
    }
} 