<?php

use app\models\Teachers;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\TeachersSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Teachers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teachers-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Teachers', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            'TeacherID',
            'FirstName',
            'LastName',
            'Subject',
            'HireDate',
            [
                'class' => ActionColumn::className(),
                'header' => 'Action',
                'urlCreator' => function ($action, Teachers $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'TeacherID' => $model->TeacherID]);
                 }
            ],
        ],
    ]); ?>


</div>
