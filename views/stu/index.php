<?php

use app\models\Students;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\StudentsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Students';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="students-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
    <div class="col d-flex align-items-center">
        <?= Html::a('Create Students', ['create'], ['class' => 'btn btn-success mr-2']) ?>
    </div>
    <div class="col d-flex justify-content-end align-items-center">
        <?= Html::a('Export Excel', ['export'], ['class' => 'btn btn-info']) ?>
    </div>
</div>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=>'SID',
                'label'=>'Student ID',
                'contentOptions'=>['style'=>'width: 90px'],
            ],
            'FirstName',
            'LastName',
            'DOB',
            'Gender',
            [
                'class' => ActionColumn::className(),
                'header' => 'Action',
                'urlCreator' => function ($action, Students $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'SID' => $model->SID]);
                 }
            ],
        ],
    ]); ?>


</div>
