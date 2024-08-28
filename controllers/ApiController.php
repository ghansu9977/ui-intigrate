<?php
namespace app\controllers;

use yii\web\Controller;
use yii\web\Response;
use yii\web\BadRequestHttpException;
use app\models\Students;
use Yii;

class ApiController extends Controller
{
    public function behaviors()
    {
        return [
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
        ];
    }

    public function actionFetchall()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $students = Students::find()->asArray()->all();
        return $students;
    }

    public function actionCreate()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $data = Yii::$app->request->getBodyParams();
        
        if (empty($data)) {
            throw new BadRequestHttpException('Empty request body');
        }

        $model = new Students();
        $model->attributes = $data;

        if ($model->validate() && $model->save()) {
            return $model;
        } else {
            return [
                'status' => 'error',
                'errors' => $model->errors,
            ];
        }
    }
    
    public function actionUpdate($SID)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        // Find the student model by SID
        $model = Students::findOne($SID);
        if (!$model) {
            return [
                'status' => 'error',
                'message' => 'Student not found',
            ];
        }

        // Load data into model and validate
        $data = Yii::$app->request->getBodyParams();
        $model->attributes = $data;

        if ($model->validate() && $model->save()) {
            return [
                'status' => 'success',
                'message' => 'Student updated successfully',
                'student' => $model,
            ];
        } else {
            return [
                'status' => 'error',
                'errors' => $model->errors,
            ];
        }
    }


    public function actionDelete($SID)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
    
        $model = Students::findOne($SID);
    
        if ($model === null) {
            return [
                'status' => 'error',
                'message' => 'Student not found',
            ];
        }
    
        if ($model->delete()) {
            return [
                'status' => 'success',
                'message' => 'Student deleted successfully',
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Failed to delete student',
            ];
        }
    }
    
}
