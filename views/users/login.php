<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\LoginForm $model */
/** @var ActiveForm $form */

$this->title = 'Login';
?>
<div class="users-login shadow-lg p-4 mb-5 bg-white rounded container-fluid w-25 h-auto" style="margin-top: 80px; ">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'user_email')->textInput(['autofocus' => true]) ?>
        <?= $form->field($model, 'password')->passwordInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'id' => 'login-button']) ?>
        </div>

    <?php ActiveForm::end(); ?>
    <!-- Add this script to handle the login and store data in localStorage -->
<script>
document.getElementById('login-button').addEventListener('click', function(e) {
    e.preventDefault();
    var form = document.forms[0];
    var formData = new FormData(form);
    
    fetch('<?= \yii\helpers\Url::to(['users/login']) ?>', {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Store the token and user details in localStorage
            localStorage.setItem('token', data.token);
            localStorage.setItem('user', JSON.stringify(data.user));
            
            // Redirect to the dashboard or another page
            window.location.href = '<?= \yii\helpers\Url::to(['users/dashboard']) ?>';
        } else {
            alert('Login failed: ' + data.error);
        }
    })
    .catch(error => console.error('Error during login:', error));
});
</script>

</div>
