<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Videos */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Videos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="videos-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <div align="center">
<!--        <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->
        <iframe class="embed-responsive-item" width="853" height="480"
                src="//www.youtube.com/embed/<?= $model->url;?>?modestbranding=0&vq=720p&showinfo=0&autoplay=0&theme=light"
                frameborder="0" allowfullscreen>
        </iframe>
    </div>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
            'title',
            'content:ntext',
            'url:url',
            'course.title',
            'user.username',
        ],
    ]) ?>
    <p align="right">
        <?= Html::a('แก้ไข', ['videos/updateadmin', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('ลบ', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
