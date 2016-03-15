<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ForumAnsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Forum Ans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="forum-ans-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Forum Ans', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'content',
            'create_at',
            'update_at',
            'user_id',
            // 'forumAsk_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
