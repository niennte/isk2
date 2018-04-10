<?php

/* @var $this \yii\web\View */
/* @var $content string */
/* @var $demoName string */

use common\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;

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


    <link rel="stylesheet" type="text/css" href="/css/filter/demo.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" >
    <link rel="stylesheet" type="text/css" href="/css/filter/panelComponent.css" />

    <script src="/js/filter/modernizr.custom.js"></script>

</head>
<body class="indexPage bsEnabled newNav blackFriday">
<?php $this->beginBody() ?>

<?= $content ?>

<?php /*$this->endBody()*/ ?>

</body>
</html>
<?php $this->endPage() ?>
