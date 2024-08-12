<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/** @var yii\web\View $this */
/** @var app\models\Teachers $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="teachers-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'FirstName')->textInput(['maxlength' => true, 'oninput' => 'this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1);']) ?>

    <?= $form->field($model, 'LastName')->textInput(['maxlength' => true, 'oninput' => 'this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1);']) ?>

    <?= $form->field($model, 'Subject')->dropDownList([''=>'-- Select --','Hindi'=>'Hindi','English'=>'English','Maths'=>'Maths','Science'=>'Science','So. Science'=>'So. Science',]) ?>

    <?= $form->field($model, 'HireDate')->widget(DatePicker::class, [
    'dateFormat' => 'yyyy-MM-dd',
    'options' => ['class' => 'form-control'],
    'clientOptions' => [
        'changeMonth' => true,
        'changeYear' => true,
        'yearRange' => '2000:2099', // Adjust the year range as needed
    ],
]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
