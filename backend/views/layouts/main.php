<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\bootstrap4\Breadcrumbs;
//use yii\bootstrap4\Alert;
use common\widgets\Alert;

use yii\widgets\ActiveForm;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js" crossorigin="anonymous"></script>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => ['navbar-dark', 'bg-dark', 'navbar-expand-md'],
        ],
    ]);
    $menuItems = [
        //['label' => 'Home', 'url' => ['/site/index']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
    } else {
        $menuItems[] = ['label' => 'Смотреть задачи', 'url' => ['/category/index']];
        $menuItems[] = ['label' => 'Категорий', 'url' => ['/category/list']];
        $menuItems[] = ['label' => 'Добавить задачу', 'url' => ['/task/create-task']];
        $menuItems[] = ['label' => 'Warrning', 'url' => ['/task/warrning-task']];
        $menuItems[] = ['label' => 'Статистика', 'url' => ['/task/statistic']];
        //$menuItems[] = '<li>'
        //    . Html::beginForm(['/site/logout'], 'post')
        //    . Html::submitButton(
        //        'Logout (' . Yii::$app->user->identity->username . ')',
        //        ['class' => 'btn btn-link logout']
        //    )
        //    . Html::endForm()
        //    . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>
<footer class="footer">

    <div class="container">
    <?php $form = ActiveForm::begin(['action' =>['site/add-no-form'], 'method' => 'post',]); ?>
            <?= Html::csrfMetaTags() ?>
            <?= Html::submitButton('+1 smoking', ['class' => 'btn btn-primary' ]) ?>
        <?php ActiveForm::end(); ?>
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
