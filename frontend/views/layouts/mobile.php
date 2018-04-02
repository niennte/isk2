<?php

/* @var $this \yii\web\View */
/* @var $content string */


use yii\helpers\Html;
use frontend\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <?= Html::csrfMetaTags() ?>

<?
    // head
    require_once($_SERVER['DOCUMENT_ROOT'] . '../legacy/mobile/inc.mobileHead.php');
?>
    <?php /*$this->head()*/ ?>
</head>
<?
    // page content
?>

        <?= $content ?>

<?
    // footer
$index = false;
?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '../legacy/mobile/mobileFooter.php'); ?>


<?php $this->endBody() ?>
</body>
</html>
<?php /*$this->endPage()*/ ?>
