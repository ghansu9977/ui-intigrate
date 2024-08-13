<?php

namespace app\controllers;

use app\models\Users;
use app\models\SignupForm;
use app\models\LoginForm;
use yii\web\Controller;
use yii\web\Response;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;

/**
 * StuController implements the CRUD actions for Students model.
 */
class UsersController extends Controller
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
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    public function actionSignup()
    {
    $model = new SignupForm();

    if ($model->load(Yii::$app->request->post()) && $model->signup()) {
        Yii::$app->session->setFlash('success', 'Thank you for signing up. You can now login.');
        return $this->redirect(['login']);
    }

    return $this->render('signup', [
        'model' => $model,
    ]);
}
    //login
    public function actionLogin()
    {
        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }
    // Logout
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    // redirect dashboard
    public function actionDashboard()
    {
        return $this->render('dashboard');
    }

}
