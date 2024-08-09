<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Teachers $model */

$this->title = 'Update Teachers: ' . $model->TeacherID;
$this->params['breadcrumbs'][] = ['label' => 'Teachers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->TeacherID, 'url' => ['view', 'TeacherID' => $model->TeacherID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="teachers-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
