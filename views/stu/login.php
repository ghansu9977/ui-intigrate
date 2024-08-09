<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Users $model */
/** @var ActiveForm $form */
?>
<div class="stu-login">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'user_name') ?>
        <?= $form->field($model, 'user_email') ?>
        <?= $form->field($model, 'password_hash') ?>
        <?= $form->field($model, 'auth_key') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- stu-login -->
