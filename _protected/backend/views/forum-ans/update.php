<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ForumAns */

$this->title = 'Update Forum Ans: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Forum Ans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="forum-ans-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
