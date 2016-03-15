<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CourseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'คอร์ส';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
  <div class="col-lg-offset-11">
    <p>
        <?= Html::a('เพิ่มคอร์ส', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
  </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'title',
//            'images',
            [
                'attribute' => 'images',
                'format' => 'html',
                'label' => 'รูปภาพ',
                'value' => function ($model) {
                    if (!empty($model->images)) {
                    return Html::img('@getImage/imgCourse/' . $model['images'],
                        ['width' => '60px']);
                    } else {
                        return Html::img('@getImage/imgCourse/none.png' ,
                            ['width' => '60px']);
                    }
                },
            ],
            'category.title',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
