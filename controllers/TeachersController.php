<?php

namespace app\controllers;

use app\models\Teachers;
use app\models\TeachersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TeachersController implements the CRUD actions for Teachers model.
 */
class TeachersController extends Controller
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

    /**
     * Lists all Teachers models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TeachersSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Teachers model.
     * @param int $TeacherID Teacher ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($TeacherID)
    {
        return $this->render('view', [
            'model' => $this->findModel($TeacherID),
        ]);
    }

    /**
     * Creates a new Teachers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Teachers();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['index', 'TeacherID' => $model->TeacherID]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Teachers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $TeacherID Teacher ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($TeacherID)
    {
        $model = $this->findModel($TeacherID);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['index', 'TeacherID' => $model->TeacherID]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Teachers model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $TeacherID Teacher ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($TeacherID)
    {
        $this->findModel($TeacherID)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Teachers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $TeacherID Teacher ID
     * @return Teachers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($TeacherID)
    {
        if (($model = Teachers::findOne(['TeacherID' => $TeacherID])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
