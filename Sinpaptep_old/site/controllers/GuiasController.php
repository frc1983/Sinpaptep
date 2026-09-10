<?php

namespace app\controllers;

use app\models\Boleto;

class GuiasController extends \yii\web\Controller {

    public function actionAssistencial() {
        return $this->render('assistencial');
    }

    public function actionSindical() {
        return $this->render('sindical');
    }
    
    public function actionSindical2() {
        return $this->render('sindical2');
    }

    public function actionBoleto() {
        //print_r($_POST);
        //die;

        $boleto = new Boleto();
        $boleto->Nome = $_POST['sacadoNome'];
        $boleto->CNPJ = str_replace('/', '', str_replace('.', '', str_replace('-', '', $_POST['sacadoCNPJ'])));
        $boleto->Endereco = $_POST['sacadoEndereco'];
        $boleto->CEP = $_POST['sacadoCep'];
        $boleto->Cidade = $_POST['sacadoCidade'];
        $boleto->Valor = number_format(str_replace(',', '.', str_replace('.', '', str_replace('R$', '', $_POST['valor']))), 2, '.', '');
        $boleto->DataVencimento = date('Y-m-d', strtotime(str_replace('-', '/', $_POST['dataVencimento'])));;
        $boleto->Multa = $_POST['multa'] != "" ? number_format(str_replace(',', '.', str_replace('.', '', str_replace('R$', '', $_POST['multa']))), 2, '.', '') : 0;
        $boleto->DespesaBancaria = 0; //number_format(str_replace(',', '.', str_replace('.', '', str_replace('R$', '', $_POST['despesas']))), 2, '.', '');
        $boleto->DataGeracaoBoleto = date("Y-m-d");

        if ($boleto->validate() && $boleto->save()) {
            $_POST['numDocumento'] = $boleto->Id;
            $_POST['nossoNumero'] = str_pad($boleto->Id, 8, "0", STR_PAD_LEFT);
            return $this->render('boleto');
        } else {
            // validation failed: $errors is an array containing error messages
            $errors = $boleto->errors;
            print_r($errors);
            die;
        }
    }

}
