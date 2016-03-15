<?php
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\helpers\Url;
use yii\data\Pagination;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', Yii::$app->name) .' '. Yii::t('app', 'Course');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'กระทู้ถาม-ตอบ'), 'url' => ['forum']];
$this->params['breadcrumbs'][] = $models2->title;

?>
<div class="article-index">

    <h1><?= Html::encode('กระทู้ถาม-ตอบ') ?>
        <span class="small"> - <?= Html::encode($models2->title) ?></span>
    </h1>

    <hr class="top">
    <div class="col-lg-offset-1 col-lg-10" align="right">
      <?php if (Yii::$app->user->id): ?>
        <?= Html::a('ตั้งกระทู้ใหม่', Url::to(['forum-ask/create', 'id'=> $models2->id]),
                 ['class' => 'btn btn-forum btn-success']) ?>
      <?php endif; ?>
    </div>

    <?php foreach ($models as $model): ?>
    <div class="col-lg-offset-1 col-lg-10">
        <div class="bs-callout bs-callout-info">
            <h4> <a href="<?= Url::to(['forum-ask/showdetail', 'id'=>Html::encode($model->id)]); ?>">
                    <?= Html::encode("{$model -> title}") ?>
                </a>
            </h4>
        </div>
    </div>



    <?php endforeach; ?>
    </ul>

    <div class="col-lg-12" align="center ">
        <?php echo LinkPager::widget([
            'pagination' => $pagination,
        ]); ?>
    </div>

</div>
