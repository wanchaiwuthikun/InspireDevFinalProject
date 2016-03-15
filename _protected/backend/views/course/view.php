<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Course */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'คอร์ส', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="col-lg-12" align="center">
    <?php if (!empty($model->images)) {

        echo Html::img(Url::to('@getImage/imgCourse/'.$model->images,true), [
            'style'=>'width:100px;',
            'class'=>'img-rounded']);

    } else {

        echo Html::img(Url::to('@getImage/imgCourse/none.png',true), [
            'style'=>'width:100px;','class'=>'img-rounded']);
    }
    ?>
    </div>
    <div class="col-lg-12" align="right">
    <p>
        <?= Html::a('แก้ไข', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('ลบ', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    </div>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
            'title',
            'images',
            'category.title',
        ],
    ]) ?>

</div>
