<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ForumAsk */

$this->title = 'Update Forum Ask: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Forum Asks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="forum-ask-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'model2' => $model2,
    ]) ?>

</div>
