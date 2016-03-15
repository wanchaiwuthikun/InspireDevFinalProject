<?php
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\helpers\Url;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'บทเรียนออนไลน์');
$this->params['breadcrumbs'][] = Yii::t('app', 'บทเรียนออนไลน์');
?>
<div class="article-index">

    <h1><?= Html::encode($this->title) ?> 
<!--        <span class="small"> - --><?//= Yii::t('app', 'The best news available') ?><!--</span>-->
    </h1>
    <?php if (Yii::$app->user->id): ?>
    <hr class="top">
        <div align="right">
                <?= Html::a('ตรวจสอบสถานะวิดีโอ', ['videos/status'], ['class' => 'btn btn-success']) ?>
        </div>
    <?php endif; ?>
    <hr>
    <div>
    <?php foreach ($models as $model): ?>

        <div class="col-xs-12 col-sm-4 col-md-6 col-lg-3 ">
            <div class="card">

                <div class="card-height-indicator"></div>

                <div class="card-content">

                    <div class="card-image">
                        <a href="<?= Url::to(['videos/show', 'id' => Html::encode($model->id)]);?>">
                            <?= Html::img(Url::to('@web/uploads/imgCourse/'.$model->images,true)); ?>
                        </a>
<!--                        <h3 class="card-image-headline">--><?//= Html::encode("{$model -> title}") ?><!--</h3>-->
                    </div>

                    <div class="card-body card-font">
                        <?= Html::encode("{$model -> title}") ?>
<!--                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>-->

                    </div>

                    <footer class="card-footer pull-right">
<!--                        <button class="btn btn-flat">Share</button>-->
                        <div class="pull-right">
                            <button class="btn btn-sm btn-flat  btn-info">
                            <a href="<?= Url::to(['videos/show', 'id'=>Html::encode($model->id)]); ?>">
                                <?= Html::encode("เรียนรู้เพิ่มเติม") ?>
                                          </a>
                            </button>
                        </div>

                    </footer>

                </div>

            </div>
        </div>


    <?php endforeach; ?>

    </div>
    <div class="" align="right">
   <?php echo LinkPager::widget([
    'pagination' => $pagination,
    ]); ?>
    </div>


</div>
