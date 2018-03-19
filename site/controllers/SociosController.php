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
                    $this->PrintPDF($model);
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

    public function PrintPDF($model) {
        $pdf = new FPDF();
        $pdf->AddPage();
        $this->addHeader($pdf);
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->SetLeftMargin(90);
        $pdf->Cell(42, 5, 'Ficha de Sócio', 'B', 0, 'C');
        $pdf->SetLeftMargin(120);
        $pdf->Ln(10);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(42, 5, 'Matrícula Nº:', '', 0, 'R');
        $pdf->Cell(0, 5, '       /         ', 'B', 0, 'R');
        
        $pdf->SetLeftMargin(10);
        $this->DadosPessoais($pdf, $model);
        $this->DadosFilhos($pdf, $model);
        $this->DadosProfissionais($pdf, $model);

        $filename = "Cadastro_Socio.pdf";
        $pdf->Output($filename, 'D');

        $this->render("print");
    }

    private function DadosPessoais($pdf, $model) {
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(40, 5, 'Dados Pessoais');

        $pdf->SetFont('Arial', '', 11);
        $pdf->Ln(7);
        $pdf->Cell(15, 5, 'Nome:');
        $pdf->Cell(130, 5, $model->Nome, 'B', 0, 'L');
        $pdf->Cell(12, 5, 'CPF:');
        $pdf->Cell(0, 5, $model->CPF, 'B');
        $pdf->Ln(7);
        $pdf->Cell(44, 5, 'Cidade de Nascimento:');
        $pdf->Cell(75, 5, $model->CidadeNascimento, 'B', 0, 'L');
        $pdf->Cell(40, 5, 'Data de Nascimento:');
        $pdf->Cell(0, 5, date("d/m/Y", strtotime($model->DataNascimento)), 'B', 0, 'L');
        $pdf->Ln(7);
        $pdf->Cell(24, 5, 'Estado Civíl:');
        $pdf->Cell(42, 5, $model->EstadoCivil, 'B', 0, 'L');
        $pdf->Cell(30, 5, 'Nacionalidade:');
        $pdf->Cell(30, 5, $model->Nacionalidade, 'B', 0, 'L');
        $pdf->Cell(38, 5, 'Nº Título de Eleitor:');
        $pdf->Cell(0, 5, $model->TituloEleitor, 'B');
        $pdf->Ln(7);
        $pdf->Cell(28, 5, 'Nome da Mãe:');
        $pdf->Cell(65, 5, $model->NomeMae, 'B');
        $pdf->Cell(26, 5, 'Nome do Pai:');
        $pdf->Cell(0, 5, $model->NomePai, 'B');
        $pdf->Ln(7);
        $pdf->Cell(34, 5, 'Nome do Cônjuge:');
        $pdf->Cell(79, 5, $model->NomeConjuge, 'B');
        $pdf->Cell(44, 5, 'Nascimento do Cônjuge:');
        $pdf->Cell(0, 5, date("d/m/Y", strtotime($model->DataNascimentoConjuge)), 'B');
        $pdf->Ln(7);
        $pdf->Cell(27, 5, 'Logradouro:');
        $pdf->Cell(65, 5, $model->socioEnderecos->Logradouro, 'B');
        $pdf->Cell(20, 5, 'Número:');
        $pdf->Cell(15, 5, $model->socioEnderecos->Numero, 'B');
        $pdf->Cell(30, 5, 'Complemento:');
        $pdf->Cell(0, 5, $model->socioEnderecos->Complemento, 'B');
        $pdf->Ln(7);
        $pdf->Cell(15, 5, 'Bairro:');
        $pdf->Cell(60, 5, $model->socioEnderecos->Bairro, 'B');
        $pdf->Cell(17, 5, 'Cidade:');
        $pdf->Cell(45, 5, $model->socioEnderecos->Cidade, 'B');
        $pdf->Cell(13, 5, 'CEP:');
        $pdf->Cell(22, 5, $model->socioEnderecos->CEP, 'B');
        $pdf->Cell(10, 5, 'UF:');
        $pdf->Cell(0, 5, $model->socioEnderecos->UF, 'B');
        $pdf->Ln(7);
        $pdf->Cell(20, 5, 'Telefone:');
        $pdf->Cell(32, 5, $model->socioEnderecos->Telefone, 'B');
        $pdf->Cell(17, 5, 'Celular:');
        $pdf->Cell(33, 5, $model->socioEnderecos->Celular, 'B');
        $pdf->Cell(13, 5, 'Email:');
        $pdf->Cell(0, 5, $model->socioEnderecos->Email, 'B');
    }

    private function DadosFilhos($pdf, $model) {
        $pdf->Ln(7);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(40, 5, 'Filhos');

        $pdf->SetFont('Arial', '', 11);
        foreach ($model->socioFilhos as $filho) {
            $pdf->Ln(7);
            $pdf->Cell(27, 5, 'Nome do filho:');
            $pdf->Cell(93, 5, $filho->Nome, 'B', 0, 'L');
            $pdf->Cell(38, 5, 'Data de Nascimento:');
            $pdf->Cell(0, 5, date("d/m/Y", strtotime($filho->DataNascimento)), 'B', 0, 'L');
        }
    }

    private function DadosProfissionais($pdf, $model) {
        $pdf->Ln(7);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(40, 5, 'Dados Profissionais');

        $pdf->SetFont('Arial', '', 11);
        $pdf->Ln(7);
        $pdf->Cell(39, 5, 'Nome da Empresa:');
        $pdf->Cell(0, 5, $model->socioDadosempresas->Nome, 'B', 0, 'L');
        $pdf->Ln(7);
        $pdf->Cell(23, 5, 'Logradouro:');
        $pdf->Cell(65, 5, $model->socioDadosempresas->Logradouro, 'B');
        $pdf->Cell(20, 5, 'Número:');
        $pdf->Cell(15, 5, $model->socioDadosempresas->Numero, 'B');
        $pdf->Cell(30, 5, 'Complemento:');
        $pdf->Cell(0, 5, $model->socioDadosempresas->Complemento, 'B');
        $pdf->Ln(7);
        $pdf->Cell(15, 5, 'Bairro:');
        $pdf->Cell(60, 5, $model->socioDadosempresas->Bairro, 'B');
        $pdf->Cell(17, 5, 'Cidade:');
        $pdf->Cell(45, 5, $model->socioDadosempresas->Cidade, 'B');
        $pdf->Cell(13, 5, 'CEP:');
        $pdf->Cell(22, 5, $model->socioDadosempresas->CEP, 'B');
        $pdf->Cell(10, 5, 'UF:');
        $pdf->Cell(0, 5, $model->socioDadosempresas->UF, 'B');
        $pdf->Ln(7);
        $pdf->Cell(14, 5, 'Email:');
        $pdf->Cell(57, 5, $model->socioDadosempresas->Email, 'B');
        $pdf->Cell(24, 5, 'Cargo atual:');
        $pdf->Cell(45, 5, $model->socioDadosempresas->CargoAtual, 'B', 0, 'L');
        $pdf->Cell(30, 5, 'Data de Início:');
        $pdf->Cell(0, 5, date("d/m/Y", strtotime($model->socioDadosempresas->DataInicioCargoAtual)), 'B');
        $pdf->Ln(7);
        $pdf->Cell(26, 5, 'Nº da CTPS:');
        $pdf->Cell(32, 5, $model->socioDadosempresas->NumeroCTPS, 'B');
        $pdf->Cell(32, 5, 'Série  da CTPS:');
        $pdf->Cell(8, 5, $model->socioDadosempresas->SerieCTPS, 'B');
        $pdf->Cell(38, 5, 'Nº Reg. Autônomo:');
        $pdf->Cell(0, 5, $model->socioDadosempresas->NumeroRegistroAutonomo, 'B');
        $pdf->Ln(7);
        $pdf->Cell(30, 5, 'Nº Reg. DRTE:');
        $pdf->Cell(35, 5, $model->socioDadosempresas->NumeroRegistroDRTE, 'B');
        $pdf->Cell(36, 5, 'Grau de Instrução:');
        $pdf->Cell(0, 5, $model->socioDadosempresas->GrauInstrucao, 'B', 0, 'L');
        $pdf->Ln(15);
        $pdf->Cell(43, 5, 'Aceito em:' . date('d/m/Y'));
        $pdf->Ln();
        $pdf->Cell(32, 5, 'Ass. Proponente:');
        $pdf->Cell(0, 5, '', 'B');
        $pdf->Ln(10);
        $pdf->Cell(27, 5, 'Observações:');
        $pdf->MultiCell(0, 5, $model->socioDadosempresas->Observacoes, 'B');
        $pdf->Ln(7);
        $pdf->SetRightMargin(35);
        $pdf->Cell(0, 5, 'Assinatura Proposto:', 0, 0, 'R');
        $pdf->Ln(15);
        $pdf->SetLeftMargin(120);
        $pdf->Cell(80, 0, '                                     ', 'B', 0, 0, 'R');
        $pdf->SetRightMargin(10);
        $pdf->Ln(10 );
        $pdf->Cell(0, 5, 'Porto Alegre, _____, __________________,________.', 0, 0, 'R');
    }

    private function addHeader($pdf){
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Image('http://www.sindicatopublicitariosrs.com.br/site/web/images/logo.jpg', 94, 10, -270);
        $pdf->Ln(17);
        $pdf->MultiCell(0, 7, 'Sindicato dos Publicitários, Agenciadores de Propaganda e Trabalhadores em Empresas de Publicidade do Estado do Rio Grande do Sul', 0, 'C');
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 12);
    }
}
