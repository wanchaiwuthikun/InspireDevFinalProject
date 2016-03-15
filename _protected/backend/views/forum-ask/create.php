<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ForumAsk */

$this->title = 'Create Forum Ask';
$this->params['breadcrumbs'][] = ['label' => 'Forum Asks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="forum-ask-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
