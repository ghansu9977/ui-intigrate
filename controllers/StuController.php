<?php

namespace app\controllers;

use app\models\Students;
use app\models\StudentsSearch;
use yii\web\Controller;
use yii\web\Response;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Yii;

/**
 * StuController implements the CRUD actions for Students model.
 */
class StuController extends Controller
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
     * Lists all Students models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new StudentsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Students model.
     * @param int $SID Sid
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($SID)
    {
        return $this->render('view', [
            'model' => $this->findModel($SID),
        ]);
    }

    /**
     * Creates a new Students model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Students();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'SID' => $model->SID]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Students model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $SID Sid
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($SID)
    {
        $model = $this->findModel($SID);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'SID' => $model->SID]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Students model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $SID Sid
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($SID)
    {
        $this->findModel($SID)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Students model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $SID Sid
     * @return Students the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($SID)
    {
        if (($model = Students::findOne(['SID' => $SID])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionDashboard()
    {
        return $this->render('dashboard');
    }
    public function actionLogin()
    {
        $model = new \app\models\Users();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                // form inputs are valid, do something here
                return;
            }
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }
    public function actionExport()
    {   
        
        $posts = Students::find()->all();

        // Check if there are any posts
        if (empty($posts)) {
            Yii::$app->session->setFlash('error', 'No data to export.');
            return $this->redirect(['index']);
        }
        else{
            
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
        
            // Set header row
            $sheet->setCellValue('A1', 'Sid');
            $sheet->setCellValue('B1', 'First Name');
            $sheet->setCellValue('C1', 'Last Name');
            $sheet->setCellValue('D1', 'Dob');
            $sheet->setCellValue('E1', 'Gender');
        
            // Add data rows
            $row = 2;
            foreach ($posts as $post) {
                $sheet->setCellValue('A' . $row, $post->SID);
                $sheet->setCellValue('B' . $row, $post->FirstName);
                $sheet->setCellValue('C' . $row, $post->LastName);
                $sheet->setCellValue('D' . $row, $post->DOB);
                $sheet->setCellValue('E' . $row, $post->Gender);
                $row++;
            }
        
            // Create Excel file
            $writer = new Xlsx($spreadsheet);
            $filename = 'products.xlsx';
        
            // Start output buffering
            ob_start();
        
            // Clear output buffer
            if (ob_get_contents()) {
                ob_end_clean();
            }
        
            // Serve the file for download
            Yii::$app->response->format = Response::FORMAT_RAW;
            Yii::$app->response->getHeaders()->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            Yii::$app->response->getHeaders()->set('Content-Disposition', 'attachment; filename="' . $filename . '"');
            Yii::$app->response->getHeaders()->set('Cache-Control', 'max-age=0');
        
            // Output the file
            $writer->save('php://output');
            Yii::$app->response->send();
            exit;
        
    }
    }
}
