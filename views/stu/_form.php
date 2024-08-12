<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;


/** @var yii\web\View $this */
/** @var app\models\Students $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="students-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'FirstName')->textInput(['maxlength' => true, 'oninput' => 'this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1);']) ?>

    <?= $form->field($model, 'LastName')->textInput(['maxlength' => true, 'oninput' => 'this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1);']) ?>

    <?= $form->field($model, 'DOB')->widget(DatePicker::class, [
    'dateFormat' => 'yyyy-MM-dd',
    'options' => ['class' => 'form-control'],
    'clientOptions' => [
        'changeMonth' => true,
        'changeYear' => true,
        'yearRange' => '1900:2099', // Adjust the year range as needed
    ],
]) ?>

    <?= $form->field($model, 'Gender')->dropDownList([''=>'-- Select --','M'=>'Male','F'=>'Female']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
