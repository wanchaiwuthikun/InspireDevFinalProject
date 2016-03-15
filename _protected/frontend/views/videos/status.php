<?php
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', Yii::$app->name) .' '. Yii::t('app', 'news');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'บทเรียนออนไลน์'), 'url' => ['lesson']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ตรวจสอบสถานะวิดีโอ')];
//$this->params['breadcrumbs'][] = Yii::t('app', 'Articles');
?>
<?php if(Yii::$app->session->getFlash('alert')): ?>
<?= \yii\bootstrap\Alert::widget([
    'body'=>ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'body'),
    'options'=>ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'options'),
])?>

<?php endif; ?>
<div class="article-index">

    <h1>
        <span class="small"><?= Html::encode('ตรวจสอบสถานะวิดีโอ')?></span>
    </h1>

    <hr class="top">

       <h4><?= Html::encode("วิดีโอของฉัน") ?></h4>

        <ul>
        <?php foreach ($model as $model): ?>
            <li>

                    <?= Html::encode($model -> title) ?>

                   <?php
                   if ($model->videos_status_id == 1) {

                       echo '<button type="button" class="btn btn-material-amber btn-xs">
                            รอตรวจสอบ </button>';
                   } else if ($model->videos_status_id == 2) {
                       echo '<button type="button" class="btn btn-success btn-xs">
                            อนุมัติ </button>';
                   } else {
                       echo '<button type="button" class="btn btn-danger btn-xs">
                            ไม่อนุมัติ </button>';
                   }

                   ?>
                    <?= Html::a('<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>',
                        ['deletemember', 'id' => $model->id], [
//                    'class' => 'btn btn-forum btn-md btn-danger',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ],
                        ]) ?>
            </li>

        <?php endforeach; ?>

    </ul>
</div>
