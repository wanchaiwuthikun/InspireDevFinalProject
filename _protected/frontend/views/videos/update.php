<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Videos */

$this->title = 'แก้ไขวิดีโอ: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Videos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="videos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'model2' => $model2
    ]) ?>

</div>