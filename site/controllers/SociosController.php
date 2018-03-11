<?php

namespace app\controllers;

use Yii;
use app\models\Socio;
use app\models\SocioEndereco;
use app\models\SocioDadosEmpresa;
use app\models\SocioFilho;
use yii\web\Controller;
use yii\db\Exception;

class SociosController extends Controller {

    public function actionIndex() {
        $mensagem = "";
        $sucesso = false;
        $model = new Socio();
        $endereco = new SocioEndereco();
        $empresa = new SocioDadosEmpresa();
        $filhos = array();

        if ($model->load(Yii::$app->request->post()) &&
                $endereco->load(Yii::$app->request->post()) &&
                $empresa->load(Yii::$app->request->post())) {

            $connection = \Yii::$app->db;
            $transaction = $connection->beginTransaction();

            try {
                $model->DataNascimento = $this->DateFromString($model->DataNascimento);
                $model->DataExpiracaoTituloEleitor = $this->DateFromString($model->DataExpiracaoTituloEleitor);
                $model->DataNascimentoConjuge = $this->DateFromString($model->DataNascimentoConjuge);
                if ($model->validate() && $model->save()) {
                    $endereco->Id_Socio = $model->Id;
                    $empresa->Id_Socio = $model->Id;
                    $empresa->DataInicioCargoAtual = $this->DateFromString($empresa->DataInicioCargoAtual);

                    if ($empresa->validate() && $endereco->validate() &&
                            $empresa->save() && $endereco->save()) {
                        $this->InsertFilhos($model);
                    }
                    $transaction->commit();

                    $mensagem = "Sócio cadastrado com sucesso!";
                    $sucesso = true;
                } else {
                    // validation failed: $errors is an array containing error messages
                    //$errors = $endereco->errors;
                    //print_r($errors);
                    //die;
                }
            } catch (Exception $e) {
                $transaction->rollback();
                $mensagem = "Erro ao salvar dados.";
                $sucesso = false;
            }
        }

        return $this->render('index', array(
                    'model' => new Socio(),
                    'endereco' => new SocioEndereco(),
                    'empresa' => new SocioDadosEmpresa(),
                    'filhos' => array(),
                    'mensagem' => $mensagem,
                    'sucesso' => $sucesso
        ));
    }

    private function InsertFilhos($model) {
        if (isset($_POST['Socio']['socioFilhos'])) {
            $filhos = $_POST['Socio']['socioFilhos'];
            foreach ($_POST['Socio']['socioFilhos'] as $filho) {
                if (!empty($filho['Nome']) && !empty($filho['DataNascimento'])) {
                    $f = new SocioFilho();
                    $f->Id_Socio = $model->Id;
                    $f->Nome = $filho['Nome'];
                    $f->DataNascimento = $this->DateFromString($filho['DataNascimento']);
                    $f->save();
                }
            }
        }
    }

    private function DateFromString($date) {
        list($d, $m, $y) = explode('/', $date);
        $mk = mktime(0, 0, 0, $m, $d, $y);
        $dob_disp1 = strftime('%Y-%m-%d', $mk);
        return $dob_disp1;
    }

}
