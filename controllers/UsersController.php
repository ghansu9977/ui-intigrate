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
        Yii::$app->user->logout();
        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $loginData = $model->login()) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return [
                'success' => true,
                'token' => $loginData['token'],
                'user' => [
                    'id' => $loginData['user']->id,
                    'user_name' => $loginData['user']->user_name,
                    'user_email' => $loginData['user']->user_email,
                ],
            ];
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }
    // Logout
    public function actionLogout()
    {
        Yii::$app->user->logout();
        // Clear localStorage via a script in the response
        $script = <<<JS
        <script>
            localStorage.removeItem('token');
            localStorage.removeItem('user');
            window.location.href = '/';
        </script>
        JS;
        return $script;
    }
    // redirect dashboard
    public function actionDashboard()
    {
        return $this->render('dashboard');
    }
    // public function actionValidateToken()
    // {
    //     Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

    //     $headers = Yii::$app->request->headers;
    //     $authHeader = $headers->get('Authorization');

    //     if ($authHeader && preg_match('/^Bearer\s+(.*?)$/', $authHeader, $matches)) {
    //         $token = $matches[1];
    //         try {
    //             $decoded = \Firebase\JWT\JWT::decode($token, Yii::$app->params['jwtSecretKey'], ['HS256']);
    //             return [
    //                 'success' => true,
    //                 'user' => $decoded->sub,  // You can include more details here if needed
    //             ];
    //         } catch (\Exception $e) {
    //             return [
    //                 'success' => false,
    //                 'message' => 'Invalid token.',
    //             ];
    //         }
    //     }

    //     return [
    //         'success' => false,
    //         'message' => 'Authorization header not found.',
    //     ];
    // }


}
