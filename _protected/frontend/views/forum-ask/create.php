<?php

use yii\helpers\Html;



/* @var $this yii\web\View */
/* @var $model app\models\ForumAsk */

$this->title = 'ตั้งกระทู้';
$this->params['breadcrumbs'][] = ['label' => 'กระทู้ถาม-ตอบ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="forum-ask-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'model2' => $model2,
        'model3' => $model3,
    ]) ?>

</div>
