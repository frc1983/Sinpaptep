<?php

namespace app\controllers;

use Yii;
use app\models\Contato;
use yii\web\Controller;

class ContatoController extends Controller {

    public function actionIndex() {
        return $this->render('index', [
                    'model' => new Contato(),
        ]);
    }

    /*public function actionSend() {
        $model = new Contato();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->mensagem = 
                    'Nome: '.Yii::$app->request->post()['Contato']['nome'].'<br />'.
                    'Email: '.Yii::$app->request->post()['Contato']['email'].'<br />'.
                    'Telefone: '.Yii::$app->request->post()['Contato']['telefone'].'<br />'.
                    'Mensagem: '.Yii::$app->request->post()['Contato']['mensagem'];
            Yii::$app->mailer->compose() // a view rendering result becomes the message body here
                    ->setFrom($model->email)
                    ->setTo(Yii::$app->params['adminEmail'])
                    ->setSubject('Contato Sinpaptep RS')
                    ->setHtmlBody($model->mensagem)
                    ->send();

            Yii::$app->session->setFlash('success', 'Email enviado com sucesso.');
        } else {
            Yii::$app->session->setFlash('error', 'Houve um erro ao enviar o email.');
        }
        
        return $this->render('index', ['model' => new Contato()]);
    }*/

}
