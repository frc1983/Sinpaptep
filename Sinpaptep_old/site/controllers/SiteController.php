<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Destaque;
use app\models\Noticia;
use app\models\Convencao;
use app\models\Parceiro;

class SiteController extends Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex() {
        $destaques = Destaque::getLast(2);
        $noticias = Noticia::find()->orderBy(['Id'=>SORT_DESC])->limit(5)->all();
        $convencoes = [
            Convencao::find()->where("Id_Categoria_Convencao = :cat", ["cat" => 1])->orderBy("Id desc")->with("idCategoriaConvencao")->all(),
            Convencao::find()->where("Id_Categoria_Convencao = :cat", ["cat" => 2])->orderBy("Id desc")->with("idCategoriaConvencao")->all(),
            Convencao::find()->where("Id_Categoria_Convencao = :cat", ["cat" => 3])->orderBy("Id desc")->with("idCategoriaConvencao")->all()
        ];
        $parceiros = Parceiro::find()->all();

        return $this->render('index', [
                    'destaques' => $destaques,
                    'noticias' => $noticias,
                    'convencoes' => $convencoes,
                    'parceiros' => $parceiros
        ]);
    }

    public function actionLogin() {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                        'model' => $model,
            ]);
        }
    }

    public function actionAbout() {
        return $this->render('about');
    }

}
