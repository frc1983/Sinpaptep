<?php

namespace frontend\controllers;

use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\models\Noticia;
use common\models\Parceiro;
use common\models\Socio;
use common\models\SocioDadosEmpresa;
use common\models\SocioEndereco;
use common\models\SocioFilho;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $noticias = Noticia::getUltimasNoticias(5);
        $anunciantes = \common\models\Parceiro::find()->orderBy(['Nome' => SORT_ASC])->all();
        return $this->render('index', [
            'noticias' => $noticias,
            'anunciantes' => $anunciantes,
        ]);
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Obrigado por entrar em contato. Responderemos o mais breve possível.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }
            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionNoticias()
    {
        $noticias = Noticia::find()
            ->with(['categoria'])
            ->orderBy(['Id' => SORT_DESC])
            ->all();
        return $this->render('noticias', [
            'noticias' => $noticias,
        ]);
    }

    public function actionNoticia($id)
    {
        $noticia = Noticia::find()
            ->with(['categoria'])
            ->where(['Id' => $id])
            ->one();
        if ($noticia === null) {
            throw new \yii\web\NotFoundHttpException('Notícia não encontrada.');
        }
        return $this->render('noticia', [
            'noticia' => $noticia,
        ]);
    }

    public function actionNoticiasPorCategoria($categoriaId)
    {
        $categoria = \common\models\Categoria::findOne($categoriaId);
        if ($categoria === null) {
            throw new \yii\web\NotFoundHttpException('Categoria não encontrada.');
        }
        $noticias = Noticia::getNoticiasPorCategoria($categoriaId);
        return $this->render('noticias-por-categoria', [
            'categoria' => $categoria,
            'noticias' => $noticias,
        ]);
    }

    public function actionBuscarNoticias()
    {
        $term = Yii::$app->request->get('q', '');
        if (empty($term)) {
            return $this->redirect(['noticias']);
        }
        $noticias = Noticia::buscarNoticias($term);
        return $this->render('buscar-noticias', [
            'term' => $term,
            'noticias' => $noticias,
        ]);
    }

    /**
     * Displays parceiros page.
     *
     * @return mixed
     */
    public function actionParceiros()
    {
        $parceiros = Parceiro::getParceirosAtivos();
        
        return $this->render('parceiros', [
            'parceiros' => $parceiros,
        ]);
    }

    /**
     * Displays homologacoes page.
     *
     * @return mixed
     */
    public function actionHomologacoes()
    {
        return $this->render('homologacoes');
    }

    /**
     * Displays politica de privacidade page.
     *
     * @return mixed
     */
    public function actionPoliticaPrivacidade()
    {
        return $this->render('politica-privacidade');
    }

    public function actionJuridico()
    {
        return $this->render('juridico');
    }

    public function actionCadastroSocio()
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
                    Yii::$app->session->setFlash('success', 'Cadastro realizado com sucesso!');
                    return $this->refresh();
                } catch (\Exception $e) {
                    $transaction->rollBack();
                    Yii::$app->session->setFlash('error', 'Erro ao salvar cadastro: ' . $e->getMessage());
                }
            }
        }

        return $this->render('cadastro-socio', [
            'socio' => $socio,
            'empresa' => $empresa,
            'endereco' => $endereco,
            'filhos' => $filhos,
        ]);
    }
} 