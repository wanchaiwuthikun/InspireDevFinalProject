
<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\VideosStatus;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\VideosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'บทเรียนออนไลน์';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if(Yii::$app->session->hasFlash('alert')):?>
    <?= \yii\bootstrap\Alert::widget([
        'body'=>ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'body'),
        'options'=>ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'options'),
    ])?>
<?php endif; ?>
<div class="videos-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   <div align="right"><p>
        <?= Html::a('อัพโหลดวิดีโอ', ['videos/createadmin'], ['class' => 'btn btn-success']) ?>
    </p></div>
    <div class="col-lg">
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
            // 'user_id',
            [
                'attribute'=>'ผู้อัพโหลด',
                'value' => function ($data) {
                    return $data->getAuthorName();
                },
            ],
            [
                'attribute'=>'สถานะ',
                'value' => function ($data) {
                    return $data->getStatusVideos();
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Action',
                'template'=>'{view} {delete}'

            ],
        ],
    ]); ?>
</div>


</div>
