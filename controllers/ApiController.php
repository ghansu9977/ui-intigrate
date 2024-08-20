<?php
namespace app\controllers;

use yii\web\Controller;
use yii\web\Response;
use app\models\Students;
use Yii;

class ApiController extends Controller
{
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'corsFilter' => [
            'class' => \yii\filters\Cors::class,
            'cors' => [
                'Origin' => ['http://localhost:5173'],
                'Access-Control-Allow-Credentials' => true,
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],
                'Access-Control-Allow-Headers' => ['Authorization', 'Content-Type', 'X-Requested-With'],
                'Access-Control-Allow-Origin' => true,
            ],
        ],
        ]);
    }
    public function actionStudents()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $students = Students::find()->asArray()->all();
        return $students;
    }
}
