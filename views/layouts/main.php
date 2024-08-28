<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
$this->registerCssFile("@web/css/custom.css", ['depends' => [\yii\bootstrap5\BootstrapAsset::class]]);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => ['/users/dashboard'],
        'options' => ['class' => 'navbar navbar-expand-lg navbar-dark bg-dark fixed-top']
    ]);
     // Initialize navigation items array
     // Left aligned items
    $navItemsLeft = [];

    if (Yii::$app->user->isGuest) {
        $navItemsLeft[] = ['label' => 'Home', 'url' => ['/users/dashboard']];
    } else {
        $navItemsLeft[] = ['label' => 'Teacher', 'url' => ['/teachers/index']];
        $navItemsLeft[] = ['label' => 'Student', 'url' => ['/stu/index']];
        $navItemsLeft[] = ['label' => 'React Students', 'url' => ['/stu/students']];
        $navItemsLeft[] = ['label' => 'React Calculator', 'url' => ['/stu/calculator']];
        $navItemsLeft[] = ['label' => 'About', 'url' => ['/stu/about']];
    }

    // Right aligned items
    $navItemsRight = [];

    if (Yii::$app->user->isGuest) {
        $navItemsRight[] = ['label' => 'Login', 'url' => ['/users/login']];
        $navItemsRight[] = ['label' => 'SignUp', 'url' => ['/users/signup']];
    } else {
        $navItemsRight[] = '<li class="nav-item">'
            . Html::beginForm(['/users/logout'])
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->user_name . ')',
                ['class' => 'nav-link btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }

    // Render left-aligned items
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => $navItemsLeft,
    ]);

    // Render right-aligned items
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ms-auto'], // Use ms-auto for Bootstrap 5 (ml-auto for older versions)
        'items' => $navItemsRight,
    ]);

    NavBar::end();
    ?>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-3 bg-light">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 text-center text-md-start">&copy; My Company <?= date('Y') ?></div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
