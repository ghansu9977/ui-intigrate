<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Users $model */
/** @var ActiveForm $form */

$this->title = 'Signup';
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'user_name')->textInput(['maxlength' => true, 'oninput' => 'capitalizeWords(this)']) ?>
        <?= $form->field($model, 'user_email') ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
        <?= $form->field($model, 'password_repeat')->passwordInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
        </div>
        <script>
function capitalizeWords(input) {
    let words = input.value.split(' ');
    for (let i = 0; i < words.length; i++) {
        words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1).toLowerCase();
    }
    input.value = words.join(' ');
}
</script>
    <?php ActiveForm::end(); ?>

</div>
