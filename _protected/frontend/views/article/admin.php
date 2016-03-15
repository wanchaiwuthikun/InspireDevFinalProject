<?php
use common\helpers\CssHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'บทความ');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="articles-admin">

    <h1>

    <?= Html::encode($this->title) ?>
    </h1>
    <div align="right"><span>
        <?= Html::a(Yii::t('app', 'สร้างบทความ'), ['article/createadmin'], ['class' => 'btn btn-success']) ?>
    </span></div>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            // author
            [
                'attribute'=>'user_id',
                'value' => function ($data) {
                    return $data->getAuthorName();
                },
            ],
            'title',
            // status
            [
                'attribute'=>'status',
                'filter' => $searchModel->statusList,
                'value' => function ($data) {
                    return $data->getStatusName($data->status);
                },
                'contentOptions'=>function($model, $key, $index, $column) {
                    return ['class'=>CssHelper::articleStatusCss($model->statusName)];
                }
            ],
            'course.title',
//            [
//                'attribute'=>'category',
//                'filter' => $searchModel->categoryList,
//                'value' => function ($data) {
//                    return $data->getCategoryName($data->category);
//                },
//                'contentOptions'=>function($model, $key, $index, $column) {
//                    return ['class'=>CssHelper::articleCategoryCss($model->categoryName)];
//                }
//            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Action',
                'template'=>'{view} {delete}'
            ],
        ],
    ]); ?>

</div>
