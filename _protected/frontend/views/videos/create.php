<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Videos */

$this->title = 'อัพโหลดวิดีโอ';
$this->params['breadcrumbs'][] = ['label' => 'บทเรียนออนไลน์', 'url' => ['lesson']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="videos-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <hr>
    <?= $this->render('_form', [
        'model' => $model,
        'model2' => $model2,
        'model3' => $model3,
    ]) ?>

</div>
