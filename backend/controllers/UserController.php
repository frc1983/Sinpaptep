<?php
namespace backend\controllers;

use Yii;
use common\models\User;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Html;

class UserController extends Controller
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
            'query' => User::find(),
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC],
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
        $model = new User();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // Gera token de verificação e envia e-mail
            $model->generateEmailVerificationToken();
            $model->save(false);
            $sent = Yii::$app->mailer->compose([
                'html' => '@common/mail/emailVerify-html',
                'text' => '@common/mail/emailVerify-text',
            ], ['user' => $model])
                ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
                ->setTo($model->email)
                ->setSubject('Confirmação de cadastro em ' . Yii::$app->name)
                ->send();
            if ($sent) {
                Yii::$app->session->setFlash('success', 'Usuário criado com sucesso! E-mail de confirmação enviado para ' . Html::encode($model->email));
            } else {
                Yii::$app->session->setFlash('warning', 'Usuário criado, mas não foi possível enviar o e-mail de confirmação.');
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Usuário atualizado com sucesso!');
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', 'Usuário excluído com sucesso!');
        return $this->redirect(['index']);
    }

    public function actionResetPassword($id)
    {
        $user = $this->findModel($id);
        $user->generatePasswordResetToken();
        if ($user->save(false)) {
            Yii::$app->mailer->compose([
                'html' => '@common/mail/passwordResetToken-html',
                'text' => '@common/mail/passwordResetToken-text',
            ], ['user' => $user])
                ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
                ->setTo($user->email)
                ->setSubject('Redefinição de senha para ' . Yii::$app->name)
                ->send();
            Yii::$app->session->setFlash('success', 'Email de redefinição de senha enviado para ' . Html::encode($user->email));
        } else {
            Yii::$app->session->setFlash('error', 'Não foi possível gerar o link de redefinição de senha.');
        }
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('O usuário solicitado não foi encontrado.');
    }
} 