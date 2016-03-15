<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ForumAns */

$this->title = 'Create Forum Ans';
$this->params['breadcrumbs'][] = ['label' => 'Forum Ans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="forum-ans-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
