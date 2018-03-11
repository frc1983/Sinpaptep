<?php

namespace app\controllers;

use Yii;
use app\models\Socio;
use app\models\SocioEndereco;
use app\models\SocioDadosEmpresa;
use app\models\SocioFilho;
use yii\web\Controller;
use yii\db\Exception;
use inquid\pdf\FPDF;

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

    public function actionPrint() {
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(40, 10, 'Cadastro de Sócios - SINPAPTEP-RS');
        
        $this->DadosPessoais($pdf);
        $filename = "Cadastro_Socio.pdf";
        $pdf->Output($filename,'D');

        $this->render("print");
    }

    private function DadosPessoais($pdf){
        $pdf->Ln(20);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(40, 5, 'Dados Pessoais');
        
        $pdf->SetFont('Arial', '', 12);
        $pdf->Ln(10);
        $pdf->Cell(15,5,'Nome:');
        $pdf->Cell(130,5,'Fábio Rocha da Costa', 'B', 0, 'L');
        $pdf->Cell(12,5,'CPF:');
        $pdf->Cell(0,5,'00139253009', 'B');
        $pdf->Ln(10);
        $pdf->Cell(47,5,'Cidade de Nascimento:');
        $pdf->Cell(75,5,'Porto Alegre', 'B', 0, 'L');
        $pdf->Cell(43,5,'Data de Nascimento:');
        $pdf->Cell(25,5,'01/05/1983', 'B', 0, 'L');
        $pdf->Ln(10);
        $pdf->Cell(27,5,'Estado Civíl:');
        $pdf->Cell(42,5,'Casado', 'B', 0, 'L');        
        $pdf->Cell(30,5,'Nacionalidade:');
        $pdf->Cell(40,5,'Brasileiro', 'B', 0, 'L');
        $pdf->Cell(24,5,'Identidade:');
        $pdf->Cell(27,5,'3078770686', 'B', 0, 'L');
        $pdf->Ln(10);
        $pdf->Cell(32,5,'Orgão Emissor:');
        $pdf->Cell(10,5,'SJS', 'B', 0, 'L');
        $pdf->Ln(10);
        $pdf->Cell(30,5,'Nome da Mãe:');
        $pdf->Cell(65,5,'Rejane Rocha da Costa', 'B');
        $pdf->Cell(28,5,'Nome do Pai:');
        $pdf->Cell(67,5,'Manoel da Costa Neto', 'B');
        $pdf->Ln(10);
        $pdf->Cell(38,5,'Nome do Cônjuge:');
        $pdf->Cell(79,5,'Carla Fernanda Ouriques', 'B');
        $pdf->Cell(48,5,'Nascimento do Cônjuge:');
        $pdf->Cell(25,5,'24/10/1969', 'B');
        $pdf->Ln(10);
        $pdf->Cell(38,5,'Nº Título de Eleitor:');
        $pdf->Cell(37,5,'53855225515', 'B');
        $pdf->Cell(40,5,'UF Título de Eleitor:');
        $pdf->Cell(8,5,'RS', 'B');
        $pdf->Cell(37,5,'Data de Expiração:');
        $pdf->Cell(30,5,'NUNCA', 'B');
        $pdf->Ln(10);
        $pdf->Cell(27,5,'Logradouro:');
        $pdf->Cell(65,5,'Rua Deodoro', 'B');
        $pdf->Cell(20,5,'Número:');
        $pdf->Cell(15,5,'205', 'B');
        $pdf->Cell(30,5,'Complemento:');
        $pdf->Cell(33,5,'Bl H Ap 4313', 'B');
        $pdf->Ln(10);        
        $pdf->Cell(15,5,'Bairro:');
        $pdf->Cell(60,5,'Protásio Alves', 'B');
        $pdf->Cell(17,5,'Cidade:');
        $pdf->Cell(45,5,'Porto Alegre', 'B');
        $pdf->Cell(13,5,'CEP:');
        $pdf->Cell(22,5,'91260370', 'B');        
        $pdf->Cell(10,5,'UF:');
        $pdf->Cell(8,5,'RS', 'B');
        $pdf->Ln(10);
        $pdf->Cell(20,5,'Telefone:');
        $pdf->Cell(32,5,'(51) 3062-5993', 'B');
        $pdf->Cell(17,5,'Celular:');
        $pdf->Cell(33,5,'(51) 99332-0861', 'B');
        $pdf->Cell(13,5,'Email:');
        $pdf->Cell(75,5,'fabiorochadacosta@gmail.com', 'B');
    }
}
