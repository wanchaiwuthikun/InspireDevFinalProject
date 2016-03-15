<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ForumAskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'กระทู้ถาม-ตอบ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="forum-ask-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div align="right"><p>
        <?= Html::a('ตั้งกระทู้', ['forum-ask/createadmin'], ['class' => 'btn btn-success']) ?>
    </p></div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'title',
//            'content:ntext',
//            'create_at',
//            'update_at',
             'course.title',
              'user.username',

            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Action',
                'template'=>'{view} {delete}'
            ],
        ],
    ]); ?>

</div>
