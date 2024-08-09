<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Teachers $model */

$this->title = $model->TeacherID;
$this->params['breadcrumbs'][] = ['label' => 'Teachers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="teachers-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'TeacherID' => $model->TeacherID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'TeacherID' => $model->TeacherID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'TeacherID',
            'FirstName',
            'LastName',
            'Subject',
            'HireDate',
        ],
    ]) ?>

</div>
