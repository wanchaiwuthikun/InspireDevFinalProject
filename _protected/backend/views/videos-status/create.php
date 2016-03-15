<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\VideosStatus */

$this->title = 'Create Videos Status';
$this->params['breadcrumbs'][] = ['label' => 'Videos Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="videos-status-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
