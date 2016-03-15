<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\VideosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'บทเรียนออนไลน์';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="videos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<!--  <div class="col-lg-offset-11">-->
<!--    <p>-->
<!--        --><?//= Html::a('อัพโหลดวิดีโอ', ['create'], ['class' => 'btn btn-success']) ?>
<!--    </p>-->
<!--  </div>-->
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'title',
//            'content:ntext',
            'url:url',
            'course.title',
//            [
//                'attribute' => 'ชื่อคอร์ส',
//                'value' => function ($data) {
//                    return $data->getCourseName();
//                },
//            ],
//            'user_id',
            [
                'attribute'=>'ผู้อัพโหลด',
                'value' => function ($data) {
                    return $data->getAuthorName();
                },
            ],
            'videosStatus.title',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
